@extends('layout')

@section('title','Project Status')

@section('content')
<section class="no-padding-top" >
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="block">
                  <div class="title"><strong>Project Table</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped" id="teamlead-view-project-updates">
                      <thead>
                        <tr>
                          <th>Sl. No.</th>
                          <th>Employee Name</th>
                          <th>Project Name</th>
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
              </div>
            </div>
        </section>
        @endsection

        
@push('scripts')

<script src="resources/views/js/teamlead.js"></script>

@endpush