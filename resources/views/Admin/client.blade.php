@extends('layout')

@section('title','Admin Dashboard')

@section('content')

<section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="block">
            <div class="title"><strong>Add New Client Info</strong></div>
            <div class="block-body">
              <form class="form-horizontal" method="POST" id="myFormClient" enctype="multipart/form-data" action="generatepdfclient">
                @csrf
                <input type="hidden" name="hidId" id="hidIdClient">

                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Company Name</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="fullnm" id="project_code" placeholder="Company Full Name" required>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="shortnm" id="project_code" placeholder="Company Short Name" required>
                  </div>
                </div>

                {{-- Commencement Date --}}
                 <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Commencement Date</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" name="com_date" id="com_date" placeholder="Enter date" required>
                    </div>
                  </div>

               <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Location</label>
                    <div class="col-4">
                      <select name="country" id=" country" class="form-control" required>
                        <option value="select" disabled selected>Country</option>
                        @foreach($countries as $c)
                        <option value="{{$c->nicename}}">{{$c->nicename}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="cin" id="cin" placeholder="Company Identification number">
                    </div>
                </div>

                <div class="row form-group">
                  <label class="col-sm-3 form-control-label">Full Address</label>
                  <div class="col-sm-9">
                    <textarea type="text" class="form-control" name="address" id="address" placeholder="Address"></textarea>
                  </div>
                </div>

                <div class="row form-group">
                  <label class="col-sm-3 form-control-label">Project Info</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="proj_name" id="proj_name" placeholder="Project Name">
                  </div>
                  <div class="col-sm-3">
                    <select name="proj_type" id="proj_type" class="form-control">
                      <option value="select" disabled selected>Project Type</option>
                      <option value="mobile">Mobile App</option>
                      <option value="web">Web App</option>
                      <option value="android">Android</option>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="proj_domain" id="proj_domain" placeholder="Domain">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Panels <small>(make a list)</small></label>
                  <div class="col-9">
                    <textarea class="ckeditor form-control" name="panels" cols="30" rows="10"></textarea>
                  </div>   
                </div>

                <div class="form-group row">
                   <label class="col-sm-3 form-control-label">Development Technology</label>
                   <input type="hidden" name="frontends" id="frontends">
                  <div class="col-sm-2">
                    <select name="front" id="front" class="form-control lang">
                      <option value="select" disabled selected>Front end</option>
                      @foreach($frontend as $f)
                      <option value="{{$f->technology}}">{{$f->technology}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <input type="hidden" name="backends" id="backends">
                    <select name="back" id="back" class="form-control lang">
                      <option value="select" disabled selected>Back end</option>
                      @foreach($backend as $b)
                      <option value="{{$b->technology}}">{{$b->technology}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <select name="db" id="db" class="form-control lang">
                      <option value="select" disabled selected>Database</option>
                      @foreach($dbs as $d)
                      <option value="{{$d->technology}}">{{$d->technology}}</option>
                      @endforeach
                    </select>
                  </div> 
                  <div class="col-sm-2">
                    <select name="server" id="server" class="form-control lang">
                      <option value="select" disabled selected>Server</option>
                      @foreach($servers as $s)
                      <option value="{{$s->technology}}">{{$s->technology}}</option>
                      @endforeach
                    </select>
                  </div>                    
                </div>
                {{-- .lang --}}
                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Selected languages</label>
                  <div class="col-9">
                    <textarea class="form-control mt-2" name="languages" id="languages" cols="30" rows="3" placeholder=" Selected languages"></textarea>
                  </div>   
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Future Feature</label>
                  <div class="col-9">
                    <textarea class="ckeditor form-control" name="feature" cols="30" rows="10"></textarea>
                  </div>   
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Project Schedule <small>(Enter in weeks e.g: 1st 2nd..)</small></label>
                 <div class="col-3">
                   <input type="text" name="reqanalysis" id="" class=" form-control" placeholder="Requirement Gathering & Agreement Signing">
                 </div>
                 <div class="col-3"><input type="text" name="backendarch" id="" class="form-control" placeholder="Backend Architecture"></div>
                 <div class="col-3"><input type="text" name="figdesign" id="" class="form-control" placeholder="Figma Designing"></div>
                  <div class="col-3"></div>
                 <div class="col-3  mt-3"><input type="text" name="development" id="" class="form-control" placeholder="Development"></div>
                 <div class="col-3  mt-3"><input type="text" name="testing" id="" class="form-control" placeholder="Testing"></div>
                 <div class="col-3  mt-3"><input type="text" name="final_touch" id="" class="form-control" placeholder="Final Touch & Deployment "></div>                 
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Pricing <small>(Enter amount number only)</small></label>
                 <div class="col-3">
                   <input type="text" name="p_designing" id="p_designing" class=" form-control" placeholder="Designing ">
                 </div>
                 <div class="col-3"><input type="text" name="p_development" id="p_development" class="form-control" placeholder="Development"></div>
                 <div class="col-3"><input type="text" name="p_testing" id="p_testing" class="form-control" placeholder="Unit Testing "></div>
                  <div class="col-3"></div>
                 <div class="col-3  mt-3"><input type="text" name="p_lptesting" id="p_lptesting" class="form-control" placeholder="Load & Performance Testing"></div>
                 <div class="col-3  mt-3"><input type="text" name="p_hosting" id="p_hosting" class="form-control" placeholder="Hosting, Deployment, Training"></div>
                 <div class="col-3  mt-3"><input type="text" name="total_amount" id="total_amount" class="form-control" placeholder=" = Total Amount" readonly></div>                 
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Payment T&C <small>(Enter amount number only)</small></label>
                 <div class="col-2"><input type="text" name="tc_brd" id="tc_brd" class="form-control" placeholder="After signing the BRD "></div>
                 <div class="col-2"><input type="text" name="tc_ux" id="tc_ux" class="form-control" placeholder="After completion of UX Design "></div>
                 <div class="col-2"><input type="text" name="tc_democ" id="tc_democ" class="form-control" placeholder="After a demo of 50% completion"></div>
                 <div class="col-2"><input type="text" name="tc_fdemo" id="tc_fdemo" class="form-control" placeholder="After being given the final demo"></div>        
                </div>
                <div class="form-group row">
                  <div class="col-sm-9 ml-auto">
                    <button type="submit" class="btn btn-primary" id="generatePDF">Generate Document</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="block">
            <div class="title"><strong>Information</strong></div>
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="clientTable">
                <thead>
                  <tr>
                    <th>Sl no.</th>
                    <th>Company Name</th>
                    <th>CIN</th>
                    <th>Country</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($clients as $c)
                  <?php $i = 1; ?>
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$c->company_name}}</td>
                    <td>{{$c->cin}}</td>
                    <td>{{$c->country}}</td>
                  </tr>
                  @endforeach  
                </tbody>
              </table>
            </div>
          </div>
        </div>

        {{-- mail form --}}
        <div class="col-lg-6">
          <div class="block">
            <div class="title"><strong>Send mail</strong></div>

            <form id="sendMailToClient" action="sendMailToClient" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label class="form-control-label">Enter Mail</label>
                  <input type="email" class="form-control mb-3 mb-3" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Client Mail" title="Please entervalid mail e.g: example@mail.com" name="email">
                  </select>
              </div>
              <div class="form-group">
                <label class="form-control-label">Upload Document</label>
                  <input type="file" class="form-control mb-3 mb-3" name="file" required>
              </div>
              <div class="form-group">       
                  <input type="submit" value="Send mail" class="btn btn-primary text-right">
              </div>
            </form>
            
          </div>
        </div>
      </div>
        {{-- email --}}
      </div>
    </div>
  </section>


@endsection

@push('scripts')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();

        $('#myFormClient')[0].reset();

    });
</script>
<script src="resources\views\js\admin.js"></script>
@endpush