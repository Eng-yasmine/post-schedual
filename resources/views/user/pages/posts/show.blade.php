@extends('user.layouts.app')
@section('title', 'Show Post')
@section('header_title', 'Post of User ')

@section('user_content')

    <div class="container my-5">
        @include('inc.message')

        <h2 class="mb-4 text-center">Post Details</h2>

        <div class="card h-100 shadow-sm">
            {{-- @dd($post->getFirstMediaUrl('posts')) --}}
            @if($post->hasMedia('posts'))
                <img src="{{  $post->getFirstMediaUrl('posts')}}" alt="Post Image">

            @else
                <p>No image available</p>
            @endif

            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
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
            </div>

            <div class="card-footer text-muted text-end">
                Created at: {{ $post->created_at->format('d M Y - H:i') }}
            </div>
        </div>

    </div>

@endsection
