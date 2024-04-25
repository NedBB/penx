
     
   @if (!is_null($detail))
   <div class="modal fade" id="editUser" wire:ignore.self tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="p-2" style="background: #337ab7; color: #fff">
            <h4 class="modal-title text-center text-white ">Slip Preview</h4>
        </div>
      <div class="modal-content" style="padding: 0 !important">
        
        <div class="modal-body">
          <div id="printable">

            @php
                $month[1] = "January";
                $month[2] = "February";
                $month[3] = "March";
                $month[4] = "April";
                $month[5] = "May";
                $month[6] = "June";
                $month[7] = "July";
                $month[8] = "August";
                $month[9] = "September";
                $month[10] = "October";
                $month[11] = "November";
                $month[12] = "December";
            @endphp
        
        
            <div style="font-size:13px">
                <div class="text-right" style="display: inline-block; width: 7%">
                    <img class="text-center" src="{{asset('pension-logo.png')}}" style="width:3rem; margin-right: 10px">
                </div>
                <div class="text-left" style="display: inline-block; width: 60%">
                    <h4 style="font-size: 27px">{{config('app.name')}}</h4>
                </div>
                <div class="text-right" style="display: inline-block; width: 30%">
                    <h5 style="font-size:14px"> 
                        {{$month[$detail->month]}}, {{$detail->year}}- PAYSLIP 
                    </h5>
                </div>
                
                <hr>
        
                 <div class="row">
                    <div class="col-lg-12">
                        <table border="0" style="border:0; width: 100%; font-size:13px">
                            <tr>
                                <td style="width: 50%">Full Name</td>
                                 <td>{{$detail->profile->fullname()}}</td> 
                            </tr>
                            <tr>
                                <td>Staff Id</td>
                                 <td>{{$detail->profile->uniqueid}}</td> 
                            </tr>
                        <tr>
                                <td>Bank</td>
                                <td>{{$detail->profile->bank ? $detail->profile->bank->name : 'UNKNOWN'}}</td> 
                            </tr>
                            <tr>
                                <td>Accout No.</td>
                                 <td>{{$detail->profile->accountno or 'N/A'}}</td> 
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td>{{$detail->profile->dutystation->name}}</td>
                            </tr>
                             @if($detail->profile->gradelevel)
                            <tr>
                                <td>Grade Level</td>
                                <td>{{$detail->profile->gradelevel->level}}</td> 
                            </tr>
                            @endif
                            <tr>
                                <td>Step</td>
                                 <td>{{$detail->profile->step}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-lg-12">
                        <div style="display: inline-block; width: 48%">
                            <h6 class="text-uppercase">Breakdown:</h6>
                            <table class="table table-responsive table-bordered">
                                <tr>
                                    <td>Basic Salary</td>
                                    <td>{{format_currency($detail->basicsalary)}}</td>
                                </tr>
                                <tr><td>Rent</td><td>{{format_currency($detail->rent)}}</td></tr>
                                <tr><td>Transport</td><td>{{format_currency($detail->transport)}}</td></tr>
                                <tr><td>Meal</td><td>{{format_currency($detail->meal)}}</td></tr>
                                <tr><td>Utility</td><td>{{format_currency($detail->utility)}}</td></tr>
                                <tr><td>Entertainment</td><td>{{format_currency($detail->entertainment)}}</td></tr>
                                <tr><td>Gross Pay</td><td>{{format_currency($detail->grosspay)}}</td></tr>
                            </table>
                        </div>
        
                        <div style="display: inline-block; width: 50%">
                            <h6 class="text-uppercase">Deductions:</h6>
                            <table class="table table-responsive table-bordered">
                                <tr><td>Salary Advance</td><td>{{format_currency($detail->salaryadvance)}}</td></tr>
                                <tr><td>Loan</td><td>{{format_currency($detail->loan)}}</td></tr>
                                <tr><td>Tax</td><td>{{format_currency($detail->tax)}}</td></tr>
                                <tr><td>Pension</td><td>{{format_currency($detail->pension)}}</td></tr>
                                <tr><td>Contribution</td><td>{{format_currency($detail->contribution)}}</td></tr>
                                <tr><td>Total Deduction</td><td>{{format_currency($detail->totaldeduction)}}</td></tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 mt-3" style="margin-bottom: 30px">
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <td style="width:50%; font-weight: bold">Net Salary</td>
                                <td>{{format_money($detail->netpay)}}</td></tr>
                        </table>
        
                        <div class="text-center">
                             <span class="inWord"></span>
                        </div>
                    </div>
                    
                </div>
            </div>
        
            <div style="border-top:2px dashed black; margin: 30px 0"></div>
        
            <div style="font-size:13px">
                <div class="text-right" style="display: inline-block; width: 7%">
                    <img class="text-center" src="{{asset('pension-logo.png')}}" style="width:3rem">
                </div>
                <div class="text-left" style="display: inline-block; width: 60%">
                    <h4 style="font-size: 27px">{{config('app.name')}}</h4>
                </div>
                <div class="text-right" style="display: inline-block; width: 30%">
                    <h5 style="font-size:14px"> 
                        {{$month[$detail->month]}}, {{$detail->year}}- PAYSLIP 
                    </h5>
                </div>
                
                <hr>
        
                <div class="row">
                    <div class="col-lg-12">
                        <table border="0" style="border:0; width: 100%; font-size:13px">
                            <tr>
                                <td style="width: 50%">Full Name</td>
                                <td>{{$detail->profile->fullname()}}</td> 
                            </tr>
                            <tr>
                                <td>Staff Id</td>
                                <td>{{$detail->profile->uniqueid}}</td>
                            </tr>
                            <tr>
                                <td>Bank</td>
                                <td>{{$detail->profile->bank ? $detail->profile->bank->name: 'UNKNOWN'}}</td>
                            </tr>
                            <tr>
                                <td>Accout No.</td>
                                <td>{{$detail->profile->accountno ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td>{{$detail->profile->dutystation->name}}</td>
                            </tr>
                            @if($detail->profile->gradelevel)
                            <tr>
                                <td>Grade Level</td>
                                <td>{{$detail->profile->gradelevel->level}}</td>
                            </tr>
                            @endif
                            <tr>
                                <td>Step</td>
                                <td>{{$detail->profile->step}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-lg-12">
                        <div style="display: inline-block; width: 48%">
                            <h6 class="text-uppercase">Breakdown:</h6>
                            <table class="table table-responsive table-bordered">
                                <tr>
                                    <td>Basic Salary</td>
                                    <td>{{format_currency($detail->basicsalary)}}</td>
                                </tr>
                                <tr><td>Rent</td><td>{{format_currency($detail->rent)}}</td></tr>
                                <tr><td>Transport</td><td>{{format_currency($detail->transport)}}</td></tr>
                                <tr><td>Meal</td><td>{{format_currency($detail->meal)}}</td></tr>
                                <tr><td>Utility</td><td>{{format_currency($detail->utility)}}</td></tr>
                                <tr><td>Entertainment</td><td>{{format_currency($detail->entertainment)}}</td></tr>
                                <tr><td>Gross Pay</td><td>{{format_currency($detail->grosspay)}}</td></tr>
                            </table>
                        </div>
        
                        <div style="display: inline-block; width: 50%">
                            <h6 class="text-uppercase">Deductions:</h6>
                            <table class="table table-responsive table-bordered">
                                <tr><td>Salary Advance</td><td>{{format_currency($detail->salaryadvance)}}</td></tr>
                                <tr><td>Loan</td><td>{{format_currency($detail->loan)}}</td></tr>
                                <tr><td>Tax</td><td>{{format_currency($detail->tax)}}</td></tr> 
                                <tr><td>Pension</td><td>{{format_currency($detail->pension)}}</td></tr>
                                <tr><td>Contribution</td><td>{{format_currency($detail->contribution)}}</td></tr>
                                <tr><td>Total Deduction</td><td>{{format_currency($detail->totaldeduction)}}</td></tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 mt-3" style="margin-bottom: 30px">
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <td style="width:50%; font-weight: bold">Net Salary</td>
                                <td>{{format_money($detail->netpay)}}</td></tr>
                        </table>
    
                        <div class="text-center">
                             <span class="inWord"></span>
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            <button class="btn btn-primary edit-national text-white print" id="slip">Print</button>
        </div>
        </div>
      </div>
    </div>
  </div>    


   
    @endif  


