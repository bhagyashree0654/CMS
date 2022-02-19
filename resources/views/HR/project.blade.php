@extends('layout')

@section('title','Project Assign')

@section('content')

<section class="no-padding-top">
  <div class="container-fluid">
    <div class="row">
      <!--project assign table-->
      <div class="col-lg-13">
        <div class="block margin-bottom-sm">
          <div class="title"><strong>Project Assign</strong></div>
          <div class="table-responsive"> 
            <table class="table table-striped" id="hr-project-view-table">
              <thead>
                <tr>
                  <th>Sl No. </th>
                  <th>Employee Name</th>
                  <th>Project Name</th>
                  <th>Starting Date</th>
                  <th>End Date</th>
                  <th>Remaining Days</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      
</section>
@endsection

@push('scripts')
<script src="resources/views/js/hr.js"></script>

@endpush