<?php
/* @var $this YearController */
/* @var $model Year */

$this->breadcrumbs=array(
	'Years'=>array('index'),
	$model->year_id,
);

$this->menu=array(
	array('label'=>'List Year', 'url'=>array('index')),
	array('label'=>'Create Year', 'url'=>array('create')),
	array('label'=>'Update Year', 'url'=>array('update', 'id'=>$model->year_id)),
	array('label'=>'Delete Year', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->year_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Year', 'url'=>array('admin')),
);
?>

<h1>View Year #<?php echo $model->year_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'year_id',
		'year',
	),
)); ?>
