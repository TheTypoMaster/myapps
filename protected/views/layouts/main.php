


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- <?php echo Yii::app()->bootstrap->register();?> -->
	<?php Yii::app()->bootstrap->register(); ?>

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

<!--
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->  

-->
</br></br>

	<div id="mainMbMenu">
	      <?php $this->widget('bootstrap.widgets.TbNavbar', array(
	'type'=>'inverse', // null or 'inverse'
	'brand'=>'CAD SYSTEM',
	'brandUrl'=>array('//'),
	'collapse'=>true, // requires bootstrap-responsive.css
	'items'=>array(
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'items'=>array(
		/*		array('label'=>'Home', 'url'=>array('//'), /*'active'=>true),*/
				
				
				
			//	array('label'=>'Income Statemet', 'url'=>array('/general/incomeStatement/1')),
				
			
/*			array('label'=>'Insert', 'url'=>'#', 'items'=>array(
					array('label'=>'General Ledger', 'url'=>array('/general/create')),
					array('label'=>'Another action', 'url'=>'#'),
					array('label'=>'Something else here', 'url'=>'#'),
					'---',
					array('label'=>'NAV HEADER'),
					array('label'=>'Separated link', 'url'=>'#'),
					array('label'=>'One more separated link', 'url'=>'#'),
				)), */
			),
		),
		//'<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(
				
					
			//	array('label'=>'Home', 'url'=>array('//'),'visible'=>!Yii::app()->user->isGuest), //yang nie Home - kena login juga
			
			//		array('label'=>'Home', 'url'=>array('//'),'visible'=>!Yii::app()->user->isGuest), //yang nie Home - kena login juga
					
					array('label'=>'Maintenance', 'url'=>'#','visible'=>!Yii::app()->user->isGuest, 'items'=>array(
					array('label'=>'Compose Email', 'url'=>array('site/contact')),
					array('label'=>'Inbox', 'url'=>array('message/inbox')),
					array('label'=>'*Manage Year', 'url'=>array('year/admin')),
					array('label'=>'*Manage State', 'url'=>array('state/admin')),
				)), //yang nie untuk message kalau dah login jer
				
				
				'---',
				array('label'=>'Account', 'url'=>'#', 'items'=>array(
				//	array('label'=>'New Account', 'url'=>array('/user/create'),'visible'=>Yii::app()->user->isGuest),
					array('label'=>'My Profile', 'url'=>array('/user/view','id'=>Yii::app()->user->id),'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'*New Account', 'url'=>array('/user/select_user','id'=>Yii::app()->user->id),'visible'=>!Yii::app()->user->isGuest),
					'---',
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				)),
			),
		),
	),
)); ?>



	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	
	

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> CADS<br/>
		Creative Accounting Detection System<br/>
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>