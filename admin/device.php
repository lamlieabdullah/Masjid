<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
  header("location:login.php");
  exit;
}
require(MYSQL);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if($_POST['mybutton'] == 'kemaskini'){
    $sql = "UPDATE " . database_prefix ."_umum SET last_update = NOW() WHERE umum_id = 1;";
    $result = mysqli_query($dbc, $sql);
  }

  if($_POST['mybutton'] == 'jam'){
    //update jam variable
    $jam_tahun = escape_data($_POST['jam_tahun'], $dbc);
    $jam_bulan = escape_data($_POST['jam_bulan'], $dbc);
    $jam_hari = escape_data($_POST['jam_hari'], $dbc);
    $jam_jam = escape_data($_POST['jam_jam'], $dbc);
    $jam_minit = escape_data($_POST['jam_minit'], $dbc);
    $jam_saat = escape_data($_POST['jam_saat'], $dbc);

    //update jam NOW raspberry pi
    system("sudo date --set '" . $jam_tahun."-" . $jam_bulan ."-" . $jam_hari. " " . $jam_jam . ":" . $jam_minit . ":" . $jam_saat . "'");
    system("sudo hwclock -w");
  }

  if($_POST['mybutton'] == 'shutdown'){
    system("sudo shutdown -h now");
    //system("sudo reboot");
  }

  if($_POST['mybutton'] == 'restart'){
    //system("sudo shutdown -h now");
    system("sudo reboot");
  }

}
$title = "Device";
include('template/header.php');
?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Utama</a>
          </li>
          <li class="breadcrumb-item active">Set Device</li>
        </ol>
        <?php
        if(isset($msg)){
          ?>
          <div class="alert alert-danger text-center" role="alert"><?php echo $msg; ?></div>
          <?php
        }
        ?>
        <!-- Tarikh Hijrah-->
        <div class="card mb-3">
          <div class="card-header text-center"></div>
          <div class="card-body">
            <form method="post">
              <button type="submit" name="mybutton" value="kemaskini" class="btn btn-lg btn-block btn-primary">Kemaskini Paparan</button>
            </form>
          </div>
        </div>

        <!-- untuk device sahaja 
        <div class="card mb-3">
          <div class="card-header text-center"></div>
          <div class="card-body">
            <form method="post">
              <input type="hidden" class="form-control" id="jam_tahun" name="jam_tahun" value="">
              <input type="hidden" class="form-control" id="jam_bulan" name="jam_bulan" value="">
              <input type="hidden" class="form-control" id="jam_hari" name="jam_hari" value="">
              <input type="hidden" class="form-control" id="jam_jam" name="jam_jam" value="">
              <input type="hidden" class="form-control" id="jam_minit" name="jam_minit" value="">
              <input type="hidden" class="form-control" id="jam_saat" name="jam_saat" value="">
              <button type="submit" name="mybutton" value="jam" class="btn btn-lg btn-block btn-warning">Sync Jam</button>
            </form>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-center"></div>
          <div class="card-body">
            <form method="post">
              <button type="submit" name="mybutton" value="restart" class="btn btn-lg btn-block btn-danger">Restart</button>
            </form>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-center"></div>
          <div class="card-body">
            <form method="post">
              <button type="submit" name="mybutton" value="shutdown" class="btn btn-lg btn-block btn-danger">Shutdown</button>
            </form>
          </div>
        </div>
        -->

<?php include('template/footer.php'); ?>

      <script>
      function startTime(){
        function checkTime(i) {
          if (i < 10) {
            i = "0" + i;
          }
          return i;
        }

        var today = new Date();
        var hr = today.getHours();
        var min = today.getMinutes();
        var sec = today.getSeconds();
        var curDay = today.getDate();
        var curMonth = today.getMonth()+1;
        var curYear = today.getFullYear();
        curMonth = checkTime(curMonth);
        hr = checkTime(hr);
        min = checkTime(min);
        sec = checkTime(sec);
        document.getElementById("jam_tahun").value = curYear;
        document.getElementById("jam_bulan").value = curMonth;
        document.getElementById("jam_hari").value = curDay;
        document.getElementById("jam_jam").value = hr;
        document.getElementById("jam_minit").value = min;
        document.getElementById("jam_saat").value = sec;
        setTimeout(function(){ startTime() }, 1000);
      }
      startTime();
      </script>
    </div>
  </body>

  </html>
