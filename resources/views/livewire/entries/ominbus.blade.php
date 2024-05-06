
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"> {{$page_title}}</h4>

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
                  <a href="#" onclick="extractContentForPrinting(4,'omnibus','{{$pvno_search}}')"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                    <span><i class="ti ti-file-export me-sm-1"></i> </span>
                    <span class="d-none d-sm-inline-block">Print</span>
                  </a>
                  <a href="#" onclick="extractSelectionforPrinting(4,5,'omnibus','{{$pvno_search}}',[4],2)"  id="print-selection" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
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
                  <th class="remove">Date</th>
                  <th>Group Head</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th class="change">Action</th>
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
                          <input id="{{time()}}" type="checkbox" class="checkbox"/>
                        </td>
                        <td class="remove">
                            <span class="fw-medium">{{sqldate($omni->created_at)}}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{$omni->subhead->head->name}}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{$omni->description}}</span>
                        </td>
                        <td data-amount={{$omni->amount}} >
                            {{format_money($omni->amount)}}
                        </td>
                        <td class="change">
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
              <tfoot class="footer">
                  <tr>
                      <td colspan="4" class="align-right">Total</td>
                      <td id="total_words" data-total={{$total}}>{{format_money($total)}}</td>
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