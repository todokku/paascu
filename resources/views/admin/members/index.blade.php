@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Member Management<a href="{{route('admin.members.create')}}"><button type="button" class="btn btn-outline-success float-right">+ Add Member</button></a></div>

                <div class="card-body">



<div id="accordion">
<?php 
$i = 0;
?>
	@foreach($members as $member)
	  <div class="card">
    <div class="card-header" id="headingOne{{$i}}">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne{{$i}}">
          {{ $member->school }} 
        @can('admin-user')
        <a href="{{route('admin.members.edit',['id'=>$member->id])}}"><button type="button" class="btn btn-outline-primary float-right">Edit</button></a>
        @endcan
          <a href="{{route('admin.members.destroy',['id'=>$member->id])}}"><button style="margin-right: 5px;" type="button" class="btn btn-outline-danger float-right">Delete</button></a>


          &nbsp;&nbsp;&nbsp;
        </button>

      </h5>
    </div>

    <div id="collapseOne{{$i}}" class="collapse" aria-labelledby="headingOne{{$i}}" data-parent="#accordion">
      <div class="card-body">
      <b>Member Status</b> : @if ($member->status == 'active')
    <span class="badge badge-success">Active</span>@elseif ($member->status == 'deactive')<span class="badge badge-secondary">Deactive</span>@else<span class="badge badge-danger">Error</span>@endif </BR></BR>
    <hr>       
      	<b>Address</b> : {{$member->address}}</BR></BR>
    <hr>
{{--   <b>Programs</b> :   --}}

{{--   <div class="col-md-6 offset-sm-1"> --}}

 <table class="table">
  <thead>
    <tr>

      <th scope="col">Program</th>
      <th scope="col">Level</th>
      <th scope="col">Valid Through</th>
    </tr>
  </thead>
  <tbody>

            @foreach($member->programs as $xmember)
    <tr>

      <td>{{$xmember->program}}</td>
      <td>{{$xmember->level}}</td>
      <td>{{$xmember->valid}}</td>
    </tr>

            @endforeach
  </tbody>
</table>
{{--   {{$xmember->program}}</BR></BR><b>Level Status</b> : {{$xmember->level}}</BR></BR><b>Valid Until</b> : {{$xmember->valid}}</BR></BR> --}}

{{-- </div> --}}


      </div>
    </div>
  </div>
</BR>
<?php 
$i++
?>
  @endforeach
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
