<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectTasks;
use App\Company;
use Validator;
use Illuminate\Support\Facades\DB;

class ProjectTasksController extends Controller
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
	   
	   $project_tasks = array();
	   if( $user_role == 'client')
	   {
		   $project_tasks = DB::table('project_tasks')->select('project_tasks_id', 'project_task_description', 
					'project_task_status', 'projects.project_name', 'users.name', 'users.last_name')
					->join('projects', 'projects.project_id', '=', 'project_tasks.project_id')
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->join('users', 'users.id', '=', 'project_tasks.user_id')
					->where('company_id','=', $request->user()->company_id)
					->get();
	   }
	   elseif($user_role == 'site_manager' || $user_role == 'super_admin')
	   {
		   $project_tasks = DB::table('project_tasks')->select('project_tasks_id', 'project_task_description', 
					'project_task_status', 'projects.project_name', 'users.name', 'users.last_name')
					->join('projects', 'projects.project_id', '=', 'project_tasks.project_id')
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->join('users', 'users.id', '=', 'project_tasks.user_id')
					->get();
		   
	   }
	   elseif($user_role == 'developer')
	   {
		   $project_tasks = DB::table('project_tasks')->select('project_tasks_id', 'project_task_description', 
					'project_task_status', 'projects.project_name', 'users.name', 'users.last_name')
					->join('projects', 'projects.project_id', '=', 'project_tasks.project_id')
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->join('users', 'users.id', '=', 'project_tasks.user_id')
					->where('project_tasks.user_id','=', $request->user()->id)
					->get();
		   
	   }
	   else
	   {
		   response("You don't have permissions to view this.", 401);
	   }
	   //var_dump($users); exit;
	   return view('project_tasks_list', compact('project_tasks'));
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
		   $project_tasks = DB::table('project_tasks')->select('project_tasks_id', 'project_task_description', 
					'project_task_status', 'projects.project_name', 'users.name', 'users.last_name')
					->join('projects', 'projects.project_id', '=', 'project_tasks.project_id')
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->join('users', 'users.id', '=', 'project_tasks.user_id')
					->where('company_id','=', $request->user()->company_id)
					->where('project_tasks_id','=', $id)
					->get();  
	   }
	   elseif($user_role == 'site_manager' || $user_role == 'super_admin')
	   {
		   $project_tasks = DB::table('project_tasks')->select('project_tasks_id', 'project_task_description', 
					'project_task_status', 'projects.project_name', 'users.name', 'users.last_name')
					->join('projects', 'projects.project_id', '=', 'project_tasks.project_id')
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->join('users', 'users.id', '=', 'project_tasks.user_id')
					->where('project_tasks_id','=', $id)
					->get();
		   
	   }
	   elseif($user_role == 'developer')
	   {
		   $project_tasks = DB::table('project_tasks')->select('project_tasks_id', 'project_task_description', 
					'project_task_status', 'projects.project_name', 'users.name', 'users.last_name')
					->join('projects', 'projects.project_id', '=', 'project_tasks.project_id')
					->join('companies', 'companies.company_id', '=', 'projects.company_id')
					->join('users', 'users.id', '=', 'project_tasks.user_id')
					->where('project_tasks.user_id','=', $request->user()->id)
					->where('project_tasks_id','=', $id)
					->get();
					
	   }
	   else
	   {
		   response("You don't have permissions to view this.", 401);
	   }
	   
	   return view('project_task_item', compact('project_tasks'));
   }
   
   
   /**
	 * create project task instance after a validation
	 *
	 * @param  array  $data
	 * @return company request
	 */
	public function create(Request $request){
		$validator= Validator::make($request->all(), [
		'project_task_description' => 'required|max:255',
		'project_task_status' => 'required|max:255',
		'project_id' => 'required|max:255',
		'user_id' => 'required|max:255',
		]);
	
		if ($validator->fails()) {
			return redirect('/project_task/add')
						->withErrors($validator)
						->withInput();
		}
		$project_task = new ProjectTasks;
		
		$project_task->project_task_description = $request->project_task_description;
		$project_task->project_task_status = $request->project_task_status;
		$project_task->project_id = $request->project_id;
		$project_task->user_id = $request->user_id;
		$project_task->save();
		$id = $project->id;
		return redirect('/project_task/'.$id)-> with('status', 'Project task saved successfully!');
	}
	
   /**
	 * edit project task instance after a validation
	 *
	 * @param  array  $data
	 * @return company request
	 */
	public function edit(Request $request, $id){
		
		$validator= Validator::make($request->all(), [
		'project_task_description' => 'required|max:255',
		'project_task_status' => 'required|max:255',
		'project_id' => 'required|max:255',
		'user_id' => 'required|max:255',
		]);
	
		if ($validator->fails()) {
			return redirect('/project_task/'.$id)
						->withErrors($validator)
						->withInput();
		}
		$project_task = ProjectTasks::find($id);
		
		$project_task->project_task_description = $request->project_task_description;
		$project_task->project_task_status = $request->project_task_status;
		$project_task->project_id = $request->project_id;
		$project_task->user_id = $request->user_id;
		$project_task->save();
		
		return redirect('/project_task/'.$id)-> with('status', 'Project task changed successfully!');
	}
	
	
   public function addProject(Request $request){
	   if(!$request->user())
	   {
		   return view('\login');
	   }
	   $users = DB::table('users')->select('users.id', 'users.name', 'users.last_name')
						->join('users_roles', 'users_roles.user_id', '=', 'users.id')
						->join('roles', 'users_roles.role_id', '=', 'roles.id')
						->where('roles.name','=', 'developer')->get(); 
						
	   $projects = DB::table('projects')->select('project_id', 'project_name')->get();
	   
	   return view('project_task_add', compact('users', 'projects'));
   }
   
}
