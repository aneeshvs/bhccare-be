<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home Safety Checklist Assessment - BHC</title>
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
            text-align:start;
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
            text-align:center;
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
            background-color: #E5F9D1;
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
            font-size: 12px;
        }

        .value {
            display: block;
            margin-top: 2px;
            font-size: 12px;
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

        /* Three Column Layout */
        .question-column {
            width: 50%;
           background-color: #E5F9D1;
        }

        .response-column {
            width: 20%;
            text-align: center;
        }

        .strategy-column {
            width: 30%;
            background-color: #F2F2F2;
        }

        .response-options {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <!-- Page 1 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-5 Home Safety Checklist Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- How to Use This Form -->
            <div class="section page-start">
                <div class="section-header1">HOW TO USE THIS FORM</div>
                <div class="section-body">
                    <div class="note-box">
                        You are to ensure onsite completion of the Home Safety Check prior to the commencement of service delivery.
                        Only complete those areas related to the services to be provided and ensure you address potential risks
                        with the Participant and put in place risk controls. This safety checklist is to be completed each time
                        changes to the supports or their delivery are required, and/or any changes made to the Participant's
                        Service Agreement and/or Support care plan.
                    </div>
                </div>
            </div>

            <!-- Participant Details -->
            <div class="section">
                <div class="section-header"> 1.PARTICIPANT DETAILS</div>
                <table>
                    <tr>
                        <td class="field-label">Participant Name</td>
                        <td class="field-value">{{ $assessment->participant_name ?? 'N/A' }}</td>
                        <td class="field-label">Address</td>
                        <td class="field-value">{{ $assessment->address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Phone</td>
                        <td class="field-value">{{ $assessment->phone ?? 'N/A' }}</td>
                        <td class="field-label">Email</td>
                        <td class="field-value">{{ $assessment->email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Assessment Type</td>
                        <td class="field-value">
                            <div class="enum-field">
                                <span class="enum-option {{ $assessment->is_new_participant ? 'selected' : '' }}">New Participant</span>
                                <span class="enum-option {{ $assessment->is_review_existing ? 'selected' : '' }}">Review Existing</span>
                            </div>
                        </td>
                        <td class="field-label">Participant Agrees to Safety Check</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($assessment->does_participant_agree ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Entry Door Used</td>
                        <td class="field-value" colspan="3">
                            <div class="enum-field">
                                @foreach(['front' => 'Front', 'side' => 'Side', 'rear' => 'Rear', 'other' => 'Other'] as $value => $label)
                                    <span class="enum-option {{ ($assessment->entry_door ?? '') === $value ? 'selected' : '' }}">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                            @if($assessment->entry_door === 'other')
                            <div style="margin-top: 4px;">
                                <span class="label">Other Entry Description:</span>
                                <span class="value">{{ $assessment->entry_door_other ?? 'N/A' }}</span>
                            </div>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="footer">
        <table class="footer-table">
            <tr>
                 <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 February 2025
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

    <!-- Page 2 - Outside Entry Assessment -->

    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
           <div class="header-title">Form F-5 Home Safety Checklist Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Outside Entry Assessment -->
            @if($assessment->outsideEntry)
            <div class="section page-start">
                <div class="section-header">2.OUTSIDE RESIDENCE(entry)</div>
                <table>
                    <thead>
                        <tr>
                            <th class="question-column"></th>
                            <th class="response-column"></th>
                            <th class="strategy-column">Where there is a risk identified, please outline the management strategy</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is parking adequate on street?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideEntry->parking_adequate ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideEntry->parking_adequate_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are Pathway/veranda/stairs level surface, non-slip, uncluttered, adequate width?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideEntry->pathway_surface ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideEntry->pathway_surface_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are gates and entry door easy to open, clear of obstruction?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideEntry->gates_entry_easy ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideEntry->gates_entry_easy_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are lighting adequate illumination from street to front door at night?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideEntry->lighting_adequate ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideEntry->lighting_adequate_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are there any outdoor fire hazards? (Potential high grass / bush fire / Snakes)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideEntry->outdoor_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideEntry->outdoor_fire_hazards_strategy ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="footer">
        <table class="footer-table">
            <tr>
                 <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 February 2025
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

    <!-- Page 3 - Inside Residence Assessment -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
           <div class="header-title">Form F-5 Home Safety Checklist Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Inside Residence Assessment -->
            @if($assessment->insideResidence)
            <div class="section page-start">
                <div class="section-header">3.INSIDE RESIDENCE (GENERAL)</div>
                <table>
                    <thead>
                        <tr>
                            <th class="question-column"></th>
                            <th class="response-column"></th>
                            <th class="strategy-column">Where there is a risk identified, please outline the management strategy</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are all exit doors unobstructed and in working order?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->insideResidence->exit_doors_unobstructed ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->insideResidence->exit_doors_unobstructed_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are heaters in suitable position? (e.g. no bedding, clothes or water nearby)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->insideResidence->heaters_suitable ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->insideResidence->heaters_suitable_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are aids and equipment in good conditions? (e.g. handrails, adjustable bed, shower chair, hoist, access ramps)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->insideResidence->aids_equipment_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->insideResidence->aids_equipment_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is there evidence of pests? (e.g. ants, wasps, vermin)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->insideResidence->evidence_of_pests ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->insideResidence->evidence_of_pests_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is the Participant able to (entry/egress) open door? (if relevant)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->insideResidence->participant_open_door ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->insideResidence->participant_open_door_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are there any fire hazards? fireplaces, candles, etc.</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->insideResidence->fire_hazards ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->insideResidence->fire_hazards_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is vacuum cleaner/carpet sweeper appropriate design and in working order?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->insideResidence->vacuum_cleaner_ok ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->insideResidence->vacuum_cleaner_ok_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is mop and bucket appropriate design and in working order?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->insideResidence->mop_bucket_ok ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->insideResidence->mop_bucket_ok_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is step ladder appropriate design and in working order?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->insideResidence->step_ladder_ok ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->insideResidence->step_ladder_ok_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are cleaning substances/products in original container and labelled appropriately?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->insideResidence->cleaning_substances_ok ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->insideResidence->cleaning_substances_ok_strategy ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="footer">
        <table class="footer-table">
            <tr>
                 <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 February 2025
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

    <!-- Page 4 - Hallways Safety Assessment -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-5 Home Safety Checklist Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Hallways Safety Assessment -->
            @if($assessment->hallways)
            <div class="section page-start">
                <div class="section-header">3.HALLWAYS / LOUNGE / DINING / BEDROOM</div>
                <table>
                    <thead>
                        <tr>
                            <th class="question-column"></th>
                            <th class="response-column"></th>
                            <th class="strategy-column">Where there is a risk identified, please outline the management strategy</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="question-column">
                                <span class="label">Hallways / Lounge / Dining / Bedroom general safety</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallways->hallways_lounge_dining_bedroom ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallways->hallways_lounge_dining_bedroom_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is there evidence of pests? (e.g. ants, wasps, vermin)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallways->pests_evidence ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallways->pests_evidence_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is there adequate lighting and workspace to undertake tasks?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallways->lighting_workspace ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallways->lighting_workspace_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is furniture stable and does not need to be moved, or easy to move? (e.g. chairs)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallways->furniture_stable ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallways->furniture_stable_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is bed adjustable or adequate height to work from?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallways->bed_adjustable ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallways->bed_adjustable_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are electrical switches/power points/leads in good condition and easy to access?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallways->electrical_switches ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallways->electrical_switches_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is there a private sleeping space with clean bed linen available for sleepover shifts?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallways->private_sleep_space ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallways->private_sleep_space_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are there any fire hazards? - heaters, electric blankets, etc.</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallways->hallways_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallways->hallways_fire_hazards_strategy ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="footer">
        <table class="footer-table">
            <tr>
                 <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 February 2025
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

    <!-- Page 5 - Kitchen/Bathroom Safety Assessment -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-5 Home Safety Checklist Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Kitchen/Bathroom Safety Assessment -->
            @if($assessment->hallwaysSafetyAssessment)
            <div class="section page-start">
                <div class="section-header">4.KITCHEN / BATHROOM / TOILET / LAUNDRY SAFETY ASSESSMENT</div>
                <table>
                    <thead>
                        <tr>
                            <th class="question-column"></th>
                            <th class="response-column"></th>
                            <th class="strategy-column">Where there is a risk identified, please outline the management strategy</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are floor surfaces level and in good condition (no trip hazards)?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->floor_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->floor_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are electrical switches/power points/leads in good condition and safely located?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->electrical_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->electrical_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is ventilation, lighting and drainage adequate?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->ventilation_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->ventilation_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are benches/surfaces clean and suitable for use?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->bench_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->bench_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is stove and food preparation equipment clean and in good working order?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->stove_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->stove_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is fridge clean and food stored appropriately?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->fridge_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->fridge_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is bath/shower design appropriate for easy access with non-slip surface?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->bath_access ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->bath_access_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is toilet accessible for cleaning and seat intact?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->toilet_access ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->toilet_access_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is privacy adequate for staff use (doors closed/locked)?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->privacy_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->privacy_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is washing machine/dryer appropriate, clean, and in working order?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->laundry_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->laundry_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is iron/ironing board/clothesline appropriate and in working order?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->ironing_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->ironing_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are manual handling risks assessed and controlled?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->manual_handling_risks ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->manual_handling_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are there any fire hazards? (fireplaces, candles, etc.)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->kitchen_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->hallwaysSafetyAssessment->kitchen_fire_hazards_strategy ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 February 2025
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

    <!-- Page 6 - Outside Residence Assessment -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-5 Home Safety Checklist Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Outside Residence Assessment -->
            @if($assessment->outsideResidenceAssessment)
            <div class="section page-start">
                <div class="section-header">5.OUTSIDE - BACK AND SIDES OF RESIDENCE / GARAGES AND SHEDS</div>
                <table>
                    <thead>
                        <tr>
                            <th class="question-column"></th>
                            <th class="response-column"></th>
                            <th class="strategy-column">Where there is a risk identified, please outline the management strategy</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are floor surfaces level, in good condition, with no trip hazards (e.g. mats)?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->floor_surfaces ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->floor_surfaces_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are electrical switches/power points/leads in good condition, easy to access, and in a suitable location?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->electrical_good_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->electrical_good_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is ventilation, lighting and drainage adequate?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->ventilation_lighting_drainage ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->ventilation_lighting_drainage_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are benches/surfaces clean and is there adequate room/height to work from?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->benches_clean_adequate ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->benches_clean_adequate_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is the stove and food preparation equipment clean and in good working order?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->stove_clean_working ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->stove_clean_working_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is the fridge clean and food stored appropriately?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->fridge_clean_stored ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->fridge_clean_stored_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is the bath/shower an appropriate design for easy access, with a non-slip surface?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->bath_shower_accessible ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->bath_shower_accessible_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is the toilet accessible for cleaning and is the seat intact?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->toilet_accessible ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->toilet_accessible_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is privacy adequate for staff use? (doors closed and locked)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->privacy_adequate ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->privacy_adequate_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is the washing machine/dryer an appropriate design, clean and in working order?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->washing_machine_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->washing_machine_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is the iron/ironing board/clothesline an appropriate design and in working order?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->ironing_equipment_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->ironing_equipment_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are manual handling risks associated with Participant transfers assessed and controlled? (e.g., transfers in/out of bed, into car)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->manual_handling_risks ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->manual_handling_risks_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are there any fire hazards? (fireplaces, candles, etc.)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->outside_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->outsideResidenceAssessment->outside_fire_hazards_strategy ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="footer">
        <table class="footer-table">
            <tr>
                 <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 February 2025
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

    <!-- Page 7 - Miscellaneous Assessment -->
    <div class="page-break"></div>
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-5 Home Safety Checklist Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Miscellaneous Assessment -->
            @if($assessment->miscellaneous)
            <div class="section page-start">
                <div class="section-header">6.MISCELLANEOUS</div>
                <table>
                    <thead>
                        <tr>
                            <th class="question-column"></th>
                            <th class="response-column"></th>
                            <th class="strategy-column">Where there is a risk identified, please outline the management strategy</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are children living at home or is it expected children may be at home during service?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->miscellaneous->misc_children_living_at_home ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->miscellaneous->misc_children_living_at_home_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are there weapons (e.g., guns, knives) stored appropriately? (gun safe, bolts/ammo separate)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->miscellaneous->misc_weapons_stored_appropriately ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->miscellaneous->misc_weapons_stored_appropriately_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is smoking outside and not in presence of staff?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->miscellaneous->misc_smoking_outside_only ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->miscellaneous->misc_smoking_outside_only_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Does the participant have mobility issues? (e.g., wheelchair or other)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->miscellaneous->misc_mobility_issues ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->miscellaneous->misc_mobility_issues_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is the wheelchair and other equipment used in good working condition?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->miscellaneous->misc_equipment_good_condition ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->miscellaneous->misc_equipment_good_condition_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are there any PPE requirements? (gloves, mask, eye protection, etc.)</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->miscellaneous->misc_ppe_requirements ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->miscellaneous->misc_ppe_requirements_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Are there any personal threats?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->miscellaneous->misc_personal_threats ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->miscellaneous->misc_personal_threats_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Is it generally a safe neighbourhood?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->miscellaneous->misc_safe_neighbourhood ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->miscellaneous->misc_safe_neighbourhood_strategy ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="question-column">
                                <span class="label">Does the participant or others in the home become aggressive?</span>
                            </td>
                            <td class="response-column">
                                <div class="response-options">
                                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                                        <span class="enum-option {{ ($assessment->miscellaneous->misc_aggression_in_home ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="strategy-column">{{ $assessment->miscellaneous->misc_aggression_in_home_strategy ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="footer">
        <table class="footer-table">
            <tr>
                 <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 February 2025
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

    <!-- Page 8 - Residence Type (LAST PAGE) -->

    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-5 Home Safety Checklist Assessment</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-5</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Residence Type - LAST SECTION -->
            @if($assessment->residenceType)
            <div class="section page-start">
                <div class="section-header">7.TYPE OF RESIDENCE</div>
                <table>
                    <tr>
                        <td class="field-label">Type of Residence-Home</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Single / Double Storey', 'Private Rental', 'Care Facility'] as $option)
                                    <span class="enum-option {{ ($assessment->residenceType->residence_house_type ?? '') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Other</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Unit', 'Caravan Park', 'Office Housing'] as $option)
                                    <span class="enum-option {{ ($assessment->residenceType->residence_other_type ?? '') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Has this Assessment been Completed With</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Participant', 'Support Worker', 'Guardian / Next Of Kin'] as $option)
                                    <span class="enum-option {{ ($assessment->residenceType->assessment_completed_with ?? '') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Name</td>
                        <td class="field-value">{{ $assessment->residenceType->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Position</td>
                        <td class="field-value">{{ $assessment->residenceType->position ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Review Date</td>
                        <td class="field-value">
                            @if(!empty($assessment->residenceType->review_date))
                                {{ date('d-m-Y', strtotime($assessment->residenceType->review_date)) }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Care Facility</td>
                        <td class="field-value">{{ $assessment->residenceType->care_facility ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 February 2025
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
