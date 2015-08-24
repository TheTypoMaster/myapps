<?php
/* @var $this InputController */
/* @var $model Input */

$this->breadcrumbs=array(
	'Inputs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Input', 'url'=>array('index')),
	array('label'=>'Manage Input', 'url'=>array('admin')),
);
?>

<h1>Create Input</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>