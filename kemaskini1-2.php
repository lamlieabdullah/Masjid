<?php
require('./config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
  header("location:admin/login.php");
  exit;
}

$title = "Kemaskini";
include('admin/template/header.php');

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

<!-- Waktu Solat-->
<div class="card mb-3">
  <div class="card-header bg-success text-center">
    <h3><i class="fa fa-calendar" aria-hidden="true"></i>Kemaskini Versi</h3></div>
    <div class="card-body">
      <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if($_POST['mybutton'] == 'versi'){
          $target_dir = BASE_URI. '/updates/';
          $target_file = round(microtime(true)) . basename($_FILES["fileToUpload"]["name"]);
          $target_dir_file = $target_dir . $target_file;
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

          // Check if file already exists
          if (file_exists($target_file)) {
            echo "Maaf, Fail tersebut telah wujud.<br>";
            $uploadOk = 0;
          }
          // Check file size
          if ($_FILES["fileToUpload"]["size"] > 20000000) {
            echo "Maaf, saiz fail melebihi 20MB.<br>";
            $uploadOk = 0;
          }
          // Allow certain file formats
          if($imageFileType != "zip") {
            echo "Maaf, hanya zip sahaja dibenarkan.<br>";
            $uploadOk = 0;
          }
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            echo "Maaf, fail tidak berjaya di muat naik.<br>";
            // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir_file)) {
              echo 'File berjaya dimuatnaik.<br>';

              //update cms saiz
              //Open The File And Do Stuff

              $zip = new ZipArchive;
              if ($zip->open($target_dir_file) === TRUE) {
                $zip->extractTo('updates/');
                $zip->close();
              }

              $zipHandle = zip_open($target_dir_file);
              echo '<ul>';
              while ($aF = zip_read($zipHandle) )
              {
                $thisFileName = zip_entry_name($aF);
                $thisFileDir = dirname($thisFileName);

                //Continue if its not a file
                if ( substr($thisFileName,-1,1) == '/') continue;


                //Make the directory if we need to...
                if ( !is_dir ( BASE_URI. '/' .$thisFileDir ) )
                {
                  mkdir ( BASE_URI. '/' .$thisFileDir, 0777, true );
                  echo '<li>Created Directory '.$thisFileDir.'</li>';
                }

                //Overwrite the file
                if ( !is_dir(BASE_URI.'/'.$thisFileName) ) {
                  echo '<li>'.$thisFileName.'...........';
                  $contents = zip_entry_read($aF, zip_entry_filesize($aF));
                  $contents = str_replace("\r\n", "\n", $contents);
                  $updateThis = '';

                  //If we need to run commands, then do it.
                  if ( $thisFileName == 'kemaskini1-2.php' )
                  {
                    $upgradeExec = fopen ('kemaskini1-2.php','w');
                    fwrite($upgradeExec, $contents);
                    fclose($upgradeExec);
                    include ('kemaskini1-2.php');
                    unlink('kemaskini1-2.php');
                    echo' EXECUTED</li>';
                  }
                  else
                  {
                    // Check if file already exists
                    if (file_exists(BASE_URI.'/'.$thisFileName)) {
                      unlink(BASE_URI.'/'.$thisFileName);
                    }
                    rename('updates/'.$thisFileName, $thisFileName);
                    echo' UPDATED</li>';
                  }
                }
              }
              echo '</ul>';
              $updated = TRUE;
              zip_close ($zipHandle);
              unlink($target_dir_file);
            }
          }
          if (isset($updated) && $updated == true)
          {
            //set_setting('site','CMS',$aV);
            echo '<p class="success">&raquo; office berjaya di kemaskini</p>';
          }
          echo '<hr>';

        }//$_POST['mybutton'] == 'hijrah'
      } //$_SERVER['REQUEST_METHOD']

      ?>
      <form method="post" enctype="multipart/form-data">
        <div class="group-set">Upload file (zip)
          <div class="form-group">
            <label for="formGroupExampleInput2">File:</label>
            <input type="file" name="fileToUpload"  id="validatedCustomFile" disabled required>
          </div>
          <button type="submit" name="mybutton" value="versi" class="btn btn-success" disabled >Kemaskini Versi</button>
        </div>
      </form>
    </div>
  </div>

  <?php include('admin/template/footer.php'); ?>
  <script>

  </script>
</div>
</body>

</html>
