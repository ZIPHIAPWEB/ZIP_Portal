@extends('layouts.app')

@section('title', 'Program Setting')

@section('content')
    <div id="app">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button class="btn btn-primary btn-flat btn-sm m-b-10 pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    <table id="program-table" class="table table-striped table-bordered">
                        <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        <tr v-for="program in programs">
                            <td>@{{ program.id }}</td>
                            <td>@{{ program.name }}</td>
                            <td>@{{ program.display_name }}</td>
                            <td>@{{ program.description }}</td>
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
    </div>
@endsection

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                programs: []
            },
            mounted: function() {

            },
            methods: {
                createPrograms() {

                }
            }
        });
    </script>
@endsection