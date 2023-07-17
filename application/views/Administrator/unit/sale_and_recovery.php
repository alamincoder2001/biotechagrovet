<style>
    .v-select {
        margin-bottom: 5px;
        display: inline-block;
        width: 160px;
    }

    .v-select .dropdown-toggle {
        padding: 0px;
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

    #branchDropdown .vs__actions button {
        display: none;
    }

    #branchDropdown .vs__actions .open-indicator {
        height: 15px;
        margin-top: 7px;
    }

    .h_title {
        text-align: center;
        margin: 1px 0 0 0;
        font-weight: bold
    }

    thead tr td {
        font-weight: bold;
    }

    input[type="text"],
    input[type='number'] {
        margin: 0px;
        border: none;
        text-align: right;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .sale_recovery {
        vertical-align: middle !important;
        background: #b6f5ff !important;
    }

    .sale_recovery td {
        background: #fdd647 !important;
    }

    .head_title_2 td {
        background: rgb(246 255 197) !important;
    }

    .areaStyle td {
        font-weight: bold;
        color: red;
        background: #e3e3e3;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<div id="sales_target" class="row">
    <div class="col-md-12">
        <form class="form-inline" @submit.prevent="searchRecords">
            <!-- <div class="form-group">
                <label>Select Unit : </label>
                <v-select v-bind:options="unites" v-model="selectedUnite" label="unite_name" @input="getMonths"></v-select>
            </div> -->
            <div class="form-group">
                <label style="padding-left: 10px">Select Month : </label>
                <v-select v-bind:options="months" v-model="selectedMonth" label="month_name" @input="onChangeMonth"></v-select>
            </div>

            <div class="form-group" style="margin-top: -5px;">
                <input type="submit" value="Search Record">
            </div>
        </form>
    </div>

    <div style="display:none" :style="{display:unitAreas.length > 0 ? '' : 'none'}">
        <div class="col-md-12" style="margin-bottom: 10px;">
            <a href="" @click.prevent="print"><i class="fa fa-print"></i> Print</a>
        </div>
        <div class="col-sm-12" id="reportContent">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td colspan="8">Last Month: {{ lastMonth }}</td>
                        <td colspan="3">Current Month Plan</td>
                    </tr>
                    <tr class="sale_recovery">
                        <td rowspan="2">Territory</td>
                        <td colspan="4">Sales</td>
                        <td colspan="3">Recovery</td>
                        <td colspan="2">Sales</td>
                        <td>Recovery</td>
                    </tr>
                    <tr class="head_title_2">
                        <td>Target</td>
                        <td>Forecast</td>
                        <td>Achieved</td>
                        <td>Ach %</td>
                        <td>Plan</td>
                        <td>Achieved</td>
                        <td>Ach %</td>
                        <td>Target</td>
                        <td>Forecast</td>
                        <td>Commitment</td>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(item,sl) in unitAreas">
                        <template v-for="(territory,index) in territories">
                            <tr v-if="territory.unit_area_id == item.unit_area_id">
                                <td nowrap style="text-align: left">{{ territory.territory_name}}</td>
                                <td style="text-align:right">{{ territory.last_month_sale_target }}</td>
                                <td style="text-align:right">{{ territory.last_month_sale_forecast }}</td>
                                <td style="text-align:right">{{ territory.last_month_sale_achieved }}</td>
                                <td style="text-align:right">{{ parseFloat(territory.last_month_sale_ach_percent).toFixed(2) }} %</td>
                                <td style="text-align:right">{{ territory.last_month_recovery_planned }}</td>
                                <td style="text-align:right">{{ territory.last_month_recovery_achieved }}</td>
                                <td style="text-align:right">{{ parseFloat(territory.last_month_recovery_ach_percent).toFixed(2) }} %</td>
                                <td style="text-align:right">{{ territory.cm_sale_target }}</td>
                                <td style="text-align:right">{{ territory.cm_sale_forecast }}</td>
                                <td style="text-align:right">{{ territory.cm_recovery_commitment }}</td>
                            </tr>
                        </template>
                        <tr class="areaStyle">
                            <td nowrap style="text-align: left">{{ item.unit_area_name}}</td>
                            <td style="text-align:right">{{ item.prev_area_sale_target }}</td>
                            <td style="text-align:right">{{ item.prev_area_sale_forecast }}</td>
                            <td style="text-align:right">{{ item.prev_area_sale_achieved }}</td>
                            <td style="text-align:right">{{ parseFloat(item.prev_area_sale_ach_percent).toFixed(2) }} %</td>
                            <td style="text-align:right">{{ item.prev_area_recovery_commitment }}</td>
                            <td style="text-align:right">{{ item.prev_area_recovery_achieved }}</td>
                            <td style="text-align:right">{{ parseFloat(item.prev_area_recovery_ach_percent).toFixed(2) }} %</td>
                            <td style="text-align:right">{{ item.cm_area_sale_target }}</td>
                            <td style="text-align:right">{{ item.cm_area_sale_forecast }}</td>
                            <td style="text-align:right">{{ item.cm_area_recovery_commitment }}</td>
                        </tr>
                    </template>
                    <tr>
                        <td colspan="11"></td>
                    </tr>
                    <tr style="font-weight:bold;color:red;background: #d0eeff;">
                        <td nowrap style="text-align: left">{{ unitName}}</td>
                        <td style="text-align:right">{{ unitData.prev_total_sale_target }}</td>
                        <td style="text-align:right">{{ unitData.prev_total_sale_forecast }} </td>
                        <td style="text-align:right">{{ unitData.prev_total_sale_achieved }} </td>
                        <td style="text-align:right">{{ parseFloat(unitData.prev_total_sale_ach_percent).toFixed(2) }} %</td>
                        <td style="text-align:right">{{ unitData.prev_total_recovery_planned }} </td>
                        <td style="text-align:right">{{ unitData.prev_total_recovery_achieved }} </td>
                        <td style="text-align:right">{{ parseFloat(unitData.prev_total_recovery_ach_percent).toFixed(2) }} %</td>
                        <td style="text-align:right">{{ unitData.total_sale_target }} </td>
                        <td style="text-align:right">{{ unitData.total_sale_forecast }} </td>
                        <td style="text-align:right">{{ unitData.total_recovery_commitment }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/vue/vue.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/axios.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/vue-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>

<script>
    Vue.component('v-select', VueSelect.VueSelect);
    new Vue({
        el: '#sales_target',
        data() {
            return {
                // unites: [],
                // selectedUnite: {
                //     unite_id: '',
                //     unite_name: 'Select---'
                // },
                months: [],
                selectedMonth: {
                    month_id: '',
                    month_name: 'Select---'
                },
                unitData: [],
                unitAreas: [],
                territories: [],
                unitName: '<?php echo $this->session->userdata('Brunch_name') ?>'

            }
        },
        created() {
            this.getMonths();
        },
        computed: {
            lastMonth() {
                if (this.selectedMonth.month_id == '') {
                    return
                }
                if (this.selectedMonth.month_id != 1) {
                    let month = this.months.filter((obj) => {
                        return obj.month_id == (this.selectedMonth.month_id - 1)
                    })
                    return month[0].month_name;
                }

            }
            // fiterTerritory() {
            //     function groupBy(list, keyGetter) {
            //         const map = new Map();
            //         list.forEach((item) => {
            //             const key = keyGetter(item);
            //             const collection = map.get(key);
            //             if (!collection) {
            //                 map.set(key, [item]);
            //             } else {
            //                 collection.push(item);
            //             }
            //         });
            //         return map;
            //     }
            //     const grouped = groupBy(this.territories, t => t.unit_area_id);
            // }
        },
        methods: {
            // getUnites() {
            //     axios.post('/get-unites', {
            //         status: 'all'
            //     }).then(res => {
            //         this.unites = res.data;
            //     })
            // },
            getMonths() {
                axios.post('/get_months').then(res => {
                    this.months = res.data;
                })
            },

            onChangeMonth() {
                this.unitData = [];
                this.unitAreas = [];
                this.territories = [];
            },
            async searchRecords() {

                if (this.selectedMonth.month_id == '') {
                    alert('Select a month');
                    return
                }


                axios.post("/get_sale_target_report", this.selectedMonth).then(res => {
                    // console.log(res);

                    this.territories = res.data.territoryData;
                    this.unitAreas = res.data.unitAreaData;
                    this.unitData = res.data.unitData;
                })
            },

            async print() {

                let reportContent = `
					<div class="container">
						<div class="row">
                            <div class="col-sm-12">
                                <h2 class="h_title">BIOTECH AGRO-VET</h2>
                                <h3 class="h_title">Sales and Recovery</h3>
                                <h4 class="h_title">${ this.unitName}</h4>
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
					<?php $this->load->view('Administrator/reports/reportHeader.php'); ?>
				`);

                reportWindow.document.head.innerHTML += `
					<style>
                        .areaStyle td {
                            font-weight: bold !important;
                            color: red !important;
                            background: #e3e3e3 !important;
                        }
                        .head_title_2 td {
                            background: rgb(246 255 197) !important;
                        }			
                        .sale_recovery {
                            vertical-align: middle !important;
                            background: #b6f5ff !important;
                        }

                        .sale_recovery td {
                            background: #fdd647 !important;
                        }	
                        .h_title {
                            text-align: center;
                            margin: 1px 0 0 0;
                            font-weight: bold
                        }

                        thead tr td {
                            font-weight: bold;
                        }

                        input[type="text"],
                        input[type='number'] {
                            margin: 0px;
                            border: none;
                            text-align: right;
                        }

                        /* Chrome, Safari, Edge, Opera */
                        input::-webkit-outer-spin-button,
                        input::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }

                        /* Firefox */
                        input[type=number] {
                            -moz-appearance: textfield;
                        }
					</style>
				`;
                reportWindow.document.body.innerHTML += reportContent;

                if (this.searchType == '' || this.searchType == 'user') {
                    let rows = reportWindow.document.querySelectorAll('.record-table tr');
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