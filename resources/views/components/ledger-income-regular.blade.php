<table class="table table-hover table-bordered table-striped" id="datatable-result">
    <thead>
    <tr>
        <th class="remove"></td>
        <th>Date Paid</th>
        <th>Sender</th>
        <th>Account</th>
        <th width="300px">Description</th>
        <th>Amount</th>
        <th>Percent</th>
        <th>Period From</th>
        <th>Period To</th>
        <th>Receipt No.</th>
        <th>Total Amount</th>
    </tr>
    </thead>
    <tbody>
        @php  $total = 0;  @endphp
        @forelse($records as $groupname => $groupdata)
            @foreach($groupdata as $record)
               
                <tr>
                    <td class="remove">
                        <input id="{{time()}}" type="checkbox" class="checkbox text-center"/>
                      </td>
                    {{-- <td>
                        {{date5($record['fromdate_at'])}}

                        <livewire:edit-anchor :record="$record" :eventoption="$editevent" wire:key='{{time().  $record['id']}}' /> 

                        <livewire:print-modal :id="$record['id']" :eventoption="$printevent" wire:key='{{time(). $record['id']}}' /> 

                       
                        <a class='removeIncome pull-right' onclick="confirm('Are you sure you want to delete {{$record['id']}} ?') ? '' : event.stopImmediatePropagation()" wire:click='delete({{$record['id']}})' >
                            <i class='fa fa-trash text-danger'></i>
                        </a>
                    </td> --}}
                    <td>
                        {{ date5($record['fromdate_at']) }} &nbsp;
                    
                        <livewire:edit-anchor :record="(object)$record" :eventoption="$editevent" wire:key="{{ time() . $record['id'] }}" /> 
                    
                        <livewire:print-modal :id="$record['id']" :eventoption="$printevent" wire:key="{{ time() . $record['id'] }}" /> 
                    
                        <a class="removeIncome pull-right" 
                           onclick="confirm('Are you sure you want to delete {{ $record['id'] }}?') ? '' : event.stopImmediatePropagation()" 
                           wire:click="delete({{ $record['id'] }})">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                        
                    </td>
                    <td>
                        <a href='#' data-href="" data-target='.bs-modal-lg' data-toggle='modal'>
                            {{$record['location']['name']}}
                        </a>
                    </td>
                    <td>
                        @if($record['account'])
                            {{$record['account']['name']}}
                            @else
                            None
                        @endif
                    </td>
                    <td>
                        {{$record['description']}}
                        
                    </td>
                    <td> {{format_currency($record['remittedamount'])}} </td>
                    <td> {{$record['incomeperc']}} </td>
                    <td> {{date5($record['fromdate_at'])}} </td>
                    <td> {{date5($record['todate_at'])}} </td>
                    <td> {{$record['receiptno']}} </td>
                    <td> 
                        @php
                            $total += $record['totalincome']
                        @endphp
                        {{format_currency($record['totalincome'])}} </td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="11" class="text-danger text-center">No data exist at the moment</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
    <tr>
        <td colspan="10" style="text-align:right">Total</td>
        <td class="total_words" data-total={{$total}}>{{format_currency($total)}}</td>
    </tr>
    </tfoot>
</table>
