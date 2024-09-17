<div class="table-responsive text-nowrap"> 

    <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse;table-layout: fixed; word-wrap:break-word;">
        <thead>
            <tr>

                @php $footercount = count($columns); $count; @endphp
                    @foreach($columns as $th=>$key)
    
                    <th 
                        @if($count <= 1) width = "50px"
                        @elseif($count == 2) width="100px" 
                        @elseif($count == 3) width="410px"
                        @else width="200px" 
                        @endif>
                        {!! wordwrap($th, 20, '<br>', false)  !!}
                    </th>
                    @php ++$count @endphp
                    @endforeach
            </tr>
        </thead>
        <tbody>
           
            @forelse($records as $tr)
                <tr>
                    {{-- <td><input type="checkbox" wire:model='{{time()}}'> </td> --}}
                    @foreach($tr as $td)
                       
                       {{-- @php 
                          $federal_amount += $td['ALLOCATION OF FUNDS FEDERAL'];
                          $state_amount += $td['ALLOCATION OF FUNDS STATE'];
                          $arrear_amount +=$td['ARREARS OF ALLOCATION'];
                          $contri_amount +=$td['CONTRIBUTION TO NLC'];
                          $advance_amount +=$td['ADVANCE ALLOCATION'];

                       @endphp --}}
                        <td>
                            {!! wordwrap($td, 120, '<br>', false)  !!}
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr><td colspan="22" class="text-center text-danger"> No record exist at the moment</td></tr>
            @endforelse
        </tbody>
        {{-- <tfoot>
            <tr>
                <td colspan="5" class="text-right total">Total</td>
                <td>{{$federal_amount}}</td>
                <td>{{$state_amount}}</td>
                <td>{{$arrear_amount}}</td>
                <td>{{$contri_amount}}</td>
                <td>{{$advance_amount}}</td>
            </tr>
        </tfoot> --}}
    </table>
</div> 