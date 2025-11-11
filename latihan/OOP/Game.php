<?php 
require_once "Produk.php";
require_once "Komik.php";

class Game extends Produk {
  public $waktuMain;

  public function __construct($judul, $penulis, $penerbit, $harga, $waktuMain) {
    parent::__construct($judul, $penulis, $penerbit, $harga);
    $this -> waktuMain = $waktuMain;
  }

  public function getInfoProduk() {
    $str = "Game : ". parent::getLabel() . "| (Rp. ". $this -> harga. ") - ($this -> waktuMain) Jam.";
    return $str;
  }
}

$produk1 = new Game ("The Witcher 1", "CD Projek Red","CD Project", 30000, 100);
  $produk2 = new Game ("Naruto", "Masashi Kishimoto","Shoomen Jump", 20000, 250);

  echo $produk1 -> getInfoProduk();
  echo "<br>";
  echo $produk2 -> getInfoProduk();
?>