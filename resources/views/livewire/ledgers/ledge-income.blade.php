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
                        <select id="select2Info" wire:model='state' name="state" class="form-select"
                            placeholder="Select States">
                            <option value="">Select States</option>
                            <option value="all">All States</option>
                            @foreach($states as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-3 col-md-3">
                        <div class="select2-info">
                          <select wire:model='report_type' name="report_type" class="form-select"
                            >
                              <option value="all">Regular</option>
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
            @if ($show == true)
            <div class="table-responsive text-nowrap"> 
              <div class="dt-buttons">
                <button  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">
                  <span><i class="ti ti-file-export me-sm-1"></i> </span>
                  <span class="d-none d-sm-inline-block">Print</span>
                </button>
                <button id="export_excel" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">
                  <span><i class="ti ti-file-export me-sm-1"></i> </span>
                  <span class="d-none d-sm-inline-block">Excel</span>
                </button>
                
              </div>
            </div>
            @endif        
        </div>
          @if($show == true)
            
                @if($view == "summarized")
                    <x-ledger-income-summarized :records="$records"/>
                @elseif($view == "detailed")
                    <x-ledger-income-detailed :records="$records"/>
                @else
                    <x-ledger-income-regular :records="$records"/>
                @endif
            </div> 
          @endif
        </div>

       
</div> 
