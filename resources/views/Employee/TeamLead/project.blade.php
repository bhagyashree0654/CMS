@extends('layout')

@section('title','Project Details')

@section('content')
<section class="no-padding-top" >
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="block">
                  <div class="title"><strong>Project Table</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped" id="teamlead-view-project">
                      <thead>
                        <tr>
                          <th>Sl. No.</th>
                          <th>Project Name</th>
                          {{-- <th>Team Memebers</th> --}}
                            {{-- <tr>
                                <td>1</td>
                            </tr> --}}
                          <th>Starting Date</th>
                          <th>End date</th>
                          <th>Days Remaining</th>
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