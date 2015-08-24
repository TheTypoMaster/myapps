<?php
/* @var $this InputController */
/* @var $model Input */

$this->breadcrumbs=array(
	'Inputs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Input', 'url'=>array('index')),
	array('label'=>'Create Input', 'url'=>array('create')),
	array('label'=>'View Input', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Input', 'url'=>array('admin')),
);
?>

<h1>Update Input <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>