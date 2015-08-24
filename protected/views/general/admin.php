<?php
/* @var $this GeneralController */
/* @var $model General */

$this->breadcrumbs=array(
	'Generals'=>array('index'),
	'Manage',
);

?>

<h1>Manage Generals</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'general-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'company_name',
		'company_id',
		'year',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
