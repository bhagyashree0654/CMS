<?php

namespace App\Http\Controllers;

use App\Mail\SendInterviewMail;
use App\Mail\DenyLeave;
use App\Mail\AcceptLeave;
use App\Mail\OfferLetterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;
// use Barryvdh\DomPDF\Facade\Pdf;
class HRController extends Controller
{
	// fetch all sidebar menu with active
    public function gethrDashboard(Request $request){
        $role_code = $request->session()->get('role_code');
		$status=1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$status])->orderBy('id')->get();
		$hr_code = $request->session()->get('hr_code');
		$actives = DB::table('employee')->where(['log_status'=>1,'hr_code'=>$hr_code])->get();
		$inactives = DB::table('employee')->where(['log_status'=>0,'hr_code'=>$hr_code])->get();
		$leaves = DB::table('employee')->where(['leave_status'=>1,'hr_code'=>$hr_code])->get();
	
		$menu_name=$request->input('menu_name');
		return view('HR.hrdashboard',compact(['menu','menu_name','actives','inactives','leaves']));
	}
    public function getEmployeeDtl(Request $request){
        $role_code = $request->session()->get('role_code');
		$status = 1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$status])->orderBy('id')->get();
					
		$menu_name=$request->input('menu_name');
		return view('HR.employee',compact(['menu','menu_name']));
	}
    public function getInterview(Request $request){
        $role_code = $request->session()->get('role_code');
		$status = 1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$status])->orderBy('id')->get();
								
		$menu_name=$request->input('menu_name');
		return view('HR.interview',compact(['menu','menu_name']));
	}
    public function manageLeave(Request $request){
        $role_code = $request->session()->get('role_code');
		$status = 1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$status])->orderBy('id')->get();
								
		$menu_name=$request->input('menu_name');
		return view('HR.leave',compact(['menu','menu_name']));
	}
    public function getPerformanceChk(Request $request){
        $role_code = $request->session()->get('role_code');
        $hr_code = $request->session()->get('hr_code');
		$status = 1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$status])->orderBy('id')->get();
		$menu_name=$request->input('menu_name');
		return view('HR.performance',compact(['menu','menu_name']));
	}
    public function gethrprofile(Request $request){
        $role_code = $request->session()->get('role_code');
		$status = 1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$status])->orderBy('id')->get();
							
		$menu_name=$request->input('menu_name');
		return view('HR.profile',compact(['menu','menu_name']));
	}
    public function getProjects(Request $request){
        $role_code = $request->session()->get('role_code');
		$status = 1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$status])->orderBy('id')->get();
							
		$menu_name=$request->input('menu_name');
		return view('HR.project',compact(['menu','menu_name']));
	}
    public function getTimeTrack(Request $request){
        $role_code = $request->session()->get('role_code');
		$status = 1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$status])->orderBy('id')->get();
							
		$menu_name=$request->input('menu_name');
		return view('HR.timetrack',compact(['menu','menu_name']));
	}
	public function getSalaryDetails(Request $request){
        $role_code = $request->session()->get('role_code');
		$status = 1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where(['role_code'=>$role_code,'status'=>$status])->orderBy('id')->get();
							
		$menu_name=$request->input('menu_name');
		return view('HR.salary',compact(['menu','menu_name']));
	}
												//1.HR dashboard section
// 1.1 Fetch active employee under the hr
	function fetchHRActiveEmployee(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
		$status = 1;
		$hr_code = $request->session()->get('hr_code');
		

		$result=DB::table('employee')->select('emp_code','emp_name')->where(['log_status'=>$status,'hr_code'=>$hr_code])->get();

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

	// 1.2 Fetch inactive employee under the hr

	function fetchHRInActiveEmployee(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
		$status = 0;
		$hr_code = $request->session()->get('hr_code');
		$result=DB::table('employee')->select('emp_code','emp_name')->where(['log_status'=>$status,'hr_code'=>$hr_code])->get();

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
	// 1.3 Fetch employee on leave under the hr

	function fetchHRLeaveEmployee(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
		$status = 1;
		$hr_code = $request->session()->get('hr_code');
		$result=DB::table('employee')->select('emp_code','emp_name')->where(['leave_status'=>$status,'hr_code'=>$hr_code])->get();
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
	// 1.4 mark attendance
	function checkAttendanceHR(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
        $user = $request->input('employee');
        $status = 1;
		$on = 1;
        $result = DB::table('hr')->where(['hr_code'=>$user,'status'=>$status])->update(['attnd_status'=>$on]);

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
	// function uncheckAttendanceHR(Request $request){
	// 	$output = array("dbStatus" => "","dbMessage" => "");
    //     $user = $request->input('employee');
    //     $status = 1;
	// 	$off = 0;
    //     $result = DB::table('hr')->where(['hr_code'=>$user,'status'=>$status])->update(['attnd_status'=>$off]);

    //     echo $result;

    //     if ($result) {
	// 		$dbStatus = "SUCCESS";
	// 		$dbMessage = "Your attendance is unchecked..";
	// 		$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
	// 	} else {
	// 		$dbStatus = "FAILURE";
	// 		$dbMessage = "Someting Went Wrong";
	// 		$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
	// 	}
	// 	return response()->json($output);
	// }
	// // 1.5 Fetch teamlead status
	// function fetchTeamLeadStatus(Request $request){
	// 	$output = array('aaData'=>array(),'dbStatus'=>'');
	// 	$status = 1;
	// 	$hr_code = $request->session()->get('hr_code');	

	// 	$result=DB::table('teamlead_update_status_hr')
	// 	->join('employee', 'teamlead_update_status_hr.emp_code', '=', 'employee.emp_code')
	// 	->join('project', 'teamlead_update_status_hr.proj_code', '=', 'project.proj_code')
	// 	->select('teamlead_update_status_hr.*', 'employee.emp_name', 'project.proj_name')
	// 	->get();

	// 	$slno=1;
	// 	if (COUNT($result)>0) {
	// 		foreach ($result AS $row) {
	// 			$row->no = $slno;
	// 			$output['aaData'][] = $row;
	// 			$output['dbStatus'] = 'SUCCESS';
	// 			$slno ++;
	// 		}
	// 	} else {
	// 		$output['dbStatus'] = 'FAILURE';
	// 	}
	// 	return response()->json($output);
	// }
	// // 1.6 delete teamlead status
	// public function removeTeamLeadStatus(Request $request){
	// 	$output = array("dbStatus" => "","dbMessage" => "");
	// 	$id = $request->input('id');
	// 	$result = DB::table('teamlead_update_status_hr')->where("id",$id)->delete();
	// 	if ($result) {
	// 		$dbStatus = "SUCCESS";
	// 		$dbMessage = "Record has been deleted successfully";
	// 		$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
	// 	} else {
	// 		$dbStatus = "FAILURE";
	// 		$dbMessage = "Someting Went Wrong";
	// 		$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
	// 	}

	// 	return response()->json($output);
	// }
	// // 1.7 fetch all projects under hr
	// function fetchAllProjectsUnderHR(Request $request){
	// 	$output = array('aaData'=>array(),'dbStatus'=>'');
	// 	$status = 1;
	// 	$hr_code = $request->session()->get('hr_code');	

	// 	$result = DB::select(DB::raw("SELECT DISTINCT T1.project_code , T2.proj_name
	// 	FROM project_assignment T1 
	// 	INNER JOIN project T2 On T1.project_code = T2.proj_code
	// 	WHERE T1.hr_code = :hr_code and T1.status = :status"),array('hr_code'=>$hr_code,'status'=>$status));
	// 	$slno=1;
	// 	if (COUNT($result)>0) {
	// 		foreach ($result AS $row) {
	// 			$row->no = $slno;
	// 			$output['aaData'][] = $row;
	// 			$output['dbStatus'] = 'SUCCESS';
	// 			$slno ++;
	// 		}
	// 	} else {
	// 		$output['dbStatus'] = 'FAILURE';
	// 	}
	// 	return response()->json($output);
	// }
	// // 1.8 give updates to admin
	// function giveUpdatestoAdmin(Request $request){
	// 	$output = array('dbStatus'=>"",'dbMessage'=>"");
	// 	$status = 1;
	// 	$project_code = $request->input('project_code');
	// 	$updatestatus = $request->input('status');
	// 	$hr_code = $request->session()->get('hr_code');
	// 	$date = date("Y/m/d");
	
	
	// 	$result = DB::table('hr_update_status_admin')->insert(['proj_code'=>$project_code,'updates'=>$updatestatus,'hr_code'=>$hr_code,'date'=>$date,'status'=>$status,'created_by'=>$hr_code]);
	
	// 	if($result){
	// 		$dbStatus = "SUCCESS";
	// 		$dbMessage = " Candidate added successfully...";
	// 		$output = array('dbStatus'=>$dbStatus,'dbMessage'=>$dbMessage);
	// 	}
	// 	else{
	// 		$dbStatus = "FAILURE";
	// 		$dbMessage = " Candidate Not added";
	// 		$output = array('dbStatus'=>$dbStatus,'dbMessage'=>$dbMessage);
	// 	}	
	// 	return response()->json($output);
	// }

// 2. Employee Manipulation part
// 2.1 Fetch all employees
	public function fetchEmployeeViewHR(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
        $hr_code = $request->session()->get('hr_code');
        $status = 1;
		$like= '%EMP%';
        $result = DB::table('employee')->select('emp_code','emp_name','phone','email','joining_date','developer','emp_photo')->where(['hr_code'=>$hr_code,'status'=>$status])->where('role_code', 'like', '%' . $like . '%')->get();

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
	// 2.2: fetch all interns
	public function fetchInternViewHR(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "",'aaData'=>array());
        $hr_code = $request->session()->get('hr_code');
        $status = 1;
		$like= '%INT%';
        $result = DB::table('employee')->select('emp_code','emp_name','phone','email','joining_date','developer','emp_photo')->where(['hr_code'=>$hr_code,'status'=>$status])->where('role_code', 'like', '%' . $like . '%')->get();

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
	// 2.3 fetch all freelancer
	public function fetchFreelancerViewHR(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "",'aaData'=>array());
        $hr_code = $request->session()->get('hr_code');
        $status = 1;
		$like= '%FREE%';
        $result = DB::table('employee')->select('emp_code','emp_name','phone','email','joining_date','developer','emp_photo')->where(['hr_code'=>$hr_code,'status'=>$status])->where('role_code', 'like', '%' . $like . '%')->get();

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
	// 2.4 Addition of employee
	public function addEmployeeViewHR(Request $request){
		// print_r($request->all());
		$output=array("aaData"=>array() , "dbMessage" => "", "dbStatus" => "");
		$status=0;
		$user_acc = $request->input('user_acc');
		$username = $request->input('username');
		$names = explode(" ", $username);
		$first_name = $names[0]; //firstname
		$roles = $request->input('roles');
		$userid = $request->input('userid');
		$email = $request->input('email');
		$password = base64_encode( $request->input('password'));
		$phone = $request->input('phone');
		$address = $request->input('address');
		$developer = $request->input('position');
		$base_salary = $request->input('base_salary');
		$hra_salary = $request->input('hra_salary');
		$bills_salary = $request->input('bills_salary');
		$class_salary = $request->input('class_salary');
		$ref_salary = $request->input('ref_salary');
		$proj_ref_salary = $request->input('proj_ref_salary');
		$pf_salary = $request->input('pf_salary');
		$epf_salary = $request->input('epf_salary');
		$total_salary = $request->input('total_salary');
		$ctc_salary = $request->input('ctc_salary');
		$authority = $request->input('authority');
		$dob = $request->input('dob');
		$joining_date = $request->input('doj');
		$created_by = $request->session()->get('hr_code');
		$option = $request->input('hidId');

		if($option != ''){
			$operation = "update";
			echo $operation;
		}
		else{
			$operation = "insert";
			// echo $operation;
		}

		$fileName="";
		$searchForExistance = DB::table('employee')->select('email')->where('email',$email)->get();
		// print_r(count($searchForExistance));
		if(count($searchForExistance) == 0 ){	

			if($request->hasFile('photo')){
				$photo = $request->file('photo');
				$extension = $photo->getClientOriginalExtension();
				$fileName = time().'.'.$extension;
				$photo->move(public_path('members/employees/'),$fileName);
			}	
			else{
				// echo "Enter photo";
			}
			if($authority == "HR"){

				$fetchHRInfo = DB::table('hr')->select('digital_signature','hr_type','hr_name')->where('hr_code',$created_by)->get();
				if($fetchHRInfo){
					foreach ($fetchHRInfo as $row) {
						$signature = $row->digital_signature;
						$position = $row->hr_type;
						$name = $row->hr_name;
						$designation = 'HR Department';
					}
				}
			}
			else if($authority == "ADMIN"){
				$fetchHRInfo = DB::table('admin')->select('digital_signature','position','admin_name','designation')->where('position','CEO')->get();
				if($fetchHRInfo){
					foreach ($fetchHRInfo as $row) {
						$signature = $row->digital_signature;
						$position = $row->position;
						$designation = $row->designation;
						$name = $row->admin_name;
					}
				}
			}
			// generate offer letter accordingly
			if(strpos($roles, 'EMP') !== false) {
				$pdf = PDF::loadView('OfferLetter.fulltime',compact(['signature','position','designation','name','user_acc','joining_date','ctc_salary','total_salary','epf_salary','pf_salary','ref_salary','proj_ref_salary','class_salary','bills_salary','hra_salary','base_salary','developer','address','first_name','username']));

				// $pdf = PDF::loadView('Admin.report',compact(['report']));	
				// $pdfname = $first_name.'_'.$joining_date.'_offer_letter.pdf';
				// // return $pdf->download($pdfname);
				// $pdf->setPaper('A4','');
				// $pdf->output();
				// return $pdf->stream(".$pdfname.",array('Attachment'=>0));
	
			}
			else if(strpos($roles, 'INTERN') !== false) {
				$pdf = PDF::loadView('OfferLetter.intern',compact(['signature','position','designation','name','user_acc','joining_date','ctc_salary','total_salary','epf_salary','pf_salary','ref_salary','proj_ref_salary','class_salary','bills_salary','hra_salary','base_salary','developer','address','first_name','username']));
			}
			else if(strpos($roles, 'FREE') !== false) {
				$pdf = PDF::loadView('OfferLetter.freelancer',compact(['signature','position','designation','name','user_acc','joining_date','ctc_salary','total_salary','epf_salary','pf_salary','ref_salary','proj_ref_salary','class_salary','bills_salary','hra_salary','base_salary','developer','address','first_name','username']));
			}
			$pdf->setPaper('A4','');
			$pdf->output();
			$salary = DB::table('salary_structure')->insert(['emp_code'=>$userid ,'base'=>$base_salary, 'hra'=>$hra_salary,'internet_phone'=>$bills_salary,'class_allowances'=>$class_salary,"referral_bonus"=>$ref_salary,"project_referral"=>$proj_ref_salary,"pf"=>$pf_salary,"epf"=>$epf_salary,"total"=>$total_salary,'ctc'=>$ctc_salary,
			"status"=>1,"created_by"=>$created_by,"hr_code"=>$created_by]);

			$result = DB::table('employee')->insert(['emp_code'=>$userid ,'emp_name'=>$username, 'role_code'=>$roles,'joining_date'=>$joining_date,
			'email'=>$email,"password"=>$password,"salary"=>$ctc_salary,"phone"=>$phone,"emp_photo"=>$fileName,"address"=>$address,'hr_code'=>$created_by,
			"dob"=>$dob,"created_by"=>$created_by,'status'=>$status,'developer'=>$developer]);

			if ($result && $salary) {
				// $dbStatus = "SUCCESS";
				echo "Record has been inserted successfully";
				// $output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			} else {
				// $dbStatus = "FAILURE";
				echo "Someting Went Wrong Server error...";
				// $output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			}
			return $pdf->stream("offerletter".$first_name.".pdf",array('Attachment'=>0));
			

		}
		 else {
		// 	$dbStatus = "FAILURE";
			echo "Data already exists..";
		// 	$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			}
		// return response()->json($output);
	}

	public function editEmployeeViewHR(Request $request){
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
	public function deleteEmployeeViewHR(Request $request){
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
	
	// 2.6: send offerletter by mail
	public function sendOfferLetterViaMailByHR(Request $request){
		$userid = $request->input('emps');
		$getEmpInfo = DB::table('employee')->select('emp_name','email','developer')->where(['emp_code'=>$userid])->get();
		if(COUNT($getEmpInfo)> 0){
			foreach($getEmpInfo as $einf){
				$emp_name = $einf->emp_name;
				$email = $einf->email;
				$developer = $einf->developer;
			}	
		}
		$file = $request->file('letter');
		$data = array(
			'email' => $email,
			'name' => $emp_name,
			'file' => $file,
			'developer' => $developer
		);
		Mail::to($email)->send(new OfferLetterMail($data));
		$message = "Success";
		return redirect()->back()->with('message', 'Offer Mail Sent Successfully!');
	}

//3.interview section//
	// 3.1 add candidate for interview
	public function addCandidate(Request $request){
		$output = array('dbStatus'=>"",'dbMessage'=>"");
		$status = 1;
		$app_status = 0;
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');
		$email = $request->input('email');
		$mobile = $request->input('mobile');
		$skills = $request->input('skills');
		$position = $request->input('position');
		$created_by = $request->session()->get('hr_code');	
		$cv = $request->file('cv');
		$extension = $cv->getClientOriginalExtension();
		$fileName = time().'.'.$extension;
        $cv->move(public_path('Candidate Resume/Resume List'),$fileName);	
		$result = DB::table('new_candidate')->insert(['first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'mobile'=>$mobile,'skills'=>$skills,'position'=>$position,'status'=>$status,'app_status'=>$app_status,'resume'=>$fileName,'created_by'=>$created_by]);	
		if($result){
			$dbStatus = "SUCCESS";
			$dbMessage = " Candidate added successfully...";
			$output = array('dbStatus'=>$dbStatus,'dbMessage'=>$dbMessage);
		}
		else{
			$dbStatus = "FAILURE";
			$dbMessage = " Candidate Not added";
			$output = array('dbStatus'=>$dbStatus,'dbMessage'=>$dbMessage);
		}	
		return response()->json($output);
	   }
	
	// 3.2 edit candidate for interview
	public function editCandidate(Request $request){
		$output = array('dbStatus'=>"",'dbMessage'=>"");		
        $hidId = $request->input('hidId');
		$status = 1;
		$app_status = 0;
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');
		$email = $request->input('email');
		$mobile = $request->input('mobile');
		$skills = $request->input('skills');
		$position = $request->input('position');
		$updated_by = $request->session()->get('hr_code');
	
		$cv = $request->file('cv');
		$extension = $cv->getClientOriginalExtension();
		$fileName = time().'.'.$extension;
		// $cv->move('public/cvs/uploads',$fileName);
        $cv->move(public_path('Candidate Resume/Resume List'),$fileName);
	
		$result = DB::table('new_candidate')->where('id',$hidId)->update(['first_name'=>$first_name,'last_name'=>$last_name,'position'=>$position,'email'=>$email,'mobile'=>$mobile,'skills'=>$skills,'status'=>$status,'app_status'=>$app_status,'resume'=>$fileName,'updated_by'=>$updated_by]);
	
		if($result){
	
			$dbStatus = "SUCCESS";
			$dbMessage = " Candidate details Updated successfully...";
			$output = array('dbStatus'=>$dbStatus,'dbMessage'=>$dbMessage);
	
		}
		else{
			$dbStatus = "FAILURE";
			$dbMessage = " Candidate Not added";
			$output = array('dbStatus'=>$dbStatus,'dbMessage'=>$dbMessage);
		}	
		return response()->json($output);

	}   

	// 3.3 delete candidate for interview
	public function deleteCandidate(Request $request){
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

	// 3.4 view all candiadate list not approved by admin
	public function allCandidateList(Request $request){
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

	// 3.4 view all candiadate list approved by admin
	public function approvedCandidateList(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
		$status = 1;
		$app = 1;
		$result = DB::table('new_candidate')->select('first_name','last_name','email','mobile','skills','resume','id','position')
		->where(['status'=>$status,'app_status'=>$app])->get();
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
	 // 3.5 send interview mail
	 function sendemail(Request $request){
		$hr = $request->session()->get('hr_code');
		$hrresult = DB::table('hr')->select('hr_name','email','hr_type')->where(['hr_code'=>$hr])->get();

		foreach($hrresult as $hres){
			$hrname = $hres->hr_name;
			$hcont = $hres->email;
			$hrtype = $hres->hr_type;
		}

        $email = $request->input('email');
		$first_nme= $request->input('first_name');
		$last_name = $request->input('last_name');
		$candidate_name = $first_nme." ".$last_name;
            $data = array(
						'name' => $candidate_name,
                        'link' => $request->input('link'),
                        'meetTime' => $request->input('meetTime'),
						'pos'=> $request->input('position'),
						'meeting_date'=>$request->input('ivdate'),
						'sendername'=>$hrname,
						'senderContact'=>$hcont,
						'position'=>$hrtype,
                    );

		Mail::to($email)->send(new SendInterviewMail($data));
		$message = "Success";
		return redirect()->back()->with('message', 'Mail Sent Successfully!');
    }
// 3.6 remove candidate from interview list
	public function removeCandidate(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
		$id = $request->input('id');
		$result = DB::table('new_candidate')->where("id",$id)->delete();
		if ($result) {
			$dbStatus = "SUCCESS";
			$dbMessage = "Record has been removed successfully";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		} else {
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}
		return response()->json($output);
	}


									//4. Profile Section //
// 4.1 fetch profile
public function fetchHRProfile(Request $request){
	$output = array('aaData'=>array(),'dbStatus'=>'');
	$user = $request->session()->get('hr_code');
	$status = 1;
	$result = DB::table('hr')->select('hr_code','hr_name','salary','hr_photo','email','contact','dob','address')
	->where(['hr_code'=>$user,'status'=>$status])->get();

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

// 4.2 update personal information
	public function updateHRInfoManual(Request $request){

		$output = array("dbStatus" => "","dbMessage" => "");
		$address= $request->address;
		$dob=$request->input('dob');
		$address = $request->input('address');
		$emp_code = $request->session()->get('hr_code');
		
		if($request->hasFile('photo')){
			$photo = $request->file('photo');
			$extension = $photo->getClientOriginalExtension();
			$fileName = time().'.'.$extension;
			$photo->move(public_path('members/employees/'),$fileName);
		}
		$updated_on = date('Y-m-d H:i:s');

		$result = DB::table('hr')->where('hr_code',$emp_code)->update(["hr_photo"=>$fileName,"address"=>$address,
		"dob"=>$dob,"updated_by"=>$emp_code,'updated_on'=>$updated_on]);
		if($result){
			$profup = "Information updated..!!!";
			$output = array("dbStatus" => "SUCCESS","dbMessage" => $profup);
		}	
		else{
			$profup = "Please update your info once or try again later..!!!";
			$output = array("dbStatus" => "FAILURE","dbMessage" => $profup);
		}	
		return response()->json($output);	
	}

	//4.3  password reset when employee is login
	public function resetpasswithloginHR(Request $request){
		$output = array('dbStatus'=>'','dbMessage'=>'');
		$oldpass = base64_encode($request->input('opass'));
		$newpass = base64_encode($request->input('npass'));

		$user = $request->session()->get('hr_code');
		$query = DB::table('hr')->where(['hr_code'=> $user , 'password' => $oldpass])->update(['password'=>$newpass]);
		if($query){
			$output['dbStatus'] = 'SUCCESS';
			$output['dbMessage'] = 'Password updated successfully..!!';
		}
		else{
			$output['dbStatus'] = 'FAILURE';
			$output['dbMessage'] = 'Wrong Password.. Please try again..!!';
		}
		return response()->json($output);
	}
	// 4.4 update sign information
	public function uploadHRDigSign(Request $request){
		// $output = array("dbStatus" => "","dbMessage" => "");
		$emp_code = $request->session()->get('hr_code');		
		if($request->hasFile('sign')){
			$photo = $request->file('sign');
			$extension = $photo->getClientOriginalExtension();
			$fileName = $emp_code.time().'.'.$extension;
			$photo->move(public_path('members/sign/'),$fileName);
		}
		$updated_on = date('Y-m-d H:i:s');
		$result = DB::table('hr')->where('hr_code',$emp_code)->update(["digital_signature"=>$fileName,"updated_by"=>$emp_code,'updated_on'=>$updated_on]);
		if($result){
			$profup = "Signature updated..!!!";
			// $output = array("dbStatus" => "SUCCESS","dbMessage" => $profup);
		}	
		else{
			$profup = "Please update your info once or try again later..!!!";
			// $output = array("dbStatus" => "FAILURE","dbMessage" => $profup);
		}	
		return redirect()->back()->with('message', $profup);
	}


										//5 Project Section
	//5.1 fetch all project details under the hr
	// public function fetchAllProjectHR(Request $request){
	// 	$output = array('aaData'=>array(),'dbStatus'=>'');
    //     $emp_code = $request->session()->get('hr_code');
    //     $status = 1;

	// 	$result = DB::select(DB::raw("SELECT p.proj_name,pa.emp_code,pa.project_code,e.emp_name,pa.starting_date,pa.end_date 
	// 	from project_assignment pa INNER JOIN project p ON pa.project_code = p.proj_code
	// 	INNER JOIN  employee e ON e.emp_code = pa.emp_code WHERE pa.status=:status and pa.hr_code=:emp_code"),array('status'=>$status,'emp_code'=>$emp_code));

    //     $slno=1;
	// 	if (COUNT($result)>0) {
	// 		foreach ($result AS $row) {
	// 			$row->no = $slno;
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
											//6.manage leave section
	//6.1 fetch leave request 
	public function fetchLeaveRequest(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
        $mngr_code = $request->session()->get('hr_code');
        $status = 1;
		$approve=0;
        $result = DB::table('leave_table')->where(['managing_code'=>$mngr_code,'status'=>$status,'approve_status'=>$approve])->get();
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
	public function approveLeaveRequest(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
		$accept = 1;
		$id = $request->input('id');
		$applicant = $request->input('emp');
        $managing_code = $request->session()->get('hr_code');
        $updated_date = date('Y-m-d');
		$name='';
		$email='';
		$mngname = '';
		$mngemail ='';
		$mngposition = '';
		$empresult = DB::table('employee')->select('emp_name','email')->where(['emp_code'=>$applicant])->get();
		foreach($empresult as $eres){
			$name = $eres->emp_name;			
			$email = $eres->email;
		}
		$searchhr = DB::table('hr')->select('hr_name','hr_code','hr_type','email')->where(['hr_code'=>$managing_code])->get();
        foreach($searchhr as $hres){
            $mngname = $hres->hr_name;
            $mngposition = $hres->hr_type;
			$mngemail = $hres->email;
        }
		$result = DB::table('leave_table')->where("id",$id)->update(['approve_status'=>$accept,'updated_by'=>$managing_code,'updated_on'=>$updated_date]);
		if ($result) {
			$details = array(
				'applicant' => $name,
				'sender'=>$mngname,
				'position'=>$mngposition,
				'email'=>$mngemail,
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
	public function denyLeaveRequest(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
		$accept = 1;
		$id = $request->input('id');
		$applicant = $request->input('emp');
        $managing_code = $request->session()->get('hr_code');
        $updated_date = date('Y-m-d');
		$name='';
		$email='';
		$mngname = '';
		$mngemail ='';
		$mngposition = '';
		$empresult = DB::table('employee')->select('emp_name','email')->where(['emp_code'=>$applicant])->get();
		foreach($empresult as $eres){
			$name = $eres->emp_name;			
			$email = $eres->email;
		}
		$searchhr = DB::table('hr')->select('hr_name','hr_code','hr_type','email')->where(['hr_code'=>$managing_code])->get();
        foreach($searchhr as $hres){
            $mngname = $hres->hr_name;
            $mngposition = $hres->hr_type;
			$mngemail = $hres->email;
        }
		$result = DB::table('leave_table')->where("id",$id)->update(['status'=>0,'updated_by'=>$managing_code,'updated_on'=>$updated_date]);
		if ($result) {
			$details = array(
				'applicant' => $name,
				'sender'=>$mngname,
				'position'=>$mngposition,
				'email'=>$mngemail,
				'start' => $request->input('start'),
				'end'=> $request->input('end'),
				'reason'=>$request->input('reason')
			);
			Mail::to($email)->send(new DenyLeave($details));
			$dbStatus = "SUCCESS";
			$dbMessage = "Leave request has been rejected..";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		} else {
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}
		return response()->json($output);
	}
	//6.4 fetch approved leave request 
	public function fetchLeaveRequestAccepted(Request $request){
		$output = array('aaData'=>array(),'dbStatus'=>'');
        $mngr_code = $request->session()->get('hr_code');
        $status = 1;
		$approve=1;
        $result = DB::table('leave_table')->where(['managing_code'=>$mngr_code,'status'=>$status,'approve_status'=>$approve])->get();
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
	public function confirmLeaveRequest(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
		$id = $request->input('id');
		$code = $request->input('code');
		$accept = 1;
		
		$searchEmpLeave = DB::table('employee')->where('emp_code',$code)->update(['leave_status'=>$accept]);
		if($searchEmpLeave){
			$result = DB::table('leave_table')->where("id",$id)->delete();
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

	// Performance
	public function fetchPerformanceHR(Request $request){
		$output = array('dbStatus' => '' , 'dbMessage' => '', 'aaData' => array());
		$mngr_code = $request->session()->get('hr_code');
		$employees  = DB::table('employee')
		->leftjoin('clock_timer','clock_timer.emp_code','=','employee.emp_code')
		->select('employee.emp_name','employee.emp_code','clock_timer.total_time')->where('employee.hr_code',$mngr_code)->get();
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
	// fetch roles
	public function fetchRolesHR(Request $request){
		$output = array('dbStatus' => '' , 'dbMessage' => '', 'aaData' => array());
		$mngr_code = $request->session()->get('hr_code');
		$emplike='%EMP%';
		$intlike='%INTERN%';
		$freelike='%FREElANCER%';
		$roles  = DB::table('role_master')->select('role_name','role_code')->where('role_code', 'like', '%' . $emplike . '%')->orwhere('role_code', 'like', '%' . $freelike . '%')->orwhere('role_code', 'like', '%' . $intlike . '%')->get();
		if(count($roles) > 0){
			$slno = 1;
			foreach($roles as $role){
				$role->no = $slno;
				$output['aaData'][] = $role;
				$output['dbStatus'] = 'SUCCESS';
				$slno++;
			}
			$output['dbMessage'] = 'Roles Found';
		}
		else{
			$output['dbStatus'] = 'FAILURE';
			$output['dbMessage'] = 'Roles Not Found';
		}
		return response()->json($output);
	}
	// fetchEmployeesByRoles
	public function fetchEmployeesByRolesHR(Request $requset){
		$output = array('dbStatus' => '' , 'dbMessage' => '', 'aaData' => array());
		$hr = $requset->session()->get('hr_code');
		$role = $requset->input('role');
		$employees  = DB::table('employee')->select('emp_name','emp_code')->where(['hr_code'=>$hr,'role_code'=>$role,'status'=>0])->get();
		if(count($employees) > 0){
			foreach($employees as $employee){
				$output['aaData'][] = $employee;
				$output['dbStatus'] = 'SUCCESS';
			}
			$output['dbMessage'] = 'Employees Found';
		}
		else{
			$output['dbStatus'] = 'FAILURE';
			$output['dbMessage'] = 'Employees Not Found';
		}
		return response()->json($output);

	}
	// 7. Salary
	public function fetchSalaryByHR(Request $requset){
		$output = array('dbStatus' => '' , 'dbMessage' => '', 'aaData' => array());
		$hr = $requset->session()->get('hr_code');

		$salary = DB::table('salary_structure')->join('employee','salary_structure.emp_code','=','employee.emp_code')->where('salary_structure.hr_code',$hr)->get();
		if(count($salary) > 0){
			$slno = 1;
			foreach($salary as $sal){
				$sal->no = $slno;
				$output['aaData'][] = $sal;
				$output['dbStatus'] = 'SUCCESS';
				$slno++;
			}
			$output['dbMessage'] = 'Salary Found';
		}
		else{
			$output['dbStatus'] = 'FAILURE';
			$output['dbMessage'] = 'Salary Not Found';
		}
		return response()->json($output);
	}
	// 7.1 : Update Salary
	public function updateSalaryByHR(Request $request){
		$output = array('dbStatus' => '' , 'dbMessage' => '');
		$id = $request->input('hidId');
		$base_salary = $request->input('base_salary');
		$hra = $request->input('hra_salary');
		$bills = $request->input('bills_salary');
		$class_salary = $request->input('class_salary');
		$bonus = $request->input('ref_salary');
		$proj_ref_salary = $request->input('proj_ref_salary');
		$pf  = $request->input('pf_salary');
		$epf = $request->input('epf_salary');
		$total_salary = $request->input('total_salary');
		$ctc = $request->input('ctc_salary');
		$hr = $request->session()->get('hr_code');
		$salary = DB::table('salary_structure')->where('emp_code',$id)->update(['base'=>$base_salary,'hra'=>$hra,'internet_phone'=>$bills,'class_allowances'=>$class_salary,'referral_bonus'=>$bonus,'project_referral'=>$proj_ref_salary,'pf'=>$pf,'epf'=>$epf,'total'=>$total_salary,'ctc'=>$ctc,'updated_by'=>$hr,'updated_on'=>date('Y-m-d H:i:s')]);
		if($salary){
			$output['dbStatus'] = 'SUCCESS';
			$output['dbMessage'] = 'Salary Updated';
		}
		else{
			$output['dbStatus'] = 'FAILURE';
			$output['dbMessage'] = 'Salary Not Updated';
		}
		return response()->json($output);
	}


}

