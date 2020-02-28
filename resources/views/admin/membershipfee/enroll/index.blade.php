
@extends('layouts.test')

@section('content')

   <meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Enroll Membership<a href="#"><button type="button" class="btn btn-outline-success float-right">+ Add Formula</button></a></div>
            </br>

<form>
<div class="form-group row">
	<label for="school" class="col-md-2 col-form-label text-md-right">School</label>
    	<div class="col-md-8">
		<select class="form-control" id="school" name="school">
			<option value=""> </option>
				@foreach($members as $member)
			<option value="{{$member->id}}">{{$member->school}}</option>
				@endforeach
		</select>
	</div>
</div>

<div class="form-group row">
  <label for="ed_level" class="col-md-2 col-form-label text-md-right">Education Level</label>
      <div class="col-md-8">
    <select class="form-control" id="ed_level" name="ed_level">
      <option></option>
      <option value="GS">Grade School</option>
      <option value="HS">High School</option>
      <option value="BED">Basic Education Program</option>
      <option value="COL">Tertiary Program</option>
      <option value="GED">Graduate Program</option>

    </select>
  </div>
</div>

<div class="form-group row" id="colradiobutton" style="display:none">
<div class="col-md-6 offset-sm-2">
<div class=" custom-control custom-radio custom-control-inline">

  <input type="radio" id="colsemester" name="colester" class="custom-control-input" value="SEMCOL">

  <label class=" custom-control-label" for="colsemester" required>Semester</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="coltrimester" name="colester" class="custom-control-input" value="TRICOL">
  <label class="custom-control-label" for="coltrimester">Trimester</label>
</div>
</div>
</div>



<div class="form-group row" id="gedradiobutton" style="display:none">
<div class="col-md-6 offset-sm-2">
<div class=" custom-control custom-radio custom-control-inline">

  <input type="radio" id="gedsemester" name="gedester" class="custom-control-input" value="SEMGED">

  <label class=" custom-control-label" for="gedsemester" required>Semester</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="gedtrimester" name="gedester" class="custom-control-input" value="TRIGED">
  <label class="custom-control-label" for="gedtrimester">Trimester</label>
</div>
</div>
</div>



</form>
<form id="formGS" name="formGS" style="display:none" action="{{ route('enrollmembership.gs')}}" method="POST">
@csrf
{{-- GS TOTAL ENROLLMENT --}}
<input type="hidden" id="gsname" name="gsname">
<div class="form-group row">
    <label for="gste" class="col-md-2 col-form-label text-md-right">Grade School Total Enrollment</label>

    <div class="col-md-8">
        <input id="gste" type="text" class="form-control @error('gste') is-invalid @enderror" name="gste" required>

        @error('gste')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- GS ANNUAL TUITION FEE --}}
<div class="form-group row">
    <label for="gsatf" class="col-md-2 col-form-label text-md-right">Grade School Annual Tuition Fee</label>

    <div class="col-md-8">
        <input id="gsatf" type="text" class="form-control @error('gsatf') is-invalid @enderror" name="gsatf" required>

        @error('gsatf')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="col-md-8 offset-sm-2">
  <button id="submitGS" name="submitGS" type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>
<form id="formHS" name="formHS" style="display:none" action="{{ route('enrollmembership.hs')}}" method="POST">
@csrf
{{-- HS TOTAL ENROLLMENT --}}
<input type="hidden" id="hsname" name="hsname">
<div class="form-group row">
    <label for="hste" class="col-md-2 col-form-label text-md-right">High School Total Enrollment</label>

    <div class="col-md-8">
        <input id="hste" type="text" class="form-control @error('hste') is-invalid @enderror" name="hste" required>

        @error('hste')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- HS ANNUAL TUITION FEE --}}
<div class="form-group row">
    <label for="hsatf" class="col-md-2 col-form-label text-md-right">High School Annual Tuition Fee</label>

    <div class="col-md-8">
        <input id="hsatf" type="text" class="form-control @error('hsatf') is-invalid @enderror" name="hsatf" required>

        @error('hsatf')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="col-md-8 offset-sm-2">
  <button id="submitHS" name="submitHS" type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>


<form id="formBED" name="formBED" style="display:none" action="{{ route('enrollmembership.bed')}}" method="POST">
  @csrf
{{-- BED GS TOTAL ENROLLMENT --}}
<input type="hidden" id="bedname" name="bedname">
<div class="form-group row">
    <label for="bedgste" class="col-md-2 col-form-label text-md-right">Grade School Total Enrollment</label>

    <div class="col-md-8">
        <input id="bedgste" type="text" class="form-control @error('bedgste') is-invalid @enderror" name="bedgste" required>

        @error('bedgste')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- BED GS ANNUAL TUITION FEE --}}
{{-- <div class="form-group row">
    <label for="bedgsatf" class="col-md-2 col-form-label text-md-right">Grade School Annual Tuition Fee</label>

    <div class="col-md-8">
        <input id="bedgsatf" type="text" class="form-control @error('bedgsatf') is-invalid @enderror" name="bedgsatf" required>

        @error('bedgsatf')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div> --}}
{{-- BED HS TOTAL ENROLLMENT --}}
<div class="form-group row">
    <label for="bedhste" class="col-md-2 col-form-label text-md-right">High School Total Enrollment</label>

    <div class="col-md-8">
        <input id="bedhste" type="text" class="form-control @error('bedhste') is-invalid @enderror" name="bedhste" required>

        @error('bedhste')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

{{-- BED HS ANNUAL TUITION FEE --}}
<div class="form-group row">
    <label for="bedatf" class="col-md-2 col-form-label text-md-right">High School Annual Tuition Fee</label>

    <div class="col-md-8">
        <input id="bedatf" type="text" class="form-control @error('bedatf') is-invalid @enderror" name="bedatf" required>

        @error('bedatf')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="col-md-8 offset-sm-2">
  <button id="submitBED" type="submitBED" class="btn btn-primary btn-block">Submit</button>
</div>
</form>


<form id="formSEMCOL" name="formSEMCOL" style="display:none">
{{-- COLL SEMESTER || TRISEMESTER --}}
<input type="hidden" id="semcolname" name="semcolname">
{{-- ACP --}}
<div class="form-group">
  <div class="col-md-8 offset-sm-2">
  <label for="semcolacp" >Accredited College Programs</label>
    <select class="form-control selectpicker " data-style="btn-info" data-live-search="true" multiple title="Check all that apply..." id="semcolacp">
      @foreach($acp as $pca)
        <option>{{$pca->program}}</option>
      @endforeach
    </select>
  </div>
</div>

{{-- COL SEMESTER || TRISEMESTER  ENROLLMENT TABLE--}}
<div class="col-md-8 offset-sm-2">
<table id="semcoltable" class="table table-dark" >
  <thead>
    <tr>
      <th scope="col">Programs</th>
      <th scope="col">1st Semester Enrollment</th>
      <th scope="col">2nd Semester Enrollment</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>datainput1</th>
      <td>datainput2</td>
      <td>datainput3</td>
      <th>datainput4</th>
    </tr>
  </tbody>
</table>
</div>

{{-- COL SEMESTER || TRISEMESTER  INPUT TO TABLE--}}
<div class="col-md-8 offset-sm-2">
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Programs">
    </div>
    <div class="col">
      <input type="number" step=".01" min="0" class="form-control" placeholder="1st Semester">
    </div>
    <div class="col">
      <input type="number" step=".01" min="0" class="form-control" placeholder="2nd Semester">
    </div>
  </div>
</br>
  <button id="submitSEMCOL" name="submitSEMCOL" type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>

<form id="formTRICOL" name="formTRICOL" style="display:none">
{{-- COLL SEMESTER || TRISEMESTER --}}
<input type="hidden" id="tricolname" name="tricolname">
{{-- ACP --}}
<div class="form-group">
  <div class="col-md-8 offset-sm-2">
  <label for="tricolacp" >Accredited College Programs</label>
    <select class="form-control selectpicker " data-style="btn-info" data-live-search="true" multiple title="Check all that apply..." id="tricolacp">
      @foreach($acp as $pca)
        <option>{{$pca->program}}</option>
      @endforeach
    </select>
  </div>
</div>

{{-- COL SEMESTER || TRISEMESTER  ENROLLMENT TABLE--}}
<div class="col-md-8 offset-sm-2">
<table id="tricoltable" class="table table-dark" >
  <thead>
    <tr>
      <th scope="col">Programs</th>
      <th scope="col">1st Semester Enrollment</th>
      <th scope="col">2nd Semester Enrollment</th>
      <th scope="col">3rd Semester Enrollment</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>datainput1</th>
      <td>datainput2</td>
      <td>datainput3</td>
      <th>datainput4</th>
      <th>datainput5</th>
    </tr>
  </tbody>
</table>
</div>

{{-- COL SEMESTER || TRISEMESTER  INPUT TO TABLE--}}
<div class="col-md-8 offset-sm-2">
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Programs">
    </div>
    <div class="col">
      <input type="number" step=".01" min="0" class="form-control" placeholder="1st Semester">
    </div>
    <div class="col">
      <input type="number" step=".01" min="0" class="form-control" placeholder="2nd Semester">
    </div>
    <div class="col">
      <input type="number" step=".01" min="0" class="form-control" placeholder="3rd Semester">
    </div>
  </div>
</br>
  <button id="submitTRICOL" name="submitTRICOL" type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>

<form id="formSEMGED" name="formSEMGED" style="display:none">
{{-- GED SEMESTER || TRISEMESTER --}}
<input type="hidden" id="semgedname" name="semgedname">
{{-- AGP --}}
  <div class="form-group">
    <div class="col-md-8 offset-sm-2">
    <label for="semgedacp">Accredited Graduate Programs</label>
    <select multiple class="form-control" id="semgedacp" size="6">
      @foreach($agp as $pga)
      <option>{{$pga->program}}</option>
      @endforeach
    </select>
  </div>
</div>
{{-- GED SEMESTER || TRISEMESTER  ENROLLMENT TABLE--}}
<div class="col-md-8 offset-sm-2">
<table id="gedtable" class="table table-dark" >
  <thead>
    <tr>
      <th scope="col">Programs</th>
      <th scope="col">1st Semester Enrollment</th>
      <th scope="col">2nd Semester Enrollment</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>datainput1</th>
      <td>datainput2</td>
      <td>datainput3</td>
      <th>datainput4</th>
    </tr>
  </tbody>
</table>
</div>
{{-- GED SEMESTER || TRISEMESTER  INPUT TO TABLE--}}
<div class="col-md-8 offset-sm-2">
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Programs">
    </div>
    <div class="col">
      <input type="number" step=".01" min="0" class="form-control" placeholder="1st Semester">
    </div>
    <div class="col">
      <input type="number" step=".01" min="0" class="form-control" placeholder="2nd Semester">
    </div>
  </div>
</br>
  <button id="submitSEMGED" name="submitSEMGED" type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>





<form id="formTRIGED" name="formTRIGED" style="display:none">
{{-- GED SEMESTER || TRISEMESTER --}}
<input type="hidden" id="trigedname" name="trigedname">
{{-- AGP --}}
  <div class="form-group">
    <div class="col-md-8 offset-sm-2">
    <label for="trigedacp">Accredited Graduate Programs</label>
    <select multiple class="form-control" id="trigedacp" size="6">
      @foreach($agp as $pga)
      <option>{{$pga->program}}</option>
      @endforeach
    </select>
  </div>
</div>
{{-- GED SEMESTER || TRISEMESTER  ENROLLMENT TABLE--}}
<div class="col-md-8 offset-sm-2">
<table id="gedtable" class="table table-dark" >
  <thead>
    <tr>
      <th scope="col">Programs</th>
      <th scope="col">1st Semester Enrollment</th>
      <th scope="col">2nd Semester Enrollment</th>
      <th scope="col">3rd Semester Enrollment</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>datainput1</th>
      <td>datainput2</td>
      <td>datainput3</td>
      <th>datainput4</th>
      <th>datainput5</th>
    </tr>
  </tbody>
</table>
</div>
{{-- GED SEMESTER || TRISEMESTER  INPUT TO TABLE--}}
<div class="col-md-8 offset-sm-2">
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Programs">
    </div>
    <div class="col">
      <input type="number" step=".01" min="0" class="form-control" placeholder="1st Semester">
    </div>
    <div class="col">
      <input type="number" step=".01" min="0" class="form-control" placeholder="2nd Semester">
    </div>
  </div>
</br>
  <button id="submitTRIGED" name="submitTRIGED" type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>

</br>
</br>



            </div>
        </div>
    </div>
</div>

  <script>

$(document).ready(function() {
        console.log('ready');
  $("#ed_level").change(function() {

    if ($(this).val() == "COL") {
    $('#semcolname').val($('#school').val());
    console.log('col');
    $("#formGS").hide();
    $("#formHS").hide();
    $("#formBED").hide();
    $("#formGED").hide();
    $("#gedradiobutton").hide();
    $("#colradiobutton").show();
    $("#formSEMGED").hide();
    $("#formTRIGED").hide();
    $("#formSEMCOL").hide();
    $("#formTRICOL").hide();
    
    $("#formCOL").show();
    }else if($(this).val() == "GS"){
    $('#gsname').val($('#school').val());
    // console.log();
    // $('#formCOL').hide();
    $('#formHS').hide();
    $('#formBED').hide();
    // $('#formGED').hide();
    $("#colradiobutton").hide();
    $("#gedradiobutton").hide();
    $("#formSEMGED").hide();
    $("#formTRIGED").hide();
    $("#formSEMCOL").hide();
    $("#formTRICOL").hide();

    $('#formGS').show();
    }else if($(this).val() == "HS"){
    $('#hsname').val($('#school').val());
    console.log('hs');
    // $('#formCOL').hide();
    $('#formGS').hide();
    $('#formBED').hide();
    // $('#formGED').hide();
    $("#colradiobutton").hide();
    $("#gedradiobutton").hide();
    $("#formSEMGED").hide();
    $("#formTRIGED").hide();
    $("#formSEMCOL").hide();
    $("#formTRICOL").hide();

      $('#formHS').show();
    }else if($(this).val() == "BED"){
    $('#bedname').val($('#school').val());
    console.log('bed');
    $('#formCOL').hide();
    $('#formGS').hide();
    $('#formHS').hide();
    // $('#formGED').hide();
    $("#colradiobutton").hide();
    $("#gedradiobutton").hide();
    $("#formSEMGED").hide();
    $("#formTRIGED").hide();
    $("#formSEMCOL").hide();
    $("#formTRICOL").hide();

    $('#formBED').show();
    }else if($(this).val() == "GED"){
    console.log('ged');
    // $('#formCOL').hide();
    $('#formGS').hide();
    $('#formHS').hide();
    $('#formBED').hide();
    $("#colradiobutton").hide();
    $("#formSEMGED").hide();
    $("#formTRIGED").hide();
    $("#formSEMCOL").hide();
    $("#formTRICOL").hide();
    $("#gedradiobutton").show();

    // $('#formGED').show();
    }else {
    console.log('elsu');
    // $('#formCOL').hide();
    $('#formGS').hide();
    $('#formHS').hide();
    $('#formBED').hide();
    // $('#formGED').hide();
    $("#colradiobutton").hide();
    $("#gedradiobutton").hide();
          $("#formSEMGED").hide();
          $("#formTRIGED").hide();
          $("#formSEMCOL").hide();
          $("#formTRICOL").hide();
    }
  });

// $('#exampleFormControlSelect2').on('change', function()
// {
//     alert( this.value );
// });

});


$('#colsemester, #coltrimester').change(function(){
    switch($(this).val()) {
    case 'SEMCOL':
      // alert("semcol");
          $("#formTRICOL").hide();
          $("#formSEMCOL").show();
    break;
    case 'TRICOL':
      // alert("tricol");
          $("#formSEMCOL").hide();
          $("#formTRICOL").show();
    break;
    default:
      alert("error");
  }  
  })

$('#colsemester, #coltrimester').change(function(){
    switch($(this).val()) {
    case 'SEMCOL':
      // alert("semcol");
          $("#formSEMGED").hide();
          $("#formTRIGED").hide();

          $("#formTRICOL").hide();
          $("#formSEMCOL").show();
    break;
    case 'TRICOL':
      // alert("tricol");
          $("#formSEMGED").hide();
          $("#formTRIGED").hide();

          $("#formSEMCOL").hide();
          $("#formTRICOL").show();
    break;
    default:
      alert("error");
  }  
  })

$('#gedsemester, #gedtrimester').change(function(){
    switch($(this).val()) {
    case 'SEMGED':
      // alert("semged");
          $("#formSEMCOL").hide();
          $("#formTRICOL").hide();

          $("#formTRIGED").hide();
          $("#formSEMGED").show();
    break;
    case 'TRIGED':
      // alert("triged");
          $("#formSEMCOL").hide();
          $("#formTRICOL").hide();

          $("#formSEMGED").hide();
          $("#formTRIGED").show();
    break;
    default:
      alert("error");
  }  
  })



 $('#exampleFormControlSelect1').change(function () {
        var selectedItem = $('.selectpicker').val();
        alert(selectedItem);
    });

  // $('#exampleFormControlSelect2').change(function () {
  //       var selectedItem = $('#exampleFormControlSelect2').val();
  //       alert(selectedItem);
  //   });

$('table').each(function() {
    if($(this).find('tr').children("td").length < 1) {
        $(this).hide();
    }
});
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

    // $('#submitGS').click(function (e) {
    //     e.preventDefault();
    //     $(this).html('Sending..');
    
    //     $.ajax({
    //       data: $('#formGS').serialize(),
    //       url: "{{ route('enrollmembership.gs') }}",
    //       type: "POST",
    //       dataType: 'json',
    //       success: function (data) {
    //  $(this).html('Submit');
    //           // $('#productForm').trigger("reset");
    //           // $('#ajaxModel').modal('hide');
    //           // table.draw();
    //     $('div.flash-message').html(data);
         
    //       },
    //       error: function (data) {
    //           console.log('Error:', data);
    //           $('#submitGS').html('Save Changes');
    //       }
    //   });
    // });

</script>

@endsection
