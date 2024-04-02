<table class="table">

    @if($data == "pension")
        <thead>
            <tr role="row">
                <th>Pension Id</th>
                <th>Name</th>
                <th>Employer[10%]</th>
                <th>Employer[8%]</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr wire:key='{{$department->id}}'>
                    <td class="text-capitalize" style="width: 80%">
                        {{$department->name}}
                    </td>
                    <td class="text-center">

                    <livewire:edit-anchor :record="$department" :eventoption="$editevent" wire:key='{{time().$department->id}}' > 
                    &nbsp;
                    <a href="#" onclick="confirm('Are you sure you want to delete {{$department->name}} Department ?') ? '' : event.stopImmediatePropagation()" wire:click='delete({{$department->id}})'>
                        <i class="fa-solid fa-trash text-danger"></i>
                        </a>

                    </td>
                </tr>
            @empty
                <tr><td colspan="2">No data exist at the moment</td></tr>
            @endforelse
        </tbody>
    @elseif($data == "tax")
        <thead>
            <tr role="row">
                <th>Tax Pin</th>
                <th>Name</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr wire:key='{{$department->id}}'>
                    <td class="text-capitalize" style="width: 80%">
                        {{$department->name}}
                    </td>
                    <td class="text-center">

                    <livewire:edit-anchor :record="$department" :eventoption="$editevent" wire:key='{{time().$department->id}}' > 
                    &nbsp;
                    <a href="#" onclick="confirm('Are you sure you want to delete {{$department->name}} Department ?') ? '' : event.stopImmediatePropagation()" wire:click='delete({{$department->id}})'>
                        <i class="fa-solid fa-trash text-danger"></i>
                        </a>

                    </td>
                </tr>
            @empty
                <tr><td colspan="2">No data exist at the moment</td></tr>
            @endforelse
        </tbody>
    @else
        <thead>
            <thead>
                <tr role="row">
                    <th>Unique Id</th>
                    <th>Name</th>
                    <th>Amount</th>
                </tr>
            </thead>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr wire:key='{{$record->id}}'>
                    <td class="text-capitalize" style="width: 80%">
                        {{$department->name}}
                    </td>
                    <td class="text-center">

                    <livewire:edit-anchor :record="$department" :eventoption="$editevent" wire:key='{{time().$department->id}}' > 
                    &nbsp;
                    <a href="#" onclick="confirm('Are you sure you want to delete {{$department->name}} Department ?') ? '' : event.stopImmediatePropagation()" wire:click='delete({{$department->id}})'>
                        <i class="fa-solid fa-trash text-danger"></i>
                        </a>

                    </td>
                </tr>
            @empty
                <tr><td colspan="2">No data exist at the moment</td></tr>
            @endforelse
        </tbody>

    @endif
</table>