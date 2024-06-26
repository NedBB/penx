<table style="width: 100%; table-layout: auto; border-collapse: collapse;" class="table table-hover table-bordered font-13 table-striped" id="expenditure-yearly">
                   
    <tbody>
        <tr><td style="font-size:14px; padding: 5px" ><strong>{{$year}} EXPENDITURE</strong></td></tr>
        @forelse($data as $head)
            <tr>
                <td style="font-weight:bold;font-size:13px" colspan="{{$head->cols}}">
                    <span style="color:#ff0000">{{$head->slug}} &nbsp;</span>&nbsp;
                    <span>&nbsp;{{$head->name}} </span>
                </td>
            </tr>
            <tr>
                @foreach ($head->subheads as $subhead)
                    @if($subhead->name !== "UNKNOWN") 
                        <td style="border: 1px solid #ccc; font-size:11px;font-weight:bold; padding: 5px;">{{$subhead->name}}</td>
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
                        $total += $subhead->amount;
                    @endphp
                    @if($subhead->name !== "UNKNOWN") 
                        <td style="border: 1px solid #ccc; padding: 8px;">{{format_money($subhead->amount)}}</td>
                    @endif
                @endforeach
                <td>{{format_money($total)}}</td>
            </tr>
        @empty
            <tr><td colspan="1" class="text-center text-danger"> No record exist at the moment</td></tr>
        @endforelse
    </tbody>
</table>