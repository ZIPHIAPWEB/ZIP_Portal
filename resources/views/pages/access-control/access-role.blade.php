@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <table id="role-table" class="table table-bordered table-striped">
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

    <div class="modal fade" id="role-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form id="role-form">
                        <div class="form-group">
                            <label for="role-name">Name:</label>
                            <input name="role-name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="role-display-name">Display Name:</label>
                            <input name="role-display-name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="role-description">Description:</label>
                            <input name="role-description" type="text" class="form-control">
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
        $(document).ready(function(){
            var dt = $('#role-table').dataTable({
                'processing': true,
                'serverSide': true,
                'ordering'    : true,
                'autoWidth'   : false,
                'ajax': '{{ route('role.view') }}',
                'dom': '<"row"<"pull-right"><"pull-left">><"row"<"pull-right m-r-15"B><"pull-left filter">>tr<"row"<"pull-right m-r-15"p><"pull-left m-l-15"i>>',
                'buttons': [
                    {
                        className: 'btn btn-default btn-flat btn-sm',
                        text: '<span class="fa fa-plus-circle"></span>&nbsp;Create',
                        action: function(e, dt, node, config){
                            $('#role-modal').find('.modal-title').text('Create New Role');
                            $('#role-modal').find('#submit').text('Save');
                            $('#role-form').attr('action', '/role/store');
                            $('#role-form')[0].reset();
                            $('#role-modal').modal('show');
                        }
                    }
                ],
                'columns': [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'display_name', name: 'display_name' },
                    { data: 'description', name: 'description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' }
                ]
            });

            $('#role-table tbody').on('click', 'td button', function() {
                var data = $(this).attr('data');
                var dataId = $(this).attr('data-id');

                switch(data) {
                    case 'edit':
                        $.ajax({
                            type: 'ajax',
                            url: '/role/edit/'+dataId,
                            method: 'get',
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                $('#role-form').attr('action', '/role/update/'+dataId);
                                $('#role-modal').find('.modal-title').text('Update Role');
                                $('#role-modal').find('#submit').text('Update');
                                $('input[name=role-name]').val(response['name']);
                                $('input[name=role-display-name]').val(response['display_name']);
                                $('input[name=role-description]').val(response['description']);

                                $('#role-modal').modal('show');
                                dt.api().ajax.reload();
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        });
                        break;

                    case 'delete':
                        $.ajax({
                            type: 'ajax',
                            url: '/role/delete/'+dataId,
                            method: 'get',
                            dataType: 'json',
                            success: function(response) {
                                dt.api().ajax.reload();
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        });
                        break;
                }
            });

            $('#submit').click(function() {
                var formData = new FormData($('#role-form')[0]);
                var url = $('#role-form').attr('action');

                $.ajax({
                    type: 'ajax',
                    url: url,
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        dt.api().ajax.reload();
                        $('#role-modal').modal('hide');
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection()