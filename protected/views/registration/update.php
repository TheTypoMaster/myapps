


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

<h4 class="label">Update : <?php echo $model->company_name; ?></h4>
<a href="../select_create"><h4 class="label">Cancel</h4></a>
</br>
</br>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>