<?php
class HomeController extends Controller
{
    // GET / atau /home : beranda (landing page)
    public function index()
    {
        $this->view('home/index', [
            'title'     => 'Beranda',
            'bodyClass' => 'home-page',
            'summary'   => (new Order())->countByStatus(),
        ]);
    }
}
