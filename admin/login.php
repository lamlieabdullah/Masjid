<?php session_start(); /* Starts the session */
if(isset($_SESSION['UserData']['Username'])){
  header("location:slider.php");
  exit;
}
	/* Check Login form submitted */
	if(isset($_POST['Submit'])){
		/* Define username and associated password array */
		$logins = array('admin' => 'oeeOhsem');

		/* Check and assign submitted Username and Password to new variable */
		$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
		$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

		/* Check Username and Password existence in defined array */
		if (isset($logins[$Username]) && $logins[$Username] == $Password){
			/* Success: Set session variables and redirect to Protected page  */
			$_SESSION['UserData']['Username']=$logins[$Username];
			header("location:slider.php");
			exit;
		} else {
			/*Unsuccessful attempt: Set error message */
			$msg="Login tidak sah.";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Memaparkan waktu solat, info dan berbagai maklumat.  Khusus untuk kegunaan masjid">
  <meta name="author" content="Hairilfaiz @ denshie.com">
	<link rel="shortcut icon" href="../setting/assets/images/islamic-symbols-icon-png-13211-128x106.png" type="image/x-icon">
  <title>Login - Sistem Paparan Digital</title>
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <style>
  .gambar-icon{
    margin: auto;
  }
  </style>
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
			<?php if(isset($msg)){
				?>
				<div class="alert alert-danger text-center" role="alert"><?php echo $msg; ?></div>
				<?php
			}?>
      <img class="gambar-icon" src="../setting/assets/images/islamic-symbols-icon-png-13211-128x106.png" alt="" width="100" height="100">
      <div class="card-header text-center">Sistem Paparan Digital</div>
      <div class="card-body">
          <p>Kata Nama: admin</p>
      <p>Kata Laluan: denshie</p>
        <form action="login.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Kata Nama</label>
            <input class="form-control" name="Username" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Kata Nama">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Kata Laluan</label>
            <input class="form-control" name="Password" id="exampleInputPassword1" type="password" placeholder="Kata Laluan">
          </div>
          <button name="Submit" class="btn btn-primary btn-block" type="submit" href="index.html">Login</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
