<?php
namespace App\Core;
class BaseController {
    public function renderView($view, $data = []){
        extract($data);
        include __DIR__ . '/../views/' . $view . '.php';
    }
    public function loadTest(){
        include __DIR__ . '/../../test.php';
    }
}
