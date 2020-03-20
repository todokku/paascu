@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">

                <h4 class="card-header bg-white ">User Management<a href="{{ route('register') }}"><button type="button" class="btn btn-outline-success float-right">+ Add User</button></a></h4>
                </br>

<div class="container">
                <span id="buttons"></span>
<table id="example" class="display table table-hover" style="width:100%">
  <thead>
    <tr>
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
        <a href="{{route('admin.users.edit', $user->id)}}"><button type="button" class="btn btn-outline-primary float-left">Edit</button></a>
        @endcan
        @can('admin-user')
<form action="{{ route('admin.users.destroy', $user)}}" method="POST" class="float-left">
  @csrf
  {{ method_field('delete')}}
&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-outline-danger">Delete</button>
</form>
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
      });
} );
// $(document).ready(function() {
// var table = $('#example').DataTable( {
//         responsive: true,
//         lengthChange: false,
        // buttons: {
        // buttons: [ 
//------------------------------------------------------------------------------------------------
// 'copyHtml5', 
// 'excelHtml5' ,
// 'csvHtml5',
// 'pdfHtml5',

// { extend: 'print', text: 'Print All Account Users', exportOptions:{ columns: [ 0, 1, 2, 3]} }, ],
//     dom: {
//       button: {
//         tag: "button",
//         className: "btn btn-outline-success"
//       },
//       buttonLiner: {
//         tag: null
//       }
//     }
// }
//------------------------------------------------------------------------------------------------
//     }


//      );
 
//     table.buttons().container()
//         .appendTo( '#example_wrapper .col-md-6:eq(0)' );
// } );

</script>


            </div>
        </div>
    </div>
</div>

@endsection
