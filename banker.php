<?php

   session_start();
   require 'db.php';
   include_once('index.php');
  if(isset($_SESSION['role']) && $_SESSION['role']  != 'user')
   {
     
      $q = "select accounts.transation_amount, accounts.account_number, accounts.transation_type, user.email from accounts join user on accounts.userID = user.id";
      $data = mysqli_query($dbcon,$q);
      $balance_query = "select sum(transation_amount) as total from accounts";
      $balance_data = mysqli_query($dbcon,$balance_query);
      $row = mysqli_fetch_array($balance_data,MYSQLI_ASSOC);
      
?>
<main role="main" class="container">
	<div class="jumbotron">
		<div>Total Balance :<?php echo $row['total']; ?> </div>
	</hr>
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">User Id</th>
		      <th scope="col">Account Number</th>
		      <th scope="col">Email</th>
		      <th scope="col">Transation</th>
		      <th scope="col">Amount</th>
		    </tr>
		  </thead>
		  <tbody>
		  <?php 
            $id = 0;
		  foreach($data as $row) { ?>
		  	<tr>
		      <td><?= ++$id; ?></td>
		      <td><?= $row['email']; ?></td>
		      <td><?= $row['account_number'];?></td>
		      <td><?= $row['transation_type'];?></td>
		      <td><?= $row['transation_amount'];?></td>
		    </tr>
		   <?php } ?>
		</tbody>
	</table>
  </div>
</main>
<?php } elseif (isset($_SESSION['role']) && $_SESSION['role']  = 'user') {
     echo "you do not have authority to access Admin page!";
}
 else
 {
    header("Location: login.php");
    exit(); 
 }
?>