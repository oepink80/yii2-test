<?php


namespace app\models\Currency;

use CBRException;
use yii\base\Model;
use yii\base\Exception;

class CBR extends Model
{
    private $url = "http://www.cbr.ru/scripts/XML_daily.asp";
    private $allCurrency    = [];

    public function getCurrency(){

        $xml = $this->getHttpRequest($this->url);
        if (!$xml) throw new CBRException("Not correct XML");
        foreach ($xml->Valute as $val) {
            $attr = $val->attributes();
            $value = str_replace(',', '.', $val->Value) / $val->Nominal;
            $this->allCurrency[current($val->CharCode)] = $value;
        }

        if (empty($this->allCurrency))
            throw new CBRFException('No loaded data');
        return $this->allCurrency;
    }

    private function getHttpRequest($url){
        $i = 0;
        while($i++ < 5){
            if (function_exists("curl_init")) {
                $curl   = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curl);
                curl_close($curl);
            } else {
                $result = file_get_contents($url);
            }
            if($result){
                break;
            }
            sleep(1);
        }

        $xml = simplexml_load_string($result);

        if (!$xml) {
            throw new CBRException("getHttpRequest is broken: " . $url);
        }

        return $xml;
    }
}
