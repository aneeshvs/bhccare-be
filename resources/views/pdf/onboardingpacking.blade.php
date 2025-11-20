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
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 10px 15px;
            font-weight: bold;
            border-left: 4px solid #0284c7;
            margin-bottom: 10px;
            border-radius: 4px;
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

        .enum-field {
            display: flex;
            gap: 10px;
            margin-top: 4px;
        }

        .enum-option {
            padding: 3px 6px;
            border: 1px solid #d1d5db;
            border-radius: 3px;
            background-color: #f9fafb;
            color: #374151;
            font-size: 11px;
            font-weight: 500;
        }

        .enum-option.selected {
            background-color: #0284c7;
            color: #ffffff;
            border-color: #0369a1;
            font-weight: bold;
        }
    </style>

    <style>
.three-col-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
    margin-bottom: 20px;
}

.three-col-table th,
.three-col-table td {
    border: 1px solid #ccc;
    padding: 6px;
    vertical-align: top;
}

.section-title {
    background: #f0f0f0;
    font-weight: bold;
    padding: 8px;
}

.tick {
    width: 80px;
    text-align: center;
    white-space: nowrap;
}

.date {
    width: 140px;
    white-space: nowrap;
}

.enum-option {
    padding: 3px 6px;
    border: 1px solid #aaa;
    margin-right: 4px;
    font-size: 11px;
}

.enum-option.selected {
    background: #007bff;
    color: white;
    border-color: #007bff;
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
        <h2>Onboarding Pack Contents List Sign Off</h2>
        <div class="document-number">Document Number: <span>Form F-19</span></div>

    </div>

    {{-- Onboarding Items --}}
<table class="three-col-table">

    <tr>
        <td colspan="3" class="section-title">1. INTAKE AND ASSESSMENT</td>

    </tr>
        <tr>
            <th style="text-align:left; width:35%; padding:8px;">Participant Name</th>
            <td style="padding:8px;">{{ $record->participantDeclaration?->participant_name ?? '—' }}</td>
        </tr>

    <!-- Column Headings -->
    <tr class="header-row">
        <th style="width:55%;">INTAKE & ASSESSMENT</th>
        <th style="width:20%;">TICK IF PROVIDED</th>
        <th style="width:25%;">DATE</th>
    </tr>

    <tr>
        <td>Service Agreement and Schedule of Support Provided</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->service_agreement_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->service_agreement_date) }}</td>
    </tr>

    <tr>
        <td>Participant Handbook Provided</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->participant_handbook_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->participant_handbook_date) }}</td>
    </tr>

    <tr>
        <td>Support Care Plan Offered</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->support_care_plan_offered ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->support_care_plan_date) }}</td>
    </tr>

    <tr>
        <td>Consent to Exchange Confidential Information – Form Signed</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->consent_form_signed ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->consent_form_date) }}</td>
    </tr>

    <tr>
        <td>Compliments / Complaints / Feedback Form Provided</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->feedback_form_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->feedback_form_date) }}</td>
    </tr>

    <tr>
        <td>Home Safety Checklist Assessment Conducted</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->home_safety_check_conducted ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->home_safety_check_date) }}</td>
    </tr>

    <tr>
        <td>Medication Consent Form (If Applicable)</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->medication_consent_form ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->medication_consent_date) }}</td>
    </tr>

    <tr>
        <td>Onboarding Form Completed</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->onboarding_form_completed ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->onboarding_form_date) }}</td>
    </tr>

    <tr>
        <td>Individual Risk Assessment Completed</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->risk_assessment_completed ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->risk_assessment_date) }}</td>
    </tr>

    <tr>
        <td>Behaviour Support Plan Obtained (If Applicable)</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->behaviour_support_plan_obtained ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->behaviour_support_plan_date) }}</td>
    </tr>

    <tr>
        <td>High Intensity Support Plan Obtained (If Applicable)</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->high_intensity_support_plan_obtained ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->high_intensity_support_plan_date) }}</td>
    </tr>

    <tr>
        <td>Mealtime Management Plan Obtained (If Applicable)</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->mealtime_plan_obtained ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->mealtime_plan_date) }}</td>
    </tr>

    <tr>
        <td>SIL Occupancy Agreement Provided</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->sil_occupancy_agreement_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->sil_occupancy_agreement_date) }}</td>
    </tr>

    <tr>
        <td>External Provider Service Agreement Completed (SIL Only)</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->external_provider_agreement_completed ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->external_provider_agreement_date) }}</td>
    </tr>

    <tr>
        <td>SDA Residency Agreement Provided</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->sda_residency_agreement_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->sda_residency_agreement_date) }}</td>
    </tr>

    <tr>
        <td>SDA Resident Welcome Pack Provided</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->sda_welcome_pack_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->sda_welcome_pack_date) }}</td>
    </tr>

    <tr>
        <td>SDA Residency Statement Provided</td>
        <td class="tick">
            @foreach(['Yes','No'] as $option)
                <span class="enum-option {{ ($record->sda_residency_statement_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
            @endforeach
        </td>
        <td class="date">{{ formatDate($record->sda_residency_statement_date) }}</td>
    </tr>

</table>


    <table>
        <tr><td colspan="2" class="section-title">2.IN LINE WITH THE DISABILITY ACT, PLEASE DISCUSS THE FOLLOWING</td></tr>
        <tr>
            <th>Clarify the type of services provided by the organisation</th>
            <td>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($record->disabilityActDiscussion?->clarify_services_provided ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <th>Provide verbal information about intake process: steps and expected timeline</th>
            <td>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($record->disabilityActDiscussion?->verbal_information_intake_process ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <th>Cost of services of all scheduled services</th>
            <td>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($record->disabilityActDiscussion?->cost_of_services ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <th>Participant rights (Handbook) including complaint, feedback, safety, incident</th>
            <td>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($record->disabilityActDiscussion?->participant_rights_handbook ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
    </table>

    <div style="page-break-before: always;"></div>


    <table class="pre-visit-table">
        <tr>
            <td class="section-title">PRIOR TO SCHEDULING A VISIT TO THE PARTICIPANT</td>
        </tr>
        <tr><td>1. Request that it is a non-smoking environment</td></tr>
        <tr><td>2. Request that any pets are kept separate to staff, both inside and outside residence</td></tr>
        <tr><td>3. Any directions/instructions to get to residence including parking options</td></tr>
        <tr><td>4. Ask if there have been any past health/safety issues, or current concerns</td></tr>
        <tr><td>5. How we can ensure safety in the participant’s environment</td></tr>
        <tr><td>6. Clarify which is the preferred door to be used for entry</td></tr>
    </table>


    <table style="width:100%; border-collapse: collapse; margin-top:30px;">
        <tr>
            <td colspan="2" class="section-title" style="font-weight:bold; background:#f3f4f6; padding:10px;">
                3.Participant Declaration
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
