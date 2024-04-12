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
                        {{format_money(($remitted))}}
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
                        {{format_money($rowTotal)}}
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
                {{format_money($total)}}
            </td>
        </tr>
        </tfoot>
    </table>

    @script
        <script>
            
                console.log("DOM fully loaded and parsed");
                let excel_export = document.getElementById('export_excel');
                excel_export.addEventListener('click',(event) => {
                    alert('hello');
                })

            
            
        </script>
    @endscript
</div>
