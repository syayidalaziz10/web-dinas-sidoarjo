<!--INNER BANNER START-->
<div id="inner-banner" style="background-image:url(images/uploads/banners/<?=$banner[2]->img?>);">
 <div class="container">
  <div class="inner-banner-heading">
   <h1>Download</h1>
   <em>Unduh :: referensi peraturan dll.</em>
  </div>
 </div>
 <div class="breadcrumb-col"> <a href="." class="btn-back"><i class="fa fa-home" aria-hidden="true"></i>Beranda</a>
  <ol class="breadcrumb">
   <li><a href=".">Beranda</a></li>
   <li class="active">Downloads</li>
  </ol>
 </div>
</div>
<!--INNER BANNER END-->

<!--MAIN START-->

<!--DEPARTMENTS SECTION START-->
<div id="main">
 <!--DEPARTMENTS SECTION START-->
 <section class="profil-section">
  <div class="hoLder">
   <div class="container">
    <div class="row">
     <div class="box">
      <div class="col-md-12 col-sm-8"><br>
       <div class="heading-style-1">
        <h2>Download<span> Page</span></h2>
       </div><br><br>
       <div class="link-widget">
        <table class="zebra-table">
         <thead>
          <tr>
           <th>Judul</th>
           <th>Deskripsi</th>
           <th>Total Downloads</th>
           <th>Opsi</th>
          </tr>
         </thead>
         <tbody>
          <?php
          $data = FrontEnd::DownloadShow($dbCon);
          foreach ($data as $key => $value) {
           ?>
           <tr>
            <td style="width:20%"><center><?=$value->title?></center></td>
            <td style="width:50%"><center><?=$value->description?></center></td>
            <td style="width:15%"><center><?=$value->totdown?></center></td>
            <td style="width:10%">
             <input type="hidden" name="url" id="urlFile"  value="<?=$_SERVER['SERVER_NAME'].'/downloads/'.$value->file ?>">
             <input type="hidden" name="fileName"  value="<?=$value->file ?>">
             <input type="hidden" name="id" id="idFile" value="<?=$value->id ?>">
             <center><a href="downloads/<?=$value->file ?>" onclick="addDown(<?=$value->id ?>)" id="download">Download</a></center>
             <center><a href="#" onclick="previewDocs('<?=$_SERVER['SERVER_NAME'].'/downloads/'.$value->file ?>')" id="preview"  >Preview</a></center>
            </td>
           </tr>
          <?php }; ?>
         </tbody>
        </table>
        <br>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>
</div>
<script type="text/javascript">
  function addDown(idf){
    console.log(idf);
    var data = new FormData();
    data.append('id', idf)
    data.append('token', '<?=$_SESSION['token'] ?>')
    fetch('backend/download.php',{ method: 'POST' ,body: data }).then(res => res.text()).then(result =>  location.reload());
  }
  function previewDocs(url){
    $('#myModal').modal({show:true});
    $(".modal-body").html("<iframe src='https://docs.google.com/viewer?url="+encodeURI(url)+" style='width:100%; height:700px;' frameborder='0'></iframe>")
  }
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-body">
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
 </div>
</div>
