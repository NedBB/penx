<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Staff Payroll </h4>
    <div class="card">
      
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            
          </div>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-3">
                <div class="table-responsive text-nowrap"> 
                  <div class="dt-buttons">
                    <x-export-printing/>
                    <x-export-excell />
                  </div>
                </div>
              </div>
              <div class="col-9 col-md-9">
                <form wire:submit='search'>
                    <div class="row mb-3">
                        <div class="col-4 col-md-4">
                            <select wire:model='option'
                                id="modalEditUserLanguage"
                                name="modalEditUserLanguage"
                                class="form-select"
                                >
                                <option value="">Option</option>
                                @foreach($options as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-3 col-md-3">
                                <select wire:model='month'
                                    id="modalEditUserLanguage"
                                    name="modalEditUserLanguage"
                                    class="form-select"
                                    >
                                    <option value="">Month</option>
                                    @foreach($monthrange as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                </select>
                        </div>
                        <div class="col-3 col-md-3">
                                <select wire:model='year'
                                    name="year"
                                    class="form-select"
                                    >
                                    <option value="">Year</option>
                                    @php
                                        $reverse = array_reverse(range(1990, date('Y')));
                                    @endphp
                                    @foreach($reverse as $i)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endforeach
                                </select>
                        </div>
                        <div class="col-2 col-md-2">
                                <button class="btn btn-primary" type="submit">submit</button>
                                </div>
                        </div>
                </form>
              </div>
            </div> 
          </div>
            
          </div>
          <div class="table-responsive text-nowrap"> 
              {{-- <x-staff-payroll-table :records="$records" :eventoption="$editevent" :count="$count" :grosspay="$grosspay"
              :salary="$salary" :rent="$rent" :meal="$meal"
              :utility="$utility" :transport="$transport" :loan="$loan"
              :entertainment="$entertainment" :contribution="$contribution"
              :salaryadvance="$salaryadvance" :pension="$pension"
              :tax="$tax" :nhf="$nhf" :deduction="$deduction"
              :netpay="$netpay"
              /> --}}


              <div class="">
                <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse;table-layout: fixed; word-wrap:break-word;">
                    <thead>
                      <tr class="bold">
                          <th width="50px"></th>
                          <th width="50px">#</th>
                          <th width="200px">Names</th>
                          <th width="150px">G.level</th>
                          <th width="80x">Step</th>
                          <th width="100px">Acct.No</th>
                          <th width="180px">Bank</th>
                          <th width="100px">Basic Salary</th>
                          <th width="100px">Rent</th>
                          <th width="100px">Transport</th>
                          <th width="100px">Meal</th>
                          <th width="100px">Util</th>
                          <th width="100px">Ent</th>
                          <th width="100px">Gross Pay</th>
                          <th width="100px">Coop</th>
                          <th width="100px">Sal. Adv</th>
                          <th width="100px">Loan</th>
                          <th width="100px">Tax</th>
                          <th width="100px">Pension</th>
                          <th width="100px">NHF</th>
                          <th width="100px">T. Deduct</th>
                          <th width="100px">Net Pay</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($records as $record)
                          @php 
                            $salary = $salary + $record->basicsalary;
                            $utility = $utility + $record->utility;
                            $entertainment= $entertainment + $record->entertainment;
                            $rent = $rent + $record->rent;
                            $contribution = $contribution + $record->contribution;
                            $transport = $meal + $record->meal;
                            $meal = $meal + $record->meal;
                            $grosspay = $grosspay + $record->grosspay;
                            $salaryadvance = $salaryadvance + $record->salaryadvance;
                            $pension = $pension + $record->pension;
                            $loan = $loan + $record->loan;
                            $tax = $tax + $record->rent;
                            $nhf = $nhf + $record->nhf;
                            $deduction = $deduction + $record->totaldeduction;
                            $netpay = $netpay + $record->netpay;
                          @endphp
                            <tr>
                                <td class="text-center"><input type="checkbox" wire:model='selectRow'></td>
                                <td>{{++$count}}</td>
                                <td>
                                    {{$record->profile->fullname()}}

                                    {{-- <livewire:edit-anchor :record="$record" :eventoption="$editevent" wire:key='{{time().$record->id}}' > 
                                         &nbsp; --}}
                                    
                                </td>
                                <td>{{$record->profile->gradelevel->gradelevelname->name.' '.$record->profile->gradelevel->level}}</td>
                                <td>{{$record->profile->step}}</td>
                                <td>{{$record->profile->accountno}}</td>
                                <td>{{($record->profile->bank) ? $record->profile->bank->name: 'UNKNOWN BANK'}}</td>
                                <td>{{format_currency($record->basicsalary)}}</td>
                                <td>{{format_currency($record->rent)}}</td>
                                <td>{{format_currency($record->transport)}}</td>
                                <td>{{format_currency($record->meal)}}</td>
                                <td>{{format_currency($record->utility)}}</td>
                                <td>{{format_currency($record->entertainment)}}</td>
                                <td>{{format_currency($record->grosspay)}}</td>
                                <td>{{format_currency($record->contribution)}}</td>
                                <td>{{format_currency($record->salaryadvance)}}</td>
                                <td>{{format_currency($record->loan)}}</td>
                                <td>{{format_currency($record->tax)}}</td>
                                <td>{{format_currency($record->pension)}}</td>
                                <td>{{$record->nhf}}</td>
                                <td>{{format_currency($record->totaldeduction)}}</td>
                                <td>{{format_currency($record->netpay)}}</td>
                            </tr>
                        @empty
                            <tr><td colspan="22" class="text-center text-danger"> No record exist at the moment</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-right"><strong>Total</strong></td>
                            <td id="total1">{{format_currency($salary)}}</td>
                            <td id="total2">{{format_currency($rent)}}</td>
                            <td id="total6">{{format_currency($transport)}}</td>
                            <td id="total7">{{format_currency($meal)}}</td>
                            <td id="total3">{{format_currency($utility)}}</td>
                            <td id="total4">{{format_currency($entertainment)}}</td>
                            <td id="total8">{{format_currency($grosspay)}}</td>
                            <td id="total5">{{format_currency($contribution)}}</td>
                            <td id="total9">{{format_currency($salaryadvance)}}</td>
                            <td id="total11">{{format_currency($loan)}}</td>
                            <td id="total12">{{format_currency($tax)}}</td>
                            <td id="tota110">{{format_currency($pension)}}</td>
                            <td id="total13">{{format_currency($nhf)}}</td>
                            <td id="total14">{{format_currency($deduction)}}</td>
                            <td id="total15">{{format_currency($netpay)}}</td>
                        </tr>
                    </tfoot>
                </table>
              </div>
          </div> 
        </div>
      </div>
    </div>
    {{-- <x-payslip :detail="$detail"/> --}}
</div> 
