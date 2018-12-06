<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Customer;
use app\lib\App;
use app\lib\Core;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
			'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	/**
     * Display Register as Professional
     *
     * @return string
     */
    public function actionRegister()
    {
		$model = new Customer();
		$loginModel = new LoginForm();
		if ($model->load(Yii::$app->request->post()))
		{
			if($model->save())
			{
				if(strlen($model->customerID) == 1) { $customerCode = 'CUS0000'.$model->customerID; }
				elseif(strlen($model->customerID) == 2) { $customerCode = 'CUS000'.$model->customerID; }
				elseif(strlen($model->customerID) == 3) { $customerCode = 'CUS00'.$model->customerID; }
				elseif(strlen($model->customerID) == 4) { $customerCode = 'CUS0'.$model->customerID; }
				elseif(strlen($model->customerID) >= 5) { $customerCode = 'CUS'.$model->customerID; }
				
				Core::updateSingleRecord("cust_customer", "customerCode = '".$customerCode."'", "customerID = '".$model->customerID."'");
				
				//------------ Send email to customer -----------------#
				if(!empty($model->emailAddress))
				{
					$body = "Hi, ".$model->firstName."<br />";
					$body .= "Thank You for showing interest<br /><br /><br />";
					$body .= "Regards<br />";
					$body .= Yii::$app->name." Team";
					
					App::sendMail($model->emailAddress, Yii::$app->params['fromEmail'], Yii::$app->params['fromName'], 'Thank You for showing interest', $body, true);
				}
				
				//------------ Send email to admin -----------------#
				
				$birthDay = !empty($model->birthDay) ? App::getFormatedDate($model->birthDay, 'd/m/Y') : "---";
				
				$body = "<h2>Customer Registration</h2><br /><br />";
				$body .= "<strong>First Name : </strong>".$model->firstName."<br />";
				$body .= "<strong>Last Name : </strong>".$model->lastName."<br />";
				$body .= "<strong>Gender : </strong>".$model->gender."<br />";
				$body .= "<strong>Birth Day : </strong>".$birthDay."<br />";
				$body .= "<strong>School : </strong>".App::getSchoolName($model->schoolID)."<br />";
				$body .= "<strong>Class : </strong>".App::getClassAssoc()[$model->classID]."<br />";
				$body .= "<strong>Email Address : </strong>".$model->emailAddress."<br />";
				$body .= "<strong>Mobile : </strong>".$model->phoneNumber."<br />";
				$body .= "<strong>Professional ID : </strong>".$customerCode;
				
				App::sendMail(Yii::$app->params['adminEmail'], Yii::$app->params['fromEmail'], Yii::$app->params['fromName'], 'Customer Registration', $body, true);
				
				Yii::$app->session->setFlash('registration-success', 'Thank You for showing interest');
				
				return $this->redirect('login');
			}
			else
			{
				Yii::$app->session->setFlash('registration-error', Core::createErrorlist($model->getErrors()));
				
				return $this->render('login', [
					'model' => $loginModel,
					'customerModel' => $model,
				]);
			}
		}
		else
		{
        	return $this->render('login', [
				'model' => $loginModel,
				'customerModel' => $model,
			]);
		}
    }
	
	public function actionLogin()
    {
        $model = new LoginForm();
		$customerModel = new Customer();
		
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
			'customerModel' => $customerModel,
        ]);
    }
	
	public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->removeAll();
       
       	return $this->goHome();
    }
}
