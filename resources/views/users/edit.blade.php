@extends('dashboard.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Update User</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @method('put')
                            @csrf
                            <div class="form-group m-3 row">
                                <label for="name" class="col-sm-6 col-form-label">User Name <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <input type="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') ?? $user->name }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group m-3 row">
                                <label for="email" class="col-sm-6 col-form-label">User Email <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') ?? $user->email }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group m-3 row">
                                <label for="password" class="col-sm-6 col-form-label">Password <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6 input-group">
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        value="{{ old('password') ?? decrypt($user->password) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-eye" id="togglePassword"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group m-3 row">
                                <label for="password_confirmation" class="col-sm-6 col-form-label">Confirm Password <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6 input-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        value="{{ old('password_confirmation') ?? decrypt($user->password) }}">
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group m-3 row">
                                <label for="password" class="col-sm-6 col-form-label">Role <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" value="0" type="radio" name="role"
                                            id="flexRadioDefault1" {{ old('role', $user->role) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Admin User
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="1" type="radio" name="role"
                                            id="flexRadioDefault2" {{ old('role', $user->role) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Agent User
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="2" type="radio" name="role"
                                            id="flexRadioDefault3" {{ old('role', $user->role) == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Regular User
                                        </label>
                                    </div>
                                    @error('role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group m-3 row">
                                <div class="text-center mx-auto">
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-dark">
                                        <i class="fa fa-arrow-left fa-lg"></i>
                                    </a>
                                    <button type="submit" class="btn btn-outline-primary">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const password_confirmation = document.querySelector('#password_confirmation');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            password_confirmation.setAttribute('type', type);
            // toggle the eye icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
