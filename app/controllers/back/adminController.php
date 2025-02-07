<?php

namespace App\Controllers\back;

use App\Core\View;

class adminController{
    public function renderDashboard($data = []) {
        View::render('Dashboard', $data);
    }
}