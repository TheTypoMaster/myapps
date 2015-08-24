<?php
/* @var $this GeneralController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Generals',
);

$this->menu=array(
	array('label'=>'Create General', 'url'=>array('create')),
	array('label'=>'Manage General', 'url'=>array('admin')),
);
?>

<h1>Generals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
