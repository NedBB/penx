<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"> {{$page_title}}</h4>

  <!-- DataTable with Buttons -->
  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="card-header">
          <livewire:add-anchor :eventoption="$addevent">
        </div>
        <div class="row mt-2 mb-3">
          <form wire:submit='searchs' style="padding: 0 20px">
            <div class="row mb-3">
              <div class="col-2 col-md-2">
                <select wire:model='subhead_search_field'
                    name="subhead_search_field"
                    class="form-select"
                    >
                    <option value="">Subhead</option>
                     @foreach($subhead_field_lists as $list)
                          <option value="{{$list->id}}">{{$list->name}}</option>
                      @endforeach
                </select>
              </div>
              <div class="col-2 col-md-2">
                <select wire:model='month_1'
                    name="month_1"
                    class="form-select"
                    >
                    <option value="">Month 1</option>
                     @foreach($monthrange as $key => $value)
                          <option value="{{$key}}">{{$value}}</option>
                      @endforeach
                </select>
              </div>
              <div class="col-2 col-md-2">
                
                <select wire:model='year_1'
                    name="year_1"
                    class="form-select"
                    >
                    <option value="">Year 1</option>
                    @php
                      $reverse = array_reverse(range(1990, date('Y')));
                    @endphp
                    @foreach($reverse as $i)
                          <option value="{{$i}}">{{$i}}</option>
                      @endforeach
                </select>
              </div>
              <div class="col-2 col-md-2">
                
                <select wire:model='month_2'
                    name="month_2"
                    class="form-select"
                    >
                    <option value="">Month 2</option>
                    @foreach($monthrange as $key => $value)
                          <option value="{{$key}}">{{$value}}</option>
                      @endforeach
                </select>
              </div>
              <div class="col-2 col-md-2">
                <select wire:model='year_2'
                    name="year_2"
                    class="form-select"
                    >
                    <option value="">Year 2</option>
                    @php
                        $reverse = array_reverse(range(1990, date('Y')));
                    @endphp
                    @foreach($reverse as $i)
                          <option value="{{$i}}">{{$i}}</option>
                      @endforeach
                </select>
            
                
              </div>
              <div class="col-1 col-md-1">
                <button class="btn btn-primary" type="submit">submit</button>
              </div>
            </div>
          </form>
        </div>
        <div class="row mt-2">
          <div class="col-sm-12 col-md-3">
            <div class="dataTables_length">
              <label>
                Show
              <select wire:model.live='page' name="page" class="form-select">
                <option value="">All</option>
                </select> 
                Entries</label>
            </div>
          </div>
          <div class="col-md-6 mt-3">
            <div class="table-responsive text-nowrap"> 
              <div class="dt-buttons">
                <a href="#" onclick="extractContentForPrinting(12,'allocation','{{$pvno_search}}')"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                  <span><i class="ti ti-file-export me-sm-1"></i> </span>
                  <span class="d-none d-sm-inline-block">Print</span>
                </a>
                <a href="#" onclick="extractSelectionforPrintingPS(14,5,'allocation','{{$pvno_search}}',[4],2)"  id="print-selection" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                  <span><i class="ti ti-file-export me-sm-1"></i> </span>
                  <span class="d-none d-sm-inline-block">Print Selection</span>
                </a>
                <x-export-excell />
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-3 d-flex justify-content-center justify-content-md-end">
            <form wire:submit='searchrecords'>
              <div class="input-group mt-3">
                <input type="text" wire:model='pvno_search' class="form-control" placeholder="Enter PVNO">
                <button class="btn btn-primary" type="submit" id="button-addon1">Search</button>
              </div>

            </form>
          </div>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover table-bordered font-13 table-striped" id="printTable">
            <thead>
              <tr>
                <th class="remove"></th>
                <th>Date</th>
                <th class="remove">Subhead</th>
                <th>State</th>
                <th>Total Check-off</th>
                <th>Gross Pay</th>
                <th>Legal</th>
                <th>Constition</th>
                <th>Almanac</th>
                <th>Badges</th>
                <th>Advance Allocation</th>
                <th>Arrears</th>
                <th>Norther Dues</th>
                <th>Audit Fee</th>
                <th>Net Pay</th>
                <th class="change">Action</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @php
                   $total = 0;
                @endphp
                @forelse ($allocations as $list)
                     @php
                        $total += $list->netpay;
                     @endphp
                    <tr wire:key='{{$list->id}}'>
                      <td class="remove">
                        <input id="{{time()}}" type="checkbox" class="checkbox"/>
                      </td>
                      <td>
                          <span class="fw-medium">{{date5($list->created_at)}}</span>
                      </td>
                      <td class="remove">
                          <span class="fw-medium">{{$list->subhead->name}}</span>
                          <livewire:edit-anchor :record="$list" :eventoption="$editevent" wire:key='{{time().$list->id}}' class="remove" > 
                          &nbsp;
                      </td>
                      <td>
                        <span class="fw-medium">{{$list->location->name}}</span>
                    </td>
                      <td class="text-capitalize">
                          <span class="fw-medium">{{format_money($list->remittedamount)}}</span>
                      </td>
                      <td class="text-capitalize">
                          <span class="fw-medium">{{format_money($list->grosspay)}}</span>
                      </td>
                      <td class="text-capitalize">

                          <span class="fw-medium">{{format_money($list->legal) }}</span>
                      </td>
                      <td class="text-capitalize">
                          <span class="fw-medium">{{format_money($list->constitution)}}</span>
                      </td>
                      <td class="text-capitalize">
                          <span class="fw-medium">{{format_money($list->almanac)}}</span>
                      </td>
                      <td class="text-capitalize">
                          <span class="fw-medium">{{format_money($list->badges)}}</span>
                      </td>
                      <td class="text-capitalize">
                          <span class="fw-medium">{{format_money($list->advanceallocation)}}</span>
                      </td>
                      <td class="text-capitalize">
                          <span class="fw-medium">{{format_money($list->arrears)}}</span>
                      </td>
                      <td class="text-capitalize">
                          <span class="fw-medium">{{format_money($list->magazine)}}</span>
                      </td>
                      <td class="text-capitalize">
                          <span class="fw-medium">{{format_money($list->auditfee)}}</span>
                      </td>
                      <td class="text-capitalize amount">{{format_money($list->netpay)}} </td>
                      <td class="change">
                        
                        <a href="#" onclick="confirm('Are you sure you want to delete ?') ? '' : event.stopImmediatePropagation()" wire:click='delete({{$list->id}})'>
                            <i class="fa-solid fa-trash text-danger"></i>
                          </a>
                      </td>
                    </tr>
                @empty
                    <tr><td colspan="16" class="text-center text-danger">No data exist at the moment</td></tr>
                @endforelse
            </tbody>
            <tfoot class="footer">
              <tr class="total-cell">
                  <td colspan="14" class="align-right total-cell">Total</td>
                  <td id="total_words" data-total={{$total}}>{{format_money($total)}}</td>
                  <td class=""></td>
              </tr>
          </tfoot>
          </table>
        </div>

        <div class="table table-hover table-bordered font-13 table-striped">
            {{-- {{$omnibusses->links()}} --}}
        </div>
      </div>
    </div>
  </div>
{{$head_id}}
  <x-add-allocation :title="$title" :locations="$locations" :monthrange="$monthrange" :month1="$month_1" :month2="$month_2" :year2="$year_2" :year1="$year_1" :data="$head_id" :heads="$heads" :records="$subheads" :edit="$edit"/>

</div>
