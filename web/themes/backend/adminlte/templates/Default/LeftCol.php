<?php
use app\lib\Core;
use app\lib\App;
use yii\bootstrap\ActiveForm;

$loginUserDetail = Core::getLoggedUser();
?>
<aside class="main-sidebar">
	<section class="sidebar">
	  	<ul class="sidebar-menu">
            <li class="<?php echo Core::getActiveClass(false, 'dashboard'); ?> treeview">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/admin/dashboard']) ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
	    	
	    	<li class="<?php echo Core::getActiveClass('basic', 'experttype'); ?> treeview">
          		<a href="#">
            		<i class="fa fa-cog"></i> <span>Master Setup</span>
        			<span class="pull-right-container">
          				<i class="fa fa-angle-left pull-right"></i>
        			</span>
          		</a>
          		<ul class="treeview-menu extra_margin">
            		<li class="<?php echo Core::getActiveClass('basic', 'professionalcode'); ?>"><a href="<?php echo Yii::$app->urlManager->createUrl(['/admin/professionalcode']) ?>"><i class="fa fa-circle-o"></i> Professional Code </a></li>
          		</ul>
        	</li>
            
            <li class="<?php echo Core::getActiveClass(false, 'professional', 'index'); ?> treeview">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/admin/professional']) ?>">
                    <i class="fa fa-money"></i> <span>Professional Users</span>
                </a>
            </li>
	 	</ul>
	</section>
</aside>