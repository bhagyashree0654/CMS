<?php

namespace App\Http\Controllers;

use App\Mail\RequestLeave;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{

	//sidebar menu list
	public function getEmpIndex(Request $request){
		$role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->get();
					
		$menu_name=$request->input('menu_name');
		return view('Employee.empdashboard',compact(['menu','menu_name']));
	}
	public function getEmpProject(Request $request){
		$role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->get();
					
		$menu_name=$request->input('menu_name');
		return view('Employee.viewproject',compact(['menu','menu_name']));
	}
	public function getEmpProfile(Request $request){
		$role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->get();
					
		$menu_name=$request->input('menu_name');
		return view('Employee.viewprofile',compact(['menu','menu_name']));
	}
	public function trackTime(Request $request){
		$role_code = $request->session()->get('role_code');
		$emp_code = $request->session()->get('emp_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->get();
		
		$projects= DB::table('project_assignment')
		->join('project','project_assignment.project_code','=','project.proj_code')->select('project_assignment.project_code','project.proj_name')->where('emp_code',$emp_code)->get();
		
		$tasks = DB::table('clock_timer')->join('project','clock_timer.proj_code','=','project.proj_code')->select('project.proj_name','clock_timer.task','clock_timer.update_date','clock_timer.total_time')->where('emp_code',$emp_code)->get();
		$menu_name=$request->input('menu_name');
		return view('trackTime',compact(['menu','menu_name','projects','tasks']));
	}

	//on dashboard
	// check attendance
    public function checkAttendance(Request $request){
        $output = array("dbStatus" => "","dbMessage" => "");
        $user = $request->input('employee');
        $status = 1;
		$on = 1;
        $result = DB::table('employee')->where(['emp_code'=>$user,'status'=>$status])->update(['attend_status'=>$on]);

        echo $result;

        if ($result) {
			$dbStatus = "SUCCESS";
			$dbMessage = "Thank You! Attendance store successfully";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		} else {
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}
		return response()->json($output);

    }
	public function uncheckAttendance(Request $request){
        $output = array("dbStatus" => "","dbMessage" => "");
        $user = $request->input('employee');
        $status = 1;
		$on = 0;
        $result = DB::table('employee')->where(['emp_code'=>$user,'status'=>$status])->update(['attend_status'=>$on]);

        echo $result;

        if ($result) {
			$dbStatus = "SUCCESS";
			$dbMessage = "Your attendance is unchecked..";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		} else {
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}
		return response()->json($output);

    }
// 2. update project status
	public function updateStatusToTeamLead(Request $request){
		$project = $request->input('project');
		$statusUpdate = $request->input('upstatus');
		$emp_code = $request->session()->get('emp_code');
		$date = date('Y-m-d H:i:s');
		$status = 1;
		$result = DB::table('emp_update_tl')->insert(['proj_code'=>$project,'emp_code'=>$emp_code,'dates'=>$date,'work_updates'=>$statusUpdate
							,'status'=>$status,'created_by'=>$emp_code]);
		if($result){
			$statmessage = "Data inserted..!!!";
			return redirect()->back()->with('message',$statmessage);
		}	
		else{
			$statmessage = "Please update your status once..!!!";
			return redirect()->back()->with('message',$statmessage);
		}				
	}

	public function fetchEmployeeProjectSelect(Request $request){

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

// 3.graph work


// profile page
// 1.fetch profile
	public function fetchEmployeeProfile(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
        $user = $request->session()->get('emp_code');
        $status = 1;
        $result = DB::table('employee')->select('emp_code','emp_name','salary','emp_photo','email','phone','dob','address')
		->where(['emp_code'=>$user,'status'=>$status])->get();

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

	// 2.update personal information
	public function updateEmployeeInfoManual(Request $request){

		$address= $request->address;
		$dob=$request->input('dob');
		$address = $request->input('address');
		$emp_code = $request->session()->get('emp_code');
		
		if($request->hasFile('photo')){
			echo "hiii inside photo";
			$photo = $request->file('photo');
			$extension = $photo->getClientOriginalExtension();
			$fileName = time().'.'.$extension;
			$photo->move(public_path('members/employees/'),$fileName);
		}
		echo "hiii outside photo";
		// $fetchimg=DB::table('employee')->select('emp_photo')->get();
		// if($fetchimg){
		// 	foreach($fetchimg as $img){
		// 		$pimg= $img->emp_photo;
		// 	}
		// 	echo $pimg;
		// 	if(file_exists('members/employees/'.$pimg.'')){
		// 		unlink('members/employees/'.$pimg.'');
		// 	  }else{
		// 		echo('File does not exists.');
		// 	  }
		// }
		$updated_on = date('Y-m-d H:i:s');

		$result = DB::table('employee')->where('emp_code',$emp_code)->update(["emp_photo"=>$fileName,"address"=>$address,
		"dob"=>$dob,"updated_by"=>$emp_code,'updated_on'=>$updated_on]);
		if($result){
			$profup = "Information updated..!!!";
			return redirect()->back()->with('message',$profup);
		}	
		else{
			$profup = "Please update your info once or try again later..!!!";
			return redirect()->back()->with('message',$profup);
		}		
	}

	//3. password reset when employee is login
	public function resetpasswithlogin(Request $request){
		$oldpass = base64_encode($request->input('opass'));
		$newpass = base64_encode($request->input('npass'));

		$user = $request->session()->get('emp_code');
		$query = DB::table('employee')->where(['emp_code'=> $user , 'password' => $oldpass])->update(['password'=>$newpass]);
		if($query){
			$passmsg = "Password updated..!!!";
			return redirect()->back()->with('message',$passmsg);
		}
		else{
			$passmsg = "Try after sometimes.!!!";
			return redirect()->back()->with('message',$passmsg);			
		}
	}

// Project
// 1.Fetch all project details & view only

	public function fetchProjectDataForEmployee(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
        $emp_code = $request->session()->get('emp_code');
        $status = 1;
// // SELECT s.name as Student, c.name as Course 
// // FROM student s
// //     INNER JOIN bridge b ON s.id = b.sid
// //     INNER JOIN course c ON b.cid  = c.id 
// // ORDER BY s.name 
// /*DB::select(DB::raw("SELECT p.proj_name,pa.emp_code,pa.proj_code,e.emp_name,pa.starting_date,pa.end_date 
// from project_assignment pa INNER JOIN project p ON pa.project_code = p.proj_code
// INNER JOIN  employee e ON e.emp_code = pa.emp_code WHERE pa.status=:status and pa.emp_code=:emp_code"),array('status'=>$status,'emp_code'=>$emp_code));

// */
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


//Leave application
	public function empLeaveApplication(Request $request){

		$output = array("dbStatus" => "","dbMessage" => "");
		$start = $request->input('startDate');
		$end = $request->input('endDate');
		$reason = $request->input('lvreason');
		$role = $request->session()->get('role_code');
		$status = 1;
		$approve = 0;
		$mng_code = '';

		if($role == 'RLEMP'){
			$employee = $request->session()->get('emp_code');
			$hr = DB::select(DB::raw("SELECT T2.email,T2.hr_code,T2.hr_name,T1.emp_name
				FROM employee T1
				INNER JOIN hr T2 On T1.hr_code = T2.hr_code
				WHERE T1.status = :status"),array('status'=>$status));

				if (count($hr)>0) {
					foreach ($hr AS $row) {
						$to_mail = $row->email;	
						$emp_name = $row->emp_name;
						$hr_name = $row->hr_name;	
						$hr_code = $row->hr_code;				
				}

			$result = DB::table('leave_table')
			->insert(['hr_code'=>$hr_code,'emp_code'=>$employee,'start_date'=>$start,'end_date'=>$end,'reason'=>$reason,'status'=>$status,'approve_status'=>$approve,'created_by'=>$employee]);

			if($result){
				
				$details = [
					'to'=>$start,
					'from'=>$end,
					'reason'=>$reason,
					'emp'=>$emp_name,
					'hr'=>$hr_name
				];
					Mail::to($to_mail)->send(new RequestLeave($details));
					$dbStatus = "SUCCESS";
					$dbMessage = "Thank You! Your Request store successfully";
					$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
				}	
				else{
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
		}
		if($role == 'RLHR'){
			$employee = $request->session()->get('hr_code');
			$hr= DB::table('hr')->select('hr_name','mng_head')->where('hr_code',$employee)->get();
			if (count($hr)>0) {
				foreach ($hr AS $h) {
					$hr_name = $h->hr_name;					
					$mng_code = $h->mng_head;					
				}
			}
			$sender = DB::select(DB::raw("SELECT M.email,M.mngr_code,M.mngr_name
			FROM managers M	WHERE M.status = :status and M.mngr_code = :code"),array('status'=>$status,'code'=>$mng_code));

		   if (count($sender)>0) {
			   foreach ($sender AS $row) {
				   $to_mail = $row->email;
				   $admin = $row->mngr_name;
				   $admin_code = $row->mngr_code;						
		   }
			$result = DB::table('leave_table')
			->insert(['managing_code'=>$admin_code,'applier_code'=>$employee,'start_date'=>$start,'end_date'=>$end,'reason'=>$reason,'status'=>$status,'approve_status'=>$approve,'created_by'=>$employee]);

			if($result){
				$details = [
					'to'=>$start,
					'from'=>$end,
					'reason'=>$reason,
					'name'=>$admin,
					'sender'=>$hr_name
				];
					Mail::to($to_mail)->send(new RequestLeave($details));
					$dbStatus = "SUCCESS";
					$dbMessage = "Thank You! Your Request store successfully";
					$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
				}	
				else{
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
		}
		return response()->json($output);
	}

	
}
