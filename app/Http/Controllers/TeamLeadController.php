<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamLeadController extends Controller
{

    public function getProfile(Request $request){
		$role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('link_text')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Employee.TeamLead.profile',compact(['menu','menu_name']));
	}
	public function getProject(Request $request){
		$role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('link_text')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Employee.TeamLead.project',compact(['menu','menu_name']));
	}
	public function getTeamStatus(Request $request){
		$role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('link_text')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Employee.TeamLead.teamStatus',compact(['menu','menu_name']));
	}
	public function getTLDashboard(Request $request){
		$role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('link_text')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Employee.TeamLead.tldashboard',compact(['menu','menu_name']));
	}
    public function timeTracker(Request $request){
		$role_code = $request->session()->get('role_code');
		$emp_code = $request->session()->get('emp_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('link_text')->get();
		$projects= DB::table('project_assignment')
		->join('project','project_assignment.project_code','=','project.proj_code')->select('project_assignment.project_code','project.proj_name')->where('emp_code',$emp_code)->get();
			
		$menu_name=$request->input('menu_name');
		return view('trackTime',compact(['menu','menu_name','projects']));
	}


    public function fetchTeamActiveEmployee(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
		$status = 1;
		$emp_code = $request->session()->get('emp_code');

		//ftch project team lead work on
		$searchProject = DB::table('project_assignment')->select('project_code')->where('emp_code',$emp_code)->get();
		// print_r($searchProject);
		foreach($searchProject as $sp){
			$proj = $sp->project_code;
			//got employee for each project
			$result=DB::table('project_assignment')
			->join('employee', 'project_assignment.emp_code', '=', 'employee.emp_code')
			->select('project_assignment.emp_code','employee.emp_name')->where(['project_assignment.project_code'=>$proj,'employee.log_status'=>$status])->get();
		}
		// $employee[] = "";
		// foreach($projresult as $pr){
		// array_push(	$employee, $pr->emp_code);
		// }
		
		// print_r($employee);
		// $result=DB::table('employee')->select('emp_code','emp_name')->where('log_status',$status)->get();

		$slno=1;
		if (COUNT($result)>0) {
			foreach ($result AS $row) {
				$row->no = $slno;
				$output['aaData'][] = $row;
				$output['dbStatus'] = 'SUCCESS';
				$slno ++;
			}
		} else {
			$output['dbStatus'] = 'FAILURE';
		}
		// $output['aaData'][] = $employee;
		return response()->json($output);

	}

	public function fetchTeamInActiveEmployee(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
		$activestatus = 0;
		$emp_code = $request->session()->get('emp_code');

		//ftch project team lead work on
		$searchProject = DB::table('project_assignment')->select('project_code')->where('emp_code',$emp_code)->get();
		// print_r($searchProject);
		foreach($searchProject as $sp){
			$proj = $sp->project_code;
			//got employee for each project
			$result=DB::table('project_assignment')
			->join('employee', 'project_assignment.emp_code', '=', 'employee.emp_code')
			->select('project_assignment.emp_code','employee.emp_name')->where(['project_assignment.project_code'=>$proj,'employee.log_status'=>$activestatus])->get();
		}
		
		$slno=1;
		if (COUNT($result)>0) {
			foreach ($result AS $row) {
				$row->no = $slno;
				$output['aaData'][] = $row;
				$output['dbStatus'] = 'SUCCESS';
				$slno ++;
			}
		} else {
			$output['dbStatus'] = 'FAILURE';
		}
		// $output['aaData'][] = $employee;
		return response()->json($output);

		
	}
	public function fetchTeamLeaveEmployee(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
		$leavestatus = 1;
		$emp_code = $request->session()->get('emp_code');

		//ftch project team lead work on
		$searchProject = DB::table('project_assignment')->select('project_code')->where('emp_code',$emp_code)->get();
		// print_r($searchProject);
		foreach($searchProject as $sp){
			$proj = $sp->project_code;
			//got employee for each project
			$result=DB::table('project_assignment')
			->join('employee', 'project_assignment.emp_code', '=', 'employee.emp_code')
			->select('project_assignment.emp_code','employee.emp_name')->where(['project_assignment.project_code'=>$proj,'employee.leave_status'=>$leavestatus])->get();
		}
		
		$slno=1;
		if (COUNT($result)>0) {
			foreach ($result AS $row) {
				$row->no = $slno;
				$output['aaData'][] = $row;
				$output['dbStatus'] = 'SUCCESS';
				$slno ++;
			}
		} else {
			$output['dbStatus'] = 'FAILURE';
		}
		// $output['aaData'][] = $employee;
		return response()->json($output);

	}

	public function fetchTeamLeadProjectSelect(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
        $emp_code = $request->session()->get('emp_code');
        $status = 1;
        $result = DB::select(DB::raw("SELECT T1.proj_name,T2.project_code,T1.id,T1.proj_code
							FROM project T1
							INNER JOIN project_assignment T2 On T1.proj_code = T2.project_code
							WHERE T2.status = :status and T2.emp_code =:emp_code"),array('status'=>$status,'emp_code'=>$emp_code));

        
		$slno = 1;
		if (COUNT($result)>0) {
			foreach ($result AS $row) {
				$row->no = $slno;
				$output['aaData'][] = $row;
				$output['dbStatus'] = 'SUCCESS';
				$slno ++;
			}
		} else {
			$output['dbStatus'] = 'FAILURE';
		}
		return response()->json($output);
	}

	public function updateStatusToHR(Request $request){
		$project = $request->input('project');
		$statusUpdate = $request->input('upstatus');
		$emp_code = $request->session()->get('emp_code');
		$date = date('Y-m-d H:i:s');
		$status = 1;
		$result = DB::table('teamlead_update_status_hr')->insert(['proj_code'=>$project,'emp_code'=>$emp_code,'dates'=>$date,'work_updates'=>$statusUpdate
							,'status'=>$status,'created_by'=>$emp_code]);
		if($result){
			$statmessage = "Data inserted..!!!";
			$role_code = $request->session()->get('role_code');
			$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
						->where('role_code',$role_code)->orderBy('link_text')->get();
						
			$menu_name="Dashboard";
			return view('Employee.Teamlead.tldashboard',compact(['statmessage','menu','menu_name']));
		}	
		else{
			$statmessage = "Please update your status once..!!!";
			$role_code = $request->session()->get('role_code');
			$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
						->where('role_code',$role_code)->orderBy('link_text')->get();
						
			$menu_name="Dashboard";
			return view('Employee.Teamlead.tldashboard',compact(['statmessage','menu','menu_name']));
		}				
	}

	// public function fetchProjectDataForTeamLead(Request $request){
	// 	$output = array('aaData'=>array(),'dbStatus'=>'');
    //     $emp_code = $request->session()->get('emp_code');
    //     $status = 1;
	// 	$employeestl[]="";
	// 	$selectProjects = DB::table('project_assignment')->select('project_code')->where('emp_code',$emp_code)->get();

	// 	foreach($selectProjects as $sps){
	// 		$proj_code_tl= $sps->project_code;
	// 		$selectEmployeesProject = DB::table('project_assignment')->join('employee', 'project_assignment.emp_code', '=', 'employee.emp_code')->select('project_assignment.emp_code','employee.emp_name')->where('project_assignment.project_code',$proj_code_tl)->get();
	// 	}
	// 	print_r($selectEmployeesProject);
	// 	foreach($selectEmployeesProject as $sep){
	// 		$empname = $sep->emp_name;
	// 	}
		
	// 	$output['aaData'][] =$empname;
		
	// 	print_r($employeestl);
		
	// 	$result = DB::select(DB::raw("SELECT p.proj_name,pa.emp_code,pa.project_code,e.emp_name,pa.starting_date,pa.end_date 
	// 	from project_assignment pa INNER JOIN project p ON pa.project_code = p.proj_code
	// 	INNER JOIN  employee e ON e.emp_code = pa.emp_code WHERE pa.status=:status and pa.emp_code=:emp_code"),array('status'=>$status,'emp_code'=>$emp_code));

		
    //     $slno=1;
	// 	if (COUNT($result)>0) {
	// 		foreach ($result AS $row) {
	// 			$row->no = $slno;
	// 			// array_push($employeestl,$row->emp_name);
	// 			$start =date_create(date("Y-m-d"));
	// 			$end = date_create($row->end_date);
	// 			$remain=date_diff($start,$end);
	// 			$row->remain = $remain->format("%a days");
	// 			$output['aaData'][] = $row;
	// 			$output['dbStatus'] = 'SUCCESS';
	// 			$slno ++;
	// 		}
	// 	} else {
	// 		$output['dbStatus'] = 'FAILURE';
	// 	}

	// 	return response()->json($output);
	// }

	function fetchProjectDataForTeamLead(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
        $emp_code = $request->session()->get('emp_code');
        $status = 1;
		$result = DB::select(DB::raw("SELECT p.proj_name,pa.emp_code,pa.project_code,e.emp_name,pa.starting_date,pa.end_date 
		from project_assignment pa INNER JOIN project p ON pa.project_code = p.proj_code
		INNER JOIN  employee e ON e.emp_code = pa.emp_code WHERE pa.status=:status and pa.emp_code=:emp_code"),array('status'=>$status,'emp_code'=>$emp_code));

        $slno=1;
		if (COUNT($result)>0) {
			foreach ($result AS $row) {
				$row->no = $slno;
				$start =date_create(date("Y-m-d"));
				$end = date_create($row->end_date);
				$remain=date_diff($start,$end);
				$row->remain = $remain->format("%a days");
				$output['aaData'][] = $row;
				$output['dbStatus'] = 'SUCCESS';
				$slno ++;
			}
		} else {
			$output['dbStatus'] = 'FAILURE';
		}
		return response()->json($output);
	}

	function fetchProjectStatusUpdatesTeamLead(Request $request){

		$output = array('aaData'=>array(),'dbStatus'=>'');
		$status = 1;
		$emp_code = $request->session()->get('emp_code');	
		// $date = date("Y/m/d");

		$result=DB::table('emp_update_tl')
		->join('employee', 'emp_update_tl.emp_code', '=', 'employee.emp_code')
		->join('project', 'emp_update_tl.proj_code', '=', 'project.proj_code')
		->select('emp_update_tl.*', 'employee.emp_name', 'project.proj_name')
		->get();

		$slno=1;
		if (COUNT($result)>0) {
			foreach ($result AS $row) {
				$row->no = $slno;
				$output['aaData'][] = $row;
				$output['dbStatus'] = 'SUCCESS';
				$slno ++;
			}
		} else {
			$output['dbStatus'] = 'FAILURE';
		}
		return response()->json($output);
	}

	function removeEmployeeStatus(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
		$id = $request->input('id');
		$result = DB::table('emp_update_tl')->where("id",$id)->delete();
		if ($result) {
			$dbStatus = "SUCCESS";
			$dbMessage = "Record has been deleted successfully";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		} else {
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}

		return response()->json($output);
	}

}
