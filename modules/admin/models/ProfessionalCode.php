<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\Core;
use app\lib\App;

/**
 * This is the model class for table "professional_code".
 *
 * @property string $professionalCodeID
 * @property string $professionCode
 * @property string $professionDesc
 * @property integer $isDeleted
 * @property string $createdByUserID
 * @property string $createdDatetime
 * @property string $modifiedByUserID
 * @property string $modifiedDatetime
 */
class ProfessionalCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'professional_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['professionCode', 'professionDesc'], 'required'],
            [['isDeleted', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['createdDatetime', 'modifiedDatetime', 'createdByUserID', 'modifiedByUserID'], 'safe'],
            [['professionCode'], 'string', 'max' => 3],
            [['professionDesc'], 'string', 'max' => 25],
            [['professionCode'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'professionalCodeID' => 'Professional Code ID',
            'professionCode' => 'Profession Code',
            'professionDesc' => 'Profession Desc',
            'isDeleted' => 'Is Deleted',
            'createdByUserID' => 'Created By User ID',
            'createdDatetime' => 'Created Datetime',
            'modifiedByUserID' => 'Modified By User ID',
            'modifiedDatetime' => 'Modified Datetime',
        ];
    }
	
	public function beforeSave($insert)
	{
		$loggedUserDetails = Core::getLoggedUser();
        $loggedUserID = (int) $loggedUserDetails->userID;
		
		$this->professionCode = strtoupper($this->professionCode);
        
        if($this->isNewRecord) 
        {
            $this->modifiedByUserID = 0;
            $this->createdByUserID = $loggedUserID;
        }
        else 
        {
            $this->modifiedByUserID = $loggedUserID;
            $this->modifiedDatetime = App::getCurrentDateTime();
        }
        return true;
	}
}
