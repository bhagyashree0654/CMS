$(document).ready(function(){

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// admin dashbord fetch employee updates from hr

var table1 = $('#hr-updates-on-project').DataTable({
	"bProcessing": false,
	"bServerSide": false,
	"bPaginate": true,
	"bLengthChange": true,
	"bFilter": true,
	"bSort": false,
	"bInfo": true,
	"bAutoWidth": true,
	"sAjaxSource": "fetchHRStatus",
	"bDestroy":false,
	"aoColumns": [
		{"data" : "no","bSortable":"false"},
		{"data" : "proj_name","sClass":"alignCenter"},
		{"data" : "hr_name","sClass":"alignCenter"},
		{"data" : "date","sClass":"alignCenter"},
		{"data" : "updates","sClass":"alignCenter"},
		{"sName" : "action",
			"sWidth":"20%",
			"data"  : null,
			"sClass":"alignCenter",
			"defaultContent": "<button id='btnRemoveStatus' action ='btnRemoveStatus' class='btn btn-primary'><i class = 'icon icon-close'></i></button>"
		}
	]
});

$('#hr-updates-on-project tbody').on( 'click', 'button[action=btnRemoveStatus]', function (event) {
  var data = table1.row($(this).parents('tr')).data();
  var oTable = $('#hr-updates-on-project').dataTable();
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
      url:"removeHRStatus",
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
        $('#hr-updates-on-project').DataTable().ajax.reload(null,false);
        } else if (result.dbStatus == 'FAILURE') {
          alert("Failed to delete Record..");
        }
      }
    });
  },function(dismiss) {
  
  }).done();
  });


// admin dashbord cards
$.ajax({      
  url: 'fetchCards',
  type:"get",
  dataType: 'json',
  success: function(response) {
    if (response.dbStatus == "SUCCESS") {
     $('#newClients').html(response.aaData.clients);
     $('#newProject').html(response.aaData.newproject);
     $('#allProject').html(response.aaData.allproject);
     $('#admin-leave-manage').DataTable().ajax.reload(null,false);

    }
  },
  error:function(response) {
    alert('Something went wrong....');
  }
});

//****************************************************datatables for leave management************************************************************//

var table3 = $('#admin-leave-manage').DataTable({
  "bProcessing": false,
  "bServerSide": false,
  "bPaginate": true,
  "bLengthChange": true,
  "bFilter": true,
  "bSort": false,
  "bInfo": true,
  "bAutoWidth": true,
  "sAjaxSource": "fetchLeaveRequestAdmin",
  "bDestroy":false,
  "aoColumns": [
    {"data" : "no","bSortable":"false"},
    {"data" : "hr_code","sClass":"alignCenter"},
    {"data" : "hr_name","sClass":"alignCenter"},
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
 $('#admin-leave-manage tbody').on( 'click', 'button[action=btnApprove]', function (event) {
  var data = table3.row($(this).parents('tr')).data();
  var oTable = $('#admin-leave-manage').dataTable();
  $(oTable.fnSettings().aoData).each(function () {
    $(this.nTr).removeClass('success');
  });
  $(event.target.parentNode.parentNode.parentNode).addClass('success');
  var  token = $("#_token").val();
  swal({
    title: 'Are you sure to Approve this request?',
    text: "",
    type: 'success',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes',
    animation: false
  }).then(function() {
  
    $.ajax({
      url:"approveLeaveRequestHR",
      type:"post",
      data:{_token: token,
        id : data.id,
        email:data.email,
        hrcode:data.hr_code,
        hr:data.hr_name,
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
        $('#admin-leave-manage').DataTable().ajax.reload(null,false);
        $('#admin-leave-approved').DataTable().ajax.reload(null,false);
        } else if (result.dbStatus == 'FAILURE') {
          alert("Failed to approve Request..");
        }
      }
    });
  },function(dismiss) {
  
  }).done();
  });

// deny leave
$('#admin-leave-manage tbody').on( 'click', 'button[action=btnDiscard]', function (event) {
  var data = table3.row($(this).parents('tr')).data();
  var oTable = $('#admin-leave-manage').dataTable();
  $(oTable.fnSettings().aoData).each(function () {
    $(this.nTr).removeClass('success');
  });
  $(event.target.parentNode.parentNode.parentNode).addClass('success');
  var  token = $("#_token").val();
  swal({
    title: 'Are you sure to Deny this request?',
    text: "",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes',
    animation: false
  }).then(function() {
  
    $.ajax({
      url:"denyLeaveRequestHR",
      type:"post",
      data:{_token: token,
        id : data.id,
        email:data.email,
        hr:data.hr_name,
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
        $('#admin-leave-manage').DataTable().ajax.reload(null,false);
       
        } else if (result.dbStatus == 'FAILURE') {
          alert("Failed to delete Record..");
        }
      }
    });
  },function(dismiss) {
  
  }).done();
  });


  var table4 = $('#admin-leave-approved').DataTable({
    "bProcessing": false,
    "bServerSide": false,
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": false,
    "bInfo": true,
    "bAutoWidth": true,
    "sAjaxSource": "fetchLeaveRequestAcceptedHR",
    "bDestroy":false,
    "aoColumns": [
      {"data" : "no","bSortable":"false"},
      {"data" : "hr_code","sClass":"alignCenter"},
      {"data" : "hr_name","sClass":"alignCenter"},
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
$('#admin-leave-approved tbody').on( 'click', 'button[action=btnConfirm]', function (event) {
  var data = table4.row($(this).parents('tr')).data();
  var oTable = $('#admin-leave-approved').dataTable();
  $(oTable.fnSettings().aoData).each(function () {
    $(this.nTr).removeClass('success');
  });
  $(event.target.parentNode.parentNode.parentNode).addClass('success');
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
      url:"confirmLeaveRequestHR",
      type:"post",
      data:{_token: token,
        id : data.id,
        code:data.hr_code
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
        $('#admin-leave-approved').DataTable().ajax.reload(null,false);
        } else if (result.dbStatus == 'FAILURE') {
          alert("Failed to delete Record..");
        }
      }
    });
  },function(dismiss) {
  
  }).done();
  });
// ********************************************************intern section******************************************************************//
var tableCand = $('#internTableAdmin').DataTable({
  "bProcessing": false,
  "bServerSide": false,
  "bPaginate": true,
  "bLengthChange": true,
  "bFilter": true,
  "bSort": false,
  "bInfo": true,
  "bAutoWidth": true,
  "sAjaxSource": "fetchInternReviewList",
  "bDestroy":false,
  "aoColumns": [
    {"data" : "no","bSortable":"false"},
    {"data" : "first_name","sClass":"alignCenter"},
    {"data" : "last_name","sClass":"alignCenter"},
    {"data" : "email","bSortable":"false"},
    {"data" : "mobile","sClass":"alignCenter"},
    {"data" : "position","sClass":"alignCenter"},
    {"data" : "resume",render: function ( resume, type, row ) {
      return '<a href="public/Candidate Resume/Resume List/'+resume+'" target="_blank">Download/View</a>';
      }
    },
    {"sName" : "action",
      "sWidth":"25%",
      "data"  : null,
      "sClass":"alignCenter",
      "defaultContent": "<button id='btnSelect' action ='btnSelect' class='btn btn-primary'><i class = 'fa fa-check-square'></i></button>"
    },
    {"sName" : "action",
    "sWidth":"25%",
    "data"  : null,
    "sClass":"alignCenter",
    "defaultContent": "<button id='btnRejected' action ='btnRejected' class='btn btn-primary'><i class = 'fa fa-window-close'></i></button>"
  }
  ]
});



$('#internTableAdmin tbody').on( 'click', 'button[action=btnSelect]', function (event) {
  var data = tableCand.row($(this).parents('tr')).data();
  var oTable = $('#internTableAdmin').dataTable();
  $(oTable.fnSettings().aoData).each(function () {
    $(this.nTr).removeClass('success');
  });
  $(event.target.parentNode.parentNode.parentNode).addClass('success');
  var  token = $("#_token").val();
  swal({
    title: 'Thanks for your Approval..!!'
  }).then(function() {

    $.ajax({
      url:"approveIntern",
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
            tableCand.ajax.reload(null,false);
        } else if (result.dbStatus == 'FAILURE') {
          alert("Failed to approve Record..");
        }
      }
    });
  },function(dismiss) {

  }).done();
});
$('#internTableAdmin tbody').on( 'click', 'button[action=btnRejected]', function (event) {
  var data = tableCand.row($(this).parents('tr')).data();
  var oTable = $('#internTableAdmin').dataTable();
  $(oTable.fnSettings().aoData).each(function () {
    $(this.nTr).removeClass('success');
  });
  $(event.target.parentNode.parentNode.parentNode).addClass('success');
  var  token = $("#_token").val();
  swal({
    title: 'Are you sure to reject the application!!'
  }).then(function() {

    $.ajax({
      url:"rejectIntern",
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
            tableCand.ajax.reload(null,false);
        } else if (result.dbStatus == 'FAILURE') {
          alert("Failed to approve Record..");
        }
      }
    });
  },function(dismiss) {

  }).done();
});

// *******************************************************************************************************************************//

var frontend=[];
var backend=[];
$('#front').on('change', function() {
  frontend.push(this.value);
  for(var i=0;i<frontend.length;i++){
    $("#frontends").val(frontend);
  }
});

$('#back').on('change', function() {
  backend.push(this.value);
  for(var i=0;i<backend.length;i++){
    $("#backends").val(backend);
  }
});
var langarray=[];
	$('.lang').on('change', function() {
		langarray.push(this.value);
		for(var i=0;i<langarray.length;i++){
			$("#languages").val(langarray);
		}
	});
var dsn=0;
var dev = 0;
var tst = 0;
var lptest = 0;
var host = 0;
var totalAmt = 0;
var amount=0;

$('#p_designing').on('change', function() {
 dsn =parseInt($('#p_designing').val());
totalCalc();
});
$('#p_development').on('change', function() {
 dev = parseInt($('#p_development').val());
totalCalc();
});
$('#p_testing').on('change', function() {
 tst =parseInt($('#p_testing').val());
totalCalc();
});
$('#p_lptesting').on('change', function() {
 lptest =parseInt($('#p_lptesting').val());
totalCalc();
});
$('#p_hosting').on('change', function() {
 host =parseInt($('#p_hosting').val());
totalCalc();
});

function totalCalc(){
  $('#total_amount').val(dsn + dev + tst + lptest + host); 
  totalAmt = dsn + dev + tst + lptest + host;
  divideTerm();
}
divideTerm();
function divideTerm(){
  if(totalAmt == 0){
    amount = 0;
  }
  else{
    amount = totalAmt/4;
  }
  $('#tc_brd').val(amount);
  $('#tc_ux').val(amount);
  $('#tc_democ').val(amount);
  $('#tc_fdemo').val(amount);

}




});
