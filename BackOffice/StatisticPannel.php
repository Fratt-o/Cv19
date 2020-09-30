<?php
        session_start();
        include_once("../API/Struttura/ControllerAdminStrutture.php");

?>
<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Statistic Pannel</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  </head>
  <body>

      <style>
          
          .pad{
              
              padding-top: 30px;
              padding-bottom:100px;
          }
          headersetting{
              width:100px;
          }
          .blocco{
              border: 1px solid #007bff;
          }
          .bordoindex{
             
              border-right: 1px solid #007bff;
          }
          .bordoheader{
              border-top: 1px solid #007bff;
          }
          .contenitore{
              border: 1px solid #007bff;

          }
          .testo{
              color : #007bff;
          }
      </style>

      <script>
         $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("RetrivalStatistiche.php",
                function (data)
                {
                    console.log(data);
                    var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].nomestruttura);
                        marks.push(data[i].mediavoto);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Student Marks',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
      
      
      </script>


      <div class="container contenitore">
       
            <nav class="navbar navbar-light ">
                <span class="navbar-brand mb-0 h1 "style="color:#007bff;">
                    
                    <div class="dropdown">
                        
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Benvenuto, <?php echo $_SESSION['username'];?>
                        </button>
                        
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item " href="adminPannel.php"onclick="location.href='adminPannel.php';">Home</a>
                            <a class="dropdown-item " href="index.php"onclick="location.href='SessionDestroy.php';">Logout</a>
                        </div>
                    
                    </div>
                    
                </span>
            </nav>

      
            <div class="row bordoheader">
          
            
           
                <div class="col-sm-6 offset-sm-2  order-sm-2 pad ">
                    
                  <h4 align="center" class="contenitore testo" >Pagina delle Statistiche</h4>
                
                    <hr>
                    <div id="chart-container">
                        <canvas id="graphCanvas"></canvas>
                    </div>
                        
                        
                </div>
           
                <div class="col-sm-2 col-xs-3 order-sm-1 bordoindex ">
                   
                    
          
                </div>    
            
       
            </div>
      
      
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

