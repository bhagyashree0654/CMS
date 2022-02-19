@extends('layout')

@section('title','Employee Dashboard')

@section('content')


<section class="mb-2 text-right">
  <div>
    <label>Mark tick for attendance </label>
    <input type="checkbox" name="attndchk" id="attndchk" disabled>
  </div>
</section>

<section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">
          <div class="stats-with-chart-2 block">
            <div class="title"><strong class="d-block">Working hour</strong><span class="d-block"></span></div>
            <div class="piechart chart">
              <canvas id="workingHourEmployee"></canvas>
              <div class="text"><strong class="d-block">35</strong><span class="d-block">Hours</span></div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="stats-with-chart-2 block">
            <div class="title"><strong class="d-block">Project Assigned</strong><span class="d-block"></span></div>
            <div class="piechart chart">
              <canvas id="projectAssignedEmployee"></canvas>
              <div class="text"><strong class="d-block">2</strong><span class="d-block">Projects</span></div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="stats-with-chart-2 block">
            <div class="title"><strong class="d-block">Upcomming Events</strong><span class="d-block"></span></div>
            <div class="piechart chart">
              <canvas id="eventsEmployee"></canvas>
              <div class="text"><strong class="d-block">5</strong><span class="d-block">Events</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <div class="block">
            <div class="title"><strong class="d-block">Update Workstatus[ {{  date('Y-m-d') }} ] </strong></div>
            <span>{{$statmessage ?? ""}}</span>
            <div class="block-body">
              <form id="updateStatus" action="updateStatusToTeamLead" method="POST">
                @csrf
                <div class="form-group">
                  <label class="form-control-label">Select Project</label>
                    <select name="project" id="employee-project-select" class="form-control mb-3 mb-3">
                    </select>
                  </div>
                <div class="form-group">
                  <label class="form-control-label">Status</label>
                    <textarea id="updateStatus" name="upstatus" placeholder="Update today's status" class="form-control form-control-success"></textarea><small class="form-text">Please update your work status for today.</small>
                </div>
                <span id="statusalert"></span>
                <div class="form-group">       
                    <input type="submit" value="Update" class="btn btn-primary text-right">
                </div>
              </form>
            </div>
          </div>
        </div>
        {{-- chart daily update --}}
        <div class="col-lg-6">
          <div class="bar-chart block chart">
            <div class="title"><strong>Daily performance</strong></div>
            <div class="bar-chart chart">
              <canvas id="barchart-employee"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="line-chart block chart">
            <div class="title"><strong>Monthly Performance</strong></div>
            <canvas id="linechart-employee"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>
 

@endsection

@push('scripts')

<script src="public/js/employee-graph.js"></script>
<script src="resources/views/js/employee.js"></script>

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
            url: "checkAttendance",
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
            url: "uncheckAttendance",
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
    document.getElementById('updateStatus').reset();

  
});


 function updateStatus(){       
        var status = document.getElementById('updateStatus').value;
        alert(status)
        if(status == ""){
          document.getElementById('statusalert').innerHTML = 'Please Fill the status..';
          return false;
        }
        if(status.length < 20 ){
         document.getElementById('statusalert').innerHTML = 'Please update status within minimum 20 words';
          return false;
        }
        return true;
        document.getElementById('statusup').value = "";     
      }
</script>

@endpush