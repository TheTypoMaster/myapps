<?php
$this->breadcrumbs=array(
	'You are about to manage Client/Company'
);

/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#general-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");	*/
?>

<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_client.JPG', "this is alt tag of image");
?>
</table>
</br>

<h4 class="label"><?php echo $model->company_name; ?>  company has been updated.</h4>
<a href="//"><h4 class="label">Ok</h4></a>

</br>
</br>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'company_name',
		'company_id',
		'company_email',
		'address',
		'postcode',
		'city',
		'state_id',
		'no_tel',
	),
)); ?>
