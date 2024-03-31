<x-my-modal>
    <div class="mb-4 modal-heading">
        <h5  class="mb-2">Add Department</h5>
      </div>
      <form id="addDepartment" class="row g-3"wire:submit="save">
        <div class="col-12 col-md-12">
          <label class="form-label">Name</label>
          <input type="text" name="name"  wire:model="name" class="form-control"/>
          <div>
            @error('name') <span class="error">{{ $message }}</span> @enderror 
          </div>
        </div>
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
        </div>
      </form>
</x-my-modal>

