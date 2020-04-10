@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Grade School Membership{{-- <a href="#"><button type="button" class="btn btn-outline-success float-right">+ Add Formula</button></a> --}}</h4>
{{--             <br> --}}
{{-- <form>
    <div class="form-group row">
    <label for="school" class="col-md-2 col-form-label text-md-right">School</label>
        <div class="col-md-8">
        <select class="form-control selectpicker" id="school" name="school" data-live-search="true" data-style="btn-info" title="Select School...">
            <option value=""> </option>
                @foreach($members as $srebmem)
            <option value="{{$srebmem->id}}">{{$srebmem->school}}</option>
                @endforeach
        </select>
    </div>
</div>
</form> --}}
</br>
<div class="container" >
<table id="example" class="display table table-hover table-sm" style="width:100%">
  <thead>
    <tr>

      <th scope="col" >School</th>
            <th scope="col" >Date Enrolled</th>
      @foreach($membershipids as $msi)
        <th scope="col">{{$msi->variables->title}}</th>
        @endforeach
      <th scope="col" >Gross Tution Revenue</th>
      <th scope="col" >Annual Membership Fee</th>
      <th scope="col" >Status</th>
      <th scope="col" >Edit</th>
    </tr>
  </thead>
  <tbody>

    @foreach($members as $srebmem)
{{--     @php $i=1; @endphp --}}
    @if($srebmem->gsmembership->first())
    <tr>
@foreach($srebmem->membership as $ggg)

        <td>{{$srebmem->school}} </td>
        <td>{{$ggg->compute->created_at->format('M.Y')}} </td>
{{--                 <td>{{$i++}} </td> --}}
@foreach($ggg->gsmembership as $ggx)
        <td>{{number_format($ggx->content,2)}}</td> 
@endforeach
<td>{{number_format($ggg->compute->gtr,2)}}</td>
<td>{{number_format($ggg->compute->amf,2)}}</td>
{{-- <td>{{number_format($ggg->compute->amf,2)}}</td> --}}
              <td>
@if ($ggg->compute->status == 'active')
    <span class="badge badge-success">Active</span>
@elseif ($ggg->compute->status == 'deactive')
    <span class="badge badge-secondary">Deactive</span>
@else
    <span class="badge badge-danger">Error</span>
@endif
{{-- <span class="badge badge-success">Error</span> --}}
      </td>
      <td>
<a href="{{route('gsenrollment.edit',['id'=>$srebmem->gsmembership->first()->member_id, 'content' => $ggg->gsmembership->first()->content_id])}}"><button type="button" class="btn btn-outline-primary float-left">Edit</button></a>
      </td>
    </tr>
    @endforeach
    @endif
    @endforeach



  </tbody>
</table>
  </br>
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
        "order": [[ 0, "asc" ]],
        buttons: {
        buttons: [ 
{ extend: 'print',
 text: 'Print All Grade School Membership Fees',
exportOptions:{ columns: [0,1,2,3,4,]},
title: 'PHILIPPINE ACCREDITING ASSOCIATION OF SCHOOLS, COLLEGES AND UNIVERSITIES (PAASCU)',
messageTop: 'GRADE SCHOOL MEMBERSHIP FEES',
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
<script>

</script>
@endsection

