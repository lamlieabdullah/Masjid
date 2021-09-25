<?php
require('../config/config.inc.php');

if(!isset($_SESSION['UserData']['Username'])){
  header("location:login.php");
  exit;
}
require(MYSQL);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if($_POST['mybutton'] == 'simpan'){
    $id = $_POST['id'];
    $teks = escape_data($_POST['scroll_teks'], $dbc);
    $sql = "UPDATE " . database_prefix ."_scroll SET text='$teks' WHERE scroll_id=$id";
    $result = mysqli_query($dbc, $sql);
  }
}

$title = "Teks";
include('template/header.php');
?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Utama</a>
          </li>
          <li class="breadcrumb-item active">Scroll Teks</li>
        </ol>

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
                      <th>Teks</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-primary">
                    <tr>
                      <th>Gil.</th>
                      <th>Teks</th>
                      <th>Tindakan</th>
                    </tr>
                  </tfoot>
                  <tbody id="table-sort">
                    <?php
                    $sql = "SELECT * FROM " . database_prefix ."_scroll WHERE paparkan='1' ORDER BY  giliran ASC";
                    $result = mysqli_query($dbc, $sql);

                    if (mysqli_num_rows($result) > 0) {
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                        $scroll_id = $row['scroll_id'];
                        $giliran = $row['giliran'];
                        $teks = $row['text'];
                        $popover_button = '<button type="button" class="btn btn-primary">Batal</button>
                        <button onclick="delete_scroll('.$scroll_id.')" type="button" class="btn btn-danger dok-tepi-kanan">Delete</button>';

                        echo "<tr id='$scroll_id'>
                        <td>$giliran</td>
                        <td>
                        <div class='form-group row'>
                        <div class='col-sm-10'>
                        <input id='scroll_$scroll_id' type='text' name='scroll_teks' class='form-control' value='$teks'>
                        </div>
                        <div class='col-sm-2'>
                        <button onclick='simpan_scroll($scroll_id)' name='mybutton' value='simpan' type='button' class='simpan btn btn-success btn-sm jarakkan'><i class='fa fa-floppy-o' aria-hidden='true'></i> Simpan</button>
                        </div>
                        </div>
                        </td>
                        <td>
                        <div>
                        <input id='toggle-event-$scroll_id' type='checkbox' checked data-toggle='toggle' data-size='small'>
                        <button data-toggle='popover' data-trigger='focus' data-html=true title='Adakah anda ingin DELETE?' data-content='$popover_button' type='button' class='btn btn-danger btn-sm jarakkan'><i class='fa fa-trash-o' aria-hidden='true'></i></button>
                        </div>
                        <script>
                        $(function() {
                          $('#toggle-event-$scroll_id').change(function() {
                            toggled_switch_off('$scroll_id');
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
                  <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead class="bg-danger">
                      <tr>
                        <th>Gil.</th>
                        <th>Teks</th>
                        <th>Tindakan</th>
                      </tr>
                    </thead>
                    <tfoot class="bg-danger">
                      <tr>
                        <th>Gil.</th>
                        <th>Teks</th>
                        <th>Tindakan</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      $sql = "SELECT * FROM " . database_prefix ."_scroll WHERE paparkan='0' ORDER BY  giliran ASC";
                      $result = mysqli_query($dbc, $sql);

                      if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                          $scroll_id = $row['scroll_id'];
                          $giliran = $row['giliran'];
                          $teks = $row['text'];
                          $popover_button = '<button type="button" class="btn btn-primary">Batal</button>
                          <button onclick="delete_scroll('.$scroll_id.')" type="button" class="btn btn-danger dok-tepi-kanan">Delete</button>';

                          echo "<tr id='$scroll_id'>
                          <td>$giliran</td>
                          <td>
                          <div class='form-group row'>
                          <div class='col-sm-10'>
                          <input id='scroll_$scroll_id' type='text' name='scroll_teks' class='form-control' value='$teks'>
                          </div>
                          <div class='col-sm-2'>
                          <button onclick='simpan_scroll($scroll_id)' name='mybutton' value='simpan' type='button' class='simpan btn btn-success btn-sm jarakkan'><i class='fa fa-floppy-o' aria-hidden='true'></i> Simpan</button>
                          </div>
                          </div>
                          </td>
                          <td>
                          <div>
                          <input id='toggle-event-$scroll_id' type='checkbox' data-toggle='toggle' data-size='small'>
                          <button data-toggle='popover' data-trigger='focus' data-html=true title='Adakah anda ingin DELETE?' data-content='$popover_button' type='button' class='btn btn-danger btn-sm jarakkan'><i class='fa fa-trash-o' aria-hidden='true'></i></button>
                          </div>
                          <script>
                          $(function() {
                            $('#toggle-event-$scroll_id').change(function() {
                              toggled_switch_on('$scroll_id');
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


            <div class="action-button">
              <button onclick="add_scroll()" type="button" class="btn btn-primary btn-lg btn-block">  <i class="fa fa-text-width" aria-hidden="true"></i>Tambah Scroll Teks</button>
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
              url: "update_order_text.php",
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
              url: 'toggled_off_text.php',
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
              url: 'toggled_on_text.php',
              data: "id=" + id,
              type: 'post',
              success: function(data, status) {
                //refresh page
                if(data=='1') location.reload();
              }
            }); // end ajax umum call
          }//end function toggled_switch_on

          function delete_scroll(id){
            $.ajax({
              url: 'delete_text.php',
              data: "id=" + id,
              type: 'post',
              success: function(data, status) {
                //refresh page
                if(data=='1') location.reload();
              }
            }); // end ajax umum call
          }//end function delete_slide

          function simpan_scroll(id){
            var text = document.getElementById("scroll_"+id).value
            //umum call
            $.ajax({
              url: 'simpan_text.php',
              data: "id=" + id+"&text="+text,
              type: 'post',
              success: function(data, status) {
                //refresh page
                if(data=='1') location.reload();
              }
            }); // end ajax umum call
          }//end function toggled_switch_on

          function add_scroll(){
            $.ajax({
              url: 'add_text.php',
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
