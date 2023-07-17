<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MaterialSalesController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->brunch = $this->session->userdata('BRANCHid');
        $access = $this->session->userdata('userId');
        if ($access == '') {
            redirect("Login");
        }
        $this->load->model('Billing_model');
        $this->load->library('cart');
        $this->load->model('Model_table', "mt", TRUE);
        $this->load->helper('form');
    }

    public function materialSales($sales_id  = 0){
        $access = $this->mt->userAccess();
        if(!$access){
            redirect(base_url());
        }
        $data['title'] = "Raw Material Sales";
        $data['sales_id'] = $sales_id;
        $data['invoiceNumber'] = $this->mt->generateMaterialSalesCode();
        $data['content'] = $this->load->view('Administrator/material/materialSales', $data, TRUE);
        $this->load->view('Administrator/index', $data);
    }

    public function MaterialSalesRecord(){
        $access = $this->mt->userAccess();
        if(!$access){
            redirect(base_url());
        }
        $data['title'] = "Material Sales Record";
        $data['content'] = $this->load->view('Administrator/material/material_sales_record', $data, TRUE);
        $this->load->view('Administrator/index', $data);
    }

    public function getMaterialSales(){
        $options = json_decode($this->input->raw_input_stream);
        $clauses = "";

        if(isset($options->sales_id)){
            $clauses .= " and p.sales_id = '$options->sales_id'";
        }

        if(isset($options->customer_id) && $options->customer_id != null){
            $clauses .= " and p.customer_id = '$options->customer_id'";
        }

        if(isset($options->dateFrom) && isset($options->dateTo) && $options->dateFrom != null && $options->dateTo != null){
            $clauses .= " and p.sales_date between '$options->dateFrom' and '$options->dateTo'";
        }

        $sales = $this->db->query("
            select 
                p.*,
                c.Customer_Name as customer_name,
                c.Customer_Code as customer_code,
                c.Customer_Mobile as customer_mobile,
                c.Customer_Address as customer_address,
                c.Customer_Type as customer_type
            from tbl_material_sales p
            join tbl_customer c on c.Customer_SlNo = p.customer_id
            where p.status = 'a' 
            and p.branch_id = '$this->brunch'
            $clauses
        ")->result();

        $totalSales = 0.00;
        $totalPaid = 0.00;
        $totalDue = 0.00;
        foreach($sales as $sale){
            $totalSales += $sale->total;
            $totalPaid += $sale->paid;
            $totalDue += $sale->due;
        }

        $data['sales'] = $sales;
        $data['totalSales'] = $totalSales;
        $data['totalPaid'] = $totalPaid;
        $data['totalDue'] = $totalDue;

        echo json_encode($data);
    }

    public function getMaterialSalesDetails(){
        $options = json_decode($this->input->raw_input_stream);
        $clauses = "";
        if(isset($options->sales_id) && $options->sales_id != '') {
            $clauses .= " and pd.sales_id = '$options->sales_id'";
        }
        if(isset($options->materialId) && $options->materialId != '') {
            $clauses .= " and pd.material_id = '$options->materialId'";
        }
        if(isset($options->categoryId) && $options->categoryId != '') {
            $clauses .= " and m.category_id = '$options->categoryId'";
        }
        $salesDetails = $this->db->query("
            select
                pd.*,
                m.code,
                m.name,
                mc.ProductCategory_Name as category_name,
                u.Unit_Name as unit_name,
                mp.invoice_no,
                mp.sales_date,
                c.Customer_Name as customer_name,
                c.Customer_Code as customer_code
            from tbl_material_sales_details pd
            join tbl_material_sales mp on mp.sales_id = pd.sales_id
            join tbl_customer c on c.Customer_SlNo = mp.customer_id
            left join tbl_materials m on m.material_id = pd.material_id
            left join tbl_materialcategory mc on mc.ProductCategory_SlNo = m.category_id
            left join tbl_unit u on u.Unit_SlNo = m.unit_id
            where pd.status = 'a'
            and pd.branch_id = '$this->brunch'
            $clauses
        ")->result();

        echo json_encode($salesDetails);
    }

    public function addMaterialSales(){
        $res = ['success'=>false, 'message'=>''];
        try{
            $data = json_decode($this->input->raw_input_stream);

            $countSalesCode = $this->db->query("select * from tbl_material_sales where invoice_no = ?", $data->sales->invoice_no)->num_rows();
            if($countSalesCode > 0){
                $data->sales->invoice_no = $this->mt->generateMaterialSalesCode();
            }

            $customerId = $data->sales->customer_id;
            if(isset($data->customer)){
                $customer = (array)$data->customer;
                unset($customer['Customer_SlNo']);
                unset($customer['display_name']);
                $customer['Customer_Code'] = $this->mt->generateCustomerCode();
                $customer['Status'] = 'a';
                $customer['AddBy'] = $this->session->userdata("FullName");
                $customer['AddTime'] = date('Y-m-d H:i:s');
                $customer['Customer_brinchid'] = $this->session->userdata('BRANCHid');

                $this->db->insert('tbl_customer', $customer);
                $customerId = $this->db->insert_id();
            }

            $sales = array(
                "customer_id" => $customerId,
                "invoice_no" => $data->sales->invoice_no,
                "sales_date" => $data->sales->sales_date,
                "sales_for" => $data->sales->sales_for,
                "sub_total" => $data->sales->sub_total,
                "vat" => $data->sales->vat,
                "transport_cost" => $data->sales->transport_cost,
                "discount" => $data->sales->discount,
                "total" => $data->sales->total,
                "paid" => $data->sales->paid,
                "due" => $data->sales->due,
                "previous_due" => $data->sales->previous_due,
                "note" => $data->sales->note,
                "status" => 'a',
                "branch_id" => $this->brunch,
            );
            $this->db->insert('tbl_material_sales', $sales);
            $lastId = $this->db->insert_id();

            foreach($data->salesMaterials as $salesMaterial){
                $pm = array(
                    "sales_id" => $lastId,
                    "material_id" => $salesMaterial->material_id,
                    "sales_rate" => $salesMaterial->sales_rate,
                    "quantity" => $salesMaterial->quantity,
                    "total" => $salesMaterial->total,
                    "status" => 'a',
                    "branch_id" => $this->brunch,
                );
                $this->db->insert('tbl_material_sales_details', $pm);
            }

            $res = ['success'=>true, 'message'=>'Material Sales Success', 'salesId'=>$lastId];
        } catch (Exception $ex){
            $res = ['success'=>false, 'message'=>$ex->getMessage()];
        }

        echo json_encode($res);
    }

    public function updateMaterialSales(){
        $res = ['success'=>false, 'message'=>''];
        try{
            $data = json_decode($this->input->raw_input_stream);

            if(isset($data->customer)){
                $customer = (array)$data->customer;
                unset($customer['Customer_SlNo']);
                unset($customer['display_name']);
                $customer['UpdateBy'] = $this->session->userdata("FullName");
                $customer['UpdateTime'] = date('Y-m-d H:i:s');

                $this->db->where('Customer_SlNo', $data->sales->customer_id)->update('tbl_customer', $customer);
            }

            $sales = array(
                "customer_id" => $data->sales->customer_id,
                "invoice_no" => $data->sales->invoice_no,
                "sales_date" => $data->sales->sales_date,
                "sales_for" => $data->sales->sales_for,
                "sub_total" => $data->sales->sub_total,
                "vat" => $data->sales->vat,
                "transport_cost" => $data->sales->transport_cost,
                "discount" => $data->sales->discount,
                "total" => $data->sales->total,
                "paid" => $data->sales->paid,
                "due" => $data->sales->due,
                "previous_due" => $data->sales->previous_due,
                "note" => $data->sales->note
            );
            $this->db->where('sales_id', $data->sales->sales_id);
            $this->db->set($sales);
            $this->db->update('tbl_material_sales');

            $this->db->delete('tbl_material_sales_details', array('sales_id' => $data->sales->sales_id));
            foreach($data->salesMaterials as $salesdMaterial){
                $pm = array(
                    "sales_id" => $data->sales->sales_id,
                    "material_id" => $salesdMaterial->material_id,
                    "sales_rate" => $salesdMaterial->sales_rate,
                    "quantity" => $salesdMaterial->quantity,
                    "total" => $salesdMaterial->total,
                    "status" => 'a',
                    "branch_id" => $this->brunch,
                );
                $this->db->insert('tbl_material_sales_details', $pm);
            }

            $res = ['success'=>true, 'message'=>'Material Update Successfully', 'salesId'=>$data->sales->sales_id];
        } catch (Exception $ex){
            $res = ['success'=>false, 'message'=>$ex->getMessage()];
        }

        echo json_encode($res);
    }

    public function deleteMaterialSales(){
        $data = json_decode($this->input->raw_input_stream);
        $res = ['success'=>false, 'message'=>''];
        try{
            $this->db->query("update tbl_material_sales p set p.status = 'd' where p.sales_id = ?", $data->sales_id);
            $this->db->query("update tbl_material_sales_details pd set pd.status = 'd' where pd.sales_id = ?", $data->sales_id);
            $res = ['success'=>true, 'message'=>'Sales deleted'];
        } catch (Exception $ex){
            $res = ['success'=>false, 'message'=>$ex->getMessage()];
        }

        echo json_encode($res);
    }

    public function materialSalesInvoice($salesId){
        $data['title'] = "Material Sales Invoice";
        $data['salesId'] = $salesId;
        $data['content'] = $this->load->view("Administrator/material/material_sales_invoice", $data, true);
        $this->load->view("Administrator/index", $data);
    }

    // public function getMaterialStock()
    // {
    //     $data = json_decode($this->input->raw_input_stream);

    //     $stock = $this->db->query("
    //     select 
    //         (
    //             select ifnull(sum(mpd.quantity), 0) from tbl_material_purchase_details mpd
    //             where mpd.status = 'a'
    //             and mpd.material_id = '$data->materialId'
    //         ) as purchase_qty,
    //         (
    //             select ifnull(sum(msd.quantity), 0) from tbl_material_sales_details msd
    //             where msd.status = 'a'
    //             and msd.material_id = '$data->materialId'
    //         ) as sales_qty,
    //         (
    //             select (purchase_qty - sales_qty)
    //         ) as cur_stock
    //     ")->row();

    //     echo json_encode($stock);
    // }

    public function getMaterialCost() {
        $data = json_decode($this->input->raw_input_stream);

        $clauses = "";
        if(isset($data->dateFrom) && $data->dateFrom != '' 
        && isset($data->dateTo) && $data->dateTo != ''){
            $clauses .= " and ms.sales_date between '$data->dateFrom' and '$data->dateTo'";
        }

        $materialSales = $this->db->query("
            select 
                ms.*,
                c.Customer_Name
            from tbl_material_sales ms
            left join tbl_customer c on c.Customer_SlNo = ms.customer_id
            where ms.status = 'a'
            and ms.branch_id= " . $this->session->userdata('BRANCHid') . "
            $clauses
        ")->result();

        $cost = array_reduce($materialSales, function($prev, $curr){ return $prev + $curr->paid;});

        $res = [
            'cost' => $cost,
            'materialSales' => $materialSales
        ];

        echo json_encode($res);
    }

}