<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Onboarding Packing Sign Off</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            background-color: #f9fafb;
            color: #111827;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 950px;
            margin: auto;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px 30px;
        }

        .header {
            position: relative;
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            position: absolute;
            top: 0;
            left: 0;
            max-width: 70px;
            height: auto;
        }

        .header h2 {
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }

        .section-title {
            background-color: #f3f4f6;
            font-weight: bold;
            padding: 8px 12px;
            border-left: 4px solid #4f46e5;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        th, td {
            border: 1px solid #e5e7eb;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f9fafb;
            font-weight: bold;
            width: 50%;
        }
    </style>
</head>
<body>

@php
    use Carbon\Carbon;
    function formatDate($date) {
        return $date ? Carbon::parse($date)->format('d/m/Y') : '-';
    }
@endphp

<div class="container">

    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <h2>Onboarding Packing Sign Off</h2>
    </div>



    {{-- Onboarding Items --}}
    <table>
        <tr><td colspan="2" class="section-title">Documents & Procedures</td></tr>
        <tr><th>Service Agreement Provided</th><td>{{ $record->service_agreement_provided ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->service_agreement_date) }}</td></tr>

        <tr><th>Participant Handbook Provided</th><td>{{ $record->participant_handbook_provided ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->participant_handbook_date) }}</td></tr>

        <tr><th>Support Care Plan Offered</th><td>{{ $record->support_care_plan_offered ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->support_care_plan_date) }}</td></tr>

        <tr><th>Consent Form Signed</th><td>{{ $record->consent_form_signed ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->consent_form_date) }}</td></tr>

        <tr><th>Feedback Form Provided</th><td>{{ $record->feedback_form_provided ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->feedback_form_date) }}</td></tr>

        <tr><th>Home Safety Check Conducted</th><td>{{ $record->home_safety_check_conducted ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->home_safety_check_date) }}</td></tr>

        <tr><th>Medication Consent Form</th><td>{{ $record->medication_consent_form ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->medication_consent_date) }}</td></tr>

        <tr><th>Onboarding Form Completed</th><td>{{ $record->onboarding_form_completed ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->onboarding_form_date) }}</td></tr>

        <tr><th>Risk Assessment Completed</th><td>{{ $record->risk_assessment_completed ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->risk_assessment_date) }}</td></tr>

        <tr><th>Behaviour Support Plan Obtained</th><td>{{ $record->behaviour_support_plan_obtained ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->behaviour_support_plan_date) }}</td></tr>

        <tr><th>High Intensity Support Plan Obtained</th><td>{{ $record->high_intensity_support_plan_obtained ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->high_intensity_support_plan_date) }}</td></tr>

        <tr><th>Mealtime Plan Obtained</th><td>{{ $record->mealtime_plan_obtained ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->mealtime_plan_date) }}</td></tr>

        <tr><th>SIL Occupancy Agreement Provided</th><td>{{ $record->sil_occupancy_agreement_provided ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->sil_occupancy_agreement_date) }}</td></tr>

        <tr><th>External Provider Agreement Completed</th><td>{{ $record->external_provider_agreement_completed ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->external_provider_agreement_date) }}</td></tr>

        <tr><th>SDA Residency Agreement Provided</th><td>{{ $record->sda_residency_agreement_provided ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->sda_residency_agreement_date) }}</td></tr>

        <tr><th>SDA Welcome Pack Provided</th><td>{{ $record->sda_welcome_pack_provided ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->sda_welcome_pack_date) }}</td></tr>

        <tr><th>SDA Residency Statement Provided</th><td>{{ $record->sda_residency_statement_provided ? 'Yes' : 'No' }}</td></tr>
        <tr><th>Date</th><td>{{ formatDate($record->sda_residency_statement_date) }}</td></tr>
    </table>

    <table>
        <tr><td colspan="2" class="section-title">Disability Act Discussion</td></tr>
        <tr>
            <th>Clarify the type of services provided by the organisation</th>
            <td>{{ $record->disabilityActDiscussion?->clarify_services_provided ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>Provide verbal information about intake process: steps and expected timeline</th>
            <td>{{ $record->disabilityActDiscussion?->verbal_information_intake_process ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>Cost of services of all scheduled services</th>
            <td>{{ $record->disabilityActDiscussion?->cost_of_services ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>Participant rights (Handbook) including complaint, feedback, safety, incident</th>
            <td>{{ $record->disabilityActDiscussion?->participant_rights_handbook ? 'Yes' : 'No' }}</td>
        </tr>
</table>

<table style="width:100%; border-collapse: collapse; margin-top:30px;">
    <tr>
        <td colspan="2" class="section-title" style="font-weight:bold; background:#f3f4f6; padding:10px;">
            Participant Declaration
        </td>
    </tr>

    <tr>
        <td colspan="2" style="padding:10px;">
            Participant to sign to indicate that you have been provided with a copy of the items
            identified on the above list, with contents explained and understood.
        </td>
    </tr>

    <tr>
        <th style="text-align:left; width:35%; padding:8px;">Participant Name</th>
        <td style="padding:8px;">{{ $record->participantDeclaration?->participant_name ?? '—' }}</td>
    </tr>

    <tr>
        <th style="text-align:left; width:35%; padding:8px;">Relationship to Participant (if applicable)</th>
        <td style="padding:8px;">{{ $record->participantDeclaration?->relationship_to_participant ?? '—' }}</td>
    </tr>

    <tr>
        <th style="text-align:left; width:35%; padding:8px;">Signature</th>
        <td style="padding:8px;">
            @if(!empty($record->participantDeclaration?->participant_signature))
                <img src="{{ $record->participantDeclaration->participant_signature }}"
                     alt="Participant Signature"
                     style="max-height:70px; border:1px solid #ccc; padding:4px;">
            @else
                <span>—</span>
            @endif
        </td>
    </tr>

    <tr>
        <th style="text-align:left; width:35%; padding:8px;">Date</th>
        <td style="padding:8px;">{{ formatDate($record->participantDeclaration?->signed_date) ?? '—' }}</td>
    </tr>
</table>




</div>

</body>
</html>
