@extends('layouts.app')

@section('title', 'Host Company Setting')

@section('content')
    <div id="app">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button class="btn btn-primary btn-sm btn-flat pull-right m-b-10"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>Description</td>
                                <td>Created At</td>
                                <td>
                                    <button class="btn btn-success btn-xs btn-flat"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button class="btn btn-danger btn-xs btn-flat"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>Description</td>
                                <td>Created At</td>
                                <td>
                                    <button class="btn btn-success btn-xs btn-flat"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button class="btn btn-danger btn-xs btn-flat"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>Description</td>
                                <td>Created At</td>
                                <td>
                                    <button class="btn btn-success btn-xs btn-flat"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button class="btn btn-danger btn-xs btn-flat"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a>«</a>
                        </li>
                        <li>
                            <a>1</a>
                        </li>
                        <li>
                            <a>of</a>
                        </li>
                        <li>
                            <a>1</a>
                        </li>
                        <li>
                            <a>»</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection