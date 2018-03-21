@extends('layouts.app')

@section('title', 'Permissions')

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