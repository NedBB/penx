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
      <form id="addDepartment" class="row g-3"wire:submit="@if($edit == false)save @else update @endif">
        <div class="col-12 col-md-6">
          <label class="form-label">Account Name</label>
          <input type="text" name="name"  wire:model="name" class="form-control" required/>
          <div>
            @error('name') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>
        <div class="col-12 col-md-6">
        <label class="form-label">Account Number</label>
        <input
            wire:model='account_number'
            type="number"
            name="account_number"
            class="form-control"
            required
            />
            @error('account_number') <span class="error">{{ $message }}</span> @enderror
        </div>
        
          <div class="col-12 col-md-12">
            <label class="form-label" for="modalEditUserLanguage">Select Bank</label>
            <select
              wire:model='bank_id'
              name="bank_id"
              class="select2 form-select"
              required
              >
              <option value="">Select</option>
              @foreach ($banks as $bank)
                <option value="{{$bank->id}}" @if(($edit == true) && ($bankaccount->bank_id == $bank->id)) selected @endif )>{{$bank->name}}</option> 
              @endforeach
            </select>
          </div>
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">@if($edit == false)Submit @else Update @endif</button>
        </div>
      </form>
</x-my-modal>

