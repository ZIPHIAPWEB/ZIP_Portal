@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidenav')
    <li class="header">Program</li>
    <li class="treeview" id="coordinator">
        <a href="#">
            <i class="fa fa-key"></i>
            <span><small>Student's Program(s)</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu" >
            <li v-for="program in programs"><a :href="url + program.id"><i class="fa fa-circle-o"></i><small>@{{ program.name }}</small></a></li>
        </ul>
    </li>
@endsection

@section('content')
    <div id="app">

    </div>
@endsection

@section('script')
    <script>
        let program_id = 'Test';

        const sidenav = new Vue({
            el: '#sidenav',
            data: {
                url: '/portal/c/program/',
                programs: []
            },
            mounted: function() {
                this.loadPrograms();
            },
            methods: {
                loadPrograms() {
                    axios.get('/helper/program/view')
                        .then((response) => {
                            this.programs = response.data.data;
                        })
                }
            }
        });

        const app = new Vue({
            el: '#app',
            data: {

            }
        })
    </script>
@endsection