<div class="table-responsive text-nowrap"> 

    {{-- <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse;table-layout: fixed; word-wrap:break-word;">
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
                    <td><input type="checkbox" wire:model='{{time()}}'> </td>
                    @foreach($tr as $td)
                       
                       {{-- @php 
                          $federal_amount += $td['ALLOCATION OF FUNDS FEDERAL'];
                          $state_amount += $td['ALLOCATION OF FUNDS STATE'];
                          $arrear_amount +=$td['ARREARS OF ALLOCATION'];
                          $contri_amount +=$td['CONTRIBUTION TO NLC'];
                          $advance_amount +=$td['ADVANCE ALLOCATION'];

                       @endphp 
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
        </tfoot> 
    </table> --}}

    <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse; table-layout: fixed; word-wrap: break-word;">
        <thead>
            <tr>
                <th width="50px" class="noExport remove"></th>
                @php 
                    $footercount = count($columns); 
                    $count = 0; 
                @endphp
                @foreach($columns as $th => $key)
                    <th 
                        @if($count <= 1) width="50px"
                        @elseif($count == 2) width="100px"
                        @elseif($count == 3) width= "600px"
                        @else width="400px" 
                        @endif
                    >
                        {{-- {!! wordwrap($th, 20, '<br>', false) !!} --}}
                        {{$th}}
                    </th>
                    @php ++$count; @endphp
                @endforeach
            </tr>
        </thead>
        <tbody>
            
            @php
                $federal_amount = 0;
                $state_amount = 0;
                $arrear_amount = 0;
                $contri_amount = 0;
                $advance_amount = 0;
            @endphp

            @forelse($records as $tr)
                <tr>
                    <td class="remove text-center">
                        <input type="checkbox" wire:model="{{time()}}">
                    </td>
                    {{-- @php 
                        $federal_amount += $tr['ALLOCATION OF FUNDS FEDERAL'] ?? 0;
                        $state_amount += $tr['ALLOCATION OF FUNDS STATE'] ?? 0;
                        $arrear_amount += $tr['ARREARS OF ALLOCATION'] ?? 0;
                        $contri_amount += $tr['CONTRIBUTION TO NLC'] ?? 0;
                        $advance_amount += $tr['ADVANCE ALLOCATION'] ?? 0;
                    @endphp --}}

                    @foreach($tr as $td)
                   
                        {{-- @php 
                            $federal_amount += $td['ALLOCATION OF FUNDS FEDERAL'] ?? 0;
                            $state_amount += $td['ALLOCATION OF FUNDS STATE'] ?? 0;
                            $arrear_amount += $td['ARREARS OF ALLOCATION'] ?? 0;
                            $contri_amount += $td['CONTRIBUTION TO NLC'] ?? 0;
                            $advance_amount += $td['ADVANCE ALLOCATION'] ?? 0;
                        @endphp --}}
                        <td>
                            {{-- {!! wordwrap($td, 120, '<br>', false) !!} --}}
                            {{$td}}
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + 1 }}" class="text-center text-danger">No record exists at the moment</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>
</div> 