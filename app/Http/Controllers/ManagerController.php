<?php

namespace App\Http\Controllers;

use App\Mail\AcceptLeave;
use App\Mail\DenyLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class ManagerController extends Controller
{
    public function getLeaveDtlHRByManager(Request $request){
        $role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
					
		$menu_name=$request->input('menu_name');
		return view('Managers.manageleave',compact(['menu','menu_name']));
    }

    public function fetchLeaveofHR(Request $request){
        $output = array('aaData'=>array(),'dbStatus'=>'');
        $mngr_code = $request->session()->get('mngr_code');
        $status = 1;
		$notApprove=0;
        $result = DB::table('leave_table')->where(['managing_code'=>$mngr_code,'status'=>$status,'approve_status'=>$notApprove])->get();
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
    public function fetchedLeaveofHR(Request $request){
        $output = array('aaData'=>array(),'dbStatus'=>'');
        $mngr_code = $request->session()->get('mngr_code');
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
    public function approveHRLeave(Request $request){
        $output = array("dbStatus" => "","dbMessage" => "");
        $accept = 1;
		$id = $request->input('id');
		$applicant = $request->input('applier_code');
        $managing_code = $request->input('managing_code');
        $updated_date = date('Y-m-d');
		$name='';
		$email='';
		$mngname = '';
		$mngemail ='';
		$mngposition = '';

		$search = DB::table('hr')->select('hr_name','email')->where(['hr_code'=>$applicant])->get();
		foreach($search as $hres){
			$name = $hres->hr_name;
            $email = $hres->email;
		}
        $searchMng = DB::table('managers')->select('mngr_name','mngr_code','position','email')->where(['mngr_code'=>$managing_code])->get();
        foreach($searchMng as $mres){
            $mngname = $mres->mngr_name;
            $mngposition = $mres->position;
        }
		$result = DB::table('leave_table')->where("id",$id)->update(['approve_status'=>$accept]);
		if ($result) {
			$details = array(
				'applicant' => $name,
				'sender'=>$mngname,
				'position'=>$mngposition,
				'start' => $request->input('start_date'),
				'end'=> $request->input('end_date'),
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
    public function denyHRLeave(Request $request){
        $output = array("dbStatus" => "","dbMessage" => "");
		$id = $request->input('id');
		$applicant = $request->input('applier_code');
        $managing_code = $request->input('managing_code');
        $updated_date = date('Y-m-d');

		$search = DB::table('hr')->select('hr_name','email')->where(['hr_code'=>$applicant])->get();
		foreach($search as $hres){
			$name = $hres->hr_name;
            $email = $hres->email;
		}
        $searchMng = DB::table('managers')->select('mngr_name','mngr_code','position','email')->where(['mngr_code'=>$managing_code])->get();
        foreach($searchMng as $mres){
            $mngname = $mres->mngr_name;
            $mngposition = $mres->position;
			$email = $mres->email;
        }

		$result = DB::table('leave_table')->where("id",$id)->update(['status'=>0]);
		if ($result) {
			$details = array(
				'applicant' => $name,
				'sender'=>$mngname,
				'position'=>$mngposition,
				'start' => $request->input('start_date'),
				'end'=> $request->input('end_date'),
				'reason'=>$request->input('reason'),
				'email'=>$email
			);
			Mail::to($email)->send(new DenyLeave($details));
			$dbStatus = "SUCCESS";
			$dbMessage = "Leave request has been denied..";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		} else {
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}
		return response()->json($output);
    }
    public function confirmHRLeave(Request $request){
		$output = array("dbStatus" => "","dbMessage" => "");
		$status=1;
		$applicant = $request->input('applier_code');
        $managing_code = $request->input('managing_code');
        $updated_date = date('Y-m-d');
		$search = DB::table('hr')->where('hr_code',$applicant)->update(['leave_status'=>$status,'updated_by'=>$managing_code,'updated_on'=>$updated_date]);

        if($search){
			$update_leave= DB::table('leave_table')->where('applier_code',$applicant)->update(array('status'=>0,'updated_by'=>$managing_code,'updated_on'=>$updated_date));
			if($update_leave){
				$dbStatus = "SUCCESS";
				$dbMessage = "Leave updated..";
				$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			}
			else{
				$dbStatus = "SUCCESS";
				$dbMessage = "Leave request has been Confirmed..";
				$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
			}
		}else {
			$dbStatus = "FAILURE";
			$dbMessage = "Someting Went Wrong";
			$output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
		}
		return response()->json($output);
    }

}
