<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\lib\App;
use yii\jui\DatePicker;
use yii\captcha\Captcha;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Yii::$app->getUrlManager()->getBaseUrl() . '/plugins/select2/select2.min.css');

$fieldOptions2 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-3 col-md-3 col-sm-12 col-xs-12\">{label}</div><div class=\"col-lg-9 col-md-9 col-sm-9\">{input}{error}</div></div>"
];

if($customerModel->isNewRecord)
{
	$customerModel->gender = 'Male';
}
?>
<div class="container">
	<div class="row">
    	<div class="col-md-4 col-sm-12 col-xs-12">
            <div class="site-login">
                <h1><?php echo Html::encode($this->title); ?></h1>
            
                <div class="line"></div>
            
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label text-left'],
                    ],
                ]); ?>
            
                    <?php echo $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Enter your email address']); ?>
            
                    <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => 'Enter password']); ?>
            
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <?php echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>
                        </div>
                    </div>
            
                <?php ActiveForm::end(); ?>
            </div>
		</div>
        <div class="col-md-offset-1 col-md-7 col-sm-12 col-xs-12">
        	<div class="site-register">
                <h1>Register</h1>
            
                <div class="line"></div>
                
                <?php if (Yii::$app->session->hasFlash('registration-success')): ?>
                    <div class="clearfix"></div>
                    <div class="alert alert-success fullwidth-alert">
                        <h4><?php echo Yii::$app->session->getFlash('registration-success') ?></h4>
                    </div>
                <?php endif; ?>
            
                <?php $form = ActiveForm::begin([
                    'id' => 'register-form',
					'action'=> Yii::$app->urlManager->createUrl(['site/register']),
                ]); ?>
                
					<?php echo $form->field($customerModel, 'firstName', $fieldOptions2)->textInput(); ?>
            
                    <?php echo $form->field($customerModel, 'lastName', $fieldOptions2)->textInput(); ?>
                
                    <?php echo $form->field($customerModel, 'gender', $fieldOptions2)->radioList(App::getGenderAssoc()); ?>
                    <?php echo $form->field($customerModel, 'birthDay', $fieldOptions2)->widget(\yii\jui\DatePicker::classname(), ['dateFormat' => App::getDatePickerDateFormat(), 'options' => ['class' => 'form-control', 'style'=>'width:160px;'], 'clientOptions' => ['changeMonth' => true, 'changeYear' => true]]); ?>
                    
                    <?php echo $form->field($customerModel, 'schoolID', $fieldOptions2)->dropdownList(App::getSchoolAssoc(), ['class' => 'form-control school-select', 'prompt' => 'Select your school']); ?>
                    
                    <?php echo $form->field($customerModel, 'classID', $fieldOptions2)->dropdownList(App::getClassAssoc(), ['class' => 'form-control', 'prompt' => 'Select your class', 'style' => 'width:40%;']); ?>
                    
                    <?php echo $form->field($customerModel, 'emailAddress', $fieldOptions2)->textInput(); ?>
                
                    <?php echo $form->field($customerModel, 'phoneNumber', $fieldOptions2)->textInput(['class' => 'form-control only_integer', 'maxlength' => true]); ?>
                    
                     <?php echo $form->field($customerModel, 'password', $fieldOptions2)->passwordInput(); ?>
                
                     <?php echo $form->field($customerModel, 'confirmPassword', $fieldOptions2)->passwordInput(); ?>
                     
                     <?php echo $form->field($customerModel, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>
            
            		<div class="clearfix"></div>
                    
                    <?php if(Yii::$app->session->hasFlash('registration-error')): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Yii::$app->session->getFlash('registration-error'); ?>
                        </div>
                    </div>
                    <?php endif; ?>
            
                    <div class="form-group">
                        <div class="col-md-9 col-sm-12 col-xs-12 p--l-0 m--b-30">
                            <?php echo Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>
                        </div>
                    </div>
            
                <?php ActiveForm::end(); ?>
            </div>
        </div>
	</div>
</div>

<?php
$this->registerJs('
	$(".school-select").select2();
');
?>