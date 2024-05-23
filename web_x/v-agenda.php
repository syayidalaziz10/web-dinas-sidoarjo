<!--INNER BANNER START-->
<?php
$id = (int)$_GET['id'];
$data = FrontEnd::EventGetID($id, $dbCon);
$datacounter = frontend::CounterShow($dbCon, $id);

if(empty($data)){
  echo "<script> window.location.href= '.?page=error' </script>";
}

$date = $data->date;
$split = explode(" ", $date);
$tgl1 = $split[1];
$bln1 = $split[2];
$jam1 = $split[5];
?>
<div id="inner-banner" style="background-image:url(images/uploads/banners/<?=$banner[2]->img?>);">
 <div class="container">
  <div class="inner-banner-heading">
   <h1>Agenda Kegiatan</h1>
   <em>Event :: <?=$option[1]->value?> Kabupaten Sidoarjo.</em>
  </div>
 </div>
 <div class="breadcrumb-col"> <a href="." class="btn-back"><i class="fa fa-home" aria-hidden="true"></i>Beranda</a>
  <ol class="breadcrumb">
   <li><a href=".">Beranda</a></li>
   <li class="active"><a href="?page=agenda&p=1">Agenda</a></li>
  </ol>
 </div>
</div>
<!--INNER BANNER END-->

<!--MAIN START-->
<div id="main">
 <!--BLOG PAGE START-->
 <section class="blog-page event-detail">
  <div class="container">
   <div class="row">
    <div class="col-md-9 col-sm-8">
     <div class="event-box">
      <div class="frame">
       <?php if($data->img !== ""){ ?>
        <img src="images/uploads/events/<?=$data->img?>" class="img-responsive"/>
       <?php } else { ?>
        <img src="images/default/noimage.png" class="img-responsive"/>
       <?php } ?>
       <div class="event-timer">
        <div class="defaultCountdown"></div>
       </div>
      </div>
      <div class="event-caption">
       <div class="date-box"><?= $tgl1 ?><span><?= $bln1 ?></span></div>
       <div class="text-col">
        <h3><a href="#"><?=$data->title?></a></h3>
        <span class="time"><i class="fa fa-clock-o" aria-hidden="true"></i><?= $jam1 ?> | Dilihat <?= count($datacounter) === 0 ? 0 : $datacounter[0]->total ?> kali</span>

      </div>
       </div>
      </div>
      <div class="post-box">
       <div class="text-box">
        <?=$data->description?>
        <div class="share-box"> <strong class="title">Share This :</strong>
         <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
          <a class="a2a_button_facebook"></a>
          <a class="a2a_button_twitter"></a>
          <a class="a2a_button_whatsapp"></a>
          <a class="a2a_button_telegram"></a>
          <a class="a2a_button_copy_link"></a>
         </div>
         <script async src="https://static.addtoany.com/menu/page.js"></script>
       </div>
      </div>
     </div>
    </div>
    <div class="col-md-3 col-sm-4">
     <aside>
      <div class="sidebar">
       <div class="widget-box">
        <h3>Agenda Kegiatan</h3>
        <div class="events-widget">
         <ul>
          <?php
          $count = count($event);
          $limit = $count <= 3 ? $count : 3;
          for ($i=0; $i <$limit ; $i++) {

           $date = $event[$i]->date;
           $split = explode(" ", $date);
           $tgl = $split[1];
           $bln = $split[2];
           $jam = $split[5];
           ?>
           <li>
            <div class="date-box"><?= $tgl ?> <span><?= $bln ?></span></div>
            <div class="text-col">
              <a href="?page=v-agenda&id=<?=$event[$i]->idevents?>"><?=$event[$i]->title?></a>
              <span class="time"><i class="fa fa-clock-o" aria-hidden="true"></i><?= $jam ?> </span>
            </div>
           </li>
           <?php
          };
          ?>
         </ul>
        </div>
       </div>
       <div class="widget-box">
        <h3>Info</h3>
        <div class="news-widget">
         <ul>
          <?php
          $count = count($news);
          $limit = $count <= 3 ? $count : 3;
          for ($i=0; $i < $limit  ; $i++) {
           ?>
           <li>
            <div class="thumb"><a href="?page=v-berita&id=<?=$news[$i]->idnews?>">
             <?php if($news[$i]->img !== ""){ ?>
              <img src="images/uploads/news/<?= $news[$i]->img ?>" style="width: 82px; height: 70px;" />
             <?php } else { ?>
              <img src="images/default/noimage.png" style="width: 82px; height: 70px;" />
             <?php } ?>
            </a></div>
            <div class="text-area"><a href="?page=v-berita&id=<?=$news[$i]->idnews?>"><?=$news[$i]->title?></a><span><i class="fa fa-calendar" aria-hidden="true"></i><font color="#888"><?= date('d-M-Y',strtotime($news[$i]->date))?></font></span>
            </div>
           </li>
          <?php }; ?>
         </ul>
        </div>
       </div>
      </div>
     </aside>
    </div>
   </div>
  </div>
 </section>
 <!--BLOG PAGE END-->
</div>
<!--MAIN END-->
<script type="text/javascript">
  $(document).ready(function(){
    addDown(<?= $id ?>)
    function addDown(idf){
      console.log(idf);
      var data = new FormData();
      data.append('idnews', idf)
      data.append('token', '<?=$_SESSION['token'] ?>')
      fetch('backend/counter.class.php',{ method: 'POST' ,body: data }).then(res => res.text()).then(result =>  console.log(result));
    }
  })
</script>
