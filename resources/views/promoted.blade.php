@extends('layouts.app')

@section('content')
    
    
    <div class="container">
        <div class="row">
            @if ($totalPromotions)
                TotalPromotedGeneral Officers{{$totalPromotions}}
            @endif
            <div class="col-md-12">
                @if (count($promotions))
                <table class="table table-dark">
                    <thead>
                     <tr>
                       
                       <th scope="col">OfficerName</th>
                       <th scope="col">OfficerUserName</th>
                       <th scope="col">OfficerRole</th>
                       
                     </tr>
                   </thead>
                   <tbody>
                       @foreach ($promotions as $patient)
                       <tr>
                   
                           <td>{{$patient->OfficerName}}</td>
                           <td>{{$patient->OfficerUserName}}</td>
                           <td>{{$patient->OfficerRole}}</td>
                         </tr>
                           
                       @endforeach
                     
                     
                   </tbody>
                 </table>
       
                    
  
                
                      
                  @else 
                  <div class="col-md-12 m-2">
                    <div class=" md-12 mb-3 text-center">
        
                        <h4>There are no promotions Yet</h4>
                    
                  </div>
        
                      
                  @endif
        
            </div>
        </div>

    </div>
@endsection