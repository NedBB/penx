<select class="form-control" @change="$dispatch('selectionChanged',{'value': $event.target.value})" name="head_id" wire:model='head_id'>
    <option>Select Option</option>
    @foreach ($heads as $head)
        <option value="{{$head->id}}">{{$head->name}}</option>
    @endforeach
</select>
