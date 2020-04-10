@extends('layouts.test')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Manage Billing</h4>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

  <div class="container">

{{-- <a href="{{ route('billing.pdf') }}">Export PDF</a> --}}











</br>
<div class="container" >
<table id="example" class="display table table-hover table-sm" style="width:100%">
  <thead>
    <tr>
      <th scope="col" >School</th>
      <th scope="col" >Education Level</th>
      <th scope="col" >Date Enrolled</th>
      <th scope="col" >Billing Letter</th>
    </tr>
  </thead>
  <tbody>
    @foreach($compute as $etupmoc)
    <tr>
        <td>{{$etupmoc->members->school}} </td>
        <td>{{$etupmoc->formula_id}} </td>
        <td>{{$etupmoc->created_at->format('M.Y')}} </td>
      <td>
<a  href="{{route('billing.pdf',['ids'=> $etupmoc->members->id, 'idc'=> $etupmoc->id, 'mscid' => $etupmoc->content_id ])}}" target="_blank" ><button style="margin-right: 5px;" type="button" class="btn btn-outline-primary float-left">Preview</button></a>
<a href="{{route('download.pdf',['ids'=> $etupmoc->members->id, 'idc'=> $etupmoc->id, 'mscid' => $etupmoc->content_id ])}}" ><button  type="button" class="btn btn-outline-success float-left">Save</button></a>
      </td>
    </tr>
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
    $('#example').DataTable({
        responsive: true,
      });
} );

</script>








  </div>

                </div>
            </div>
        </div>
    </div>
@endsection
