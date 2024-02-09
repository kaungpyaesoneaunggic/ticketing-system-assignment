@extends('dashboard.index')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3>User List</h3>
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
                          <th>Name</th>
                          <th>Email</th>
                          <th>PW</th>
                          <th>Role</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        <tr class="text-center">
                          <th>{{ $num++ }}</th>
                          <th scope="row">id - {{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td class="text-truncate">{{ \Illuminate\Support\Str::limit($user->password, 10) }}</td>
                          <td>
                            @if($user->role == 0)
                                Admin
                            @elseif($user->role == 1)
                                Agent
                            @else
                                Regular
                            @endif
                        </td>
                          <td>
                            <a type="button" href="{{ route('user.edit',$user->id) }}" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i></a>
                            <form id="deleteForm{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="post" class="d-inline-block">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $user->id }}')"><i class="fa fa-trash"></i></button>
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
  function confirmDelete(userId) {
        var result = confirm("Are you sure you want to delete?");
        if (result) {
            // If user clicks OK, submit the form with the corresponding userId
            document.getElementById('deleteForm' + userId).submit();
        } else {
            // If user clicks Cancel, do nothing
        }
    }
  setTimeout(function() {
        $(".alert").alert('close');
    }, 4000);
  
</script>
@endsection