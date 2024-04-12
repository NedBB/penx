<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Deductions </h4>
    <div class="card">
      
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            
          </div>
          </div>
          <div class="card-body">
            <form wire:submit='search'>
            <div class="row mb-3">
                    <div class="col-3 col-md-2">
                        
                        <select wire:model='option'
                            id="modalEditUserLanguage"
                            name="modalEditUserLanguage"
                            class="form-select"
                            >
                            <option value="">Option</option>
                            @foreach($options as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                        </select>
                        </div>
                            <div class="col-2 col-md-2">
                            
                            <select wire:model='month'
                                id="modalEditUserLanguage"
                                name="modalEditUserLanguage"
                                class="select2 form-select"
                                >
                                <option value="">Month</option>
                                @foreach($monthrange as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                            </select>
                            </div>
                            <div class="col-2 col-md-2">
                            <select wire:model='year'
                                name="year"
                                class="select2 form-select"
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
         
            {{-- <div class="row mt-5">
            
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
              </div> --}}
          </div>
            
          </div>
          <div class="table-responsive text-nowrap"> 
              <x-pension-table :records="$records" :data="$data" :hide="$hide" />
          </div> 


        </div>
      </div>
    </div>
</div> 
