@extends('layouts.runbootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <h2>Create Run</h2>
                    
                    <form method="POST" action="{{route('runs.store')}}" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input id="addrun" type="text" name="date" class="form-control" value={{old('date')}}>
                        </div>
                       
                        <div class="form-group">
                            <label for="miles">Miles</label>
                            <input type="text" name="miles" class="form-control" value={{old('miles')}}>
                        </div>

                        <div class="form-group">
                            <label for="hours">Hours</label>
                            <input type="tel" name="hours" class="form-control" maxlength="2" value={{old('hours')}}>
                        </div>

                        <div class="form-group">
                            <label for="minutes">Minutes</label>
                            <input type="tel" name="minutes" class="form-control" maxlength="2" value={{old('minutes')}}>
                        </div>

                        <div class="form-group">
                            <label for="seconds">Seconds</label>
                            <input type="tel" name="seconds" class="form-control" maxlength="2" value={{old('seconds')}}>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea type="text" name="notes" class="form-control" rows="3" value={{old('notes')}}></textarea>
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
