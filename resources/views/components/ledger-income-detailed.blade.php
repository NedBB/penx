<table class="table table-hover table-bordered table-striped" id="result">
    <thead>
    <tr>
      
        <td>Sender</td>
        <td>Description</td>
        <td>Amount</td>
        <td>Percent</td>
        <td>Period From</td>
        <td>Period To</td>
        <td>Total Amount</td>
    </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @forelse($records as $groupname => $record)
            @php $remitted = 0; $subtotal = 0; @endphp
            <tr>
                {{-- <td class="remove">
                    <input id="{{time()}}" type="checkbox" class="checkbox text-center"/>
                  </td> --}}
                <td>
                    {{$groupname}}
                </td>
                <td></td>
                <td>

                </td>
                <td></td>
                <td>

                </td>
                <td>

                </td>
                <td>
                    {{-- <?php //$rowTotal = array_sum($record['totalincome']); $total +=  $rowTotal?> --}}
                </td>

            </tr>
            {{-- @php $record = usort($record['formdate_at']) @endphp --}}

            @foreach($record as $row)
                 @php   
                        $remitted += $row['remittedamount'];
                        $subtotal += $row['totalincome'];
                        // $total += $subtotal;
                 @endphp
                <tr>
                    {{-- <td></td> --}}
                    <td></td>
                    <td>
                        {{$row['description']}}
                        <a class="removeIncome pull-right" 
                           onclick="confirm('Are you sure you want to delete {{ $row['id'] }}?') ? '' : event.stopImmediatePropagation()" 
                           wire:click="delete({{ $row['id'] }})">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    </td>
                    <td>
                        {{format_currency($row['remittedamount'])}}
                    </td>
                    <td>
                        {{$row['incomeperc']}}
                    </td>
                    <td> {{date5($row['fromdate_at'])}} </td>
                    <td> {{date5($row['todate_at'])}} </td>
                    <td> {{format_currency($row['totalincome'])}} </td>
                </tr>
            @endforeach
            <tr>
                {{-- <td></td> --}}
                <td></td>
                <td style="text-align: right; font-weight: bold">
                    TOTAL
                </td>
                <td>{{format_money($remitted)}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{format_money($subtotal)}}</td>
            </tr>

            @php
                $total += $subtotal; // Move this outside the loop so it's correct
            @endphp
        @empty
            <tr>
                <td colspan="8" class="text-center text-danger">No data exist at the moment</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
    <tr>
        <td colspan="6" style="text-align:right">GRAND TOTAL</td>
        <td id="total_works" data-total={{$total}}>
            {{format_money($total)}}
        </td>
    </tr>
    </tfoot>
</table>

