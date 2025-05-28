@extends('user.layouts.app')
@section('title', 'Create Post')
@section('header_title', 'Edit Patform')

@section('user_content')

    <div class="container my-5">
        @include('inc.message')
        <h2 class="mb-4 text-center">Create Post </h2>
        <form id="postForm" action="{{ route('platforms.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Platform Name</label>
                <input type="text" class="form-control" id="title" name="name" required placeholder=" type post Title " />
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Platforms</label>
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



@endsection
@section('scripts')

@endsection
