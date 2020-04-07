<?php


namespace app\controllers;

use app\models\Currency\CurrencyTable;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Currency\Currency;

class CurrencyController extends Controller
{
    private $currencyTable;

    public function actionCurrency($day=null)
    {
        $day = $_GET['date'] ?: date("Y-m-d");
        return $this->render('currency', ['currency' => $this->getCurrency($day), 'day'=>$day]);
    }

    public function getCurrency($day){
        $currencyTable = new CurrencyTable();
        return $currencyTable->getCurrencyList($day);
    }
}