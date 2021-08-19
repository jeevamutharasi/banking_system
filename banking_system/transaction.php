<?php
include 'connect.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['email'];
    $amount = $_POST['amount'];
	
    $sql = "SELECT * from customer where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sqls = "SELECT * from customer where email='$to'";
    echo($sqls);
    $query1 = mysqli_query($conn,$sqls);
    $sql2 = mysqli_fetch_array($query1);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['balance'] - $amount;
                $sqla = "UPDATE customer set balance=$newbalance where id=$from";
                mysqli_query($conn,$sqla);
             

                // adding amount to reciever's account
                $newbalance = $sql2['balance'] + $amount;
                $sqlb = "UPDATE customer set balance=$newbalance where email='$to'";
                mysqli_query($conn,$sqlb);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sqlc = "INSERT INTO transferhistory(`sender`, `reciver`, `amount`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sqlc);

                if($query){
                     echo "<script> alert('TRANSACTION SUCCESSFUL');
                                     window.location='history.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>View Customer </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
      .bttn{
        background-color:blueviolet;
        transition: 0.5s;
      }
      button:hover{
        background-color: #1e90ff;
        color: lavender;
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
          <li class="nav-item">
            <a id="mybtn" class="btn btn-outline-primary" href="view.php" role="button">View Customer</a>
          </li>
        </ul>
     </div>
    </nav>
    <div class="container">
        <h2 class="text-center pt-4">Transaction</h2>
            <?php
                include 'connect.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  customer where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-success table-condensed table-bordered">
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label>Transfer To:</label>
        <select name="email" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'connect.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM customer where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option>
                   <?php echo $rows['email'] ;?>
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label>Amount:</label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="bttn btn mt-3" name="submit" type="submit" id="myBtn">Transfer</button>
            </div>
        </form>
    </div>

  <footer>
    &copy; Banking System | All Right Reserved | Belongs to Jeevamutharasi    
  </footer>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</html>