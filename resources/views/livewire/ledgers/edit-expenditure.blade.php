<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">{{$year}} Edit  Expenditure with Unknown Subhead </h4>
    <div class="card">
      
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="card-header">
              
            </div>
        </div>
        <div class="card-body">
          
          <form wire:submit='search'>
            <div class="row mb-3">
                <div class="col-2 col-md-2">
                    <select wire:model='record' id="record" name="record" class="form-select">
                      <option value="">Record Type</option>
                      
                      @foreach($record_type as $index => $value)
                            <option value="{{$index}}">{{$value}}</option>
                        @endforeach
                  </select>
                </div>
                <div class="col-3 col-md-3">
                    <livewire:selection-change :records="$heads">
                </div>
                <div class="col-3 col-md-3">
                    <livewire:selection-update>
                </div>
                <div class="col-2 col-md-2">
                    <select wire:model='year'id="year" name="year" class="form-select">
                      <option value="">Select Year</option>
                      @php
                          $reverse = array_reverse(range(1990, date('Y')));
                      @endphp
                      @foreach($reverse as $i)
                            <option value="{{$i}}">{{$i}}</option>
                        @endforeach
                  </select>
                </div>
                
                <div class="col-1 col-md-1">
                <button class="btn btn-primary" type="submit">submit</button>
                </div>
            </div>
          </form>
          
        </div>
          
          @if($show)
            <div class="table-responsive text-nowrap"> 

                <table class="table table-hover table-bordered font-13 table-striped" id="printTable">
                    <thead>
                      <tr>
                        
                        <th>Date</th>
                        <th>PVNO</th>
                        <th>Group Head</th>
                        <th>SubHead</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th class="change">Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                          $total = 0;
                        @endphp
                        @forelse ($results as $data)
                          
                            <tr wire:key='{{$data->id}}'>
                              
                              <td class="remove">
                                  <span class="fw-medium">{{sqldate($data->created_at)}}</span>
                              </td>
                              <td class="remove">
                                <span class="fw-medium">{{$data->pvno}}</span>
                            </td>
                              <td class="text-capitalize">
                                  <span class="fw-medium">{{$data->subhead->head->slug}}</span>
                              </td>
                              <td class="text-capitalize">
                                <span class="fw-medium">{{$data->subhead->name}}</span>
                            </td>
                              <td>
                                  <span class="fw-medium">{{($data->description)?:null}}</span>
                              </td>
                              <td data-amount={{$data->amount}} >
                                  {{format_money($data->amount)}}
                              </td>
                              <td class="change remove">
                                <a href="#" class="float-sm-end" wire:click="openModal({{ $data->id }})" wire:key='{{time().$data->id}}' data-bs-toggle="modal" data-bs-target="#editUser">
                                   <i class="fa-solid fa-pencil text-primary"></i>
                                </a>
                               
                              </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-danger">No data exist at the moment</td></tr>
                        @endforelse
                    </tbody>
                    
                  </table>
            </div> 
          @endif
      </div>

    </div>

   
    <x-edit-expenditure-form  :title="$title" :head_id="$head_id" :subhead_id="$subhead_id" :subheads="$subheads"/>

    
</div> 
