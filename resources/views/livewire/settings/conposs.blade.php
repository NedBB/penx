<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Conposs </h4>
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
                    <th>Grade Level</th>
                    <th>Step</th>
                    <th>Base Amount</th>
                    <th>Increment Rate</th>
                    <th class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($conposses as $conposs)
                    <tr wire:key='{{$conposs->id}}'>
                        <td class="text-capitalize">
                              {{$conposs->gradelevel->gradelevelname->name}} {{$conposs->gradelevel->level}}
                        </td>
                        <td class="text-capitalize">
                            {{$conposs->step}}
                        </td>
                        <td class="text-capitalize">
                          {{$conposs->baseamount}}
                        </td>
                        <td class="text-capitalize">
                          {{$conposs->incrementrate}}
                        </td>
                        <td class="text-center">
                          <livewire:edit-anchor :record="$conposs" :eventoption="$editevent" wire:key='{{time().$conposs->id}}' > 
                           &nbsp;
                        </td>
                    </tr>
                  @empty
                      <tr><td colspan="2">No data exist at the moment</td></tr>
                  @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
          {{$conposses->links()}}
      </div>
      </div>
    </div>
  </div>
  
  <x-add-conposs :title="$title" :edit=$edit :gradelevel="$gradelevel"/>

</div>

