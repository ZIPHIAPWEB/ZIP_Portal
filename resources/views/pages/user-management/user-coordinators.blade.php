@extends('layouts.app')

@section('title', 'Coordinators')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
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
            </div>
        </div>
    </div>
@endsection()

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                coordinator: [],
                coordinators: [],
                links: [],
                meta: []
            },
            mounted: function() {
                this.loadCoordinators();
            },
            methods: {
                loadCoordinators: function() {
                    let vm = this;
                    fetch('/coor/show')
                    .then((response) => response.json())
                    .then(function(response) {
                        vm.coordinators = response.data;
                        vm.links = response.links;
                        vm.meta = response.meta;
                        console.log(vm.links);
                        console.log(vm.meta);
                        console.log(vm.coordinators);
                    }).catch(function(error){
                        console.log(error);
                    });
                },
                view: function(id) {
                    let vm = this;
                    fetch(`/coor/single/${id}`)
                        .then((response) => response.json())
                        .then(function(response) {
                            console.log(response.data);
                            vm.coordinator = response.data;
                        }).catch(function(error) {
                            console.log(error)
                    });
                },
                deactivate: function(id) {
                    let vm = this;
                    fetch(`/coor/single/${id}`)
                        .then((response) => response.json())
                        .then(function(response) {
                            console.log(response.data);
                        }).catch(function(error) {
                            console.log(error);
                    })
                }
            }
        });
    </script>
@endsection()