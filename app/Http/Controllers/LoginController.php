<?php

namespace App\Http\Controllers;

use App\Mail\OTPmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function getLogin(){
		return view('Auth.login');
	}

    public function loginValidate(Request $request)
	{
		$request->session()->put('data',$request->input());
		$username = $request->input('username');
		$password =base64_encode($request->input('password')); 
		$status = 1;
		$active_status = 1;
		$inactive_status = 0;
		$dashboard = "";
		$emp_code = "";	
		$display_name = "";
		$role_code = "";
		$role="";
		$position="";

        $first = DB::table('employee')->select('role_code')->where('emp_code',$username);
        $second = DB::table('admin')->select('role_code')->where('admin_code',$username)->union($first);
		$third = DB::table('management_team')->select('role_code')->where('mng_code',$username)->union($second);
		$fourth = DB::table('managers')->select('role_code')->where('mngr_code',$username)->union($third);
		$final = DB::table('hr')->select('role_code')->where('hr_code',$username)->union($fourth)->get();

        if (count($final)>0) {
            foreach ($final AS $row) {
                $role = $row->role_code;
        
        	}
    	}

		if($role == 'RLEMP'    || $role == 'RLTEAMLEAD'){
			// different emp roles

			// $update_log_time = DB::table('employee')->where('emp_code',$username)->update(['log_time'=>date('Y-m-d H:i:s')]);

			// $employee = DB::select(DB::raw("SELECT T1.emp_code, T1.emp_name as display_name,  password,T1.role_code,T2.dashboard,T2.role_name,T1.log_status,T1.attend_status,T1.emp_photo,T1.team_lead_status,T1.log_time
			// 	FROM employee T1
			// 	INNER JOIN role_master T2 On T1.role_code = T2.role_code
			// 	WHERE T1.emp_code = :username and T1.password = :password and T1.status = :status"),array('username'=>$username,'password'=>$password,'status'=>$status));
			$employee = DB::select(DB::raw("SELECT T1.emp_code, T1.emp_name as display_name,  password,T1.role_code,T2.dashboard,T2.role_name,T1.log_status,T1.attend_status,T1.emp_photo,T1.log_time
				FROM employee T1
				INNER JOIN role_master T2 On T1.role_code = T2.role_code
				WHERE T1.emp_code = :username and T1.password = :password and T1.status = :status"),array('username'=>$username,'password'=>$password,'status'=>$status));

			if (count($employee)>0) {
				foreach ($employee AS $row) {
					$dashboard = $row->dashboard;
					$emp_code = $row->emp_code;
					$display_name = $row->display_name; 
					$role_code = $row->role_code;	
					// $teamlead = $row->team_lead_status;	
					$photo = $row->emp_photo;					
				}

			$loginStatus = 1;
			$result= DB::table('employee')->where('emp_code',$emp_code)->update(['log_status'=>$loginStatus,'attend_status'=>$loginStatus]);
			if(!$result){
				$result1 = DB::table('employee')->where('emp_code',$emp_code)->update(['log_status'=>0,'attend_status'=>0,'log_time'=>date('Y-m-d H:i:s')]);
				$message = "Please login again..";
				return view('Auth.login',compact(['message']));

			}
				$request->session()->put('display_name',$display_name);
				$request->session()->put('role_code',$role_code);
				$request->session()->put('emp_code',$emp_code);
				$request->session()->put('photo',$photo);
			}	
			else{
				$message = "Invalid login id or password..";
				return view('Auth.login',compact(['message']));
				
			}			
			
		}
		else if($role == 'RLADMIN'){
			$admin = DB::select(DB::raw("SELECT T1.admin_code, T1.admin_name as display_name,  password,T1.role_code,T2.dashboard,T2.role_name, T1.admin_photo,T1.position
		 			FROM admin T1
		 			INNER JOIN role_master T2 On T1.role_code = T2.role_code
		 			WHERE T1.admin_code = :username and T1.password = :password and T1.status = :status"),array('username'=>$username,'password'=>$password,'status'=>$status));

		$activeemp = DB::table('employee')->select('emp_name','emp_code','log_time','emp_photo')->where('log_status',$active_status);
		$actives = DB::table('hr')->select('hr_code','hr_name','log_time','hr_photo')->where('log_status',$active_status)->union($activeemp)->get();
		$inactiveemp = DB::table('employee')->select('emp_name','emp_code','log_time','emp_photo')->where('log_status',$inactive_status);
		$inactives = DB::table('hr')->select('hr_code','hr_name','log_time','hr_photo')->where('log_status',$inactive_status)->union($inactiveemp)->get();
		$leaveemp = DB::table('employee')->select('emp_name','emp_code','log_time','emp_photo')->where('leave_status',$active_status);
		$leaves = DB::table('hr')->select('hr_code','hr_name','log_time','hr_photo')->where('leave_status',$active_status)->union($leaveemp)->get();

			if (count($admin)>0) {
				foreach ($admin AS $row) {

					$position = $row->position;
					$dashboard = $row->dashboard;
					$admin_code = $row->admin_code;
					$display_name = $row->display_name; 
					$role_code = $row->role_code;
					$photo = $row->admin_photo;					
				}
				
				$request->session()->put('display_name',$display_name);
				$request->session()->put('role_code',$role_code);
				$request->session()->put('admin_code',$admin_code);
				$request->session()->put('photo',$photo);
				$request->session()->put('position',$position);
			}	
			else{
				$message = "Invalid login id or password..";
				return view('Auth.login',compact(['message']));
				
			}
		 
		}
		else if($role == 'RLHR'){
			$hr = DB::select(DB::raw("SELECT T1.hr_code, T1.hr_name as display_name,  password,T1.role_code,T2.dashboard,T2.role_name,T1.log_status,T1.attnd_status,T1.hr_photo,T1.log_time
				FROM hr T1
				INNER JOIN role_master T2 On T1.role_code = T2.role_code
				WHERE T1.hr_code = :username and T1.password = :password and T1.status = :status"),array('username'=>$username,'password'=>$password,'status'=>$status));

					if (count($hr)>0) {
						foreach ($hr AS $row) {
							$dashboard = $row->dashboard;
							$hr_code = $row->hr_code;
							$display_name = $row->display_name; 
							$role_code = $row->role_code;	
							$photo = $row->hr_photo;						
						}
						$loginStatus = 1;
						$result= DB::table('hr')->where('hr_code',$hr_code)->update(['log_status'=>$loginStatus,'attnd_status'=>$loginStatus,'log_time'=>date('Y-m-d H:i:s')]);
						if(!$result){
							$result1= DB::table('hr')->where('hr_code',$hr_code)->update(['log_status'=>0,'attnd_status'=>0]);
							$message = "Please login again..";
							return view('Auth.login',compact(['message']));

						}
						// $codes = $request->session()->get('hr_code');
						$actives = DB::table('employee')->where(['log_status'=>1,'hr_code'=>$hr_code])->get();
						$inactives = DB::table('employee')->where(['log_status'=>0,'hr_code'=>$hr_code])->get();
						$leaves = DB::table('employee')->where(['leave_status'=>1,'hr_code'=>$hr_code])->get();
					
						$request->session()->put('display_name',$display_name);
						$request->session()->put('role_code',$role_code);
						$request->session()->put('hr_code',$hr_code);
						$request->session()->put('photo',$photo);
								
					}
					else{
						$message = "Invalid login id or password..";
						return view('Auth.login',compact(['message']));
						
					}
			
		}
		else if($role == "RLMANAGEMENT"){
			$managementteam = DB::select(DB::raw("SELECT T1.mng_code, T1.mng_name as display_name,  password,T1.role_code,T2.dashboard,T2.role_name,T1.image
			FROM management_team T1
			INNER JOIN role_master T2 On T1.role_code = T2.role_code
			WHERE T1.mng_code = :username and T1.password = :password and T1.status = :status"),array('username'=>$username,'password'=>$password,'status'=>$status));

			if (count($managementteam)>0) {
				foreach ($managementteam AS $row) {
					$dashboard = $row->dashboard;
					$mng_code = $row->mng_code;
					$display_name = $row->display_name; 
					$role_code = $row->role_code;	
					$photo = $row->image;						
				}
				$request->session()->put('display_name',$display_name);
				$request->session()->put('role_code',$role_code);
				$request->session()->put('mng_code',$mng_code);
				$request->session()->put('photo',$photo);
						
			}
			else{
				$message = "Invalid login id or password..";
				return view('Auth.login',compact(['message']));
				
			}
		}
		// managers
		else if($role == "RLMANAGERS"){
			$mngrs = DB::select(DB::raw("SELECT T1.mngr_code, T1.mngr_name as display_name,  password,T1.role_code,T2.dashboard,T2.role_name,T1.image,T1.mng_head
			FROM managers T1
			INNER JOIN role_master T2 On T1.role_code = T2.role_code
			WHERE T1.mngr_code = :username and T1.password = :password and T1.status = :status"),array('username'=>$username,'password'=>$password,'status'=>$status));

			if (count($mngrs)>0) {
				foreach ($mngrs AS $row) {
					$dashboard = $row->dashboard;
					$mngr_code = $row->mngr_code;
					$display_name = $row->display_name; 
					$role_code = $row->role_code;	
					$photo = $row->image;	
					$mng_head = $row->mng_head;					
				}
				$request->session()->put('display_name',$display_name);
				$request->session()->put('role_code',$role_code);
				$request->session()->put('mngr_code',$mngr_code);
				$request->session()->put('mng_head',$mng_head);
				$request->session()->put('photo',$photo);
						
			}
			else{
				$message = "Invalid login id or password..";
				return view('Auth.login',compact(['message']));
				
			}
		}
		// managers
		else{
			$message = "Invalid login id or password..";
			return view('Auth.login',compact(['message']));
			
		}
		$status = 1;
		$menu=DB::table('role_resource')->select('resource_name','link_text','role_code','icons','id')
		->where(['role_code'=>$role_code,'status'=>$status])->orderBy('id')->get();
			$menu_name="";
			if(count($menu)>0){

				if($role_code == "RLMANAGEMENT" || $role_code == 'RLMANAGERS' || $role_code == 'RLEMP'){
				return view($dashboard,compact(['menu' ,'menu_name']));
				}
				else{
					return view($dashboard,compact(['menu' ,'menu_name','actives','inactives','leaves']));
				}
			}
			else{
				$message = "Failed to load resource..";
			return view('Auth.login',compact(['message']));
			}		
	}

	public function sendOTPvalidation(Request $request){
		$status=1;
        $searchKey=$request->input('username');
        $otp = mt_rand(100000,999999);
        $foundId="";
        $role="";
        
        $first = DB::table('employee')->select('email','role_code')->where('emp_code',$searchKey);
		$second = DB::table('admin')->select('email','role_code')->where('admin_code',$searchKey)->union($first);
        $mailLog = DB::table('hr')->select('email','role_code')->where('hr_code',$searchKey)->union($second)->get();
        
        if($mailLog){            
            foreach($mailLog as $ml){
                $foundId = $ml->email;
                $role = $ml->role_code;
            }
		}
		else{
			$error = "User not found";
            return view('Auth.forgetpass',compact(['error']));
         }

		$details = [				
				'otp' => $otp,
				'mail'=>$foundId
			];

		if($role == "RLEMP"){
			$updateotp = DB::table('employee')
			->where('emp_code',$searchKey)
			->update(['passreset'=>$otp]);
		}else if($role == "RLHR"){
			$updateotp = DB::table('hr')
			->where('hr_code',$searchKey)
			->update(['passreset'=>$otp]);
		}else if($role == "RLADMIN"){
			$updateotp = DB::table('admin')
			->where('admin_code',$searchKey)
			->update(['passreset'=>$otp]);	
		}

		if($updateotp){
				
			Mail::to($foundId)->send(new OTPmail($details));
			$otpmsg="Your OTP has been sent to registered email id";   
			$request->session()->put('foundId', $foundId);
			return view('Auth.validateOTP',compact(['otpmsg']));

		}		
        else{
			$error = "Error Try after sometime..";
            return view('Auth.forgetpass',compact(['error']));
         }

	}

	public function validateOTP(Request $request){
		$userId = $request->session()->get('foundId');
        $enteredOTP = $request->input('otp');

		$first = DB::table('hr')->select('email','passreset')->where(['email'=> $userId,'passreset'=>$enteredOTP]);
		$second = DB::table('admin')->select('email','passreset')->where(['email'=> $userId,'passreset'=>$enteredOTP])->union($first);
        $verify = DB::table('employee')->select('email','passreset')->where(['email'=> $userId,'passreset'=>$enteredOTP])->union($second)->get();

        if($verify){
            $otpverifymsg="Your OTP has been verified Successfully..";       

            return view('Auth.resetpass',compact(['otpverifymsg']));
        }
	}

	public function resetpass(Request $request){

		$userId = $request->session()->get('foundId');
		$password =base64_encode( $request->input('pass'));
		$resotp=0;
		$role="";

		$first = DB::table('employee')->select('role_code')->where('email',$userId);
        $second = DB::table('admin')->select('role_code')->where('email',$userId)->union($first);
		$final = DB::table('hr')->select('role_code')->where('email',$userId)->union($second)->get();

        if (count($final)>0) {
            foreach ($final AS $row) {
                $role = $row->role_code;
        
        	}
    	}

		if($role == 'RLEMP'){
			$passrs=DB::table('employee')
				->where('email',$userId)
				->update(['passreset'=>$resotp,'password'=>$password]);

		}
		else if($role=="RLHR"){
			$passrs=DB::table('hr')
				->where('email',$userId)
				->update(['passreset'=>$resotp,'password'=>$password]);

		}
		else if($role == 'RLADMIN'){
			$passrs=DB::table('admin')
				->where('email',$userId)
				->update(['passreset'=>$resotp,'password'=>$password]);

		}

		if($passrs){
			$resetMsg = "Password reset Sucessfully";
			$request->session()->forget('foundID');
			return view('Auth.login',compact(['resetMsg']));
		} 
		else{
		$resetMsg = "Error try again later";
		$request->session()->forget('foundID');
		return view('Auth.login',compact(['resetMsg']));
		}    
	}


	public function resetpasswithloginHR(Request $request){
		$oldpass = base64_encode($request->input('opass'));
		$newpass = base64_encode($request->input('npass'));

		$user = $request->session()->get('hr_code');
		$query = DB::table('hr')->where(['hr_code'=> $user , 'password' => $oldpass])->update(['password'=>$newpass]);
		if($query){
			$passmsg = "Password updated..!!!";
			return redirect()->back()->with('message',$passmsg);
		}
		else{
			$passmsg = "Try after sometimes.!!!";
			return redirect()->back()->with('message',$passmsg);			
		}

	}


    public function logout(Request $request){

		$roleToLO = $request->session()->get('role_code');
		if($roleToLO == 'RLEMP'    || $roleToLO == 'RLTEAMLEAD'){ 

			$valEmp =$request->session()->get('emp_code');
			$offStatus = 0;
			$result= DB::table('employee')->where('emp_code',$valEmp)->update(['log_status'=>$offStatus,'attend_status'=>$offStatus]);
			if($result){
				$request->session()->flush();
				$request->session()->regenerate();
				return redirect('/');
			}
		}
		else if($roleToLO == 'RLHR'){
			$valEmp =$request->session()->get('hr_code');
			$offStatus = 0;
			$result= DB::table('hr')->where('hr_code',$valEmp)->update(['log_status'=>$offStatus,'attnd_status'=>$offStatus]);
			if($result){
				$request->session()->flush();
				$request->session()->regenerate();
				return redirect('/');
			}
			
		}
			
			// $valEmp =$request->session()->get('admin_code');
			// $offStatus = 1;
			// $result= DB::table('admin')->where('admin_code',$valEmp)->update(['log_status'=>$offStatus]);
			// if($result){
			// 	$request->session()->flush();
			// 	$request->session()->regenerate();
			// 	return redirect('/');
			// }

            $request->session()->flush();
			$request->session()->regenerate();
    		return redirect('/');
       
    }

}
