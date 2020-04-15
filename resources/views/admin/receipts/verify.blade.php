@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Original Reciept Verification</h4>

                <div class="card-body">


                <form action="{{ route('receipts.upload')}}" method="POST" enctype="multipart/form-data">
<div class="form-group row">
        <input type="hidden" name="idc" value = "{{$idc}}">
        <input type="hidden" name="idp" value = "{{$idp}}">
 </div>
 
{{--                 <div class="form-group row">
                <div class="col-md-6 offset-sm-2">
<div class=" custom-control custom-radio custom-control-inline">

  <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="active" {{ ($compute->verified == 'verified')? "checked" : "" }}>

  <label class=" custom-control-label" for="customRadioInline1">Verify</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="deactive" {{ ($compute->verified == 'pending')? "checked" : "" }}>
  <label class="custom-control-label" for="customRadioInline2">Pending</label>
</div>
</div>
                </div> --}}

                        <div class="form-group row">
                            <label for="school" class="col-md-2 col-form-label text-md-right">School</label>

                            <div class="col-md-8">
                                <input id="school" type="text" class="form-control @error('school') is-invalid @enderror" name="school" value="{{ $member->school }}" readonly="">

                                @error('school')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                                                <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">Upload Original Reciept</label>

                            <div class="col-md-8">
             
                                <img src="{!! asset('receipt/' . $compute->receipt) !!}" width="250" height="250">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


<div class="col-md-8 offset-sm-2">
<table id="example" class="display table table-hover table-sm" style="width:100%">
        <thead>
            <tr>
      <th style="width: 40%;">Program</th>
      <th style="width: 25%;">Accreditation Level</th>
      <th style="width: 25%;">Valid Until</th>
{{--       <th style="width: 10%;">Total</th> --}}
            </tr>
        </thead>
        <tbody>
@foreach($progdata as $pd)
            <tr>
                <td>{{$pd->program}}</td>
                <td><input id="{{"f".$pd->id}}" type="text" class="form-control @error("f".$pd->id) is-invalid @enderror" name="{{"f".$pd->id}}" value="{{$pd->level}}"></td>
                <td><input id="{{"s".$pd->id}}" type="text" class="form-control @error("s".$pd->id) is-invalid @enderror" name="{{"s".$pd->id}}" value="{{$pd->valid}}"></td>
{{--                 <td><input id="{{"s".$rebmem->id}}" type="number" step=".01" min="0" class="form-control @error("s".$rebmem->id) is-invalid @enderror" name="tprice" required></td> --}}

            </tr>
            @endforeach
        </tbody>
    </table>
</div>


                  @csrf
{{--                   {{ method_field('PUT')}} --}}
                  
                  <button type="submit" class="btn btn-success float-right">Upload</button>
                </form>


                </div>


            </div>
        </div>
    </div>
</div>
@endsection