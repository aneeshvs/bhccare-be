<?php
namespace App\Services;

use App\Models\Referral;

class ReferralService
{
    public function save(array $data): Referral
    {
        // map the incoming keys to your model fields
        return Referral::create([
            'agency'       => $data['agency'] ?? null,
            'contact_name' => $data['contact_name'] ?? null,
            'job_title'    => $data['job_title'] ?? null,
            'work_contact' => $data['work_contact'] ?? null,
            'mobile'       => $data['mobile'] ?? null,
            'email'        => $data['email'] ?? null,
            'has_consent'  => $data['has_consent'],
        ]);
    }
}
