{{-- @extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Member</div>

                <div class="card-body">

                <form action="{{ route('admin.members.store')}}" method="POST">

                        <div class="form-group row">
                            <label for="institution" class="col-md-2 col-form-label text-md-right">Institution</label>

                            <div class="col-md-10">
                                <input id="institution" type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" value="" required autocomplete="institution" autofocus>

                                @error('institution')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label text-md-right">Address</label>

                            <div class="col-md-10">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="" required autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="program" class="col-md-2 col-form-label text-md-right">Program</label>

                            <div class="col-md-10">
                                <input id="program" type="text" class="form-control @error('program') is-invalid @enderror" name="program" value="" required autofocus>

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
                                <input id="level" type="text" class="form-control @error('level') is-invalid @enderror" name="level" value="" required autofocus>

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
                                <input id="valid" type="text" class="form-control @error('valid') is-invalid @enderror" name="valid" value="" required autofocus>

                                @error('valid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                  @csrf
{{--                   {{ method_field('PUT')}} --}}
                  
                  <button type="submit" class="btn btn-success float-right">Submit</button>
                </form>


                </div>


            </div>
        </div>
    </div>
</div>
@endsection
 --}}