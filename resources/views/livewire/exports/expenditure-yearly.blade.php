
<table style="width: 100%; table-layout: auto; border-collapse: collapse;"  id="result">
                   
    <tbody>
        <tr><td><strong>{{$year}} EXPENDITURE</strong></td></tr>
        @php
            $grand = 0;
        @endphp
        @forelse($data as $head)

        @if ($head->name != 'CONTRAL')
        
            <tr>
                <td style="font-weight:bold" colspan="{{$head->cols}}">
                    <span style="color:red">{{$head->slug}}</span>
                    <span>   {{$head->name}} </span>
                </td>
            </tr>
            <tr>
                @foreach ($head->subheads as $subhead)
                {{-- @if($subhead->name !== "UNKNOWN")  --}}
                        <td>{{$subhead->name}}</td>
                    {{-- @endif --}}
                @endforeach
                <td>Total</td>
            </tr>

            <tr>
                @php
                    $total = 0;
                @endphp
                @foreach ($head->subheads as $subhead)
                    @php
                        $total += $subhead->amount; // Add each subhead's amount
                        $grand += $subhead->amount; // Add to grand total
                    @endphp
                    {{-- @if($subhead->name !== "UNKNOWN")  --}}
                        <td>{{$subhead->amount}}</td>
                    {{-- @endif --}}
                @endforeach
                <td>{{$total}}</td>
            </tr>
            @endif
        @empty
            <tr><td colspan="1" class="text-center text-danger"> No record exist at the moment</td></tr>
        @endforelse
            
        <tr class="total-cell"><td class="text-center text-danger"><strong>Grand Total</strong></td><td><strong>{{$grand}}</strong></td></tr>

    </tbody>
</table>