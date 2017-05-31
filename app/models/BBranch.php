<?php

class BBranch extends \Eloquent {

public $table = "bank_branches";

public static $rules = [
		'name' => 'required',
		'code' => 'required',
		'sort_code' => 'required',
		'bank_id' => 'required'
	];

public static $messages = array(
        'name.required'=>'Please insert bank name!',
        'code.required'=>'Please insert bank branch code!',
        'sort_code.required'=>'Please insert bank branch sort code!',
        'bank_id.required'=>'Please insert bank!',
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function employees(){

		return $this->hasMany('Employee');
	}

	public function bank(){
         return $this->belongsTo('Bank');
    }

    public static function getName($id){
        if($id > 0){
		$bbranch = BBranch::find($id);
        return $bbranch->bank_branch_name;
    }
	}

}