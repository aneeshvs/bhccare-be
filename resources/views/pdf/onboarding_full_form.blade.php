<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Profile - Onboarding</title>
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
            height: 45px; /* Increased height to accommodate larger logo and title */
            display: flex;
            align-items: center;
            box-sizing: border-box;
        }

        .page-header .logo {
            max-width: 60px; /* Increased from 25px to 40px */
            height: auto;
            margin-right: 10px;
        }

        .header-content {
            text-align: center;
            flex-grow: 1;
        }

        .header-title {
            font-size: 14px; /* Increased from 10px to 14px */
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
            font-size: 10px; /* Same size as field-label */
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
            margin-top: 50px; /* Increased to accommodate larger header */
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

        /* Ensure proper page breaks */
        .page-break-avoid {
            page-break-inside: avoid;
        }

        .page-break-before {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Page Header -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-18 Client Profile (Onboarding)</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-18</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- PART A – INITIAL ENQUIRY -->
            <div class="section page-start">
                <div class="section-header">PART A – INITIAL ENQUIRY</div>
                <table>
                    <tr>
                        <td class="field-label">Client Name</td>
                        <td class="field-value">{{ $initial->full_name ?? 'N/A' }}</td>
                        <td class="field-label">Preferred Name</td>
                        <td class="field-value">{{ $initial->preferred_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Gender</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['male', 'female', 'non-binary'] as $option)
                                    <span class="enum-option {{ ($initial->gender ?? '') === $option ? 'selected' : '' }}">
                                        {{ ucfirst($option) }}
                                    </span><br>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">Date of Birth</td>
                        <td class="field-value">
                            @if(!empty($initial->date_of_birth) && $initial->date_of_birth != '0000-00-00')
                                {{ \Carbon\Carbon::parse($initial->date_of_birth)->format('d-m-Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Address</td>
                        <td class="field-value">{{ $initial->address ?? 'N/A' }}</td>
                        <td class="field-label">Post Code</td>
                        <td class="field-value">{{ $initial->postcode ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Phone Number</td>
                        <td class="field-value">{{ $initial->phone_number ?? 'N/A' }}</td>
                        <td class="field-label">Mobile Number</td>
                        <td class="field-value">{{ $initial->mobile_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Email</td>
                        <td class="field-value" colspan="3">{{ $initial->email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="full-width-label">Does the client need the involvement of an independent family member, friend, advocate, or legal guardian to assist with understanding and signing the agreement as part of this assessment?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ (isset($initial->need_support_person) && (($initial->need_support_person == 1 ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>


                        <td class="full-width-label">If yes, please provide details and Contact information:</td>
                        <td class="full-width-value">{{ $initial->description ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <!-- PART B – FUNDING DETAILS -->
            @if(isset($initial->funding))
            <div class="section">
                <div class="section-header">2.FUNDING</div>
                <table>
                    <tr>
                        <td class="field-label">Type of Funding</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Self-Managed','NDIA', 'Plan Managed'] as $option)
                                    <span class="enum-option {{ ($initial->funding->type_of_funding ?? '') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span><br>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">Contact person for funding</td>
                        <td class="field-value">{{ $initial->funding->funding_contact_person ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">NDIS Plan Attached</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ (isset($initial->funding->ndis_plan_attached) && (($initial->funding->ndis_plan_attached == 1 ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">NDIS Plan Start Date</td>
                        <td class="field-value">
                            @if(!empty($initial->funding->ndis_plan_start_date) && $initial->funding->ndis_plan_start_date != '0000-00-00')
                                {{ \Carbon\Carbon::parse($initial->funding->ndis_plan_start_date)->format('d-m-Y') }}
                            @else
                                <span class="empty-field">Not provided</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">NDIS Plan End Date</td>
                        <td class="field-value">
                            @if(!empty($initial->funding->ndis_plan_end_date) && $initial->funding->ndis_plan_end_date != '0000-00-00')
                                {{ \Carbon\Carbon::parse($initial->funding->ndis_plan_end_date)->format('d-m-Y') }}
                            @else
                                <span class="empty-field">Not provided</span>
                            @endif
                        </td>
                        <td class="field-label">Plan Manager Name</td>
                        <td class="field-value">{{ $initial->funding->plan_manager_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Plan Manager Email</td>
                        <td class="field-value">{{ $initial->funding->plan_manager_email ?? 'N/A' }}</td>
                        <td class="field-label">Plan Manager Phone</td>
                        <td class="field-value">{{ $initial->funding->plan_manager_phone ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            @endif

            <!-- PART C – EMERGENCY CONTACT DETAILS -->
            @if(isset($initial->emergencyContact))
            <div class="section">
                <div class="section-header">3.ALTERNATIVE EMERGENCY CONTACTS</div>
                <table>
                    <tr>
                        <td class="field-label">Name</td>
                        <td class="field-value">{{ $initial->emergencyContact->name ?? 'N/A' }}</td>
                        <td class="field-label">Relationship with client</td>
                        <td class="field-value">{{ $initial->emergencyContact->relationship ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Phone</td>
                        <td class="field-value">{{ $initial->emergencyContact->phone ?? 'N/A' }}</td>
                        <td class="field-label">Mobile</td>
                        <td class="field-value">{{ $initial->emergencyContact->mobile ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Work Contact</td>
                        <td class="field-value" colspan="3">{{ $initial->emergencyContact->work_contact ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            @endif

            <!-- PART D – SCHEDULE OF CARES -->
            <div class="section">
                <div class="section-header">4.SCHEDULE OF CARE</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width:5%">#</th>
                            <th style="width:30%">Type of service the Participant requires</th>
                            <th style="width:32.5%">Primary Task List</th>
                            <th style="width:32.5%">Secondary Task List</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $rows = $initial->scheduleOfCares ?? [];
                            $minRows = 5;
                            $totalRows = max(count($rows) + 1, $minRows);
                        @endphp

                        @for ($i = 0; $i < $totalRows; $i++)
                            <tr>
                                <td style="text-align: center;">{{ $i + 1 }}</td>
                                <td>{{ $rows[$i]->type_of_service ?? 'N/A' }}</td>
                                <td>{{ $rows[$i]->primary_task_list ?? 'N/A' }}</td>
                                <td>{{ $rows[$i]->secondary_task_list ?? 'N/A' }}</td>
                            </tr>

                        @endfor
                        <tr>
                            <td colspan="2" class="full-width-label">
                                Are there children under the age of 18 residing in the client home
                            </td>
                            <td colspan="2" class="field-value">
                                <div class="enum-field">
                                    @foreach(['Yes', 'No'] as $option)
                                        <span class="enum-option {{ (isset($initial->culturalBackground->has_children_under_18) && (($initial->culturalBackground->has_children_under_18 ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach

                                    @if(!isset($initial->culturalBackground->has_children_under_18))
                                        <span class="empty-field">Not provided</span>
                                    @endif
                                </div>
                            </td>
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
                <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: {{ date('d F Y') }}
                </td>
                <td style="width: 34%">
                    Approver: Director<br>
                    UNCONTROLLED WHEN PRINTED
                </td>
                <td style="width: 33%" >

                </td>
            </tr>
        </table>
    </div>

    <!-- PAGE BREAK -->
    <div class="page-break"></div>

    <!-- Header for Page 2 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-18 Client Profile (Onboarding)</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-18</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- PART E – CULTURAL BACKGROUND -->
            @if(isset($initial->culturalBackground))
            <div class="section page-start">
                <div class="section-header">5.RELIGIOUS/CULTURAL</div>
                <table>
                    <tr>

                        <td class="field-label">Country of Birth</td>
                        <td class="field-value">{{ $initial->culturalBackground->country_of_birth ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Preferred Language</td>
                        <td class="field-value">{{ $initial->culturalBackground->preferred_language ?? 'N/A' }}</td>
                        <td class="field-label">Religion</td>
                        <td class="field-value">{{ $initial->culturalBackground->religion ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Other Languages</td>
                        <td class="field-value">{{ $initial->culturalBackground->other_languages ?? 'N/A' }}</td>
                        <td class="field-label">Cultural Needs</td>
                        <td class="field-value">{{ $initial->culturalBackground->cultural_needs ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Interpreter</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ (isset($initial->culturalBackground->interpreter_required) && (($initial->culturalBackground->interpreter_required ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                                @if(!isset($initial->culturalBackground->interpreter_required))
                                    <span class="empty-field">Not provided</span>
                                @endif
                            </div>
                        </td>
                        <td class="field-label">AUSLAN</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ (isset($initial->culturalBackground->auslan_required) && (($initial->culturalBackground->auslan_required ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                                @if(!isset($initial->culturalBackground->auslan_required))
                                    <span class="empty-field">Not provided</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            @endif

            <!-- PART F – NDIS GOALS -->
            @if(isset($initial->ndisGoals))
            <div class="section">
                <div class="section-header">6.NDIS GOALS FOR BHC SUPPORT</div>
                <table>
                    <tr>
                        <th colspan="2">What are the NDIS Goals that you would like assistance from BHC with?</th>
                    </tr>
                    @if(isset($initial->ndisGoals) && $initial->ndisGoals->count() > 0)
                        @foreach($initial->ndisGoals as $index => $goal)
                            <tr>
                                <td class="field-label">{{ $index + 1 }}</td>
                                <td class="field-value">{{ $goal->goal_description ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @else
                        @for($i = 1; $i <= 5; $i++)
                            <tr>
                                <td class="field-label">{{ $i }}</td>
                                <td class="field-value"></td>
                            </tr>
                        @endfor
                    @endif
                </table>
            </div>
            @endif

            <!-- PART G – HEALTH PROFESSIONAL DETAILS -->
            <div class="section">
                <div class="section-header">7.Health Professional Details
(Medical practitioner, BSP, medical specialists, Physio, OT, Podiatrist, Dentist etc.)</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40%">Name</th>
                            <th style="width: 30%">Role/Position</th>
                            <th style="width: 30%">Contact Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $predefinedRoles = [
                                'General Practitioner',
                                'Physiotherapy',
                                'Speech Therapist',
                                'Occupational Therapist',
                                'Behaviour Support Practitioner',
                                'Podiatrist'
                            ];

                            $predefinedProfessionals = [];
                            $customProfessionals = [];

                            if (isset($initial->healthProfessionalDetails) && $initial->healthProfessionalDetails->count() > 0) {
                                foreach ($initial->healthProfessionalDetails as $prof) {
                                    if (in_array($prof->role, $predefinedRoles)) {
                                        $predefinedProfessionals[$prof->role] = $prof;
                                    } else {
                                        $customProfessionals[] = $prof;
                                    }
                                }
                            }
                        @endphp

                        @foreach($predefinedRoles as $role)
                            @php
                                $hasData = isset($predefinedProfessionals[$role]);
                                $prof = $hasData ? $predefinedProfessionals[$role] : null;
                            @endphp
                            <tr>
                                <td>{{ $hasData ? ($prof->name ?? '') : '' }}</td>
                                <td>
                                    <div class="checkbox-item">
                                        <span class="checkbox-box {{ $hasData ? 'checked' : '' }}">
                                            {{ $hasData ? '' : '' }}
                                        </span>
                                        <span class="checkbox-label">{{ $role }}</span>
                                    </div>
                                </td>
                                <td>{{ $hasData ? ($prof->contact_number ?? '') : '' }}</td>
                            </tr>
                        @endforeach

                        @foreach($customProfessionals as $customProf)
                        <tr>
                            <td>{{ $customProf->name ?? '' }}</td>
                            <td>
                                <div class="checkbox-item">
                                    <span class="checkbox-box checked">
                                        *
                                    </span>
                                    <span class="checkbox-label">{{ $customProf->role }}</span>
                                </div>
                            </td>
                            <td>{{ $customProf->contact_number ?? '' }}</td>
                        </tr>
                        @endforeach

                        @if(count($customProfessionals) === 0)
                        <tr>
                            <td></td>
                            <td>
                                <div class="checkbox-item">
                                    <span class="checkbox-box">
                                    </span>
                                    <span class="checkbox-label">* Add Other</span>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- PART H: DIAGNOSIS SUMMARY -->
            @if ($initial->diagnosisSummary)
            <div class="section">
                <div class="section-header">8.DIAGNOSIS SUMMARY</div>
                <table>
                    <tr>
                        <td class="field-label">Primary Diagnosis</td>
                        <td class="field-value">{{ $initial->diagnosisSummary->primary_diagnosis }}</td>
                        <td class="field-label">Secondary Diagnosis</td>
                        <td class="field-value">{{ $initial->diagnosisSummary->secondary_diagnosis }}</td>
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
                    Issue: {{ date('d F Y') }}
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

    <!-- PAGE BREAK -->
    <div class="page-break"></div>

    <!-- Header for Page 3 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-18 Client Profile (Onboarding)</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-18</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- PART I: HEALTH INFORMATION -->
            @if ($initial->healthInformation)
            <div class="section page-start">
                <div class="section-header">9.HEALTH INFORMATION</div>
                <table>
                    <tr>
                        <td colspan="4">
                            <span class="label">Health Conditions</span>
                            <table class="health-conditions-table">
                                <tr>
                                    @php
                                        $allHealthConditions = [
                                            'Urinary Catheter Management',
                                            'Intellectual Disability',
                                            'Spinal Cord Disability/Injury',
                                            'Bowel Care',
                                            'Wound Care / Pressure Area Care',
                                            'Hearing Impairment',
                                            'Tracheostomy Management',
                                            'Cerebral Palsy',
                                            'Subcutaneous Medication Management',
                                            'Mealtime Support or Dysphagia',
                                            'Enteral Feeding or Peg Feeding',
                                            'Ventilator',
                                            'Medication Support',
                                            'Autism',
                                            'Mental Health',
                                            'Physical Disability',
                                            'Other'
                                        ];

                                        $selectedConditions = $initial->healthInformation->health_conditions ?? [];
                                        $selectedConditions = is_array($selectedConditions) ? $selectedConditions : [];

                                        $chunkSize = ceil(count($allHealthConditions) / 3);
                                        $columns = array_chunk($allHealthConditions, $chunkSize);
                                    @endphp

                                    @foreach($columns as $column)
                                    <td class="health-conditions-column">
                                        @foreach($column as $condition)
                                        <div class="checkbox-item">
                                            <span class="checkbox-box {{ in_array($condition, $selectedConditions) ? 'checked' : '' }}">
                                                {{ in_array($condition, $selectedConditions) ? '' : '' }}
                                            </span>
                                            <span class="checkbox-label">{{ $condition }}</span>
                                        </div>
                                        @endforeach
                                    </td>
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            @endif

            <!-- PART J: HEALTHCARE SUPPORT DETAIL -->
            @if ($initial->healthcareSupportDetail)
            <div class="section">
                <div class="section-header">10.HEALTHCARE AND SUPPORT DETAILS</div>
                <table>
                    <tr>
                        <td class="field-label">Medicare</td>
                        <td class="field-value">{{ $initial->healthcareSupportDetail->medicare ?? 'N/A' }}</td>
                        <td class="field-label">Health Fund</td>
                        <td class="field-value">{{ $initial->healthcareSupportDetail->health_fund ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Pension Card Number</td>
                        <td class="field-value">{{ $initial->healthcareSupportDetail->pension_card_number ?? 'N/A' }}</td>
                        <td class="field-label">Health Care Card</td>
                        <td class="field-value">{{ $initial->healthcareSupportDetail->health_care_card ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">DVA Type</td>
                        <td class="field-value">{{ $initial->healthcareSupportDetail->dva_type ?? 'N/A' }}</td>
                        <td class="field-label">DVA Number</td>
                        <td class="field-value">{{ $initial->healthcareSupportDetail->dva_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Companion Card</td>
                        <td class="field-value">{{ $initial->healthcareSupportDetail->companion_card ?? 'N/A' }}</td>
                        <td class="field-label">Preferred Hospital</td>
                        <td class="field-value">{{ $initial->healthcareSupportDetail->preferred_hospital ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Ambulance Number</td>
                        <td class="field-value">{{ $initial->healthcareSupportDetail->ambulance_number ?? 'N/A' }}</td>
                        <td class="field-label">Disabled Parking</td>
                        <td class="field-value">{{ $initial->healthcareSupportDetail->disabled_parking ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            @endif

            <!-- PART K: BEHAVIOUR SUPPORT -->
            @if(isset($initial->behaviourSupport))
            <div class="section">
                <div class="section-header">11.BEHAVIOUR SUPPORT</div>
                <table>
                    <tr>
                        <td class="field-label">Do you have a current support plan?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ (isset($initial->behaviourSupport->has_support_plan) && (($initial->behaviourSupport->has_support_plan == 1 ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                                @if(!isset($initial->behaviourSupport->has_support_plan))
                                    <span class="empty-field">Not provided</span>
                                @endif
                            </div>
                        </td>
                        <td class="field-label">Copy of behaviour support plan received?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ (isset($initial->behaviourSupport->plan_copy_received) && (($initial->behaviourSupport->plan_copy_received == 1 ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                                @if(!isset($initial->behaviourSupport->plan_copy_received))
                                    <span class="empty-field">Not provided</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            @endif

            <!-- PART L – MEDICAL ALERT -->
            @if ($initial->medicalAlert)
            <div class="section">
                <div class="section-header">12.MEDICAL ALERTS/ ALLERGIES</div>
                <table>
                    <tr>
                        <td class="field-label">Has Epilepsy</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($initial->medicalAlert->epilepsy ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">Has Asthma</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($initial->medicalAlert->asthma ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">Has Diabetes</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($initial->medicalAlert->diabetes ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">Allergies (Specify)</td>
                        <td class="field-value">{{ $initial->medicalAlert->allergies }}</td>
                    </tr>
                    <tr>
                        <td colspan="8">
                            <span class="label">(If yes to any of the above, please provide a copy of the current plan less than a year old.)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Medical Info</td>
                        <td class="field-value">{{ $initial->medicalAlert->medical_info }}</td>
                        <td class="field-label">Diagnosis</td>
                        <td class="field-value">{{ $initial->medicalAlert->diagnosis }}</td>
                        <td class="field-label">Other Description</td>
                        <td class="field-value">{{ $initial->medicalAlert->other_description }}</td>
                        <td class="field-label">What medication does the person take?</td>
                        <td class="field-value">{{ $initial->medicalAlert->medication_taken }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">What is the medication for?</td>
                        <td class="field-value">{{ $initial->medicalAlert->medication_purpose }}</td>
                        <td class="field-label">Is it expected that staff to administer any medication?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($initial->medicalAlert->staff_administer_medication ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td colspan="4">
                            <span class="label">If yes, by whom:</span><br>
                            <div style="display: flex; gap: 20px; margin-top: 4px;">
                                <div class="checkbox-item">
                                    <span class="checkbox-box {{ $initial->medicalAlert->self_administered ? 'checked' : '' }}">
                                        {{ $initial->medicalAlert->self_administered ? '' : '' }}
                                    </span>
                                    <span class="checkbox-label">Self Administered</span>
                                </div>
                                <div class="checkbox-item">
                                    <span class="checkbox-box {{ $initial->medicalAlert->guardian ? 'checked' : '' }}">
                                        {{ $initial->medicalAlert->guardian ? '' : '' }}
                                    </span>
                                    <span class="checkbox-label">Guardian</span>
                                </div>
                                <div class="checkbox-item">
                                    <span class="checkbox-box {{ $initial->medicalAlert->support_worker ? 'checked' : '' }}">
                                        {{ $initial->medicalAlert->support_worker ? '' : '' }}
                                    </span>
                                    <span class="checkbox-label">Support Worker</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            @endif
        </div>
    </div>

    <!-- Footer for Page 3 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: {{ date('d F Y') }}
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

    <!-- PAGE BREAK -->
    <div class="page-break"></div>

    <!-- Header for Page 4 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-18 Client Profile (Onboarding)</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-18</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- PART M – PREVENTIVE HEALTH SUMMARY -->
            @if ($initial->preventiveHealthSummary)
            <div class="section page-start">
                <div class="section-header">13.PREVENTIVE HEALTH SUMMARY</div>
                <table>
                    <tr>
                        <td class="field-label">Medical Check-Up and Immunisation Status</td>
                        <td class="field-value">{{ $initial->preventiveHealthSummary->medical_checkup_status }}</td>
                        <td class="field-label">When was the last time the person had a dental check? </td>
                        <td class="field-value">
                            @if(!empty($initial->preventiveHealthSummary->last_dental_check) && $initial->preventiveHealthSummary->last_dental_check != '0000-00-00')
                                {{ \Carbon\Carbon::parse($initial->preventiveHealthSummary->last_dental_check)->format('d-m-Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">When was the last time the person had a hearing check? </td>
                        <td class="field-value">
                            @if(!empty($initial->preventiveHealthSummary->last_hearing_check) && $initial->preventiveHealthSummary->last_hearing_check != '0000-00-00')
                                {{ \Carbon\Carbon::parse($initial->preventiveHealthSummary->last_hearing_check)->format('d-m-Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="field-label">When was the last time the person had a Vision check?</td>
                        <td class="field-value">
                            @if(!empty($initial->preventiveHealthSummary->last_vision_check) && $initial->preventiveHealthSummary->last_vision_check != '0000-00-00')
                                {{ \Carbon\Carbon::parse($initial->preventiveHealthSummary->last_vision_check)->format('d-m-Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="field-label">Does the person require assistance to obtain up to date vaccinations? </td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($initial->preventiveHealthSummary->requires_vaccination_assistance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            @endif

            <!-- PART N – SUPPORT INFORMATION -->
            @if ($initial->supportInformation)
            <div class="section">
                <div class="section-header">14.SUPPORT INFORMATION</div>
                <table>
                    <tr>
                        <td class="field-label">Do you require assistance with communication?


Communication support is needed with hearing, comprehension, and vision.
(Languages other than English)

** Refer to Communication Plan if Needed </td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($initial->supportInformation->communication_assistance_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">Do you have a mealtime management plan that includes dietary or modification requirements? </td>
                        <td class="field-value">{{ $initial->supportInformation->mealtime_plan }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Likes</td>
                        <td class="field-value">{{ is_array($initial->supportInformation->likes) ? implode(', ', $initial->supportInformation->likes) : $initial->supportInformation->likes }}</td>
                        <td class="field-label">Dislikes</td>
                        <td class="field-value">{{ is_array($initial->supportInformation->dislikes) ? implode(', ', $initial->supportInformation->dislikes) : $initial->supportInformation->dislikes }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Interests (for example gardening, craft, reading etc) </td>
                        <td class="field-value">{{ is_array($initial->supportInformation->interests) ? implode(', ', $initial->supportInformation->interests) : $initial->supportInformation->interests }}</td>
                        <td class="field-label">Preferred Worker</td>
                        <td class="field-value">
                            <div style="display: flex; flex-direction: column; gap: 4px; margin-top: 4px;">
                                <div class="checkbox-item">
                                    <span class="checkbox-box {{ $initial->supportInformation->male ? 'checked' : '' }}">
                                        {{ $initial->supportInformation->male ? '*' : '' }}
                                    </span>
                                    <span class="checkbox-label">Male</span>
                                </div>
                                <div class="checkbox-item">
                                    <span class="checkbox-box {{ $initial->supportInformation->female ? 'checked' : '' }}">
                                        {{ $initial->supportInformation->female ? '*' : '' }}
                                    </span>
                                    <span class="checkbox-label">Female</span>
                                </div>
                                <div class="checkbox-item">
                                    <span class="checkbox-box {{ $initial->supportInformation->no_preference ? 'checked' : '' }}">
                                        {{ $initial->supportInformation->no_preference ? '*' : '' }}
                                    </span>
                                    <span class="checkbox-label">No Preference</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Any Special Request</td>
                        <td class="field-value" colspan="3">{{ $initial->supportInformation->special_request }}</td>
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
                    Issue: {{ date('d F Y') }}
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
