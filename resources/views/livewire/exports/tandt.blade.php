<table class="table table-hover table-bordered font-13 table-striped" id="printTable">
    <thead>
      <tr>
        <th class="remove">Date</th>
        <th>Description</th>
        <th>Transport</th>
        <th>House All</th>
        <th>Total Acc</th>
        <th>Food All</th>
        <th>Total Feeding</th>
        <th>Outstation</th>
        <th>Total Outstation</th>
        <th>Sit All</th>
        <th>Total Sitting</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @php
          $total_house = 0;
          $total_food = 0;
          $total_out = 0;
          $total_sit = 0;
          $sum_house = 0;
          $sum_house_all = 0;
          $sum_transport = 0;
          $sum_food = 0;
          $sum_food_all = 0;
          $sum_out = 0;
          $sum_out_all = 0;
          $sum_sit = 0;
          $sum_sit_all = 0;
          $sum_amount = 0;
        @endphp
        @forelse ($tts as $tt)
          @php
            //$total += $omni->amount;
            $total_house = ($tt->houseallowance * $tt->ha_multiple);
            $total_food = ($tt->foodallowance * $tt->fa_multiple);
            $total_out = ($tt->outstationallowance * $tt->os_multiple);
            $total_sit = ($tt->sittingallowance * $tt->sa_multiple);
           
            $sum_house += $tt->houseallowance;
            $sum_house_all += $total_house; 
            $sum_transport += $tt->transportallowance; 
            $sum_food += $tt->foodallowance; 
            $sum_food_all += $total_food; 
            $sum_out += $tt->outstationallowance; 
            $sum_out_all += $total_out; 
            $sum_sit += $tt->sittingallowance; 
            $sum_sit_all += $total_sit; 
            $sum_amount += $tt->totalamount; 
          @endphp
            <tr wire:key='{{$tt->id}}'>
              <td class="remove">
                  <span class="fw-medium">{{sqldate($tt->created_at)}}</span>
              </td>
              <td>
                  <span class="fw-medium">{{$tt->description}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($tt->transportallowance)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($tt->houseallowance)}}</span>
              </td>
              <td class="text-capitalize">

                  <span class="fw-medium">{{format_money($total_house) }}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($tt->foodallowance)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($total_food)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($tt->outstationallowance)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($total_out)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($tt->sittingallowance)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($total_sit)}}</span>
              </td>
              <td class="text-capitalize">
                  <span class="fw-medium">{{format_money($tt->totalamount)}}</span>
              </td>
            </tr>
        @empty
            <tr><td colspan="14" class="text-center text-danger">No data exist at the moment</td></tr>
        @endforelse
        </tbody>
  </table>