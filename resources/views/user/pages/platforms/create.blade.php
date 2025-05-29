@extends('Admin.layouts.app')


@section('content')

<div class="container my-5">
    @include('inc.message')
    <h2 class="mb-4 text-center">Create Platform </h2>
    <form id="postForm" action="{{ route('platforms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Platform Name</label>
            <input type="text" class="form-control" id="title" name="name" required placeholder="Type platform name" />
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Platform Type</label>
            <select name="type" id="status" class="form-control" required>
                <option value="">Choose Platform</option>
                <option value="twitter">twitter</option>
                <option value="linkedin">linkedin</option>
                <option value="instagram">instagram</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Add Platform</button>
    </form>
</div>

@if($platforms->count())
    <div class="container my-5">
        <h3 class="mb-3 text-center">List of Platforms</h3>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($platforms as $platform)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $platform->name }}</td>
                        <td>{{ $platform->type }}</td>
                        <td>{{ $platform->created_at->format('d M Y - H:i') }}</td>
                        <td>
                            <a href="{{ route('platforms.edit', $platform->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('platforms.destroy', $platform->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this platform?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="text-center mt-4">
        <p>No platforms added yet.</p>
    </div>
@endif

@endsection
