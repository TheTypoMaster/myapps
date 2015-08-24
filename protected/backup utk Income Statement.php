<?php echo $this->renderPartial('_balanceSheet', array('model'=>$model)); ?>

<?php 
if(isset($_GET['General'])): 
	if(isset($_GET['General']['year']) AND $_GET['General']['year'] == 'all'){
		$data = General::model()->findAll('company_id=:company_id ORDER BY year', array(':company_id'=>$_GET['General']['company_id']));
	}
	else{
		$data = General::model()->findByAttributes(array('company_id'=>$_GET['General']['company_id'], 'year'=>$_GET['General']['year']));
	}
	if(!empty($data)):
		$year = array();
		$company_name = $company_id = '';
		if(is_array($data)){
			foreach($data as $key => $value){
				if(!$company_name) $company_name = $value['company_name'];
				if(!$company_id) $company_id = $value['company_id'];
				$revenue[$value['year']] = $value['revenue'];
				$otherOperatingIncome[$value['year']] = $value['otherOperatingIncome'];
				$directOperatingExpenses[$value['year']] = $value['directOperatingExpenses'];
				$administrationExpenses[$value['year']] = $value['administrationExpenses'];
				$otherOperatingExpenses[$value['year']] = $value['otherOperatingExpenses'];
				$lossProfitFromOperations[$value['year']] = $value['lossProfitFromOperations'];
				$financeCost[$value['year']] = $value['financeCost'];
				$sharedOfLossprofit[$value['year']] = $value['sharedOfLossprofit'];
				$lossProfitbeforetaxation[$value['year']] = $value['lossProfitbeforetaxation'];
				$taxationFinance[$value['year']] = $value['taxationFinance'];
				$lossProfitaftertaxation[$value['year']] = $value['lossProfitaftertaxation'];
				$minoritySharedholder[$value['year']] = $value['minoritySharedholder'];
				$netlossProfitforthefinancialyear[$value['year']] = $value['netlossProfitforthefinancialyear'];
				$year[] = $value['year'];
			}
		}
		else{
			if(!$company_name) $company_name = $data['company_name'];
			if(!$company_id) $company_id = $data['company_id'];
				$revenue[$value['year']] = $value['revenue'];
				$otherOperatingIncome[$value['year']] = $value['otherOperatingIncome'];
				$directOperatingExpenses[$value['year']] = $value['directOperatingExpenses'];
				$administrationExpenses[$value['year']] = $value['administrationExpenses'];
				$otherOperatingExpenses[$value['year']] = $value['otherOperatingExpenses'];
				$lossProfitFromOperations[$value['year']] = $value['lossProfitFromOperations'];
				$financeCost[$value['year']] = $value['financeCost'];
				$sharedOfLossprofit[$value['year']] = $value['sharedOfLossprofit'];
				$lossProfitbeforetaxation[$value['year']] = $value['lossProfitbeforetaxation'];
				$taxationFinance[$value['year']] = $value['taxationFinance'];
				$lossProfitaftertaxation[$value['year']] = $value['lossProfitaftertaxation'];
				$minoritySharedholder[$value['year']] = $value['minoritySharedholder'];
				$netlossProfitforthefinancialyear[$value['year']] = $value['netlossProfitforthefinancialyear'];
				$year[] = $value['year'];
		}
?>

<p align="center"><h4>INCOME STATEMENT</h4></p>
<h5>Company Name :<?php echo $model->company_name; ?> &nbsp; &nbsp; Company ID:<?php echo $model->company_id; ?></h5>
<hr>
<table border="0" cellpadding="0" >

<?php
$row1 = $row2 = $row3 = $row4 = $row5 = $row6 = $row7 = $row8 = $row9 = $row10 = '';
$row11 = $row12 = $row13 = $row14 = '';

foreach($year as $key => $value){
	$row1 .= "<td align='center'>".$value."</td>";
	$row2 .= "<td align='center'>".number_format($revenue[$value])."</td>";
	$row3 .= "<td align='center'>".number_format($otherOperatingIncome[$value])."</td>";
	$row4 .= "<td align='center'>".number_format($directOperatingExpenses[$value])."</td>";
	$row5 .= "<td align='center'>".number_format($administrationExpenses[$value])."</td>";
	$row6 .= "<td align='center'>".number_format($otherOperatingExpenses[$value])."</td>";
	$row7 .= "<td align='center'><hr><b>".number_format($lossProfitFromOperations[$value])."</b></hr></td>";
	$row8 .= "<td align='center'>".number_format($financeCost[$value])."</td>";
	$row9 .= "<td align='center'>".number_format($sharedOfLossprofit[$value])."</td>";
	$row10 .= "<td align='center'><hr><b>".number_format($lossProfitbeforetaxation[$value])."</b></hr></td>";
	$row11 .= "<td align='center'>".number_format($taxationFinance[$value])."</td>";
	$row12 .= "<td align='center'>".number_format($lossProfitaftertaxation[$value])."</td>";
	$row13 .= "<td align='center'>".number_format($minoritySharedholder[$value])."</td>";
	$row14 .= "<td align='center'><hr><b>".number_format($netlossProfitforthefinancialyear[$value])."</b></hr></td>";
	
}
?>
	<tr><th width="500" align="left">
		YEAR 
	</th>

	<?php
			echo $row1;
		?>
	</tr>

		<!--yang nie untuk ruang tengah-->
	<tr>
		<th colspan="2">
			</br>
		</th>
	</tr> 

<!--
	<tr>
		<td colspan="2">
			<hr>
		</td>
	</tr>  -->

	<tr><td>
		Revenue
	</td>

	<?php
			echo $row2;
		?>

	</tr>
	<tr><td>
		Other Operating Income
	</td>

	<?php
			echo $row3;
		?>

	</tr>
	<tr><td>
		Direct Operating Expenses
	</td>

	<?php
			echo $row4;
		?>

	</tr>
	<tr><td>
		Administration Expenses
	</td>

	<?php
			echo $row5;
		?>

	</tr>
	<tr><td>
		Other Operating Expenses
	</td>

	<?php
			echo $row6;
		?>

	</tr>
	

	<tr><td>
	<hr><b>
	(Lost)/Profit From Operation</b>
		
	</td>

	<?php
			echo $row7;
		?>

	</tr>

	<!--yang nie untuk ruang tengah-->
	<tr>
		<td colspan="2">
		</br>
		</td>
	</tr> 

	
	<!--Nie masuk pasrt bawah-->

	<tr><td>
		Finance Costs
	</td>
	<?php
			echo $row8;
		?>
	
	<tr><td>
	Share Of (loss) Profit In An Associated Company
		
	</td>

	<?php
			echo $row9;
		?>

	</tr>
	
	
	<tr><td>
	<hr><b>
	(Lost)/Profit Before Taxation</b>
		
	</td>

	<?php
			echo $row10;
		?>
	
	<!--yang nie untuk ruang tengah-->
	<tr>
		<td colspan="2">
		</br>
		</td>
	</tr> 
	

	</tr>
	<tr><td>
		Taxation
	</td>

	<?php
			echo $row11;
		?>
	</tr>
	
	<tr><td>
	<hr><b>
	(Lost)/Profit After Taxation</b>
		
	</td>

	<?php
			echo $row12;
		?>
	</tr>
	
	<!--yang nie untuk ruang tengah-->
	<tr>
		<td colspan="2">
		</br>
		</td>
	</tr> 
	

	<tr><td>
		Minority shareholder's Interest
	</td>

	<?php
			echo $row13;
		?>
	</tr>

	<tr><td>
	<hr><b>
	Net(loss)/Profit For The Financial Year</b>
		
	</td>

	<?php
			echo $row14;
		?>
	</tr>


</table> 
<?php 
else:
echo 'Record not found.';
endif;
endif; ?>
	
</div>