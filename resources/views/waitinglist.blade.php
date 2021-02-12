@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<style>
    .pending{
        text-align: center;
        font-weight: 900;
        color:#fff;
    }
</style>
<div class="container-">
    <div class="row">

        <div class="col-md-12 mt-3">
            <h2 class="pending">PendingOfficerList</h2>
            @if (count($promotions))
            <table class="table table-dark">
                <thead>
                 <tr>
                   
                   <th scope="col">OfficerName</th>
                   <th scope="col">OfficerUserName</th>
                   <th scope="col">Award</th>
                   <th>Pending</th>
                   
                 </tr>
               </thead>
               <tbody>
                   @foreach ($promotions as $patient)
                   <tr>
               
                       <td>{{$patient->OfficerName}}</td>
                       <td>{{$patient->OfficerUserName}}</td>
                       <td>{{$patient->Award}}</td>
                       <td>Yes</td>
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
