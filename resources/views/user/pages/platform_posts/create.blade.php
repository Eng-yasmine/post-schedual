@extends('user.layouts.app')
@section('title', 'ADD Platform')
@section('header_title', 'ADD Patform')

@section('user_content')

    <div class="container my-5">
        @include('inc.message')
        <h2 class="mb-4 text-center">Create Post </h2>
        <form id="postForm" action="{{ route('platform_posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="status" class="form-label">Platform post Status</label>
                <select name="platform_status" id="status" class="form-control" required>
                    <option value="">Choose Platform post</option>
                    <option value="pending">pending</option>
                    <option value="published">published</option>

                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Add Platform status</button>
        </form>
    </div>



@endsection

