@extends('Admin.layouts.app')


@section('content')

    <div class="container my-5">
        <h2 class="mb-4 text-center">All Users Posts (Table View)</h2>

        @if($posts->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Scheduled Time</th>
                        <th>Platforms</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ ucfirst($post->status) }}</td>
                            <td>
                                @if ($post->schedualed_time)
                                    {{ $post->schedualed_time->format('d M Y - H:i') }}
                                @else
                                    <span class="text-muted">no date found</span>
                                @endif
                            </td>
                            <td>
                                @forelse ($post->platforms as $platform)
                                    <span class="badge bg-secondary">
                                        {{ $platform->name }}
                                        @if ($platform->pivot && $platform->pivot->platform_status)
                                            ({{ $platform->pivot->platform_status }})
                                        @endif
                                    </span>
                                @empty
                                    <span class="text-muted">No platforms</span>
                                @endforelse
                            </td>
                            <td>
                                @if ($post->hasMedia('posts'))
                                    <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="Post Image" width="60">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>
                                @if ($post->created_at)
                                    {{ $post->created_at->format('d M Y - H:i') }}
                                @else
                                    <span class="text-muted">no date</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-info">View</a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- ✅ Pagination --}}
            <div>
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-center text-muted">You don’t have any posts yet.</p>
        @endif
    </div>
@endsection
