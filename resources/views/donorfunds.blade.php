@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('layouts.headers.cards')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                         RegisterDonorFunds
                    </div>
                   
                    <form role="form" method="POST" action="{{ route('funds') }}">
                        @csrf
                            <label for="">Name</label>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }} mb-3">
                            <div class="input-group input-group-alternative">
                                
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                placeholder="{{ __('Name') }}" type="name" name="name" value="{{ old('name') }}" value="admin@argon.com" 
                                >
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                        <label for="">Amount</label>
                        <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                
                                <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" placeholder="{{ __('amount') }}" 
                                type="text" placeholder="like 1000000000000 no commas" >
                            </div>
                            @if ($errors->has('amount'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                        <label for="">Month</label>
                        <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                
                                <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" 
                                name="month" placeholder="{{ __('amount') }}" 
                                type="month" >
                            </div>
                            @if ($errors->has('amount'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-4">{{ __('RegisterFunds') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection