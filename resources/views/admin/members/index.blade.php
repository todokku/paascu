@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">

                <h4 class="card-header bg-white">Member Management<a href="{{route('admin.members.create')}}"><button type="button" class="btn btn-outline-success float-right">+ Add Member</button></a></h4>
                </br>

<div class="container">
<table id="example" class="display table table-hover" style="width:100%">
        <thead>
            <tr>
      <th style="width: 40;">School</th>
      <th style="width: 40%;">Address</th>
      <th style="width: 5%;">Status</th>
      <th style="width: 15%;">Action</th>
            </tr>
        </thead>
  <tbody>
  @foreach($members as $member)
    <tr>
      <th scope="row">{{$member->school}}</th>
      <td>{{$member->address}}</td>
      <td>
@if ($member->status == 'active')
    <span class="badge badge-success">Active</span>
@elseif ($member->status == 'deactive')
    <span class="badge badge-secondary">Deactive</span>
@else
    <span class="badge badge-danger">Error</span>
@endif
      </td>
      <td>
        @can('admin-user')
        <a href="{{route('admin.members.edit',['id'=>$member->id])}}"><button type="button" class="btn btn-outline-primary float-left">Edit</button></a>
        @endcan
        @can('admin-user')
<form action="{{route('admin.members.destroy',['id'=>$member->id])}}" method="POST" class="float-left">
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

</script> 
            </div>
        </div>
    </div>
</div>

@endsection
