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
            <label class="form-label" for="modalEditUserLanguage">Grade level</label>
            <select
              wire:model='gradelevel_id'
              id="gradelevel"
              name="gradelevel"
              class="select2 form-select">
              <option value="">Select</option>
              @foreach ($gradelevel as $level)
                  <option value="{{$level->id}}">{{$level->gradelevelname->name}} {{$level->level}} </option>
              @endforeach
            </select>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">Base Amount</label>
            <input
                wire:model='baseamount'
                type="number"
                step="0.01"
                id="baseamount"
                name="baseamount"
                class="form-control"
                placeholder="Base Amount" />
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">Increment Rate</label>
            <input
                wire:model='incrementrate'
                type="number"
                step="0.01"
                id="incrementrate"
                name="incrementrate"
                class="form-control"
                placeholder="Increment Rate" />
          </div>
          
          <div class="col-12 col-md-6">
            <label class="form-label">Step</label>
            <input
                wire:model='step'
                type="number"
                id="step"
                name="step"
                class="form-control"
                placeholder="Interest Rate" />
            <div>
                @error('step') <span class="error">{{ $message }}</span> @enderror 
            </div>
          </div>
        </div>
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">@if($edit == false)Submit @else Update @endif</button>
        </div>
      </form>
</x-my-modal>