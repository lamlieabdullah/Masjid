<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
  header("location:login.php");
  exit;
}
require(MYSQL);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if($_POST['mybutton'] == 'hijrah'){
    $tahun = $_POST['pilih_tahun'];
    if($tahun != '10'){
      $target_dir = "../waktuSolat/".$tahun."/";
      $target_file = basename($_FILES["fileToUpload"]["name"]);
      $target_dir_file = $target_dir . $target_file;
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

      // Check if file already exists
      if (file_exists($target_file)) {
        $msg = "Maaf, Fail tersebut telah wujud.";
        $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 2000000) {
        $msg = "Maaf, saiz fail melebihi 2MB.";
        $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "json") {
        $msg = "Maaf, hanya JSON sahaja dibenarkan.";
        $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        $msg .= "Maaf, fail tidak berjaya di muat naik.";
        // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir_file)) {
          $msg = 'Kalendar Hijrah berjaya dimuatnaik';
        }
      }
    } else $msg = "Maaf, fail tidak berjaya di muat naik.Tahun tidak dipilih";

  }//$_POST['mybutton'] == 'hijrah'

  /*==========================================================*/
  if($_POST['mybutton'] == 'solat'){
    $tahun = $_POST['pilih_tahun'];
    if($tahun != '10'){
      $target_dir = "../waktuSolat/".$tahun."/lokasi/";
      $target_file = basename($_FILES["fileToUpload"]["name"]);
      $target_dir_file = $target_dir . $target_file;
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

      // Check if file already exists
      if (file_exists($target_file)) {
        $msg = "Maaf, Fail tersebut telah wujud.";
        $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 2000000) {
        $msg = "Maaf, saiz fail melebihi 2MB.";
        $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "json" ) {
        $msg = "Maaf, hanya JSON sahaja dibenarkan.";
        $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        $msg .= "Maaf, fail tidak berjaya di muat naik.";
        // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir_file)) {
          $msg = 'Waktu Solat berjaya dimuatnaik';
        }
      }
    } else $msg = "Maaf, fail tidak berjaya di muat naik.Tahun tidak dipilih";

  }//$_POST['mybutton'] == 'solat'
} //$_SERVER['REQUEST_METHOD']
$title = "Kemaskini";
include('template/header.php');
?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Utama</a>
          </li>
          <li class="breadcrumb-item active">Kemaskini</li>
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
          <div class="card-header bg-primary text-center">
            <h3><i class="fa fa-calendar" aria-hidden="true"></i>Tarikh Hijrah</h3></div>
            <div class="card-body">
              <form method="post" enctype="multipart/form-data">
                <div class="group-set">Upload Kalendar Hijrah
                  <div class="form-group">
                    <label for="formGroupExampleInput">Tahun:</label>
                    <select class="custom-select" name='pilih_tahun' id='pilih_tahun' class="form-control">
                      <option value='10'>Pilih Tahun</option>
                      <option value="2018">2018</option>
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      <option value="2025">2025</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">File:</label>
                    <input type="file" name="fileToUpload"  id="validatedCustomFile" required>
                  </div>
                  <button type="submit" name="mybutton" value="hijrah" class="btn btn-primary">Upload Kalendar Hijrah</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Waktu Solat-->
          <div class="card mb-3">
            <div class="card-header bg-success text-center">
              <h3><i class="fa fa-calendar" aria-hidden="true"></i>Waktu Solat</h3></div>
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <div class="group-set">Upload Waktu Solat
                    <div class="form-group">
                      <label for="formGroupExampleInput">Tahun:</label>
                      <select class="custom-select" name='pilih_tahun' id='pilih_tahun' class="form-control">
                        <option value='10'>Pilih Tahun</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput2">File:</label>
                      <input type="file" name="fileToUpload"  id="validatedCustomFile" required>
                    </div>
                    <button type="submit" name="mybutton" value="solat" class="btn btn-success">Upload Waktu Solat</button>
                  </div>
                </form>
              </div>
            </div>


<?php include('template/footer.php'); ?>

          <script>

          </script>
        </div>
      </body>

      </html>
