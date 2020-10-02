<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Belajar Ci4',
            'tes' => ['satu', 'dua', 'tiga'],
        ];
        return view('Pages/Home', $data);
    }
}
