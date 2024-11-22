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


            <div class="col-3 col-md-3">
            <select wire:model='month_1'
                name="month_1"
                class="form-select"
                >
                <option value="">Month 1</option>
                @foreach($monthrange as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
            </select>
            </div>
            <div class="col-3 col-md-3">
            
            <select wire:model='year_1'
                name="year_1"
                class="form-select"
                >
                <option value="">Year 1</option>
                @php
                    $reverse = array_reverse(range(1990, date('Y')));
                @endphp
                @foreach($reverse as $i)
                        <option value="{{$i}}">{{$i}}</option>
                    @endforeach
            </select>
            </div>
            <div class="col-3 col-md-3">
            
            <select wire:model='month_2'
                name="month_2"
                class="form-select"
                >
                <option value="">Month 2</option>
                @foreach($monthrange as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
            </select>
            </div>
            <div class="col-3 col-md-3">
            <select wire:model='year_2'
                name="year_2"
                class="form-select"
                >
                <option value="">Year 2</option>
                @php
                    $reverse = array_reverse(range(1990, date('Y')));
                @endphp
                @foreach($reverse as $i)
                        <option value="{{$i}}">{{$i}}</option>
                    @endforeach
            </select>
        
            
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
                <label class="form-label" for="modalEditUserFirstName">State</label>
                <select class="form-control" wire:model='location_id'>
                    <option>Select State</option>
                    @foreach ($locations as $list )
                        <option value="{{$list->id}}"> {{$list->name}}</option>
                    @endforeach
                </select>
                    <div>
                        @error('location_id') <span class="error">{{ $message }}</span> @enderror 
                    </div>
            </div>
        
            
                <hr>
                <div class="col-md-4">
                    <div class="input-group">
                    <span class="input-group-addon" style="background: #e8e8e8;padding: 4px;">
                        <input type="checkbox" id="apply" aria-label="..." name="applypercent"  wire:blur="selectApply">
                   </span>
                        <input type="text" class="form-control checks" aria-label="..." placeholder="Apply Percentages" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="control-label">Select percentage to use:</div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon"  style="background: #e8e8e8;padding: 4px;">
                            <input type="radio" id="nty" aria-label="..." name="divisionpercent" wire:click="getPercent(90)" value="90" >
                       </span>
                        <input type="text" class="form-control checks" aria-label="..." placeholder="90%" disabled>
                        <span class="input-group-addon"  style="background: #e8e8e8;padding: 4px;">
                            <input type="radio" id="hnd" aria-label="90" name="divisionpercent" wire:blur="getPercent(100)" value="100" >
                         </span>
                        <input type="text" class="form-control checks" aria-label="..." placeholder="100%" disabled>
                    </div>
                </div>
                
                <hr>

                <div class="col-12 col-md-6">
                    <label class="form-label">Date</label>
                    <input
                        wire:model='date_record'
                        type="date"
                        name="date_record"
                        {{-- value="{{date('Y-m-d')}}" --}}
                        
                        class="form-control" 
                    />
                    <div>
                        @error('date') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
            
            <div class="clearfix"></div>
                <div class="col-4 col-md-4">
                    <label class="form-label">Amount Received</label>
                    <input
                        {{-- wire:model='amount' --}}
                        {{-- wire:blur="getPay" --}}
                        {{-- wire:model.defer="amount" --}}
                       
                        {{-- oninput="this.setAttribute('value', this.value)" 
                        wire:model.defer="amount" 
                        wire:keyup="handleKeypress($event.target.value)" --}}
                        type="text"
                        name="amount"
                        class="form-control"
                        wire:model.defer="amount" {{-- Delay synchronization until the user finishes input --}}
                        wire:keyup="handleKeypress($event.target.value)" {{-- Trigger backend logic on keypress --}}
                        type="text"
                        name="amount"
                        class="form-control"
                        oninput="delayedSync(event)"
                        />

                        
                    <div>
                        @error('amount') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="col-4 col-md-4">
                    <label class="form-label">Allocation %</label>
                    <input
                        wire:model='allocation_field'
                        type="number"
                        name="allocation_field"
                        class="form-control" 
                    />
                    <div>
                        @error('allocation_field') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label class="form-label">Gross Pay</label>
                    <input
                        wire:model='gross_pay'
                        type="number"
                        name="gross_pay"
                        class="form-control" 
                        disabled
                    />
                    <div>
                        @error('gross_pay') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>


                <div class="col-4 col-md-4">
                    <label class="form-label">NLC</label>
                    <input
                        wire:model='nlc'
                        {{-- wire:keyup="calculateTotals($event.target.value)" --}}
                        wire:blur="calculateTotals"
                        type="number"
                        name="nlc"
                        class="form-control" 
                    />
                    <div>
                        @error('nlc') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="col-4 col-md-4">
                    <label class="form-label">Constitution</label>
                    <input
                        wire:model='constitution'
                        wire:blur="calculateTotals"
                        {{-- wire:keyup="calculateTotals($event.target.value)" --}}
                        type="number"
                        name="constitution"
                        class="form-control" 
                    />
                    <div>
                        @error('constitution') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label class="form-label">Advance Allocation</label>
                    <input
                        wire:model='advance_allocation'
                        type="number"
                        name="advance_allocation"
                        wire:blur="calculateTotals"
                        {{-- wire:keyup="calculateTotals($event.target.value)" --}}
                        class="form-control" 
                    />
                    <div>
                        @error('advance_allocation') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>


                <div class="col-4 col-md-4">
                    <label class="form-label">Arrears</label>
                    <input
                        wire:model='arrears'
                        {{-- wire:keyup="calculateTotals($event.target.value)" --}}
                        wire:blur="calculateTotals"
                        type="number"
                        name="arrears"
                        class="form-control" 
                    />
                    <div>
                        @error('arrears') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="col-4 col-md-4">
                    <label class="form-label">Northern-dues</label>
                    <input
                        wire:model='northern_dues'
                        wire:blur="calculateTotals"
                        type="number"
                        name="northern_dues"
                        class="form-control" 
                    />
                    <div>
                        @error('northern_dues') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label class="form-label">Audit Fees</label>
                    <input
                        wire:model='audit_fees'
                        type="number"
                        name="audit_fees"
                        {{-- wire:keyup="calculateTotals($event.target.value)" --}}
                        wire:blur="calculateTotals"
                        class="form-control" 
                    />
                    <div>
                        @error('audit_fees') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>


                <div class="col-4 col-md-4">
                    <label class="form-label">Legal</label>
                    <input
                        wire:model='legal'
                        wire:blur="calculateTotals"
                        type="number"
                        name="legal"
                        class="form-control" 
                    />
                    <div>
                        @error('legal') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="col-4 col-md-4">
                    <label class="form-label">Almanac</label>
                    <input
                        wire:model='almanac'
                        wire:blur="calculateTotals"
                        type="number"
                        name="almanac"
                        class="form-control" 
                    />
                    <div>
                        @error('almanac') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <label class="form-label">Badges</label>
                    <input
                        wire:model='badges'
                        type="number"
                        name="badges"
                        class="form-control" 
                    />
                    <div>
                        @error('badges') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>

                <div class="col-4 col-md-4">
                    <label class="form-label">Net Pay</label>
                    <input
                        wire:model='net_pay'
                        type="number"
                        name="net_pay"
                        class="form-control" 
                        disabled
                    />
                    <div>
                        @error('net_pay') <span class="error">{{ $message }}</span> @enderror 
                    </div>
                </div>
            
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            </div>
    </form>

</x-my-modal>