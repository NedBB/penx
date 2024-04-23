<table class="table table-hover table-bordered font-13 table-striped">
    <thead>
      <tr>
        <th>Unique ID</th>
        <th>Surname</th>
        <th>Firstname</th>
        <th>Middlename</th>
        <th>Status</th>
        <th>Gradelevel name</th>
        <th>Gradelevel</th>
        <th>Step</th>
        <th>Position</th>
        <th>Account No</th>
        <th>Basic Salary [₦]</th>
      </tr>
    </thead>
    <tbody class="table-border-bottom-0">
    
        @forelse ($staff as $list)
            <tr wire:key='{{$list->id}}' >
              <td @if($list->active == false) class="text-danger" @endif>
                  {{$list->uniqueid}}                  
              </td>
               <td class="text-capitalize">
                  {{$list->surname}}
                  </td>
                <td class="text-capitalize ">
                  {{$list->firstname}}
                </td>
                <td class="text-capitalize">
                  {{$list->middlename}}
                </td>
                <td>
                  {{($list->active) ? "Active" : "Disabled"}}
                </td>
                <td>{{$list->gradelevel->gradelevelname->name}}</td>
                <td>{{$list->gradelevel->level}}</td>
                <td>{{$list->step}}</td>
                <td class="text-capitalize">
                  {{$list->dutystation->name}}
                </td>
                <td class="text-capitalize">
                  {{$list->accountno}}
                </td>
                <td class="text-capitalize">
                  {{round(($list->conposs->baseamount)/12,2)}}
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-danger">No data exist at the moment</td></tr>
        @endforelse
    </tbody>
  </table>