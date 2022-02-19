<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementTeamController extends Controller
{
    public function manageManagers(Request $request)
    {
        $role_code = $request->session()->get('role_code');
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons')
					->where('role_code',$role_code)->orderBy('id')->get();
					
		$menu_name=$request->input('menu_name');
		return view('ManagementTeam.managers',compact(['menu','menu_name']));
    }
    public function fetchManagers(Request $request){
        $output = array('aaData'=>array(),'dbStatus'=>'');
        $mng_head = $request->session()->get('mng_code');
        $status = 1;

		$result = DB::table('managers')->where(['status'=>$status,'mng_head'=>$mng_head])->get();
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

    }public function dfetchManagers(Request $request){
        $output = array('aaData'=>array(),'dbStatus'=>'');
        $mng_head = $request->session()->get('mng_code');
        $status = 0;

		$result = DB::table('managers')->where(['status'=>$status,'mng_head'=>$mng_head])->get();
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
    public function addManager(Request $request){
        $output=array("aaData"=>array() , "dbMessage" => "", "dbStatus" => "");
		$status=1;
		$username = $request->input('username');
		$userid = $request->input('userid');
		$email = $request->input('email');
		$password = base64_encode(12345678);
		$phone = $request->input('phone');
        $managertype='';
        // get the management type
        $role_code = $request->session()->get('mng_code');
        $searchPosition = DB::table('management_team')->select('position')->where('mng_code',$role_code)->get();
        // print_r($searchPosition);

        foreach($searchPosition as $sp){
            if($sp->position == 'CMO'){
                $managertype = 'Marketing Manager';
            }
            else if($sp->position == 'CTO'){
                $managertype = 'Technical Manager';
            }
            else if($sp->position == 'COO'){
                $managertype = 'Operational Manager';
            }
            else if($sp->position == 'CBDO'){
                $managertype = 'Business Development Manager';
            }
        }

        // if($searchPosition == 'CTO'){
        //     $managertype = 'Technical Manager';
        // }
        // else if($searchPosition == 'CMO'){
        //     $managertype = 'Marketing Manager';
        // }
        // else if($searchPosition == 'COO'){
        //     $managertype = 'Operational Manager';
        // }
        // else if($searchPosition == 'CBDO'){
        //     $managertype = 'Business Development Manager';
        // }
		$fileName="";
        $roles = 'RLMANAGERS';
		$searchForExistance = DB::table('managers')->select('email')->where('email',$email)->get();
		// print_r(count($searchForExistance));
		if(count($searchForExistance) == 0 ){	
			if($request->hasFile('photo')){
				$photo = $request->file('photo');
				$extension = $photo->getClientOriginalExtension();
				$fileName = time().'.'.$extension;
				$photo->move(public_path('members/managers/'),$fileName);
			}	
			else{
				// echo "Enter photo";
			}	
			$result = DB::table('managers')->insert(['mngr_code'=>$userid ,'mngr_name'=>$username, 'role_code'=>$roles,'email'=>$email,"password"=>$password,"phone"=>$phone,"image"=>$fileName,
			"created_by"=>$role_code,'status'=>$status,'position'=>$managertype,'mng_head'=>$role_code]);

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
    public function editManager(Request $request){

        $output=array("aaData"=>array() , "dbMessage" => "", "dbStatus" => "");
		$username = $request->input('username');
		$userid = $request->input('userid');
		$email = $request->input('email');
		$phone = $request->input('phone');
		$fileName="";
        $role_code = $request->session()->get('mng_code');
		$searchForExistance = DB::table('managers')->select('email')->where('email',$email)->get();
		if(count($searchForExistance) == 0 ){	
			if($request->hasFile('photo')){
				$photo = $request->file('photo');
				$extension = $photo->getClientOriginalExtension();
				$fileName = time().'.'.$extension;
				$photo->move(public_path('members/managers/'),$fileName);
			}	
			else{
				// echo "Enter photo";
			}	
			$result = DB::table('managers')->where('mngr_code',$userid)->update(['mngr_name'=>$username, 'email'=>$email,"phone"=>$phone,"image"=>$fileName,
			"updated_by"=>$role_code,'mng_head'=>$role_code,'updated_on'=>date('Y-m-d H:i:s')]);

			if ($result) {
				$dbStatus = "SUCCESS";
				$dbMessage = "Record has been updated successfully";
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
    public function deleteManager(Request $request){

        $output=array("aaData"=>array() , "dbMessage" => "", "dbStatus" => "");
		$id = $request->input('id');
        $role_code = $request->session()->get('mng_code');
		$status = 0;
        $query = DB::table('managers')->where('id',$id)->update(['status'=>$status,"updated_by"=>$role_code,'updated_on'=>date('Y-m-d H:i:s')]);
        if ($query) {
            $dbStatus = "SUCCESS";
            $dbMessage = "Record has been Modified successfully";
            $output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
        } else {
            $dbStatus = "FAILURE";
            $dbMessage = "Someting Went Wrong";
            $output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
        }
		return response()->json($output);

    }
    public function enableManager(Request $request){

        $output=array("aaData"=>array() , "dbMessage" => "", "dbStatus" => "");
		$id = $request->input('id');
        $role_code = $request->session()->get('mng_code');
		$status = 1;
        $query = DB::table('managers')->where('id',$id)->update(['status'=>$status,"updated_by"=>$role_code,'updated_on'=>date('Y-m-d H:i:s')]);
        if ($query) {
            $dbStatus = "SUCCESS";
            $dbMessage = "Record has been Modified successfully";
            $output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
        } else {
            $dbStatus = "FAILURE";
            $dbMessage = "Someting Went Wrong";
            $output = array("dbStatus" => $dbStatus,"dbMessage" => $dbMessage);
        }
		return response()->json($output);

    }



}
