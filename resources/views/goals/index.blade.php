@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Goals</div>

                <div class="card-body">

                {{$year}}
                <select name="" id="">
                    @foreach($goalyeararray as $goalyear)
                    
                        @if($goalyear === $currentyear)
                            <option selected="selected" value="">{{$goalyear}}</option>
                        @else
                            <option value="">{{$goalyear}}</option>
                        @endif

                    @endforeach
                </select>

               

                <h2>Goals in the year {{$year}}.</h2>
                    <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">week</th>
                                    <th scope="col">miles</th>
                                    <th scope="col">add/edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach($combinedgoals as $goal)
                                    @if($currentweek === $goal->weekofyear and $currentyear === $year)
                                        <tr class="bg-primary">
                                    @else 
                                        <tr>
                                    @endif
                                        <th scope="row">{{$goal->startofweek}} - {{$goal->endofweek}} ({{$goal->weekofyear}})</th>
                                        <td>{{$goal->miles}}</td>
                                        @if($goal->miles > 0)
                                            <td><a class="btn btn-warning btn-sm" href="{{route('goals.edit', [$year,$goal->weekofyear])}}">Edit</a></td>
                                        @else 
                                            <td><a class="btn btn-success btn-sm" href="{{route('goals.create', [$year,$goal->weekofyear])}}">Add</a></td>
                                        @endif
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
                            
                           

                            </tbody>
                    </table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
