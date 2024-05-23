<div id="inner-banner" style="background-image:url(images/uploads/banners/<?=$banner[2]->img?>);">
  <div class="container">
    <div class="inner-banner-heading">
      <h1>Video</h1>
      <em>Videos :: <?=$option[1]->value?> Kabupaten Sidoarjo.</em>
    </div>
  </div>
  <div class="breadcrumb-col"> <a href="." class="btn-back"><i class="fa fa-home" aria-hidden="true"></i>Beranda</a>
    <ol class="breadcrumb">
      <li><a href=".">Beranda</a></li>
      <li class="active">Video</a></li>
    </ol>
  </div>
</div>
<div id="main">
  <section class="news-section">
    <div class="container">
      <div class="row">
        <div class="city-law">
          <div class="row">
            <?php
            $hal = (int)@$_GET['p'];
            $page = !isset($hal) ? 1 : $hal;
            $limit = 6;
            $offset = ($page - 1) * $limit;
            $total_items = count($video);
            $total_pages = ceil($total_items / $limit);
            $array = array_splice($video, $offset, $limit);
            $countArr = count($array);
            $newLimit = $countArr < 6 ? $countArr : $limit;
            for ($i=0; $i < $newLimit; $i++) {
              $getid = explode('=', $array[$i]->url);
              ?>
              <div class="col-md-4">
                <div class="box">
                  <iframe class="img-responsive" src="https://www.youtube.com/embed/<?=$getid[1]?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allow="autoplay; encrypted-media" style="width: 100%; height:350px" allowfullscreen></iframe>
                  <div class="caption">
                    <h4><a href="#"><?= $array[$i]->title ?></a></h4>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="pagination-col">
        <nav aria-label="Page navigation">
          <?php
          echo '<ul class="pagination">';
          if($hal > 1)
          echo "<li><a href='?page=video&p=".($hal - 1)."'>Prev</a></li>&nbsp;";
          for($page = 1; $page <=$total_pages; $page++){
            if((($page >= $hal - 3) && ($page <= $hal + 3)) || ($page === 1) || ($page === $total_pages)){
              if(($hal >= 1) && ($page >= 2 ))
              if (($hal !== ($total_pages - 1 )) && ($page === $total_pages));
              if($page === $hal)
              echo "<li class='active'><a href='#'>".$page."</a></li>&nbsp;";
              else
              echo "<li><a href='.?page=video&p=".$page."'>".$page."</a></li>&nbsp;";
            }
          }
          if($hal < $total_pages)
          echo "<li><a href='?page=video&p=".($hal + 1)."'>Next</a></li>";
          echo '</ul>';
          ?>
        </nav>
      </div>
    </div>
  </section>
</div>
