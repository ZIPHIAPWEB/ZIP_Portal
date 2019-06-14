@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div id="app">
        <div class="col-sm-12">
            <div class="container">
                <div class="box box-primary">
                    <div class="box-header with-header">
                        <h3 class="box-title">Statistic</h3>
                        <div class="pull-right">
                            <select name="" id="" class="form-control input-sm">
                                <option value="All">All</option>
                                <option value="SWT - Spring">Summer Work and Travel - Spring</option>
                                <option value="SWT - Summer">Summer Work and Travel - Summer</option>
                                <option value="Career Training">Career Training</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="progress-group">
                                    <span class="progress-text">1st Payment</span>
                                    <span class="progress-number">6/12</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary" style="width: 50%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="progress-group">
                                    <span class="progress-text">2nd Payment</span>
                                    <span class="progress-number">6/12</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" style="width: 50%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="progress-group">
                                    <span class="progress-text">3rd Payment</span>
                                    <span class="progress-number">6/12</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="progress-group">
                                    <span class="progress-text">4th Payment</span>
                                    <span class="progress-number">6/12</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" style="width: 50%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection