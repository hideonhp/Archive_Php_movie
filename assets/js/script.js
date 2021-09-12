function volTog(button){
     var muted = $(".preVid").prop("muted");
     $(".preVid").prop("muted", !muted);

     $(button).find("i").toggleClass("fa-volume-mute");
     $(button).find("i").toggleClass("fa-volume-up");
}

function previewEnded() {
     $(".preVid").toggle();
     $(".preImg").toggle();
 }