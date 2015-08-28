<?php


class ReportController extends Controller
{
    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index',''),
				'users'=>array('*'),
			),
			
		);
	}
    
	public function actionIndex()
	{
            if(isset($_REQUEST['report_company_id']))
            {
                
                $company_id=$_REQUEST['report_company_id'];
                $company_name = $_REQUEST['company_name'];
                
                $years = Yii::app()->db->createCommand("
                                    select `year` 
                                    from tbl_item_value 
                                    where `company_id` ='".$company_id."' 
                                    group by `year`")->queryAll();
                
               $total_current_assets = Yii::app()->db->createCommand("
                                    select sum(IV.value) as sum,IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.category = 'CURRENT ASSETS' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $total_non_current_assets = Yii::app()->db->createCommand("
                                    select sum(IV.value) as sum, IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.category = 'NON CURRENT ASSET' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $total_current_liabilities = Yii::app()->db->createCommand("
                                    select sum(IV.value) as sum, IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.category = 'CURRENT LIABILITIES' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $total_non_current_liabilities = Yii::app()->db->createCommand("
                                    select sum(IV.value) as sum, IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.category = 'NON-CURRENT LIABILITIES' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $share_hoder_fund =Yii::app()->db->createCommand("
                                    select sum(IV.value) as sum, IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.category = 'FINANCED BY / EQUITY'
                                    and I.name not like '%minority interest%'
                                    and I.name not like '%Preference Shares for Shareholders Equity%'
                                    order by I.id, IV.year ")->queryAll();
                
               $share_hoder_equity =Yii::app()->db->createCommand("
                                    select sum(IV.value) as sum, IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.category = 'FINANCED BY / EQUITY' 
                                    order by I.id, IV.year ")->queryAll();
                
               $revenue =Yii::app()->db->createCommand("
                                    select IV.value ,IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.name = 'Revenue' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $total_other_income =Yii::app()->db->createCommand("
                                    select sum(IV.value) as sum, IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.category = 'OTHER INCOME' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $total_expense =Yii::app()->db->createCommand("
                                    select sum(IV.value) as sum, IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.category = 'EXPENSES' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $finance_cost =Yii::app()->db->createCommand("
                                    select sum(IV.value) as sum, IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."'
                                    and I.category = 'EXPENSES' 
                                    and I.name like '%finance%' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $share_of_profit_in_asociated_company =Yii::app()->db->createCommand("
                                    select IV.value,IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.name = 'Share of (Loss) Profit in an Associated Company' 
                                    group by IV.year order by IV.year")->queryAll();
                
               $taxation =Yii::app()->db->createCommand("
                                    select IV.value,IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.name = 'Share of (Loss) Profit in an Associated Company' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
               $share_capital = Yii::app()->db->createCommand("
                                    select IV.value,IV.year from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.name = 'Share Capital' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $share_premum = Yii::app()->db->createCommand("
                                    select IV.value,IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.name = 'Share Premium' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $preference_shares = Yii::app()->db->createCommand("
                                    select IV.value,IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.name = 'Preference Shares' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $foreign_exchanged_reserve = Yii::app()->db->createCommand("
                                    select IV.value,IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.name = 'Foreign Exchange Reserve' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $accumulated_loss_retained_profit = Yii::app()->db->createCommand("
                                    select IV.value, IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.name = '(Accumulated Loss)/Retained Profit' 
                                    group by IV.year 
                                    order by IV.year")->queryAll();
                
               $revenues = array();
               $expenses = array();
               $current_ratios = array();
               $quick_ratios = array();
               $debt_to_equitys = array();
               $debt_to_total_assets = array();
               $total_capitalisaions = array();
               $interes_coverages = array();
               $gross_profit_margins = array();
               $net_profit_margins = array();
               $gross_operating_margins = array();
               $net_operating_margins = array();
               $return_on_equities = array();
               $return_on_assets = array();
               $return_on_capital_employeds = array();
               $earning_per_shares = array();
               $total_asset_tunovers = array();
               $fix_asset_tunovers = array();
               $gering_ratio_debt_equitys= array();
               $gering_ratio_total_finances = array();
               $interes_covers = array();
                
               for($j=0;$j<count($years);$j++)
               {
                   if(isset($revenue[$j]['value']))
                   {
                       $revenues[$j] = $revenue[$j]['value'];
                   }
                   else
                   {
                       $revenues[$j] =0;
                   }
                   if(isset($total_expense[$j]['sum']))
                   {
                       $expenses[$j] = $total_expense[$j]['sum'];
                   }
                   else
                   {
                       $expenses[$j] =0;
                   }
                   
                    if(isset ($total_current_assets[$j]['sum']) && isset($total_current_liabilities[$j]['sum']) && 
                       isset($total_current_liabilities[$j]['sum']))
                    {
                        
                         $current_ratios[$j] =  $total_current_assets[$j]['sum']
                                                / $total_current_liabilities[$j]['sum'];
                    }
                    else
                    {
                         $current_ratios[$j] =0;
                    }
                   
                    if(isset ($total_current_assets[$j]['sum']) && isset($total_current_liabilities[$j]['sum']) && 
                       isset($total_current_liabilities[$j]['sum']))
                    {
                         $quick_ratios[$j] =  $total_current_assets[$j]['sum'] 
                                              / $total_current_liabilities[$j]['sum'];
                    }
                    else
                    {
                         $quick_ratios[$j] =0;
                    }
                   
                    if(isset($total_current_assets[$j]['sum']) && isset ($total_current_liabilities[$j]['sum']) && 
                       isset ($share_hoder_fund[$j]['value']) && isset($share_hoder_fund[$j]['value']))
                    {
                        $debt_to_equitys[$j] = ($total_current_assets[$j]['sum']
                                                + $total_current_liabilities[$j]['sum'])
                                                / $share_hoder_fund[$j]['value'];
                    }
                    else
                    {
                        $debt_to_equitys[$j] = 0;
                    }
                    
                    if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']) && 
                       isset($total_non_current_assets[$j]['year']) && isset($total_current_assets[$j]['year']))
                    {
                        $debt_to_total_assets[$j] = ($total_current_liabilities[$j]['sum'] 
                                                     + $total_non_current_liabilities[$j]['sum']) 
                                                     / ($total_non_current_assets[$j]['year'] 
                                                     +  $total_current_assets[$j]['year']);
                    }
                    else
                    {
                        $debt_to_total_assets[$j]=0;
                    }
                    
                   
                    if(isset($total_non_current_liabilities[$j]['sum']) && isset($share_hoder_equity[$j]['value']) && 
                       isset($share_hoder_equity[$j]['value']))
                    {
                        $total_capitalisaions[$j] = ($total_non_current_liabilities[$j]['sum'] 
                                                     / $share_hoder_equity[$j]['value']);
                    }
                    else
                    {
                        $total_capitalisaions[$j] =0;
                    }
                    
            
                    
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && isset($total_expense[$j]['sum']) && 
                       isset($finance_cost[$j]['value'])&& isset($share_of_profit_in_asociated_company[$j]['value']) && 
                       isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']))
                    {
                        $interes_coverages[$j]= ($revenue[$j]['value'] 
                                                 + $total_other_income[$j]['sum'] 
                                                 + $total_expense[$j]['sum'] 
                                                 + $finance_cost[$j]['value'] 
                                                 + $share_of_profit_in_asociated_company[$j]['value']) 
                                                 / ($revenue[$j]['value'] 
                                                 +  $total_other_income[$j]['sum']);
                    }
                    else
                    {
                        $interes_coverages[$j]=0;
                    }
                    
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && isset($total_expense[$j]['sum']) && 
                       isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']))
                    {
                        $gross_profit_margins[$j] = ($revenue[$j]['value'] 
                                                     + $total_other_income[$j]['sum'] 
                                                     + $total_expense[$j]['sum']) 
                                                     / ($revenue[$j]['value'] 
                                                     +  $total_other_income[$j]['sum']);
                    }
                    else
                    {
                        $gross_profit_margins[$j]=0;
                    }
                    
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && isset($total_expense[$j]['sum']) && 
                       isset($finance_cost[$j]['value']) && isset($share_of_profit_in_asociated_company[$j]['value']) && 
                       isset($taxation[$j]['value']) && isset($revenue[$j]['value']) && 
                       isset($total_other_income[$j]['sum']) && isset($revenue[$j]['value']) && 
                       isset($total_other_income[$j]['sum']))
                    {
                        
                        $net_profit_margins[$j]= ($revenue[$j]['value'] 
                                                  + $total_other_income[$j]['sum'] 
                                                  + $total_expense[$j]['sum'] 
                                                  + $finance_cost[$j]['value'] 
                                                  + $share_of_profit_in_asociated_company[$j]['value'] 
                                                  + $taxation[$j]['value']) 
                                                  / ($revenue[$j]['value'] 
                                                  +  $total_other_income[$j]['sum']);
                        
                    }
                    else
                    {
                        $net_profit_margins[$j]=0;
                    }
                    
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && isset($total_expense[$j]['sum']) && 
                       isset($revenue[$j]['value']) && isset($revenue[$j]['value']))
                    {
                        $gross_operating_margins[$j] = ($revenue[$j]['value'] 
                                                        + $total_other_income[$j]['sum'] 
                                                        + $total_expense[$j]['sum']) 
                                                        / $revenue[$j]['value'];
                    }
                    else
                    {
                        $gross_operating_margins[$j]=0;
                    }
                    
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($total_expense[$j]['sum']) && isset($finance_cost[$j]['value']) && 
                       isset($share_of_profit_in_asociated_company[$j]['value']) && isset($finance_cost[$j]['value']) && 
                       isset($revenue[$j]['value']) && isset($revenue[$j]['value']))
                    {
                        $net_operating_margins[$j]= ($revenue[$j]['value'] 
                                                     + $total_other_income[$j]['sum'] 
                                                     + $total_expense[$j]['sum'] 
                                                     + $finance_cost[$j]['value'] 
                                                     + $share_of_profit_in_asociated_company[$j]['value'] 
                                                     + $finance_cost[$j]['value'] 
                                                     / $revenue[$j]['value']);
                    }
                    else
                    {
                        $net_operating_margins[$j]=0;
                    }
                    
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && isset($total_expense[$j]['sum']) && 
                       isset($finance_cost[$j]['value']) && isset($share_of_profit_in_asociated_company[$j]['value']) && 
                       isset($taxation[$j]['value']) && 
                       isset($share_capital[$j]['value']) && isset($share_capital[$j]['value']) && 
                       isset($preference_shares[$j]['value']) && isset($foreign_exchanged_reserve[$j]['value']) && 
                       isset($accumulated_loss_retained_profit[$j]['value']))
                    {
                        $return_on_equities[$j] = ($revenue[$j]['value'] 
                                                   + $total_other_income[$j]['sum'] 
                                                   + $total_expense[$j]['sum'] 
                                                   + $finance_cost[$j]['value'] 
                                                   + $share_of_profit_in_asociated_company[$j]['value'] 
                                                   + $taxation[$j]['value'] 
                                                   / $share_capital[$j]['value'] 
                                                   + $share_premum[$j]['value'] 
                                                   + $preference_shares[$j]['value'] 
                                                   + $foreign_exchanged_reserve[$j]['value'] 
                                                   + $accumulated_loss_retained_profit[$j]['value']);
                    }
                    else
                    {
                        $return_on_equities[$j]=0;
                    }
                    
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($finance_cost[$j]['value']) && isset($total_non_current_assets[$j]['sum']) && 
                       isset($total_non_current_assets[$j]['sum']) && isset($total_current_assets[$j]['sum']))
                    {
                       $return_on_assets[$j] = ($revenue[$j]['value'] 
                                                + $total_other_income[$j]['sum'] 
                                                + $finance_cost[$j]['value'] 
                                                / $total_non_current_assets[$j]['sum'] 
                                                + $total_current_assets[$j]['sum']);
                    }
                    else
                    {
                       $return_on_assets[$j] =0;
                    }
                     
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && isset($total_expense[$j]['sum']) && 
                        isset($total_non_current_liabilities[$j]['sum']) && isset($share_hoder_equity[$j]['value']) && 
                        isset($total_non_current_liabilities[$j]['sum']) && isset($share_hoder_equity[$j]['value']))
                    {
                        $return_on_capital_employeds[$j] = ($revenue[$j]['value'] 
                                                            + $total_other_income[$j]['sum'] 
                                                            + $total_expense[$j]['sum']) 
                                                            / ($total_non_current_liabilities[$j]['sum'] 
                                                            +  $share_hoder_equity[$j]['value']);
                    }
                    else
                    {
                        $return_on_capital_employeds[$j]=0;
                    }
                     
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($total_expense[$j]['sum']) && isset($finance_cost[$j]['value']) && 
                       isset($share_of_profit_in_asociated_company[$j]['value']) && isset($taxation[$j]['value']) && 
                       isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && isset($revenue[$j]['value']) && 
                       isset($total_other_income[$j]['sum']) && isset($share_hoder_equity[$j]['value']) && 
                       isset($share_hoder_equity[$j]['value']))
                    {
                        $earning_per_shares[$j]= (($revenue[$j]['value'] 
                                                   + $total_other_income[$j]['sum'] 
                                                   + $total_expense[$j]['sum'] 
                                                   + $finance_cost[$j]['value'] 
                                                   + $share_of_profit_in_asociated_company[$j]['value'] 
                                                   + $taxation[$j]['value']) 
                                                   / ($revenue[$j]['value'] 
                                                   +  $total_other_income[$j]['sum'])) 
                                                   / $share_hoder_equity[$j]['value'];
                    }
                    else
                    {
                        $earning_per_shares[$j]=0;
                    }
                            
                    if(isset($revenue[$j]['value']) && isset($total_non_current_assets[$j]['sum']) && 
                       isset($total_current_assets[$j]['sum']) && isset($total_non_current_assets[$j]['sum']) && 
                       isset($total_current_assets[$j]['sum']))
                    {
                        $total_asset_tunovers[$j] = ($revenue[$j]['value'] 
                                                     / ($total_non_current_assets[$j]['sum'] 
                                                     +  $total_current_assets[$j]['sum']));
                    }
                    else
                    {
                        $total_asset_tunovers[$j]=0;
                    }
                    
                    if(isset($revenue[$j]['value']) && isset($total_non_current_assets[$j]['sum']) && 
                       isset($total_non_current_assets[$j]['sum']))
                    {
                        $fix_asset_tunovers[$j]= ($revenue[$j]['value'] 
                                                  / $total_non_current_assets[$j]['sum']);
                    }
                    else
                    {
                        $fix_asset_tunovers[$j]=0;
                    }
                    
                    if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']) && 
                       isset($share_hoder_equity[$j]['sum']) && isset($share_hoder_equity[$j]['sum']))
                    {
                        $gering_ratio_debt_equitys[$j] = ($total_current_liabilities[$j]['sum'] 
                                                          + $total_non_current_liabilities[$j]['sum'] 
                                                          / $share_hoder_equity[$j]['sum']);
                    }
                    else
                    {
                        $gering_ratio_debt_equitys[$j]=0;
                    }
                        
                    
                    if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']) && 
                      isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']) && 
                      isset($share_hoder_equity[$j]['value']) && isset($total_current_liabilities[$j]['sum']) && 
                      isset($total_non_current_liabilities[$j]['sum']) && isset($share_hoder_equity[$j]['value']))
                    {
                        $gering_ratio_total_finances[$j] = ($total_current_liabilities[$j]['sum'] 
                                                            + $total_non_current_liabilities[$j]['sum']) 
                                                            / ($total_current_liabilities[$j]['sum'] 
                                                            +  $total_non_current_liabilities[$j]['sum'] 
                                                            +  $share_hoder_equity[$j]['value']);
                    }
                
                    else
                    {
                        $gering_ratio_total_finances[$j]=0;
                    }
                    
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && isset($total_expense[$j]['sum']) && 
                       isset($finance_cost[$j]['value']) && isset($finance_cost[$j]['value']))
                    {
                        $interes_covers[$j] = ($revenue[$j]['value'] 
                                               + $total_other_income[$j]['sum'] 
                                               + $total_expense[$j]['sum'] 
                                               / $finance_cost[$j]['value']);
                    }
                    else
                    {
                        $interes_covers[$j] =0;
                    }
                    
            }
                $this->render('report_detail',array(
                    'years' => $years,
                    'revenues' =>$revenues,
                    'expenses' =>$expenses,
                    'current_ratios'=>$current_ratios,
                    'quick_ratios' =>$quick_ratios,
                    'debt_to_equitys' => $debt_to_equitys,
                    'debt_to_total_assets'=>$debt_to_total_assets,
                    'total_capitalisaions'=>$total_capitalisaions,
                    'interes_coverages'=>$interes_coverages,
                    'gross_profit_margins'=>$gross_profit_margins,
                    'net_profit_margins'=>$net_profit_margins,
                    'gross_operating_margins'=>$gross_operating_margins,
                    'net_operating_margins'=>$net_operating_margins,
                    'return_on_equities'=>$return_on_equities,
                    'return_on_assets'=>$return_on_assets,
                    'return_on_capital_employeds'=>$return_on_capital_employeds,
                    'earning_per_shares'=>$earning_per_shares,
                    'total_asset_tunovers'=>$total_asset_tunovers,
                    'fix_asset_tunovers'=>$fix_asset_tunovers,
                    'gering_ratio_debt_equitys'=>$gering_ratio_debt_equitys,
                    'gering_ratio_total_finances'=>$gering_ratio_total_finances,
                    'interes_covers'=>$interes_covers,
                    'company_name'=>$company_name
                ));
                
            }
            else 
            {
               $this->render('index'); 
            }
            
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}