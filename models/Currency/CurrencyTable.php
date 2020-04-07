<?php

namespace app\models\Currency;

use yii\db\ActiveRecord;

class CurrencyTable extends ActiveRecord
{
    protected function fetchById(int $currencyId)
    {
        /** @var Currency $result */
        $result = $this::find($currencyId);
        return $result;
    }

    public function getCurrencyList($day){
        $result = $this::find()
            ->where(['date' => $day])
            ->asArray()
            ->all();
        if (!$result) return false;
        return $result;
    }

    public function updateCurrency(){
        $date = date("Y-m-d");
        $CBR = new CBR();
        $currencyList = $CBR->getCurrency();
        foreach ($currencyList as $key => $rate){
            $result = $this::find()
                ->where(['date' => $date, 'name' => $key])
                ->all();
            if (empty($result)){
                $currency = new CurrencyTable();
                $currency->name = $key;
                $currency->rate = $rate;
                $currency->date = $date;
                $currency ->save();
            }
        }
        return 'Currency updated';
    }
}