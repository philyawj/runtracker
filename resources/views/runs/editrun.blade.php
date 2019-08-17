@extends('layouts.runbootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <h2>Edit Run</h2>
                    
                    <form method="POST" action="{{route('runs.update', $run->id)}}" autocomplete="off">
                    <input type="hidden" name="_method" value="PATCH">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input id="editrun" type="text" name="date" class="form-control" value={{old('date', $run->date)}}>
                            @error('date')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="form-group">
                            <label for="miles">Miles</label>
                            <input type="text" name="miles" class="form-control" value={{old('miles', $run->miles)}}>
                            @error('miles')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="hours">Hours</label>
                            <input type="tel" name="hours" class="form-control" maxlength="2" value={{old('hours', $run->hours)}}>
                            @error('converted_seconds')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                            @error('hours')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="minutes">Minutes</label>
                            <input type="tel" name="minutes" class="form-control" maxlength="2" value={{old('minutes', $run->minutes)}}>
                            @error('minutes')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="seconds">Seconds</label>
                            <input type="tel" name="seconds" class="form-control" maxlength="2" value={{old('seconds', $run->seconds)}}>
                            @error('seconds')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" rows="3" class="form-control">{{old('notes', $run->notes)}}</textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Edit Run">
                        </div>

                    </form>

                    <form method="post" action="{{route('runs.destroy', $run->id)}}">
                        <input type="hidden" name="_method" value="DELETE">
                        {{csrf_field()}}

                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" value="Delete Run">
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
