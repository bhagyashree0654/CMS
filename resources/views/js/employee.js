$(document).ready(function(){
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

    //datatable for view project
    var table1 = $('#emp-view-project').DataTable({
      "bProcessing": false,
      "bServerSide": false,
      "bPaginate": true,
      "bLengthChange": true,
      "bFilter": true,
      "bSort": false,
      "bInfo": true,
      "bAutoWidth": true,
      "sAjaxSource": "fetchProjectDataForEmployee",
      "bDestroy":false,
      "aoColumns": [
        {"data" : "no","bSortable":"false"},
        {"data" : "proj_name","sClass":"alignCenter"},
        // {"data" : "emp_name","bSortable":"false"},     
        // {"data" : "project_lead","sClass":"alignCenter"},   
        {"data" : "starting_date","bSortable":"false"},
        {"data" : "end_date","bSortable":"false"},
        {"data" : "remain","bSortable":"false"}
      ]
    });


    $.ajax({
      url: 'fetchEmployeeProjectSelect',
      type:"get",
      dataType: 'json',
      success: function(response) {
        var options = "<option value=''>--Select Project--</option>";
        if (response.dbStatus == "SUCCESS") {
          $.each(response.aaData,function(i, data) {
            options += "<option value= '"+data.proj_code+"'>"+data.proj_name+"</option>";
          });
          $("#employee-project-select").html(options);
        }
      },
      error:function(response) {
        alert('Something went wrong....');
      }
    });


});