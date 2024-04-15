<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Payment Schedule </h4>
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
                    <input type="date" name="start_date" wire:model='start_date' class="form-control" placeholder="Start Date"/>
                </div>
                <div class="col-5 col-md-5">            
                    <input type="date" name="end_date" wire:model='end_date' class="form-control" placeholder="End Date"/>
                </div>
                <div class="col-2 col-md-2">
                    <button class="btn btn-primary" type="submit">submit</button>
                </div>
            </div>
            </form>

            @if ($show == true)
              <x-exports />
            @endif

          </div>
            
          </div>
          @if ($show == true)
            
          <div class="table-responsive text-nowrap"> 
            
             
              <x-payment-schedule-table  :sort="$sort" :nationpayroll="$nationpayroll" :staffpayroll="$staffpayroll" :pension="$pension" />
           
            </div> 
            @endif

        </div>
      </div>
    </div>
</div> 
