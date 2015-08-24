<?php

/**
 * This is the model class for table "tbl_booking".
 *
 * The followings are the available columns in table 'tbl_booking':
 * @property integer $id
 * @property string $booking_date
 * @property string $name
 * @property integer $adult
 * @property integer $children
 * @property integer $total_amount
 */
class Booking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Booking the static model class
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
		return 'tbl_booking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	 
	public  $daily_ceiling=100;//only hundred tickets are alloted for each day.
    public static $adult_pricing=8;
    public static $child_pricing=4
	 
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('booking_date, name, adult, children, total_amount', 'required'),
			array('adult, children, total_amount', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			 array('daily_ceiling', 'validateCeiling'),

			array('id, booking_date, name, adult, children, total_amount', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	 
	  public function validateCeiling($attribute,$params)
	  {

        $bookings=Booking::model()->findAllByAttributes(array('booking_date'=>$this->booking_date));
        $total_booked=0;
        foreach($bookings as $booking)

	   {
                        $total_booked+=$booking->adult;
                        $total_booked+=$booking->children;              
        }
    //We are going to throw errors if current booking exceeds the daily alloted booking.

        if(($total_booked+$this->adult+$this->children) >$this->daily_ceiling)
                $this->addError('daily_ceiling',"       We have only ".($this->daily_ceiling-$total_booked)." tickets left on ". $this->booking_date);
	 
	 }

	 
	   public function validateDate($attribute,$params)
    {   
        //We are going to throw errors if user erroneously enter a date in the past.
        if($this->booking_date < date('Y-m-d'))
                $this->addError($attribute,"You have entered a date in the past.");

        //Booking are possibly for next one month,not more than that.
        if($this->booking_date > date('Y-m-d',time()+30*24*60*60))
                $this->addError($attribute,"Booking are allowed for only next 30 days.");
    }

	 
	 
	 
	   public static function dropDownArray($number)
    {   
        //creating a array source used in dropDownList
        $arr=array(0=>'select');
        for($i=1;$i<=$number;$i++)
            $arr[$i]=$i;
        return $arr;
    }   
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
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
			'booking_date' => 'Booking Date',
			'name' => 'Name',
			'adult' => 'Adult',
			'children' => 'Children',
			'total_amount' => 'Total Amount',
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
		$criteria->compare('booking_date',$this->booking_date,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('adult',$this->adult);
		$criteria->compare('children',$this->children);
		$criteria->compare('total_amount',$this->total_amount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}