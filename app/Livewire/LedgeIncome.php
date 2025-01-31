<?php

namespace App\Livewire;

use App\Services\IncomeService;
use App\Services\LocationService;
use App\Services\BankService;
use Livewire\Component;
use App\Exports\IncomeExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Attributes\On;
use Carbon\Carbon;

class LedgeIncome extends Component
{
    public $states;
    public $show = false;
    public $edit = false;
    public $print= false;
    public $state;
    public $title;
    public $accounts;
    public $event = '';
    public $start_date;
    public $view = '';
    public $report_type;
    public $editevent = "edit-income";
    public $printevent = "print-modal";
    public $end_date;
    public $component;
    public $income;
    public $incomes;
    public $date_from;
    public $date_to;
    public $description;
    public $location_id;
    public $account_id;
    public $amount;
    public $total;
    public $receipt;
    public $records = [];
    public $incomeService;
    public $id;

    protected $listeners = [
        'refreshRecords' => 'search'
    ];

    public function boot(LocationService $locationService,){
        $this->states = $locationService->listState();
    }

    public function search(IncomeService $incomeService ){

        $end_date = Carbon::parse($this->end_date)->endOfDay(); 
        $start_date = Carbon::parse($this->start_date)->startOfDay(); 

        $validated = $this->validate([ 
            'state' => 'nullable',
            'start_date'=>'required',
            'end_date' => 'required',
            'report_type' => 'required'

        ]);

        if($this->report_type === 'summarized' || $this->report_type === 'detailed') {

       
            $income = $incomeService->getRecords($start_date, $end_date);


            if($this->state && $this->state !== 'all') {
              
                $income = $incomeService->getRecordWithLocation($start_date, $end_date, $this->state);
            }

            $income = $income->sortBy('location.name', SORT_NATURAL | SORT_FLAG_CASE)
                                ->groupBy('location.name');
            $this->records = $income->toArray();
            
            $this->view = $this->report_type;
            $this->show = true;
            $this->event = $this->report_type;
            $this->component = ($this->report_type == 'summarized' ? 'ledger-income-summarize': 'ledger-income-detailed');

        }
     
        elseif($this->report_type == "all") {
        
            $income = $incomeService->getRecordsOrder($start_date, $end_date);
            

            if($this->state && $this->state !== 'all') {
                $income = $incomeService->getRecordsOrderWithLocation($start_date, $end_date, $this->state);
            }

            $income = $income->sortBy('location.name', SORT_NATURAL | SORT_FLAG_CASE)
                        ->groupBy('location.name');

            $this->view = $this->report_type;
            $this->records = $income->toArray();
            $this->component = "ledge-income-regular";
            $this->show = true;
        }
    }

    #[On('print-modal')]
    public function printReceipt($id,IncomeService $incomeservice){
        $this->print = true;
        $this->incomes = $incomeservice->getPrintRecord($id);
    }

    #[On('edit-income')]
    public function edit($id, IncomeService $incomeservice,BankService $account){
       
        $this->title = "edit ledger income";
        $this->edit = true;
        $this->id = $id;
        $this->incomes = $incomeservice->getById($id);
        $this->accounts = $account->listAccounts();
        $this->date_from = $this->incomes->fromdate_at;
        $this->date_to = $this->incomes->todate_at;
       
        $this->income = $this->incomes->incomeperc;
        $this->description = $this->incomes->description;
        $this->location_id = $this->incomes->location_id;
        $this->account_id = $this->incomes->account_id; 
        $this->amount = $this->incomes->remittedamount;
        $this->total = $this->incomes->totalincome;
        $this->receipt = $this->incomes->receiptno;
        // $this->subhead_id = $this->omnibus->subhead_id;
        // $subhead = $groupheadService->getById($this->omnibus->subhead_id,'subhead');
        // $this->head_id = $subhead->head_id;
    
        // $this->date = sqldate($this->omnibus->created_at);
        // $this->pvno = $this->omnibus->pvno;
        // $this->id = $this->omnibus->id;
       
    }

    public function update(IncomeService $incomeService){
        $validate =  $this->validate([
            "location_id"       => ['required'],
            "amount"    => ['required','regex:/^\d{1,8}(\.\d{1,2})?$/'],
            "income"        => ['required'],
            "receipt"         => ['required'],
            "description"       => ['required'],
            "date_from"          => ['required'],
            "date_to"            => ['required'],
            'account_id'      =>  ['required']
        ]);
        $validate['total'] = $this->amount;
        $response = $incomeService->update($this->id, $validate);

        //$this->reset(['location_id','account_id','amount','income','receipt','description','date_from','date_to','total']);
        
        if($response){
            $this->dispatch('refreshRecords');
            request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
        }
    }

    public function delete($id,IncomeService $incomeService){
        
        $state =  $incomeService->delete($id);
        
        if($state){
            $records = $this->records;
           
            foreach ($records as $key => $record) {
              
                foreach($record as $index => $list){//
                    if ($list['id'] == $id) {
                        unset($records[$key][$index]);
                    }
                }
            }
           
            $this->records = $records;
        }
    }

    public function export(){
        return Excel::download(new IncomeExport($this->records, $this->view), 'income.xlsx');
    }

    public function render()
    {
        return view('livewire.ledgers.ledge-income')->layout('layouts.app');
    }
}
