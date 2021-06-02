@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Badges</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('badges.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" />

                    @error('name')
                        <div class="small font-weight-bold text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Avatar</label>
                    <input type="file" class="form-control-file" name="avatar" />

                    @error('avatar')
                        <div class="small font-weight-bold text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>

@endsection
