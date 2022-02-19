@extends('layout')

@section('title','Admin Dashboard')

@section('content')
{{-- main content --}}
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
          <div class="statistic-block block">
            <div
              class="
                progress-details
                d-flex
                align-items-end
                justify-content-between
              "
            >
              <div class="title">
                <div class="icon"><i class="icon-user-1"></i></div>
                <strong>Clients</strong>
              </div>
              <div class="number dashtext-1" id="newClients"> </div>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="statistic-block block">
            <div
              class="
                progress-details
                d-flex
                align-items-end
                justify-content-between
              "
            >
              <div class="title">
                <div class="icon"><i class="icon-contract"></i></div>
                <strong>Ongoing Projects</strong>
              </div>
              <div class="number dashtext-2" id="newProject"> </div>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="statistic-block block">
            <div
              class="
                progress-details
                d-flex
                align-items-end
                justify-content-between
              "
            >
              <div class="title">
                <div class="icon">
                  <i class="icon-writing-whiteboard"></i>
                </div>
                <strong>All Projects</strong>
              </div>
              <div class="number dashtext-4" id="allProject"> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="no-padding-bottom">
    <div class="container-fluid">
      <div class="row row-eq-height">
        <div class="col-lg-4 equal-card">
          <div class="messages-block block">
            <div class="title"><strong>Active Employee</strong></div>
            <div class="messages" id="activeEmp">

              @if($actives->count() <= 0)
              <p class="alert alert-danger">No Active Employee..</p>
              @endif

              @foreach ($actives as $active)

              <a href="#?" class="message d-flex align-items-center">
                <div class="profile">

                  @if($active->hr_photo == null)
                    <img src="public/assets/img/staff.jpg" alt="..." class="img-fluid" style="background-color: #fff;">
                  @else
                  <img src="public/members/employees/{{$active->hr_photo}}" alt="employee" class="img-fluid"/>
                  @endif

                  <div class="status online"></div>
                </div>
                <div class="content">
                  <strong class="d-block">{{$active->hr_name}}</strong>
                  <span class="d-block">{{$active->hr_code}}</span>
                  <small class="date d-block">{{ date('H:i A', strtotime($active->log_time))}}</small>
                 
                </div>
              </a>

              @endforeach
              
            </div>
          </div>
        </div>
        <div class="col-lg-4 equal-card">
          <div class="messages-block block">
            <div class="title"><strong>Inactive Employee</strong></div>
            <div class="messages" id="inactiveEmp">
              @if($inactives->count() <= 0)
              <p class="alert alert-danger">No inactive employee..</p>
              @endif
              @foreach ($inactives as $iactive)

              <a href="#?" class="message d-flex align-items-center">
                <div class="profile">

                  @if($iactive->hr_photo == null)
                    <img src="public/assets/img/staff.jpg" alt="..." class="img-fluid" style="background-color: #fff;">
                  @else
                  <img src="public/members/employees/{{$iactive->hr_photo}}" alt="employee" class="img-fluid"/>
                  @endif

                  <div class="status busy"></div>
                </div>
                <div class="content">
                  <strong class="d-block">{{$iactive->hr_name}}</strong>
                  <span class="d-block">{{$iactive->hr_code}}</span>
                  <small class="date d-block">{{ date('H:i A', strtotime($iactive->log_time))}}</small>
                 
                </div>
              </a>

              @endforeach
            </div>
          </div>
        </div>
        <div class="col-lg-4 equal-card">
          <div class="messages-block block">
            <div class="title"><strong>Employee on Leave</strong></div>
            <div class="messages" id="leaveEmp"> 
              @if($leaves->count() <= 0)
              <p class="alert alert-danger">No leave employee..</p>
              @endif
              @foreach ($leaves as $leave)
              
              <a href="#?" class="message d-flex align-items-center">
                <div class="profile">

                  @if($leave->hr_photo == null)
                    <img src="public/assets/img/staff.jpg" alt="..." class="img-fluid" style="background-color: #fff;">
                  @else
                  <img src="public/members/employees/{{$leave->hr_photo}}" alt="employee" class="img-fluid"/>
                  @endif

                  <div class="status away"></div>
                </div>
                <div class="content">
                  <strong class="d-block">{{$leave->hr_name}}</strong>
                  <span class="d-block">{{$leave->hr_code}}</span>
                  <small class="date d-block">{{ date('H:i A', strtotime($leave->log_time))}}</small>
                 
                </div>
              </a>
              @endforeach
            </div>
          </div>
        </div>
      </div>  

      <style>
        .messages-block::-webkit-scrollbar {
        width: 9px;
        height: 5px;
        }
        .messages-block::-webkit-scrollbar-track {
        background-color: #d6d4d4;
        }
        .messages-block::-webkit-scrollbar-thumb {
        background: #d6d4d4;
        border-radius: 5px;
        transition: 0.5s;
        }
        .messages-block::-webkit-scrollbar-thumb:hover {
        background: #686767;
        transition: 0.5s;
        }
        .messages-block {
         height: 400px;
         overflow-x: hidden;
         overflow-y: scroll;
        }
      </style>
      {{-- <div class="row row-eq-height">
        <div class="col-lg-12">
          <div class="block margin-bottom-sm">
            <div class="title"><strong>Updates of Projects By HR</strong></div>
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="hr-updates-on-project">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>HR Name</th>
                    <th>Date</th>
                    <th>Updates</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody>

                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
  </section>
{{-- .main content --}}
@endsection

@push('scripts')

<script src="resources/views/js/admin.js"></script>
{{-- <script src="public/js/employee-custom-graph.js"></script> --}}
@endpush