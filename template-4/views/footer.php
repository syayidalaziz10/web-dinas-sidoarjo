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
               <p class="mb-2"><i class="fa fa-location-dot me-3"></i><?= $profileData[0]['prof_addr']?></p>
               <p class="mb-2"><i class="fa fa-phone me-3"></i><?= $profileData[0]['prof_telp']?></p>
               <p class="mb-2"><i class="fa fa-fax me-3"></i><?= $profileData[0]['prof_fax']?></p>
               <p class="mb-2"><i class="fa fa-envelope me-3"></i></p><?= $profileData[0]['prof_mail']?>
            </div> 
         </div>

         <?php 
            $data = $mysqli->query('SELECT * from set_menu WHERE _active=1');
            $_mnrecord = $data->fetch_all(MYSQLI_ASSOC);         
         ?>

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
      <div class="row mt-5">
         <div class="col-12 text-center">
            <p class="text-white copyright">Copyright &copy;2024. All Rights Reserved. &mdash; Dikelola oleh <a class="text-white" href="https://diskominfo.sidoarjokab.go.id/">Dinas Komunikasi dan Informatika Kabupaten Sidoarjo</a>
         </div>
      </div>
   </div>
</footer>