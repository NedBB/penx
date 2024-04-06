<div class="">
    <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse;table-layout: fixed;
  word-wrap:break-word;">
        <thead>
        <tr class="bold">
            <th width="50px"></th>
            <th width="50px">#</th>
            <th width="200px">Names</th>
            <th width="150px">G.level</th>
            <th width="80x">Step</th>
            <th width="120px">Acct.No</th>
            <th width="120px">Bank</th>
            <th width="120px">Basic Salary</th>
            <th width="120px">Rent</th>
            <th width="120px">Transpt</th>
            <th width="120px">Meal</th>
            <th width="120px">Util</th>
            <th width="120px">Ent</th>
            <th width="120px">Gross Pay</th>
            <th width="120px">Coop</th>
            <th width="120px">Sal. Adv</th>
            <th width="120px">Loan</th>
            <th width="120px">Tax</th>
            <th width="120px">Pension</th>
            <th width="120px">NHF</th>
            <th width="120px">T. Deduct</th>
            <th width="120px">Net Pay</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr>
                    <td class="text-center"><input type="checkbox" wire:model='selectRow'></td>
                    <td>{{++$count}}</td>
                    <td>{{$record->profile->fullname()}}</td>
                    <td>{{$record->profile->gradelevel->gradelevelname->name.' '.$record->profile->gradelevel->level}}</td>
                    <td>{{$record->profile->step}}</td>
                    <td>{{$record->profile->accountno}}</td>
                    <td>{{($record->profile->bank) ? $record->profile->bank->name: 'UNKNOWN BANK'}}</td>
                    <td>{{format_currency($record->basicsalary)}}</td>
                    <td>{{format_currency($record->rent)}}</td>
                    <td>{{format_currency($record->utility)}}</td>
                    <td>{{format_currency($record->entertainment)}}</td>
                    <td>{{format_currency($record->contribution)}}</td>
                    <td>{{format_currency($record->transport)}}</td>
                    <td>{{format_currency($record->meal)}}</td>
                    <td>{{format_currency($record->grosspay)}}</td>
                    <td>{{format_currency($record->salaryadvance)}}</td>
                    <td>{{format_currency($record->pension)}}</td>
                    <td>{{format_currency($record->loan)}}</td>
                    <td>{{format_currency($record->tax)}}</td>
                    <td>{{$record->nhf}}</td>
                    <td>{{format_currency($record->totaldeduction)}}</td>
                    <td>{{format_currency($record->netpay)}}</td>
                </tr>
            @empty
                <tr><td colspan="22" class="text-center text-danger"> No record exist at the moment</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-right"><strong>Total</strong></td>
                <td id="total1"></td>
                <td id="total2"></td>
                <td id="total3"></td>
                <td id="total4"></td>
                <td id="total5"></td>
                <td id="total6"></td>
                <td id="total7"></td>
                <td id="total8"></td>
                <td id="total9"></td>
                <td id="tota110"></td>
                <td id="total11"></td>
                <td id="total12"></td>
                <td id="total13"></td>
                <td id="total14"></td>
                <td id="total15"></td>
            </tr>
        </tfoot>
    </table>
</div>