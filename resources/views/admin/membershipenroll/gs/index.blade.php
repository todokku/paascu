@extends('layouts.test')

@section('content')

{{--    <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Enroll Grade School Membership</div>
            <br>
<form>
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
</form>

{{$formula->id}}

<form id="formGS" name="formGS" action="#" method="POST">
@csrf
{{-- GS TOTAL ENROLLMENT --}}
@foreach($variabled as $xxx)
<input type="hidden" id="varid" name="gsname" value="{{$xxx->id}}">
<input type="hidden" id="title{{$xxx->code}}" name="title{{$xxx->code}}" value="{{$xxx->code}}">
<div class="form-group row">
    <label for="gste" class="col-md-2 col-form-label text-md-right">{{$xxx->title}}</label>

    <div class="col-md-8">
        <input id="{{$xxx->code}}" type="number" step=".01" min="0" class="form-control @error($xxx->code) is-invalid @enderror" name="{{$xxx->code}}" required placeholder="{{$xxx->id}}">

        @error($xxx->code)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@endforeach


<div class="col-md-8 offset-sm-2">
  <button id="submitGS" name="submitGS" type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>



        </div>
    </div>
</div>
</div>
@endsection