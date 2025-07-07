<?php
namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Model;

class Client extends DefaultDBModel
{
    protected $fillable = [
        'prospect_uuid',
        'full_name',
        'date_of_birth',
        'gender',
        'residential_address',
        // 'contact_type',
        'home_phone',
        'work_phone',
        'mobile',
        'email',
        'password',
        'atsi_status',
        'cultural_background',
        'language_spoken',
        'interpreter_required',
        'guardian_name',
        'is_public_guardian',
        'guardian_relationship',
        'guardian_mobile',
        'guardian_email',
        'guardian_address',
        'guardian_contact_method',
        'form_status',
    ];

    protected $casts = [
        'interpreter_required' => 'boolean',

        // 'date_of_birth' => 'date',
    ];


        public function referrals()
    {
        return $this->hasMany(Referral::class);
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }

    public function previousServiceProviders()
    {
        return $this->hasMany(PreviousServiceProvider::class);
    }

    public function selectedServices()
    {
        return $this->hasMany(SelectedService::class);
    }

    public function clientNdisDetail()
    {
        return $this->hasOne(ClientNdisDetail::class);
    }

    public function medicalInformation()
    {
        return $this->hasOne(MedicalInformation::class);
    }

    public function housingHistory()
    {
        return $this->hasOne(HousingHistory::class);
    }

    public function rosterOfCare()
    {
        return $this->hasOne(RosterOfCare::class);
    }

    public function ndisGoals()
    {
        return $this->hasMany(NdisGoal::class);
    }

    public function independentLivingOption()
    {
        return $this->hasOne(IndependentLivingOption::class);
    }

    public function finalDeclaration()
    {
        return $this->hasOne(FinalDeclaration::class);
    }





}
