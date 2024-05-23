  <!--INNER BANNER START-->
  <div id="inner-banner" style="background-image:url(images/uploads/banners/<?=$banner[2]->img?>);">
    <div class="container">
      <div class="inner-banner-heading">
        <h1>Pengumuman</h1>
        <em>Announcement :: <?=$option[1]->value?> Kabupaten Sidoarjo.</em>
      </div>
    </div>
    <div class="breadcrumb-col"> <a href="." class="btn-back"><i class="fa fa-home" aria-hidden="true"></i>Beranda</a>
      <ol class="breadcrumb">
        <li><a href=".">Beranda</a></li>
        <li class="active">Pengumuman</li>
      </ol>
    </div>
  </div>
  <!--INNER BANNER END-->

  <!--MAIN START-->
  <div id="main">
    <!--ERROR PAGE START-->
    <section class="faq">
      <div class="container">
        <div class="row">
          <div class="col-md-9 col-sm-8">
            <div class="accordion-style-1">
              <?php
              $count = count($announcement);
              $id = (int)@$_GET['_pid'];
              for ($i=0; $i < $count ; $i++) {
                if(isset($_GET['_pid'])){
                  $idne = (int)$announcement[$i]->idnews;
                  if($id === $idne ){
                    echo "
                    <script type='text/javascript'>
                    $(document).ready(function() {
                      $('#open').attr('style','display: block')
                    });
                    </script>
                    ";
                    ?>
                    <div class="outer-col">
                      <div class="accordion_cp accordion-open"><?= $announcement[$i]->title ?><span><i class="fa fa-minus" aria-hidden="true"></i></span> </div>
                      <div class="contain_cp_accor" id="open">
                        <div class="content_cp_accor">
                          <?= $announcement[$i]->description ?>
                          <br>
                          <p><b>Pengumuman berlaku sampai <?= date('d-M-Y', strtotime($announcement[$i]->datex)) ?></b></p>
                        </div>
                      </div>
                    </div>
                  <?php } else { ?>
                    <div class="outer-col">
                      <div class="accordion_cp"><?= $announcement[$i]->title ?><span><i class="fa fa-minus" aria-hidden="true"></i></span> </div>
                      <div class="contain_cp_accor">
                        <div class="content_cp_accor">
                          <?= $announcement[$i]->description ?>
                          <br>
                          <p><b>Pengumuman berlaku sampai <?= date('d-M-Y', strtotime($announcement[$i]->datex)) ?></b></p>
                        </div>
                      </div>
                    </div>
                  <?php }
                } else {?>
                  <div class="outer-col">
                    <div class="accordion_cp"><?= $announcement[$i]->title ?><span><i class="fa fa-minus" aria-hidden="true"></i></span> </div>
                    <div class="contain_cp_accor">
                      <div class="content_cp_accor">
                        <?= $announcement[$i]->description ?>
                        <br>
                        <p><b>Pengumuman berlaku sampai <?= date('d-M-Y', strtotime($announcement[$i]->datex)) ?></b></p>
                      </div>
                    </div>
                  </div>
              <?php } } ?>
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
                       <img src="images/uploads/news/<?= $news[$i]->img ?>" style="width: 82px; height: 70px;" />
                      <?php } else { ?>
                       <img src="images/default/noimage.png" style="width: 82px; height: 70px;" />
                      <?php } ?>
                     </a></div>
                     <div class="text-area"><a href="?page=v-berita&id=<?=$news[$i]->idnews?>"><?=$news[$i]->title?></a><span><i class="fa fa-calendar" aria-hidden="true"></i><font color="#888"><?= date('d-M-Y', strtotime($news[$i]->date))?></font></span>
                     </div>
                    </li>
                   <?php }; ?>
                  </ul>
                 </div>
                </div>
                <div class="widget-box">
                 <h3>Agenda Kegiatan</h3>
                 <div class="events-widget">
                  <ul>
                   <?php
                   $count1 = count($event);
                   $limit = $count1 <= 3 ? $count1 : 3;
                   for ($i=0; $i <$limit ; $i++) {

                    $date = $event[$i]->date;
                    $split = explode(" ", $date);
                    $tgl = $split[1];
                    $bln = $split[2];
                    $jam = $split[5];
                    ?>
                    <li>
                     <div class="date-box"><?= $tgl ?><span><?= $bln ?></span></div>
                     <div class="text-col">
                      <a href="?page=v-agenda&id=<?=$event[$i]->idevents?>"><?=$event[$i]->title?></a>
                      <span class="time"><i class="fa fa-clock-o" aria-hidden="true"></i><?= $jam ?></span>
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
    <!--ERROR PAGE END-->
  </div>
  <!--MAIN END-->
