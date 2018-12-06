<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\ProfessionalCode;

/**
 * ProfessionalCodeSearch represents the model behind the search form about `app\modules\admin\models\ProfessionalCode`.
 */
class ProfessionalCodeSearch extends ProfessionalCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['professionalCodeID', 'isDeleted', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['professionCode', 'professionDesc', 'createdDatetime', 'modifiedDatetime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProfessionalCode::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort' => [
				'defaultOrder' => [
					'professionCode' => SORT_ASC,
				]
			]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'professionalCodeID' => $this->professionalCodeID,
            'isDeleted' => $this->isDeleted,
            'createdByUserID' => $this->createdByUserID,
            'createdDatetime' => $this->createdDatetime,
            'modifiedByUserID' => $this->modifiedByUserID,
            'modifiedDatetime' => $this->modifiedDatetime,
        ]);

        $query->andFilterWhere(['like', 'professionCode', $this->professionCode])
            ->andFilterWhere(['like', 'professionDesc', $this->professionDesc]);

        return $dataProvider;
    }
}
