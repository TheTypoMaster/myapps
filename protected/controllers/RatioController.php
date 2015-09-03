<?php

class RatioController extends Controller
{
	public function actionIndex()
	{
	   
            $this->render('index');
	}
        public function actionRatiosReport()
        {
           $template ="";
           if(isset($_REQUEST['ratios_company_id']))
           {
               $company_id = $_REQUEST['ratios_company_id'];
               $company_name = $_REQUEST['ratios_company_name'];
               
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
               //PROFIT FROM OPERATION, 
               //TOTAL
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
               
                $template.="<h4><span>RATIO</span></h4>";
                $template.="<h4><span>COMPANY NAME: ".$company_name." COMPANY ID: ".$company_id."</span></h4>";
                $template.="<hr/>";
                $template .= "<table width='882'>";
                $template.="<tr>";
                $template.="<td><h4>YEAR</h4></td>";
                $template.="<td></td>";
               
                for($j=0;$j<count($years);$j++)
                {
                    $template.="<td valign='center'><h4>".$years[$j]['year']."</h4></td>";
                }
                $template.="</tr>";
                $template .="<tr>";
                $template .="<td colspan='".(count($years)+2)."'> <h5>BALANCE SHEET <br/>RATIO</h5></td>";
                
                $template .="</tr>";
                $template .="<tr>";
                $template .="<td><label>LIQUIDITY RATIOS</label></td>";
                $template .="<td><label>CURRENT RATIOS</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                   
                    if(isset ($total_current_assets[$j]['sum'])&& isset($total_current_liabilities[$j]['sum']) && 
                       $total_current_liabilities[$j]['sum']!=0)
                        
                            $template.= "<td><label>".
                                number_format(($total_current_assets[$j]['sum'] 
                                               / $total_current_liabilities[$j]['sum']), 3, '.', ',').
                                        "</label></td>";
                    
                    else
                    {
                        $template.="<td><label>-</label></td>";
                    }
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td><label>QUICK RATIO</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    
                   
                     if(isset ($total_current_assets[$j]['sum'])&& isset($total_current_liabilities[$j]['sum']) && 
                        $total_current_liabilities[$j]['sum']!=0)
                         
                        $template.= "<td><label>".
                        number_format(($ca_without_inventory_prepayment[$j]['sum'] 
                                       / $total_current_liabilities[$j]['sum']), 3, '.', ',').
                                    "</label></td>";
                    
                    else
                    {
                        $template.="<td><label>-</label></td>";
                    }
                }
                $template .="</tr>";
                
              
           
                $template .="<tr>";
                $template .="<td><label>FINANCIAL<br/>LAVERAGE RATIO</label></td>";
               
                $template .="<td><label>DEBT-TO-EQUITY</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                   
                   if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum'])){
                       
                        $template.= "<td><label>".
                        number_format(($total_current_liabilities[$j]['sum'] 
                                       + $total_non_current_liabilities[$j]['sum']) 
                                       / $share_hoder_fund[$j]['value'], 3, '.', ',').
                                    "</label></td>";
                   }
                   else
                   {
                        $template.="<td><label>-</label></td>";
                   }
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td><label>DEBT-TO-TOTAL ASSETS</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']) &&
                       isset($total_non_current_assets[$j]['sum']) && isset($total_current_assets[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format(($total_current_liabilities[$j]['sum'] 
                                           + $total_non_current_liabilities[$j]['sum']) 
                                           / ($total_non_current_assets[$j]['sum'] 
                                           +  $total_current_assets[$j]['sum']), 3, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        
                        $template.="<td><label>-</label></td>";
                    }
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td><label>TOTAL<br/>CAPITALISATION</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_non_current_liabilities[$j]['sum']) && isset($share_hoder_equity[$j]['sum']))
                    {
               
                        $template.="<td><label>".
                            number_format($total_non_current_liabilities[$j]['sum']
                                          / $share_hoder_equity[$j]['sum'], 3, '.', ',').
                                   "</label></td>";
                    }
                    else
                    {
                        $template.="<td><label>-</label></td>";
                    }

                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td colspan='".(count($years)+2)."'> <h5>INCOME<br/>STATEMENT<br/>RATIOS</h5></td>";
              
                $template .="</tr>";
                $template .="<tr>";
                $template .="<td><label>COVERAGE RATIO</label></td>";
                $template .="<td><label>INTEREST<br/>COVERAGE</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    
                    if(isset($total_profit_from_operations[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format(($total_profit_from_operations[$j]['sum']
                                           + $total_profit_before_taxation[$j]['sum'])
                                           / $finance_cost[$j]['value'], 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }

                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td><label>PROFITABILITY<br/>RATIO(MARGIN<br/>RATIO)</label></td>";
                $template .="<td><label>GROSS PROFIT<br/>MARGIN</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_profit_from_operations[$j]['sum']))
                    {
                            $template.= "<td><label>".
                            number_format(($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                          / ($revenue[$j]['value']
                                          + $total_other_income[$j]['sum']), 2, '.', ',').
                                    "</label></td>";
                    }
                    else
                    {
                            $template.="<td><label>-</label></td>";
                    }

                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td>NET PROFIT<br/>MARGIN</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_profit_from_operations[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format((($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                           + $total_profit_before_taxation[$j]['sum']
                                           + $total_profit_after_taxation[$j]['sum'])
                                           / ($revenue[$j]['value']
                                           + $total_other_income[$j]['sum']), 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }
                    
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td>GROSS<br/>OPERATING<br/>MARGIN</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_profit_from_operations[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format(($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                          / $revenue[$j]['value'], 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }
                    
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td>NET OPERATING<br/>MARGIN</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_profit_from_operations[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format((($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                           + $total_profit_before_taxation[$j]['sum']
                                           + $finance_cost[$j]['value'])
                                           / $revenue[$j]['value'], 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }
                }
                $template .="</tr>";
                
                
                $template .="<tr>";
                $template .="<td><label>RETURN ON<br/>INVESTMENT(ROI)</label></td>";
                $template .="<td><label>RETURN ON EQUITY<br/>(ROE)</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_profit_from_operations[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format((($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                           + $total_profit_before_taxation[$j]['sum']
                                           + $total_profit_after_taxation[$j]['sum'])
                                           / $share_hoder_fund[$j]['value'], 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td>RETURN ON ASSETS<br(ROA)</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_profit_from_operations[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format((($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                           + $total_profit_before_taxation[$j]['sum']
                                           + $finance_cost[$j]['value'])
                                           / ($total_non_current_assets[$j]['sum'] 
                                           +  $total_current_assets[$j]['sum']), 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }                  
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td>RETURN ON<br/>CAPITAL EMPLOYED<br/>(ROCE)</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_profit_from_operations[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format(($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                          / ($total_non_current_liabilities[$j]['sum']
                                          +  $share_hoder_equity[$j]['sum']), 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }                  
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td>EARNINGS PER<br/>SHARE</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_profit_from_operations[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format((($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                           + $total_profit_before_taxation[$j]['sum'])
                                           / $share_hoder_equity[$j]['sum'], 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }
                    
                     
                }
                $template .="</tr>";
                    
                $template .="<tr>";
                $template .="<td><label>ASSET<br/>UTILISATION<br/>RATIOS</label></td>";
                $template .="<td><label>TOTAL ASSET<br/>TURNOVER</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($revenue[$j]['value']))
                    {
                        
                        $template.= "<td><label>".
                            number_format($revenue[$j]['value']
                                          / ($total_non_current_assets[$j]['sum'] 
                                          +  $total_current_assets[$j]['sum']), 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }  
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td>FIXED ASSET<br/>TURNOVER</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($revenue[$j]['value']))
                    {
                        
                        $template.= "<td><label>".
                            number_format($revenue[$j]['value']
                                          / $total_non_current_assets[$j]['sum'], 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }  
                }
                $template .="</tr>";
                
                
                $template .="<tr>";
                $template .="<td><label>LONG-TERM<br/>SOLVENCY RISK<br/>RATIOS</label></td>";
                $template .="<td><label>GEARING RATIO<br/>(DEBT/EQUITY)</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format(($total_current_liabilities[$j]['sum'] 
                                          + $total_non_current_liabilities[$j]['sum'])
                                          / $share_hoder_equity[$j]['sum'], 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }  
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td>GEARING RATIO <br/>(DEBT/DEBT+EQUITY)</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format(($total_current_liabilities[$j]['sum'] 
                                          + $total_non_current_liabilities[$j]['sum'])
                                          / (($total_current_liabilities[$j]['sum'] 
                                          + $total_non_current_liabilities[$j]['sum'])
                                          + $share_hoder_equity[$j]['sum']), 2, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }  
                }
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td></td>";
                $template .="<td>INTEREST COVER</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_profit_from_operations[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format(($total_profit_from_operations[$j]['sum'] - $total_cogs[$j]['sum'])
                                          / $finance_cost[$j]['value'], 0, '.', ',').
                                    "</label></td>";
                    }
                    else{
                        $template.="<td><label>-</label></td>";
                    }             
                 }
                $template .="</tr>";
                

           }
           echo $template;
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