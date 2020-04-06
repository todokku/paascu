@extends('layouts.test')

@section('content')

{{--    <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Enroll Graduate Education Membership</h4>
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

  <input type="radio" id="gedsemester" name="status" class="custom-control-input" value="Semester">

  <label class=" custom-control-label" for="gedsemester">Semester</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="gedtrimester" name="status" class="custom-control-input" value="Trimester">
  <label class="custom-control-label" for="gedtrimester">Trimester</label>
</div>
</div>
</div>

</form>

<div class="col-md-8 offset-sm-2">
<form style="display:none" id="formGED" name="formGED" action="{{ route('gedsemenrollment.index')}}" method="POST">
<input type="hidden" id="gedsemid" name="gedsemid">
@csrf
<button id="submitGED" name="submitGED" type="submit" class="btn btn-primary btn-block">Submit</button>

</form>
{{-- make as tri --}}
<form style="display:none" id="formTRI" name="formTRI" action="{{ route('gedtrienrollment.index')}}" method="POST">
<input type="hidden" id="gedtriid" name="gedtriid">
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
//this checks if anything selected and shows the submit
    if($('#gedsemester').prop("checked")) {
        $("#formTRI").hide();
        $("#formGED").show(); 
    }
    if($('#gedtrimester').prop("checked")) {
        $("#formGED").hide();
        $("#formTRI").show();
    }
//sending ids based on selection of school
    console.log('ready');
    $("#school").change(function() {
        $('#gedsemid').val($('#school').val());
        $('#gedtriid').val($('#school').val());
    });
//radio button on change
$('#gedsemester, #gedtrimester').change(function(){
    switch($(this).val()) {
    case 'Semester':
    $("#formTRI").hide();
    $("#formGED").show();


    break;
    case 'Trimester':
    $("#formGED").hide();
    $("#formTRI").show();


    break;
    default:
        $("#formGED").hide();
        $("#formTRI").hide();
      alert("error");
  }  
  })



});
</script>


@endsection