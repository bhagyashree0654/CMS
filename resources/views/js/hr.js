$(document).ready(function(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// 2. Profile
 $.ajax({    
  cache: false,  
  url: 'fetchHRProfile',
  type:"get",
  dataType: 'json',
  success: function(response) {
    var myopt = "";
    if (response.dbStatus == "SUCCESS") {
      $.each(response.aaData,function(i, data) {
               myopt+=  `<img class="mt-2" style="border-radius:50%; display: block;
                  margin-left: auto;margin-right: auto;" id="profilepic" src="public/members/employees/${data.hr_photo}" class="card-img-top" height="15%" width="10%" alt="prof"> <div style="height: 15px; width:15px; border-radius:50%;background-color:green; color:green;border:rgb(10, 243, 10);margin-left: auto;margin-right: auto; margin-top:-8px; position: relative;"></div>
                  <div class="card-body">
                    <h5 class="card-title text-center">${data.hr_name}</h5>
                    <p class="card-text text-center">
                      <b>Employee Code:</b> <span>${data.hr_code}</span> <br>
                      <b>Address:</b> <span>${data.address}</span> <br>
                      <b>Date of Birth:</b> <span>${data.dob}</span> <br>
                    </p>                      
                  </div>`
      });
      $("#profile").html(myopt);
    }
  },
  error:function(response) {
    alert('Something went wrong....');
  }
});

$('#resetSuccess').hide();
$('#updateSuccess').hide();

  $('#pass-clk').click(function(){
    $('#eye-icon').toggleClass('fa-eye-slash');
    var input = $('#opass');
    if(input.attr('type') === "password"){
      input.attr('type','text');
    }else{
      input.attr('type','password');
    }
  });

  $('#cpass-clk').click(function(){
    $('#c-eye-icon').toggleClass('fa-eye-slash');
    var input1 = $('#npass');
    if(input1.attr('type') === "password"){
      input1.attr('type','text');
    }else{
      input1.attr('type','password');
    }
  });
// password reset validation
function passresetLogin(){
  var old = document.getElementById('opass').value;
  var newp = document.getElementById('npass').value;

  if(old == ""){
    document.getElementById('olderr').innerHTML = "Please fill the password";    
    return false;
}
if((old.length <= 5)||(old.length >30))
{
    document.getElementById('olderr').innerHTML = "Password must contain 6 to 30 character";    
    return false;
}
if(newp == ""){
    document.getElementById('newerr').innerHTML = "Please fill the new password";    
    return false;
}
if((newp.length <= 5)||(newp.length >30))
{
    document.getElementById('newerr').innerHTML = "New Password must contain 6 to 30 character";    
    return false;
}
if((newp.length <= 5)||(newp.length >30))
{
    document.getElementById('newerr').innerHTML = "New Password must contain 6 to 30 character";    
    return false;
}
 return true;
}
 // profile update
 $('#updateEmpInfo').on('submit',function(e){  
  e.preventDefault();
  var form = $('#updateEmpInfo')[0];
  var formData = new FormData(form);
  $("#updateEmpInfoBtn").attr("disabled", true);
  $.ajax({
    url: 'updateHRInfoManual',
    type: "post",
    processData: false,
    contentType: false,
    data: formData,
    success: function(response){
      var result = response;
      if (result.dbStatus == 'SUCCESS') {
        $('#resetSuccess').show();
        $('#resetSuccess').html(result.dbMessage);
        $('#upempmodal').modal('hide');
        $("#updateEmpInfoBtn").removeAttr('disabled');
        $('#upempmodal').on('hidden.bs.modal', function () {
          $('#updateEmpInfo')[0].reset();
        });
      }
        else if (result.dbStatus == 'FAILURE') {
          alert("Sorry... Error..!! "+result.dbMessage);
          $("#updateEmpInfoBtn").removeAttr('disabled');
        }
      }
    });
});
// profile password reset
$('#HRresetpasswithlogin').on('submit',function(e){  
e.preventDefault();
var form = $('#HRresetpasswithlogin')[0];
var formData = new FormData(form);
$("#passwordReset").attr("disabled", true);
$.ajax({
  url: 'HRresetpasswithlogin',
  type: "post",
  processData: false,
  contentType: false,
  data: formData,
  success: function(response){
    var result = response;
    if (result.dbStatus == 'SUCCESS') {
      $('#resetSuccess').show();
      $('#resetSuccess').html(result.dbMessage);
      $('#passmodal').modal('hide');
      $("#passwordReset").removeAttr('disabled');
      $('#passmodal').on('hidden.bs.modal', function () {
        $('#HRresetpasswithlogin')[0].reset();
      });
    }
      else if (result.dbStatus == 'FAILURE') {
        alert("Sorry... Error..!! "+result.dbMessage);
        $("#passwordReset").removeAttr('disabled');
      }
    }
  });
});
// end profile
// 4.performance
  $('#myalert').hide();
    var employeedtls = [];
    $.ajax({
      type: "get",
      url: "fetchPerformanceHR",
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
  // var ctx2 = document.getElementById('emp-performance'); // node
  // var ctx2= document.getElementById('emp-performance').getContext('2d'); // 2d context
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
// end of performance
//6. Leave management
  var leavetblnotcnf = $('#hr-leave-manage').DataTable({
    "bProcessing": false,
    "bServerSide": false,
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": false,
    "bInfo": true,
    "bAutoWidth": true,
    "sAjaxSource": "fetchLeaveRequest",
    "bDestroy":false,
    "aoColumns": [
      {"data" : "no","bSortable":"false"},
      {"data" : "applier_code","sClass":"alignCenter"},
      {"data" : "start_date","sClass":"alignCenter"},
      {"data" : "end_date","sClass":"alignCenter"},
      {"data" : "reason","sClass":"alignCenter"},       
      {"sName" : "action",
        "sWidth":"20%",
        "data"  : null,
        "sClass":"alignCenter",
        "defaultContent": "<button id='btnApprove' action ='btnApprove' class='btn btn-info'><i class='icon icon-layers'></i></button>"
      },{"sName" : "action",
      "sWidth":"20%",
      "data"  : null,
      "sClass":"alignCenter",
      "defaultContent": "<button id='btnDiscard' action ='btnDiscard' class='btn btn-danger '><i class ='icon icon-close'></i></button>"
    }
    ]
  });
    // approve leave
    $('#hr-leave-manage tbody').on( 'click', 'button[action=btnApprove]', function (event) {
    var data = leavetblnotcnf.row($(this).parents('tr')).data();
    console.log(data)
    var  token = $("#_token").val();
    swal({
      title: 'Approve this request?',
      text: "",
      type: 'success',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      animation: false
    }).then(function() {
    
      $.ajax({
        url:"approveLeaveRequest",
        type:"post",
        data:{_token: token,
          id : data.id,
          emp:data.applier_code,
          mng:data.managing_code,
          start:data.start_date,
          end:data.end_date,
          reason:data.reason
        },      
        success:function(response) {
          var result = response;
          if (result.dbStatus == 'SUCCESS') {
            swal({
                  title: "Good job!",
                  text: result.dbMessage,
                  type: "success",
                  button: "Aww yiss!",
                });
          $('#hr-leave-manage').DataTable().ajax.reload(null,false);
          $('#hr-leave-approved').DataTable().ajax.reload(null,false);
          } else if (result.dbStatus == 'FAILURE') {
            alert(result.dbMessage);
          }
        }
      });
    },function(dismiss) {
    
    }).done();
    });
    // deny leave
    $('#hr-leave-manage tbody').on( 'click', 'button[action=btnDiscard]', function (event) {
      var data = leavetblnotcnf.row($(this).parents('tr')).data();
      var  token = $("#_token").val();
      swal({
        title: 'Deny this request?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        animation: false
      }).then(function() {
      
        $.ajax({
          url:"denyLeaveRequest",
          type:"post",
          data:{_token: token,
            id : data.id,
            emp:data.applier_code,
            mng:data.managing_code,
            start:data.start_date,
            end:data.end_date,
            reason:data.reason
          },      
          success:function(response) {
            var result = response;
            if (result.dbStatus == 'SUCCESS') {
              swal({
                    title: "Good job!",
                    text: result.dbMessage,
                    type: "success",
                    button: "Aww yiss!",
                  });
            $('#hr-leave-manage').DataTable().ajax.reload(null,false);
           
            } else if (result.dbStatus == 'FAILURE') {
              alert("Failed to delete Record..");
            }
          }
        });
      },function(dismiss) {
      }).done();
      });
      var leavetblcnf = $('#hr-leave-approved').DataTable({
        "bProcessing": false,
        "bServerSide": false,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": true,
        "sAjaxSource": "fetchLeaveRequestAccepted",
        "bDestroy":false,
        "aoColumns": [
          {"data" : "no","bSortable":"false"},
          {"data" : "applier_code","sClass":"alignCenter"},
          {"data" : "start_date","sClass":"alignCenter"},
          {"data" : "end_date","sClass":"alignCenter"},
          {"data" : "reason","sClass":"alignCenter"},       
          {"sName" : "action",
            "sWidth":"20%",
            "data"  : null,
            "sClass":"alignCenter",
            "defaultContent": "<button id='btnConfirm' action ='btnConfirm' class='btn btn-success'><i class='fa fa-thumbs-up'></i></button>"
          }
        ]
      });
 // final leave confirmation update leave
    $('#hr-leave-approved tbody').on( 'click', 'button[action=btnConfirm]', function (event) {
      var data = leavetblcnf.row($(this).parents('tr')).data();
      var  token = $("#_token").val();
      swal({
        title: 'Final Confirmation..',
        text: "",
        type: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        animation: false
      }).then(function() {
      
        $.ajax({
          url:"confirmLeaveRequest",
          type:"post",
          data:{_token: token,
            id : data.id,
            code:data.applier_code
          },      
          success:function(response) {
            var result = response;
            if (result.dbStatus == 'SUCCESS') {
              swal({
                    title: "Good job!",
                    text: result.dbMessage,
                    type: "success",
                    button: "Aww yiss!",
                  });
            $('#hr-leave-approved').DataTable().ajax.reload(null,false);
            } else if (result.dbStatus == 'FAILURE') {
              alert("Failed to delete Record..");
            }
          }
        });
      },function(dismiss) {
      
      }).done();
      });

//3. Employee manipulation
// $('#myFormEmployee')[0].reset();
   var emptbl = $('#hr-emp-table').DataTable({
    "bProcessing": false,
    "bServerSide": false,
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": false,
    "bInfo": true,
    "bAutoWidth": true,
    "sAjaxSource": "fetchEmployeeViewHR",
    "bDestroy":false,
    "aoColumns": [
      {"data" : "no","bSortable":"false"},
      {"data": "emp_photo",
      "render": function (data) {
        if(data == null)
          return '<img src="https://image.shutterstock.com/image-vector/businessman-icon-260nw-564112600.jpg" width="55px" />';
        else
          return '<img src="public/members/employees/' + data + '" width="55px" />';
      },
      "sClass":"alignCenter"},
      {"data" : "emp_code","sClass":"alignCenter"},
      {"data" : "emp_name","bSortable":"false"},     
      {"data" : "phone","sClass":"alignCenter"},   
      {"data" : "email","bSortable":"false"},
      {"data" : "joining_date","bSortable":"false"},
      {"data" : "developer","bSortable":"false"},
      {"sName" : "action",
        "sWidth":"20%",
        "data"  : null,
        "sClass":"alignCenter",
        "defaultContent": "<button id='btnEditEmpHR' action ='btnEditEmpHR' class='btn btn-info'>Edit</button>"
      },{"sName" : "action",
      "sWidth":"20%",
      "data"  : null,
      "sClass":"alignCenter",
      "defaultContent": "<button id='btnDeleteEmpHR' action ='btnDeleteEmpHR' class='btn btn-danger'>Delete</button>"
    }
    ]
  });
  var interntbl = $('#intern-hr-table').DataTable({
    "bProcessing": false,
    "bServerSide": false,
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": false,
    "bInfo": true,
    "bAutoWidth": true,
    "sAjaxSource": "fetchInternViewHR",
    "bDestroy":false,
    "aoColumns": [
      {"data" : "no","bSortable":"false"},
      {"data": "emp_photo",
      "render": function (data) {
        if(data == null)
          return '<img src="https://image.shutterstock.com/image-vector/businessman-icon-260nw-564112600.jpg" width="55px" />';
        else
          return '<img src="public/members/employees/' + data + '" width="55px" />';
      },
      "sClass":"alignCenter"},
      {"data" : "emp_code","sClass":"alignCenter"},
      {"data" : "emp_name","bSortable":"false"},     
      {"data" : "phone","sClass":"alignCenter"},   
      {"data" : "email","bSortable":"false"},
      {"data" : "joining_date","bSortable":"false"},
      {"data" : "developer","bSortable":"false"},
      {"sName" : "action",
        "sWidth":"20%",
        "data"  : null,
        "sClass":"alignCenter",
        "defaultContent": "<button id='btnEditIntHR' action ='btnEditIntHR' class='btn btn-info'>Edit</button>"
      },{"sName" : "action",
      "sWidth":"20%",
      "data"  : null,
      "sClass":"alignCenter",
      "defaultContent": "<button id='btnDeleteIntHR' action ='btnDeleteIntHR' class='btn btn-danger'>Delete</button>"
    }
    ]
  });
  var freelancertbl = $('#freelancer-emp-table').DataTable({
    "bProcessing": false,
    "bServerSide": false,
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": false,
    "bInfo": true,
    "bAutoWidth": true,
    "sAjaxSource": "fetchFreelancerViewHR",
    "bDestroy":false,
    "aoColumns": [
      {"data" : "no","bSortable":"false"},
      {"data": "emp_photo",
      "render": function (data) {
        if(data == null)
          return '<img src="https://image.shutterstock.com/image-vector/businessman-icon-260nw-564112600.jpg" width="55px" />';
        else
          return '<img src="public/members/employees/' + data + '" width="55px" />';
      },
      "sClass":"alignCenter"},
      {"data" : "emp_code","sClass":"alignCenter"},
      {"data" : "emp_name","bSortable":"false"},     
      {"data" : "phone","sClass":"alignCenter"},   
      {"data" : "email","bSortable":"false"},
      {"data" : "joining_date","bSortable":"false"},
      {"data" : "developer","bSortable":"false"},
      {"sName" : "action",
        "sWidth":"20%",
        "data"  : null,
        "sClass":"alignCenter",
        "defaultContent": "<button id='btnEditFreelancerHR' action ='btnEditFreelancerHR' class='btn btn-info'>Edit</button>"
      },{"sName" : "action",
      "sWidth":"20%",
      "data"  : null,
      "sClass":"alignCenter",
      "defaultContent": "<button id='btnDeleteFreelancerHR' action ='btnDeleteFreelancerHR' class='btn btn-danger'>Delete</button>"
    }
    ]
  });
  $.ajax({
    url: 'fetchRolesHR',
    type:"get",
    dataType: 'json',
    success: function(response) {
      var options = "<option value=''>--SELECT--</option>";
      if (response.dbStatus == "SUCCESS") {
        $.each(response.aaData,function(i, data) {
          
          if(data.role_name == 'Super Admin'){
            options += "<option disabled value= '"+data.role_code+"'>"+data.role_name+"</option>";
          }
          else{
            options += "<option value= '"+data.role_code+"'>"+data.role_name+"</option>";
          }
        });
        $("#roles").html(options);
        $("#roles1").html(options);
                
      }
    },
    error:function(response) {
      alert('Something went wrong....');
    }
  });
  // change on role event
  $("#roles1").change(function(){
    var role = $("#roles1").val();
    alert(role);
    $.ajax({
      url: 'fetchEmployeesByRolesHR',
      type:"post",
      data: {role:role},
      success: function(response) {
        var options = "<option value=''>--SELECT--</option>";
        if (response.dbStatus == "SUCCESS") {
          $.each(response.aaData,function(i, data) {
              options += "<option value= '"+data.emp_code+"'>"+data.emp_name+"</option>";
          });
          $("#emps").html(options);
        }
        else if (response.dbStatus == "FAILURE") {
          $.each(response.aaData,function(i, data) {
              options += "";
          });
          $("#emps").html(options);
        }
      },
      error:function(response) {
        alert('Something went wrong....');
      }
    });
  });
  //add user id    
  $('#username').on('change',function(){
    var total = "";
    var uname = $(this).val();
    $.ajax({
      url:"getEmployeeCount",
      type:"get",    
      success:function(response) {
        var result = response;
        if (result.dbStatus == 'SUCCESS') {      
        total = result.aaData.totalEmployee;
        if(total < 10){
          ftotal = "0"+total;
        }
        else{
          ftotal = total;
        }
        var matches = uname.match(/\b(\w)/g); 
        var acronym = matches.join(''); 
        userid = acronym +"0000"+ftotal;
        $('#userid').val(userid);					 
        } else if (result.dbStatus == 'FAILURE') {
        alert("Fail..");
        }
      },
      error:function(response){
        console.log(response)
      }
      });
  });
  // calculation of amount
  var bs=0;
  var hra = 0;
  var bill = 0;
  var classes = 0;
  var referal = 0;
  var project = 0;
  var pf=0;
  var epf=0;
  var totalAmt = 0;
  var amount=0;

  $('#base_salary').on('change', function() {
  bs =parseInt($('#base_salary').val());
  totalCalc();
  });
  $('#hra_salary').on('change', function() {
  hra = parseInt($('#hra_salary').val());
  totalCalc();
  });
  $('#bills_salary').on('change', function() {
  bill =parseInt($('#bills_salary').val());
  totalCalc();
  });
  $('#class_salary').on('change', function() {
  classes =parseInt($('#class_salary').val());
  totalCalc();
  });
  $('#ref_salary').on('change', function() {
  referal =parseInt($('#ref_salary').val());
  totalCalc();
  });
  $('#proj_ref_salary').on('change', function() {
    project =parseInt($('#proj_ref_salary').val());
  totalCalc();
  });
  $('#pf_salary').on('change', function() {
    pf =parseInt($('#pf_salary').val());
  totalCalc();
  });
  $('#epf_salary').on('change', function() {
    epf =parseInt($('#epf_salary').val());
  totalCalc();
  });
  function totalCalc(){
    totalAmt = bs + hra + bill + referal + classes + project + pf + epf;
    $('#total_salary').val(totalAmt);  
    ctc();
  }
  ctc();
  function ctc(){
    if(totalAmt == 0){
      amount = 0;
    }
    else{
      amount = totalAmt * 12;
    }
    if(amount == 0 || amount == null || amount == "" || amount == undefined || amount == NaN)
    $('#ctc_salary').val(0);
    else
    $('#ctc_salary').val(amount);
    $('#total_salary').val(totalAmt);
  } 
//8. salary management
  var salaryTbl = $('#hr-salary-table').DataTable({
    "bProcessing": false,
    "bServerSide": false,
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": false,
    "bInfo": true,
    "bAutoWidth": true,
    "sAjaxSource": "fetchSalaryByHR",
    "bDestroy":false,
    "dataSrc":"",
    "aoColumns": [
      {"data" : "no","bSortable":"false"},
      {"data" : "emp_code","sClass":"alignCenter"},
      {"data" : "emp_name","sClass":"alignCenter"},
      {"data" : "base","bSortable":"false"},     
      {"data" : "hra","sClass":"alignCenter"},   
      {"data" : "internet_phone","bSortable":"false"},
      {"data" : "class_allowances","bSortable":"false"},
      {"data" : "referral_bonus","bSortable":"false"},
      {"data" : "project_referral","bSortable":"false"},
      {"data" : "pf","bSortable":"false"},
      {"data" : "epf","bSortable":"false"},
      {"data" : "total","bSortable":"false"},
      {"data" : "ctc","bSortable":"false"},
      {"sName" : "action",
        "sWidth":"20%",
        "data"  : null,
        "sClass":"alignCenter",
        "defaultContent": "<button id='btnEditSalary' action ='btnEditSalary' class='btn btn-info'>Edit</button>"
      }
    ]
  });
  // edit salary           
  $('#hr-salary-table tbody').on( 'click', 'button[action=btnEditSalary]', function (event) {
    var data = salaryTbl.row($(this).parents('tr')).data();
    $(event.target.parentNode.parentNode).addClass('success');
    $("#hidId").val(data.emp_code);
    $("#base_salary").val(data.base);
    $("#hra_salary").val(data.hra);
    $("#bills_salary").val(data.internet_phone);
    $("#class_salary").val(data.class_allowances);
    $("#ref_salary").val(data.referral_bonus);
    $("#proj_ref_salary").val(data.project_referral);
    $("#pf_salary").val(data.pf);
    $("#epf_salary").val(data.epf);
    $("#total_salary").val(data.total);
    $("#ctc_salary").val(data.ctc);
  });
  // update salary       
  $('#myFormSalaryEmployee').on('submit',function(e){ 
    var form = $('#myFormSalaryEmployee')[0];
    var formData = new FormData(form);
    $('#addSalary').attr('disabled','disabled');
    e.preventDefault();
    oper = "updateSalaryByHR";
    $.ajax({
        url: oper,
        type: "post",
        processData: false,
        contentType: false,
        data:formData,
        success: function(response){
            var result = response;
            if (result.dbStatus == 'SUCCESS') {
              swal({
                    text: result.dbMessage,
                    type: "success",
                    button: "Aww yiss!",
                  });
              $('#hr-salary-table').DataTable().ajax.reload(null,false);
              $("#hidId").val('');
              $('#myFormSalaryEmployee')[0].reset();
              $('#addSalary').removeAttr('disabled');
            }
            else if (result.dbStatus == 'FAILURE') {
                alert("Sorry... Error..!!");
                $('#hr-salary-table').DataTable().ajax.reload(null,false);
                $("#hidId").val('');
                $('#myFormSalaryEmployee')[0].reset();
                $('#addSalary').removeAttr('disabled');
            }
        }
    });
  });


  });