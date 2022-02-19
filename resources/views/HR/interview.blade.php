@extends('layout')

@section('title','Interviewee Details')

@section('content')

  <!-- Employee details -->
  <section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <p class="text-success"> @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }} 
            </div>
        @endif</p>
        </div>
        <!-- Add Employee-->
        <div class="col-lg-7">
          <div class="block">
            <div class="title"><strong>Add Candidate Details for Interview</strong></div>
            <div class="block-body text-center">
              <button
                type="button"
                data-toggle="modal"
                data-target="#myModal"
                class="btn btn-primary"
              >
                Click here
              </button>
              <!-- Add Candidate Modal-->
              <div
                id="myModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
                class="modal fade text-left"
              >
                <div role="document" class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <strong id="exampleModalLabel" class="modal-title">Interviewee Details</strong>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="#" id="candidate">
                        <div class="form-group"> 
                          <input type="hidden" class="form-control" id="hidId" name="hidId" aria-describedby="id">
                          <input type="hidden" class="form-control tooltips" name="_token" id="_token" value="{{ csrf_token() }}"/>
                          <input type="text" class="form-control" id="first_name" aria-describedby="date" placeholder="First Name" name="first_name" required 
                            pattern="[A-z]{3,15}" oninvalid="this.setCustomValidity(' username must not be empty atleast 3 characters')" oninput="setCustomValidity('')" title="e.g sri'">
                        </div>

                            <div class="form-group">
                              <input type="text" placeholder="Last Name" class="mr-sm-3 form-control" id="lastName" name="last_name"  required 
                              pattern="[A-z]{3,15}" oninvalid="this.setCustomValidity(' username must not be empty atleast 3 characters')" oninput="setCustomValidity('')" title="e.g das">
                            </div>

                            <div class="form-group">
                              <input type="text" placeholder="Email" class="mr-sm-3 form-control" id="addEmailName" name="email" required 
                              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" oninvalid="this.setCustomValidity(' Fillout the Email section')" oninput="setCustomValidity('')" title="e.g something@gmail.com">
                            </div>

                            <div class="form-group">
                              <input type="text" placeholder="Phone" class="mr-sm-3 form-control" id="addPhoneName" name="mobile"  required 
                              pattern="^\d{10}$" oninvalid="this.setCustomValidity(' Fillout the Email section')" oninput="setCustomValidity('')" title="e.g must be 10 digits" >
                              <span id="PhonenameError" style="color:red;display:none;margin-left:100px;">Phoneno. must not be empty</span></p>
                            </div>

                            <div class="form-group">
                              <input type="text" placeholder="skiils" class="mr-sm-3 form-control" id="addSkillName" name="skills" required> 
                            </div>
                            <div class="form-group">
                              <input type="text" placeholder="Position" class="mr-sm-3 form-control" id="position" name="position"  required 
                              pattern="[A-z]{5,15}" oninvalid="this.setCustomValidity(' position must not be empty atleast 5 characters')" oninput="setCustomValidity('')" title="e.g backend">
                            </div>

                            <div class="form-group">
                              <input type="file" name="cv" id="fileToUpload" accept=".pdf,.doc">only pdf and docsx
                            </div>
                            <button type="submit" class="btn btn-primary" id="add">
                              Add
                              </button>
                          
                      </form>
                    </div>
                    <div class="modal-footer">
                      
                    </div>
                  </div>
                </div>
              </div>    
            </div>
          </div>
        </div>
              <!--Meeting modal-->
        <div class="modal fade" id="meeting" tabindex="-1" role="dialog" aria-labelledby="lvmodalexmpl" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="lvmodalexmpl">Send Meeting Credentials</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="sendemail">
                  {{ csrf_field() }}
                  <div class="form-group"> 
                    <input type="text" class="form-control" id="first_email" aria-describedby="date" placeholder="First Name" name="first_name" required pattern="[A-z]{3,15}" oninvalid="this.setCustomValidity('username must not be empty atleast 3 characters')" oninput="setCustomValidity('')" title="e.g sri'">
                  </div>
                  <div class="form-group"> 
                    <input type="text" class="form-control" id="last_email" aria-describedby="date" placeholder="Last Name" name="last_name" required pattern="[A-z]{3,15}" oninvalid="this.setCustomValidity(' username must not be empty atleast 3 characters')" oninput="setCustomValidity('')" title="e.g sri'">
                  </div>
                  <div class="form-group"> 
                    <input type="text" class="form-control" id="meet_email" aria-describedby="date" placeholder="Enter Email ID" name="email" required pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$">
                  </div>
                  <div class="form-group">
                    <input type="text" placeholder="Position" class="mr-sm-3 form-control" id="pos" name="position"  required 
                    pattern="[A-z]{5,15}" oninvalid="this.setCustomValidity(' position must not be empty atleast 5 characters')" oninput="setCustomValidity('')" title="e.g backend">
                  </div>
                  <div class="form-group"> 
                    <input type="date" class="form-control" id="meet_date" aria-describedby="date" placeholder="Enter Interview Date" name="ivdate" required>
                  </div>
                  <div class="form-group">
                    <input type="url" class="form-control" id="meet_link" placeholder="Enter Meeting ID or Link" name="link">
                    <span id="meetIdError" style="color:red;display:none;margin-left:100px;">Meeting ID must not be empty</span></p>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="meet_time" placeholder="Meeting Time" name="meetTime"> 
                    <span id="meetTimeError" style="color:red;display:none;margin-left:100px;">Meeting Time must not be empty</span></p>
                  </div>
                  <button type="submit" class="btn btn-primary" id="meet" name="send" value="send">Send</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        
        <!--Fetched data table for Candidates -->
        <div class="col-lg-12">
          <div class="block margin-bottom-sm">
            <div class="title"><strong>All Candidate List</strong></div>
            <div class="table-responsive">
              <table class="table" id="all_candidate_table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Position</th>
                    <th>CV</th>
                    <th>Action</th>
                  </tr>
                </thead>
                {{-- <tbody>
                </tbody> --}}
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="block margin-bottom-sm">
            <div class="title"><strong>Selected Candidate List For Interview</strong></div>
            <div class="table-responsive">
              <table class="table" id="sel_candidate_table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Position</th>
                    <th>CV</th>
                    <th>Take Interview</th>
                    <th>Remove</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

 @endsection
         
  @push('scripts')
 <script>

$('#candidate').on('submit',function(e){  
        var form = $('#candidate')[0];
        var formData = new FormData(form);
        e.preventDefault();
        var  hidId = $("#hidId").val();
            alert(hidId);
        var oper = "";

        if (hidId == '' || hidId == null || hidId == undefined) {
          oper = "addCandidate";
        } else {
          oper = "editCandidate";
        }

        $.ajax({
            // url: 'addCandidate' , //oper
            url: oper,
            type: "post",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response){
                var result = response;
                if (result.dbStatus == 'SUCCESS') {
                  swal({
                        title: "Good job!",
                        text: result.dbMessage,
                        type: "success",
                        button: "Aww yiss!",
                      });
                  $('#all_candidate_table').DataTable().ajax.reload(null,false);
                  $("#hidId").val('');
                  $("#add").html('Add');
                  $("#add").removeAttr('disabled');
                  $('#candidate')[0].reset();
                  $('#myModal').modal('hide');
                  $('#myModal').on('hidden.bs.modal', function () {
                    $('#candidate')[0].reset();
                  });
               }
                else if (result.dbStatus == 'FAILURE') {
                    alert("Sorry... Error..!!");
                    $("#add").removeAttr('disabled');
                }
            }
        });
        

    });
 </script>

 <script>
   $(document).ready( function () {
    var table1 = $('#all_candidate_table').DataTable({
		"bProcessing": false,
		"bServerSide": false,
		"bPaginate": true,
		"bLengthChange": true,
		"bFilter": true,
		"bSort": false,
		"bInfo": true,
		"bAutoWidth": true,
		"sAjaxSource": "allCandidateList",
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
				"defaultContent": "<button id='btnEdit' action ='btnEdit' class='btn btn-primary'><i class = 'fa fa-edit'></i></button>&nbsp;&nbsp;<button id='btnDelete' action ='btnDelete' class='btn btn-danger '><i class = 'fa fa-trash''></i></button>"
			}
		]
	});

  $('#all_candidate_table tbody').on( 'click', 'button[action=btnEdit]', function (event) {
		var data = table1.row($(this).parents('tr')).data();
		//console.log(data);
		var oTable = $('#all_candidate_table').dataTable();
		$(oTable.fnSettings().aoData).each(function () {
			$(this.nTr).removeClass('success');
		});
		$(event.target.parentNode.parentNode).addClass('success');
		$("#first_name").val(data.first_name);
		$("#lastName").val(data.last_name);
    $("#addEmailName").val(data.email);
    $("#addPhoneName").val(data.mobile);
		$("#addSkillName").val(data.skills);
    $("#position").val(data.position);
		$("#hidId").val(data.id);
		$("#add").html('<i class="fa fa-pencil-alt"></i> Update');
		$("#myModal").modal('show');
	});

$('#all_candidate_table tbody').on( 'click', 'button[action=btnDelete]', function (event) {
var data = table1.row($(this).parents('tr')).data();
var oTable = $('#all_candidate_table').dataTable();
$(oTable.fnSettings().aoData).each(function () {
  $(this.nTr).removeClass('success');
});
$(event.target.parentNode.parentNode.parentNode).addClass('success');
var  token = $("#_token").val();
swal({
  title: 'Are you sure to Delete?',
  text: "",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes',
  animation: false
}).then(function() {

  $.ajax({
    url:"deleteCandidate",
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
      $('#all_candidate_table').DataTable().ajax.reload(null,false);
      } else if (result.dbStatus == 'FAILURE') {
        alert("Failed to delete Record..");
      }
    }
  });
},function(dismiss) {

}).done();
});

  // selected candidate table
  var table2 = $('#sel_candidate_table').DataTable({
		"bProcessing": false,
		"bServerSide": false,
		"bPaginate": true,
		"bLengthChange": true,
		"bFilter": true,
		"bSort": false,
		"bInfo": true,
		"bAutoWidth": true,
		"sAjaxSource": "approvedCandidateList",
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
				"sWidth":"50%",
				"data"  : null,
				"sClass":"alignCenter",
				"defaultContent": "<button id='btnSendMailLink' action ='btnSendMailLink' class='btn btn-primary ' style='width: 50px;'><i class='icon icon-paper-and-pencil'></i></button>"
			},
      {"sName" : "action",
				"sWidth":"50%",
				"data"  : null,
				"sClass":"alignCenter",
				"defaultContent": "<button id='btnRemoveCand' action ='btnRemoveCand' class='btn btn-warning' style='width: 50px;'><i class='fa fa-ban'></i></button>"
			}
		]
	});

  $('#sel_candidate_table tbody').on( 'click', 'button[action=btnSendMailLink]', function (event) {
		var data = table2.row($(this).parents('tr')).data();
		//console.log(data);
		$(event.target.parentNode.parentNode).addClass('success');
		$("#first_email").val(data.first_name);
		$("#last_email").val(data.last_name);
    $("#meet_email").val(data.email);
    $("#pos").val(data.position);
		$("#hidId").val(data.id);
		$("#meeting").modal('show');
	});

  
$('#sel_candidate_table tbody').on( 'click', 'button[action=btnRemoveCand]', function (event) {
var data = table2.row($(this).parents('tr')).data();
var  token = $("#_token").val();
swal({
  title: 'Remove Entry?',
  text: "",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes',
  animation: false
}).then(function() {

  $.ajax({
    url:"removeCandidate",
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
      $('#sel_candidate_table').DataTable().ajax.reload(null,false);
      } else if (result.dbStatus == 'FAILURE') {
        alert("Failed to remove Record..");
      }
    }
  });
},function(dismiss) {

}).done();
});


} );

</script>  
    
@endpush