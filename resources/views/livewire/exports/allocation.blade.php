<table class="table table-hover table-bordered font-13 table-striped" id="printTable">
    <thead>
      <tr>
        <th class="remove">Date</th>
        <th>Subhead</th>
        <th>State</th>
        <th>Total Check-off</th>
        <th>Gross Pay</th>
        <th>Legal</th>
        <th>Constition</th>
        <th>Almanac</th>
        <th>Badges</th>
        <th>Advance Allocation</th>
        <th>Arrears</th>
        <th>Norther Dues</th>
        <th>Audit Fee</th>
        <th>Net Pay</th>
      </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        
        @forelse ($allocations as $list)
          
            <tr wire:key='{{$list->id}}'>
              <td class="remove">
                  <span class="fw-medium">{{sqldate($list->created_at)}}</span>
              </td>
              <td>
                  <span class="fw-medium">{{$list->subhead->name}}</span>
              </td>
              <td>
                <span class="fw-medium">{{$list->location->name}}</span>
            </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($list->remittedamount)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($list->grosspay)}}</span>
              </td>
              <td class="text-capitalize">

                  <span class="fw-medium">{{format_money($list->legal) }}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($list->constitution)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($list->almanac)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($list->badges)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($list->advanceallocation)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($list->arrears)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($list->magazine)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($list->auditfee)}}</span>
              </td>
              <td class="text-capitalize">
                <span class="fw-medium">{{format_money($list->netpay)}}</span>
            </td>
             
            </tr>
        @empty
            <tr><td colspan="16" class="text-center text-danger">No data exist at the moment</td></tr>
        @endforelse
    </tbody>
    
  </table>