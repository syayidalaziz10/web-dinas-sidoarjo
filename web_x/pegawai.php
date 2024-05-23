<!--INNER BANNER START-->
<div id="inner-banner" style="background-image:url(images/uploads/banners/<?=$banner[2]->img?>);">
 <div class="container">
  <div class="inner-banner-heading">
   <h1>Daftar Pegawai</h1>
   <em>List of Employees :: <?=$option[1]->value?> Kabupaten Sidoarjo.</em>
  </div>
 </div>
 <div class="breadcrumb-col"> <a href="." class="btn-back"><i class="fa fa-home" aria-hidden="true"></i>Beranda</a>
  <ol class="breadcrumb">
   <li><a href=".">Beranda</a></li>
   <li><a href="#">Profil</a></li>
   <li class="active">Daftar Pegawai</li>
  </ol>
 </div>
</div>
<!--INNER BANNER END-->

<!--MAIN START-->
<div id="main">
 <!--TEAM PAGE START-->
 <section class="team-section">
  <div class="container">
   <div class="row">
    <?php
    $hal = (int)@$_GET['p'];
    $page = !isset($hal) ? 1 : $hal;
    $limit = 12;
    $offset = ($page - 1) * $limit;
    $total_items = count($employee);
    $total_pages = ceil($total_items / $limit);
    $array = array_splice($employee, $offset, $limit);
    $countArr = count($array);
    $newLimit = $countArr < 12 ? $countArr : $limit;
    for ($i=0; $i < $newLimit ; $i++) {
     ?>
     <div class="col-md-3 col-sm-6">
      <div class="box">
       <div class="outer">
        <div class="frame">
         <?php if($array[$i]->img !== ""){ ?>
          <img src="images/uploads/employees/<?= $array[$i]->img ?>" style="width:243px; height:300px;"/>
         <?php } else { ?>
          <img src="images/default/noimage.png" style="width:100%; height:300px;"/>
         <?php } ?>
         <div class="caption">
          <div class="inner">
           <p><?=$array[$i]->bagian?></p>
           <p><?=$array[$i]->tahun?></p>
          </div>
         </div>
        </div>
       </div>
       <div class="text-box">
        <h3><a href="#"><?=$array[$i]->name?></a></h3>
        <strong class="title"><?=$array[$i]->jabatan?></strong>
       </div>
      </div>
     </div>
    <?php }?>
   </div>
   <div class="pagination-col">
    <nav aria-label="Page navigation">
     <?php
     echo '<ul class="pagination">';
     if($hal > 1)
     echo "<li><a href='?page=pegawai&p=".($hal - 1)."'>Prev</a></li>&nbsp;";
     for($page = 1; $page <=$total_pages; $page++){
      if((($page >= $hal - 3) && ($page <= $hal + 3)) || ($page === 1) || ($page === $total_pages)){
       if(($hal >= 1) && ($page >= 2 ));
       if (($hal !== ($total_pages - 1 )) && ($page === $total_pages));
       if($page === $hal)
       echo "<li class='active'><a href='#'>".$page."</a></li>&nbsp;";
       else
       echo "<li><a href='.?page=pegawai&p=".$page."'>".$page."</a></li>&nbsp;";
      }
     }
     if($hal < $total_pages)
     echo "<li><a href='?page=pegawai&p=".($hal + 1)."'>Next</a></li>";
     echo '</ul>';
     ?>
    </nav>
   </div>
  </div>
 </section>
 <!--TEAM PAGE END-->
</div>
<!--MAIN END-->
