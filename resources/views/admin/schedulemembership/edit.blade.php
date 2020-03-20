@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Edit Schedule Membership Fee</h4>

                <div class="card-body">


                <form action="{{ route('admin.schedulemembership.update')}}" method="POST">
<div class="form-group row">
        <input type="hidden" name="id" value = "{{$SM->id}}">
 </div>

{{--                 <div class="form-group row">
                <div class="col-md-6 offset-sm-2">
<div class=" custom-control custom-radio custom-control-inline">

  <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="active" {{ ($SM->status == 'active')? "checked" : "" }}>

  <label class=" custom-control-label" for="customRadioInline1">Active</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
  <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="deactive" {{ ($SM->status == 'deactive')? "checked" : "" }}>
  <label class="custom-control-label" for="customRadioInline2">Deactive</label>
</div>
</div>
                </div> --}}

                        <div class="form-group row">
                            <label for="gtrs" class="col-md-2 col-form-label text-md-right">Gtrs</label>

                            <div class="col-md-10">
                                <input id="gtrs" type="number" step=".01" min="0" class="form-control @error('gtrs') is-invalid @enderror" name="gtrs" value="{{ $SM->gtrs }}" required autocomplete="gtrs" autofocus>

                                @error('gtrs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="gtre" class="col-md-2 col-form-label text-md-right">Gtre</label>

                            <div class="col-md-10">
                                <input id="gtre" type="number" step=".01" min="0" class="form-control @error('gtre') is-invalid @enderror" name="gtre" value="{{ $SM->gtre }}" required autofocus>

                                @error('gtre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                                                <div class="form-group row">
                            <label for="amf" class="col-md-2 col-form-label text-md-right">Amf</label>

                            <div class="col-md-10">
                                <input id="amf" type="number" step=".01" min="0" class="form-control @error('amf') is-invalid @enderror" name="amf" value="{{ $SM->amf }}" required autofocus>

                                @error('amf')
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
