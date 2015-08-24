<?php

/**
 * This is the model class for table "tbl_input".
 *
 * The followings are the available columns in table 'tbl_input':
 * @property integer $id
 * @property string $company_name
 * @property string $company_id
 * @property string $year_1
 * @property double $pro_1
 * @property double $intangible_1
 * @property double $development_1
 * @property double $invest_sub_1
 * @property double $invest_aso_1
 * @property double $other_1
 * @property double $total_1
 * @property double $tradeReceivable
 * @property double $otherReceivable
 * @property double $amountSubsidy
 * @property double $amountAssociated
 * @property double $fixedDeposit
 * @property double $cash_bank
 * @property double $total_2
 * @property double $otherPayable
 * @property double $amountOwnSubsidy
 * @property double $amountOwnDirect
 * @property double $purchasePayable
 * @property double $bankOverdraft
 * @property double $taxation
 * @property double $total_3
 * @property double $net_current_liabilities
 * @property double $shareCapital
 * @property double $sharePremium
 * @property double $preferenceShare
 * @property double $foreignExchange
 * @property double $AccLost
 * @property double $total_4
 * @property double $preferenceShare1
 * @property double $minorityInterest
 * @property double $total_5
 * @property double $purchasePayable1
 * @property double $taxLiabilities
 * @property double $total_6
 * @property double $revenue
 * @property double $other_operating_income
 * @property double $direct_operating_expenses
 * @property double $administration_expenses
 * @property double $finance_cost
 * @property double $shared_lossprofit
 * @property double $taxation_2
 * @property double $minority_shared
 */
class Input extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Input the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_input';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_name, company_id, year_1, pro_1, intangible_1, development_1, invest_sub_1, invest_aso_1, other_1, total_1, tradeReceivable, otherReceivable, amountSubsidy, amountAssociated, fixedDeposit, cash_bank, total_2, otherPayable, amountOwnSubsidy, amountOwnDirect, purchasePayable, bankOverdraft, taxation, total_3, net_current_liabilities, shareCapital, sharePremium, preferenceShare, foreignExchange, AccLost, total_4, preferenceShare1, minorityInterest, total_5, purchasePayable1, taxLiabilities, total_6, revenue, other_operating_income, direct_operating_expenses, administration_expenses, finance_cost, shared_lossprofit, taxation_2, minority_shared', 'required'),
			array('pro_1, intangible_1, development_1, invest_sub_1, invest_aso_1, other_1, total_1, tradeReceivable, otherReceivable, amountSubsidy, amountAssociated, fixedDeposit, cash_bank, total_2, otherPayable, amountOwnSubsidy, amountOwnDirect, purchasePayable, bankOverdraft, taxation, total_3, net_current_liabilities, shareCapital, sharePremium, preferenceShare, foreignExchange, AccLost, total_4, preferenceShare1, minorityInterest, total_5, purchasePayable1, taxLiabilities, total_6, revenue, other_operating_income, direct_operating_expenses, administration_expenses, finance_cost, shared_lossprofit, taxation_2, minority_shared', 'numerical'),
			array('company_name, company_id', 'length', 'max'=>45),
			array('year_1', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, company_name, company_id, year_1, pro_1, intangible_1, development_1, invest_sub_1, invest_aso_1, other_1, total_1, tradeReceivable, otherReceivable, amountSubsidy, amountAssociated, fixedDeposit, cash_bank, total_2, otherPayable, amountOwnSubsidy, amountOwnDirect, purchasePayable, bankOverdraft, taxation, total_3, net_current_liabilities, shareCapital, sharePremium, preferenceShare, foreignExchange, AccLost, total_4, preferenceShare1, minorityInterest, total_5, purchasePayable1, taxLiabilities, total_6, revenue, other_operating_income, direct_operating_expenses, administration_expenses, finance_cost, shared_lossprofit, taxation_2, minority_shared', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_name' => 'Company Name',
			'company_id' => 'Company',
			'year_1' => 'Year 1',
			'pro_1' => 'Pro 1',
			'intangible_1' => 'Intangible 1',
			'development_1' => 'Development 1',
			'invest_sub_1' => 'Invest Sub 1',
			'invest_aso_1' => 'Invest Aso 1',
			'other_1' => 'Other 1',
			'total_1' => 'Total 1',
			'tradeReceivable' => 'Trade Receivable',
			'otherReceivable' => 'Other Receivable',
			'amountSubsidy' => 'Amount Subsidy',
			'amountAssociated' => 'Amount Associated',
			'fixedDeposit' => 'Fixed Deposit',
			'cash_bank' => 'Cash Bank',
			'total_2' => 'Total 2',
			'otherPayable' => 'Other Payable',
			'amountOwnSubsidy' => 'Amount Own Subsidy',
			'amountOwnDirect' => 'Amount Own Direct',
			'purchasePayable' => 'Purchase Payable',
			'bankOverdraft' => 'Bank Overdraft',
			'taxation' => 'Taxation',
			'total_3' => 'Total 3',
			'net_current_liabilities' => 'Net Current Liabilities',
			'shareCapital' => 'Share Capital',
			'sharePremium' => 'Share Premium',
			'preferenceShare' => 'Preference Share',
			'foreignExchange' => 'Foreign Exchange',
			'AccLost' => 'Acc Lost',
			'total_4' => 'Total 4',
			'preferenceShare1' => 'Preference Share1',
			'minorityInterest' => 'Minority Interest',
			'total_5' => 'Total 5',
			'purchasePayable1' => 'Purchase Payable1',
			'taxLiabilities' => 'Tax Liabilities',
			'total_6' => 'Total 6',
			'revenue' => 'Revenue',
			'other_operating_income' => 'Other Operating Income',
			'direct_operating_expenses' => 'Direct Operating Expenses',
			'administration_expenses' => 'Administration Expenses',
			'finance_cost' => 'Finance Cost',
			'shared_lossprofit' => 'Shared Lossprofit',
			'taxation_2' => 'Taxation 2',
			'minority_shared' => 'Minority Shared',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('year_1',$this->year_1,true);
		$criteria->compare('pro_1',$this->pro_1);
		$criteria->compare('intangible_1',$this->intangible_1);
		$criteria->compare('development_1',$this->development_1);
		$criteria->compare('invest_sub_1',$this->invest_sub_1);
		$criteria->compare('invest_aso_1',$this->invest_aso_1);
		$criteria->compare('other_1',$this->other_1);
		$criteria->compare('total_1',$this->total_1);
		$criteria->compare('tradeReceivable',$this->tradeReceivable);
		$criteria->compare('otherReceivable',$this->otherReceivable);
		$criteria->compare('amountSubsidy',$this->amountSubsidy);
		$criteria->compare('amountAssociated',$this->amountAssociated);
		$criteria->compare('fixedDeposit',$this->fixedDeposit);
		$criteria->compare('cash_bank',$this->cash_bank);
		$criteria->compare('total_2',$this->total_2);
		$criteria->compare('otherPayable',$this->otherPayable);
		$criteria->compare('amountOwnSubsidy',$this->amountOwnSubsidy);
		$criteria->compare('amountOwnDirect',$this->amountOwnDirect);
		$criteria->compare('purchasePayable',$this->purchasePayable);
		$criteria->compare('bankOverdraft',$this->bankOverdraft);
		$criteria->compare('taxation',$this->taxation);
		$criteria->compare('total_3',$this->total_3);
		$criteria->compare('net_current_liabilities',$this->net_current_liabilities);
		$criteria->compare('shareCapital',$this->shareCapital);
		$criteria->compare('sharePremium',$this->sharePremium);
		$criteria->compare('preferenceShare',$this->preferenceShare);
		$criteria->compare('foreignExchange',$this->foreignExchange);
		$criteria->compare('AccLost',$this->AccLost);
		$criteria->compare('total_4',$this->total_4);
		$criteria->compare('preferenceShare1',$this->preferenceShare1);
		$criteria->compare('minorityInterest',$this->minorityInterest);
		$criteria->compare('total_5',$this->total_5);
		$criteria->compare('purchasePayable1',$this->purchasePayable1);
		$criteria->compare('taxLiabilities',$this->taxLiabilities);
		$criteria->compare('total_6',$this->total_6);
		$criteria->compare('revenue',$this->revenue);
		$criteria->compare('other_operating_income',$this->other_operating_income);
		$criteria->compare('direct_operating_expenses',$this->direct_operating_expenses);
		$criteria->compare('administration_expenses',$this->administration_expenses);
		$criteria->compare('finance_cost',$this->finance_cost);
		$criteria->compare('shared_lossprofit',$this->shared_lossprofit);
		$criteria->compare('taxation_2',$this->taxation_2);
		$criteria->compare('minority_shared',$this->minority_shared);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}