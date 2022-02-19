@extends('layout')

@section('title','Admin Dashboard')

@section('content')
{{-- main content --}}
  <section class="no-padding-bottom">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
            <div class="block margin-bottom-sm">
              <div class="title text-center"><strong>Intern Review List</strong></div>
              <div class="table-responsive">
                <table class="table" id="internTableAdmin">
                  <thead>
                    <tr>
                      <th>Sl No.</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Phone No.</th>
                      <th>Position</th>
                      <th>CV</th>
                      <th>Approve</th> 
                      <th>Reject</th>
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

{{-- .main content --}}
@endsection

@push('scripts')
<script src="resources\views\js\admin.js"></script>
@endpush