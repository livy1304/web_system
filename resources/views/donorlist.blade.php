@extends('layouts.app');
@section('content')
@include('layouts.headers.cards')
<div class="container ">
    <div class="row ">
          @if (count($donors))
          <table class="table  m-5 table-dark">
            <thead>
              <tr>
                <th scope="col">DonorName</th>
                <th scope="col">Amount</th>
                <th scope="col">Month</th>
          
              </tr>
            </thead>
            <tbody>
              @foreach ($donors as $totals)
              <tr>
              
                <td>{{$totals->DonorName}}</td>
                <td>{{$totals->Amount}}</td>
                <td>{{$totals->Month}}</td>
              </tr>
                  
              @endforeach
              

            </tbody>
          </table>

              
          @endif
           </div>
</div>

    
@endsection
