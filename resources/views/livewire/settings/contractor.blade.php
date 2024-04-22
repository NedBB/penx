<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Contractor </h4>
    <div class="card">
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            <livewire:add-anchor :eventoption="$addevent">
          </div>
          <div class="row mt-2">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length">
                <label>
                  Show
                <select wire:model.live='perpage' name="perpage" class="form-select">
                  <option value="5">5</option>
                  <option value="7">7</option>
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  </select> 
                  Entries</label>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
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
                    <tr role="row">
                      <th>Unique ID</th>
                      <th>Fullname</th>
                      <th>Address</th>
                      <th>Account No</th>
                      <th>Account Name</th>
                      <th>Bank</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($contractors as $contractor)
                      <tr wire:key='{{$contractor->id}}'>
                          <td class="text-capitalize">
                                {{$contractor->number}}
                          </td>
                          <td class="text-capitalize">
                              {{$contractor->fullname()}}
                          </td>
                          <td class="text-capitalize">
                            {{$contractor->address}}
                          </td>
                          <td class="text-capitalize">
                            {{$contractor->account_no}}
                          </td>
                          <td class="text-capitalize">
                            {{$contractor->account_name}}
                          </td>
                          <td class="text-capitalize">
                            {{$contractor->bank->name}}
                          </td>
                          <td class="text-center">
                            <livewire:edit-anchor :record="$contractor" :eventoption="$editevent" wire:key='{{time().$contractor->id}}' > 
                             &nbsp;
                          </td>
                      </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-danger">No data exist at the moment</td></tr>
                    @endforelse
                  </tbody>
              </table>
          </div>
          <div class="card-footer">
            {{$contractors->links()}}
        </div>
        </div>
      </div>
    </div>
    
    <x-add-contractor :title="$title" :edit="$edit" :banks="$banks" :titles="$titles"/>
  
  </div>
  
  