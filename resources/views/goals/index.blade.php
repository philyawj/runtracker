@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Goals</div>

                <div class="card-body">

                <h2>Goals in the year {{$currentyear}}.</h2>

                    <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">week</th>
                                    <th scope="col">miles</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($weeks as $week)

                                <tr>
                                    <th scope="row">{{$week}}</th>
                                    <td>
                                    @foreach($goals as $goal)
                                        @if($week == $goal->weekofyear)
                                            {{$goal->miles}}
                                        @endif
                                    @endforeach
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                    </table>
                

                <hr>

                <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">user_id</th>
                                    <th scope="col">year</th>
                                    <th scope="col">weekofyear</th>
                                    <th scope="col">miles</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($goals as $goal)

                                <tr>
                                    <th scope="row">{{$goal->id}}</th>
                                    <td>{{$goal->user_id}}</td>
                                    <td>{{$goal->year}}</td>
                                    <td>{{$goal->weekofyear}}</td>
                                    <td>{{$goal->miles}}</td>
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
