<?php
  session_start();
     require 'db.php';
     include  'index.php';
   if(isset($_SESSION['role']) && $_SESSION['role']  != 'banker')
   {
    $total = mysqli_query($dbcon,"select sum(transation_amount) as total from accounts  where userID ='".$_SESSION['user_id']."'");
       $row = mysqli_fetch_array($total,MYSQLI_ASSOC);
        $_SESSION['total'] = $row['total'];
        if(isset($_POST['submit']))
         {
            $account_number = $_POST['account_number'];
            $transation_type = $_POST['transation_type'];
            $transation_amount = $_POST['transation_amount'];
            $userID = $_SESSION['user_id'];
             $_SESSION['transation_amount'] = $transation_amount;

            if($transation_type == 'deposit')
            {
              $q = "insert into accounts values('','$account_number','$transation_type','$transation_amount','$userID')";
              if(mysqli_query($dbcon,$q) == 1)
                {
                    echo "Your ammont has been added successfully";
                   header("Location: users.php");
                   exit();
                    
                }
            }
            elseif ($transation_type == 'withdraw') 
            {
            $query = "update accounts set transation_amount='".$_SESSION['total']."' - '".$_SESSION['transation_amount']."', transation_type='withdraw' where userID ='".$_SESSION['user_id']."'";
              $data = mysqli_query($dbcon,$query);
              if($data == 1)
              {
                echo "Money Withdraw successfully";
                header("Location: users.php");
                exit();
              }
            }
            else{
              echo "Not added";
            }
            
    }
     
 ?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.bg-light {
            background-color: #f8f9fa!important;
          }
	</style>
	<title>users dashboard</title>
</head>
<body class="bg-light">
<div class="container">
<div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">User Dashboard | Total balance : <?php echo $row['total']; ?></h6>
        <div class="text-muted pt-3">
          <form method="POST">
				  <div class="form-group">
				    <label for="accountNumber">Account Number</label>
				    <input type="number" class="form-control" name="account_number" id="account_number" placeholder="Enter Account Number">
				    <small id="account_number" class="form-text text-muted">Account Number will be 6 Character</small>
				  </div>
				  <div class="form-group">
				  <label for="transactionType">Transaction Type</label>
				  <select class="form-control form-control-sm" name="transation_type" id="transation_type">
                      <option>Select Trans Type</option>
                      <option value="deposit">Deposit</option>
                      <option value="withdraw">Withdraw</option>
                  </select>
              </div>
				  <div class="form-group">
				    <label for="transaction_amount">Transaction Amount</label>
				    <input type="number" class="form-control" name="transation_amount" id="transation_amount" placeholder="Enter Amount">
				  </div>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				</form>
          
        </div>
        <small class="d-block text-right mt-3">
          <a href="#">All updates</a>
        </small>
      </div>
    </div>
</body>
</html>
<?php } elseif (isset($_SESSION['role']) && $_SESSION['role']  == 'banker') {
     echo "Not permit to access user Dashboard";
}

else {
    header("Location: login.php"); 
}
?>