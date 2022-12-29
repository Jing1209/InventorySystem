@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container">

    <div class="d-flex flex-row-reverse my-3">
        <div class="container p-5 bg-light text-white">
            <canvas id="myChart" height="50px" width="100px"></canvas>        </div>
        <div class="container p-5 bg-light text-white me-3">
            <canvas id='myChart1' height="100px"></canvas>        </div>
    </div>
   
        
    
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script type="text/javascript">
  
      var labels =  {{ Js::from($labels) }};
      var users =  {{ Js::from($data) }};
      const label = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
        ];
        const label1 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
        ];
      
    
      const data = {
        labels: labels,
        datasets: [{
          label: 'My First dataset',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: users,
        }]
      };

      const data1 = {
        labels: label,
        datasets: [{
          label: 'My First dataset',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
         data: [0, 10, 5, 2, 20, 15, 25],
        }]
      };
  
      const config = {
        type: 'bar',
        data: data,
        options: {}
      };

      const config1 = {
          type:'line',
          data:data1,
          option:{}
      }
  
      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
      const myChart1 = new Chart(
        document.getElementById('myChart1'),
        config1
      );
  

</script>
@endsection