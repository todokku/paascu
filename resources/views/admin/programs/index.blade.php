 @extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Program Management<a href="{{route('admin.programs.create')}}"><button type="button" class="btn btn-outline-success float-right">+ Add Program</button></a></h4>
                              </br>

<div class="container">  

<table id="example" class="display table table-hover" style="width:100%">
        <thead>
            <tr>
      <th style="width: 20%;">School</th>
      <th style="width: 20%;">Program</th>
      <th style="width: 10%;">Accreditation Level</th>
      <th style="width: 10%;">Education Level</th>
      <th style="width: 10%;">Valid Until</th>
      <th style="width: 10%;">Status</th>
      <th style="width: 20;">Action</th>
            </tr>
        </thead>
 <tbody>
  @foreach($members as $member)
@foreach($member->programs as $xmember)
<tr>
  <td>@if ($loop->first)
{{$xmember->members->school}}
@else
{{$xmember->members->school}}
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
<td><div class="btn-group"><a href="{{route('admin.programs.edit',['id'=>$xmember->id])}}"><button style="margin-right: 5px;" type="button" class="btn btn-outline-primary float-right">Edit</button></a><a href="{{route('admin.programs.destroy',['id'=>$xmember->id])}}"><button  type="button" class="btn btn-outline-danger float-right">Delete</button></a></div>
      </td>
          @endforeach
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
    //     columnDefs: [
    //       { targets: [2,3,4,5,6],
    //         searchable: false
    //       },
    // ]
      });
} );

</script> 
            </div>
        </div>
    </div>
</div>
@endsection
