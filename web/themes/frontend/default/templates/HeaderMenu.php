<?php
use yii\helpers\Html;
use app\lib\Core;

$loggedCustomerDetail = Core::getLoggedCustomer();
?>
<div class="header-outer">
    <nav class="navbar">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl;?>">
                    <?php echo Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/default/images/logo.png", ['alt' => '']);?>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="<?php echo Yii::$app->homeUrl;?>" class="<?php echo Core::getActiveClass(false, 'site', 'index'); ?>">Home</a></li>
                </ul>
                
                <?php if(Yii::$app->user->isGuest){ ?>
                    <ul class="nav navbar-nav navbar-right user-action">
                        <li><?php echo Html::a('Login',['/login'], ['class' => Core::getActiveClass(false, 'site', 'login')]);?></li>
                        <li class="separater">|</li>
                        <li><?php echo Html::a('Register',['/register'], ['class' => Core::getActiveClass(false, 'site', 'register')]);?></li>
                    </ul>
                <?php }else{ ?>
                	<ul class="nav navbar-nav navbar-right logged-user-action">
                        <li id="fat-menu" class="dropdown">
                            <a href="#" class="dropdown-toggle" id="drop3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <?php echo $loggedCustomerDetail->firstName; ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu user-action-menu" aria-labelledby="drop3">
                                <li><?php echo Html::a('<span class="fa fa-user text-orange m--r-10"></span> My Profile',['/customer/profile'], ['class' => Core::getActiveClass(false, 'customer', 'profile')]);?></li>
                                <li role="separator" class="divider"></li>
                                <li><?php echo Html::a('<span class="fa fa-th-list text-orange m--r-10"></span> Transaction Details',['/order/'], ['class' => Core::getActiveClass(false, 'order', 'index')]);?></li>
                                <li role="separator" class="divider"></li>
                                <li><?php echo Html::a('<span class="fa fa-book text-orange m--r-10"></span> Order Text Book',['/order/create'], ['class' => Core::getActiveClass(false, 'order', 'create')]);?></li>
                                <li role="separator" class="divider"></li>
                                <li><?php echo Html::a('<span class="fa fa-key text-orange m--r-10"></span> Change Password',['/customer/changepassword'], ['class' => Core::getActiveClass(false, 'customer', 'changepassword')]);?></li>
                                <li role="separator" class="divider"></li>
                                <li><?php echo Html::a('<span class="fa fa-power-off text-orange m--r-10"></span> Logout',['/logout'], ['class' => Core::getActiveClass(false, 'site', 'logout')]);?></li>
                            </ul>
                        </li>
                        <li>
							<?php
                            	$totalItemsInCart = 0;
								$cartBadge = ($totalItemsInCart > 0) ? '<span class="fa fa-shopping-cart position-relative"><span class="badge cart-badge">'.$totalItemsInCart.'</span></span>' : '<span class="fa fa-shopping-cart position-relative"></span>';
								echo Html::a($cartBadge.' Cart',['/cart/index'], ['class' => Core::getActiveClass(false, 'cart', 'index')]);
							?>
                        </li>
                    </ul>
                <?php } ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>
<div class="clear"></div> 