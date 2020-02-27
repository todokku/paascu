@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">Manage Schedule Membership Fee<a href="{{route('admin.schedulemembership.create')}}"><button type="button" class="btn btn-outline-success float-right">+ Add</button></a></div>
</BR>
<div class="row">
  <div class="col-md-10 offset-md-1">

{{-- <table>
  <tr>
    <th>GTR</th>
    <th>AMF</th>
  </tr>
  <tr>
    @foreach($smf as $fms)  
        <td>{{$fms->gtrs}} to {{$fms->gtre}}</td>
        <td>{{$fms->amf}}</td>
    @endforeach

  </tr>
</table> --}}
</br>
<center><h2><b>Schedule of Membership Fees</b></h2></center>
</br>
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">GROSS TUITION REVENUE</th>
      <th scope="col">ANNUAL MEMBERSHIP FEE</th>
{{--       <th scope="col">STATUS</th> --}}
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
        @foreach($smf as $fms)  
    <tr>
        <td>{{number_format($fms->gtrs, 0, '.', ',')}} to {{number_format($fms->gtre, 0, '.', ',')}}</td>
        <td>{{number_format($fms->amf, 2, '.', ',')}}</td>
{{--               <td>
@if ($fms->status == 'active')
    <span class="badge badge-success">Active</span>
@elseif ($fms->status == 'deactive')
    <span class="badge badge-secondary">Deactive</span>
@else
    <span class="badge badge-danger">Error</span>
@endif
      </td> --}}

      <td>
{{-- {{route('admin.schedulemembership.edit',['id'=>$sms->id])}}  --}}       
<a href="{{route('admin.schedulemembership.edit',['id'=>$fms->id])}}"><button style="margin-right: 5px;" type="button" class="btn btn-outline-primary">Edit</button></a>

<a href="{{route('admin.schedulemembership.destroy',['id'=>$fms->id])}}"><button  type="button" class="btn btn-outline-danger">Delete</button></a>
</td> 

    </tr>
        @endforeach
  </tbody>
</table>


</div>
</div>
            </div>
        </div>
    </div>
</div>
@endsection
