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
          @php
            $profileoption = "profile";
            $profile_list = "profile_id"
          @endphp
        <div class="col-12 col-md-6">
          <label class="form-label">Profile</label>
          <livewire:selection-change :records='$data' :name="$profileoption">
          <div>
              @error('profile') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Profile</label>
          <livewire:selection-update :records='$records' :name="$profile_list">
          <div>
              @error('profile_id') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Loan Type</label>
          <select class="form-control" wire:model='loantype_id' name="loantype_id" name="record_id" @change="$dispatch('getInterest',{'value': $event.target.value})">
            <option value="">-- Select Loantype--</option>
            @foreach ($loantypes as $loan)
              <option value="{{$loan->id}}">{{$loan->name}}</option>
            @endforeach
          </select> 
          <div>
              @error('loantype_id') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Interest Rate</label>
          <input
              wire:model='interestrate'
              type="text"
              name="interestrate"
              class="form-control" 
              disabled
          /> 
              
          <div>
              @error('interestrate') <span class="error">{{ $message }}</span> @enderror 
          </div> 
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Principal</label>
          <input
              wire:model='principal'
              type="number"
              name="principal"
              class="form-control" /> 
              <div>
                  @error('principal') <span class="error">{{ $message }}</span> @enderror 
              </div> 
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Effect Month</label>
          <input
              wire:model='effect_month'
              type="date"
              name="effect_month"
              class="form-control" 
          /> 
          <div>
              @error('effect_month') <span class="error">{{ $message }}</span> @enderror 
          </div> 
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Expiry Month</label>
          <input @change="$dispatch('calculateLoanInterest',{'value': $event.target.value})"
              wire:model='expiry_month'
              type="date"
              name="expiry_month"
              class="form-control"
          /> 
          <div>
              @error('expiry_month') <span class="error">{{ $message }}</span> @enderror 
          </div> 
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Period</label>
          <input
              wire:model='period'
              type="number"
              name="period"
              class="form-control" 
              disabled
          /> 
          <div>
              @error('period') <span class="error">{{ $message }}</span> @enderror 
          </div> 
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Payable</label>
          <input
              wire:model='payable'
              type="number"
              name="payable"
              class="form-control" 
              disabled
          /> 
              <div>
                  @error('payable') <span class="error">{{ $message }}</span> @enderror 
              </div> 
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Monthly Due</label>
          <input
              wire:model='monthly_due'
              type="number"
              name="monthly_due"
              class="form-control" 
              disabled
          /> 
          <div>
              @error('monthly_due') <span class="error">{{ $message }}</span> @enderror 
          </div> 
        </div>
        
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
      </div>

      </form>
</x-my-modal>