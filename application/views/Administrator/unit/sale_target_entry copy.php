<style>
    .v-select {
        margin-bottom: 5px;
        display: inline-block;
        width: 200px;
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

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<div id="sales_target" class="row">
    <div class="col-md-12">
        <form class="form-inline" @submit.prevent="loadTable">
            <div class="form-group">
                <label>Select Unit : </label>
                <v-select v-bind:options="unites" v-model="selectedUnite" label="unite_name"></v-select>
            </div>

            <div class="form-group" style="margin-top: -5px;">
                <input type="submit" value="Load Table">
            </div>
        </form>
    </div>
    <div class="col-sm-12">
        <h2 class="h_title">BIOTECH AGRO-VET</h2>
        <h3 class="h_title">Sales and Recovery</h3>
        <h4 class="h_title">{{ selectedUnite.unite_name}}</h4>
    </div>
    <div class="col-sm-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td colspan="8">Last Month: February 2022</td>
                    <td colspan="3">Current Month Plan</td>
                </tr>
                <tr>
                    <td rowspan="2" style="vertical-align: middle;background: #b6f5ff;">Territory</td>
                    <td style="background: #fdd647;" colspan="4">Sales</td>
                    <td style="background: #fdd647;" colspan="3">Recovery</td>
                    <td style="background: #fdd647;" colspan="2">Sales</td>
                    <td style="background: #fdd647;">Recovery</td>
                </tr>
                <tr style="background: rgb(246 255 197);">
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
                            <td><input type="number" v-model="territory.last_month_sale_target" @input="calLastMonthSaleTarget(territory)" class="form-control" readonly></td>
                            <td><input type="number" v-model="territory.last_month_sale_forecast" @input="calLastMonthSaleTarget(territory)" class="form-control" readonly></td>
                            <td><input type="number" v-model="territory.last_month_sale_achieved" class="form-control" readonly></td>
                            <td><input type="number" v-model="territory.last_month_sale_ach_percent" class="form-control" readonly></td>
                            <td><input type="number" v-model="territory.last_month_recovery_planned" @input="calLastMonthSaleTarget(territory)" class="form-control" readonly></td>
                            <td><input type="number" v-model="territory.last_month_recovery_achieved" class="form-control" readonly></td>
                            <td><input type="number" v-model="territory.last_month_recovery_ach_percent" class="form-control" readonly></td>
                            <td><input type="number" v-model="territory.current_month_sale_target" @input="calLastMonthSaleTarget(territory)" class="form-control"></td>
                            <td><input type="number" v-model="territory.current_month_sale_forecast" @input="calLastMonthSaleTarget(territory)" class="form-control"></td>
                            <td><input type="number" v-model="territory.current_month_recovery_commitment" @input="calLastMonthSaleTarget(territory)" class="form-control"></td>
                        </tr>
                    </template>
                    <tr style="font-weight:bold;color:red;background: #e3e3e3;">
                        <td nowrap style="text-align: left">{{ item.unit_area_name}}</td>
                        <td><input style="color:red;" type="text" v-model="item.total_last_month_sale_target" class="form-control" readonly></td>
                        <td><input style="color:red;" type="text" v-model="item.total_last_month_sale_forecast" class="form-control" readonly></td>
                        <td><input style="color:red;" type="text" v-model="item.total_last_month_sale_achieved" class="form-control" readonly></td>
                        <td><input style="color:red;" type="text" v-model="item.total_last_month_sale_ach_percent" class="form-control" readonly></td>
                        <td><input style="color:red;" type="text" v-model="item.total_last_month_recovery_planned" class="form-control" readonly></td>
                        <td><input style="color:red;" type="text" v-model="item.total_last_month_recovery_achieved" class="form-control" readonly></td>
                        <td><input style="color:red;" type="text" v-model="item.total_last_month_recovery_ach_percent" class="form-control" readonly></td>
                        <td><input style="color:red;" type="text" v-model="item.total_current_month_sale_target" class="form-control" readonly></td>
                        <td><input style="color:red;" type="text" v-model="item.total_current_month_sale_forecast" class="form-control" readonly></td>
                        <td><input style="color:red;" type="text" v-model="item.total_current_month_recovery_commitment" class="form-control" readonly></td>
                    </tr>
                </template>
                <tr>
                    <td colspan="11"></td>
                </tr>
                <tr style="font-weight:bold;color:red;background: #d0eeff;">
                    <td nowrap style="text-align: left">{{ selectedUnite.unite_name}}</td>
                    <td style="text-align:right">{{ unit_total_last_month_sale_target }}</td>
                    <td style="text-align:right">{{ unit_total_last_month_sale_forecast }} </td>
                    <td style="text-align:right">{{ unit_total_last_month_sale_achieved }} </td>
                    <td style="text-align:right">{{ unit_total_last_month_sale_ach_percent }} </td>
                    <td style="text-align:right">{{ unit_total_last_month_recovery_planned }} </td>
                    <td style="text-align:right">{{ unit_total_last_month_recovery_achieved }} </td>
                    <td style="text-align:right">{{ unit_total_last_month_recovery_ach_percent }} </td>
                    <td style="text-align:right">{{ unit_total_current_month_sale_target }} </td>
                    <td style="text-align:right">{{ unit_total_current_month_sale_forecast }} </td>
                    <td style="text-align:right">{{ unit_total_current_month_recovery_commitment }} </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-12" style="text-align:right">
        <input type="submit" class="btn btn-info" value="Save Date" @click.prevent="saveData">
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
                unites: [],
                selectedUnite: {
                    unite_id: '',
                    unite_name: 'Select---'
                },
                unitAreas: [],
                territories: [],

                unit_total_last_month_sale_target: 0,
                unit_total_last_month_sale_forecast: 0,
                unit_total_last_month_sale_achieved: 0,
                unit_total_last_month_sale_ach_percent: 0,
                unit_total_last_month_recovery_planned: 0,
                unit_total_last_month_recovery_achieved: 0,
                unit_total_last_month_recovery_ach_percent: 0,
                unit_total_current_month_sale_target: 0,
                unit_total_current_month_sale_forecast: 0,
                unit_total_current_month_recovery_commitment: 0,
            }
        },
        created() {
            this.getUnites();
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
            getUnites() {
                axios.post('/get-unites', {
                    status: 'all'
                }).then(res => {
                    this.unites = res.data;
                })
            },

            async loadTable() {

                if (this.selectedUnite.unite_id == '') {
                    alert('Select a Unit');
                    return;
                }

                await axios.post("/get-unit-areas", {
                    unite_id: this.selectedUnite.unite_id
                }).then(res => {
                    unitAreasArr = res.data.filter((obj) => {
                        return obj.status == 'a'
                    })

                    let newUnitArr = [];
                    unitAreasArr.forEach(ele => {
                        let filter = {
                            name: ele.unit_area_name,
                            type: 'unit_area_name',
                            unit_id: ele.unite_id,
                            unit_name: ele.unite_name,
                            unit_area_id: ele.unit_area_id,
                            unit_area_name: ele.unit_area_name,
                            total_last_month_sale_target: '',
                            total_last_month_sale_forecast: '',
                            total_last_month_sale_achieved: '',
                            total_last_month_sale_ach_percent: '',
                            total_last_month_recovery_planned: '',
                            total_last_month_recovery_achieved: '',
                            total_last_month_recovery_ach_percent: '',
                            total_current_month_sale_target: '',
                            total_current_month_sale_forecast: '',
                            total_current_month_recovery_commitment: '',
                        }
                        newUnitArr.push(filter);
                    })
                    this.unitAreas = newUnitArr
                })

                // console.log(this.unitAreas);

                await axios.post("/get-territories", {
                    unite_id: this.selectedUnite.unite_id
                }).then(res => {
                    let dataArray = res.data.filter((obj) => {
                        return obj.status == 'a'
                    })

                    let newArr = [];
                    dataArray.forEach(item => {
                        let filter = {
                            name: item.territory_name,
                            type: 'territory',
                            unit_id: item.unite_id,
                            unit_name: item.unite_name,
                            unit_area_id: item.unit_area_id,
                            unit_area_name: item.unit_area_name,
                            territory_id: item.territory_id,
                            territory_name: item.territory_name,
                            last_month_sale_target: '',
                            last_month_sale_forecast: '',
                            last_month_sale_achieved: '',
                            last_month_sale_ach_percent: '',
                            last_month_recovery_planned: '',
                            last_month_recovery_achieved: '',
                            last_month_recovery_ach_percent: '',
                            current_month_sale_target: '',
                            current_month_sale_forecast: '',
                            current_month_recovery_commitment: '',
                        }
                        newArr.push(filter);
                    })

                    this.territories = newArr;
                })
            },

            calLastMonthSaleTarget(territory) {
                // console.log(territory);
                t_last_month_sale_target = this.territories.filter(({
                    unit_area_id
                }) => unit_area_id == territory.unit_area_id).reduce((prev, curr) => {
                    return +prev + +curr.last_month_sale_target
                }, 0)

                t_last_month_sale_forecast = this.territories.filter(({
                    unit_area_id
                }) => unit_area_id == territory.unit_area_id).reduce((prev, curr) => {
                    return +prev + +curr.last_month_sale_forecast
                }, 0)

                t_last_month_recovery_planned = this.territories.filter(({
                    unit_area_id
                }) => unit_area_id == territory.unit_area_id).reduce((prev, curr) => {
                    return +prev + +curr.last_month_recovery_planned
                }, 0)
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
                        ele.total_last_month_sale_target = t_last_month_sale_target;
                        ele.total_last_month_sale_forecast = t_last_month_sale_forecast;
                        ele.total_last_month_recovery_planned = t_last_month_recovery_planned;
                        ele.total_current_month_sale_target = t_current_month_sale_target;
                        ele.total_current_month_sale_forecast = t_current_month_sale_forecast;
                        ele.total_current_month_recovery_commitment = t_current_month_recovery_commitment;
                    }
                });

                this.unit_total_last_month_sale_target = this.unitAreas.reduce((prev, curr) => {
                    return +prev + +curr.total_last_month_sale_target
                }, 0);
                this.unit_total_last_month_sale_forecast = this.unitAreas.reduce((prev, curr) => {
                    return +prev + +curr.total_last_month_sale_forecast
                }, 0);
                this.unit_total_last_month_recovery_planned = this.unitAreas.reduce((prev, curr) => {
                    return +prev + +curr.total_last_month_recovery_planned
                }, 0);
                this.unit_total_current_month_sale_target = this.unitAreas.reduce((prev, curr) => {
                    return +prev + +curr.total_current_month_sale_target
                }, 0);
                this.unit_total_current_month_sale_forecast = this.unitAreas.reduce((prev, curr) => {
                    return +prev + +curr.total_current_month_sale_forecast
                }, 0);
                this.unit_total_current_month_recovery_commitment = this.unitAreas.reduce((prev, curr) => {
                    return +prev + +curr.total_current_month_recovery_commitment
                }, 0);

            },

            saveData() {
                let filter = {
                    unitAreas: this.unitAreas,
                    territories: this.territories,
                    unitId: this.selectedUnite.unite_id,
                    total_sale_target: this.unit_total_current_month_sale_target,
                    total_sale_forecast: this.unit_total_current_month_sale_forecast,
                    total_recovery_commitment: this.unit_total_current_month_recovery_commitment,
                }
                axios.post("/save_sale_target", filter).then(res => {
                    alert(res.message);
                    if (res.success) {
                        location.reload();
                    }
                })
            },

        }
    })
</script>