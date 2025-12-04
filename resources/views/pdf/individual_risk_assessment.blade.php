<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Individual Risk Assessment</title>
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
            background-color: #e0f2fe;
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

        .three-column-table {
            width: 100%;
            border-collapse: collapse;
        }

        .three-column-table td {
            border: none;
            padding: 1px 3px;
        }

        .health-conditions-table {
            width: 100%;
            border-collapse: collapse;
        }

        .health-conditions-table td {
            border: none;
            padding: 1px 3px;
            vertical-align: top;
        }

        .health-conditions-column {
            width: 33.33%;
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

        .how-to-use {
            margin-bottom: 15px;
            padding: 8px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 10px;
        }

        .how-to-use-title {
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <!-- Page Header -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-5a Individual Risk Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5a</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- HOW TO USE THIS FORM -->
            <div class="how-to-use">
                <div class="how-to-use-title">HOW TO USE THIS FORM</div>
                You are to ensure onsite completion of the Home Safety Check prior to the commencement of service delivery.
                Only complete those areas related to the services to be provided and ensure you address potential risks
                with the Participant and put in place risk controls. This safety checklist is to be completed each time
                changes to the supports or their delivery are required, and/or any changes made to the Participant's
                Service Agreement and/or Support care plan.
            </div>

            <!-- Client Details -->
            <div class="section page-start">
                <div class="section-header">1.Client</div>
                <table>
                    <tr>
                        <td class="field-label">Client Name</td>
                        <td class="field-value">{{ $assessment->client_name ?? 'N/A' }}</td>
                        <td class="field-label">Site Address</td>
                        <td class="field-value">{{ $assessment->site_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Date of Assessment</td>
                        <td class="field-value">
                            {{ $assessment->assessment_date ? \Carbon\Carbon::parse($assessment->assessment_date)->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td class="field-label">Planned Review Date</td>
                        <td class="field-value">
                            {{ $assessment->planned_review_date ? \Carbon\Carbon::parse($assessment->planned_review_date)->format('d/m/Y') : 'N/A' }}
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Vulnerability Details -->
            <div class="section">
                <div class="section-header">2.Vulnerability</div>
                <table>
                    <tr>
                        <td class="field-label">Vulnerability</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['high' => 'High', 'medium' => 'Medium', 'low' => 'Low'] as $value => $label)
                                    <span class="enum-option {{ ($assessment->details->vulnerability ?? '') === $value ? 'selected' : '' }}">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">Review Frequency</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['3_months' => '3 Months', '6_months' => '6 Months', '12_months' => '12 Months'] as $value => $label)
                                    <span class="enum-option {{ ($assessment->details->review_frequency ?? '') === $value ? 'selected' : '' }}">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Are you reliant on Best of Home Care for your daily needs? </td>
                        <td class="field-value" colspan="3">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->details->dependent_on_homecare ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Communication -->
            @if($assessment->communications)
            <div class="section">
                <div class="section-header">3.Communication</div>
                <table>
                    <tr>
                        <th style="width: 30%">Question</th>
                        <th style="width: 10%">Response</th>
                        <th style="width: 25%">Hazards identified</th>
                        <th style="width: 35%">Management Plan</th>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant have Hearing impairment?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->communications->hearing_impairment ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->communications->hearing_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->communications->hearing_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant have Speech impairment?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->communications->speech_impairment ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->communications->speech_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->communications->speech_management_plan ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            @endif

            <!-- Cognition -->
            @if($assessment->cognitions)
            <div class="section">
                <div class="section-header">4.Cognition</div>
                <table>
                    <tr>
                        <th style="width: 30%">Question</th>
                        <th style="width: 10%">Response</th>
                        <th style="width: 25%">Hazards identified</th>
                        <th style="width: 35%">Management Plan</th>
                    </tr>
                    <tr>
                        <td class="field-label">Is the Participant disoriented in time and place</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->cognitions->oriented_in_time_place ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->cognitions->oriented_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->cognitions->oriented_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Is the partcipant unable to follow direction and instruction?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->cognitions->accepts_direction ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->cognitions->direction_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->cognitions->direction_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant experience Short-term memory difficulties?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->cognitions->short_term_memory_issues ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->cognitions->memory_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->cognitions->memory_management_plan ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
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
                <td style="width: 33%">

                </td>
            </tr>
        </table>
    </div>



    <!-- Header for Page 2 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-5a Individual Risk Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5a</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Mobility -->
            @if($assessment->mobilities)
            <div class="section page-start">
                <div class="section-header">5.Mobility</div>
                <table>
                    <tr>
                        <th style="width: 30%">Question</th>
                        <th style="width: 10%">Response</th>
                        <th style="width: 25%">Hazards identified</th>
                        <th style="width: 35%">Management Plan</th>
                    </tr>
                    <tr>
                        <td class="field-label">Does the partcipant face the risk when walking without assistance?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->mobilities->walk_unaided ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->mobilities->walk_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->mobilities->walk_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="full-width-label">Are environmental accessibility considerations required (e.g., premise must have ramp, sensory requirements, parking requirements) </td>
                        <td class="field-value"  colspan="3" >
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->mobilities->accessibility_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="field-label">Does the participant require  assisitance to use stairs</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->mobilities->manages_stairs ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->mobilities->stairs_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->mobilities->stairs_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Uses walking aid to walk</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->mobilities->uses_walking_aid ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->mobilities->walking_aid_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->mobilities->walking_aid_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Uses electric wheelchair/ scooter</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->mobilities->uses_wheelchair ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->mobilities->wheelchair_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->mobilities->wheelchair_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Bed Transfer</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->mobilities->bed_transfer ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->mobilities->bed_transfer_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->mobilities->bed_transfer_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Vehicle Transfer</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->mobilities->vehicle_transfer ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->mobilities->vehicle_transfer_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->mobilities->vehicle_transfer_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Toilet Transfer</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->mobilities->toilet_transfer ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->mobilities->toilet_transfer_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->mobilities->toilet_transfer_management_plan ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            @endif

            <!-- Personal Care & Support -->
            @if($assessment->personalCareSupport)
            <div class="section">
                <div class="section-header">6.Personal Care & Support</div>
                <table>
                    <tr>
                        <th style="width: 30%">Question</th>
                        <th style="width: 10%">Response</th>
                        <th style="width: 25%">Hazards identified</th>
                        <th style="width: 35%">Management Plan</th>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant require assistance with showering?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->personalCareSupport->showering ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->personalCareSupport->showering_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->personalCareSupport->showering_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant require assistance with meal?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->personalCareSupport->meal ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->personalCareSupport->meal_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->personalCareSupport->meal_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant require assistance with Toileting?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->personalCareSupport->toileting ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->personalCareSupport->toileting_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->personalCareSupport->toileting_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant require assistance with Grooming?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->personalCareSupport->grooming ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->personalCareSupport->grooming_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->personalCareSupport->grooming_management_plan ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            @endif
        </div>
    </div>

    <!-- Footer for Page 2 -->
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
                <td style="width: 33%">

                </td>
            </tr>
        </table>
    </div>



    <!-- Header for Page 3 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-5a Individual Risk Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5a</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Personal Care & Support (Continued) -->
            @if($assessment->personalCareSupport)
            <div class="section page-start">
                <div class="section-header">Personal Care & Support (Continued)</div>
                <table>
                    <tr>
                        <th style="width: 30%">Question</th>
                        <th style="width: 10%">Response</th>
                        <th style="width: 25%">Hazards identified</th>
                        <th style="width: 35%">Management Plan</th>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant require assistance with Repositioning in bed?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->personalCareSupport->repositioning_bed ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->personalCareSupport->repositioning_bed_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->personalCareSupport->repositioning_bed_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant require assistance with Repositioning in chair?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->personalCareSupport->repositioning_chair ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->personalCareSupport->repositioning_chair_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->personalCareSupport->repositioning_chair_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant require assistance with Mouthcare?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->personalCareSupport->mouthcare ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->personalCareSupport->mouthcare_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->personalCareSupport->mouthcare_management_plan ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Does the participant require assistance with Skin care?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->personalCareSupport->skin_care ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-value">{{ $assessment->personalCareSupport->skin_care_hazards ?? 'N/A' }}</td>
                        <td class="field-value">{{ $assessment->personalCareSupport->skin_care_management_plan ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            @endif

            <!-- Manual Handling -->
            <div class="section">
                <div class="section-header">7.Manual Handling (Refer to Manual Handling HandBook)</div>
                <table>
                    <tr>
                        <th style="width: 30%">Question</th>
                        <th style="width: 10%">Response</th>
                        <th style="width: 25%">Hazards identified</th>
                        <th style="width: 35%">Management Plan</th>
                    </tr>
                    @php
                        $manualHandlings = $assessment->manualHandlings ?? collect();
                    @endphp

                    @if($manualHandlings->isNotEmpty())
                        @foreach($manualHandlings as $mh)
                            <tr>
                                <td class="field-label">Has training been provided to support staff for specific client handling techniques?</td>
                                <td class="field-value">
                                    <div class="enum-field">
                                        @foreach(['Yes', 'No'] as $option)
                                            <span class="enum-option {{ ($mh->training_provided ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                                {{ $option }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="field-value">{{ $mh->training_hazards ?? 'N/A' }}</td>
                                <td class="field-value">{{ $mh->training_management_plan ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="field-label">Can all manual handling tasks be undertaken safely with current staff and equipment?</td>
                                <td class="field-value">
                                    <div class="enum-field">
                                        @foreach(['Yes', 'No'] as $option)
                                            <span class="enum-option {{ ($mh->tasks_safe ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                                {{ $option }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="field-value">{{ $mh->tasks_hazards ?? 'N/A' }}</td>
                                <td class="field-value">{{ $mh->tasks_management_plan ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="field-label">Has training been provided to support staff for specific client handling techniques?</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    <span class="enum-option">Yes</span>
                                    <span class="enum-option">No</span>
                                </div>
                            </td>
                            <td class="field-value">N/A</td>
                            <td class="field-value">N/A</td>
                        </tr>
                        <tr>
                            <td class="field-label">Can all manual handling tasks be undertaken safely with current staff and equipment?</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    <span class="enum-option">Yes</span>
                                    <span class="enum-option">No</span>
                                </div>
                            </td>
                            <td class="field-value">N/A</td>
                            <td class="field-value">N/A</td>
                        </tr>
                    @endif
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
                <td style="width: 33%">

                </td>
            </tr>
        </table>
    </div>



    <!-- Header for Page 4 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-5a Individual Risk Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5a</div>
        </div>
    </div>

   <div class="content-wrapper">
    <div class="container">
        <!-- Violence Risks -->
        @if($assessment->violenceRisk)
        <div class="section page-start">
            <div class="section-header">8.Violence Risks</div>
            <table>
                <tr>
                    <th style="width: 25%">Question</th>
                    <th style="width: 10%">Response</th>
                    <th style="width: 20%">Hazards identified</th>
                    <th style="width: 25%">Management Plan</th>
                    <th style="width: 20%">Is there a BSP plan:</th>
                </tr>
                @php
                    $vr = $assessment->violenceRisk;
                @endphp
                <tr>
                    <td class="field-label">Is there a history of physical aggression toward staff by the client?</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->physical_aggression ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="field-value">{{ $vr->physical_hazards ?? 'N/A' }}</td>
                    <td class="field-value">{{ $vr->physical_management_plan ?? 'N/A' }}</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->physical_bsp_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="field-label">Is there a history of verbal aggression toward staff by the client?</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->verbal_aggression ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="field-value">{{ $vr->verbal_hazards ?? 'N/A' }}</td>
                    <td class="field-value">{{ $vr->verbal_management_plan ?? 'N/A' }}</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->verbal_bsp_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="field-label">Is there a history of aggression towards other clients?</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->client_aggression ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="field-value">{{ $vr->client_hazards ?? 'N/A' }}</td>
                    <td class="field-value">{{ $vr->client_management_plan ?? 'N/A' }}</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->client_bsp_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="field-label">Is there a history of self harm?</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->self_harm ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="field-value">{{ $vr->self_harm_hazards ?? 'N/A' }}</td>
                    <td class="field-value">{{ $vr->self_harm_management_plan ?? 'N/A' }}</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->self_harm_bsp_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="field-label">Does the participant engage in drug or alcohol use?</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->drug_alcohol_use ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="field-value">{{ $vr->drug_alcohol_hazards ?? 'N/A' }}</td>
                    <td class="field-value">{{ $vr->drug_alcohol_management_plan ?? 'N/A' }}</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->drug_alcohol_bsp_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="field-label">Is there a history of sexual abuse?</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->sexual_abuse_history ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="field-value">{{ $vr->sexual_abuse_hazards ?? 'N/A' }}</td>
                    <td class="field-value">{{ $vr->sexual_abuse_management_plan ?? 'N/A' }}</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->sexual_abuse_bsp_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="field-label">Use of emotions to achieve goals?</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->emotional_manipulation ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="field-value">{{ $vr->emotional_hazards ?? 'N/A' }}</td>
                    <td class="field-value">{{ $vr->emotional_management_plan ?? 'N/A' }}</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->emotional_bsp_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="field-label">Other known risks?</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->other_known_risks ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="field-value">{{ $vr->other_risks_hazards ?? 'N/A' }}</td>
                    <td class="field-value">{{ $vr->other_risks_management_plan ?? 'N/A' }}</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->other_risks_bsp_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="field-label">Does the participant need help to manage their finances?</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->finance_management ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="field-value">{{ $vr->finance_hazards ?? 'N/A' }}</td>
                    <td class="field-value">{{ $vr->finance_management_plan ?? 'N/A' }}</td>
                    <td class="field-value">
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($vr->finance_bsp_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        @endif
    </div>
</div>

    <!-- Footer for Page 4 -->
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
                <td style="width: 33%">

                </td>
            </tr>
        </table>
    </div>
</body>
</html>
