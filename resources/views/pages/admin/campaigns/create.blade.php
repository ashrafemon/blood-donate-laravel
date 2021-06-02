@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Campaigns</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" />

                    @error('title')
                        <div class="small font-weight-bold text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" class="form-control-file" name="image" />

                    @error('image')
                        <div class="small font-weight-bold text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Held On</label>
                    <input type="date" class="form-control" name="held_on" />

                    @error('held_on')
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
