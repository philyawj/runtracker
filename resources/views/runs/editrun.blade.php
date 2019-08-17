@extends('layouts.runbootstrap')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <h2>Edit Run</h2>
                    
                    <form method="POST" action="{{route('runs.update', $run->id)}}" autocomplete="off">
                    <input type="hidden" name="_method" value="PATCH">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input id="editrun" type="text" name="date" class="form-control" value={{old('date', $run->date)}}>
                        </div>
                       
                        <div class="form-group">
                            <label for="miles">Miles</label>
                            <input type="text" name="miles" class="form-control" value={{old('miles', $run->miles)}}>
                        </div>

                        <div class="form-group">
                            <label for="hours">Hours</label>
                            <input type="tel" name="hours" class="form-control" maxlength="2" value={{old('hours', $run->hours)}}>
                        </div>

                        <div class="form-group">
                            <label for="minutes">Minutes</label>
                            <input type="tel" name="minutes" class="form-control" maxlength="2" value={{old('minutes', $run->minutes)}}>
                        </div>

                        <div class="form-group">
                            <label for="seconds">Seconds</label>
                            <input type="tel" name="seconds" class="form-control" maxlength="2" value={{old('seconds', $run->seconds)}}>
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
