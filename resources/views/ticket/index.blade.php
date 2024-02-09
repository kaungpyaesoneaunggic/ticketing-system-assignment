@extends('dashboard.index')

@section('content')
    <style>
        th {
            vertical-align: middle;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-2">
                    <div class="card-header text-center">
                        <h3>Tickets Solution</h3>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                {{ session('success') }}
                                <button class="close alert-dismissible" data-dismiss="alert"><i class="fa fa-x"></i></button>
                            </div>
                        @endif
                        @if (session('update'))
                            <div class="alert alert-primary alert-dismissible">
                                {{ session('update') }}
                                <button class="close alert-dismissible" data-dismiss="alert"><i
                                        class="fa fa-x"></i></button>
                            </div>
                        @endif
                        @if (session('delete'))
                            <div class="alert alert-danger alert-dismissible">
                                {{ session('delete') }}
                                <button class="close alert-dismissible" data-dismiss="alert"><i
                                        class="fa fa-x"></i></button>
                            </div>
                        @endif
                    </div class='container'>
                    <table class="table text-center" class="mx-5">
                        <thead>
                            @php
                                $num = 1;
                            @endphp
                            <tr class="text-center">
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
                                    <th scope="row">#{{ $ticket->id }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td class="text-truncate">{{ \Illuminate\Support\Str::limit($ticket->description, 30) }}
                                    </td>
                                    <td >
                                      <div style="color: white"
                                      class="btn btn-sm
                                        @if ($ticket->priority == 'high') btn-danger
                                        @elseif($ticket->priority == 'medium')
                                            btn-warning
                                        @elseif($ticket->priority == 'low')
                                            btn-info @endif
                                      "
                                      >
                                      {{ $ticket->priority }}
                                    </div>  
                                    </td>
                                    <td>
                                        <div
                                            class="btn btn-sm 
                                          @if ($ticket->status == 'open') btn-success
                                          @elseif($ticket->status == 'closed')
                                          btn-primary @endif
                                         ">
                                            {{ $ticket->status }}
                                        </div>
                                    </td>
                                    <td>
                                        @foreach ($ticketLabelIds[$ticket->id] as $labelId)
                                            @php
                                                $label = \App\Models\Label::find($labelId);
                                            @endphp
                                            {{ $label->name }},
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($ticketCategoryIds[$ticket->id] as $categoryId)
                                            @php
                                                $category = \App\Models\Category::find($categoryId);
                                            @endphp
                                            {{ $category->name }},
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="image-wrapper">
                                            @foreach ($ticketImages[$ticket->id] as $image)
                                                <img class="small-image" src="{{ asset('storage/gallery/' . $image) }}"
                                                    alt="Ticket Image">
                                            @endforeach
                                            <div class="modal">
                                                @foreach ($ticketImages[$ticket->id] as $image)
                                                    <img class="modal-content"
                                                        src="{{ asset('storage/gallery/' . $image) }}"
                                                        alt="Enlarged Image">
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a type="button" href="{{ route('comment.index', $ticket->id) }}"
                                            class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-comment"></i></a>
                                        @if (Auth::user()->role != 2)
                                            <a type="button" href='{{ route('ticket.edit', $ticket->id) }}'
                                                class="btn btn-outline-warning btn-sm">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
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
        document.querySelectorAll('.image-wrapper').forEach(function(wrapper) {
            let timer = null;
            wrapper.addEventListener('mouseenter', function() {
                if (timer === null) {
                    timer = setTimeout(() => {
                        this.querySelector('.modal').style.display = 'block';
                    }, 1500);
                }
            });

            wrapper.addEventListener('mouseleave', function() {
                clearTimeout(timer);
                timer = null;
                this.querySelector('.modal').style.display = 'none';
            });
        });
    </script>
@endsection
