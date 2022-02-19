$(document).ready(function(){

     var managertbl = $('#managerTable').DataTable({
        "bProcessing": false,
        "bServerSide": false,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": true,
        "sAjaxSource": "fetchManagers",
        "bDestroy":false,
        "aoColumns": [
          {"data" : "no","bSortable":"false"},
          {"data" : "mngr_code","sClass":"alignCenter"},
          {"data" : "mngr_name","sClass":"alignCenter"},
          {"data": "image",
          "render": function (data) {

                if(data == '' || data == null)
                    return '<img src="public/assets/img/staff.jpg" width="55px" />';
                else
                    return '<img src="public/members/managers/' + data + '" width="55px" />';
                }
           },
          {"data" : "position","sClass":"alignCenter"},
          {"data" : "email","sClass":"alignCenter"},
          {"data" : "phone","sClass":"alignCenter"},
          {"sName" : "action",
            "sWidth":"20%",
            "data"  : null,
            "sClass":"alignCenter",
            "defaultContent": "<button id='btnEditEmp' action ='btnEditEmp' class='btn btn-info'><i class='fa fa-edit'></i></button>"
          },
          {"sName" : "action",
          "sWidth":"20%",
          "data"  : null,
          "sClass":"alignCenter",
          "defaultContent": "<button id='btnDeleteEmp' action ='btnDeleteEmp' class='btn btn-danger'><i class='fa fa-times'></i></button>"
        }
        ]
      });

      var dmanagertbl = $('#dismanagerTable').DataTable({
        "bProcessing": false,
        "bServerSide": false,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": true,
        "sAjaxSource": "dfetchManagers",
        "bDestroy":false,
        "aoColumns": [
          {"data" : "no","bSortable":"false"},
          {"data" : "mngr_code","sClass":"alignCenter"},
          {"data" : "mngr_name","sClass":"alignCenter"},{"data": "image",
          "render": function (data) {

            if(data == '' || data == null)
                return '<img src="public/assets/img/staff.jpg" width="55px" />';
            else
                return '<img src="public/members/managers/' + data + '" width="55px" />';
            }
        },
          {"data" : "position","sClass":"alignCenter"},
          {"data" : "email","sClass":"alignCenter"},
          {"data" : "phone","sClass":"alignCenter"},
          {"sName" : "action",
            "sWidth":"20%",
            "data"  : null,
            "sClass":"alignCenter",
            "defaultContent": "<button id='btnenableManager' action ='btnenableManager' class='btn btn-warning'><i class='fa fa-history'></i></button>"
          }
        ]
      });

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
                var noZero = 6 - total.toString().length;
                var final = '';
                for(i = 1 ; i<=noZero ; i++){
                    zeroString = ""+0;
                    final+=zeroString;
                }
				var matches = uname.match(/\b(\w)/g);
				var acronym = matches.join('');
				userid = acronym +final+total;
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
      
          
      $('#managerTable tbody').on( 'click', 'button[action=btnEditEmp]', function (event) {
        var data = managertbl.row($(this).parents('tr')).data();
        var oTable = $('#managerTable').dataTable();
        $(oTable.fnSettings().aoData).each(function () {
          $(this.nTr).removeClass('success');
        });
        console.log(data)
        $(event.target.parentNode.parentNode).addClass('success');
        $("#hidId").val(data.id);
        $("#username").val(data.mngr_name);
        $("#userid").val(data.mngr_code);
        $("#email").val(data.email);
        $("#phone").val(data.phone);
        $("#managerModal").modal('show');
      });
  
      
    $('#formManager').on('submit',function(e){ 
      var form = $('#formManager')[0];
      var formData = new FormData(form);
      e.preventDefault();
      var  hidId = $("#hidId").val();
      var oper = "";
  
      if (hidId == '' || hidId == null || hidId == undefined) {
        oper = "addManager";
      }
      else{
          oper="editManager";
      }
      $.ajax({
          url: oper,
          type: "post",
          processData: false,
          contentType: false,
          data:formData,
          success: function(response){
              alert(response)
              var result = response;
              alert(result);
              if (result.dbStatus == 'SUCCESS') {
                swal({
                      title: "Good job!",
                      text: result.dbMessage,
                      type: "success",
                      button: "Aww yiss!",
                    });
                $('#managerTable').DataTable().ajax.reload(null,false);
                $("#hidId").val('');
                $('#formManager')[0].reset();
                $('#managerModal').modal('hide');
                $('#managerModal').on('hidden.bs.modal', function () {
                  $('#formManager')[0].reset();
                });
             }
              else if (result.dbStatus == 'FAILURE') {
                  alert("Sorry... Error..!!");
              }
          }
      });
  });
//   disabled
$('#managerTable tbody').on( 'click', 'button[action=btnDeleteEmp]', function (event) {
    var data = managertbl.row($(this).parents('tr')).data();
    var oTable = $('#managerTable').dataTable();
    var  token = $("#_token").val();
    console.log(data)
    swal({
      title: 'Are you sure to disable this record?',
      text: "",
      type: 'success',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      animation: false
    }).then(function() {
    
      $.ajax({
        url:"deleteManager",
        type:"post",
        data:{_token: token,
          id:data.id
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
          $('#managerTable').DataTable().ajax.reload(null,false);
          $('#dismanagerTable').DataTable().ajax.reload(null,false);
          } else if (result.dbStatus == 'FAILURE') {
            alert("Failed to disabled Record..");
          }
        }
      });
    },function(dismiss) {
    
    }).done();
    });
// enabled
    $('#dismanagerTable tbody').on( 'click', 'button[action=btnenableManager]', function (event) {
        var data = dmanagertbl.row($(this).parents('tr')).data();
        var oTable = $('#dismanagerTable').dataTable();
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
            url:"enableManager",
            type:"post",
            data:{_token: token,
              id:data.id
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
              $('#dismanagerTable').DataTable().ajax.reload(null,false);
              $('#managerTable').DataTable().ajax.reload(null,false);
              } else if (result.dbStatus == 'FAILURE') {
                alert("Failed to enabled Record..");
              }
            }
          });
        },function(dismiss) {
        
        }).done();
        });
  

});