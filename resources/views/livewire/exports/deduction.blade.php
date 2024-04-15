<table class="table table-hover table-bordered table-striped">
    
    @if($data == "pension")
        <thead>
            <tr role="row">
                <th>Pension Id</th>
                <th>Name</th>
                <th>Employer[10%]</th>
                <th>Employee[8%]</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                   $total=0; 
                   $employers = 0;
                   $employee = 0;
            @endphp
            @forelse ($records as $record)
                @php 
                    $employer = $record->basicsalary * (10/100);
                    $sum = $record->amount + $employer;
                    $total += $sum;
                    $employers += $employer;
                   $employee += $record->amount;
                @endphp

                <tr>
                    <td class="text-capitalize">
                        {{$record->profile->pensionpin}}
                    </td>
                    <td class="text-capitalize">
                        {{$record->profile->fullname()}}
                    </td>
                    <td>
                        {{format_currency($employer)}}
                    </td>
                    <td>
                        {{format_currency($record->amount)}}
                    </td>
                    <td>
                        {{format_currency($sum)}}
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No data exist at the moment</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="align-right"><strong>Total</strong></td>
                <td><strong>{{format_currency($employers)}}</strong></td>
                <td><strong>{{format_currency($employee)}}</strong></td>
                <td><strong>{{format_currency($total)}}</strong></td>
            </tr>
        </tfoot>
    @else
        <thead>
            <thead>
                <tr role="row">
                    @if($data == 'tax')
                        <td>Tax Pin</td>
                    @else
                        <td>Unique Id</td>
                    @endif
                    <th>Name</th>
                    <th>Amount</th>
                </tr>
            </thead>
        </thead>
   
        <tbody>
            @php  $total = 0; @endphp
            @forelse ($records as $record)
                @php  $total += $record->amount; @endphp
                <tr wire:key='{{$record->id}}'>
                    {{-- <td class="text-capitalize" style="width: 80%">
                        {{$record->name}}
                    </td>
                    <td class="text-capitalize" style="width: 80%">
                        {{$record->name}}
                    </td>
                    <td class="text-capitalize" style="width: 80%">
                        {{$record->name}}
                    </td> --}}
                    <td class="text-capitalize">{{($data == 'tax')?$record->profile->taxpin:$record->profile->uniqueid}}</td>
                    <td>{{$record->profile->fullname()}}</td>
                    <td>{{format_currency($record->amount)}}</td>
                    {{-- <td class="text-center">

                    <livewire:edit-anchor :record="$department" :eventoption="$editevent" wire:key='{{time().$department->id}}' > 
                    &nbsp;
                    <a href="#" onclick="confirm('Are you sure you want to delete {{$department->name}} Department ?') ? '' : event.stopImmediatePropagation()" wire:click='delete({{$department->id}})'>
                        <i class="fa-solid fa-trash text-danger"></i>
                        </a>

                    </td> --}}
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-danger">No data exist at the moment</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="align-right"><strong>Total</strong></td>
                <td><strong>{{format_currency($total)}}</strong></td>
            </tr>
        </tfoot>
    @endif
</table>