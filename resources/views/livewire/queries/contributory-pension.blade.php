<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Contributory Pension </h4>
    <div class="card">
      
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            
          </div>
          </div>
          <div class="card-body">
            
            <div class="row mb-3">
              
               <div class="col-12">
                  <form wire:submit='search'>
                    <div class="row">
                        <div class="col-4 col-md-4">
                            
                            <select wire:model='option'
                                name="option"
                                class="form-select"
                                >
                                <option value="">Option</option>
                                @foreach($options as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-3 col-md-3">
                                
                            <select wire:model='month'
                                name="month"
                                class="form-select"
                                >
                                <option value="">Month</option>
                                @foreach($monthrange as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-3 col-md-3">
                                <select wire:model='year'
                                    name="year"
                                    class="form-select"
                                    >
                                    <option value="">Year</option>
                                    @php
                                        $reverse = array_reverse(range(1990, date('Y')));
                                    @endphp
                                    @foreach($reverse as $i)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endforeach
                                </select>                            
                        </div>
                      <div class="col-2 col-md-2">
                                <button class="btn btn-primary" type="submit">submit</button>
                                </div>
                    </div>   
                  </form>
               </div>  
               
               <div class="col-md-6 mt-2">
                <div class="table-responsive text-nowrap"> 
                  <div class="dt-buttons">
                    <a href="#" onclick="extractContentForPrinting(2,'pension')"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                      <span><i class="ti ti-file-export me-sm-1"></i> </span>
                      <span class="d-none d-sm-inline-block">Print</span>
                    </a>
                    <a href="#" onclick="extractSelectionforPrinting(3,6,'pension',null,[3,4,5],1)"  id="print" class="dt-button buttons-collection dropdown-toggle btn btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">    
                      <span><i class="ti ti-file-export me-sm-1"></i> </span>
                      <span class="d-none d-sm-inline-block">Print Selection</span>
                    </a>
                    <x-export-excell />
                  </div>
                </div>
              </div>
               
          </div>
          
          </div>
         
            
          </div>
          <div class="table-responsive text-nowrap"> 
              <x-pension-table :records="$records" :data="$data" :hide="$hide" />
          </div> 


        </div>
      </div>
    </div>
</div> 
