@extends('layouts.noheader')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card">
        
                <div class="card-body text-center">
                    <h1>Run Tracker</h1>
                    <p class="lead">Welcome to Run Tracker. Create a new account or sign back in by clicking the button below.</p>
                    <a href="{{url('login/google')}}" class="btn btn-primary">
                        Login with Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
