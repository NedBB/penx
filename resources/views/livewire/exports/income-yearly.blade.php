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
            @forelse($data as $record)
               
                <tr>
                    <td class="remove">
                        <input id="{{time()}}" type="checkbox" class="checkbox text-center"/>
                      </td>
                    <td>
                        <a href='#' data-href="" data-target='.bs-modal-lg' data-toggle='modal'>
                            {{$record->location->name}}
                        </a>
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
                <td colspan="3" class="text-danger text-center">No data exist at the moment</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
    <tr>
        <td colspan="1" style="text-align:right">Grand Total</td>
        <td class="total_words" data-total={{$total}}>{{format_currency($amount)}}</td>
        <td class="total_words" data-total={{$total}}>{{format_currency($total)}}</td>
    
    </tr>
    </tfoot>
</table>