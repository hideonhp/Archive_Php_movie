<?php
class PreviewProvider {

    private $con, $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function createPreviewVideo($entity) {
        if ($entity==null){
            $entity = $this -> getRdEntity();
        }

        $id = $entity -> getId();
        $name = $entity -> getName();
        $preview = $entity -> getPreview();
        $thumbnail = $entity -> getThumbnail();
        
        return "<div class='preCon'>
                    <img src ='$thumbnail' class='preImg' hidden>

                    <video autoplay muted class='preVid' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>

                    <div class='preOve'>
                        <div class='mainDtl'>
                            <h3>$name</h3>

                            <div class='buttons'>
                                <button><i class='fas fa-play'></i>  Xem Ngay</button>
                                <button onclick='volTog(this)'><i class='fas fa-volume-mute'></button>
                            </div>
                        </div>
                    </div>
                </div>";
    }

    private function getRdEntity(){
        $query = $this -> con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query-> execute();

        $row = $query-> fetch(PDO::FETCH_ASSOC);
        
        return new Entity($this->con, $row);
    }

}
?>