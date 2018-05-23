@extends('layouts.app')

@section('title', 'Permissions')

@section('sidenav')
    <li class="{{ Route::currentRouteNamed('dash.superadmin') ? 'active' : '' }}">
        <a href="{{ route('dash.superadmin') }}">
            <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
        </a>
    </li>
    <li class="header">Administrative</li>
    <li class="treeview {{ Route::currentRouteNamed('um.students') ? 'active' : '' }}{{ Route::currentRouteNamed('um.coordinators') ? 'active' : '' }}{{ Route::currentRouteNamed('um.sponsors') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-users"></i>
            <span><small>User Management</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('um.students') ? 'active' : '' }}"><a href="{{ route('um.students') }}"><i class="fa fa-circle-o"></i> <span><small>Students</small></span></a></li>
            <li class="{{ Route::currentRouteNamed('um.coordinators') ? 'active' : '' }}"><a href="{{ route('um.coordinators') }}"><i class="fa fa-circle-o"></i> <span><small>Coordinators</small></span></a></li>
            <li class="{{ Route::currentRouteNamed('um.sponsors') ? 'active' : '' }}"><a href="{{ route('um.sponsors') }}"><i class="fa fa-circle-o"></i> <span><small>Visa Sponsors</small></span></a></li>
        </ul>
    </li>
    <li class="treeview {{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-key"></i>
            <span><small>Access Control Management</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}"><a href="{{ route('ac.role') }}"><i class="fa fa-circle-o"></i> <small>Roles</small></a></li>
            <li class="{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}"><a href="{{ route('ac.permission') }}"><i class="fa fa-circle-o"></i> <small>Permissions</small></a></li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-desktop"></i> <span><small>Website Content Management</small></span>
        </a>
    </li>
    <li class="header">Settings</li>
    <li class="treeview {{ Route::currentRouteNamed('s.school') ? 'active' : '' }}{{ Route::currentRouteNamed('s.host') ? 'active' : '' }}{{ Route::currentRouteNamed('s.programs') ? 'active' : '' }}{{ Route::currentRouteNamed('s.sponsors') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-gear"></i> <span><small>General</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('s.programs') ? 'active' : '' }}"><a href="{{ route('s.programs') }}"><i class="fa fa-circle-o"></i> <small>Program</small></a></li>
            <li class="{{ Route::currentRouteNamed('s.sponsors') ? 'active' : '' }}"><a href="{{ route('s.sponsors') }}"><i class="fa fa-circle-o"></i> <small>Visa Sponsor</small></a></li>
            <li class="{{ Route::currentRouteNamed('s.host') ? 'active' : '' }}"><a href="{{ route('s.host') }}"><i class="fa fa-circle-o"></i> <small>Host Company</small></a></li>
            <li class="{{ Route::currentRouteNamed('s.school') ? 'active' : '' }}"><a href="{{ route('s.school') }}"><i class="fa fa-circle-o"></i> <small>School</small></a></li>
        </ul>
    </li>
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="box box-primary with-border">
            <div class="box-body">
                <table id="permission-table" class="table table-bordered table-striped">
                    <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Action</th>
                    </thead>
                </table>
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
                    <button type="submit" id="submit" class="btn btn-success btn-flat btn-block">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection()

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            var dt = $('#permission-table').dataTable({
                'processing': true,
                'serverSide': true,
                'ordering'  : true,
                'autoWidth' : false,
                'ajax'  :   '{{ route('permission.view') }}',
                'sorting': [0,'desc'],
                'dom': '<"row"<"pull-right"><"pull-left">><"row"<"pull-right m-r-15"B><"pull-left filter">>tr<"row"<"pull-right m-r-15"p><"pull-left m-l-15"i>>',
                'buttons': [
                    {
                        className: 'btn btn-default btn-flat btn-sm',
                        text: '<span class="fa fa-plus-circle"></span>&nbsp;Create',
                        action: function(e, dt, node, config){
                            $('#permission-modal').find('.modal-title').text('Create New Permission');
                            $('#permission-modal').find('#submit').text('Save');
                            $('#permission-modal').modal('show');

                            $('#permission-form').attr('action', '/permission/store');
                            $('#permission-form')[0].reset();
                        }
                    }
                ],
                'columns'   :   [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'display_name', name: 'display_name' },
                    { data: 'description', name: 'description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });

            $('#btn-create').click(function() {
                $('#permission-modal').find('.modal-title').text('Create New Permission');
                $('#permission-modal').find('#submit').text('Save');
                $('#permission-modal').modal('show');

                $('#permission-form').attr('action', '/permission/store');
                $('#permission-form')[0].reset();
            });

            $('#permission-table tbody').on('click', 'td button', function() {
                var data = $(this).attr('data');
                var dataId = $(this).attr('data-id');

                switch(data) {
                    case 'edit':
                        $.ajax({
                            type: 'ajax',
                            url: '/permission/edit/'+dataId,
                            method: 'get',
                            dataType: 'json',
                            success: function(response) {
                                $('#permission-modal').find('.modal-title').text('Update Permission');
                                $('#permission-modal').find('#submit').text('Update');
                                $('input[name=permission-name]').val(response['name']);
                                $('input[name=permission-display-name]').val(response['display_name']);
                                $('input[name=permission-description]').val(response['description']);

                                $('#permission-form').attr('action', '/permission/update/'+dataId);
                                $('#permission-modal').modal('show');
                                console.log(response);
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        });
                        break;

                    case 'delete':
                        $.ajax({
                            type: 'ajax',
                            url: '/permission/delete/'+dataId,
                            method: 'get',
                            dataType: 'json',
                            success: function(response) {
                                dt.api().ajax.reload();
                                console.log(response);
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        });
                        break;
                }
            });

            $('#submit').click(function() {
                var formData = new FormData($('#permission-form')[0]);
                var url = $('#permission-form').attr('action');

                $.ajax({
                    type: 'ajax',
                    url: url,
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#permission-form')[0].reset();
                        $('#permission-modal').modal('hide');
                        dt.api().ajax.reload();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection()