<div id="inner-banner" style="background-image:url(images/uploads/banners/<?=$banner[2]->img?>);">
 <div class="container">
  <div class="inner-banner-heading">
   <h1>Info</h1>
   <em>Information :: <?=$option[1]->value?> Kabupaten Sidoarjo.</em>
  </div>
 </div>
 <div class="breadcrumb-col"> <a href="." class="btn-back"><i class="fa fa-home" aria-hidden="true"></i>Beranda</a>
  <ol class="breadcrumb">
   <li><a href=".">Beranda</a></li>
   <li class="active">Info</a></li>
  </ol>
 </div>
</div>
<div id="main">
 <section class="news-section">
  <div class="container">
   <div class="row">
    <?php
    $hal = (int)@$_GET['p'];
    $page = !isset($hal) ? 1 : $hal;
    $limit = 8;
    $offset = ($page - 1) * $limit;
    $total_items = count($news);
    $total_pages = ceil($total_items / $limit);
    $array = array_splice($news, $offset, $limit);
    $countArr = count($array);
    $newLimit = $countArr < 8 ? $countArr : $limit;
    for ($i=0; $i < $newLimit ; $i++) {
    $datacounter = frontend::CounterShow($dbCon, $array[$i]->idnews);

    $pecahkata = explode(' ', $array[$i]->description);
    $countwrd = count($pecahkata);
    $limitw = $countwrd > 8 ? 8 : $countwrd;
     ?>
     <div class="col-md-3 col-sm-6">
      <div class="box">
       <div class="frame"><a href="?page=v-berita&id=<?=$array[$i]->idnews?>">
        <?php if($array[$i]->img !== ""){ ?>
         <img src="images/uploads/news/<?= $array[$i]->img ?>" style="width: 100%; height: 174px;" />
        <?php } else { ?>
         <img src="images/default/noimage.png" style="width: 100%; height: 174px;" />
        <?php } ?>
       </div>
       <div class="text-box">
        <div class="tp-row">
        </div>
        <div class="inner" style="height:200px;">
         <h4><a href="?page=v-berita&id=<?=$array[$i]->idnews?>"><?=$array[$i]->title;?></a></h4>
         <p>
           <?php
           for ($x=0; $x < $limitw ; $x++) {
             echo $countwrd > 8 ? $x === 7 ? $pecahkata[$x]."... ": $pecahkata[$x]." " : $pecahkata[$x]." ";
           }
           ?>
         </p>
        </div>
        <div class="btm-row">
         <em><?= $array[$i]->full_name ?></em> <span class="date"><?= date('d-M-Y',strtotime($array[$i]->date)) ?> |  Dibaca <?= count($datacounter) === 0 ? 0 : $datacounter[0]->total ?> kali</span>
        </div>
       </div>
      </div>
     </div>
    <?php } ?>
   </div>
   <div class="pagination-col">
    <nav aria-label="Page navigation">
     <?php
     echo '<ul class="pagination">';
     if($hal > 1)
     echo "<li><a href='?page=informasi&p=".($hal - 1)."'>Prev</a></li>&nbsp;";
     for($page = 1; $page <=$total_pages; $page++){
      if((($page >= $hal - 3) && ($page <= $hal + 3)) || ($page === 1) || ($page === $total_pages)){
       if(($hal >= 1) && ($page >= 2 ))
       if (($hal !== ($total_pages - 1 )) && ($page === $total_pages));
       if($page === $hal)
       echo "<li class='active'><a href='#'>".$page."</a></li>&nbsp;";
       else
       echo "<li><a href='.?page=informasi&p=".$page."'>".$page."</a></li>&nbsp;";
      }
     }
     if($hal < $total_pages)
     echo "<li><a href='?page=informasi&p=".($hal + 1)."'>Next</a></li>";
     echo '</ul>';
     ?>
    </nav>
   </div>
  </div>
 </section>
</div>
