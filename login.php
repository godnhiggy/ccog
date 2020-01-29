<?php include('server.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>CCOG Calendar Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>PLC Login</h2>
  </div>

  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>

  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  	<!--	Not yet a member? <a href="register_insurance.php">Sign up</a>-->
  	</p>
  </form>
</body>
</html>
