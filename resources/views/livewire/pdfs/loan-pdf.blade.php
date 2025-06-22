@extends('layouts.printer')
@section('content')
  <table class="table table-hover table-bordered font-13 table-striped" id="selected">
    <thead>
      <tr>
        <th>Staff Name</th>
        <th>Loan type</th>
        <th>Principal Amount</th>
        <th>Period</th>
        <th>Payable Amount</th>
        <th>Monthly Due</th>
        <th>Effective Date</th>
        <th>Expiry Date</th>
      </tr>
    </thead>
    <tbody class="table-border-bottom-0">
      
        @php
          $principal = 0;
          $payable = 0;
          $monthly = 0;
        @endphp
        @forelse ($loans as $loan)
           @php
              $principal += $loan->principalamount;
              $payable += $loan->payableamount;
              $monthly += $loan->monthlydue;
           @endphp

            <tr wire:key='{{$loan->id}}'>
              <td class="text-capitalize">
                  <span class="fw-medium">{{$loan->profile->fullname()}}</span>
                  </td>
                <td class="text-capitalize">
                <span class="fw-medium">{{$loan->loantype->name;}}</span>
                </td>
                <td>
                    <span class="fw-medium">{{format_currency($loan->principalamount)}}</span>
                </td>
                <td>{{$loan->period}}</td>
                <td>
                    <span class="fw-medium">{{format_currency($loan->payableamount)}}</span>
                </td>
                <td>{{format_currency($loan->monthlydue)}}</td>
                <td>{{sqldate($loan->effectivedate)}}</td>
                <td>{{sqldate($loan->expirydate)}}</td>
            </tr>
        @empty
            <tr><td colspan="9" class="text-center text-danger">No data exist at the moment</td></tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
          <td colspan="2" class="align-right">Total</td>
          <td>{{format_currency($principal)}}</td>
          <td></td>
          <td>{{format_currency($payable)}}</td>
          <td>{{format_currency($monthly)}}</td>
          <td></td>
        </tr>
    </tfoot>
  </table>
@endsection