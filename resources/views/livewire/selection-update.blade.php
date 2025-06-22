
<select class="form-control" name="record_id" @change="$dispatch('selectionSubhead',{'value': $event.target.value})" wire:model='recordx_id'>
    <option>Select Option</option>
        @foreach ($records as $record)
            <option value="{{$record['id']}}" wire:key='{{$record['id']}}'>
                @if(isset($record['name']))
                   {{-- @if($type="add-grouphead-name")

                   @else --}}
                    {{$record['name']}} 
                   {{-- @endif --}}
                @else 
                    {{$record['firstname']}} {{$record['surname']}} 
                @endif
            </option>
        @endforeach
</select>
