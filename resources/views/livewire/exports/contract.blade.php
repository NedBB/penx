<table class="table table-hover table-bordered font-13 table-striped" id="selected">
    <thead>
      <tr>
        <th>Number</th>
        <th>Full Name</th>
        <th>Company Name</th>
        <th>Title</th>
        <th>Description</th>
        <th>Cost</th>
        <th>Paid</th>
        <th>Start Date</th>
        <th>Exp. Delivery Date</th>
        <th>Delivery Date</th>
        <th>CreatedAt</th>
      </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        
        @forelse ($contracts as $list)
           
            <tr wire:key='{{$list->id}}'>
              <td class="text-capitalize">
                  <span class="fw-medium">{{$list->number}}</span>
                  
                </td>
                  </td>
                <td class="text-capitalize">
                <span class="fw-medium">{{$list->contractor->fullname()}}</span>
                </td>
                <td>
                    <span class="fw-medium">{{$list->company_name}}</span>
                </td>
                <td>{{$list->title}}</td>
                <td>{{$list->description}}</td>
                <td>
                    {{format_money($list->cost)}}</span>
                </td>
                <td>{{format_currency($list->contractpayments->sum('paid_amount'))}}</td>
                <td>{{$list->start_at}}</td>
                <td>{{sqldate($list->expected_end_at)}}</td>
                <td>{{$list->end_at}}</td>
                <td>{{sqldate($list->created_at)}}</td>
                
            
            </tr>
        @empty
            <tr><td colspan="11" class="text-center text-danger">No data exist at the moment</td></tr>
        @endforelse
    </tbody>
    
  </table>