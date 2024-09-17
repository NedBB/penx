<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">{{$types}}</h4>
    <div class="card">
      
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            
          </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
              
              <div class="col-12 col-md-12">
                <form wire:submit='search'>
                    <div class="row mb-3">
                        
                        <div class="col-3 col-md-3">
                          <select wire:model='type'
                              id="modalEditUserLanguage"
                              name="modalEditUserLanguage"
                              class="form-select"
                              >
                              <option value="">Select</option>
                              @foreach($user_types as $key => $value)
                                      <option value="{{$key}}">{{$value}}</option>
                                  @endforeach
                          </select>
                  </div>
                        <div class="col-3 col-md-3">
                            <input wire:model='start_date' class="form-control" type="date" />
                        </div>
                        <div class="col-3 col-md-3">
                            <input wire:model='end_date' class="form-control" type="date" />

                        </div>
                        <div class="col-2 col-md-2">
                                <button class="btn btn-primary" type="submit">submit</button>
                                </div>
                        </div>
                </form>
                <div class="row">
                  <div class="col-md-2">
                    <div class="table-responsive text-nowrap"> 
                      <div class="dt-buttons">
                        <x-export-excell />
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              
            </div> 
        </div>
        <div class="table-responsive text-nowrap"> 
            <div class="">
              <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse;table-layout: fixed; word-wrap:break-word;">
                  <thead>
                    <tr class="bold">
                        <th width="50px">S/N</th>
                        <th width="200px">HEAD</th>
                        <th width="200px">SUBHEAD</th>
                        <th width="150px">PVNO</th>
                        <th width="150px">AMOUNT</th>
                    </tr>
                  </thead>
                  <tbody>
                      @php $count = 0; @endphp
                      @forelse ($records as $record)
                          <tr>
                              <td>{{++$count}}</td>
                              <td>
                                 {{$record->subhead->head->name}}
                              </td>
                              <td>
                                {{$record->subhead->name}}
                             </td>
                              <td>{{$record->pvno}}</td>
                              <td>{{format_currency($record->amount)}}</td>
                          </tr>
                      @empty
                          <tr><td colspan="5" class="text-center text-danger"> No record exist at the moment</td></tr>
                      @endforelse
                  </tbody>
                  
              </table>
            </div>
        </div> 
      </div>
    </div>    
</div> 
