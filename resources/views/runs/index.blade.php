@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">date</th>
                                    <th scope="col">miles</th>
                                    <th scope="col">time</th>
                                    <th scope="col">mph</th>
                                    <th scope="col">notes</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            
                            @foreach($runs as $run)

                                <tr>
                                    <td><a href="{{route('runs.edit', $run->id)}}">{{date("m/d/Y", strtotime($run->date))}}</a></td>
                                    <td>{{$run->miles}}</td>
                                    <td>{{date("H:i:s", $run->seconds)}}</td>
                                    <td>{{$run->mph}}</td>
                                    <td>{{$run->notes}}</td>
                                </tr>

                            @endforeach

                            </tbody>
                    </table>

                    {{ $runs->links() }}

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
