
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3"><span class="text-muted fw-light">Settings /</span> System Settings</h4>

        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">{{session('success')}}</div>
                @endif

                @if (session('failed'))
                    <div class="alert alert-danger" role="alert">{{session('failed')}}</div>
                @endif
                <form id="editUserForm" wire:submit='save' class="row g-3" onsubmit="return false">
                    <input type="hidden" wire:model='id'/>
                    <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserFirstName">Rent</label>
                    <input
                        wire:model='rent'
                        type="number"
                        name="rent"
                        class="form-control"
                        required
                        />
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <label class="form-label">Transport</label>
                        <input
                        wire:model='transport'
                        type="number"
                        name="transport"
                        class="form-control"
                        required
                        />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Meal</label>
                        <input
                            wire:model='meal'
                            type="number"
                            name="meal"
                            class="form-control"
                            placeholder="Doe" 
                            required
                            />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Employee %</label>
                        <input
                            wire:model='employee'
                            type="number"
                            name="employee"
                            class="form-control"
                            required
                            />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Employer %</label>
                        <input
                            wire:model='employer'
                            type="number"
                            name="employer"
                            class="form-control"
                            required
                            />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">NGF</label>
                        <input
                            wire:model='nhf'
                            type="number"
                            name="nhf"
                            class="form-control"
                            required
                            />
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>