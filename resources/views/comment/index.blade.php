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
                        </tr>
                      </thead>
                      
                      <tbody>
                        <tr class="text-center">
                          <th>{{ $num++ }}</th>
                          <th scope="row">id - {{ $ticket->id }}</td>
                          <td>{{ $ticket->title }}</td>
                          <td class="text-truncate">{{ \Illuminate\Support\Str::limit($ticket->description, 30) }}</td>
                          <td>{{ $ticket->priority }}</td>
                          <td>{{ $ticket->status }}</td>
                          <td>
                            @foreach ($ticketLabelIds as $labelId)
                            @php
                              $label=\App\Models\Label::find($labelId);
                            @endphp
                                {{ $label->name }},
                            @endforeach
                          </td>
                          <td>
                            @foreach ($ticketCategoryIds as $categoryId)
                            @php
                            $category=\App\Models\Category::find($categoryId);
                          @endphp
                              {{ $category->name }},
                            @endforeach
                          </td>
                          <td>
                            <div class="image-wrapper">
                              @foreach ($ticketImageIds as $imageId)
                              @php
                                 $image=\App\Models\Image::find($imageId);
                              @endphp
                                  <img class="small-image" src="{{ asset('storage/gallery/' . $image->image) }}" alt="Ticket Image">
                              @endforeach
                              <div class="modal">
                                  @foreach ($ticketImageIds as $imageId)
                                      <img class="modal-content" src="{{ asset('storage/gallery/' . $image->image) }}" alt="Enlarged Image">
                                  @endforeach
                              </div>
                          </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="mx-3">
                      <h4 ><i class="fas fa-comment text-warning"></i> Comments</h4>
                      <div class="row text-center d-flex justify-content-between mx-5">
                          @foreach ($comments as $comment)
                          <div class="col-md-5 m-2 card">
                              <div class="card-container">
                                  <div class="card-header">
                                      <div class="user-info text-align-center">
                                          <span class="username">{{ $comment->user->name }}</span> | <span class="role">{{ $comment->user->role }}</span>
                                          <span class="float-right d-none d-sm-inline-block">
                                            <a class="btn btn-sm btn-outline-primary" ><i class="fa fa-pencil"></i></a>
                                              <form id="deleteForm{{ $comment->id }}" action="{{ route('comment.destroy', ['id' => $ticket->id, 'comment' => $comment->id]) }}" method="post" class="d-inline-block">
                                              @method('delete')
                                              @csrf
                                              <button type="submit" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $comment->id }}')"><i class="fa fa-trash"></i></button>
                                          </form>
                                          </span>
                                        </div>
                                  </div>
                                  <div class="comment-body">
                                      <p>{{ $comment->comment_body }}</p>
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