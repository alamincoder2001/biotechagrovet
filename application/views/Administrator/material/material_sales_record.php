<style>
    .form-group {
        margin-right: 15px;
    }

    .v-select{
		margin-top:-2.5px;
        float: right;
        min-width: 180px;
        margin-left: 5px;
	}
	.v-select .dropdown-toggle{
		padding: 0px;
        height: 30px;
        border-radius: 0;
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

    input[type="date"] {
        border-radius: 0 !important;
        height: 29px;
        margin-top: 2px;
    }
</style>
<div id="salesRecord">
    <div class="row" style="padding: 15px;border-bottom: 1px solid #ccc;">
        <div class="col-sm-12">
            <form class="form-inline" v-on:submit.prevent="getResult">
                <div class="form-group">
                    <label>Search Type</label><br>
                    <select class="form-conrol" v-model="searchType" @change="onChangeSearchType">
                        <option value="all">All</option>
                        <option value="byCustomer">By Customer</option>
                        <option value="byCategory">By Category</option>
                        <option value="byMaterial">By Material</option>
                    </select>
                </div>
                <div class="form-group" v-if="searchType == 'byCustomer'" style="display:none;" v-bind:style="{display: searchType == 'byCustomer' ? '' : 'none'}">
                    <label>Customer</label><br>
                    <v-select label="display_name" v-bind:options="customers" v-model="selectedCustomer" placeholder="Select Customer"></v-select>
                </div>
                <div class="form-group" v-if="searchType == 'byCategory'" style="display:none;" v-bind:style="{display: searchType == 'byCategory' ? '' : 'none'}">
                    <label>Category</label><br>
                    <v-select label="ProductCategory_Name" v-bind:options="categories" v-model="selectedCategory" placeholder="Select Category"></v-select>
                </div>
                <div class="form-group" v-if="searchType == 'byMaterial'" style="display:none;" v-bind:style="{display: searchType == 'byMaterial' ? '' : 'none'}">
                    <label>Material</label><br>
                    <v-select label="name" v-bind:options="materials" v-model="selectedMaterial" placeholder="Select Material"></v-select>
                </div>
                <div class="form-group">
                    <label>Date From</label><br>
                    <input type="date" class="form-control" v-model="dateFrom">
                </div>
                <div class="form-group">
                    <label>Date To</label><br>
                    <input type="date" class="form-control" v-model="dateTo">
                </div>
                <div class="form-group">
                    <label>&nbsp;</label><br>
                    <button type="submit" class="btn btn-info btn-xs">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row" style="padding: 15px;display:none;" v-bind:style="{display: sales.length > 0 ? '' : 'none'}">
        <div class="col-sm-12" style="margin-bottom: 10px;">
			<a href="" @click.prevent="print"><i class="fa fa-print"></i> Print</a>
		</div>
        <div class="col-sm-12">
            <div class="table-responsive" id="reportContent">
                <table class="table table-bordered" v-if="searchType == 'all' || searchType == 'byCustomer'" v-bind:style="{ display: searchType == 'all' || searchType == 'byCustomer' ? '' : 'none' }">
                    <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Date</th>
                            <th>Customer Id</th>
                            <th>Customer Name</th>
                            <th>Sub Total</th>
                            <th>VAT</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sale in sales">
                            <td>{{ sale.invoice_no }}</td>
                            <td>{{ sale.sales_date }}</td>
                            <td>{{ sale.customer_code }}</td>
                            <td>{{ sale.customer_name }}</td>
                            <td>{{ sale.sub_total }}</td>
                            <td>{{ sale.vat }}</td>
                            <td>{{ sale.discount }}</td>
                            <td>{{ sale.total }}</td>
                            <td>{{ sale.paid }}</td>
                            <td>{{ sale.due }}</td>
                            <td>{{ sale.note }}</td>
                            <td>
                                <?php if($this->session->userdata('accountType') != 'u'){?>
                                <a href="" v-bind:href="`material_sales_invoice/${sale.sales_id}`" target="_blank"><i class="fa fa-file-text fa-2x"></i></a>
                                <a href="" v-bind:href="`material_sales/${sale.sales_id}`"><i class="fa fa-pencil-square fa-2x"></i></a>
                                <a href="" v-on:click.prevent="deletesales(sale.sales_id, sale.invoice_no)"><i class="fa fa-trash fa-2x"></i></a>
                                <?php }?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7"></td>
                            <td>{{ totalsales }}</td>
                            <td>{{ totalPaid }}</td>
                            <td>{{ totalDue }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered" v-if="searchType == 'byCategory' || searchType == 'byMaterial'" v-bind:style="{ display: searchType == 'byCategory' || searchType == 'byMaterial' ? '' : 'none' }">
                    <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Date</th>
                            <th>Customer Id</th>
                            <th>Customer Name</th>
                            <th>Category Name</th>
                            <th>Material Name</th>
                            <th>Sales Rate</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sale in sales">
                            <td>{{ sale.invoice_no }}</td>
                            <td>{{ sale.sales_date }}</td>
                            <td>{{ sale.customer_code }}</td>
                            <td>{{ sale.customer_name }}</td>
                            <td>{{ sale.category_name }}</td>
                            <td>{{ sale.name }}</td>
                            <td>{{ sale.sales_rate }}</td>
                            <td>{{ sale.quantity }} {{ sale.unit_name }}</td>
                            <td>{{ sale.total }}</td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align:right">Total</td>
                            <td>{{ sales.reduce((p, c) => { return +p + +c.total }, 0) }}</td>
                        </tr>
                    </tbody>
                </table>
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
        el: '#salesRecord',
        data() {
            return {
                customers: [],
                selectedCustomer: null,
                materials: [],
                selectedMaterial: null,
                categories: [],
                selectedCategory: null,
                dateFrom: moment().format('YYYY-MM-DD'),
                dateTo: moment().format('YYYY-MM-DD'),
                sales: [],
                searchType: 'all',
                totalsales: 0.00,
                totalPaid: 0.00,
                totalDue: 0.00
            }
        },
        created() {
            this.getSales();
        },
        methods: {
            getCustomers() {
                axios.get('get_customers')
                    .then(res => {
                        this.customers = res.data;
                    })
            },
            getMaterials() {
                axios.get('/get_materials').then(res => {
                    this.materials = res.data;
                })
            },
            getCategories() {
                axios.get('/get_categories').then(res => {
                    this.categories = res.data;
                })
            },
            onChangeSearchType() {
                this.sales = [];

                if(this.searchType == 'byCustomer') {
                    this.getCustomers();
                }
                if(this.searchType == 'byCategory') {
                    this.getCategories();
                }
                if(this.searchType == 'byMaterial') {
                    this.getMaterials();
                }
            },
            getResult() {
                if(this.searchType != 'byCustomer') {
                    this.selectedCustomer = null;
                }
                if(this.searchType != 'byCategory') {
                    this.selectedCategory = null;
                }
                if(this.searchType != 'byMaterial') {
                    this.selectedMaterial = null;
                }

                if(this.searchType == 'all' || this.searchType == 'byCustomer') {
                    this.getSales();
                } else if(this.searchType == 'byCategory' || this.searchType == 'byMaterial') {
                    this.getSalesDetails();
                }
            },
            getSales(){
                let customer_id = null;
                if(this.selectedCustomer != null && this.searchType == 'byCustomer'){
                    customer_id = this.selectedCustomer.Customer_SlNo;
                }
                let options = {
                    customer_id: customer_id,
                    dateFrom: this.dateFrom,
                    dateTo: this.dateTo
                }
                axios.post('get_material_sales', options)
                    .then(res=>{
                        this.sales = res.data.sales;
                        this.totalsales = res.data.totalsales;
                        this.totalPaid = res.data.totalPaid;
                        this.totalDue = res.data.totalDue;
                    })
            },
            getSalesDetails() {
                let options = {
                    dateFrom: this.dateFrom,
                    dateTo: this.dateTo
                }
                if(this.selectedCategory != null && this.searchType == 'byCategory') {
                    options.categoryId = this.selectedCategory.ProductCategory_SlNo;
                }
                if(this.selectedMaterial != null && this.searchType == 'byMaterial') {
                    options.materialId = this.selectedMaterial.material_id;
                }

                axios.post('/get_material_sales_details', options)
                    .then(res => {
                        this.sales = res.data;
                    })
            },
            deletesales(sales_id, invoice_no){
                let conf = confirm('Are you sure?');
                if(conf == false){
                    return;
                }
                let options = {
                    sales_id,
                    invoice_no
                }
                axios.post('/delete_material_sales', options)
                    .then(res=>{
                        let r = res.data;
                        alert(r.message);
                        if(r.success){
                            this.getSales();
                        }
                    })
            },
            async print(){
				let dateText = '';
				if(this.dateFrom != '' && this.dateTo != ''){
					dateText = `Statement from <strong>${this.dateFrom}</strong> to <strong>${this.dateTo}</strong>`;
				}

				let reportContent = `
					<div class="container">
						<div class="row">
							<div class="col-xs-12 text-center">
								<h3>Material Sales Record</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
							</div>
							<div class="col-xs-6 text-right">
								${dateText}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								${document.querySelector('#reportContent').innerHTML}
							</div>
						</div>
					</div>
				`;

				var reportWindow = window.open('', 'PRINT', `height=${screen.height}, width=${screen.width}`);
				reportWindow.document.write(`
					<?php $this->load->view('Administrator/reports/reportHeader.php');?>
				`);

				reportWindow.document.head.innerHTML += `
					<style>
						.container{
							width: 100%;
						}
					</style>
				`;
				reportWindow.document.body.innerHTML += reportContent;

				if(this.searchType == 'all' || this.searchType == 'byCustomer'){
					let rows = reportWindow.document.querySelectorAll('.table tr');
					rows.forEach(row => {
						row.lastChild.remove();
					})
				}


				reportWindow.focus();
				await new Promise(resolve => setTimeout(resolve, 1000));
				reportWindow.print();
				reportWindow.close();
			}
        }
    })
</script>