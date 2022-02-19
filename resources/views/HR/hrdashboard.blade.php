@extends('layout')

@section('title','Home')

@section('content')
<section class="mb-2 text-right">
  <div>
    <label>Mark tick for attendance </label>
    <input type="checkbox" name="attndchk" id="attndchk" disabled checked>
  </div>
</section>
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row row-eq-height">
      <div class="col-lg-4 equal-card">
        <div class="messages-block block">
          <div class="title"><strong>Active Employee</strong></div>
          <div class="messages" id="activeEmp">

            @if($actives->count() <= 0)
            <p class="alert alert-danger">No active employee..</p>
            @endif

            @foreach ($actives as $active)

            <a href="#?" class="message d-flex align-items-center">
              <div class="profile">

                @if($active->emp_photo == null)
                  <img src="public/assets/img/staff.jpg" alt="..." class="img-fluid" style="background-color: #fff;">
                @else
                <img src="public/members/employees/{{$active->emp_photo}}" alt="employee" class="img-fluid"/>
                @endif

                <div class="status online"></div>
              </div>
              <div class="content">
                <strong class="d-block">{{$active->emp_name}}</strong>
                <span class="d-block">{{$active->emp_code}}</span>
                {{-- <small class="date d-block">{{ date('H:i A', strtotime($active->log_time))}}</small> --}}
               
              </div>
            </a>

            @endforeach
            
          </div>
        </div>
      </div>
      <div class="col-lg-4 equal-card">
        <div class="messages-block block">
          <div class="title"><strong>Inactive Employee</strong></div>
          <div class="messages" id="inactiveEmp">
            @if($inactives->count() <= 0)
            <p class="alert alert-danger">No inactive employee..</p>
            @endif
            @foreach ($inactives as $iactive)

            <a href="#?" class="message d-flex align-items-center">
              <div class="profile">

                @if($iactive->emp_photo == null)
                  <img src="public/assets/img/staff.jpg" alt="..." class="img-fluid" style="background-color: #fff;">
                @else
                <img src="public/members/employees/{{$iactive->emp_photo}}" alt="employee" class="img-fluid"/>
                @endif

                <div class="status busy"></div>
              </div>
              <div class="content">
                <strong class="d-block">{{$iactive->emp_name}}</strong>
                <span class="d-block">{{$iactive->emp_code}}</span>
                {{-- <small class="date d-block">{{ date('H:i A', strtotime($iactive->log_time))}}</small> --}}
               
              </div>
            </a>

            @endforeach
          </div>
        </div>
      </div>
      <div class="col-lg-4 equal-card">
        <div class="messages-block block">
          <div class="title"><strong>Employee on Leave</strong></div>
          <div class="messages" id="leaveEmp"> 
            @if($leaves->count() <= 0)
            <p class="alert alert-danger">No leave employee..</p>
            @endif
            @foreach ($leaves as $leave)
            
            <a href="#?" class="message d-flex align-items-center">
              <div class="profile">

                @if($leave->emp_photo == null)
                  <img src="public/assets/img/staff.jpg" alt="..." class="img-fluid" style="background-color: #fff;">
                @else
                <img src="public/members/employees/{{$leave->emp_photo}}" alt="employee" class="img-fluid"/>
                @endif

                <div class="status online"></div>
              </div>
              <div class="content">
                <strong class="d-block">{{$leave->emp_name}}</strong>
                <span class="d-block">{{$leave->emp_code}}</span>
                {{-- <small class="date d-block">{{ date('H:i A', strtotime($leave->log_time))}}</small> --}}
               
              </div>
            </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>  

    <style>
      .messages-block::-webkit-scrollbar {
      width: 9px;
      height: 5px;
      }
      .messages-block::-webkit-scrollbar-track {
      background-color: #d6d4d4;
      }
      .messages-block::-webkit-scrollbar-thumb {
      background: #d6d4d4;
      border-radius: 5px;
      transition: 0.5s;
      }
      .messages-block::-webkit-scrollbar-thumb:hover {
      background: #686767;
      transition: 0.5s;
      }
      .messages-block {
       height: 400px;
       overflow-x: hidden;
       overflow-y: scroll;
      }
    </style>
    {{-- <div class="row row-eq-height">
      <div class="col-lg-12">
        <div class="block margin-bottom-sm">
          <div class="title"><strong>Updates of Projects By HR</strong></div>
          <div class="table-responsive">
            <table class="table table-striped table-hover" id="hr-updates-on-project">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Project Name</th>
                  <th>HR Name</th>
                  <th>Date</th>
                  <th>Updates</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody>

                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> --}}
  </div>
</section>
{{-- 
<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="block margin-bottom-sm">
          <div class="title"><strong>Updates of Projects By Teamleads</strong></div>
          <div class="table-responsive">
            <table class="table" id="teamlead-updates-on-project">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Project Name</th>
                  <th>Teamlead Name</th>
                  <th>Date</th>
                  <th>Updates</th>
                  <th>Remove</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="block margin-bottom-sm">
          <div class="title"><strong>Project Updation</strong></div>
          <div class="table-responsive">
            <table class="table" id="hr-updates-on-project-to-admin">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Project Code</th>
                  <th>Project Name</th>
                  <th>Updates</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--status update modal-->
  <div class="modal fade" id="updateStatus" tabindex="-1" role="dialog" aria-labelledby="lvmodalexmpl" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="lvmodalexmpl">Project Updates</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" id="status-update-to-admin">
            <div class="form-group">
              <input type="hidden" class="form-control" id="hidId" name="hidId" aria-describedby="id">
              <input type="hidden" class="form-control tooltips" name="_token" id="_token" value="{{ csrf_token() }}"/>
              <label for="project">Project Code</label>
              <input type="text" class="form-control" id="projectcode" name="project_code" aria-describedby="project" readonly>
            </div>  
            <div class="form-group">
              <label for="project">Project Name</label>
              <input type="text" class="form-control" id="projectname" name="projectname" aria-describedby="project" disabled>
            </div>  
            <div class="form-group">
              <label for="project">Update</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="status" id="statusTA" required minlength="15"></textarea>
            </div>              
            <button type="submit" class="btn btn-primary" id="update" name="update" value="update">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section> --}}


@endsection

@push('scripts')

<script src="resources\views\js\hr.js"></script>
<script>
$(document).ready(function(){
  // $('#attndchk').on('change', function() { 

    var emp = '{{ Session::get('emp_code');}}';
    if(emp){
      // alert('true');
      $("#attndchk").prop('checked', true); 
    }
    $('#attndchk').on('change',function() {
      var emp = '{{ Session::get('emp_code');}}';
      var  token = $("#_token").val();
      var checkbox = $('input[type="checkbox"]');
      if ($(checkbox).prop('checked')) {
        console.log("Was Checked");
        //ajax call to add attendance and mark it checked
        $.ajax({
          type: "post",
          url: "checkAttendanceHR",
          data:{_token: '{{csrf_token()}}',
            employee:emp,
          },
          success: function(response){
            var result = response;
            if(result.dbStatus == "SUCCESS"){
              alert(result.dbMessage);

            }else if (result.dbStatus == 'FAILURE') {
              alert(result.dbMessage);
            }
          },
          error: function(){
            // alert("Error");
          }

        });
        //.ajax call to add attendance and mark it checked


      } else {
        console.log("Was Not Checked");
        //ajax call to remove attendance and mark it unchecked
        $.ajax({
          type: "post",
          url: "uncheckAttendanceHR",
          data:{_token: '{{csrf_token()}}',
            employee:emp,
          },
          success: function(response){
            var result = response;
            if(result.dbStatus == "SUCCESS"){
              alert(result.dbMessage);
            }else if (result.dbStatus == 'FAILURE') {
              alert(result.dbMessage);
            }
          },
          error: function(){
            // alert("Error");
          }

        });
        //.ajax call to remove attendance and mark it unchecked
      }
  });




     
 

});



</script>

@endpush