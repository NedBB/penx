
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"> Omnibus</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            <livewire:add-anchor :eventoption="$addevent">
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
                  <x-export-printing/>
                  <x-export-print-selection/>
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
            <table class="table table-hover table-bordered font-13 table-striped">
              <thead>
                <tr>
                  <th class="remove"></th>
                  <th>Date</th>
                  <th>Group Head</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th class="remove">Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  @php
                    $total = 0;
                  @endphp
                  @forelse ($omnibusses as $omni)
                    @php
                      $total += $omni->amount;
                    @endphp
                      <tr wire:key='{{$omni->id}}'>
                        <td class="remove">
                          <input id="{{time()}}" type="checkbox" />
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{sqldate($omni->created_at)}}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{$omni->subhead->head->name}}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{$omni->description}}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{format_money($omni->amount)}}</span>
                        </td>
                        <td class="remove">
                          <livewire:edit-anchor :record="$omni" :eventoption="$editevent" wire:key='{{time().$omni->id}}' > 
                            &nbsp;
                          <a href="#" onclick="confirm('Are you sure you want to delete {{$omni->name}} ?') ? '' : event.stopImmediatePropagation()" wire:click='delete({{$omni->id}})'>
                              <i class="fa-solid fa-trash text-danger"></i>
                            </a>
                        </td>
                      </tr>
                  @empty
                      <tr><td colspan="6" class="text-center text-danger">No data exist at the moment</td></tr>
                  @endforelse
              </tbody>
              <tfoot>
                  <tr>
                      <td colspan="4" class="align-right">Total</td>
                      <td>{{format_money($total)}}</td>
                      <td class="remove"></td>
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

    <x-add-omnibus :title="$title" :data="$head_id" :heads="$heads" :records="$subheads"/>

</div>