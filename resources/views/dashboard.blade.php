@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <p>Miles this week: {{$milesthisweek}}</p>

                    <p>Last 3 runs</p>
                    <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">user_id</th>
                                    <th scope="col">date</th>
                                    <th scope="col">miles</th>
                                    <th scope="col">seconds</th>
                                    <th scope="col">mph</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                        
                            @foreach($lastthreeruns as $lastthreerun)

                                <tr>
                                    <th scope="row">{{$lastthreerun->id}}</th>
                                    <td>{{$lastthreerun->user_id}}</td>
                                    <td>{{$lastthreerun->date}}</td>
                                    <td>{{$lastthreerun->miles}}</td>
                                    <td>{{$lastthreerun->seconds}}</td>
                                    <td>{{$lastthreerun->mph}}</td>
                                </tr>

                            @endforeach

                            </tbody>
                    </table>

                    <ul>
                        

                        <li>3.  w/ see more </li>

                        <li>1.5 Progress to weekly goal if there is one</li>
                        <li>2. Miles this month</li>
                        <li>2.5 Progress to monthly goal if there is one.</li>
                        
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
