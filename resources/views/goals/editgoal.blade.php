@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Goal</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{route('goals.update', $goal->id)}}" autocomplete="off">
                    <input type="hidden" name="_method" value="PATCH">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="year">Year</label>
                            <input readonly type="text" name="year" class="form-control" value={{$goal->year}}>
                        </div>

                        <div class="form-group">
                            <label for="week">Week</label>
                            <input readonly type="text" name="week" class="form-control" value={{$goal->week_of_year}}>
                        </div>

                        <div class="form-group">
                            <label for="miles">Miles</label>
                            <input type="tel" maxlength="3" name="miles" class="form-control" value={{$goal->miles}}>
                        </div>
                       

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Edit Goal">
                        </div>

                    </form>

                    <form method="post" action="{{route('goals.destroy', $goal->id)}}">
                        <input type="hidden" name="_method" value="DELETE">
                        {{csrf_field()}}

                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" value="Delete Goal">
                        </div>
                    </form>

                    @if(count($errors) > 0)

                    <div class="alert alert-danger">
                        <ul>

                            @foreach($errors->all() as $error)

                                <li>{{$error}}</li>

                            @endforeach

                        </ul>
                    </div>

                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
