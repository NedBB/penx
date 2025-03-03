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

    <form id="editUserForm" class="row g-3" wire:submit="update">
        
        <div class="col-12 col-md-12">
            <label class="form-label" for="modalEditUserFirstName">Subhead</label>
            <select wire:model='subhead_id' class="select2 form-select" required>
                <option value="">Select</option>
                @foreach ($subheads as $subhead)
                    <option value="{{$subhead->id}}">{{$subhead->name}}</option> 
                @endforeach
            </select>
        </div>
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
        </div>
    </form>

</x-my-modal>