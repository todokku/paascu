@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Graduate Education Semester Edit Membership</h4>
            <br>



                <div class="card-body">


                                                <div class="form-group row">
                            <label for="school" class="col-md-2 col-form-label text-md-right">School</label>
                            <div class="col-md-10">
                            <select class="form-control" id="school" name="school" readonly>
                            <option value="{{$school->id}}" readonly>{{$school->school}}</option>
                            </select>
                            </div>
                        </div>


<form action="{{ route('gedsemenrollment.update')}}" method="POST">
    <div class="form-group row">
        <input type="hidden" name="id" value = "{{$memid}}">
        <input type="hidden" name="cid" value = "{{$contid}}">
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
        <div class="col-md-10">
            <input id="{{$pihsrebmem->id}}" type="text" class="form-control @error('{{$pihsrebmem->id}}') is-invalid @enderror" name="{{$pihsrebmem->id}}" value="{{$pihsrebmem->content}}" required autocomplete="program" autofocus>

                @error('{{$pihsrebmem->id}}')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
</div>
@endforeach

    @csrf
{{--     {{ method_field('PUT')}}     --}}     
    <button type="submit" class="btn btn-success float-right">update</button>
</form>





</div>


            </div>
        </div>
    </div>
</div>

@endsection

