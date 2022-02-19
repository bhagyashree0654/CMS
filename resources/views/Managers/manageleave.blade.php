@extends('layout')

@section('title','HR Leave Details')

@section('content')
{{-- main content --}}
<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row d-flex">
        <div class="col-lg-12">
            <div class="block margin-bottom-sm">
              <div class="title"><strong>Pending Leave List</strong></div>
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="pendingTbl">
                  <thead>
                    <tr>
                      <th>Sl. No.</th>
                      <th>ID</th>
                      <th>Reason</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Approve</th>
                      <th>Deny</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="block margin-bottom-sm">
              <div class="title"><strong>Approved Leave List</strong></div>
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="confirmTbl">
                  <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>ID</th>
                        <th>Reason</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Confirm</th>
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
@endsection

@push('scripts')

<script src="resources\views\js\manager.js"></script>

@endpush