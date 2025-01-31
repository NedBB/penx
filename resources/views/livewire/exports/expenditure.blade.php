<div class="table-responsive text-nowrap"> 

    <table class="table table-hover table-bordered font-13 table-striped" id="result" style="border-collapse: collapse; word-wrap: break-word;">
        @php 
            $fcount = count($columns); 
            $footercount = $fcount - 5;
            $count = 0; 
            $counter = 0;
            $x = 0;
         @endphp
        <thead>
            <tr style="text-wrap: auto">
                
                @foreach($columns as $th => $key)
                    <th 
                        @if($count <= 1) width="50px"
                        @elseif($count == 2) width="100px"
                        @elseif($count == 3) width= "350px"
                        @else width="400px" 
                        @endif
                    >
                        {{-- {!! wordwrap($th, 20, '<br>', false) !!} --}}
                        {{$th}}
                        
                    </th>
                    @php ++$count; @endphp
                @endforeach
            </tr>
        </thead>
        <tbody>
            
            

            @forelse($records as $tr)
                <tr>


                    @foreach($tr as $td)
                        
                        {{-- @if($counter >= 4)
                            @php
                                $this->processFooter($td, $x - 4);
                            @endphp
                        @endif --}}
                   
                        <td>
                            {{-- {!! wordwrap($td, 120, '<br>', false) !!} --}}
                            @if ($count >= 4)
                            {{ str_replace(',', '', $td) }}
                        @else
                            {{$td}}
                        @endif
                        </td>

                        {{-- @php ++$counter; ++$x; @endphp --}}

                    @endforeach
                </tr>
                {{-- @php
                    $counter = 0; $x = 0;// Reset column counter for each row
                @endphp --}}
            @empty
                <tr>
                    <td colspan="{{ count($columns) + 1 }}" class="text-center text-danger">No record exists at the moment</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right total">Total</td>
                @foreach ($footer as $item)
                    <td>{{$item}}</td>
                @endforeach
                
            </tr>
        </tfoot>
    </table>
</div> 