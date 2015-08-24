<?php
/* @var $this GeneralController */
/* @var $model General */

$this->breadcrumbs=array(
	'Generals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List General', 'url'=>array('index')),
	array('label'=>'Manage General', 'url'=>array('admin')),
);
?>

<h1>Create General</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>