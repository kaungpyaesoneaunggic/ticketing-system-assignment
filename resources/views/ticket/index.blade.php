@extends('dashboard.index')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card p-2">
                <div class="card-header text-center">
                    <h3>Tickets Solution</h3>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            {{ session('success') }}
                            <button class="close alert-dismissible" data-dismiss="alert"><i class="fa fa-x"></i></button>
                        </div>
                        @endif
                    @if(session('update'))
                        <div class="alert alert-primary alert-dismissible">
                            {{ session('update') }}
                            <button class="close alert-dismissible" data-dismiss="alert"><i class="fa fa-x"></i></button>
                        </div>
                        @endif
                    @if(session('delete'))
                        <div class="alert alert-danger alert-dismissible">
                            {{ session('delete') }}
                            <button class="close alert-dismissible" data-dismiss="alert"><i class="fa fa-x"></i></button>
                        </div>
                        @endif
                </div class='container'>
                    <table class="table text-center" class="mx-5">
                      <thead>
                        @php
                          $num=1
                        @endphp
                        
                        <tr>
                          <th>#</th>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Priority</th>
                          <th>Status</th>
                          <th>Label</th>
                          <th>Categories</th>
                          <th>Images</th>
                          <th>add comment</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tickets as $ticket)
                        <tr class="text-center">
                          <th>{{ $num++ }}</th>
                          <th scope="row">id - {{ $ticket->id }}</td>
                          <td>{{ $ticket->title }}</td>
                          <td class="text-truncate">{{ \Illuminate\Support\Str::limit($ticket->description, 30) }}</td>
                          <td>{{ $ticket->priority }}</td>
                          <td>{{ $ticket->status }}</td>
                          <td>
                            @foreach ($ticketLabelIds[$ticket->id] as $labelId)
                            @php
                              $label=\App\Models\Label::find($labelId);
                            @endphp
                                {{ $label->name }},
                            @endforeach
                          </td>
                          <td>
                            @foreach ($ticketCategoryIds[$ticket->id] as $categoryId)
                            @php
                            $category=\App\Models\Category::find($categoryId);
                          @endphp
                              {{ $category->name }},
                            @endforeach
                          </td>
                          <td>
                            @foreach ($ticketImages[$ticket->id] as $image)
                            <img src="{{ asset('storage/gallery/' . $image) }}" width="80px" height="40px" style="object-fit: contain">
                            @endforeach
                          </td>
                          <td>
                            <a type="button" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-comment"></i></a>
                            @if (Auth::user()->role != 2)
                            <a type="button" href='{{ route('ticket.edit',$ticket->id) }}' class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-edit"></i></a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    
                </div>
          </div>
    </div>
</div>
<script>
  setTimeout(function() {
        $(".alert").alert('close');
    }, 4000);
  
</script>
@endsection