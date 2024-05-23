<?php
foreach ($announcement as $data) {
  $dateNow = date('Y-m-d');
  if($data->datex < $dateNow || $data->status === 0 ){
    continue;
  }
  echo "
  <script type='text/javascript'>
  $(document).ready(function() {
    $('#myModal').modal({show:true});
  });
  </script>
  ";
  ?>
  <a href="#"></a>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Pengumuman</h4>
        </div>
        <?php foreach ($announcement as $data) {
          $dateNow = date('Y-m-d');
          if($data->datex < $dateNow ){
            continue;
          }
          ?>
          <div class="modal-body">
            <h5><?=$data->title?></h5>
            <?php
            $link = "<a href='.?page=pengumuman&_pid=".$data->idnews."'>Selengkapnya</a>";
            $pecah = explode(' ', $data->description);
            $countwrd = count($pecah);

            $limit = $countwrd > 40 ? 40 : $countwrd;

            for ($i=0; $i < $limit ; $i++) {
              echo $countwrd > 40 ? $i === 39 ? $pecah[$i]."... ".$link: $pecah[$i]." " : $pecah[$i]." ";
            }
            ?>
          </div>
        <?php }; ?>
        <div class="modal-footer">
          <a href=".?page=pengumuman" class="btn btn-primary">Lainnya</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<!--BANNER START-->
<div id="banner">
  <div class="owl-carousel" id="home-banner">
    <?php
    $count = count($slider);
    for ($i=0; $i <$count ; $i++) {
      ?>
      <div class="item">
        <img src="images/uploads/banners/<?=$slider[$i]->img?>" class="img-fluid" alt="Responsive image"><span class="slide animated fadeInRight">
        </span>
        <div class="caption">
          <div class="container">
            <div class="holder">
              <h1 class="animated fadeInUp delay-2"><?=$slider[$i]->title?></h1>
              <strong class="title animated fadeInDown"><?=$slider[$i]->description?></strong></div>
            </div>
          </div>
        </div>
        <?php
      }
      ;?>
    </div>
  </div>
  <!--BANNER END-->

  <!--MAIN START-->
  <div id="main">
    <!--HIGHLIGHTS ROW START-->
    <section class="highlights-row">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-7">
            <div class="highlight-box" style="height:211px;">
              <div class="item">
                <div class="top-col"> <strong class="title">Highlight</strong> <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i><?= date('d-M-Y',strtotime($news[0]->date))?></span> </div>
                <a style="text-decoration: none" href="?page=v-berita&id=<?= $news[0]->idnews ?>"><b><?=$news[0]->title?></b></a>
                  <p>
                    <?php
                      $pecahkata = explode(' ', $news[0]->description);
                      $countwrd = count($pecahkata);
                      $limit = $countwrd > 25 ? 25 : $countwrd;

                      for ($i=0; $i < $limit ; $i++) {
                        echo $countwrd > 25 ? $i === 24 ? $pecahkata[$i]."... ": $pecahkata[$i]." " : $pecahkata[$i]." ";
                      }
                    ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-5">
              <div class="thumb">
                <a class="weatherwidget-io" href="https://forecast7.com/en/n7d47112d67/sidoarjo-regency/" data-label_1="Cuaca" data-label_2="Kabupaten Sidoarjo" data-theme="original" >SIDOARJO REGENCY WEATHER</a>
                <script>
                !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
                </script>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--HIGHLIGHTS ROW END-->

      <!--SERVICES BOARD SECTION START-->
      <section class="services-board">
        <div class="container">
          <div class="heading-style-1">
            <h2>Layanan <span style="font-size:22px;">Services </span></h2>
          </div>
          <em></em>
          <div class="owl-carousel" id="services-slider">
            <?php
            $count = count($service);
            for ($i=0; $i < $count; $i++) {
              ?>
              <div class="item">
                <div class="box board-color-<?= $i === 0 ? $i+1 : $i+1; ?>" style="height: 340px">
                  <div class="round-icon"><i class="fa fa-link" aria-hidden="true"></i></div>
                  <h3><a href="?page=v-layanan&id=<?=$service[$i]->id?>"><?=$service[$i]->name?></a> </h3>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>
      <!--SERVICES BOARD SECTION END-->

      <!--NEW SECTION START-->
      <section class="news-section">
        <div class="container">
          <div class="heading-style-1">
            <h2>Info</h2>
          </div>
          <em></em> <a href="?page=informasi&p=1" class="btn-style-1">Lainnya</a>
          <div class="row">
            <?php
            $count = count($news);
            $limit = $count <= 4 ? $count : 4;
            for ($i=0; $i < $limit  ; $i++) {
            $datacounter = frontend::CounterShow($dbCon, $news[$i]->idnews);

            $pecahkata = explode(' ', $news[$i]->description);
            $countwrd = count($pecahkata);
            $limitw = $countwrd > 8 ? 8 : $countwrd;
              ?>
              <div class="col-md-3 col-sm-6">
                <div class="box" >
                  <div class="frame"><a href="?page=v-berita&id=<?=$news[$i]->idnews?>">
                    <?php if($news[$i]->img !== ""){ ?>
                      <img src="images/uploads/news/<?= $news[$i]->img ?>" style="width:100%; height:174px;"/>
                    <?php }else{ ?>
                      <img src="images/default/noimage.png" style="width:100%; height:174px;"/>
                    <?php } ?>
                  </a>
                </div>
                <div class="text-box">
                  <div class="tp-row">
                  </div>
                  <div class="inner" style="height:200px;">
                    <h4><a href="?page=v-berita&id=<?=$news[$i]->idnews?>"><?=$news[$i]->title?></a></h4>
                    <p>
                      <?php
                      for ($x=0; $x < $limitw ; $x++) {
                        echo $countwrd > 8 ? $x === 7 ? $pecahkata[$x]."... ": $pecahkata[$x]." " : $pecahkata[$x]." ";
                      }
                      ?>
                    </p>
                  </div>
                  <div class="btm-row">
                    <em><?=$news[$i]->full_name?></em> <span class="date"><?= date('d-M-Y',strtotime($news[$i]->date))?> | Dibaca <?= count($datacounter) === 0 ? 0 : $datacounter[0]->total ?> kali</span>
                  </div>
                </div>
              </div>
            </div>
            <?php
          } ;?>
        </div>
      </div>
    </section>
    <!--NEW SECTION END-->

    <!--UPCOMING EVENTS SECTION START-->
    <section class="upcoming-event">
      <div class="container">
        <div class="heading-style-1">
          <h2>Agenda Kegiatan<span style="font-size:22px;"> Events</span></h2>
        </div>
        <em></em> <a href="?page=agenda&p=1" class="btn-style-1">Lainnya</a>
        <section class="event-slider">
          <div id="carousel" class="flexslider">
            <ul class="slides">
              <?php
              $count1 = count($event);
              $limit = $count1 <= 6 ? $count1 : 6;
              for ($i=0; $i <$limit ; $i++) {
                ?>
                <li>
                  <?php if($event[$i]->img !== ""){ ?>
                    <img src="images/uploads/events/<?=$event[$i]->img?>" style="width:380px; height:300px;" alt="img" />
                  <?php } else { ?>
                    <img src="images/default/noimage.png" style="width:380px; height:300px;" />
                  <?php } ?>
                </li>
              <?php }?>
            </ul>
          </div>
          <div id="slider" class="flexslider event-caption">
            <ul class="slides">
              <?php
              $count1 = count($event);
              $limit = $count1 <= 6 ? $count1 : 6;
              for ($i=0; $i <$limit ; $i++) {
                $datacounter = frontend::CounterShow($dbCon, $event[$i]->idevents);

                $date = $event[$i]->date;
                $split = explode(" ", $date);
                $tgl = $split[1];
                $bln = $split[2];
                $jam = $split[5];
                //print_r($split);
                $lentitle = strlen($event[$i]->title);

                $pecahkatatitle = explode(' ', $event[$i]->title);
                $countwrd = count($pecahkatatitle);
                $limitw = $countwrd > 5 ? 5 : $countwrd;


                $pecahkatadesc = explode(' ', $event[$i]->description);
                $countwrdesc = count($pecahkatadesc);
                $limitwdesc = $countwrdesc > 5 ? 5 : $countwrdesc;
                ?>
                <li>
                  <div class="date-box">
                    <?= $tgl ?><span><?= $bln ?></span>
                  </div>
                  <div class="text-col">
                    <h3>
                    <a href="?page=v-agenda&id=<?=$event[$i]->idevents?>">
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
                    <a href="?page=v-agenda&id=<?=$event[$i]->idevents?>" class="btn-style-1">Lihat</a> </div>
                  </li>
                <?php };?>
              </ul>
            </div>
          </section>
        </div>
      </section>
      <!--UPCOMING EVENTS SECTION END-->


      <!--GOVERNOR MESSAGE SECTION START-->

      <section class="governor-message">
        <div class="container">
          <a href="?page=profil-pimpinan&p=1" class="btn-style-1" style="float:right;">Profil Pimpinan</a>
          <div class="holder">
            <span class="image-frame animated fadeInLeft"><img src="images/uploads/banners/<?= $banner[4]->img ?>" alt="img"></span>
            <div class="text-box">
              <h2 style="font-size:22px;"><?= $banner[4]->title ?></h2>
              <blockquote> <span>“</span><?= $banner[4]->description ?> <em>”</em> </blockquote>
              <strong class="name"><?=$option[3]->value?></strong>
            </div>
          </div>
        </div>
      </section>
      <!--GOVERNOR MESSAGE SECTION END-->

      <!--EXPLORE SECTION START-->
      <?php $getid = explode('=', $video[0]->url); ?>
      <section class="explore-section">
        <div class="container">
          <div class="heading-style-1">
            <h2>Digital <span style="font-size:22px;">Media</span></h2>
          </div>
          <em></em>
          <a href=".?page=video&p=1" class="btn-style-1">Lainnya</a>
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="video-frame">
                <iframe class="img-responsive" src="https://www.youtube.com/embed/<?= $getid[1] ?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" class="btn-play" allow="autoplay; encrypted-media" allowfullscreen></iframe>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="popular-videos">
                <div class="popular-head">
                  <h3>Video</h3>
                </div>
                <div class="text-box" style="overflow: scroll; height: 350px">
                  <ul>
                    <?php
                    $count  = count($video);
                    $limit = $count > 6 ? 6 : $count;
                    for ($i=1; $i < $limit; $i++) {
                      $getid = explode('=', $video[$i]->url);
                      ?>
                      <li>
                        <div class="video-frame-1">
                          <iframe class="img-responsive" src="https://www.youtube.com/embed/<?=$getid[1]?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                        <div class="text-col">
                          <h4><a href="#"><?=$video[$i]->title?></a></h4>
                        </div>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--EXPLORE SECTION END-->

      <!--COMMUNITY AND CITIZENS SECTION START-->
      <section class="department-section">
        <div class="holder">
          <div class="container">
            <div class="heading-style-1">
              <h2>Pemerintahan <span style="font-size:22px;">Goverment</span></h2>
            </div>
            <em></em>
            <div class="row">
              <?php
              foreach ($dinas as $key => $value) {
                ?>
                <div class="col-md-2 col-sm-4">
                  <div class="box">
                    <div class="frame">
                      <?php if($value->img !== ""){ ?>
                        <img src="images/uploads/inst/<?=$value->img?>"/>
                      <?php } else { ?>
                        <img src="images/default/default_logo_inst.png"/>
                      <?php } ?>
                    </div>
                    <div class="caption">
                      <div class="text-box">
                        <h4><a href="<?=$value->description?>"><?=$value->name?></a></h4>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }; ?>
            </div>
            <div class="mayor-row">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <a href="http://sidoarjokab.go.id" class="link">
                    <div class="mayor-office mayor-colo-1">
                      <h3>Portal Pemerintah</h3>
                      <h2>Kabupaten Sidoarjo</h2>
                      <h3>www.sidoarjokab.go.id</h3>
                    </div>
                  </a>
                </div>
                <div class="col-md-6 col-sm-6">
                  <a href="http://indonesia.go.id/">
                    <div class="mayor-office mayor-colo-2">
                      <h3>Portal Pemerintah</h3>
                      <h2>Republik Indonesia</h2>
                      <h3>www.indonesia.go.id</h3>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--COMMUNITY AND CITIZENS SECTION END-->
    </div>
    <!--MAIN END-->
