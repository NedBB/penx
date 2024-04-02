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
        <div class="col-12 col-md-12">
          <label class="form-label">Name</label>
          <input type="text" name="username"  wire:model="username" class="form-control"/>
          <div>
            @error('username') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>
        @if ($edit == false)
            <div class="col-12 col-md-12">
                <label class="form-label">Password</label>
                <input type="password" name="password"  wire:model="password" class="form-control"/>
                <div>
                @error('password') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
            <div class="col-12 col-md-12">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmed"  wire:model="password_confirmed" class="form-control"/>
                <div>
                @error('password_confirmed') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
        @endif
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">@if($edit == false)Submit @else Update @endif</button>
        </div>
      </form>
</x-my-modal>