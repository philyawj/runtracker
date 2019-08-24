@extends('layouts.dash')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <h2>Dashboard</h2>

                    <h3>Miles</h3>

                    <div class="row text-center mb-3">

                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <div class="card card-darker h-100">
                                <div class="card-body">
                                    <h5>Week:</h5>
                                    <h4>{{$miles_this_week}}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <div class="card card-darker h-100">
                                <div class="card-body">
                                    <h5>Month:</h5>
                                    <h4>{{$miles_this_month}}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="card card-darker h-100">
                                <div class="card-body">
                                    <h5>Year:</h5>
                                    <h4>{{$miles_this_year}}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="card card-darker h-100">
                                <div class="card-body">
                                    <h5>All Time:</h5>
                                    <h4>{{$miles_all_time}}</h4>
                                </div>
                            </div>
                        </div>

                    </div>

                    <h3>
                        @if(!is_null($this_week_goal))
                            Weekly Goal: {{$this_week_goal}} 
                        @else 
                            Weekly Goal
                        @endif
                    </h3>

                    @if(is_null($this_week_goal)) 
                        <p><a class="btn btn-sm btn-primary" href="{{route('goals.create', [$current_year,$current_week])}}">Set goal</a></p>
                        
                    @else
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" style="width: {{$weekly_progress}}%" aria-valuenow="{{$weekly_progress}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endif
                

                    <h3>Weekly Miles</h3>

                    <canvas id="myChart"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
