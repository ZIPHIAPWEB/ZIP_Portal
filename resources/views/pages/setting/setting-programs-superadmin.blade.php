@extends('layouts.app')

@section('title', 'Program Setting')

@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <table id="program-table" class="table table-striped table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Summer Work and Travel - Summer</td>
                            <td>SWT - Summer</td>
                            <td>Summer Work and Travel</td>
                            <td>
                                <button class="btn btn-primary btn-flat btn-xs" data="add"><span class="glyphicon glyphicon-plus"></span></button>&nbsp;
                                <button class="btn btn-success btn-flat btn-xs" data="edit"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
                                <button class="btn btn-danger btn-flat btn-xs" data="delete"><span class="glyphicon glyphicon-trash"></span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="program-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <table id="program-single-table" class="table table-striped table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Application Form</td>
                                <td>Application Form</td>
                                <td>
                                    <button class="btn btn-success btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
                                    <button class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2 x 2 Picture</td>
                                <td>2 x 2 Picture</td>
                                <td>
                                    <button class="btn btn-success btn-flat btn-xs" data="edit"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
                                    <button class="btn btn-danger btn-flat btn-xs" data="delete"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="program-single-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var programDT = $('#program-table').dataTable();
            var programSingleDT = $('#program-single-table').dataTable({
                'dom': '<"row"<"pull-right"><"pull-left">><"row"<"pull-right m-r-15"B><"pull-left filter">>tr<"row"<"pull-right m-r-15"p><"pull-left m-l-15"i>>',
                'buttons': [
                    {
                        className: 'btn btn-default btn-flat btn-sm',
                        text: '<span class="glyphicon glyphicon-plus"></span> Create'
                    }
                ]
            });

            $('#program-table tbody').on('click', 'td button', function() {
                var data = $(this).attr('data');
                var dataId = $(this).attr('data-id');

                switch(data) {
                    case 'add':
                        $('#program-modal').modal('show');
                        break;
                    case 'edit':
                        alert('Edit!');
                        break;

                    case 'delete':
                        alert('Delete');
                        break;
                }
            });

            $('#program-single-table tbody').on('click', 'td button', function() {
                var data = $(this).attr('data');
                var dataId = $(this).attr('data-id');

                switch(data) {
                    case 'edit':
                        $('#program-single-modal').modal('show');
                        break;

                    case 'delete':
                        alert('Delete');
                        break;
                }
            });
        });
    </script>
@endsection