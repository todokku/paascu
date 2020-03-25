@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Edit Members</h4>

                <div class="card-body">


                <form action="{{ route('admin.members.update')}}" method="POST" enctype="multipart/form-data">
<div class="form-group row">
        <input type="hidden" name="id" value = "{{$member->id}}">
 </div>

                <div class="form-group row">
                <div class="col-md-6 offset-sm-2">
<div class=" custom-control custom-radio custom-control-inline">

  <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="active" {{ ($member->status == 'active')? "checked" : "" }}>

  <label class=" custom-control-label" for="customRadioInline1">Active</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="deactive" {{ ($member->status == 'deactive')? "checked" : "" }}>
  <label class="custom-control-label" for="customRadioInline2">Deactive</label>
</div>
</div>
                </div>
 
                        <div class="form-group row">
                            <label for="school" class="col-md-2 col-form-label text-md-right">School</label>

                            <div class="col-md-10">
                                <input id="school" type="text" class="form-control @error('school') is-invalid @enderror" name="school" value="{{ $member->school }}" required autocomplete="school" autofocus>

                                @error('school')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label text-md-right">Address</label>

                            <div class="col-md-10">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $member->address }}" required autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                                                <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">Member Logo</label>

                            <div class="col-md-10">
                                                        <img src="{!! asset('images/' . $member->image) !!}">
                                <input id="image" type="file" class="form-control @error('address') is-invalid @enderror" name="image" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



{{--                         <div class="form-group row">
                            <label for="program" class="col-md-2 col-form-label text-md-right">Program</label>

                            <div class="col-md-10">
                                <input id="program" type="text" class="form-control @error('program') is-invalid @enderror" name="program" value="{{ $member->program }}" required autofocus>

                                @error('program')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                                                <div class="form-group row">
                            <label for="level" class="col-md-2 col-form-label text-md-right">Level</label>

                            <div class="col-md-10">
                                <input id="level" type="text" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ $member->level }}" required autofocus>

                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            <div class="form-group row">
                            <label for="valid" class="col-md-2 col-form-label text-md-right">Valid</label>

                            <div class="col-md-10">
                                <input id="valid" type="text" class="form-control @error('valid') is-invalid @enderror" name="valid" value="{{ $member->valid }}" required autofocus>

                                @error('valid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}



                  @csrf
                  {{ method_field('PUT')}}
                  
                  <button type="submit" class="btn btn-success float-right">update</button>
                </form>


                </div>


            </div>
        </div>
    </div>
</div>
@endsection
