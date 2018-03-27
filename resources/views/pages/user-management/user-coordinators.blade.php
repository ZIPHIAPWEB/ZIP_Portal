@extends('layouts.app')

@section('title', 'Coordinators')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
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
                        <thead>
                            <tr v-for="coordinator in coordinators">
                                <td>@{{ coordinator.id }}</td>
                                <td>@{{ coordinator.name }}</td>
                                <td>@{{ coordinator.email }}</td>
                                <td>
                                    <button @click="view(coordinator.id)" class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button>
                                    <button @click="view(coordinator.id)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-ban-circle"></span></button>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a @click="previous()" href="#">«</a>
                        </li>
                        <li>
                            <a>@{{ current_page }}</a>
                        </li>
                        <li>
                            <a href="#">of</a>
                        </li>
                        <li>
                            <a>@{{ last_page }}</a>
                        </li>
                        <li>
                            <a @click="next()" href="#">»</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                coordinator: [],
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
                    axios(this.links.prev)
                        .then((response) => {
                            this.coordinators = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                next() {
                    axios(this.links.next)
                        .then((response) => {
                            this.coordinators = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                loadCoordinators() {
                    axios('/coor/show')
                    .then((response) => {
                        this.coordinators = response.data.data;
                        this.links = response.data.links;
                        this.current_page = response.data.meta.current_page;
                        this.last_page = response.data.meta.last_page;

                    }).catch((error) => {
                        console.log(error);
                    });
                },
                view(id) {
                    axios(`/coor/single/${id}`)
                        .then((response) => {
                            console.log(response.data.data);
                            this.coordinator = response.data.data;
                        }).catch((error) => {
                            console.log(error)
                    });
                },
                deactivate(id) {
                    axios(`/coor/single/${id}`)
                        .then((response) => {
                            console.log(response.data.data);
                        }).catch((error) => {
                            console.log(error);
                    });
                }
            }
        });
    </script>
@endsection