@extends('layouts.test')

@section('content')

{{--    <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Enroll College Membership<a href="{{ route('coltrimembership.index') }}"><button type="button" class="btn btn-outline-success float-right">View Trimester Memberships</button><a href="{{ route('colsemmembership.index') }}"><button type="button" class="btn btn-outline-success float-right mr-2">View Semester Memberships</button></a></h4>
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
    <select name="school" id="school" class="selectpicker form-control input-lg dynamic @error('colsemid') is-invalid @enderror @error('coltriid') is-invalid @enderror" data-dependent="program" data-live-search="true" title="Select School" >
                @foreach($members as $srebmem)
            <option value="{{$srebmem->id}}" >{{$srebmem->school}}</option>

                @endforeach
    </select>
                @error('colsemid')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('coltriid')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>
</div>
   <br />
<div class="form-group row">
    <label for="acp" class="col-md-2 col-form-label text-md-right">Accredited College Programs</label>
        <div class="col-md-8">
{{--     country --}}
    <select name="acp[]" id="acp" class="selectpicker form-control input-lg @error('colsemacp') is-invalid @enderror @error('coltriacp') is-invalid @enderror" multiple data-live-search="true" title="Check All Accredited College Programs">
                @foreach($acp as $pca)
            <option value="{{$pca->id}}" >{{$pca->program}}</option>
                @endforeach
    </select>
                    @error('colsemacp')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('coltriacp')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>
</div>

<div class="form-group row">
    <label for="program" class="col-md-2 col-form-label text-md-right">Programs</label>
        <div class="col-md-8">
{{--     state --}}
    <select name="program[]" id="program" class="selectpicker form-control input-lg @error('colsemprogram') is-invalid @enderror @error('coltriprogram') is-invalid @enderror" multiple data-dependent="city" title="Check All Programs">
    </select>
                @error('colsemprogram')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                @error('coltriprogram')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
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

  <input type="radio" id="colsemester" name="status" class="custom-control-input" value="Semester">

  <label class=" custom-control-label" for="colsemester">Semester</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="coltrimester" name="status" class="custom-control-input" value="Trimester">
  <label class="custom-control-label" for="coltrimester">Trimester</label>
</div>
</div>
</div>

</form>

    <div class="col-md-12">
{{-- placeholder button --}}
   <br />
<button id="pholder" style="width: 100px;" name="pholder" type="button" class="btn btn-success float-right" disabled>Submit</button>

<form style="display:none" id="formCOL" name="formCOL" action="{{ route('colsemenrollment.index')}}" method="POST">
<input type="hidden" id="colsemid" name="colsemid">
<input type="hidden" id="colsemacp" name="colsemacp">
<input type="hidden" id="colsemprogram" name="colsemprogram">
@csrf
<button id="submitCOL" style="width: 100px;" name="submitCOL" type="submit" class="btn btn-success float-right">Submit</button>

</form>
{{-- make as tri --}}
<form style="display:none" id="formTRI" name="formTRI" action="{{ route('coltrienrollment.index')}}" method="POST">
<input type="hidden" id="coltriid" name="coltriid">
<input type="hidden" id="coltriacp" name="coltriacp">
<input type="hidden" id="coltriprogram" name="coltriprogram">
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
        $('#acp').val('');
          $('#program').val('');
$('input[name="status"]').prop('checked', false);
//this checks if anything selected and shows the submit
    if($('#colsemester').prop("checked")) {
        $("#pholder").hide();
        $("#formTRI").hide();
        $("#formCOL").show(); 
    }
    else if($('#coltrimester').prop("checked")) {
        $("#pholder").hide();
        $("#formCOL").hide();
        $("#formTRI").show();
    }
//on school dropdown change
    $("#school").change(function() {
        $('#colsemid').val($('#school').val());
        $('#coltriid').val($('#school').val());
  if($(this).val() != '')
  {
   var select = $(this).attr("id");

   var value = $(this).val();

   var dependent = $(this).data('dependent');

   var _token = $('input[name="_token"]').val();

   $.ajax({
    url:"{{ route('colenrollment.fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
     $('#'+dependent).selectpicker('refresh');
    }

   })
  }
        $("#acp").val('').selectpicker("refresh");
  $('#program').val('');

    });


//on acp dropdown change
$("#acp").change(function() {   
   $('#colsemacp').val($('#acp').val());
   $('#coltriacp').val($('#acp').val());
});
//on program dropdown change
$("#program").change(function() {   
   $('#colsemprogram').val($('#program').val());
   $('#coltriprogram').val($('#program').val());
});

//radio button on change
$('#colsemester, #coltrimester').change(function(){
    switch($(this).val()) {
    case 'Semester':
    $("#pholder").hide();
    $("#formTRI").hide();
    $("#formCOL").show();


    break;
    case 'Trimester':
    $("#pholder").hide();
    $("#formCOL").hide();
    $("#formTRI").show();


    break;
    default:
        $("#formCOL").hide();
        $("#formTRI").hide();
        $("#pholder").hide();
      alert("error");
  }  
  })
});
</script>


@endsection