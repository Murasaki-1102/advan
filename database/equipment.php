<?php

class equipment {

  protected $maker;
  protected $name;
  protected $category;
  protected $subCategory;
  protected $comment;
  protected $stock;
  protected $img1;
  protected $img2;
  protected $img3;
  protected $weight;
  protected $power;
  protected $date;

  public function __construct($maker,$name,$category,$subCategory,$comment,$stock,$img1,$img2,$img3,$weight,$power,$date){
    $this->maker = $maker;
    $this->name = $name;
    $this->category = $category;
    $this->subCategory = $subCategory;
    $this->comment = $comment;
    $this->stock = $stock;
    $this->img1 = $img1;
    $this->img2 = $img2;
    $this->img3 = $img3;
    $this->weight = $weight;
    $this->power = $power;
    $this->date = $date;


  }

  public function getMaker() {
    return $this->maker;
  }
  public function getName(){
    return $this->name;
  }
  public function getCategory(){
    return $this->category;
  }
  public function getSubCategory(){
    return $this->subCategory;
  }
  public function getComment(){
    return $this->comment;
  }
  public function getStock(){
    return $this->stock;
  }
  public function getImg1(){
    return $this->img1;
  }
  public function getImg2(){
    return $this->img2;
  }
  public function getImg3(){
    return $this->img3;
  }
  public function getWeight(){
    return $this->weight;
  }
  public function getPower(){
    return $this->power;
  }
  public function getDate(){
    return $this->date;
  }

  public static function findByName($equipments,$name) {
    foreach($equipments as $equipment) {
      if($equipment->getName() == $name) {
        return $equipment;
      }
    }
  }

}

?>
