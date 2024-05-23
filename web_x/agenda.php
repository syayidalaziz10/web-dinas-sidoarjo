<!--INNER BANNER START-->
<div id="inner-banner" style="background-image:url(images/uploads/banners/<?=$banner[2]->img?>);">
 <div class="container">
  <div class="inner-banner-heading">
   <h1>Agenda Kegiatan</h1>
   <em>Events :: <?=$option[1]->value?> Kabupaten Sidoarjo.</em>
  </div>
 </div>
 <div class="breadcrumb-col"> <a href="." class="btn-back"><i class="fa fa-home" aria-hidden="true"></i>Beranda</a>
  <ol class="breadcrumb">
   <li><a href=".">Beranda</a></li>
   <li class="active">Agenda</li>
  </ol>
 </div>
</div>
<!--INNER BANNER END-->

<!--MAIN START-->
<div id="main">
 <!--BLOG PAGE START-->
 <section class="blog-page event-list">
  <div class="container">
   <div class="row">
    <div class="col-md-9 col-sm-8">
     <?php
     $hal = (int)@$_GET['p'];
     $page = !isset($hal) ? 1 : $hal;
     $limit = 5;
     $offset = ($page - 1) * $limit;
     $total_items = count($event);
     $total_pages = ceil($total_items / $limit);
     $array = array_splice($event, $offset, $limit);
     $countArr = count($array);
     $newLimit = $countArr < 5 ? $countArr : $limit;
     for ($i=0; $i < $newLimit ; $i++) {
      $datacounter = frontend::CounterShow($dbCon, $array[$i]->idevents);
      $date = $array[$i]->date;
      $split = explode(" ", $date);
      $tgl = $split[1];
      $bln = $split[2];
      $jam = $split[5];

      $pecahkatatitle = explode(' ', $array[$i]->title);
      $countwrd = count($pecahkatatitle);
      $limitw = $countwrd > 5 ? 5 : $countwrd;


      $pecahkatadesc = explode(' ', $array[$i]->description);
      $countwrdesc = count($pecahkatadesc);
      $limitwdesc = $countwrdesc > 5 ? 5 : $countwrdesc;
      ?>
      <div class="event-box" style="position:relative;">
       <div class="event-caption">
        <div class="date-box"><?= $tgl ?> <span><?= $bln ?></span></div>
        <div class="text-col">
         <h3>
           <a href="?page=v-agenda&id=<?=$array[$i]->idevents?>">
             <?php
             for ($x=0; $x < $limitw ; $x++) {
               echo $countwrd > 5 ? $x === 4 ? $pecahkatatitle[$x]."... ": $pecahkatatitle[$x]." " : $pecahkatatitle[$x]." ";
             }
             ?>
           </a>
         </h3>
         <span class="time"><i class="fa fa-clock-o" aria-hidden="true"></i><?= $jam ?> | Dilihat <?= count($datacounter) === 0 ? 0 : $datacounter[0]->total ?> kali</span>
         <p>
           <?php
           for ($x=0; $x < $limitwdesc ; $x++) {
             echo $countwrdesc > 5 ? $x === 4 ? $pecahkatadesc[$x]."... ": $pecahkatadesc[$x]." " : $pecahkatadesc[$x]." ";
           }
           ?>
         </p>
         <a href="?page=v-agenda&id=<?=$array[$i]->idevents?>" class="btn-style-1">Lihat</a> </div>
        </div>
        <div class="frame">
         <?php if($array[$i]->img !== ""){ ?>
          <img src="images/uploads/events/<?=$array[$i]->img?>" style="width:100%; height:300px;" alt="img">
         <?php } else { ?>
          <img src="images/default/noimage.png" style="width:100%; height:300px;" />
         <?php } ?>
        </div>
       </div>
      <?php }; ?>
      <div class="pagination-col">
       <nav aria-label="Page navigation">
        <?php
        echo '<ul class="pagination">';
        if($hal > 1)
        echo "<li><a href='?page=agenda&p=".($hal - 1)."'>Prev</a></li>&nbsp;";
        for($page = 1; $page <=$total_pages; $page++){
         if((($page >= $hal - 3) && ($page <= $hal + 3)) || ($page === 1) || ($page === $total_pages)){
          if(($hal >= 1) && ($page >= 2 ));
          if (($hal !== ($total_pages - 1 )) && ($page === $total_pages));
          if($page === $hal)
          echo "<li class='active'><a href='#'>".$page."</a></li>&nbsp;";
          else
          echo "<li><a href='.?page=agenda&p=".$page."'>".$page."</a></li>&nbsp;";
         }
        }
        if($hal < $total_pages)
        echo "<li><a href='?page=agenda&p=".($hal + 1)."'>Next</a><li>";
        echo '</ul>';
        ?>
       </nav>
      </div>
     </div>
     <div class="col-md-3 col-sm-4">
      <aside>
       <div class="sidebar">
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
               <img src="images/uploads/news/<?=$news[$i]->img ?>" style="width: 82px; height: 70px;" />
              <?php } else { ?>
               <img src="images/default/noimage.png" style="width: 82px; height: 70px;" />
              <?php } ?>
             </a></div>
             <div class="text-area"> <a href="?page=v-berita&id=<?=$news[$i]->idnews?>"><?=$news[$i]->title?></a> <span><i class="fa fa-calendar" aria-hidden="true"></i><font color="#888"><?= date('d-M-Y',strtotime($news[$i]->date))?></font></span>
             </div>
            </li>
            <?php
           };
           ?>
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
