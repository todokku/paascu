@extends('layouts.test')

@section('content')
{{--    <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$formula->formula_id}} Edit Formula</div>

                <div class="card-body">


                <form action="{{ route('admin.membershipformula.update')}}" method="POST">
<div class="form-group row">
        <input type="hidden" name="id" value = "{{$formula->id}}">
        <input type="hidden" name="ed_type" value = "{{$formula->formula_id}}">
 </div>
 
                        <div class="form-group row">
                            <label for="formula" class="col-md-2 col-form-label text-md-right">Current Formula</label>

                            <div class="col-md-10">
                                <input id="formula" type="text" class="form-control @error('formula') is-invalid @enderror" name="formula" value="{{ $formula->formula }}" required autocomplete="formula" disabled>

                                @error('formula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newformula" class="col-md-2 col-form-label text-md-right">New Formula</label>

                            <div class="col-md-10">
                                <input id="newformula" type="text" class="form-control @error('newformula') is-invalid @enderror" name="newformula" placeholder="Select New Varables" required autocomplete="newformula" readonly>

                                @error('newformula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
    <label for="school" class="col-md-2 col-form-label text-md-right">Variable Input</label>
        <div class="col-md-10">
        <select class="form-control selectpicker" id="school" name="school" data-live-search="true" title="Select Variable"   >
            <option value=""> </option>
                @foreach($variable as $elbairav)
            <option value="{{$elbairav->id}}">{{$elbairav->code}}</option>
                @endforeach
        </select>
    </div>
</div>

 <div class="form-group row">
    <div class="col offset-md-3">
      <button id="btnocom" type="button" class="btn btn-outline-primary">(</button> 
    </div>
    <div class="col">
      <button id="btnccom" type="button" class="btn btn-outline-primary">)</button>
    </div>
    <div class="col">
     <button id="btnadd" type="button" class="btn btn-outline-primary">+</button>
    </div>
    <div class="col">
      <button id="btnmin" type="button" class="btn btn-outline-primary">-</button>
    </div>
    <div class="col">
      <button id="btnmul" type="button" class="btn btn-outline-primary">*</button>
    </div>
    <div class="col">
      <button id="btndiv" type="button" class="btn btn-outline-primary">/</button>
    </div>

  </div>
</br>

                  @csrf
                  {{ method_field('PUT')}}
                  
                  <button type="submit" class="btn btn-outline-success float-right">update</button>
                  <button id="btnclr" style="margin-right: 5px;" type="reset" class="btn btn-outline-secondary float-right">clear</button>
                </form>


                </div>


            </div>
        </div>



 <div class="col-md-12">
            <div class="card">
                <div class="card-header">Insert New Variable</div>

                <div class="card-body">


<form action="{{ route('admin.membershipformula.updatevariable')}}" method="POST">
<div class="form-group row">
        <input type="hidden" id="newvared_type" name="newvared_type" value = "{{$formula->formula_id}}">
 </div>
 
                        <div class="form-group row">
                            <label for="newvartitle" class="col-md-2 col-form-label text-md-right">Variable Title</label>

                            <div class="col-md-10">
                                <input id="newvartitle" type="text" class="form-control @error('newvartitle') is-invalid @enderror" name="newvartitle" placeholder="ex. Example Fee" required autocomplete="newvartitle" >

                                @error('newvartitle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newvariable" class="col-md-2 col-form-label text-md-right">Variable</label>

                            <div class="col-md-10">
                                <input id="newvariable" type="text" class="form-control @error('newvariable') is-invalid @enderror" name="newvariable" placeholder="ex. gs_example_fee" required autocomplete="newvariable">

                                @error('newvariable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                  @csrf
                  
                  <button type="submit" class="btn btn-success float-right">Create</button>
                </form>


                </div>


            </div>
        </div>




    </div>
</div>
<script>
$(document).ready(function() {
        console.log('ready');
var formulaAppend ="";
  $("#school").change(function() {
formulaAppend += $("#school option:selected").text()+" ";
$('#newformula').val(formulaAppend); 
$('#school').val(' '); 
  });
$('#btnadd').click(function(){
formulaAppend += "+ ";
$('#newformula').val(formulaAppend); 
});
$('#btnmin').click(function(){
formulaAppend += "- ";
$('#newformula').val(formulaAppend); 
});
$('#btnmul').click(function(){
formulaAppend += "* ";
$('#newformula').val(formulaAppend); 
});
$('#btndiv').click(function(){
formulaAppend += "/ ";
$('#newformula').val(formulaAppend); 
});
$('#btnocom').click(function(){
formulaAppend += "( ";
$('#newformula').val(formulaAppend); 
});
$('#btnccom').click(function(){
formulaAppend += ") ";
$('#newformula').val(formulaAppend); 
});
$('#btnclr').click(function(){
formulaAppend = "";
});

});
</script>
@endsection


