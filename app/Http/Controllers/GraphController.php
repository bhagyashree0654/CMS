<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    public function projectGraphFetch(){

        $output = array("dbStatus"=>"" , "dbMessage"=>"" , 'aaData' => array());

        $result=DB::table('clock_timer')
        ->join('project', 'clock_timer.proj_code', '=', 'project.proj_code')
        ->select('clock_timer.total_time','clock_timer.update_date', 'project.proj_name','project.proj_code')
        ->get();

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
    public function fetchGraphFortable(Request $request){
        $output = array("dbStatus"=>"" , "dbMessage"=>"" , 'aaData' => array());
        $code  = $request->input('code');
        $result=DB::table('clock_timer')->select('total_time','proj_code')->where('emp_code',$code)->get();
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
}
