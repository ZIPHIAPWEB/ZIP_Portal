@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <b>Students</b>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">

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
                students: [],
                links: [],
                current_page: '',
                last_page: ''
            },
            mounted: function() {
                this.loadStudents();
            },
            methods: {
                loadStudents() {

                }
            }
        })
    </script>
@endsection()