@extends('layouts.app');
@section('content')
@include('layouts.headers.cards')
<div class="container ">
    <div class="row ">
      <div class="col-md-12-text-center">
        <a href="{{route('registerofficer')}}" class="btn-success btn-block  ml-3 mt-4 p-2">
          AddOfficer
        </a>
      </div>
          @if ($total)
            Total Officers  {{$total}}
          @endif
          @if ($totalOfficers)
          <table class="table  m-5 table-dark">
            <thead>
              <tr>
                <th scope="col">OfficerName</th>
                <th scope="col">OfficerUserName</th>
                <th scope="col">HospitalCategory</th>
          
              </tr>
            </thead>
            <tbody>
              @foreach ($totalOfficers as $totals)
              <tr>
              
                <td>{{$totals->OfficerName}}</td>
                <td>{{$totals->OfficerUserName}}</td>
                <td>{{$totals->HospitalCategory}}</td>
              </tr>
                  
              @endforeach
              

            </tbody>
          </table>
          @else

          <h2 class="text-center">There are no Officers yet</h2>    
          @endif
        
           </div>
</div>

    
@endsection
