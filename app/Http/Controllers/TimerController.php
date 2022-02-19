<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimerController extends Controller
{
   public function fetchTimer(Request $request){

    // $output = array('aaData'=>array(),'dbStatus'=>'');
    $emp_code = $request->session()->get('emp_code');
    $status=1;

    $tasks = DB::select(DB::raw("SELECT ct.id,ct.task,ct.update_date,ct.total_time,ct.proj_code,p.proj_name,ct.start_time,ct.stop_time
    FROM clock_timer ct
    INNER JOIN project p On ct.proj_code = p.proj_code 
    WHERE ct.emp_code = :emp_code and ct.status = :status ORDER BY ct.id DESC"),array('emp_code'=>$emp_code,'status'=>$status));


    if (COUNT($tasks)>0) {
        foreach ($tasks AS $row) {
            $output['aaData'][] = $row;
            $output['dbStatus'] = 'SUCCESS';
        }
    } else {
        $output['dbStatus'] = 'FAILURE';
    }
    return response()->json($output);

   }
   
    public function addTaskClock(Request $request)
    {
        print_r($request->all());
        $output=array("dbMessage" => "", "dbStatus" => "");
        $role_code = $request->session()->get('role_code');
        $emp_code = $request->session()->get('emp_code');
        $task_id = $request->input('task');
        $project_id = $request->input('project');
        $start_time = $request->input('start');
        $end_time = $request->input('stop');
        $total = $request->input('total');

        $query = DB::table('clock_timer')->insert([
            'emp_code' => $emp_code,
            'task' => $task_id,
            'proj_code' => $project_id,
            'start_time' => $start_time,
            'stop_time' => $end_time,
            'total_time' => $total,
            'role_code' => $role_code,
            'created_by' => $emp_code,
            'update_date' => date('Y-m-d'),
            'status' => 1
        ]);

        if ($query) {
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
}
