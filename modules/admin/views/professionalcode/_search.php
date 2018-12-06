<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProfessionalCodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="professional-code-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'professionalCodeID') ?>

    <?= $form->field($model, 'professionCode') ?>

    <?= $form->field($model, 'professionDesc') ?>

    <?= $form->field($model, 'isDeleted') ?>

    <?= $form->field($model, 'createdByUserID') ?>

    <?php // echo $form->field($model, 'createdDatetime') ?>

    <?php // echo $form->field($model, 'modifiedByUserID') ?>

    <?php // echo $form->field($model, 'modifiedDatetime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
