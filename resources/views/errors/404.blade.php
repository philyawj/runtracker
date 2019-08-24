@extends('layouts.noheader')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-12">
            <div class="card">
        
                <div class="card-body text-center">
                    <h1 class="mb-4">Something Went Wrong</h1>
                    <a href="{{url('/')}}" class="btn btn-primary mb-1">
                        Return Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
