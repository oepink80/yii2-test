<?php


namespace app\models\Currency;

use yii\base\Model;

class Currency extends Model
{
      private $id;
      private $name;
      private $rate;

      public function getId($id){
          return $this->id;
      }

    public function getName($name){
        return $this->name;
    }

    public function getRate($id){
        return $this->rate;
    }
}