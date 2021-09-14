<?php
class PreviewProvider
{

    private $con, $username;

    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function createPreviewVideo($entity)
    {
        if ($entity == null) {
            $entity = $this->getRdEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $preview = $entity->getPreview();
        $thumbnail = $entity->getThumbnail();

        $videoId = VideoProvider::getEntityVideoFor($this->con, $id, $this->username);
        $video = new Video($this->con, $videoId);

        $isProgress = $video->isInProgress($this->username);
        $playButtonText = $isProgress ? "Tiếp tục xem" : "Xem liền";

        $seasonEpisode = $video->getSsAndEp();
        $subHeading = $video->isMovie() ? "" : "<h4>$seasonEpisode</h4>";
        return "<div class='preCon'>
                    <img src ='$thumbnail' class='preImg' hidden>

                    <video autoplay muted class='preVid' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>

                    <div class='preOve'>
                        <div class='mainDtl'>
                            <h3>$name</h3>
                            $subHeading
                            <div class='buttons'>
                                <button onclick='watchVideo($videoId)'><i class='fas fa-play'></i>  $playButtonText</button>
                                <button onclick='volTog(this)'><i class='fas fa-volume-mute'></i></button>
                            </div>
                        </div>
                    </div>
                </div>";
    }

    public function createEntityPreviewSquare($entity)
    {
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
                    <div class='preCon small'>
                        <img src='$thumbnail' title='$name'>
                    </div>
                </a>";
    }

    private function getRdEntity()
    {
        // $query = $this -> con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        // $query-> execute();

        // $row = $query-> fetch(PDO::FETCH_ASSOC);

        // return new Entity($this->con, $row);
        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }
}
