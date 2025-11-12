<?php

class About extends Controller
{
  public function index($nama = 'Car', $pekerjaan = 'Explode', $umur = '999')
  {
    $data['judul'] = 'About';
    $data['nama'] = $nama;
    $data['pekerjaan'] = $pekerjaan;
    $data['umur'] = $umur;
    $this->view('templates/header', $data);
    $this->view('About/index', $data);
    $this->view('templates/footer');
  }

  public function page()
  {
    $data['judul'] = 'Page';
    $this->view('templates/header', $data);
    $this->view('About/page');
    $this->view('templates/footer');
  }
}
