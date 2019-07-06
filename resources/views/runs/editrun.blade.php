@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Run</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{route('runs.update', $run->id)}}">
                    <input type="hidden" name="_method" value="PATCH">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" name="date" class="form-control" value={{$run->date}}>
                        </div>
                       
                        <div class="form-group">
                            <label for="miles">Miles</label>
                            <input type="text" name="miles" class="form-control" value={{$run->miles}}>
                        </div>

                        <div class="form-group">
                            <label for="hours">Hours</label>
                            <input type="tel" name="hours" class="form-control" value={{$run->hours}}>
                        </div>

                        <div class="form-group">
                            <label for="minutes">Minutes</label>
                            <input type="tel" name="minutes" class="form-control" maxlength="2" value={{$run->minutes}}>
                        </div>

                        <div class="form-group">
                            <label for="seconds">Seconds</label>
                            <input type="tel" name="seconds" class="form-control" maxlength="2" value={{$run->seconds}}>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <input type="text" name="notes" class="form-control" value="{{$run->notes}}"">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Edit Run">
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
