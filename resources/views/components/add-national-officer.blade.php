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
              <label class="form-label">Title</label>
              <select class="form-control" wire:model='title_id' name="title_id">
                <option value="">-- Select Title--</option>
                @foreach($titles as $list)
                    <option value="{{$list->id}}">{{$list->name}}</option>
                @endforeach
              </select> 
              <div>
                  @error('title_id') <span class="error">{{ $message }}</span> @enderror 
              </div>
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Unique ID</label>
              <input
                  wire:model='uniqueid'
                  type="text"
                  name="uniqueid"
                  class="form-control" /> 
              <div>
                  @error('uniqueid') <span class="error">{{ $message }}</span> @enderror 
              </div> 
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Honours</label>
              <input
                  wire:model='honours'
                  type="text"
                  name="honours"
                  class="form-control" /> 
                  <div>
                      @error('honour') <span class="error">{{ $message }}</span> @enderror 
                  </div> 
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Surname</label>
              <input
                  wire:model='surname'
                  type="text"
                  name="surname"
                  class="form-control" /> 
                  <div>
                      @error('surname') <span class="error">{{ $message }}</span> @enderror 
                  </div> 
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">First name</label>
              <input
                  wire:model='firstname'
                  type="text"
                  name="firstname"
                  class="form-control" /> 
                  <div>
                      @error('firstname') <span class="error">{{ $message }}</span> @enderror 
                  </div> 
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Middle name</label>
              <input
                  wire:model='middlename'
                  type="text"
                  name="middlename"
                  class="form-control" /> 
                  <div>
                      @error('firstname') <span class="error">{{ $message }}</span> @enderror 
                  </div> 
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Utility</label>
              <input
                  wire:model='utility'
                  type="text"
                  name="utility"
                  class="form-control" /> 
                  <div>
                      @error('utility') <span class="error">{{ $message }}</span> @enderror 
                  </div> 
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Entertainment</label>
              <input
                  wire:model='entertainment'
                  type="text"
                  name="entertainment"
                  class="form-control" /> 
                  <div>
                      @error('entertainment') <span class="error">{{ $message }}</span> @enderror 
                  </div> 
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Position</label>
              <select class="form-control" wire:model='dutystation_id' name="dutystation_id">
                <option value="">-- Select Position--</option>
                @foreach($dutystations as $list)
                    <option value="{{$list->id}}">{{$list->name}}</option>
                @endforeach
              </select> 
              <div>
                  @error('dutystation_id') <span class="error">{{ $message }}</span> @enderror 
              </div>
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Salary</label>
              <input
                  wire:model='basicsalary'
                  type="number"
                  step="0.01"
                  name="basicsalary"
                  class="form-control" /> 
                  <div>
                      @error('basicsalary') <span class="error">{{ $message }}</span> @enderror 
                  </div> 
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Account No</label>
              <input
                  wire:model='accountno'
                  type="number"
                  name="accountno"
                  class="form-control" /> 
                  <div>
                      @error('accountno') <span class="error">{{ $message }}</span> @enderror 
                  </div> 
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Payment Method</label>
              <select class="form-control" wire:model='paymentmethod_id' name="paymentmethod_id">
                <option value="">-- Select Payment--</option>
                @foreach($payments as $list)
                    <option value="{{$list->id}}">{{$list->name}}</option>
                @endforeach
              </select> 
              <div>
                  @error('paymentmethod_id') <span class="error">{{ $message }}</span> @enderror 
              </div>
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Bank</label>
              <select class="form-control" wire:model='bank_id' name="bank_id">
                <option value="">-- Select Bank--</option>
                @foreach($banks as $list)
                    <option value="{{$list->id}}">{{$list->name}}</option>
                @endforeach
              </select> 
              <div>
                  @error('bank_id') <span class="error">{{ $message }}</span> @enderror 
              </div>
            </div>
            
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
          </div>

          </form>
</x-my-modal>