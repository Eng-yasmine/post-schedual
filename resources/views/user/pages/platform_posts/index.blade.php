@extends('user.layouts.app')
@section('title', 'Platform Posts Status')
@section('header_title', 'Platform Posts Status List')

@section('user_content')

    <div class="container my-5">
        @include('inc.message')

        <h2 class="mb-4 text-center">Platform Posts Status List</h2>

        <div class="mb-3 text-end">
            <a href="{{ route('platform_posts.create') }}" class="btn btn-success">Add New Platform Post Status</a>
        </div>

        @if($platformPosts->count())
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Post Title</th>
                        <th>Platform Name</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($platformPosts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->post->title ?? 'N/A' }}</td>
                            <td>{{ $item->platform->name ?? 'N/A' }}</td>
                            <td>
                                @if($item->platform_status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($item->platform_status == 'published')
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span>{{ $item->platform_status }}</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('platform_posts.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <form action="{{ route('platform_posts.destroy', $item->id) }}" method="POST"
                                    style="display:inline-block" onsubmit="return confirm('Are you sure to delete this status?')">
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
                {{ $platformPosts->links() }}
            </div>

        @else
            <p class="text-center">No platform post statuses found.</p>
        @endif
    </div>

@endsection
