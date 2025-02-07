<?php

namespace App\Controllers\front;

use App\Core\View;

class ClientController{
    public function renderHome($data = []) {
        View::render('home', $data);
    }
}