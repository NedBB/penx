<table class="table">
    <thead>
      <tr>
       
        <th>Date</th>
        <th>Sub Head</th>
        <th>Description</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody class="table-border-bottom-0">
    
        @forelse ($omnibusses as $omni)
            <tr wire:key='{{$omni->id}}'>
              
              <td class="text-capitalize">
                  <span class="fw-medium">{{sqldate($omni->created_at)}}</span>
                  </td>
                <td class="text-capitalize">
                <span class="fw-medium">{{$omni->subhead->name}}</span>
                </td>
                <td>
                    <span class="fw-medium">{{$omni->description}}</span>
                </td>
                <td>
                    <span class="fw-medium">{{$omni->amount}}</span>
                </td>
               
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-danger">No data exist at the moment</td></tr>
        @endforelse
    </tbody>
  </table>