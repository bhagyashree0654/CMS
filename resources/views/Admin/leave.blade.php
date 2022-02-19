@extends('layout')

@section('title','Admin Dashboard')

@section('content')
{{-- main content --}}
<section class="no-padding-top">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="block margin-bottom-sm">
          <div class="title"><strong>Leave Request Details</strong></div>
          <div class="table-responsive"> 
            <table class="table table-striped" id="admin-leave-manage">
              <thead>
                <tr>                    
                  <th>Sl no.</th>
                  <th>HR ID</th>
                  <th>Name</th>
                  <th>Leave From</th>
                  <th>Leave To</th>
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
          <div class="title"><strong>HR Leave Approved</strong></div>
          <div class="table-responsive"> 
            <table class="table table-striped" id="admin-leave-approved">
              <thead>
                <tr>                    
                  <th>Sl no.</th>
                  <th>HR ID</th>
                  <th>Name</th>
                  <th>Leave From</th>
                  <th>Leave To</th>
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

{{-- .main content --}}
@endsection

@push('scripts')
<script src="resources\views\js\admin.js"></script>
@endpush