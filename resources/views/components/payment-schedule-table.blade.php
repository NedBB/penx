<table class="table table-hover table-bordered dataTable font-13" id="result">
    <thead>
    <tr>
        <td style="width: 15px;"></td>
        <td>S/N</td>
        <td>Description</td>
        <td>PV No</td>
        <td>Record Type</td>
        <td>Amount</td>
        <td>Net Amount</td>
    </tr>
    </thead>
    <tbody>
        @php $count = 0; $tablename=''; $pvno=''; $netpay = 0;  @endphp
        @if($sort)
            @foreach($sort as $lists)
                @foreach($lists as $value)

                    @if( ($pvno == $value['pvno'] && $tablename == $value['tablename']) || ($tablename =='' && $pvno
                    == ''))
                        @php 
                            $pvno = $value['pvno']; $tablename = $value['tablename']; $netpay += $value['amount']
                        @endphp
                        <tr>
                            <td></td>
                            <td>{{++$count}}</td>
                            <td>{{($value['tablename'] == 'allocation')?$value['subhead']['name'].' for '
                            .$value['location']['name']
                            :$value['description']}}</td>
                            <td>{{$value['pvno']}}</td>
                            <td>{{$value['tablename']}}</td>
                            <td>{{format_money($value['amount'])}}</td>
                            <td>&nbsp;</td>
                        </tr>
                    @else
                        <tr>
                            <td style="visibility: hidden; border-top: 1px solid #fc0"></td>
                            <td style="border-right: 0"></td>
                            <td style="border-right: 0"></td>
                            <td style="border-right: 0"></td>
                            <td style="border-right: 0"></td>
                            <td style=""></td>
                            <td class="bold">{{format_money($netpay)}}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>{{++$count}}</td>
                            <td>{{($value['tablename'] == 'allocation')?$value['subhead']['name'].' for '
                            .$value['location']['name']
                            :$value['description']}}</td>
                            <td>{{$value['pvno']}}</td>
                            <td>{{$value['tablename']}}</td>
                            <td>{{format_money($value['amount'])}}</td>
                            <td>&nbsp;</td>
                        </tr>
                        @php $pvno = $value['pvno']; $tablename = $value['tablename']; $netpay = $value['amount'] @endphp
                    @endif

                @endforeach

            @endforeach
        @endif

        @if($pension)
            <tr>
                <td></td>
                <td>{{++$count}}</td>
                <td>Staff Contributory pension</td>
                <td>Contribution</td>
                <td>Pension</td>
                <td>{{format_money($pension)}}</td>
                <td></td>
            </tr>
            <tr>
                <td style="visibility: hidden"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td style=""></td>
                <td class="bold">{{format_money($pension)}}</td>
            </tr>
        @endif
        @if($nationpayroll)
            <tr>
                <td></td>
                <td>{{++$count}}</td>
                <td>Payroll for nationa officers</td>
                <td>Payroll</td>
                <td>NOF Payroll</td>
                <td>{{format_money($nationpayroll)}}</td>
                <td></td>
            </tr>
            <tr>
                <td style="visibility: hidden"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td style=""></td>
                <td class="bold">{{format_money($nationpayroll)}}</td>
            </tr>

        @endif
        @if($staffpayroll)
            <tr>
                <td></td>
                <td>{{++$count}}</td>
                <td>Payroll for staff</td>
                <td>Payroll</td>
                <td>Staff Payroll</td>
                <td>{{format_money($staffpayroll)}}</td>
                <td></td>
            </tr>
            <tr>
                <td style="visibility: hidden" class="check"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td style=""></td>
                <td class="bold">{{format_money($staffpayroll)}}</td>
            </tr>
        @endif
    <tfoot>
        <tr>
            <td style="border-right:0"></td>
            <td style="border-right:0"></td>
            <td style="border-right:0"></td>
            <td style="border-right:0"></td>
            <td style="border-right:0"></td>
            <td class="bold" style="text-align:right">Total</td>
            <td id="total" class="bold"></td>
        </tr>
    </tfoot>
    </tbody>

</table>