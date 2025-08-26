<?php

namespace App\Models;
use App\Models\Classes\DefaultDBModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportPlanFinancialSupport extends DefaultDBModel
{
    use HasFactory;

    protected $fillable = [
        'support_plan_id',
        'financial_has_power_of_attorney',
        'financial_power_of_attorney_details',
        'has_access_to_money',
        'access_to_money_details',
        'at_risk_of_abuse',
        'risk_of_abuse_details',
        'needs_support_for_bills',
        'support_for_bills_details',
        'not_enough_money',
        'not_enough_money_details',
        'support_financial_counsellor',
        'financial_counsellor_details',
        'support_government_initiatives',
        'government_initiatives_details',
    ];

    public function supportPlan()
    {
        return $this->belongsTo(SupportPlan::class);
    }
}
