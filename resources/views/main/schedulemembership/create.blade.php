@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Add Schedule Membership Fee</h4>

                <div class="card-body">

                <form action="{{ route('schedulemembership.store')}}" method="POST">
                  @csrf
                        <div class="form-group row">
                            <label for="gtrs" class="col-md-2 col-form-label text-md-right">Gross Tuition Revenue Range Start</label>

                            <div class="col-md-10">
                                <input id="gtrs" type="number" step=".01" min="0" class="form-control @error('gtrs') is-invalid @enderror" name="gtrs" value="" required autocomplete="gtrs" autofocus>

                                @error('gtrs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="gtre" class="col-md-2 col-form-label text-md-right">Gross Tuition Revenue Range End</label>

                            <div class="col-md-10">
                                <input id="gtre" type="number" step=".01" min="0" class="form-control @error('gtre') is-invalid @enderror" name="gtre" placeholder="Leave empty if last"  autofocus>

                                @error('gtre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                                                <div class="form-group row">
                            <label for="amf" class="col-md-2 col-form-label text-md-right">Annual Membership Fee</label>

                            <div class="col-md-10">
                                <input id="amf" type="number" step=".01" min="0" class="form-control @error('amf') is-invalid @enderror" name="amf" value="" required autofocus>

                                @error('amf')
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
