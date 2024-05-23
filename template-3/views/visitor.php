<?php 

$visitor =  $mysqli->query('SELECT 
(SELECT COUNT(*) FROM visitors WHERE DATE(vs_date) = CURDATE()) AS today_visitors,
(SELECT COUNT(*) FROM visitors WHERE YEAR(vs_date) = YEAR(NOW())) AS month_visitors,
(SELECT COUNT(*) FROM visitors WHERE MONTH(vs_date) = MONTH(NOW())) AS year_visitors,
(SELECT COUNT(*) FROM visitors) AS total_visitors');
$countVisit = mysqli_fetch_assoc($visitor);



?>

<!-- START VISITOR -->
<div class=" visitor shadow-lg rounded-pill d-flex justify-content-center align-items-center"
    style="box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); height: 50px; width: 170px;">
    <ul class="list-unstyled social mb-0 my-1 mr-2" style="margin-right:10px;">
        <li><a href="#" onclick="return false;" class="floating-btn "><span class="bi bi-people-fill"></span></a>
        </li>
    </ul>
    <p class="mb-0">Visitor <?= $countVisit['total_visitors']?></p>
</div>
<!-- END VISITOR -->

<div class="visitor-panel-container rounded-pill shadow-lg mb-5"
    style="border-radius: 30px; box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <div class="visitor-panel">
        <div class="d-flex justify-content-center align-items-center flex-column ">
            <small>HARI INI</small>
            <medium><?= $countVisit['today_visitors']?></medium>
        </div>
        <div class="d-flex justify-content-center align-items-center flex-column ">
            <small>BULAN INI</small>
            <medium><?= $countVisit['month_visitors']?></medium>
        </div>
        <div class="d-flex justify-content-center align-items-center flex-column ">
            <small>TAHUN INI</small>
            <medium><?= $countVisit['year_visitors']?></medium>
        </div>
    </div>
</div>


<script>
// COUNTER PENGUNJUNG
const floating_btn = document.querySelector('.floating-btn');
const close_btn = document.querySelector('.close-btn');
const social_panel_container = document.querySelector('.visitor-panel-container');

floating_btn.addEventListener('click', () => {
    social_panel_container.classList.toggle('visible')
});

close_btn.addEventListener('click', () => {
    social_panel_container.classList.remove('visible')
});
</script>