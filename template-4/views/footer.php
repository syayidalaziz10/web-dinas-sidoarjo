<?php 


$current_page = $_SERVER['REQUEST_URI'];
$siteUrl = ($current_page === '') ? '' : '../';

?>


<footer class="site-footer">
   <div class="container-fluid footer-content">
      <div class="row">
         
         <div class="col-lg-4">
            <div class="widget">
               <h3><?= $profileData[0]['prof_lnm']?><span class="text-primary">.</span> </h3>
               <p><?= $profileData[0]['prof_desk']?>.</p>
               <div class="d-flex contact align-items-center justify-content-start gap-3">
                  <p><i class="fa-solid fa-location-dot"></i></p>
                  <p><?= $profileData[0]['prof_addr']?></p>
               </div>
               <div class="d-flex contact align-items-center justify-content-start gap-3">
                  <p><i class="fa-solid fa-phone"></i></p>
                  <p><?= $profileData[0]['prof_telp']?></p>
               </div>
               <div class="d-flex contact align-items-center justify-content-start gap-3">
                  <p><i class="fa-solid fa-fax"></i></p>
                  <p><?= $profileData[0]['prof_fax']?></p>
               </div>
               <div class="d-flex contact align-items-center justify-content-start gap-3">
                  <p><i class="fa-solid fa-envelope"></i></p>
                  <p><?= $profileData[0]['prof_mail']?></p>
               </div>
            </div> 
         </div>

         <?php 
            $data = $mysqli->query('SELECT * from set_menu WHERE _active=1');
            $_mnrecord = $data->fetch_all(MYSQLI_ASSOC);         
         ?>


         <div class="col-lg-8">
            <div class="row">
                  <?php foreach ($_mnrecord as $record): ?>
                     <?php if ($record['parent'] == 0): ?>
                        <div class="col-lg-2">
                           <div class="widget">
                              <h3><?= $record['mn_txt'] ?></h3>
                              <ul class="list-unstyled float-start links">
                                 <?php foreach ($_mnrecord as $childRecord): ?>
                                    <?php if ($childRecord['parent'] == $record['mn_id']): ?>
                                       <li><a target="<?= $childRecord['mn_tar'] ?>" href="<?= $siteUrl . $childRecord['mn_url'] ?>" class="text-capitalize"><?= $childRecord['mn_txt'] ?></a></li>
                                       <?php foreach ($_mnrecord as $endChild): ?>
                                          <ul class="list-unstyled">
                                             <?php if ($endChild['parent'] == $childRecord['mn_id']): ?>
                                                <li><a target="<?= $record['mn_tar'] ?>" href="<?= $siteUrl . $childRecord['mn_url'] ?>" class="text-capitalize"><?= $endChild['mn_txt'] ?></a></li>
                                             <?php endif ?>
                                          </ul>
                                       <?php endforeach ?>
                                    <?php endif ?>
                                 <?php endforeach ?>
                              </ul>
                           </div>
                        </div>
                     <?php endif ?>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>

      <div class="row mt-5">
         <div class="col-12 text-center">
            <p class="text-white copyright">Copyright &copy;2024. All Rights Reserved. &mdash; Dikelola oleh <a class="text-white" href="https://diskominfo.sidoarjokab.go.id/">Dinas Komunikasi dan Informatika Kabupaten Sidoarjo</a>
         </div>
      </div>

   </div>
</footer>