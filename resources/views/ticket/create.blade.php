@extends('dashboard.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Create ticket</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('ticket.store') }}">
                            @csrf

                            <div class="form-group m-3 row">
                                <label for="name" class="col-sm-6 col-form-label">ticket Name <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <input type="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group m-3 row">
                                <div class="text-center mx-auto">
                                    <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">
                                        <i class="fa fa-arrow-left fa-lg"></i>
                                    </a>
                                    <button type="submit" class="btn btn-outline-primary">Create</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
