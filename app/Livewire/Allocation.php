<?php

namespace App\Livewire;

use App\Services\AllocationService;
use App\Services\GroupheadService;
use App\Services\LocationService;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\OmnibusService;
use App\Services\TransportandtravelService;
use Livewire\Attributes\On;
use App\Exports\AllocationExport;
use App\Services\StaffprofileService;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class Allocation extends Component
{
    use WithPagination;
    public $allocations = [];
    public $pvno_search;
    public $heads;
    public $locations;
    public $location_id;
    
    public $name;
    public $allocation;
    public $tts = [];
    public $page = 5;
    public $subheads = [];
    public $pvno;
    public $subhead_id;
    public $head_id = 0;
    public $date;
    public $head_field ="head_id";
    public $subhead_field = "subhead_id";
    public $net_pay = 0;
    public $gross_pay = 0;
    public $constitution = 0;
    public $date_record;
    public $id;
    public $arrears = 0;
    public $nlc = 0;
    public $allocation_field = 55;
    public $divisionpercent;
    public $applypercent = false;
    public $legal = 0;
    public $almanac = 0;
    public $advance_allocation = 0;
    public $audit_fees = 0;
    public $badges = 0;
    public $northern_dues = 0;
    public $amount = '';
    public $title = "Add Allocations";
    public $edittitle = "Edit Allocations";
    public $addevent= "add-allocation";
    public $editevent = "edit-allocation";
    public $edit = false;
    public $search = '';
    public $page_title = 'Payment Voucher for Allocation of Funds to Branches';
    public $selected;
    public $selection = [];
    public $subhead_field_lists;
    public $subhead_search_field;
    public $month_1;
    public $month_2;
    public $year_1;
    public $year_2;

    protected $listeners = [
        'refreshAllocationRecords' => 'searchs',
        'refreshRecords' => 'searchrecords',
        'amountUpdated' => 'handleKeypress',
    ];

    // protected $rules = [
    //     'amount' => 'required|numeric|between:0,999999.99',
    // ];

    // protected $casts = [
    //     'amount' => 'decimal:2',
    // ];
    
    // protected $listeners = [
    //     'amountUpdated' => 'handleAmountUpdate',
    // ];

    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];

    public function boot(GroupheadService $head, LocationService $locations, GroupheadService $headService){
        $this->heads = $head->headList();
        $this->subhead_field_lists = $headService->getSubHeadByHeadid(1);
        $this->locations = $locations->listState();
        
    }

    #[On('selectionChanged')]
    public function getSubheads($value,GroupheadService $service){
        $this->head_id = $value;
        $records = $service->getSubHeadByHeadid($value);
        $this->dispatch('messageSent', data:$records);
    }

    #[On('selectionSubhead')]
    public function updateSubhead($value){
        $this->subhead_id = (int)$value;
        
        if($this->head_id == 1 && $this->subhead_id == 72){
            $this->allocation_field = 0;
        }
        // else{
        //     $this->allocation_field = 0;
        // }
    }

    public function getPercent($value){
        if($this->applypercent){
            $this->divisionpercent = (int)$value;
        }else{
            $this->divisionpercent = (int)$value;
        }
    }

    public function updatedAmount($value)
    {
        // Validate input: allow numbers and a single decimal
        if (preg_match('/^\d*\.?\d*$/', $value)) {
            $this->amount = $value;
        } else {
            // Reset or sanitize invalid input
            $this->amount = preg_replace('/[^\d.]/', '', $value);
        }
    }

    public function addEditAsNew(){
        $this->edit = false;
    }

    public function saveNewRecord(AllocationService $allocationService){

        $validate =  $this->validate([
            "head_id"       => ['required'],
            "subhead_id"       => ['required'],
            "amount"    => ['required'],
            "advance_allocation"       => ['required'],
            "pvno"          => ['required'],
            "location_id"            => ['required'],
            "legal"            => ['required'],
            "almanac" => ["required"],
            "audit_fees" => ["required"],
            "nlc"            => ['required'],
            "date_record"    => ['required'],
            "arrears"            => ['required'],
            "badges"            => ['required'],
            "gross_pay"            => ['required'],
            "net_pay"            => ['required'],
            "allocation_field"            => ['required'],
            "constitution"            => ['required'],
            "northern_dues"            => ['required'],
            "audit_fees"            => ['required'],
            "month_1"            => ['required'],
            "month_2"            => ['required'],
            "year_1"            => ['required'],
            "year_2"            => ['required'],
            "divisionpercent" => ['required']
        ]);
       
        $response = $allocationService->createRecord($validate);
     
        if($response){
            $this->dispatch('refreshRecords');
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function getFormattedAmountProperty()
    {
        return number_format((float) $this->amount, 2, '.', '');
    }

    public function updatePercentage($percent){
        $this->allocation_field = $percent;
        
        if(isset($this->amount)){
            $this->handleKeypress($this->amount);
        }
        
    }

    public function handleKeypress($value){
       
        $sanitizedValue = preg_replace('/[^0-9.]/', '', $value);

        // Prevent multiple decimal points
        $parts = explode('.', $sanitizedValue);
        if (count($parts) > 2) {
            $sanitizedValue = $parts[0] . '.' . implode('', array_slice($parts, 1));
        }

        // Optionally, enforce two decimal places
        if (strpos($sanitizedValue, '.') !== false) {
            $sanitizedValue = preg_replace('/(\.\d{2})\d+/', '$1', $sanitizedValue);
        }

        // Assign the sanitized value back to the Livewire property
        $this->amount = $sanitizedValue;

        $amount = (float)$this->amount;
        $this->amount = $amount;

        $start_date = Carbon::create($this->year_1,$this->month_1,1)->startOfMonth();
        $end_date = Carbon::create($this->year_2,$this->month_2)->endOfMonth();
        $diffInMonths = $start_date->diffInMonths($end_date);
        $diffInMonths = ($diffInMonths == 0) ? 1 : $diffInMonths;

        if($this->allocation_field > 0){
            
            $percent_division = $this->allocation_field/$this->divisionpercent;
            $amount_multipled = $amount * $percent_division;
            $gross_pay = $diffInMonths * $amount_multipled;
            $this->gross_pay = round($gross_pay, 2);
            
        }
        else{
            $this->gross_pay = $amount;
        }
        $deduct = (float)$this->nlc + (float)$this->arrears + (float)$this->advance_allocation + (float)$this->constitution 
        + (float)$this->northern_dues + (float)$this->audit_fees + (float)$this->legal + (float)$this->almanac + (float)$this->badges;
       
        $this->net_pay = $this->gross_pay - $deduct;
    }


    public function getPay(){
        $start_date = Carbon::create($this->year_1,$this->month_1,1)->startOfMonth();
        $end_date = Carbon::create($this->year_2,$this->month_2)->endOfMonth();
        $diffInMonths = $start_date->diffInMonths($end_date);
        $diffInMonths = ($diffInMonths == 0) ? 1 : $diffInMonths;

        if($this->allocation_field > 0){
            $amount = (float)$this->amount;
            $percent_division = $this->allocation_field/$this->divisionpercent;
            $amount_multipled = $amount * $percent_division;
            $gross_pay = $diffInMonths * $amount_multipled;
            $this->gross_pay = round($gross_pay, 2);
            
        }
        else{
            $this->gross_pay = (float)$this->amount;
        }
        $deduct = (float)$this->nlc + (float)$this->arrears + (float)$this->advance_allocation + (float)$this->constitution 
        + (float)$this->northern_dues + (float)$this->audit_fees + (float)$this->legal + (float)$this->almanac + (float)$this->badges;
        $this->net_pay = $this->gross_pay - $deduct;
    }

    public function calculateTotals(){
        $deduct = (float)$this->nlc + (float)$this->arrears + (float)$this->advance_allocation + (float)$this->constitution 
        + (float)$this->northern_dues + (float)$this->audit_fees + (float)$this->legal + (float)$this->almanac + (float)$this->badges;
        $this->net_pay = (float)$this->gross_pay - (float)$deduct;
    }

    public function selectApply(){
        $this->applypercent = true;
    }


    public function save(AllocationService $allocationService)
    {

        $validate =  $this->validate([
            "head_id"       => ['required'],
            "subhead_id"       => ['required'],
            "amount"    => ['required'],
            "advance_allocation"       => ['required'],
            "date_record" => ['required'],
            "pvno"          => ['required'],
            "location_id"            => ['required'],
            "legal"            => ['required'],
            "almanac" => ["required"],
            "audit_fees" => ["required"],
            "nlc"            => ['required'],
            "arrears"            => ['required'],
            "badges"            => ['required'],
            "gross_pay"            => ['required'],
            "net_pay"            => ['required'],
            "allocation_field"            => ['required'],
            "constitution"            => ['required'],
            "northern_dues"            => ['required'],
            "audit_fees"            => ['required'],
            "month_1"            => ['required'],
            "month_2"            => ['required'],
            "year_1"            => ['required'],
            "year_2"            => ['required'],
            "divisionpercent" => ['required']
        ]);

        $response = $allocationService->createRecord($validate);

        $this->reset(['amount','head_id','subhead_id','date_record',
            'net_pay','gross_pay','pvno','constitution','nlc','audit_fees','advance_allocation','arrears',
            'almanac','badges','legal','northern_dues','divisionpercent','applypercent','month_1','month_2','year_1','year_2','location_id'
        ]);

        if($response){
            request()->session()->flash('success','Record has successfully been created',array('timeout' => 3000));
        }
        else{
            request()->session()->flash('failed','Record creation failed',array('timeout' => 3000));
        }
    }

    public function delete($id,AllocationService $allocationService){
        $state = $allocationService->delete($id);
        if($state){
            $records = $this->allocations;
            foreach ($records as $key => $record) {
                if ($record['id'] == $id) {
                    unset($records[$key]);
                }
            }
            $this->allocations = $records;
        }
    }

    #[On('add-allocation')]
    public function add(){
        $this->reset(['amount','head_id','subhead_id','date_record',
        'net_pay','gross_pay','pvno','constitution','nlc','audit_fees','advance_allocation','arrears',
        'almanac','badges','legal','northern_dues','divisionpercent','applypercent','month_1','month_2','year_1','year_2','location_id'
        ]);        
       $this->edit = false;
        $this->title = "Add Allocation";
    }

    #[On('edit-allocation')]
    public function edit($id, AllocationService $allocationService, GroupheadService $groupheadService){
      
        $this->title = "edit allocation";
        $this->edit = true;

         $records = $allocationService->getRecordById($id);
         $this->id = $records->id;
        // $this->name = $this->ttrecords->profile;
        // $this->description = $this->ttrecords->description;
        $this->subhead_id = $records->subhead_id;
        //$subhead = $groupheadService->getById($this->allocation->subhead_id,'subhead');
        $this->head_id = $records->head_id;    
        $this->amount = $records->remittedamount;
        $this->pvno = $records->pvno;
        //$this->id = $this->allocation->id;
        $this->arrears = $records->arrears;
        $this->year_1 = $records->year_1;
        $this->year_2 = $records->year_2;
        $this->month_2 = $records->month_2;
        $this->month_1 = $records->month_1;
        $this->audit_fees = $records->auditfee;
        $this->date_record = Carbon::parse($records->created_at)->toDateString();
        $this->northern_dues = $records->magazine;
        $this->legal = $records->legal;
        $this->advance_allocation = $records->advanceallocation;
        $this->badges = $records->badges;
        $this->almanac = $records->almanac;
        $this->divisionpercent = $records->divisionpercent;
        $this->constitution = $records->constitution;
        $this->nlc = $records->contributiontonlc;
        $this->net_pay = $records->netpay;
        $this->gross_pay = $records->grosspay;
        $this->net_pay = $records->netpay;
        $this->allocation_field = $records->allocationpercent;
        $this->location_id = $records->location_id;
    }

    public function update(AllocationService $allocationService){
       
        $validate =  $this->validate([
            "head_id"       => ['required'],
            "subhead_id"       => ['required'],
            "amount"    => ['required'],
            "advance_allocation"       => ['required'],
            "pvno"          => ['required'],
            "location_id"            => ['required'],
            "legal"            => ['required'],
            "almanac" => ["required"],
            "audit_fees" => ["required"],
            "nlc"            => ['required'],
            "date_record"    => ['required'],
            "arrears"            => ['required'],
            "badges"            => ['required'],
            "gross_pay"            => ['required'],
            "net_pay"            => ['required'],
            "allocation_field"            => ['required'],
            "constitution"            => ['required'],
            "northern_dues"            => ['required'],
            "audit_fees"            => ['required'],
            "month_1"            => ['required'],
            "month_2"            => ['required'],
            "year_1"            => ['required'],
            "year_2"            => ['required'],
            "divisionpercent" => ['required']
        ]);

        if($this->edit == false){
           $this->saveNewRecord($allocationService);
        }
        else{

            $response = $allocationService->updateRecord($this->id,$validate);

            if($response){
                $this->dispatch('refreshAllocationRecords');
                request()->session()->flash('success','Record has successfully been updated',array('timeout' => 3000));
            }
            else{
                request()->session()->flash('failed','Record update failed',array('timeout' => 3000));
            }
        }
    }

    public function searchs(AllocationService $allocationsService){
        
        $validated = $this->validate([ 
            'subhead_search_field' => 'required',
            'year_1' => 'required',
            'year_2' => 'required',
            'month_1' => 'required',
            'month_2' => 'required'
        ]);
       
        $this->allocations = $allocationsService->getRecords($validated);
    }

    public function searchrecords(AllocationService $allocationsService){
        $this->allocations = $allocationsService->getRecordsByPvno($this->pvno_search);
    }

    public function export(){
        return Excel::download(new AllocationExport($this->allocations), 'allocation.xlsx');
    }

    public function render(AllocationService $allocationService)
    {
        return view('livewire.entries.allocation')->layout('layouts.app');
    }
}
