<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use Validator;

class CompanyController extends Controller
{
	public function __construct()
	 {
		$this->middleware('auth');
		$this->middleware('roles');
	 }
	public function show($id){
	  return view('company_item.company', ['company' => Company::find($id)]);
   }
   
   public function addCompany(Request $request){
	   if(!$request->user())
	   {
		   return view('\login');
	   }
	   return view('company_add');
   }
   
   public function showList(Request $request){
	   if(!$request->user())
	   {
		   return view('\login');
	   }
	   
	   $user_role = $request->user()->getUserRole($request->user()->id);
	   
	   $companies = array();
	   if($user_role == 'site_manager' || $user_role == 'client')
	   {
		   $companies = Company::select(['company_id', 'company_name', 'company_phone', 'company_emails', 'company_contact_person'])
								->where('company_id','=', $request->user()->company_id)->get();
	   }
	   elseif($user_role == 'super_admin')
	   {
		   $companies = Company::all(['company_id', 'company_name', 'company_phone', 
									'company_emails', 'company_contact_person']); 
	   }
	   
	   return view('companies_list', compact('companies'));
   }
   
   public function showCompany(Request $request, $id){
	   if(!$request->user())
	   {
		   return view('\login');
	   }
	   
	   $user_role = $request->user()->getUserRole($request->user()->id);
	   
	   $companies = array();
	   if($user_role == 'site_manager' || $user_role == 'client')
	   {
		   if($request->user()->company_id == $id){
				$companies = Company::select(['company_id', 'company_name', 'company_phone', 'company_emails', 'company_contact_person'])
								->where('company_id','=', $id)->get();   
		   }
		   else{
			   response("You don't have permissions to view this.", 401);
		   }
	   }
	   elseif($user_role == 'super_admin')
	   {
		   $companies = Company::select(['company_id', 'company_name', 'company_phone', 'company_emails', 'company_contact_person'])
								->where('company_id','=', $id)->get();
	   }
	   return view('company_item', compact('companies'));
   }
   
   
   /**
	 * create company instance after a validation
	 *
	 * @param  array  $data
	 * @return company request
	 */
	public function create(Request $request){
		$validator= Validator::make($request->all(), [
		'name' => 'required|max:255',
		'email' => 'required|email|max:255',
		'phone' => 'required|max:255',
		'person' => 'required|max:255',
	]);
	
		if ($validator->fails()) {
			return redirect('/company/add')
						->withErrors($validator)
						->withInput();
		}
		$company = new Company;
		
		$company->company_name = $request->name;
		$company->company_emails = $request->email;
		$company->company_phone = $request->phone;
		$company->company_contact_person = $request->person;
		$company->save();
		$id = $company->id;
		return redirect('/company/'.$id)-> with('status', 'Company info saved successfully!');
	}
	
   /**
	 * edit company instance after a validation
	 *
	 * @param  array  $data
	 * @return company request
	 */
	public function edit(Request $request, $id){
		
		$validator= Validator::make($request->all(), [
		'name' => 'required|max:255',
		'email' => 'required|email|max:255',
		'phone' => 'required|max:255',
		'person' => 'required|max:255',
	]);
	
		if ($validator->fails()) {
			return redirect('/company/'.$id)
						->withErrors($validator)
						->withInput();
		}
		$company = Company::find($id);
		
		$company->company_name = $request->name;
		$company->company_emails = $request->email;
		$company->company_phone = $request->phone;
		$company->company_contact_person = $request->person;
		$company->save();
		
		return redirect('/company/'.$id)-> with('status', 'Company info changed successfully!');
	}
}
