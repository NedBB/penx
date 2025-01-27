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
                    <a href="#" onclick="extractContentForPrinting(4,'expenditure')"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                        <span><i class="ti ti-file-export me-sm-1"></i> </span>
                        <span class="d-none d-sm-inline-block">Print</span>
                    </a>
                    <a href="#" onclick="extractSelectionforPrinting(9,10,'expenditure',null,[10],1)"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
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
            <div class="table-responsive text-nowrap" > 

                <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse; word-wrap: break-word;">
                    @php 
                        $fcount = count($columns); 
                        $footercount = $fcount - 5;
                        $count = 0; 
                        $counter = 0;
                        $x = 0;
                     @endphp
                    <thead>
                        <tr style="text-wrap: auto">
                            <th width="50px" class="noExport remove"></th>
                            
                            @foreach($columns as $th => $key)
                                <th 
                                    @if($count <= 1) width="50px"
                                    @elseif($count == 2) width="100px"
                                    @elseif($count == 3) width= "350px"
                                    @else width="400px" 
                                    @endif
                                >
                                    {{-- {!! wordwrap($th, 20, '<br>', false) !!} --}}
                                    {{$th}}
                                </th>
                                @php ++$count; @endphp
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        
                        

                        @forelse($records as $tr)
                            <tr>
                                <td class="remove text-center">
                                    <input type="checkbox" wire:model="{{time()}}">
                                </td>

                                @foreach($tr as $td)
                                    
                                    @if($counter >= 4)
                                        @php
                                            $this->processFooter($td, $x - 4);
                                        @endphp
                                    @endif
                               
                                    <td>
                                        {{-- {!! wordwrap($td, 120, '<br>', false) !!} --}}
                                        {{$td}}
                                    </td>

                                    @php ++$counter; ++$x; @endphp

                                @endforeach
                            </tr>
                            @php
                                $counter = 0; $x = 0;// Reset column counter for each row
                            @endphp
                        @empty
                            <tr>
                                <td colspan="{{ count($columns) + 1 }}" class="text-center text-danger">No record exists at the moment</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right total">Total</td>
                            @foreach ($footer as $item)
                                <td>{{format_currency($item)}}</td>
                            @endforeach
                            
                        </tr>
                    </tfoot>
                </table>
                
               
            </div> 
          @endif
        </div>
      </div>
    </div>
</div> 
