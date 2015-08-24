
<?php
$this->breadcrumbs=array(
	'You are about to manage Admin/Officer'
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
");  */
?>

<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_profile.JPG', "this is alt tag of image");
?>
</table>

</br>

<h4 class="label">Update Profile : <?php echo $model->username; ?></h4>
<a href="../<?php echo $model->id; ?>"><h4 class="label">Cancel</h4></a>
</br>
</br>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>