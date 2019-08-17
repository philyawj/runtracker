@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Goals</div>

                <div class="card-body">
                
                <form method="POST" action="{{route('goals.reroute')}}" autocomplete="off">
                        {{ csrf_field() }}

                        <select name="gotoyear" id="">
                            @foreach($goal_year_array as $goalyear)
                            
                                @if($goalyear === $year)
                                    <option selected="selected" value={{$goalyear}}>{{$goalyear}}</option>
                                @else
                                    <option value={{$goalyear}}>{{$goalyear}}</option>
                                @endif

                            @endforeach
                        </select>
                        
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-sm" value="Go to goal year">
                        </div>

                    </form>
                

               

                <h2>Goals in the year {{$year}}.</h2>
                @if(Session::has('message'))
                    <p class="alert alert-warning">{{ Session::get('message') }}</p>
                @endif
                    <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col fit">week</th>
                                    <th scope="col">progress</th>
                                    <th scope="col">goal</th>
                                    <th scope="col">done</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach($combined_goals as $goal)
                                    @if($current_week === $goal->week_of_year and $current_year === $year)
                                        <tr class="bg-secondary">
                                    @else 
                                        <tr>
                                    @endif

                                        @if($goal->miles > 0)
                                            <td scope="row" class="fit"><a href="{{route('goals.edit', [$year,$goal->week_of_year])}}">{{$goal->startofweek}} - {{$goal->endofweek}} ({{$goal->week_of_year}})</a></td>
                                            
                                        @else 
                                            <td scope="row" class="fit"><a href="{{route('goals.create', [$year,$goal->week_of_year])}}">{{$goal->startofweek}} - {{$goal->endofweek}} ({{$goal->week_of_year}})</a></td>
                                         
                                        @endif

                                        <td>
                                            @if($goal->miles > 0)
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{($goal->miles_done/$goal->miles)*100}}%" aria-valuenow="{{$goal->miles_done/$goal->miles}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @else 
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{0}}%" aria-valuenow="{{0}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @endif
                                        </td>
                                       
                                        <td>{{$goal->miles}}</td>
                                        <td>{{$goal->miles_done}}</td>

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
