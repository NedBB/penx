
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
            <form wire:submit='searchs' style="padding: 0 100px">
              <div class="row mb-3">
                <div class="col-3 col-md-3">
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
                <div class="col-3 col-md-3">
                  
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
          <div class="row mt-2 mb-3">
            <div class="col-sm-12 col-md-4">
              <div class="dataTables_length">
                <label>
                  Show
                <select name="" class="form-select">
                  <option value="">All</option>
                  </select> 
                  Entries</label>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 mt-3">
              <div class="table-responsive text-nowrap"> 
                <div class="dt-buttons">
                  <a href="#" onclick="extractContentForPrinting(2,'loan')"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                    <span><i class="ti ti-file-export me-sm-1"></i> </span>
                    <span class="d-none d-sm-inline-block">Print</span>
                  </a>
                  <a href="#" onclick="extractSelectionforPrinting(3,null,'loans',null,[3,5,6],1)"  id="print-selection" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                    <span><i class="ti ti-file-export me-sm-1"></i> </span>
                    <span class="d-none d-sm-inline-block">Print Selection</span>
                  </a>
                  <x-export-pdf />
                </div>
              </div>
            </div>
            {{-- <div class="col-sm-12 col-md-4 d-flex justify-content-center justify-content-md-end">
              <div class="dataTables_filter">
                <div class="dt-search">
                  <label for="dt-search-0">PVNO:</label>
                  <input type="text" wire:model.live.debounce.300ms='search' class="form-control form-control-sm" id="dt-search-0" placeholder="" aria-controls="example">
                </div>
              </div>
            </div> --}}
          </div>
          <div class="table-responsive text-nowrap">
              <x-entry-loan-table :loans="$loans" :editevent="$editevent"/>
          </div>

          <div class="card-footer">
              {{-- {{$loans->links()}} --}}
          </div>
        </div>
      </div>
    </div>

    <x-add-entry-loan :title="$title" :edit="$edit" :data="$profileoption" :records="$profiledata" :loantypes="$loantypes"/>

</div>