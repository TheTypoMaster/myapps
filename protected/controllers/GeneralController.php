<?php

class GeneralController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','generalLedger','search','selectYearExisted','addMoreItem','createGeneralLedger','GenerateLedgerGeneral','yearReportSheet','balancesheet','selectlegeritem','incomebalancesheet','cashflowstatement','deleteitem','deletenew'),
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
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            $model =$this->loadModel($id); 
            $items = Yii::app()->db->createCommand("select I.name,IV.value,I.isMandatory from tbl_item as I inner join tbl_item_value as IV on I.id = IV.item_id where IV.company_id='".$model->company_id."' and IV.year='".$model->year."'")->queryAll();
            $this->render('view',array(
                    'model'=>$model,
                    'items'=>$items
            ));
	}


//Nie code untuk upload images
/* 
	public function actionUpload(){
    $file = CUploadedFile::getInstanceByName('file');
    // Do your business ... save on file system for example,
    // and/or do some db operations for example
    $file->saveAs('images/'.$file->getName());
    // return the new file path
    echo Yii::app()->baseUrl.'/images/'.$file->getName();
}

*/

	/*Yang nie untuk view select_General
	public function actionSelect_general()
	{
		$this->render('select_general');
	}*/

	/*Yang nie nak view Income Statement*/
	public function actionIncomeStatement($id)
	{
		$this->render('incomeStatement',array(
			'model'=>$this->loadModel($id),
		));
	}
       
       public function actionDeleteItem()
       {
           $item_id = $_REQUEST['item_id'];
           Item::model()->deleteAll("id =".$item_id);
       }
    
        public function actionCashFlowStatement()
        {
           
           if(isset($_REQUEST['Company_report_sheet']))
            {
	        $template =""; 
                $company_id= $_REQUEST['Company_report_sheet'];
                $company_name = $_REQUEST['Company_report_sheet_name'];
                $year = $_REQUEST['year_report_sheet'];
                $year_arr = ($year=="")?explode(",", $_REQUEST['years_hide']): array("",$year);
                
               /*CASH FLOW template*/
                    
                $template.="<h4><span style='padding-left: 267px;'>CASH FLOW STATEMENT</span></h4>";
                $template.="<h4><span style='padding-left: 167px;'>COMPANY NAME: ".$company_name." COMPANY ID: ".$company_id."</span></h4>";
                $template.="<hr/>";
                $template .= "<table width='882'>";
                $template.="<tr>";
               
                $template.="<td><h4>YEAR</h4></td>";
                for($j=1;$j<count($year_arr);$j++)
                {
                    $template.="<td valign='center'><h4>".$year_arr[$j]."</h4></td>";
                }
               
                $cash_flow_from_operating_activity = 
                    ($year =="")?Yii::app()->db->createCommand("select IV.item_id, I.name,IV.value,IV.year 
                                                                from tbl_item as I 
                                                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                where IV.company_id = '".$company_id."' 
                                                                and I.category = 'CASH FLOW FROM OPERATING ACTIVITIES' 
                                                                order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                                                                select I.name,IV.value,IV.year,I.category 
                                                                from tbl_item as I 
                                                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                                                where IV.company_id = '".$company_id."' 
                                                                and IV.year='".$year."' 
                                                                and I.category = 'CASH FLOW FROM OPERATING ACTIVITIES' 
                                                                order by I.id")->queryAll();
                 
                if(!empty($cash_flow_from_operating_activity))
                {
                    $cash_flow_from_operating_activity_statitis = array();
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $cash_flow_from_operating_activity_statitis[$year_arr[$j]]=0;
                    }
                   
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>CASH FLOW FROM OPERATING ACTIVITIES</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";
                    for($i=0;$i<count($cash_flow_from_operating_activity);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$cash_flow_from_operating_activity[$i]['name']."</td>";
                        while($j<count($year_arr))
                        {
                            if(isset($cash_flow_from_operating_activity[$i]['year']) && 
                               $year_arr[$j]==$cash_flow_from_operating_activity[$i]['year'])
                            {

                                $template.="<td valign='center'>".
                                    number_format($cash_flow_from_operating_activity[$i]['value'])."</td>";
                                
                                $cash_flow_from_operating_activity_statitis[$year_arr[$j]]+=$cash_flow_from_operating_activity[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }
                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                    
                    $template.="<td><h5><i>(Total cash inflow from operating<br/>activities)</i></h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".
                            number_format($cash_flow_from_operating_activity_statitis[$year_arr[$j]])."</h5></td>";
                    }
                    $template.="</tr>";  
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                }
                
                
                 //CASH FLOW FROM INVESTING ACTIVITIES
                 $cash_flow_from_operating_investing = ($year =="")?Yii::app()->db->createCommand("
                                            select IV.item_id, I.name,IV.value,IV.year 
                                            from tbl_item as I 
                                            inner join tbl_item_value as IV on I.id = IV.item_id 
                                            where IV.company_id = '".$company_id."' 
                                            and I.category = 'CASH FLOW FROM INVESTING ACTIVITIES' 
                                            order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                                            select I.name,IV.value,IV.year,I.category 
                                            from tbl_item as I 
                                            inner join tbl_item_value as IV on I.id = IV.item_id 
                                            where IV.company_id = '".$company_id."' 
                                            and IV.year='".$year."' 
                                            and I.category = 'CASH FLOW FROM INVESTING ACTIVITIES' 
                                            order by I.id")->queryAll();
               
                 $cash_flow_from_operating_investing_statitis = array();
               
                for($j=1;$j<count($year_arr);$j++)
                {
                    $cash_flow_from_operating_investing_statitis[$year_arr[$j]]=0;
                }
                 if(!empty($cash_flow_from_operating_investing))
                 {
                    
                    
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>CASH FLOW FROM INVESTING<br/>ACTIVITIES</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";

                    for($i=0;$i<count($cash_flow_from_operating_investing);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$cash_flow_from_operating_investing[$i]['name']."</td>";
                        
                        while($j<count($year_arr))
                        {
                            if(isset($cash_flow_from_operating_investing[$i]['year']) && 
                               $year_arr[$j]==$cash_flow_from_operating_investing[$i]['year'])
                            {

                                $template.="<td valign='center'>".number_format($cash_flow_from_operating_investing[$i]['value'])."</td>";
                                
                                $cash_flow_from_operating_investing_statitis[$year_arr[$j]]+=$cash_flow_from_operating_investing[$i]['value'];
                                
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }

                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                     
                    $template.="<td><h5><i>(Total cash outflow from investing<br/>activitie)</i></h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".
                            number_format($cash_flow_from_operating_investing_statitis[$year_arr[$j]])."</h5></td>";
                    }
                     
                    $template.="</tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                     
                    $template.="<td><h5>GROSS PROFIT</h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.= "<td valign='center'><h5>".
                            number_format(($cash_flow_from_operating_activity_statitis[$year_arr[$j]] 
                                           - $cash_flow_from_operating_investing_statitis[$year_arr[$j]]))."</h5></td>";
                    }
                     
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                 }
                 
                 //NET CASH INFLOW FROM
                $net_cash_inflow_from_financing_activies = ($year =="")?Yii::app()->db->createCommand("
                                        select IV.item_id, I.name,IV.value,IV.year 
                                        from tbl_item as I 
                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                        where IV.company_id = '".$company_id."' 
                                        and I.category = 'NET CASH INFLOW FROM FINANCING ACTIVITIES' 
                                        order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                                        select I.name,IV.value,IV.year,I.category 
                                        from tbl_item as I 
                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                        where IV.company_id = '".$company_id."' 
                                        and IV.year='".$year."' 
                                        and I.category = 'NET CASH INFLOW FROM' 
                                        order by I.id")->queryAll();
              
                 if(!empty($net_cash_inflow_from_financing_activies))
                 {
                    $net_cash_inflow_from_financing_activies_statitis = array();
                     
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $net_cash_inflow_from_financing_activies_statitis[$year_arr[$j]]=0;
                    }
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>NET CASH INFLOW FROM<br/>FINANCING ACTIVITIES</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";

                    for($i=0;$i<count($net_cash_inflow_from_financing_activies);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$net_cash_inflow_from_financing_activies[$i]['name']."</td>";
                        while($j<count($year_arr))
                        {
                            if(isset($net_cash_inflow_from_financing_activies[$i]['year']) 
                               && $year_arr[$j]==$net_cash_inflow_from_financing_activies[$i]['year'])
                            {

                                $template.="<td valign='center'>".
                                    number_format($net_cash_inflow_from_financing_activies[$i]['value'])."</td>";
                                $net_cash_inflow_from_financing_activies_statitis[$year_arr[$j]] += 
                                    $net_cash_inflow_from_financing_activies[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }

                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td><h5><i>(CLOSING CASH AND CASH <br/>EQUIVALENT)</i></h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".
                            number_format($net_cash_inflow_from_financing_activies_statitis[$year_arr[$j]])."</h5></td>";
                    }
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                   
                    }
					
		   $template .="</table>";
             
                   echo $template;
                    
                 }
                 
               
        }
    
        //*******************************************************INCOME STATEMENT*****************************************************
        public function actionIncomeBalanceSheet()
        {
           $template =""; 
           if(isset($_REQUEST['Company_report_sheet']))
            {
                $company_id= $_REQUEST['Company_report_sheet'];
                $company_name = $_REQUEST['Company_report_sheet_name'];
                $year = $_REQUEST['year_report_sheet'];
                 $year_arr = ($year=="")?explode(",", $_REQUEST['years_hide']): array("",$year);
                
               /*Income sheet template*/
                    
                $template.="<h4><span style='padding-left: 152px;'>STATEMENT OF FINANCIAL PERFORMANCE / INCOME STATEMENT</span></h4>";
                $template.="<h4><span style='padding-left: 167px;'>COMPANY NAME: ".$company_name." COMPANY ID: ".$company_id."</span></h4>";
                $template.="<hr/>";
                $template .= "<table width='882'>";
                $template.="<tr>";
               
                $template.="<td><h4>YEAR</h4></td>";
                for($j=1;$j<count($year_arr);$j++)
                {
                    $template.="<td valign='center'><h4>".$year_arr[$j]."</h4></td>";
                }
                $revenue = ($year =="")?Yii::app()->db->createCommand("
                                        select IV.item_id, I.name,IV.value,IV.year 
                                        from tbl_item as I 
                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                        where IV.company_id = '".$company_id."' 
                                        and I.category = 'REVENUE' 
                                        order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                                        select I.name,IV.value,IV.year,I.category 
                                        from tbl_item as I 
                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                        where IV.company_id = '".$company_id."' 
                                        and IV.year='".$year."' 
                                        and I.category = 'REVENUE' 
                                        order by I.id")->queryAll();
                 
                if(!empty($revenue))
                {
                    $revenue_statitis = array();
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $revenue_statitis[$year_arr[$j]]=0;
                    }
                   
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>REVENUE</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";
                    for($i=0;$i<count($revenue);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$revenue[$i]['name']."</td>";
                        while($j<count($year_arr))
                        {
                            if(isset($revenue[$i]['year'])&&$year_arr[$j]==$revenue[$i]['year'])
                            {

                                $template.="<td valign='center'>".number_format($revenue[$i]['value'])."</td>";
                                $revenue_statitis[$year_arr[$j]]+=$revenue[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }
                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td><h5><i>(TOTAL REVENUE)</i></h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".number_format($revenue_statitis[$year_arr[$j]])."</h5></td>";
                    }
                    $template.="</tr>";  
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                }
                
                
                //COST OF GOOD SOLD
                $cost_of_good_sold = ($year =="")?Yii::app()->db->createCommand("
                                select IV.item_id, I.name,IV.value,IV.year 
                                from tbl_item as I 
                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                where IV.company_id = '".$company_id."' 
                                and I.category = 'COST OF GOOD SOLD' 
                                order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                                select I.name,IV.value,IV.year,I.category 
                                from tbl_item as I 
                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                where IV.company_id = '".$company_id."' 
                                and IV.year='".$year."' 
                                and I.category = 'COST OF GOOD SOLD' order by I.id")->queryAll();
               
                $cost_of_good_sold_statitis = array();
               
                for($j=1;$j<count($year_arr);$j++)
                {
                    $cost_of_good_sold_statitis[$year_arr[$j]]=0;
                }
               
                 if(!empty($cost_of_good_sold))
                 {
                    
                    
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>LESS:<br/>COST OF GOOD SOLD</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";

                    for($i=0;$i<count($cost_of_good_sold);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$cost_of_good_sold[$i]['name']."</td>";
                        
                        while($j<count($year_arr))
                        {
                            if(isset($cost_of_good_sold[$i]['year'])&&$year_arr[$j]==$cost_of_good_sold[$i]['year'])
                            {

                                $template.="<td valign='center'>".number_format($cost_of_good_sold[$i]['value'])."</td>";
                                $cost_of_good_sold_statitis[$year_arr[$j]]+=$cost_of_good_sold[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }

                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                     
                    $template.="<td><h5><i>(TOTAL COGS)</i></h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".number_format($cost_of_good_sold_statitis[$year_arr[$j]])."</h5></td>";
                    }
                     
                     
                    $template.="</tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                     
                    $template.="<td><h5>GROSS PROFIT</h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".
                            number_format(($revenue_statitis[$year_arr[$j]] - $cost_of_good_sold_statitis[$year_arr[$j]]))."</h5></td>";
                    }
                     
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                 }
                 
               
                 //OTHER INCOME
                $other_income = ($year =="")?Yii::app()->db->createCommand("
                            select IV.item_id, I.name,IV.value,IV.year 
                            from tbl_item as I 
                            inner join tbl_item_value as IV on I.id = IV.item_id 
                            where IV.company_id = '".$company_id."' 
                            and I.category = 'CURRENT ASSETS' 
                            order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                            select I.name,IV.value,IV.year,I.category 
                            from tbl_item as I 
                            inner join tbl_item_value as IV on I.id = IV.item_id 
                            where IV.company_id = '".$company_id."' 
                            and IV.year='".$year."' 
                            and I.category = 'CURRENT ASSETS' 
                            order by I.id")->queryAll();

                 if(!empty($other_income))
                 {
                    $other_income_statitis = array();
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $other_income_statitis[$year_arr[$j]]=0;
                    }
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>OTHER INCOME</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";

                    for($i=0;$i<count($other_income);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$other_income[$i]['name']."</td>";
                        while($j<count($year_arr))
                        {
                            if(isset($other_income[$i]['year'])&&$year_arr[$j]==$other_income[$i]['year'])
                            {

                                $template.="<td valign='center'>".number_format($other_income[$i]['value'])."</td>";
                                $other_income_statitis[$year_arr[$j]]+=$other_income[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }

                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td><h5><i>(TOTAL OTHER INCOME)</i></h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".number_format($other_income_statitis[$year_arr[$j]])."</h5></td>";
                    }
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                   
                 }
               
                 //EXPENSES
                $expenses = ($year =="")?Yii::app()->db->createCommand("
                                select IV.item_id, I.name,IV.value,IV.year 
                                from tbl_item as I 
                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                where IV.company_id = '".$company_id."' 
                                and I.category = 'EXPENSES' 
                                order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                                select I.name,IV.value,IV.year,I.category 
                                from tbl_item as I 
                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                where IV.company_id = '".$company_id."' 
                                and IV.year='".$year."' 
                                and I.category = 'EXPENSES' 
                                order by I.id")->queryAll();
               
                $taxions = Yii::app()->db->createCommand("select IV.item_id, I.name,IV.value,IV.year 
                                                          from tbl_item as I 
                                                          inner join tbl_item_value as IV on I.id = IV.item_id 
                                                          where IV.company_id = '".$company_id."' 
                                                          and I.name = 'Taxation' 
                                                          order by IV.year")->queryAll();
                $taxions_statitis = array();
                $expenses_statitis = array();
                for($j=1;$j<count($year_arr);$j++)
                {
                    $expenses_statitis[$year_arr[$j]]=0;
                    $taxions_statitis[$year_arr[$j]]=isset($taxions[$j-1]['value'])?$taxions[$j-1]['value']: 0;
                }
                 if(!empty($expenses))
                 {
                   
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>EXPENSES</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";

                    for($i=0;$i<count($expenses);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$expenses[$i]['name']."</td>";
                        while($j<count($year_arr))
                        {
                            if(isset($expenses[$i]['year'])&&$year_arr[$j]==$expenses[$i]['year'])
                            {

                                $template.="<td valign='center'>".number_format($expenses[$i]['value'])."</td>";
                                $expenses_statitis[$year_arr[$j]]+=$expenses[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }

                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                     
                    $template.="<td><h5>TOTAL EXPENSES</h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".number_format($expenses_statitis[$year_arr[$j]])."</h5></td>";
                    }
                    $template.="</tr>";
                    }

                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
               
                    $template.="<td><h5>NET INCOME/PROFIT</h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.= "<td valign='center'><h5>".
                            number_format($revenue_statitis[$year_arr[$j]] 
                                          - $cost_of_good_sold_statitis[$year_arr[$j]] 
                                          + $other_income_statitis[$year_arr[$j]] 
                                          - $expenses_statitis[$year_arr[$j]]).
                                    "</h5></td>";
                    }
                    $template.="</tr>";
                     $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
               
                    $template.="<td><h5>PROFIT AFTER TAXATION</h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.= "<td valign='center'><h5>".
                            number_format($revenue_statitis[$year_arr[$j]] 
                                          - $cost_of_good_sold_statitis[$year_arr[$j]] 
                                          + $other_income_statitis[$year_arr[$j]] 
                                          - $expenses_statitis[$year_arr[$j]] 
                                          - $taxions_statitis[$year_arr[$j]]).
                                    "</h5></td>";
                    }
               
                    $template.="</tr>";
					
		            $template.="</tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    
                 }
                 
                $template .="</table>";
             
                echo $template;
        }
        //*******************************************************INCOME STATEMENT*****************************************************
    

        public function actionBalanceSheet()
        {
           
            if(isset($_REQUEST['Company_report_sheet']))
            {
                $company_id= $_REQUEST['Company_report_sheet'];
                $company_name = $_REQUEST['Company_report_sheet_name'];
                $year = $_REQUEST['year_report_sheet'];
                $year_arr = ($year=="")?explode(",", $_REQUEST['years_hide']): array("",$year);
               
                $non_current_asset = ($year =="")?Yii::app()->db->createCommand("
                                    select IV.item_id, I.name,IV.value,IV.year 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and I.category = 'NON CURRENT ASSET' 
                                    order by I.id,IV.year")->queryAll():Yii::app()->db->createCommand("
                                    select I.name,IV.value,IV.year,I.category 
                                    from tbl_item as I 
                                    inner join tbl_item_value as IV on I.id = IV.item_id 
                                    where IV.company_id = '".$company_id."' 
                                    and IV.year='".$year."' 
                                    and I.category = 'NON CURRENT ASSET' 
                                    order by I.id")->queryAll();
                
                if(!empty($non_current_asset))
                {
                    $non_current_asset_statitis = array();
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $non_current_asset_statitis[$year_arr[$j]]=0;
                    }
                    
                    /*Balance sheet template*/
                    $template ="";
                    $template.="<h4><span style='padding-left: 267px;'>BALANCE SHEET STATEMENT</span></h4>";
                    $template.="<h4><span style='padding-left: 167px;'>COMPANY NAME: ".$company_name.
                               " COMPANY ID: ".$company_id."</span></h4>";
                    $template.="<hr/>";
                    $template .= "<table width='882'>";
                    $template.="<tr>";
                    
                    $template.="<td><h4>YEAR</h4></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h4>".$year_arr[$j]."</h4></td>";
                    }
                    
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>NON CURRENT ASSET</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";
                    
                    for($i=0;$i<count($non_current_asset);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$non_current_asset[$i]['name']."</td>";
                        while($j<count($year_arr))
                        {
                            if(isset($non_current_asset[$i]['year'])&&$year_arr[$j]==$non_current_asset[$i]['year'])
                            {

                                $template.="<td valign='center'>".number_format($non_current_asset[$i]['value'])."</td>";
                                $non_current_asset_statitis[$year_arr[$j]]+=$non_current_asset[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }
                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                    
                    $template.="<td><h5><i>(TOTAL NON-CURRENT ASSETS)</i></h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".number_format($non_current_asset_statitis[$year_arr[$j]])."</h5></td>";
                        
                    }
                    $template.="</tr>";  
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                }
                
                //Current_Asset
                $current_asset = ($year =="")?Yii::app()->db->createCommand("
                            select IV.item_id, I.name,IV.value,IV.year 
                            from tbl_item as I 
                            inner join tbl_item_value as IV on I.id = IV.item_id 
                            where IV.company_id = '".$company_id."' 
                            and I.category = 'CURRENT ASSETS' 
                            order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                            select I.name,IV.value,IV.year,I.category 
                            from tbl_item as I 
                            inner join tbl_item_value as IV on I.id = IV.item_id 
                            where IV.company_id = '".$company_id."' 
                            and IV.year='".$year."' 
                            and I.category = 'CURRENT ASSETS' 
                            order by I.id")->queryAll();
              
                 if(!empty($current_asset))
                 {
                    $current_asset_statitis = array();
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $current_asset_statitis[$year_arr[$j]]=0;
                    }
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>CURRENT ASSET</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";

                    for($i=0;$i<count($current_asset);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$current_asset[$i]['name']."</td>";
                        while($j<count($year_arr))
                        {
                            if(isset($current_asset[$i]['year'])&&$year_arr[$j]==$current_asset[$i]['year'])
                            {

                                $template.="<td valign='center'>".number_format($current_asset[$i]['value'])."</td>";
                                $current_asset_statitis[$year_arr[$j]]+=$current_asset[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }

                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                     
                    $template.="<td><h5><i>(TOTAL CURRENT ASSETS)</i></h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".number_format($current_asset_statitis[$year_arr[$j]])."</h5></td>";
                    }
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                     
                    $template.="<td><h5>TOTAL ASSETS</h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td ><h5>".
                            number_format(($current_asset_statitis[$year_arr[$j]] 
                                           + $non_current_asset_statitis[$year_arr[$j]])).
                                   "</h5></td>";
                    }
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";

                 }
                
                //CURRENT LIABILITIES
                 $current_liabilities = ($year =="")?Yii::app()->db->createCommand("
                                select IV.item_id, I.name,IV.value,IV.year 
                                from tbl_item as I 
                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                where IV.company_id = '".$company_id."' 
                                and I.category = 'CURRENT LIABILITIES' 
                                order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                                select I.name,IV.value,IV.year,I.category 
                                from tbl_item as I 
                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                where IV.company_id = '".$company_id."' 
                                and IV.year='".$year."' 
                                and I.category = 'CURRENT LIABILITIES' 
                                order by I.id")->queryAll();
              
                 if(!empty($current_liabilities))
                 {
                    $current_liabilities_statitis = array();
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $current_liabilities_statitis[$year_arr[$j]]=0;
                    }
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>LESS:<br/>CURRENT LIABILITIES</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";

                    for($i=0;$i<count($current_liabilities);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$current_liabilities[$i]['name']."</td>";
                        while($j<count($year_arr))
                        {
                            if(isset($current_liabilities[$i]['year'])&&$year_arr[$j]==$current_liabilities[$i]['year'])
                            {

                                $template.="<td valign='center'>".number_format($current_liabilities[$i]['value'])."</td>";
                                $current_liabilities_statitis[$year_arr[$j]]+=$current_liabilities[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }

                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td><h5><i>(TOTAL CURRENT LIABILITIES)</i></h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".number_format($current_liabilities_statitis[$year_arr[$j]])."</h5></td>";
                    }
                    $template.="</tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="
                                <td><h5>
                                    NET CURRENT ASSETS or NET CURRENT LIABILITIES?
                                </h5></td>
                               ";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".
                            number_format(($current_asset_statitis[$year_arr[$j]]
                                           - $current_liabilities_statitis[$year_arr[$j]])).
                                   "</h5></td>";
                        
                        $netCL=number_format(($current_asset_statitis[$year_arr[$j]]
                                                              - $current_liabilities_statitis[$year_arr[$j]]));
                    }
                     
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                     
                    
                 }
                
                //************************************BALANCE NO. 1********************************************
                    $template.="</tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td><h5>TOTAL NON-CURRENT ASSET + NET CURRENT LIABILITIES</h5></td>";
                
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        
                        $template.="<td valign='center'><h5>".
                            number_format($non_current_asset_statitis[$year_arr[$j]] 
                                           + ($current_asset_statitis[$year_arr[$j]]
                                           - $current_liabilities_statitis[$year_arr[$j]])).
                                   "</h5></td>";
                    }
                 //********************************************************************************************
                 
                 //FINANCED BY / EQUITY
                $finaced_by_or_equity = ($year =="")?Yii::app()->db->createCommand("
                                select IV.item_id, I.name,IV.value,IV.year 
                                from tbl_item as I 
                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                where IV.company_id = '".$company_id."' 
                                and I.category = 'FINANCED BY / EQUITY' 
                                order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                                select I.name,IV.value,IV.year,I.category 
                                from tbl_item as I 
                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                where IV.company_id = '".$company_id."' 
                                and IV.year='".$year."' 
                                and I.category = 'FINANCED BY / EQUITY' 
                                order by I.id")->queryAll();
              
                 if(!empty($finaced_by_or_equity))
                 {
                    $finaced_by_or_equity_statitis = array();
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $finaced_by_or_equity_statitis[$year_arr[$j]]=0;
                    }
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>Financed by:<br/>FINANCED BY / EQUITY</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";

                    for($i=0;$i<count($finaced_by_or_equity);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$finaced_by_or_equity[$i]['name']."</td>";
                        while($j<count($year_arr))
                        {
                            if(isset($finaced_by_or_equity[$i]['year'])&&$year_arr[$j]==$finaced_by_or_equity[$i]['year'])
                            {

                                $template.="<td valign='center'>".number_format($finaced_by_or_equity[$i]['value'])."</td>";
                                $finaced_by_or_equity_statitis[$year_arr[$j]]+=$finaced_by_or_equity[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }

                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                     
                    $template.="<td><h5>SHAREHOLDER’S EQUITY</h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".number_format($finaced_by_or_equity_statitis[$year_arr[$j]])."</h5></td>";
                    }
                    $template.="</tr>";
                 }
                 
                 //NON-CURRENT LIABILITIES
                 $no_current_liabilities = ($year =="")?Yii::app()->db->createCommand("
                                        select IV.item_id, I.name,IV.value,IV.year 
                                        from tbl_item as I 
                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                        where IV.company_id = '".$company_id."' 
                                        and I.category = 'NON-CURRENT LIABILITIES' 
                                        order by I.id, IV.year ")->queryAll():Yii::app()->db->createCommand("
                                        select I.name,IV.value,IV.year,I.category 
                                        from tbl_item as I 
                                        inner join tbl_item_value as IV on I.id = IV.item_id 
                                        where IV.company_id = '".$company_id."' 
                                        and IV.year='".$year."' 
                                        and I.category = 'NON-CURRENT LIABILITIES' 
                                        order by I.id")->queryAll();
              
                 if(!empty($no_current_liabilities))
                 {
                    $no_current_liabilities_statitis = array();
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $no_current_liabilities_statitis[$year_arr[$j]]=0;
                    }
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><h5>NON-CURRENT LIABILITIES</h5></td>";
                    $template.="</tr>";
                    $template.="</tr>";

                    for($i=0;$i<count($no_current_liabilities);)
                    {
                        $template .="<tr>";
                        $j=1;
                        $template.="<td>".$no_current_liabilities[$i]['name']."</td>";
                        while($j<count($year_arr))
                        {
                            if(isset($no_current_liabilities[$i]['year'])&&$year_arr[$j]==$no_current_liabilities[$i]['year'])
                            {

                                $template.="<td valign='center'>".number_format($no_current_liabilities[$i]['value'])."</td>";
                                $no_current_liabilities_statitis[$year_arr[$j]]+=$no_current_liabilities[$i]['value'];
                                $i++;
                            }
                            else
                            {
                                $template.='<td>0</td>';
                            }
                            $j++;

                        }
                        $template.="</tr>";
                    }

                    $template.="<tr>";

                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                     
                    $template.="<td><h5><i>(TOTAL NON-CURRENT LIABILITIES)</i></h5></td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.="<td valign='center'><h5>".number_format($no_current_liabilities_statitis[$year_arr[$j]])."</h5></td>";
                    }
                    $template.="</tr>";
                     
                    //************************************BALANCE NO. 2********************************************
                    $template.="</tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td><h5>SHAREHOLDERS EQUITY + TOTAL NON-CURRENT LIABILITIES</h5></td>";

                    for($j=1;$j<count($year_arr);$j++)
                    {
                            $template.="<td valign='center'><h5>".number_format($finaced_by_or_equity_statitis[$year_arr[$j]]
                                                                                + $no_current_liabilities_statitis[$year_arr[$j]]).
                                       "</h5></td>";

                    }
                    //*********************************************************************************************
  
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td>This value refer to?????</td>";
                    for($j=1;$j<count($year_arr);$j++)
                    {
                        $template.= "<td valign='center'><h5>".
                            number_format($non_current_asset_statitis[$year_arr[$j]] 
                                          + $current_asset_statitis[$year_arr[$j]] 
                                          + $current_liabilities_statitis[$year_arr[$j]]).
                                    "</h5></td>";
                    }
                     
                    $template.="</tr>";
                    $template.="<tr>";
                    $template.="<td colspan='".count($year_arr)."'><hr/></td>";
                    $template.="</tr>";
                    
                 }
                
               
                
                $template .="</table>";
                echo $template;
                
            }
        }
    
    
        public function actionCreateGeneralLedger()
        {
            $result = "";
            
            if(isset($_REQUEST['General_company_name']))
            {
                $company_id = $_REQUEST['General_company_name'];
                $year = $_REQUEST['year'];
                $rows1 = Yii::app()->db->createCommand("select I.id, I.name, I.isMandatory,I.category,IV.value 
                                                        from tbl_item as I 
                                                        inner join tbl_select_ledger_item as SI on I.id = SI.item_id   
                                                        left join tbl_item_value as IV  on I.id = IV.item_id 
                                                        where SI.company_id ='".$company_id."' 
                                                        and (IV.year ='".$year."' 
                                                        or IV.year is null)
                                                        group by I.name
                                                        order by (
                                                            case category 
                                                            when 'NON CURRENT ASSET' then 0
                                                            when 'CURRENT ASSET' then 1
                                                            when 'CURRENT LIABILITIES' then 2
                                                            when 'FINANCED BY / EQUITY' then 3
                                                            when 'NON-CURRENT LIABILITIES' then 4
                                                            when 'REVENUE' then 5
                                                            when 'COST OF GOOD SOLD' then 6
                                                            when 'OTHER INCOME' then 7
                                                            when 'EXPENSES' then 8
                                                            when 'CASH FLOW FROM OPERATING ACTIVITIES' then 9
                                                            when 'CASH FLOW FROM INVESTING ACTIVITIES' then 10
                                                            when 'NET CASH INFLOW FROM FINANCING ACTIVITIES' then 11
                                                            end
                                                            )")->queryAll();
                
                $rows2 = Yii::app()->db->createCommand("select I.id, I.name, I.isMandatory,I.category,0 as value 
                                                        from tbl_item as I 
                                                        inner join tbl_select_ledger_item as SI on I.id = SI.item_id   
                                                        left join tbl_item_value as IV on I.id = IV.item_id 
                                                        where SI.company_id ='".$company_id."'
                                                        group by I.name
                                                        order by (
                                                            case category 
                                                            when 'NON CURRENT ASSET' then 0
                                                            when 'CURRENT ASSET' then 1
                                                            when 'CURRENT LIABILITIES' then 2
                                                            when 'FINANCED BY / EQUITY' then 3
                                                            when 'NON-CURRENT LIABILITIES' then 4
                                                            when 'REVENUE' then 5
                                                            when 'COST OF GOOD SOLD' then 6
                                                            when 'OTHER INCOME' then 7
                                                            when 'EXPENSES' then 8
                                                            when 'CASH FLOW FROM OPERATING ACTIVITIES' then 9
                                                            when 'CASH FLOW FROM INVESTING ACTIVITIES' then 10
                                                            when 'NET CASH INFLOW FROM FINANCING ACTIVITIES' then 11
                                                            end
                                                            )")->queryAll();
                
                $rows = (count($rows1)>=count($rows2))?$rows1:$rows2;
                
                if(empty($rows))
                {
                    $rows = Yii::app()->db->createCommand("select id, name, category, isMandatory, 0 as value 
                                                            from tbl_item 
                                                            where isMandatory = 1 
                                                            order by (
                                                            case category 
                                                            when 'NON CURRENT ASSET' then 0
                                                            when 'CURRENT ASSET' then 1
                                                            when 'CURRENT LIABILITIES' then 2
                                                            when 'FINANCED BY / EQUITY' then 3
                                                            when 'NON-CURRENT LIABILITIES' then 4
                                                            when 'REVENUE' then 5
                                                            when 'COST OF GOOD SOLD' then 6
                                                            when 'OTHER INCOME' then 7
                                                            when 'EXPENSES' then 8
                                                            when 'CASH FLOW FROM OPERATING ACTIVITIES' then 9
                                                            when 'CASH FLOW FROM INVESTING ACTIVITIES' then 10
                                                            when 'NET CASH INFLOW FROM FINANCING ACTIVITIES' then 11
                                                            end
                                                            )")->queryAll();
                }
                if(!empty($rows))
                {
                    
                    $category = $rows[0]['category'];
                    $result.="<tr><td><h5>".$category."</h5></td></tr>";
                    $next_category =$category;
                    foreach($rows as $row)
                    {
                         $next_category =$row["category"];
                         if($next_category!=$category)
                         {
                             $result.="<tr><td><h5>".$next_category."</h5></td></tr>";
                             $category = $next_category;
                         }
                         $star = $row['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                         $result.="<tr>
                                 <td width='40%'>".$row['name'].$star."</td>
                                 <td width='60%'> <input type='text' name= '"."item_".$row['id']."' value='".$row['value']."'></td>
                                 </tr>";
                    }
                }
           }
           echo $result;
            
        }
    
        public function actionCreateGeneralLedger_old()
        {
             $result = "";
            
             if(isset($_REQUEST['General_company_name']))
             {
                 
              $company_id = $_REQUEST['General_company_name'];
                 
                $non_cureent_asset = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='NON CURRENT ASSET' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $cureent_asset = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='CURRENT ASSETS' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $cureent_liabilities = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='CURRENT LIABILITIES' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $no_cureent_liabilities = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='NON-CURRENT LIABILITIES' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $financed_by_equity = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='FINANCED BY / EQUITY' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $revenue = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='REVENUE' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $cost_of_good_sold = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='COST OF GOOD SOLD' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $other_income = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='OTHER INCOME' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $expense = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='EXPENSES' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $cash_flow_from_operating = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='CASH FLOW FROM OPERATING ACTIVITIES' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $cash_flow_from_investing = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='CASH FLOW FROM INVESTING ACTIVITIES' 
                                and SI.company_id ='".$company_id."'")->queryAll();
                 
             $net_cash_inflow_financing = Yii::app()->db->createCommand("
                                select I.id, I.name, I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_select_ledger_item as SI on I.id = SI.item_id  
                                where I.category ='NET CASH INFLOW FROM FINANCING ACTIVITIES' 
                                and SI.company_id ='".$company_id."'")->queryAll();
             }
             
             if(empty($non_cureent_asset) && empty($cureent_asset) && empty($cureent_liabilities) && empty($financed_by_equity))
             {
                $non_cureent_asset = Yii::app()->db->createCommand("
                            select `id`, `name`, `isMandatory` 
                            from tbl_item 
                            where `category`='NON CURRENT ASSET' 
                            and `isMandatory` = 1")->queryAll();
                 
                $cureent_asset = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory` 
                            from tbl_item 
                            where `category`='CURRENT ASSETS' 
                            and `isMandatory` = 1")->queryAll();
                 
                $cureent_liabilities = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory` 
                            from tbl_item 
                            where `category`='CURRENT LIABILITIES' 
                            and `isMandatory` = 1")->queryAll();
                 
                $no_cureent_liabilities = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory` 
                            from tbl_item 
                            where `category`='NON-CURRENT LIABILITIES' 
                            and `isMandatory` = 1")->queryAll();
                 
                $financed_by_equity = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory`  
                            from tbl_item 
                            where `category`='FINANCED BY / EQUITY' 
                            and `isMandatory` = 1")->queryAll();
                 
                $revenue = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory`  
                            from tbl_item 
                            where `category`='REVENUE' 
                            and `isMandatory` = 1")->queryAll();
                 
                $cost_of_good_sold = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory`  
                            from tbl_item 
                            where `category`='COST OF GOOD SOLD' 
                            and `isMandatory` = 1")->queryAll();
                 
                $other_income = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory`  
                            from tbl_item 
                            where `category`='OTHER INCOME' 
                            and `isMandatory` = 1")->queryAll();
                 
                $expense = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory`  
                            from tbl_item 
                            where `category`='EXPENSES' 
                            and `isMandatory` = 1")->queryAll();
                 
                $cash_flow_from_operating = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory`  
                            from tbl_item 
                            where `category`='CASH FLOW FROM OPERATING ACTIVITIES' 
                            and `isMandatory` = 1")->queryAll();
                 
                $cash_flow_from_investing = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory`  
                            from tbl_item 
                            where `category`='CASH FLOW FROM INVESTING ACTIVITIES' 
                            and `isMandatory` = 1")->queryAll();
                 
                $net_cash_inflow_financing = Yii::app()->db->createCommand("
                            select  `id`, `name`, `isMandatory`  
                            from tbl_item 
                            where `category`='NET CASH INFLOW FROM FINANCING ACTIVITIES' 
                            and `isMandatory` = 1")->queryAll();
             }
                 
            if(!empty($non_cureent_asset))
            {
                $result.="<tr><td><h5>NON CURRENT ASSET</h5></td></tr>";
                foreach($non_cureent_asset as $value)
                {
                    $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                              <td width='40%'>".$value['name'].$star."</td>
                              <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                              </tr>";
                }
            }
                 
           if(!empty($cureent_asset))
           {
               $result.="<tr><td><h5>CURRENT ASSET</h5></td></tr>";
               foreach($cureent_asset as $value)
               {
                   $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                   $result.="<tr>
                            <td width='40%'>".$value['name'].$star."</td>
                            <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                            </tr>";
               }
            }
                 
            if(!empty($cureent_liabilities))
            {
                $result.="<tr><td><h5>CURRENT LIABILITIES</h5></td></tr>";
                foreach($cureent_liabilities as $value)
                {
                    $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                              <td width='40%'>".$value['name'].$star."</td>
                              <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                              </tr>";
                }
            }
                 
            if(!empty($financed_by_equity))
            {
                $result.="<tr><td><h5>FINANCED BY / EQUITY</h5></td></tr>";
                foreach($financed_by_equity as $value)
                {
                    $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                         <td width='40%'>".$value['name'].$star."</td>
                         <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                         </tr>";
                }
            }
                 
            if(!empty($no_cureent_liabilities))
            {
                $result.="<tr><td><h5>NO CURRENT LIABILITIES</h5></td></tr>";
                foreach($no_cureent_liabilities as $value)
                {
                    $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                              <td width='40%'>".$value['name'].$star."</td>
                              <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                              </tr>";
                }
            }
                 
            if(!empty($revenue))
            {
                $result.="<tr><td><h5>REVENUE</h5></td></tr>";
                foreach($revenue as $value)
                {
                    $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                              <td width='40%'>".$value['name'].$star."</td>
                              <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                              </tr>";
                }
            }
                 
            if(!empty($cost_of_good_sold))
            {
                $result.="<tr><td><h5>COST OF GOOD SOLD</h5></td></tr>";
                foreach($cost_of_good_sold as $value)
                {
                    $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                              <td width='40%'>".$value['name'].$star."</td>
                              <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                              </tr>";
                }
             }
                 
             if(!empty($other_income))
             {
                $result.="<tr><td><h5>OTHER INCOME</h5></td></tr>";
                foreach($other_income as $value)
                {
                     $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                             <td width='40%'>".$value['name'].$star."</td>
                             <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                             </tr>";
                }
             }
                 
             if(!empty($expense))
             {
                $result.="<tr><td><h5>EXPENSES</h5></td></tr>";
                foreach($expense as $value)
                {
                     $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                             <td width='40%'>".$value['name'].$star."</td>
                             <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                             </tr>";
                }
             }
                 
            if(!empty($cash_flow_from_operating))
            {
                $result.="<tr><td><h5>CASH FLOW FROM OPERATING ACTIVITIES</h5></td></tr>";
                foreach($cash_flow_from_operating as $value)
                {
                     $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                             <td width='40%'>".$value['name'].$star."</td>
                             <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                             </tr>";
                }
            }
                 
            if(!empty($cash_flow_from_investing))
            {
                $result.="<tr><td><h5>CASH FLOW FROM INVESTING ACTIVITIES</h5></td></tr>";
                foreach($cash_flow_from_investing as $value)
                {
                    $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                              <td width='40%'>".$value['name'].$star."</td>
                              <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                              </tr>";
                }
            }
                 
            if(!empty($net_cash_inflow_financing))
            {
                $result.="<tr><td><h5>NET CASH INFLOW FROM FINANCING ACTIVITIES</h5></td></tr>";
                foreach($net_cash_inflow_financing as $value)
                {
                    $star = $value['isMandatory']==true?"<span style='color: red;'>*</span>":"";
                    $result.="<tr>
                              <td width='40%'>".$value['name'].$star."</td>
                              <td width='60%'> <input type='text' name= '"."item_".$value['id']."'></td>
                              </tr>";
                }
            
            }
         
           echo $result;
    }
            
	/*Yang nie nak view Income Statement*/
	public function actionGeneralLedger()
	{
		$this->render('generalLedger');
	}
    
    public function actionAddMoreItem()
	{
            if(isset($_REQUEST["category_item"])&& $_REQUEST["category_item"]!=""){
                    
                    $item = new Item();
                    $item->isMandatory = false;
                    $item->name = $_REQUEST["item-name"];
                    $item->category = $_REQUEST["category_item"];
                    $item->insert();
                    echo $item->id;
                    
            }
            
	}
    
    /**
    * Catching select Year event, and check data of year is exits;
    * @param type $id
    * @return boolean
    */
    public function actionSelectYearExisted($company_name,$year)
    {
            $res= Yii::app()->db->createCommand("
                        select `id` 
                        from tbl_general 
                        where `company_name`='".$company_name."' 
                        and `year`=".$year)->queryAll();
            
            echo isset($res)?1:0;
    }

    
    /**
    * Creates a new model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    */
    public function actionGenerateLedgerGeneral()
    {

            if(isset($_REQUEST['General_company_name']))
            {
                    
                    $company_id = $_REQUEST["General_company_name"];
                    $company_name = $_REQUEST["company_name"];
                    $year = $_REQUEST["year"];
                    $ret = ItemValue::model()->deleteAll("company_id ='".$company_id."' and year ='".$year."'");
                    $ret1 = General::model()->deleteAll("company_id ='".$company_id."' and year =".$year);
                    $general = new General();
                    $general->company_id = $company_id;
                    $general->company_name = $company_name;
                    $general->year = $year;
                    $general->insert();
      
                    foreach($_REQUEST as $key => $value)
                    {
                       
                        if($key=='General_company_name' || ($key=='year')||($key=='company_name'))
                            continue;
                        if($value !="")
                        {
                         $item = new ItemValue();
                         $it = explode('_', $key);
                         $item->item_id = $it[1];
                         $item->value = $value;
                         $item->company_id = $company_id;
                         $item->year = $year;
                         $item->save();
                        }
                    }
            }
    }
    public function actionSelectLegerItem()
    {
            if(isset($_POST["select_leger_items_company_name"])&& $_POST["select_leger_items_company_name"]!="")
            {  
                    $array_post = $_POST;
                  
                    $company_id = $_POST["select_leger_items_company_name"];
                    $ret = SelectLedgerItem::model()->deleteAll("company_id ='".$company_id."'");
                
 
                    foreach($array_post as $key => $value)
                    {
                        if($key=='select_leger_items_company_name')
                            continue;
                         $item = new SelectLedgerItem();
                         $item->company_id = $company_id;
                         $item->item_id = $value;
   
                        $item->save();
                    }

                }
    }
    
    public function actionSelect_general()
	{            
		$model=new General;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		

		$this->render('select_general',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            if(isset($_POST["General_company_name"])&& $_POST["General_company_name"]!="")
                {
                  
                   $company_id = $_REQUEST["General_company_name"];
                    $company_name = $_REQUEST["company_name"];
                    $year = $_REQUEST["year"];
                    
                    $general = General::model()->findByPk($id);
                    if(!isset($general))
                        $general = new General();
                    $general->company_id = $company_id;
                    $general->company_name = $company_name;
                    $general->year = $year;
                    $general->save();
                    $ret = ItemValue::model()->deleteAll("company_id ='".$company_id."' and year ='".$year."'");
                   
                    foreach($_POST as $key => $value)
                    {
                 
                        if($key=='General_company_name' || ($key=='year')||($key=='company_name'))
                            continue;
                        if($value !="")
                        {
                              
                         $item = new ItemValue();
                         $it = explode("_", $key);
                        
                         $item->item_id = $it[1];
                         $item->value = $value;
                         $item->company_id = $company_id;
                         $item->year = $year;
                         $item->save();
                        }
                    }
                    
                    //$this->redirect(Yii::app()->getBaseUrl().'/index.php/general/admin');
                }
        
		        $model=$this->loadModel($id);
                $items = Yii::app()->db->createCommand("
                                select I.id,I.name,IV.value,I.isMandatory 
                                from tbl_item as I 
                                inner join tbl_item_value as IV on I.id = IV.item_id 
                                where IV.company_id='".$model->company_id."' 
                                and IV.year='".$model->year."'")->queryAll();

		        // Uncomment the following line if AJAX validation is needed
		        // $this->performAjaxValidation($model);

		        $this->render('update',array('model'=>$model,'items' =>$items));
	}
        
    public function actionDeleteNew()
    {
                $id = $_POST['item_id'];
                $model=$this->loadModel($id);
                ItemValue::model()->deleteAll("company_id ='".$model->company_id."' and year ='".$model->year."'");
                $model->delete();
    }
    
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		       $model=$this->loadModel($id);
               ItemValue::model()->deleteAll("company_id ='".$$model->company_id."' and year ='".$$model->year."'");
               Yii::app()->db->createCommand("delete from tbl_general where id='".$id."'")->queryAll();
		
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('General');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}





	/*Yang nie untuk view Income Statement
	public function actionIncomeStatement()
	{
		$dataProvider=new CActiveDataProvider('General');
		$this->render('incomeStatement',array(
			'dataProvider'=>$dataProvider,
		));
	}  */

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new General('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['General']))
			$model->attributes=$_GET['General'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return General the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=General::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param General $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='general-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        

	public function actionSearch($term)
     {
          if(Yii::app()->request->isAjaxRequest && !empty($term))
        {
              $variants = array();
              $criteria = new CDbCriteria;
              $criteria->select='company_name';
              $criteria->addSearchCondition('company_name',$term.'%',false);
              $tags = Registration::model()->findAll($criteria);
              if(!empty($tags))
              {
                foreach($tags as $tag)
                {
                    $variants[] = $tag->attributes['company_name'];
                }
              }
              echo CJSON::encode($variants);
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
     }
	 
	public function actionYears(){
        
		$data = General::model()->findAll('company_id=:company_id ORDER BY year',array(':company_id'=>$_POST['General']['company_id']));
		
		$data = CHtml::listData($data, 'year' ,'year');
		if($_POST['General']['company_id']){
			echo CHtml::tag('option', array('value'=>''),CHtml::encode('Please Choose'),true);
			echo CHtml::tag('option', array('value'=>'all'),CHtml::encode('All'),true);
            
			foreach($data as $key => $value){
				echo CHtml::tag("option", array('value'=>$key),CHtml::encode($value),true);
			}
            
		}
		else{
            
			echo CHtml::tag('option', array('value'=>''),CHtml::encode('Choose Company First'),true);
            
		}
	}
    
	public function actionYearReportSheet()
    {
            $result ="";
        
            if(isset($_REQUEST["Company_report_sheet"]))
            {
                $company_id = $_REQUEST["Company_report_sheet"];
                
                $years = Yii::app()->db->createCommand("
                            select `year` 
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
       
	   public function actionCompanyIds()
       {
		  if($_POST['General']['company_name']){
              
			     $company_name = $_POST['General']['company_name'];
              
		  }
           
		$data = Registration::model()->findByAttributes(array('company_name'=>$company_name));
		//print_r($data);
		echo "<td><b>Company ID</b></td>";
		echo "<td>";
		//echo CHtml::tag('input', array( 'type'=>'text' , 'value' => $data->company_id));
		echo CHtml::textField("General[company_id]", $data->company_id, array('readonly'=>'readonly', 'id'=>'General_company_id'));
		echo "</td>";
           
	   }
	
}
