<?php

namespace App\Livewire\Admin\Dashboard\Dep\Humanresource\Employee\Viewprofile;

use App\Models\Empasset;
use App\Models\Empbankdetails;
use App\Models\Empedudetails;
use App\Models\Empfamilydetails;
use App\Models\Employee;
use App\Models\Empworkexperiencedetails;
use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public $userid,$userimg,$username,$userrole,$empid,$joindate,$useroffice,$bankname,$accno,$branch,$familyData,$eduData,$experienceData;
    public $phone,$email,$gender,$birthday,$address,$postalcode,$emphasassets;

    protected $listeners = ['bankdetailsupdated' => 'resetpage','familydetailsadded'=>'resetpage','edudataadded'=>'resetpage','expdataadded'=>'resetpage','empdataadded'=>'resetpage'];
    public function openbankmodal($id){
     $this->dispatch('openbankmodal',$id);
    }

    public function openfamilymodal($id){
        $this->dispatch('openfamilymodal',$id);
    }

    public function openedumodal($id){
        $this->dispatch('openedumodal',$id);
    }

    public function openexpmodal($id){
        $this->dispatch('openexpereincemodal',$id);
    }

    public function editinfomodal($id){
        $this->dispatch('openinfomodal',$id);
    }

    public function resetpage($id){
        $this->userid = $id;
        $userdata=User::find($this->userid);
        $this->userimg=$userdata->profile_img ?? 'user.png';
        $this->username=$userdata->name;
        $this->userrole=$userdata->role;
        $this->empid=$userdata->id;
        $this->joindate=$userdata->created_at->format('d-m-Y');
        $this->useroffice=$userdata->location;
        // dd($this->userimg);

        $bankdata=Empbankdetails::where('empid',$this->userid)->first();
        if($bankdata){
            $this->bankname=$bankdata->bank_name;
            $this->accno=$bankdata->acc_no;
            $this->branch=$bankdata->branch;
        }

        $this->familyData=Empfamilydetails::where('empid',$this->userid)->get();
        $this->eduData=Empedudetails::where('empid',$this->userid)->get();
        $this->experienceData=Empworkexperiencedetails::where('empid',$this->userid)->get();
        $empData=Employee::where('user_id',$this->userid)->first();
        $this->phone=$empData->contact;
        $this->email=$empData->email;
       $this->gender=$empData->gender;
       $this->birthday=$empData->birthday;
       $this->address=$empData->address;
       $this->postalcode=$empData->postal_code;
    }

    public function mount()
    {
        $this->userid = request()->query('userid');
        $userdata=User::find($this->userid);
        $this->userimg=$userdata->profile_img ?? 'user.png';
        $this->username=$userdata->name;
        $this->userrole=$userdata->role;
        $this->empid=$userdata->id;
        $this->joindate=$userdata->created_at->format('d-m-Y');
        $this->useroffice=$userdata->location;
        // dd($this->userimg);

        $bankdata=Empbankdetails::where('empid',$this->userid)->first();
        if($bankdata){
            $this->bankname=$bankdata->bank_name;
            $this->accno=$bankdata->acc_no;
            $this->branch=$bankdata->branch;
        }
        $this->familyData=Empfamilydetails::where('empid',$this->userid)->get();
        $this->eduData=Empedudetails::where('empid',$this->userid)->get();
        $this->experienceData=Empworkexperiencedetails::where('empid',$this->userid)->get();
        $empData=Employee::where('user_id',$this->userid)->first();
        $this->phone=$empData->contact;
        $this->email=$empData->email;
       $this->gender=$empData->gender;
       $this->birthday=$empData->birthday;
       $this->address=$empData->address;
       $this->postalcode=$empData->postal_code;
       $this->emphasassets=Empasset::where('empid',$this->userid)->get();
    }
    public function deletefamilydata($id){
        $familyData=Empfamilydetails::find($id);
        $familyData->delete();
        $this->familyData=Empfamilydetails::where('empid',$this->userid)->get();
    }
    public function remove($id){
        $eduData=Empedudetails::find($id);
        $eduData->delete();
        $this->eduData=Empedudetails::where('empid',$this->userid)->get();
    }
    public function removeexp($id){
        $expData=Empworkexperiencedetails::find($id);
        $expData->delete();
        $this->experienceData=Empworkexperiencedetails::where('empid',$this->userid)->get();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.humanresource.employee.viewprofile.profile')->layout('livewire.admin.dashboard.layout.master');
    }
}
