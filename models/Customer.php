<?php

namespace app\models;

use Yii;
use app\lib\App;
use app\lib\Core;

/**
 * This is the model class for table "cust_customer".
 *
 * @property string $customerID
 * @property string $customerCode
 * @property string $firstName
 * @property string $lastName
 * @property string $gender
 * @property string $birthDay
 * @property string $schoolID
 * @property string $classID
 * @property string $phoneNumber
 * @property string $emailAddress
 * @property string $password
 * @property string $registrationDate
 * @property string $accountType
 * @property string $lastLoginTime
 * @property integer $isActive
 * @property string $createdByAdminUserID
 * @property string $createdDatetime
 * @property string $modifiedByAdminUserID
 * @property string $modifiedDatetime
 */
class Customer extends \yii\db\ActiveRecord
{
	public $confirmPassword;
	public $verifyCode;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cust_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'schoolID', 'classID', 'phoneNumber', 'emailAddress', 'password', 'confirmPassword'], 'required'],
            [['birthDay', 'registrationDate', 'lastLoginTime', 'createdDatetime', 'modifiedDatetime', 'confirmPassword', 'verificationOTP', 'verificationOTPSentAt', 'customerCode'], 'safe'],
            [['schoolID', 'classID', 'isMobileVerified', 'isActive', 'createdByAdminUserID', 'modifiedByAdminUserID'], 'integer'],
            [['customerCode', 'gender', 'accountType'], 'string', 'max' => 10],
            [['firstName', 'lastName'], 'string', 'max' => 50],
            [['phoneNumber'], 'string', 'max' => 13],
            [['emailAddress'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
            [['emailAddress'], 'unique'],
			[['emailAddress'], 'email'],
            [['phoneNumber'], 'unique'],
			[['confirmPassword'], 'compare', 'compareAttribute' => 'password'],
			['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customerID' => 'Customer ID',
            'customerCode' => 'Customer Code',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'gender' => 'Gender',
            'birthDay' => 'Date of Birth',
            'schoolID' => 'School',
            'classID' => 'Class',
            'phoneNumber' => 'Mobile',
            'emailAddress' => 'Email',
            'password' => 'Password',
            'registrationDate' => 'Registration Date',
            'accountType' => 'Account Type',
            'lastLoginTime' => 'Last Login Time',
            'isActive' => 'Is Active',
            'createdByAdminUserID' => 'Created By Admin User ID',
            'createdDatetime' => 'Created Datetime',
            'modifiedByAdminUserID' => 'Modified By Admin User ID',
            'modifiedDatetime' => 'Modified Datetime',
			'verifyCode' => 'Verification Code',
        ];
    }
	
	public function beforeSave($insert)
    {
		$this->isActive = (int) $this->isActive;
		$this->isMobileVerified = (int) $this->isMobileVerified;
		
		$loggedUserID = (int) Core::getLoggedUserID();
        if($this->isNewRecord) 
        {
            $this->modifiedByAdminUserID = 0;
            $this->createdByAdminUserID = $loggedUserID;
			$this->password = md5($this->confirmPassword);
			$this->registrationDate =App::getCurrentDateTime();
			$this->verificationOTP = App::generateOTP();
			$this->verificationOTPSentAt = App::getCurrentDatetime();
        }
        else 
        {
            $this->modifiedByAdminUserID = $loggedUserID;
            $this->modifiedDatetime =App::getCurrentDateTime();
        }
        return true;
    }
}
