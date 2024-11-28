<x-my-modal>
     
    <div class="mb-4 modal-heading">
        <h5  class="mb-2">{{$title}}</h5>
      </div>
      @if (session('success'))
        <div class="alert alert-success" role="alert">{{session('success')}}</div>
      @endif

      @if (session('failed'))
        <div class="alert alert-danger" role="alert">{{session('failed')}}</div>
      @endif

      <form id="editUserForm" class="row g-3" wire:submit="@if($edit == false)save @else update @endif">
         
        <div class="col-12 col-md-6">
          <label class="form-label">Contractor</label>
          <select class="form-control" wire:model='contractor' name="contractor">
            <option value="">-- Select Contractor--</option>
            @foreach ($contractors as $list)
              <option value="{{$list->id}}">{{$list->fullname()}}</option>
            @endforeach
          </select> 
          <div>
              @error('contractor') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Company Name</label>
          <input
              wire:model='company_name'
              type="text"
              name="company_name"
              class="form-control" 
          /> 
          <div>
              @error('company_name') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Contract Title</label>
          <input
              wire:model='contract_title'
              type="text"
              name="contract_title"
              class="form-control" 
          /> 
              
          <div>
              @error('title') <span class="error">{{ $message }}</span> @enderror 
          </div> 
        </div>
        <div class="col-12 col-md-6">
            <label class="form-label">Cost</label>
            <input
              wire:model='cost'
              type="number"
              step="0.01"
              name="cost"
              class="form-control" 
            /> 
            <div>
                @error('cost') <span class="error">{{ $message }}</span> @enderror 
            </div> 
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Payment</label>
          <input
              wire:model='payment'
              type="number"
              step="0.01"
              name="payment"
              class="form-control"
          /> 
          <div>
              @error('payment') <span class="error">{{ $message }}</span> @enderror 
          </div> 
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Payment Date</label>
          <input
              wire:model='payment_date'
              type="date"
              name="payment_date"
              class="form-control" 
          /> 
          <div>
              @error('payment_date') <span class="error">{{ $message }}</span> @enderror 
          </div> 
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label">Start Date</label>
            <input
                wire:model='start_date'
                type="date"
                name="start_date"
                class="form-control" 
            /> 
            <div>
                @error('start_date') <span class="error">{{ $message }}</span> @enderror 
            </div> 
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Exp. Delivery Date</label>
          <input
              wire:model='expected_delivery_date'
              type="date"
              name="expected_delivery_date"
              class="form-control" 
          /> 
          <div>
              @error('expected_delivery_date') <span class="error">{{ $message }}</span> @enderror 
          </div> 
        </div>
        <div class="col-12 col-md-12">
            <label class="form-label">Description</label>
            <textarea wire:model='description' class="form-control"></textarea>
            
            <div>
                @error('description') <span class="error">{{ $message }}</span> @enderror 
            </div> 
        </div>
        
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
      </div>

      </form>
</x-my-modal>