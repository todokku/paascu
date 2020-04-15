@extends('layouts.test')

@section('content')

{{--    <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Enroll Graduate Education Membership<a href="{{ route('gedtrimembership.index') }}"><button type="button" class="btn btn-outline-success float-right">View Trimester Memberships</button><a href="{{ route('gedsemmembership.index') }}"><button type="button" class="btn btn-outline-success float-right mr-2">View Semester Memberships</button></a></h4>
            <br>
<form>
{{-- <div class="form-group row">
	<label for="school" class="col-md-2 col-form-label text-md-right">School</label>
    	<div class="col-md-8">
		<select class="form-control selectpicker" id="school" name="school" data-live-search="true" data-style="btn-info" title="Select School...">
			<option value=""> </option>
				@foreach($members as $srebmem)
			<option value="{{$srebmem->id}}" >{{$srebmem->school}}</option>

				@endforeach
		</select>
	</div>
</div> --}}
<div class="form-group row">
    <label for="school" class="col-md-2 col-form-label text-md-right">School</label>
        <div class="col-md-8">
{{--     country --}}
    <select name="school" id="school" class="selectpicker form-control input-lg dynamic" data-dependent="program" data-live-search="true" title="Select School" >
                @foreach($members as $srebmem)
            <option value="{{$srebmem->id}}" >{{$srebmem->school}}</option>

                @endforeach
    </select>
        </div>
</div>
   <br />
<div class="form-group row">
    <label for="agp" class="col-md-2 col-form-label text-md-right">Accredited Graduate Programs</label>
        <div class="col-md-8">
{{--     country --}}
    <select name="agp[]" id="agp" class="selectpicker form-control input-lg " multiple data-live-search="true" title="Check All Accredited Graduate Programs">
                @foreach($agp as $pca)
            <option value="{{$pca->id}}" >{{$pca->program}}</option>
                @endforeach
    </select>
        </div>
</div>
<div class="form-group row">
    <label for="program" class="col-md-2 col-form-label text-md-right">Programs</label>
        <div class="col-md-8">
{{--     state --}}
    <select name="program[]" id="program" class="selectpicker form-control input-lg " multiple data-dependent="city" title="Check All Programs">
    </select>
   </div>
      </div>
   <br />
{{--    <div class="form-group"> --}}
{{--    city --}}
{{--     <select name="city" id="city" class="form-control input-lg">
     <option value="">Select City</option>
                 <option value="21" >22</option>
    </select>
   </div> --}}
   {{ csrf_field() }}
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

    <div class="col-md-12">
{{-- placeholder button --}}
   <br />
<button id="pholder" style="width: 100px;" name="pholder" type="button" class="btn btn-success float-right" disabled>Submit</button>

<form style="display:none" id="formGED" name="formGED" action="{{ route('gedsemenrollment.index')}}" method="POST">
<input type="hidden" id="gedsemid" name="gedsemid">
<input type="hidden" id="gedsemagp" name="gedsemagp">
<input type="hidden" id="gedsemprogram" name="gedsemprogram">
@csrf
<button id="submitGED" style="width: 100px;" name="submitGED" type="submit" class="btn btn-success float-right">Submit</button>

</form>
{{-- make as tri --}}
<form style="display:none" id="formTRI" name="formTRI" action="{{ route('gedtrienrollment.index')}}" method="POST">
<input type="hidden" id="gedtriid" name="gedtriid">
<input type="hidden" id="gedtriagp" name="gedtriagp">
<input type="hidden" id="gedtriprogram" name="gedtriprogram">
@csrf
<button id="submitTRI" style="width: 100px;" name="submitTRI" type="submit" class="btn btn-success float-right">Submit</button>
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
      //clearing the slate just from backing to previous page
      $('#school').val('');
        $('#agp').val('');
          $('#program').val('');
$('input[name="status"]').prop('checked', false);
//this checks if anything selected and shows the submit
    if($('#gedsemester').prop("checked")) {
        $("#pholder").hide();
        $("#formTRI").hide();
        $("#formGED").show(); 
    }
    if($('#gedtrimester').prop("checked")) {
        $("#pholder").hide();
        $("#formGED").hide();
        $("#formTRI").show();
    }
//sending ids based on selection of school
    $("#school").change(function() {
        $('#gedsemid').val($('#school').val());
        $('#gedtriid').val($('#school').val());
  if($(this).val() != '')
  {
   var select = $(this).attr("id");

   var value = $(this).val();

   var dependent = $(this).data('dependent');

   var _token = $('input[name="_token"]').val();

   $.ajax({
    url:"{{ route('gedenrollment.fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
     $('#'+dependent).selectpicker('refresh');
    }

   })
  }
        $("#agp").val('').selectpicker("refresh");
  $('#program').val('');
    });

//on agp dropdown change
$("#agp").change(function() {   
   $('#gedsemagp').val($('#agp').val());
   $('#gedtriagp').val($('#agp').val());
});
//on program dropdown change
$("#program").change(function() {   
   $('#gedsemprogram').val($('#program').val());
   $('#gedtriprogram').val($('#program').val());
});    
//radio button on change
$('#gedsemester, #gedtrimester').change(function(){
    switch($(this).val()) {
    case 'Semester':
    $("#pholder").hide();
    $("#formTRI").hide();
    $("#formGED").show();


    break;
    case 'Trimester':
    $("#pholder").hide();
    $("#formGED").hide();
    $("#formTRI").show();


    break;
    default:
        $("#formGED").hide();
        $("#formTRI").hide();
        $("#pholder").hide();
      alert("error");
  }  
  })



});
</script>


@endsection