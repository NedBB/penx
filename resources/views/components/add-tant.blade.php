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
        @php
            $head_field = "head_id";
            $subhead_field = "subhead_id"
        @endphp
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
                <label class="form-label" for="modalEditUserFirstName">Full name</label>
                <select class="form-control" wire:model='name'>
                    <option>Select Staff</option>
                    @foreach ($fullnames as $name )
                        <option value="{{$name->id}}"> {{$name->fullname()}}</option>
                    @endforeach
                </select>
                    <div>
                        @error('name') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>
        
            <div class="col-12 col-md-12">
                <label class="form-label" for="modalEditUserFirstName">Head</label>
                <livewire:selection-change :records='$heads' :data="$data" :name="$head_field">
                    <div>
                        @error('record_id') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>

            <div class="col-12 col-md-12">
                <label class="form-label" for="modalEditUserFirstName">Subhead</label>
                <livewire:selection-update :records='$records' :name="$subhead_field">
                    <div>
                        @error('subhead_id') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>


            <div class="col-12 col-md-6">
                <label class="form-label">Transport</label>
                <input wire:model='transport'
                    type="number"
                    name="transport"
                    class="form-control"
                    placeholder="transport" />
                <div>
                    @error('transport') <span class="error">{{ $message }}</span> @enderror 
                </div>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Date</label>
                <input
                    wire:model='date_record'
                    type="text"
                    name="date_record"
                    readonly
                    class="form-control" 
                />
                <div>
                    @error('date') <span class="error">{{ $message }}</span> @enderror 
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
            
            
                <div class="col-4 col-md-4">
                    <label class="form-label">House</label>
                    <input
                        wire:model='house'
                        wire:blur="calculateTotals"
                        type="number"
                        name="house"
                        class="form-control" 
                    />
                    <div>
                        @error('house') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="col-4 col-md-4">
                    <label class="form-label">Multiple</label>
                    <input
                        wire:model='house_multiple'
                        wire:blur="calculateTotals"
                        type="number"
                        name="house_multiple"
                        class="form-control" 
                    />
                    <div>
                        @error('house_multiple') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label class="form-label">Total</label>
                    <input
                        wire:model='house_total'
                        type="text"
                        name="house_total"
                        class="form-control" 
                        disabled
                    />
                    <div>
                        @error('house_total') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>


                <div class="col-4 col-md-4">
                    <label class="form-label">Fooding</label>
                    <input
                        wire:model='food'
                        wire:blur="calculateTotals"
                        type="number"
                        name="food"
                        class="form-control" 
                    />
                    <div>
                        @error('food') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="col-4 col-md-4">
                    <label class="form-label">Multiple</label>
                    <input
                        wire:model='food_multiple'
                        wire:blur="calculateTotals"
                        type="number"
                        name="food_multiple"
                        class="form-control" 
                    />
                    <div>
                        @error('food_multiple') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label class="form-label">Total</label>
                    <input
                        wire:model='food_total'
                        type="text"
                        name="food_total"
                        class="form-control" 
                        disabled
                    />
                    <div>
                        @error('food_total') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>


                <div class="col-4 col-md-4">
                    <label class="form-label">Outstation</label>
                    <input
                        wire:model='outstation'
                        wire:blur="calculateTotals"
                        type="number"
                        name="outstation"
                        class="form-control" 
                    />
                    <div>
                        @error('outstation') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="col-4 col-md-4">
                    <label class="form-label">Multiple</label>
                    <input
                        wire:model='outstation_multiple'
                        wire:blur="calculateTotals"
                        type="number"
                        name="outstation_multiple"
                        class="form-control" 
                    />
                    <div>
                        @error('outstation_multiple') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label class="form-label">Total</label>
                    <input
                        wire:model='outstation_total'
                        type="text"
                        name="outstation_total"
                        class="form-control" 
                        disabled
                    />
                    <div>
                        @error('outstation_total') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>


                <div class="col-4 col-md-4">
                    <label class="form-label">Seating</label>
                    <input
                        wire:model='seating'
                        wire:blur="calculateTotals"
                        type="number"
                        name="seating"
                        class="form-control" 
                    />
                    <div>
                        @error('seating') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="col-4 col-md-4">
                    <label class="form-label">Multiple</label>
                    <input
                        wire:model='seating_multiple'
                        wire:blur="calculateTotals"
                        type="number"
                        name="seating_multiple"
                        class="form-control" 
                    />
                    <div>
                        @error('seating_multiple') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label class="form-label">Total</label>
                    <input
                        wire:model='seating_total'
                        type="text"
                        name="seating_total"
                        class="form-control" 
                        disabled
                    />
                    <div>
                        @error('seating_total') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="col-4 col-md-4 offset-8">
                    <label class="form-label">Grand Total</label>
                    <input
                        wire:model='grand_total'
                        type="text"
                        name="grand_total"
                        class="form-control" 
                        disabled
                    />
                    <div>
                        @error('grand_total') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
            
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            </div>
    </form>

</x-my-modal>