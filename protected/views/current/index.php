<?php
/* @var $this CurrentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Currents',
);

$this->menu=array(
	array('label'=>'Create Current', 'url'=>array('create')),
	array('label'=>'Manage Current', 'url'=>array('admin')),
);
?>

<h1>Currents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
