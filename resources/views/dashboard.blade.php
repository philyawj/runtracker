@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <p>Miles this week: {{$milesthisweek}}</p>
                    @if(is_null($thisweekgoal)) 
                        <p><a class="btn btn-sm btn-primary" href="{{route('goals.create', [$current_year,$current_week])}}">Button to set goal for this week</a></p>
                        
                    @else
                        <p>Goal this week: {{$thisweekgoal}}</p>
                        <p class="mb-0">Progress to weekly goal</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{$weeklyprogress}}%" aria-valuenow="{{$weeklyprogress}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endif
                    
                    
                    <p>Miles last week: {{$mileslastweek}}</p>
                    <p>Miles this month: {{$milesthismonth}}</p>
                    <p>Miles last month: {{$mileslastmonth}}</p>

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
                                    <td scope="row">{{$lastthreerun->date}}</td>
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
