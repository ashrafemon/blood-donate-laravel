@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Badges</h5>
        </div>

        <div class="card-body">
            <div class="text-right mb-3">
                <a href="{{ route('badges.create') }}" class="btn btn-primary btn-sm">Add New</a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Name</td>
                            <td>Avatar</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($badges as $badge)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $badge->name }}</td>
                                <td>
                                    @if ($badge->avatar)
                                        <img style="width: 40px" src="{{ $badge->avatar }}" alt="{{ $badge->name }}">
                                    @else
                                        no image
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('badges.edit', $badge->id) }}"
                                            class="btn btn-warning btn-sm mr-1">Edit</a>
                                        <form action="{{ route('badges.destroy', $badge->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No data found...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
