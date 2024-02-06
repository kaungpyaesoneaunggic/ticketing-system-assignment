@extends('dashboard.index')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Label List</h3>
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
                    <table class="table" class="mx-5">
                      <thead>
                        @php
                          $num=1
                        @endphp
                        
                        <tr class="text-center">
                          <th>#</th>
                          <th>ID</th>
                          <th>label Name</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($labels as $label)
                        <tr class="text-center">
                          <th>{{ $num++ }}</th>
                          <th scope="row">id - {{ $label->id }}</td>
                          <td>{{ $label->name }}</td>
                          <td>
                            <a type="button"  href="{{ route('label.edit',$label->id) }}"  class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i></a>
                            <form id="deleteForm{{ $label->id }}" action="{{ route('label.destroy', $label->id) }}" method="post" class="d-inline-block">
                              @method('delete')
                              @csrf
                              <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $label->id }}')"><i class="fa fa-trash"></i></button>
                          </form>
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
  function confirmDelete(labelId) {
        var result = confirm("Are you sure you want to delete?");
        if (result) {
            // If label clicks OK, submit the form with the corresponding userId
            document.getElementById('deleteForm' + labelId).submit();
        } else {
            // If label clicks Cancel, do nothing
        }
    }
  setTimeout(function() {
        $(".alert").alert('close');
    }, 4000);
  
</script>
@endsection