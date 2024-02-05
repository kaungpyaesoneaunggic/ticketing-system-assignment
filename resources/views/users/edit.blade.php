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
                                        value="{{  old('name') ?? $user->name }}">
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
                                <div class="col-sm-6">
                                    <input type="password" name="password"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('password') ?? $user->password  }}">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group m-3 row">
                              <label for="password" class="col-sm-6 col-form-label">Password <small
                                      class="text-danger">*</small></label>
                              <div class="col-sm-6  ">
                                <div class="form-check">
                                  <input class="form-check-input" value=0 type="radio" name="role" id="flexRadioDefault2" checked>
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Admin User
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" value=1 type="radio" name="role" id="flexRadioDefault1">
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    Agent User
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" value=2 type="radio" name="role" id="flexRadioDefault2" checked>
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Regular User
                                  </label>
                                </div>
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
@endsection
