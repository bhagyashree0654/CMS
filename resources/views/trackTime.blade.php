@extends('layout')

@section('title','Profile')

@section('content')

<style>
 #time {
  display: flex;
  /* transition: 300ms ease-in all; */
}
#time p {
  font-size: 2em;
}
.wrapper {
  display: flex;
  justify-content: space-between;
}

</style>
<section>
    <div class="container">
      <div class="row">
        <div class="col-md-12 justify-content-lg-end">
          <div class="text-center">
            <div class="wrapper">
              <div id="time">
                <p class="t" id="hour" data-time="hour">00:</p>
                <p class="t" id="min" data-time="min">00:</p>
                <p class="t" id="sec" data-time="sec">00</p>
              </div>
              <div class="btns">
                <button id="start" class="btn btn-success">start</button>
                {{-- <button id="reset" class="btn btn-info">reset</button> --}}
                <button id="stop" class="btn btn-danger">stop</button>
              </div>
            </div>   
          </div>
          </div>
          <div class="col-12">
            <form action="" method="POST" id="addTasks">
              <div class="form-group">
                <label for="tasks">Enter the task</label>
                <input type="text" class="form-control" id="tasks" placeholder="Enter task">
              </div>
              <div class="form-group">
                <label for="projects">Project</label>
                <select class="form-control" id="projects">
                  <option value="" disabled selected>Select Project</option>
                 @foreach($projects as $project)
                  <option value="{{$project->project_code}}">{{$project->proj_name}}</option>
                 @endforeach 
                </select>

                <div class="alert alert-danger mt-2" id="alertproj" style="display: none ;"></div>
              </div>
            </form>
          </div>
        </div>    
        <div class="row">
          <h3 class="mx-3">Working hour</h3>
          <div class="col-lg-12">
            <div class="block">
              <div id="tableTimer">

                {{-- <table class="table bg-light" id="timerTbl1">
                  <thead>
                    <tr>
                      <th colspan="3"><i class="fa fa-calendar"></i> Date: <span id="calander-date"></span> </th>
                      <th colspan="4"> <i class="fa fa-edit"></i> Total Time: <span id="total-time"></span></th>
                    </tr>
                  </thead>
                  <tbody id="timerTblTbody">                       
                   
                  </tbody>
                </table> --}}

              </div>
            </div>
          </div>
        </div>     
    </div>
  </section>
  <div id="myids">

  </div>

@push('scripts')
          
@endpush
@endsection



