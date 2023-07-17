<style>
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
                    <label class="control-label col-md-3">Unite Name</label>
                    <label class="col-md-1" style="text-align: right;">:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" v-model="inputField.unite_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Description</label>
                    <label class="col-md-1" style="text-align: right;">:</label>
                    <div class="col-md-8">
                        <textarea type="text" class="form-control" v-model="inputField.description" cols="30" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group" style="display: none;" :style="{display: inputField.unite_id != '' ? '' : 'none'}">
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
                <datatable :columns="columns" :data="allUnites" :filter-by="filter">
                    <template scope="{ row }">
                        <tr :style="{color: row.status == 'd' ? 'red' :''}">
                            <td>{{ row.unite_id }}</td>
                            <td>{{ row.unite_name }}</td>
                            <td>{{ row.description }}</td>
                            <td>{{ row.status == 'a' ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <?php if ($this->session->userdata('accountType') != 'u') {
                                ?>
                                    <a href="" v-on:click.prevent=" editItem(row)"><i class="fa fa-pencil"></i></a>&nbsp;
                                    <a href="" class="button" v-on:click.prevent="deleteItem(row.unite_id )"><i class="fa fa-trash"></i></a>
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
    new Vue({
        el: '#vehicle',
        data() {
            return {
                inputField: {
                    unite_id: '',
                    unite_name: '',
                    description: '',
                },
                saveProcess: false,
                allUnites: [],

                columns: [{
                        label: 'SL',
                        field: 'unite_id',
                        align: 'center'
                    },
                    {
                        label: 'Unite Name',
                        field: 'unite_name',
                        align: 'center'
                    },
                    {
                        label: 'description',
                        field: 'description',
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
            this.getUnites();
        },
        methods: {
            getUnites() {
                axios.post('/get-unites', {
                    status: 'all'
                }).then(res => {
                    this.allUnites = res.data;
                })
            },
            saveDate() {
                if (this.inputField.unite_name == '') {
                    alert('Unite Name is Required!');
                    return;
                }
                // if (this.inputField.description == '') {
                //     alert('Description required!');
                //     return;
                // }

                let url = '/save-unite';

                this.saveProcess = true;

                axios.post(url, this.inputField).then(res => {
                    let r = res.data;
                    alert(r.message);
                    if (r.success) {
                        this.saveProcess = false;
                        // this.getClientCode();
                        this.getUnites();
                        this.clearForm();
                    } else {
                        this.saveProcess = false;
                    }
                })
            },
            editItem(data) {
                this.inputField.unite_id = data.unite_id;
                this.inputField.unite_name = data.unite_name;
                this.inputField.description = data.description;
                this.inputField.status = data.status;
            },
            deleteItem(id) {
                let deleteConfirm = confirm('Are Your Sure to delete the item?');
                if (deleteConfirm == false) {
                    return;
                }
                axios.post('/delete-unite', {
                    unite_id: id
                }).then(res => {
                    let r = res.data;
                    alert(r.message);
                    if (r.success) {
                        this.getUnites();
                    }
                })
            },
            clearForm() {
                this.inputField.unite_id = '';
                this.inputField.unite_name = '';
                this.inputField.description = '';

                delete this.inputField.status;
            }

        }
    })
</script>