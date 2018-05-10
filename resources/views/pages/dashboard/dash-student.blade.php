@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="container">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title ">Student Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-4">
                            <img src="#" alt="" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">Payment Details</h3>
                    </div>
                    <div class="box-body">

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">Basic Requirement</h3>
                    </div>
                    <div class="box-body" v-cloak>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <th>Requirements</th>
                            <th class="text-center">Uploaded</th>
                            </thead>
                            <tbody>
                            <tr v-for="requirement in basicRequirements">
                                <td>@{{ requirement.name }}</td>
                                <td class="text-center">
                                    <span v-if="requirement.status" class="fa fa-check" style="color: green;"></span>
                                    <span v-else class="fa fa-remove" style="color: red;"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">Visa Requirements</h3>
                    </div>
                    <div class="box-body">

                    </div>
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
                basicRequirements: []
            },
            mounted: function() {
                this.loadBasicRequirements(6);
            },
            methods: {
                loadBasicRequirements(programId) {
                    axios.get(`/stud/requirement/basic/${programId}`)
                        .then((response) => {
                            this.basicRequirements = response.data.data;
                            console.log(response.data.data);
                        }).catch((error) => {
                        console.log(error);
                    })
                }
            }
        });
    </script>
@endsection