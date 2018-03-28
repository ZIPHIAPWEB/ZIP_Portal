@extends('layouts.app')

@section('title', 'Coordinators')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <b>Coordinator</b>
                </div>
                <div class="box-body">
                    <table id="coordinator-table" class="table table-bordered table-striped">
                        <thead>
                            <th>#</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="coordinator in coordinators.data">
                                <td>@{{ coordinator.id }}</td>
                                <td>@{{ coordinator.name }}</td>
                                <td>@{{ coordinator.email }}</td>
                                <td>
                                    <button class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-eye-open"></span>&nbsp; View</button>
                                    <button class="btn btn-warning btn-flat btn-xs"><span class="fa fa-cogs"></span>&nbsp; @{{ coordinator.verified === 0 ? 'Activate' : 'Deactivate' }}</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a @click="previous()">«</a>
                        </li>
                        <li>
                            <a>@{{ current_page }}</a>
                        </li>
                        <li>
                            <a>of</a>
                        </li>
                        <li>
                            <a>@{{ last_page }}</a>
                        </li>
                        <li>
                            <a @click="next()">»</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                coordinators: [],
                links: [],
                current_page: '',
                last_page: ''
            },
            mounted: function() {
                this.loadCoordinators();
            },
            methods: {
                previous() {

                },
                next() {

                },
                loadCoordinators() {
                    axios('/coor/show')
                        .then((response) => {
                            this.coordinators = response.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page
                        }).catch((error) => {
                            console.log(error);
                    });
                }
            }
        });
    </script>
@endsection()