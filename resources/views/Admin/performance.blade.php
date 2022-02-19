@extends('layout')

@section('title','Admin Dashboard')

@section('content')
{{-- main content --}}
<section>
  <div class="container-fluid">
    <div class="row">
      {{-- <div class="col-lg-12">
        <div class="bar-chart block chart">
          <div class="title"><strong>Weekly Project Report</strong></div>
          <div class="bar-chart chart">
            <canvas id="barChartCustom3" height="120"></canvas>
          </div>
        </div>
      </div> --}}

      <div class="col-lg-7" display='flex'>
        <div class="block margin-bottom-sm">
          <div class="title">
          </div>
          <div class="table-responsive">
            <table class="table table-striped" id="emp-performance-tbl">
              <thead>
                <tr>
                  <th>Sl no</th>
                  <th>Username</th>
                  <th>Employee Name</th>
                  <th>Total Time</th>
                  <th>View Report</th>
                </tr>
              </thead>
              <tbody id="emp-performance-tbl-tbody">
                <?php $slno = 1; ?>
                {{-- @foreach($employees as $employee)
                  <tr>
                    <td>{{$slno++}}</td>
                    <td>{{$employee->emp_name}}</td>
                    <td>{{$employee->total_time}}</td>
                    <td><button type="button" class="btn btn-success view-graph" id="vg-{{$employee->emp_code}}"><i class = 'fa fa-bar-chart'></i></button></td>
                  </tr>
                @endforeach --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="bar-chart chart block">
          <div class="title"><strong id="dynamic_empname">Employee Performance Chart</strong></div>
          <div class="bar-chart chart margin-bottom-sm">
            <canvas id="emp-performance"></canvas>
            <div class="alert alert-warning" role="alert" id="myalert">
              Data not available
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- .main content --}}
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script>
  // create table of performance

$(document).ready(function() {
  $('#myalert').hide();
    var employeedtls = [];
    $.ajax({
      type: "get",
      url: "fetchPerformance",
      success: function (response) {
        var timertbl = {
                "emp_code": "",
                "emp_name": "",
                "total_time": []
            };  
            var totaltimes = {
              "totaltimes" : ""
            }        
            if (response.dbStatus == "SUCCESS") {
                $.each(response.aaData, function (i, data) {
                    if (timertbl.emp_code.includes(data.emp_code)) {
                        // alert("Duplicate employee");
                        totaltimes = {
                            "totaltimes": data.total_time
                        }
                        timertbl.total_time.push(totaltimes);
                    }
                    else {
                        timertbl = {
                            "emp_code": data.emp_code,
                            "emp_name": data.emp_name,
                            "total_time": [{
                                "totaltimes": data.total_time
                            }],
                        }
                        employeedtls.push(timertbl);
                    }
                });
                var tableContent = createTable(employeedtls);           
                //    separate-emps-table
                $("#emp-performance-tbl-tbody").html(tableContent);
                $('#emp-performance-tbl').DataTable();
            }
      },
      error: function (error) {
        console.log(error);
      }
    });
  // chart view
  $("#emp-performance-tbl tbody").on("click", ".view-graph", function(e){
    document.getElementsByClassName('chart').innerHTML = "";
       tr= e.target.parentNode.parentNode;
       var code = tr.getElementsByTagName('td')[1].innerHTML;
       $.ajax({
         type: "post",
         url: "fetchGraphFortable",
         data: {
            code: code
          },
         success: function (response) {
          //  console.log(response);
          //  alert(response.dbStatus);
            if (response.dbStatus == "SUCCESS") {
              $('#myalert').hide();
              var project=[];
              var totaltime=[];
              var finaltime=[];
              // loop 
              $.each(response.aaData, function (i, data) {

                if(project.includes(data.proj_code)){
                    var time = totaltime[project.indexOf(data.proj_code)];
                    var finaltime = addTimes(time,data.total_time);
                    totaltime[project.indexOf(data.proj_code)]=finaltime;
                  }
                  else{
                    project.push(data.proj_code);
                    totaltime.push(data.total_time);
                  }               
                });
                $.each(totaltime,function(i,time){
                  var hour=0;
                  var min = time.split(':')[1];
                  finaltime.push(parseInt(time.slice(0,2))+"."+parseInt(min));

                });
               // loop
               createChart(project,finaltime);
            } 
            else if(response.dbStatus == "FAILURE"){
              $('#myalert').show();
              project=[];
              totaltime=[];
              createChart(project,finaltime);
            }     
         },
          error: function (error) {
            console.log(error);
          }
       });
  });
    // create a table
    var tblTimerDtlsEmps = '';
    var total = "00:00:00";
    var temp = "00:00:00";    
    function createTable(lists) {
        slno = 1;
        tblTimerDtlsEmps = '';
        lists.forEach(function (emps) {
          var finaltimes = "00:00:00";
          tblTimerDtlsEmps+= `<tr>                
                            <td>${slno}</td>
                            <td>${emps.emp_code}</td>
                            <td>${emps.emp_name}</td>`;
          emps.total_time.forEach(function (times) {
            temp=times.totaltimes;
            totalfinal = addTimes(finaltimes,temp);   
            finaltimes=totalfinal;   
          });
          tblTimerDtlsEmps +=`<td>${finaltimes}</td>`;

          tblTimerDtlsEmps +=
              `<td><button type="button" class="btn btn-success view-graph fa fa-bar-chart" id="vg-"+${emps.emp_code}></button></td>`;
          tblTimerDtlsEmps += `</tr>`;
          slno++;
        });

        // alert(tblTimerDtlsEmps);
        return tblTimerDtlsEmps;
    }

    function addTimes(startTime, endTime) {
    var times = [ 0, 0, 0 ]
    var max = times.length
  
    var a = (startTime || '').split(':')
    var b = (endTime || '').split(':')
  
    // normalize time values
    for (var i = 0; i < max; i++) {
      a[i] = isNaN(parseInt(a[i])) ? 0 : parseInt(a[i])
      b[i] = isNaN(parseInt(b[i])) ? 0 : parseInt(b[i])
    }
    // store time values
    for (var i = 0; i < max; i++) {
      times[i] = a[i] + b[i]
    }
    var hours = times[0]
    var minutes = times[1]
    var seconds = times[2]
    if (seconds >= 60) {
      var m = (seconds / 60) << 0
      minutes += m
      seconds -= 60 * m
    }
    if (minutes >= 60) {
      var h = (minutes / 60) | 0
      hours += h
      minutes -= 60 * h
    }
    return ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2)
  }
  var ctx2 = document.getElementById('emp-performance'); // node
  var ctx2= document.getElementById('emp-performance').getContext('2d'); // 2d context
  var barChartExample="";
  function createChart(project,finaltime){

    if (barChartExample) {
      barChartExample.destroy()
    }
    // colors
    Chart.defaults.global.legend.display = false;
    var color = ['#00a65a', '#f39c12', '#f56954', '#00c0ef', '#3c8dbc', '#d2d6de','#00a65a', '#f39c12', '#f56954', '#00c0ef', '#3c8dbc', '#d2d6de','#00a65a', '#f39c12', '#f56954', '#00c0ef', '#3c8dbc', '#d2d6de'];
     // chart data
     var chart_data = {
        labels: project,
        datasets: [
          {
          label: project,
          backgroundColor: color,
          color:'#fff',
          data: finaltime
          }
        ]
      };
      // chart options
      var chart_options = {
        // responsive:true,
          // maintainAspectRatio: false,
          scales:{
            xAxes: [ {
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Project'
              },
              ticks: {
                major: {
                  fontStyle: 'bold',
                  fontColor: '#FF0000'
                }
              }
            } ],
            yAxes:[{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Time (in hours)'
              },
              ticks:{
                min:0
              }
            }]
          }
      };
      // chart rendering
      var ctx2 = document.getElementById('emp-performance'); // node
      var ctx2= document.getElementById('emp-performance').getContext('2d'); // 2d context
      barChartExample = new Chart(ctx2, {
          type: 'bar',
          data: chart_data,
          options: chart_options
      });
  }

});

</script>
{{-- <script src="resources/views/js/charts.js"></script> --}}

@endpush