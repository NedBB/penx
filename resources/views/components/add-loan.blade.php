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
          <input type="text" name="name"  wire:model="name" class="form-control"/>
          <div>
            @error('name') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>
        <div class="col-12 col-md-12">
          <label class="form-label">Interest Rate</label>
          <input type="number" step="0.01" name="interestrate"  wire:model="interestrate" class="form-control"/>
          <div>
            @error('interestrate') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">@if($edit == false)Submit @else Update @endif</button>
        </div>
      </form>
</x-my-modal>