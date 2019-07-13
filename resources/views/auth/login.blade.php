@extends('layouts.noheader')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body text-center">
                    <a href="{{url('login/google')}}" class="btn btn-primary">
                        Login with Google
                    </a>
                    <h1>get rid of this page</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
