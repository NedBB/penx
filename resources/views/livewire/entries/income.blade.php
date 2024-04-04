<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3"><span class="text-muted fw-light">Entries /</span> Income</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">{{session('success')}}</div>
            @endif

            @if (session('failed'))
                <div class="alert alert-danger" role="alert">{{session('failed')}}</div>
            @endif
            <form id="editUserForm" wire:submit='save' class="row g-3"onsubmit="return false ">
                {{-- <input type="hidden" wire:model='id'/> --}}
                <div class="col-12 col-md-6">
                    <label class="form-label">State</label>
                    <select
                      wire:model='location_id'
                      name="location_id"
                      class="select2 form-select"
                      required
                      >
                      <option value="">Select State</option>
                      @foreach ($states as $state)
                        <option value="{{$state->id}}" class="text-capitalize">{{$state->name}}</option>
                      @endforeach
                      
                    </select>
                    <div>
                        @error('location_id') <span class="error">{{ $message }}</span> @enderror 
                      </div>
                </div>
                
                <div class="col-12 col-md-6">
                <label class="form-label">Remitted Amount</label>
                <input
                    wire:model.live='amount'
                    type="number"
                    name="amount"
                    class="form-control"
                    required
                    />
                    <div>
                        @error('amount') <span class="error">{{ $message }}</span> @enderror 
                      </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <label class="form-label">Income Percent</label>
                    <input
                        wire:model='income'
                        type="number"
                        name="incomeperc"
                        class="form-control"
                        required
                    />
                    <div>
                        @error('income') <span class="error">{{ $message }}</span> @enderror 
                      </div>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Receipt No.</label>
                    <input
                        wire:model='receipt'
                        type="number"
                        name="receipt"
                        class="form-control"
                        required
                        />
                        <div>
                            @error('receipt') <span class="error">{{ $message }}</span> @enderror 
                          </div>
                </div>
                <div class="col-12 col-md-12">
                    <label class="form-label">Address</label>
                    <input
                        wire:model='description'
                        type="text"
                        name="address"
                        class="form-control"
                        required
                        />
                        <div>
                            @error('description') <span class="error">{{ $message }}</span> @enderror 
                          </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Date From</label>
                    <input
                        wire:model='date_from'
                        type="date"
                        name="data_from"
                        class="form-control"
                        required
                        />
                        <div>
                            @error('date_from') <span class="error">{{ $message }}</span> @enderror 
                          </div>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Date To</label>
                    <input
                        wire:model='date_to'
                        type="date"
                        name="date_to"
                        class="form-control"
                        required
                        />
                        <div>
                            @error('date_to') <span class="error">{{ $message }}</span> @enderror 
                          </div>
                </div>
                <div class="col-12 col-md-12">
                    <label class="form-label">Bank Account</label>
                    <select
                      wire:model='account_id'
                      name="account_id"
                      class="select2 form-select"
                      required
                      >
                      <option value="">Select Bank Accounts</option>
                      @foreach ($accounts as $account)
                        <option value="{{$account->id}}" class="text-capitalize">{{$account->name}}</option>
                      @endforeach
                      
                    </select>
                    <div>
                        @error('account_id') <span class="error">{{ $message }}</span> @enderror 
                      </div>
                </div>
                <div class="col-12 col-md-12">
                    <label class="form-label">Total</label>
                    <input disabled
                        wire:model='amount'
                        type="number"
                        name="total"
                        class="form-control"
                        required
                        />
                        
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>