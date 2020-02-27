 @extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Program Management<a href="{{route('admin.programs.create')}}"><button type="button" class="btn btn-outline-success float-right">+ Add Program</button></a></div>
                <table class="table">
  <thead>
    <tr>
      <th scope="col" style="width: 35%">School</th>
      <th scope="col" style="width: 25%">Program</th>
      <th scope="col" style="width: 5%">Accreditation Level</th>
      <th scope="col" style="width: 5%">Education Level</th>
      <th scope="col" style="width: 5%";>Valid Until</th>
      <th scope="col" style="width: 5%";>Status</th>
      <th scope="col" style="width: 20%";>Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($members as $member)
{{--     <tr>
      <th scope="row">{{$member->school}}</th> --}}
@foreach($member->programs as $xmember)
<tr>
  <td>@if ($loop->first)
{{$xmember->members->school}}
@else
 
@endif</td>
        <td>{{$xmember->program}}</td>
      <td>{{$xmember->level}}</td>
      <td>
        @if ($xmember->ed_level == null)
        N/A
        @else
        {{$xmember->ed_level}}
        @endif
      </td>
      <td>{{$xmember->valid}}</td>
      <td>
@if ($xmember->status == 'active')
    <span class="badge badge-success">Active</span>
@elseif ($xmember->status == 'deactive')
    <span class="badge badge-secondary">Deactive</span>
@else
    <span class="badge badge-danger">Error</span>
@endif
      </td>

      <td><a href="{{route('admin.programs.edit',['id'=>$xmember->id])}}"><button style="margin-right: 5px;" type="button" class="btn btn-outline-primary">Edit</button></a><a href="{{route('admin.programs.destroy',['id'=>$xmember->id])}}"><button  type="button" class="btn btn-outline-danger">Delete</button></a>
      </td>
          @endforeach
    </tr>
    @endforeach

  </tbody>
</table>

            </div>
        </div>
    </div>
</div>
@endsection
