<?php
/* @var $this InputController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Inputs',
);

$this->menu=array(
	array('label'=>'Create Input', 'url'=>array('create')),
	array('label'=>'Manage Input', 'url'=>array('admin')),
);
?>

<h1>Inputs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
