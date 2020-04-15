@extends('layouts.test')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Manage Original Receipts</h4>

                <div class="card-body">
{{--                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

</br>
<div class="container" >
<table id="example" class="display table table-hover table-sm" style="width:100%">
  <thead>
    <tr>
      <th scope="col" >School</th>
      <th scope="col" >Education Level</th>
      <th scope="col" >Date Enrolled</th>
      <th scope="col" >Status</th>
      <th scope="col" >Verify / View</th>


    </tr>
  </thead>
  <tbody>
    @foreach($compute as $etupmoc)
    <tr>
        <td>{{$etupmoc->members->school}} </td>
        <td>{{$etupmoc->formula_id}} </td>
        <td>{{$etupmoc->created_at->format('M.Y')}} </td>
            <td>
@if ($etupmoc->verified == 'verified')
    <span class="badge badge-success">Verified</span>
@else
    <span class="badge badge-secondary">Pending</span>
@endif
      </td>
            <td>
<a  href="{{route('receipts.verify',['ids'=> $etupmoc->members->id, 'idc'=> $etupmoc->id, 'mscid' => $etupmoc->content_id ])}}" ><button style="margin-right: 5px;" type="button" class="btn btn-outline-primary float-left">Upload</button></a>


<a  href="{!! asset('receipt/' . $etupmoc->receipt) !!}" target="_blank"><button style="margin-right: 5px;" type="button" class="btn btn-outline-primary float-left">View</button></a>  
</td>
    </tr>
    @endforeach



  </tbody>
</table>
  </br>
</div>

                </div>
            </div>
        </div>
    </div>

<script>

$(document).ready(function() {
    $('#example').DataTable({
        responsive: true,        

      });
} );

</script>

@endsection
