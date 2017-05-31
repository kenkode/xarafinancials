<?php

class Dailypay extends \Eloquent {
	/*
	use \Traits\Encryptable;


	protected $encryptable = [

		'allowance_amount',
		
		
	];
	*/

public static $rules = [
		'employee' => 'required',
		'days' => 'required|regex:/^[+]?\d+$/',
		'amount' => 'required|regex:/^(\$?(?(?=\()(\())\d+(?:,\d+)?(?:\.\d+)?(?(2)\)))$/'
	];

public static $messages = array(
        'employee.required'=>'Please select employee!',
        'days.required'=>'Please insert days worked!',
        'days.regex'=>'Please insert a valid day!',
        'amount.required'=>'Please insert employee allowance amount!',
        'amount.regex'=>'Please insert a valid amount!',
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function employee(){

		return $this->belongsTo('Employee');
	}

	public static function pay($id,$period){
        $total = Dailypay::where('employee_id',$id)->where('period',$period)->where('status',0)->sum("total");
		return $total;
	}

	public static function dpay($id,$period){
        $count = Dailypay::where('employee_id',$id)->where('period',$period)->where('status',0)->count();
		return $count;
	}

}