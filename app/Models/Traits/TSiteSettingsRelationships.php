<?php

namespace App\Models\Traits;

use App\Models\MasterData\Country;
use App\Models\MasterData\Currency;
use App\Models\MasterData\Language;
use App\Models\MasterData\Timezone;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait TSiteSettingsRelationships
{
    public function billingsettings(): HasOne
    {
        return $this->hasOne(BillingSetting::class,'site_id','id');
    }

    public function billingAddressSettings(): HasOne
    {
        return $this->hasOne(BillingAddress::class,'site_id','id');
    }

    public function billingCurrenciesSettings(): BelongsToMany
    {
        return $this->belongsToMany(Currency::class,
        BillingSettings::makeJunctionTable(Currency::model()));
    }

    public function businessAddressSettings(): HasOne
    {
        return $this->hasOne(BusinessAddress::class, 'site_id', 'id');
    }

    public function businessSettings(): HasOne
    {
        return $this->hasOne(BusinessSetting::class, 'site_id', 'id');
    }

    // public function clientFieldSettings(): HasOne
    // {
    //     return $this->hasOne(ClientFieldSetting::class, 'site_id', 'id');
    // }

    public function contactSettings(): HasOne
    {
        return $this->hasOne(ContactSetting::class, 'site_id', 'id');
    }

    public function regionalCountriesSettings(): BelongsToMany
    {
        return $this->belongsToMany(Country::class,
        RegionalSetting::makeJunctionTable(Country::model()));
    }

    public function regionalCurrenciesSettings(): BelongsToMany
    {
        return  $this->belongsToMany(Currency::class,
        RegionalSetting::makeJunctionTable(Currency::model()));
    }

    public function regionalLanguagesSettings(): BelongsToMany
    {
        return  $this->belongsToMany(Language::class,
        RegionalSetting::makeJunctionTable(Language::model()));
    }

    public function regionalTimezonesSettings(): BelongsToMany
    {
        return  $this->belongsToMany(Timezone::class,
        RegionalSetting::makeJunctionTable(Timezone::model()));
    }

    public function regionalSettings(): HasOne
    {
        return $this->hasOne(RegionalSetting::class, 'site_id', 'id');
    }

    public function websiteSettings(): HasOne
    {
        return $this->hasOne(WebsiteSetting::class, 'site_id', 'id');
    }
}
