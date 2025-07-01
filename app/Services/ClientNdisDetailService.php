<?php
// app/Services/ClientNdisDetailService.php

namespace App\Services;

use App\Models\ClientNdisDetail;

class ClientNdisDetailService
{
    public function save(array $data): ClientNdisDetail
    {
        return ClientNdisDetail::updateOrCreate(
           ['client_id' => $data['client_id']],
             [
            'ndis_plan_approved'             => $data['ndis_plan_approved'] ?? null,
            'ndis_number'                    => $data['ndis_number'] ?? null,
            'ndis_plan_start_date'           => $data['ndis_plan_start_date'] ?? null,
            'ndis_plan_end_date'             => $data['ndis_plan_end_date'] ?? null,
            'plan_manager_name'              => $data['plan_manager_name'] ?? null,
            'plan_manager_contact_mobile'    => $data['plan_manager_contact'] ?? null,
            'plan_manager_contact_email'    => $data['plan_manager_email'] ?? null,
            'plan_type'                      => $data['plan_type'] ?? null,
            'copy_of_plan_provided'          => $data['copy_of_plan_provided'] ?? null,
            'reason_plan_not_provided'       => $data['reason_plan_not_provided'] ?? null,
            'engagement_concerns'            => $data['engagement_concerns'] ?? null,
            'engagement_concerns_description'=> $data['engagement_concerns_description'] ?? null,
             ]
        );
    }
}
