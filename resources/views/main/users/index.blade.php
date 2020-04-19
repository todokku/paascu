@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">

                <h4 class="card-header bg-white ">User Management<a href="{{ route('register') }}"><button type="button" class="btn btn-outline-success float-right">+ Add User Accounts</button></a></h4>
                </br>

<div class="container">
                <span id="buttons"></span>
<table id="example" class="display table table-hover" style="width:100%">
  <thead>
    <tr>
      <th>ID</th>
      <th style="width: 30%;">Name</th>
      <th style="width: 30%;">Email</th>
      <th style="width: 10%;">Roles</th>
      <th style="width: 10%;">Status</th>
      <th style="width: 20%;">Actions</th>
    </tr>
  </thead>
          <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{$user->id}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{implode( ',',$user->roles()->get()->pluck('name')->toArray()) }}</td>
      <td>
@if ($user->status == 'active')
    <span class="badge badge-success">Active</span>
@elseif ($user->status == 'deactive')
    <span class="badge badge-secondary">Deactive</span>
@else
    <span class="badge badge-danger">Error</span>
@endif
      </td>
      <td>
        @can('admin-user')
        <a href="{{route('users.edit', $user->id)}}"><button type="button" class="btn btn-outline-primary float-left mr-2">Edit</button></a>
        @endcan
        @can('admin-user')
        <a href="{{route('user.destroyx', $user->id)}}"><button type="button" class="btn btn-outline-danger float-left delete"@if($user->id == 1)disabled @endif>Delete</button></a>
        @endcan
      </td>
    </tr>
    @endforeach

  </tbody>
    </table>
  </br>
  </div>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        responsive: true,
        columnDefs: [
            {
                targets: [ 0 ],
                visible: false,
                searchable: false
            },
        ]
      });

$("#example").on("click",'.delete', function(){
      event.preventDefault();
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
$(this).unbind('click').click();
  }
})
    });




} );

</script>


            </div>
        </div>
    </div>
</div>

@endsection
