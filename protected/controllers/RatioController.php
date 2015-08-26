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
               
//**************************************************************************************************************************************
               
               $years = Yii::app()->db->createCommand("select `year` 
                                                       from tbl_item_value 
                                                       where `company_id` ='".$company_id."' 
                                                       group by `year` 
                                                       order by `year` ")->queryAll();
               
               $total_current_assets = Yii::app()->db->createCommand("select sum(IV.value) as sum, IV.year 
                                                                      from tbl_item as I 
                                                                      inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                      where IV.company_id = '".$company_id."' 
                                                                      and I.category = 'CURRENT ASSETS' 
                                                                      group by IV.year 
                                                                      order by IV.year")->queryAll();
               
               $total_non_current_assets = Yii::app()->db->createCommand("select sum(IV.value) as sum, IV.year 
                                                                          from tbl_item as I 
                                                                          inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                          where IV.company_id = '".$company_id."' 
                                                                          and I.category = 'NON CURRENT ASSET' 
                                                                          group by IV.year 
                                                                          order by IV.year")->queryAll();
               
               $total_current_liabilities = Yii::app()->db->createCommand("select sum(IV.value) as sum,IV.year 
                                                                           from tbl_item as I 
                                                                           inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                           where IV.company_id = '".$company_id."' 
                                                                           and I.category = 'CURRENT LIABILITIES' 
                                                                           group by IV.year 
                                                                           order by IV.year")->queryAll();
               
               $total_non_current_liabilities = Yii::app()->db->createCommand("select sum(IV.value) as sum,IV.year 
                                                                               from tbl_item as I 
                                                                               inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                               where IV.company_id = '".$company_id."' 
                                                                               and I.category = 'NON-CURRENT LIABILITIES' 
                                                                               group by IV.year 
                                                                               order by IV.year")->queryAll();
    //****************************************************************************************************************************
    //current assets withot inventories and prepayments
    $ca_without_inventory_prepayment = Yii::app()->db->createCommand("select sum(IV.value) as sum, IV.year 
                                                                      from tbl_item as I 
                                                                      inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                      where IV.company_id = '".$company_id."' 
                                                                      and I.category = 'CURRENT ASSETS'
                                                                      and I.name not like '%inventor%'
                                                                      and I.name not like '%prepayment%'
                                                                      group by IV.year 
                                                                      order by IV.year")->queryAll();
    //dont forget the COGS value          
               $cost_of_good_sold = Yii::app()->db->createCommand("
                                                                    select sum(IV.value) as sum, IV.year 
                                                                    from tbl_item as I 
                                                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                    where IV.company_id = '".$company_id."' 
                                                                    and I.category = 'COST OF GOOD SOLD' 
                                                                    order by I.id, IV.year
                                                                    ")->queryAll();
               
    //i'm getting shareholders fund as sum here.
                $share_hoder_fund = Yii::app()->db->createCommand("
                                                                    select sum(IV.value) as sum, IV.year 
                                                                    from tbl_item as I 
                                                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                    where IV.company_id = '".$company_id."' 
                                                                    and I.category = 'FINANCED BY / EQUITY'
                                                                    and I.name not like '%minority interest%'
                                                                    and I.name not like '%Preference Shares for Shareholders Equity%'
                                                                    order by I.id, IV.year ")->queryAll();
               
    //i'm getting shareholders equity as sum here.
                $share_hoder_equity = Yii::app()->db->createCommand("
                                                                    select sum(IV.value) as sum, IV.year 
                                                                    from tbl_item as I 
                                                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                    where IV.company_id = '".$company_id."' 
                                                                    and I.category = 'FINANCED BY / EQUITY' 
                                                                    order by I.id, IV.year ")->queryAll();
               
    //now lets get the EXPENSES value of PROFIT FROM OPERATION with string 'expenses' only
               $profit_from_operation_expenses = Yii::app()->db->createCommand("
                                                                    select sum(IV.value) as sum, IV.year
                                                                    from tbl_item as I 
                                                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                    where IV.company_id = '".$company_id."' 
                                                                    and I.category = 'EXPENSES'
                                                                    and I.name not like '%share of%'
                                                                    and I.name not like '%finance%' 
                                                                    and I.name not like '%tax%'
                                                                    and I.name not like '%interest%'
                                                                    order by I.id, IV.year ")->queryAll();
               
    //then, lets get the EXPENSES value of PROFIT BEFORE TAXATION with string 'share of' and 'finance' only
               $profit_before_taxation_expenses = Yii::app()->db->createCommand("
                                                                    select sum(IV.value) as sum, IV.year
                                                                    from tbl_item as I 
                                                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                    where IV.company_id = '".$company_id."' 
                                                                    and I.category = 'EXPENSES'
                                                                    and I.name not like '%expense%'
                                                                    and I.name not like '%interest%'
                                                                    and I.name not like '%tax%'
                                                                    order by I.id, IV.year ")->queryAll();
               
    //after that, proceed to the EXPENSES value of PROFIT AFTER TAXATION with string 'tax' only
               $profit_after_taxation_expenses = Yii::app()->db->createCommand("
                                                                    select sum(IV.value) as sum, IV.year
                                                                    from tbl_item as I 
                                                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                    where IV.company_id = '".$company_id."' 
                                                                    and I.category = 'EXPENSES'
                                                                    and I.name not like '%expense%'
                                                                    and I.name not like '%interest%'
                                                                    and I.name not like '%share of%'
                                                                    and I.name not like '%finance%' 
                                                                    order by I.id, IV.year ")->queryAll();
               
    //************************************************************************************************************************************
               
               
               $revenue =Yii::app()->db->createCommand("select IV.value, IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."' 
                                                        and I.name = 'Revenue' 
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               
               $total_other_income =Yii::app()->db->createCommand("select sum(IV.value) as sum, IV.year 
                                                                   from tbl_item as I 
                                                                   inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                   where IV.company_id = '".$company_id."' 
                                                                   and I.category = 'OTHER INCOME' 
                                                                   group by IV.year 
                                                                   order by IV.year")->queryAll();
               
               $total_expense =Yii::app()->db->createCommand("select sum(IV.value) as sum, IV.year 
                                                              from tbl_item as I 
                                                              inner join tbl_item_value as IV on I.id = IV.item_id 
                                                              where IV.company_id = '".$company_id."' 
                                                              and I.category = 'EXPENSES' 
                                                              group by IV.year 
                                                              order by IV.year")->queryAll();
               
               $finance_cost =Yii::app()->db->createCommand("select sum(IV.value) as sum, IV.year 
                                                             from tbl_item as I 
                                                             inner join tbl_item_value as IV on I.id = IV.item_id 
                                                             where IV.company_id = '".$company_id."'
                                                             and I.category = 'EXPENSES' 
                                                             and I.name like '%finance%' 
                                                             group by IV.year 
                                                             order by IV.year")->queryAll();
               
    $share_of_profit_in_asociated_company =Yii::app()->db->createCommand("select IV.value, IV.year 
                                                                          from tbl_item as I 
                                                                          inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                          where IV.company_id = '".$company_id."' 
                                                                          and I.name = 'Share of (Loss) Profit in an Associated Company' 
                                                                          group by IV.year 
                                                                          order by IV.year")->queryAll();
               
               $taxation =Yii::app()->db->createCommand("select IV.value, IV.year 
                                                         from tbl_item as I 
                                                         inner join tbl_item_value as IV on I.id = IV.item_id 
                                                         where IV.company_id = '".$company_id."' 
                                                         and I.name = 'Share of (Loss) Profit in an Associated Company' 
                                                         group by IV.year 
                                                         order by IV.year")->queryAll();
               
               $share_capital = Yii::app()->db->createCommand("select IV.value, IV.year 
                                                               from tbl_item as I 
                                                               inner join tbl_item_value as IV on I.id = IV.item_id 
                                                               where IV.company_id = '".$company_id."' 
                                                               and I.name = 'Share Capital' 
                                                               group by IV.year 
                                                               order by IV.year")->queryAll(); 
               
               $share_premum = Yii::app()->db->createCommand("select IV.value, IV.year 
                                                              from tbl_item as I 
                                                              inner join tbl_item_value as IV on I.id = IV.item_id 
                                                              where IV.company_id = '".$company_id."' 
                                                              and I.name = 'Share Premium' 
                                                              group by IV.year 
                                                              order by IV.year")->queryAll();
               
               $preference_shares = Yii::app()->db->createCommand("select IV.value, IV.year 
                                                                   from tbl_item as I 
                                                                   inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                   where IV.company_id = '".$company_id."' 
                                                                   and I.name = 'Preference Shares' 
                                                                   group by IV.year 
                                                                   order by IV.year")->queryAll();
               
               $foreign_exchanged_reserve = Yii::app()->db->createCommand("select IV.value, IV.year 
                                                                           from tbl_item as I 
                                                                           inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                           where IV.company_id = '".$company_id."' 
                                                                           and I.name = 'Foreign Exchange Reserve' 
                                                                           group by IV.year 
                                                                           order by IV.year")->queryAll();
               
               $accumulated_loss_retained_profit = Yii::app()->db->createCommand("select IV.value, IV.year 
                                                                                  from tbl_item as I 
                                                                                  inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                                  where IV.company_id = '".$company_id."' 
                                                                                  and I.name = '(Accumulated Loss)/Retained Profit' 
                                                                                  group by IV.year 
                                                                                  order by IV.year")->queryAll();
               
//**************************************************************************************************************************************
               
                $template.="<h4><span style='padding-left: 170px;'>RATIO</span></h4>";
                $template.="<h4><span style='padding-left: 150px;'>COMPANY NAME: ".$company_name." COMPANY ID: ".$company_id."</span></h4>";
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
                   
                    if(isset ($total_current_assets[$j]['sum']) && 
                       isset($total_current_liabilities[$j]['sum']) && $total_current_liabilities[$j]['sum'] !=0 )
                    {
                        
                            $template.= "<td><label>".
                                number_format(($total_current_assets[$j]['sum'] / $total_current_liabilities[$j]['sum']), 3, '.', ',').
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
                $template .="<td><label>QUICK RATIO</label></td>";
               
                for($j=0;$j<count($years);$j++)
                {
                    
                   
                     if(isset ($ca_without_inventory_prepayment[$j]['sum']) && 
                        isset($total_current_liabilities[$j]['sum']) && $total_current_liabilities[$j]['sum'])
                     {
                         
                        $template.= "<td><label>".
                        number_format(($ca_without_inventory_prepayment[$j]['sum'] / $total_current_liabilities[$j]['sum']), 3, '.', ',').
                                    "</label></td>";
                     }
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
                   
                   if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']) &&
                      isset($share_hoder_fund[$j]['sum'])){
                       
                        $template.= "<td><label>".
                        number_format(($total_current_liabilities[$j]['sum'] 
                                       + $total_non_current_liabilities[$j]['sum']) 
                                       / $share_hoder_fund[$j]['sum'], 3, '.', ',').
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
                       isset($total_non_current_assets[$j]['sum']) && isset($total_current_assets[$j]['sum']) !=0)
                    {
                        
                        $template.= "<td><label>".
                            number_format(($total_current_liabilities[$j]['sum'] 
                                           + $total_non_current_liabilities[$j]['sum']) 
                                           / ($total_non_current_assets[$j]['sum'] 
                                           +$total_current_assets[$j]['sum']), 3, '.', ',').
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
                            number_format(($total_non_current_liabilities[$j]['sum'] / 
                                           $share_hoder_equity[$j]['sum']), 3, '.', ',').
                                   "</label></td>";
                    }
                    else
                    {
                        $template.="<td><label>-</label></td>";
                    }

                }
                $template .="</tr>";
                
               
               //****************************************************************************************************************
                $template .="<tr>";
                $template .="<td colspan='".(count($years)+2)."'> <h5>INCOME<br/>STATEMENT<br/>RATIOS</h5></td>";
                $template .="</tr>";
                $template .="<tr>";
                $template .="<td><label>COVERAGE RATIO</label></td>";
                $template .="<td><label>INTEREST<br/>COVERAGE</label></td>";
               
                 
                for($j=0;$j<count($years);$j++)
                {
                    //since the function cannot get null value, then, we subtract the REVENUE and COGS first!
                    $revenue_cogs = $revenue[$j]['value'] - $cost_of_good_sold[$j]['sum'];
                    //**************************************************************************************
                    
                    if(isset($revenue_cogs) && isset($total_other_income[$j]['sum']) && isset($profit_from_operation_expenses[$j]['sum']))
                    {
                        $cost_of_good_sold[$j]['sum'];
                        
                        $template.= "<td><label>".
                            number_format(($revenue_cogs
                                           + $total_other_income[$j]['sum'] 
                                           + $profit_from_operation_expenses[$j]['sum'] 
                                           + $profit_before_taxation_expenses[$j]['sum'])
                                           / $finance_cost[$j]['sum'], 2, '.', ',').
                                    "</label></td>";
                    }
                    else
                    {
                        $template.="<td><label>-</label></td>";
                    }

                }
               
                $template .="</tr>";
                
                $template .="<tr>";
                $template .="<td><label>PROFITABILITY<br/>RATIO(MARGIN<br/>RATIO)</label></td>";
                $template .="<td><label>GROSS PROFIT<br/>MARGIN</label></td>";
               
                for($j=0;$j<count($years);$j++)
                {
                    $revenue_cogs = $revenue[$j]['value'] - $cost_of_good_sold[$j]['sum'];
                    
                    if(isset($revenue_cogs) && isset($total_other_income[$j]['sum']) && isset($profit_from_operation_expenses[$j]['sum']))
                    {
                        
                    $template.= "<td><label>".
                        number_format(($revenue_cogs
                                      + $total_other_income[$j]['sum'] 
                                      + $profit_from_operation_expenses[$j]['sum'])
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
                    $revenue_cogs = $revenue[$j]['value'] - $cost_of_good_sold[$j]['sum'];
                    
                    if(isset($revenue_cogs) && isset($total_other_income[$j]['sum']) && isset($profit_from_operation_expenses[$j]['sum']))
                    {
                        $template.= "<td><label>".
                            number_format(($revenue_cogs
                                           + $total_other_income[$j]['sum'] 
                                           + $profit_from_operation_expenses[$j]['sum'] 
                                           + $profit_before_taxation_expenses[$j]['sum']
                                           + $profit_after_taxation_expenses[$j]['sum'])
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
                    $revenue_cogs = $revenue[$j]['value'] - $cost_of_good_sold[$j]['sum'];
                    
                    if(isset($revenue_cogs) && isset($total_other_income[$j]['sum']) && isset($profit_from_operation_expenses[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue_cogs
                                           + $total_other_income[$j]['sum'] 
                                           + $profit_from_operation_expenses[$j]['sum'])
                                           / $revenue[$j]['value'], 2, '.', ',').
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
                $template .="<td>NET OPERATING<br/>MARGIN</td>";
               
                for($j=0;$j<count($years);$j++)
                {
                    $revenue_cogs = $revenue[$j]['value'] - $cost_of_good_sold[$j]['sum'];
                    
                    if(isset($revenue_cogs) && isset($total_other_income[$j]['sum']) && isset($profit_from_operation_expenses[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue_cogs
                                           + $total_other_income[$j]['sum'] 
                                           + $profit_from_operation_expenses[$j]['sum'] 
                                           + $profit_before_taxation_expenses[$j]['sum']
                                           + $finance_cost[$j]['sum'])
                                           / $revenue[$j]['value'], 2, '.', ',').
                                    "</label></td>";
                        
                    }
                    else
                    {
                        $template.="<td><label>-</label></td>";
                    }
                }
               
                $template .="</tr>";
                
                //******************************************************************************************************************
                $template .="<tr>";
                $template .="<td><label>RETURN ON<br/>INVESTMENT(ROI)</label></td>";
               
                $template .="<td><label>RETURN ON EQUITY<br/>(ROE)</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    $revenue_cogs = $revenue[$j]['value'] - $cost_of_good_sold[$j]['sum'];
                    
                    if(isset($revenue_cogs) && isset($share_hoder_fund[$j]['sum']))
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue_cogs
                                           + $total_other_income[$j]['sum'] 
                                           + $profit_from_operation_expenses[$j]['sum'] 
                                           + $profit_before_taxation_expenses[$j]['sum']
                                           + $profit_after_taxation_expenses[$j]['sum'])
                                           / $share_hoder_fund[$j]['sum'], 2, '.', ',').
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
               
                $template .="<td>RETURN ON ASSETS<br(ROA)</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($finance_cost[$j]['value']) && isset($total_non_current_assets[$j]['sum']) && 
                       $total_non_current_assets[$j]['sum'] && isset($total_current_assets[$j]['sum']) !=0 )
                    {
                        
                        $template.="<td><label>".
                            number_format(($revenue[$j]['value'] + $total_other_income[$j]['sum'] 
                                           + $finance_cost[$j]['value'] / $total_non_current_assets[$j]['sum'] 
                                           + $total_current_assets[$j]['sum']), 3, '.', ',').
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
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($total_expense[$j]['sum']) && isset($finance_cost[$j]['value']) && 
                       isset($share_of_profit_in_asociated_company[$j]['value']) && 
                       isset($taxation[$j]['value']) && isset($revenue[$j]['value']) && 
                       isset($total_other_income[$j]['sum']) && ($revenue[$j]['value'] + $total_other_income[$j]['sum']) !=0 )
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue[$j]['value'] + $total_other_income[$j]['sum'] + $total_expense[$j]['sum'] 
                                           + $finance_cost[$j]['value'] + $share_of_profit_in_asociated_company[$j]['value'] 
                                           + $taxation[$j]['value'])/($revenue[$j]['value'] + $total_other_income[$j]['sum']), 3, '.', ',').
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
               
                $template .="<td>RETURN ON<br/>CAPITAL EMPLOYED<br/>(ROCE)</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($total_expense[$j]['sum'])&& isset($total_non_current_liabilities[$j]['sum']) && 
                       isset($share_hoder_equity[$j]['value']) && 
                       ($total_non_current_liabilities[$j]['sum'] + $share_hoder_equity[$j]['value']) !=0 )
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue[$j]['value'] + $total_other_income[$j]['sum'] 
                                           + $total_expense[$j]['sum']) / ($total_non_current_liabilities[$j]['sum'] 
                                           + $share_hoder_equity[$j]['value']), 3, '.', ',').
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
               
                $template .="<td>EARNINGS PER<br/>SHARE</td>";
                for($j=0;$j<count($years);$j++)
                {
                     if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                        isset($total_expense[$j]['sum']) && isset($finance_cost[$j]['value']) && 
                        isset($share_of_profit_in_asociated_company[$j]['value']) && 
                        isset($taxation[$j]['value']) && isset($revenue[$j]['value']) && 
                        isset($total_other_income[$j]['sum']) && ($revenue[$j]['value'] + $total_other_income[$j]['sum']) &&
                        isset($share_hoder_equity[$j]['value']) && $share_hoder_equity[$j]['value'] !=0 )
                     {
                        $template.= "<td><label>".
                            number_format((($revenue[$j]['value'] + $total_other_income[$j]['sum'] 
                                            + $total_expense[$j]['sum'] + $finance_cost[$j]['value'] 
                                            + $share_of_profit_in_asociated_company[$j]['value'] 
                                            + $taxation[$j]['value']) 
                                            / ($revenue[$j]['value'] + $total_other_income[$j]['sum'])) 
                                            / $share_hoder_equity[$j]['value'], 3, '.', ',').
                                    "</label></td>";
                     }
                     else
                     {
                        $template.="<td><label>-</label></td>";
                     } 
                }
                $template .="</tr>";
                    
                $template .="<tr>";
                $template .="<td><label>ASSET<br/>UTILISATION<br/>RATIOS</label></td>";
               
                $template .="<td><label>TOTAL ASSET<br/>TURNOVER</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($revenue[$j]['value']) && isset($total_non_current_assets[$j]['sum']) && 
                       isset($total_current_assets[$j]['sum']) && 
                       ($total_non_current_assets[$j]['sum'] + $total_current_assets[$j]['sum']) !=0 )
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue[$j]['value'] / ($total_non_current_assets[$j]['sum'] 
                                           + $total_current_assets[$j]['sum'])), 3, '.', ',').
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
               
                $template .="<td>FIXED ASSET<br/>TURNOVER</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($revenue[$j]['value']) && 
                       isset($total_non_current_assets[$j]['sum']) && $total_non_current_assets[$j]['sum'] !=0 )
                    {
                        $template.="<td><label>".
                            number_format(($revenue[$j]['value'] / $total_non_current_assets[$j]['sum']), 3, '.', ',').
                                   "</label></td>";
                    }
                    else
                    {
                        $template.="<td><label>-</label></td>";
                    }
                }
                $template .="</tr>";
                
                
                $template .="<tr>";
                $template .="<td><label>LONG-TERM<br/>SOLVENCY RISK<br/>RATIOS</label></td>";
               
                $template .="<td><label>GEARING RATIO<br/>(DEBT/EQUITY<br/>RATIO)</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_current_liabilities[$j]['sum']) && 
                       isset($total_non_current_liabilities[$j]['sum']) && 
                       isset($share_hoder_equity[$j]['sum']) && $share_hoder_equity[$j]['sum'] !=0 )
                    {
                        $template.= "<td><label>".
                            number_format(($total_current_liabilities[$j]['sum'] 
                                           + $total_non_current_liabilities[$j]['sum'] 
                                           / $share_hoder_equity[$j]['sum']), 3, '.', ',').
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
               
                $template .="<td>GEARING RATIO <br/>(TOTAL FINANCE)</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']) && 
                       isset($total_current_liabilities[$j]['sum']) && isset($total_non_current_liabilities[$j]['sum']) && 
                       isset($share_hoder_equity[$j]['value']) && 
                       ($total_current_liabilities[$j]['sum'] + $total_non_current_liabilities[$j]['sum'] 
                        + $share_hoder_equity[$j]['value']) !=0 )
                    {
                        $template.= "<td><label>".
                            number_format(($total_current_liabilities[$j]['sum'] 
                                           + $total_non_current_liabilities[$j]['sum']) 
                                           / ($total_current_liabilities[$j]['sum'] 
                                           + $total_non_current_liabilities[$j]['sum'] 
                                           + $share_hoder_equity[$j]['value']), 3, '.', ',').
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
               
                $template .="<td>INTEREST COVER</td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($total_expense[$j]['sum']) && isset($finance_cost[$j]['value']) && 
                       $finance_cost[$j]['value'] !=0 )
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue[$j]['value'] + $total_other_income[$j]['sum'] + $total_expense[$j]['sum']
                                           / $finance_cost[$j]['value']), 3, '.', ',').
                                    "</label></td>";
                    }
                    else
                    {
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