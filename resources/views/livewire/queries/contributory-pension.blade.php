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
              <div class="col-md-3">
                <div class="table-responsive text-nowrap"> 
                  <div class="dt-buttons">
                    <x-export-printing/>
                    <x-export-excell />
                  </div>
                </div>
              </div>
               <div class="col-9">
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
