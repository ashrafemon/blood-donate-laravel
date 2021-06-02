@extends('layouts.auth')

@section('content')
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Blood Donate Admin Authenticate</h5>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label for="">Email*</label>
                    <input type="email" name="email" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="">Password*</label>
                    <input type="password" name="password" class="form-control" />
                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary px-5">Login</button>
            </div>
        </div>
    </form>
@endsection
