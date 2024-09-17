<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Staff/National Officer Payment Schedule @if($month) for {{$monthrange[$month]}}  {{$year}}@endif</h4>
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
                                <select wire:model='month'
                                    id="modalEditUserLanguage"
                                    name="modalEditUserLanguage"
                                    class="form-select"
                                    >
                                    <option value="">Month</option>
                                    @foreach($monthrange as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                </select>
                        </div>
                        <div class="col-3 col-md-3">
                                <select wire:model='year'
                                    name="year"
                                    class="form-select"
                                    >
                                    <option value="">Year</option>
                                    @php
                                        $reverse = array_reverse(range(1990, date('Y')));
                                    @endphp
                                    @foreach($reverse as $i)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endforeach
                                </select>
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
                        <th width="200px">BENEFICIARY NAME</th>
                        <th width="150px">ACCTS NO</th>
                        <th width="100px">AMOUNT</th>
                        <th width="150px">SORT CODE</th>
                        <th width="150px">BANK</th>
                        <th width="150px">NARATION</th>
                    </tr>
                  </thead>
                  <tbody>
                      @php $count = 0; @endphp
                      @forelse ($records as $record)
                          <tr>
                              <td>{{++$count}}</td>
                              <td>
                                 {{$record->profile->fullname()}}
                              </td>
                              <td>{{$record->profile->accountno}}</td>
                              <td>{{format_currency($record->netpay)}}</td>
                              <td>{{$record->profile->bank->sortcode}}</td>
                              <td>{{empty($record->profile->bank->abbreviation) ? $record->profile->bank->name : $record->profile->bank->abbreviation}}</td>
                              <td></td>
                          </tr>
                      @empty
                          <tr><td colspan="7" class="text-center text-danger"> No record exist at the moment</td></tr>
                      @endforelse
                  </tbody>
                  
              </table>
            </div>
        </div> 
      </div>
    </div>    
</div> 
