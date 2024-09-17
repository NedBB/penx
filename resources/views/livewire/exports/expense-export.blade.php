<table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse;table-layout: fixed; word-wrap:break-word;">
    <thead>
      <tr class="bold">
          <th width="200px">HEAD</th>
          <th width="200px">SUBHEAD</th>
          <th width="150px">PVNO</th>
          <th width="150px">AMOUNT</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($records as $record)
            <tr>
                <td>
                   {{$record->subhead->head->name}}
                </td>
                <td>
                  {{$record->subhead->name}}
               </td>
                <td>{{$record->pvno}}</td>
                <td>{{format_currency($record->amount)}}</td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-danger"> No record exist at the moment</td></tr>
        @endforelse
    </tbody>
    
</table>