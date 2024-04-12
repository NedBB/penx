<table class="table table-hover table-bordered table-striped" id="datatable-result">
    <thead>
    <tr>
        <td></td>
        <td>Date Paid</td>
        <td>Sender</td>
        <td>Account</td>
        <td>Description</td>
        <td>Amount</td>
        <td>Percent</td>
        <td>Period From</td>
        <td>Period To</td>
        <td>Receipt No.</td>
        <td>Total Amount</td>
    </tr>
    </thead>
    <tbody>
        <?php $bottomTotal = 0  ?>
        @forelse($records ?? [] as $groupname => $groupdata)
            @foreach($groupdata->sortBy('fromdate_at') as $record)
                <tr>
                    <td></td>
                    <td>
                        <a href='#' data-href="" class='' data-target='.bs-modal-lg' data-toggle='modal'>
                            {{date5($record->fromdate_at)}}
                        </a>
                    </td>
                    <td>
                        <a href='#' data-href="" data-target='.bs-modal-lg' data-toggle='modal'>
                            {{$record->location->name}}
                        </a>
                    </td>
                    <td>
                        @if($record->account)
                            {{$record->account->name}}
                            @else
                            None
                        @endif
                    </td>
                    <td>
                        {{$record->description}}
                        <a href="{{route('post.entry.income.delete', $record->id)}}" class='removeIncome pull-right' >
                            <i class='fa fa-trash text-danger'></i>
                        </a>
                    </td>
                    <td> {{format_currency($record->remittedamount)}} </td>
                    <td> {{$record->incomeperc}} </td>
                    <td> {{date5($record->fromdate_at)}} </td>
                    <td> {{date5($record->todate_at)}} </td>
                    <td> {{$record->receiptno}} </td>
                    <td> {{format_currency($record->totalincome)}} </td>
                </tr>
            @endforeach
            @php $bottomTotal += $groupdata->sum('totalincome') @endphp
        @empty
            <tr>
                <td colspan="11" class="text-danger text-center">No data exist at the moment</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
    <tr>
        <td colspan="10" style="text-align:right">Total</td>
        <td>{{format_currency($bottomTotal)}}</td>
    </tr>
    </tfoot>
</table>
