
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Omnibus</h4>

    <!-- DataTable with Buttons -->
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
                  <label for="dt-search-0">PVNO:</label>
                  <input type="text" wire:model.live.debounce.300ms='search' class="form-control form-control-sm" id="dt-search-0" placeholder="" aria-controls="example">
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th></th>
                  <th>Date</th>
                  <th>Group Head</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              
                  @forelse ($omnibusses as $omni)
                      <tr wire:key='{{$omni->id}}'>
                        <td><input type="checkbox" wire:model='selected' /></td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{$omni->created_at}}</span>
                            </td>
                          <td class="text-capitalize">
                          <span class="fw-medium">{{$omni->subhead->head->name}}</span>
                          </td>
                          <td>
                              <span class="fw-medium">{{$omni->description}}</span>
                          </td>
                          <td>
                              <span class="fw-medium">{{$omni->amount}}</span>
                          </td>
                          <td>
                          <livewire:edit-anchor :record="$omni" :eventoption="$editevent" wire:key='{{time().$omni->id}}' > 
                             &nbsp;
                            <a href="#" onclick="confirm('Are you sure you want to delete {{$omni->name}} ?') ? '' : event.stopImmediatePropagation()" wire:click='delete({{$omni->id}})'>
                                <i class="fa-solid fa-trash text-danger"></i>
                              </a>
                            </td>
                      </tr>
                  @empty
                      <tr><td colspan="5" class="text-center text-danger">No data exist at the moment</td></tr>
                  @endforelse
              </tbody>
            </table>
          </div>

          <div class="card-footer">
              {{$omnibusses->links()}}
          </div>
        </div>
      </div>
    </div>

    <x-add-omnibus :title="$title" :heads="$heads" :subheads="$subheads"/>

</div>