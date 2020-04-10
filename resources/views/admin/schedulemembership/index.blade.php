@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">

                <h4 class="card-header bg-white">Manage Schedule Membership Fee<a href="{{route('admin.schedulemembership.create')}}"><button type="button" class="btn btn-outline-success float-right">+ Add</button></a></h4>
</BR>
{{-- <div class="row">
  <div class="col-md-10 offset-md-1"> --}}

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


<center><h2><b>Schedule of Membership Fees</b></h2></center>
</br>
<div class="container" >
                <span id="buttons"></span>
<table id="example" class="display table table-hover table-sm" style="width:100%">
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
      @if($loop->last)
        <td> {{number_format($fms->gtrs, 0, '.', ',')}} and above</td>
        <td>{{number_format($fms->amf, 2, '.', ',')}}</td>
        @else
        <td>{{number_format($fms->gtrs, 0, '.', ',')}} to {{number_format($fms->gtre, 0, '.', ',')}}</td>
        <td>{{number_format($fms->amf, 2, '.', ',')}}</td>
              @endif
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
  </br>

{{-- </div>
</div> --}}
</div>

<script>
  
// $(document).ready(function() {
//     $('#example').DataTable({
//         responsive: true,
//         lengthChange: false,
//         paging: false,
//         "order": [[ 1, "asc" ]],
//       });
// } );

$(document).ready(function() {
var table = $('#example').DataTable( {
        responsive: true,
        lengthChange: false,
                paging: false,
                info: false,
        "order": [[ 1, "asc" ]],
        buttons: {
        buttons: [ 
{ extend: 'print',
 text: 'Print All Schedule Membership Fees',
exportOptions:{ columns: [ 0, 1,]},
title: 'PHILIPPINE ACCREDITING ASSOCIATION OF SCHOOLS, COLLEGES AND UNIVERSITIES (PAASCU)',
messageTop: 'SCHEDULE OF MEMBERSHIP FEES',
}, 
],

    dom: {
      button: {
        tag: "button",
        className: "btn btn-outline-success",
      },
      buttonLiner: {
        tag: null
      }
    }
}

    }


     );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );

</script>
            </div>
        </div>
    </div>
</div>
@endsection
