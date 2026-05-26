@extends('common.main')
@section('title', 'Post Management')
@section('meta_description', 'Create and manage posts. View existing submissions and their status.')
@section('content3')

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- Animated Page Header --}}
                <div class="text-center mb-5 page-header">
                    <h1 class="page-title mb-2">Post Creation Panel</h1>
                    <p class="page-subtitle">Fill in the details to publish a new post. Submissions will be logged accordingly.</p>
                </div>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-custom-success alert-dismissible fade show mb-4 shadow-sm" role="alert" id="successAlert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row g-4">
                    {{-- Left side: Post Form --}}
                    <div class="col-lg-5 col-md-6">
                        <div class="post-card p-4">
                            <h2 class="h4 fw-bold mb-4 text-dark d-flex align-items-center">
                                <i class="bi bi-file-earmark-plus me-2 text-primary"></i> Create Post
                            </h2>

                            <form method="POST" action="{{ route('post.store') }}" id="postForm" novalidate>
                                @csrf

                                <div class="mb-4 form-group-animated">
                                    <label for="inputTitle" class="form-label fw-semibold">Title</label>
                                    <input type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="inputTitle"
                                           name="title"
                                           value="{{ old('title') }}"
                                           placeholder="Enter post title"
                                           aria-describedby="titleError"
                                           @error('title') aria-invalid="true" @enderror
                                           required>
                                    @error('title')
                                        <div id="titleError" class="invalid-feedback" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4 form-group-animated">
                                    <label for="inputDescription" class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="inputDescription"
                                              name="description"
                                              rows="5"
                                              placeholder="Enter detailed description"
                                              aria-describedby="descError"
                                              @error('description') aria-invalid="true" @enderror
                                              required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div id="descError" class="invalid-feedback" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-submit" id="submitBtn">
                                        <span class="btn-text">
                                            <i class="bi bi-send-fill me-1"></i> Submit Post
                                        </span>
                                        <span class="btn-loading d-none">
                                            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                            Submitting…
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Right side: Posts Table --}}
                    <div class="col-lg-7 col-md-6">
                        <div class="custom-table-container">
                            <div class="custom-table-header">
                                <h2 class="h4 fw-bold text-dark d-flex align-items-center mb-0">
                                    <i class="bi bi-table me-2 text-primary"></i> Existing Posts
                                </h2>
                                <span class="post-count">{{ count($posts ?? []) }} {{ Str::plural('post', count($posts ?? [])) }}</span>
                            </div>
                            <div class="table-responsive">
                                <table class="custom-table" aria-label="Existing posts">
                                    <caption class="visually-hidden">List of all submitted posts with their title, description, author, and status</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($posts) && count($posts) > 0)
                                            @foreach($posts as $post)
                                                <tr>
                                                    <td class="fw-bold text-dark">{{ $post->title }}</td>
                                                    <td class="text-secondary small description-cell" title="{{ $post->description }}">{{ $post->description }}</td>
                                                    <td><span class="text-dark fw-medium">{{ $post->created_by }}</span></td>
                                                    <td>
                                                        @if($post->status === 'published')
                                                            <span class="badge-status badge-status-published"><i class="bi bi-check-circle-fill"></i> Published</span>
                                                        @elseif($post->status === 'draft')
                                                            <span class="badge-status badge-status-draft"><i class="bi bi-pencil-fill"></i> Draft</span>
                                                        @else
                                                            <span class="badge-status badge-status-archived"><i class="bi bi-archive-fill"></i> {{ ucfirst($post->status) }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4">
                                                    <div class="empty-state">
                                                        <i class="bi bi-folder-x"></i>
                                                        <p>No posts yet. Create your first one!</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Micro-interactions --}}
    <script>
        // Prevent double-submit and show loading spinner
        document.getElementById('postForm').addEventListener('submit', function () {
            var btn = document.getElementById('submitBtn');
            btn.querySelector('.btn-text').classList.add('d-none');
            btn.querySelector('.btn-loading').classList.remove('d-none');
            btn.disabled = true;
        });

        // Auto-dismiss success alert after 5 seconds with smooth exit
        document.addEventListener('DOMContentLoaded', function () {
            var alert = document.getElementById('successAlert');
            if (alert) {
                setTimeout(function () {
                    alert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-12px)';
                    setTimeout(function () { alert.remove(); }, 400);
                }, 5000);
            }

            // Live character counter for description
            var desc = document.getElementById('inputDescription');
            if (desc) {
                var counter = document.createElement('div');
                counter.className = 'form-text text-end mt-1';
                counter.style.transition = 'color 0.2s ease';
                counter.id = 'charCounter';
                desc.parentNode.appendChild(counter);

                function updateCounter() {
                    var len = desc.value.length;
                    counter.textContent = len + ' characters';
                    counter.style.color = len > 500 ? '#ef4444' : '#94a3b8';
                }
                desc.addEventListener('input', updateCounter);
                updateCounter();
            }

            // Focus animation — label color change
            document.querySelectorAll('.form-group-animated .form-control').forEach(function (input) {
                var label = input.closest('.form-group-animated').querySelector('.form-label');
                input.addEventListener('focus', function () {
                    if (label) label.style.color = '#4f46e5';
                });
                input.addEventListener('blur', function () {
                    if (label) label.style.color = '';
                });
            });
        });
    </script>

@endsection
