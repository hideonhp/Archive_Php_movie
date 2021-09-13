<?php
require_once("includes/header.php");

if(!isset($_GET["id"])){
     ErrorMessage::show("Có gì đó sai sai !!!");
}
$entityId = $_GET["id"];
$entity = new Entity($con, $entityId);

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createPreviewVideo(null);

$seasonProvider = new SeasonProvider($con, $userLoggedIn);
echo $seasonProvider-> create ($entity);

$CategoryContainers = new CategoryContainers($con, $userLoggedIn);
echo $CategoryContainers-> showCategory ($entity->getCategoryId(),"Bạn có thể thích các bộ phim khác ?");
?>