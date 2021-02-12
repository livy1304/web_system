@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-dark shadow border-0  color-light">
                <div class="card-body px-lg-5 py-lg-5 mt-5">
                    <div class="text-center text-muted mt-5">
                         RegisterOfficer
                    </div>
                    @if (session("status"))
                    <h2 style="color: red">
                        {{session("status")}}
                    </h2>
                    
                        
                    @endif
                    <form role="form" method="POST" action="{{ route('registerofficer') }}" class='mt-5'>
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
                        <label for="">UserName</label>
                        <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                
                                <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" placeholder="{{ __('username') }}" 
                                type="text" >
                            </div>
                            @if ($errors->has('username'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-4">{{ __('RegisterOfficer') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection