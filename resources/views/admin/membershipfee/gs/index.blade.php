@extends('layouts.test')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Grade School Membership{{-- <a href="#"><button type="button" class="btn btn-outline-success float-right">+ Add Formula</button></a> --}}</div>
            </br>
<form>
<div class="form-group row">
	<label for="school" class="col-md-2 col-form-label text-md-right">School</label>
    	<div class="col-md-8">
		<select class="form-control" id="school" name="school">
			<option value="0"> </option>
				@foreach($membership as $memberships)    
			<option 
            value="{{$memberships->members->id}}" 
            data-price="{{$memberships->members->address}}" 
            data-content="{{$memberships->content}}" 
            data-gtr="{{$memberships->gtr}}"
            >{{$memberships->members->school}}
            </option>
				@endforeach
		</select>
	</div>
</div>
 
                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label text-md-right">Address</label>

                            <div class="col-md-8">
                                <input disabled id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required>

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
                                <input id="formula" type="text" class="form-control @error('formula') is-invalid @enderror" name="formula" value="{{$formula->variable. ' = gross_tuition_fee'}}" required disabled>

                                @error('formula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


</br>
    	<div class="col-md-10 offset-md-1">
            <div class="table-responsive">
<table class="table">
  <thead class="thead-dark">
    <tr>
        @foreach($pieces as $seceip)
        @if(strlen($seceip)>1)
      <th scope="col" style="text-align: center">{{$seceip}}</th>
      @endif
      @endforeach
      <th scope="col" style="text-align: center">gross_tuition_fee</th>
      <th scope="col" style="text-align: center">annual_membership_fee</th>
    </tr>
  </thead>
  <tbody>
{{--   @foreach($membership as $membershipx) --}}
    <tr>
{{--       <td>  
 <input id="totalEnrollment" name="totalEnrollment" type="number" step=".01" min="0" class="form-control form-control-lg" @error('totalEnrollment') is-invalid @enderror">

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
</td> --}}
 @foreach($pieces as $seceip)
         @if(strlen($seceip)>1)
      <td>  
 <input id="{{$seceip}}" name="{{$seceip}}" disabled value="" type="number" step=".01" min="0" class="form-control form-control-lg" @error($seceip) is-invalid @enderror>

                                @error($seceip)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
</td>
@endif
@endforeach
      <td>
<input id="grossTuitionRevenue" name="grossTuitionRevenue" type="number" step=".01" min="0" class="form-control form-control-lg @error('grossTuitionRevenue') is-invalid @enderror" disabled>

                                @error('grossTuitionRevenue')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
      </td>
            <td>
<input id="annualMembershipFee" name="annualMembershipFee" type="number" step=".01" min="0" class="form-control form-control-lg @error('annualMembershipFee') is-invalid @enderror" disabled>

                                @error('annualMembershipFee')
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
</div>

</form>
            </div>
        </div>
    </div>
</div>
<script>


var i = 0;
    $('#school').change(function() {
            // if ($("#school").val()==0) {
                @foreach($pieces as $seceip)
                @if(strlen($seceip)>1)
                $("#{{$seceip}}").val(" "); 
                $("#annualMembershipFee").val(" "); 
                
                @endif
                @endforeach
            // }
                $.ajax({
              url: '{{ route('gsmembership.getformula')}}',
              type: "Get",
              dataType: 'json',//this will expect a json response
              data:{id:$("#school").val()}, 
               success: function(response){ 
                @foreach($pieces as $seceip)
                @if(strlen($seceip)>1)
                $("#{{$seceip}}").val(parseFloat(response[i].content).toFixed(2)); 
                i++;
                @endif
                @endforeach
i=0;
        }
            });

        $var = $(this).find(':selected').data('price');
        $('#address').val($var);
        // $te = $(this).find(':selected').data('te');
        // $('#totalEnrollment').val( $te);

        // $content = $(this).find(':selected').data('content');
        // $('#content').val( $content);

        $gtr = $(this).find(':selected').data('gtr');
        $('#grossTuitionRevenue').val( $gtr);   

        @foreach( $sm as $ms )

        if({{$ms->gtrs}} < $gtr && $gtr < {{$ms->gtre}}){ 
                    console.log({{$ms->gtrs}});
                    console.log({{$ms->gtre}});
        $('#annualMembershipFee').val({{$ms->amf}});
        }
        @endforeach
    })

</script>
@endsection

