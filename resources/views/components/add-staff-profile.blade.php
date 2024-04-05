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
                  @error('middlename') <span class="error">{{ $message }}</span> @enderror 
              </div> 
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Pension Pin</label>
          <input
              wire:model='pensionpin'
              type="text"
              name="pensionpin"
              class="form-control" /> 
              <div>
                  @error('pensionpin') <span class="error">{{ $message }}</span> @enderror 
              </div> 
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Tax Pin</label>
          <input
              wire:model='taxpin'
              type="text"
              name="taxpin"
              class="form-control" /> 
              <div>
                  @error('taxpin') <span class="error">{{ $message }}</span> @enderror 
              </div> 
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">NHF Pin</label>
          <input
              wire:model='nhfpin'
              type="text"
              name="nhfpin"
              class="form-control" /> 
              <div>
                  @error('nhfpin') <span class="error">{{ $message }}</span> @enderror 
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
          <label class="form-label">Department</label>
          <select class="form-control" wire:model='department_id' name="department_id">
            <option value="">-- Select Department--</option>
            @foreach($departments as $list)
                <option value="{{$list->id}}">{{$list->name}}</option>
            @endforeach
          </select> 
          <div>
              @error('department_id') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Grade Level</label>
          <select class="form-control" wire:model='dutystation_id' name="dutystation_id">
            <option value="">-- Select Grade Level--</option>
            @foreach($gradelevels as $list)
                <option value="{{$list->id}}">Level {{$list->level}}</option>
            @endforeach
          </select> 
          <div>
              @error('gradelevel_id') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Salary</label>
          <input
              wire:model='baseamount'
              type="text"
              name="baseamount"
              class="form-control" readonly /> 
              <div>
                  @error('baseamount') <span class="error">{{ $message }}</span> @enderror 
              </div> 
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Step</label>
          <select class="form-control" wire:model='step_id' name="step_id">
            <option value="">-- Select Grade--</option>
            @foreach($steps as $list)
                <option value="{{$list->id}}">{{$list->name}}</option>
            @endforeach
          </select> 
          <div>
              @error('step_id') <span class="error">{{ $message }}</span> @enderror 
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
          <label class="form-label">Contribution</label>
          <input
              wire:model='contribution'
              type="number"
              name="contribution"
              class="form-control" /> 
              <div>
                  @error('contribution') <span class="error">{{ $message }}</span> @enderror 
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
        <div iv class="col-12 col-md-6"></div>
        <div class="col-12 col-md-6">
          <label class="form-label">Part of Pension</label>
          <input
              wire:model='partofpension'
              type="checkbox"
              name="partofpension"
              class="form-check-input" /> 
              <div>
                  @error('partofpension') <span class="error">{{ $message }}</span> @enderror 
              </div> 
        </div>
        
        <div class="col-12 col-md-6">
          <label class="form-label">Part of NHF</label>
          <input
              wire:model='partofnhf'
              type="checkbox"
              name="partofnhf"
              class="form-check-input" /> 
              <div>
                  @error('partofnhf') <span class="error">{{ $message }}</span> @enderror 
              </div> 
        </div>
        
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
      </div>

      </form>
</x-my-modal>