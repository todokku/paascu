@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <div class="card-header bg-white">Add Program</div>

                <div class="card-body">
                <form action="{{ route('programs.store')}}" method="POST">
                  @csrf

                        <div class="form-group row">
                            <label for="school" class="col-md-2 col-form-label text-md-right">School</label>
                            <div class="col-md-8">
                            <select class="selectpicker form-control" id="school" name="school" data-live-search="true" title="Select School">
                            <option disable></option>
                            @foreach($members as $member)
                            <option value="{{$member->id}}">{{$member->school}}</option>
                            @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="program" class="col-md-2 col-form-label text-md-right">Program Name</label>

                            <div class="col-md-8">
                                <input id="program" type="text" class="form-control @error('program') is-invalid @enderror" name="program" value="" required autocomplete="program" autofocus>

                                @error('program')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="level" class="col-md-2 col-form-label text-md-right">Level</label>

                            <div class="col-md-8">
                                <select id="level" type="text" class="selectpicker form-control @error('level') is-invalid @enderror" name="level" data-live-search="true" title="Select Accreditation Level" required autofocus>
                                        <option>Candidate</option>
                                        <option>Level I</option>
                                        <option>Level II</option>
                                        <option>Level III</option>
                                        <option>Level IV</option>
                                        </select>
                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ed_level" class="col-md-2 col-form-label text-md-right">Education Level</label>

                            <div class="col-md-8">
                                <select id="ed_level" type="text" class="selectpicker form-control @error('ed_level') is-invalid @enderror" name="ed_level" data-live-search="true" title="Select Education Level" required autofocus>
                                 <option>Grade School</option>
                                 <option>High School</option>
                                 <option>Basic Education</option>
                                 <option>College</option>
                                 <option>Graduate Education</option>
                                </select>

                                @error('ed_level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="valid" class="col-md-2 col-form-label text-md-right">Vaild Until</label>

                            <div class="col-md-8">
                                <input id="valid" type="text" class="form-control @error('valid') is-invalid @enderror" name="valid" required autocomplete="valid" autofocus>

                                @error('valid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                  
                   <button type="submit" class="btn btn-success float-right">Submit</button>
                </form>


                </div>


            </div>
        </div>
    </div>
</div>
@endsection
