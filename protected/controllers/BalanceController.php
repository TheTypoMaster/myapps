<?php

class BalanceController extends Controller
{
    public $message;
	 public $message2;
	  public $message3;
	 public $message4;
	  public $message5;
	 public $message6;
	  public $message7;
	 public $message8;
	 
	public function actionIndex()
	{
	    
		$message = General::model()->findbyPk(1);
		$this->message = $message->year_1;
		$this->message2 = $message->pro_1;
		$this->message3 = $message->intangible_1;
		$this->message4 = $message->development_1;
		$this->message5 = $message->invest_sub_1;
		$this->message6 = $message->invest_aso_1;
		$this->message7 = $message->other_1;
		$this->message8 = $message->total_1;
		$this->render('index', array('year_1'=>$this->message));
		
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