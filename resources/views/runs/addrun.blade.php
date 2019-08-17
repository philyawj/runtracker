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
                            @error('date')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="miles">Miles</label>
                            <input type="text" name="miles" class="form-control" value={{old('miles')}}>
                            @error('miles')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="hours">Hours</label>
                            <input type="tel" name="hours" class="form-control" maxlength="2" value={{old('hours')}}>
                            @error('converted_seconds')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                            @error('hours')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="minutes">Minutes</label>
                            <input type="tel" name="minutes" class="form-control" maxlength="2" value={{old('minutes')}}>
                            @error('minutes')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="seconds">Seconds</label>
                            <input type="tel" name="seconds" class="form-control" maxlength="2" value={{old('seconds')}}>
                            @error('seconds')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea type="text" name="notes" class="form-control" rows="3" value={{old('notes')}}></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Create Run">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
