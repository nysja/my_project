<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\Company;
use Validator;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('roles');
	}
	 
	public function showList(Request $request){
	   if(!$request->user())
	   {
		   return view('\login');
	   }
	   
	   $user_role = $request->user()->getUserRole($request->user()->id);
	   $select = DB::table('projects')->select('project_id', 'project_name', 'project_description', 
					'project_costs', 'companies.company_name');
	   $projects = array();
	   if( $user_role == 'client')
	   {
		   $projects = $select
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->where('company_id','=', $request->user()->company_id)
					->get();
	   }
	   elseif($user_role == 'site_manager' || $user_role == 'super_admin')
	   {
		   $projects = $select
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->get();
		   
	   }
	   elseif($user_role == 'developer')
	   {
		   $projects = $select
					->join('project_tasks', 'project_tasks.project_id', '=', 'projects.project_id')
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->where('project_tasks.user_id','=', $request->user()->id)->distinct()
					->get();
		   
	   }
	   else
	   {
		   response("You don't have permissions to view this.", 401);
	   }
	   //var_dump($users); exit;
	   return view('projects_list', compact('projects'));
   }
   
   
   public function showProject(Request $request, $id){
	   if(!$request->user())
	   {
		   return view('\login');
	   }
	   
	   $user_role = $request->user()->getUserRole($request->user()->id);
	   
	   $projects = array();
	   if( $user_role == 'client')
	   {
		   $projects = DB::table('projects')->select('project_id', 'project_name', 'project_description', 
					'project_costs', 'companies.company_name', 'companies.company_id')
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->where('company_id','=', $request->user()->company_id)
					->where('projects.project_id','=', $id)
					->get();
	   }
	   elseif($user_role == 'site_manager' || $user_role == 'super_admin')
	   {
		   $projects = DB::table('projects')->select('project_id', 'project_name', 'project_description', 
					'project_costs', 'companies.company_name', 'companies.company_id')
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->where('projects.project_id','=', $id)
					->get();
		   
	   }
	   elseif($user_role == 'developer')
	   {
		   $projects = DB::table('projects')->select('projects.project_id', 'projects.project_name', 'projects.project_description', 
					'projects.project_costs', 'companies.company_name', 'companies.company_id')
					->join('project_tasks', 'project_tasks.project_id', '=', 'projects.project_id')
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->where('project_tasks.user_id','=', $request->user()->id)
					->where('projects.project_id','=', $id)->distinct()
					->get();
		   
	   }
	   else
	   {
		   response("You don't have permissions to view this.", 401);
	   }
	   
	   return view('project_item', compact('projects'));
   }
   
   
   /**
	 * create project instance after a validation
	 *
	 * @param  array  $data
	 * @return company request
	 */
	public function create(Request $request){
		$validator= Validator::make($request->all(), [
		'project_name' => 'required|max:255',
		'project_description' => 'required|max:255',
		'project_costs' => 'required|max:255',
		'company_id' => 'required|max:255',
	]);
	
		if ($validator->fails()) {
			return redirect('/project/add')
						->withErrors($validator)
						->withInput();
		}
		$project = new Projects;
		
		$project->project_name = $request->project_name;
		$project->project_description = $request->project_description;
		$project->project_costs = $request->project_costs;
		$project->company_id = $request->company_id;
		$project->save();
		$id = $project->id;
		return redirect('/project/'.$id)-> with('status', 'Project saved successfully!');
	}
	
   /**
	 * edit project instance after a validation
	 *
	 * @param  array  $data
	 * @return company request
	 */
	public function edit(Request $request, $id){
		
		$validator= Validator::make($request->all(), [
		'project_name' => 'required|max:255',
		'project_description' => 'required|max:255',
		'project_costs' => 'required|max:255',
		'company_id' => 'required|max:255',
	]);
	
		if ($validator->fails()) {
			return redirect('/project/'.$id)
						->withErrors($validator)
						->withInput();
		}
		$project = Projects::find($id);
		
		$project->project_name = $request->project_name;
		$project->project_description = $request->project_description;
		$project->project_costs = $request->project_costs;
		$project->company_id = $request->company_id;
		$project->save();
		
		return redirect('/project/'.$id)-> with('status', 'Project changed successfully!');
	}
	
	
   public function addProject(Request $request){
	   if(!$request->user())
	   {
		   return view('\login');
	   }
	   $companies = Company::all(['company_id', 'company_name']);
	   return view('project_add', compact('companies'));
   }
}
