<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DenyLeave;
use App\Mail\AcceptLeave;
use App\Mail\clientmail;
use Illuminate\Support\Facades\DB;
use PDF;


class AdminController extends Controller
{
	// menu list of sidebar admin
	public function adminDashboard(Request $request){
        $role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
		$active_status = 1;			
		$inactive_status=0;
		//dashboard
		$activeemp = DB::table('employee')->select('emp_name','emp_code','log_time','emp_photo')->where('log_status',$active_status);
		$actives = DB::table('hr')->select('hr_code','hr_name','log_time','hr_photo')->where('log_status',$active_status)->union($activeemp)->get();
		$inactiveemp = DB::table('employee')->select('emp_name','emp_code','log_time','emp_photo')->where('log_status',$inactive_status);
		$inactives = DB::table('hr')->select('hr_code','hr_name','log_time','hr_photo')->where('log_status',$inactive_status)->union($inactiveemp)->get();
		$leaveemp = DB::table('employee')->select('emp_name','emp_code','log_time','emp_photo')->where('leave_status',$active_status);
		$leaves = DB::table('hr')->select('hr_code','hr_name','log_time','hr_photo')->where('leave_status',$active_status)->union($leaveemp)->get();
		$menu_name=$request->input('menu_name');
	
		return view('Admin.admdashboard',compact(['menu','menu_name','actives','inactives','leaves']));
	}


    public function getEmployeeDetails(Request $request){
        $role_code = $request->session()->get('role_code');
		$status=1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>1])->orderBy('id')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Admin.employee',compact(['menu','menu_name']));
	}

    public function getIntern(Request $request){
        $role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Admin.intern',compact(['menu','menu_name']));
	}

    public function getRoles(Request $request){
        $role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Admin.roles',compact(['menu','menu_name']));
	}

    public function getAttendance(Request $request){
        $role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Admin.attendance',compact(['menu','menu_name']));
	}
    public function getLeaveDetails(Request $request){
        $role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Admin.leave',compact(['menu','menu_name']));
	}
    public function getPerformance(Request $request){
        $role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
	$employees  = DB::table('employee')
	->leftjoin('clock_timer','clock_timer.emp_code','=','employee.emp_code')
	->select('employee.emp_name','employee.emp_code','clock_timer.total_time')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Admin.performance',compact(['menu','menu_name','employees']));
	}

	// public function getAdminTreeView(Request $request){
	// 	$role_code = $request->session()->get('role_code');
	// 	$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
	// 				->where('role_code',$role_code)->orderBy('id')->get();
					
	// 	$menu_name=$request->input('menu_name');
	// 	return view('Admin.treeview',compact(['menu','menu_name']));
	// }

	public function getClient(Request $request){
        $role_code = $request->session()->get('role_code');
		$status=1;
		$countries = DB::table('country')->select('id','nicename')->get();
		$backend=DB::table('technologies')->select('id','technology','type')->where('type',"Backend")->orWhere('type',"Others")->get();
		$frontend=DB::table('technologies')->select('id','technology','type')->where(['type'=>"Frontend"])->get();
		$dbs=DB::table('technologies')->select('id','technology','type')->where(['type'=>"DB"])->get();
		$servers=DB::table('technologies')->select('id','technology','type')->where(['type'=>"Server"])->get();
		$clients = DB::table('client')->select('id','company_name','cin','country','document')->where('status',1)->get();
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Admin.client',compact(['menu','menu_name','countries','backend','frontend','dbs','servers','clients']));
	}


	public function getProjectAdm(Request $request){

		$employees = DB::table('employee')->select('id','emp_name','emp_code')->get();
		$hrs=DB::table('hr')->select('id','hr_name','hr_code')->get();
		$frontend = DB::table('technologies')->select('id','technology','type')->where('type','Frontend')->get();
		$backend = DB::table('technologies')->select('id','technology','type')->where('type','Backend')->get();
		$others = DB::table('technologies')->select('id','technology','type')->where('type','Others')->get();
		// $projects = DB::table('project')->orderBy('id', 'DESC')->get();

        $role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();					
		$menu_name=$request->input('menu_name');
		return view('Admin.project',compact(['menu','menu_name','employees','hrs','frontend','backend','others']));
	}


// ***********************************************************end of menu list*************************************************************//
public function fetchCards(){

	$output = array('aaData'=>array(),'dbStatus'=>'');
	$status = 1;

	$allresult=DB::table('project')->where('status',$status)->count();
	$newresult=DB::table('project')->where('closing_status',0)->count();
	$clients=DB::table('client')->where('status',1)->count();

	// print_r($newresult);
	// print_r($allresult);
	$slno=1;
	if ($newresult>0 || $allresult>0 || $clients>0){			
		$output['aaData']['allproject'] = $allresult;
		$output['aaData']['newproject'] = $newresult;
		$output['aaData']['clients'] = $clients;
		$output['dbStatus'] = 'SUCCESS';
	} else {
		$output['dbStatus'] = 'FAILURE';
	}
	return response()->json($output);
	
}
// 1.1 Dashboard section	
public function fetchActiveEmployee(){

	$output = array('aaData'=>array(),'dbStatus'=>'');
	$status = 1;
	$astatus = 1;
	
	$first = DB::table('hr')->select('hr_code','hr_name')->where('log_status',$status);
	$result=DB::table('employee')->select('emp_code','emp_name')->where('log_status',$status)->union($first)->get();

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
public function fetchInActiveEmployee(){

	$output = array('aaData'=>array(),'dbStatus'=>'');
	$status = 0;
	
	$first = DB::table('hr')->select('hr_code','hr_name')->where('log_status',$status);
	$result=DB::table('employee')->select('emp_code','emp_name')->where('log_status',$status)->union($first)->get();

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
public function fetchLeaveEmployee(){

	$output = array('aaData'=>array(),'dbStatus'=>'');
	$status = 1;
	
	$first = DB::table('hr')->select('hr_code','hr_name','hr_photo')->where('leave_status',$status);
	$result=DB::table('employee')->select('emp_code','emp_name','emp_photo')->where('leave_status',$status)->union($first)->get();

	$slno=1;
	if (COUNT($result)>0) {
		foreach ($result AS $row) {
			$row->no = $slno;
			$output['aaData'][] = $row;
			$output['dbStatus'] = 'SUCCESS';
			$slno ++;
		}
	} else {
		$output['aaData'][] = "";
		$output['dbStatus'] = 'FAILURE';
	}
	return response()->json($output);
}
public function fetchHRStatus(Request $request){
	$output = array('aaData'=>array(),'dbStatus'=>'');
	$status = 1;
	$app_status = 0;
	
	
	$result=DB::table('hr_update_status_admin')
	->join('hr', 'hr_update_status_admin.hr_code', '=', 'hr.hr_code')
	->join('project', 'hr_update_status_admin.proj_code', '=', 'project.proj_code')
	->select('hr_update_status_admin.*', 'hr.hr_name', 'project.proj_name')
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
function removeHRStatus(Request $request){
	$output = array("dbStatus" => "","dbMessage" => "");
	$id = $request->input('id');
	$result = DB::table('hr_update_status_admin')->where("id",$id)->delete();
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
// ***********************************************************end of dashboard page*************************************************************//
// ***********************************************************employee list*************************************************************//

public function getEmployeeCount(){
	$output = array('aaData'=>array(),'dbStatus'=>'');
	$status = 1;

	
	$countAdm=DB::table('admin')->count();
	$countEmp=DB::table('employee')->count();
	$countMngr=DB::table('hr')->count();
	$countMngtm=DB::table('management_team')->count();
	$countHR=DB::table('managers')->count();


	$totalEmployee = $countAdm + $countEmp + $countHR + $countMngr + $countMngtm + 1 ; 

	if ($countAdm>0 || $countEmp>0 || $countHR > 0 || $countMngr > 0 || $countMngtm > 0){			
		$output['aaData']['totalEmployee'] = $totalEmployee;
		$output['dbStatus'] = 'SUCCESS';
	} else {
		$output['dbStatus'] = 'FAILURE';
	}
	return response()->json($output);

}

	public function fetchRoles(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
		$status = 1;

		$result = DB::select(DB::raw("SELECT T1.role_code, T1.role_name, T1.id
					FROM role_master T1
					where T1.status = :status
					ORDER BY T1.id"),array('status'=>$status));

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
	public function fetchEmployee(){

		$output = array('aaData'=>array(),'dbStatus'=>'');
		$status = 1;

		$result = DB::select(DB::raw("SELECT T1.emp_code, T1.email, T1.emp_name,T1.id,T1.role_code,T2.role_name,T1.emp_photo,T1.developer,T1.salary
					FROM employee T1 INNER JOIN role_master T2 ON T1.role_code = T2.role_code
					where T1.status = :status
					ORDER BY T1.id"),array('status'=>$status));

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
	public function fetchHR(){

		$output = array('aaData'=>array(),'dbStatus'=>'');
		$status = 1;

		$result = DB::select(DB::raw("SELECT T1.hr_code, T1.email, T1.hr_name,T1.id,T1.role_code,T2.role_name,T1.hr_photo
					FROM hr T1 INNER JOIN role_master T2 ON T1.role_code = T2.role_code
					where T1.status = :status
					ORDER BY T1.id"),array('status'=>$status));

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

	public function addEmployee(Request $request){
		$output=array("aaData"=>array() , "dbMessage" => "", "dbStatus" => "");
		$status=1;
		$username = $request->input('username');
		$roles = $request->input('roles');
		$userid = $request->input('userid');
		$email = $request->input('email');
		$password = base64_encode( $request->input('password'));
		$salary = $request->input('salary');
		$phone = $request->input('phone');
		$address = $request->input('address');
		$developer = $request->input('position');
		$dob = $request->input('dob');
		$created_by = 'Super Admin';
		$fileName="";

		$searchForExistance = DB::table('employee')->select('email')->where('email',$email)->get();
		print_r(count($searchForExistance));
		if(count($searchForExistance) == 0 ){	

			if($request->hasFile('photo')){
				$photo = $request->file('photo');
				$extension = $photo->getClientOriginalExtension();
				$fileName = time().'.'.$extension;
				$photo->move(public_path('members/employees/'),$fileName);
			}	
			else{
				echo "Enter photo";
			}	

			$result = DB::table('employee')->insert(['emp_code'=>$userid ,'emp_name'=>$username, 'role_code'=>$roles,
			'email'=>$email,"password"=>$password,"salary"=>$salary,"phone"=>$phone,"emp_photo"=>$fileName,"address"=>$address,
			"dob"=>$dob,"created_by"=>$created_by,'status'=>$status,'developer'=>$developer]);

			if ($result) {
				$dbStatus = "SUCCESS";
				$dbMessage = "Record has been inserted successfully";
				$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			} else {
				$dbStatus = "FAILURE";
				$dbMessage = "Someting Went Wrong";
				$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			}

		}
		 else {
			$dbStatus = "FAILURE";
			$dbMessage = "Data already exists..";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			}

		return response()->json($output);
	}


	public function editEmployee(Request $request){
		$output=array("aaData"=>array() , "dbMessage" => "", "dbStatus" => "");
		$status=1;
		$hidId = $request->input('hidId');
		$roles = $request->input('roles1');
		$userid = $request->input('euserid');
		$salary = $request->input('esalary');
		$developer = $request->input('eposition');
		$updated_by = 'Super Admin';

			$result = DB::table('employee')->where(['id'=>$hidId,'emp_code'=>$userid])->update(['emp_code'=>$userid , 'role_code'=>$roles,
			"salary"=>$salary,"updated_by"=>$updated_by,'status'=>$status,'developer'=>$developer]);

		if ($result) {
			$dbStatus = "SUCCESS";
			$dbMessage = "Record has been inserted successfully";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		} else {
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}

		return response()->json($output);
	}


	public function deleteEmployee(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
		$id = $request->input('id');
		$result = DB::table('employee')->where("id",$id)->delete();
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

// ***********************************************************end of employee list*************************************************************//
// ***************************************************intern/employee review list*******************************************************//
public function fetchInternReviewList(){
	$output = array('aaData'=>array(),'dbStatus'=>'');
	$status = 1;
	$app_status = 0;		
	$result = DB::table('new_candidate')->select('first_name','last_name','email','mobile','skills','resume','id','position')
	->where(['status'=>$status,'app_status'=>$app_status])->get();
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

public function approveIntern(Request $request){
	$output=array("aaData"=>array() , "dbMessage" => "", "dbStatus" => "");
	$id = $request->input('id');
	$app_status = 1;
	$result = DB::table('new_candidate')->where('id',$id)->update(['app_status'=>$app_status]);

	if ($result) {
		$dbStatus = "SUCCESS";
		$dbMessage = "Thank You! Record has been updated successfully";
		$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
	} else {
		$dbStatus = "FAILURE";
		$dbMessage = "Someting Went Wrong";
		$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
	}
	return response()->json($output);
}
public function rejectIntern(Request $request){
	$output = array("dbStatus" => "","dbMessage" => "");
	$id = $request->input('id');
	$result = DB::table('new_candidate')->where("id",$id)->delete();
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
// ***********************************************************end of intern list*************************************************************//
// ***********************************************************leave request list*************************************************************//
//6.1 manage leave section
	public function fetchLeaveRequestAdmin(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
        $status = 1;
		$notApprove=0;

		$result = DB::select(DB::raw("SELECT e.hr_name,lt.hr_code,lt.id,lt.start_date,lt.end_date,lt.reason,e.email
		from leave_table_hr lt INNER JOIN hr e ON lt.hr_code = e.hr_code
		WHERE lt.status=:status and lt.approve_status=:notApprove" ),array('status'=>$status,'notApprove'=>$notApprove));

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
	//6.2 approve leave request
	public function approveLeaveRequestHR(Request $request){

		$output = array("dbStatus" => "","dbMessage" => "");
		$accept = 1;
		$id = $request->input('id');
		$email = $request->input('email');
		$emp = $request->input('hr');
		$hr = $request->input('hrcode');
		$admin = DB::table('admin')->select('admin_name','email')->get();

		foreach($admin as $hres){
			$hrname = $hres->admin_name;
			$hcont = $hres->email;
		}

		$result = DB::table('leave_table_hr')->where("id",$id)->update(['approve_status'=>$accept]);
		if ($result) {
			$details = array(
				'name' => $emp,
				'hrname'=>$hrname,
				'hrcontact'=>$hcont,
				'start' => $request->input('start'),
				'end'=> $request->input('end'),
				'reason'=>$request->input('reason')
			);
			Mail::to($email)->send(new AcceptLeave($details));
			$dbStatus = "SUCCESS";
			$dbMessage = "Leave request has been accepted..";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		} else {
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}
		return response()->json($output);

	}
	//6.3 deny leave request
	public function denyLeaveRequestHR(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
		$id = $request->input('id');
		$email = $request->input('email');
		$emp = $request->input('hr');
		$admin = DB::table('admin')->select('admin_name','email')->get();

		foreach($admin as $hres){
			$hrname = $hres->admin_name;
			$hcont = $hres->email;
		}

		$result = DB::table('leave_table_hr')->where("id",$id)->delete();
		if ($result) {
			$details = array(
				'name' => $emp,
				'hrname'=>$hrname,
				'hrcontact'=>$hcont,
				'start' => $request->input('start'),
				'end'=> $request->input('end'),
				'reason'=>$request->input('reason')
			);
			Mail::to($email)->send(new DenyLeave($details));
			$dbStatus = "SUCCESS";
			$dbMessage = "Leave request has been discarded..";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		} else {
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}
		return response()->json($output);
	}
	//6.4 fetch approved leave request 
	public function fetchLeaveRequestAcceptedHR(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
        $status = 1;
		$notApprove=1;

		$result = DB::select(DB::raw("SELECT e.hr_name,lt.hr_code,lt.id,lt.start_date,lt.end_date,lt.reason,e.email
		from leave_table_hr lt INNER JOIN hr e ON lt.hr_code = e.hr_code
		WHERE lt.status=:status and lt.approve_status=:notApprove" ),array('status'=>$status,'notApprove'=>$notApprove));

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
	//6.5 confirm leave request
	public function confirmLeaveRequestHR(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
		$id = $request->input('id');
		$code = $request->input('code');
		$accept = 1;
		
		$searchEmpLeave = DB::table('hr')->where('hr_code',$code)->update(['leave_status'=>$accept]);
		if($searchEmpLeave){
			$result = DB::table('leave_table_hr')->where("id",$id)->delete();
			if ($result) {
				$dbStatus = "SUCCESS";
				$dbMessage = "Leave request updated..";
				$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			} else {
				$dbStatus = "FAILURE";
				$dbMessage = "Someting Went Wrong";
				$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			}
		}
		else{
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}
		
		return response()->json($output);
	}
// ***********************************************************end of leave list*************************************************************//

// ***********************************************************project list*************************************************************//
public function fetchProjectLanguage(){
	$output = array("dbStatus" => "","dbMessage" => "");
	$result = DB::table('technologies')->get();
	if (COUNT($result)>0) {
		foreach ($result AS $row) {
			$output['aaData'][] = $row;
			$output['dbStatus'] = 'SUCCESS';
		}
	} else {
		$output['dbStatus'] = 'FAILURE';
	}
	return response()->json($output);
}

// Project Admin
// ****************//
public function fetchProjectByAdmin(Request $request){
	$output = array('aaData'=>array(),'dbStatus'=>'');
        $status = 1;

		$result = DB::table('project')->get();
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
public function addProjectByAdmin(Request $request){

	$output = array("dbStatus" => "","dbMessage" => "");
	// print_r($request->all());
	$project_name = $request->input('project_name');
	$project_code = $request->input('project_code');
	$type = $request->input('type');
	if(isset($request->client_name)){
		$client_name = $request->input('client_name');
	}
	else{
		$client_name = "";
	}
	$languages = $request->input('languages');
	$start_date = $request->input('start_date');
	$end_date = $request->input('end_date');
	$selected_emps = $request->input('selected-emps'); //ARRAY FORMAT BY ,
	$members = $request->input('members');
	$team_lead_name = $request->input('team-lead'); 
	$proj_lead_name = $request->input('proj-lead'); 
	$team_lead_code = $request->input('team-lead-name'); // update employee code team-lead
	$proj_lead_code = $request->input('proj-lead-name'); // update employee code proj-lead

	if($type == "Internal"){
		$int_type = 1;
	}
	else if($type == "External"){
		$int_type = 0;
	}

	$proj_doc = $request->file('proj_doc');
	$extension = $proj_doc->getClientOriginalExtension();
	$fileName = $project_code.time().'.'.$extension;
	$proj_doc->move(public_path('Project Documentation/Project List'),$fileName);
	
	$status = 1;
	$created_by = $request->session()->get('role_code');;
	$emparray=explode(",",$selected_emps);

	$searchProject = DB::table('project')->where('proj_code',$project_code)->get();
	if(count($searchProject) > 0){
		$dbStatus = "FAILURE";
		$dbMessage = "Project Code Already Exist";
		$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		return response()->json($output);	
	}

	$query = DB::table('project')->insert(['proj_name' => $project_name, 'proj_code' => $project_code, 'pref_lang' => $languages,'members' => $members,'internal_status'=>$int_type, 'client_name' => $client_name, 'starting_date' => $start_date, 'end_date' => $end_date, 'project_lead' => $proj_lead_name,'team_lead' => $team_lead_name,'documentation'=>$fileName,'status'=>$status,'created_by'=>$created_by]);
	if($query){
		
		foreach($emparray as $emp){
			if($emp == $proj_lead_code){
				$plcode = 1;
			}
			else{
				$plcode = 0;
			}
			if($emp == $team_lead_code){
				$tlcode = 1;
			}
			else{
				$tlcode = 0;
			}
		
			$assign = DB::table('project_assignment')->insert(['project_code'=>$project_code,'emp_code'=>$emp,'team_lead_status'=>$tlcode,'project_lead_status'=>$plcode,'proj_lead_code'=>$proj_lead_code ,'team_lead_code'=> $team_lead_code ,'status'=>$status,'created_by'=>$created_by]);
			if($assign){
				$output = array("dbStatus" => "SUCCESS","dbMessage" => "Project Added");
			}
			else{
				$output = array("dbStatus" => "FAILURE","dbMessage" => "Project Not Added");
				return response()->json($output);
			}
		}
		$dbStatus = "SUCCESS";
		$dbMessage = "Project Added";
		$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
	}
	else{
		$dbStatus = "FAILURE";
		$dbMessage = "Something went wrong in project section";
		$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
	}
	return response()->json($output);
	
}

public function editProjectByAdmin(Request $request){	
	$output = array("dbStatus" => "","dbMessage" => "");
	// print_r($request->all());
	$id = $request->input('hidId');
	$project_name = $request->input('project_name');
	$project_code = $request->input('project_code');
	$type = $request->input('type');
	if(isset($request->client_name)){
		$client_name = $request->input('client_name');
	}
	else{
		$client_name = "";
	}
	$languages = $request->input('languages');
	$start_date = $request->input('start_date');
	$end_date = $request->input('end_date');
	$selected_emps = $request->input('selected-emps'); //ARRAY FORMAT BY ,
	$members = $request->input('members');
	$team_lead_name = $request->input('team-lead'); 
	$proj_lead_name = $request->input('proj-lead'); 
	$team_lead_code = $request->input('team-lead-name'); // update employee code team-lead
	$proj_lead_code = $request->input('proj-lead-name'); // update employee code proj-lead

	if($type == "Internal"){
		$int_type = 1;
	}
	else if($type == "External"){
		$int_type = 0;
	}

	$proj_doc = $request->file('proj_doc');
	$extension = $proj_doc->getClientOriginalExtension();
	$fileName = $project_code.time().'.'.$extension;
	$proj_doc->move(public_path('Project Documentation/Project List'),$fileName);
	
	$status = 1;
	$updated_by = $request->session()->get('role_code');
	$updated_on=date('Y-m-d H:i:s');
	$emparray=explode(",",$selected_emps);

	// delete all previous project assignment
	$deleteQuery = DB::table('project_assignment')->where('project_code',$project_code)->delete();

	// if($deleteQuery){

		// insert new project
		// check if project code already exist
		$searchProject = DB::table('project')->where('proj_code',$project_code)->get();
		if(count($searchProject) > 0){
			$dbStatus = "FAILURE";
			$dbMessage = "Project Code Already Exist";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			return response()->json($output);	
		}
		// update project
		$updateQuery = DB::table('project')->where('id',$id)->update(['proj_name' => $project_name, 'proj_code' => $project_code, 'pref_lang' => $languages,'members' => $members,'internal_status'=>$int_type, 'client_name' => $client_name, 'starting_date' => $start_date, 'end_date' => $end_date, 'project_lead' => $proj_lead_name,'team_lead' => $team_lead_name,'documentation'=>$fileName,'status'=>$status,'updated_by'=>$updated_by,'updated_on'=>$updated_on]);

		if($updateQuery){
			foreach($emparray as $emp){
				if($emp == $proj_lead_code){
					$plcode = 1;
				}
				else{
					$plcode = 0;
				}
				if($emp == $team_lead_code){
					$tlcode = 1;
				}
				else{
					$tlcode = 0;
				}
			
				$assign = DB::table('project_assignment')->insert(['project_code'=>$project_code,'emp_code'=>$emp,'team_lead_status'=>$tlcode,'project_lead_status'=>$plcode,'proj_lead_code'=>$proj_lead_code ,'team_lead_code'=> $team_lead_code ,'status'=>$status,'created_by'=>$updated_by]);
				if($assign){
					$output = array("dbStatus" => "SUCCESS","dbMessage" => "Project Added");
				}
				else{
					$output = array("dbStatus" => "FAILURE","dbMessage" => "Project Not Added");
					return response()->json($output);
				}
			}

			$dbStatus = "SUCCESS";
			$dbMessage = "Project Updated";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}
		else{
			$dbStatus = "FAILURE";
			$dbMessage = "Project Not Updated";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			return response()->json($output);
		}


	return response()->json($output);

	
}
public function disableProject(Request $request){

	$output = array("dbStatus" => "","dbMessage" => "");
	$id = $request->input('id');
	$code = $request->input('code');
	$status = 1;
	$updated_by = $request->session()->get('role_code');
	$updated_on=date('Y-m-d H:i:s');
	$query = DB::table('project')->where('proj_code',$code)->update(['closing_status'=>$status,'updated_by'=>$updated_by,'updated_on'=>$updated_on]);
	$upassignemt = DB::table('project_assignment')->where('project_code',$code)->update(['close'=>$status,'updated_by'=>$updated_by,'updated_on'=>$updated_on]);
	if($query && $upassignemt){
		$output = array("dbStatus" => "SUCCESS","dbMessage" => "Project Disabled");
	}
	else{
		$output = array("dbStatus" => "FAILURE","dbMessage" => "Project Not Disabled");
	}
	return response()->json($output);	
}
// ***********************************************************end of project list*************************************************************//

public function generatepdfclient(Request $request){

	// print_r($request->all());
	$companyfullname=$request->input('fullnm');
	$companyshortname=$request->input('shortnm');
	$Commencement=	$Commencement=$request->input('com_date');
	// $Commencement=$request->input('com_date');
	$country = $request->input('country');
	$cin = $request->input('cin');
	$address = $request->input('address');
	$proj_name = $request->input('proj_name');
	$proj_type = $request->input('proj_type');
	$proj_domain = $request->input('proj_domain');
	$panels = $request->input('panels');
	$front= $request->input('frontends'); //get array
	$back= $request->input('backends'); //getArray
	$db = $request->input('db');
	$server = $request->input('server');
	$languages = $request->input('languages');
	$features = $request->input('feature');	
	$reqanalysis = $request->input('reqanalysis');
	$backendarch = $request->input('backendarch');
	$figdesign = $request->input('figdesign');
	$development = $request->input('development');
	$testing = $request->input('testing');
	$final_touch = $request->input('final_touch');
	$p_designing = $request->input('p_designing');
	$p_development = $request->input('p_development');
	$p_testing = $request->input('p_testing');
	$p_lptesting = $request->input('p_lptesting');
	$p_hosting = $request->input('p_hosting');
	$total_amount = $request->input('total_amount');
	$tc_brd = $request->input('tc_brd');
	$tc_ux = $request->input('tc_ux');
	$tc_democ = $request->input('tc_democ');
	$tc_fdemoc = $request->input('tc_fdemoc');
	$sign = $request->file('dig_sign');
	$stamp = $request->file('dig_stamp');

	$role_code = $request->session()->get('role_code');
	$username = $request->session()->get('display_name');
	$position = $request->session()->get('position');
	$countries = DB::table('country')->select('id','nicename')->get();
		$backend=DB::table('technologies')->select('id','technology','type')->where(['type'=>"Backend",'type'=>"Others"])->get();
		$frontend=DB::table('technologies')->select('id','technology','type')->where(['type'=>"Frontend"])->get();
		$dbs=DB::table('technologies')->select('id','technology','type')->where(['type'=>"DB"])->get();
		$servers=DB::table('technologies')->select('id','technology','type')->where(['type'=>"Server"])->get();
		$clients = DB::table('client')->select('id','company_name','cin','country','document')->where('status',1)->get();
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
					
		$menu_name=$request->input('menu_name');


		$search = DB::table('client')->select('cin')->where('cin',$cin)->get();
		if(count($search)){

			echo "CIN already exist";
		}
		else{
			$insertClient = DB::table('client')->insert(['company_name'=>$companyfullname,'country'=>$country,'cin'=>$cin,'status'=>1,'created_by'=>$username]);
			if($insertClient){
				// $output = array("dbStatus" => "SUCCESS","dbMessage" => "Client Added");
			}
			else{
				// $output = array("dbStatus" => "FAILURE","dbMessage" => "Client Not Added");
				// return response()->json($output);
			}
		}
	

	// generate pdf + add to db
	$pdf = PDF::loadView('Admin.certificate',compact(['companyfullname','companyshortname','Commencement','country','cin','address','proj_name','proj_type','proj_domain','panels','front','back','db','server','languages','features','reqanalysis','backendarch','figdesign','development','testing','final_touch','p_designing','p_development','p_testing','p_lptesting','p_hosting','total_amount','tc_brd','tc_ux','tc_democ','tc_fdemoc','sign','stamp','menu','menu_name','backend','frontend','dbs','servers','clients','countries','username','position']));
	
	// return $pdf->download('client.pdf');
	$pdf->setPaper('A4','');
	$pdf->output();
	// $canvas = $pdf->getDomPDF()->getCanvas();
	// $height = $canvas->get_height();
	// $width = $canvas->get_width();
	// $imageW= "400";
	// $imageH= "500";
	// $x = (($width-$imageW)/2);
	// $y = (($height-$imageH)/2);
	// $canvas->set_opacity(.2,"Multiply");
	// $canvas->image("public/assets/img/logo-white-bg.png", $x, $y, $imageW, $imageH);
	// $canvas->image($width/5, $height/2, 'Codekart', null, 70, array(0,0,0),2,2,0);
			// $font = null;
            // $size = 16;
            // $color = array(255,0,0);
            // $word_space = 0.0;  //  default
            // $char_space = 0.0;  //  default
            // $angle = 0.0;   //  default
	// $pdf->page_text(200,50,'',$font,$size,$color,$word_space,$char_space,$angle);
	return $pdf->stream("client.pdf",array('Attachment'=>0));
	// $created_by = $request->session()->get('role_code');
	// $generateddoc="";
	// $insertClient = DB::table('client')->insert(['company_name'=>$companyfullname,'country'=>$country,'cin'=>$cin,'document'=>$generateddoc,'status'=>1,'created_by'=>$created_by]);
	// if($insertClient){
	// 	// $output = array("dbStatus" => "SUCCESS","dbMessage" => "Client Added");
	// }
	// else{
	// 	// $output = array("dbStatus" => "FAILURE","dbMessage" => "Client Not Added");
	// 	// return response()->json($output);
	// }

	return redirect('getclient');
}

public function fetchPerformance(Request $request){
	$output = array('dbStatus' => '' , 'dbMessage' => '', 'aaData' => array());
	$employees  = DB::table('employee')
	->leftjoin('clock_timer','clock_timer.emp_code','=','employee.emp_code')
	->select('employee.emp_name','employee.emp_code','clock_timer.total_time')->get();
	if(count($employees) > 0){
		$slno = 1;
		foreach($employees as $employee){
			$employee->no = $slno;
			$output['aaData'][] = $employee;
			$output['dbStatus'] = 'SUCCESS';
			$slno++;
		}
		$output['dbMessage'] = 'Employees Found';
	}
	else{
		$output['dbStatus'] = 'FAILURE';
		$output['dbMessage'] = 'Employees Not Found';
	}
	return response()->json($output);
}

public function generateDoc(Request $request){
	$report=$request->input('report');
	// generate pdf + add to db
	$pdf = PDF::loadView('Admin.report',compact(['report']));
	$pdf->setPaper('A4','');
	$pdf->output();
	return $pdf->stream("report.pdf",array('Attachment'=>0));
	return redirect('getProjectAdm');
}

public function sendMailToClient(Request $request){
	$email=$request->input('email');
	$file = $request->file('file');
		$data = array(
			'email' => $email,
			'file' => $file,
		);
		Mail::to($email)->send(new clientmail($data));
		$message = "Success";
		return redirect()->back()->with('message', 'Mail Sent Successfully!');
}


	
}
