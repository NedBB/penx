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
                              <td>{{!empty($record->profile->bank->abbreviation) ? $record->profile->bank->name : $record->profile->bank->abbreviation}}</td>
                              <td></td>
                          </tr>
                      @empty
                          <tr><td colspan="7" class="text-center text-danger"> No record exist at the moment</td></tr>
                      @endforelse
                  </tbody>
                  
              </table>