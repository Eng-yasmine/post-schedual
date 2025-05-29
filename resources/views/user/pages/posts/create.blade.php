@extends('user.layouts.app')
@section('title', 'Create Post')
@section('header_title', 'Create Post')

@section('user_content')

    <div class="container my-5">
        @include('inc.message')
        <h2 class="mb-4 text-center">Create Post </h2>
        <form id="postForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" required placeholder=" type post Title " />
            </div>


            <div class="mb-3">
                <label for="content" class="form-label">Post Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required
                    placeholder="  type Post Content"></textarea>
                <div id="charCount" class="form-text text-end"> max 1000 char </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Image (Optinal)</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*" />
            </div>

            <div class="mb-3">
                <label for="platforms" class="form-label">Choose Platforms</label>
                <select name="platforms[]" id="platforms" class="form-control" multiple>
                    @foreach($platforms as $platform)
                        <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">Choose Status</option>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="schedualed">Schedualed</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="schedualed_time" class="form-label">Schedualed Time</label>
                <input type="datetime-local" class="form-control" name="schedualed_time" id="schedualed_time">
            </div>


            <button type="submit" class="btn btn-primary w-100">Create Post</button>
        </form>
    </div>



@endsection
