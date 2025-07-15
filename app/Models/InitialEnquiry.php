<?php
namespace App\Models;

use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class InitialEnquiry extends DefaultDBModel
{
    protected $fillable = [
        'full_name',
        'preferred_name',
        'gender',
        'date_of_birth',
        'address',
        'postcode',
        'phone_number',
        'mobile_number',
        'email',
        'need_support_person',
        'support_person_details',
        'user_id',
        'client_type',
        'staff_id',
        'form_status',
    ];
        protected $attributes = [
        'form_status' => 'in_progress',
    ];


    public function funding()
    {
        return $this->hasOne(FundingDetail::class, 'initial_enquiry_id');
    }

    public function emergencyContact()
    {
        return $this->hasOne(EmergencyContact::class, 'initial_enquiry_id');
    }

    public function scheduleOfCares()
    {
        return $this->hasMany(ScheduleOfCare::class, 'initial_enquiry_id');
    }

    public function culturalBackground()
    {
        return $this->hasOne(CulturalBackground::class, 'initial_enquiry_id');
    }

    public function ndisGoals()
    {
        return $this->hasMany(NdisGoals::class, 'initial_enquiry_id');
    }

    public function healthProfessionalDetails()
    {
        return $this->hasMany(HealthProfessionalDetail::class, 'initial_enquiry_id');
    }

    public function diagnosisSummary()
    {
        return $this->hasOne(DiagnosisSummary::class, 'initial_enquiry_id');
    }

    public function healthInformation()
    {
        return $this->hasOne(HealthInformation::class, 'initial_enquiry_id');
    }

    public function healthcareSupportDetail()
    {
        return $this->hasOne(HealthcareSupportDetail::class, 'initial_enquiry_id');
    }

    public function behaviourSupport()
    {
        return $this->hasOne(BehaviourSupport::class, 'initial_enquiry_id');
    }

    public function medicalAlert()
    {
        return $this->hasOne(MedicalAlert::class, 'initial_enquiry_id');
    }

    public function preventiveHealthSummary()
    {
        return $this->hasOne(PreventiveHealthSummary::class, 'initial_enquiry_id');
    }

    public function supportInformation()
    {
        return $this->hasOne(SupportInformation::class, 'initial_enquiry_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
