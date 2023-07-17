<style>
    .v-select {
        margin-bottom: 5px;
        display: inline-block;
        width: 160px;
    }

    .v-select .dropdown-toggle {
        padding: 0px;
        border-radius: 4px 0px 0px 4px;
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

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .saveBtn {
        background: #1d7581;
        color: white;
        border: none;
        padding: 4px 10px;
        border-radius: 2px;
    }
</style>

<div id="sales_target" class="row">
    <div class="col-md-12">
        <form class="form-inline" @submit.prevent="loadTable">
            <div class="form-group">
                <label>Select Month : </label>
                <v-select v-bind:options="months" v-model="selectedMonth" label="month_name"></v-select>
                <a href="<?= base_url('month') ?>" class="btn btn-xs btn-info" style="border: 0; width: 27px;margin-top: -4px;margin-left: -4px;height: 27px;" target="_blank" title="Add Month"><i class="fa fa-plus" aria-hidden="true" style="margin-top: 5px;"></i></a>
            </div>

            <div class="form-group" style="margin-top: -5px;margin-left:10px">
                <input type="submit" class="saveBtn" value="Load Table">
            </div>
        </form>
    </div>
    <div style="display:none" :style="{display:isShow ? '' : 'none'}">
        <div class="col-sm-12">
            <h2 class="h_title">BIOTECH AGRO-VET</h2>
            <h3 class="h_title">Sales and Recovery</h3>
            <h4 class="h_title"><?= $this->session->userdata('Brunch_name'); ?></h4>
        </div>
        <div class="col-sm-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td colspan="4">Current Month Plan</td>
                    </tr>
                    <tr style="background: rgb(246 255 197);">
                        <td style="vertical-align: middle;background: #b6f5ff;">Territory</td>
                        <td>Sales Target</td>
                        <td>Sales Forecast</td>
                        <td>Recovery Commitment</td>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(item,sl) in unitAreas">
                        <template v-for="(territory,index) in territories">
                            <tr v-if="territory.unit_area_id == item.unit_area_id">
                                <td nowrap style="text-align: left">{{ territory.territory_name}}</td>
                                <td>
                                    <input type="number" v-model="territory.current_month_sale_target" @input="calLastMonthSaleTarget(territory)" class="form-control">
                                </td>
                                <td>
                                    <input type="number" v-model="territory.current_month_sale_forecast" @input="calLastMonthSaleTarget(territory)" class="form-control">
                                </td>
                                <td>
                                    <input type="number" v-model="territory.current_month_recovery_commitment" @input="calLastMonthSaleTarget(territory)" class="form-control">
                                </td>
                            </tr>
                        </template>
                        <tr style="font-weight:bold;color:red;background: #e3e3e3;">
                            <td nowrap style="text-align: left">{{ item.unit_area_name}}</td>
                            <td>
                                <input style="color:red;" type="text" v-model="item.total_current_month_sale_target" class="form-control" readonly>
                            </td>
                            <td>
                                <input style="color:red;" type="text" v-model="item.total_current_month_sale_forecast" class="form-control" readonly>
                            </td>
                            <td>
                                <input style="color:red;" type="text" v-model="item.total_current_month_recovery_commitment" class="form-control" readonly>
                            </td>
                        </tr>
                    </template>
                    <tr>
                        <td colspan="11"></td>
                    </tr>
                    <tr style="font-weight:bold;color:red;background: #d0eeff;">
                        <td nowrap style="text-align: left;font-size:20px;"><?= $this->session->userdata('Brunch_name'); ?></td>
                        <td style="text-align:right;font-size:20px;">{{ inputField.total_sale_target }} </td>
                        <td style="text-align:right;font-size:20px;">{{ inputField.total_sale_forecast }} </td>
                        <td style="text-align:right;font-size:20px;">{{ inputField.total_recovery_commitment }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12" style="text-align:right">
            <input type="submit" class="btn btn-info" value="Save Date" @click.prevent="saveData">
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
                inputField: {
                    sale_target_id: '',
                    total_sale_target: 0,
                    total_sale_forecast: 0,
                    total_recovery_commitment: 0,
                },
                months: [],
                selectedMonth: {
                    month_id: '',
                    month_name: 'Select---'
                },
                BranchId: '<?php echo $this->session->userdata("BRANCHid") ?>',
                BranchName: '<?php echo $this->session->userdata("Brunch_name") ?>',
                isShow: false,
                unitAreas: [],
                territories: [],
            }
        },
        created() {
            this.getMonths();
        },
        computed: {
            fiterTerritory() {
                function groupBy(list, keyGetter) {
                    const map = new Map();
                    list.forEach((item) => {
                        const key = keyGetter(item);
                        const collection = map.get(key);
                        if (!collection) {
                            map.set(key, [item]);
                        } else {
                            collection.push(item);
                        }
                    });
                    return map;
                }
                const grouped = groupBy(this.territories, t => t.unit_area_id);
            }
        },
        methods: {
            // onChangeUnit() {
            //     this.isShow = false;
            //     this.unitAreas = [];
            //     this.territories = [];
            // },
            getMonths() {
                axios.post('/get_months').then(res => {
                    this.months = res.data;
                })
            },

            async loadTable() {

                if (this.selectedMonth.month_id == '') {
                    alert('Select a Month');
                    return;
                }

                let updateStatus = false;
                await axios.post("/check_sale_target", {
                    month_id: this.selectedMonth.month_id
                }).then(async res => {
                    if (res.data.success) {
                        // ..................... territories part start ....................
                        let newArr = [];
                        res.data.saleTargetDetails.forEach(item => {
                            let filter = {
                                name: item.territory_name,
                                type: 'territory',
                                unit_area_id: item.unit_area_id,
                                unit_area_name: item.unit_area_name,
                                territory_id: item.unit_area_territory_id,
                                territory_name: item.territory_name,
                                current_month_sale_target: item.cm_sale_target,
                                current_month_sale_forecast: item.cm_sale_forecast,
                                current_month_recovery_commitment: item.cm_recovery_commitment,
                            }
                            newArr.push(filter);
                        })
                        this.territories = newArr;

                        // ...................... unit area part start ......................

                        const unique = [...new Set(res.data.saleTargetDetails.map(item => item.unit_area_id))];

                        let newUArea = [];
                        for (let index = 0; index < unique.length; index++) {

                            t_cm_sale_target = res.data.saleTargetDetails.filter(({
                                unit_area_id
                            }) => unit_area_id == unique[index]).reduce((prev, curr) => {
                                return +prev + +curr.cm_sale_target
                            }, 0)

                            t_cm_sale_forecast = res.data.saleTargetDetails.filter(({
                                unit_area_id
                            }) => unit_area_id == unique[index]).reduce((prev, curr) => {
                                return +prev + +curr.cm_sale_forecast
                            }, 0)

                            t_cm_recovery_commitment = res.data.saleTargetDetails.filter(({
                                unit_area_id
                            }) => unit_area_id == unique[index]).reduce((prev, curr) => {
                                return +prev + +curr.cm_recovery_commitment
                            }, 0)

                            var objdata = res.data.saleTargetDetails.find(item => item.unit_area_id == unique[index])
                            let filter1 = {
                                name: objdata.unit_area_id,
                                type: 'unit_area_name',
                                unit_area_id: objdata.unit_area_id,
                                unit_area_name: objdata.unit_area_name,
                                total_current_month_sale_target: t_cm_sale_target,
                                total_current_month_sale_forecast: t_cm_sale_forecast,
                                total_current_month_recovery_commitment: t_cm_recovery_commitment,
                            }


                            newUArea.push(filter1)
                        }
                        this.unitAreas = newUArea;

                        // .................... update unit sum ......................
                        this.inputField.total_sale_target = res.data.saleTarget[0].total_sale_target
                        this.inputField.total_sale_forecast = res.data.saleTarget[0].total_sale_forecast
                        this.inputField.total_recovery_commitment = res.data.saleTarget[0].total_recovery_commitment
                        this.inputField.sale_target_id = res.data.saleTarget[0].sale_target_id

                        this.isShow = true;
                    } else {

                        await axios.post("/get-unit-areas").then(res => {
                            unitAreasArr = res.data.filter((obj) => {
                                return obj.status == 'a'
                            })

                            let newUnitArr = [];
                            unitAreasArr.forEach(ele => {
                                let filter = {
                                    name: ele.unit_area_name,
                                    type: 'unit_area_name',
                                    unit_area_id: ele.unit_area_id,
                                    unit_area_name: ele.unit_area_name,
                                    total_current_month_sale_target: '',
                                    total_current_month_sale_forecast: '',
                                    total_current_month_recovery_commitment: '',
                                }
                                newUnitArr.push(filter);
                            })
                            this.unitAreas = newUnitArr
                        })

                        // console.log(this.unitAreas);

                        await axios.post("/get-territories").then(res => {
                            let dataArray = res.data.filter((obj) => {
                                return obj.status == 'a'
                            })

                            let newArr = [];
                            dataArray.forEach(item => {
                                let filter = {
                                    name: item.territory_name,
                                    type: 'territory',
                                    unit_area_id: item.unit_area_id,
                                    unit_area_name: item.unit_area_name,
                                    territory_id: item.territory_id,
                                    territory_name: item.territory_name,
                                    current_month_sale_target: '',
                                    current_month_sale_forecast: '',
                                    current_month_recovery_commitment: '',
                                }
                                newArr.push(filter);
                            })

                            this.territories = newArr;
                        })

                        this.inputField.total_sale_target = 0;
                        this.inputField.total_sale_forecast = 0;
                        this.inputField.total_recovery_commitment = 0;
                        this.inputField.sale_target_id = '';

                        this.isShow = true;

                    }

                })
            },

            calLastMonthSaleTarget(territory) {
                // console.log(territory);
                // t_last_month_sale_target = this.territories.filter(({
                //     unit_area_id
                // }) => unit_area_id == territory.unit_area_id).reduce((prev, curr) => {
                //     return +prev + +curr.last_month_sale_target
                // }, 0)

                // t_last_month_sale_forecast = this.territories.filter(({
                //     unit_area_id
                // }) => unit_area_id == territory.unit_area_id).reduce((prev, curr) => {
                //     return +prev + +curr.last_month_sale_forecast
                // }, 0)

                // t_last_month_recovery_planned = this.territories.filter(({
                //     unit_area_id
                // }) => unit_area_id == territory.unit_area_id).reduce((prev, curr) => {
                //     return +prev + +curr.last_month_recovery_planned
                // }, 0)
                t_current_month_sale_target = this.territories.filter(({
                    unit_area_id
                }) => unit_area_id == territory.unit_area_id).reduce((prev, curr) => {
                    return +prev + +curr.current_month_sale_target
                }, 0)
                t_current_month_sale_forecast = this.territories.filter(({
                    unit_area_id
                }) => unit_area_id == territory.unit_area_id).reduce((prev, curr) => {
                    return +prev + +curr.current_month_sale_forecast
                }, 0)
                t_current_month_recovery_commitment = this.territories.filter(({
                    unit_area_id
                }) => unit_area_id == territory.unit_area_id).reduce((prev, curr) => {
                    return +prev + +curr.current_month_recovery_commitment
                }, 0)


                this.unitAreas.forEach(ele => {
                    if (ele.unit_area_id == territory.unit_area_id) {
                        // ele.total_last_month_sale_target = t_last_month_sale_target;
                        // ele.total_last_month_sale_forecast = t_last_month_sale_forecast;
                        // ele.total_last_month_recovery_planned = t_last_month_recovery_planned;
                        ele.total_current_month_sale_target = t_current_month_sale_target;
                        ele.total_current_month_sale_forecast = t_current_month_sale_forecast;
                        ele.total_current_month_recovery_commitment = t_current_month_recovery_commitment;
                    }
                });

                // this.unit_total_last_month_sale_target = this.unitAreas.reduce((prev, curr) => {
                //     return +prev + +curr.total_last_month_sale_target
                // }, 0);
                // this.unit_total_last_month_sale_forecast = this.unitAreas.reduce((prev, curr) => {
                //     return +prev + +curr.total_last_month_sale_forecast
                // }, 0);
                // this.unit_total_last_month_recovery_planned = this.unitAreas.reduce((prev, curr) => {
                //     return +prev + +curr.total_last_month_recovery_planned
                // }, 0);
                this.inputField.total_sale_target = this.unitAreas.reduce((prev, curr) => {
                    return +prev + +curr.total_current_month_sale_target
                }, 0);
                this.inputField.total_sale_forecast = this.unitAreas.reduce((prev, curr) => {
                    return +prev + +curr.total_current_month_sale_forecast
                }, 0);
                this.inputField.total_recovery_commitment = this.unitAreas.reduce((prev, curr) => {
                    return +prev + +curr.total_current_month_recovery_commitment
                }, 0);

            },

            saveData() {

                this.inputField.month_id = this.selectedMonth.month_id

                let filter = {
                    unitAreas: this.unitAreas,
                    territories: this.territories,
                    inpupData: this.inputField,
                }
                axios.post("/save_sale_target", filter).then(res => {
                    alert(res.data.message);
                    if (res.data.success) {
                        window.location.reload();
                    }
                })
            },

        }
    })
</script>