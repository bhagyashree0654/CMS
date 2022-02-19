@extends('layout')

@section('title','Employee Details')

@section('content')

<!--Employee Details Table-->
<style>
    /*----------------genealogy-scroll----------*/

.genealogy-scroll::-webkit-scrollbar {
width: 5px;
height: 8px;
}
.genealogy-scroll::-webkit-scrollbar-track {
border-radius: 10px;
background-color: #e4e4e4;
}
.genealogy-scroll::-webkit-scrollbar-thumb {
background: #212121;
border-radius: 10px;
transition: 0.5s;
}
.genealogy-scroll::-webkit-scrollbar-thumb:hover {
background: #d5b14c;
transition: 0.5s;
}


/*----------------employee-tree----------*/
.genealogy-body{
white-space: nowrap;
overflow-y: hidden;
padding: 50px;
min-height: 500px;
padding-top: 10px;
}
.employee-tree ul {
padding-top: 20px; 
position: relative;
padding-left: 0px;
display: flex;
}
.employee-tree li {
float: left; text-align: center;
list-style-type: none;
position: relative;
padding: 20px 5px 0 5px;
}
.employee-tree li::before, .employee-tree li::after{
content: '';
position: absolute; 
top: 0; 
right: 50%;
border-top: 2px solid #ccc;
width: 50%; 
height: 18px;
}
.employee-tree li::after{
right: auto; left: 50%;
border-left: 2px solid #ccc;
}
.employee-tree li:only-child::after, .employee-tree li:only-child::before {
display: none;
}
.employee-tree li:only-child{ 
padding-top: 0;
}
.employee-tree li:first-child::before, .employee-tree li:last-child::after{
border: 0 none;
}
.employee-tree li:last-child::before{
border-right: 2px solid #ccc;
border-radius: 0 5px 0 0;
-webkit-border-radius: 0 5px 0 0;
-moz-border-radius: 0 5px 0 0;
}
.employee-tree li:first-child::after{
border-radius: 5px 0 0 0;
-webkit-border-radius: 5px 0 0 0;
-moz-border-radius: 5px 0 0 0;
}
.employee-tree ul ul::before{
content: '';
position: absolute; top: 0; left: 50%;
border-left: 2px solid #ccc;
width: 0; height: 20px;
}
.employee-tree li a{
text-decoration: none;
color: #666;
font-family: arial, verdana, tahoma;
font-size: 11px;
display: inline-block;
border-radius: 5px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
}

.employee-tree li a:hover+ul li::after, 
.employee-tree li a:hover+ul li::before, 
.employee-tree li a:hover+ul::before, 
.employee-tree li a:hover+ul ul::before{
border-color:  #fbba00;
}

/*--------------memeber-card-design----------*/
.member-view-box{
    width: 100%;
padding:0px 40px;
text-align: center;
border-radius: 4px;
position: relative;
}
.member-details h3{
    font-size: 14px;
    font-weight: 600;
    margin: 0;
    padding: 5px 0 0 0;
    color: rgb(146, 144, 144);
}
.member-details p{
    margin: 0;
    padding: 0 0 5px 0;
    font-size: 12px;
    color: rgb(250, 250, 250);
}
.member-image{
width: 70px;
position: relative;
}
.member-image img{
width: 80px;
height: 80px;
border-radius: 6px;
background-color :#fff;
z-index: 1;
}
</style>
<section class="no-padding-top">
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="body genealogy-body genealogy-scroll">
                <div class="employee-tree">
                    <ul>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="member-view-box">
                                    <div class="member-image">
                                        <img src="public/assets/img/logo-white-bg.png" alt="logo">
                                        <div class="member-details">
                                            <h3 class="box">Codekart Management Team</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="active">
                                @foreach ($admin as $adm)
                                <li>
                                    <a href="#?" data-toggle="modal" data-target="#leavemodal">
                                        <div class="member-view-box">
                                            <div class="member-image">
                                                <img src="https://image.shutterstock.com/image-vector/businessman-icon-260nw-564112600.jpg" alt="Member" >
                                                <div class="member-details">
                                                    <h3>{{$adm->admin_name}}</h3>
                                                    <p>{{$adm->position}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <ul class="active">
                                        {{-- @if(count($management_team)>0)) --}}
                                        @foreach ($management_team as $mt)
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="member-view-box">
                                                    <div class="member-image">
                                                        <img src="https://image.shutterstock.com/image-vector/businessman-icon-260nw-564112600.jpg" alt="Member">
                                                        <div class="member-details">
                                                            <h3>{{$mt->mng_name}}</h3>
                                                            <p>{{$mt->position}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <ul>
                                                @foreach ($managers as $m)
                                                @if ($m->mng_head == $mt->mng_code)
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <div class="member-view-box">
                                                            <div class="member-image">
                                                                <img src="https://image.shutterstock.com/image-vector/businessman-icon-260nw-564112600.jpg" alt="Member">
                                                                <div class="member-details">
                                                                    <h3>{{$m->mngr_name}}</h3>
                                                                    <p>{{$m->position}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <ul>
                                                        @foreach ($hrs as $hr)
                                                        @if ($hr->mng_head == $m->mngr_code)
                                                        <li>
                                                            <a href="javascript:void(0);">
                                                                <div class="member-view-box">
                                                                    <div class="member-image">
                                                                        <img src="https://image.shutterstock.com/image-vector/businessman-icon-260nw-564112600.jpg" alt="Member">
                                                                        <div class="member-details">
                                                                            <h3>{{$hr->hr_name}}</h3>
                                                                            <p>{{$hr->hr_type}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <ul>
                                                                @foreach($proj_leads as $pl)
                                                                @if($pl->hr_code == $hr->hr_code)
                                                                <li>
                                                                    <a href="javascript:void(0);">
                                                                        <div class="member-view-box">
                                                                            <div class="member-image">
                                                                                <img src="https://image.shutterstock.com/image-vector/businessman-icon-260nw-564112600.jpg" alt="Member">
                                                                                <div class="member-details">
                                                                                    <h3>{{$pl->emp_name}}</h3>
                                                                                    <h3>Proj lead</h3>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <ul>
                                                                        @foreach($team_leads as $tls)
                                                                        @if($tls->proj_lead_code == $pl->emp_code)
                                                                        <li>
                                                                            <a href="javascript:void(0);">
                                                                                <div class="member-view-box">
                                                                                    <div class="member-image">
                                                                                        <img src="https://image.shutterstock.com/image-vector/businessman-icon-260nw-564112600.jpg" alt="Member">
                                                                                        <div class="member-details">
                                                                                            <h3>{{$tls->emp_name}}</h3>
                                                                                            <p>Team lead</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <ul>
                                                                                @foreach($emps as $emp)
                                                                                @if($emp->team_lead_code == $tls->emp_code)
                                                                                <li>
                                                                                    <a href="javascript:void(0);">
                                                                                        <div class="member-view-box">
                                                                                            <div class="member-image">
                                                                                                <img src="https://image.shutterstock.com/image-vector/businessman-icon-260nw-564112600.jpg" alt="Member">
                                                                                                <div class="member-details">
                                                                                                    <h3>{{$emp->emp_name}}</h3>
                                                                                                    <p>Team Member</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </a>
                                                                                </li>
                                                                                @endif
                                                                                @endforeach                                                                      
                                                                            </ul>
                                                                        </li>
                                                                        @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                                @endif
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
        
                                @foreach ($management as $mngmt)
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="member-view-box">
                                            <div class="member-image">
                                                <img src="public/assets/img/staff.jpg" alt="Member">
                                                <div class="member-details">
                                                    <h3>{{$mngmt->admin_name}}</h3>
                                                    <p>{{$mngmt->position}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>   
                                @endforeach
        
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
                {{--end section  --}}
     </div>
    </div>
  </div>
</section>

{{-- profmodal --}}
<!-- Modal -->
<div class="modal fade" id="leavemodal" tabindex="-1" role="dialog" aria-labelledby="leavemodalexmpl" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="leavemodalexmpl">Leave Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="leave-emp-app">
            @csrf
            <div class="form-group">
              <label for="fromdate">Take Leave From</label>
              <input type="date" class="form-control" id="startDate" name="startDate" aria-describedby="date" placeholder="Enter date" required>
              <span id="datealert" class="text-warning"></span>
            </div>
            <div class="form-group">
              <label for="todate">To</label>
              <input type="date" class="form-control" id="endDate" name="endDate" placeholder="Enter date" required>
              <span id="datealert1" class="text-warning"></span>
            </div>
            <div class="form-group">
              <textarea name="lvreason" class="form-control" id="lvreason" cols="40" rows="8" placeholder="Enter leave reason"></textarea>
              <span id="reasonalert" class="text-danger"></span>
            </div>
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')

{{-- <script src="resources\views\js\hr.js"></script> --}}
<script>
    $(function () {
        $('.employee-tree ul').hide();
        $('.employee-tree>ul').show();
        $('.employee-tree ul.active').show();
        $('.employee-tree li').on('click', function (e) {
            var children = $(this).find('> ul');
            if (children.is(":visible")) children.hide('fast').removeClass('active');
            else
            {
                if(children.has('li').length > 0)
                {
                    // defined
                    children.show('fast').addClass('active');
                }
                else{
                    children.hide('fast').removeClass('active');
                }
            }
            e.stopPropagation();
        });
    });
    </script>
@endpush
