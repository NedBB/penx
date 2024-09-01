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
                  <a href="#" onclick="extractContentForPrinting(1,'tt','{{$pvno_search}}')"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                    <span><i class="ti ti-file-export me-sm-1"></i> </span>
                    <span class="d-none d-sm-inline-block">Print</span>
                  </a>
                  <a href="#" onclick="extractSelectionforPrinting(1,5,'tt','{{$pvno_search}}',[4],2)"  id="print-selection" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
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
                  <th>Description</th>
                  <th>Transport</th>
                  <th>House All</th>
                  <th>Total Acc</th>
                  <th>Food All</th>
                  <th>Total Feeding</th>
                  <th>Outstation</th>
                  <th>Total Outstation</th>
                  <th>Sit All</th>
                  <th>Total Sitting</th>
                  <th>Total</th>
                  <th class="change">Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  @php
                    $total_house = 0;
                    $total_food = 0;
                    $total_out = 0;
                    $total_sit = 0;
                    $sum_house = 0;
                    $sum_house_all = 0;
                    $sum_transport = 0;
                    $sum_food = 0;
                    $sum_food_all = 0;
                    $sum_out = 0;
                    $sum_out_all = 0;
                    $sum_sit = 0;
                    $sum_sit_all = 0;
                    $sum_amount = 0;
                  @endphp
                  @forelse ($tts as $tt)
                    @php
                      //$total += $omni->amount;
                      $total_house = ($tt->houseallowance * $tt->ha_multiple);
                      $total_food = ($tt->foodallowance * $tt->fa_multiple);
                      $total_out = ($tt->outstationallowance * $tt->os_multiple);
                      $total_sit = ($tt->sittingallowance * $tt->sa_multiple);
                     
                      $sum_house += $tt->houseallowance;
                      $sum_house_all += $total_house; 
                      $sum_transport += $tt->transportallowance; 
                      $sum_food += $tt->foodallowance; 
                      $sum_food_all += $total_food; 
                      $sum_out += $tt->outstationallowance; 
                      $sum_out_all += $total_out; 
                      $sum_sit += $tt->sittingallowance; 
                      $sum_sit_all += $total_sit; 
                      $sum_amount += $tt->totalamount; 
                    @endphp
                      <tr wire:key='{{$tt->id}}'>
                        <td class="remove">
                          <input id="{{time()}}" type="checkbox" class="checkbox"/>
                        </td>
                        <td class="remove">
                            <span class="fw-medium">{{sqldate($tt->created_at)}}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{$tt->description}}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{format_money($tt->transportallowance)}}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{format_money($tt->houseallowance)}}</span>
                        </td>
                        <td class="text-capitalize">

                            <span class="fw-medium">{{format_money($total_house) }}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{format_money($tt->foodallowance)}}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{format_money($total_food)}}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{format_money($tt->outstationallowance)}}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{format_money($total_out)}}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{format_money($tt->sittingallowance)}}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{format_money($total_sit)}}</span>
                        </td>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{format_money($tt->totalamount)}}</span>
                        </td>
                        <td class="change">
                          <livewire:edit-anchor :record="$tt" :eventoption="$editevent" wire:key='{{time().$tt->id}}' > 
                            &nbsp;
                          {{-- <a href="#" onclick="confirm('Are you sure you want to delete {{$omni->name}} ?') ? '' : event.stopImmediatePropagation()" wire:click='delete({{$omni->id}})'>
                              <i class="fa-solid fa-trash text-danger"></i>
                            </a> --}}
                        </td>
                      </tr>
                  @empty
                      <tr><td colspan="14" class="text-center text-danger">No data exist at the moment</td></tr>
                  @endforelse
              </tbody>
              <tfoot class="footer">
                  <tr>
                      <td colspan="3" class="align-right">Total</td>
                      <td id="total_words">{{format_money($sum_transport)}}</td>
                      <td id="total_words">{{format_money($sum_house)}}</td>
                      <td id="total_words">{{format_money($sum_house_all)}}</td>
                      <td id="total_words">{{format_money($sum_food)}}</td>
                      <td id="total_words">{{format_money($sum_food_all)}}</td>
                      <td id="total_words">{{format_money($sum_out)}}</td>
                      <td id="total_words">{{format_money($sum_out_all)}}</td>
                      <td id="total_words">{{format_money($sum_sit)}}</td>
                      <td id="total_words">{{format_money($sum_sit_all)}}</td>
                      <td id="total_words">{{format_money($sum_amount)}}</td>
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

    <x-add-tant :title="$title" :data="$head_id" :heads="$heads" :records="$subheads" :fullnames="$fullnames"/>

</div>
