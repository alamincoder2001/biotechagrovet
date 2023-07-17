<style>
    .v-select {
        margin-bottom: 5px;
    }

    .v-select.open .dropdown-toggle {
        border-bottom: 1px solid #ccc;
    }

    .v-select .dropdown-toggle {
        padding: 0px;
        height: 30px;
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

    .saveBtn {
        padding: 7px 22px;
        background-color: #00acb5 !important;
        border-radius: 2px !important;
        border: none;
    }

    .saveBtn:hover {
        padding: 7px 22px;
        background-color: #06777c !important;
        border-radius: 2px !important;
        border: none;
    }

    select.form-control {
        padding: 1px;
    }
</style>
<div id="vehicle">
    <div class="row" style="margin-top: 10px;margin-bottom:15px;border-bottom: 1px solid #ccc;padding-bottom: 15px;">
        <form class="form-horizontal" v-on:submit.prevent="saveDate">
            <div class="col-md-5 col-md-offset-3">
                <div class="form-group">
                    <label class="control-label col-md-3">Area Name</label>
                    <label class="col-md-1" style="text-align: right;">:</label>
                    <div class="col-md-8">
                        <input style="height: 30px;" placeholder="Area name" type="text" class="form-control" v-model="inputField.unit_area_name">
                    </div>
                </div>
                <div class="form-group" style="display: none;" :style="{display: inputField.unit_area_id != '' ? '' : 'none'}">
                    <label class="control-label col-md-3">status</label>
                    <label class="col-md-1" style="text-align: right;">:</label>
                    <div class="col-md-8">
                        <select class="form-control" v-model="inputField.status">
                            <option value="" selected>Select---</option>
                            <option value="a">Active</option>
                            <option value="d">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group clearfix">
                    <div class="col-md-12" style="text-align: right;">
                        <input type="submit" class="btn saveBtn" :disabled="saveProcess" value="Add">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-sm-12 form-inline">
            <div class="form-group">
                <label for="filter" class="sr-only">Filter</label>
                <input type="text" class="form-control" v-model="filter" placeholder="Filter">
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <datatable :columns="columns" :data="unitAreas" :filter-by="filter">
                    <template scope="{ row }">
                        <tr :style="{color: row.status == 'd' ? 'red' :''}">
                            <td>{{ row.unit_area_id }}</td>
                            <td>{{ row.unit_area_name }}</td>
                            <td>{{ row.status == 'a' ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <?php if ($this->session->userdata('accountType') != 'u') {
                                ?>
                                    <a href="" v-on:click.prevent=" editItem(row)"><i class="fa fa-pencil"></i></a>&nbsp;
                                    <a href="" class="button" v-on:click.prevent="deleteItem(row.unit_area_id )"><i class="fa fa-trash"></i></a>
                                <?php  }
                                ?>
                            </td>
                            <td v-else></td>
                        </tr>
                    </template>
                </datatable>
                <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
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
        el: '#vehicle',
        data() {
            return {
                inputField: {
                    unit_area_id: '',
                    unit_area_name: '',
                },
                saveProcess: false,
                unitAreas: [],

                columns: [{
                        label: 'SL',
                        field: 'unit_area_id',
                        align: 'center'
                    },
                    {
                        label: 'Area Name',
                        field: 'unit_area_name',
                        align: 'center'
                    },
                    {
                        label: 'Status',
                        field: 'status',
                        align: 'center'
                    },
                    {
                        label: 'Action',
                        align: 'center',
                        filterable: false
                    }
                ],
                page: 1,
                per_page: 10,
                filter: ''
            }
        },
        created() {
            this.getUnitAreas();
        },
        methods: {
            getUnitAreas() {
                axios.post('/get-unit-areas', {
                    status: 'all'
                }).then(res => {
                    this.unitAreas = res.data;
                })
            },
            saveDate() {
                if (this.inputField.unit_area_name == '') {
                    alert('Unit Area field is empty!');
                    return;
                }

                let url = '/save-unit-area';

                this.saveProcess = true;

                axios.post(url, this.inputField).then(res => {
                    let r = res.data;
                    alert(r.message);
                    if (r.success) {
                        this.saveProcess = false;
                        this.getUnitAreas();
                        this.clearForm();
                    } else {
                        this.saveProcess = false;
                    }
                })
            },
            editItem(data) {
                this.inputField.unit_area_id = data.unit_area_id;
                this.inputField.unit_area_name = data.unit_area_name;
                this.inputField.status = data.status;
            },
            deleteItem(id) {
                let deleteConfirm = confirm('Are Your Sure to delete the item?');
                if (deleteConfirm == false) {
                    return;
                }
                axios.post('/delete-unit-area', {
                    unit_area_id: id
                }).then(res => {
                    let r = res.data;
                    alert(r.message);
                    if (r.success) {
                        this.getUnitAreas();
                    }
                })
            },
            clearForm() {
                this.inputField.unit_area_id = '';
                this.inputField.unit_area_name = '';

                delete this.inputField.status;
            }

        }
    })
</script>