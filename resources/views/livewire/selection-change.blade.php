<select class="form-control" @change="$dispatch('selectionChanged',{'value': $event.target.value})" name="record_id" wire:model='record_id'>
    <option>Select Option</option>

    @if (is_array($records))
        @foreach ($records as $key => $record)
            <option value="{{$key}}" class="text-capitalize">{{$record}}</option>
        @endforeach
    @else
        @foreach ($records as $record)
            <option value="{{$record->id}}" class="text-capitalize">{{$record->name}}</option>
        @endforeach
    @endif
    
</select>
