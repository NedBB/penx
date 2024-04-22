
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"> Contracts</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            <livewire:add-anchor :eventoption="$addevent">
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
            <div class="col-sm-12 col-md-4 mt-3">
              <div class="table-responsive text-nowrap"> 
                <div class="dt-buttons">
                  <x-export-printing/>
                  <x-export-excell />
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
              <x-contract-table :contracts="$contracts" :editevent="$editevent"/>
          </div>

          <div class="card-footer">
              {{$contracts->links()}}
          </div>
        </div>
      </div>
    </div>

    <x-add-contract :title="$title" :edit="$edit" :contractors="$contractors"/>

</div>
