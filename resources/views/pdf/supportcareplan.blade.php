<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SCP-01 Support Care Plan - BHC</title>
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
            text-align: center;
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
            text-align: start;
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
            font-size: 12px;
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
            font-size: 8px;
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
            font-size: 10px;
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

        .checkbox-group {
            display: block;
            white-space: nowrap;
            margin-top: 2px;
        }

        .checkbox-group-columns {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 8px;
            margin-top: 2px;
        }

        .checkbox-column {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .comm-checkbox-item {
            display: flex;
            align-items: flex-start;
            gap: 4px;
            min-height: 14px;
        }

        .comm-checkbox-box {
            width: 8px;
            height: 8px;
            border: 1px solid #000;
            display: inline-block;
            flex-shrink: 0;
            position: relative;
            background-color: #fff;
            margin-top: 1px;
        }

        .comm-checkbox-box.checked {
            background-color: #666;
        }

        .comm-checkbox-box.checked::after {
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

        .goal-table {
            width: 100%;
            border-collapse: collapse;
        }

        .goal-table th {
            background-color: #D6EEF7;
            padding: 6px;
            text-align: center;
            border: 1px solid #000;
            font-weight: bold;
            font-size: 10px;
        }

        .goal-table td {
            padding: 6px;
            border: 1px solid #000;
            font-size: 10px;
        }

        .goal-table .field-label {
            background-color: #e0f2fe;
            width: 30%;
        }

        .goal-table .field-value {
            background-color: #fff;
            width: 70%;
        }

        .goal-header-row {
            background-color: #D6EEF7;
            font-weight: bold;
            text-align: center;
            padding: 6px;
            font-size: 10px;
        }

        .info-text {
            font-style: italic;
            font-size: 8px;
            color: #555;
            margin-top: 1px;
        }

        .emergency-table {
            width: 100%;
            border-collapse: collapse;
        }

        .emergency-table th {
            background-color: #D6EEF7;
            padding: 6px;
            text-align: center;
            border: 1px solid #000;
            font-weight: bold;
            font-size: 10px;
        }

        .emergency-table td {
            padding: 6px;
            border: 1px solid #000;
            font-size: 10px;
        }

        .emergency-section {
            margin-top: 8px;
            border: 1px solid #000;
            page-break-inside: avoid;
        }

        .emergency-section-header {
            background-color: #bae6fd;
            color: #000;
            padding: 6px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #000;
            font-size: 10px;
            text-transform: uppercase;
        }

        .emergency-section-content {
            padding: 6px;
            font-size: 10px;
            background-color: #fff;
        }

        .emergency-section-content ul {
            margin: 4px 0;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <!-- Page 1 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title"> SCP-01 Support Care Plan</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SCP-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">


            <!-- Participant Details -->
            <div class="section page-start">
                <div class="section-header1">1.PARTICIPANT DETAILS</div>
                <table>
                    <tr>
                        <td class="field-label">First Name</td>
                        <td class="field-value">{{ $supportCarePlan->consents_participant_first_name ?? 'N/A' }}</td>
                        <td class="field-label">Surname</td>
                        <td class="field-value">{{ $supportCarePlan->consents_participant_surname ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Date of Birth</td>
                        <td class="field-value">
                            @if(isset($supportCarePlan->consents_participant_dob))
                                {{ \Carbon\Carbon::parse($supportCarePlan->consents_participant_dob)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="field-label">Plan Created Date</td>
                        <td class="field-value">
                            @if(isset($supportCarePlan->created_at))
                                {{ \Carbon\Carbon::parse($supportCarePlan->created_at)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Goal Plan Start Date</td>
                        <td class="field-value">
                            @if(isset($supportCarePlan->consents_goal_plan_start_date))
                                {{ \Carbon\Carbon::parse($supportCarePlan->consents_goal_plan_start_date)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="field-label">Goal Plan Review Date</td>
                        <td class="field-value">
                            @if(isset($supportCarePlan->consents_goal_plan_review_date))
                                {{ \Carbon\Carbon::parse($supportCarePlan->consents_goal_plan_review_date)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Alternate Decision Maker -->
            <div class="section">
                <div class="section-header1"> 2.ALTERNATE DECISION MAKER</div>
                <table>
                    <tr>
                        <td class="field-label">Type</td>
                        <td class="field-value" colspan="3">
                            <div class="enum-field">
                                @foreach(['not_applicable' => 'Not Applicable', 'partner' => 'Partner', 'carer' => 'Carer', 'guardian' => 'Guardian', 'parent' => 'Parent', 'advocacy' => 'Advocacy', 'other' => 'Other'] as $value => $label)
                                    <span class="enum-option {{ ($supportCarePlan->alternateDecisionMaker->type ?? '') === $value ? 'selected' : '' }}">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">First Name</td>
                        <td class="field-value">{{ $supportCarePlan->alternateDecisionMaker->first_name ?? 'N/A' }}</td>
                        <td class="field-label">Surname</td>
                        <td class="field-value">{{ $supportCarePlan->alternateDecisionMaker->surname ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Notes</td>
                        <td class="field-value" colspan="3">{{ $supportCarePlan->alternateDecisionMaker->notes ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
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

    <!-- Page 2 - SIL Goals -->

    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SCP-01 Support Care Plan</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SCP-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- SIL GOALS -->
            <div class="section page-start">
                <div class="section-header1"> 3.SIL GOALS</div>

                @php
                    $silGoals = $supportCarePlan->silGoals ?? collect();
                @endphp

                <!-- Goal #1 -->
                <table class="goal-table">
                    <tr>
                        <td colspan="2" class="goal-header-row">Goal #1</td>
                    </tr>
                    <tr>
                        <td class="field-label">Goals of support<br><span class="info-text">What is the specific goal to be achieved through BHC supports?</span></td>
                        <td class="field-value">{{ $silGoals->get(0)->goals_of_support ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Steps<br><span class="info-text">What will the participant do to actively participate in meeting this goal?</span></td>
                        <td class="field-value">{{ $silGoals->get(0)->steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Organisation's steps<br><span class="info-text">What support will we provide to meet this goal?</span></td>
                        <td class="field-value">{{ $silGoals->get(0)->organisation_steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk</td>
                        <td class="field-value">{{ $silGoals->get(0)->risk ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk Management Strategies</td>
                        <td class="field-value">{{ $silGoals->get(0)->risk_management_strategies ?? 'N/A' }}</td>
                    </tr>
                </table>

                <!-- Goal #2 -->
                <table class="goal-table" style="margin-top: 6px;">
                    <tr>
                        <td colspan="2" class="goal-header-row">Goal #2</td>
                    </tr>
                    <tr>
                        <td class="field-label">Goals of support<br><span class="info-text">What is the specific goal to be achieved through BHC supports?</span></td>
                        <td class="field-value">{{ $silGoals->get(1)->goals_of_support ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Steps<br><span class="info-text">What will the participant do to actively participate in meeting this goal?</span></td>
                        <td class="field-value">{{ $silGoals->get(1)->steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Organisation's steps<br><span class="info-text">What support will we provide to meet this goal?</span></td>
                        <td class="field-value">{{ $silGoals->get(1)->organisation_steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk</td>
                        <td class="field-value">{{ $silGoals->get(1)->risk ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk Management Strategies</td>
                        <td class="field-value">{{ $silGoals->get(1)->risk_management_strategies ?? 'N/A' }}</td>
                    </tr>
                </table>

                <!-- Health Goals (SIL) -->
                {{-- <table class="goal-table" style="margin-top: 6px;">
                    <tr>
                        <td colspan="2" class="goal-header-row">Health Goals (Where Applicable) (SIL)</td>
                    </tr>
                    <tr>
                        <td class="field-label">Goals of support<br><span class="info-text">What is the specific goal to be achieved through BHC supports?</span></td>
                        <td class="field-value">{{ $silGoals->get(2)->goals_of_support ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Steps<br><span class="info-text">What will the participant do to actively participate in meeting this goal?</span></td>
                        <td class="field-value">{{ $silGoals->get(2)->steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Organisation's steps<br><span class="info-text">What support will we provide to meet this goal?</span></td>
                        <td class="field-value">{{ $silGoals->get(2)->organisation_steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk</td>
                        <td class="field-value">{{ $silGoals->get(2)->risk ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk Management Strategies</td>
                        <td class="field-value">{{ $silGoals->get(2)->risk_management_strategies ?? 'N/A' }}</td>
                    </tr>
                </table> --}}
            </div>
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

    <!-- Page 3 - Support Coordination Goals -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SCP-01 Support Care Plan</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SCP-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- SUPPORT COORDINATION GOALS -->
            <div class="section page-start">
                <div class="section-header1"> 4.SUPPORT COORDINATION GOALS</div>

                @php
                    $supportCoordinationGoals = $supportCarePlan->supportCoordinationGoals ?? collect();
                @endphp

                <!-- Goal #1 -->
                <table class="goal-table">
                    <tr>
                        <td colspan="2" class="goal-header-row">Goal #1</td>
                    </tr>
                    <tr>
                        <td class="field-label">Goals of support<br><span class="info-text">What is the specific goal to be achieved through BHC supports?</span></td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(0)->goals_of_support ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Steps<br><span class="info-text">What will the participant do to actively participate in meeting this goal?</span></td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(0)->steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Organisation's steps<br><span class="info-text">What support will we provide to meet this goal?</span></td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(0)->organisation_steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk</td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(0)->risk ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk Management Strategies</td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(0)->risk_management_strategies ?? 'N/A' }}</td>
                    </tr>
                </table>

                <!-- Goal #2 -->
                <table class="goal-table" style="margin-top: 6px;">
                    <tr>
                        <td colspan="2" class="goal-header-row">Goal #2</td>
                    </tr>
                    <tr>
                        <td class="field-label">Goals of support<br><span class="info-text">What is the specific goal to be achieved through BHC supports?</span></td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(1)->goals_of_support ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Steps<br><span class="info-text">What will the participant do to actively participate in meeting this goal?</span></td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(1)->steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Organisation's steps<br><span class="info-text">What support will we provide to meet this goal?</span></td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(1)->organisation_steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk</td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(1)->risk ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk Management Strategies</td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(1)->risk_management_strategies ?? 'N/A' }}</td>
                    </tr>
                </table>

                <!-- Health Goals (Support Coordination) -->
                {{-- <table class="goal-table" style="margin-top: 6px;">
                    <tr>
                        <td colspan="2" class="goal-header-row">Health Goals (Where Applicable) (Support Coordination)</td>
                    </tr>
                    <tr>
                        <td class="field-label">Goals of support<br><span class="info-text">What is the specific goal to be achieved through BHC supports?</span></td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(2)->goals_of_support ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Steps<br><span class="info-text">What will the participant do to actively participate in meeting this goal?</span></td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(2)->steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Organisation's steps<br><span class="info-text">What support will we provide to meet this goal?</span></td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(2)->organisation_steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk</td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(2)->risk ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk Management Strategies</td>
                        <td class="field-value">{{ $supportCoordinationGoals->get(2)->risk_management_strategies ?? 'N/A' }}</td>
                    </tr>
                </table> --}}
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

    <!-- Page 4 - Home Care Goals -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SCP-01 Support Care Plan</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SCP-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- HOME CARE GOALS -->
            <div class="section page-start">
                <div class="section-header1">5.HOME CARE GOALS</div>

                @php
                    $homecareGoals = $supportCarePlan->homecareGoals ?? collect();
                @endphp

                <!-- Goal #1 -->
                <table class="goal-table">
                    <tr>
                        <td colspan="2" class="goal-header-row">Goal #1</td>
                    </tr>
                    <tr>
                        <td class="field-label">Goals of support<br><span class="info-text">What is the specific goal to be achieved through BHC supports?</span></td>
                        <td class="field-value">{{ $homecareGoals->get(0)->goals_of_support ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Steps<br><span class="info-text">What will the participant do to actively participate in meeting this goal?</span></td>
                        <td class="field-value">{{ $homecareGoals->get(0)->steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Organisation's steps<br><span class="info-text">What support will we provide to meet this goal?</span></td>
                        <td class="field-value">{{ $homecareGoals->get(0)->organisation_steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk</td>
                        <td class="field-value">{{ $homecareGoals->get(0)->risk ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk Management Strategies</td>
                        <td class="field-value">{{ $homecareGoals->get(0)->risk_management_strategies ?? 'N/A' }}</td>
                    </tr>
                </table>

                <!-- Goal #2 -->
                <table class="goal-table" style="margin-top: 6px;">
                    <tr>
                        <td colspan="2" class="goal-header-row">Goal #2</td>
                    </tr>
                    <tr>
                        <td class="field-label">Goals of support<br><span class="info-text">What is the specific goal to be achieved through BHC supports?</span></td>
                        <td class="field-value">{{ $homecareGoals->get(1)->goals_of_support ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Steps<br><span class="info-text">What will the participant do to actively participate in meeting this goal?</span></td>
                        <td class="field-value">{{ $homecareGoals->get(1)->steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Organisation's steps<br><span class="info-text">What support will we provide to meet this goal?</span></td>
                        <td class="field-value">{{ $homecareGoals->get(1)->organisation_steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk</td>
                        <td class="field-value">{{ $homecareGoals->get(1)->risk ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk Management Strategies</td>
                        <td class="field-value">{{ $homecareGoals->get(1)->risk_management_strategies ?? 'N/A' }}</td>
                    </tr>
                </table>

                <!-- Health Goals (Homecare) -->
                {{-- <table class="goal-table" style="margin-top: 6px;">
                    <tr>
                        <td colspan="2" class="goal-header-row">Health Goals (Where Applicable) (Homecare)</td>
                    </tr>
                    <tr>
                        <td class="field-label">Goals of support<br><span class="info-text">What is the specific goal to be achieved through BHC supports?</span></td>
                        <td class="field-value">{{ $homecareGoals->get(2)->goals_of_support ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Steps<br><span class="info-text">What will the participant do to actively participate in meeting this goal?</span></td>
                        <td class="field-value">{{ $homecareGoals->get(2)->steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Organisation's steps<br><span class="info-text">What support will we provide to meet this goal?</span></td>
                        <td class="field-value">{{ $homecareGoals->get(2)->organisation_steps ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk</td>
                        <td class="field-value">{{ $homecareGoals->get(2)->risk ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Risk Management Strategies</td>
                        <td class="field-value">{{ $homecareGoals->get(2)->risk_management_strategies ?? 'N/A' }}</td>
                    </tr>
                </table> --}}
            </div>
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

    <!-- Page 5 - Communication Plan -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SCP-01 Support Care Plan</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SCP-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- My Communication Plan -->
            <div class="section page-start">
                <div class="section-header1">6.MY COMMUNICATION PLAN</div>
                <table>
                    @if($supportCarePlan->communicationPlans && $supportCarePlan->communicationPlans->count() > 0)
                        @foreach($supportCarePlan->communicationPlans as $communication)
                            @php
                                function normalizeCommunicationData($data) {
                                    if (is_string($data)) {
                                        $decoded = json_decode($data, true);
                                        return is_array($decoded) ? $decoded : [$data];
                                    } elseif (!is_array($data)) {
                                        return [];
                                    }
                                    return $data;
                                }

                                $helpsMeTalk = normalizeCommunicationData($communication->helps_me_talk);
                                $helpsMeUnderstand = normalizeCommunicationData($communication->helps_me_understand);
                                $pleaseCommunicateBy = normalizeCommunicationData($communication->please_communicate_by);
                            @endphp

                            <tr>
                                <td class="field-label">This Helps Me Talk To You</td>
                                <td class="field-value">
                                    <div class="checkbox-group-columns">
                                        <!-- Column 1 -->
                                        <div class="checkbox-column">
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Interpreter', $helpsMeTalk) ? 'checked' : '' }}"></span>
                                                <span>Interpreter</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Symbols', $helpsMeTalk) ? 'checked' : '' }}"></span>
                                                <span>Symbols</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Pictures', $helpsMeTalk) ? 'checked' : '' }}"></span>
                                                <span>Pictures</span>
                                            </div>
                                        </div>
                                        <!-- Column 2 -->
                                        <div class="checkbox-column">
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Gesturing', $helpsMeTalk) ? 'checked' : '' }}"></span>
                                                <span>Gesturing</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Facial Expressions', $helpsMeTalk) ? 'checked' : '' }}"></span>
                                                <span>Facial Expressions</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Simple words', $helpsMeTalk) ? 'checked' : '' }}"></span>
                                                <span>Simple words</span>
                                            </div>
                                        </div>
                                        <!-- Column 3 -->
                                        <div class="checkbox-column">
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('When you wait for me to respond', $helpsMeTalk) ? 'checked' : '' }}"></span>
                                                <span>When you wait for me to respond</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('My Supporter/carer', $helpsMeTalk) ? 'checked' : '' }}"></span>
                                                <span>My Supporter/carer</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Other (Including Assistive technology)', $helpsMeTalk) ? 'checked' : '' }}"></span>
                                                <span>Other (Including Assistive technology)</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="field-label">This is What Helps Me To Understand You</td>
                                <td class="field-value">
                                    <div class="checkbox-group-columns">
                                        <!-- Column 1 -->
                                        <div class="checkbox-column">
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Short plain sentences', $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                                <span>Short plain sentences</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Simple words', $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                                <span>Simple words</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Concrete examples', $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                                <span>Concrete examples</span>
                                            </div>
                                        </div>
                                        <!-- Column 2 -->
                                        <div class="checkbox-column">
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Diagrams or pictures', $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                                <span>Diagrams or pictures</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Checking to see if I understand', $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                                <span>Checking to see if I understand</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Asking me to explain it', $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                                <span>Asking me to explain it</span>
                                            </div>
                                        </div>
                                        <!-- Column 3 -->
                                        <div class="checkbox-column">
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Asking my supporter/carer to explain it to me', $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                                <span>Asking my supporter/carer to explain it to me</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Using real objects', $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                                <span>Using real objects</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Giving me a demonstration', $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                                <span>Giving me a demonstration</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Other', $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                                <span>Other</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="field-label">Please communicate with me by</td>
                                <td class="field-value">
                                    <div class="checkbox-group-columns">
                                        <!-- Column 1 -->
                                        <div class="checkbox-column">
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Speaking directly to me', $pleaseCommunicateBy) ? 'checked' : '' }}"></span>
                                                <span>Speaking directly to me</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Taking time to tell me', $pleaseCommunicateBy) ? 'checked' : '' }}"></span>
                                                <span>Taking time to tell me</span>
                                            </div>
                                        </div>
                                        <!-- Column 2 -->
                                        <div class="checkbox-column">
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Waiting for me to respond', $pleaseCommunicateBy) ? 'checked' : '' }}"></span>
                                                <span>Waiting for me to respond</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Writing down notes in my care plan', $pleaseCommunicateBy) ? 'checked' : '' }}"></span>
                                                <span>Writing down notes in my care plan</span>
                                            </div>
                                        </div>
                                        <!-- Column 3 -->
                                        <div class="checkbox-column">
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Knowing I cannot talk but can hear and understand', $pleaseCommunicateBy) ? 'checked' : '' }}"></span>
                                                <span>Knowing I cannot talk but can hear and understand</span>
                                            </div>
                                            <div class="comm-checkbox-item">
                                                <span class="comm-checkbox-box {{ in_array('Other', $pleaseCommunicateBy) ? 'checked' : '' }}"></span>
                                                <span>Other</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="field-label">How to communicate with me in an emergency</td>
                                <td class="field-value">{{ $communication->emergency_communication ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="field-label">Communication Plan</td>
                            <td class="field-value">No communication plan available</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 5 -->
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

    <!-- Page 6 - Emergency Information -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SCP-01 Support Care Plan</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SCP-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Emergency and Disaster Plan -->
            <div class="section page-start">
                <div class="section-header1"> 7.EMERGENCY AND DISASTER PLAN</div>
                <table>
                    <tr>
                        <td class="field-label">Participant Name</td>
                        <td class="field-value">{{ $supportCarePlan->emergencyDisasterPlan->participant_name ?? 'N/A' }}</td>
                        <td class="field-label">Date</td>
                        <td class="field-value">
                            @if(isset($supportCarePlan->emergencyDisasterPlan->date))
                                {{ \Carbon\Carbon::parse($supportCarePlan->emergencyDisasterPlan->date)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Review Date</td>
                        <td class="field-value">
                            @if(isset($supportCarePlan->emergencyDisasterPlan->review_date))
                                {{ \Carbon\Carbon::parse($supportCarePlan->emergencyDisasterPlan->review_date)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="field-label"></td>
                        <td class="field-value"></td>
                    </tr>
                </table>
            </div>

            <!-- Key Emergency Contacts -->
            <div class="section">
                <div class="section-header1">8. KEY EMERGENCY CONTACTS</div>
                <table>
                    <tr>

                        <td class="full-width-label ">


                                    I do not have an informal emergency contact <br>
                                    (discuss with participant formal supports to be contacted in an emergency)

                        </td>
                    </tr>
                    @php
                        $contacts = $supportCarePlan->emergencyContacts ?? collect();
                    @endphp

                    @if($contacts->isNotEmpty())
                        @foreach($contacts as $index => $contact)
                            <tr>
                                <td colspan="2" style="background-color: #D6EEF7; font-weight: bold; padding: 4px; text-align: center;">
                                    Emergency Contact {{ $index + 1 }}
                                </td>
                            </tr>
                            <tr>
                                <td class="field-label">Name</td>
                                <td class="field-value">{{ $contact->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="field-label">Relationship</td>
                                <td class="field-value">{{ $contact->relationship ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="field-label">Phone</td>
                                <td class="field-value">{{ $contact->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="field-label">Email</td>
                                <td class="field-value">{{ $contact->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="field-label">Location</td>
                                <td class="field-value">{{ $contact->location ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" style="background-color: #D6EEF7; font-weight: bold; padding: 4px; text-align: center;">
                                Emergency Contact 1
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Name</td>
                            <td class="field-value">N/A</td>
                        </tr>
                        <tr>
                            <td class="field-label">Relationship</td>
                            <td class="field-value">N/A</td>
                        </tr>
                        <tr>
                            <td class="field-label">Phone</td>
                            <td class="field-value">N/A</td>
                        </tr>
                        <tr>
                            <td class="field-label">Email</td>
                            <td class="field-value">N/A</td>
                        </tr>
                        <tr>
                            <td class="field-label">Location</td>
                            <td class="field-value">N/A</td>
                        </tr>
                    @endif
                </table>
            </div>

            <!-- My Important Contacts/Services -->
            <div class="section">
                <div class="section-header1"> 9.MY IMPORTANT CONTACTS/SERVICES</div>
                <table>
                    <tr>
                        <td class="field-label">Advocate</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->advocate ?? 'N/A' }}</td>
                        <td class="field-label">Childcare/School Contact</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->childcare_school_contact ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Power of Attorney/Guardian</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->power_of_attorney_guardian ?? 'N/A' }}</td>
                        <td class="field-label">Workplace/Volunteer Contact</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->workplace_volunteer_contact ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Landlord, SDA Provider etc</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->landlord_sda_provider ?? 'N/A' }}</td>
                        <td class="field-label">Doctor</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->doctor ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Solicitor</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->solicitor ?? 'N/A' }}</td>
                        <td class="field-label">Specialist Practitioner</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->specialist_practitioner ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Insurer (home/contents)</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->insurer_home_contents ?? 'N/A' }}</td>
                        <td class="field-label">Private Health Cover</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->private_health_cover ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Insurer - vehicle</td>
                        <td class="field-value">{{ $supportCarePlan->importantContacts->insurer_vehicle ?? 'N/A' }}</td>
                        <td class="field-label"></td>
                        <td class="field-value"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 6 -->
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

    <!-- Page 7 - Local Services & Emergency Scenarios -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SCP-01 Support Care Plan</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SCP-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Local Services - Contact -->
            <div class="section page-start">
                <div class="section-header1">10. LOCAL SERVICES - CONTACT</div>
                <table>
                    <tr>
                        <td class="field-label">Council</td>
                        <td class="field-value">{{ $supportCarePlan->localServicesContact->council ?? 'N/A' }}</td>
                        <td class="field-label">Hospital</td>
                        <td class="field-value">{{ $supportCarePlan->localServicesContact->hospital ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Electricity</td>
                        <td class="field-value">{{ $supportCarePlan->localServicesContact->electricity ?? 'N/A' }}</td>
                        <td class="field-label">Water</td>
                        <td class="field-value">{{ $supportCarePlan->localServicesContact->water ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Emergency Scenarios and Support Actions -->
            <div class="section">
                <div class="section-header1">11.EMERGENCY SCENARIOS AND SUPPORT ACTIONS</div>
                <table class="emergency-table">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="30%">Emergency Type</th>
                            <th width="60%">My Support coordinator will</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($supportCarePlan->emergencyScenario)
                        @php $esc = $supportCarePlan->emergencyScenario; @endphp

                        <tr>
                            <td style="text-align: center;">
                                <div class="checkbox-item" style="justify-content: center;">
                                    <span class="checkbox-box {{ $esc->admitted_to_hospital ? 'checked' : '' }}"></span>
                                </div>
                            </td>
                            <td class="field-label">Admitted to Hospital</td>
                            <td class="field-value">{{ $esc->admitted_to_hospital_action ?? 'N/A' }}</td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <div class="checkbox-item" style="justify-content: center;">
                                    <span class="checkbox-box {{ $esc->medical_emergencies ? 'checked' : '' }}"></span>
                                </div>
                            </td>
                            <td class="field-label">Medical Emergencies</td>
                            <td class="field-value">{{ $esc->medical_emergencies_action ?? 'N/A' }}</td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <div class="checkbox-item" style="justify-content: center;">
                                    <span class="checkbox-box {{ $esc->other_likely_medical_emergency ? 'checked' : '' }}"></span>
                                </div>
                            </td>
                            <td class="field-label">Other likely medical emergency</td>
                            <td class="field-value">{{ $esc->other_likely_medical_emergency_action ?? 'N/A' }}</td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <div class="checkbox-item" style="justify-content: center;">
                                    <span class="checkbox-box {{ $esc->natural_disaster ? 'checked' : '' }}"></span>
                                </div>
                            </td>
                            <td class="field-label">Natural Disaster</td>
                            <td class="field-value">{{ $esc->natural_disaster_action ?? 'N/A' }}</td>
                        </tr>
                    @else
                        <tr>
                            <td style="text-align: center;">
                                <div class="checkbox-item" style="justify-content: center;">
                                    <span class="checkbox-box"></span>
                                </div>
                            </td>
                            <td class="field-label">Admitted to Hospital</td>
                            <td class="field-value">N/A</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <div class="checkbox-item" style="justify-content: center;">
                                    <span class="checkbox-box"></span>
                                </div>
                            </td>
                            <td class="field-label">Medical Emergencies</td>
                            <td class="field-value">N/A</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <div class="checkbox-item" style="justify-content: center;">
                                    <span class="checkbox-box"></span>
                                </div>
                            </td>
                            <td class="field-label">Other likely medical emergency</td>
                            <td class="field-value">N/A</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <div class="checkbox-item" style="justify-content: center;">
                                    <span class="checkbox-box"></span>
                                </div>
                            </td>
                            <td class="field-label">Natural Disaster</td>
                            <td class="field-value">N/A</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 7 -->
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

    <!-- Page 8 - Emergency Response Information -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SCP-01 Support Care Plan</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SCP-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Emergency Response Information -->
            <div class="section page-start">

                <table>
                    <tr>
                        <td class="field-value">
                            Best of Homecare is committed to ensuring that all participants are informed about the organisation's Emergency and Disaster Management Plan. The following information outlines how Best of Homecare intends to respond in the event of an emergency.
                        </td>
                    </tr>
                </table>

                <!-- Pandemic outbreak -->
                <div class="emergency-section">
                    <div class="emergency-section-header">PANDEMIC OUTBREAK</div>
                    <div class="emergency-section-content">
                        Where a confirmed case Best of Homecare will explain to you the need to isolate and explore options with you.
                        <ul>
                            <li>Continue to provide services that you are dependent on for daily living with appropriate infection control management.</li>
                            <li>Offer online support where appropriate.</li>
                        </ul>
                    </div>
                </div>

                <!-- Fire -->
                <div class="emergency-section">
                    <div class="emergency-section-header">FIRE</div>
                    <div class="emergency-section-content">
                        Staff will not travel into fire zones, floodwaters or travel during extreme thunderstorms or severe weather. In this case, Emergency Services and Emergency Contact lists will be activated by Best of Homecare, who will monitor your safety through ongoing communication with you and your supports.
                    </div>
                </div>

                <!-- Flood -->
                <div class="emergency-section">
                    <div class="emergency-section-header">FLOOD</div>
                    <div class="emergency-section-content">
                        Best of Homecare will contact you to assess the situation. Contact your local Emergency Services secondary contacts as required. Ongoing communication to monitor your safety.
                    </div>
                </div>

                <!-- Extreme Heatwaves -->
                <div class="emergency-section">
                    <div class="emergency-section-header">EXTREME HEATWAVES</div>
                    <div class="emergency-section-content">
                        Contact with you prior to the heatwave (weather forecast) to ensure adequate cooling, water and other requirements are available. If required, Best of Homecare will either provide, or contact your Support Network for availability of onsite support.
                    </div>
                </div>

                <!-- Thunderstorms and severe weather -->
                <div class="emergency-section">
                    <div class="emergency-section-header">THUNDERSTORMS AND SEVERE WEATHER</div>
                    <div class="emergency-section-content">
                        Contact you prior to the event (weather forecast) to ensure food, water, and other requirements are available. If required, Best of Homecare will either provide onsite support or contact your Support Network for the availability of onsite support.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer for Page 8 -->
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
