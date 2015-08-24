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
               
//******************************************************************************************************************************************
               
               $years = Yii::app()->db->createCommand("select `year` 
                                                       from tbl_item_value 
                                                       where `company_id` ='".$company_id."' 
                                                       group by `year` 
                                                       order by `year` ")->queryAll();
               
               $total_current_assets = Yii::app()->db->createCommand("select sum(IV.value) as sum,IV.year 
                                                                      from tbl_item as I 
                                                                      inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                      where IV.company_id = '".$company_id."' 
                                                                      and I.category = 'CURRENT ASSETS' 
                                                                      group by IV.year 
                                                                      order by IV.year")->queryAll();
               
               $total_non_current_assets = Yii::app()->db->createCommand("select sum(IV.value) as sum,IV.year 
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
               
               $share_hoder_fund =Yii::app()->db->createCommand("select IV.value,IV.year 
                                                                 from tbl_item as I 
                                                                 inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                 where IV.company_id = '".$company_id."' 
                                                                 and I.name = 'Shareholder’s Fund' 
                                                                 group by IV.year 
                                                                 order by IV.year")->queryAll();
               
               $share_hoder_equity =Yii::app()->db->createCommand("select IV.value,IV.year 
                                                                   from tbl_item as I 
                                                                   inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                   where IV.company_id = '".$company_id."' 
                                                                   and I.name = 'Shareholder’s Equity' 
                                                                   group by IV.year 
                                                                   order by IV.year")->queryAll();
               
               $revenue =Yii::app()->db->createCommand("select IV.value ,IV.year 
                                                        from tbl_item as I 
                                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                                        where IV.company_id = '".$company_id."' 
                                                        and I.name = 'Revenue' 
                                                        group by IV.year 
                                                        order by IV.year")->queryAll();
               
               $total_other_income =Yii::app()->db->createCommand("select sum(IV.value) as sum,IV.year 
                                                                   from tbl_item as I 
                                                                   inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                   where IV.company_id = '".$company_id."' 
                                                                   and I.category = 'OTHER INCOME' 
                                                                   group by IV.year 
                                                                   order by IV.year")->queryAll();
               
               $total_expense =Yii::app()->db->createCommand("select sum(IV.value) as sum,IV.year 
                                                              from tbl_item as I 
                                                              inner join tbl_item_value as IV on I.id = IV.item_id 
                                                              where IV.company_id = '".$company_id."' 
                                                              and I.category = 'EXPENSES' 
                                                              group by IV.year 
                                                              order by IV.year")->queryAll();
               
               $finance_cost =Yii::app()->db->createCommand("select IV.value,IV.year 
                                                             from tbl_item as I 
                                                             inner join tbl_item_value as IV on I.id = IV.item_id 
                                                             where IV.company_id = '".$company_id."' 
                                                             and I.name = 'Finance Costs' 
                                                             group by IV.year 
                                                             order by IV.year")->queryAll();
               
    $share_of_profit_in_asociated_company =Yii::app()->db->createCommand("select IV.value,IV.year 
                                                                          from tbl_item as I 
                                                                          inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                          where IV.company_id = '".$company_id."' 
                                                                          and I.name = 'Share of (Loss) Profit in an Associated Company' 
                                                                          group by IV.year 
                                                                          order by IV.year")->queryAll();
               
               $taxation =Yii::app()->db->createCommand("select IV.value,IV.year 
                                                         from tbl_item as I 
                                                         inner join tbl_item_value as IV on I.id = IV.item_id 
                                                         where IV.company_id = '".$company_id."' 
                                                         and I.name = 'Share of (Loss) Profit in an Associated Company' 
                                                         group by IV.year 
                                                         order by IV.year")->queryAll();
               
               $share_capital = Yii::app()->db->createCommand("select IV.value,IV.year 
                                                               from tbl_item as I 
                                                               inner join tbl_item_value as IV on I.id = IV.item_id 
                                                               where IV.company_id = '".$company_id."' 
                                                               and I.name = 'Share Capital' 
                                                               group by IV.year 
                                                               order by IV.year")->queryAll(); 
               
               $share_premum = Yii::app()->db->createCommand("select IV.value,IV.year 
                                                              from tbl_item as I 
                                                              inner join tbl_item_value as IV on I.id = IV.item_id 
                                                              where IV.company_id = '".$company_id."' 
                                                              and I.name = 'Share Premium' 
                                                              group by IV.year 
                                                              order by IV.year")->queryAll();
               
               $preference_shares = Yii::app()->db->createCommand("select IV.value,IV.year 
                                                                   from tbl_item as I 
                                                                   inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                   where IV.company_id = '".$company_id."' 
                                                                   and I.name = 'Preference Shares' 
                                                                   group by IV.year 
                                                                   order by IV.year")->queryAll();
               
               $foreign_exchanged_reserve = Yii::app()->db->createCommand("select IV.value,IV.year 
                                                                           from tbl_item as I 
                                                                           inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                           where IV.company_id = '".$company_id."' 
                                                                           and I.name = 'Foreign Exchange Reserve' 
                                                                           group by IV.year 
                                                                           order by IV.year")->queryAll();
               
               $accumulated_loss_retained_profit = Yii::app()->db->createCommand("select IV.value,IV.year 
                                                                                  from tbl_item as I 
                                                                                  inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                                  where IV.company_id = '".$company_id."' 
                                                                                  and I.name = '(Accumulated Loss)/Retained Profit' 
                                                                                  group by IV.year 
                                                                                  order by IV.year")->queryAll();
               
//*****************************************************************************************************************************************
               
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
                    
                   
                     if(isset ($total_current_assets[$j]['sum']) && 
                        isset($total_current_liabilities[$j]['sum']) && $total_current_liabilities[$j]['sum']!=0)
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
                $template .="<td><label>FINANCIAL<br/>LAVERAGE RATIO</label></td>";
                $template .="<td><label>DEBT-TO-EQUITY</label></td>";
               
                for($j=0;$j<count($years);$j++)
                {
                   
                   if(isset($total_current_assets[$j]['sum']) && isset ($total_current_liabilities[$j]['sum']) && 
                      isset ($share_hoder_fund[$j]['value']) && $share_hoder_fund[$j]['value'] !=0 ){
                       
                        $template.= "<td><label>".
                        number_format(($total_current_assets[$j]['sum'] + $total_current_liabilities[$j]['sum'])
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
                       isset($total_non_current_assets[$j]['year']) && isset($total_current_assets[$j]['year']) !=0)
                    {
                        
                        $template.= "<td><label>".
                            number_format(($total_current_liabilities[$j]['sum'] 
                                           + $total_non_current_liabilities[$j]['sum']) 
                                           / ($total_non_current_assets[$j]['year'] 
                                           +$total_current_assets[$j]['year']), 3, '.', ',').
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
                    if(isset($total_non_current_liabilities[$j]['sum']) && isset($share_hoder_equity[$j]['value']) 
                       && $share_hoder_equity[$j]['value'] !=0 )
                    {
               
                        $template.="<td><label>".
                            number_format(($total_non_current_liabilities[$j]['sum'] / 
                                           $share_hoder_equity[$j]['value']), 3, '.', ',').
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
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && isset($total_expense[$j]['sum'])&&
                       isset($finance_cost[$j]['value'])&& isset($share_of_profit_in_asociated_company[$j]['value'])&& 
                       isset($revenue[$j]['value'])&& 
                       isset($total_other_income[$j]['sum']) && ($revenue[$j]['value']+$total_other_income[$j]['sum']) !=0)
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue[$j]['value'] + $total_other_income[$j]['sum'] 
                                           + $total_expense[$j]['sum'] + $finance_cost[$j]['value'] 
                                           + $share_of_profit_in_asociated_company[$j]['value']) 
                                           / ($revenue[$j]['value'] + $total_other_income[$j]['sum']), 3, '.', ',').
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
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($total_expense[$j]['sum']) && isset($revenue[$j]['value']) && 
                       isset($total_other_income[$j]['sum']) && ($revenue[$j]['value'] + $total_other_income[$j]['sum']) !=0 )
                    {
                        
                    $template.= "<td><label>".
                        number_format(($revenue[$j]['value'] + $total_other_income[$j]['sum'] 
                                       + $total_expense[$j]['sum']) / ($revenue[$j]['value'] 
                                       + $total_other_income[$j]['sum']), 3, '.', ',').
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
                       isset($taxation[$j]['value']) && isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) 
                       && ($revenue[$j]['value'] + $total_other_income[$j]['sum']) !=0 )
                    {
                        $template.= "<td><label>".
                            number_format(($revenue[$j]['value'] + $total_other_income[$j]['sum'] 
                                           + $total_expense[$j]['sum'] 
                                           + $finance_cost[$j]['value'] + $share_of_profit_in_asociated_company[$j]['value'] 
                                           + $taxation[$j]['value']) / ($revenue[$j]['value'] 
                                           + $total_other_income[$j]['sum']), 3, '.', ',').
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
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($total_expense[$j]['sum']) && isset($revenue[$j]['value']) && 
                       $revenue[$j]['value'] !=0 )
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue[$j]['value'] + $total_other_income[$j]['sum'] 
                                           + $total_expense[$j]['sum']) 
                                           / $revenue[$j]['value'], 3, '.', ',').
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
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($total_expense[$j]['sum']) && isset($finance_cost[$j]['value']) && 
                       isset($share_of_profit_in_asociated_company[$j]['value']) && isset($finance_cost[$j]['value']) && 
                       isset($revenue[$j]['value'])&& $revenue[$j]['value'] !=0 )
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue[$j]['value'] + $total_other_income[$j]['sum'] + $total_expense[$j]['sum'] 
                                           + $finance_cost[$j]['value'] + $share_of_profit_in_asociated_company[$j]['value'] 
                                           + $finance_cost[$j]['value'] / $revenue[$j]['value']), 3, '.', ',').
                                    "</label></td>";
                        
                    }
                    else
                    {
                        $template.="<td><label>-</label></td>";
                    }
                }
               
                $template .="</tr>";
                
                
                $template .="<tr>";
                $template .="<td><label>RETURN ON<br/>INVESTMENT(ROI)</label></td>";
               
                $template .="<td><label>RETURN ON EQUITY<br/>(ROE)</label></td>";
                for($j=0;$j<count($years);$j++)
                {
                    if(isset($revenue[$j]['value']) && isset($total_other_income[$j]['sum']) && 
                       isset($total_expense[$j]['sum']) && isset($finance_cost[$j]['value']) && 
                       isset($share_of_profit_in_asociated_company[$j]['value']) && isset($taxation[$j]['value']) && 
                       isset($share_capital[$j]['value']) && $share_capital[$j]['value'] && 
                       isset($preference_shares[$j]['value']) && isset($foreign_exchanged_reserve[$j]['value']) &&
                       isset($accumulated_loss_retained_profit[$j]['value']) !=0 )
                    {
                        
                        $template.= "<td><label>".
                            number_format(($revenue[$j]['value'] + $total_other_income[$j]['sum'] + $total_expense[$j]['sum'] 
                                           + $finance_cost[$j]['value'] + $share_of_profit_in_asociated_company[$j]['value'] 
                                           + $taxation[$j]['value'] 
                                           / $share_capital[$j]['value'] 
                                           + $share_premum[$j]['value'] + $preference_shares[$j]['value'] 
                                           + $foreign_exchanged_reserve[$j]['value'] 
                                           + $accumulated_loss_retained_profit[$j]['value']), 3, '.', ',').
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