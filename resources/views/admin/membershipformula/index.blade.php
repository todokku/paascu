@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">GS & HS Membership Fee Formula Management{{-- <a href="{{route('admin.members.create')}}"><button type="button" class="btn btn-outline-success float-right">+ Add Member</button></a> --}}</div>
<div class="col-md-12 offset-md-2">
</br>
GS = GRADE SCHOOL </br></br>
HS = HIGH SCHOOL </br></br>
TE = TOTAL ENROLMENT </br></br>
ATF = ANNUAL TUITION FEE </br></br>
GTR = GROSS TUITION REVENUE </br></br>
TFPU = TUITION FEE PER UNIT </br></br>
12U = 12 UNITS </br></br>
21U = 21 UNITS </br></br>
</div>
<form>

{{-- <div class="form-group row">
	<label for="formula" class="col-md-2 col-form-label text-md-right">Formula</label>

    <div class="col-md-8">
    <input id="formula" type="text" class="form-control @error('formula') is-invalid @enderror" name="formula" value="{{$formula->formula}}" required disabled>

        @error('formula')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </br>
        <a href="#"><button type="button" class="btn btn-outline-primary float-right">Edit</button></a>
    </div>
</div> --}}

<div class="input-group mb-3 col-md-8 offset-md-2">
  <input type="text" class="form-control" value="{{$gs->formula}}" aria-label="Recipient's username" aria-describedby="basic-addon2" disabled>
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Edit Formula</button>
  </div>
</div>

<div class="input-group mb-3 col-md-8 offset-md-2">
  <input type="text" class="form-control" value="{{$hs->formula}}" aria-label="Recipient's username" aria-describedby="basic-addon2" disabled>
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Edit Formula</button>
  </div>
</div>


<div class="input-group mb-3 col-md-8 offset-md-2">
  <input type="text" class="form-control" value="{{$bed->formula}}" aria-label="Recipient's username" aria-describedby="basic-addon2" disabled>
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Edit Formula</button>
  </div>
</div>


<div class="input-group mb-3 col-md-8 offset-md-2">
  <input type="text" class="form-control" value="{{$semcol->formula}}" aria-label="Recipient's username" aria-describedby="basic-addon2" disabled>
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Edit Formula</button>
  </div>
</div>


<div class="input-group mb-3 col-md-8 offset-md-2">
  <input type="text" class="form-control" value="{{$tricol->formula}}" aria-label="Recipient's username" aria-describedby="basic-addon2" disabled>
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Edit Formula</button>
  </div>
</div>


<div class="input-group mb-3 col-md-8 offset-md-2">
  <input type="text" class="form-control" value="{{$semged->formula}}" aria-label="Recipient's username" aria-describedby="basic-addon2" disabled>
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Edit Formula</button>
  </div>
</div>


<div class="input-group mb-3 col-md-8 offset-md-2">
  <input type="text" class="form-control" value="{{$triged->formula}}" aria-label="Recipient's username" aria-describedby="basic-addon2" disabled>
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Edit Formula</button>
  </div>
</div>


</form>

            </div>
        </div>
    </div>
</div>
@endsection



