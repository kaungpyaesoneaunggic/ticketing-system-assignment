@extends('dashboard.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Edit ticket</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('ticket.update',$ticket->id) }}" enctype="multipart/form-data">
                          @method('put')
                          @csrf
                          
                            {{-- Title Input --}}
                            <div class="form-group m-3 row">
                                <label for="title" class="col-sm-6 col-form-label">Title <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                    <input type="name" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') ?? $ticket->title}}">
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
                                        value="{{ old('description') ?? $ticket->description}}">
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Priority Input --}}
                            <div class="form-group m-3 row">
                                <label for="priority" class="col-sm-6 col-form-label">Priority<small class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                <select type="priority" name="priority" class="form-control" >
                                    {{-- <option value="low">Low</option>
                                    <option value="medium">Mdeium</option>
                                    <option value="high">High</option> --}}
                                    <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                                </div>
                            </div>

                            {{-- Status Input --}}
                            <div class="form-group m-3 row">
                                <label for="status" class="col-sm-6 col-form-label">Status<small class="text-danger">*</small></label>
                                <div class="col-sm-6">
                                {{-- <select type="status" name="status" class="form-control">
                                    <option value="open">Open</option>
                                    <option value="closed">Closed</option>
                                    <option value="pending">Pending</option>
                                </select> --}}
                                <select name="status" class="form-control">
                                  <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                  <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                  <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                              </select>
                              </div>
                            </div>
                            {{-- category input --}}
                            <div class="form-group m-3 row">
                                <label for="categories" class="col-sm-6 col-form-label">Categories<small class="text-danger">*</small></label>
                                <div class="col-lg-8 d-flex flex-row">
                                    @foreach ($categories as $category)
                                    <div class="form-check m-1">
                                        <input class="form-check-input" name="category_ids[]" type="checkbox" value="{{ $category->id }}" id="category{{ $category->id }}" {{ in_array($category->id, $selectedCategoryIds) ? 'checked' : '' }}>
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
                                        <input class="form-check-input" name="label_ids[]" type="checkbox" value="{{ $label->id }}" id="label{{ $label->id }}" {{ in_array($label->id, $selectedLabelIds) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="category{{ $label->id }}">
                                            {{ $label->name }}
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            
                            <div class="form-group m-3 row">
                              <label for="status" class="col-sm-6 col-form-label">Assigened Agent<small class="text-danger">*</small></label>
                              <div class="col-sm-6">
                              <select type="status" name="agent_id" class="form-control">
                                  <option value='0'>-None-</option>
                                  @foreach ($agents as $agent)
                                  <option value='{{ $agent->id }}'>{{ $agent->name }}</option>
                                  @endforeach
                              </select>
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
                                        <i class="fa fa-arrow-left fa-lg py-2"></i>
                                    </a>
                                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                                </div>
                                
                        </form>
                                @if (Auth::user()->role == 0)
                                    <form id="deleteForm{{ $ticket->id }}" action="{{ route('ticket.destroy', $ticket->id) }}" method="post" class="d-inline-block">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $ticket->id }}')"><i class="fa fa-trash p-1"></i></button>
                                    </form>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(ticketId) {
            var result = confirm("Are you sure you want to delete?");
            if (result) {
                // If user clicks OK, submit the form with the corresponding userId
                document.getElementById('deleteForm' + ticketId).submit();
            } else {
                // If user clicks Cancel, do nothing
            }
        }
    </script>
@endsection

