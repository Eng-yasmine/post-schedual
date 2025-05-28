@extends('user.layouts.app')
@section('title', 'Create Post')
@section('header_title', 'Edit Post')

@section('user_content')

    <div class="container my-5">
        @include('inc.message')
        <h2 class="mb-4 text-center">Create Post </h2>
        <form id="postForm" action="{{ route('posts.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                <label class="form-label">Choose Platform </label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="twitter" id="platformTwitter"
                        name="platforms[]" />
                    <label class="form-check-label" for="platformTwitter">twitter</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="instagram" id="platformInstagram"
                        name="platforms[]" />
                    <label class="form-check-label" for="platformInstagram">instagram</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="linkedin" id="platformLinkedin"
                        name="platforms[]" />
                    <label class="form-check-label" for="platformLinkedin">linkedin</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">Choose Status</option>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="scheduled">Scheduled</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="scheduled_time" class="form-label">Scedual Time</label>
                <input type="datetime-local" class="form-control" id="scheduled_time" name="scheduled_time" />
            </div>


            <button type="submit" class="btn btn-primary w-100">Create Post</button>
        </form>
    </div>



@endsection
@section('scripts')
    <script>

        const contentInput = document.getElementById('content');
        const charCount = document.getElementById('charCount');
        const maxChars = 280;

        contentInput.addEventListener('input', () => {
            const currentLength = contentInput.value.length;
            charCount.textContent = `${currentLength} / ${maxChars} حرف`;
            if (currentLength > maxChars) {
                charCount.classList.add('text-danger');
            } else {
                charCount.classList.remove('text-danger');
            }
        });
    </script>
@endsection
