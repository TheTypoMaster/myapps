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
                
                $years = Yii::app()->db->createCommand("select year 
                                                       from tbl_item_value 
                                                       where company_id ='".$company_id."'
                                                       group by year 
                                                       order by year")->queryAll();
               
               $total_current_assets = Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum, IV.year 
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
                                                        select sum(IV.value) as sum,IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.category = 'CURRENT LIABILITIES' 
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               
               $total_non_current_liabilities = Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum,IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.category = 'NON-CURRENT LIABILITIES' 
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               
               //current assets withot inventories and prepayments
               $ca_without_inventory_prepayment = Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.category = 'CURRENT ASSETS'
                                                        and I.name not like '%inventor%'
                                                        and I.name not like '%prepayment%'
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               
                //i'm getting shareholders fund here.
                $share_hoder_fund = Yii::app()->db->createCommand(" 
                                                        select IV.value, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.category = 'FINANCED BY / EQUITY'
                                                        and I.name = 'Shareholders Fund'
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               
                //i'm getting shareholders equity as sum here.
                $share_hoder_equity = Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum,IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.category = 'FINANCED BY / EQUITY'
														and I.name != 'Shareholders Fund'
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               
               $revenue =Yii::app()->db->createCommand("select sum(IV.value) as value, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.category = 'REVENUE'
                                                        and I.main_category = '(LOSS)/PROFIT FROM OPERATIONS'
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
                
               $total_cogs =Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.category = 'COST OF GOOD SOLD'
                                                        and I.main_category = '(LOSS)/PROFIT FROM OPERATIONS' 
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               
               $total_other_income =Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.category = 'OTHER INCOME'
                                                        and I.main_category = '(LOSS)/PROFIT FROM OPERATIONS'
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               
               //************************************************************************************************************
               //PROFIT FROM OPERATION, TOTAL
               $total_profit_from_operations = Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum, IV.year
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.main_category = '(LOSS)/PROFIT FROM OPERATIONS'
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               
               //************************************************************************************************************
               
               //****************************************************************************************************
               //PROFIT BEFORE TAXATION, 
               
               //TOTAL 
               $total_profit_before_taxation=Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."' 
                                                        and I.main_category = '(LOSS)/PROFIT BEFORE TAXATION' 
                                                        group by IV.year 
                                                        order by IV.year")->queryAll(); 
               //EXPENSES
               $finance_cost =Yii::app()->db->createCommand("
                                                        select IV.value, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.category = 'EXPENSES'
                                                        and I.main_category = '(LOSS)/PROFIT BEFORE TAXATION'
                                                        and I.name like '%finance%' 
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               //****************************************************************************************************
               
               
               //****************************************************************************************************
               //PROFIT AFTER TAXATION 
               //TOTAL
               $total_profit_after_taxation=Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."' 
                                                        and I.main_category = '(LOSS)/PROFIT AFTER TAXATION' 
                                                        group by IV.year 
                                                        order by IV.year")->queryAll(); 
               //****************************************************************************************************
                
                
               //****************************************************************************************************
               //PROFIT FOR THE FINANCIAL YEAR 
               //TOTAL    
               $total_profit_financial_year = Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."' 
                                                        and I.main_category = 'NET (LOSS)/PROFIT FOR THE FINANCIAL YEAR' 
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               //****************************************************************************************************
                
               $total_expense=Yii::app()->db->createCommand("
                                                        select sum(IV.value) as sum, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."'
                                                        and I.category = 'EXPENSES'
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
                
               $revenues = array();
               $expenses = array();
               $financial_year = array();
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
                   
                   if(isset($total_profit_from_operations[$j]['sum']))
                   {
                       $financial_year[$j] = ($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                              + $total_profit_before_taxation[$j]['sum']
                                              + $total_profit_after_taxation[$j]['sum']
                                              + $total_profit_financial_year[$j]['sum'];
                   }
                   else
                   {
                       $financial_year[$j] =0;
                   }
                   
                    if(isset ($total_current_assets[$j]['sum'])&& isset($total_current_liabilities[$j]['sum']) &&
                       $total_current_liabilities[$j]['sum']!=0)
                        
                         $current_ratios[$j] =  $total_current_assets[$j]['sum']/$total_current_liabilities[$j]['sum'];
                   
                    else
                    {
                        $current_ratios[$j] =0;
                    }
                   
                    if(isset ($total_current_assets[$j]['sum'])&& 
                       isset($total_current_liabilities[$j]['sum']) && $total_current_liabilities[$j]['sum']!=0)
                        
                         $quick_ratios[$j] =  ($ca_without_inventory_prepayment[$j]['sum'] 
                                               / $total_current_liabilities[$j]['sum']);
                   
                    else
                    {
                        $quick_ratios[$j] =0;
                    }
                   
                    if(isset($total_current_assets[$j]['sum'])&& isset ($total_current_liabilities[$j]['sum'])&& 
                       isset ($share_hoder_fund[$j]['value'])&&$share_hoder_fund[$j]['value']!=0)
                        
                        $debt_to_equitys[$j] =($total_current_liabilities[$j]['sum'] 
                                               + $total_non_current_liabilities[$j]['sum']) 
                                               / $share_hoder_fund[$j]['value'];
                    else
                        
                        $debt_to_equitys[$j] = 0;
                    
                    if(isset($total_current_liabilities[$j]['sum'])&& isset($total_non_current_liabilities[$j]['sum']) &&
                       isset($total_non_current_assets[$j]['year']) && isset($total_current_assets[$j]['year']))
                        
                        $debt_to_total_assets[$j] = ($total_current_liabilities[$j]['sum'] 
                                                     + $total_non_current_liabilities[$j]['sum']) 
                                                     / ($total_non_current_assets[$j]['sum'] 
                                                     +  $total_current_assets[$j]['sum']);
                   
                    else
                        $debt_to_total_assets[$j]=0;
                   
                    
                    if(isset($total_non_current_liabilities[$j]['sum']))
                        
                        $total_capitalisaions[$j] =$total_non_current_liabilities[$j]['sum']
                                                   / $share_hoder_equity[$j]['sum'];
                   
                    else
                        $total_capitalisaions[$j] =0;
                    
            
                    
                    if(isset($total_profit_from_operations[$j]['sum']))
                    
                        
                        $interes_coverages[$j]=(($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                                 + $total_profit_before_taxation[$j]['sum'])
                                                 / $finance_cost[$j]['value'];
                       
                    else
                       
                        $interes_coverages[$j]=0;
                    
                    if(isset($total_profit_from_operations[$j]['sum']))
                        
                        $gross_profit_margins[$j]=($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                                   / ($revenue[$j]['value']
                                                   + $total_other_income[$j]['sum']);
                    else
                       
                        $gross_profit_margins[$j]=0;
                    
                    if(isset($total_profit_from_operations[$j]['sum']))
                        
                        $net_profit_margins[$j]=(($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                                  + $total_profit_before_taxation[$j]['sum']
                                                  + $total_profit_after_taxation[$j]['sum'])
                                                  / ($revenue[$j]['value']
                                                  + $total_other_income[$j]['sum']);
                   
                    else
                        
                        $net_profit_margins[$j]=0;
                    
                    if(isset($total_profit_from_operations[$j]['sum']))
                        
                        $gross_operating_margins[$j]=($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                                      / $revenue[$j]['value'];
                   
                    else
                        
                        $gross_operating_margins[$j]=0;
                    
                    if(isset($total_profit_from_operations[$j]['sum']))
                        
                        $net_operating_margins[$j]=(($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                                   + $total_profit_before_taxation[$j]['sum']
                                                   + $finance_cost[$j]['value'])
                                                   / $revenue[$j]['value'];
        
                    else
                        $net_operating_margins[$j]=0; 
                   
                    
                   if(isset($total_profit_from_operations[$j]['sum']))
                        
                        $return_on_equities[$j]=(($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                               + $total_profit_before_taxation[$j]['sum']
                                               + $total_profit_after_taxation[$j]['sum'])
                                               / $share_hoder_fund[$j]['value'];
                   
                   else
                        $return_on_equities[$j]=0;
                        
                    
                    if(isset($total_profit_from_operations[$j]['sum']))
                        
                       $return_on_assets[$j]=(($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                               + $total_profit_before_taxation[$j]['sum']
                                               + $finance_cost[$j]['value'])
                                               / ($total_non_current_assets[$j]['sum'] 
                                               +  $total_current_assets[$j]['sum']);
                    else
                       $return_on_assets[$j] =0;
                   
                     
                     if(isset($total_profit_from_operations[$j]['sum']))
                         
                        $return_on_capital_employeds[$j]=($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                                          / ($total_non_current_liabilities[$j]['sum']
                                                          +  $share_hoder_equity[$j]['sum']); 
                   
                   
                     else      
                        $return_on_capital_employeds[$j]=0;
                   
                     
                    if(isset($total_profit_from_operations[$j]['sum']))
                        
                        $earning_per_shares[$j]=(($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                                   + $total_profit_before_taxation[$j]['sum'])
                                                   / $share_hoder_equity[$j]['sum'];
                    else     
                        $earning_per_shares[$j]=0;
                   
                            
                    if(isset($revenue[$j]['value']))
                        
                        $total_asset_tunovers[$j]=$revenue[$j]['value']
                                                  / ($total_non_current_assets[$j]['sum'] 
                                                  +  $total_current_assets[$j]['sum']);
                   
                    else
                        
                        $total_asset_tunovers[$j]=0;
                   
                    
                    if(isset($revenue[$j]['value']))
                        
                        $fix_asset_tunovers[$j]=$revenue[$j]['value']
                                                / $total_non_current_assets[$j]['sum'];     
                    else
                        $fix_asset_tunovers[$j]=0;
                   
                    
                    if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']))
                        
                        $gering_ratio_debt_equitys[$j]=($total_current_liabilities[$j]['sum'] 
                                                        + $total_non_current_liabilities[$j]['sum'])
                                                        / $share_hoder_equity[$j]['sum'];
                
                    else
                        $gering_ratio_debt_equitys[$j]=0;
                   
                    
                   if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']))
                        
                        $gering_ratio_total_finances[$j]=($total_current_liabilities[$j]['sum'] 
                                                          + $total_non_current_liabilities[$j]['sum'])
                                                          / (($total_current_liabilities[$j]['sum'] 
                                                          + $total_non_current_liabilities[$j]['sum'])
                                                          + $share_hoder_equity[$j]['sum']);
                
                    else
                        $gering_ratio_total_finances[$j]=0;
                   
                    
                     if(isset($total_profit_from_operations[$j]['sum']))
                        
                        $interes_covers[$j] = ($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                               / $finance_cost[$j]['value'];
                    else
                        $interes_covers[$j] =0;
                    
               }
                $this->render('report_detail',array(
                    'years' => $years,
                    'revenues' =>$revenues,
                    'expenses' =>$expenses,
                    'financial_year' =>$financial_year,
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