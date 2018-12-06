<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProfessionalCode */

$this->title = $model->professionCode;
$this->params['breadcrumbs'][] = ['label' => 'Professional Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="professional-code-view">
                <p>
                    <?php echo Html::a('Update', ['update', 'id' => $model->professionalCodeID], ['class' => 'btn btn-primary']) ?>
                    <?php echo Html::a('Delete', ['delete', 'id' => $model->professionalCodeID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            
                <?php echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'professionCode',
                        'professionDesc',
                        [
							'attribute' => 'isDeleted',
							'value' => ($model->isDeleted == 1) ? 'Yes' : 'No',
						],
                    ],
                ]) ?>
            
            </div>
		</div>
	</div>
</section>