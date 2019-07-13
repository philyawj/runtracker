@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">user_id</th>
                                    <th scope="col">date</th>
                                    <th scope="col">year</th>
                                    <th scope="col">month</th>
                                    <th scope="col">week of year</th>
                                    <th scope="col">miles</th>
                                    <th scope="col">time</th>
                                    <th scope="col">mph</th>
                                    <th scope="col">notes</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            
                            @foreach($runs as $run)

                                <tr>
                                    <th scope="row">{{$run->id}}</th>
                                    <td>{{$run->user_id}}</td>
                                    <td>{{$run->date}}</td>
                                    <td>{{$run->year}}</td>
                                    <td>{{$run->month}}</td>
                                    <td>{{$run->week_of_year}}</td>
                                    <td>{{$run->miles}}</td>
                                    <td>{{date("H:i:s", $run->seconds)}}</td>
                                    <td>{{$run->mph}}</td>
                                    <td>{{$run->notes}}</td>
                                    <td><a class="btn btn-warning btn-sm" href="{{route('runs.edit', $run->id)}}">Edit</a></td>
                                </tr>

                            @endforeach

                            </tbody>
                    </table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
