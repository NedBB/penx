<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">{{$year}} Ledgers Expenditure </h4>
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

                <table style="width: 100%; table-layout: auto; border-collapse: collapse;" class="table table-hover table-bordered font-13 table-striped" id="result">
                   
                    <tbody>
                        <tr><td><strong>{{$year}} EXPENDITURE</strong></td></tr>
                        @php
                            $grand = 0;
                        @endphp
                        @forelse($records as $head)

                            @if ($head->name != 'CONTRAL')
                        
                                <tr>
                                    <td style="font-weight:bold" colspan="{{$head->cols}}">
                                        <span style="color:red">{{$head->slug}}</span>
                                        <span>   {{$head->name}} </span>
                                    </td>
                                </tr>
                                <tr>
                                    @foreach ($head->subheads as $subhead)
                                        @if($subhead->name !== "UNKNOWN") 
                                            <td style="border: 1px solid #ccc; padding: 8px;">{{$subhead->name}}</td>
                                        @endif
                                    @endforeach
                                    <td>Total</td>
                                </tr>

                                <tr>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($head->subheads as $subhead)
                                        @php
                                            //$total += $subhead->amount;
                                            $grand = $subhead->amount + $grand;
                                           
                                        @endphp
                                      
                                        @if($subhead->name !== "UNKNOWN") 
                                            <td style="border: 1px solid #ccc; padding: 8px;">{{format_money($subhead->amount)}}</td>
                                        @endif
                                    @endforeach
                                    
                                    <td>{{format_money($subhead->amount)}}</td>
                                </tr>
                            @endif
                        @empty
                            <tr><td colspan="1" class="text-center text-danger"> No record exist at the moment</td></tr>
                        @endforelse
                            
                        <tr><td class="text-center text-danger"><strong>Grand Total</strong></td><td><strong>{{format_money($grand)}}</strong></td></tr>

                    </tbody>
                </table>
            </div> 
          @endif
        </div>
      </div>
    </div>
    <script>
        document.addEventListener('download-excel', function () {
            
            let link = document.createElement('a');
            link.href = "{{ route('yearly-expenditure-export') }}";  // Assuming the export route
            link.click();
        });
    </script>
    
</div> 
