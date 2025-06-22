<table class="table table-hover table-bordered table-striped" id="datatable-result">
    <thead>
    <tr>
        <th>Sender</th>
        <th>Amount</th>
        <th>Total Amount</th>
    </tr>
    </thead>
    @php $amount= 0; $total = 0;  @endphp
    <tbody>
       
        @forelse($data as $record)
               
                <tr>
                    
                    <td>
                            {{$record->location->name}}
                    </td>
                    <td> {{$record->amount}} </td>
                    <td> {{$record->total}} </td>
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
        <td>{{$amount}}</td>
        <td>{{$total}}</td>
    
    </tr>
    </tfoot>
</table>