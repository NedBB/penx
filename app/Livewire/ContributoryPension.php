<?php

namespace App\Livewire;

use Livewire\Component;

use App\Services\StaffprofileService;
use App\Services\ContributorypensionService;

class ContributoryPension extends Component
{
    
    public $month;
    public $data;
    public $year;
    public $option;
    public $records = [];
   
    public $hide = true;

    public $options = ["create" => "Create Record","generate" => "Generate Record"];
    public $monthrange = [
        '01'=>'January', '02'=>'February','03'=>'March','04'=>'April',
        '05'=>'May','06'=>'June','07'=>'July','08'=>'August',
        '09'=>'September','10'=>'October','11'=>'November','12'=>'December'
    ];
 
    public function search(StaffprofileService $staffprofileservice, ContributorypensionService $contributorypensionService){

        $validated = $this->validate([ 
            'option' => 'nullable',
            'year' => 'required',
            'month' => 'required'
        ]);

        $this->hide = false;

      

        if(!($validated['option']) && ($validated['month']) && ($validated['year'])){
                $this->records = $contributorypensionService->getContribution($validated);
        }
        elseif(($validated['option'] == 'create') & ($validated['month']) && ($validated['year'])){

            $generate =  $staffprofileservice->generateContributoryPension($validated['month'],$validated['year']);//this is
            $contributorypensionService->insertPension($validated['month'],$validated['year'],$generate);
            $this->records = $contributorypensionService->getContribution($validated);
        }
        elseif(($validated['option'] == 'generate') && ($validated['month']) && ($validated['year'])){
            $contributorypensionService->deleteSchedule($validated['month'],$validated['year']);
            $generate =  $staffprofileservice->generateContributoryPension($validated['month'],$validated['year']);
            $contributorypensionService->insertPension($validated['month'],$validated['year'],$generate);
            $this->records = $contributorypensionService->getContribution($validated);
        }

        
    }

    public function render()
    {
        return view('livewire.queries.contributory-pension')->layout('layouts.app');
    }
}
