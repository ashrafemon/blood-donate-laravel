@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Blood Groups</h5>
        </div>

        <div class="card-body">
            <div class="text-right mb-3">
                <a href="{{ route('blood_groups.create') }}" class="btn btn-primary btn-sm">Add New</a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blood_groups as $group)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $group->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('blood_groups.edit', $group->id) }}"
                                            class="btn btn-warning btn-sm mr-1">Edit</a>
                                        <form action="{{ route('blood_groups.destroy', $group->id) }}" method="POST">
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
