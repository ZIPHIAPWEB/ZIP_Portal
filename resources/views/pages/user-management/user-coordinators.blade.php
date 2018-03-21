@extends('layouts.app')

@section('title', 'Coordinators')

@section('content')
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <table id="coordinator-table" class="table table-bordered table-striped">
                    <thead>
                        <th>#</th>
                        <th>Username</th>
                        <th>E-mail</th>

                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection()

@section('script')
    <script>
        $(document).ready(function() {
            var dt = $('#coordinator-table').dataTable({
                'processing': true,
                'serverSide': true,
                'ajax': '/coor/show',
                'columns': [
                    { data: 'id', name: 'user.id' },
                    { data: 'name', name: 'user.name' },
                    { data: 'email', name: 'user.email' }
                ]
            });

            $.ajax({
               type: 'ajax',
               url: '/coor/show',
               method: 'get',
               dataType: 'json',
               success: function(response) {
                   console.log(response);
               }
            });
        });
    </script>
@endsection()