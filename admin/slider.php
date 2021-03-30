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
          <li class="breadcrumb-item active">Slide</li>
        </ol>

        <div class="action-button">Tambah Slide:
        <a href='add_gambar.php'><button type="button" class="btn btn-primary btn-sm"><i class='fa fa-picture-o' aria-hidden='true'></i>Gambar</button></a>
        <a href='add_video.php'><button type="button" class="btn btn-secondary btn-sm"><i class='fa fa-video-camera' aria-hidden='true'></i>Video</button></a>
        <a href='add_event.php'><button type="button" class="btn btn-success btn-sm"><i class='fa fa-sort-numeric-desc' aria-hidden='true'></i>CountDown</button></a>
        <a href='add_template.php'><button type="button" class="btn btn-danger btn-sm"><i class='fa fa-file-text-o' aria-hidden='true'></i>Template</button></a>
      </div>

        <!-- Aktif-->
        <div class="card mb-3">
          <div class="card-header bg-primary text-center">
            <h1><i class="fa fa-table"></i>Dipaparkan</h1></div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                  <thead class="bg-primary">
                    <tr>
                      <th>Gil.</th>
                      <th>Jenis</th>
                      <th>Tajuk</th>
                      <th>Mula</th>
                      <th>Tamat</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-primary">
                    <tr>
                      <th>Gil.</th>
                      <th>Jenis</th>
                      <th>Tajuk</th>
                      <th>Mula</th>
                      <th>Tamat</th>
                      <th>Tindakan</th>
                    </tr>
                  </tfoot>
                  <tbody id="table-sort">
                    <?php
                    $sql = "SELECT * FROM " . database_prefix ."_slider WHERE paparkan='1' ORDER BY paparkan DESC, giliran ASC, slider_id DESC";
                    $result = mysqli_query($dbc, $sql);

                    if (mysqli_num_rows($result) > 0) {
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                        $slider_id = $row['slider_id'];
                        $giliran = $row['giliran'];
                        $tajuk = $row['tajuk'];
                        $mula = $row['mula'];
                        $tamat = $row['tamat'];
                        $popover_button = '<button type="button" class="btn btn-primary">Batal</button>
                        <button onclick="delete_slide('.$slider_id.')" type="button" class="btn btn-danger dok-tepi-kanan">Delete</button>';
                        if($row['jenis']==='gambar') {
                          $jenis = 'fa fa-picture-o';
                          $edit = "<a href='edit_gambar.php?id=$slider_id'><button type='button' class='btn btn-success btn-sm jarakkan'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>";
                        }
                        else if($row['jenis']==='video') {
                          $jenis = 'fa fa-video-camera';
                          $edit = "<a href='edit_video.php?id=$slider_id'><button type='button' class='btn btn-success btn-sm jarakkan'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>";
                        }
                        else if($row['jenis']==='event'){
                          $jenis = 'fa fa-sort-numeric-desc';
                          $edit = "<a href='edit_event.php?id=$slider_id'><button type='button' class='btn btn-success btn-sm jarakkan'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>";
                        }
                        else {
                          $jenis = 'fa fa-file-text-o';
                          $edit = "<a href='edit_template.php?id=$slider_id'><button type='button' class='btn btn-success btn-sm jarakkan'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>";
                        }
                        echo "<tr id='$slider_id'>
                        <td>$giliran</td>
                        <td><i class='$jenis' aria-hidden='true'></i></td>
                        <td>$tajuk</td>
                        <td>$mula</td>
                        <td>$tamat</td>
                        <td>
                        <div>
                        <input id='toggle-event-$slider_id' type='checkbox' checked data-toggle='toggle' data-size='small'>
                        $edit
                        <button data-toggle='popover' data-trigger='focus' data-html=true title='Adakah anda ingin DELETE?' data-content='$popover_button' type='button' class='btn btn-danger btn-sm jarakkan'><i class='fa fa-trash-o' aria-hidden='true'></i></button>
                        </div>
                        <script>
                        $(function() {
                          $('#toggle-event-$slider_id').change(function() {
                            toggled_switch_off('$slider_id');
                          })
                        })
                        </script>
                        </td>
                        ";
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Tidak Aktif-->
          <div class="card mb-3">
            <div class="card-header bg-danger text-center">
              <h1><i class="fa fa-table"></i>Tidak Dipaparkan</h1></div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead class="bg-danger">
                      <tr>
                        <th>Gil.</th>
                        <th>Jenis</th>
                        <th>Tajuk</th>
                        <th>Mula</th>
                        <th>Tamat</th>
                        <th>Tindakan</th>
                      </tr>
                    </thead>
                    <tfoot class="bg-danger">
                      <tr>
                        <th>Gil.</th>
                        <th>Jenis</th>
                        <th>Tajuk</th>
                        <th>Mula</th>
                        <th>Tamat</th>
                        <th>Tindakan</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      $sql = "SELECT * FROM " . database_prefix ."_slider WHERE paparkan='0' ORDER BY paparkan DESC, giliran ASC, slider_id DESC";
                      $result = mysqli_query($dbc, $sql);

                      if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                          $slider_id = $row['slider_id'];
                          $giliran = $row['giliran'];
                          $tajuk = $row['tajuk'];
                          $mula = $row['mula'];
                          $tamat = $row['tamat'];
                          $popover_button = '<button type="button" class="btn btn-primary">Batal</button>
                          <button onclick="delete_slide('.$slider_id.')" type="button" class="btn btn-danger dok-tepi-kanan">Delete</button>';
                          if($row['jenis']==='gambar') {
                            $jenis = 'fa fa-picture-o';
                            $edit = "<a href='edit_gambar.php?id=$slider_id'><button type='button' class='btn btn-success btn-sm jarakkan'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>";
                          }
                          else if($row['jenis']==='video') {
                            $jenis = 'fa fa-video-camera';
                            $edit = "<a href='edit_video.php?id=$slider_id'><button type='button' class='btn btn-success btn-sm jarakkan'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>";
                          }
                          else if($row['jenis']==='event'){
                            $jenis = 'fa fa-sort-numeric-desc';
                            $edit = "<a href='edit_event.php?id=$slider_id'><button type='button' class='btn btn-success btn-sm jarakkan'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>";
                          }
                          else {
                            $jenis = 'fa fa-file-text-o';
                            $edit = "<a href='edit_template.php?id=$slider_id'><button type='button' class='btn btn-success btn-sm jarakkan'><i class='fa fa-pencil' aria-hidden='true'></i></button></a>";
                          }
                          echo "<tr id='$slider_id'>
                          <td>$giliran</td>
                          <td><i class='$jenis' aria-hidden='true'></i></td>
                          <td>$tajuk</td>
                          <td>$mula</td>
                          <td>$tamat</td>
                          <td>
                          <div>
                          <input id='toggle-event-$slider_id' type='checkbox' data-toggle='toggle' data-size='small'>
                          $edit
                          <button data-toggle='popover' data-trigger='focus' data-html=true title='Adakah anda ingin DELETE?' data-content='$popover_button' type='button' class='btn btn-danger btn-sm jarakkan'><i class='fa fa-trash-o' aria-hidden='true'></i></button>
                          </div>
                          <script>
                          $(function() {
                            $('#toggle-event-$slider_id').change(function() {
                              toggled_switch_on('$slider_id');
                            })
                          })
                          </script>
                          </td>
                          ";
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="action-button">Tambah Slide:
            <a href='add_gambar.php'><button type="button" class="btn btn-primary btn-sm"><i class='fa fa-picture-o' aria-hidden='true'></i>Gambar</button></a>
            <a href='add_video.php'><button type="button" class="btn btn-secondary btn-sm"><i class='fa fa-video-camera' aria-hidden='true'></i>Video</button></a>
            <a href='add_event.php'><button type="button" class="btn btn-success btn-sm"><i class='fa fa-sort-numeric-desc' aria-hidden='true'></i>CountDown</button></a>
            <a href='add_template.php'><button type="button" class="btn btn-danger btn-sm"><i class='fa fa-file-text-o' aria-hidden='true'></i>Template</button></a>
          </div>

<?php include('template/footer.php'); ?>
          <script>
          $(function() {
            $("#table-sort").sortable({
              placeholder: "ui-state-highlight",
              update: function( event, ui ) {
                updateDisplayOrder();
              }
            });
          });

          function updateDisplayOrder() {
            var selectedLanguage = new Array();
            //ul#sortable-rows li
            $('tbody#table-sort tr').each(function() {
              selectedLanguage.push($(this).attr("id"));
            });
            var dataString = 'sort_order='+selectedLanguage;
            console.log(dataString);
            $.ajax({
              type: "GET",
              url: "update_order.php",
              data: dataString,
              cache: false,
              success: function(data){
                location.reload();
              }
            });
          }

          function toggled_switch_off(id){
            //umum call
            $.ajax({
              url: 'toggled_off.php',
              data: "id=" + id,
              type: 'post',
              success: function(data, status) {
                //refresh page
                if(data=='1') location.reload();
              }
            }); // end ajax umum call
          }//end function toggled_switch_off

          function toggled_switch_on(id){
            //umum call
            $.ajax({
              url: 'toggled_on.php',
              data: "id=" + id,
              type: 'post',
              success: function(data, status) {
                //refresh page
                if(data=='1') location.reload();
              }
            }); // end ajax umum call
          }//end function toggled_switch_on

          function delete_slide(id){
            $.ajax({
              url: 'delete_slide.php',
              data: "id=" + id,
              type: 'post',
              success: function(data, status) {
                //refresh page
                if(data=='1') location.reload();
              }
            }); // end ajax umum call
          }//end function delete_slide

          $(function () {
            $('[data-toggle="popover"]').popover(
              //  html: 'true'
            )
          });

          </script>
        </div>
      </body>

      </html>
