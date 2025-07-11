<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"> {{$page_title}} </h4>
    <div class="card">
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            <livewire:add-anchor :eventoption="$addevent">
          </div>
          <div class="row mt-2">
            <div class="col-sm-12 col-md-4">
              <div class="dataTables_length">
                <label>
                  Show
                <select wire:model.live='perpage' name="perpage" class="form-select">
                  <option value="">All</option>
                  </select> 
                  Entries</label>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 mt-3">
              <div class="table-responsive text-nowrap"> 
                <div class="dt-buttons">
                  <a href="#" onclick="extractContentForPrinting(2,'plain')"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                    <span><i class="ti ti-file-export me-sm-1"></i> </span>
                    <span class="d-none d-sm-inline-block">Print</span>
                  </a>
                  <x-export-excell />
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-4 d-flex justify-content-center justify-content-md-end">
              <div class="dataTables_filter">
                <div class="dt-search">
                  <label for="dt-search-0">Search:</label>
                  <input type="text" wire:model.live.debounce.300ms='search' class="form-control form-control-sm" id="dt-search-0" placeholder="" aria-controls="example">
                </div>
              </div>
            </div>
          </div>

          <div class="table-responsive text-nowrap">
            <table class="table table-hover table-bordered font-13 table-striped">
              <thead>
                <tr>
                  <th>Unique ID</th>
                  <th>Surname</th>
                  <th>Firstname</th>
                  <th>Middlename</th>
                  <th>Status</th>
                  <th>Position</th>
                  <th>Account No</th>
                  <th>Basic Salary [₦]</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              
                  @forelse ($officers as $list)
                      <tr wire:key='{{$list->id}}' @if($list->active) class="text-danger" @endif>
                        <td>
                            {{$list->uniqueid}} &nbsp;
                            <livewire:edit-anchor :record="$list" :eventoption="$editevent" wire:key='{{time().$list->id}}' /> 
                            
                        </td>
                         <td class="text-capitalize">
                            {{$list->surname}}
                            </td>
                          <td class="text-capitalize">
                            {{$list->firstname}}
                          </td>
                          <td class="text-capitalize">
                            {{$list->middlename}}
                          </td>
                          <td>
                            {{($list->active) ? "Active" : "Disabled"}}
                          </td>
                          <td class="text-capitalize">
                            {{is_null($list->dutystation)? "N/A" : $list->dutystation->name}}
                          </td>
                          <td class="text-capitalize">
                            {{$list->accountno}}
                          </td>
                          <td class="text-capitalize">
                            {{$list->basicsalary}}
                          </td>
                      </tr>
                  @empty
                      <tr><td colspan="5" class="text-center text-danger">No data exist at the moment</td></tr>
                  @endforelse
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            {{-- {{$officers->links()}} --}}
        </div>
        </div>
      </div>
    </div>
    
    <x-add-national-officer :title="$title" :edit="$edit" :titles="$titles" :dutystations="$dutystations" :payments="$payments" :banks="$banks"/>



</div>