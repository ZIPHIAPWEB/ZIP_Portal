@extends('layouts.app')

@section('title', 'Visa Sponsors')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button @click="create()" class="btn btn-primary btn-flat btn-sm m-b-10 pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    <table id="sponsor-table" class="table table-striped table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="sponsor in sponsors">
                                <td>@{{ sponsor.name }}</td>
                                <td>@{{ sponsor.display_name }}</td>
                                <td>@{{ sponsor.description }}</td>
                                <td>@{{ sponsor.created_at }}</td>
                                <td>
                                    <button @click="" class="btn btn-primary btn-flat btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                                    <button class="btn btn-success btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="create-sponsor-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Create Sponsor</h4>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <label for="sponsor-name">Name</label>
                                <input type="text" name="sponsor-name" class="form-control" placeholder="Enter Sponsor Name...">
                            </div>
                            <div class="form-group">
                                <label for="sponsor-display-name">Display Name</label>
                                <input type="text" name="sponsor-display-name" class="form-control" placeholder="Enter Sponsor Display Name...">
                            </div>
                            <div class="form-group">
                                <label for="sponsor-description">Description</label>
                                <input type="text" name="sponsor-description" class="form-control" placeholder="Enter Sponsor Description...">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer clearfix">
                        <button class="btn btn-success btn-flat btn-block">Add Sponsor</button>
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
                sponsors: [
                    { id: 1, name: 'Sample Name', display_name: 'Sample Display Name', description: 'Sample Description', created_at: 'Sample Created At' },
                    { id: 1, name: 'Sample Name', display_name: 'Sample Display Name', description: 'Sample Description', created_at: 'Sample Created At' },
                    { id: 1, name: 'Sample Name', display_name: 'Sample Display Name', description: 'Sample Description', created_at: 'Sample Created At' },
                    { id: 1, name: 'Sample Name', display_name: 'Sample Display Name', description: 'Sample Description', created_at: 'Sample Created At' },
                    { id: 1, name: 'Sample Name', display_name: 'Sample Display Name', description: 'Sample Description', created_at: 'Sample Created At' },
                    { id: 1, name: 'Sample Name', display_name: 'Sample Display Name', description: 'Sample Description', created_at: 'Sample Created At' },
                ]
            },
            methods: {
                create() {
                    $('#create-sponsor-modal').modal('show');
                }
            }
        });
    </script>
@endsection