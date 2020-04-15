@extends('layouts.test')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Enroll High School Membership<a href="{{ route('hsmembership.index') }}"><button type="button" class="btn btn-outline-success float-right">View High School Memberships</button></a></h4>

<br>

<form>
    <div class="form-group row">
	<label for="school" class="col-md-2 col-form-label text-md-right">School</label>
        <div class="col-md-8">
		<select class="form-control selectpicker" id="school" name="school" data-live-search="true" title="Select High School">
		@foreach($members as $srebmem)
		  <option value="{{$srebmem->id}}">{{$srebmem->school}}</option>
		@endforeach
		</select>
	    </div>
    </div>
</form>

<form id="formHS" name="formHS" action="{{ route('hsenrollment.store')}}" method="POST">
    @csrf
    <input type="hidden" id="hsmember" name="hsmember">
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
    <div class="col-md-12">
    <button id="submitHS" style="width: 100px;" name="submitHS" type="submit" class="btn btn-success float-right">Submit</button>
    </div>
</form>

<br>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {
    $("#school").change(function() {
    $('#hsmember').val($('#school').val());
    });
});

</script>

@endsection