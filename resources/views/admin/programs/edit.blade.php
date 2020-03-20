@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Edit Programs</h4>

                <div class="card-body">


                <form action="{{ route('admin.programs.update')}}" method="POST">
<div class="form-group row">
        <input type="hidden" name="id" value = "{{$program->id}}">
 </div>

                <div class="form-group row">
                <div class="col-md-6 offset-sm-2">
<div class=" custom-control custom-radio custom-control-inline">

  <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="active" {{ ($program->status == 'active')? "checked" : "" }}>

  <label class=" custom-control-label" for="customRadioInline1">Active</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="deactive" {{ ($program->status == 'deactive')? "checked" : "" }}>
  <label class="custom-control-label" for="customRadioInline2">Deactive</label>
</div>
</div>
                </div>
 

                                                <div class="form-group row">
                            <label for="school" class="col-md-2 col-form-label text-md-right">School</label>
                            <div class="col-md-10">
                            <select class="form-control" id="school" name="school" value="">
                            <option value="{{$program->members->id}}">{{$program->members->school}}</option>
                            @foreach($members as $member)
                            <option value="{{$member->id}}">{{$member->school}}</option>
                            @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="program" class="col-md-2 col-form-label text-md-right">Program</label>

                            <div class="col-md-10">
                                <input id="program" type="text" class="form-control @error('program') is-invalid @enderror" name="program" value="{{ $program->program }}" required autocomplete="program" autofocus>

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
                                <input id="level" type="text" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ $program->level }}" required autofocus>

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
                                <input id="valid" type="text" class="form-control @error('valid') is-invalid @enderror" name="valid" value="{{ $program->valid }}" required autofocus>

                                @error('valid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
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
