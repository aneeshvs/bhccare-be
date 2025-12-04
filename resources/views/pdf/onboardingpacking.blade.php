<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Onboarding Packing Sign Off</title>
    <style>
        @page {
            margin: 10mm;
            size: A4;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            margin-top: 80px !important;
            padding: 0;
            color: #000;
            line-height: 1.3;
            counter-reset: page;
            padding-bottom: 40px;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            background: white;
        }

        .page-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: white;
            padding: 4px 10mm;
            z-index: 1000;
            height: 45px;
            display: flex;
            align-items: center;
            box-sizing: border-box;

        }

        .page-header .logo {
            max-width: 60px;
            height: auto;
            margin-right: 10px;
        }

        .header-content {
            text-align: center;
            flex-grow: 1;
        }

        .header-title {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .document-number-container {
            position: absolute;
            top: 4px;
            right: 10mm;
            text-align: right;
        }

        .page-document-number {
            font-size: 9px;
            font-weight: 600;
            background-color: #bae6fd;
            padding: 2px 6px;
            border: 1px solid #000;
            border-radius: 3px;
            white-space: nowrap;
        }

        .section {
            margin-bottom: 8px;
            border: 1px solid #000;
            page-break-inside: avoid;
        }

        .section-header {
            background-color: #bae6fd;
            color: #000;
            padding: 6px;
            font-weight: bold;
            font-size: 10px;
            border-bottom: 1px solid #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: start;
        }

        .section-header1 {
            background-color: #bae6fd;
            color: #000;
            padding: 6px;
            font-weight: bold;
            font-size: 10px;
            border-bottom: 1px solid #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        th {
            background-color: #D6EEF7;
            color: #000;
            padding: 6px;
            text-align: center;
            border: 1px solid #000;
            font-weight: bold;
            font-size: 10px;
        }

        td {
            padding: 6px;
            vertical-align: top;
            border: 1px solid #000;
            font-size: 10px;
        }

        .field-label {
            background-color: #F2F2F2;
            font-weight: bold;
            width: 25%;
            padding: 6px;
            vertical-align: top;
            font-size: 10px;
        }

        .field-value {
            width: 25%;
            padding: 6px;
            vertical-align: top;
            font-size: 10px;
        }

        .full-width-label {
            font-weight: bold;
            width: 50%;
            padding: 6px;
            vertical-align: top;
            background-color: #e0f2fe;
            font-size: 10px;
        }

        .full-width-value {
            width: 50%;
            padding: 6px;
            vertical-align: top;
            font-size: 10px;
        }

        .empty-field {
            color: #666;
            font-style: italic;
        }

        .enum-field {
            display: flex;
            gap: 4px;
            margin-top: 1px;
            flex-wrap: wrap;
        }

        .enum-option {
            padding: 1px 3px;
            border: 1px solid #000;
            border-radius: 2px;
            background-color: #fff;
            color: #000;
            font-size: 9px;
            font-weight: 500;
        }

        .enum-option.selected {
            background-color: #666;
            color: #ffffff;
            border-color: #000;
            font-weight: bold;
        }

        .checkbox-item {
            display: flex;
            align-items: flex-start;
            gap: 4px;
            padding: 1px 0;
            margin-bottom: 1px;
            line-height: 1.1;
        }

        .checkbox-box {
            width: 8px;
            height: 8px;
            border: 1px solid #000;
            display: inline-block;
            flex-shrink: 0;
            position: relative;
            background-color: #fff;
            margin-top: 1px;
        }

        .checkbox-box.checked {
            background-color: #666;
        }

        .checkbox-box.checked::after {
            content: '';
            position: absolute;
            left: 1px;
            top: -1px;
            width: 3px;
            height: 5px;
            border: solid #fff;
            border-width: 0 1px 1px 0;
            transform: rotate(45deg);
        }

        ul {
            margin: 1px 0;
            padding-left: 8px;
        }

        li {
            margin-bottom: 1px;
            line-height: 1.2;
            font-size: 10px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            padding: 4px 15px;
            font-size: 8px;
            z-index: 100;
            height: 30px;
            box-sizing: border-box;
            border-top: 1px solid #000;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-table td {
            border: 1px solid #000;
            padding: 2px 6px;
            text-align: center;
            vertical-align: middle;
        }

        .footer-table td:first-child {
            text-align: left;
        }

        .footer-table td:last-child {
            text-align: right;
        }

        .page-break {
            page-break-before: always;
        }

        .content-wrapper {
            margin-top: 50px;
            margin-bottom: 35px;
        }

        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 2px;
            font-size: 10px;
        }

        .value {
            display: block;
            margin-top: 2px;
            font-size: 10px;
        }

        .section-body {
            padding: 6px;
        }

        .page-start {
            padding-top: 5px;
        }

        .page-break-avoid {
            page-break-inside: avoid;
        }

        .page-break-before {
            page-break-before: always;
        }

        .note-box {
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
            padding: 6px 8px;
            margin: 8px 0;
            font-size: 9px;
            line-height: 1.3;
        }

        .signature-img {
            max-height: 40px;
            border: 1px solid #ccc;
            padding: 2px;
            background-color: white;
        }

        .tick-column {
            width: 15%;
            text-align: center;
        }

        .date-column {
            width: 20%;
            text-align: center;
        }

        .item-column {
            width: 65%;
        }
    </style>
</head>
<body>
    <!-- Page Header -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-19 Onboarding Pack Contents List Sign Off</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-19</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Participant Information -->
            <div class="section page-start">
                <div class="section-header1">Participant Information</div>
                <table>
                    <tr>
                        <td class="field-label">Participant Name</td>
                        <td class="field-value" colspan="3">{{ $record->participantDeclaration?->participant_name ?? '—' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Intake and Assessment -->
            <div class="section">
                <div class="section-header">1. INTAKE AND ASSESSMENT</div>
                <table>
                    <thead>
                        <tr>
                            <th class="item-column">INTAKE & ASSESSMENT</th>
                            <th class="tick-column">TICK IF PROVIDED</th>
                            <th class="date-column">DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Service Agreement and Schedule of Support Provided</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->service_agreement_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">
                                @php
                                    use Carbon\Carbon;
                                    function formatDate($date) {
                                        return $date ? Carbon::parse($date)->format('d/m/Y') : '-';
                                    }
                                @endphp
                                {{ formatDate($record->service_agreement_date) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Participant Handbook Provided</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->participant_handbook_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->participant_handbook_date) }}</td>
                        </tr>
                        <tr>
                            <td>Support Care Plan Offered</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->support_care_plan_offered ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->support_care_plan_date) }}</td>
                        </tr>
                        <tr>
                            <td>Consent to Exchange Confidential Information – Form Signed</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->consent_form_signed ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->consent_form_date) }}</td>
                        </tr>
                        <tr>
                            <td>Compliments / Complaints / Feedback Form Provided</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->feedback_form_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->feedback_form_date) }}</td>
                        </tr>
                        <tr>
                            <td>Home Safety Checklist Assessment Conducted</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->home_safety_check_conducted ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->home_safety_check_date) }}</td>
                        </tr>
                        <tr>
                            <td>Medication Consent Form (If Applicable)</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->medication_consent_form ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->medication_consent_date) }}</td>
                        </tr>
                        <tr>
                            <td>Onboarding Form Completed</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->onboarding_form_completed ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->onboarding_form_date) }}</td>
                        </tr>
                        <tr>
                            <td>Individual Risk Assessment Completed</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->risk_assessment_completed ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->risk_assessment_date) }}</td>
                        </tr>
                        <tr>
                            <td>Behaviour Support Plan Obtained (If Applicable)</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->behaviour_support_plan_obtained ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->behaviour_support_plan_date) }}</td>
                        </tr>
                        <tr>
                            <td>High Intensity Support Plan Obtained (If Applicable)</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->high_intensity_support_plan_obtained ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->high_intensity_support_plan_date) }}</td>
                        </tr>
                        <tr>
                            <td>Mealtime Management Plan Obtained (If Applicable)</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->mealtime_plan_obtained ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->mealtime_plan_date) }}</td>
                        </tr>
                        <tr>
                            <td>SIL Occupancy Agreement Provided</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->sil_occupancy_agreement_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->sil_occupancy_agreement_date) }}</td>
                        </tr>
                        <tr>
                            <td>External Provider Service Agreement Completed (SIL Only)</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->external_provider_agreement_completed ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->external_provider_agreement_date) }}</td>
                        </tr>
                        <tr>
                            <td>SDA Residency Agreement Provided</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->sda_residency_agreement_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->sda_residency_agreement_date) }}</td>
                        </tr>
                        <tr>
                            <td>SDA Resident Welcome Pack Provided</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->sda_welcome_pack_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->sda_welcome_pack_date) }}</td>
                        </tr>
                        <tr>
                            <td>SDA Residency Statement Provided</td>
                            <td class="tick-column">
                                <div class="enum-field">
                                    @foreach(['Yes','No'] as $option)
                                        <span class="enum-option {{ ($record->sda_residency_statement_provided ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="date-column">{{ formatDate($record->sda_residency_statement_date) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <tr>
                <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 Febraury 2025
                </td>
                <td style="width: 34%">
                    Approver: Director<br>
                    UNCONTROLLED WHEN PRINTED
                </td>

                <td>
                </td>

            </tr>
            </tr>
        </table>
    </div>


    <!-- Header for Page 2 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-19 Onboarding Pack Contents List Sign Off</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-19</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Disability Act Discussion -->
            <div class="section page-start">
                <div class="section-header">2. IN LINE WITH THE DISABILITY ACT, PLEASE DISCUSS THE FOLLOWING</div>
                <table>
                    <tr>
                        <td class="field-label">Clarify the type of services provided by the organisation</td>
                        <td class="field-value">
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
                        <td class="field-label">Provide verbal information about intake process: steps and expected timeline</td>
                        <td class="field-value">
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
                        <td class="field-label">Cost of services of all scheduled services</td>
                        <td class="field-value">
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
                        <td class="field-label">Participant rights (Handbook) including complaint, feedback, safety, incident</td>
                        <td class="field-value">
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
            </div>

            <!-- Prior to Scheduling Visit -->
            <div class="section">
                <div class="section-header1">PRIOR TO SCHEDULING A VISIT TO THE PARTICIPANT</div>
                <table>
                    <tr>
                        <td>
                            <div class="checkbox-item">
                                <span class="checkbox-box"></span>
                                <span>Request that it is a non-smoking environment</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox-item">
                                <span class="checkbox-box"></span>
                                <span>Request that any pets are kept separate to staff, both inside and outside residence</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox-item">
                                <span class="checkbox-box"></span>
                                <span>Any directions/instructions to get to residence including parking options</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox-item">
                                <span class="checkbox-box"></span>
                                <span>Ask if there have been any past health/safety issues, or current concerns</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox-item">
                                <span class="checkbox-box"></span>
                                <span>How we can ensure safety in the participant's environment</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox-item">
                                <span class="checkbox-box"></span>
                                <span>Clarify which is the preferred door to be used for entry</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 2 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <tr>
                <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 Febraury 2025
                </td>
                <td style="width: 34%">
                    Approver: Director<br>
                    UNCONTROLLED WHEN PRINTED
                </td>

                <td>
                </td>

            </tr>
            </tr>
        </table>
    </div>


    <!-- Header for Page 3 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-19 Onboarding Pack Contents List Sign Off</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-19</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Participant Declaration -->
            <div class="section page-start">
                <div class="section-header">3. PARTICIPANT DECLARATION</div>
                <div class="note-box">
                    Participant to sign to indicate that you have been provided with a copy of the items identified on the above list, with contents explained and understood.
                </div>
                <table>
                    <tr>
                        <td class="field-label">Participant Name</td>
                        <td class="field-value">{{ $record->participantDeclaration?->participant_name ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Relationship to Participant (if applicable)</td>
                        <td class="field-value">{{ $record->participantDeclaration?->relationship_to_participant ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Signature</td>
                        <td class="field-value">
                            @if(!empty($record->participantDeclaration?->participant_signature))
                                <img src="{{ $record->participantDeclaration->participant_signature }}"
                                     alt="Participant Signature"
                                     class="signature-img">
                            @else
                                <span>—</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Date</td>
                        <td class="field-value">{{ formatDate($record->participantDeclaration?->signed_date) ?? '—' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 3 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 Febraury 2025
                </td>
                <td style="width: 34%">
                    Approver: Director<br>
                    UNCONTROLLED WHEN PRINTED
                </td>
                <td>
                </td>

            </tr>
        </table>
    </div>
</body>
</html>
