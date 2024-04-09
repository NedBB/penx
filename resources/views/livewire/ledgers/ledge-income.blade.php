<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ledgers /</span> Income </h4>
    <div class="card">
      
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            
          </div>
          </div>
          <div class="card-body">
            <form wire:submit='search'>
            <div class="row mb-3">
                    <div class="col-3 col-md-3">
                      <div class="select2-info">
                        <select id="select2Info" wire:model='state_id' name="state_id" class="select2 form-select"
                            multiple
                            placeholder="Select States">
                            <option value="all">All States</option>
                            @foreach($states as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-3 col-md-3">
                        <div class="select2-info">
                          <select wire:model='state_id' name="state_id" class="form-select"
                            >
                              <option value="">Report Type</option>
                              <option value="regular">Regular</option>
                              <option value="summarized">Summarized</option>
                              <option value="detailed">Detailed</option>
                          </select>
                        </div>
                      </div>
                    <div class="col-3 col-md-3">
                        <input wire:model='start_date' class="form-control" type="date" />
                    </div>
                    <div class="col-2 col-md-2">
                        <input wire:model='end_date' class="form-control" placeholder="Start Date" type="date" />
                    </div>
                    <div class="col-1 col-md-1">
                    <button class="btn btn-primary" type="submit">submit</button>
                    </div>
                </div>
            </form>

          </div>
            
          </div>
          @if($show)
            <div class="table-responsive text-nowrap"> 
                <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse;table-layout: fixed; word-wrap:break-word;">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Date Paid</td>
                            <td>Sender</td>
                            <td>Account</td>
                            <td>Description</td>
                            <td>Amount</td>
                            <td>Percent</td>
                            <td>Period From</td>
                            <td>Period To</td>
                            <td>Receipt No.</td>
                            <td>Total Amount</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php $bottomTotal = 0  @endphp
                        @forelse($records ?? [] as $groupname => $groupdata)
                            @foreach($groupdata->sortBy('fromdate_at') as $record)
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href='#' data-href={{route('get.ledger.query.income.receipt', $record->id)}} class='' data-target='.bs-modal-lg' data-toggle='modal'>
                                            {{date5($record->fromdate_at)}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href='#' data-href={{route('get.entry.income.edit', $record->id)}} data-target='.bs-modal-lg' data-toggle='modal'>
                                            {{$record->location->name}}
                                        </a>
                                    </td>
                                    <td>
                                        @if($record->account)
                                            {{$record->account->name}}
                                            @else
                                            None
                                        @endif
                                    </td>
                                    <td>
                                        {{$record->description}}
                                        <a href="{{route('post.entry.income.delete', $record->id)}}" class='removeIncome pull-right' >
                                            <i class='fa fa-trash text-danger'></i>
                                        </a>
                                    </td>
                                    <td> {{format_currency($record->remittedamount)}} </td>
                                    <td> {{$record->incomeperc}} </td>
                                    <td> {{date5($record->fromdate_at)}} </td>
                                    <td> {{date5($record->todate_at)}} </td>
                                    <td> {{$record->receiptno}} </td>
                                    <td> {{format_currency($record->totalincome)}} </td>
                                </tr>
                            @endforeach
                            @php $bottomTotal += $groupdata->sum('totalincome') @endphp
                        @empty
                                <tr><td colspan="11" class="text-danger text-center">No record exist at the moment</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right total">Total</td>
                           
                        </tr>
                    </tfoot>
                </table>
            </div> 
          @endif
        </div>
      </div>
    </div>
    {{-- <x-payslip :detail="$detail"/> --}}
</div> 
