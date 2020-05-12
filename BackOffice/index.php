<!DOCTYPE html>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
Il dito di fabio in cancrena
-->
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <title>BackOffice Home</title>
  </head>
  <body>
      <style>
          
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

      </style>
      <div class="container contenitore">
       
           <nav class="navbar navbar-light ">
               <span class="navbar-brand mb-0 h1 "style="color:#007bff;">Navbar</span>
            </nav>

      
        <div class="row bordoheader">
          
            
           
          <div class="col-sm-6 offset-sm-2  order-sm-2 pad ">
              
              <div class=" " style="color:#007bff;">
                   
                  <div class="card-body ">
                       
                        <h5 class="card-title ">Benvenuto nel area amministrazione di CV19</h5>
                  
                        <form method="post" action="http://cv19ing20.altervista.org/Cv19/API/Utente/adminloginController.php">
                        
                            <div class="form-group">
                                
                                <label for="email">Indirizzo Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            
                            </div>
                            
                            <div class="form-group">
                            
                                <label for="psw">Password</label>
                                <input type="password" name="psw" class="form-control " id="psw" required>
                            
                            </div>
                            
                             
                            <button type="submit" class="btn btn-outline-primary">Accedi</button>
                            <hr>
                            
                        </form>    
                    
                  </div>
                  
              </div>
           
          </div>
           
          <div class="col-sm-2 col-xs-3 order-sm-1 bordoindex ">
             

          
          </div>    
            
       
        </div>
      
      
      </div>
      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
