@extends('layouts.app')

@section('title', 'Permissions')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary with-border">
                <div class="box-body">
                    <form action="" class="form-inline">
                        <div class="form-group">
                            <label for="from-date">From Date: </label>
                            <input type="date" name="from-date" class="form-control input-sm">
                        </div>
                        <div class="form-group">
                            <label for="to-date">To Date: </label>
                            <input type="date" name="to-date" class="form-control input-sm">
                        </div>
                        <div class="form-group">
                            <select class="form-control input-sm" name="" id="">
                                <option value="">Select</option>
                            </select>
                            <button type="submit" class="btn btn-warning btn-flat btn-sm"><span class="glyphicon glyphicon-filter"></span>&nbsp; Filter</button>
                        </div>
                        <button @click="createPermission()" class="btn btn-primary btn-flat btn-sm pull-right m-b-10"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    </form>
                    <table id="permission-table" class="table table-bordered table-striped">
                        <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="permission in permissions.data">
                                <td>@{{ permission.id }}</td>
                                <td>@{{ permission.name }}</td>
                                <td>@{{ permission.display_name }}</td>
                                <td>@{{ permission.description }}</td>
                                <td>@{{ permission.created_at }}</td>
                                <td>
                                    <button @click="viewPermission(permission.id)" class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button @click="deletePermission(permission.id)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li>
                                <a href="#">«</a>
                            </li>
                            <li>
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">»</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="permission-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form id="permission-form">
                            <div class="form-group">
                                <label for="permission-name">Name:</label>
                                <input name="permission-name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="permission-display-name">Display Name:</label>
                                <input name="permission-display-name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="permission-description">Description:</label>
                                <input name="permission-description" type="text" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button @click="storePermission()" type="submit" id="submit" class="btn btn-success btn-flat btn-block">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection()

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                permissions: [],
            },
            mounted: function() {
                this.loadPermissions();
            },
            methods: {
                loadPermissions() {
                    axios(`/permission/view`)
                        .then((response) => {
                            console.log(response.data);
                            this.permissions = response.data;
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                createPermission() {
                    $('#permission-form')[0].reset();
                    $('#permission-form').attr('action', '/permission/store');
                    $('#permission-modal').modal('show');
                },
                storePermission() {
                    let url = $('#permission-form').attr('action');
                    let formData = new FormData($('#permission-form')[0]);

                    axios({
                        method: 'post',
                        url: url,
                        data: formData
                    })
                        .then((response) => {
                            this.loadPermissions();
                            $('#permission-modal').modal('hide');
                            console.log(response);
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                viewPermission(id) {
                    axios(`/permission/edit/${id}`)
                        .then((response) => {
                            $('input[name=permission-name]').val(response.data.name);
                            $('input[name=permission-display-name]').val(response.data.display_name);
                            $('input[name=permission-description]').val(response.data.description);

                            $('#permission-form').attr('action', `/permission/update/${id}`);
                            $('#permission-modal').modal('show');

                            console.log(response.data);
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                deletePermission(id) {
                    axios(`/permission/delete/${id}`)
                        .then((response) => {
                            alert('Permission Deleted!');
                            this.loadPermissions();
                            console.log(response.data);
                        }).catch((error) => {
                            console.log(error);
                    })
                }
            }
        });
    </script>
@endsection()