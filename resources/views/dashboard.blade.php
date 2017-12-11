@extends('layouts.app')

@section('content')

 <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-primary">
                                <div class="card-block pb-0">
                                    <div class="btn-group float-right">
                                        <button type="button" class="btn btn-transparent active dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">View</a>
                                            {{-- <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a> --}}
                                        </div>
                                    </div>
                                    <h4 class="mb-0">10</h4>
                                    <p>New Orders</p>
                                </div>
                                <div class="chart-wrapper px-3" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->

                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-info">
                                <div class="card-block pb-0">
                                    <button type="button" class="btn btn-transparent active p-0 float-right">
                                        <i class="icon-location-pin"></i>
                                    </button>
                                    <h4 class="mb-0">99</h4>
                                    <p>Today Orders</p>
                                </div>
                                <div class="chart-wrapper px-3" style="height:70px;">
                                    <canvas id="card-chart2" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->

                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-warning">
                                <div class="card-block pb-0">
                                    <div class="btn-group float-right">

                                    </div>
                                    <h4 class="mb-0">$ 99,999 BHT</h4>
                                    <p>Today Sold Amount</p>
                                </div>
                                <div class="chart-wrapper" style="height:70px;">
                                    <canvas id="card-chart3" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->

                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-danger">
                                <div class="card-block pb-0">
                                    <div class="btn-group float-right">
                                        <button type="button" class="btn btn-transparent active dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-settings"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">View</a>

                                        </div>
                                    </div>
                                    <h4 class="mb-0">2</h4>
                                    <p>Open Ticket</p>
                                </div>
                                <div class="chart-wrapper px-3" style="height:70px;">
                                    <canvas id="card-chart4" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->
                    </div>
                    <!--/.row-->


@endsection
