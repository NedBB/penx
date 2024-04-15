<table class="table table-hover table-bordered table-striped">
            <thead>
                <tr role="row">
                    <th width="30%">Fullname</th>
                    <th width="30%">Pension Pin</th>
                    <th>Employer</th>
                    <th>Employee</th>
                    <th>Contribution</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $employer = 0; 
                    $employee = 0; 
                    $total = 0; 
                @endphp

                @forelse ($records as $record)
                    @php 
                        $employer += $record->employer_pension; 
                        $employee += $record->employee_pension; 
                        $total += $record->contribution; 
                    @endphp

                    <tr>
                        <td class="text-capitalize">
                            {{$record->staffprofile->fullname()}}
                        </td>
                        <td class="text-capitalize">
                            {{$record->staffprofile->pensionpin}}
                        </td>
                        <td class="text-capitalize">
                            {{format_currency($record->employer_pension)}}
                        </td>
                        <td class="text-capitalize">
                            {{format_currency($record->employee_pension)}}
                        </td>
                        <td class="text-capitalize">
                            {{format_currency($record->contribution)}}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-danger">No data exist at the moment</td></tr>
                @endforelse
            </tbody>
            <tfoot>
                  <tr>
                    <td class="align-right" style="font-weght: bold" colspan="2" width="60%"><strong>Total</strong></td>
                    <td><strong>{{format_currency($employer)}}</strong></td>
                    <td><strong>{{format_currency($employee)}}</strong></td>
                    <td><strong>{{format_currency($total)}}</strong></td>
                  </tr>
            </tfoot>
       
        
</table>
