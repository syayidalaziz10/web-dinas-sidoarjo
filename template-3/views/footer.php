<?php 
   $profile =  $mysqli->query('SELECT * from pub_profile WHERE _active=1 ORDER BY _cre DESC');
   $_profile = $profile->fetch_all(MYSQLI_ASSOC);   
   
   $current_page = $_SERVER['REQUEST_URI'];

   // Menentukan jalur berdasarkan halaman yang sedang dimuat
   $footer_url = ($current_page === '') ? '' : '../';


   if ((!empty($row['post_img'])) && file_exists($dir_image)) {

    $src = $_dirProf . $prof[0]['prof_lg'];

} else {

    $src = $_dirProf . 'default.png';

}

?>

<footer id="footer" class="footer">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.php" class="d-flex align-items-center">
                    <img src="<?= $src ?>" style="width:70px ; height:70px ;" alt="">
                </a>
                <div class="footer-contact pt-3">

                    <p><?= $_profile[0]['prof_lnm']?></p>
                    <p><?= $_profile[0]['prof_desk']?></p>
                </div>
            </div>

            <?php 
            $data = $mysqli->query('SELECT * from set_menu WHERE _active=1');
            $_mnrecord = $data->fetch_all(MYSQLI_ASSOC);         
         ?>
            <?php foreach ($_mnrecord as $record): ?>
            <?php if ($record['parent'] == 0): ?>
            <div class="col-lg-2 col-md-3 footer-links">
                <h3 class="text-capitalize"><?= $record['mn_txt'] ?></h3>
                <ul class="footer_block-nav">
                    <?php foreach ($_mnrecord as $childRecord): ?>
                    <?php if ($childRecord['parent'] == $record['mn_id']): ?>
                    <li><i class="bi bi-chevron-right"></i><a target="<?= $childRecord['mn_tar'] ?>"
                            href="<?= $footer_url . $childRecord['mn_url'] ?>"
                            class="text-capitalize"><?= $childRecord['mn_txt'] ?></a></li>
                    <?php foreach ($_mnrecord as $endChild): ?>
                    <ul class="list-unstyled">
                        <?php if ($endChild['parent'] == $childRecord['mn_id']): ?>
                        <li><i class="bi bi-chevron-right"></i><a target="<?= $record['mn_tar'] ?>"
                                href="<?= $footer_url . $childRecord['mn_url'] ?>"
                                class="text-capitalize"><?= $endChild['mn_txt'] ?></a></li>
                        <?php endif ?>
                    </ul>
                    <?php endforeach ?>
                    <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php endif ?>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename"><?= $_profile[0]['prof_lnm']?></strong> <span>All
                Rights Reserved</span>
        </p>
    </div>

</footer>