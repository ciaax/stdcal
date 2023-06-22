<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Input Mahasiswa</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    

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
                        <a class="nav-link" href="display">Lihat Data</a>
                        </li>
                    </ul>
                    </div>
                </div>
                </nav>

               <h1 class="text-info text-center mt-3 mb-4">Input Nilai Mahasiswa</h1>

                        <div class="nav nav-fill my-2">
                          <label class="nav-link shadow-sm step0   border ml-2 ">Step One</label>
                          <label class="nav-link shadow-sm step1   border ml-2 " >Step Two</label>
                        </div>
          
                <form action="/post" method="post" class="employee-form">
                 @csrf
                <div class="form-section">
                    <label for="">Name:</label>
                    <input type="text" class="form-control mb-3" name="name" required>
                    <label for="">Last Name:</label>
                    <input type="text" class="form-control mb-3" name="last_name" required>
                </div>
                <div class="form-section">
                    <input type="radio" name="jenis" value="kuis" checked> Kuis<br>
                    <input type="radio" name="jenis" value="tugas"> Tugas<br>
                    <input type="radio" name="jenis" value="absensi"> Absensi<br>
                    <input type="radio" name="jenis" value="praktek"> Praktek<br>
                    <input type="radio" name="jenis" value="uas"> UAS<br>
                    <label for="">Nilai:</label>
                    <input type="number" class="form-control mb-3" name="nilai"  required>
                    <!--<span style="color: blue">@error('nilai'){{$message}}@enderror</span><br>--> 
                </div>
              <div class="form-navigation mt-3">
                 <button type="button" class="previous btn btn-info float-left">&lt; Previous</button>
                 <button type="button" class="next btn btn-info float-right">Next &gt;</button>
                 <button type="submit" class="btn btn-success float-right">Submit</button>
              </div>

            </form>
        </div>
            
        </div>
      </div>
    </div>

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