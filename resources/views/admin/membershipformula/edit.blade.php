@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$formula->ed_type}} Edit Formula</div>

                <div class="card-body">


                <form action="{{ route('admin.membershipformula.update')}}" method="POST">
<div class="form-group row">
        <input type="hidden" name="id" value = "{{$formula->id}}">
 </div>
 
                        <div class="form-group row">
                            <label for="formula" class="col-md-2 col-form-label text-md-right">Formula</label>

                            <div class="col-md-10">
                                <input id="formula" type="text" class="form-control @error('formula') is-invalid @enderror" name="formula" value="{{ $formula->variable }}" required autocomplete="formula" autofocus>

                                @error('formula')
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
