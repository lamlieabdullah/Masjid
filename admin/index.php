<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
  header("location:login.php");
  exit;
}
require(MYSQL);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = '1';
  if($_POST['mybutton'] == 'layar'){
		$player = $_POST['player'];

		$sql = "UPDATE " . database_prefix ."_umum SET
		`template` = '$player'
		WHERE umum_id=$id";
		$result = mysqli_query($dbc, $sql);
	}

  if($_POST['mybutton'] == 'maklumat'){
    $nama_lokasi = escape_data($_POST['nama_lokasi'], $dbc);
		$alamat = escape_data($_POST['alamat'], $dbc);

		$sql = "UPDATE " . database_prefix ."_umum SET
    `nama_tempat`='$nama_lokasi',
		`alamat`='$alamat'
		WHERE umum_id=$id";
		$result = mysqli_query($dbc, $sql);
	}

  if($_POST['mybutton'] == 'zon'){
if( ($_POST['pilih_zone'] != '0') && ($_POST['pilih_negeri'] != '0') ) {
    $pilih_negeri = $_POST['pilih_negeri'];
    $pilih_zone = $_POST['pilih_zone'];
		$sql = "UPDATE " . database_prefix ."_umum SET
    `negeri`='$pilih_negeri',
		`lokasiID`='$pilih_zone'
		WHERE umum_id=$id";
		$result = mysqli_query($dbc, $sql);
  }
	}

  if($_POST['mybutton'] == 'iqamah'){
    $iqamah_subuh = escape_data($_POST['iqamah_subuh'], $dbc);
		$iqamah_zohor = escape_data($_POST['iqamah_zohor'], $dbc);
		$iqamah_asar = escape_data($_POST['iqamah_asar'], $dbc);
		$iqamah_maghrib = escape_data($_POST['iqamah_maghrib'], $dbc);
		$iqamah_isyak = escape_data($_POST['iqamah_isyak'], $dbc);

		$sql = "UPDATE " . database_prefix ."_umum SET
    `iqamah_subuh`='$iqamah_subuh',
		`iqamah_zohor`='$iqamah_zohor',
		`iqamah_asar`='$iqamah_asar',
		`iqamah_maghrib`='$iqamah_maghrib',
		`iqamah_isyak`='$iqamah_isyak'
		WHERE umum_id=$id";
		$result = mysqli_query($dbc, $sql);
	}

  if($_POST['mybutton'] == 'solat'){
    $solat_subuh = escape_data($_POST['solat_subuh'], $dbc);
		$solat_zohor = escape_data($_POST['solat_zohor'], $dbc);
		$solat_asar = escape_data($_POST['solat_asar'], $dbc);
		$solat_maghrib = escape_data($_POST['solat_maghrib'], $dbc);
		$solat_isyak = escape_data($_POST['solat_isyak'], $dbc);

		$sql = "UPDATE " . database_prefix ."_umum SET
    `solat_subuh`='$solat_subuh',
		`solat_zohor`='$solat_zohor',
		`solat_asar`='$solat_asar',
		`solat_maghrib`='$solat_maghrib',
		`solat_isyak`='$solat_isyak'
		WHERE umum_id=$id";
		$result = mysqli_query($dbc, $sql);
	}

  if($_POST['mybutton'] == 'jumaat'){
    $jumaat_tempoh_azan = escape_data($_POST['jumaat-tempoh-azan'], $dbc);
		$jumaat_tempoh_khutbah = escape_data($_POST['jumaat-tempoh-khutbah'], $dbc);
		$jumaat_tempoh_solat = escape_data($_POST['jumaat-tempoh-solat'], $dbc);

		$sql = "UPDATE " . database_prefix ."_umum SET
    `jumaat_azan` = '$jumaat_tempoh_azan',
		`jumaat_khutbah` = '$jumaat_tempoh_khutbah',
		`jumaat_solat` = '$jumaat_tempoh_solat'
		WHERE umum_id=$id";
		$result = mysqli_query($dbc, $sql);
	}

  if($_POST['mybutton'] == 'slide'){
    $tempoh_slide = escape_data($_POST['tempoh_slide'], $dbc);

		$sql = "UPDATE " . database_prefix ."_umum SET
    `jeda_slide`='$tempoh_slide'
		WHERE umum_id='$id'";
		$result = mysqli_query($dbc, $sql);
	}

  if($_POST['mybutton'] == 'teks'){
    $saiz_teks = escape_data($_POST['saiz_teks'], $dbc);

		$sql = "UPDATE " . database_prefix ."_umum SET
    `saiz`='$saiz_teks'
		WHERE umum_id='$id'";
		$result = mysqli_query($dbc, $sql);
	}
	
  if($_POST['mybutton'] == 'hijri_adjust'){
    $hijri_adjust = escape_data($_POST['hijri_adjust'], $dbc);

		$sql = "UPDATE " . database_prefix ."_umum SET
    `hijrah_adjustment`='$hijri_adjust'
		WHERE umum_id='$id'";
		$result = mysqli_query($dbc, $sql);
	}	

	
}

$sql = "SELECT * FROM " . database_prefix ."_umum";
$result = mysqli_query($dbc, $sql);

if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $negeri = strtoupper($row['negeri']);
  $zon = $row['lokasiID'];
  $adjustment = $row['hijrah_adjustment'];
}

$title = "Utama";
include('template/header.php');
?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Utama</li>
        </ol>

        <!-- Tarikh Hijrah-->
        <div class="card mb-3">
          <div class="card-header text-center">Pilihan Layar:</div>
          <div class="card-body">
            <form method="POST">
                  <div class="group-set">
                    <img height="100" width="100" src="../background/player0.jpg" alt="template 1" class="img-thumbnail">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="player" id="inlineRadio1" value="0" <?php if($row['template']=='0') echo 'checked'; ?> >
                      <label class="form-check-label" for="inlineRadio1">0</label>
                    </div>
                    <img height="100" width="100" src="../background/player1.jpg" alt="template 1" class="img-thumbnail">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="player" id="inlineRadio2" value="1" <?php if($row['template']=='1') echo 'checked'; ?>>
                      <label class="form-check-label" for="inlineRadio2">1</label>
                    </div>
                    <img height="100" width="100" src="../background/player2.jpg" alt="template 1" class="img-thumbnail">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="player" id="inlineRadio2" value="2" <?php if($row['template']=='2') echo 'checked'; ?>>
                      <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <img height="100" width="100" src="../background/player3.jpg" alt="template 1" class="img-thumbnail">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="player" id="inlineRadio2" value="3" <?php if($row['template']=='3') echo 'checked'; ?>>
                      <label class="form-check-label" for="inlineRadio2">3</label>
                    </div>
                  </div>
                  <button type="submit" name="mybutton" value="layar" class="btn-lg btn-block btn btn-primary">Simpan Layar</button>
            </form>
          </div>
        </div>

        <!-- Waktu Solat-->
        <div class="card mb-3">
          <div class="card-header text-center">Maklumat Masjid/Surau:</div>
          <div class="card-body">
            <form method="POST">
            <div class="group-set">
      		    <div class="form-group">
      		      <label for="lokasi">Nama Lokasi</label>
      		      <input type="text" class="form-control" name="nama_lokasi" id="nama_lokasi" placeholder="Nama Lokasi" value="<?php echo $row['nama_tempat']; ?>">
      		    </div>
      		    <div class="form-group">
      		      <label for="latitut">Alamat</label>
      		      <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $row['alamat']; ?>">
      		    </div>
      		  </div>
            <button type="submit" name="mybutton" value="maklumat" class="btn-lg btn-block btn btn-primary">Simpan Maklumat Masjid/Surau</button>
      </form>
          </div>
        </div>
		<!-- Hijri Adjustment-->
        <div class="card mb-3">
          <div class="card-header text-center">Hijri Adjustment</div>
          <div class="card-body">
            <form method="POST">
            <div class="group-set">
      		    <div class="form-group">
      		      <label for="lokasi">Hari</label>
      		      <input type="text" class="form-control" name="hijri_adjust" id="hijri_adjust" placeholder="Hijri Adjust" value="<?php echo $row['hijrah_adjustment'] ?>">
      		    </div>
      		  </div>
            <button type="submit" name="mybutton" value="hijri_adjust" class="btn-lg btn-block btn btn-primary">Simpan Hijri Adjustment</button>
      </form>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-center">Zon untuk waktu solat:</div>
          <div class="card-body">
            <form method="post">
              <div class="group-set">
        		    <div class="alert alert-success" role="alert">
        		      Tetapan Sekarang ialah: <?php $content = file_get_contents("zone.json");
        		      $kandungan = json_decode($content, true);
                  if(isset($kandungan["$negeri"][$zon])){
        		      $daerah = $kandungan["$negeri"][$zon]["lokasi"];
        		      echo $negeri .'( '.$daerah. ' )';
                }
        		      ?>
        		    </div>
        		    <div class="form-group">
        		      <label for="longitut">Negeri</label>
        		      <select name='pilih_negeri' id='pilih_negeri' class="form-control">
        		        <option value='0'>Pilih Negeri</option>
                        <option value="Brunei">Brunei</option>
        		        <option value="Johor">Johor</option>
        		        <option value="Kedah">Kedah</option>
        		        <option value="Kelantan">Kelantan</option>
        		        <option value="Melaka">Melaka</option>
        		        <option value="Negeri_Sembilan">Negeri Sembilan</option>
        		        <option value="Pahang">Pahang</option>
        		        <option value="Perak">Perak</option>
        		        <option value="Perlis">Perlis</option>
        		        <option value="Pulau_Pinang">Pulau Pinang</option>
        		        <option value="Sabah">Sabah</option>
        		        <option value="Sarawak">Sarawak</option>
        		        <option value="Selangor">Selangor</option>
        		        <option value="Terengganu">Terengganu</option>
        		        <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>
        		      </select>
        		    </div>
        		    <div class="form-group">
        		      <label for="longitut">Daerah</label>
        		      <!-- pilih zone -->
        		      <select id='pilih_zone' name='pilih_zone' class="form-control">
        		        <option value='0'>Pilih Zon</option>
        		      </select>
        		    </div>
        		    <div class="alert alert-primary" role="alert">
        		      Sumber Waktu Solat : Kiraan berdasarkan formula takwim
        		    </div>
        		  </div>
              <button type="submit" name="mybutton" value="zon" class="btn-lg btn-block btn btn-primary">Simpan Zon Waktu Solat</button>
            </form>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-center">Tempoh Waktu Iqamah (Minit):</div>
          <div class="card-body">
            <form method="post">
              <!--WAKTU IQAMAH -->
        		  <div class="group-set">
        		    <div class="form-group">
        		      <label for="latitut">Subuh</label>
        		      <input type="number" min="1" max="15" class="form-control" name="iqamah_subuh" value="<?php echo $row['iqamah_subuh']; ?>">
        		    </div>
        		    <div class="form-group">
        		      <label for="latitut">Zohor</label>
        		      <input type="number" min="1" max="15" class="form-control" name="iqamah_zohor" value="<?php echo $row['iqamah_zohor']; ?>">
        		    </div>
        		    <div class="form-group">
        		      <label for="latitut">Asar</label>
        		      <input type="number" min="1" max="15" class="form-control" name="iqamah_asar" value="<?php echo $row['iqamah_asar']; ?>">
        		    </div>
        		    <div class="form-group">
        		      <label for="latitut">Maghrib</label>
        		      <input type="number" min="1" max="15" class="form-control" name="iqamah_maghrib" value="<?php echo $row['iqamah_maghrib']; ?>">
        		    </div>
        		    <div class="form-group">
        		      <label for="latitut">Isyak</label>
        		      <input type="number" min="1" max="15" class="form-control" name="iqamah_isyak" value="<?php echo $row['iqamah_isyak']; ?>">
        		    </div>
        		  </div>
              <button type="submit" name="mybutton" value="iqamah" class="btn-lg btn-block btn btn-primary">Simpan Tempoh Iqamah</button>
            </form>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-center">Tempoh Waktu Solat (minit):</div>
          <div class="card-body">
            <form method="post">
              <!--WAKTU SOLAT -->
        		  <div class="group-set">Tempoh Waktu Solat (minit):
        		    <div class="form-group">
        		      <label for="latitut">Subuh</label>
        		      <input type="number" min="1" max="15" class="form-control" name="solat_subuh" value="<?php echo $row['solat_subuh']; ?>">
        		    </div>
        		    <div class="form-group">
        		      <label for="latitut">Zohor</label>
        		      <input type="number" min="1" max="15" class="form-control" name="solat_zohor" value="<?php echo $row['solat_zohor']; ?>">
        		    </div>
        		    <div class="form-group">
        		      <label for="latitut">Asar</label>
        		      <input type="number" min="1" max="15" class="form-control" name="solat_asar" value="<?php echo $row['solat_asar']; ?>">
        		    </div>
        		    <div class="form-group">
        		      <label for="latitut">Maghrib</label>
        		      <input type="number" min="1" max="15" class="form-control" name="solat_maghrib" value="<?php echo $row['solat_maghrib']; ?>">
        		    </div>
        		    <div class="form-group">
        		      <label for="latitut">Isyak</label>
        		      <input type="number" min="1" max="15" class="form-control" name="solat_isyak" value="<?php echo $row['solat_isyak']; ?>">
        		    </div>
        		  </div>
              <button type="submit" name="mybutton" value="solat" class="btn btn-lg btn-block btn-primary">Simpan Tempoh Solat</button>
            </form>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-center"></div>
          <div class="card-body">
            <form method="post">
              <!--SOLAT JUMAAT-->
        		  <div class="group-set">Solat Jumaat:
        		    <div class="form-group">
        		      <label for="latitut">Tempoh Azan (Minit)</label>
        		      <input type="number" min="1" max="15" class="form-control" name="jumaat-tempoh-azan" value="<?php echo $row['jumaat_azan']; ?>">
        		    </div>
        		    <div class="form-group">
        		      <label for="latitut">Tempoh Khutbah (Minit)</label>
        		      <input type="number" min="1" max="60" class="form-control" name="jumaat-tempoh-khutbah" value="<?php echo $row['jumaat_khutbah']; ?>">
        		    </div>
        		    <div class="form-group">
        		      <label for="latitut">Tempoh Solat (Minit)</label>
        		      <input type="number" min="1" max="15" class="form-control" name="jumaat-tempoh-solat" value="<?php echo $row['jumaat_solat']; ?>">
        		    </div>
        		  </div>
              <button type="submit" name="mybutton" value="jumaat" class="btn btn-lg btn-block btn-primary">Simpan Solat Jumaat</button>
            </form>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-center">Tempoh Slide (saat):</div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
        		    <label for="longitut"></label>
        		    <input type="number" class="form-control" name="tempoh_slide" id="tempoh_slide" placeholder="Tempoh slide" value="<?php echo $row['jeda_slide']; ?>">
        		  </div>
              <button type="submit" name="mybutton" value="slide" class="btn btn-lg btn-block btn-primary">Simpan Tempoh Slide</button>
            </form>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-center">Saiz Teks</div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
        		    <label for="longitut"></label>
        		    <input type="number" class="form-control" name="saiz_teks" id="saiz" placeholder="Saiz Teks" value="<?php echo $row['saiz']; ?>">
        		  </div>
              <button type="submit" name="mybutton" value="teks" class="btn btn-lg btn-block btn-primary">Simpan Saiz Teks</button>
            </form>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header text-center">Slide Utama</div>
          <div class="card-body">
            <img src="../images/<?php echo $row['slide_utama']; ?>" width="100%" class="img-fluid" alt="Responsive image">
            <hr>
            <form id="uploadimage" action="" method="post" enctype="multipart/form-data">

							<img id="previewing" src="noimage.png" class="img-fluid" alt="Responsive image">

							<!--  <div id="selectImage"> -->
              <div class="form-group">
								<label for="exampleFormControlFile1">Pilih Gambar:</label>
								<input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" required>
							</div>
							<input type="submit" class="btn btn-success btn-lg btn-block" value="Upload" class="submit" />
							<!--      </div> -->
						</form>
						<div id="loading" class="alert alert-success" role="alert">Loading...</div>
						<div id="message" class="alert alert-danger" role="alert"></div>
          </div>
        </div>



<?php include('template/footer.php'); ?>
      <script>
      //event selector to detect if "pilih negeri" select box is change
    	//if change, fetch and append the list of zones from zone.json (thx abam shahril) for the chosen state
    	$(document).on("change","#pilih_negeri", function(){
    		$('.se-pre-con').fadeIn('fast'); // show loading
    		$('#pilih_zone').empty();
    		$('#results').empty();

    		//use jquery getJSON function to fetch json data
    		$.getJSON( "zone.json", function( data ) {

    			//convert string to uppercase, needed so that can use to compare with the json file.
    			//malas nak tukar satu2 kat index.html xD
    			var negeri = $('#pilih_negeri').val().toUpperCase();

    			var zons = "";
    			$.each( data[negeri], function( key, val ) {
    				zons += "<option value='" + key + "'>" + val.lokasi + "</option>";
    			});
    			var textpilih = "<option value=''>Pilih Zon</option>";
    			$('#pilih_zone').append(textpilih+zons); //append list
    			$('.se-pre-con').fadeOut('fast'); // hide loading

    		});
    	});

      $('#loading').hide();
      $('#message').hide();
      $("#uploadimage").on("submit",(function(e) {
        e.preventDefault();
        $('#loading').show();
        $("#message").empty();
        $.ajax({
          url: "ajax_php_gambar_utama.php", // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false,       // The content type used when sending data to the server.
          cache: false,             // To unable request pages to be cached
          processData:false,        // To send DOMDocument or non processed data file it is set to false
          success: function(data, status) {
            if(data != "berjaya") {
              $('#loading').hide();
              $("#message").html(data);
              $('#message').show();
            }else{
              $('#loading').hide();
              //alert('upload berjaya. Gambar slide akan berasa bahagian Tidak Dipaparkan. Silia ubah setting selanjutnya disitu.');
              window.location.replace("index.php");
            }
          }
        });
      }));

      // Function to preview image after validation
      $(function() {
        $("#fileToUpload").change(function() {
          $('#loading').hide();
          $("#message").empty(); // To remove the previous error message
          var file = this.files[0];
          var imagefile = file.type;
          var match= ["image/jpeg","image/png","image/jpg","image/gif"];
          if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3])))
          {
            $("#previewing").attr("src","noimage.png");
            $("#message").html("Sila pilih fail gambar sahaja.Hanya jpeg, jpg, png dan gif sahaja dibenarkan.");
            $('#message').show();
            return false;
          }
          else
          {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
          }
        });
      });
      function imageIsLoaded(e) {
        $("#fileToUpload").css("color","green");
        $("#image_preview").css("display", "block");
        $("#previewing").attr("src", e.target.result);

      };

      </script>
    </div>
  </body>

  </html>
