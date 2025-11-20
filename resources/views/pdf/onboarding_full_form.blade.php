<!DOCTYPE html>
<html lang="en">
<head>

 <meta charset="UTF-8">
   <title>Client Profile - Onboarding</title>
<style>
    body {
        font-family: sans-serif;
        font-size: 12px;
        background-color: #f9fafb;
        color: #111827;
        margin: 0;
        padding: 20px;
        counter-reset: section;
        line-height: 1.2; /* Reduce default line height */
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
        margin-bottom: 15px; /* Reduced */
        padding-top: 10px;
    }

    .logo {
        position: absolute;
        top: 0;
        left: 0;
        max-width: 60px;
        height: auto;
    }

    .header-title {
        font-size: 20px;
        font-weight: bold;
        margin-top: 8px;
        margin-bottom: 5px; /* Added */
    }

    .document-number {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 3px; /* Reduced */
    }

    .section {
        margin-bottom: 12px; /* Reduced from 20px */
        page-break-inside: avoid;
        break-inside: avoid;
    }

    .section-header {
        counter-increment: section;
        background-color: #e0f2fe;
        color: #0369a1;
        padding: 6px 10px; /* Reduced padding */
        font-weight: bold;
        border-left: 4px solid #0284c7;
        margin-bottom: 6px; /* Reduced */
        border-radius: 4px;
        font-size: 13px;
    }

    .section-header::before {
        content: counter(section) ". ";
        font-weight: bold;
        color: #0284c7;
        margin-right: 4px; /* Reduced */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
        border-spacing: 0;
    }

    td {
        padding: 4px 6px; /* Reduced padding */
        vertical-align: top;
        border: 1px solid #e5e7eb;
        line-height: 1.2;
    }

    th {
        padding: 6px 8px; /* Reduced padding */
        background-color: #f8fafc;
        font-weight: bold;
        border: 1px solid #e5e7eb;
        text-align: left;
        line-height: 1.2;
    }

    .label {
        font-weight: bold;
        display: block;
        margin-bottom: 1px; /* Reduced */
        font-size: 11px;
        color: #374151;
        line-height: 1.2;
    }

    .value {
        display: block;
        margin-top: 1px; /* Reduced */
        line-height: 1.2;
        min-height: auto;
    }

    /* Remove fixed row heights */
    tr {
        height: auto;
        min-height: auto; /* Remove fixed min-height */
    }

    .enum-field {
        display: flex;
        gap: 8px; /* Reduced */
        margin-top: 2px; /* Reduced */
        flex-wrap: wrap;
    }

    .enum-option {
        padding: 2px 4px; /* Reduced */
        border: 1px solid #d1d5db;
        border-radius: 2px;
        background-color: #f9fafb;
        color: #374151;
        font-size: 10px; /* Reduced */
        font-weight: 500;
        word-break: break-word;
        max-width: 200px;
        line-height: 1.1;
    }

    .enum-option.selected {
        background-color: #0284c7;
        color: #ffffff;
        border-color: #0369a1;
        font-weight: bold;
    }

    .checkbox-item {
        display: flex;
        align-items: flex-start;
        gap: 4px; /* Reduced */
        padding: 2px 0; /* Reduced */
        margin-bottom: 1px; /* Reduced */
        line-height: 1.1;
    }

    .checkbox-box {
        width: 12px; /* Reduced */
        height: 12px; /* Reduced */
        border: 1px solid #d1d5db; /* Reduced */
        border-radius: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 8px; /* Reduced */
        font-weight: bold;
        color: white;
        flex-shrink: 0;
        margin-top: 0; /* Removed */
    }

    .empty-field {
        color: #6b7280;
        font-style: italic;
        font-size: 10px; /* Reduced */
    }

    /* Compact list styles */
    ul {
        margin: 2px 0; /* Reduced */
        padding-left: 15px; /* Reduced */
    }

    li {
        margin-bottom: 1px; /* Reduced */
        line-height: 1.2;
        font-size: 11px;
    }

    /* Professional table compact styles */
    .professional-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 4px; /* Reduced */
    }

    .professional-table th {
        padding: 4px 6px; /* Reduced */
        font-size: 10px; /* Reduced */
    }

    .professional-table td {
        padding: 4px 6px; /* Reduced */
        line-height: 1.1;
    }

    .professional-table .checkbox-item {
        margin: 0;
        gap: 4px; /* Reduced */
    }

    .professional-table .checkbox-box {
        width: 12px; /* Reduced */
        height: 12px; /* Reduced */
        font-size: 8px; /* Reduced */
    }

    /* Three column table adjustments */
    .three-column-table td {
        padding: 0 8px 0 0; /* Reduced */
        vertical-align: top;
    }

    .warning-box {
        margin-top: 8px; /* Reduced */
        padding: 6px; /* Reduced */
    }

    .warning-text {
        font-size: 10px; /* Reduced */
    }

    /* Ensure no extra space in section body */
    .section-body {
        margin: 0;
        padding: 0;
    }

    /* Compact field styles */
    .field {
        margin: 2px 0; /* Reduced */
    }
</style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">

        <div class="header-title">Client Profile(Onboarding)</div>
         <div class="document-number">Document Number: <span>Form F-18</span></div>
    </div>

    <!-- PART A – INITIAL ENQUIRY -->
    <div class="section">
        <div class="section-header">PART A – INITIAL ENQUIRY</div>
        <table>
            <tr>
                <td style="width: 25%">
                    <span class="label">Full Name</span>
                    <span class="value">{{ $initial->full_name ?? 'N/A' }}</span>
                </td>
                <td style="width: 25%">
                    <span class="label">Preferred Name</span>
                    <span class="value">{{ $initial->preferred_name ?? 'N/A' }}</span>
                </td>
                <td style="width: 25%">
                    <span class="label">Gender</span>
                    <div class="enum-field">
                        @foreach(['male', 'female', 'other'] as $option)
                            <span class="enum-option {{ ($initial->gender ?? '') === $option ? 'selected' : '' }}">
                                {{ ucfirst($option) }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td style="width: 25%">
                    <span class="label">Date of Birth</span>
                    <span class="value">
                        @if(!empty($initial->date_of_birth) && $initial->date_of_birth != '0000-00-00')
                            {{ \Carbon\Carbon::parse($initial->date_of_birth)->format('d-m-Y') }}

                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Address</span>
                    <span class="value">{{ $initial->address ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Postcode</span>
                    <span class="value">{{ $initial->postcode ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Phone Number</span>
                    <span class="value">{{ $initial->phone_number ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Mobile Number</span>
                    <span class="value">{{ $initial->mobile_number ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Email</span>
                    <span class="value">{{ $initial->email ?? 'N/A' }}</span>
                </td>
                <td>
                        <span class="label">Does the client need the involvement of an independent family member, friend, advocate, or legal guardian to assist with understanding and signing the agreement as part of this assessment?</span>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ (isset($initial->agreement) && (($initial->agreement == 1 ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach

                        </div>
                </td>
                <td>
                    <span class="label">Description</span>
                    <span class="value">{{ $initial->description ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- PART B – FUNDING DETAILS -->
    @if(isset($initial->funding))
    <div class="section">
        <div class="section-header"> FUNDING </div>
        <table>
            <tr>
                <td style="width: 25%">
                    <span class="label">Type of Funding </span>
                    <div class="enum-field">
                        @foreach(['Self-Managed','NDIA', 'Plan Managed'] as $option)
                            <span class="enum-option {{ ($initial->funding->type_of_funding ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td style="width: 25%">
                    <span class="label">Funding Contact Person</span>
                    <span class="value">{{ $initial->funding->funding_contact_person ?? 'N/A' }}</span>
                </td>
                <td style="width: 25%">
                    <span class="label">NDIS Plan Attached</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (isset($initial->funding->ndis_plan_attached) && (($initial->funding->ndis_plan_attached == 1 ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach

                    </div>
                </td>
                <td style="width: 25%">
                    <span class="label">NDIS Plan Start Date</span>
                    <span class="value">
                        @if(!empty($initial->funding->ndis_plan_start_date) && $initial->funding->ndis_plan_start_date != '0000-00-00')
                            {{ \Carbon\Carbon::parse($initial->funding->ndis_plan_start_date)->format('d-m-Y') }}
                        @else
                            <span class="empty-field">Not provided</span>
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">NDIS Plan End Date</span>
                    <span class="value">
                        @if(!empty($initial->funding->ndis_plan_end_date) && $initial->funding->ndis_plan_end_date != '0000-00-00')
                            {{ \Carbon\Carbon::parse($initial->funding->ndis_plan_end_date)->format('d-m-Y') }}
                        @else
                            <span class="empty-field">Not provided</span>
                        @endif
                    </span>
                </td>
                <td>
                    <span class="label">Plan Manager Name</span>
                    <span class="value">{{ $initial->funding->plan_manager_name ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Plan Manager Email</span>
                    <span class="value">{{ $initial->funding->plan_manager_email ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Plan Manager Phone</span>
                    <span class="value">{{ $initial->funding->plan_manager_phone ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>
    @endif

    <!-- PART C – EMERGENCY CONTACT DETAILS -->
    @if(isset($initial->emergencyContact))
    <div class="section">
        <div class="section-header">ALTERNATIVE EMERGENCY CONTACTS</div>
        <table>
            <tr>
                <td style="width: 25%">
                    <span class="label">Name</span>
                    <span class="value">{{ $initial->emergencyContact->name ?? 'N/A' }}</span>
                </td>
                <td style="width: 25%">
                    <span class="label">Relationship</span>
                    <span class="value">{{ $initial->emergencyContact->relationship ?? 'N/A' }}</span>
                </td>
                <td style="width: 25%">
                    <span class="label">Phone</span>
                    <span class="value">{{ $initial->emergencyContact->phone ?? 'N/A' }}</span>
                </td>
                <td style="width: 25%">
                    <span class="label">Mobile</span>
                    <span class="value">{{ $initial->emergencyContact->mobile ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span class="label">Work Contact</span>
                    <span class="value">{{ $initial->emergencyContact->work_contact ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>
    @endif

    <!-- PART D – SCHEDULE OF CARES -->
<div class="section">
    <div class="section-header">SCHEDULE OF CARE</div>
    <table style="width:100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f0f0f0; text-align: left;">
                <th style="width:5%; border: 1px solid #ccc; padding: 8px;">#</th>
                <th style="width:30%; border: 1px solid #ccc; padding: 8px;">Type of Service</th>
                <th style="width:32.5%; border: 1px solid #ccc; padding: 8px;">Primary Task List</th>
                <th style="width:32.5%; border: 1px solid #ccc; padding: 8px;">Secondary Task List</th>
            </tr>
        </thead>
        <tbody>
            @php
                $rows = $initial->scheduleOfCares ?? [];
                $minRows = 5; // minimum rows to display
                $totalRows = max(count($rows) + 1, $minRows); // +1 will auto-add 1 extra empty row
            @endphp

            @for ($i = 0; $i < $totalRows; $i++)
                <tr>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $i + 1 }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $rows[$i]->type_of_service ?? 'N/A' }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $rows[$i]->primary_task_list ?? 'N/A' }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $rows[$i]->secondary_task_list ?? 'N/A' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>



    <!-- PART E – CULTURAL BACKGROUND -->
    @if(isset($initial->culturalBackground))
    <div class="section">
        <div class="section-header">RELIGIOUS/CULTURAL</div>
        <table>
            <tr>
                <td style="width: 25%">
                    <span class="label">Has Children Under 18</span>
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
                <td style="width: 25%">
                    <span class="label">Country of Birth</span>
                    <span class="value">{{ $initial->culturalBackground->country_of_birth ?? 'N/A' }}</span>
                </td>
                <td style="width: 25%">
                    <span class="label">Preferred Language</span>
                    <span class="value">{{ $initial->culturalBackground->preferred_language ?? 'N/A' }}</span>
                </td>
                <td style="width: 25%">
                    <span class="label">Religion</span>
                    <span class="value">{{ $initial->culturalBackground->religion ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Other Languages</span>
                    <span class="value">{{ $initial->culturalBackground->other_languages ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Cultural Needs</span>
                    <span class="value">{{ $initial->culturalBackground->cultural_needs ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Interpreter Required</span>
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
                <td>
                    <span class="label">AUSLAN Required</span>
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
        <div class="section-header"> NDIS GOALS FOR BHC SUPPORT</div>
        <div class="section-body">
            <div class="field">
                <span class="label">What are the NDIS Goals that you would like assistance from BHC with?</span>
                <ul>
                    @foreach ($initial->ndisGoals as $goal)
                        <li>{{ $goal->goal_description ?? 'N/A' }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif




<!-- PART G – HEALTH PROFESSIONAL DETAILS -->
<div class="section">
    <div class="section-header"> HEALTH PROFESSIONAL DETAILS((Medical practitioner, BSP, medical specialists, Physio, OT, Podiatrist, Dentist etc.))</div>
    <div class="section-body">
        <table>
            <tr>
                <td>
                    <span class="label">Health Professionals</span>
                    <table class="professional-table">
                        <thead>
                            <tr>
                                <th style="width: 30%">Role/Position</th>
                                <th style="width: 40%">Name</th>
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

                                // Get all professionals and separate predefined vs custom
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

                            {{-- Display predefined roles --}}
                            @foreach($predefinedRoles as $role)
                                @php
                                    $hasData = isset($predefinedProfessionals[$role]);
                                    $prof = $hasData ? $predefinedProfessionals[$role] : null;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="checkbox-item">
                                            <span class="checkbox-box {{ $hasData ? 'checked' : '' }}">
                                                {{ $hasData ? '*' : '' }}
                                            </span>
                                            <span class="checkbox-label">{{ $role }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $hasData ? ($prof->name ?? '') : '' }}</td>
                                    <td>{{ $hasData ? ($prof->contact_number ?? '') : '' }}</td>
                                </tr>
                            @endforeach

                            {{-- Display custom/added professions --}}
                            @foreach($customProfessionals as $customProf)
                            <tr>
                                <td>
                                    <div class="checkbox-item">
                                        <span class="checkbox-box checked">
                                            *
                                        </span>
                                        <span class="checkbox-label">{{ $customProf->role }}</span>
                                    </div>
                                </td>
                                <td>{{ $customProf->name ?? '' }}</td>
                                <td>{{ $customProf->contact_number ?? '' }}</td>
                            </tr>
                            @endforeach

                            {{-- Show "Add Other" option if no custom professions exist --}}
                            @if(count($customProfessionals) === 0)
                            <tr>
                                <td>
                                    <div class="checkbox-item">
                                        <span class="checkbox-box">
                                            {{-- Empty checkbox --}}
                                        </span>
                                        <span class="checkbox-label">* Add Other</span>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>
{{-- PART H: DIAGNOSIS SUMMARY --}}
@if ($initial->diagnosisSummary)
    <div class="section">
        <div class="section-header"> DIAGNOSIS SUMMARY</div>
        <div class="section-body">
            <table>
                <tr>
                    <td>
                        <span class="label">Primary Diagnosis</span>
                        <span class="value">{{ $initial->diagnosisSummary->primary_diagnosis }}</span>
                    </td>
                    <td>
                        <span class="label">Secondary Diagnosis</span>
                        <span class="value">{{ $initial->diagnosisSummary->secondary_diagnosis }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endif




<!-- PART I: HEALTH INFORMATION -->
@if ($initial->healthInformation)
<div class="section">
    <div class="section-header"> HEALTH INFORMATION</div>
    <div class="section-body">
        <table>
            <tr>
                <td>
                    <span class="label">Health Conditions</span>
                    <table class="three-column-table">
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
                                    'Other'
                                ];

                                $selectedConditions = $initial->healthInformation->health_conditions ?? [];
                                $selectedConditions = is_array($selectedConditions) ? $selectedConditions : [];

                                $chunkSize = ceil(count($allHealthConditions) / 3);
                                $columns = array_chunk($allHealthConditions, $chunkSize);
                            @endphp

                            @foreach($columns as $column)
                            <td style="width: 33%; vertical-align: top;">
                                @foreach($column as $condition)
                                <div class="checkbox-item">
                                    <span class="checkbox-box {{ in_array($condition, $selectedConditions) ? 'checked' : '' }}">
                                        {{ in_array($condition, $selectedConditions) ? '*' : '' }}
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
</div>
@endif
{{-- PART J: HEALTHCARE SUPPORT DETAIL --}}
@if ($initial->healthcareSupportDetail)
    <div class="section">
        <div class="section-header">HEALTHCARE AND SUPPORT DETAILS</div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="border: 1px solid #ccc; padding: 8px; width: 20%; font-weight: bold;">Medicare</td>
                <td style="border: 1px solid #ccc; padding: 8px; width: 30%;">{{ $initial->healthcareSupportDetail->medicare ?? 'N/A' }}</td>
                <td style="border: 1px solid #ccc; padding: 8px; width: 20%; font-weight: bold;">Health Fund</td>
                <td style="border: 1px solid #ccc; padding: 8px; width: 30%;">{{ $initial->healthcareSupportDetail->health_fund ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #ccc; padding: 8px; font-weight: bold;">Pension Card Number</td>
                <td style="border: 1px solid #ccc; padding: 8px;">{{ $initial->healthcareSupportDetail->pension_card_number ?? 'N/A' }}</td>
                <td style="border: 1px solid #ccc; padding: 8px; font-weight: bold;">Health Care Card</td>
                <td style="border: 1px solid #ccc; padding: 8px;">{{ $initial->healthcareSupportDetail->health_care_card ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #ccc; padding: 8px; font-weight: bold;">DVA Type</td>
                <td style="border: 1px solid #ccc; padding: 8px;">{{ $initial->healthcareSupportDetail->dva_type ?? 'N/A' }}</td>
                <td style="border: 1px solid #ccc; padding: 8px; font-weight: bold;">DVA Number</td>
                <td style="border: 1px solid #ccc; padding: 8px;">{{ $initial->healthcareSupportDetail->dva_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #ccc; padding: 8px; font-weight: bold;">Companion Card</td>
                <td style="border: 1px solid #ccc; padding: 8px;">{{ $initial->healthcareSupportDetail->companion_card ?? 'N/A' }}</td>
                <td style="border: 1px solid #ccc; padding: 8px; font-weight: bold;">Preferred Hospital</td>
                <td style="border: 1px solid #ccc; padding: 8px;">{{ $initial->healthcareSupportDetail->preferred_hospital ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #ccc; padding: 8px; font-weight: bold;">Ambulance Number</td>
                <td style="border: 1px solid #ccc; padding: 8px;">{{ $initial->healthcareSupportDetail->ambulance_number ?? 'N/A' }}</td>
                <td style="border: 1px solid #ccc; padding: 8px; font-weight: bold;">Disabled Parking</td>
                <td style="border: 1px solid #ccc; padding: 8px;">{{ $initial->healthcareSupportDetail->disabled_parking ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>
@endif



{{-- PART K: BEHAVIOUR SUPPORT --}}
@if(isset($initial->behaviourSupport))
    <div class="section">
        <div class="section-header"> BEHAVIOUR SUPPORT</div>
        <div class="section-body">
            <table>
                <tr>
                    <td style="width: 50%">
                        <span class="label">Has Behaviour Support Plan</span>
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
                    <td style="width: 50%">
                        <span class="label">Plan Copy Received</span>
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
    </div>
@endif

{{-- PART L – MEDICAL ALERT --}}
@if ($initial->medicalAlert)
   <div class="section page-break">
        <div class="section-header"> MEDICAL ALERTS/ ALLERGIES</div>
        <div class="section-body">
            <table>
                <tr>
                    <td>
                        <span class="label">Has Epilepsy</span>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($initial->medicalAlert->epilepsy ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <span class="label">Has Asthma</span>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($initial->medicalAlert->asthma ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <span class="label">Has Diabetes</span>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($initial->medicalAlert->diabetes ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <span class="label">Allergies</span>
                        <span class="value">{{ $initial->medicalAlert->allergies }}</span>
                    </td>
                </tr>
                <tr><td><span class="label">(If yes to any of the above, please provide a copy of the current plan less than a year old.) </span></td></tr>

                <tr>
                    <td>
                        <span class="label">Medical Info</span>
                        <span class="value">{{ $initial->medicalAlert->medical_info }}</span>
                    </td>
                    <td>
                        <span class="label">Diagnosis</span>
                        <span class="value">{{ $initial->medicalAlert->diagnosis }}</span>
                    </td>
                    <td>
                        <span class="label">Other Description</span>
                        <span class="value">{{ $initial->medicalAlert->other_description }}</span>
                    </td>
                    <td>
                        <span class="label">Medication Taken</span>
                        <span class="value">{{ $initial->medicalAlert->medication_taken }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Medication Purpose</span>
                        <span class="value">{{ $initial->medicalAlert->medication_purpose }}</span>
                    </td>
                    <td>
                        <span class="label">Staff Administers Medication</span>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($initial->medicalAlert->staff_administer_medication ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td colspan="2">
                        <span class="label">If yes, by whom:</span><br>
                        <div style="display: flex; gap: 20px; margin-top: 4px;">
                            <div class="checkbox-item">
                                <span class="checkbox-box {{ $initial->medicalAlert->self_administered ? 'checked' : '' }}">
                                    {{ $initial->medicalAlert->self_administered ? '*' : 'X' }}
                                </span>
                                <span class="checkbox-label">Self Administered</span>
                            </div>
                            <div class="checkbox-item">
                                <span class="checkbox-box {{ $initial->medicalAlert->guardian ? 'checked' : '' }}">
                                    {{ $initial->medicalAlert->guardian ? '*' : 'X' }}
                                </span>
                                <span class="checkbox-label">Guardian</span>
                            </div>
                            <div class="checkbox-item">
                                <span class="checkbox-box {{ $initial->medicalAlert->support_worker ? 'checked' : '' }}">
                                    {{ $initial->medicalAlert->support_worker ? '*' : 'X' }}
                                </span>
                                <span class="checkbox-label">Support Worker</span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endif

{{-- PART M – PREVENTIVE HEALTH SUMMARY --}}
@if ($initial->preventiveHealthSummary)
    <div class="section">
        <div class="section-header"> PREVENTIVE HEALTH SUMMARY</div>
        <div class="section-body">
            <table>
                <tr>
                    <td>
                        <span class="label">Medical Check-Up Status</span>
                        <span class="value">{{ $initial->preventiveHealthSummary->medical_checkup_status }}</span>
                    </td>
                    <td>
                        <span class="label">Last Dental Check</span>
                         <span class="value">{{ \Carbon\Carbon::parse($initial->preventiveHealthSummary->last_dental_check)->format('d-m-Y') }}</span>
                    </td>
                    <td>
                        <span class="label">Last Hearing Check</span>
                        <span class="value">{{ \Carbon\Carbon::parse($initial->preventiveHealthSummary->last_hearing_check)->format('d-m-Y') }}</span>

                    </td>
                    <td>
                        <span class="label">Last Vision Check</span>
                        <span class="value">{{ \Carbon\Carbon::parse($initial->preventiveHealthSummary->last_vision_check)->format('d-m-Y') }}</span>

                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Requires Vaccination Assistance</span>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($initial->preventiveHealthSummary->requires_vaccination_assistance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td></td><td></td><td></td>
                </tr>
            </table>
        </div>
    </div>
@endif

{{-- PART N – SUPPORT INFORMATION --}}
@if ($initial->supportInformation)
    <div class="section">
        <div class="section-header"> SUPPORT INFORMATION</div>
        <div class="section-body">
            <table>
                <tr>
                   <td>
                        <span class="label">Communication Assistance Required(Communication support is needed with hearing, comprehension, and vision.
(Languages other than English)** Refer to Communication Plan if Needed)</span>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($initial->supportInformation->communication_assistance_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <span class="label">Mealtime Plan</span>
                        <span class="value">{{ $initial->supportInformation->mealtime_plan }}</span>
                    </td>
                    <td>
                        <span class="label">Likes</span>
                        <span class="value">{{ is_array($initial->supportInformation->likes) ? implode(', ', $initial->supportInformation->likes) : $initial->supportInformation->likes }}</span>
                    </td>
                    <td>
                        <span class="label">Dislikes</span>
                        <span class="value">{{ is_array($initial->supportInformation->dislikes) ? implode(', ', $initial->supportInformation->dislikes) : $initial->supportInformation->dislikes }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Interests(Interests (for example gardening, craft, reading etc))</span>
                        <span class="value">{{ is_array($initial->supportInformation->interests) ? implode(', ', $initial->supportInformation->interests) : $initial->supportInformation->interests }}</span>
                    </td>
                    <td>
                        <span class="label">Preferred Worker</span>
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
                    <td>
                        <span class="label">Special Request</span>
                        <span class="value">{{ $initial->supportInformation->special_request }}</span>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
@endif
</div>
</body>
</html>
