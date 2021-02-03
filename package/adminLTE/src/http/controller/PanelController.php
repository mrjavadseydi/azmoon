<?php


namespace MrjavadSeydi\AdminLTE\http\controller;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index()
    {
        return sview('index');
    }
}
