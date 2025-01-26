<select class="form-control" @change="$dispatch('selectionChanged',{'value': $event.target.value})" name="record_id" wire:model='record_id'>
    <option>Select Option</option>
      
    @if (is_array($records))
        {{$data}}
        @foreach ($records as $key => $record)
            <option value="{{$key}}" @if($key == $data) selected @endif class="text-capitalize" class="text-capitalize">{{$record}}</option>
        @endforeach
    @else   
        @foreach ($records as $record)
         {{$data}}
            @if ($data)
                <option value="{{$record->id}}" @if($record->id == $data) selected @endif class="text-capitalize">{{$record->slug}}-{{$record->name}}</option>
            @else
                <option value="{{$record->id}}" class="text-capitalize">{{$record->slug}}-{{$record->name}}</option>
            @endif
        @endforeach
    @endif

</select>
