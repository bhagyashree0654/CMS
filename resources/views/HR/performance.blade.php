@extends('layout')

@section('title','Employee Performnce')

@section('content')
{{-- main content --}}
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-7" display='flex'>
        <div class="block margin-bottom-sm">
          <div class="title">
          </div>
          <div class="table-responsive">
            <table class="table table-striped" id="emp-performance-tbl">
              <thead>
                <tr>
                  <th>Sl no</th>
                  <th>Username</th>
                  <th>Employee Name</th>
                  <th>Total Time</th>
                  <th>View Report</th>
                </tr>
              </thead>
              <tbody id="emp-performance-tbl-tbody">
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="bar-chart chart block">
          <div class="title"><strong id="dynamic_empname">Employee Performance Chart</strong></div>
          <div class="bar-chart chart margin-bottom-sm">
            <canvas id="emp-performance"></canvas>
            <div class="alert alert-warning" role="alert" id="myalert">
              Data not available
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- .main content --}}
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script src="resources/views/js/hr.js"></script>
@endpush