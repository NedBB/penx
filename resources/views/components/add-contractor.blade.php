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
                <label class="form-label">Title</label>
                <select
                    wire:model='title_id'
                    id="title_id"
                    name="title_id"
                    class="form-select"
                    >
                    <option value="">Select</option>
                    @foreach ($titles as $title)
                        <option value="{{$title->id}}">{{$title->name}}</option>
                    @endforeach

                </select>
                <div>
                    @error('title_id') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Surname</label>
                <input
                    wire:model='surname'
                    type="text"
                    id="surname"
                    name="surname"
                    class="form-control"
                    placeholder="surname" />
                    <div>
                        @error('surname') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">First name</label>
                <input
                    wire:model='firstname'
                    type="text"
                    id="firstname"
                    name="firstname"
                    class="form-control"
                    placeholder="Doe" />
                <div>
                    @error('firstname') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Account Name</label>
                <input
                    wire:model='account_name'
                    type="text"
                    name="account_name"
                    class="form-control"
                    placeholder="Account name" />
                <div>
                    @error('account_name') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Account No.</label>
                <input
                    wire:model='account_no'
                    type="number"
                    name="account_no"
                    class="form-control"
                    placeholder="Account No" />
                <div>
                    @error('account_no') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Bank</label>
                <select wire:model='bank_id'
                    id="modalEditUserLanguage"
                    name="modalEditUserLanguage"
                    class="select2 form-select"
                    >
                    <option value="">Select</option>
                    @foreach ($banks as $bank)
                        <option value="{{$bank->id}}">{{$bank->name}}</option>
                    @endforeach
                </select>
                <div>
                    @error('bank_id') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
            <div class="col-12 col-md-12">
                <label class="form-label">Address</label>
                <input
                    wire:model='address'
                    type="text"
                    name="address"
                    class="form-control"
                    placeholder="Address" />
                <div>
                    @error('address') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">@if($edit == false)Submit @else Update @endif</button>
        </div>
      </form>
</x-my-modal>