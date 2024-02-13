@extends('dashboard.index')

@section('content')
    <div class="container d-flex flex-column">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-2">
                    <div class="card-header text-center">
                    </div class='container'>
                    <table class="table text-center col-md-12" class="mx-5">
                        <thead>
                            @php
                                $num = 1;
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
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="text-center">
                                <th>{{ $num++ }}</th>
                                <th scope="row">id - {{ $ticket->id }}</td>
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
                                    @foreach ($ticketLabelIds as $labelId)
                                        @php
                                            $label = \App\Models\Label::find($labelId);
                                        @endphp
                                        {{ $label->name }},
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($ticketCategoryIds as $categoryId)
                                        @php
                                            $category = \App\Models\Category::find($categoryId);
                                        @endphp
                                        {{ $category->name }},
                                    @endforeach
                                </td>
                                <td>
                                    <div class="image-wrapper">
                                        @foreach ($ticketImageIds as $imageId)
                                            @php
                                                $image = \App\Models\Image::find($imageId);
                                            @endphp
                                            <img class="small-image" src="{{ asset('storage/gallery/' . $image->image) }}"
                                                alt="Ticket Image">
                                        @endforeach
                                        <div class="modal">
                                            @foreach ($ticketImageIds as $imageId)
                                                <img class="modal-content"
                                                    src="{{ asset('storage/gallery/' . $image->image) }}"
                                                    alt="Enlarged Image">
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mx-3">
                        <h4><i class="fas fa-comment text-warning ml-5"></i> Comments</h4>
                        <div class="row text-center d-flex justify-content-between mx-5">
                            @foreach ($comments as $comment)
                                <div class="col-md-5 m-2 card">
                                    <div class="card-container">
                                        <div class="card-header">
                                            <div class="user-info text-align-center">
                                                <span class="username">{{ $comment->user->name }}</span> | <span class="role">
                                                    @if($comment->user->role == 0)
                                                        Admin
                                                    @elseif($comment->user->role == 1)
                                                        Assigned Agent
                                                    @elseif($comment->user->role == 2)
                                                        Ticket Owner
                                                    @endif
                                                </span>
                                                @if (Auth::user()->role=='0'||$comment->user->id==Auth::user()->id)
                                                <span class="float-right d-none d-sm-inline-block">
                                                    <button class="btn btn-sm btn-outline-primary edit-comment-btn"
                                                        data-comment-id="{{ $comment->id }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <form id="deleteForm{{ $comment->id }}"
                                                        action="{{ route('comment.destroy', ['id' => $ticket->id, 'comment' => $comment->id]) }}"
                                                        method="post" class="d-inline-block">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="confirmDelete('{{ $comment->id }}')"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="comment-body">
                                            <p id="comment-body-{{ $comment->id }}" class="comment-text">
                                                {{ $comment->comment_body }}</p>
                                            <form
                                                action="{{ route('comment.update', ['id' => $ticket->id, 'comment' => $comment->id]) }}"
                                                method="post" class="edit-comment-form"
                                                data-comment-id="{{ $comment->id }}" style="display: none;">
                                                @method('put')
                                                @csrf
                                                <input type="text" name="comment_body" class="form-control"
                                                    value="{{ $comment->comment_body }}">
                                                <button type="submit" class="btn btn-sm btn-success">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            $(".alert").alert('close');
        }, 4000);

        function confirmDelete(commentId) {
            var result = confirm("Are you sure you want to delete?");
            if (result) {
                // If user clicks OK, submit the form with the corresponding userId
                document.getElementById('deleteForm' + commentId).submit();
            } else {
                // If user clicks Cancel, do nothing
            }
        }
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

        // comment edit JS
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-comment-btn');
            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    toggleCommentEditMode(commentId);
                });
            });

            function toggleCommentEditMode(commentId) {
                const commentParagraph = document.getElementById('comment-body-' + commentId);
                const editForm = document.querySelector('.edit-comment-form[data-comment-id="' + commentId + '"]');

                const isInEditMode = commentParagraph.classList.contains('edit-mode');

                if (!isInEditMode) {
                    commentParagraph.style.display = 'none';
                    editForm.style.display = 'block';
                } else {
                    commentParagraph.style.display = 'block';
                    editForm.style.display = 'none';
                }

                // Toggle the edit mode class on the comment paragraph
                commentParagraph.classList.toggle('edit-mode');
            }
        });

        Echo.channel('comment.' + ticketId)
    .listen('CommentCreated', (event) => {
        // Update the UI dynamically to reflect the new comment
        console.log('New comment:', event.comment);
        // Add the new comment to the display using Vue, React, or JavaScript DOM manipulation
    })
    .listen('CommentUpdated', (event) => {
        // Update the UI to reflect the edited comment
        console.log('Updated comment:', event.comment);
        // Find and update the existing comment element, or apply necessary changes
    })
    .listen('CommentDeleted', (event) => {
        // Remove the comment from the UI
        console.log('Deleted comment:', event.comment);
        // Find and remove the relevant comment element using JavaScript
    });
    </script>
@endsection

@section('comment_section')
    <div class="d-flex justify-content-center" style="width: 100%">
        <form class="input-group col-lg-8 mb-3" action="{{ route('comment.store', $ticket->id) }}" method="POST">
            @csrf
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-comment"></i></span>
            </div>
            <input type="text" class="form-control" name="comment_body">
            <div class="input-group-append">
                <button type="submit" class="input-group-text"><i class="fa fa-arrow-right text-primary"></i></button>
            </div>
        </form>
    </div>
@endsection
