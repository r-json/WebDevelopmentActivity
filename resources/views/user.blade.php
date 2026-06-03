@extends('common.main')
@section('title', isset($editUser) ? 'Edit User' : 'User Registration')
@section('meta_description', 'Create and manage user accounts. View registered users and their information.')
@section('content3')

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">

            {{-- Animated Page Header --}}
            <div class="text-center mb-5 user-page-header">
                <h1 class="user-page-title mb-2">User Management Center</h1>
                <p class="text-muted">Register new users and manage existing accounts in the system.</p>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert user-alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert" id="userSuccessAlert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                        <div>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert user-alert-error alert-dismissible fade show mb-4 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                        <div>
                            <strong>Error!</strong> {{ session('error') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                {{-- Left side: Registration / Edit Form --}}
                <div class="col-lg-4 col-md-5">
                    <div class="user-form-card p-4">
                        <h2 class="h4 fw-bold mb-4 text-dark d-flex align-items-center">
                            @if(isset($editUser))
                                <i class="bi bi-pencil-square me-2 text-primary"></i> Edit User
                            @else
                                <i class="bi bi-person-plus-fill me-2 text-primary"></i> Create User
                            @endif
                        </h2>

                        <form method="POST"
                              action="{{ isset($editUser) ? route('user.update', $editUser->id) : route('user.submit') }}"
                              id="userForm" novalidate>
                            @csrf
                            @if(isset($editUser))
                                @method('PUT')
                            @endif

                            {{-- Validation Errors --}}
                            @if($errors->any())
                                <div class="mb-3">
                                    @foreach($errors->all() as $error)
                                        <div class="alert user-alert-error d-flex align-items-center" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                            <div>{{ $error }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mb-3 form-group-animated">
                                <label for="inputFirstName" class="form-label fw-semibold">First Name</label>
                                <input type="text"
                                       class="form-control @error('first_name') is-invalid @enderror"
                                       id="inputFirstName"
                                       name="first_name"
                                       value="{{ old('first_name', isset($editUser) ? $editUser->first_name : '') }}"
                                       placeholder="Enter first name"
                                       required>
                            </div>

                            <div class="mb-3 form-group-animated">
                                <label for="inputMiddleName" class="form-label fw-semibold">Middle Name</label>
                                <input type="text"
                                       class="form-control @error('middle_name') is-invalid @enderror"
                                       id="inputMiddleName"
                                       name="middle_name"
                                       value="{{ old('middle_name', isset($editUser) ? $editUser->middle_name : '') }}"
                                       placeholder="Enter middle name"
                                       required>
                            </div>

                            <div class="mb-3 form-group-animated">
                                <label for="inputLastName" class="form-label fw-semibold">Last Name</label>
                                <input type="text"
                                       class="form-control @error('last_name') is-invalid @enderror"
                                       id="inputLastName"
                                       name="last_name"
                                       value="{{ old('last_name', isset($editUser) ? $editUser->last_name : '') }}"
                                       placeholder="Enter last name"
                                       required>
                            </div>

                            <div class="mb-3 form-group-animated">
                                <label for="inputEmail" class="form-label fw-semibold">Email Address</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="inputEmail"
                                       name="email"
                                       value="{{ old('email', isset($editUser) ? $editUser->email : '') }}"
                                       placeholder="Enter email address"
                                       required>
                                <div class="form-text text-muted small mt-1">
                                    <i class="bi bi-shield-lock-fill me-1"></i> Data will be securely saved.
                                </div>
                            </div>

                            {{-- Password — only shown in Create mode --}}
                            @if(!isset($editUser))
                                <div class="mb-3 form-group-animated">
                                    <label for="inputPassword" class="form-label fw-semibold">Password</label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="inputPassword"
                                           name="password"
                                           placeholder="Enter secure password"
                                           required>
                                </div>
                            @endif

                            <div class="mb-4 form-group-animated">
                                <label for="inputUserType" class="form-label fw-semibold">User Type</label>
                                <select class="form-select @error('user_type') is-invalid @enderror"
                                        name="user_type"
                                        id="inputUserType"
                                        required>
                                    <option selected disabled value="">-- Select User Type --</option>
                                    @foreach($userTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('user_type', isset($editUser) ? $editUser->user_type_id : '') == $type->id ? 'selected' : '' }}>
                                            {{ $type->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_type')
                                    <div class="invalid-feedback" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-user-submit" id="userSubmitBtn">
                                    <span class="btn-text">
                                        @if(isset($editUser))
                                            <i class="bi bi-check-lg me-1"></i> Update User
                                        @else
                                            <i class="bi bi-person-check-fill me-1"></i> Register User
                                        @endif
                                    </span>
                                    <span class="btn-loading d-none">
                                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                        {{ isset($editUser) ? 'Updating…' : 'Registering…' }}
                                    </span>
                                </button>
                                @if(isset($editUser))
                                    <a href="/user" class="btn btn-outline-secondary">
                                        <i class="bi bi-x-lg me-1"></i> Cancel
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Right side: User Cards --}}
                <div class="col-lg-8 col-md-7">
                    <div class="user-cards-section">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h2 class="h4 fw-bold text-dark d-flex align-items-center mb-0">
                                <i class="bi bi-people-fill me-2 text-primary"></i> Registered Users
                            </h2>
                            <span class="user-count-badge">{{ count($users ?? []) }} {{ Str::plural('user', count($users ?? [])) }}</span>
                        </div>

                        @if(isset($users) && count($users) > 0)
                            <div class="row g-3">
                                @foreach($users as $user)
                                    <div class="col-md-6 col-xl-6">
                                        <div class="user-card-item">
                                            <div class="d-flex align-items-start gap-3">
                                                {{-- Avatar with Initials --}}
                                                <div class="user-avatar">
                                                    {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                                                </div>

                                                {{-- User Info --}}
                                                <div class="user-info">
                                                    <div class="user-name">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</div>
                                                    <div class="user-email"><i class="bi bi-envelope me-1"></i>{{ $user->email }}</div>

                                                    <div class="d-flex align-items-center gap-2 mt-2">
                                                        @if($user->user_type_name)
                                                            @php $typeName = $user->user_type_name; @endphp
                                                            <span class="badge-user-type badge-type-{{ $typeName }}">
                                                                @if($typeName === 'admin')
                                                                    <i class="bi bi-shield-fill-check"></i>
                                                                @elseif($typeName === 'faculty')
                                                                    <i class="bi bi-mortarboard-fill"></i>
                                                                @elseif($typeName === 'staff')
                                                                    <i class="bi bi-briefcase-fill"></i>
                                                                @elseif($typeName === 'student')
                                                                    <i class="bi bi-book-fill"></i>
                                                                @elseif($typeName === 'user')
                                                                    <i class="bi bi-person-fill"></i>
                                                                @elseif($typeName === 'guest')
                                                                    <i class="bi bi-person-badge"></i>
                                                                @endif
                                                                {{ $user->user_type_display_name }}
                                                            </span>
                                                        @else
                                                            <span class="badge-user-type badge-type-guest">
                                                                <i class="bi bi-question-circle"></i> Unassigned
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Card Footer Meta --}}
                                            <div class="user-card-meta mt-3 pt-2 border-top d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="meta-item me-3">
                                                        <i class="bi bi-hash"></i> ID: {{ $user->id }}
                                                    </span>
                                                    @if($user->created_at)
                                                        <span class="meta-item">
                                                            <i class="bi bi-calendar3"></i>
                                                            {{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                {{-- Edit Button --}}
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                   class="btn-user-edit"
                                                   title="Edit {{ $user->first_name }}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="user-empty-state">
                                <i class="bi bi-people"></i>
                                <h5 class="text-secondary fw-semibold">No Registered Users Yet</h5>
                                <p class="text-muted small mb-0">Use the registration form on the left to add users to the system.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Micro-interactions --}}
<script>
    // Prevent double-submit and show loading spinner
    document.getElementById('userForm').addEventListener('submit', function () {
        var btn = document.getElementById('userSubmitBtn');
        btn.querySelector('.btn-text').classList.add('d-none');
        btn.querySelector('.btn-loading').classList.remove('d-none');
        btn.disabled = true;
    });

    // Auto-dismiss success alert after 5 seconds with smooth exit
    document.addEventListener('DOMContentLoaded', function () {
        var alert = document.getElementById('userSuccessAlert');
        if (alert) {
            setTimeout(function () {
                alert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-12px)';
                setTimeout(function () { alert.remove(); }, 400);
            }, 5000);
        }

        // Focus animation — label color change
        document.querySelectorAll('.form-group-animated .form-control, .form-group-animated .form-select').forEach(function (input) {
            var label = input.closest('.form-group-animated').querySelector('.form-label');
            input.addEventListener('focus', function () {
                if (label) label.style.color = '#0d6efd';
            });
            input.addEventListener('blur', function () {
                if (label) label.style.color = '';
            });
        });
    });
</script>

@endsection
