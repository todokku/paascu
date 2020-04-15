@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Graduate Education Trimester Edit Membership<a href="{{ route('gedtrimembership.index') }}"><button type="button" class="btn btn-outline-success float-right">View Trimester Memberships</button></a></h4>
            <br>



                <div class="card-body">


                                                <div class="form-group row">
                            <label for="school" class="col-md-2 col-form-label text-md-right">School</label>
                            <div class="col-md-8">
                            <select class="form-control" id="school" name="school" readonly>
                            <option value="{{$school->id}}" readonly>{{$school->school}}</option>
                            </select>
                            </div>
                        </div>


<form action="{{ route('gedtrienrollment.update')}}" method="POST">
    <div class="form-group row">
        <input type="hidden" name="id" value = "{{$memid}}">
        <input type="hidden" name="cid" value = "{{$contid}}">
        <input type="hidden" id="agpx" name="agpx">
    </div>

<div class="form-group row">
    <label for="agp" class="col-md-2 col-form-label text-md-right">Accredited Graduate Programs</label>
        <div class="col-md-8">
{{--     country --}}
    <select name="agp[]" id="agp" class="selectpicker form-control input-lg " multiple data-live-search="true" title="Check All Accredited Graduate Programs" >
                @foreach($agpall as $llagca)
            <option value="{{$llagca->id}}" >{{$llagca->program}}</option>
                @endforeach
    </select>
        </div>
</div>

<div class="col-md-8 offset-sm-2">
<table id="example" class="display table table-hover table-sm" style="width:100%">
        <thead>
            <tr>
      <th style="width: 40%;">Program</th>
      <th style="width: 20%;">1st Semester</th>
      <th style="width: 20%;">2nd Semester</th>
      <th style="width: 20%;">3rd Semester</th>
            </tr>
        </thead>
        <tbody>
            @foreach($program as $rebmem)
            <tr>
                <td>{{$rebmem->program}}</td>
                <td><input id="{{"f".$rebmem->id}}" type="number" step=".01" min="0" class="form-control @error("f".$rebmem->id) is-invalid @enderror price" name="{{"f".$rebmem->id}}" value="{{$rebmem->semone}}"></td>
                <td><input id="{{"s".$rebmem->id}}" type="number" step=".01" min="0" class="form-control @error("s".$rebmem->id) is-invalid @enderror price" name="{{"s".$rebmem->id}}" value="{{$rebmem->semtwo}}"></td>
                <td><input id="{{"t".$rebmem->id}}" type="number" step=".01" min="0" class="form-control @error("s".$rebmem->id) is-invalid @enderror price" name="{{"t".$rebmem->id}}" value="{{$rebmem->semthree}}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="form-group row">
    <div class="col-md-6 offset-sm-2">
        <div class=" custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="active" {{ ($compute->status == 'active')? "checked" : "" }}>
            <label class=" custom-control-label" for="customRadioInline1">Active</label>
        </div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="deactive" {{ ($compute->status == 'deactive')? "checked" : "" }}>
            <label class="custom-control-label" for="customRadioInline2">Deactive</label>
</div>
    </div>
</div>

@foreach($membership as $pihsrebmem)
<div class="form-group row">
    <label for="{{$pihsrebmem->id}}" class="col-md-2 col-form-label text-md-right">{{$pihsrebmem->variables->title}}</label>
        <div class="col-md-8">
            <input id="{{$pihsrebmem->variables->code}}" type="text" class="form-control @error('{{$pihsrebmem->variables->code}}') is-invalid @enderror" name="{{$pihsrebmem->id}}" value="{{$pihsrebmem->content}}" required autocomplete="program" autofocus>

                @error('{{$pihsrebmem->id}}')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
</div>
@endforeach

    @csrf
        <div class="col-md-12">      
    <button type="submit" style="width: 100px;" class="btn btn-primary float-right">update</button>
</div>
</form>





</div>


            </div>
        </div>
    </div>
</div>

<script>
    var agparray = @json($agparray);
$(document).ready(function() {
    //on agp dropdown change

    $('.selectpicker').selectpicker('val', agparray); 
   $('#agpx').val($('#agp').val());
    $("#ged_tri_total_enrollment").attr('readonly', true); 
    $('form :input.price').change(function(){
var input = 0.00;
//  console.log(val);
$("form :input.price").each(function(){

 input = Number($(this).val()) + input; // This is the jquery object of the input, do what you will

 console.log(input);
});

$("#ged_tri_total_enrollment").val(input.toFixed(2));

});
    $("#agp").change(function() {   
   $('#agpx').val($('#agp').val());

});
});
</script>

@endsection

