<?php
use yii\helpers\Html;
$this->title = 'Курс валют на '.$day;
$date = new DateTime($day);
$prevday = $date->modify('-1 day')->format('Y-m-d');
$nextday = $date->modify('+2 day')->format('Y-m-d');
?>
<h1>Курсы валют на <?=$day?></h1>
<a href="/basic/web/index.php?r=currency%2Fcurrency&date=<?=$prevday?>">Курс на <?=$prevday?></a> ---
<a href="/basic/web/index.php?r=currency%2Fcurrency&date=<?=$nextday?>">Курс на <?=$nextday?></a>
<br/>
<?php
foreach ($currency as $item){
foreach ($item as $key=>$value){
    echo $key.":".$value." ";
}
echo "<br/>";
}

?>


