<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProfessionalCode */
/* @var $form yii\widgets\ActiveForm */

$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}{error}</div></div>"
];
?>

<div class="professional-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'professionCode', $fieldOptions1)->textInput(['maxlength' => true, 'autofocus' => 'autofocus', 'style' => 'text-transform:uppercase;']) ?>

    <?php echo $form->field($model, 'professionDesc', $fieldOptions1)->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
