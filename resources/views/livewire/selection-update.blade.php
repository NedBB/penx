
<select class="form-control" name="subhead_id" @change="$dispatch('selectionSubhead',{'value': $event.target.value})" wire:model='subhead_id'>
    <option>Select Option</option>
   
    @forelse ($subheads as $sub)
        <option value="{{$sub['id']}}" wire:key='{{$sub['id']}}'>{{$sub['name']}}</option>
    @empty
        
    @endforelse
</select>
