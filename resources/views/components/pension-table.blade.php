<table class="table">
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
                @forelse ($records as $record)

                    <tr>
                        <td class="text-capitalize">
                            {{$record->staffprofile->fullname()}}
                        </td>
                        <td class="text-capitalize">
                            {{$record->staffprofile->pensionpin}}
                        </td>
                        <td class="text-capitalize">
                            {{$record->employer_pension}}
                        </td>
                        <td class="text-capitalize">
                            {{$record->employee_pension}}
                        </td>
                        <td class="text-capitalize">
                            {{$record->contribution}}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-danger">No data exist at the moment</td></tr>
                @endforelse
            </tbody>
            <tfooter>
                  <tr>
                    <td style="font-weght: bold" colspan="2" width="60%">Total</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                  </tr>
            </tfooter>
       
        
</table>
