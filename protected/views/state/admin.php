<?php
/* @var $this StateController */
/* @var $model State */

$this->breadcrumbs=array(
	'You are about to manage State',
);

?>

<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_state.JPG', "this is alt tag of image");
?>
</table>
</br>
<table>
	
		<td width="100"><i class="icon-plus"></i><a href="create"><b>ADD STATE</b></a></td>
	</table>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'state-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'state_id',
		'state',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
