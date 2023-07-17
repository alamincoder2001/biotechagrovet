<style>
    .v-select {
        margin-bottom: 5px;
    }

    .v-select.open .dropdown-toggle {
        border-bottom: 1px solid #ccc;
    }

    .v-select .dropdown-toggle {
        padding: 0px;
        height: 25px;
    }

    .v-select input[type=search],
    .v-select input[type=search]:focus {
        margin: 0px;
    }

    .v-select .vs__selected-options {
        overflow: hidden;
        flex-wrap: nowrap;
    }

    .v-select .selected-tag {
        margin: 2px 0px;
        white-space: nowrap;
        position: absolute;
        left: 0px;
    }

    .v-select .vs__actions {
        margin-top: -5px;
    }

    .v-select .dropdown-menu {
        width: auto;
        overflow-y: auto;
    }

    #customers label {
        font-size: 13px;
    }

    #customers select {
        border-radius: 3px;
    }

    #customers .add-button {
        padding: 2.5px;
        width: 28px;
        background-color: #298db4;
        display: block;
        text-align: center;
        color: white;
    }

    #customers .add-button:hover {
        background-color: #41add6;
        color: white;
    }

    #customers input[type="file"] {
        display: none;
    }

    #customers .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 5px 12px;
        cursor: pointer;
        margin-top: 5px;
        background-color: #298db4;
        border: none;
        color: white;
    }

    #customers .custom-file-upload:hover {
        background-color: #41add6;
    }

    #customerImage {
        height: 100%;
    }
</style>
<div id="customerListReport">

    <div class="row">
        <div class="col-md-12">
            <form class="form-inline" v-on:submit.prevent="getCustomers">
                <div class="form-group" style="display: inline-flex;">
                    <label>Select Area:</label>
                    <v-select style="width: 160px;margin:0 10px" v-bind:options="unitAreas" v-model="selectedUnitArea" label="unit_area_name" @input="getTerritory"></v-select>
                </div>
                <div class="form-group" style="display: inline-flex;">
                    <label>Select Territory:</label>
                    <v-select style="width: 160px;margin-left:10px" v-bind:options="territories" label="territory_name" v-model="selectedTerritory"></v-select>
                </div>
                <div class="form-group" style="margin-top: -5px;">
                    <input type="submit" value="Search">
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a href="" @click.prevent="printCustomerList"><i class="fa fa-print"></i> Print</a>
        </div>
    </div>

    <div class="row" style="margin-top:15px;display:none;" v-bind:style="{display: customers.length > 0 ? '' : 'none'}">
        <div class="col-md-12">
            <div class="table-responsive" id="printContent">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <th>Sl</th>
                        <th>Customer Id</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Contact No.</th>
                        <th>Unit Area Name</th>
                        <th>Territory Name</th>
                    </thead>
                    <tbody>
                        <tr v-for="(customer, sl) in customers">
                            <td>{{ sl + 1 }}</td>
                            <td>{{ customer.Customer_Code }}</td>
                            <td>{{ customer.Customer_Name }}</td>
                            <td>{{ customer.Customer_Address }} {{ customer.District_Name }}</td>
                            <td>{{ customer.Customer_Mobile }}</td>
                            <td>{{ customer.unit_area_name }}</td>
                            <td>{{ customer.territory_name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row" style="display:none;text-align:center;" v-bind:style="{display: customers.length > 0 ? 'none' : ''}">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <th>Sl</th>
                        <th>Customer Id</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Contact No.</th>
                        <th>Unit Area Name</th>
                        <th>Territory Name</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" style="color:red;padding:20px;font-weight:600">No Record Founded</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo base_url(); ?>assets/js/vue/vue.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/axios.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/vuejs-datatable.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/vue-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>

<script>
    Vue.component('v-select', VueSelect.VueSelect);
    new Vue({
        el: '#customerListReport',
        data() {
            return {
                customers: [],
                unitAreas: [],
                selectedUnitArea: {
                    unit_area_id: '',
                    unit_area_name: 'Select---'
                },
                territories: [],
                selectedTerritory: {
                    territory_id: '',
                    territory_name: 'Select---'
                },
            }
        },
        created() {
            this.getCustomers();
            this.getUnitAreas();
        },
        methods: {
            getUnitAreas() {
                axios.post('/get-unit-areas').then(res => {
                    this.unitAreas = res.data;
                })
            },
            getTerritory() {
                if (this.selectedUnitArea.unit_area_id != '') {
                    axios.post('/get-territories', {
                        unitAreaId: this.selectedUnitArea.unit_area_id
                    }).then(res => {
                        this.territories = res.data;
                    })

                }
            },
            getCustomers() {
                let filter = {
                    unitAreaId: this.selectedUnitArea.unit_area_id,
                    territory_id: this.selectedTerritory.territory_id
                }
                axios.post('/get_customers', filter).then(res => {
                    this.customers = res.data;
                })
            },

            async printCustomerList() {
                let printContent = `
                    <div class="container">
                        <h4 style="text-align:center">Customer List</h4 style="text-align:center">
						<div class="row">
							<div class="col-xs-12">
								${document.querySelector('#printContent').innerHTML}
							</div>
						</div>
                    </div>
                `;

                let printWindow = window.open('', '', `width=${screen.width}, height=${screen.height}`);
                printWindow.document.write(`
                    <?php $this->load->view('Administrator/reports/reportHeader.php'); ?>
                `);

                printWindow.document.body.innerHTML += printContent;
                printWindow.focus();
                await new Promise(r => setTimeout(r, 1000));
                printWindow.print();
                printWindow.close();
            }
        }
    })
</script>