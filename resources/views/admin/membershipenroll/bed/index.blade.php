@extends('layouts.test')

@section('content')

{{--    <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Enroll Basic Education Membership</h4>
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


<form id="formBED" name="formBED" action="{{ route('bedenrollment.store')}}" method="POST">
@csrf

<input type="hidden" id="bedmember" name="bedmember">

@foreach($variabled as $delbairav)
<input type="hidden" id="vari-{{$delbairav->id}}" name="vari-{{$delbairav->id}}" value="{{$delbairav->id}}">

<div class="form-group row">

    <label for="{{$delbairav->code}}" class="col-md-2 col-form-label text-md-right">{{$delbairav->title}}</label>

    <div class="col-md-8">

        <input id="{{$delbairav->code}}" type="number" step=".01" min="0" class="form-control @error($delbairav->code) is-invalid @enderror" name="{{$delbairav->code}}" required >

        @error($delbairav->code)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
</div>
@endforeach


<div class="col-md-8 offset-sm-2">
  <button id="submitBED" name="submitBED" type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>
            <br>


        </div>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    console.log('ready');
    $("#school").change(function() {
        $('#bedmember').val($('#school').val());
    });
});
</script>
@endsection