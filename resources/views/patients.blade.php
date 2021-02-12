@extends('layouts.app');
@section('content')
@include('layouts.headers.cards')
<style>
    .tab{
        background: #000;
        color:#fff;
        width: 100%;
    }
</style>
<div class="container-">
    <div class="row">
        

        <div class="col-md-12 mt-3">
            <div class="tab md-12 mb-3 text-center">
                @if ($total)
                Total patients are {{$total}}
                    
                @endif
              
            </div>
         
             <div class="row">
                 <div class="col-md-12 m-2">
                     <div class="tab md-12 mb-3 text-center">
         
                         <h2>PatientsInGeneralHospitals</h2>
                     
                   </div>
                   @if (count($patients_general))
                   <table class="table table-dark">
                     <thead>
                       <tr>
                         
                         <th scope="col">PatientName</th>
                         <th scope="col">OfficerName</th>
                         <th scope="col">Hospital</th>
                         
                       </tr>
                     </thead>
                     <tbody>
                         @foreach ($patients_general as $patient)
                         <tr>
                     
                             <td>{{$patient->PatientName}}</td>
                             <td>{{$patient->OfficerName}}</td>
                             <td>{{$patient->HospitalName}}</td>
                           </tr>
                             
                         @endforeach
                       
                       
                     </tbody>
                   </table>
         
                       
                   @else 
                   <div class="col-md-12 m-2">
                     <div class="tab md-12 mb-3 text-center">
         
                         <h4>No Patients in General Hospitals Yet</h4>
                     
                   </div>
         
                       
                   @endif
         
                    
                 </div>

                 
                          
             <div class="row">
                <div class="col-md-12 m-2">
                    <div class="tab md-12 mb-3 text-center">
        
                        <h2>PatientsInRegionalHospitals</h2>
                    
                  </div>
                  @if (count($patients_regional))
                  <table class="table table-dark">
                    <thead>
                      <tr>
                        
                        <th scope="col">PatientName</th>
                        <th scope="col">OfficerName</th>
                        <th scope="col">Hospital</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients_regional as $patient)
                        <tr>
                    
                            <td>{{$patient->PatientName}}</td>
                            <td>{{$patient->OfficerName}}</td>
                            <td>{{$patient->HospitalName}}</td>
                          </tr>
                            
                        @endforeach
                      
                      
                    </tbody>
                  </table>
        
                      
                  @else 
                  <div class="col-md-12 m-2">
                    <div class=" md-12 mb-3 text-center">
        
                        <h4>No Patients in Regional Hospitals Yet</h4>
                    
                  </div>
        
                      
                  @endif
        
                   
                </div>

                
                          
             <div class="row">
                <div class="col-md-12 m-2">
                    <div class="tab md-12 mb-3 text-center">
        
                        <h2>PatientsInNationalHospitals</h2>
                    
                  </div>
                  @if (count($patients_national))
                  <table class="table table-dark">
                    <thead>
                      <tr>
                        
                        <th scope="col">PatientName</th>
                        <th scope="col">OfficerName</th>
                        <th scope="col">Hospital</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients_national as $patient)
                        <tr>
                    
                            <td>{{$patient->PatientName}}</td>
                            <td>{{$patient->OfficerName}}</td>
                            <td>{{$patient->HospitalName}}</td>
                          </tr>
                            
                        @endforeach
                      
                      
                    </tbody>
                  </table>
        
                      
                  @else 
                  <div class="col-md-12 m-2">
                    <div class="md-12 mb-3 text-center">
        
                        <h4>No Patients in National Hospitals Yet</h4>
                    
                  </div>
        
                      
                  @endif
        
                   
                </div>
         
               
         
    </div>
</div>
@endsection