@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    THIS IS THE RUNS PAGE FROM runs folder
                    <a class="btn btn-primary" href="{{route('runs.create')}}">Add Run</a>

                    <p>Miles this week: {{$milesthisweek}}</p>
                    <hr>
                    
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
                                    <th scope="col">seconds</th>
                                    <th scope="col">mph</th>
                                    <th scope="col">notes</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
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
                                    <td>{{$run->weekofyear}}</td>
                                    <td>{{$run->miles}}</td>
                                    <td>{{$run->seconds}}</td>
                                    <td>{{$run->mph}}</td>
                                    <td>{{$run->notes}}</td>
                                    <td><a href="{{route('runs.edit', $run->id)}}">Edit</a></td>
                                    <td><form method="post" action="{{route('runs.destroy', $run->id)}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-danger btn-sm" value="Delete Run">
                                            </div>
                                        </form></td>
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
