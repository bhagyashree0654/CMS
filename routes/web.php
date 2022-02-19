<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeamLeadController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\ManagementTeamController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//*************************Authentication routes************************//

Route::get('/', [LoginController::class,'getLogin']);
Route::get('/login', [LoginController::class,'getLogin']);
Route::post('/loginValidate', [LoginController::class,'loginValidate']);
Route::get('/logout', [LoginController::class,'logout']);
Route::get('/forgetpass', function () {
    return view('Auth.forgetpass');
});
Route::post('/sendOTPvalidation', [LoginController::class,'sendOTPvalidation']);
Route::post('/validateOTP', [LoginController::class,'validateOTP']);
Route::post('/resetpass', [LoginController::class,'resetpass']);
Route::post('/resetpasswithlogin', [LoginController::class,'resetpasswithlogin']);

//**************************employee routes***********************//
Route::get('/eindex', [EmployeeController::class,'getEmpIndex']);
Route::get('/viewproj', [EmployeeController::class,'getEmpProject']);
Route::get('/viewprof', [EmployeeController::class,'getEmpProfile']);
Route::get('/trackTime', [EmployeeController::class,'trackTime']);

Route::post('/checkAttendance', [EmployeeController::class,'checkAttendance']);
Route::post('/uncheckAttendance', [EmployeeController::class,'uncheckAttendance']);
Route::post('/empLeaveApplication', [EmployeeController::class,'empLeaveApplication']);

Route::get('/fetchEmployeeProfile', [EmployeeController::class,'fetchEmployeeProfile']);
Route::post('/requestLeave', [EmployeeController::class,'requestLeave']);
Route::post('/updateStatusToTeamLead', [EmployeeController::class,'updateStatusToTeamLead']);
Route::post('/updateEmployeeInfoManual', [EmployeeController::class,'updateEmployeeInfoManual']);
Route::get('/fetchEmployeeProjectSelect', [EmployeeController::class,'fetchEmployeeProjectSelect']);
Route::post('/resetpasswithlogin', [EmployeeController::class,'resetpasswithlogin']);
Route::get('/fetchProjectDataForEmployee', [EmployeeController::class,'fetchProjectDataForEmployee']);

//***************************admin routes*************************//
Route::get('/getIntern',[AdminController::class,'getIntern']);
Route::get('/getEmployeeDetails', [AdminController::class,'getEmployeeDetails']);
Route::get('/fetchCards',[AdminController::class,'fetchCards']);
// Route::get('/getAttendance',[AdminController::class,'getAttendance']);
Route::get('/getLeaveDetails',[AdminController::class,'getLeaveDetails']);
Route::get('/getPerformance',[AdminController::class,'getPerformance']);
Route::get('/adminDashboard',[AdminController::class,'adminDashboard']);
Route::get('/getProjectAdm',[AdminController::class,'getProjectAdm']);
Route::get('/fetchRoles',[AdminController::class,'fetchRoles']);
Route::get('/getClient',[AdminController::class,'getClient']);
                    //dashboard-manipulation//
Route::get('/fetchActiveEmployee',[AdminController::class,'fetchActiveEmployee']);
Route::get('/fetchInActiveEmployee',[AdminController::class,'fetchInActiveEmployee']);
Route::get('/fetchLeaveEmployee',[AdminController::class,'fetchLeaveEmployee']);
Route::get('/fetchHRStatus', [AdminController::class,'fetchHRStatus']);
Route::post('/removeHRStatus', [AdminController::class,'removeHRStatus']);
                            // employee manipulation //
Route::get('/getEmployeeCount',[AdminController::class,'getEmployeeCount']);                          
Route::get('/fetchEmployee', [AdminController::class,'fetchEmployee']);
Route::get('/fetchHR', [AdminController::class,'fetchHR']);
Route::post('/addEmployee', [AdminController::class,'addEmployee']);
Route::post('/editEmployee', [AdminController::class,'editEmployee']);
Route::post('/deleteEmployee', [AdminController::class,'deleteEmployee']);
                        //Internlist manage
Route::get('/fetchInternReviewList', [AdminController::class,'fetchInternReviewList']);
Route::post('/approveIntern', [AdminController::class,'approveIntern']);
Route::post('/rejectIntern', [AdminController::class,'rejectIntern']);
                        //leave manage
Route::get('/fetchLeaveRequestAdmin', [AdminController::class,'fetchLeaveRequestAdmin']);
Route::post('/approveLeaveRequestHR', [AdminController::class,'approveLeaveRequestHR']);
Route::post('/denyLeaveRequestHR', [AdminController::class,'denyLeaveRequestHR']);
Route::get('/fetchLeaveRequestAcceptedHR',[ AdminController::class,'fetchLeaveRequestAcceptedHR']);
Route::post('/confirmLeaveRequestHR',[ AdminController::class,'confirmLeaveRequestHR']);
                            // project manage
Route::get('/fetchProjectLanguage', [AdminController::class,'fetchProjectLanguage']);
Route::get('/fetchProjectByAdmin', [AdminController::class,'fetchProjectByAdmin']);
Route::post('/addProjectByAdmin', [AdminController::class,'addProjectByAdmin']);
Route::post('/editProjectByAdmin', [AdminController::class,'editProjectByAdmin']);
Route::post('/disableProject', [AdminController::class,'disableProject']);
Route::post('/generateDoc', [AdminController::class,'generateDoc']);
// client
Route::post('/generatepdfclient', [AdminController::class,'generatepdfclient']);
Route::post('/sendMailToClient', [AdminController::class,'sendMailToClient']);
// performance
Route::get('/fetchPerformance', [AdminController::class,'fetchPerformance']);
Route::get('/fetchPerformanceHR', [HRController::class,'fetchPerformanceHR']);
Route::post('/fetchGraphFortable', [GraphController::class,'fetchGraphFortable']);

                         
//************************hr-routes***********************//
Route::get('/gethrDashboard',[HRController::class,'gethrDashboard']);
Route::get('/gethrprofile',[HRController::class,'gethrprofile']);
Route::get('/getInterview',[HRController::class,'getInterview']);
Route::get('/getProjects',[HRController::class,'getProjects']);
Route::get('/getTimeTrack',[HRController::class,'getTimeTrack']);
Route::get('/manageLeave',[HRController::class,'manageLeave']);
Route::get('/getEmployeeDtl',[HRController::class,'getEmployeeDtl']);
Route::get('/getPerformanceChk',[HRController::class,'getPerformanceChk']);
Route::get('/getSalaryDetails',[HRController::class,'getSalaryDetails']);
                            //dashboard-manipulation//
// Route::get('/fetchHRActiveEmployee',[HRController::class,'fetchHRActiveEmployee']);
// Route::get('/fetchHRInActiveEmployee',[HRController::class,'fetchHRInActiveEmployee']);
// Route::get('/fetchHRLeaveEmployee',[HRController::class,'fetchHRLeaveEmployee']);
Route::post('/checkAttendanceHR', [HRController::class,'checkAttendanceHR']);
Route::post('/uncheckAttendanceHR',[HRController::class,'uncheckAttendanceHR']);
// Route::get('/fetchTeamLeadStatus', [HRController::class,'fetchTeamLeadStatus']);
// Route::post('/removeTeamLeadStatus', [HRController::class,'removeTeamLeadStatus']);
// Route::get('/fetchAllProjectsUnderHR', [HRController::class,'fetchAllProjectsUnderHR']);
// Route::post('/giveUpdatestoAdmin', [HRController::class,'giveUpdatestoAdmin']);
                            //employee,intern,freelancer details//fetchRolesHR
Route::get('/fetchRolesHR', [HRController::class,'fetchRolesHR']);                            
Route::get('/fetchEmployeeViewHR', [HRController::class,'fetchEmployeeViewHR']); 
Route::get('/fetchInternViewHR', [HRController::class,'fetchInternViewHR']);
Route::get('/fetchFreelancerViewHR', [HRController::class,'fetchFreelancerViewHR']);
Route::post('/addEmployeeViewHR', [HRController::class,'addEmployeeViewHR']);                          
Route::post('/editEmployeeViewHR', [HRController::class,'editEmployeeViewHR']);                          
Route::post('/deleteEmployeeViewHR', [HRController::class,'deleteEmployeeViewHR']);  
Route::post('/experienceCertificateOfEmployeeByHR', [HRController::class,'experienceCertificateOfEmployeeByHR']);  
Route::post('/clearanceCertificateOfEmployeeByHR', [HRController::class,'clearanceCertificateOfEmployeeByHR']);
Route::post('/fetchEmployeesByRolesHR', [HRController::class,'fetchEmployeesByRolesHR']);
Route::post('/sendOfferLetterViaMailByHR', [HRController::class,'sendOfferLetterViaMailByHR']);


// Salary
Route::get('/fetchSalaryByHR', [HRController::class,'fetchSalaryByHR']);
Route::post('/updateSalaryByHR', [HRController::class,'updateSalaryByHR']);
// Route::post('/addInternViewHR', [HRController::class,'addInternViewHR']); 
// Route::post('/editInternViewHR', [HRController::class,'editInternViewHR']); 
// Route::post('/deleteInternViewHR', [HRController::class,'deleteInternViewHR']); 
// Route::post('/experienceCertificateOfInternByHR', [HRController::class,'experienceCertificateOfInternByHR']); 
// Route::post('/clearanceCertificateOfInternByHR', [HRController::class,'clearanceCertificateOfInternByHR']);

// Route::post('/addFreelancerViewHR', [HRController::class,'addFreelancerViewHR']); 
// Route::post('/editFreelancerViewHR', [HRController::class,'editFreelancerViewHR']); 
// Route::post('/deleteFreelancerViewHR', [HRController::class,'deleteFreelancerViewHR']); 
// Route::post('/experienceCertificateOfFreelancerByHR', [HRController::class,'experienceCertificateOfFreelancerByHR']); 
// Route::post('/clearanceCertificateOfFreelancerByHR', [HRController::class,'clearanceCertificateOfFreelancerByHR']);           
                            //interview//
Route::post('/sendemail',[HRController::class,'sendemail']);
Route::post('/addCandidate',[HRController::class,'addCandidate']);
Route::get('/allCandidateList',[HRController::class,'allCandidateList']);
Route::get('/approvedCandidateList',[HRController::class,'approvedCandidateList']);
Route::post('/editCandidate',[HRController::class,'editCandidate']);
Route::post('/deleteCandidate', [HRController::class,'deleteCandidate']);
Route::post('/removeCandidate', [HRController::class,'removeCandidate']);
                            //profile update//                            
Route::get('/fetchHRProfile', [HRController::class,'fetchHRProfile']);
Route::post('/updateHRInfoManual',[HRController::class,'updateHRInfoManual']);
Route::post('/uploadHRDigSign',[HRController::class,'uploadHRDigSign']);
Route::post('/HRresetpasswithlogin', [HRController::class,'resetpasswithloginHR']);
                                //project tables//
Route::get('/fetchAllProjectHR', [HRController::class,'fetchAllProjectHR']);  
                                //leave management//
Route::get('/fetchLeaveRequest', [HRController::class,'fetchLeaveRequest']);
Route::post('/approveLeaveRequest',[HRController::class,'approveLeaveRequest']);
Route::post('/denyLeaveRequest', [HRController::class,'denyLeaveRequest']);  
Route::get('/fetchLeaveRequestAccepted', [HRController::class,'fetchLeaveRequestAccepted']);
Route::post('/confirmLeaveRequest',[HRController::class,'confirmLeaveRequest']);                  

//*********************************team-lead routes*******************************//
Route::get('/getProfile',[TeamLeadController::class,'getProfile']); 
Route::get('/getProject',[TeamLeadController::class,'getProject']);
Route::get('/getTeamStatus',[TeamLeadController::class,'getTeamStatus']);
Route::get('/getTLDashboard',[TeamLeadController::class,'getTLDashboard']);
Route::get('/timeTracker',[TeamLeadController::class,'timeTracker']);
                                //dashboard-manipulation//
Route::get('/fetchTeamActiveEmployee',[TeamLeadController::class,'fetchTeamActiveEmployee']);
Route::get('/fetchTeamInActiveEmployee',[TeamLeadController::class,'fetchTeamInActiveEmployee']);
Route::get('/fetchTeamLeaveEmployee',[TeamLeadController::class,'fetchTeamLeaveEmployee']);
Route::get('/fetchTeamLeadProjectSelect', [TeamLeadController::class,'fetchTeamLeadProjectSelect']);
Route::post('/updateStatusToHR', [TeamLeadController::class,'updateStatusToHR']);
                                            //project 
Route::get('/fetchProjectDataForTeamLead', [TeamLeadController::class,'fetchProjectDataForTeamLead']);
                                    // team-lead status fetch and remove
Route::get('/fetchProjectStatusUpdatesTeamLead', [TeamLeadController::class,'fetchProjectStatusUpdatesTeamLead']);
Route::post('/removeEmployeeStatus', [TeamLeadController::class,'removeEmployeeStatus']);
//***************************management team routes***********************//
Route::get('/manageManagers',[ManagementTeamController::class,'manageManagers']);
Route::get('/fetchManagers',[ManagementTeamController::class,'fetchManagers']);
Route::get('/dfetchManagers',[ManagementTeamController::class,'dfetchManagers']);
Route::post('/addManager',[ManagementTeamController::class,'addManager']);
Route::post('/editManager',[ManagementTeamController::class,'editManager']);
Route::post('/deleteManager',[ManagementTeamController::class,'deleteManager']);
Route::post('/enableManager',[ManagementTeamController::class,'enableManager']);
//***************************managers routes***********************//
Route::get('/getLeaveDtlHRByManager',[ManagerController::class,'getLeaveDtlHRByManager']);
Route::get('/fetchLeaveofHR',[ManagerController::class,'fetchLeaveofHR']);
Route::get('/fetchedLeaveofHR',[ManagerController::class,'fetchedLeaveofHR']);
Route::post('/approveHRLeave',[ManagerController::class,'approveHRLeave']);
Route::post('/denyHRLeave',[ManagerController::class,'denyHRLeave']);
Route::post('/confirmHRLeave',[ManagerController::class,'confirmHRLeave']);
//***************************timer routes***********************//
Route::post('/addTaskClock', [TimerController::class,'addTaskClock']);
Route::get('/fetchTimer', [TimerController::class,'fetchTimer']);
   // tree structure
Route::get('/getAdminTreeView', [GeneralController::class,'getAdminTreeView']);
Route::get('/getManagementTreeView', [GeneralController::class,'getManagementTreeView']);
Route::get('/getManagerTreeView', [GeneralController::class,'getManagerTreeView']);
Route::get('/getHRTreeView', [GeneralController::class,'getHRTreeView']);
Route::get('/getEmployeeTreeView', [GeneralController::class,'getEmployeeTreeView']);

//***************************graph routes***********************//
Route::get('/projectGraphFetch', [GraphController::class,'projectGraphFetch']);