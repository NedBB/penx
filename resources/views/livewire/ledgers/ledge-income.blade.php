<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Ledgers /</span> Expenditure </h4>
    <div class="card">
      
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            
          </div>
          </div>
          <div class="card-body">
            <form wire:submit='search'>
            <div class="row mb-3">
                    <div class="col-5 col-md-5">
                        <select wire:model='head_id'
                            name="head_id"
                            class="select2 form-select"
                            multiple 
                            data-selected-text-format="count > 3" 
                            data-live-search="true" data-actions-box="true"
                            >
                            <option value="">Select States</option>
                            @foreach($states as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                        </div>
                            <div class="col-3 col-md-3">
                                <input wire:model='start_date' class="form-control" type="date" />
                            </div>
                            <div class="col-2 col-md-2">
                                <input wire:model='end_date' class="form-control" placeholder="Start Date" type="date" />
                            </div>
                            <div class="col-1 col-md-1">
                            <button class="btn btn-primary" type="submit">submit</button>
                            </div>
                        </div>
            </form>

          </div>
            
          </div>
          @if($show)
            <div class="table-responsive text-nowrap"> 

                <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse;table-layout: fixed; word-wrap:break-word;">
                    <thead>
                        <tr>
                            <th width="50px"></th>
                          <th width="50px">#</th>
                          <th width="200px">Names</th>
                          <th width="230px">Position</th>
                          <th width="100px">Acct.No</th>
                          <th width="200px">Bank</th>
                          <th width="120px">Basic Salary</th>
                          <th width="100px">Rent</th>
                          <th width="100px">Transport</th>
                          <th width="100px">Meal</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right total">Total</td>
                           
                        </tr>
                    </tfoot>
                </table>
            </div> 
          @endif
        </div>
      </div>
    </div>
    {{-- <x-payslip :detail="$detail"/> --}}
</div> 
