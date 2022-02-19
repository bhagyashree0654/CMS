$(document).ready(function(){

    var managertbl = $('#pendingTbl').DataTable({
       "bProcessing": false,
       "bServerSide": false,
       "bPaginate": true,
       "bLengthChange": true,
       "bFilter": true,
       "bSort": false,
       "bInfo": true,
       "bAutoWidth": true,
       "sAjaxSource": "fetchLeaveofHR",
       "bDestroy":false,
       "aoColumns": [
         {"data" : "no","bSortable":"false"},
         {"data" : "applier_code","sClass":"alignCenter"},
         {"data" : "reason","sClass":"alignCenter"},
         {"data" : "start_date","sClass":"alignCenter"},
         {"data" : "end_date","sClass":"alignCenter"},
         {"sName" : "action",
           "sWidth":"20%",
           "data"  : null,
           "sClass":"alignCenter",
           "defaultContent": "<button id='btnApprove' action ='btnApprove' class='btn btn-warning'><i class='fa fa-check-circle-o'></i></button>"
         },
         {"sName" : "action",
         "sWidth":"20%",
         "data"  : null,
         "sClass":"alignCenter",
         "defaultContent": "<button id='btnDeny' action ='btnDeny' class='btn btn-danger'><i class='fa fa-times'></i></button>"
       }
       ]
     });

     var dmanagertbl = $('#confirmTbl').DataTable({
       "bProcessing": false,
       "bServerSide": false,
       "bPaginate": true,
       "bLengthChange": true,
       "bFilter": true,
       "bSort": false,
       "bInfo": true,
       "bAutoWidth": true,
       "sAjaxSource": "fetchedLeaveofHR",
       "bDestroy":false,
       "aoColumns": [
        {"data" : "no","bSortable":"false"},
        {"data" : "applier_code","sClass":"alignCenter"},
        {"data" : "reason","sClass":"alignCenter"},
        {"data" : "start_date","sClass":"alignCenter"},
        {"data" : "end_date","sClass":"alignCenter"},
         {"sName" : "action",
           "sWidth":"20%",
           "data"  : null,
           "sClass":"alignCenter",
           "defaultContent": "<button id='btnConfirm' action ='btnConfirm' class='btn btn-success'><i class='fa fa-check'></i></button>"
         }
       ]
     });

//   approve
$('#pendingTbl tbody').on( 'click', 'button[action=btnApprove]', function (event) {
   var data = managertbl.row($(this).parents('tr')).data();
   var oTable = $('#pendingTbl').dataTable();
   var  token = $("#_token").val();
   console.log(data)
   swal({
     title: 'Approve Leave?',
     text: "",
     type: 'success',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes',
     animation: false
   }).then(function() {
   
     $.ajax({
       url:"approveHRLeave",
       type:"post",
       data:{_token: token,
         id:data.id,
         applier_code:data.applier_code,
         managing_code:data.managing_code,
         start_date:data.start_date,
          end_date:data.end_date,
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
         $('#pendingTbl').DataTable().ajax.reload(null,false);
         $('#confirmTbl').DataTable().ajax.reload(null,false);
         } else if (result.dbStatus == 'FAILURE') {
           alert("Failed to disabled Record..");
         }
       }
     });
   },function(dismiss) {
   
   }).done();
   });
// deny
   $('#pendingTbl tbody').on( 'click', 'button[action=btnDeny]', function (event) {
       var data = managertbl.row($(this).parents('tr')).data();
       var oTable = $('#pendingTbl').dataTable();
       var  token = $("#_token").val();
       console.log(data)
       swal({
         title: 'Are you sure to enable this record?',
         text: "",
         type: 'success',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes',
         animation: false
       }).then(function() {
       
         $.ajax({
           url:"denyHRLeave",
           type:"post",
           data:{_token: token,
            id:data.id,
            applier_code:data.applier_code,
            managing_code:data.managing_code,
            start_date:data.start_date,
             end_date:data.end_date,
             reason:data.reason
           },      
           success:function(response) {
             var result = response;
             if (result.dbStatus == 'SUCCESS') {
               swal({
                     title: "Good job!",
                     text: result.dbMessage,
                     type: "success",
                     button: "okay!",
                   });
             $('#confirmTbl').DataTable().ajax.reload(null,false);
             $('#pendingTbl').DataTable().ajax.reload(null,false);
             } else if (result.dbStatus == 'FAILURE') {
               alert("Failed to enabled Record..");
             }
           }
         });
       },function(dismiss) {
       
       }).done();
    });

  // confirm    
$('#confirmTbl tbody').on( 'click', 'button[action=btnConfirm]', function (event) {
    var data = dmanagertbl.row($(this).parents('tr')).data();
    var oTable = $('#confirmTbl').dataTable();
    var  token = $("#_token").val();
    console.log(data)
    swal({
      title: 'Confirm?',
      text: "",
      type: 'success',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      animation: false
    }).then(function() {
      $.ajax({
        url:"confirmHRLeave",
        type:"post",
        data:{_token: token,
         id:data.id,
         applier_code:data.applier_code,
         managing_code:data.managing_code
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
          $('#confirmTbl').DataTable().ajax.reload(null,false);
          $('#pendingTbl').DataTable().ajax.reload(null,false);
          } else if (result.dbStatus == 'FAILURE') {
            alert("Failed to confirm Record..");
          }
        }
      });
    },function(dismiss) {
    
    }).done();
    });
});