<?php 
   $profile = $mysqli->query('SELECT prof_lnm, prof_snm, prof_lg from pub_profile');
   $_profile = $profile->fetch_all(MYSQLI_ASSOC);

   $current_page = $_SERVER['REQUEST_URI'];
$url_root = ($current_page === '') ? '' : '../';


if ((!empty($row['post_img'])) && file_exists($dir_image)) {

    $src = $_dirProf . $prof[0]['prof_lg'];

} else {

    $src = $_dirProf . 'default.png';

}

?>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.php" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="<?= $src?>" alt="">

            <style>
            .desktop {
                display: none;
            }

            .mobile {
                display: block;
            }

            @media (min-width: 768px) {
                .desktop {
                    display: block;
                }

                .mobile {
                    display: none;
                }
            }
            </style>
            <h6 class="sitename align-items-center mt-2 desktop"><?= $_profile[0]['prof_lnm']?><br>
                Kabupaten Sidoarjo</h6>
            <h6 class="sitename align-items-center mt-2 mobile"><?= $_profile[0]['prof_snm']?></h6>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php" class="">Beranda</a></li>
                <!-- LOOP FOR MENU NAVBAR -->
                <?php
        // Get menu data from database
        $result = $mysqli->query('SELECT * from set_menu WHERE _active=1');
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Call function to display menu
        displayMenu($rows);

        // Function to display menu recursively
        function displayMenu($data, $parent_id = 0) {
            foreach ($data as $key => $value) {
                if ($value['parent'] == $parent_id) {
                    generateHTML($data, $value);
                }
            }
        }

        function generateHTML($data, $menu) {
            $count = 0;

            foreach ($data as $key => $value) {
                if ($value['parent'] == $menu['mn_id']) {
                    $count++;
                }
            }

            if ($count > 0) {
                echo '<li class="dropdown">';
                echo '<a href="#" class="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$menu['mn_txt'].' <i class="bi bi-chevron-down toggle-dropdown"></i></a>';
                echo '<ul class="dropdown-menu">';
                displayMenu($data, $menu['mn_id']);
                echo '</ul>';
                echo '</li>';
            } else {
                echo '<li><a href="'.$menu['mn_url'].'">'.$menu['mn_txt'].'</a></li>';
            }
        }
        ?>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>