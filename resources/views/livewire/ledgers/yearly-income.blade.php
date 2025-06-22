<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">{{$year}} Ledgers Income </h4>
    <div class="card">
      
      <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="card-header">
            
          </div>
          </div>
          <div class="card-body">
            
            <form wire:submit='search'>
            <div class="row mb-3">
                <div class="col-3 col-md-3">
                    @if ($show == true)
                        <x-export-excell />
                    @endif
                </div>
                <div class="col-6 col-md-6">
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
            
          </div>
          @if($show)
            <div class="table-responsive text-nowrap"> 

                <table class="table table-hover table-bordered table-striped" id="datatable-result">
                    <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Amount</th>
                        <th>Total Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $amount= 0; $total = 0;  @endphp
                            @forelse($records as $record)
                               
                                <tr>
                                    <td>
                                            {{$record->location->name}}
                                    </td>
                                    <td> {{format_currency($record->amount)}} </td>
                                    <td> {{format_currency($record->total)}} </td>
                                </tr>
                                        @php
                                            $total += $record->total;
                                            $amount += $record->amount;
                                        @endphp
                        @empty
                            <tr>
                                <td colspan="4" class="text-danger text-center">No data exist at the moment</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                    <tr class="total-cell">
                        <td colspan="1" style="text-align:right">Grand Total</td>
                        <td class="total_words" data-total={{$total}}>{{format_currency($amount)}}</td>
                        <td class="total_words" data-total={{$total}}>{{format_currency($total)}}</td>
                    
                    </tr>
                    </tfoot>
                </table>
            </div> 
          @endif
        </div>
      </div>
    </div>
    <script>
        document.addEventListener('download-excel', function () {
            
            let link = document.createElement('a');
            link.href = "{{ route('yearly-income-export') }}";  // Assuming the export route
            link.click();
        });
    </script>
</div> 
