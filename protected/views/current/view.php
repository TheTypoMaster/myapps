<?php
/* @var $this CurrentController */
/* @var $model Current */

$this->breadcrumbs=array(
	'Currents'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Current', 'url'=>array('index')),
	array('label'=>'Create Current', 'url'=>array('create')),
	array('label'=>'Update Current', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Current', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Current', 'url'=>array('admin')),
);
?>

<h1>View Current #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tradeReceive',
		'otherReceive',
		'amountSub',
		'amountAssc',
		'fixedDeposit',
		'cash_bank',
		'total_2',
	),
)); ?>
