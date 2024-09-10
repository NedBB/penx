<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Ledgers Expenditure </h4>
    <div class="card">
      
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            
          </div>
          </div>
          <div class="card-body">
            <form wire:submit='search'>
            <div class="row mb-3">
                    <div class="col-5 col-md-5">
                        <select wire:model='head_id'
                            name="head_id"
                            class="form-select"
                            >
                            <option value="">Select Head</option>
                            @foreach($heads as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                        </div>
                            <div class="col-3 col-md-3">
                                <input wire:model='start_date' class="form-control" type="date" />
                            </div>
                            <div class="col-2 col-md-2">
                                <input wire:model='end_date' class="form-control" placeholder="Start Date" type="date" />
                            </div>
                            <div class="col-1 col-md-1">
                            <button class="btn btn-primary" type="submit">submit</button>
                            </div>
                        </div>
            </form>
            @if ($show == true)
            <div class="col-sm-12 col-md-12 mt-3">
                <div class="table-responsive text-nowrap"> 
                  <div class="dt-buttons">
                    <a href="#" onclick="extractContentForPrinting(5,'expenditure')"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                        <span><i class="ti ti-file-export me-sm-1"></i> </span>
                        <span class="d-none d-sm-inline-block">Print</span>
                    </a>
                    <a href="#" onclick="extractContentForPrinting(9,10,'expenditure',null,[10],1)"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                        <span><i class="ti ti-file-export me-sm-1"></i> </span>
                        <span class="d-none d-sm-inline-block">Print Selection</span>
                    </a>
                    <x-export-excell />
                    <x-export-pdf />
                  </div>
                </div>
              </div>
            @endif 
          </div>
            
          </div>
          @if($show)
            <div class="table-responsive text-nowrap"> 

                <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse;table-layout: fixed; word-wrap:break-word;">
                    <thead>
                        <tr>
                            <th width="50px" class="noExport"></th>
                            @php $footercount = count($columns); $count @endphp
                                @foreach($columns as $th=>$key)
                
                                <th 
                                    @if($count <= 1) width = "50px"
                                    @elseif($count == 2) width="100px" 
                                    @elseif($count == 3) width="410px"
                                    @else width="200px" 
                                    @endif>
                                    {!! wordwrap($th, 20, '<br>', false)  !!}
                                </th>
                                @php ++$count @endphp
                                @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $tr)
                            <tr class=>
                                <td class="remove text-center">
                                    <input type="checkbox" wire:model='{{time()}}'> </td>
                                @foreach($tr as $td)
                                   {{-- @php 
                                      $federal_amount += $td['ALLOCATION OF FUNDS FEDERAL'];
                                      $state_amount += $td['ALLOCATION OF FUNDS STATE'];
                                      $arrear_amount +=$td['ARREARS OF ALLOCATION'];
                                      $contri_amount +=$td['CONTRIBUTION TO NLC'];
                                      $advance_amount +=$td['ADVANCE ALLOCATION'];

                                   @endphp --}}
                                    <td>
                                        {!! wordwrap($td, 120, '<br>', false)  !!}
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr><td colspan="22" class="text-center text-danger"> No record exist at the moment</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right total">Total</td>
                            <td>{{$federal_amount}}</td>
                            <td>{{$state_amount}}</td>
                            <td>{{$arrear_amount}}</td>
                            <td>{{$contri_amount}}</td>
                            <td>{{$advance_amount}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div> 
          @endif
        </div>
      </div>
    </div>
</div> 
