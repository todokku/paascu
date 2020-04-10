@extends('layouts.test')

@section('content')

{{--    <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Enroll College Membership (Trimester)</h4>
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

</form>




<form id="formCOLTRI" name="formCOLTRI" action="{{ route('coltrienrollment.store')}}" method="POST">
@csrf

<input type="hidden" id="coltrimember" name="coltrimember" value="{{$members->id}}">

<div class="form-group row">
    <label for="acp" class="col-md-2 col-form-label text-md-right">Accredited College Programs</label>
        <div class="col-md-8">
        <select class="form-control selectpicker" id="acp" name="acp" multiple data-live-search="true" data-style="btn-info" title="Please Select ...">
            <option value=""> </option>
      @foreach($acp as $pca)
            <option>{{$pca->program}}</option>
                @endforeach
        </select>
    </div>
</div>

<div class="col-md-8 offset-sm-2">
<table id="example" class="display table table-hover table-sm" style="width:100%">
        <thead>
            <tr>
      <th style="width: 30%;">Program</th>
      <th style="width: 23.33%;">1st Trimester</th>
      <th style="width: 23.33%;">2nd Trimester</th>
      <th style="width: 23.33%;">3rd Trimester</th>
{{--       <th style="width: 10%;">Total</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $rebmem)
            <tr>
                <td>{{$rebmem->program}}</td>
                <td><input id="{{"f".$rebmem->id}}" type="number" step=".01" min="0" class="form-control @error("f".$rebmem->id) is-invalid @enderror" name="price" ></td>
                <td><input id="{{"s".$rebmem->id}}" type="number" step=".01" min="0" class="form-control @error("s".$rebmem->id) is-invalid @enderror" name="price" ></td>
                <td><input id="{{"t".$rebmem->id}}" type="number" step=".01" min="0" class="form-control @error("t".$rebmem->id) is-invalid @enderror" name="price" ></td>
{{--                 <td><input id="{{"s".$rebmem->id}}" type="number" step=".01" min="0" class="form-control @error("s".$rebmem->id) is-invalid @enderror" name="tprice" required></td> --}}

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{--   <div class="row">
    <div class="col offset-sm-2">
first sem 
    </div>
    <div class="col">
second sem
            </div>
  </div>
@foreach($members->programs as $rebmem)

<div class="form-group row">

    <label for="{{$rebmem->id}}" class="col-md-2 col-form-label text-md-right">{{$rebmem->program}}</label>

    <div class="col-md-8">


  <div class="row">
    <div class="col">
        <input id="{{"f".$rebmem->id}}" type="number"  class="form-control zzz @error("f".$rebmem->id) is-invalid @enderror" name="price" required>
    </div>
    <div class="col">
        <input id="{{"s".$rebmem->id}}" type="number"  class="form-control zzz @error("s".$rebmem->id) is-invalid @enderror" name="price" required>
    </div>
  </div>

        @error("f".$rebmem->id)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

                @error("s".$rebmem->id)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
</div>
@endforeach --}}




@foreach($variabled as $delbairav)
{{-- @if( strcmp($delbairav->title, '21 Units') == 0)
  @break
@endif --}}
<input type="hidden" id="vari-{{$delbairav->id}}" name="vari-{{$delbairav->id}}" value="{{$delbairav->id}}">

<div class="form-group row">

    <label for="{{$delbairav->code}}" class="col-md-2 col-form-label text-md-right">{{$delbairav->title}}</label>

    <div class="col-md-8">

        <input id="{{$delbairav->code}}" type="number" step=".01" min="0" class="form-control @error($delbairav->code) is-invalid @enderror" name="{{$delbairav->code}}" required value="{{ $delbairav->def_val != 0.00 ? floor($delbairav->def_val) : '' }}" >

        @error($delbairav->code)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
</div>
@endforeach

<div class="col-md-8 offset-sm-2">
  <button id="submitCOLTRI" name="submitCOLTRI" type="submit" class="btn btn-primary btn-block">Submit</button>
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
        $('#coltrimember').val($('#school').val());
    });
//  val = 0;
// $( "#submitCOLSEM" ).click(function() {
//         console.log("1");

// //  $("#formCOLSEM input[name=sprice]").each(function() {      
// //     val = parseInt($(this).attr('value')) + parseInt(val);
// //  });
// var input = 0;
// //  console.log(val);
// $("form#formCOLSEM :input[name=price]").each(function(){
//  input = Number($(this).val()) + input; // This is the jquery object of the input, do what you will
//  console.log(input);
// });
// });
 


$('form#formCOLTRI :input[name=price]').change(function(){
var input = 0.00;
//  console.log(val);
$("form#formCOLTRI :input[name=price]").each(function(){

 input = Number($(this).val()) + input; // This is the jquery object of the input, do what you will

 console.log(input);
});

$("#col_tri_total_enrollment").val(input.toFixed(2));
});

// $('.fprice').blur(function () {
//     var sum = 0;
//     $('.fprice').each(function() {
//         sum += Number($(this).val());
//     });

//     console.log(sum);
// });​​​​​​​​​

// (function() {
//     $('form > input').keyup(function() {

//         var empty = false;
//         $('form > input').each(function() {
//             if ($(this).val() == '') {
//                 empty = true;
//             }
//         });

//         if (empty) {
//             $('.fprice').attr('disabled', 'disabled'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
//         } else {
//             $('.fprice').removeAttr('disabled'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
//         }
//     });
// })()

$(document).ready(function() {
    $('#example').DataTable({
        responsive: true,
        paging: false,
        info: false,
        bFilter: false,
        columnDefs: 
        [
            { orderable: false, targets: _all }
        ],
      });
} );
});
</script>


@endsection