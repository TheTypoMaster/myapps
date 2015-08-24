<?php
/* @var $this YearController */
/* @var $model Year */

$this->breadcrumbs=array(
	'You are about to manage Year',
);


?>
<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_year.JPG', "this is alt tag of image");
?>
</table>
</br>
<table>
	
		<td width="100"><i class="icon-plus"></i><a href="create"><b>ADD YEAR</b></a></td>
	</table>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'year-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'year_id',
		'year',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
