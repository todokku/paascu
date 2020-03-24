@extends('layouts.test')

@section('content')

{{--    <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Enroll College Membership</h4>
            <br>
<form>
<div class="form-group row">
	<label for="school" class="col-md-2 col-form-label text-md-right">School</label>
    	<div class="col-md-8">
		<select class="form-control selectpicker" id="school" name="school" data-live-search="true" data-style="btn-info" title="Select School...">
			<option value=""> </option>
				@foreach($members as $srebmem)
			<option value="{{$srebmem->id}}" >{{$srebmem->school}}</option>

				@endforeach
		</select>
	</div>
</div>

                <div class="form-group row">
                <div class="col-md-6 offset-sm-2">
<div class=" custom-control custom-radio custom-control-inline">

  <input type="radio" id="colsemester" name="status" class="custom-control-input" value="Semester" active>

  <label class=" custom-control-label" for="colsemester">Semester</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="coltrimester" name="status" class="custom-control-input" value="Trimester">
  <label class="custom-control-label" for="coltrimester">Trimester</label>
</div>
</div>
</div>

</form>

<div class="col-md-8 offset-sm-2">
<form id="formCOL" name="formCOL" action="{{ route('colsemenrollment.index')}}" method="POST">
<input type="hidden" id="colsemid" name="colsemid">
@csrf
<button id="submitCOL" name="submitCOL" type="submit" class="btn btn-primary btn-block">Submit</button>

</form>
{{-- make as tri --}}
<form style="display:none" id="formTRI" name="formTRI" action="{{ route('colsemenrollment.index')}}" method="POST">
<input type="hidden" id="coltriid" name="coltriid">
@csrf
<button id="submitTRI" name="submitTRI" type="submit" class="btn btn-primary btn-block">Submit</button>
</form>

</div>
{{-- </form> --}}
            <br>


        </div>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    console.log('ready');
    $("#school").change(function() {
        $('#colsemid').val($('#school').val());
        $('#coltriid').val($('#school').val());
    });

$('#colsemester, #coltrimester').change(function(){
    switch($(this).val()) {
    case 'Semester':
    $("#formTRI").hide();
    $("#formCOL").show();


    break;
    case 'Trimester':
    $("#formCOL").hide();
    $("#formTRI").show();


    break;
    default:
        $("#formCOL").hide();
        $("#formTRI").hide();
      alert("error");
  }  
  })



});
</script>


@endsection