<?php
require_once("includes/header.php");

if (!isset($_GET["id"])) {
     ErrorMessage::show(("Có gì đó sai sai !!!"));
}

$video = new Video($con, $_GET["id"]);
$video->inscrementViews();

$upNextVideo = VideoProvider::getUpNext($con, $video);
?>

<div class="watCon">
     <div class="videoCon watchNav">
          <button onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
          <h1><?php echo $video->getTitle();?></h1>
     </div>

     <div class="videoCon upNext" style="display:none;">
          <button onclick="restartVideo();"><i class="fas fa-redo"></i></button>
          <div class="upNextCon">
               <h2>Xem phần tiếp theo:</h2>
               <h3><?php echo $upNextVideo->getTitle(); ?></h3>
               <h3><?php echo $upNextVideo->getSsAndEp(); ?></h3>
               <button class="playNext" onclick="watchVideo(<?php echo $upNextVideo->getId(); ?>)">
                    <i class="fas fa-play"></i>Xem
               </button>
          </div>
     </div>

     <video controls autoplay onended="showUpNext()">
          <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
     </video>
</div>

<script>
     initVideo("<?php echo $video->getId();?>","<?php echo $userLoggedIn; ?>");
</script>