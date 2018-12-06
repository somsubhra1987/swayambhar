<?php
use yii\helpers\Html;
use app\lib\Core;

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="">
    
    <div class="container">
        <div>
        	<?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/default/images/Bookstore.jpg", ['alt' => '']);?>
        </div>
    </div>
</div>