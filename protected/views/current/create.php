<?php
/* @var $this CurrentController */
/* @var $model Current */

$this->breadcrumbs=array(
	'Currents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Current', 'url'=>array('index')),
	array('label'=>'Manage Current', 'url'=>array('admin')),
);
?>

<h1>Current Asset</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>