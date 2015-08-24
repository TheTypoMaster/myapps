<?php
/* @var $this InputController */
/* @var $model Input */

$this->breadcrumbs=array(
	'Inputs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Input', 'url'=>array('index')),
	array('label'=>'Create Input', 'url'=>array('create')),
	array('label'=>'Update Input', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Input', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Input', 'url'=>array('admin')),
);
?>

<h1>View Input #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_name',
		'company_id',
		'year_1',
		'pro_1',
		'intangible_1',
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
	),
)); ?>
