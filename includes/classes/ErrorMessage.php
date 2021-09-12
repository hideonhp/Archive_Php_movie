<?php
class ErrorMessage {
    public static function show($text) {
        exit("<span class='errBanner'>$text</span>");
    }
}
?>