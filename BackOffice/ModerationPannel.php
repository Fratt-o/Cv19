<?php
        session_start();
        include_once("../API/Recensioni/ControllerAdmin.php");
?>
<!doctype html>
<html>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/75a5c81b4e.js" crossorigin="anonymous"></script>
    
    <title>ModerationPannel</title>
  </head>
  <body>
      <style>
          .btn {
            background-color: DodgerBlue;
            border: none;
            color: white;
            padding: 5px 5px;
            
            cursor: pointer;
           }

            /* Darker background on mouse-over */
            .btn:hover {
            background-color: RoyalBlue;
           }
          .pad{
              
              padding-top: 100px;
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
          .chose{
              
              padding:20px;
          }
          .testo{
              color : #007bff;
          }
      </style>
      <script>
          function alertApprovazione(id){
            var txt;
            if (confirm("Sicuro di voler apporovare la recensione?")) {
                
                window.location= "http://cv19ing20.altervista.org/Cv19/BackOffice/approvazione.php?id="+id;
            } else {
                txt = "You pressed Cancel!";
            }
          }

          function alertRifiuto(id){
            var txt;
            if (confirm("Sicuro di voler scartare la recensione?")) {
                window.location= "http://cv19ing20.altervista.org/Cv19/BackOffice/cancellaRecensione.php?id="+id;
            } else {
                txt = "You pressed Cancel!";
            } 
          }
      </script>
        <?php 
        if($_SESSION['username']==null){
            http_response_code(404);
        }
      ?>
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
          
            
           
                <div class="col-sm-8 offset-sm-1  order-sm-2 " style="padding-top: 30px; ">
           
                    <h4 align="center" class="contenitore testo" >Recensioni in Moderazione</h4>
                    
                    <hr>
                    
                    <?php 
                        
                        $controlller = new ControllerAdmin();

                        $data = $controlller->getReview();
                        if ( isset($data)){
                            
                            $value = array_pop($data);
                            while ($value != NULL){
                    ?>
                            <div class="card" >
                                
                                <div class="row">
                                    
                                    
                                    <div class="col-sm-5 offset-sm-2">
                                        
                                        <h6><?php if(!empty($value->nomeMostrato)){
                                            echo $value->nomeMostrato;
                                        }else { echo $value->fkutente;} ?></h6>
                                        
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        
                                        <span style="font-size: 12pt; ">
                                            <?php 
                                                for($i=0;$i < $value->voto; $i++){
                                            ?>
                                                <i class="fas fa-star"></i>
                                            <?php } ?>
                                            <?php for($x=$value->voto;$x<5;$x++){ ?>
                                            
                                                <i class="far fa-star"></i>
                                            <?php } ?>
                                        </span>

                                                
                                    </div>
                                
                                    
                                </div>
                                
                                <div class="row">
                                    
                                    
                                    <div class="col-sm-2 offset-sm-2">
                                        
                                        <p>
                                            <?php echo $value->titolo; ?>
                                        </p>
                                        
                                    </div>
                                    
                                    <div class="col-sm-5">
                                        
                                        <p>
                                            <?php echo $value->testo; ?>
                                            
                                        </p>
                                        
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        
                                        <span  class="chose"style="font-size: 24pt; ">

                                            <button onclick="alertApprovazione(<?php echo $value->idRecensione ?>)" class="btn"><i class="fas fa-check"></i></button>
                                            <button onclick="alertRifiuto(<?php echo $value->idRecensione ?>)" class="btn"><i class="fas fa-times"></i></button>
                                        </span>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <?php 
                                
                                $value = array_pop($data);
                                }
                            } else { echo "Non ci sono recensioni da moderare";} 
                            ?>
                
                    <hr>
                </div>
           
                <div class="col-sm-2 col-xs-3 order-sm-1 bordoindex ">
             

          
                </div>    
            
       
            </div>
      
      
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
