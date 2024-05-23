<style>
.card-img-top {
    transition: opacity 0.3s ease;
}

.card-img-top:hover {
    opacity: 0.7;
}
</style>

<div class="services-list">
    <h5>Kategori </h5>
    <hr>
    <?php
    // Array asosiatif untuk memetakan nilai ca_id menjadi kata-kata
    $categories = array(
        '001' => 'Berita Utama',
        '002' => 'Event',
        '003' => 'Pengumuman',
        '004' => 'Dokumen',
        '005' => 'Layanan',
        // Tambahkan kategori lainnya sesuai kebutuhan
    );

    // Query untuk menghitung total berita per kategori
    $total_posts = $mysqli->query("SELECT ca_id, COUNT(*) AS total_berita FROM pub_post GROUP BY ca_id");

    // Menampilkan hasil dengan mengganti ca_id dengan nama kategori yang sesuai
    while ($post = $total_posts->fetch_assoc()) {
        $category_name = isset($categories[$post['ca_id']]) ? $categories[$post['ca_id']] : 'Kategori Tidak Diketahui';
        $category_href = $post['ca_id']; 
        ?>
    <a href="../<?= $category_href?>/" class="active"><?= $category_name ?> <span
            class="badge bg-primary"><?= $post['total_berita'] ?></span></a>
    <?php } ?>
</div>




<div class="card shadow-sm mb-3">
    <div class="container">
        <div class="mt-3 mb-3">

            <h4>Berita Terkini</h4>
        </div>
        <hr>
        <?php
    $query = $mysqli->query("SELECT * FROM pub_post WHERE ca_id='001' ORDER BY post_see DESC LIMIT 3");
    $news = $query->fetch_all(MYSQLI_ASSOC);
    
    foreach ($news as $row) {
        $id = $row['post_id'];
        $title = $row['post_judul'];
        $date = $row['post_publish'];
        $see 	= $row['post_see'];
        $image = 'images/post/' . $row['post_img'];

       
    ?>
        <div class="d-flex flex-row post-item">
            <a href="../001/<?= $id?>"><img src="../<?= $image ?>" class="flex-shrink-0 ml-2 mb-3 rounded"
                    style="height: 100px; object-fit: cover; margin-right:10px; " alt="Nama Gambar"></a>
            <div>
                <a href="../001/<?= $id?>">
                    <h6 class="card-title text-justify" style="text-align: justify;"><?= $title ?></h6>
                </a>

                <ul style="font-size:0.6 rem ;">
                    <i class="bi bi-calendar-event-fill"></i> <?=  dateToDay($date) ?>
                    <!-- <i class="bi bi-eye-fill"></i> Dibaca <?= $see ?> kali -->
                </ul>
            </div>
        </div><!-- End recent post item-->

        <?php 

}

?>
    </div>
</div>




<div class="card shadow-sm mb-3">
    <div class="container">
        <div class="mt-3 mb-3">

            <h4>Event Terkini</h4>
        </div>
        <hr>
        <?php
      
      $query = $mysqli->query("SELECT * FROM pub_post WHERE ca_id=002 ORDER BY post_see DESC LIMIT 3");
      $news = $query->fetch_all(MYSQLI_ASSOC);
      
      foreach ($news as $row) {
         $id 		= $row['post_id'];
         $title 	= $row['post_judul'];
         $date 	= $row['post_publish'];
         $see 	= $row['post_see'];
         $image	= 'images/post/'.$row['post_img'];
         
      
      ?>
        <div class="d-flex flex-row post-item">
            <a href="../002/<?= $id?>"><img src="../<?= $image ?>" class="flex-shrink-0 ml-2 mb-3 rounded"
                    style="height: 100px; object-fit: cover; margin-right:10px;" alt="Nama Gambar"></a>
            <div>
                <a href="../002/<?= $id?>">
                    <h6 class="card-title text-justify" style="text-align: justify;"><?= $title ?></h6>
                </a>

                <ul>
                    <i class="bi bi-calendar-event-fill"></i> <?=  dateToDay($date) ?>
                    <!-- <i class="bi bi-eye-fill"></i> Dibaca <?= $see ?> kali -->
                </ul>
            </div>
        </div><!-- End recent post item-->

        <?php 

}

?>
    </div>
</div>