@extends('layouts.app')

@section('title', 'Visa Sponsors')

@section('content')
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <table id="sponsor-table" class="table table-striped table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var sponsorDT = $('#sponsor-table').dataTable({

            });
        });
    </script>
@endsection