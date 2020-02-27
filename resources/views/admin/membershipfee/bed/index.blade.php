@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Basic Education Membership{{-- <a href="#"><button type="button" class="btn btn-outline-success float-right">+ Add Formula</button></a> --}}</div>
            </br>
<form>
<div class="form-group row">
	<label for="school" class="col-md-2 col-form-label text-md-right">School</label>
    	<div class="col-md-8">
		<select class="form-control" id="school" name="school">
			<option value=""> </option>
				@foreach($membership as $memberships)    
			<option 
                value="{{$memberships->members->id}}" 
                data-price="{{$memberships->members->address}}" 
                data-te="{{$memberships->te}}" 
                data-atf="{{$memberships->atf}}" 
                data-gtr="{{$memberships->gtr}}">
                {{$memberships->members->school}}
            </option>
				@endforeach
		</select>
	</div>
</div>
 
                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label text-md-right">Address</label>

                            <div class="col-md-8">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                                                <div class="form-group row">
                            <label for="formula" class="col-md-2 col-form-label text-md-right">Formula</label>

                            <div class="col-md-8">
                                <input id="formula" type="text" class="form-control @error('formula') is-invalid @enderror" name="formula" value="TOTAL BED ENROLMENT X ANNUAL TUITION FEE = GTR" required disabled>

                                @error('formula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


</br>
    	<div class="col-md-10 offset-md-1">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="width: 35%;text-align: center">Total Enrolment</th>
      <th scope="col" style="width: 35%;text-align: center">Annual Tuition Fee</th>
      <th scope="col" style="width: 30%;text-align: center">Gross Tuition Revenue (GTR)*</th>
    </tr>
  </thead>
  <tbody>
{{--   @foreach($membership as $membershipx) --}}
    <tr>
      <td>  
 <input id="totalEnrollment" name="totalEnrollment" type="number" step=".01" min="0" class="form-control form-control-lg" @error('totalEnrollment') is-invalid @enderror>

                                @error('totalEnrollment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
</td>

      <td>  
<input id="annualTuitionFee" name="annualTuitionFee" type="number" step=".01" min="0" class="form-control form-control-lg" @error('annualTuitionFee') is-invalid @enderror>

                                @error('annualTuitionFee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
</td>
      <td>
<input id="grossTuitionRevenue" name="grossTuitionRevenue" type="number" step=".01" min="0" class="form-control form-control-lg @error('grossTuitionRevenue') is-invalid @enderror" disabled>

                                @error('grossTuitionRevenue')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
      </td>
    </tr>
{{--     @endforeach --}}
  </tbody>
</table>
</div>

</form>
            </div>
        </div>
    </div>
</div>
<script>

$(function () {

    $('#school').change(function() {
        $var = $(this).find(':selected').data('price');
        $('#address').val($var);
        $te = $(this).find(':selected').data('te');
        $('#totalEnrollment').val( $te);
        $atf = $(this).find(':selected').data('atf');
        $('#annualTuitionFee').val( $atf);
        $gtr = $(this).find(':selected').data('gtr');
        $('#grossTuitionRevenue').val( $gtr);   
    })
})
</script>
@endsection
