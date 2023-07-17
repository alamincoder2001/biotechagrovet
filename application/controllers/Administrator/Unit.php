<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->branch = $this->session->userdata('BRANCHid');
        $access = $this->session->userdata('userId');
        if ($access == '') {
            redirect("Login");
        }
        $this->load->model('Model_table', "mt", TRUE);
    }



    // start Unites Add
    // public function addUnite()
    // {
    //     $access = $this->mt->userAccess();
    //     if (!$access) {
    //         redirect(base_url());
    //     }
    //     $data['title'] = "Add Unite";
    //     $data['content'] = $this->load->view('Administrator/unit/add-unite', $data, TRUE);
    //     $this->load->view('Administrator/index', $data);
    // }

    // public function saveUnite()
    // {
    //     $res = ['success' => false, 'message' => ''];
    //     $inputObJ = json_decode($this->input->raw_input_stream);
    //     $uniteId = $inputObJ->unite_id;

    //     if ($uniteId == '') {
    //         $query = $this->db->query("select * from tbl_unites where unite_name = ? and branch_id = ?", [$inputObJ->unite_name, $this->brunch])->row();
    //     } else {
    //         $query = $this->db->query("select * from tbl_unites where unite_id != ? and unite_name = ? and branch_id = ?", [$uniteId, $inputObJ->unite_name, $this->brunch])->row();
    //     }

    //     if ($query) {
    //         $res = ['success' => false, 'message' => 'Duplicate Unite Name'];
    //         echo json_encode($res);
    //         exit;
    //     }

    //     try {
    //         $data = (array)$inputObJ;

    //         if ($uniteId == '') {
    //             unset($data['unite_id']);
    //             $data['status']    = 'a';
    //             $data['AddBy']     = $this->session->userdata("userId");
    //             $data['AddTime']   = date('Y-m-d H:i:s');
    //             $data['branch_id'] = $this->brunch;

    //             $this->db->insert('tbl_unites', $data);
    //         } else {
    //             unset($data['unite_id']);
    //             $data['UpdateBy']   = $this->session->userdata("userId");
    //             $data['updatetime'] = date('Y-m-d H:i:s');
    //             $this->db->where('unite_id', $uniteId)->update('tbl_unites', $data);
    //         }

    //         $res = ['success' => true, 'message' => 'Data Save successfully'];
    //     } catch (Exception $ex) {
    //         $res = ['success' => false, 'message' => $ex->getMessage()];
    //     }
    //     echo json_encode($res);
    // }

    // public function getUnites()
    // {
    //     $data = json_decode($this->input->raw_input_stream);

    //     // $clause = '';
    //     // if (isset($data->memo_for) && $data->memo_for == 'sale') {
    //     //     $clause = " and memo_for = 'sale' ";
    //     // }
    //     // if (isset($data->memo_for) && $data->memo_for == 'payment') {
    //     //     $clause = " and memo_for = 'payment' ";
    //     // }

    //     $unites = $this->db->query("SELECT * FROM tbl_unites order by unite_id asc")->result();

    //     echo json_encode($unites);
    // }
    // public function deleteUnite()
    // {
    //     $data = json_decode($this->input->raw_input_stream);

    //     $updateData = [];
    //     $updateData['status'] = 'd';

    //     $this->db->where('unite_id', $data->unite_id)->update('tbl_unites', $updateData);

    //     echo json_encode(['success' => true, 'message' => 'Unite delete successfully']);
    // }



    // start Unites Add
    public function addUnitArea()
    {
        $access = $this->mt->userAccess();
        if (!$access) {
            redirect(base_url());
        }
        $data['title'] = "Add Unit Area";
        $data['content'] = $this->load->view('Administrator/unit/add-unit-area', $data, TRUE);
        $this->load->view('Administrator/index', $data);
    }

    public function saveUnitArea()
    {
        $res = ['success' => false, 'message' => ''];
        $inputObJ = json_decode($this->input->raw_input_stream);
        $unitAreaId = $inputObJ->unit_area_id;

        if ($unitAreaId == '') {
            $query = $this->db->query("select * from tbl_unit_area where unit_area_name = ? and branch_id = ?", [$inputObJ->unit_area_name, $this->branch])->row();
        } else {
            $query = $this->db->query("select * from tbl_unit_area where unit_area_id != ? and unit_area_name = ? and branch_id = ?", [$unitAreaId, $inputObJ->unit_area_name, $this->branch])->row();
        }

        if ($query) {
            $res = ['success' => false, 'message' => 'Duplicate Unite Area Name'];
            echo json_encode($res);
            exit;
        }

        try {
            $data = (array)$inputObJ;

            if ($unitAreaId == '') {
                unset($data['unit_area_id']);
                $data['status']    = 'a';
                $data['AddBy']     = $this->session->userdata("userId");
                $data['AddTime']   = date('Y-m-d H:i:s');
                $data['branch_id'] = $this->branch;

                $this->db->insert('tbl_unit_area', $data);

                $res = ['success' => true, 'message' => 'Data Save successfully'];
            } else {
                unset($data['unit_area_id']);
                $data['UpdateBy']   = $this->session->userdata("userId");
                $data['updatetime'] = date('Y-m-d H:i:s');
                $this->db->where('unit_area_id', $unitAreaId)->update('tbl_unit_area', $data);

                $res = ['success' => true, 'message' => 'Data Update successfully'];
            }
        } catch (Exception $ex) {
            $res = ['success' => false, 'message' => $ex->getMessage()];
        }
        echo json_encode($res);
    }

    public function getUnitAreas()
    {
        $data = json_decode($this->input->raw_input_stream);

        $clause = '';
        if (isset($data->unit_area_id) && $data->unit_area_id != '') {
            $clause .= " and ua.unit_area_id = '$data->unit_area_id' ";
        }
        // if (isset($data->unite_id) && $data->unite_id != '') {
        //     $clause .= " and ua.unite_id = '$data->unite_id' ";
        // }
        // if (isset($data->BranchId) && $data->BranchId != '') {
        //     $clause .= " and ua.branch_id = '$data->BranchId' ";
        // }

        $unites = $this->db->query("SELECT ua.*
        FROM tbl_unit_area ua
        where ua.branch_id = ?
        $clause
        order by ua.unit_area_id asc", $this->branch)->result();

        echo json_encode($unites);
    }
    public function deleteUnitArea()
    {
        $data = json_decode($this->input->raw_input_stream);

        $updateData = [];
        $updateData['status'] = 'd';

        $this->db->where('unit_area_id', $data->unit_area_id)->update('tbl_unit_area', $updateData);

        echo json_encode(['success' => true, 'message' => 'Unite Area delete successfully']);
    }



    // start Territory Add
    public function addTerritory()
    {
        $access = $this->mt->userAccess();
        if (!$access) {
            redirect(base_url());
        }
        $data['title'] = "Add Unite";
        $data['content'] = $this->load->view('Administrator/unit/add-territory', $data, TRUE);
        $this->load->view('Administrator/index', $data);
    }

    public function saveTerritory()
    {
        $res = ['success' => false, 'message' => ''];
        $inputObJ = json_decode($this->input->raw_input_stream);
        $territoryId = $inputObJ->territory_id;

        if ($territoryId == '') {
            $query = $this->db->query("select * from tbl_territories where territory_name = ? and branch_id = ?", [$inputObJ->territory_name, $this->branch])->row();
        } else {
            $query = $this->db->query("select * from tbl_territories where territory_id != ? and territory_name = ? and branch_id = ?", [$territoryId, $inputObJ->territory_name, $this->branch])->row();
        }

        if ($query) {
            $res = ['success' => false, 'message' => 'Duplicate Territory Name'];
            echo json_encode($res);
            exit;
        }

        try {
            $data = (array)$inputObJ;

            if ($territoryId == '') {
                unset($data['territory_id']);
                $data['status']    = 'a';
                $data['AddBy']     = $this->session->userdata("userId");
                $data['AddTime']   = date('Y-m-d H:i:s');
                $data['branch_id'] = $this->branch;

                $this->db->insert('tbl_territories', $data);
            } else {
                unset($data['territory_id']);
                $data['UpdateBy']   = $this->session->userdata("userId");
                $data['updatetime'] = date('Y-m-d H:i:s');
                $this->db->where('territory_id', $territoryId)->update('tbl_territories', $data);
            }

            $res = ['success' => true, 'message' => 'Data Save successfully'];
        } catch (Exception $ex) {
            $res = ['success' => false, 'message' => $ex->getMessage()];
        }
        echo json_encode($res);
    }

    public function getTerritories()
    {
        $data = json_decode($this->input->raw_input_stream);

        $clause = '';
        if (isset($data->unitAreaId) && $data->unitAreaId != '') {
            $clause .= " and tr.unit_area_id = '$data->unitAreaId' ";
        }
        if (isset($data->BranchId) && $data->BranchId != '') {
            $clause .= " and tr.branch_id = '$data->BranchId' ";
        }

        $territories = $this->db->query("SELECT tr.*,ua.unit_area_name
        FROM tbl_territories tr
        LEFT JOIN tbl_unit_area ua on ua.unit_area_id = tr.unit_area_id
        where tr.branch_id = ?
        $clause
        order by territory_id asc", $this->branch)->result();

        echo json_encode($territories);
    }
    public function deleteTerritory()
    {
        $data = json_decode($this->input->raw_input_stream);

        $updateData = [];
        $updateData['status'] = 'd';

        $this->db->where('territory_id', $data->territory_id)->update('tbl_territories', $updateData);

        echo json_encode(['success' => true, 'message' => 'Territory delete successfully']);
    }

    public function index()
    {
        $access = $this->mt->userAccess();
        if (!$access) {
            redirect(base_url());
        }

        $data['title'] = "Sales Target Entry";
        $data['content'] = $this->load->view('Administrator/unit/sale_target_entry', $data, TRUE);
        $this->load->view('Administrator/index', $data);
    }

    public function saveSaleTarget()
    {
        $data = json_decode($this->input->raw_input_stream);
        $saleTargetId = $data->inpupData->sale_target_id;

        try {
            if ($saleTargetId == '') {
                $inputArray = [
                    'month_id'                  => $data->inpupData->month_id,
                    'date'                      => date('Y-m-d'),
                    'total_sale_target'         => $data->inpupData->total_sale_target,
                    'total_sale_forecast'       => $data->inpupData->total_sale_forecast,
                    'total_recovery_commitment' => $data->inpupData->total_recovery_commitment,
                    'status'                    => 'a',
                    'AddBy'                     => $this->session->userdata('userId'),
                    'AddTime'                   => date('Y-m-d H:i:s'),
                    'branch_id'                 => $this->branch,
                ];

                $this->db->insert('tbl_sale_target', $inputArray);
                $saleTargetInsertId = $this->db->insert_id();

                foreach ($data->territories as $key => $territory) {
                    $tDataArray = [
                        'sale_target_id'         => $saleTargetInsertId,
                        'unit_area_id'           => $territory->unit_area_id,
                        'unit_area_territory_id' => $territory->territory_id,
                        'cm_sale_target'         => $territory->current_month_sale_target,
                        'cm_sale_forecast'       => $territory->current_month_sale_forecast,
                        'cm_recovery_commitment' => $territory->current_month_recovery_commitment,
                        'status'                 => 'a',
                        'AddBy'                  => $this->session->userdata('userId'),
                        'AddTime'                => date('Y-m-d H:i:s'),
                        'branch_id'              => $this->branch,
                    ];

                    $this->db->insert('tbl_sale_target_details', $tDataArray);
                }

                $res = ['success' => true, 'message' => 'Data Save Successfully'];
            } else {
                $inputArray = [
                    'month_id'                   => $data->inpupData->month_id,
                    'total_sale_target'         => $data->inpupData->total_sale_target,
                    'total_sale_forecast'       => $data->inpupData->total_sale_forecast,
                    'total_recovery_commitment' => $data->inpupData->total_recovery_commitment,
                    'UpdateBy'                  => $this->session->userdata('userId'),
                    'UpdateTime'                => date('Y-m-d H:i:s'),
                    'branch_id'                 => $this->branch,
                ];

                $this->db->where('sale_target_id', $saleTargetId)->update('tbl_sale_target', $inputArray);

                $this->db->where('sale_target_id', $saleTargetId)->delete('tbl_sale_target_details');

                foreach ($data->territories as $key => $territory) {
                    $tDataArray = [
                        'sale_target_id'         => $saleTargetId,
                        'unit_area_id'           => $territory->unit_area_id,
                        'unit_area_territory_id' => $territory->territory_id,
                        'cm_sale_target'         => $territory->current_month_sale_target,
                        'cm_sale_forecast'       => $territory->current_month_sale_forecast,
                        'cm_recovery_commitment' => $territory->current_month_recovery_commitment,
                        'status'                 => 'a',
                        'AddBy'                  => $this->session->userdata('userId'),
                        'AddTime'                => date('Y-m-d H:i:s'),
                        'branch_id'              => $this->branch,
                    ];

                    $this->db->insert('tbl_sale_target_details', $tDataArray);
                }
                $res = ['success' => true, 'message' => 'Data Update Successfully'];
            }
        } catch (Exception $e) {
            $res = ['success' => false, 'message' => $e->getMessage];
        }

        echo json_encode($res);
    }

    public function checkSaleTarget()
    {
        $data = json_decode($this->input->raw_input_stream);

        $checkExist = $this->db->query("SELECT * FROM tbl_sale_target WHERE status = 'a' and month_id = ? and branch_id = ? ", [$data->month_id, $this->branch])->row();

        if ($checkExist) {
            $saleTarget = $this->db->query("SELECT * FROM tbl_sale_target WHERE status = 'a' and month_id = ? and branch_id = ?", [$data->month_id, $this->branch])->result();

            $saleTargetDetails = $this->db->query("SELECT std.*,ua.unit_area_name,t.territory_name
            FROM tbl_sale_target_details std
            LEFT JOIN tbl_sale_target st on st.sale_target_id = std.sale_target_id
            LEFT JOIN tbl_unit_area ua on ua.unit_area_id = std.unit_area_id
            LEFT JOIN tbl_territories t on t.territory_id = std.unit_area_territory_id
            WHERE std.status = 'a'
            and std.sale_target_id = ?
            and std.branch_id = ?
            order by target_details_id asc
            ", [$saleTarget[0]->sale_target_id, $this->branch])->result();

            $res = ['success' => true, 'message' => 'Exist Found', 'saleTarget' => $saleTarget, 'saleTargetDetails' => $saleTargetDetails];
        } else {
            $res = ['success' => false, 'message' => 'Exist Not Found'];
        }

        echo json_encode($res);
    }










    //extra
    public function getSaleTargetMonth()
    {
        $data = json_decode($this->input->raw_input_stream);

        $clause = '';
        if (isset($data->unit_id) && $data->unit_id != '') {
            $clause .= " and unit_id = '$data->unit_id' ";
        }

        $months = $this->db->query("SELECT sale_target_id, date
         FROM tbl_sale_target
         WHERE status = 'a'
         and branch_id = ?
         $clause
        ", $this->branch)->result();

        echo json_encode($months);
    }







    //unit reports

    public function saleRecovery()
    {
        $access = $this->mt->userAccess();
        if (!$access) {
            redirect(base_url());
        }
        $data['title'] = "Sale and Recovery";
        $data['content'] = $this->load->view('Administrator/unit/sale_and_recovery', $data, TRUE);
        $this->load->view('Administrator/index', $data);
    }
    public function getSaleTargetReport()
    {
        $data = json_decode($this->input->raw_input_stream);

        $clause = '';
        if (isset($data->month_id) && $data->month_id != '') {
            $clause .= " and month_id = '$data->month_id' ";
        }

        $saleMonth = date("m", strtotime($data->month_name)) - 1;
        $month = $data->month_id;
        $prev_month = $month - 1;

        $unitData = $this->db->query("SELECT
            (
                SELECT ifnull(sum(pst.total_sale_target),0)
                FROM tbl_sale_target pst
                WHERE pst.month_id = '$prev_month'
                and pst.status = 'a'
            ) as prev_total_sale_target,
            
            (
                SELECT ifnull(sum(pst.total_sale_forecast),0)
                FROM tbl_sale_target pst
                WHERE pst.month_id = '$prev_month'
                and pst.status = 'a'
            ) as prev_total_sale_forecast,

            (
                SELECT ifnull(sum(sm.SaleMaster_TotalSaleAmount),0)
                FROM tbl_salesmaster sm
                WHERE sm.Status = 'a'
                and MONTH(sm.SaleMaster_SaleDate) = '$saleMonth'
            ) as prev_total_sale_achieved,

            (select (prev_total_sale_achieved *100) / prev_total_sale_target) as prev_total_sale_ach_percent,
            
            (
                SELECT ifnull(sum(pst.total_recovery_commitment),0)
                FROM tbl_sale_target pst
                WHERE pst.month_id = '$prev_month'
                and pst.status = 'a'
            ) as prev_total_recovery_planned,

            (
                SELECT ifnull(sum(cp.CPayment_amount),0)
                FROM tbl_customer_payment cp
                WHERE cp.CPayment_status = 'a'
                and MONTH(cp.CPayment_date) = '$saleMonth'
            ) as prev_total_recovery_achieved,
            
            (select (prev_total_recovery_achieved *100) / prev_total_recovery_planned) as prev_total_recovery_ach_percent,

            
            (
                SELECT ifnull(sum(st.total_sale_target),0)
                FROM tbl_sale_target st
                WHERE st.month_id = '$month'
                and st.status = 'a'
            ) as total_sale_target,
            (
                SELECT ifnull(sum(st.total_sale_forecast),0)
                FROM tbl_sale_target st
                WHERE st.month_id = '$month'
                and st.status = 'a'
            ) as total_sale_forecast,
            (
                SELECT ifnull(sum(st.total_recovery_commitment),0)
                FROM tbl_sale_target st
                WHERE st.month_id = '$month'
                and st.status = 'a'
            ) as total_recovery_commitment

            FROM tbl_sale_target st
            WHERE st.status = 'a'
        ")->row();

        $res['unitData'] = $unitData;


        $unitAreaData = $this->db->query("SELECT ua.unit_area_name,ua.unit_area_id,
            (
                SELECT ifnull(sum(pstd.cm_sale_target),0)
                FROM tbl_sale_target_details pstd
                LEFT JOIN tbl_sale_target st on st.sale_target_id = pstd.sale_target_id
                WHERE st.month_id = '$prev_month'
                and pstd.unit_area_id = ua.unit_area_id
            ) as prev_area_sale_target,

            (
                SELECT ifnull(sum(pstd.cm_sale_forecast),0)
                FROM tbl_sale_target_details pstd
                LEFT JOIN tbl_sale_target st on st.sale_target_id = pstd.sale_target_id
                WHERE st.month_id = '$prev_month'
                and pstd.unit_area_id = ua.unit_area_id
            ) as prev_area_sale_forecast,

            (
                SELECT ifnull(sum(sm.SaleMaster_TotalSaleAmount),0)
                FROM tbl_salesmaster sm
                WHERE sm.Status = 'a'
                and MONTH(sm.SaleMaster_SaleDate) = '$saleMonth'
                and sm.unit_area_id = ua.unit_area_id
            ) as prev_area_sale_achieved,

            (select (prev_area_sale_achieved *100) / prev_area_sale_forecast) as prev_area_sale_ach_percent,

            (
                SELECT ifnull(sum(pstd.cm_recovery_commitment),0)
                FROM tbl_sale_target_details pstd
                LEFT JOIN tbl_sale_target st on st.sale_target_id = pstd.sale_target_id
                WHERE st.month_id = '$prev_month'
                and pstd.unit_area_id = ua.unit_area_id
            ) as prev_area_recovery_commitment,

            (
                SELECT ifnull(sum(cp.CPayment_amount),0)
                FROM tbl_customer_payment cp
                WHERE cp.CPayment_status = 'a'
                and MONTH(cp.CPayment_date) = '$saleMonth'
                and cp.unit_area_id = ua.unit_area_id
            ) as prev_area_recovery_achieved,
            
            (select (prev_area_recovery_achieved *100) / prev_area_recovery_commitment) as prev_area_recovery_ach_percent,

            (
                SELECT ifnull(sum(cstd.cm_sale_target),0)
                FROM tbl_sale_target_details cstd
                LEFT JOIN tbl_sale_target cst on cst.sale_target_id = cstd.sale_target_id
                WHERE cst.month_id = '$month'
                and cstd.unit_area_id = ua.unit_area_id
            ) as cm_area_sale_target,

            (
                SELECT ifnull(sum(cstd.cm_sale_forecast),0)
                FROM tbl_sale_target_details cstd
                LEFT JOIN tbl_sale_target cst on cst.sale_target_id = cstd.sale_target_id
                WHERE cst.month_id = '$month'
                and cstd.unit_area_id = ua.unit_area_id
            ) as cm_area_sale_forecast,

            (
                SELECT ifnull(sum(cstd.cm_recovery_commitment),0)
                FROM tbl_sale_target_details cstd
                LEFT JOIN tbl_sale_target cst on cst.sale_target_id = cstd.sale_target_id
                WHERE cst.month_id = '$month'
                and cstd.unit_area_id = ua.unit_area_id
            ) as cm_area_recovery_commitment

            FROM tbl_unit_area ua
            WHERE ua.status = 'a'
            and ua.branch_id = ?
            ", $this->branch)->result();

        $res['unitAreaData'] = $unitAreaData;


        $territoryData = $this->db->query("SELECT t.territory_name,t.unit_area_id,
            (
                SELECT ifnull(sum(pstd.cm_sale_target),0)
                FROM tbl_sale_target_details pstd
                left join tbl_sale_target pst on pst.sale_target_id = pstd.sale_target_id
                WHERE pst.month_id = '$prev_month'
                and pstd.unit_area_id = t.unit_area_id
                and pstd.unit_area_territory_id = t.territory_id
            ) as last_month_sale_target,
            
            (
                SELECT ifnull(sum(pstd.cm_sale_forecast),0)
                FROM tbl_sale_target_details pstd
                left join tbl_sale_target pst on pst.sale_target_id = pstd.sale_target_id
                WHERE pst.month_id = '$prev_month'
                and pstd.unit_area_id = t.unit_area_id
                and pstd.unit_area_territory_id = t.territory_id
            ) as last_month_sale_forecast,

            (
                SELECT ifnull(sum(sm.SaleMaster_TotalSaleAmount),0)
                FROM tbl_salesmaster sm
                WHERE sm.Status = 'a'
                and MONTH(sm.SaleMaster_SaleDate) = '$saleMonth'
                and sm.unit_area_id = t.unit_area_id
                and sm.territory_id = t.territory_id
            ) as last_month_sale_achieved,

            (select (last_month_sale_achieved *100) / last_month_sale_target) as last_month_sale_ach_percent,

            (
                SELECT ifnull(sum(pstd.cm_recovery_commitment),0)
                FROM tbl_sale_target_details pstd
                left join tbl_sale_target pst on pst.sale_target_id = pstd.sale_target_id
                WHERE pst.month_id = '$prev_month'
                and pstd.unit_area_id = t.unit_area_id
                and pstd.unit_area_territory_id = t.territory_id
            ) as last_month_recovery_planned,

            (
                SELECT ifnull(sum(cp.CPayment_amount),0)
                FROM tbl_customer_payment cp
                WHERE cp.CPayment_status = 'a'
                and MONTH(cp.CPayment_date) = '$saleMonth'
                and cp.unit_area_id = t.unit_area_id
                and cp.territory_id = t.territory_id
            ) as last_month_recovery_achieved,
            
            (select (last_month_recovery_achieved *100) / last_month_recovery_planned) as last_month_recovery_ach_percent,

            (
                SELECT ifnull(sum(cstd.cm_sale_target),0)
                FROM tbl_sale_target_details cstd
                left join tbl_sale_target cst on cst.sale_target_id = cstd.sale_target_id
                WHERE cst.month_id = '$month'
                and cstd.unit_area_id = t.unit_area_id
                and cstd.unit_area_territory_id = t.territory_id
            ) as cm_sale_target,
            (
                SELECT ifnull(sum(cstd.cm_sale_forecast),0)
                FROM tbl_sale_target_details cstd
                left join tbl_sale_target cst on cst.sale_target_id = cstd.sale_target_id
                WHERE cst.month_id = '$month'
                and cstd.unit_area_id = t.unit_area_id
                and cstd.unit_area_territory_id = t.territory_id
            ) as cm_sale_forecast,
            (
                SELECT ifnull(sum(cstd.cm_recovery_commitment),0)
                FROM tbl_sale_target_details cstd
                left join tbl_sale_target cst on cst.sale_target_id = cstd.sale_target_id
                WHERE cst.month_id = '$month'
                and cstd.unit_area_id = t.unit_area_id
                and cstd.unit_area_territory_id = t.territory_id
            ) as cm_recovery_commitment

            FROM tbl_territories t
            where t.status = 'a'
            and t.branch_id = ?
        ", $this->branch)->result();

        $res['territoryData'] = $territoryData;

        echo json_encode($res);
    }
}
