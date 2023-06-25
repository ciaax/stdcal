<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Input Mahasiswa</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.form-section{
    display: none;
}

.form-section.current{
    display: inline;
}
.parsley-errors-list{
    color:red;
}
</style>

</head>
  <body>
    <div class="container-fluid  ">
      <div class="row justify-content-md-center">
        <div class="col-md-9 ">
            <div class="card px-5 py-3 mt-5 shadow">

                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link" href="/">Input Data</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('display') }}">Lihat Data</a>
                        </li>
                    </ul>
                    </div>
                </div>
                </nav>

               <h1 class="text-info text-center mt-3 mb-4">Nama Mahasiswa: {{$first." ".$last}}</h1>

               <h1 class="text-info text-center mt-3 mb-4">Grafik Grade Nilai Mahasiswa: </h1>
          
                <form action="/post" method="post" class="employee-form">
                <canvas id="grades" width="400" height="400"></canvas>

            </form>

               <h1 class="text-info text-center mt-3 mb-4">Nilai Rata-Rata Mahasiswa: {{$totalScore}}</h1>
          
                <form action="/post" method="post" class="employee-form">

            </form>

            <h1 class="text-info text-center mt-3 mb-4">Grafik Nilai Mahasiswa: 
            </h1>
          
          <form action="/post" method="post" class="employee-form">
          <canvas id="nilai" width="400" height="400"></canvas>

      </form>
      <h1 class="text-info text-center mt-3 mb-4">Data Nilai Mahasiswa: 
                {!!$nilaisString!!}
            </h1>
        </div>
            
        </div>
      </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        var ctx = document.getElementById('grades').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['A', 'B', 'C', 'D'],
                datasets: [{
                    label: 'Jumlah Grade',
                    data: [{{ isset($grades["A"])?$grades["A"]:0}}, {{  isset($grades["B"])?$grades["B"]:0 }}, {{ isset($grades["C"])?$grades["C"]:0}}, {{  isset($grades["D"])?$grades["D"]:0}}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 78, 78, 0.8)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 78, 78, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx = document.getElementById('nilai').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [{!!'"'.implode('", "',$keys).'"'!!}],
                datasets: [{
                    label: 'Nilai',
                    data: [{{ implode(', ', $nilaiArr)}}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(206, 162, 135, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(206, 162, 135, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
    });

    });

    
</script>
<script>
    $(function(){
        var $sections=$('.form-section');
        function navigateTo(index){
            $sections.removeClass('current').eq(index).addClass('current');
            $('.form-navigation .previous').toggle(index>0);
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [Type=submit]').toggle(atTheEnd);
            const step= document.querySelector('.step'+index);
            step.style.backgroundColor="#17a2b8";
            step.style.color="white";
        }

        function curIndex(){

            return $sections.index($sections.filter('.current'));
        }

        $('.form-navigation .previous').click(function(){
            navigateTo(curIndex() - 1);
        });

        $('.form-navigation .next').click(function(){
            $('.employee-form').parsley().whenValidate({
                group:'block-'+curIndex()
            }).done(function(){
                navigateTo(curIndex()+1);
            });
        });

        $sections.each(function(index,section){
            $(section).find(':input').attr('data-parsley-group','block-'+index);
        });
        navigateTo(0);
    });
</script>



  </body>
</html>