<?php
namespace App\Services;

use App\Models\Referral;

class ReferralService
{
    public function save(array $data): Referral
    {
        // map the incoming keys to your model fields
        return Referral::create([
            'client_id'      => $data['client_id'],
            'agency'         => $data['agency'] ?? null,
            'contact_name'   => $data['contact_name'] ?? null,
            'job_title'      => $data['job_title'] ?? null,
            'work_contact'   => $data['work_contact'] ?? null,
            'referral_mobile'=> $data['referral_mobile'] ?? null,
            'referral_email' => $data['referral_email'] ?? null,
            'has_consent'    => $data['has_consent'],
        ]);
    }
}
