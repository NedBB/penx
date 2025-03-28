@if($view == 'summarized')
    <div>
        <table class="table table-hover table-bordered table-striped" id="summarized">
            <thead>
            <tr>
                <td></td>
                <td>Sender</td>
                <td>Amount</td>
                <td>Period From</td>
                <td>Period To</td>
                <td>Total Amount</td>
            </tr>
            </thead>
            <tbody>
                <?php $total = 0;  ?>
                @forelse($records as $groupname => $record)
                @foreach ($record as $list)
                    <tr>
                        <td></td>
                        <td>
                            {{$groupname}}
                        </td>
                        <td>
                            @php 
                                $remitted = 0;

                                if(is_array($list['remittedamount'])){
                                    $remitted = array_sum($list['remittedamount']); 
                                }else{
                                    $remitted = $list['remittedamount'];
                                }
                                
                            @endphp 
                            {{($remitted)}}
                        </td>
                        <td>
                            @php 
                                $min_date;
                                if(is_array($list['fromdate_at'])){
                                    $min_date = min($list['fromdate_at']);
                                }else{
                                    $min_date = $list['fromdate_at'];
                                }
                            @endphp
                            {{ $min_date }}
                        </td>
                        <td>
                            @php 
                                $max_date;
                                if(is_array($list['todate_at'])){
                                    $max_date = min($list['todate_at']);
                                }else{
                                    $max_date = $list['todate_at'];
                                }
                            @endphp
                            {{ $min_date }}
                            
                        </td>
                        <td>
                            <?php 
                                $rowTotal = 0;

                                if(is_array($list['totalincome'])){
                                    $rowTotal = array_sum($list['totalincome']); 
                                }else{
                                    $rowTotal = $list['totalincome'];
                                }
                            
                                $total +=  $rowTotal
                                
                                ?> 
                            {{$rowTotal}}
                        </td>

                    </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-danger">No data exist at the moment</td>
                    </tr> 
                @endforelse
            </tbody>
            <tfoot id="summarized_footer">
            <tr>
                <td colspan="5" style="text-align:right">Total</td>
                <td id="summarized_total">
                    {{$total}}
                </td>
            </tr>
            </tfoot>
        </table>

        
    </div>
    
@elseif ($view == "detailed")
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
            <?php $total = 0; $remitted = 0; $subtotal = 0; ?>
            @forelse($records as $groupname => $record)

                <tr>
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
                            $total += $subtotal;
                    @endphp
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            {{$row['description']}}
                            
                        </td>
                        <td>
                            {{$row['remittedamount']}}
                        </td>
                        <td>
                            {{$row['incomeperc']}}
                        </td>
                        <td> {{date5($row['fromdate_at'])}} </td>
                        <td> {{date5($row['todate_at'])}} </td>
                        <td> {{$row['totalincome']}} </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align: right; font-weight: bold">
                        TOTAL
                    </td>
                    <td>{{$remitted}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$subtotal}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-danger">No data exist at the moment</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
        <tr>
            <td colspan="7" style="text-align:right">GRAND TOTAL</td>
            <td>
                {{$total}}
            </td>
        </tr>
        </tfoot>
    </table>
    
@elseif($view == 'all')

    <table class="table table-hover table-bordered table-striped" id="datatable-result">
        <thead>
            <tr>
                <th></td>
                <th>Date Paid</th>
                <th>Sender</th>
                <th>Account</th>
                <th>Description</th>
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
                        <td></td>
                        <td>
                                {{date5($record['fromdate_at'])}}
                        </td>
                        <td>
                                {{$record['location']['name']}}
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
                        <td> {{$record['remittedamount']}} </td>
                        <td> {{$record['incomeperc']}} </td>
                        <td> {{date5($record['fromdate_at'])}} </td>
                        <td> {{date5($record['todate_at'])}} </td>
                        <td> {{$record['receiptno']}} </td>
                        <td> 
                            @php
                                $total += $record['totalincome']
                            @endphp
                            {{$record['totalincome']}} </td>
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
                <td>{{$total}}</td>
            </tr>
        </tfoot>
    </table>
@else
@endif