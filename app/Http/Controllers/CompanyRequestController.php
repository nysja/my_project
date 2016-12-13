<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CompanyRequest;
use Validator;
class CompanyRequestController extends Controller
{
	 /**
	 * Show the company requests which are not processed.
	 *
	 * 
	 * @return Response
	 */
	 public function __construct()
	 {
		$this->middleware('auth');
		$this->middleware('roles');
	 }
	
	public function show(Request $request)
	{
		if(!$request->user())
	   {
		   return view('/login');
	   }
	   
	   $user_role = $request->user()->getUserRole($request->user()->id);
		if($user_role == 'site_manager' || $user_role == 'super_admin')
	   {
		   $list = CompanyRequest::all(['id', 'contact_person', 'email', 'company_name', 'project_request', 'processed']);
		   
	   }
		return view('company_request_list', compact('list'));
	}
	
	/**
	 * Create a company request instance after a validation
	 *
	 * @param  array  $data
	 * @return company request
	 */
	public function create(Request $request){
		$validator= Validator::make($request->all(), [
		'name' => 'required|max:255',
		'email' => 'required|max:255',
		'company_name' => 'required|max:255',
		'project_request' => 'required|max:255',
	]);
	
		if ($validator->fails()) {
			return redirect('/company_request')
						->withErrors($validator)
						->withInput();
		}
		$company_request = new CompanyRequest;
		
		$company_request->contact_person = $request->name;
		$company_request->email = $request->email;
		$company_request->company_name = $request->company_name;
		$company_request->project_request = $request->project_request;
		$company_request->save();
		
		return redirect('/company_request')-> with('status', 'Request sent!');
	}
	 
}
