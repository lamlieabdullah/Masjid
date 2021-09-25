<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
require(MYSQL);

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
					<li class="breadcrumb-item active">Tambah Slide Video</li>
				</ol>

				<!-- Aktif-->

				<div class="card mb-3">
					<div class="card-header bg-primary text-center">
						<h1>Masukkan Slide Video</h1>
						<h4>Hanya file video format mp4 sahaja dibenarkan</h4>
					</div>
					<div class="card-body">

						<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="inputTajuk" class="col-sm-2 col-form-label">Tajuk:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="tajuk" name="tajuk" type="text" placeholder="Tajuk Slide" required>
								</div>
							</div>
							<video id="previewing" controls>
		 						<source src="movie.mp4" type="video/mp4">
		 						Your browser does not support the video tag.
							</video>

							<input type="hidden" id="vid_duration" name="tempoh" value="0">

							<!--  <div id="selectImage"> -->
							<div class="form-group">
								<label for="exampleFormControlFile1">Fail Video:</label>
								<input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" required>
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
							<label for="inputTamat" class="col-sm-2 col-form-label">Tamat:</label>
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
						<div id="loading" class="alert alert-success" role="alert">Loading...</div>
						<div id="message" class="alert alert-danger" role="alert"></div>
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

			$('#loading').hide();
			$('#message').hide();
			$("#uploadimage").on("submit",(function(e) {
				e.preventDefault();
				$('#loading').show();
				$("#message").empty();
				$.ajax({
					url: "ajax_php_video.php", // Url to which the request is send
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
							alert('upload berjaya. Video slide akan berasa bahagian Tidak Dipaparkan. Silia ubah setting selanjutnya disitu.');
							window.location.replace("slider.php");
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
					var videofile = file.type;
					var match= ["video/mp4","video/MP4"];
					if(!((videofile==match[0]) || (videofile==match[1]) ))
					{
						//$("#previewing").attr("src","noimage.png");
						//$("#message").html(videofile);
						$("#message").html("<p id=\'error\'>Sila pilih fail video sahaja.</p>"+"<h4>Nota:</h4>"+"<span id=\'error_message\'>Hanya mp4 sahaja dibenarkan.</span>");
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
				var vid = document.getElementById("previewing");
				vid.onloadedmetadata = function() {
					document.getElementById("vid_duration").value = Math.ceil(vid.duration);
    			//alert(vid.duration);
					};

			};
			</script>
		</div>
	</body>

	</html>
