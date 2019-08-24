@extends('layouts.noheader')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card">
        
                <div class="card-body text-center">
                    <h1 class="mb-4">Track Your Run</h1>
                    <a href="{{url('login/google')}}" class="btn btn-primary mb-1">
                        Login with Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
