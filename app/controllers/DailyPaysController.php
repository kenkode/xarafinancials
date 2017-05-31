<?php

class DailyPaysController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$pays = DB::table('dailypays')
		          ->join('employee', 'dailypays.employee_id', '=', 'employee.id')
		          ->where('in_employment','=','Y')
		          ->where('employee.organization_id',Confide::user()->organization_id)
		          ->select('dailypays.id','first_name','middle_name','last_name','amount','days','period')
		          ->get();

		Audit::logaudit('Daily Pays', 'view', 'viewed daily pays');

		return View::make('dailypays.index', compact('pays'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */

    
	public function create()
	{
		
		$employees = DB::table('employee')
		          ->where('in_employment','=','Y')
		          ->where('employee.organization_id',Confide::user()->organization_id)
		          ->get();
		$currency = Currency::whereNull('organization_id')->orWhere('organization_id',Confide::user()->organization_id)->first();
		return View::make('dailypays.create',compact('employees','currency'));
	}


	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Dailypay::$rules, Dailypay::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$pay = new Dailypay;

		$pay->employee_id = Input::get('employee');

        $pay->days = Input::get('days');

        $pay->status = 0;

        $pay->organization_id = Confide::user()->organization_id;
		
		$pay->period = Input::get('period');

		$a = str_replace( ',', '', Input::get('amount') );

		$t = str_replace( ',', '', Input::get('balance') );

        $pay->amount = $a;

        $pay->total = $t;

	    $pay->save();

		Audit::logaudit('Daily Pays', 'create', 'assigned: '.$pay->amount.' to'.Employee::getEmployeeName(Input::get('employee')));

		return Redirect::route('dailypays.index')->withFlashMessage('Employee Daily Pay successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$pay = Dailypay::findOrFail($id);

		return View::make('dailypays.show', compact('pay'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pay = Dailypay::find($id);
		$employees = Employee::where('organization_id',Confide::user()->organization_id)->get();
	    $currency = Currency::whereNull('organization_id')->orWhere('organization_id',Confide::user()->organization_id)->first();
		return View::make('dailypays.edit', compact('pay','employees','currency'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$pay = Dailypay::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Dailypay::$rules, Dailypay::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $pay->days = Input::get('days');
		
		$pay->period = Input::get('period');

		$a = str_replace( ',', '', Input::get('amount') );

		$t = str_replace( ',', '', Input::get('balance') );

        $pay->amount = $a;

        $pay->total = $t;

		$pay->update();

		Audit::logaudit('Daily Pays', 'update', 'assigned: '.$pay->amount.' to '.Employee::getEmployeeName($pay->employee_id));

		return Redirect::route('dailypays.index')->withFlashMessage('Employee Daily Pay successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$pay = Dailypay::findOrFail($id);

		Dailypay::destroy($id);


		Audit::logaudit('Daily Pays', 'delete', 'deleted: '.$pay->amount.' for '.Employee::getEmployeeName($pay->employee_id));


		return Redirect::route('dailypays.index')->withDeleteMessage('Employee Daily Pay successfully deleted!');
	}

    public function view($id){

		$pay = DB::table('dailypays')
		          ->join('employee', 'dailypays.employee_id', '=', 'employee.id')
		          ->where('dailypays.id','=',$id)
		          ->where('employee.organization_id',Confide::user()->organization_id)
		          ->select('dailypays.id','first_name','last_name','middle_name','amount',
		          	'photo','signature','days','period')
		          ->first();

		$organization = Organization::find(Confide::user()->organization_id);

		return View::make('dailypays.view', compact('pay'));
		
	}


}
