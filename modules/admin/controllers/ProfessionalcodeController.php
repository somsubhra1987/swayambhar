<?php

namespace app\modules\admin\controllers;

use Yii;
use app\lib\App;
use app\modules\admin\models\ProfessionalCode;
use app\modules\admin\models\ProfessionalCodeSearch;
use app\modules\admin\ControllerAdmin;
use yii\web\NotFoundHttpException;

/**
 * ProfessionalcodeController implements the CRUD actions for ProfessionalCode model.
 */
class ProfessionalcodeController extends ControllerAdmin
{
    /**
     * Lists all ProfessionalCode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfessionalCodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProfessionalCode model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProfessionalCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProfessionalCode();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->professionalCodeID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProfessionalCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->professionalCodeID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProfessionalCode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$model = $this->findModel($id);
        if(App::checkDataInUse(array(['tableName' => 'professional_user_code', 'fieldName' => 'professionalUserCodeID', 'condDataArr' => array('professionCode' => $model->professionCode)])) == 0)
		{
			$model->delete();
			
			Yii::$app->session->setFlash('success', 'Deleted Successfully');
		}
		else
		{
			Yii::$app->session->setFlash('error', 'This code is already in use');
		}

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProfessionalCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProfessionalCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfessionalCode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
