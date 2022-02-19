<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            text-align: justify;
            font-size: 16px;
        }
        @page {
                margin: 0cm 0cm;
               /* margin: 220px 50px 80px 50px; */
        }
        @media print {
            section {page-break-after: always;}
            }
            @media all{
                body{
                    margin:220px 50px 80px 50px;                    
                }
            }
        body {
            /* margin-top:    3.5cm; */
            margin-bottom: 1cm;
            margin-left:   1cm;
            margin-right:  1cm;
        }
        .page-break {
            page-break-after: always;
        }
        .para1{
            justify-content: flex-start;
        }
        p{
            margin-top:2px;
            margin-bottom: 2px;
        }
        ol,ul{
            margin-left: 13px;
        }
        #watermark {
            position: fixed;
            top: 0px;
            bottom:   0px;
            left:     0px;
            width:    21cm;
            height:   29.7cm;
            /** Your watermark should be behind every content**/
            z-index:  -1000;
        }
    </style>
</head>
<body>
 <div id="watermark">
            <img src="{{ public_path('assets/img/lh.png') }}" height="100%" width="100%" />
        </div>
    <section>
        <p class="para1">
            Prepared for: <br>
            {{$companyfullname}} <br>
            Created by: <br>
            Codekart Solutions Private Limited <br>
        </p>

        <p class="indent-text">
            This Agreement (here in after referred to as the "Agreement") is made and effective at
                Bhubaneswar on {{$Commencement}} (“ the Commencement Date” ) by and between Codekart
                Solutions Pvt Ltd (CIN U72900OR2021PTC036225) a company incorporated in India
                and duly registered under the Companies Act, 2013 and having its Registered Office at
                Plot No - 504/2382/2701, Shree Residency Patia, PS- Chandrasekharpur, Bhubaneswar,
                Khordha, Orissa, India, 751024 hereinafter referred to as the “Service
                Provider/Codekart” (which expression shall, unless repugnant to the context or
                meaning thereof, shall mean to include its affiliated companies,
                subsidiary/parent/holding companies, successors in interest, administrators and
                permitted assigns) of ONE PART;
        </p>

        <p style="text-align: center;">And</p>

        <p class="indent-text">
            {{$companyfullname}}, a company registered and existing in India (CIN
                {{$cin}}) with a registered office at {{$address}}, hereinafter referred to
                as “{{$companyshortname}}” (which expression, unless repugnant to the context or meaning thereof,
                will include its representatives and executors) of the OTHER PART
        </p>

        <p style="text-transform: uppercase;">Whereas:</p>
        <p>
            <ol style="margin-left: 50px;">
                <li> {{$companyshortname}} has a need for complete IT support like developing a {{$proj_type}}
                    building for the project called <strong> {{$proj_name}} </strong>with the technologies like {{$front}},{{$back}}, etc.</li>
                <li> After the completion and delivery of the project, CodeKart has to provide IT
                    support and further phases development of this specific project.</li>
                <li> CodeKart has an interest in performing such services for {{$companyshortname}} and</li>
                <li> The parties wish to set forth the terms and conditions upon which such services will be provided to {{$companyshortname}} by CodeKart;</li>
            </ol>     
        </p>

        <p class="indent-text">
            NOW, THEREFORE, in consideration of the foregoing, and the mutual promises here in
            contained, the parties hereby agree as follows:
        </p>

    </section>
    <div class="page-break"></div>
    <section>
        <strong style="text-decoration: underline;">Basic information:</strong>
        <p>
            <ul style="list-style: circle;">
                <li><b>Project Domain:</b>  {{$proj_domain}}</li>
                <li><b>Project Format</b> {{$proj_type}}</li>
                <li><b>No. of Panel: </b>
                    {{-- <ul style="list-style: square;"> --}}
                    {!! $panels !!}
                    {{-- </ul> --}}
                </li>

                <li><b>Designing Technology:</b>Figma</li>
                <li><b>Development Technologies:</b>
                    <ul style="list-style: square;">
                        <li>Frontend:
                            <ul style="list-style: disc;">

                                <?php $front = explode(',', $front); 
                                ?>
                                @foreach($front as $frontend)
                                <li>{{$frontend}}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li>Backend:
                            <ul style="list-style: disc;">
                                <?php $back = explode(',', $back); 
                                ?>
                                @foreach($back as $backend)
                                <li>{{$backend}}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li>Database:
                            <ul style="list-style: disc;">
                                <li>{{$db}}</li>
                            </ul>
                        </li>
                        <li>Server:
                            <ul style="list-style: disc;">
                                <li>{{$server}}</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
                <li><b>Future Phases (Not Focus for 1st phase):</b> 
                    {!! $features !!}
                    {{-- <ul style="list-style: square;">
                    <li>Frontend:
                    </li>
                    <li>Server:
                       
                    </li>
                </ul> --}}
                </li>
            </ul>
        </p>
    </section>
    <div class="page-break"></div>
    <section>
        <strong style="text-decoration: underline;">Project Schedule:</strong>
        <table width="100%" style="margin-left: 30px;">
            <tr>
                <th style="text-align: left;">Task</th>
                <th>Weeks</th>
            </tr>
            <tr>
                <th style="text-align: left;"> <ul><li> Requirement Gathering & Agreement Signing </li></ul></th>
                <td>{{$reqanalysis}}</td>
            </tr>
            <tr>
                <th style="text-align: left;"><ul><li>Backend Architecture </li></ul> </th>
                <td>{{$backendarch}}</td>
            </tr>
            <tr>
                <th style="text-align: left;"><ul><li> Figma Designing</li></ul></th>
                <td>{{$figdesign}}</td>
            </tr>
            <tr >
                <th style="text-align: left;"><ul><li> Development</li></ul></th>
                <td>{{$development}}</td>
            </tr>
            <tr>
                <th style="text-align: left;"><ul><li>Testing</li></ul>  </th>
                <td>{{$testing}}</td>
            </tr>
            <tr>
                <th style="text-align: left;"><ul><li> Final Touch & Deployment</li></ul></th>
                <td>{{$final_touch}}</td>
            </tr>
        </table>

        <strong style="text-decoration: underline;">Pricing:</strong>
        <table width="100%" style="margin-left: 30px;">
            <tr>
                <th style="text-align: left;">Task</th>
                <th>Amount</th>
            </tr>
            <tr>
                <th style="text-align: left;"> <ul><li> Designing </li></ul></th>
                <td>{{$p_designing}}</td>
            </tr>
            <tr>
                <th style="text-align: left;"><ul><li>Development </li></ul> </th>
                <td>{{$p_development}}</td>
            </tr>
            <tr>
                <th style="text-align: left;"><ul><li>Unit Testing</li></ul></th>
                <td>{{$p_testing}}</td>
            </tr>
            <tr >
                <th style="text-align: left;"><ul><li> Load & Performance Testing</li></ul></th>
                <td>{{$p_lptesting}}</td>
            </tr>
            <tr>
                <th style="text-align: left;"><ul><li>Hosting, Deployment, Training</li></ul>  </th>
                <td>{{$p_hosting}}</td>
            </tr>
            <tr>
                <th style="text-align: left;"><ul><li> Total </li></ul></th>
                <td>{{$total_amount}}</td>
            </tr>
        </table>

        <strong style="text-decoration: underline;">Payment Terms & Schedule:</strong>
        <table width="100%" style="margin-left: 30px;">
            <tr>
                <th style="text-align: left;">Phases</th>
                <th>Task</th>
                <th>Amount</th>
            </tr>
            <tr>
                <th><ul><li> 1st </li></ul></th>
                <th style="text-align: left;"> After signing the BRD </th>
                <td>{{$tc_brd}}</td>
            </tr>
            <tr>
                <th><ul><li>2nd</li></ul></th>
                <th style="text-align: left;"> After completion of UX Design</th>
                <td>{{$tc_ux}}</td>
            </tr>
            <tr>
                <th><ul><li>3rd</li></ul></th>
                <th style="text-align: left;">After a demo of 50% completion</th>
                <td>{{$tc_democ}}</td>
            </tr>
            <tr>
                <th><ul><li> 4th </li></ul></th>
                <th style="text-align: left;">After being given the final demo</th>
                <td> {{$tc_fdemoc}}</td>
            </tr>
        </table>
    
        <p>
            <strong style="text-decoration: underline;">N.B:</strong>

            <ul style="margin-left: 40px;">
                <li>The client has to pay the total amounts in 4 installments.</li>
                <li> Each installment will be 25% of the total amount.</li>
                <li>Once Codekart will release the invoice then only the client has to pay the amount
                    after verifying the progress.</li>
                <li> 
                    The client has to pay the amount within 7days of raising the invoice. If the client is
                    not paying the amount, Codekart has the right to pause the work with or without
                    any notice</li>
            </ul>
        </p>
    </section>
    <div class="page-break"></div>
    <section>
        <p>
            <strong style="text-decoration: underline;">Terms and Conditions: </strong>

            <p class="m-3">
                This Contract is governed by the terms and conditions provided here and in
                Attachment A, attached hereto.
                <br>
                IN WITNESS WHEREOF, by their respective signatures below, the parties have caused
                the Contract, inclusive of Attachment A, to be duly executed and effective as of the
                Effective Date.
            </p>

            <div class="row">
                <div class="col text-start">Sender Company <br>
                    Codekart Solutions Pvt. Ltd <br> Accepted by:</div>
                <div class="col text-end">Receiver Company <br>
                    {{$companyfullname}} <br>Accepted by:</div>

                    <br>
                    <br><br>
            </div>
            <div class="row">
                <div class="col text-start">
                    <img src="{{ public_path('assets/img/sign.png') }}" alt="sign" height="50" width="200"> <img src="{{ public_path('assets/img/images.png') }}" alt="stamp" height="50" width="50">
                </div>
                <div class="col text-end">
                    <img src="" alt="sign"> <img src="" alt="stamp">
                </div>
            </div>
        </p>

        <p>
            <table width="100%" style="margin-left: 30px;">
                <tr>
                    <td style="text-align: left;">Witness</td>
                    <td>Witness</td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Name: {{$username}}</td>
                    <td> Name: </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Title: {{$position}}</td>
                    <td> Title: </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Address: PLOT NO- 504/2382/2701, Address:
                        SHREE RESIDENCY PATIA,<br>
                        PS- CHANDRASEKHARPUR,<br>
                        BHUBANESWAR Khordha OR 751024 IN <br></td>
                    <td> Address: <br></td>
                </tr>
                <tr >
                    <td style="text-align: left;">Date: {{$Commencement}}</td>
                    <td> Date: </td>
                </tr>
            </table>
        </p>
       <p>
    </section>
    <div class="page-break"></div>
        <strong style="text-decoration: underline;">Attachment A</strong>
        <br>
        <b>Contract Terms and Conditions</b>

        <ol>
            <li> <b>Intellectual Property Rights</b> 
                <ul style="list-style: disc;">
                    <li>
                    <b> Retained Rights.</b> Each party will retain all right, title, and interest in and to its own Pre‐Existing Intellectual Property
                        irrespective of any disclosure of such Pre‐Existing Intellectual Property to the other party, subject to any licenses granted
                        herein.
                    </li>
                    <li>
                        <b> Pre‐Existing Intellectual Property. </b> CodeKart will not use any CodeKart or third party Pre‐Existing Intellectual Property
                        in connection with this Contract unless CodeKart has the right to use it for Customer’s benefit. If CodeKart is not the
                        owner of such Pre‐Existing Intellectual Property, CodeKart will obtain from the owner any rights as are necessary to
                        enable CodeKart to comply with this Contract.
                    </li>
                </ul>
                <p>
                    CodeKart grants Customer a non‐exclusive, royalty‐free, worldwide, perpetual and irrevocable license in CodeKart and
                    third party Pre‐Existing Intellectual Property, to the extent such Pre‐Existing Intellectual Property is incorporated into any
                    Deliverable, with the license including the right to make, have made, sell, use, reproduce, modify, adapt, display,
                    distribute, make other versions of and disclose the property and to sublicense others to do these things.
                    CodeKart will not incorporate any materials from a third party, including Open Source or freeware, into any Deliverable
                    unless (i) CodeKart clearly identifies the specific elements of the Deliverable to contain third party materials, (ii) CodeKart
                    identifies the corresponding third party licenses and any restrictions on use thereof, and (ii) approval is given by
                    Customer in writing. CodeKart represents, warrants and covenants that CodeKart has complied and shall continue to
                    comply with all third party licenses (including all open source licenses) associated with any software components that will
                    be included in the Deliverables or any other materials supplied by CodeKart. CodeKart shall indemnify Customer against
                    any losses and liability incurred by Customer due to failure of CodeKart to meet any of the requirements in any of the
                    third party licenses.
                </p>
                <ul style="list-style: disc;">
                    <li>
                        <b> Ownership of Deliverables. </b>Subject to CodeKart and third party rights in Pre‐Existing Intellectual Property, all
                        Deliverables, whether complete or in progress, and all Intellectual Property Rights related thereto shall belong to
                        Customer, and CodeKart hereby assigns such rights to Customer. CodeKart agrees that Customer will own all patents,
                        inventor’s certificates, utility models or other rights, copyrights or trade secrets covering the Deliverables and will have full
                        rights to use the Deliverables without claim on the part of CodeKart for additional compensation and without challenge,
                        opposition or interference by CodeKart and CodeKart will, and will cause each of its Personnel to, waive their respective
                        moral rights therein. CodeKart will sign any necessary documents and will otherwise assist Customers in securing,
                        maintaining and defending copyrights or other rights to protect the Deliverables in any country.
                    </li>
                    <li>
                        <b>  No Rights to Customer Intellectual Property.</b>Except for the limited license to use materials provided by Customer as
                        may be necessary in order for CodeKart to perform Services under this Contract, CodeKart is granted no right, title, or
                        interest in any Customer Intellectual Property.
                    </li>
                </ul>
            </li>
            <li> <b>Confidentiality</b> 
                <ul style="list-style: disc;">
                    <li>
                        <b> Confidential Information.  </b>For purposes of this Contract, “Confidential Information” shall mean information or material
                        proprietary to a Party or designated as confidential by such Party (the “Disclosing Party”), as well as information about
                        which a Party (the “Receiving Party”) obtains knowledge or access, through or as a result of this Contract (including
                        information conceived, originated, discovered or developed in whole or in part by CodeKart hereunder). Confidential
                        Information does not include: a) information that is or becomes publicly known without restriction and without breach of
                        this Contract or that is generally employed by the trade at or after the time the Receiving Party first learns of such
                        information; b) generic information or knowledge which the Receiving Party would have learned in the course of similar
                        employment or work elsewhere in the trade; c) information the Receiving Party lawfully receives from a third party
                        without restriction on disclosure and without breach of a nondisclosure obligation; d) information the Receiving Party
                        rightfully knew prior to receiving such information from the Disclosing Party to the extent such knowledge was not
                        subject to restrictions on further disclosure; or (e) information the Receiving Party develops independent of any
                        information originating from the Disclosing Party.
                    </li>
                    <li>
                        <b> Customer Confidential Information.. </b> The following constitute Confidential Information of Customer and should not be
                        disclosed to third parties: the Deliverables, discoveries, ideas, concepts, software in various states of development,
                        designs, drawings, specifications, techniques, models, data, source code, source files and documentation, object code,
                        documentation, diagrams, flow charts, research, development, processes, procedures, “know-how”, marketing techniques
                        and materials, marketing and development plans, customer names and other information related to customers, price
                        lists, pricing policies and financial information, this Contract and the existence of this Contract, and any work assignments
                        authorized or issued under this Contract. CodeKart will not use Customer’s name, likeness, or logo (Customer’s “Identity”),
                        without Customer’s prior written consent, to include use or reference to Customer’s Identity, directly or indirectly, in
                        conjunction with any other clients or potential clients, any client lists, advertisements, news releases or releases to any
                        professional or trade publications.
                    </li>
                    <li>
                        <b> Non-Disclosure. </b> The Parties hereby agree that during the term hereof and at all times thereafter, and except as
                        specifically permitted herein or in a separate writing signed by the Disclosing Party, the Receiving Party shall not use,
                        commercialize or disclose Confidential Information to any person or entity. Upon termination, or at any time upon the
                        request of the Disclosing Party, the Receiving Party shall return to the Disclosing Party all Confidential Information,
                        including all notes, data, reference materials, sketches, drawings, memorandums, documentations and records which in
                        any way incorporate Confidential Information.
                    </li>
                    <li>
                        <b> Right to Disclose.</b> With respect to any information, knowledge, or data disclosed to Customer by the CodeKart, the
                        CodeKart warrants that the CodeKart has full and unrestricted right to disclose the same without incurring legal liability to
                        others, and that Customer shall have full and unrestricted right to use and publish the same as it may see fit. Any
                        restrictions on Customer’s use of any information, knowledge, or data disclosed by CodeKart must be made known to
                        Customer as soon as practicable and in any event agreed upon before the start of any work.
                    </li>
                </ul>

            </li>       
            <li> <b> Conflict of Interest</b>
                <ul style="list-style: disc;">
                    <li>
                        CodeKart represents that its execution and performance of this Contract does not conflict with or breach any contractual,
                        fiduciary or other duty or obligation to which CodeKart is bound. CodeKart shall not accept any work from Customer or
                        work from any other business organizations or entities which would create an actual or potential conflict of interest for
                        the CodeKart or which is detrimental to Customer’s business interests.                    
                    </li>
                </ul>
            </li>
            <li>
                <b>Termination</b><br> <b>Rights to Terminate</b>
                <ul style="list-style: disc;">
                    <li>Customers may terminate this Contract and/or an individual project for its convenience, without liability at any time, upon
                        prior written notice to CodeKart.</li>
                    <li>CodeKart may terminate this Contract upon thirty days prior written notice provided there are no open projects at the
                        time notice is given.</li>
                    <li>Customer may terminate this Contract and/or any open projects immediately for cause if the CodeKart fails to perform
                        any of its obligations under this Contract or if CodeKart breaches any of the warranties provided herein and fails to
                        correct such failure or breach to Customer’s reasonable satisfaction within ten (10) calendar days (unless extended by
                        Customer) following notice by Customer. Customers shall be entitled to seek and obtain all remedies available to it in law
                        or in equity.</li>
                    <li>Upon termination of any project or work given CodeKart hereunder, CodeKart will immediately provide Customer with
                        any and all work in progress or completed prior to the termination date. As Customer’s sole obligation to CodeKart
                        resulting from such termination, Customer will pay CodeKart an equitable amount as determined by Customer for the
                        partially completed work in progress and the agreed to price for the completed Services and/or Deliverables provided and
                        accepted prior to the date of termination.</li>
                    <li>Upon termination or expiration of this Contract or a project performed by CodeKart hereunder, whichever occurs first,
                        CodeKart shall promptly return to Customer all materials and or tools provided by Customer under this Contract and all
                        Confidential Information provided by Customer to CodeKart.</li>
                    <li>Any provision or clause in this Contract that, by its language or context, implies its survival shall survive any termination
                        or expiration of this Contract.</li>

                </ul>
            </li>
            <li>
                <b> Warranties</b><br> <b>CodeKart warrants that:</b>
                <ul style="list-style: disc;">
                    <li>the Services and Deliverables are original and do not infringe upon any third party’s patents, trademarks, trade secrets,
                        copyrights or other proprietary rights,</li>
                    <li>it will perform the Services hereunder in a professional and workmanlike manner,</li>
                    <li>the Deliverables CodeKart provides to Customer are new, of acceptable quality free from defects in material and
                        workmanship and will meet the requirements and conform with any specifications agreed between the parties,</li>
                    <li>it has all necessary permits and is authorized to do business in all jurisdictions where Services are to be performed,</li>
                    <li>it will comply with all applicable federal and other jurisdictional laws in performing the Services,</li>
                    <li>it has all rights to enter into this Contract and there are no impediments to CodeKart’s execution of this Contract or
                        CodeKart’s performance of Services hereunder.</li>
                </ul>
            </li>
            <li>
                <b> Limitation of Liability</b>
                <ul style="list-style: disc;">
                    <li>tExcept as set forth in this section below, in no event will either party be liable for any special, indirect, incidental, or
                        consequential damages nor for loss of data, profits or revenue, cost of capital or downtime costs, nor for any exemplary
                        or punitive damages, arising from any claim or action, incidental or collateral to, or directly or indirectly related to or in
                        any way connected with, the subject matter of the agreement, whether such damages are based on contract, tort, statute,
                        implied duties or obligations, or other legal theory, even if advised of the possibility of such damages</li>
                    <li>Notwithstanding the foregoing, any purported limitation or waiver of liability shall not apply to contractor’s obligation
                        under the indemnification or confidential information sections of this agreement or either party’s liability to the other for
                        personal injury, death or physical damage to property claims.</li>
                </ul>
            </li>
            <li>
                <b> Inspection and Acceptance</b>
                <ul style="list-style: disc;">
                    <li> Non-Conforming Services and Deliverables. If any of the Services performed or Deliverables delivered do not conform
                        to specified requirements, Customer may require the CodeKart to perform the Services again or replace or repair the
                        non-conforming Deliverables in order to bring them into full conformity with the requirements, at CodeKart’s sole cost
                        and expense. When the defects in Services and/or Deliverables cannot be corrected by re-performance, Customer may:
                        (a) require CodeKart to take necessary action, at CodeKart’s own cost and expense, to ensure that future performance
                        conforms to the requirements and/or (b) reduce any price payable under the applicable project to reflect the reduced
                        value of the Services performed and/or Deliverables delivered by CodeKart and accepted by Customer.</li>
                    <li>If CodeKart fails to promptly conform the Services and/or Deliverables to defined requirements or specifications, or take
                        action deemed by Customer to be sufficient to ensure future performance of the project in full conformity with such
                        requirements, Customer may (a) by contract or otherwise, perform the services or subcontract to another CodeKart to
                        perform the Services and reduce any price payable by an amount that is equitable under the circumstances and charge
                        the difference in re-procurement costs back to CodeKart and/or (b) terminate the project and/or this Contract for default.
                </li>
                </ul>
            </li>

            <li>
                <b>Insurance</b>
                <ul style="list-style: disc;">
                    <li> CodeKart shall maintain adequate insurance coverage and minimum coverage limits for its business as required by any
                        applicable law or regulation, including Workers’ Compensation insurance as required by any applicable law or regulation,
                        or otherwise as determined by CodeKart in its reasonable discretion. CodeKart’s lack of insurance coverage shall limit any
                        liability CodeKart may have under this Contract.
                </li>
                </ul>
            </li>

            <li>
                <b>Miscellaneous</b>
                <ul style="list-style: disc;">
                    <li><b>Assignment. </b> CodeKart shall not assign any rights of this Contract or any other written instrument related to Services
                        and/or Deliverables provided under this Contract, and no assignment shall be binding without the prior written consent
                        of Customer. Subject to the foregoing, this Contract will be binding upon the Parties’ heirs, executors, successors and
                        assigns.
                    </li>
                    <li>
                        <b>Governing Law. </b> The Parties shall make a good-faith effort to amicably settle by mutual agreement any dispute that may
                        arise between them under this Contract. The foregoing requirement will not preclude either Party from seeking injunctive
                        relief as it deems necessary to protect its own interests. This Contract will be construed and enforced in accordance with
                        the laws of the State of [State] , excluding its choice of law rules.
                    </li>
                    <li>
                        <b>Severability. </b> The Parties recognize the uncertainty of the law with respect to certain provisions of this Contract and
                        expressly stipulate that this Contract will be construed in a manner that renders its provisions valid and enforceable to
                        the maximum extent possible under applicable law. To the extent that any provisions of this Contract are determined by a
                        court of competent jurisdiction to be invalid or unenforceable, such provisions will be deleted from this Contract or
                        modified so as to make them enforceable and the validity and enforceability of the remainder of such provisions and of
                        this Contract will be unaffected.
                    </li>
                    <li>
                        <b>Independent Contractor. </b> Nothing contained in this Contract shall create an employer and employee relationship, a
                        master and servant relationship, or a principal and agent relationship between CodeKart and Customer. Customer and
                        CodeKart agree that CodeKart is, and at all times during this Contract shall remain, an independent contractor.            
                    </li>
                    <li>
                        <b>Force Majeure. </b> Neither Party shall be liable for any failure to perform under this Contract when such failure is due to
                        causes beyond that Party’s reasonable control, including, but not limited to, acts of state or governmental authorities, acts
                        of terrorism, natural catastrophe, fire, storm, flood, earthquakes, accident, and prolonged shortage of energy. In the
                        event of such delay the date of delivery or time for completion will be extended by a period of time reasonably necessary
                        by both CodeKart and Customer. If the delay remains in effect for a period in excess of thirty days, Customer may
                        terminate this Contract immediately upon written notice to CodeKart.            
                    </li>
                    <li>
                        <b> Entire Contract. </b>This document and all attached or incorporated documents contains the entire agreement between the
                        Parties and supersedes any previous understanding, commitments or agreements, oral or written. Further, this Contract
                        may not be modified, changed, or otherwise altered in any respect except by a written agreement signed by both Parties.
                    </li>

                </ul>
            </li>
        </ol>
       </p>
       
        
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>