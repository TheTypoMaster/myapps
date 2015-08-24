<?php
/* @var $this CurrentController */
/* @var $model Current */

$this->breadcrumbs=array(
	'Currents'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Current', 'url'=>array('index')),
	array('label'=>'Create Current', 'url'=>array('create')),
	array('label'=>'View Current', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Current', 'url'=>array('admin')),
);
?>

<h1>Update Current <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>