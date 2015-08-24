<?php
/* @var $this GeneralController */
/* @var $model General */

$this->breadcrumbs=array(
	'Generals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List General', 'url'=>array('index')),

	array('label'=>'View General', 'url'=>array('view', 'id'=>$model->id)),
	
);
?>

<h1>Update General <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'items'=>$items)); ?>