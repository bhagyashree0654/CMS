@extends('layout')

@section('title','Employee Details')
<style>
  .container {
  margin: 0 auto;
  width: 800px;
}

#form-container {
  height: auto;
  margin-top: 20px;
  margin-bottom: 20px;
  background-color: #fff;
  padding-top: 20px;
  padding-bottom: 20px;
}

#form-container .wp-editor-container textarea.wp-editor-area {
  resize: none;
}
ul.tabs {
  margin: 0px;
  padding: 0px;
  list-style: none;
}

ul.tabs li {
  background: none;
  color: #222;
  display: inline-block;
  padding: 10px 15px;
  cursor: pointer;
}

ul.tabs li.current {
  background: #ededed;
  color: #222;
}

.tab-content {
  display: none;
  background: #ededed;
  padding: 15px;
}

.tab-content.current {
  display: inherit;
}

#stocklabel {
  font-weight: bold;
}

iframe {
  width: auto;
  height: 500px;
}
</style>

@section('content')

<!--Employee Details Table-->
<section class="no-padding-top">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 block">
        <div id="form-container" class="container">
          {{-- <form id="myFormEmployeeTabs" class="form-horizontal"> --}}
            <fieldset>
              <ul class="tabs">
                <li class="tab-link current" tab="tab-1">Add Employee/Intern/Freelancer</li>
                <li class="tab-link" tab="tab-2">Send Offer letter</li> 
                <li class="tab-link" tab="tab-3">Clearance Cert.</li>
                <li class="tab-link" tab="tab-4">Experience Cert.</li>
              </ul>
              {{-- emp form --}}
              <div id="tab-1" class="tab-content current">
                <form name="myFormEmployee" id="myFormEmployee" enctype="multipart/form-data" action="addEmployeeViewHR" method="POST">
                  <div class="row">
                    <div class="col-2">
                      <label>Choose</label>
                      <select name="user_acc" id="user_acc" class="form-control" required>
                        <option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Miss.">Miss.</option>
                      </select>
                    </div>
                    <div class="form-group col-4">
                      <label>Name</label>
                      <input type="text" placeholder="Enter Employee Name"  class="form-control" name="username" id="username" required pattern="[a-zA-Z\s]{2,100}" title="Please enter full name"/>
                      <input type="hidden" class="form-control tooltips" name="_token" id="_token" value="{{ csrf_token() }}"/>
                      <input type="hidden" class="form-control" id="hidId" name="hidId" aria-describedby="id">  
                      {{-- <input type="hidden" class="form-control" id="hidIdroleEmployee" name="hidIdroleEmployee" aria-describedby="id">                            --}}
                    </div>
                    <span id="usererr" class="text-danger"></span>
                    <div class="form-group col-3">
                      <label>Choose User Role</label>
                      <select class="form-control" id="roles" name="roles" required>
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label>User Id</label>
                      <input type="text" placeholder="User id" class="form-control" name="userid" id="userid" readonly/>
                      <span id="useriderr" class="text-danger"></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="Email Address" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter valid mail e.g: example@mail.com"/>
                        <span id="mailerr" class="text-danger"></span>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" placeholder="Phone Number" class="form-control" id="phone" name="phone" pattern="^[6-9]{1}[0-9]{9}$|^[6-9]{1}[0-9]{11}$" title="must be 10 or 12digit"/>
                        <span id="phonerr" class="text-danger"></span>
                      </div>                      
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>D.O.B</label>
                        <input type="date" placeholder="Enter dob" class="form-control" id="dob" name="dob"  required/>
                        <span id="doberr" class="text-danger"></span>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Photo</label>
                        <input type="file" placeholder="Upload Photo" class="form-control" id="photo" name="photo"/>
                      </div>                     
                    </div>
                  </div>
                 
                  <label>Choose Position</label>
                  <div class="form-group" id="positionChoosen">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="position" id="inlineRadio1" value="Frontend" required>
                      <label class="form-check-label" for="inlineRadio1">Frontend Developer</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="Backend">
                      <label class="form-check-label" for="inlineRadio2">Backend Developer</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="Full Stack">
                      <label class="form-check-label" for="inlineRadio3">Full Stack Developer</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="Software Tester">
                      <label class="form-check-label" for="inlineRadio3">Software Tester</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="Software Developer Student Intern">
                      <label class="form-check-label" for="inlineRadio3">Software Developer Student Intern</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="Software Tester Student Intern">
                      <label class="form-check-label" for="inlineRadio3">Software Tester Student Intern</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="Software Tester Freelancer">
                      <label class="form-check-label" for="inlineRadio3">Software Tester Freelancer</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="position" id="inlineRadio2" value="Software Developer Freelancer">
                      <label class="form-check-label" for="inlineRadio3">Software Developer Freelancer</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password"  placeholder="Password" class="form-control" id="password" name="password" value="1234567"/>
                        <span id="passerr" class="text-danger"></span> <small class="text-info">'1234567' is default password</small>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Joining Date</label>
                        <input type="date" placeholder="Enter Date of Joining" class="form-control" id="doj" name="doj" required/>
                      </div>
                    </div>     
                    <div class="col-12">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea rows="5" cols="10" placeholder="Enter Address" class="form-control" id="address" name="address"> </textarea>
                        <span id="adderr" class="text-danger"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-12" for="salary Structure">Salary Structure</label> <br>
                    {{-- base --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Base Salary" class="form-control" id="base_salary" name="base_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Base Salary</small>
                      </div>
                    </div>

                    {{-- HRA --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="HRA" class="form-control" id="hra_salary" name="hra_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>HRA</small>                       
                      </div>
                    </div>
                    {{-- bills --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Bills" class="form-control" id="bills_salary" name="bills_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Phone and Internet Bills</small>                       
                      </div>
                    </div>
                    {{-- class --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Class referal" class="form-control" id="class_salary" name="class_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Class Allowances</small>                       
                      </div>
                    </div>
                    {{-- bomus ref --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Referral Bonus" class="form-control" id="ref_salary" name="ref_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Referral Bonus</small>                       
                      </div>
                    </div>
                    {{-- proj ref --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Project referral" class="form-control" id="proj_ref_salary" name="proj_ref_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Project referral Bonus</small>                       
                      </div>
                    </div>
                    {{-- pf --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="PF" class="form-control" id="pf_salary" name="pf_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>PF</small>
                      </div>
                    </div>
                    {{-- epf --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="EPF" class="form-control" id="epf_salary" name="epf_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>EPF</small>                       
                      </div>
                    </div>
                    {{-- total --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Total" class="form-control" id="total_salary" name="total_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Total</small>                       
                      </div>
                    </div>
                    {{-- ctc --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Annual CTC" class="form-control" id="ctc_salary" name="ctc_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Annual CTC</small>                       
                      </div>
                    </div>
                    {{-- end --}}
                  </div>   
                  <div class="row">             
                    <div class="col-12">
                      <label for="choosepower">Choose Authority</label>
                      <div class="form-group" id="authorityChoosen">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="authority" id="inlineRadio11" value="HR" required>
                          <label class="form-check-label" for="inlineRadio11">HR</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="authority" id="inlineRadio12" value="ADMIN">
                          <label class="form-check-label" for="inlineRadio12">Admin</label>
                        </div>
                      </div>
                    </div>
                  </div>                        
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="addEmp">Submit</button>
                  </div>
                </form>
              </div>

              {{-- offer send form --}}
              <div id="tab-2" class="tab-content">
                <form name="sendOfferLetterViaMailByHR" id="sendOfferLetterViaMailByHR" enctype="multipart/form-data" action="sendOfferLetterViaMailByHR" method="POST">
                  <div class="row">
                    <div class="form-group col-4">
                      <input type="hidden" class="form-control tooltips" name="_token" id="_token" value="{{ csrf_token() }}"/>
                      <label>Choose User Role</label>
                      <select class="form-control" id="roles1" name="roles" required>
                      </select>
                    </div>
                    <div class="form-group col-4">
                      <label>Employee Choose</label>
                      <select class="form-control" id="emps" name="emps" required>
                        <option value=''>--SELECT--</option>
                      </select>
                    </div>
                    <div class="form-group col-4">
                      <div class="form-group">
                          <label>Offer Letter Pdf</label>
                          <input type="file" placeholder="Upload Photo" class="form-control" id="letter" name="letter" required/>
                        </div>  
                    </div>
                  </div>
                                    
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="addEmp">Submit</button>
                  </div>
                  <p class="text-success"> @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }} 
                    </div>
                @endif</p>

                </form>
              </div>
              {{-- fl form --}}
              <div id="tab-3" class="tab-content">
               form here
              </div>
              {{-- fulltime offer form --}}
              <div id="tab-4" class="tab-content">
                form here
              </div>
             
            </fieldset>
          {{-- </form> --}}
        </div>
        <!-- container -->
        
{{-- end --}}
      </div>
      <div class="col-lg-12">
        <div class="block margin-bottom-sm">
          <div class="title"><strong>Employee Details</strong></div>
          <div class="table-responsive"> 
            <table class="table table-striped" id="hr-emp-table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Photo</th>
                  <th>Emp. ID</th>
                  <th>Employee Name</th>
                  <th>Mobile No.</th>
                  <th>Email ID</th>
                  <th>Joining Date</th>
                  <th>Position</th>
                  <th>Edit</th>
                  <th>Delete</th>                
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
      {{-- Intern --}}
      <div class="col-lg-12">
        <div class="block margin-bottom-sm">
          <div class="title"><strong>Intern Details</strong></div>
          <div class="table-responsive"> 
            <table class="table table-striped" id="intern-hr-table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Photo</th>
                  <th>Emp. ID</th>
                  <th>Employee Name</th>
                  <th>Mobile No.</th>
                  <th>Email ID</th>
                  <th>Joining Date</th>
                  <th>Position</th>
                  <th>Edit</th>
                  <th>Delete</th>                
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
      {{-- freelancer --}}
      <div class="col-lg-12">
        <div class="block margin-bottom-sm">
          <div class="title"><strong>Freelancer Details</strong></div>
          <div class="table-responsive"> 
            <table class="table table-striped" id="freelancer-emp-table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Photo</th>
                  <th>Emp. ID</th>
                  <th>Employee Name</th>
                  <th>Mobile No.</th>
                  <th>Email ID</th>
                  <th>Joining Date</th>
                  <th>Position</th>
                  <th>Edit</th>
                  <th>Delete</th>                
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

        </section>
        <!--End Employee Details Table-->
@endsection

@push('scripts')
<script>
  $(document).ready(function(){
  //when a tab is clicked
	$('ul.tabs li').click(function(){
    //grab the id of the tab
		var id = $(this).attr('tab');
    //change current tab
		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');
    //
		$(this).addClass('current');
		$("#" + id).addClass('current');
	})

})
</script>
<script src="resources\views\js\hr.js"></script>
@endpush