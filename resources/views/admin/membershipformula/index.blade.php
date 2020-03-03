@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">Membership Fee Formula Management
                </div>

@foreach($formula as $alumrof)
<form id="updateformula" name="updateformula" action="{{ url('admin/membershipformula/'.$alumrof->id.'/edit')}}">
{{-- @csrf
@method('PUT') --}}

</BR>
<div class="container">
{{--   <div class="card" >
  <ul class="list-group list-group-flush">
    {{$alumrof->ed_type}} full formula
    <li class="list-group-item">{{$alumrof->variable." = gross_tuition_fee"}}</li>
  </ul>
</div> --}}
{{$alumrof->ed_type}} formula
<div class="input-group mb-3">
  <input type="text" class="form-control" value="{{$alumrof->variable.' = gross_tuition_fee'}}" aria-label="Recipient's username" aria-describedby="button-{{$alumrof->ed_type}}" disabled>
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="submit" id="button-{{$alumrof->ed_type}}">Update</button>
  </div>
</div>
</div>
</form>
@endforeach




            </div>
        </div>
    </div>
</div>


@endsection



