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

    <form id="editUserForm" class="row g-3" wire:submit='save'>
            <div class="col-12 col-md-6">
                <label class="form-label">Name</label>
                <input
                wire:model='name'
                type="text"
                name="name"
                class="form-control" /> 
                <div>
                    @error('name') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
           
            <div class="col-12 col-md-6">
                <label class="form-label">Date</label>
                <input
                    wire:model='date'
                    type="date"
                    name="date"
                    class="form-control" />
                    <div>
                        @error('date') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>
        
            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserFirstName">Head</label>
                <livewire:selection-change :heads='$heads'>
                    <div>
                        @error('head_id') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserFirstName">Subhead</label>
                <livewire:selection-update :subheads='$subheads'>
                    <div>
                        @error('subhead_id') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>
        
            <div class="col-12 col-md-6">
                <label class="form-label">PVNo</label>
                <input wire:model='pvno'
                    type="text"
                    name="pvno"
                    class="form-control" />
                    <div>
                        @error('pvno') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Amount</label>
                <input wire:model='amount'
                    type="number"
                    name="amount"
                    class="form-control"
                    placeholder="amount" />
                <div>
                    @error('amount') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
            <div class="col-12 col-md-12">
                <label class="form-label">Description</label>
                <input wire:model='description'
                type="text"
                name="description"
                class="form-control"
                placeholder="description" />
                <div>
                    @error('description') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>
            
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            </div>
    </form>

</x-my-modal>