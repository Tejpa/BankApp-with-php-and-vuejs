<?php
  session_start();
  require 'db.php';
  include 'index.php';

  if(isset($_POST['login']))
  {
  	$email = $_REQUEST['email'];
  	$password = $_REQUEST['password'];
    $role = $_REQUEST['role'];
    $_SESSION['role'] = $role;
    $_SESSION['email'] = $email;
  	

  	$query_user = "select * from user where email='$email' AND password=SHA1('$password') AND role='$role'";
  	 $q_data = mysqli_query($dbcon,$query_user);
     $count = mysqli_num_rows($q_data);

     $row = mysqli_fetch_array($q_data,MYSQLI_ASSOC);
     // print_r($row);exit();
     if($count == 1)
     {
        $_SESSION['user_id'] = $row['id'];
        $role = $row['role'];

        if($role == 'user')
        {
           header("Location: users.php");
           exit();
        }
        elseif ($role == 'banker') {
            header("Location: banker.php");
            exit();
        }
        else{
            echo "Wrong Email and Password";
           header("Location: login.php");
        }
     }
     else{
          
          header("Location: login.php");
     }

  }
?>

 <div class="container">
   <h2>Login</h2>
  <form  id="Loginapp" @submit="loginForm" method="POST">
  	<p v-if="errors.length">
			 <b>Please correct the following error(s):</b>
			  <ul>
			     <li v-for="error in errors">{{ error }}</li>
			   </ul>
			</p>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" v-model="email" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" v-model="password" id="password" placeholder="Enter password" name="password">
    </div>
     <div class="form-group">
          <label for="role">Role</label>
          <select class="form-control form-control-sm" name="role">
              <option>Select Role</option>
              <option value="banker">banker</option>
              <option value="user">user</option>
          </select>
      </div>
    <button type="submit" name="login" class="btn btn-primary">Login</button>
  </form>
</div>
<script src="app.js"></script>