@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Run</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{route('run.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" name="date" class="form-control" value={{old('date')}}>
                        </div>
                       
                        <div class="form-group">
                            <label for="distance">Distance</label>
                            <input type="text" name="distance" class="form-control" value={{old('distance')}}>
                        </div>

                        <div class="form-group">
                            <label for="hours">Hours</label>
                            <input type="text" name="hours" class="form-control" value={{old('hours')}}>
                        </div>

                        <div class="form-group">
                            <label for="minutes">Minutes</label>
                            <input type="text" name="minutes" class="form-control" value={{old('minutes')}}>
                        </div>

                        <div class="form-group">
                            <label for="seconds">Seconds</label>
                            <input type="text" name="seconds" class="form-control" value={{old('seconds')}}>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <input type="text" name="notes" class="form-control" value={{old('notes')}}>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Create Run">
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
