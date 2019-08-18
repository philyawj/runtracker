@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <h2>Dashboard</h2>

                    <div class="row text-center mb-3">

                    <div class="col-6 col-md-3 mb-3 mb-md-0">
                        <div class="card card-darker h-100">
                            <div class="card-body">
                                <h5>This Week:</h5>
                                <h4>{{$milesthisweek}}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mb-3 mb-md-0">
                        <div class="card card-darker h-100">
                            <div class="card-body">
                                <h5>This Month:</h5>
                                <h4>{{$milesthismonth}}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="card card-darker h-100">
                            <div class="card-body">
                                <h5>This Year:</h5>
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

                    @if(is_null($thisweekgoal)) 
                        <p><a class="btn btn-sm btn-primary" href="{{route('goals.create', [$current_year,$current_week])}}">Button to set goal for this week</a></p>
                        
                    @else
                        <p>Goal this week: {{$thisweekgoal}}</p>
                        <p class="mb-0">Progress to weekly goal</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{$weeklyprogress}}%" aria-valuenow="{{$weeklyprogress}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endif
                    
                    
                    

                    <h5>Last 3 Runs</h5>
                    <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">date</th>
                                    <th scope="col">miles</th>
                                    <th scope="col">time</th>
                                    <th scope="col">mph</th>
                                </tr>
                            </thead>
                            <tbody>
                        
                            @foreach($lastthreeruns as $lastthreerun)

                                <tr>
                                    <td scope="row">{{date("m/d/Y", strtotime($lastthreerun->date))}}</td>
                                    <td>{{$lastthreerun->miles}}</td>
                                    <td>{{date("H:i:s", $lastthreerun->seconds)}}</td>
                                    <td>{{$lastthreerun->mph}}</td>
                                </tr>

                            @endforeach

                            </tbody>
                    </table>

                    <a class="btn btn-primary" href="{{route('runs.index')}}">See more runs</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
