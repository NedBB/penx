<?php

namespace App\Livewire;

use App\Services\AllocationService;
use App\Services\ContributorypensionService;
use App\Services\OmnibusService;
use App\Services\PayrollService;
use App\Services\TransportandtravelService;
use Livewire\Component;

class PaymentSchedule extends Component
{

    public $start_date;
    public $end_date;
    public $pension;
    public $sort;
    public $nationpayroll;
    public $staffpayroll;

    public $data = [];

    public function search(AllocationService $allocationService,TransportandtravelService $transportandtravelService, 
    OmnibusService $omnibusService, ContributorypensionService $contributorypensionService,
    PayrollService $payrollService){

        if (($date2 = $this->end_date) && ($date1 = $this->start_date)) {
            $date2 = icarbon($date2)->endOfDay();

            $allocation = $allocationService->getAllocationSchedule($date1, $date2)->toArray();
            $omnibus = $omnibusService->getOmnibusSchedule($date1, $date2)->toArray();
            $tandt = $transportandtravelService->getTransportSchedule($date1, $date2)->toArray();

            $data['pension'] = $contributorypensionService->getPensionSchedule($date1, $date2);
            $data['nationpayroll'] = $payrollService->getPayrollSchedule('nationaloffice', $date1, $date2);
            $data['staffpayroll'] = $payrollService->getPayrollSchedule('staffprofile', $date1, $date2);


            $unsortedMerge = array_merge($allocation,$omnibus,$tandt);

            //tt($unsortedMerge);

            //$data['sort'] = array_merge($allocation,$omnibus,$tandt);

            //$collectdata = collect($data['sort'])->sort();

            //dd($collectdata);

            //ksort($data['sort']);

            usort($unsortedMerge, function($a, $b) {
                //dd($a[0]['pvno']);
                $a_arr = explode('/', $a[0]['pvno']);
                $b_arr = explode('/', $b[0]['pvno']);
    

                /*$my1 = $a_arr[1].$a_arr[2];
                $my2 = $b_arr[1].$b_arr[2];

                if($my1 == $my2) {
                    return 0;
                }

                return ($my1 < $my2) ? -1 : 1;*/
                //return strcmp(strrev($a[0]['pvno']), strrev($b[0]['pvno']));

                if(!isset($a_arr[2])){ 
                    return strcmp($a_arr[1].$a_arr[0], $b_arr[1].$b_arr[0]);
                }
                if(!isset($b_arr[2])){ 
                    return strcmp($a_arr[1].$a_arr[0], $b_arr[1].$b_arr[0]);
                }

                return strcmp($a_arr[2].$a_arr[1].$a_arr[0], $b_arr[2].$b_arr[1].$b_arr[0]);

            });

            $collectdata = collect($unsortedMerge)->keyBy(function($item) {
                return $item[0]['pvno'];
            });


            $data['sort'] = $collectdata;

            $this->pension = $data['pension'];
            $this->nationpayroll = $data['nationpayroll'];
            $this->staffpayroll =  $data['staffpayroll'];
            $this->sort = $data['sort'];


           

        }


    }

    public function render()
    {
        return view('livewire.queries.payment-schedule')->layout('layouts.app');
    }
}
