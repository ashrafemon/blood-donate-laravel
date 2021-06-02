@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Campaigns</h5>
        </div>

        <div class="card-body">
            <div class="text-right mb-3">
                <a href="{{ route('campaigns.create') }}" class="btn btn-primary btn-sm">Add New</a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Name</td>
                            <td>Image</td>
                            <td>Held On</td>
                            <td>Created By</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($campaigns as $campaign)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $campaign->title }}</td>
                                <td>
                                    @if ($campaign->image)
                                        <img style="width: 100px" src="{{ $campaign->image }}"
                                            alt="{{ $campaign->title }}">
                                    @else
                                        file not found
                                    @endif
                                </td>
                                <td>{{ $campaign->held_on }}</td>
                                <td>{{ $campaign->user->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        {{-- <a href="{{ route('campaigns.edit', $badge->id) }}"
                                            class="btn btn-warning btn-sm mr-1">Edit</a> --}}
                                        <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No data found...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
