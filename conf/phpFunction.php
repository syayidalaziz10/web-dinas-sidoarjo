<?PHP









//------------------------------------------------------------------------------
// START FRONTEND FUNCTION 
//------------------------------------------------------------------------------


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require('config.php');

$_px	= isset($_REQUEST['_px']) ? strval($_REQUEST['_px']) : '';
$_c1	= isset($_REQUEST['_c1']) ? strval($_REQUEST['_c1']) : '';
$_c2	= isset($_REQUEST['_c2']) ? strval($_REQUEST['_c2']) : '';

$_p0	= isset($_REQUEST['_p0']) ? strval($_REQUEST['_p0']) : '';
$_p1	= isset($_REQUEST['_p1']) ? strval($_REQUEST['_p1']) : '';
$_p2	= isset($_REQUEST['_p2']) ? strval($_REQUEST['_p2']) : '';
$_p3	= isset($_REQUEST['_p3']) ? strval($_REQUEST['_p3']) : '';



function requestRec($loadField, $loadTbl, $loadWhere, $loadOrder, $limit, $typeView)
{
	$carouselCount = 0;

	require('config.php');

	$sql = "SELECT $loadField FROM $loadTbl";
	if (!empty($loadWhere)) {
		$sql .= " WHERE $loadWhere";
	}
	if (!empty($loadOrder)) {
		$sql .= " ORDER BY $loadOrder";
	}
	if (!empty($limit)) {
		$sql .= " LIMIT $limit";
	}

	$rowLoad = '';
	$result = $GLOBALS['mysqli']->query($sql);
	$rowNum = $result->num_rows;

	while ($row = $result->fetch_array()) {
		$_val = $row[0];
		$_disp = $row[1];

		switch ($typeView) {

			case 1:


				// GET DATA BANNER
				$dir_image = $_dirPost . $row[1];


				if ((!empty($row[1])) && file_exists($dir_image)) {
					$image = $_dirGalery . $row[1];
				} else {
					$image = $_dirGalery . 'default.png';
				}


				if (strlen($row[0]) > 3) {
					$title = $row[0];
					$line = '<span></span>';
				} else {
					$title = '';
					$line = '';
				}

				$view =

					'
				<div class="item" style="background-image: url(' . $image . ');">
					<div class="header-text">
						<h2>' . $title . '</h2>
					</div>
				</div>
				
				';

				break;

			case 2:

				// GET DATA LEAD

				$nama		= strtolower($row[0]);
				$desk		= $row[1];
				$lhkpn		= $row[2];
				$jabatan 	= $row[3];
				$image		= $_dirEmp . $row[4];



				$_convertNama	= ucwords($nama, " ");

				$view =

					'
				
				<div class="col-lg-6 col-12 mb-lg-0 mb-5">
					<div class="path-profile shadow" style="background-image: url(' . $image . ');">
					</div>
				</div>
				<div class="col-lg-6 col-12 d-flex justify-content-center align-items-center">
					<div class="text-container">
						<h3 class="h3 font-weight-bold">' . $_convertNama . '</h3>
						<blockquote>"' . $desk . '"</blockquote>
						<a class="btn btn-outline-primary" href="' . $lhkpn . '" target="_blank">LHKPN</a>
					</div>
				</div>
				
				';

				break;

			case 3:

				// GET DATA SERVICES

				$id 		= $row[0];
				$nama 	    = $row[1];
				$desk 	    = strip_tags($row[2]);

				// VARIABEL NEED OPERATION


				// if (!empty($row['post_img'] && file_exists($dir_image) )) {
				// 	$src = 'images/post/'.$row[3];
				// } else {
				// 	$src = 'images/post/default-services.png';
				// }


				$deskToFirst = ucfirst($desk);


				if (!empty($row[3])) {
					$image = $_dirPost . $row[3];
				} else {
					$image = $_dirPost . 'default-services.png';
				}

				$view = '


				<div class="card shadow-sm services-item">
					<div class="card-body text-center p-4 p-xxl-5">
						<div class="d-flex justify-content-center align-items-center mb-4">
							<img src="' . $image . '"></img>
						</div>
						<h3 class="mb-2">' . $nama . '</h3>
						<p class="mb-2">' . substr($deskToFirst, 0, 250) . '</p>
					</div>
					<div class="card-foot d-flex justify-content-center align-items-center">					
						<a href="005/' . $id . '" class="read-more">
							Selengkapnya
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
							</svg>
						</a>
					</div>
				</div>

				';

				break;

			case 4:

				// GET DATA NEWS

				$id 		= $row[0];
				$title 	= $row[1];
				$desk 	= $row[2];
				$date 	= $row[3];
				$count 	= $row[4];


				$dir_image = $_dirPost . $row[5];


				if ((!empty($row[5])) && file_exists($dir_image)) {
					$image = $_dirPost . $row[5];
				} else {
					$image = $_dirPost . 'default.png';
				}

				$dateString 	= DateTime::createFromFormat('Y-m-d', $date);
				$dayEng	= $dateString->format('l');


				$listDayIn = array(
					'Sunday' => 'Minggu',
					'Monday' => 'Senin',
					'Tuesday' => 'Selasa',
					'Wednesday' => 'Rabu',
					'Thursday' => 'Kamis',
					'Friday' => 'Jumat',
					'Saturday' => 'Sabtu'
				);


				$dayIn = $listDayIn[$dayEng];
				$_convertDate = $dayIn . ', ' . $dateString->format('d F Y');

				$deskToStr = strip_tags($desk);

				if (strlen($title) > 50) {
					$title = substrwords($title, 50);
				}

				$view 	=

					'
				<div class="news-item">
					<div class="news-img">
						<img src="' . $image . '" alt="" class="img-fluid">
					</div>
					<div class="news-contents my-4">
						<a href="001/' . $id . '"><h3>' . $title . '</h3></a>
						<p>' . substrwords($deskToStr, 200) . '</p>
						<span>' . $_convertDate . '<span class="icon-eye ml-3 mr-2"></span>' . $count . '</span>
					</div>
					<p class="mb-0"><a href="001/' . $id . '" class="read-more-arrow">
						<svg class="bi bi-arrow-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"/>
							<path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"/>
						</svg>
					</a>
					</p>
				</div>
				
				';


				break;


			case 5:


				$_val2	= $row[2];
				$_val3	= $row[3];
				$_val4	= $row[4];
				$_val5	= $row[5];
				$_max = '100';
				$_href	= '#view-' . $loadTbl . '-' . $_val . '-' . $_disp;

				$view = '<div class="col-md-4">
							<div class="card card-blog">
								<div class="card-image">
									<a href="#"> <img class="img" src="/upload/' . $_val . $_val4 . '"> </a>
									<div class="ripple-cont"></div>
								</div>
								<div class="table">
									<h4 class="card-caption">
										<a href="' . $_href . '">' . $_disp . '</a>
									</h4>
									<p class="card-description">' . substrwords($_val2, $_max) . '...</p>
									<div class="ftr">
										<div class="author">
											<i class="fa fa-calendar" aria-hidden="true"></i> ' . $_val3 . '
										</div>
										<div class="stats"> 
											<i class="fa fa-eye"></i> ' . $_val5 . '
										</div>
									</div>
								</div>
							</div>
						</div>';
				break;

			case 6:

				// GET DATA VIDEO

				$id = $row[0];
				$url = $row[1];
				$queryString = parse_url($url, PHP_URL_QUERY);
				parse_str($queryString, $params);
				$videoId = $params['v'];


				$view =

					'
				<div data-video="' . $videoId . '" class="item video-thumb">
					<img src="https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg"/>
				</div>
				
				';

				break;

			case 7:

				// GET DATA GALERY

				$title = $row[0];
				$dir_image = $_dirGalery . $row[1];



				if ((!empty($row[1])) && file_exists($dir_image)) {
					$image = $_dirGalery . $row[1];
				} else {
					$image = $_dirPost . 'default.png';
				}

				$view =

					'

				<div class="col-lg-4 col-12">
					<a href="' . $image . '" class="gal-item mb-4" data-fancybox="gal" data-caption="' . $title . '"><img src="' . $image . '" alt="Galeri ' . $title . '" class="img-fluid"></a>
				</div>

				';

				break;

			case 8:

				// GET DATA ANNOUNCEMENT

				$id			= $row[0];
				$title 		= strtolower($row[1]);
				$desk 		= $row[2];

				$_convert 	= ucwords($title, " ");

				$view =

					'

				<div class="announcement-item">
					<div class="announcement-contents">
						<a href="003/' . $id . '"><h3>' . $_convert . '</h3></a>
						<p>' . $desk . '</p>
					</div>
				</div>

				';

				break;

			case 9:

				// GET DATA EVENT

				$id 		= $row[0];
				$title 		= $row[1];
				$desk 		= $row[2];
				$startDate 	= $row[3];
				$endDate 	= $row[4];


				if (!empty($row[5])) {
					$image = $_dirPost . $row[5];
				} else {
					$image = $_dirPost . 'default.png';
				}

				$deskToStr = strip_tags($desk);

				if (strlen($deskToStr) > 200) {
					$deskTruncate = substrwords($deskToStr, 200);
				} else {
					$deskTruncate = $deskToStr;
				}

				$view 	=

					'


				<div class="col-12" data-aos="fade-up" data-aos-delay="100">
					<div class="event-item mb-4">
						<div class="row">
							<div class="col-lg-6 col-12">
								<img src="' . $image . '" alt="">
							</div>
							<div class="col-lg-6 col-12 d-flex justify-content-start align-items-center">
								<div>
									<div class="date-event">
										</span>' . dateToDMY($startDate) . ' -</span>
										</span>' . dateToDMY($endDate) . '</span>
									</div>
									<a href="002/' . $id . '">
										<h4 class="my-2">' . $title . '</h4>
									</a>
									<p>' . $deskTruncate . '</p>
									<a href="002/' . $id . '" class="read-more">
										Baca selengkapnya
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
											<path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
										</svg>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				';


				break;

			case 10:

				// GET DATA SOCIAL

				$title 	= strtolower($row[0]);
				$url 	= $row[1];

				$view =

					'
					<li class="d-block mb-1"><a href="' . $url . '" target="_blank"><span class="icon-' . $title . '"></span></a></li>
	
					';

				break;

			case 11:

				// GET DATA LINK TERKAIT

				$title 	= strtolower($row[0]);
				$url 		= $row[1];

				$src = $_dirLink . $row[2];

				$view =

					'
					<a href="' . $url . '" class="link-image" target="_blank">
						<img target="_blank" src="' . $src . '" alt="Gambar ' . $title . '">
					</a>
	
					';

				break;
		}

		$rowLoad .= $view;
	}

	return $rowLoad;
}


function requestRecTemplate2($loadField, $loadTbl, $loadWhere, $loadOrder, $limit, $typeView)
{
	$carouselCount = 0;

	$sql = "SELECT $loadField FROM $loadTbl";
	if (!empty($loadWhere)) {
		$sql .= " WHERE $loadWhere";
	}
	if (!empty($loadOrder)) {
		$sql .= " ORDER BY $loadOrder";
	}
	if (!empty($limit)) {
		$sql .= " LIMIT $limit";
	}

	require('config.php');

	$rowLoad = '';
	$result = $GLOBALS['mysqli']->query($sql);
	$rowNum = $result->num_rows;

	while ($row = $result->fetch_array()) {
		$_val = $row[0];
		$_disp = $row[1];

		switch ($typeView) {

			case 1:


				// GET DATA BANNER
				$image = $_dirGalery . $row[1];


				if (strlen($row[0]) > 3) {
					$title = $row[0];
					$line = '<span></span>';
				} else {
					$title = '';
					$line = '';
				}

				$view =

					'
				


				<div class="item" style="background-image: url(' . $image . ');">
					<div class="header-text">
						<h2>' . $title . '</h2>
					</div>
				</div>

				
				';

				break;

			case 2:

				// GET DATA LEAD

				$nama			= strtolower($row[0]);
				$desk			= $row[1];
				$lhkpn		= $row[2];
				$jabatan 	= $row[3];
				$image		= $_dirEmp . $row[4];



				$_convertNama	= ucwords($nama, " ");

				$view =

					'

				<div class="row">
					<div class="col-lg-12">
						<div class="team-member">
							<div class="main-content">
								<img src="' . $image . '" alt="">
								<span class="category">Kepala Dinas</span>
								<h4>' . $_convertNama . '</h4>
								<span class="category mb-3">' . $desk . '</span>
								<div class="main-button-blue mt-4">
									<a href="005/">LHKPN</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				';

				break;

			case 3:

				// GET DATA SERVICES

				$id 		= $row[0];
				$nama 	= $row[1];
				$desk 	= strip_tags($row[2]);
				$dir_image = 'images/post/' . $row[3];


				// VARIABEL NEED OPERATION

				if (!empty($row['post_img'] && file_exists($dir_image))) {
					$src = 'images/post/' . $row[3];
				} else {
					$src = 'assets/images/service-03.png';
				}


				$deskToFirst = ucfirst($desk);


				$view = '


				<div class="service-item">
					<div class="icon">
						<img src="' . $src . '" alt="logo layanan">
					</div>
					<div class="main-content">
						<h4>' . $nama . '</h4>
						<p>' . substr($deskToFirst, 0, 100) . '</p>
						<div class="main-button">
							<a href="005/' . $id . '">Read More</a>
						</div>
					</div>
				</div>

				';

				break;

			case 4:

				// GET DATA NEWS

				$id 			= $row[0];
				$title 		= $row[1];
				$desk 		= $row[2];
				$date 		= $row[3];
				$count 		= $row[4];
				$dir_image =  $_dirPost . $row[5];



				// VARIABEL NEED OPERATION
				$deskToStr = strip_tags($desk);

				if (!empty($row[5]) && file_exists($dir_image)) {
					$image = $dir_image;
				} else {
					$image = $_dirPost . 'default-template-2.png';
				}


				$view 	=

					'


				<div class="col-lg-4 col-md-6 align-self-center mb-30 event_outer design">
					<div class="news-item">
						<div class="thumb">
							<a href="001/' . $id . '"><img src="' . $image . '" alt=""></a>
						</div>
						<div class="down-content">
							<span class="author mb-3">' . dateToDMY($date) . '<i class="fa fa-eye mx-2"></i>' . $count . '</span>
							<a href="001/' . $id . '"><h4>' . $title . '</h4></a>
						</div>
					</div>
				</div>
				
				';


				break;


			case 5:


				$_val2	= $row[2];
				$_val3	= $row[3];
				$_val4	= $row[4];
				$_val5	= $row[5];
				$_max = '100';
				$_href	= '#view-' . $loadTbl . '-' . $_val . '-' . $_disp;

				$view = '<div class="col-md-4">
							<div class="card card-blog">
								<div class="card-image">
									<a href="#"> <img class="img" src="/upload/' . $_val . $_val4 . '"> </a>
									<div class="ripple-cont"></div>
								</div>
								<div class="table">
									<h4 class="card-caption">
										<a href="' . $_href . '">' . $_disp . '</a>
									</h4>
									<p class="card-description">' . substrwords($_val2, $_max) . '...</p>
									<div class="ftr">
										<div class="author">
											<i class="fa fa-calendar" aria-hidden="true"></i> ' . $_val3 . '
										</div>
										<div class="stats"> 
											<i class="fa fa-eye"></i> ' . $_val5 . '
										</div>
									</div>
								</div>
							</div>
						</div>';
				break;

			case 6:

				// GET DATA VIDEO

				$id = $row[0];
				$url = $row[1];
				$queryString = parse_url($url, PHP_URL_QUERY);
				parse_str($queryString, $params);
				$videoId = $params['v'];


				$view =

					'

				<div data-video="' . $videoId . '" class="item video-thumb">
					<img src="https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg"/>
				</div>
				
				';

				break;

			case 7:

				// GET DATA GALERY

				$id = $row[0];
				$title = $row[1];
				$image = 'images/banners/' . $row[2];

				$view =

					'


				<div class="col-lg-4 mb-5">
					<div class="gallery-item">
						<a href="' . $image . '" data-fancybox="gal" data-caption="' . $title . '"><img src="' . $image . '" alt="" class="img-fluid"></a>
					</div>
				</div>

				';

				break;

			case 8:

				// GET DATA ANNOUNCEMENT

				$id			= $row[0];
				$title 		= strtolower($row[1]);
				$desk 		= $row[2];

				$_convert 	= ucwords($title, " ");

				$view =

					'

				<div class="announcement-item">
					<div class="announcement-contents">
						<a href="003/' . $id . '"><h3>' . $_convert . '</h3></a>
						<p>' . $desk . '</p>
					</div>
				</div>

				';

				break;

			case 9:

				// GET DATA EVENT

				$id 			= $row[0];
				$title 		= $row[1];
				$desk 		= $row[2];
				$startDate 	= $row[3];
				$endDate 	= $row[4];
				$image 		= 'images/post/' . $row[5];


				$dir_image = 'images/post/' . $row[5];

				if (!empty($row['post_img'] && file_exists($dir_image))) {
					$src = 'images/post/' . $row[5];
				} else {
					$src = 'images/post/default.png';
				}

				$deskToStr = strip_tags($desk);

				if (strlen($deskToStr) > 200) {
					$deskTruncate = substrwords($deskToStr, 200);
				} else {
					$deskTruncate = $deskToStr;
				}

				$view 	=

					'


				<div class="col-lg-12 col-md-6">
					<div class="item">
						<div class="row">
							<div class="col-lg-3">
								<div class="image">
								<img src="' . $src . '" alt="">
								</div>
							</div>
							<div class="col-lg-9">
								<ul>
								<li>
									<span class="category">Acara</span>
									<h4>' . $title . '</h4>
								</li>
								<li>
									<span>Start:</span>
									<h6>' . dateToDMY($startDate) . '</h6>
								</li>
								<li>
									<span>End:</span>
									<h6>' . dateToDMY($endDate) . '</h6>
								</li>
								</ul>
								<a href="002/' . $id . '"><i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
				</div>

				
				';


				break;

			case 10:

				// GET DATA SOCIAL

				$title 	= strtolower($row[0]);
				$url 	= $row[1];

				$view =

					'

					<li><a href="' . $url . '"><i class="fa-brands fa-' . $title . '"></i></a></li>
	
					';

				break;

			case 11:

				// GET DATA LINK TERKAIT

				$title 	= strtolower($row[0]);
				$url 		= $row[1];

				$src = $_dirLink . $row[2];

				$view =

					'
					<div class="clients-list__item col-lg-2 mb-lg-0 mb-5">
						<a href="' . $url . '">
							<img src="' . $src . '">
						</a>
					</div>
	
					';

				break;

			case 12:

				// GET DATA MEDIA 

				$url 		= $row[1];

				$queryString = parse_url($url, PHP_URL_QUERY);
				parse_str($queryString, $params);
				$urlID = isset($params['v']) ? $params['v'] : '';



				$view =

					'

					<div class="item">
						<a href="' . $url . '" data-fancybox>
							<iframe src="https://www.youtube.com/embed/' . $urlID . '"></iframe>
						</a>
					</div>
	
					';

				break;

			case 13:

				// GET BUTTON LAYANAN

				$url			= $row[0];
				$name 		= strtoupper($row[1]);


				$view =

					'
						<div class="main-button-blue mt-4">
							<a href="' . $url . '">' . $name . '</a>
						</div>
		
						';
		}

		$rowLoad .= $view;
	}

	return $rowLoad;
}


// template 3

function requestRecTemplate3($loadField, $loadTbl, $loadWhere, $loadOrder, $limit, $typeView)
{
	$carouselCount = 0;
	$videoCount = 1;

	$sql = "SELECT $loadField FROM $loadTbl";
	if (!empty($loadWhere)) {
		$sql .= " WHERE $loadWhere";
	}
	if (!empty($loadOrder)) {
		$sql .= " ORDER BY $loadOrder";
	}
	if (!empty($limit)) {
		$sql .= " LIMIT $limit";
	}

	$rowLoad = '';
	$result = $GLOBALS['mysqli']->query($sql);
	$rowNum = $result->num_rows;

	while ($row = $result->fetch_array()) {
		$_val = $row[0];
		$_disp = $row[1];

		switch ($typeView) {

			case 1:
				// GET DATA BANNER
				$image = 'images/banners/' . $row[1];


				if (strlen($row[0]) > 3) {
					$title = $row[0];
					$line = '<span></span>';
				} else {
					$title = '';
					$line = '';
				}

				$view =

					'
					<div class="swiper-slide" style="">
						<img src="' . $image . '.jpg" alt="Banner ' . $title . '"  style="width: 100vw; height: 100vh; object-fit: cover; position: absolute; margin-top: -55vh; filter: brightness(60%);">
					</div>
					
					';

				break;


			case 2:

				// GET DATA LEAD

				$nama			= strtolower($row[0]);
				$desk			= $row[1];
				$lhkpn		= $row[2];
				$jabatan 	= $row[3];
				$image		= 'images/employees/' . $row[4];



				$_convertNama	= ucwords($nama, " ");

				$view =

					'
					
					<div class="swiper-slide">
								<div class="testimonial-item">
									<img src="' . $image . '" class="testimonial-img" alt="">
									<h2>' . $_convertNama . '</h2>
									<p>
									<i class="bi bi-quote quote-icon-left"></i>
									<span>"' . $desk . '"</span>
									<i class="bi bi-quote quote-icon-right"></i>
								  </p>
									<a
							class="mt-2 mb-3 btn btn-info text-white shadow" style="width:200px ; height:40px ; border-radius: 30px;"
							href="files/' . $lhkpn . '" target="_blank"
							data-aos="fade-up"
							data-aos-delay="100" 
						  >
							<span class="text" style="padding:20px ;">LHKPN</span>
						  </a>
								</div>
							</div>
	
					
					';

				break;

			case 3:

				// GET DATA SERVICES

				$id 		= $row[0];
				$nama 	= $row[1];
				$desk 	= strip_tags($row[2]);
				$dir_image = 'images/post/' . $row[3];

				// VARIABEL NEED OPERATION


				if (!empty($row['post_img'] && file_exists($dir_image))) {
					$src = '../images/post/' . $row[3];
				} else {
					$src = '../images/post/default-services.png';
				}


				$deskToFirst = ucfirst($desk);


				// if(!empty($row[3])){
				// 	$image = 'images/services/'.$row[3];

				// } else {
				// 	$image = 'images/sidoarjo.png';
				// }

				$view =
					'
					<div class="col-xl-3 col-md-6 d-flex " data-aos="fade-up" data-aos-delay="100"  >
							<div class="service-item position-relative rounded" style="width:400px ; height:400px ;">
								<div class="icon"><img src="' . $src . '" style="width:80px ; height:80px ;"></img></div>
								<h4><a href="005/' . $id . '" class="stretched-link">' . $nama . '</a></h4>
								<p>' . substr($deskToFirst, 0, 100) . '</p>
							</div>
						</div>
					';

				break;

			case 4:

				// GET DATA NEWS

				$id 		= $row[0];
				$title 	= $row[1];
				$desk 	= $row[2];
				$date 	= $row[3];
				$count 	= $row[4];

				$dir_image = 'images/post/' . $row[5];

				// VARIABEL NEED OPERATION


				if (!empty($row['post_img'] && file_exists($dir_image))) {
					$src = '../images/post/' . $row[5];
				} else {
					$src = '../images/post/default_3.png';
				}

				$dateString 	= DateTime::createFromFormat('Y-m-d', $date);
				$dayEng	= $dateString->format('l');


				$listDayIn = array(
					'Sunday' => 'Minggu',
					'Monday' => 'Senin',
					'Tuesday' => 'Selasa',
					'Wednesday' => 'Rabu',
					'Thursday' => 'Kamis',
					'Friday' => 'Jumat',
					'Saturday' => 'Sabtu'
				);


				$dayIn = $listDayIn[$dayEng];
				$_convertDate = $dayIn . ', ' . $dateString->format('d F Y');

				$deskToStr = strip_tags($desk);

				$view 	=

					'
					<div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
							<div class="team-member d-flex align-items-start">
								<div class="pic"><img src="' . $src . '" class="img-fluid" alt=""></div>
								<div class="member-info">
									<h4><a href="001/' . $id . '">' . $title . '</a></h4>
									<p>' . substrwords($deskToStr, 100) . '</p>
								</div>
							</div>
						</div>
						
					
					';


				break;


			case 5:


				$_val2	= $row[2];
				$_val3	= $row[3];
				$_val4	= $row[4];
				$_val5	= $row[5];
				$_max = '100';
				$_href	= '#view-' . $loadTbl . '-' . $_val . '-' . $_disp;

				$view = '<div class="col-md-4">
								<div class="card card-blog">
									<div class="card-image">
										<a href="#"> <img class="img" src="/upload/' . $_val . $_val4 . '"> </a>
										<div class="ripple-cont"></div>
									</div>
									<div class="table">
										<h4 class="card-caption">
											<a href="' . $_href . '">' . $_disp . '</a>
										</h4>
										<p class="card-description">' . substrwords($_val2, $_max) . '...</p>
										<div class="ftr">
											<div class="author">
												<i class="fa fa-calendar" aria-hidden="true"></i> ' . $_val3 . '
											</div>
											<div class="stats"> 
												<i class="fa fa-eye"></i> ' . $_val5 . '
											</div>
										</div>
									</div>
								</div>
							</div>';
				break;

			case 6:

				// GET DATA VIDEO

				$id = $row[0];
				$url = $row[1];
				$queryString = parse_url($url, PHP_URL_QUERY);
				parse_str($queryString, $params);
				$videoId = $params['v'];


				$view =

					'
					<div id="video-' . $videoCount++ . '" data-video-id="' . $videoId . '" class="carousel-item swiper-slide">
						<iframe class="embed-responsive-item rounded" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" rel="0" allowfullscreen style="width: 100%; height: 100%;"></iframe>
					</div>
					
					
					';

				break;

			case 7:

				// GET DATA GALERY

				$title = $row[0];
				$desk = $row[1];
				$image = 'images/banners/' . $row[2];

				$view =

					'
					<div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
								<img src="' . $image . '" class="img-fluid" alt="">
								<div class="portfolio-info">
									<h4>' . $title . '</h4>
									<p>' . $desk . '</p>
									<a href="' . $image . '" title="' . $title . '"
										data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
											class="bi bi-zoom-in"></i></a>
								</div>
							</div>
	
					';

				break;

			case 8:

				// GET DATA ANNOUNCEMENT

				$id			= $row[0];
				$title 		= strtolower($row[1]);
				$desk 		= $row[2];

				$_convert 	= ucwords($title, " ");

				$view =

					'
	
					<div class="announcement-item">
						<div class="announcement-contents">
							<a href="003/' . $id . '"><h3>' . $_convert . '</h3></a>
							<p>' . $desk . '</p>
						</div>
					</div>
	
					';

				break;

			case 9:

				// GET DATA EVENT

				$id 			= $row[0];
				$title 		= $row[1];
				$desk 		= $row[2];
				$startDate 	= $row[3];
				$endDate 	= $row[4];
				$image 		= 'images/post/' . $row[5];


				$dir_image = 'images/post/' . $row[5];

				if (!empty($row['post_img'] && file_exists($dir_image))) {
					$src = '../images/post/' . $row[5];
				} else {
					$src = '../images/post/default_3.png';
				}

				$deskToStr = strip_tags($desk);

				if (strlen($deskToStr) > 200) {
					$deskTruncate = substrwords($deskToStr, 200);
				} else {
					$deskTruncate = $deskToStr;
				}

				$view 	=

					'
	
					<div class="col-xl-3 col-md-6 d-flex " data-aos="fade-up" data-aos-delay="100"  >
                        <div class="service-item position-relative rounded"  style="width:400px ; height:400px ;">
                            <div class="icon"><img src="' . $src . '" style="width:120px ; height:80px ;"></img></div>
                            <h4><a href="005/' . $id . '" class="stretched-link">' . $title . '</a></h4>
								</span>' . dateToDMY($startDate) . ' -</span>
								</span>' . dateToDMY($endDate) . '</span>
								<hr>
                            <p  style="text-align:justify;">' . $deskTruncate . '</p>
                        </div>
                	</div>
				
					
					';


				break;

			case 10:

				// GET DATA SOCIAL

				$title 	= strtolower($row[0]);
				$url 	= $row[1];

				$view =

					'
						<li class="d-block mb-2"><a href="' . $url . '" target="_blank"><i class="bi bi-' . $title . '"></i></a></li>
						
						';

				break;

			case 11:

				// GET DATA LINK TERKAIT

				$title 	= strtolower($row[0]);
				$url 		= $row[1];

				if (!empty($row[2])) {
					$src = './images/socials/' . $row[2];
				} else {
					$src = './images/tautan/default.png'; // Ganti dengan path gambar default Anda
				}

				$view =

					'
						
						<div class="swiper-slide"><img width="100px" src="' . $src . '" class="img-fluid" alt="Gambar ' . $title . '">
						</div>
						
		
		
						';

				break;
		}

		$rowLoad .= $view;
	}

	return $rowLoad;
}



// end template 3

function requestRecTemplate4($loadField, $loadTbl, $loadWhere, $loadOrder, $limit, $typeView)
{
	$carouselCount = 0;

	require('config.php');

	$sql = "SELECT $loadField FROM $loadTbl";
	if (!empty($loadWhere)) {
		$sql .= " WHERE $loadWhere";
	}
	if (!empty($loadOrder)) {
		$sql .= " ORDER BY $loadOrder";
	}
	if (!empty($limit)) {
		$sql .= " LIMIT $limit";
	}

	$rowLoad = '';
	$result = $GLOBALS['mysqli']->query($sql);
	$rowNum = $result->num_rows;

	while ($row = $result->fetch_array()) {
		$_val = $row[0];
		$_disp = $row[1];

		switch ($typeView) {

			case 1:


				// GET DATA BANNER
				$image = $row[1];

				$view =

					'
				

				<div class="u-background-video u-expanded" style="filter: brightness(0.45); height: 100%;">
					<div class="embed-responsive embed-responsive-1">
						<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" class="embed-responsive-item" src="' . $image . '&amp;loop=1&amp;mute=1&amp;showinfo=0&amp;controls=0&amp;start=0&amp;autoplay=1" data-autoplay="0" frameborder="0" allowfullscreen=""></iframe>
					</div>
					<div class="u-video-shading"></div>
				</div>
				
				';

				break;

			case 2:

				// GET DATA LEAD

				$nama			= strtolower($row[0]);
				$desk			= $row[1];
				$lhkpn		= $row[2];
				$jabatan 	= $row[3];
				$image		= '../images/employees/' . $row[4];



				$_convertNama	= ucwords($nama, " ");

				$view =

					'

				<div class="u-shape u-shape-svg u-text-palette-1-base u-shape-1" data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="1000">
					<svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 160" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-a0bf"></use></svg>
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 160 160" x="0px" y="0px" id="svg-a0bf" style="enable-background:new 0 0 160 160;"><path d="M80,30c27.6,0,50,22.4,50,50s-22.4,50-50,50s-50-22.4-50-50S52.4,30,80,30 M80,0C35.8,0,0,35.8,0,80s35.8,80,80,80
					s80-35.8,80-80S124.2,0,80,0L80,0z"></path></svg>
					</div>
					<div class="u-palette-1-base u-shape u-shape-circle u-shape-2" data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="750"></div>
					<div class="u-align-center u-border-20 u-border-no-bottom u-border-no-left u-border-no-right u-border-palette-1-base u-container-style u-expanded-width-xs u-group u-radius u-shape-round u-white u-group-1" data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="750">
					<div class="u-container-layout u-container-layout-1">
						<h2 style="font-size: 1.5rem;" class="u-align-left u-text u-text-1">PROFIL <span style="font-weight: 700; font-style: italic;">PIMPINAN</span>
						</h2>
						<p class="u-align-left u-large-text u-text u-text-variant u-text-2" style="font-size : 1.3rem;">
							' . $jabatan . '
							<br><strong class="name">' . $_convertNama . '</strong>
							<br><br>
							<a href="?page=profil-pimpinan&p=1" class="u-btn u-btn-round u-button-style u-custom u-radius-50 u-btn-1">LHKPN</a>
						</div>
					</div>
					<div class="u-shape u-shape-svg u-text-palette-1-base u-shape-3" data-animation-name="flipIn" data-animation-duration="1500" data-animation-direction="X" data-animation-delay="500">
						<svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 160" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-e858"></use></svg>
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 160 160" x="0px" y="0px" id="svg-e858" style="enable-background:new 0 0 160 160;"><path d="M80,30c27.6,0,50,22.4,50,50s-22.4,50-50,50s-50-22.4-50-50S52.4,30,80,30 M80,0C35.8,0,0,35.8,0,80s35.8,80,80,80
							s80-35.8,80-80S124.2,0,80,0L80,0z"></path></svg>
					</div>
					<img class="u-expanded-width-xs u-image u-image-default u-image-1" src="' . $image . '" alt="" data-image-width="375" data-image-height="508" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="0">
				<div>
				
				';

				break;

			case 3:

				// GET DATA SERVICES

				$id 		= $row[0];
				$nama 	= $row[1];
				$desk 	= strip_tags($row[2]);
				$dir_image = 'images/post/' . $row[3];


				// VARIABEL NEED OPERATION

				if (!empty($row['post_img'] && file_exists($dir_image))) {
					$src = 'images/post/' . $row[3];
				} else {
					$src = 'assets/images/service-03.png';
				}


				$deskToFirst = ucfirst($desk);


				$view = '


				<div class="service-item">
					<div class="icon">
						<img src="' . $src . '" alt="logo layanan">
					</div>
					<div class="main-content">
						<h4>' . $nama . '</h4>
						<p>' . substr($deskToFirst, 0, 100) . '</p>
						<div class="main-button">
							<a href="005/' . $id . '">Read More</a>
						</div>
					</div>
				</div>

				';

				break;

			case 4:

				// GET DATA NEWS

				$id 		= $row[0];
				$title 	= $row[1];
				$desk 	= $row[2];
				$date 	= $row[3];
				$count 	= $row[4];

				$dir_image =  $_dirPost . $row[5];



				// VARIABEL NEED OPERATION

				if (!empty($row[5]) && file_exists($dir_image)) {
					$image = $dir_image;
				} else {
					$image = $_dirPost . 'default-template-2.png';
				}



				$title = strip_tags($title);

				if (strlen($title) > 50) {
					$title = substrwords($title, 50);
				}

				$deskToStr = strip_tags($desk);

				$view 	=

					'

				<div class="col-6 w-100 mb-5" style="z-index: 999;">
					<div class="card text-white">
						<img class="card-img" src="' . $image . '" alt="..." />
						<div class="card-img-overlay d-flex flex-column justify-content-center px-5 px-md-3 px-lg-5 bg-dark-gradient">
							<div class="" style="margin-top: 30%;">
								<p class="text-white">
								<i class="fa-regular fa-calendar"></i> <span style="margin: 0 10px;">' . dateToDMY($date) . '</span>
								<i class="fa-solid fa-eye"></i> <span style="margin-left: 10px;">25</span>
								</p>
								<a href="001/' . $id . '" class="text-decoration-none"><h6 class="fw-bold text-white fs-3 fs-md-5 fs-lg-3 lh-sm">' . $title . '</h6></a>
							</div>
						</div>
					</div>
				</div>
				
				';


				break;


			case 5:


				$_val2	= $row[2];
				$_val3	= $row[3];
				$_val4	= $row[4];
				$_val5	= $row[5];
				$_max = '100';
				$_href	= '#view-' . $loadTbl . '-' . $_val . '-' . $_disp;

				$view = '<div class="col-md-4">
							<div class="card card-blog">
								<div class="card-image">
									<a href="#"> <img class="img" src="/upload/' . $_val . $_val4 . '"> </a>
									<div class="ripple-cont"></div>
								</div>
								<div class="table">
									<h4 class="card-caption">
										<a href="' . $_href . '">' . $_disp . '</a>
									</h4>
									<p class="card-description">' . substrwords($_val2, $_max) . '...</p>
									<div class="ftr">
										<div class="author">
											<i class="fa fa-calendar" aria-hidden="true"></i> ' . $_val3 . '
										</div>
										<div class="stats"> 
											<i class="fa fa-eye"></i> ' . $_val5 . '
										</div>
									</div>
								</div>
							</div>
						</div>';
				break;

			case 6:

				// GET DATA VIDEO

				$id = $row[0];
				$url = $row[1];
				$queryString = parse_url($url, PHP_URL_QUERY);
				parse_str($queryString, $params);
				$videoId = $params['v'];


				$view =

					'

				<div data-video="' . $videoId . '" class="item video-thumb">
					<img src="https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg"/>
				</div>
				
				';

				break;

			case 7:

				// GET DATA GALERY

				$id 	= $row[0];
				$dir_image	= $_dirGalery . $row[1];


				// VARIBEL NEED A OPERATION

				if (!empty($row[1]) && file_exists($dir_image)) {
					$image = $dir_image;
				} else {
					$image = $_dirPost . 'default-template-2.png';
				}

				$view =

					'

				<img src="' . $image . '" class="img-fluid">

				';

				break;

			case 8:

				// GET DATA ANNOUNCEMENT

				$id			= $row[0];
				$dir_image	= $_dirPost . $row[1];


				// VARIBEL NEED A OPERATION

				if (!empty($row[1]) && file_exists($dir_image)) {
					$image = $dir_image;
				} else {
					$image = $_dirPost . 'default-template-2.png';
				}


				$view =

					'

				<div class="carousel-item active">
					<a href="003/' . $id . '"><img src="' . $image . '" class="image-announcement d-block w-100" alt="..."></a>
				</div>
				
				';

				break;

			case 9:

				// GET DATA EVENT

				$id 			= $row[0];
				$title 		= $row[1];
				$desk 		= $row[2];
				$startDate 	= $row[3];
				$endDate 	= $row[4];

				$deskToStr = strip_tags($desk);

				if (strlen($deskToStr) > 200) {
					$deskTruncate = substrwords($deskToStr, 200);
				} else {
					$deskTruncate = $deskToStr;
				}

				// Memecah tanggal menjadi bagian-bagian (tahun, bulan, dan hari)
				list($styear, $stmonth, $stdate) = explode('-', $startDate);
				$monthName = date("F", strtotime("{$styear}-{$stmonth}-01"));

				$view 	=

					'

				<div class="u-align-center w-100 mb-4 u-container-style u-list-item u-palette-1-base u-radius u-repeater-item u-shape-round u-list-item-1" data-animation-name="customAnimationIn" data-animation-duration="1000" data-animation-delay="750">
					<div class="u-container-layout u-similar-container u-container-layout-1">
						<div class="u-align-left u-border-10 u-border-white u-container-style u-group u-palette-1-dark-2 u-shape-circle u-group-1">
							<div class="u-container-layout">
								<p class="u-text u-text-default u-text-3" style="color : white">' . $monthName . '</p>
								<h1 class="u-text u-text-default u-title u-text-4" style="color : white" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">25</h1>
								<br><h4 class="u-text u-text-default u-text-5" style="color : white">' . $styear . '</h4>
							</div>
						</div>
						<h5 class="u-text u-text-6" style="color : white">
							<a href="002/' . $id . '">
								' . $title . '
							</a>
						</h5>
					</div>
				</div>

				
				';


				break;

			case 10:

				// GET DATA SOCIAL

				$title 	= strtolower($row[0]);
				$url 	= $row[1];

				$view =

					'

					<li><a href="' . $url . '"><i class="fa-brands fa-' . $title . '"></i></a></li>
	
					';

				break;

			case 11:

				// GET DATA LINK TERKAIT

				$title 	= strtolower($row[0]);
				$url 		= $row[1];

				if (!empty($row[2])) {
					$src = '../images/socials/' . $row[2];
				} else {
					$src = '../images/tautan/default.png'; // Ganti dengan path gambar default Anda
				}

				$view =

					'
					<div class="clients-list__item col-lg-2 mb-lg-0 mb-5">
						<a href="' . $url . '">
							<img src="' . $src . '">
						</a>
					</div>
	
					';

				break;

			case 12:

				// GET DATA MEDIA 

				$url 		= $row[1];

				$queryString = parse_url($url, PHP_URL_QUERY);
				parse_str($queryString, $params);
				$urlID = isset($params['v']) ? $params['v'] : '';



				$view =

					'

					<div class="item">
						<a href="' . $url . '" data-fancybox>
							<iframe src="https://www.youtube.com/embed/' . $urlID . '"></iframe>
						</a>
					</div>
	
					';

				break;


			case 13:

				// GET BUTTON LAYANAN

				$url			= $row[0];
				$name 		= strtoupper($row[1]);


				$view =

					'

						<a href="' . $url . '" class="mt-3 u-active-palette-1-base u-align-left u-border-none u-btn u-btn-round u-button-style  u-hover-black u-palette-1-base u-radius u-text-active-white u-text-body-alt-color u-text-hover-white u-btn-1" data-animation-name="fadeIn" data-animation-duration="1000" data-animation-delay="500">' . $name . '</a>
		
						';

				break;

			case 14:

				// GET DATA BIDANG

				$nama			= $row[0];
				$desk 		= $row[1];


				$view =

					'
						<div class="u-align-left col-lg-3 col-12 mb-5 u-container-align-center u-container-style u-effect-hover-zoom u-image-round u-list-item u-radius-20 u-repeater-item u-shading u-video-cover u-list-item-2" data-image-width="626" data-image-height="417" data-animation-direction="Up" data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="750" data-toggle="modal" data-target="#myModal_pikom">
							<div class="u-background-effect u-expanded">
								<div class="u-background-effect-image u-expanded u-image u-shading u-image-2" data-image-width="626" data-image-height="417"></div>
								</div>
								<div class="u-container-layout u-similar-container u-valign-top u-container-layout-2"><span class="u-align-center u-file-icon u-icon u-opacity u-opacity-70 u-text-white u-icon-2"><img src="../images/9743209-7758dc09.png" alt=""></span>
								<h4 class="u-align-center u-text u-text-5" style="line-height: 1.5rem; color: white;font-size : 1.5rem;">' . $nama . '</h4>
								<p class="u-align-center u-text u-text-6" style="color: white;font-size : 1rem;"> Bidang Pengelolaan Informasi dan Komunikasi Publik</p>
							</div>
						</div>
		
						';

				break;
		}

		$rowLoad .= $view;
	}

	return $rowLoad;
}




// mail function ============================================================
function sendOTP($email, $otp)
{

	require 'src/Exception.php';
	require 'src/PHPMailer.php';
	require 'src/SMTP.php';

	require('config.php');

	$profile =  $mysqli->query('SELECT prof_snm, prof_mail, prof_pwd from pub_profile WHERE _active=1 ORDER BY _cre DESC');
	$prof = $profile->fetch_all(MYSQLI_ASSOC);



	$message_body = "Terima kasih telah memberikan kritik dan saran melalui " .	$prof[0]['prof_snm'] . " Kabupaten Sidoarjo <br/> Verifikasi kritik dan saran harap masukkan kode OTP berikut ini: :<br/><br/>" . $otp;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = TRUE;
	$mail->SMTPSecure = 'tls';
	$mail->Port     = 587;
	$mail->Username = $prof[0]['prof_mail'];
	$mail->Password = $prof[0]['prof_pwd'];
	$mail->Host     = 'mail.sidoarjokab.go.id';
	$mail->Mailer   = 'smtp';
	$mail->SetFrom('triwf@sidoarjokab.go.id');
	$mail->AddAddress($email);
	$mail->Subject = "OTP Verifikasi";
	$mail->MsgHTML($message_body);
	$mail->IsHTML(true);
	$result = $mail->Send();

	return $result;
}
//============================================================================

function enc($cry)
{
	$cry = base64_encode(md5("pass@w0rd" . trim($cry . '--SITES--')));

	return $cry;
}



function getIP()
{
	if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
			$addr = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
			$ip = trim($addr[0]);
		} else {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	return $ip;
}

function get_operating_system()
{
	$u_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	$operating_system = 'Other';

	if ($u_agent) {
		if (preg_match('/linux/i', $u_agent)) {
			$operating_system = 'Linux';
		} elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
			$operating_system = 'Mac';
		} elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
			$operating_system = 'Windows';
		} elseif (preg_match('/ubuntu/i', $u_agent)) {
			$operating_system = 'Ubuntu';
		} elseif (preg_match('/iphone/i', $u_agent)) {
			$operating_system = 'IPhone';
		} elseif (preg_match('/ipod/i', $u_agent)) {
			$operating_system = 'IPod';
		} elseif (preg_match('/ipad/i', $u_agent)) {
			$operating_system = 'IPad';
		} elseif (preg_match('/android/i', $u_agent)) {
			$operating_system = 'Android';
		} elseif (preg_match('/blackberry/i', $u_agent)) {
			$operating_system = 'Blackberry';
		} elseif (preg_match('/webos/i', $u_agent)) {
			$operating_system = 'Mobile';
		}
	} else {
		$operating_system = php_uname('s');
	}

	return $operating_system;
}

function get_the_browser()
{
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)
		return 'Internet explorer';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false)
		return 'Internet explorer';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false)
		return 'Mozilla Firefox';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
		return 'Google Chrome';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false)
		return "Opera Mini";
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== false)
		return "Opera";
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Edge') !== false)
		return "Microsoft Edge";
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false)
		return "Safari";
}



$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

function generateShareLink($social_media, $url)
{
	switch ($social_media) {
		case 'facebook':
			return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);
		case 'twitter':
			return 'https://twitter.com/intent/tweet?url=' . urlencode($url);
		case 'whatsapp':
			return 'https://api.whatsapp.com/send?text=' . urlencode($url);
		case 'instagram':
			return 'https://www.instagram.com/share?url=' . urlencode($url);
		default:
			return '#';
	}
}

function strOrganisasi()
{

	$sql = "
SELECT pub_employees.emp_id, pub_employees.emp_img, pub_employees.emp_nm, pub_employees.jab_id, pub_employees.parent, set_jabdept.jab_nm, set_jabdept.stat FROM 
			pub_employees JOIN set_jabdept ON pub_employees.jab_id = set_jabdept.jab_id WHERE set_jabdept.stat = 2";

	$result = $GLOBALS['mysqli']->query($sql);
	$json = [];

	while ($row = $result->fetch_assoc()) {
		$json[] = ['id' => $row['emp_id'], 'name' => $row['emp_nm'], 'image' => $row['emp_img'], 'position' => $row['jab_nm'], 'parentId' => $row['parent']];
	}

	return json_encode($json);
}

function jsonEvent()
{
	require('config.php');
	$sql = "SELECT post_id, post_judul, post_publish, post_datex FROM pub_post WHERE ca_id='002'";
	$result = $mysqli->query($sql);
	$json = [];

	while ($row = $result->fetch_assoc()) {
		// Menggunakan utf8_encode untuk setiap nilai dalam array
		$title = utf8_encode($row['post_judul']);
		$start = utf8_encode($row['post_publish']);
		$end = utf8_encode($row['post_datex']);
		$url = utf8_encode('002/' . $row['post_id']);

		// Tambahkan nilai yang telah dikonversi ke dalam array JSON
		$json[] = [
			'title' => $title,
			'start' => $start,
			'end' => $end,
			'url' => $url
		];
	}

	return json_encode($json);
}




function addVisitToDatabase($ip_address, $os, $browser, $visit_date)
{
	require('config.php');

	$getDate 	= date('Y-m-d H:i:s');
	$timestamp 	= strtotime($getDate);
	$sql 		= "INSERT INTO visitors (vs_id, vs_ip, vs_os, vs_brow, vs_date) VALUES ('$timestamp','$ip_address', '$os', '$browser', '$visit_date')";

	mysqli_query($mysqli, $sql);
	mysqli_close($mysqli);
}

function postSee($post_id)
{
	require('config.php');
	$updatePostSee = "UPDATE pub_post SET post_see = post_see + 1 WHERE post_id = $post_id";
	mysqli_query($mysqli, $updatePostSee);
}


function dateToDMY($tanggal)
{
	$bulan = array(
		'January'   => 'Januari',
		'February'  => 'Februari',
		'March'     => 'Maret',
		'April'     => 'April',
		'May'       => 'Mei',
		'June'      => 'Juni',
		'July'      => 'Juli',
		'August'    => 'Agustus',
		'September' => 'September',
		'October'   => 'Oktober',
		'November'  => 'November',
		'December'  => 'Desember'
	);

	$dateTimestamp = strtotime($tanggal);
	$namaBulan = $bulan[date('F', $dateTimestamp)];
	$converted_date = date('d', $dateTimestamp) . ' ' . $namaBulan . ' ' . date('Y', $dateTimestamp);

	return $converted_date;
}


function strtoTimeDetail($id)
{
	$dateTimestamp = date('l, d F Y | H.i', $id);

	$hari = array(
		'Sunday'    => 'Minggu',
		'Monday'    => 'Senin',
		'Tuesday'   => 'Selasa',
		'Wednesday' => 'Rabu',
		'Thursday'  => 'Kamis',
		'Friday'    => 'Jumat',
		'Saturday'  => 'Sabtu'
	);

	$bulan = array(
		'January'   => 'Januari',
		'February'  => 'Februari',
		'March'     => 'Maret',
		'April'     => 'April',
		'May'       => 'Mei',
		'June'      => 'Juni',
		'July'      => 'Juli',
		'August'    => 'Agustus',
		'September' => 'September',
		'October'   => 'Oktober',
		'November'  => 'November',
		'December'  => 'Desember'
	);

	if (!is_numeric($id)) {
		$dateTimestamp = strtotime($id);
	} else {
		$dateTimestamp = $id;
	}

	$namaHari = $hari[date('l', $dateTimestamp)];
	$namaBulan = $bulan[date('F', $dateTimestamp)];

	$_convertDate = $namaHari . ', ' . date('d', $dateTimestamp) . ' ' . $namaBulan . ' ' . date('Y', $dateTimestamp) . ' | ' . date('H.i', $dateTimestamp);

	return $_convertDate;
}


function dateToDay($date)
{
	$dateString = DateTime::createFromFormat('Y-m-d', $date);
	$dayEng = $dateString->format('l');

	$listDayIn = array(
		'Sunday' => 'Minggu',
		'Monday' => 'Senin',
		'Tuesday' => 'Selasa',
		'Wednesday' => 'Rabu',
		'Thursday' => 'Kamis',
		'Friday' => 'Jumat',
		'Saturday' => 'Sabtu'
	);

	$listMonthIn = array(
		'January' => 'Januari',
		'February' => 'Februari',
		'March' => 'Maret',
		'April' => 'April',
		'May' => 'Mei',
		'June' => 'Juni',
		'July' => 'Juli',
		'August' => 'Agustus',
		'September' => 'September',
		'October' => 'Oktober',
		'November' => 'November',
		'December' => 'Desember'
	);

	$dayIn = $listDayIn[$dayEng];
	$monthIn = $listMonthIn[$dateString->format('F')];
	$_convertDate = $dayIn . ', ' . $dateString->format('d') . ' ' . $monthIn . ' ' . $dateString->format('Y');
	return $_convertDate;
}


function downloadFile($file)
{
	if (isset($file)) {
		$fileName = basename($file);
		$filePath = '../images/download/' . $fileName;

		if (file_exists($filePath)) {
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . $fileName . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filePath));

			readfile($filePath);

			// Lakukan peningkatan jumlah unduhan pada database
			$query = "UPDATE pub_files SET files_down = files_down + 1 WHERE files_nm = '$fileName'";
			$mysqli->query($query);

			exit;
		} else {
			echo "File not found.";
		}
	} else {
		echo "Invalid request.";
	}
}


//================================================
//SPECIAL CONDITION
//================================================

if (!empty($_REQUEST['kategori'])) {
	$rLink = '../';
	$bgNav = 'bg-primary bg-gradient';
} else if (count(explode("/", $_SERVER['REQUEST_URI'])) > 3) {
	$rLink = '../';
	$bgNav = 'bg-primary bg-gradient';
} else {
	$rLink = '';
	$bgNav = '';

	$ip_address = getIp();
	$os = get_operating_system();
	$browser = get_the_browser();
	$visit_date = date('Y-m-d H:i:s');
	addVisitToDatabase($ip_address, $os, $browser, $visit_date);
}


//------------------------------------------------------------------------------

// END FRONTEND FUNCTION 
//------------------------------------------------------------------------------


//------------------------------------------------------------------------------
//START BACKEND FUNCTION
//------------------------------------------------------------------------------

function inOpt($loadField, $loadTbl, $loadWhere, $loadOrder, $typeView)
{

	$sql = "SELECT $loadField FROM $loadTbl";
	if (!empty($loadWhere)) {
		$sql .= " WHERE $loadWhere";
	}
	if (!empty($loadOrder)) {
		$sql .= " ORDER BY $loadOrder";
	}

	$rowLoad = '';
	$result = $GLOBALS['mysqli']->query($sql);
	$rowNum = $result->num_rows;

	while ($row = $result->fetch_array()) {
		$_val = $row[0];
		$_disp = $row[1];

		switch ($typeView) {
			case 1: //_mast-kategori.php
				$view = '<option style="padding-bottom: 0;" value="' . $_val . '">' . $_disp . '</option>';
				break;
			case 2: //_set-menu.php
				$view = '<option style="padding-bottom: 0;" value="' . $loadTbl . '-' . $_val . '">' . $_disp . '</option>';
				break;
			case 3:
				$num_ag = loadRecText('count(*)', 'tb_agnd', '_active=1 AND _cre="' . $_val . '"');
				$num_fl = loadRecText('count(*)', 'tb_files', '_active=1 AND _cre="' . $_val . '"');
				$num_ga = loadRecText('count(*)', 'tb_galery', '_active=1 AND _cre="' . $_val . '"');
				$num_li = loadRecText('count(*)', 'tb_link', '_active=1 AND _cre="' . $_val . '"');
				$num_po = loadRecText('count(*)', 'tb_post', '_active=1 AND _cre="' . $_val . '"');
				$num_all = $num_ag + $num_fl + $num_ga + $num_li + $num_po;

				$view = '<div class="col-sm-6 col-xl-2">
							<div class="p-3 bg-warning-300 rounded overflow-hidden position-relative text-white mb-g">
								<div class="">
									<h3 class="display-4 d-block l-h-n m-0 fw-500">
										<small class="m-0 l-h-n text-capitalize">' . $_disp . '</small>
										' . $num_all . '
									</h3>
								</div>
								<i class="fal fa-solid fa-file position-absolute pos-right pos-bottom opacity-50 mb-n1 mr-n1" style="font-size:6rem"></i>
							</div>
						</div>';
				break;
		}

		$rowLoad .= $view;
	}

	return $rowLoad;
}

function hrefAside($field, $tbl, $sqlJoin, $sqlWhere, $sqlOrder)
{

	$sql = "SELECT $field FROM $tbl";
	if (!empty($sqlJoin)) {
		$sql .= " $sqlJoin";
	}
	if (!empty($sqlWhere)) {
		$sql .= " WHERE $sqlWhere";
	}
	if (!empty($sqlOrder)) {
		$sql .= " ORDER BY $sqlOrder";
	}

	$rowLoad = '';
	$result = $GLOBALS['mysqli']->query($sql);

	while ($row = $result->fetch_array()) {
		$_var1 = $row[0];
		$_var2 = $row[1];
		$_var2c = str_replace(" ", "-", "$row[1]");
		$_var3 = $row[2];
		$_var4 = $row[3];

		//a.ka_id, a.ka_name, a.fm_id, b.fm_file

		$view =	"<li>" .
			"<a href=\"javascript:void(0)\" onClick=\"goPublic('$_var4','$_var1','$_var2c','publikasi_data_$_var2c')\">" .
			"<span class=\"nav-link-text\" data-i18n=\"nav.settings_user\">$_var2</span>" .
			"</a>" .
			"</li>";

		$rowLoad .= $view;
	}

	return $rowLoad;
}

function privAcc($txtbread, $priv)
{

	$result = $GLOBALS['mysqli']->query("SELECT COUNT(*) AS nRec, a.page_id, a.page_name, a.page_addr, b.ro_id, b.rr_read, b.rr_cre, b.rr_up, b.rr_del
								FROM set_page a
									LEFT JOIN set_rules b
										ON a.page_id = b.page_id AND b.ro_id='$priv'
								WHERE a._active=1 AND a.page_addr='$txtbread'
								GROUP BY a.page_id")
		or die('Ada kesalahan pada query tampil data transaksi: ' . $mysqli->error);


	$row = $result->fetch_assoc();
	$rowNum = $result->num_rows;

	if ($rowNum) {
		return array('_num' => $row['nRec'], '_re' => $row['rr_read'], '_cr' => $row['rr_cre'], '_up' => $row['rr_up'], '_de' => $row['rr_del']);
	} else {
		return array('_num' => 0);
	}

	die();
}
function updateOneField($loadField, $loadTbl, $loadWhere)
{

	$sql = "UPDATE $loadTbl AS t1, (SELECT $loadField FROM $loadTbl WHERE $loadWhere) as t2
				SET t1.$loadField = t2.$loadField+1 
				WHERE $loadWhere";

	$result = $GLOBALS['mysqli']->query($sql);

	//return $rowLoad;
}

function updateField($setField, $setTbl, $setWhere)
{
	$sql = "UPDATE $setTbl
				SET $setField
				WHERE $setWhere";

	$result = $GLOBALS['mysqli']->query($sql);

	//return $rowLoad;
}

function loadRecText($field, $table, $condition)
{

	$sql = "SELECT $field FROM $table WHERE $condition";
	$result = $GLOBALS['mysqli']->query($sql);
	$row = $result->fetch_assoc();

	return $row[$field];
}

function logSites($dt, $IP, $OS, $BR, $C)
{
	//logSites($dateYMD, getIP(), get_operating_system(), get_the_browser());

	$logid = $dt . str_pad(loadRecText('count(*)', 'log_sites', 'logcat=' . $C . ' AND logid LIKE "' . $dt . '%"') + 1, 3, '0', STR_PAD_LEFT);

	$sql = "INSERT INTO log_sites
				VALUES ('$logid', '$IP', '$BR', '$OS', SYSDATE(), '$C')";

	$result = $GLOBALS['mysqli']->query($sql);

	return $rowLoad;
}

function sidebarLi($loadPage, $textdisp)
{
	$rest = "<li><a href=\"javascript:void(0);\" onClick=\"$loadPage\"><span class=\"sub-item\">$textdisp</span></a></li>";
	return $rest;
}

function bulan($var)
{
	$bulan = array(
		01 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	return $bulan[$var];
}
function tgl_panjang($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function tgl_pendek($tanggal)
{
	$bulan = array(
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agust',
		'Sept',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function tgljam($tanggal)
{
	list($tgl, $jam) = explode(' ', $tanggal);
	$bulan = array(
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agust',
		'Sept',
		'Okt',
		'Nov',
		'Des'
	);

	list($th, $bl, $tg) = explode('-', $tgl);
	if ($th == date('Y')) {
		$th = '';
	}
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $tg . ' ' . $bulan[(int)$bl] . ' ' . $th;
}

function substrwords($text, $maxchar, $end = '...')
{
	$text = strip_tags($text);
	if (strlen($text) > $maxchar || $text == '') {
		$words = preg_split('/\s/', $text);
		$output = '';
		$i      = 0;
		while (1) {
			$length = strlen($output) + strlen($words[$i]);
			if ($length > $maxchar) {
				break;
			} else {
				$output .= " " . $words[$i];
				++$i;
			}
		}
		$output .= $end;
	} else {
		$output = $text;
	}
	return $output;
}

function beda_waktu($date1, $date2, $format = false)
{
	$diff = date_diff(date_create($date1), date_create($date2));
	if ($format)
		return $diff->format($format);

	return array(
		'y' => $diff->y,
		'm' => $diff->m,
		'd' => $diff->d,
		'h' => $diff->h,
		'i' => $diff->i,
		's' => $diff->s
	);
}

//START EMAIL HIDDEN//
function mask($str, $first, $last)
{
	$len = strlen($str);
	$toShow = $first + $last;
	return substr($str, 0, $len <= $toShow ? 0 : $first) . str_repeat("*", $len - ($len <= $toShow ? 0 : $toShow)) . substr($str, $len - $last, $len <= $toShow ? 0 : $last);
}

function mask_email($email)
{
	$mail_parts = explode("@", $email);
	$domain_parts = explode('.', $mail_parts[1]);

	$mail_parts[0] = mask($mail_parts[0], 2, 1); // show first 2 letters and last 1 letter
	$domain_parts[0] = mask($domain_parts[0], 2, 1); // same here
	$mail_parts[1] = implode('.', $domain_parts);

	return implode("@", $mail_parts);
}
//END EMAIL//

//SIDOARJO DALAM ANGKA
function curWord($cu)
{
	$cux = number_format($cu, 0);
	$lenCux = strlen($cux);

	if ($lenCux > 8) {
		if (substr($cux, 2, 1) != 0) {
			switch ($lenCux) {
				case 9:
					$subCux = substr($cux, 0, 3);

					$combine = $subCux . ' Juta';
					break;
				case 13:
					$subCux = substr($cux, 0, 3);

					$combine = $subCux . ' M';
					break;
				case 17:
					$subCux = substr($cux, 0, 3);

					$combine = $subCux . ' T';
					break;
			}
		} else {
			switch ($lenCux) {
				case 9:
					$subCux = substr($cux, 0, 1);

					$combine = $subCux . ' Juta';
					break;
				case 13:
					$subCux = substr($cux, 0, 1);

					$combine = $subCux . ' M';
					break;
				case 17:
					$subCux = substr($cux, 0, 1);

					$combine = $subCux . ' T';
					break;
			}
		}
	} else {
		$combine = $cux;
	}

	return $combine;
}
//END SIDOARJO DALAM ANGKA

//date ago
function TimeAgo($oldTime, $newTime)
{
	$timeCalc = strtotime($newTime) - strtotime($oldTime);
	if ($timeCalc >= (60 * 60 * 24 * 30 * 12 * 2)) {
		$timeCalc = intval($timeCalc / 60 / 60 / 24 / 30 / 12) . " years ago";
	} else if ($timeCalc >= (60 * 60 * 24 * 30 * 12)) {
		$timeCalc = intval($timeCalc / 60 / 60 / 24 / 30 / 12) . " year ago";
	} else if ($timeCalc >= (60 * 60 * 24 * 30 * 2)) {
		$timeCalc = intval($timeCalc / 60 / 60 / 24 / 30) . " months ago";
	} else if ($timeCalc >= (60 * 60 * 24 * 30)) {
		$timeCalc = intval($timeCalc / 60 / 60 / 24 / 30) . " month ago";
	} else if ($timeCalc >= (60 * 60 * 24 * 2)) {
		$timeCalc = intval($timeCalc / 60 / 60 / 24) . " days ago";
	} else if ($timeCalc >= (60 * 60 * 24)) {
		$timeCalc = " Yesterday";
	} else if ($timeCalc >= (60 * 60 * 2)) {
		$timeCalc = intval($timeCalc / 60 / 60) . " hours ago";
	} else if ($timeCalc >= (60 * 60)) {
		$timeCalc = intval($timeCalc / 60 / 60) . " hour ago";
	} else if ($timeCalc >= 60 * 2) {
		$timeCalc = intval($timeCalc / 60) . " minutes ago";
	} else if ($timeCalc >= 60) {
		$timeCalc = intval($timeCalc / 60) . " minute ago";
	} else if ($timeCalc > 0) {
		$timeCalc .= " seconds ago";
	}
	return $timeCalc;
} //end date ago


//------------------------------------------------------------------------------
// END BACKEND FUNCTION
//------------------------------------------------------------------------------
