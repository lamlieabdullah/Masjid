<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

if(isset($_GET["id"])) {
	$id = $_GET["id"];
}
else $id = '0';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$tajuk_post = escape_data($_POST['tajuk'], $dbc);
	$giliran_post = escape_data($_POST['giliran'], $dbc);
	$mula_post = escape_data($_POST['mula'], $dbc);
	$tamat_post = escape_data($_POST['tamat'], $dbc);
	$kandungan_post = escape_data($_POST['kandungan'], $dbc);
	$tempoh_post = escape_data($_POST['tempoh'], $dbc);
	if($_POST['mybutton'] == 'simpan'){
		$sql = "UPDATE " . database_prefix ."_slider SET
		`tajuk`='$tajuk_post',
		`giliran`='$giliran_post',
		`tamat`='$tamat_post',
		`mula`='$mula_post',
		`kandungan` = '$kandungan_post',
		`slide_duration`='$tempoh_post'
		WHERE `slider_id`='$id'
		";
		$result = mysqli_query($dbc, $sql);
		if(mysqli_affected_rows($dbc) === 1){
			header("location:slider.php");
		}else{
			$error = "Tiada perubahan.Kemaskini tidak berjaya";
		}
	}
}
$title = "Slide";
include('template/header.php');
?>

				<!-- Breadcrumbs-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="index.php">Utama</a>
					</li>
					<li class="breadcrumb-item">
						<a href="slider.php">Slide</a>
					</li>
					<li class="breadcrumb-item active">Edit Slide Template</li>
				</ol>

				<!-- Aktif-->
				<?php
				if(isset($error)){
					?> <div class="alert alert-danger text-center" role="alert"> <?php
					echo $error;
					?> </div> <?php
				} ?>
				<div class="card mb-3">
					<div class="card-header bg-primary text-center">
						<i class="fa fa-table"></i>Edit Slide Template</div>
						<div class="card-body">
							<?php
							$sql = "SELECT * FROM " . database_prefix ."_slider WHERE `slider_id`='$id'";
							$result = mysqli_query($dbc, $sql);
							if (mysqli_num_rows($result) === 1) {
								// output data of each row
								$row = mysqli_fetch_assoc($result);
								$url = $row['url'];
								$tajuk = $row['tajuk'];
								$giliran = $row['giliran'];
								$tamat = $row['tamat'];
								$mula = $row['mula'];
								$kandungan = $row['kandungan'];
								$tempoh = $row['slide_duration'];
								?>
								<img src="../background/<?php echo $url; ?>" width="100%" class="img-fluid" alt="Responsive image">
									<hr>
									<form method="POST">
										<div class="form-group row">
											<label for="inputTajuk" class="col-sm-2 col-form-label">Tajuk:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="tajuk" name="tajuk" value="<?php echo $tajuk; ?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="inputGiliran" class="col-sm-2 col-form-label">Giliran:</label>
											<div class="col-sm-10">
												<input type="number" min="0" class="form-control" id="giliran" name="giliran" value="<?php echo $giliran; ?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="inputGiliran" class="col-sm-2 col-form-label">Tempoh Slide (saat):</label>
											<div class="col-sm-10">
												<input type="number" min="0" class="form-control" id="tempoh" name="tempoh" value="<?php echo $tempoh; ?>">
											</div>
										</div>
									<div class="form-group row">
										<label for="inputTamat" class="col-sm-2 col-form-label">Mula:</label>
										<div class="col-sm-10 input-group date" id="datetimepicker_mula" data-target-input="nearest">
											<input  type="text" name="mula" value="<?php echo $mula; ?>" class="form-control datetimepicker-input" data-target="#datetimepicker_mula" required/>
											<div class="input-group-append" data-target="#datetimepicker_mula" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputTamat" class="col-sm-2 col-form-label">Tamat:</label>
										<div class="col-sm-10 input-group date" id="datetimepicker_tamat" data-target-input="nearest">
											<input type="text" name="tamat" value="<?php echo $tamat; ?>" class="form-control datetimepicker-input" data-target="#datetimepicker_tamat" required/>
											<div class="input-group-append" data-target="#datetimepicker_tamat" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<textarea name="kandungan"><?php echo $kandungan; ?></textarea>
									</div>
									<button name="mybutton" value="simpan" type="submit" class="btn btn-primary btn-lg btn-block">Simpan</button>
								</form>
								<?php
							}
							?>
						</div>
					</div>
<?php include('template/footer.php'); ?>
				<script src="../vendor/tinymce/tinymce.min.js"></script>

				<script>
				$(function () {
					$('#datetimepicker_mula').datetimepicker({
						format: 'YYYY-MM-DD'
					});
				});

				$(function () {
					$('#datetimepicker_tamat').datetimepicker({
						format: 'YYYY-MM-DD HH:mm'
					});
				});

				tinymce.init({
					selector: 'textarea',
					relative_urls: false,
					remove_script_host: false,
					convert_urls: true,
					fontsize_formats:'16pt 20pt 24pt 36pt 48pt 54pt 72pt 82pt',
					images_upload_url: 'postAcceptor.php',
					images_upload_base_path: '<?php echo $home_url;?>admin/',
					height: 400,
					theme: 'modern',
					plugins: 'code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
					toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
					toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | image code | insertdatetime preview | forecolor backcolor table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking template pagebreak restoredraft",
					image_advtab: false,
					templates: [
						{ title: 'Test template 1', content: 'Test 1' },
						{ title: 'Test template 2', content: 'Test 2' }
					],
					mobile: {
						theme: 'mobile',
						plugins: [ 'autosave', 'lists', 'autolink' ],
						toolbar: [ 'undo', 'redo', 'bullist', 'numlist', 'styleselect','image', 'formatselect', 'fontsizeselect', 'forecolor']
					}
				});

				</script>
			</div>
		</body>

		</html>
