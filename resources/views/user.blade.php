@extends('common.main')
@section('title', 'User Registration')
@section('content3')

    <style>
        /* Premium Modern UI Styling */
        body {
            background-color: #f8fafc;
            color: #334155;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        /* Beautiful Gradient Heading */
        .page-title {
            font-size: 2.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.025em;
        }

        /* Card container styling */
        .user-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .user-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Form Controls */
        .form-label {
            color: #475569;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: #1e293b;
            transition: all 0.2s ease-in-out;
            background-color: #f8fafc;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
            outline: 0;
        }

        /* Modern Gradient Button */
        .btn-submit {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(13, 110, 253, 0.2), 0 2px 4px -1px rgba(13, 110, 253, 0.1);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #0b5ed7 0%, #0bacd2 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(13, 110, 253, 0.3), 0 4px 6px -2px rgba(13, 110, 253, 0.15);
            color: white;
        }

        .btn-submit:active {
            transform: translateY(1px);
        }

        /* Custom Modern Table */
        .custom-table-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .custom-table {
            margin-bottom: 0;
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .custom-table td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .custom-table tbody tr:last-child td {
            border-bottom: none;
        }

        .custom-table tbody tr {
            transition: background-color 0.2s ease;
        }

        .custom-table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* User ID badge */
        .badge-id {
            background-color: #e0f2fe;
            color: #0369a1;
            font-weight: 700;
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            font-size: 0.8rem;
        }

        /* Success & Error Alert styling */
        .alert-custom-success {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            border-radius: 12px;
            padding: 1rem 1.25rem;
        }

        .alert-custom-danger {
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
        }
    </style>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">

                <div class="text-center mb-5">
                    <h2 class="page-title">User Registration Center</h2>
                    <p class="text-muted">Register a new user to store their records in the MySQL database.</p>
                </div>

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-custom-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
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
                    {{-- Left side: Registration Form --}}
                    <div class="col-lg-5">
                        <div class="user-card p-4">
                            <h4 class="fw-bold mb-4 text-dark d-flex align-items-center">
                                <i class="bi bi-person-plus-fill me-2 text-primary"></i> Create User Account
                            </h4>
                            
                            <form method="POST" action="{{ route('user.submit') }}">
                                @csrf

                                {{-- Validation Errors --}}
                                @if($errors->any())
                                    <div class="mb-3">
                                        @foreach($errors->all() as $error)
                                            <div class="alert alert-custom-danger d-flex align-items-center" role="alert">
                                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                <div>{{ $error }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="inputFirstName" class="form-label fw-semibold">First Name</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                               id="inputFirstName" name="first_name" value="{{ old('first_name') }}" 
                                               placeholder="Enter first name">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="inputMiddleName" class="form-label fw-semibold">Middle Name</label>
                                        <input type="text" class="form-control @error('middle_name') is-invalid @enderror" 
                                               id="inputMiddleName" name="middle_name" value="{{ old('middle_name') }}" 
                                               placeholder="Enter middle name">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="inputLastName" class="form-label fw-semibold">Last Name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                               id="inputLastName" name="last_name" value="{{ old('last_name') }}" 
                                               placeholder="Enter last name">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputEmail" class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="inputEmail" name="email" value="{{ old('email') }}" 
                                           placeholder="Enter email address">
                                    <div class="form-text text-muted small mt-1">
                                        <i class="bi bi-shield-lock-fill me-1"></i> Data will be securely saved.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="inputPassword" class="form-label fw-semibold">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="inputPassword" name="password" 
                                           placeholder="Enter secure password">
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-submit">
                                        <i class="bi bi-person-check-fill me-1"></i> Register User
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Right side: Users Table --}}
                    <div class="col-lg-7">
                        <h4 class="fw-bold mb-4 text-dark d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-people-fill me-2 text-primary"></i> Registered Users</span>
                            <span class="badge bg-secondary-soft text-primary fs-6 fw-normal px-3 py-1 bg-light rounded-pill">Database Connected</span>
                        </h4>

                        @if(isset($users) && count($users) > 0)
                            <div class="custom-table-container">
                                <div class="table-responsive">
                                    <table class="custom-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 80px;">ID</th>
                                                <th>Full Name</th>
                                                <th>Email Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td><span class="badge-id">#{{ $user->id }}</span></td>
                                                    <td>
                                                        <div class="fw-bold text-dark">
                                                            {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
                                                        </div>
                                                    </td>
                                                    <td class="text-secondary">{{ $user->email }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="text-center p-5 bg-white border border-dashed rounded-3">
                                <i class="bi bi-people text-muted fs-1 mb-3 d-block"></i>
                                <h5 class="text-secondary fw-semibold">No Registered Users Yet</h5>
                                <p class="text-muted small mb-0">Use the registration form on the left to add users directly into the MySQL database.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
