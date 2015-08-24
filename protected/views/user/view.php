<?php
/* @var $this UserController */
/* @var $model User */
$this->pageTitle=Yii::app()->name . ' Profile';
$this->breadcrumbs=array(
	'You are viewing Profile.',
);
$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<table border="1" width="800">
<?php
echo CHtml::image(Yii::app()->request->baseUrl.'/images/ban_profile.JPG', "this is alt tag of image");
?>
</table>

<h1 class="label">User Profile: <?php echo $model->username; ?></h1>

<a href="update/<?php echo $model->id; ?>" > <h1 class="label">Update Profile</h1></a>

<table border="0" align='center'>
	<tr>
		<td align="center"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/avatar/'.$model->avatar, "this is alt tag of image", array('width'=>'100', 'height'=>'100')); ?></td>
	</tr>
<table>

	</br>
	
<table align="center">	
	<tr>
		<td width="200" class="breadcrumb">
			<b>Username</b>
		</td>
		<td>
			: <?php echo $model->username; ?></td>
		</td>
	</tr>
	
	<tr>
		<td></td>
	</tr>
	
	<tr>
		<td class="breadcrumb">
			<b>Email</b>
		</td>
		<td>
			: <?php echo $model->email; ?></td>
		</td>
	</tr>
	
	<tr>
		<td></td>
	</tr>
	
	<tr>
		<td class="breadcrumb">
			<b>Registration Date</b>
		</td>
		<td>
			: <?php echo $model->joinDate; ?></td>
		</td>
	</tr>
	
	<tr>
		<td></td>
	</tr>
	
	<tr>
		<td class="breadcrumb">
			<b>Level ID</b>
		</td>
		<td>
			: <?php echo $model->level_id; ?></td>
		</td>
	</tr>
</table>


</br>
<!--
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'saltPassword',
		'email',
		'joinDate',
		'level_id',
		array(
			'label'=>'Avatar',
			'type'=>'raw',
			'value'=>CHtml::image('a/../avatar/'.$model->avatar,'DORE', array("width"=>100)),
		),
	),
)); ?>   -->