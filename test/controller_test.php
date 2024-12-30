<?php

class amirali {
    public function howRegesWork(string $text = "/TEST") {
        // include "../index.php";
        // include "../controller/Main_Controller.php";

        $new = new Core\App();
        var_dump($new->check_validity($text));
    }
}

// var_dump((new amirali())->howRegesWork());