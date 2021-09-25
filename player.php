<?php
require('config/config.inc.php');
require(MYSQL);
$nama_file = 'player.php';

$sql = "SELECT `template` FROM " . database_prefix ."_umum";
$result = mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $template =  $row['template'];
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{
  width: 100%;
  height: 100%;
}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  border-left: 16px solid pink;
  width: 200px;
  height: 200px;
  margin-left: auto;
  margin-right: auto;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

h1{
  text-align: center;
}
</style>
</head>
<body>

<h1>Loading...</h1>
<div class="loader"></div>

    <script>
    function startPlayer(){
        window.location='playerStart.php';
    }

    setTimeout(function(){ startPlayer() }, 2000);
</script>
</body>
</html>
