@extends('site.layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="text-success"><b>You are login as User</b></div>
                    <div><a href="{{ route('logout') }}">logout</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
