@extends('layout')

@section('title','Admin-Employee Details')

@section('content')
{{-- main content --}}
<section class="no-padding-top">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="block">
          <div class="title"><strong>Create Project Report</strong></div>
          <form action="generateDoc" class="form-horizontal" method="POST" id="myFormReport" enctype="multipart/form-data">
            @csrf
            <label class="col-sm-3 form-control-label">Create your report</label>
            <div class="col-9">
              <textarea class="ckeditor form-control" name="report" cols="30" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Generate Report</button>
          </form>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="block">
          <div class="title"><strong>Add New Project</strong></div>
          <div class="block-body">
            <form class="form-horizontal" method="POST" id="myFormProject" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="hidId" id="hidIdProj">
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">ProJect Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Project Name">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">ProJect Code</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="project_code" id="project_code" placeholder="Project Code">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Project Type</label>
                <div class="col-sm-9">
                  <div>
                    <input id="optionsRadios1" type="radio" value="Internal" name="type" id="int-status">
                    <label for="optionsRadios1">Internal</label>
                  </div>
                  <div>
                    <input id="optionsRadios2" type="radio" value="External" name="type" id="ext-status">
                    <label for="optionsRadios2">External</label>
                    <div class="form-group row" id="ifYes">
                      <label class="col-sm-3 form-control-label">Client Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="client_name" id="client-name">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- <div class="line"></div> --}}
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Languages Used</label>
                <div class="col-9 d-flex">
                  <select class="form-control col-3 mx-1 lang" name="frontend[]" id="frontend">
                    <option value='frontend' disabled selected>Frontend</option>
                    @foreach($frontend as $front)
                    <option value="{{$front->technology}}">{{$front->technology}}</option>
                    @endforeach
                  </select>
                  <select class="form-control col-3 mx-1 lang" name="backend[]" id="backend">
                    <option value='backend' disabled selected>Backend</option>
                    @foreach($backend as $back)
                    <option value="{{$back->technology}}">{{$back->technology}}</option>
                    @endforeach
                  </select>
                  <select class="form-control col-3 lang" name="others[]" id="others">
                    <option value='others' disabled selected>Others</option>
                    @foreach($others as $other)
                    <option value="{{$other->technology}}">{{$other->technology}}</option>
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-3 mt-2 form-control-label">Selected languages</label>
                <div class="col-9">
                  <textarea class="form-control mt-2" name="languages" id="languages" cols="30" rows="3" placeholder=" Selected languages"></textarea>
                </div>                
              </div>


              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Project Start date</label>
                <div class="col-sm-9">
                  <input type="date" name="start_date" class="form-control" id="proj-start">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Project End Date</label>
                <div class="col-sm-9">
                  <input type="date" name="end_date" class="form-control" id="proj-end">
                </div>
              </div>

        
              <div class="form-group row">
                <input type="hidden" name="selected-emps" id="selected-emps">
                <label class="col-sm-3 form-control-label">Member</label>
                <div class="col-sm-9 d-flex" id="newDiv">
                  <select class="form-control emp" name="member-select[]" id="member-select">
                    <option value="">Select Member</option>
                    @foreach($employees as $employee)
                    <option value="{{$employee->emp_code}}">{{$employee->emp_name}}</option>
                    @endforeach
                  </select>
                  {{-- <select class="form-control col-4 mx-1" name="member_select_hr" id="member-select-hr">
                    <option value="">Select HR</option>
                    @foreach($hrs as $hr)
                    <option value="{{$hr->hr_code}}">{{$hr->hr_name}}</option>
                    @endforeach
                  </select> --}}
                </div>
                <label class="col-sm-3 mt-2 form-control-label">Selected Members</label>
                <div class="col-9">
                  <textarea class="form-control mt-2" name="members" id="members" cols="30" rows="3" placeholder="Selected Members"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <input type="hidden" name="proj-lead" id="proj-lead">
                <input type="hidden" name="team-lead" id="team-lead">

                <label class="col-sm-3 form-control-label">Project Lead</label>
                <div class="col-sm-4">
                  <select class="form-control" name="team-lead-name" id="team-lead-name">
                    <option value='' disabled selected>Select Team Lead</option>
                  </select>
                  <small class="alert alert-warning mt-3" id="team"></small>
                </div> 
                <div class="col-sm-5">
                  <select class="form-control" name="proj-lead-name" id="proj-lead-name">
                    <option value='' disabled selected>Select Project Lead</option>
                  </select>

                  <small class="alert alert-warning mt-3" id="proj"></small>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Project Documentation</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" name="proj_doc" id="proj-docs">
                  
                </div>
              </div>

              <div id="notes" class="alert alert-success">
                <strong>Note:</strong> Please add the project document,languages,project members,project lead, and team lead before adding the project.
              </div>

              <div class="form-group row">
                <div class="col-sm-9 ml-auto">
                  <button type="submit" class="btn btn-primary" id="addProject">Add Project</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="block">
          <div class="title"><strong>All Project details</strong></div>
          <div class="table-responsive">
            <table class="table table-striped table-hover" id="projectTable">
              <thead>
                <tr>
                  <th>Sl no.</th>
                  <th>Project Name</th>
                  <th>Project Type</th>
                  <th>Client Name</th>
                  <th>Lanuages</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Member</th>
                  <th>Project Lead</th>
                  <th>Team Lead</th>
                  <th>Document</th>
                  <th>Modify</th>
                  <th>Close</th>
                </tr>
              </thead>
              <tbody>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- .add employee --}}
{{-- .main content --}}
@endsection

@push('scripts')

<script src="resources/views/js/employee_admin.js"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();

        $('#myFormClient')[0].reset();

    });
</script>

@endpush