$(document).ready(function(){


	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
		url: 'fetchRoles',
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
                var noZero = 6 - total.toString().length;
                var final = '';
                for(i = 1 ; i<=noZero ; i++){
                    zeroString = ""+0;
                    final+=zeroString;
                }
				var matches = uname.match(/\b(\w)/g); // ['J','S','O','N']
				var acronym = matches.join(''); // JSON
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
	
	$('#roles').on('change', function() {	
		var role = $(this).val();	
		alert(role)
		if(this.options[this.selectedIndex].text != 'Employee' || this.options[this.selectedIndex].text != 'Team Lead'){
				$('#positionChoosen').hide();
				$('#hiddenlabel').hide();
		}
		if(this.options[this.selectedIndex].text == 'Employee' || this.options[this.selectedIndex].text == 'Team Lead'){
			$('#positionChoosen').show();
			$('#hiddenlabel').show();
	
		}
	});		
	//.end

	function validateEmployeeFields(){

		var name = document.getElementById('username').value;
		var userid = document.getElementById('userid').value;
		var email = document.getElementById('email').value;
		var photo = document.getElementById('photo').value;
		var password = document.getElementById('password').value;
		var phone = document.getElementById('phone').value;
		var address = document.getElementById('address').value;		
		const regexDigit = /\d/;
		var regxphone = /^[6-9]\d{9}$/ ;
	
		//validate user name
		if(name.length == ""){
			document.getElementById('usererr').innerHTML="Enter the username";
			return false;
		  }
		  if(name.length < 6 && name.length >60){
			  document.getElementById('usererr').innerHTML="Enter the valid username";
			return false;
		  }
		  if(regexDigit.test(name)){
			  document.getElementById('usererr').innerHTML='Digits are not allowed';
			return false;
		  }

		  if(userid.length == ""){
			document.getElementById('useriderr').innerHTML="Enter the userid";
			return false;
		  }
		  if(userid.length < 6 && userid.length >15){
			  document.getElementById('useriderr').innerHTML="Enter the valid userid";
			return false;
		  }
		   //validate mail
		   if(email == ""){
			document.getElementById('mailerr').innerHTML="Please Enter your mail id"; 
		  return false;
		}
		if(email.indexOf('@') <= 0){
			document.getElementById('mailerr').innerHTML="invalid position of @";    
		return false;
		}
		if((email.charAt(email.length-4) != '.') && (email.charAt(email.length-3) != '.')){
			document.getElementById('mailerr').innerHTML="invalid '.' position";    
		return false;
		}
		//validate img
		// var ext = photo.substring(photo.lastIndexOf('.') + 1);
		// if(ext != "gif" || ext != "GIF" || ext != "JPEG" || ext != "jpeg" || ext != "jpg" || ext != "JPG" || ext != "doc")
		// {		
		// alert("Upload Gif or Jpg images only");
		// return false;
		// }
		//validate password 
		if(password == ""){
			document.getElementById('passerr').innerHTML="Do not leave it blank..";
		  return false;
		}
		if(password.length < 6){
			document.getElementById('passerr').innerHTML="Password must be 6 character long..";
		  return false;
		}
		//validate address
		if(address.length == ""){
			document.getElementById('adderr').innerHTML="Enter the address";
			return false;
		  }
		  if(address.length < 6 && address.length >60){
			  document.getElementById('adderr').innerHTML="Enter the valid address";
			return false;
		  }
		//PHONE Validation
		  if(phone.length == ""){
			document.getElementById('phonerr').innerHTML="Enter the valid phone no";
			return false;
		  }
		  if(phone.length <10 && phone.length > 12){
			document.getElementById('phonerr').innerHTML="Enter the valid phone no";
			return false;
		  }
		  if(!regxphone.test(phone)){
			document.getElementById('phonerr').innerHTML="Enter the valid phone no";
			return false;
		  }
		  return true;
	}

    var table1 = $('#empTable').DataTable({
		"bProcessing": false,
		"bServerSide": false,
		"bPaginate": true,
		"bLengthChange": true,
		"bFilter": true,
		"bSort": false,
		"bInfo": true,
		"bAutoWidth": true,
		"sAjaxSource": "fetchEmployee",
		"bDestroy":false,
		"aoColumns": [
			{"data" : "no","bSortable":"false"},
			{"data" : "emp_code","sClass":"alignCenter"},
			{"data" : "emp_name","sClass":"alignCenter"},
			{"data": "emp_photo",
				"render": function (data) {
					return '<img src="public/members/employees/' + data + '" width="55px" />';
				}
			},
			{"data" : "role_name","sClass":"alignCenter"},
            {"data" : "email","sClass":"alignCenter"},
			{"data" : "developer","sClass":"alignCenter"},
			{"sName" : "action",
				"sWidth":"20%",
				"data"  : null,
				"sClass":"alignCenter",
				"defaultContent": "<button id='btnEdit' action ='btnEdit' class='btn btn-info'>Edit  <i class = 'fa fa-edit'></i></button>"
			},{"sName" : "action",
            "sWidth":"20%",
            "data"  : null,
            "sClass":"alignCenter",
            "defaultContent": "<button id='btnDelete' action ='btnDelete' class='btn btn-danger '>Delete  <i class = 'fa fa-times'></i></button>"
        }
		]
	});
	// edit
	$('#empTable tbody').on( 'click', 'button[action=btnEdit]', function (event) {
		var data = table1.row($(this).parents('tr')).data();
		var oTable = $('#empTable').dataTable();
		$(oTable.fnSettings().aoData).each(function () {
			$(this.nTr).removeClass('success');
		});
		$(event.target.parentNode.parentNode).addClass('success');
		$("#euserid").val(data.emp_code);
		$("#roles1").val(data.role_code);
		$("#esalary").val(data.salary);
		$("#hidId").val(data.id);
		$("#myModal1").modal('show');
	});


	$('#myFormEmployee').on('submit',function(e){  
		e.preventDefault();
		var dataValidation = validateEmployeeFields();
		if(dataValidation){
		var form = $('#myFormEmployee')[0];
		var formData = new FormData(form);
		console.log(formData);
		var  hidId = $("#hidId").val();
		$("#addEmp").attr("disabled", true);
		var oper = "";

		if (hidId == '' || hidId == null || hidId == undefined) {
		oper = "addEmployee";
		} else {
		oper = "editEmployee";
		}

		$.ajax({
			url: oper,
			type: "post",
			processData: false,
			contentType: false,
			data: formData,
			dataType:'text',
			success: function(response){
				var result = response;
				if (result.dbStatus == 'SUCCESS') {
					swal({
						title: "Good job!",
						text: result.dbMessage,
						type: "success",
						button: "Aww yiss!",
					});
					$('#empTable').DataTable().ajax.reload(null,false);
					$('#hrTable').DataTable().ajax.reload(null,false);
					$("#hidId").val('');
					$("#addEmp").removeAttr('disabled');
					$('#myFormEmployee')[0].reset();
					$('#myModal').modal('hide'); //myModal1
					$('#myModal').on('hidden.bs.modal', function () {
						$('#myFormEmployee')[0].reset();
					});
				}
					else if (result.dbStatus == 'FAILURE') {
						alert("Sorry... Error..!! "+result.dbMessage);
						$("#addEmp").removeAttr('disabled');
					}
				}
			});

		}

	});

	$('#empTable tbody').on( 'click', 'button[action=btnDelete]', function (event) {
		var data = table1.row($(this).parents('tr')).data();
		var oTable = $('#empTable').dataTable();
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
			url:"deleteEmployee",
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
			  $('#empTable').DataTable().ajax.reload(null,false);
			  } else if (result.dbStatus == 'FAILURE') {
				alert("Failed to delete Record..");
			  }
			}
		  });
		},function(dismiss) {
		
		}).done();
		});

// ****************************************************HR Table***********************************************************//
		var table2 = $('#hrTable').DataTable({
			"bProcessing": false,
			"bServerSide": false,
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": false,
			"bInfo": true,
			"bAutoWidth": true,
			"sAjaxSource": "fetchHR",
			"bDestroy":false,
			"aoColumns": [
				{"data" : "no","bSortable":"false"},
				{"data" : "hr_code","sClass":"alignCenter"},
				{"data" : "hr_name","sClass":"alignCenter"},
				{"data": "hr_photo",
					"render": function (data) {
						return '<img src="public/members/employees/' + data + '" width="55px" />';
					}
				},
				{"data" : "role_name","sClass":"alignCenter"},
				{"data" : "email","sClass":"alignCenter"},
				{"sName" : "action",
					"sWidth":"20%",
					"data"  : null,
					"sClass":"alignCenter",
					"defaultContent": "<button id='btnEditHR' action ='btnEditHR' class='btn btn-info'>Edit  <i class = 'fa fa-edit'></i></button>"
				},{"sName" : "action",
				"sWidth":"20%",
				"data"  : null,
				"sClass":"alignCenter",
				"defaultContent": "<button id='btnDeleteHR' action ='btnDeleteHR' class='btn btn-danger '>Delete  <i class = 'fa fa-times'></i></button>"
			}
			]
		});
	
	
		$('#hrTable tbody').on( 'click', 'button[action=btnDeleteHR]', function (event) {
			var data = table2.row($(this).parents('tr')).data();
			var oTable = $('#hrTable').dataTable();
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
				url:"deleteHR",
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
				  $('#hrTable').DataTable().ajax.reload(null,false);
				  } else if (result.dbStatus == 'FAILURE') {
					alert("Failed to delete Record..");
				  }
				}
			  });
			},function(dismiss) {
			
			}).done();
			});
	  

// *****************************************************HR section***********************************************************//
	
	// $.ajax({    
	// 	cache: false,  
	// 		url: 'fetchEmployeeProfile',
	// 		type:"get",
	// 		dataType: 'json',
	// 		success: function(response) {
	// 			var myopt = "";
	// 			if (response.dbStatus == "SUCCESS") {
	// 				$.each(response.aaData,function(i, data) {
	// 				 myopt+=  `<img class="mt-2" style="border-radius:50%; display: block;
	// 					margin-left: auto;margin-right: auto;" id="profilepic" src="public/members/employees/${data.emp_photo}" class="card-img-top" height="15%" width="10%" alt="prof"> <div style="height: 15px; width:15px; border-radius:50%;background-color:green; color:green;border:rgb(10, 243, 10);margin-left: auto;margin-right: auto; margin-top:-8px; position: relative;"></div>
	// 					<div class="card-body">
	// 					  <h5 class="card-title text-center">${data.emp_name}</h5>
	// 					  <p class="card-text text-center">
	// 						<b>Employee Code:</b> <span>${data.emp_code}</span> <br>
	// 						<b>Salary:</b> <span>${data.salary}</span> <br>
	// 						<b>Address:</b> <span>${data.address}</span> <br>
	// 						<b>Date of Birth:</b> <span>${data.dob}</span> <br>
	// 					  </p>                      
	// 					</div>`
	// 				});
	// 				$("#profile").html(myopt);
	// 			}
	// 		},
	// 		error:function(response) {
	// 			alert('Something went wrong....');
	// 		}
	// 	});

// *****************************************************3. Project section***********************************************************//

	$('#languages').html('');
	$('#members').html('');
	$("#ifYes").hide();
	$("#notes").hide();
	$('#optionsRadios1').click(function(){
		$("#ifYes").slideUp(500);
	});

	$('#optionsRadios2').click(function(){
		$("#ifYes").slideDown(500);
	});

	$('#project_name').change(function(){

		$('#project_code').val($('#project_name').val().toLowerCase().replace(/ /g, '_'));

	});

	var langarray=[];
	$('.lang').on('change', function() {
		langarray.push(this.value);
		for(var i=0;i<langarray.length;i++){
			$("#languages").val(langarray);
		}
	});

	var empArray=[];
	var empArrayCode=[];
	$('.emp').on('change', function() {
		empArray.push($(this).find(":selected").text());
		empArrayCode.push(this.value);
		for(var i=0;i<empArray.length;i++){
			$("#members").val(empArray);
			$('#selected-emps').val(empArrayCode);
		}
	});
	
	$('.emp').on('change', function() {
		var emps="<option value='' disabled selected>Select Team Lead</option>";
		for(var i=0,j=0;i<empArray.length,j<empArrayCode.length;i++,j++){
			emps += "<option value='"+empArrayCode[i]+"'>"+empArray[i]+"</option>";
		}
		$("#proj-lead-name").html(emps);
		$("#team-lead-name").html(emps);
	});

	$('#proj-lead-name').change(function(){
		$('#proj-lead').val($(this).find(":selected").text());
		$('#proj').hide();
		$('#proj').html("");
	});
	$('#team-lead-name').change(function(){
		$('#team-lead').val($(this).find(":selected").text());
		$('#team').hide();
		$('#team').html("");
	});

	// Project add edit delete
	var projTbl = $('#projectTable').DataTable({
		"bProcessing": false,
		"bServerSide": false,
		"bPaginate": true,
		"bLengthChange": true,
		"bFilter": true,
		"bSort": false,
		"bInfo": true,
		"bAutoWidth": true,
		"sAjaxSource": "fetchProjectByAdmin",
		"bDestroy":false,
		"aoColumns": [
			{"data" : "no","bSortable":"false"},
			{"data" : "proj_name","sClass":"alignCenter"},
			{"data" : "internal_status",
					"render": function (data) {
						if(data == 0)
						return "External";
						else
						return "Internal";
					}
				
			},
			{"data" : "client_name","sClass":"alignCenter"},
			{"data" : "pref_lang","sClass":"alignCenter"},
			{"data" : "starting_date","sClass":"alignCenter"},
			{"data" : "end_date","sClass":"alignCenter"},
			{"data" : "members","sClass":"alignCenter"},
			{"data" : "project_lead","sClass":"alignCenter"},
			{"data" : "team_lead","sClass":"alignCenter"},
			{"data" : "documentation",render: function ( doc, type, row ) {
				return '<a href="public/Project Documentation/Project List/'+doc+'" target="_blank">Download/View</a>';
				}
			  },

			{"sName" : "action",
				"sWidth":"20%",
				"data"  : null,
				"sClass":"alignCenter",
				"defaultContent": "<button id='btnEditProject' action ='btnEditProject' class='btn btn-info'>Edit <i class = 'fa fa-edit'></i></button>"
			},
			{"sName" : "action",
				"sWidth":"20%",
				"data"  : null,
				"sClass":"alignCenter",
				"defaultContent": "<button id='btnCloseProject' action ='btnCloseProject' class='btn btn-danger'>Close <i class = 'fa fa-times'></i></button>"
			}
		]
	});

	$('#team').hide();
	$('#proj').hide();

	// edit
	$('#projectTable tbody').on( 'click', 'button[action=btnEditProject]', function (event) {
		var data = projTbl.row($(this).parents('tr')).data();
		console.log(data)
		$("#project_name").val(data.proj_name);
		$("#project_code").val(data.proj_code);

		if(data.internal_status == 1){
			$("input:radio[value='Internal']").prop('checked',true);
		}
		if(data.external_status == 1){
			$("input:radio[value='External']").prop('checked',true);
			$("#ifYes").show();
			$('#client-name').val(data.client_name)
		}

		$("#notes").show();
		$("#team").html("Team Lead: "+data.team_lead);
		$('#team').show();
		$("#proj").html("Project Lead: "+data.project_lead);
		$('#proj').show();

		$("#languages").val(data.pref_lang);
		$("#proj-start").val(data.starting_date);
		$("#proj-end").val(data.end_date);
		$("#members").val(data.members);
		$("#hidIdProj").val(data.id);
	});


	$('#myFormProject').on('submit',function(e){  
		e.preventDefault();
		var form = $('#myFormProject')[0];
		var formData = new FormData(form);
		var  hidId = $("#hidIdProj").val();
		alert(hidId);
		$("#addProject").attr("disabled", true);
		var oper = "";

		if (hidId == '' || hidId == null || hidId == undefined) {
		oper = "addProjectByAdmin";
		} else {
		oper = "editProjectByAdmin";
		}

		$.ajax({
			url: oper,
			type: "post",
			processData: false,
			contentType: false,
			data: formData,
			dataType:'text',
			success: function(response){
				// alert(response);
				var result = jQuery.parseJSON(response);
				// alert(result);
				if (result.dbStatus == 'SUCCESS') {
					swal({
						title: "Good job!",
						text: result.dbMessage,
						type: "success",
						button: "Aww yiss!",
					});
					projTbl.ajax.reload();
					$("#hidIdProj").val('');
					$("#addProject").prop("disabled", false); 
					$('#myFormProject')[0].reset();
					$("#notes").hide();
				}
					else if (result.dbStatus == 'FAILURE') {
						alert("Sorry... Error..!! "+result.dbMessage);
						$("#hidIdProj").val('');
						$("#addProject").prop("disabled", false); 
						$('#myFormProject')[0].reset(); 
						$("#notes").hide();
					}
				}
			});

	});

	$('#projectTable tbody').on( 'click', 'button[action=btnCloseProject]', function (event) {
		var data = projTbl.row($(this).parents('tr')).data();
		console.log(data)
		var id = data.id;

		$.ajax({
			url: "disableProject",
			type: "post",
			data: {id:id,
			code:data.proj_code},
			success: function(response){
				alert(response);
				var result = jQuery.parseJSON(response);
				// alert(result);
				if (result.dbStatus == 'SUCCESS') {
					swal({
						text: result.dbMessage,
						type: "success",
						button: "Close!!",
					});
				}

			},
			error: function(response){
				alert("Sorry... Error..!! "+response);
			}


		});
	});
	
});