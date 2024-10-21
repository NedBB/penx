<x-my-print-modal>


    <div class="modal-body" id="printable">

        <div style="font-size:13px">
            <div class="text-right" style="display: inline-block; width: 7%; margin-right: 15px">
                <img class="text-center" src="{{asset('pension-logo.png')}}" style="width:4rem; margin-right: 10px">
            </div>
            <div class="text-left" style="display: inline-block; width: 89%">
                <h4 style="font-size: 28px">{{config('app.name')}}</h4>
            </div>
            <hr>

            <div class="text-center">
                <h5> 
                    {{$income->location->name}} - RECEIPT
                </h5>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <table style="border:0; width: 100%; font-size:13px">
                        <tr>
                            <td style="width: 50%">Receipt No.</td>
                            <td>{{$income->receiptno}}</td>
                        </tr>
                        <tr>
                            <td>From:</td>
                            <td>{{icarbon($income->fromdate_at)->format('dS, F - Y')}}</td>
                        </tr>

                        <tr>
                            <td>To:</td>
                            <td>{{icarbon($income->todate_at)->format('dS, F - Y')}}</td>
                        </tr>
                        
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div style="display: inline-block; width: 98%">
                        <h6 class="text-uppercase">Breakdown:</h6>
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <td>Description</td>
                                <td>{{$income->description}}</td>
                            </tr>
                            <tr>
                                <td>Income Percent %</td>
                                <td>{{$income->incomeperc}}</td>
                            </tr>
                            <tr>
                                <td>Remitted Amount</td>
                                <td>{{format_money($income->remittedamount)}}</td>
                            </tr>
                            
                            <tr>
                                <td>Total</td>
                                <td>{{format_currency($income->totalincome)}}</td>
                            </tr>
                        </table>
                    </div>

                </div>
                
                <div class="col-lg-12" style="margin-bottom: 30px; margin-top: 30px">
                    <div class="text-center">
                        <span class="inWord"></span>
                    </div>
                </div>
                
                <div class="col-lg-6 pull-left
                ">
                    <span>Prepared By:............................................................</span>
                </div>
                <div class="col-lg-6 pull-right">
                    <span>Collected By:............................................................</span>
                </div>
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
        <button class="btn btn-primary edit-national text-white print" onclick='printData({{$income->totalincome}})'>Print</button>
    </div>

    <script type='text/javascript'>
        // $(function() {
        //     $('.print').on('click', function(e) {
        //         e.preventDefault()
        //         $("#printable").print("#printable");
        //     });

        //     $('.inWord').html(numberToMoney("{{$income->totalincome}}"));
        // });


    </script> 

</x-my-print-modal>>