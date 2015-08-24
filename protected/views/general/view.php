<?php
/* @var $this GeneralController */
/* @var $model General */

$this->breadcrumbs=array(
	'Generals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List General', 'url'=>array('index')),
	
	array('label'=>'Update General', 'url'=>array('update', 'id'=>$model->id)),
	
);
?>

<h1>View General #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_name',
		'company_id',
		'year',
	),
)); ?>
<table class="detail-view" id="yw0">
<?php foreach ($items as $item): ?>
    <tr class="odd">
        <td width="70%"><?php echo "<label>".$item['name']."</label>"?></td>
        <td width="30%"><?php echo "<label>".$item['value']."</label>"?></td>
   </tr>
<?php endforeach; ?>
</table>
