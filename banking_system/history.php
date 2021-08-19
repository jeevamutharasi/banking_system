<!doctype html>
<html lang="en">
  <head>
    <title>View Customer </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
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
            <a id="mybtn" class="btn btn-outline-primary" href="view.php" role="button">View Customer</a>
          </li>
        </ul>
     </div>
    </nav>
    <div class="container">
      <h2 class="text-center pt-4">ALL THE TRANSACTION HISTORY IS HERE</h2>
      
     <br>
     <div class="table-responsive-sm">
  <table class="table table-hover table-info table-condensed table-bordered">
      <thead>
          <tr>
              <th class="text-center">Sender</th>
              <th class="text-center">Receiver</th>
              <th class="text-center">Amount</th>
      </thead>
      <tbody>
      <?php

          include 'connect.php';

          $sql ="select * from transferhistory";

          $query =mysqli_query($conn, $sql);

          while($rows = mysqli_fetch_assoc($query))
          {
      ?>

          <tr>
          <td class="py-2"><?php echo $rows['sender']; ?></td>
          <td class="py-2"><?php echo $rows['reciver']; ?></td>
          <td class="py-2"><?php echo $rows['amount']; ?> </td>
               
      <?php
          }

      ?>
      </tbody>
  </table>

  </div>
</div>

<footer>
    &copy; Banking System | All Right Reserved | Belongs to Jeevamutharasi    
  </footer>

  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</html>