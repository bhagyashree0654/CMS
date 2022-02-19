
  //1. HR dashboard
  //dashboard active-inactive-leave employees
  // $.ajax({      
  //   url: 'fetchHRActiveEmployee',
  //   type:"get",
  //   dataType: 'json',
  //   success: function(response) {
  //       var myopt1 = "";
  //       if (response.dbStatus == "SUCCESS") {
  //           $.each(response.aaData,function(i, data) {
  //               myopt1 +=     `<a href="#" class="message d-flex align-items-center">
  //               <div class="profile">
  //                 <img
  //                   src="img/avatar-1.jpg"
  //                   alt=""
  //                   class="img-fluid"
  //                 />
  //                 <div class="status online"></div>
  //               </div>
  //               <div class="content">
  //                 <strong class="d-block">${data.emp_code}</strong
  //                 ><span class="d-block">${data.emp_name}</span><small class="date d-block"></small>
  //               </div>
  //             </a>`;
  //           });
  //           $("#activeEmp").html(myopt1);
  //       }
  //   },
  //   error:function(response) {
  //       alert('Something went wrong....');
  //   }
  // });
  // $.ajax({      
  //   url: 'fetchHRInActiveEmployee',
  //   type:"get",
  //   dataType: 'json',
  //   success: function(response) {
  //       var myopt2 = "";
  //       if (response.dbStatus == "SUCCESS") {
  //           $.each(response.aaData,function(i, data) {
  //               myopt2 +=     `<a href="#" class="message d-flex align-items-center">
  //               <div class="profile">
  //                 <img
  //                   src="img/avatar-1.jpg"
  //                   alt=""
  //                   class="img-fluid"
  //                 />
  //                 <div class="status away"></div>
  //               </div>
  //               <div class="content">
  //                 <strong class="d-block">${data.emp_code}</strong
  //                 ><span class="d-block">${data.emp_name}</span><small class="date d-block"></small>
  //               </div>
  //             </a>`;
  //           });
  //           $("#inactiveEmp").html(myopt2);
  //       }
  //   },
  //   error:function(response) {
  //       alert('Something went wrong....');
  //   }
  // });
  // $.ajax({      
  //   url: 'fetchHRLeaveEmployee',
  //   type:"get",
  //   dataType: 'json',
  //   success: function(response) {
  //       var myopt3 = "";
  //       if (response.dbStatus == "SUCCESS") {
  //           $.each(response.aaData,function(i, data) {
  //               myopt3 +=`<a href="#" class="message d-flex align-items-center">
  //               <div class="profile">
  //                 <img
  //                   src="img/avatar-1.jpg"
  //                   alt=""
  //                   class="img-fluid"
  //                 />
  //                 <div class="status busy"></div>
  //               </div>
  //               <div class="content">
  //                 <strong class="d-block">${data.emp_code}</strong
  //                 ><span class="d-block">${data.emp_name}</span><small class="date d-block"></small>
  //               </div>
  //             </a>`;
  //           });
  //           $("#leaveEmp").html(myopt3);
  //       }
  //   },
  //   error:function(response) {
  //       alert('Something went wrong....');
  //   }
  // });

  // team leads update status
  // var table8 = $('#teamlead-updates-on-project').DataTable({
  //   "bProcessing": false,
  //   "bServerSide": false,
  //   "bPaginate": true,
  //   "bLengthChange": true,
  //   "bFilter": true,
  //   "bSort": false,
  //   "bInfo": true,
  //   "bAutoWidth": true,
  //   "sAjaxSource": "fetchTeamLeadStatus",
  //   "bDestroy":false,
  //   "aoColumns": [
  //     {"data" : "no","bSortable":"false"},
  //     {"data" : "proj_name","sClass":"alignCenter"},
  //     {"data" : "emp_name","sClass":"alignCenter"},
  //     {"data" : "dates","sClass":"alignCenter"},
  //     {"data" : "work_updates","sClass":"alignCenter"},
  //     {"sName" : "action",
  //       "sWidth":"20%",
  //       "data"  : null,
  //       "sClass":"alignCenter",
  //       "defaultContent": "<button id='btnremove' action ='btnremove' class='btn btn-info'><i class='icon icon-close'></i></button>"
  //     }
  //   ]
  // });
  // $('#teamlead-updates-on-project tbody').on( 'click', 'button[action=btnremove]', function (event) {
  //   var data = table8.row($(this).parents('tr')).data();
  //   var oTable = $('#teamlead-updates-on-project').dataTable();
  //   $(oTable.fnSettings().aoData).each(function () {
  //     $(this.nTr).removeClass('success');
  //   });
  //   $(event.target.parentNode.parentNode.parentNode).addClass('success');
  //   var  token = $("#_token").val();
  //   swal({
  //     title: 'Are you sure to remove this entry?',
  //     text: "",
  //     type: 'warning',
  //     showCancelButton: true,
  //     confirmButtonColor: '#3085d6',
  //     cancelButtonColor: '#d33',
  //     confirmButtonText: 'Yes',
  //     animation: false
  //   }).then(function() {
    
  //     $.ajax({
  //       url:"removeTeamLeadStatus",
  //       type:"post",
  //       data:{_token: token,
  //         id : data.id
  //       },      
  //       success:function(response) {
  //         var result = response;
  //         if (result.dbStatus == 'SUCCESS') {
  //           swal({
  //                 title: "Good job!",
  //                 text: result.dbMessage,
  //                 type: "success",
  //                 button: "Aww yiss!",
  //               });
  //         $('#teamlead-updates-on-project').DataTable().ajax.reload(null,false);
  //         } else if (result.dbStatus == 'FAILURE') {
  //           alert("Failed to delete Record..");
  //         }
  //       }
  //     });
  //   },function(dismiss) {
    
  //   }).done();
  //   });

    // project update to admin by hr
    // var table9 = $('#hr-updates-on-project-to-admin').DataTable({
    //   "bProcessing": false,
    //   "bServerSide": false,
    //   "bPaginate": true,
    //   "bLengthChange": true,
    //   "bFilter": true,
    //   "bSort": false,
    //   "bInfo": true,
    //   "bAutoWidth": true,
    //   "sAjaxSource": "fetchAllProjectsUnderHR",
    //   "bDestroy":false,
    //   "aoColumns": [
    //     {"data" : "no","bSortable":"false"},
    //     {"data" : "project_code","sClass":"alignCenter"},
    //     {"data" : "proj_name","sClass":"alignCenter"},
    //     {"sName" : "action",
    //       "sWidth":"20%",
    //       "data"  : null,
    //       "sClass":"alignCenter",
    //       "defaultContent": "<button id='btnstatus' action ='btnstatus' class='btn btn-info'><i class='fa fa-edit'></i></button>"
    //     }
    //   ]
    // });
    
        
//     $('#hr-updates-on-project-to-admin').on( 'click', 'button[action=btnstatus]', function (event) {
//       var data = table9.row($(this).parents('tr')).data();
//       var oTable = $('#hr-updates-on-project-to-admin').dataTable();
//       $(oTable.fnSettings().aoData).each(function () {
//         $(this.nTr).removeClass('success');
//       });
//       $(event.target.parentNode.parentNode).addClass('success');
//       $("#hidId").val(data.id);
//       $("#projectcode").val(data.project_code);
//       $("#projectname").val(data.proj_name);
//       $("#updateStatus").modal('show');
//     });

    
//   $('#status-update-to-admin').on('submit',function(e){ 
//     var form = $('#status-update-to-admin')[0];
//     var formData = new FormData(form);
//     e.preventDefault();
//     var  hidId = $("#hidId").val();
//     var oper = "";

//     if (hidId == '' || hidId == null || hidId == undefined) {
//       oper = "giveUpdatestoAdmin";
//     }
//     $.ajax({
//         url: oper,
//         type: "post",
//         processData: false,
//         contentType: false,
//         data:formData,
//         success: function(response){
//             var result = response;
//             if (result.dbStatus == 'SUCCESS') {
//               swal({
//                     title: "Good job!",
//                     text: result.dbMessage,
//                     type: "success",
//                     button: "Aww yiss!",
//                   });
//               $('#hr-updates-on-project-to-admin').DataTable().ajax.reload(null,false);
//               $("#hidId").val('');
//               $('#status-update-to-admin')[0].reset();
//               $('#updateStatus').modal('hide');
//               $('#updateStatus').on('hidden.bs.modal', function () {
//                 $('#status-update-to-admin')[0].reset();
//               });
//            }
//             else if (result.dbStatus == 'FAILURE') {
//                 alert("Sorry... Error..!!");
//             }
//         }
//     });
// });


  

 
        // leave management
     //datatable for view employee details
    //  var table2 = $('#hr-project-view-table').DataTable({
    //   "bProcessing": false,
    //   "bServerSide": false,
    //   "bPaginate": true,
    //   "bLengthChange": true,
    //   "bFilter": true,
    //   "bSort": false,
    //   "bInfo": true,
    //   "bAutoWidth": true,
    //   "sAjaxSource": "fetchAllProjectHR",
    //   "bDestroy":false,
    //   "aoColumns": [
    //     {"data" : "no","bSortable":"false"},        
    //     {"data" : "emp_name","bSortable":"false"},     
    //     {"data" : "proj_name","sClass":"alignCenter"}, 
    //     {"data" : "starting_date","bSortable":"false"},
    //     {"data" : "end_date","bSortable":"false"},     
    //     {"data" : "remain","bSortable":"false"}
    //   ]
    // });

      
      // $('#roles').on('change', function() {	
      //   var role = $(this).val();	
      //   // alert(role)
      //   if(this.options[this.selectedIndex].text != 'Employee' || this.options[this.selectedIndex].text != 'Team Lead'){
      //       $('#positionChoosen').hide();
      //       $('#hiddenlabel').hide();
      //   }
      //   if(this.options[this.selectedIndex].text == 'Employee' || this.options[this.selectedIndex].text == 'Team Lead'){
      //     $('#positionChoosen').show();
      //     $('#hiddenlabel').show();
      
      //   }
      // });		
      //.end
	// edit
	// $('#hr-emp-table tbody').on( 'click', 'button[action=btnEditEmpHR]', function (event) {
	// 	var data = table1.row($(this).parents('tr')).data();
  //   console.log(data);
	// 	var oTable = $('#hr-emp-table').dataTable();
  //   $('#username').val(data.emp_name);
	// 	$("#userid").val(data.emp_code);
	// 	$("#roles").val(data.role_code);
	// 	$("#salary").val(data.salary);
	// 	$("#hidId").val(data.id);
	// 	$("#myModal").modal('show');
	// });
// Employee add and edit ajax
	// $('#myFormEmployee').on('submit',function(e){  
	// 	e.preventDefault();
	// 	var form = $('#myFormEmployee')[0];
	// 	var formData = new FormData(form);
	// 	console.log(formData);
	// 	var  hidId = $("#hidId").val();
	// 	$("#addEmp").attr("disabled", true);
	// 	var oper = "";
	// 	if (hidId == '' || hidId == null || hidId == undefined) {
	// 	oper = "addEmployeeViewHR";
	// 	} else {
	// 	oper = "editEmployeeViewHR";
	// 	}
	// 	$.ajax({
	// 		url: oper,
	// 		type: "post",
	// 		processData: false,
	// 		contentType: false,
	// 		data: formData,
	// 		dataType:'text',
	// 		success: function(response){
	// 			var result = response;
	// 			if (result.dbStatus == 'SUCCESS') {
	// 				swal({
	// 					title: "Good job!",
	// 					text: result.dbMessage,
	// 					type: "success",
	// 					button: "Aww yiss!",
	// 				});
	// 				$('#hr-emp-table').DataTable().ajax.reload(null,false);
	// 				$('#hr-intern-table').DataTable().ajax.reload(null,false);
	// 				$('#hr-fl-table').DataTable().ajax.reload(null,false);
	// 				$("#hidId").val('');
	// 				$("#addEmp").removeAttr('disabled');
	// 				$('#myFormEmployee')[0].reset();
	// 			}
	// 				else if (result.dbStatus == 'FAILURE') {
	// 					alert("Sorry... Error..!! "+result.dbMessage);
	// 					$("#addEmp").removeAttr('disabled');
	// 				}
	// 			}
	// 		});
	// });

	// $('#hr-emp-table tbody').on( 'click', 'button[action=btnDeleteEmpHR]', function (event) {
	// 	var data = table1.row($(this).parents('tr')).data();
	// 	var oTable = $('#hr-emp-table').dataTable();
	// 	$(oTable.fnSettings().aoData).each(function () {
	// 	  $(this.nTr).removeClass('success');
	// 	});
	// 	$(event.target.parentNode.parentNode.parentNode).addClass('success');
	// 	var  token = $("#_token").val();
	// 	swal({
	// 	  title: 'Are you sure to remove this entry?',
	// 	  text: "",
	// 	  type: 'warning',
	// 	  showCancelButton: true,
	// 	  confirmButtonColor: '#3085d6',
	// 	  cancelButtonColor: '#d33',
	// 	  confirmButtonText: 'Yes',
	// 	  animation: false
	// 	}).then(function() {
		
	// 	  $.ajax({
	// 		url:"deleteEmployee",
	// 		type:"post",
	// 		data:{_token: token,
	// 		  id : data.id
	// 		},      
	// 		success:function(response) {
	// 		  var result = response;
	// 		  if (result.dbStatus == 'SUCCESS') {
	// 			swal({
	// 				  title: "Good job!",
	// 				  text: result.dbMessage,
	// 				  type: "success",
	// 				  button: "Aww yiss!",
	// 				});
	// 		  $('#hr-emp-table').DataTable().ajax.reload(null,false);
	// 		  } else if (result.dbStatus == 'FAILURE') {
	// 			alert("Failed to delete Record..");
	// 		  }
	// 		}
	// 	  });
	// 	},function(dismiss) {
		
	// 	}).done();
	// 	});
