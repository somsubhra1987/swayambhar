<?php

namespace app\controllers;

use app\lib\UserParentController;

class OrderController extends UserParentController
{
    public function actionCreate()
    {
        return $this->render('create');
    }

}
