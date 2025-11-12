<?php
class Produk
{
  public $judul;
  public $penulis;
  public $penerbit;
  public $harga;

  public function __construct($judul, $penulis, $penerbit, $harga)
  {
    $this->harga = $harga;
    $this->harga = $harga;
    $this->harga = $harga;
    $this->harga = $harga;
  }

  public function getLabel()
  {
    return "$this ->penulis =, $this -> penerbit";
  }
}
