<table class="table table-hover table-bordered dataTable font-13" id="result">
    <thead>
    <tr>
        <td style="width: 15px;" class="remove"></td>
        <td  class="remove">S/N</td>
        <td>Description</td>
        <td>PV No</td>
        <td class="remove">Record Type</td>
        <td>Amount</td>
        <td>Net Amount</td>
    </tr>
    </thead>
    <tbody>
        @php $count = 0; $tablename=''; $pvno=''; $netpay = 0; $total = 0;  @endphp
        @if($sort)
            @foreach($sort as $lists)
                @foreach($lists as $value)
                    @if( ($pvno == $value['pvno'] && $tablename == $value['tablename']) || ($tablename =='' && $pvno == ''))
                        @php 
                            $pvno = $value['pvno']; $tablename = $value['tablename']; $netpay += $value['amount'];
                            $total += $value['amount']
                       @endphp
                        <tr>
                            <td class="remove">
                                <input id="{{time()}}" type="checkbox" class="checkbox text-center"/>
                              </td>
                            <td class="remove">{{++$count}}</td>
                            <td>{{($value['tablename'] == 'allocation')?$value['subhead']['name'].' for '
                            .$value['location']['name']
                            :$value['description']}}</td>
                            <td>{{$value['pvno']}}</td>
                            <td class="remove">{{$value['tablename']}}</td>
                            <td class="amount">{{format_money($value['amount'])}}</td>
                            {{-- <td class="remove">&nbsp;</td> --}}
                        </tr>
                    @else
                        @php
                            $total += $value['amount']
                        @endphp
                        <tr>
                            <td style="visibility: hidden; border-top: 1px solid #fc0"></td>
                            <td style="border-right: 0"></td>
                            <td style="border-right: 0"></td>
                            <td class="remove"></td>
                            <td class="remove"></td>
                            <td class="remove"></td>
                            <td class="bold">{{format_money($netpay)}}</td>
                        </tr>

                        <tr>
                            <td class="remove"><input id="{{time()}}" type="checkbox" class="checkbox text-center"/>
                            </td>
                            <td class="remove">{{++$count}}</td>
                            <td>{{($value['tablename'] == 'allocation')?$value['subhead']['name'].' for '
                            .$value['location']['name']
                            :$value['description']}}</td>
                            <td>{{$value['pvno']}}</td>
                            <td  class="remove">{{$value['tablename']}}</td>
                            <td class="amount">{{format_money($value['amount'])}}</td>
                            {{-- <td>&nbsp;</td> --}}
                        </tr>
                        @php $pvno = $value['pvno']; $tablename = $value['tablename']; $netpay = $value['amount'] @endphp
                    @endif

                @endforeach

            @endforeach
        @endif

        @if($pension)
        @php
               $total += $pension
           @endphp
            <tr>
                <td class="remove">
                    <input id="{{time()}}" type="checkbox" class="checkbox text-center"/>
                  </td>
                <td class="remove">{{++$count}}</td>
                <td>Staff Contributory pension</td>
                <td>Contribution</td>
                <td>Pension</td>
                <td class="amount">{{format_money($pension)}}</td>
                {{-- <td></td> --}}
            </tr>
            <tr >
                <td style="visibility: hidden"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td class="remove"></td>
                <td class="remove"></td>
                <td class="remove"></td>
                <td class="bold">{{format_money($pension)}}</td>
            </tr>
        @endif
        @if($nationpayroll)

        @php
               $total += $nationpayroll
           @endphp
            <tr>
                <td class="remove">
                    <input id="{{time()}}" type="checkbox" class="checkbox text-center"/>
                  </td>
                <td  class="remove"> {{++$count}}</td>
                <td>Payroll for nationa officers</td>
                <td>Payroll</td>
                <td>NOF Payroll</td>
                <td class="amount">{{format_money($nationpayroll)}}</td>
                {{-- <td></td> --}}
            </tr>
            <tr>
                <td style="visibility: hidden"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td class="remove"></td>
                <td class="remove"></td>
                <td class="remove"></td>
                <td class="bold">{{format_money($nationpayroll)}}</td>
            </tr>

        @endif
        @if($staffpayroll)
           @php
               $total += $staffpayroll
           @endphp
            <tr>
                <td class="remove">
                    <input id="{{time()}}" type="checkbox" class="checkbox text-center"/>
                  </td>
                <td  class="remove">{{++$count}}</td>
                <td>Payroll for staff</td>
                <td class="remove">Payroll</td>
                <td  class="remove">Staff Payroll</td>
                <td class="amount">{{format_money($staffpayroll)}}</td>
                {{-- <td></td> --}}
            </tr>
            <tr>
                <td style="visibility: hidden" class="check"></td>
                <td style="border-right: 0"></td>
                <td style="border-right: 0"></td>
                <td class="remove"></td>
                <td class="remove"></td>
                <td class="remove"></td>
                <td class="bold">{{format_money($staffpayroll)}}</td>
            </tr>
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td class="remove"></td>
            <td class="remove"></td>
            <td class="remove"></td>
            <td class="remove"></td>
            <td class="remove"></td>
            <td class="bold" style="text-align:right">Total</td>
            <td ></td>
            <td ></td>
            {{-- <td ></td>
            <td ></td>
            <td ></td> --}}
            <td  id="total_words" data-total={{$total}} class="bold">{{format_money($total)}}</td>
        </tr>
    </tfoot>
    

</table>