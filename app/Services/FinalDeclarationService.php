<?php
namespace App\Services;

use App\Models\FinalDeclaration;

class FinalDeclarationService
{
    public function save(array $data): FinalDeclaration
    {
        return FinalDeclaration::create([
            'client_id'              => $data['client_id'],
            'primary_email'          => $data['primary_email'] ?? null,
            'secondary_email'        => $data['secondary_email'] ?? null,
            'referrer_date'          => $data['referrer_date'] ?? null,
            'referrer_name'          => $data['referrer_name'] ?? null,
            'referrer_signature'     => $data['referrer_signature'] ?? null,
            'referrer_organisation'  => $data['referrer_organisation'] ?? null,
            'client_date'            => $data['client_date'] ?? null,
            'client_name'            => $data['client_name'] ?? null,
            'client_signature'       => $data['client_signature'] ?? null,
            'guardian_date'          => $data['guardian_date'] ?? null,
            'guardian_name'          => $data['guardian_name'] ?? null,
            'guardian_signature'     => $data['guardian_signature'] ?? null,
        ]);
    }
}
