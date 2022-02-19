@extends('layout')

@section('title','Salary Details')
@section('content')

<!--Employee Details Table-->
<section class="no-padding-top">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 block">
        <div id="form-container" class="container">
              {{-- emp form --}}
              <div id="tab-1" class="tab-content current">
                <form name="myFormSalaryEmployee" id="myFormSalaryEmployee">
                      <input type="hidden" class="form-control tooltips" name="_token" id="_token" value="{{ csrf_token() }}"/>
                      <input type="hidden" class="form-control" id="hidId" name="hidId" aria-describedby="id">  

                  <div class="row">
                    <label class="col-12" for="salary Structure" style="font-size: 20px">Salary Structure</label> <br>
                    {{-- base --}} <br>
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Base Salary" class="form-control" id="base_salary" name="base_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Base Salary</small>
                      </div>
                    </div>

                    {{-- HRA --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="HRA" class="form-control" id="hra_salary" name="hra_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>HRA</small>                       
                      </div>
                    </div>
                    {{-- bills --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Bills" class="form-control" id="bills_salary" name="bills_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Phone and Internet Bills</small>                       
                      </div>
                    </div>
                    {{-- class --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Class referal" class="form-control" id="class_salary" name="class_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Class Allowances</small>                       
                      </div>
                    </div>
                    {{-- bomus ref --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Referral Bonus" class="form-control" id="ref_salary" name="ref_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Referral Bonus</small>                       
                      </div>
                    </div>
                    {{-- proj ref --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Project referral" class="form-control" id="proj_ref_salary" name="proj_ref_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Project referral Bonus</small>                       
                      </div>
                    </div>
                    {{-- pf --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="PF" class="form-control" id="pf_salary" name="pf_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>PF</small>
                      </div>
                    </div>
                    {{-- epf --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="EPF" class="form-control" id="epf_salary" name="epf_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>EPF</small>                       
                      </div>
                    </div>
                    {{-- total --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Total" class="form-control" id="total_salary" name="total_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Total</small>                       
                      </div>
                    </div>
                    {{-- ctc --}}
                    <div class="col-3">
                      <div class="form-group">
                        <input  type="number" placeholder="Annual CTC" class="form-control" id="ctc_salary" name="ctc_salary" required pattern="[0-9]{3,20}" title="Only numbers allowed"/>
                        <small>Annual CTC</small>                       
                      </div>
                    </div>
                    {{-- end --}}
                  </div>                 
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="addSalary">Submit</button>
                  </div>
                </form>
              </div>
        </div>
        <!-- container -->
        
{{-- end --}}
      </div>
      <div class="col-lg-12">
        <div class="block margin-bottom-sm">
          <div class="title"><strong>Salary Details</strong></div>
          <div class="table-responsive"> 
            <table class="table table-striped" id="hr-salary-table">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Employee Id</th>
                  <th>Employee Name</th>
                  <th>Base Salary</th>
                  <th>HRA</th>
                  <th>Internet & phone bills</th>
                  <th>Class Allowances</th>
                  <th>Referral Bonus</th>              
                  <th>Project Referral Bonus</th>              
                  <th>PF</th>              
                  <th>EPF</th>              
                  <th>Total</th>              
                  <th>CTC</th>              
                  <th>Edit</th>            
                </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
        <!--End Salary Details Table-->
@endsection

@push('scripts')
<script src="resources\views\js\hr.js"></script>
@endpush