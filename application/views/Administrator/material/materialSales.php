<style>
    .v-select{
		margin-top:-2.5px;
        float: right;
        min-width: 180px;
        width: 100%;
        margin-left: 5px;
        margin-bottom: 5px;
	}
	.v-select .dropdown-toggle{
		padding: 0px;
        height: 25px;
	}
	.v-select input[type=search], .v-select input[type=search]:focus{
		margin: 0px;
	}
	.v-select .vs__selected-options{
		overflow: hidden;
		flex-wrap:nowrap;
	}
	.v-select .selected-tag{
		margin: 2px 0px;
		white-space: nowrap;
		position:absolute;
		left: 0px;
	}
	.v-select .vs__actions{
		margin-top:-5px;
	}
	.v-select .dropdown-menu{
		width: auto;
		overflow-y:auto;
	}
</style>
<div id="materialSales">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12" style="border-bottom:1px #ccc solid;margin-bottom:5px;">
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-1 control-label no-padding-right" for="age"> Invoice no </label>
                    <div class="col-sm-2">
                        <input type="text" id="purchInvoice" name="purchInvoice" class="form-control" readonly v-model="sales.invoice_no"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="SalesFor"> Sales For </label>
                    <div class="col-sm-3">
                        <select class="chosen-select form-control" name="SalesFor" id="SalesFor">
                            <option value="<?php echo $this->session->userdata('BRANCHid'); ?>">
                                <?php echo $this->session->userdata('Brunch_name'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-1 control-label no-padding-right" for="sales_date"> Date </label>
                    <div class="col-sm-3">
                        <input class="form-control" id="sales_date" name="sales_date" type="date"
                            class="form-control" v-model="sales.sales_date" />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-9 col-md-9 col-lg-9">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Customer & Raw Material Information</h4>
                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>

                        <a href="#" data-action="close">
                            <i class="ace-icon fa fa-times"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="CustomerID"> Customer
                                    </label>
                                    <div class="col-sm-7">
                                        <v-select label="display_name" v-bind:options="customers"
                                            v-model="selectedCustomer" placeholder="Select Customer" v-on:input="onChangeCustomer"></v-select>
                                    </div>
                                    <div class="col-sm-1" style="padding: 0;">
                                        <a href="customer" title="Add New Customer" class="btn btn-xs btn-danger"
                                            style="height: 25px; border: 0; width: 27px; margin-left: -10px;"
                                            target="_blank"><i class="fa fa-plus" aria-hidden="true"
                                                style="margin-top: 5px;"></i></a>
                                    </div>
                                </div>

                                <div class="form-group" style="display:none;" v-bind:style="{display: selectedCustomer.Customer_Type == 'G' ? '' : 'none'}">
                                    <label class="col-sm-4 control-label no-padding-right"> Name </label>
                                    <div class="col-sm-8">
                                        <input type="text" placeholder="Customer Name" class="form-control" v-model="selectedCustomer.Customer_Name" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right"> Mobile No </label>
                                    <div class="col-sm-8">
                                        <input type="text" placeholder="Mobile No" class="form-control" v-model="selectedCustomer.Customer_Mobile" v-bind:disabled="selectedCustomer.Customer_Type == 'G' ? false : true" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right"> Address </label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" v-model="selectedCustomer.Customer_Address" v-bind:disabled="selectedCustomer.Customer_Type == 'G' ? false : true"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="patient_id"> Raw Material
                                    </label>
                                    <div class="col-sm-7">
                                        <v-select label="display_text" v-bind:options="materials" v-on:input="setFocus();getMaterialStock()"
                                        v-model="selectedMaterial" placeholder="Select Material"></v-select>
                                    </div>
                                    <div class="col-sm-1" style="padding: 0;">
                                        <a href="materials" title="Add New Raw Material" class="btn btn-xs btn-danger"
                                            style="height: 25px; border: 0; width: 27px; margin-left: -10px;"
                                            target="_blank"><i class="fa fa-plus" aria-hidden="true"
                                                style="margin-top: 5px;"></i></a>
                                    </div>
                                </div>

                                <form id="MaterialsResult" v-on:submit.prevent="addToCart">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="materialStock">
                                            Material Stock
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" id="materialStock" 
                                                placeholder="Raw Material Name" class="form-control" readonly v-model="stock_quantity"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="MaterialRATE"> Sale
                                            Rate
                                        </label>
                                        <div class="col-sm-3">
                                            <input type="text" id="SalesRate" name="SalesRate"
                                                class="form-control" placeholder="Sale Rate" v-model="selectedMaterial.sales_rate"/>
                                        </div>

                                        <label class="col-sm-2 control-label no-padding-right" for="SalesQTY">
                                            Quantity
                                        </label>
                                        <div class="col-sm-3">
                                            <input type="text" id="SalesQTY" name="SalesQTY" ref="quantity" required
                                                class="form-control" placeholder="Quantity" v-model="selectedMaterial.quantity" v-on:input="materialTotal"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="totalAmount"> Total
                                            Amount </label>
                                        <div class="col-sm-8">
                                            <input type="text" id="totalAmount" name="totalAmount"
                                                class="form-control" readonly v-model="selectedMaterial.total"/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right"> </label>
                                        <div class="col-sm-8">
                                            <button type="submit" class="btn btn-default pull-right">Add Cart</button>
                                        </div>
                                    </div>
                                </form>
                                    
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xs-12 col-md-12 col-lg-12" style="padding-left: 0px;padding-right: 0px;">
                <div class="table-responsive">
                    <table class="table table-bordered" cellspacing="0" cellpadding="0"
                        style="color:#000;margin-bottom: 5px;">
                        <thead>
                            <tr>
                                <th style="width:4%;color:#000;">SL</th>
                                <th style="width:10%;color:#000;">Material Code</th>
                                <th style="width:20%;color:#000;">Material Name</th>
                                <th style="width:13%;color:#000;">Category</th>
                                <th style="width:8%;color:#000;">Pur. Rate</th>
                                <th style="width:5%;color:#000;">Qty</th>
                                <th style="width:13%;color:#000;">Total Amount</th>
                                <th style="width:10%;color:#000;">Act.</th>
                            </tr>
                        </thead>
                        <tbody style="display:none;" v-bind:style="{display: cart.length > 0 ? '' : 'none'}">
                            <tr v-for="(material, sl) in cart">
                                <td>{{ sl+1 }}</td>
                                <td>{{ material.code }}</td>
                                <td>{{ material.name }}</td>
                                <td>{{ material.category_name }}</td>
                                <td>{{ parseFloat(material.sales_rate).toFixed(2) }}</td>
                                <td>{{ material.quantity }}</td>
                                <td>{{ material.total }}</td>
                                <td><button class="btn btn-danger btn-xs" v-on:click="removeFromCart(material)"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            
                            <tr v-if="cart.length > 0">
                                <td colspan="8"></td>
                            </tr>
                            <tr v-if="cart.length > 0">
                                <td colspan="4">Notes</td>
                                <td colspan="4">Total</td>
                            </tr>
                            <tr v-if="cart.length > 0">
                                <td colspan="4"><textarea style="width: 100%;height:100%;" v-model="sales.note"></textarea></td>
                                <td colspan="4" style="font-size:18px;font-weight: bold;">Tk. {{ sales.sub_total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Amount Details</h4>
                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>

                        <a href="#" data-action="close">
                            <i class="ace-icon fa fa-times"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="" cellspacing="0" cellpadding="0"
                                        style="color:#000;margin-bottom: 0px;">
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label no-padding-right"
                                                        for="subTotalDisabled">Sub Total</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="subTotalDisabled"
                                                            name="subTotalDisabled" class="form-control"
                                                            readonly v-model="sales.sub_total"/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label no-padding-right"
                                                        for="subTotalDisabled"> Vat </label>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="vatPersent" name="vatPersent"
                                                            class="" style="width:50px;height:25px;" v-model="vatPercent" v-on:input="calculateTotal"/>
                                                        <span style="width:20px;"> % </span>
                                                        <input type="number" id="purchVat" readonly="" name="purchVat"
                                                            class="" style="width:140px;height:25px;" v-model="sales.vat"/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label no-padding-right"
                                                        for="subTotalDisabled">Transport / Labour Cost</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="purchFreight" name="purchFreight"
                                                            class="form-control" v-model="sales.transport_cost"  v-on:input="calculateTotal"/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label no-padding-right"
                                                        for="subTotalDisabled">Discount</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="purchDiscount" name="purchDiscount"
                                                            class="form-control" v-model="sales.discount"  v-on:input="calculateTotal"/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label no-padding-right"
                                                        for="subTotalDisabled">Total</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="purchTotaldisabled"
                                                            class="form-control" readonly v-model="sales.total" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label no-padding-right"
                                                        for="subTotalDisabled">Paid</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="PurchPaid"
                                                            class="form-control" v-model="sales.paid" v-on:input="calculateTotal" v-bind:disabled="selectedCustomer.Customer_Type == 'G' ? true : false"/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label no-padding-right"
                                                        for="previousDue">Previous Due</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="previousDue" name="previousDue" class="form-control" v-model="sales.previous_due" readonly style="color:red;" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="col-sm-12 control-label no-padding-right"
                                                        for="subTotalDisabled">Due</label>
                                                    <div class="col-sm-12">
                                                        <input type="number" id="salesDue2" name="salesDue2"
                                                            class="form-control" readonly v-model="sales.due"/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="col-sm-4">
                                                        <input type="button" class="btn btn-success" value="Sales"
                                                            style="background:#000;color:#fff;" v-on:click="saveSales" v-bind:disabled="salesInProgress ? true : false">
                                                    </div>
                                                    <div class="col-sm-4 col-sm-offset-1">
                                                        <a class="btn btn-info" href="<?php echo base_url();?>material_sales"
                                                            style="background:#000;color:#fff;">New Sales</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/vue/vue.min.js"></script>
<script src="<?php echo base_url();?>assets/js/vue/axios.min.js"></script>
<script src="<?php echo base_url();?>assets/js/vue/vuejs-datatable.js"></script>
<script src="<?php echo base_url();?>assets/js/vue/vue-select.min.js"></script>
<script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
<script>
    Vue.component('v-select', VueSelect.VueSelect);
    new Vue({
        el: '#materialSales',
        data() {
            return {
                sales: {
                    sales_id: parseInt("<?php echo $sales_id;?>"),
                    customer_id: '',
                    invoice_no: '<?php echo $invoiceNumber;?>',
                    sales_date: '',
                    sales_for: parseInt("<?php echo $this->session->userdata('BRANCHid'); ?>"),
                    sub_total: 0.00,
                    vat: 0.00,
                    transport_cost: 0.00,
                    discount: 0.00,
                    total: 0.00,
                    paid: 0.00,
                    due: 0.00,
                    previous_due: 0.00,
                    note: ''
                },
                oldCustomerId: null,
                oldPreviousDue: 0,
                vatPercent: 0,
                cart: [],
                customers: [],
                materials: [],
                selectedCustomer: {
                    display_name: 'Selected Customer',
                    Customer_SlNo: null,
                    Customer_Name: 'Select Customer',
                    Customer_Mobile: '',
                    Customer_Address: '',
                    Customer_Type: ''
                },
                selectedMaterial: {
                    material_id: '',
                    display_text: 'Raw Material',
                    name: '',
                    sales_rate: 0.00
                },
                stock_quantity: 0,
                salesInProgress: false
            }
        },
        created() {
            this.sales.sales_date = moment().format('YYYY-MM-DD');
            this.getCustomers();
            this.getMaterials();

            if(this.sales.sales_id != 0){
                this.getSales();
            }
        },
        methods: {
            getCustomers() {
                axios.get('/get_customers')
                    .then(res => {
                        this.customers = res.data;
                        this.customers.unshift({
                            Customer_SlNo: 'S01',
                            Customer_Code: '',
                            Customer_Name: '',
                            display_name: 'General Customer',
                            Customer_Mobile: '',
                            Customer_Address: '',
                            Customer_Type: 'G'
                        })
                    })
            },
            onChangeCustomer(){
				if(this.selectedCustomer.Customer_SlNo == null){
					return;
				}

				if(event.type == 'readystatechange'){
					return;
				}

                if(this.sales.sales_id != 0 && this.oldCustomerId != parseInt(this.selectedCustomer.Customer_SlNo)){
					let changeConfirm = confirm('Changing Customer will set previous due to current due amount. Do you really want to change Customer?');
					if(changeConfirm == false){
						return;
					}
				} else if(this.sales.sales_id != 0 && this.oldCustomerId == parseInt(this.selectedCustomer.Customer_SlNo)){
					this.sales.previous_due = this.oldPreviousDue;
					return;
				}

				axios.post('/get_customer_due', {customerId: this.selectedCustomer.Customer_SlNo}).then(res => {
					if(res.data.length > 0){
						this.sales.previous_due = parseFloat(res.data[0].dueAmount).toFixed(2);
					} else {
						this.sales.previous_due = 0;
					}
				})
            },
            getMaterials() {
                axios.get('/get_materials')
                    .then(res => {
                        this.materials = res.data.filter(m => m.status == 1);
                    })
            },
            getMaterialStock(){
                this.alert_message = '';
                if(this.selectedMaterial.material_id == ''){
                    return;
                }
                axios.post('/get_material_stock', {material_id: this.selectedMaterial.material_id})
                    .then(res=>{
                        this.stock_quantity = res.data[0].stock_quantity;
                    })
            },
            setFocus() {
                this.$refs.quantity.focus();
            },
            materialTotal(){
                this.selectedMaterial.total = (this.selectedMaterial.sales_rate * this.selectedMaterial.quantity).toFixed(2);
                this.calculateTotal();
            },
            addToCart(){
                let ind = this.cart.findIndex(m => m.material_id == this.selectedMaterial.material_id);
                if(ind > -1) {
                    if((parseFloat(this.cart[ind].quantity) + parseFloat(this.selectedMaterial.quantity)) > parseFloat(this.stock_quantity)){
                        alert('Stock unavailable');
                        return;
                    }
                    this.clearMaterial();
                    return;
                }
                if(parseFloat(this.selectedMaterial.quantity) > parseFloat(this.stock_quantity)) {
                    alert('Stock unavailable');
                    return;
                }

                this.cart.push(this.selectedMaterial);
                this.clearMaterial();
                this.calculateTotal();
            },
            removeFromCart(material){
                let ind = this.cart.findIndex(m => m.material_id == material.material_id);
                if(ind > -1){
                    this.cart.splice(ind, 1);
                    this.calculateTotal();
                }
            },
            calculateTotal(){
                this.sales.sub_total = 0;
                this.cart.forEach(m => {
                    this.sales.sub_total += parseFloat(m.total);
                })

                this.sales.sub_total = parseFloat(this.sales.sub_total).toFixed(2);

                this.sales.vat = (this.sales.sub_total * this.vatPercent / 100).toFixed(2);
                this.sales.total = ((this.sales.sub_total + parseFloat(this.sales.vat) + parseFloat(this.sales.transport_cost)) - parseFloat(this.sales.discount)).toFixed(2);
                if (this.selectedCustomer.Customer_Type == 'G') {
                    this.sales.paid = this.sales.total;
                    this.sales.due = 0;
                } else {
                    this.sales.due = (this.sales.total - this.sales.paid).toFixed(2);
                }
            },
            clearMaterial(){
                this.selectedMaterial = {
                    material_id: '',
                    name: '',
                    display_text: 'Raw Material',
                    sales_rate: 0.00
                }
                this.stock_quantity = 0;
            },
            saveSales(){
                this.sales.customer_id = this.selectedCustomer.Customer_SlNo;
                if(this.sales.customer_id == 0 || this.sales.customer_id == null){
                    alert('Select customer');
                    return;
                }

                if(this.cart.length == 0){
                    alert('Cart is empty');
                    return;
                }

                let url = '/add_material_sales';
                if(this.sales.sales_id != 0){
                    url = '/update_material_sales';
                }

                let data = {
                    sales: this.sales,
                    salesMaterials: this.cart
                }

                if(this.selectedCustomer.Customer_Type == 'G'){
					data.customer = this.selectedCustomer;
				}

                this.salesInProgress = true;
                axios.post(url, data)
                    .then(async res => {
                        let r = res.data;
                        alert(r.message);
                        if(r.success){
                            let invoiceConf = confirm('Do you want to view invoice?');
                            if(invoiceConf){
                                window.open(`/material_sales_invoice/${r.salesId}`, '_blank');
                                await new Promise(resolve => setTimeout(resolve, 1000));
                            }
                            window.location = '<?php echo base_url();?>material_sales';
                        }
                    })
            },
            async getSales(){
                let options = {
                    sales_id: this.sales.sales_id
                }
                await axios.post('/get_material_sales', options)
                    .then(res=>{
                        this.sales = res.data.sales[0];
                        this.oldCustomerId = res.data.sales[0].customer_id;
                        this.oldPreviousDue = res.data.sales[0].previous_due;
                        this.selectedCustomer = {
                            display_name: this.sales.customer_type == 'G' ? 'General Customer' : `${this.sales.customer_code} - ${this.sales.customer_name}`,
                            Customer_SlNo: this.sales.customer_id,
                            Customer_Name: this.sales.customer_name,
                            Customer_Mobile: this.sales.customer_mobile,
                            Customer_Address: this.sales.customer_address,
                            Customer_Type: this.sales.customer_type
                        }
                    });

                await axios.post('/get_material_sales_details', {sales_id: this.sales.sales_id})
                    .then(res=>{
                        this.cart = res.data;
                    })
                
            }
        }
    })
</script>