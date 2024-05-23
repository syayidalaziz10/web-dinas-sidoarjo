<?php
include_once 'loader.class.php';
$dbCon = DB::Connect();
$data = array();

$site = Settings::Show($dbCon);
$news = News::Show($dbCon);
$event = Events::Show($dbCon);

$data['site'] = array(
  'name' => $site[1]->value,
  'url' => $site[0]->value,
);
$data['news'] = array(
	'idnews' => $news[0]->idnews,
	'title' => $news[0]->title,
	'description' => $news[0]->description,
	'author' => $news[0]->full_name,
	'date' => $news[0]->date,
	'url_image' =>  $news[0]->img !== "" ? $site[0]->value.'/images/uploads/news/'.$news[0]->img : null,
	'url_news' =>  $site[0]->value.'/?page=v-berita&id='.$news[0]->idnews
);
$data['event'] = array(
	'idevent' => $event[0]->idevents,
	'title' => $event[0]->title,
	'description' => $event[0]->description,
	'author' => $event[0]->full_name,
	'date' => $event[0]->date,
	'url_image' =>  $event[0]->img !== "" ? $site[0]->value.'/images/uploads/events/'.$event[0]->img : null,
	'url_news' =>  $site[0]->value.'/?page=v-agenda&id='.$event[0]->idevents
);


echo json_encode($data, true | JSON_UNESCAPED_SLASHES);
// echo "<pre>";
// print_r($site);
