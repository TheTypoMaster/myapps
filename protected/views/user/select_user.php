<?php $this->pageTitle=Yii::app()->name; ?>


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
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_admin.JPG', "this is alt tag of image");
?>
</table>

</br>


<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab"> <i class="icon-folder-close"></i>Create New User</a></li>
    <li><a href="#tab2" data-toggle="tab"><i class="icon-wrench"></i>Manage Users</a></li>
	
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">

    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

    <table>
    	<tr>
    		<td></td>
    	</tr>
    </table>
     
    </div>
	
	    <div class="tab-pane" id="tab2">

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		//'password',
		//'saltPassword',
		'email',
		'joinDate',
		/*
		'level_id',
		'avatar',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>




</div>

</div>
</div>

	