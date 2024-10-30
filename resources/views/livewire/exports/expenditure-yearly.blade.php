
<table style="width: 100%; table-layout: auto; border-collapse: collapse;" class="table table-hover table-bordered font-13 table-striped" id="result">
                   
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
                @if($subhead->name !== "UNKNOWN") 
                        <td style="border: 1px solid #ccc; padding: 8px;">{{$subhead->name}}</td>
                    @endif
                @endforeach
                <td>Total</td>
            </tr>

            <tr>
                @php
                    $total = 0;
                @endphp
                @foreach ($head->subheads as $subhead)
                    @php
                        $grand = $subhead->amount + $grand;
                    @endphp
                    @if($subhead->name !== "UNKNOWN") 
                        <td style="border: 1px solid #ccc; padding: 8px;">{{$subhead->amount}}</td>
                    @endif
                @endforeach
                <td>{{$subhead->amount}}</td>
            </tr>
            @endif
        @empty
            <tr><td colspan="1" class="text-center text-danger"> No record exist at the moment</td></tr>
        @endforelse
            
        <tr><td class="text-center text-danger"><strong>Grand Total</strong></td><td><strong>{{$grand}}</strong></td></tr>

    </tbody>
</table>