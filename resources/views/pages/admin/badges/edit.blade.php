@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Badges</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('badges.update', $badge->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $badge->name }}" />

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
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection
