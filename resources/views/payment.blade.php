@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
<style>
    .tab{
        background: #000;
        color:blue;
    }
</style>
@include('layouts.headers.cards')
<div class="container-">
    <form method="POST" action="{{ route('payments') }}" class="m-2">
        @csrf
    
        <div class="form-group  ">
          <div class="form-group">
            <label for="role" class="text-center">{{ __('selectMonth') }}</label>
            <div class="col-md-12">
                <select name="month" id="" class="form-control" 
                style="background: #000 !important; color:#fff !important">
                  @if (count($months))
                  @foreach ($months as $month)
                  <option 
                  style="color:#fff !important"
                  value={{ $month->Month }}>{{ $month->Month }}</option>
              @endforeach
                  @endif
                  
    
                </select>
                
                @error('month')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
    
            </div>
        </div>
        <div class="form-group ml-6 mt-2 d-flex flex-column">
                <button type="submit" class="btn btn-primary">
                    {{ __('MakePayments') }}
                </button>
            
        </div>
    </form> 
        
     


<div class="col-md-12">
   <div class="tab md-12 mb-3 text-center">

         MonthlySalary 
         @if ($default ?? '')
             <b>{{$default ?? ''}}</b>
         @endif
     
   </div>

    <div class="row">
        <div class="col-md-12 m-2">
            <div class="tab md-12 mb-3 text-center">

                <h2>StaffMembers</h2>
            
          </div>
          @if (count($staff))
          <table class="table table-dark">
            <thead>
              <tr>
                
                <th scope="col">Name</th>
                <th scope="col">Amount</th>
                
              </tr>
            </thead>
            <tbody>
                @foreach ($staff as $staffMember)
                <tr>
            
                    <td>{{$staffMember->name}}</td>
                    <td>shs{{$staffMember->Payments}}</td>
                  </tr>
                    
                @endforeach
              
              
            </tbody>
          </table>

              
          @else 
          <div class="col-md-12 m-2">
            <div class="tab md-12 mb-3 text-center">

                <h4>No payments effected yet</h4>
            
          </div>

              
          @endif

           
        </div>

      
        <div class="col-md-12 m-2">
            <div class="tab md-12 mb-3 text-center">

                <h1>GeneralOfficerPayments</h1>
            
          </div>
          @if (count($officers_general))
          <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Role</th>
                
              </tr>
            </thead>
            <tbody>
                @foreach ($officers_general as $general)
                <tr>
                    <th >{{$general->OfficerName}}</th>
                    <td>shs{{$general->Payments}}</td>
                    <td>{{$general->OfficerRole}}</td>
                
                  </tr>
                    
                @endforeach
              
            </tbody>
          </table>

              
          @else
          <div class="col-md-12 m-2">
            <div class="tab md-12 mb-3 text-center">

                <h4>No payments effected yet</h4>
            
          </div>
              
          @endif
            
        </div>
        
        <div class="col-md-12 m-2">
            <div class="tab md-12 mb-3 text-center">

                <h1>RegionalOfficerPayments</h1>
            
          </div>
          @if (count($officers_regional))
          <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Role</th>
                
              </tr>
            </thead>
            <tbody>
                @foreach ($officers_regional as $general)
                <tr>
                    <th >{{$general->OfficerName}}</th>
                    <td>shs{{$general->Payments}}</td>
                    <td>{{$general->OfficerRole}}</td>
                
                  </tr>
                    
                @endforeach
              
            </tbody>
          </table>

              
          @else
          <div class="col-md-12 m-2">
            <div class="tab md-12 mb-3 text-center">

                <h4>No payments effected yet</h4>
            
          </div>
              
          @endif
            
        </div>
       
       <div class="col-md-12 m-2">
        <div class="tab md-12 mb-3 text-center">

            <h1>NationalHospitalPayments</h1>
        
      </div>
      @if (count($officers_national))
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Amount</th>
            <th scope="col">Role</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach ($officers_national as $general)
            <tr>
                <th >{{$general->OfficerName}}</th>
                <td>shs{{$general->Payments}}</td>
                <td>{{$general->OfficerRole}}</td>
            
              </tr>
                
            @endforeach
          
        </tbody>
      </table>

          
      @else
      <div class="col-md-12 m-2">
        <div class="tab md-12 mb-3 text-center">

            <h4>No payments effected yet</h4>
        
      </div>
          
      @endif
        
    </div>
    </div>
</div>

    
@endsection