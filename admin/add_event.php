<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$sql = "SELECT `jenis` FROM `" . database_prefix ."_slider` WHERE `jenis`='event'";
	$result = mysqli_query($dbc,$sql);
	$rowcount = mysqli_num_rows($result);
	if($rowcount >= 5) {
		$error = '<div class="alert alert-danger" role="alert">Maaf, maksimum 5 CountDown slide sahaja dibenarkan.</div>';

	} else {
		$tajuk = escape_data($_POST['tajuk'], $dbc);
		$url = 'template_'.$_POST['template'].'.jpg';
		$mula = escape_data($_POST['mula'], $dbc);
		$tarikh_peristiwa = escape_data($_POST['tamat'], $dbc);

		$sql = "INSERT INTO " . database_prefix ."_slider (`url`, `paparkan`, `giliran`, `jenis`, `tamat`, `tajuk`, `mula`)
		 				VALUES ('$url', '0', '0', 'event', '$tarikh_peristiwa', '$tajuk', '$mula')";

		$result = mysqli_query($dbc, $sql);
		if(mysqli_affected_rows($dbc)){
			header('Location: slider.php');
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
					<li class="breadcrumb-item active">Tambah Slide CountDown</li>
				</ol>

				<?php if(isset($error)) echo $error; ?>

				<!-- Aktif-->
				<div class="card mb-3">
					<div class="card-header bg-primary text-center">
						<h1>Masukkan Slide CountDown</h1>
					</div>
					<div class="card-body">

						<form method="post">
							<div class="form-group row">
								<label for="inputTajuk" class="col-sm-2 col-form-label">Tajuk:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="tajuk" name="tajuk" type="text" placeholder="Tajuk Slide" required>
								</div>
							</div>
							<div class="form-group row">
									<label for="inputTajuk" class="col-sm-2 col-form-label">Pilihan Latar:</label>
									<div class="col-sm-10">
										<img height="100" width="100" src="../background/template_1.jpg" alt="template 1" class="img-thumbnail">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="template" id="inlineRadio1" value="1" checked="checked">
											<label class="form-check-label" for="inlineRadio1">1</label>
										</div>
										<img height="100" width="100" src="../background/template_2.jpg" alt="template 1" class="img-thumbnail">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="template" id="inlineRadio2" value="2">
											<label class="form-check-label" for="inlineRadio2">2</label>
										</div>
										<img height="100" width="100" src="../background/template_3.jpg" alt="template 1" class="img-thumbnail">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="template" id="inlineRadio1" value="3">
											<label class="form-check-label" for="inlineRadio1">3</label>
										</div>
										<img height="100" width="100" src="../background/template_4.jpg" alt="template 1" class="img-thumbnail">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="template" id="inlineRadio2" value="4">
											<label class="form-check-label" for="inlineRadio2">4</label>
										</div>
										<img height="100" width="100" src="../background/template_5.jpg" alt="template 1" class="img-thumbnail">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="template" id="inlineRadio1" value="5">
											<label class="form-check-label" for="inlineRadio1">5</label>
										</div>
										<img height="100" width="100" src="../background/template_6.jpg" alt="template 1" class="img-thumbnail">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="template" id="inlineRadio2" value="6">
											<label class="form-check-label" for="inlineRadio2">6</label>
										</div>
										<img height="100" width="100" src="../background/template_11.jpg" alt="template 1" class="img-thumbnail">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="template" id="inlineRadio1" value="11">
											<label class="form-check-label" for="inlineRadio1">7</label>
										</div>
										<img height="100" width="100" src="../background/template_8.jpg" alt="template 1" class="img-thumbnail">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="template" id="inlineRadio2" value="8">
											<label class="form-check-label" for="inlineRadio2">8</label>
										</div>
										<img height="100" width="100" src="../background/template_9.jpg" alt="template 1" class="img-thumbnail">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="template" id="inlineRadio1" value="9">
											<label class="form-check-label" for="inlineRadio1">9</label>
										</div>
										<img height="100" width="100" src="../background/template_10.jpg" alt="template 1" class="img-thumbnail">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="template" id="inlineRadio2" value="10">
											<label class="form-check-label" for="inlineRadio2">10</label>
										</div>
									</div>
							</div>
						<div class="form-group row">
							<label for="inputTamat" class="col-sm-2 col-form-label">Mula:</label>
							<div class="col-sm-10 input-group date" id="datetimepicker_mula" data-target-input="nearest">
								<input  type="text" name="mula"  class="form-control datetimepicker-input" data-target="#datetimepicker_mula" required/>
								<div class="input-group-append" data-target="#datetimepicker_mula" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputTamat" class="col-sm-2 col-form-label">Tarikh Peristiwa:</label>
							<div class="col-sm-10 input-group date" id="datetimepicker_tamat" data-target-input="nearest">
								<input type="text" name="tamat"  class="form-control datetimepicker-input" data-target="#datetimepicker_tamat" required/>
								<div class="input-group-append" data-target="#datetimepicker_tamat" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
							<hr>
							<input type="submit" class="btn btn-success btn-lg btn-block" value="Upload" class="submit" />
							<!--      </div> -->
						</form>
					</div>
				</div>

<?php include('template/footer.php'); ?>

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

			</script>
		</div>
	</body>

	</html>
