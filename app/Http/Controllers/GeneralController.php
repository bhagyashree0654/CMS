<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function getAdminTreeView(Request $request){
		$role_code = $request->session()->get('role_code');
		$on=1;
		$off=0;
		$position = "CEO";
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
		// admins
		$admin = DB::table('admin')->where('position',$position)->get();	
        $management = DB::table('admin')->where('position','Management Team')->get();
		// coo cto
        $management_team = DB::table('management_team')->get();
		// managers
        $managers=DB::table('managers')->get();
		// hr
        $hrs=DB::table('hr')->get();
		// $proj_leads = DB::table('employee')->where('project_lead_status',$on)->get();
		$proj_leads = DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.proj_lead_code')->where('project_lead_status',$on)->get();
		// print_r($proj_leads);
		$team_leads = DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.team_lead_code')->where('team_lead_status',$on)->get();
		// print_r($team_leads);
		// // $team_leads = DB::table('employee')->where('team_lead_status',$on)->get();
		$emps =DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.emp_code')->where(['project_lead_status'=> $off,'team_lead_status'=>$off])->get();
		// print_r($emps);

		$menu_name=$request->input('menu_name');
		return view('Admin.treeview',compact(['menu','menu_name','admin','management','management_team','managers','hrs','proj_leads','team_leads','emps']));
	}
	public function getManagementTreeView(Request $request){
		$role_code = $request->session()->get('role_code');
		$mng_code = $request->session()->get('mng_code');
		$on=1;
		$off=0;
		$position = "CEO";
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
		// admins
		$admin = DB::table('admin')->where('position',$position)->get();	
        $management = DB::table('admin')->where('position','Management Team')->get();
		// coo cto
        $management_team = DB::table('management_team')->where('mng_code',$mng_code)->get();
		// managers
        $managers=DB::table('managers')->get();
		// hr
        $hrs=DB::table('hr')->get();
		// $proj_leads = DB::table('employee')->where('project_lead_status',$on)->get();
		$proj_leads = DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.proj_lead_code')->where('project_lead_status',$on)->get();
		// print_r($proj_leads);
		$team_leads = DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.team_lead_code')->where('team_lead_status',$on)->get();
		// print_r($team_leads);
		// // $team_leads = DB::table('employee')->where('team_lead_status',$on)->get();
		$emps =DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.emp_code')->where(['project_lead_status'=> $off,'team_lead_status'=>$off])->get();
		// print_r($emps);

		$menu_name=$request->input('menu_name');
		return view('Admin.treeview',compact(['menu','menu_name','admin','management','management_team','managers','hrs','proj_leads','team_leads','emps']));
	}

	public function	getManagerTreeView(Request $request){
		$role_code = $request->session()->get('role_code');
		$mngr_code = $request->session()->get('mngr_code');
		$mng_head = $request->session()->get('mng_head');
		$on=1;
		$off=0;
		$position = "CEO";
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
		// admins
		$admin = DB::table('admin')->where('position',$position)->get();	
        $management = DB::table('admin')->where('position','Management Team')->get();
		// coo cto
        $management_team = DB::table('management_team')->where('mng_code',$mng_head)->get();
		// managers
        $managers=DB::table('managers')->where('mngr_code',$mngr_code)->get();
		// hr
        $hrs=DB::table('hr')->where('mng_head',$mngr_code)->get();
		// $proj_leads = DB::table('employee')->where('project_lead_status',$on)->get();
		$proj_leads = DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.proj_lead_code')->where('project_lead_status',$on)->get();
		// print_r($proj_leads);
		$team_leads = DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.team_lead_code')->where('team_lead_status',$on)->get();
		// print_r($team_leads);
		// // $team_leads = DB::table('employee')->where('team_lead_status',$on)->get();
		$emps =DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.emp_code')->where(['project_lead_status'=> $off,'team_lead_status'=>$off])->get();
		// print_r($emps);

		$menu_name=$request->input('menu_name');
		return view('Admin.treeview',compact(['menu','menu_name','admin','management','management_team','managers','hrs','proj_leads','team_leads','emps']));
	}
	public function	getHRTreeView(Request $request){
		$role_code = $request->session()->get('role_code');
		$hr_code = $request->session()->get('hr_code');
		$on=1;
		$off=0;
		$position = "CEO";
		$management_team = '';
        $managers='';

		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$on])->orderBy('id')->get();
		// admins
		$admin = DB::table('admin')->where('position',$position)->get();	
        $management = DB::table('admin')->where('position','Management Team')->get();
		// fetch-hr
        $hrs=DB::table('hr')->where('hr_code',$hr_code)->get();
		if(count($hrs)>0){
			$mng_head = $hrs[0]->mng_head;
			$managers = DB::table('managers')->where('mngr_code',$mng_head)->get();
			if(count($managers)>0){
				$mngr_code = $managers[0]->mng_head;
				$management_team = DB::table('management_team')->where('mng_code',$mngr_code)->get();
			}
		}
		$proj_leads = DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.proj_lead_code')->where('project_lead_status',$on)->get();
		$team_leads = DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.team_lead_code')->where('team_lead_status',$on)->get();
		$emps =DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.emp_code')->where(['project_lead_status'=> $off,'team_lead_status'=>$off])->get();
		$menu_name=$request->input('menu_name');
		return view('Admin.treeview',compact(['menu','menu_name','admin','management','management_team','managers','hrs','proj_leads','team_leads','emps']));
	}
	public function	getEmployeeTreeView(Request $request){
		$role_code = $request->session()->get('role_code');
		$hr_code = $request->session()->get('emp_code');
		$on=1;
		$off=0;
		$position = "CEO";
		$management_team = '';
        $managers='';

		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$on])->orderBy('id')->get();
		// admins
		$admin = DB::table('admin')->where('position',$position)->get();	
        $management = DB::table('admin')->where('position','Management Team')->get();
		// fetch-hr
        $hrs=DB::table('hr')->where('hr_code',$hr_code)->get();
		if(count($hrs)>0){
			$mng_head = $hrs[0]->mng_head;
			$managers = DB::table('managers')->where('mngr_code',$mng_head)->get();
			if(count($managers)>0){
				$mngr_code = $managers[0]->mng_head;
				$management_team = DB::table('management_team')->where('mng_code',$mngr_code)->get();
			}
		}
		$proj_leads = DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.proj_lead_code')->where('project_lead_status',$on)->get();
		$team_leads = DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.team_lead_code')->where('team_lead_status',$on)->get();
		$emps =DB::table('employee')->join('project_assignment','employee.emp_code','=','project_assignment.emp_code')->where(['project_lead_status'=> $off,'team_lead_status'=>$off])->get();
		$menu_name=$request->input('menu_name');
		return view('Admin.treeview',compact(['menu','menu_name','admin','management','management_team','managers','hrs','proj_leads','team_leads','emps']));
	}


	
}
