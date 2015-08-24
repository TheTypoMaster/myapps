<?php

class AccrualsController extends Controller
{
    /* Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','yearreportsheet','jonemodel'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','incomeStatement','generalLedger','select_general','years','companyId'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create'),
				'expression'=>'$user->getLevel()<=1',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
       public function actionYearReportSheet()
        {
            $result ="";
            if(isset($_REQUEST["accruals_company_id"]))
            {
                $company_id = $_REQUEST["accruals_company_id"];
                
                $years = Yii::app()->db->createCommand("select `year` 
                                                        from tbl_item_value 
                                                        where `company_id` ='".$company_id."' 
                                                        group by `year`")->queryAll();
                
                if(!empty($years))
                {
                    $result.= "<option value=''>All</option>";
                    foreach ($years as $y)
                    {
                        $result.="<option value='".$y['year']."'>".$y['year']."</option>";
                    }
                     foreach ($years as $y)
                     {
                         
                     }
                }
            }
            echo $result;
        }
    
    
        public function actionMcNichoModel()
        {
            if(isset($_REQUEST['accruals_company']))
            {
                $company_id = $_REQUEST['accruals_company'];
                $company_name = $_REQUEST['company_name'];
                $year = $_REQUEST['accruals_model_year'];
                $e =  $_REQUEST['epsinol'];
                $b0 = $_REQUEST['b0'];
                $b1 = $_REQUEST['b1'];
                $b2 = $_REQUEST['b2'];
                $b3 = $_REQUEST['b3'];
                $b4 = $_REQUEST['b4'];
                $b5 = $_REQUEST['b5'];
                $b6 = $_REQUEST['b6'];
                
                $total_current_assets = Yii::app()->db->createCommand("select sum(IV.value) as sum,IV.year   
                                                                       from tbl_item as I 
                                                                       inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                       where IV.company_id = '".$company_id."' 
                                                                       and I.category = 'CURRENT ASSETS' 
                                                                       and IV.year='".$year."'")->queryAll();
                
                $total_assets = Yii::app()->db->createCommand("select sum(IV.value) as sum,IV.year   
                                                               from tbl_item as I 
                                                               inner join tbl_item_value as IV on I.id = IV.item_id 
                                                               where IV.company_id = '".$company_id."' 
                                                               and (I.category = 'CURRENT ASSETS' 
                                                               or I.category = 'NON CURRENT ASSETS') 
                                                               and IV.year='".$year."'")->queryAll();
                
                $CFO = Yii::app()->db->createCommand("select sum(IV.value) as sum,IV.year   
                                                      from tbl_item as I 
                                                      inner join tbl_item_value as IV on I.id = IV.item_id 
                                                      where IV.company_id = '".$company_id."' 
                                                      and I.category = 'CASH FLOW FROM OPERATING' 
                                                      group by IV.year 
                                                      order by IV.year")->queryAll();
                
                $revenues = Yii::app()->db->createCommand("select  IV.value 
                                                           from tbl_item as I 
                                                           inner join tbl_item_value as IV on I.id = IV.item_id 
                                                           where IV.company_id = '".$company_id."' 
                                                           and IV.year = '".$year."' 
                                                           and I.name = 'Revenue'")->queryAll();
                
                $plan_property_equirement = Yii::app()->db->createCommand("select  IV.value 
                                                                           from tbl_item as I 
                                                                           inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                           where IV.company_id = '".$company_id."' 
                                                                           and IV.year = '".$year."' 
                                                                           and I.name = 'Property, Plant & Equipment (PPE)'")->queryAll();
                
                $year_index = 0;
                for($year_index=0;$year_index<count($CFO);)
                {
                    if($CFO['year']==$year)
                        break;
                    $year_index++;
                }
                $x = (isset($total_current_assets[0]['sum']) && isset($total_assets[0]['sum']) && $total_assets[0]['sum']!=0)?$total_current_assets[0]['sum']/$total_assets[0]['sum']:0;
                if($total_assets!=0 && $year_index>0)
                    $y = ($b0+ $b1*isset($CFO[$year_index-1]['sum'])?$CFO[$year_index-1]['sum']:0+$b2*isset($CFO[$year_index-1]['sum'])?$CFO[$year_index-1]['sum']:0+$b3*isset($CFO[$year_index-1]['sum'])?$CFO[$year_index-1]['sum']:0+$b4*(isset($revenues[$year_index]['value'])?$revenues[$year_index]['value']:0-isset($revenues[$year_index-1]['value'])?$revenues[$year_index-1]['value']:0)+$b5*isset($plan_property_equirement[0]['value'])?$plan_property_equirement[0]['value']:0)/$total_assets;
                else
                    $y=0;
                
	        $template ="";
				$template ="<input style='margin-left: 890px;' type='submit' class='print' value='Print' >"; 
                $template.="<h4><span style='padding-left: 220px;'>McNICHOLS MODEL</span></h4>";
                $template.="<h4><span style='padding-left: 150px;'>COMPANY NAME: ".$company_name." COMPANY ID: ".$company_id."</span></h4>";
                $template.="<hr/>";
                $template .= "<table width='882' style='margin-left: 35px;'>";
                $template.="<tr>";
                $template.="<td><h4>YEAR</h4></td>";
                $template.="<td><h4>".$year."</h4></td>";
                $template.="</tr>";
                $template.="<tr>";
                $template.="<td><h4>".number_format($x, 3, '.', ',')."</h4></td>";
                $template.="<td><h4>".number_format($y, 3, '.', ',')."</h4></td>";
                $template.="</tr>";
                $template.="<tr>";
                $template.="<td colspan='2'><h4>The manipulated value is = ".number_format($x-$y, 3, '.', ',')."</h4></td>";
                $template.="</tr>";
                echo $template;;
                
            }
        }
    
        public function actionDechowModel()
        {
            if(isset($_REQUEST['accruals_company']))
            {
                $company_id =$_REQUEST['accruals_company'];
                $company_name = $_REQUEST['company_name'];
                $year =$_REQUEST['accruals_model_year'];
                $e =  $_REQUEST['epsinol'];
                $b0 = $_REQUEST['b0'];
                $b1 = $_REQUEST['b1'];
                $b2 = $_REQUEST['b2'];
                $b3 = $_REQUEST['b3'];
                     
                $work_capital_temp = Yii::app()->db->createCommand("select IV.value   
                                                                    from tbl_item as I 
                                                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                    where IV.company_id = '".$company_id."' 
                                                                    and IV.year = '".$year."' 
                                                                    and I.name = 'Working Capital'")->queryAll();
                
                $work_capital = (!empty($total_current_assets_temp))?$work_capital_temp[0]['value']:0;
                
                $work_capital_last_year_temp = Yii::app()->db->createCommand("select IV.value   
                                                                              from tbl_item as I 
                                                                              inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                              where IV.company_id = '".$company_id."' 
                                                                              and IV.year = '".($year-1)."' 
                                                                              and I.name = 'Working Capital'")->queryAll();
                
                $work_capital_last_year = (!empty($total_current_assets_temp))?$work_capital_last_year_temp[0]['value']:0;
                
                $CFO = Yii::app()->db->createCommand("select sum(IV.value) as sum,IV.year   
                                                      from tbl_item as I 
                                                      inner join tbl_item_value as IV on I.id = IV.item_id 
                                                      where IV.company_id = '".$company_id."' 
                                                      and I.category = 'CASH FLOW FROM OPERATING' 
                                                      group by IV.year order by IV.year")->queryAll();
                
                $year_index = 0;
                for($year_index=0;$year_index<count($CFO);)
                {
                    if($CFO['year']==$year)
                        break;
                    $year_index++;
                }
                $x = $work_capital -$work_capital_last_year;
                $y = $b0+$b1*(isset($CFO[$year_index-1]['sum'])?$CFO[$year_index-1]['sum']:0)+$b1*(isset($CFO[$year_index]['sum'])?$CFO[$year_index]['sum']:0)+$b2*(isset($CFO[$year_index+1]['sum'])?$CFO[$year_index+1]['sum']:0)+$e;
                $template ="";
				$template ="<input style='margin-left: 890px;' type='submit' class='print' value='Print' >"; 
                $template.="<h4><span style='padding-left: 220px;'>DECHOW AND DICHEV MODEL</span></h4>";
                $template.="<h4><span style='padding-left: 150px;'>COMPANY NAME: ".$company_name." COMPANY ID: ".$company_id."</span></h4>";
                $template.="<hr/>";
                $template .= "<table width='882' style='margin-left: 35px;'>";
                $template.="<tr>";
                $template.="<td><h4>YEAR</h4></td>";
                $template.="<td><h4>".$year."</h4></td>";
                $template.="</tr>";
                $template.="<tr>";
                $template.="<td><h4>".number_format($x, 3, '.', ',')."</h4></td>";
                $template.="<td><h4>".number_format($y, 3, '.', ',')."</h4></td>";
                $template.="</tr>";
                $template.="<tr>";
                $template.="<td colspan='2'><h4>The manipulated value is = ".number_format($x-$y, 3, '.', ',')."</h4></td>";
                $template.="</tr>";
                echo $template;
                
            }
        }
    
    
        public function actionJoneModel()
        {
            if(isset($_REQUEST['accruals_company']))
            {
                $company_id =$_REQUEST['accruals_company'];
                $company_name = $_REQUEST['company_name'];
                $year =$_REQUEST['accruals_model_year'];
                $e =  $_REQUEST['epsinol'];
                    
                $total_current_assets_temp = Yii::app()->db->createCommand("select sum(IV.value) as total_current_assets  
                                                                            from tbl_item as I 
                                                                            inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                            where IV.company_id = '".$company_id."' 
                                                                            and IV.year = '".$year."' 
                                                                            and I.category = 'CURRENT ASSET'")->queryAll();
                
                $total_current_assets = (!empty($total_current_assets_temp))?$total_current_assets_temp[0]['total_current_assets']:0;
                
                $total_current_assets_last_year_temp = Yii::app()->db->createCommand("select sum(IV.value) as total_current_assets  
                                                                                      from tbl_item as I 
                                                                                      inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                                      where IV.company_id = '".$company_id."' 
                                                                                      and IV.year = '".($year-1)."' 
                                                                                      and I.category = 'CURRENT ASSET'")->queryAll();
                
                $total_current_assets_last_year = (!empty($total_current_assets_last_year_temp))?$total_current_assets_last_year_temp[0]['total_current_assets']:0;
                
                $total_current_liabilities_temp = Yii::app()->db->createCommand("select sum(IV.value) as total_current_liabilities  
                                                                                 from tbl_item as I 
                                                                                 inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                                 where IV.company_id = '".$company_id."' 
                                                                                 and IV.year = '".$year."' 
                                                                                 and I.category = 'CURRENT LIABILITIES'")->queryAll();
                
                $total_current_liabilities = !(empty($total_current_liabilities_temp))?$total_current_liabilities_temp[0]['total_current_liabilities']:0;
                
        $total_current_liabilities_last_year_temp = Yii::app()->db->createCommand("select sum(IV.value) as total_current_liabilities_last_year  
                                                                                   from tbl_item as I 
                                                                                   inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                                   where IV.company_id = '".$company_id."' 
                                                                                   and IV.year = '".($year-1)."' 
                                                                                   and I.category = 'CURRENT LIABILITIES'")->queryAll();
                
                $total_current_liabilities_last_year = !(empty($total_current_liabilities_last_year_temp))?$total_current_liabilities_last_year_temp[0]['total_current_liabilities_last_year']:0;
  
                      
                $cash_temp = Yii::app()->db->createCommand("select IV.value 
                                                            from tbl_item as I 
                                                            inner join tbl_item_value as IV on I.id = IV.item_id 
                                                            where IV.company_id = '".$company_id."' 
                                                            and IV.year = '".$year."' 
                                                            and I.name = 'Cash & Bank Balance'")->queryAll();
                
                $cash = !(empty($cash_temp))?$cash_temp[0]['value']:0;
          
                $cash_last_year_temp = Yii::app()->db->createCommand("select IV.value 
                                                                      from tbl_item as I 
                                                                      inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                      where IV.company_id = '".$company_id."' 
                                                                      and IV.year = '".($year-1)."' 
                                                                      and I.name = 'Cash & Bank Balance'")->queryAll();
                
                $cash_last_year =!(empty($cash_last_year_temp))? $cash_last_year_temp[0]['value']:0;
                
                $short_term_debt_temp = Yii::app()->db->createCommand("select IV.value 
                                                                       from tbl_item as I 
                                                                       inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                       where IV.company_id = '".$company_id."' 
                                                                       and IV.year = '".$year."' 
                                                                       and I.name = 'Short Term Debt'")->queryAll();
                
                $short_term_debt = !(empty($short_term_debt_temp))?$short_term_debt_temp[0]['value']:0;
               
                $short_term_deb_last_year_temp = Yii::app()->db->createCommand("select IV.value 
                                                                                from tbl_item as I 
                                                                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                                where IV.company_id = '".$company_id."' 
                                                                                and IV.year = '".($year-1)."' 
                                                                                and I.name = 'Short Term Debt'")->queryAll();
                
                $short_term_deb_last_year = !(empty($short_term_deb_last_year_temp))?$short_term_deb_last_year_temp[0]['value']:0;
              
                $depreciation_temp = Yii::app()->db->createCommand("select IV.value 
                                                                    from tbl_item as I 
                                                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                    where IV.company_id = '".$company_id."' 
                                                                    and IV.year = '".$year."' 
                                                                    and I.name = 'Depreciation Expenses'")->queryAll();
                
                $depreciation = !(empty($depreciation_temp))?$depreciation_temp[0]['value']:0;
                
                $total_assets_temp = Yii::app()->db->createCommand("select sum(IV.value) as total_assets  
                                                                    from tbl_item as I 
                                                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                    where IV.company_id = '".$company_id."' 
                                                                    and IV.year = '".$year."' 
                                                                    and I.category in ('NON CURRENT ASSET','CURRENT ASSET')")->queryAll();
                
                $total_assets = !empty($total_assets_temp)?$total_assets_temp[0]['total_assets']:0;
                
        $total_assets_last_year_temp = Yii::app()->db->createCommand("select sum(IV.value) as total_assets_last_year  
                                                                      from tbl_item as I 
                                                                      inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                      where IV.company_id = '".$company_id."' 
                                                                      and IV.year = '".($year-1)."' 
                                                                      and I.category in ('NON CURRENT ASSET','CURRENT ASSET')")->queryAll();
                
                $total_assets_last_year = !empty($total_assets_last_year_temp)? $total_assets_last_year_temp[0]['total_assets_last_year']:0;
                ///////////////////
               
      
                $revenue_temp = Yii::app()->db->createCommand("select  IV.value 
                                                               from tbl_item as I 
                                                               inner join tbl_item_value as IV on I.id = IV.item_id 
                                                               where IV.company_id = '".$company_id."' 
                                                               and IV.year = '".$year."' and I.name = 'Revenue'")->queryAll();
                
                
                $revenue = !empty($revenue_temp)? $revenue_temp[0]['value']:0;
                
                $revenue_last_year_temp = Yii::app()->db->createCommand("select IV.value 
                                                                         from tbl_item as I 
                                                                         inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                         where IV.company_id = '".$company_id."' 
                                                                         and IV.year = '".($year-1)."' 
                                                                         and I.name = 'Revenue'")->queryAll();
                
                $revenue_last_year = !empty($revenue_last_year_temp)?$revenue_last_year_temp[0]['value']:0;
                
                $property_plant_equipment_temp = Yii::app()->db->createCommand("select IV.value 
                                                                                from tbl_item as I 
                                                                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                                where IV.company_id = '".$company_id."' 
                                                                                and IV.year = '".$year."' 
                                                                                and I.name = 'Property, Plant & Equipment (PPE)'")->queryAll();
                
                $property_plant_equipment = !empty($property_plant_equipment_temp)? $property_plant_equipment_temp[0]['value']:0;
                
                if($total_assets!=0)
                    $x = ($total_current_assets-$total_current_assets_last_year-$total_current_liabilities + $total_current_liabilities_last_year-$cash +$cash_last_year + $short_term_debt-$short_term_deb_last_year-$depreciation)/$total_assets;
                else 
                    $x=0;    
                if($total_assets!=0&& $total_assets_last_year!=0 &&$total_assets_last_year!=0)
                    $y = 1/$total_assets + ($revenue - $revenue_last_year)/$total_assets_last_year+ $property_plant_equipment/$total_assets_last_year + $e;
                else
                    $y=0;
             
                $template ="<input style='margin-left: 890px;' type='submit' class='print' value='Print' >"; 
                $template.="<h4><span style='padding-left: 290px;'>JONES MODEL</span></h4>";
                $template.="<h4><span style='padding-left: 150px;'>COMPANY NAME: ".$company_name." COMPANY ID: ".$company_id."</span></h4>";
                $template.="<hr/>";
                $template .= "<table width='882' style='margin-left: 35px;'>";
                $template.="<tr>";
                $template.="<td><h4>YEAR</h4></td>";
                $template.="<td><h4>".$year."</h4></td>";
                $template.="</tr>";
                $template.="<tr>";
                 $template.="<td><h4>".number_format($x, 3, '.', ',')."</h4></td>";
                $template.="<td><h4>".number_format($y, 3, '.', ',')."</h4></td>";
               $template.="</tr>";
                $template.="<tr>";
                $template.="<td colspan='2'><h4>The manipulated value is = ".  number_format($x-$y, 3, '.', ',')."</h4></td>";
                $template.="</tr>";
                echo $template;
            }        
        }
    
    
	public function actionIndex()
	{
                  if(isset($_POST["select_leger_items_company_name"])&& $_POST["select_leger_items_company_name"]!="")
                {
                  
                    $array_post = $_POST;
                    $company_id = $_POST["select_leger_items_company_name"];
                    $selected_item ="";
                    foreach($array_post as $key => $value)
                    {
                        if($key=='select_leger_items_company_name')
                            continue;
                        $selected_item.= $value.';';
                        
                    }
                    $criteria = new CDbCriteria;  
                    $criteria->addCondition("`company_id` = '".$company_id+"'");
                    $item = SelectLedgerItem::model()->find($criteria);
                   
                    if(!isset($item))
                    {
                       $item = new SelectLedgerItem();
                       $item->Company_id = $company_id;
                       
                    }
                    $item->selected_item = $selected_item;
                   
                  
                    $item->save();
                }
                
		$model=new General;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['General']))
		{ 
			$model->attributes=$_POST['General'];
			$model->total_1=$model->pro_1 + $model->intangible_1 + $model->development_1 + $model->invest_sub_1 + $model->invest_aso_1 + $model->other_1;
			$model->total_2=$model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank;
			$model->total_3=$model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation;
			$model->netcurrentLiabilities=$model->netcurrentLiabilities=($model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank) - ($model->otherPayable + $model->amountOwnSubsidy + $model->amountOwnDirect + $model->purchasePayable + $model->bankOverdraft+ $model->taxation);
			$model->total_4=$model->pro_1 + $model->intangible_1 + $model->development_1 + $model->invest_sub_1 + $model->invest_aso_1 + $model->other_1 + $model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank - $model->otherPayable - $model->amountOwnSubsidy- $model->amountOwnDirect- $model->purchasePayable- $model->bankOverdraft- $model->taxation;
			$model->shareHolderfund=$model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost;
			$model->total_5=$model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest;
			$model->total_6=$model->purchasePayable1 + $model->taxLiabilities;
			$model->total_7=$model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest+$model->purchasePayable1 + $model->taxLiabilities;
			$model->lossProfitFromOperations=$model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses;
			$model->lossProfitbeforetaxation=$model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses+$model->financeCost+ $model->sharedOfLossprofit;
			$model->lossProfitaftertaxation=$model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses+$model->financeCost+ $model->sharedOfLossprofit+$model->taxationFinance;
			$model->netlossProfitforthefinancialyear=$model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses+$model->financeCost+ $model->sharedOfLossprofit+$model->taxationFinance+$model->minoritySharedholder;
			
			if (($model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation)>0){
			$model->currentRatio=($model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank)/($model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation);
		     }
			

			if(($model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation)>0){
			$model->quickRatio=(($model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank )-0-0)/($model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation);
			}


          if(($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost)*100>0){
          $model->debtToEquity=(($model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation)+($model->purchasePayable1 + $model->taxLiabilities))/($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost)*100;
            }

             if((($model->pro_1 + $model->intangible_1 + $model->development_1 + $model->invest_sub_1 + $model->invest_aso_1 + $model->other_1)+($model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank))>0){
            $model->debtTototalassets=(($model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation)+($model->purchasePayable1 + $model->taxLiabilities))/(($model->pro_1 + $model->intangible_1 + $model->development_1 + $model->invest_sub_1 + $model->invest_aso_1 + $model->other_1)+($model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank));
			}

			if(($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest)>0){
			$model->totalCapitalisation=($model->purchasePayable1 + $model->taxLiabilities)/($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest);
			}

			if(($model->financeCost)>0 || ($model->financeCost)<0){
			$model->interestCoverage=($model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses+$model->financeCost+ $model->sharedOfLossprofit)/($model->financeCost);
			}

			if(($model->revenue + $model->otherOperatingIncome)>0){
			$model->grossProfitmargin=($model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses)/($model->revenue + $model->otherOperatingIncome);
			}

			if(($model->revenue + $model->otherOperatingIncome)>0){
			$model->netProfitMargin=($model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses+$model->financeCost+ $model->sharedOfLossprofit+$model->taxationFinance)/($model->revenue + $model->otherOperatingIncome);
			}

			if($model->revenue>0){
			$model->grossOperatingmargin=($model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses)/$model->revenue;
			}

			if(($model->revenue)>0){
			$model->netOperatingmargin=(($model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses+$model->financeCost+ $model->sharedOfLossprofit)+($model->financeCost))/($model->revenue);
			}

			if(($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost)>0){
			$model->returnOnequity=($model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses+$model->financeCost+ $model->sharedOfLossprofit+$model->taxationFinance)/($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost);
			}

			if((($model->pro_1 + $model->intangible_1 + $model->development_1 + $model->invest_sub_1 + $model->invest_aso_1 + $model->other_1)+($model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank))>0){
			$model->returnOnassets=(($model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses+$model->financeCost+ $model->sharedOfLossprofit)+($model->financeCost))/(($model->pro_1 + $model->intangible_1 + $model->development_1 + $model->invest_sub_1 + $model->invest_aso_1 + $model->other_1)+($model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank));
			}


			if((($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest)+($model->purchasePayable1 + $model->taxLiabilities))>0){
			$model->returnOncapitalemployed=($model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses)/(($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest)+($model->purchasePayable1 + $model->taxLiabilities));
			}
			
			if(($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest)>0){
			$model->earningPershare=($model->revenue + $model->otherOperatingIncome+ $model->directOperatingExpenses+ $model->administrationExpenses+ $model->otherOperatingExpenses+$model->financeCost+ $model->sharedOfLossprofit)/($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest);
			}

			if((($model->pro_1 + $model->intangible_1 + $model->development_1 + $model->invest_sub_1 + $model->invest_aso_1 + $model->other_1)+($model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank))>0){
			$model->totalAssetturnover=($model->revenue)/(($model->pro_1 + $model->intangible_1 + $model->development_1 + $model->invest_sub_1 + $model->invest_aso_1 + $model->other_1)+($model->tradeReceivable + $model->otherReceivable + $model->amountSubsidy + $model->amountAssociated+ $model->fixedDeposit+ $model->cash_bank));
			}

			if(($model->pro_1 + $model->intangible_1 + $model->development_1 + $model->invest_sub_1 + $model->invest_aso_1 + $model->other_1)>0){
			$model->fixedAssetsturnover=($model->revenue)/($model->pro_1 + $model->intangible_1 + $model->development_1 + $model->invest_sub_1 + $model->invest_aso_1 + $model->other_1);
			}

			if(($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest)>0){
			$model->gearingRatiodebt=(($model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation)+($model->purchasePayable1 + $model->taxLiabilities))/($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest);
			}

			if(((($model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation)+($model->purchasePayable1 + $model->taxLiabilities))+($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest))>0){
			$model->gearingRatiofinance=(($model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation)+($model->purchasePayable1 + $model->taxLiabilities))/((($model->otherPayable + $model->amountOwnSubsidy+ $model->amountOwnDirect+ $model->purchasePayable+ $model->bankOverdraft+ $model->taxation)+($model->purchasePayable1 + $model->taxLiabilities))+($model->shareCapital + $model->sharePremium+ $model->preferenceShare+ $model->foreignExchange+ $model->AccLost+$model->preferenceShare1+$model->minorityInterest));
			}

			if(($model->financeCost)>0 || ($model->financeCost)<0 ){
			$model->interestCover=($model->revenue + $model->otherOperatingIncome + $model->directOperatingExpenses + $model->administrationExpenses + $model->otherOperatingExpenses)/-($model->financeCost);
             }



			if($model->save())
				$this->redirect(array('select_general'));
		}

		$this->render('index',array(
			'model'=>$model,
		));
		
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