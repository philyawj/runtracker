@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Run</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{route('goals.store')}}" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="year">Year</label>
                            <input readonly type="text" name="year" class="form-control" value={{$goal->year}}>
                        </div>

                        <div class="form-group">
                            <label for="weekofyear">Week</label>
                            <input readonly type="text" name="weekofyear" class="form-control" value={{$goal->weekofyear}}>
                        </div>

                        <div class="form-group">
                            <label for="miles">Miles</label>
                            <input type="text" name="miles" class="form-control" value={{old('miles')}}>
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
