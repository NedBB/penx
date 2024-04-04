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

    <form id="editUserForm" class="row g-3" onsubmit="return false">
            <div class="col-12 col-md-6">
                <label class="form-label">Name</label>
                <input
                wire:model='name'
                type="text"
                name="name"
                class="form-control" />
            </div>
            
            <div class="col-12 col-md-6">
                <label class="form-label">Date</label>
                <input
                    wire:model='date'
                    type="date"
                    name="date"
                    class="form-control" />
            </div>
        
            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserFirstName">Head</label>
                <select class="form-control"  name="head_id" wire:model='head_id'>
                    <option>Select Option</option>
                    @foreach ($heads as $head)
                        <option @click="$dispatch('selectionChanged', '{{$head->id}}')" value="{{$head->id}}">{{$head->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserFirstName">Subhead</label>
                <select class="form-control" name="subhead_id" wire:model='subhead_id'>
                    <option>Select Option</option>
                </select>
            </div>
        
            <div class="col-12 col-md-6">
                <label class="form-label">PVNo</label>
                <input wire:model='pvno'
                    type="text"
                    name="pvno"
                    class="form-control" />
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Amount</label>
                <input wire:model='amount'
                    type="number"
                    name="amount"
                    class="form-control"
                    placeholder="amount" />
            </div>
            <div class="col-12 col-md-12">
                <label class="form-label">Description</label>
                <input wire:model='description'
                type="text"
                name="description"
                class="form-control"
                placeholder="description" />
            </div>
            
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                <button
                    type="reset"
                    class="btn btn-label-secondary"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                    Cancel
                </button>
            </div>
    </form>

</x-my-modal>