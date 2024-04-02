<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> State & Parastatal </h4>
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
            
            <table class="table">
                  <thead>
                    <tr role="row">
                      <th>Name</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($states as $state)
                      <tr wire:key='{{$state->id}}'>
                          <td class="text-capitalize" style="width: 80%">
                                {{$state->name}}
                          </td>
                          <td class="text-center">

                            <livewire:edit-anchor :record="$state" :eventoption="$editevent" wire:key='{{time().$state->id}}' > 
                             &nbsp;
                            <a href="#" onclick="confirm('Are you sure you want to delete {{$state->name}} Department ?') ? '' : event.stopImmediatePropagation()" wire:click='delete({{$state->id}})'>
                                <i class="fa-solid fa-trash text-danger"></i>
                              </a>

                          </td>
                      </tr>
                    @empty
                        <tr><td colspan="2">No data exist at the moment</td></tr>
                    @endforelse
                  </tbody>
              </table>
          </div>
          <div class="card-footer">
            {{$states->links()}}
        </div>
        </div>
      </div>
    </div>
    
    <x-add-state :title="$title" :edit=$edit :state="$state"/>

</div>

