<?php

namespace App\Controllers;


class Dashboard extends BaseController
{
    public function index()
    {
        $data = ['title' => 'MyAdmin - Dashboard']; 
        return view('pages/v_index', $data);
    }
}
