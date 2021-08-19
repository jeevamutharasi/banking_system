<!doctype html>
<html lang="en">
  <head>
    <title>View Customer </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
      button{
        background-color: rgb(145, 150, 221);;
        transition: 0.5s;
      }
      button:hover{
        background-color: #1e90ff;
        color: lavender;
      }
      td{
        text-align: center;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
          <img src="logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
          Apex Bank
        </a>
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <a id="mybtn" class="btn btn-outline-primary" href="index.html" role="button">Home</a>
          </li>
          <li class="nav-item">
            <a id="mybtn" class="btn btn-outline-primary" href="history.php" role="button">Transaction History</a>
          </li>
        </ul>
     </div>
    </nav>
<?php
    include 'connect.php';
    $sql = "SELECT * FROM customer";
    $result = mysqli_query($conn,$sql);
?>

<div class="container">
        <h2 class="text-center pt-4">TRANSFER MONEY HERE!!</h2>
        <br>
            <div class="row">
                <div class="col">
                    <div class="table-responsive-sm">
                    <table class="table table-hover table-sm table-info table-condensed table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" class="text-center py-2">Id</th>
                            <th scope="col" class="text-center py-2">Name</th>
                            <th scope="col" class="text-center py-2">E-Mail</th>
                            <th scope="col" class="text-center py-2">Balance</th>
                            <th scope="col" class="text-center py-2">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td class="text-center py-2"><?php echo $rows['id'] ?></td>
                        <td class="text-center py-2"><?php echo $rows['name']?></td>
                        <td class="text-center py-2"><?php echo $rows['email']?></td>
                        <td class="text-center py-2"><?php echo $rows['balance']?></td>
                        <td><a href="transaction.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class="text-center">Transact</button></a></td> 
                    </tr>
                <?php
                    }
                ?>
            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div> 
         </div>

  <footer>
    &copy; Banking System | All Right Reserved | Belongs to Jeevamutharasi    
  </footer>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</html>