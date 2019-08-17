@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <h2>Create Goal</h2>
                    
                    <form method="POST" action="{{route('goals.store')}}" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="year">Year</label>
                            <input  type="text" name="year" class="form-control" value={{$goal->year}}>
                        </div>

                        <div class="form-group">
                            <label for="week_of_year">Week</label>
                            <input readonly type="text" name="week_of_year" class="form-control" value={{$goal->week_of_year}}>
                        </div>

                        <div class="form-group">
                            <label for="miles">Miles</label>
                            <input type="tel" name="miles" class="form-control" maxlength="3">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Create Goal">
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
