<?php
/* @var $this InputController */
/* @var $model Input */

$this->breadcrumbs=array(
	'Inputs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Input', 'url'=>array('index')),
	array('label'=>'Create Input', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#input-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Inputs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'input-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'company_name',
		'company_id',
		'year_1',
		'pro_1',
		'intangible_1',
		/*
		'development_1',
		'invest_sub_1',
		'invest_aso_1',
		'other_1',
		'total_1',
		'tradeReceivable',
		'otherReceivable',
		'amountSubsidy',
		'amountAssociated',
		'fixedDeposit',
		'cash_bank',
		'total_2',
		'otherPayable',
		'amountOwnSubsidy',
		'amountOwnDirect',
		'purchasePayable',
		'bankOverdraft',
		'taxation',
		'total_3',
		'net_current_liabilities',
		'shareCapital',
		'sharePremium',
		'preferenceShare',
		'foreignExchange',
		'AccLost',
		'total_4',
		'preferenceShare1',
		'minorityInterest',
		'total_5',
		'purchasePayable1',
		'taxLiabilities',
		'total_6',
		'revenue',
		'other_operating_income',
		'direct_operating_expenses',
		'administration_expenses',
		'finance_cost',
		'shared_lossprofit',
		'taxation_2',
		'minority_shared',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
