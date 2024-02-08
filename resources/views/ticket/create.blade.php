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
                        <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            {{-- Title Input --}}
                            <div class="form-group m-3 row">
                                <label for="title" class="col-sm-6 col-form-label">Title <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <input type="name" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Description Input --}}
                            <div class="form-group m-3 row">
                                <label for="description" class="col-sm-6 col-form-label">Description <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <input type="name" name="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        value="{{ old('description') }}">
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Priority Input --}}
                            <div class="form-group m-3 row">
                                <label for="priority" class="col-sm-6 col-form-label">Priority<small class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                <select type="priority" name="priority" class="form-control">
                                    <option value="low">Low</option>
                                    <option value="medium">Mdeium</option>
                                    <option value="high">High</option>
                                </select>
                                </div>
                            </div>

                            {{-- category input --}}
                            <div class="form-group m-3 row">
                                <label for="categories" class="col-sm-6 col-form-label">Categories<small class="text-danger">*</small></label>
                                <div class="col-lg-8 d-flex flex-row">
                                    @foreach ($categories as $category)
                                    <div class="form-check m-1">
                                        <input class="form-check-input" name="category_ids[]" type="checkbox" value="{{ $category->id }}" id="category{{ $category->id }} ">
                                        <label class="form-check-label" for="category{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>

                            {{-- Labels input --}}
                            <div class="form-group m-3 row">
                                <label for="labels" class="col-sm-6 col-form-label">Labels<small class="text-danger">*</small></label>
                                <div class="col-lg-8 d-flex flex-row">
                                    @foreach ($labels as $label)
                                    <div class="form-check m-1">
                                        <input class="form-check-input" name="label_ids[]" type="checkbox" value="{{ $label->id }}" id="label{{ $label->id }}">
                                        <label class="form-check-label" for="category{{ $label->id }}">
                                            {{ $label->name }}
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>


                            {{-- images input --}}
                            <div class="form-group m-3 row">
                                <label for="imgInput" class="col-sm-6 col-form-label @error('images') is-invalid @enderror" value="{{ old('image') }}" >Image<small class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                  <input class="form-control-file" type="file" id="images" name="images[]" multiple>
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
