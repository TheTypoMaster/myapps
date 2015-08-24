<?php
/* @var $this RegistrationController */
/* @var $model Registration */



$this->menu=array(
	array('label'=>'List Registration', 'url'=>array('index')),
	array('label'=>'Manage Registration', 'url'=>array('admin')),
);
?>

<table border="1" width="800">
<tr><th>
<img src="ban_general.jpg">
</th></tr>
</table>

<h1>Register Company Profile</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>