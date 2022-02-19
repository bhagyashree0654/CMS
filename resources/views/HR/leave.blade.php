@extends('layout')

@section('title','HR Dashboard')

@section('content')

<!--Employee Leave Request Table-->
<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="block margin-bottom-sm">
            <div class="title"><strong>Leave Request Details</strong></div>
            <div class="table-responsive"> 
              <table class="table table-striped" id="hr-leave-manage">
                <thead>
                  <tr>                    
                    <th>Sl no.</th>
                    <th>Emp. ID</th>
                    <th>Leave From</th>
                    <th>To Date</th>
                    <th>Reason</th>
                    <th>Approve</th>
                    <th>Deny</th>  
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="block margin-bottom-sm">
            <div class="title"><strong>Employee Leave Approved</strong></div>
            <div class="table-responsive"> 
              <table class="table table-striped" id="hr-leave-approved">
                <thead>
                  <tr>                    
                    <th>Sl no.</th>
                    <th>Emp. ID</th>
                    <th>Leave From</th>
                    <th>To Date</th>
                    <th>Reason</th>
                    <th>Update</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>


@endsection

@push('scripts')

<script src="resources/views/js/hr.js"></script>

@endpush