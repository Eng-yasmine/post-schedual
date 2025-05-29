@extends('user.layouts.app')
@section('title', 'Create Post')
@section('header_title', 'Post of Users ')

@section('user_content')

<div class="container my-5">
    @include('inc.message')
    <h2 class="mb-4 text-center">ALL Posts</h2>

    @if($posts->count())
        <div class="d-flex flex-column gap-4">
            @foreach($posts as $post)
                <div class="card shadow-sm">
                    {{-- استخدام hasMedia وليس hasMediaUrl --}}
                    @if($post->hasMedia('posts'))
                        <img src="{{ $post->getFirstMediaUrl('posts') }}" class="card-img-top" alt="Post Image">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->content, 200) }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($post->status) }}</p>
                        @if($post->scheduled_time)
                            <p><strong>Scheduled for:</strong> {{ $post->scheduled_time->format('d M Y - H:i') }}</p>
                        @endif

                        <p>
                            <strong>Platforms:</strong>
                            @foreach($post->platforms as $platform)
                                <span class="badge bg-info text-dark">{{ $platform->type }}</span>
                            @endforeach
                        </p>

                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary btn-sm mt-2">View Details</a>
                    </div>

                    <div class="card-footer text-muted text-end">
                        Created at: {{ $post->created_at->format('d M Y - H:i') }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            You haven't created any posts yet.
        </div>
    @endif
</div>

@endsection
