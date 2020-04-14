@extends('layouts.test')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Manage Origial Receipts</h4>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

  <div class="container">

  </div>

                </div>
            </div>
        </div>
    </div>
@endsection
