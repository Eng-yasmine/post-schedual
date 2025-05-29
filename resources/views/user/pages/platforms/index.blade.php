@extends('Admin.layouts.app')

@section('content')

<div class="container my-5">
    @include('inc.message')

    <h2 class="mb-4 text-center">Platforms List</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('platforms.create') }}" class="btn btn-success">Add New Platform</a>
    </div>

    @if($platforms->count())
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Platform Name</th>
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
                    <td>{{ ucfirst($platform->type) }}</td>
                    <td>{{ $platform->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('platforms.edit', $platform->id) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ route('platforms.destroy', $platform->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure to delete this platform?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $platforms->links() }}
        </div>
    @else
        <p class="text-center">No platforms found.</p>
    @endif

</div>

@endsection
