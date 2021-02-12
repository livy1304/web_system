@extends('layouts.app');
@section('content')
@include('layouts.headers.cards')
<div class="container ">
    <div class="row ">
            <!-- Chart's container -->
    <div id="chart" style="height: 800px; background:#1c478e; color:black;
    width:80% !important; margin:20px"

    ></div>
    <div id="month" style="height: 800px; background:#1c478e; color:black;
    width:80% !important; margin:20px"

    ></div>
    </div>
</div>
   <!-- Charting library -->
<script  src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

 <script>
        

   const chart = new Chartisan({
     el: '#chart',
     url: "@chart('donations')",
     hooks:new ChartisanHooks()
            .beginAtZero()
           .legend({position:"top"})
           .title("A graph of Donations against DonorNames")
           .datasets([{type:"bar", 
           borderColor:"red",
           backgroundColor:"red",
           hoverBackgroundColor:"yellow",
           }])
           
   });

   const chart2 = new Chartisan({
     el: '#month',
     url: "@chart('months')",
     hooks:new ChartisanHooks()
            .beginAtZero()
           .legend({position:"top"})
           .title("A graph of Donations against Months")
           .datasets([{type:"bar", 
           borderColor:"red",
           backgroundColor:"red",
           hoverBackgroundColor:"yellow",
           }])
           
   });
 </script>



    
@endsection
