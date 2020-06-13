<?php
  require 'db.php';
  include 'index.php';
  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
	  $name = trim($_POST['name']);
	  $email = trim($_POST['email']);
	  $phone = trim($_POST['phone']);
	  $password = trim($_POST['password']);
	  $role = trim($_POST['role']);
      
	  $query = "INSERT INTO user VALUES('','$name','$email','$phone',SHA1('$password'),'$role')";
	  if(mysqli_query($dbcon,$query) == 1)
	  {
		  	header("Location: login.php");
		  	exit;
	  }
	  else
	  {
	  	 echo "Sorry! There is an error";
	  }
	}
?>
<main role="main" class="container">
    <div class="jumbotron">
       <form id="app" @submit="checkForm" method="POST" action="register.php">
       	   <p v-if="errors.length">
			 <b>Please correct the following error(s):</b>
			  <ul>
			     <li v-for="error in errors">{{ error }}</li>
			   </ul>
			</p>
       	 <div class="form-group">
		    <label for="name">Name</label>
		    <input type="text" v-model="name" id="name" class="form-control" name="name" placeholder="Enter name">
		  </div>
		  <div class="form-group">
		    <label for="email">Email address</label>
		    <input type="email" v-model="email" id="email" class="form-control" name="email" placeholder="Enter email">
		  </div>
		  <div class="form-group">
		    <label for="phone">Phone Number</label>
		    <input type="number" v-model="phone" id="phone" class="form-control" name="phone" placeholder="8010551054">
		  </div>
		  <div class="form-group">
		    <label for="password">Password</label>
		    <input type="password" v-model="password" id="password" class="form-control" name="password" placeholder="Password">
		  </div>
		  <div class="form-inline">
			  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Role</label>
			  <select class="custom-select my-1 mr-sm-2" v-model="role" id="role" name="role">
			    <option value="banker">banker</option>
			    <option value="user">user</option>
			  </select>
           </div>
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form> 
<script src="app.js"></script>
    </div>
</main>
