$(document).ready(function(){

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
    //dashboard active-inactive-leave employees
      $.ajax({      
          url: 'fetchTeamActiveEmployee',
          type:"get",
          dataType: 'json',
          success: function(response) {
              var myopt = "";
              if (response.dbStatus == "SUCCESS") {
                  $.each(response.aaData,function(i, data) {
                      myopt +=     `<a href="#" class="message d-flex align-items-center">
                      <div class="profile">
                        <img
                          src="img/avatar-1.jpg"
                          alt=""
                          class="img-fluid"
                        />
                        <div class="status online"></div>
                      </div>
                      <div class="content">
                        <strong class="d-block">${data.emp_code}</strong
                        ><span class="d-block">${data.emp_name}</span><small class="date d-block">...</small>
                      </div>
                    </a>`;
                  });
                  $("#activeEmpTL").html(myopt);
              }
          },
          error:function(response) {
              alert('Something went wrong....');
          }
      });
      $.ajax({      
          url: 'fetchTeamInActiveEmployee',
          type:"get",
          dataType: 'json',
          success: function(response) {
              var myopt = "";
              if (response.dbStatus == "SUCCESS") {
                  $.each(response.aaData,function(i, data) {
                      myopt +=     `<a href="#" class="message d-flex align-items-center">
                      <div class="profile">
                        <img
                          src="img/avatar-1.jpg"
                          alt=""
                          class="img-fluid"
                        />
                        <div class="status away"></div>
                      </div>
                      <div class="content">
                        <strong class="d-block">${data.emp_code}</strong
                        ><span class="d-block">${data.emp_name}</span><small class="date d-block">...</small>
                      </div>
                    </a>`;
                  });
                  $("#inactiveEmpTL").html(myopt);
              }
          },
          error:function(response) {
              alert('Something went wrong....');
          }
      });
      $.ajax({      
          url: 'fetchTeamLeaveEmployee',
          type:"get",
          dataType: 'json',
          success: function(response) {
              var myopt = "";
              if (response.dbStatus == "SUCCESS") {
                  $.each(response.aaData,function(i, data) {
                      myopt +=`<a href="#" class="message d-flex align-items-center">
                      <div class="profile">
                        <img
                          src="img/avatar-1.jpg"
                          alt=""
                          class="img-fluid"
                        />
                        <div class="status busy"></div>
                      </div>
                      <div class="content">
                        <strong class="d-block">${data.emp_code}</strong
                        ><span class="d-block">${data.emp_name}</span><small class="date d-block">...</small>
                      </div>
                    </a>`;
                  });
                  $("#leaveEmpTL").html(myopt);
              }
          },
          error:function(response) {
              alert('Something went wrong....');
          }
      });
//dashboard select project
      $.ajax({
        url: 'fetchTeamLeadProjectSelect',
        type:"get",
        dataType: 'json',
        success: function(response) {
          var options = "<option value=''>--Select Project--</option>";
          if (response.dbStatus == "SUCCESS") {
            $.each(response.aaData,function(i, data) {
              options += "<option value= '"+data.proj_code+"'>"+data.proj_name+"</option>";
            });
            $("#teamlead-project-select").html(options);
          }
        },
        error:function(response) {
          alert('Something went wrong....');
        }
      });

      $.ajax({    
        cache: false,  
        url: 'fetchEmployeeProfile',
        type:"get",
        dataType: 'json',
        success: function(response) {
          var myopt = "";
          if (response.dbStatus == "SUCCESS") {
            $.each(response.aaData,function(i, data) {
                     myopt+=  `<img class="mt-2" style="border-radius:50%; display: block;
                        margin-left: auto;margin-right: auto;" id="profilepic" src="public/members/employees/${data.emp_photo}" class="card-img-top" height="15%" width="10%" alt="prof"> <div style="height: 15px; width:15px; border-radius:50%;background-color:green; color:green;border:rgb(10, 243, 10);margin-left: auto;margin-right: auto; margin-top:-8px; position: relative;"></div>
                        <div class="card-body">
                          <h5 class="card-title text-center">${data.emp_name}</h5>
                          <p class="card-text text-center">
                            <b>Employee Code:</b> <span>${data.emp_code}</span> <br>
                            <b>Salary:</b> <span>${data.salary}</span> <br>
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

      //project section table data fetch
      var table1 = $('#teamlead-view-project').DataTable({
        "bProcessing": false,
        "bServerSide": false,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": true,
        "sAjaxSource": "fetchProjectDataForTeamLead",
        "bDestroy":false,
        "aoColumns": [
          {"data" : "no","bSortable":"false"},
          {"data" : "proj_name","sClass":"alignCenter"},
          {"data" : "starting_date","bSortable":"false"},
          {"data" : "end_date","bSortable":"false"},
          {"data" : "remain","bSortable":"false"}
        ]
      });
       //project section table data fetch
       var table2 = $('#teamlead-view-project-updates').DataTable({
        "bProcessing": false,
        "bServerSide": false,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": true,
        "sAjaxSource": "fetchProjectStatusUpdatesTeamLead",
        "bDestroy":false,
        "aoColumns": [
          {"data" : "no","bSortable":"false"},
          {"data" : "emp_name","sClass":"alignCenter"},
          {"data" : "proj_name","bSortable":"false"},
          {"data" : "dates","bSortable":"false"},
          {"data" : "work_updates","bSortable":"false"},
          {"sName" : "action",
          "sWidth":"20%",
          "data"  : null,
          "sClass":"alignCenter",
          "defaultContent": "<button id='btnRemove' action ='btnRemove' class='btn btn-primary'><i class='icon icon-close'></i></button>"
        }
        ]
      });

      $('#teamlead-view-project-updates tbody').on( 'click', 'button[action=btnRemove]', function (event) {
        var data = table2.row($(this).parents('tr')).data();
        var oTable = $('#teamlead-view-project-updates').dataTable();
        $(oTable.fnSettings().aoData).each(function () {
          $(this.nTr).removeClass('success');
        });
        $(event.target.parentNode.parentNode.parentNode).addClass('success');
        var  token = $("#_token").val();
        swal({
          title: 'Are you sure to remove this entry?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes',
          animation: false
        }).then(function() {
        
          $.ajax({
            url:"removeEmployeeStatus",
            type:"post",
            data:{_token: token,
              id : data.id
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
              $('#teamlead-view-project-updates').DataTable().ajax.reload(null,false);
              } else if (result.dbStatus == 'FAILURE') {
                alert("Failed to delete Record..");
              }
            }
          });
        },function(dismiss) {
        
        }).done();
        });
  
  });
  