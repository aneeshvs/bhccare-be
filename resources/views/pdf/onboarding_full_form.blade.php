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
            margin-bottom: 25px;
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
        }

        .document-number {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .document-number span {
            color: #4f46e5;
        }

        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .section-header {
            counter-increment: section;
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 8px 12px;
            font-weight: bold;
            border-left: 4px solid #0284c7;
            margin-bottom: 8px;
            border-radius: 4px;
        }

        .section-header::before {
            content: counter(section) ". ";
            font-weight: bold;
            color: #0284c7;
            margin-right: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        td {
            padding: 6px 8px;
            vertical-align: top;
            border: 1px solid #e5e7eb;
        }

        th {
            padding: 8px 10px;
            background-color: #f8fafc;
            font-weight: bold;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 2px;
            font-size: 11px;
            color: #374151;
        }

        .value {
            display: block;
            margin-top: 2px;
            line-height: 1.3;
        }

        .page-break {
            page-break-before: always;
            break-before: page;
        }

        .enum-field {
            display: flex;
            gap: 6px;
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

        .section-body {
            margin: 0;
            padding: 0;
        }

        .empty-field {
            color: #6b7280;
            font-style: italic;
        }

        ul {
            margin: 6px 0;
            padding-left: 18px;
        }

        li {
            margin-bottom: 3px;
            line-height: 1.3;
        }

        /* Consistent row heights */
        tr {
            height: auto;
            min-height: 32px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="document-number">Document Number: <span>Form F-18</span></div>
        <div class="header-title">Client Profile - Onboarding</div>
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
                        @else
                            <span class="empty-field">Not provided</span>
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
                    <span class="label">Needs Assistance</span>
                    <span class="value">
                        @if(isset($initial->agreement))
                            {{ $initial->agreement == 1 ? 'Yes' : 'No' }}
                        @else
                            <span class="empty-field">Not provided</span>
                        @endif
                    </span>
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
        <div class="section-header">PART B – FUNDING DETAILS</div>
        <table>
            <tr>
                <td style="width: 25%">
                    <span class="label">Type of Funding</span>
                    <span class="value">{{ $initial->funding->type_of_funding ?? 'N/A' }}</span>
                </td>
                <td style="width: 25%">
                    <span class="label">Funding Contact Person</span>
                    <span class="value">{{ $initial->funding->funding_contact_person ?? 'N/A' }}</span>
                </td>
                <td style="width: 25%">
                    <span class="label">NDIS Plan Attached</span>
                    <span class="value">
                        @if(isset($initial->funding->ndis_plan_attached))
                            {{ $initial->funding->ndis_plan_attached == 1 ? 'Yes' : 'No' }}
                        @else
                            <span class="empty-field">Not provided</span>
                        @endif
                    </span>
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
        <div class="section-header">PART C – EMERGENCY CONTACT DETAILS</div>
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
    @if(isset($initial->scheduleOfCares) && count($initial->scheduleOfCares) > 0)
    <div class="section">
        <div class="section-header">PART D – SCHEDULE OF CARES</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 30%">Type of Service</th>
                    <th style="width: 35%">Primary Task List</th>
                    <th style="width: 35%">Secondary Task List</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($initial->scheduleOfCares as $schedule)
                    <tr>
                        <td>{{ $schedule->type_of_service ?? 'N/A' }}</td>
                        <td>{{ $schedule->primary_task_list ?? 'N/A' }}</td>
                        <td>{{ $schedule->secondary_task_list ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- PART E – CULTURAL BACKGROUND -->
    @if(isset($initial->culturalBackground))
    <div class="section">
        <div class="section-header">PART E – CULTURAL BACKGROUND</div>
        <table>
            <tr>
                <td style="width: 25%">
                    <span class="label">Has Children Under 18</span>
                    <span class="value">
                        @if(isset($initial->culturalBackground->has_children_under_18))
                            {{ $initial->culturalBackground->has_children_under_18 ? 'Yes' : 'No' }}
                        @else
                            <span class="empty-field">Not provided</span>
                        @endif
                    </span>
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
                    <span class="value">
                        @if(isset($initial->culturalBackground->interpreter_required))
                            {{ $initial->culturalBackground->interpreter_required ? 'Yes' : 'No' }}
                        @else
                            <span class="empty-field">Not provided</span>
                        @endif
                    </span>
                </td>
                <td>
                    <span class="label">AUSLAN Required</span>
                    <span class="value">
                        @if(isset($initial->culturalBackground->auslan_required))
                            {{ $initial->culturalBackground->auslan_required ? 'Yes' : 'No' }}
                        @else
                            <span class="empty-field">Not provided</span>
                        @endif
                    </span>
                </td>
            </tr>
        </table>
    </div>
    @endif

    <!-- Page break before PART F -->
    <div style="page-break-before: always;"></div>

    <!-- PART F – NDIS GOALS -->
    @if(isset($initial->ndisGoals) && count($initial->ndisGoals) > 0)
    <div class="section">
        <div class="section-header">PART F – NDIS GOALS</div>
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
    @if(isset($initial->healthProfessionalDetails) && count($initial->healthProfessionalDetails) > 0)
    <div class="section">
        <div class="section-header">PART G – HEALTH PROFESSIONAL DETAILS</div>
        <div class="section-body">
            <table>
                <thead>
                    <tr>
                        <th style="width: 30%">Role</th>
                        <th style="width: 40%">Name</th>
                        <th style="width: 30%">Contact Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($initial->healthProfessionalDetails as $prof)
                        <tr>
                            <td>{{ $prof->role ?? 'N/A' }}</td>
                            <td>{{ $prof->name ?? 'N/A' }}</td>
                            <td>{{ $prof->contact_number ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
{{-- PART H: DIAGNOSIS SUMMARY --}}
@if ($initial->diagnosisSummary)
    <div class="section">
        <div class="section-header">PART H – DIAGNOSIS SUMMARY</div>
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

{{-- PART I: HEALTH INFORMATION --}}
@if ($initial->healthInformation)
    <div class="section">
        <div class="section-header">PART I – HEALTH INFORMATION</div>
        <div class="section-body">
            <table>
                <tr>
                    <td>
                        <span class="label">Health Conditions</span>
                        <span class="value">
                            {{ is_array($initial->healthInformation->health_conditions)
                                ? implode(', ', $initial->healthInformation->health_conditions)
                                : $initial->healthInformation->health_conditions }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endif
{{-- PART J: HEALTHCARE SUPPORT DETAIL --}}
@if ($initial->healthcareSupportDetail)
    <div class="section">
        <div class="section-header">PART J – HEALTHCARE SUPPORT DETAIL</div>
        <div class="section-body">
            <table>
                <tr>
                    <td>
                        <span class="label">Medicare</span>
                        <span class="value">{{ $initial->healthcareSupportDetail->medicare }}</span>
                    </td>
                    <td>
                        <span class="label">Health Fund</span>
                        <span class="value">{{ $initial->healthcareSupportDetail->health_fund }}</span>
                    </td>
                    <td>
                        <span class="label">Pension Card Number</span>
                        <span class="value">{{ $initial->healthcareSupportDetail->pension_card_number }}</span>
                    </td>
                    <td>
                        <span class="label">Health Care Card</span>
                        <span class="value">{{ $initial->healthcareSupportDetail->health_care_card }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">DVA Type</span>
                        <span class="value">{{ $initial->healthcareSupportDetail->dva_type }}</span>
                    </td>
                    <td>
                        <span class="label">DVA Number</span>
                        <span class="value">{{ $initial->healthcareSupportDetail->dva_number }}</span>
                    </td>
                    <td>
                        <span class="label">Companion Card</span>
                        <span class="value">{{ $initial->healthcareSupportDetail->companion_card }}</span>
                    </td>
                    <td>
                        <span class="label">Preferred Hospital</span>
                        <span class="value">{{ $initial->healthcareSupportDetail->preferred_hospital }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Ambulance Number</span>
                        <span class="value">{{ $initial->healthcareSupportDetail->ambulance_number }}</span>
                    </td>
                    <td>
                        <span class="label">Disabled Parking</span>
                        <span class="value">{{ $initial->healthcareSupportDetail->disabled_parking }}</span>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
@endif



{{-- PART K: BEHAVIOUR SUPPORT --}}
@if(isset($initial->behaviourSupport))
    <div class="section">
        <div class="section-header">PART K – BEHAVIOUR SUPPORT</div>
        <div class="section-body">
            <table>
                <tr>
                    <td style="width: 50%">
                        <span class="label">Has Behaviour Support Plan</span>
                        <span class="value">
                            @if(isset($initial->behaviourSupport->has_support_plan))
                                {{ $initial->behaviourSupport->has_support_plan == 1 ? 'Yes' : 'No' }}
                            @else
                                <span class="empty-field">Not provided</span>
                            @endif
                        </span>
                    </td>
                    <td style="width: 50%">
                        <span class="label">Plan Copy Received</span>
                        <span class="value">
                            @if(isset($initial->behaviourSupport->plan_copy_received))
                                {{ $initial->behaviourSupport->plan_copy_received == 1 ? 'Yes' : 'No' }}
                            @else
                                <span class="empty-field">Not provided</span>
                            @endif
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    @endif

{{-- PART L – MEDICAL ALERT --}}
@if ($initial->medicalAlert)
   <div class="section page-break">
        <div class="section-header">PART L – MEDICAL ALERT</div>
        <div class="section-body">
            <table>
                <tr>
                    <td>
                        <span class="label">Has Epilepsy</span>
                        <span class="value">{{ $initial->medicalAlert->epilepsy ? 'Yes' : 'No' }}</span>
                    </td>
                    <td>
                        <span class="label">Has Asthma</span>
                        <span class="value">{{ $initial->medicalAlert->asthma ? 'Yes' : 'No' }}</span>
                    </td>
                    <td>
                        <span class="label">Has Diabetes</span>
                        <span class="value">{{ $initial->medicalAlert->diabetes ? 'Yes' : 'No' }}</span>
                    </td>
                    <td>
                        <span class="label">Allergies</span>
                        <span class="value">{{ $initial->medicalAlert->allergies }}</span>
                    </td>
                </tr>
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
                        <span class="value">{{ $initial->medicalAlert->staff_administer_medication ? 'Yes' : 'No' }}</span>
                    </td>
                    <td>
                        <span class="label">Self Administered</span>
                        <span class="value">{{ $initial->medicalAlert->self_administered ? 'Yes' : 'No' }}</span>
                    </td>
                    <td>
                        <span class="label">Guardian</span>
                        <span class="value">{{ $initial->medicalAlert->guardian }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Support Worker</span>
                        <span class="value">{{ $initial->medicalAlert->support_worker }}</span>
                    </td>
                    <td></td><td></td><td></td>
                </tr>
            </table>
        </div>
    </div>
@endif

{{-- PART M – PREVENTIVE HEALTH SUMMARY --}}
@if ($initial->preventiveHealthSummary)
    <div class="section">
        <div class="section-header">PART M – PREVENTIVE HEALTH SUMMARY</div>
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
                        <span class="value">{{ $initial->preventiveHealthSummary->requires_vaccination_assistance ? 'Yes' : 'No' }}</span>
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
        <div class="section-header">PART N – SUPPORT INFORMATION</div>
        <div class="section-body">
            <table>
                <tr>
                    <td>
                        <span class="label">Communication Assistance Required</span>
                        <span class="value">{{ $initial->supportInformation->communication_assistance_required ? 'Yes' : 'No' }}</span>
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
                        <span class="label">Interests</span>
                        <span class="value">{{ is_array($initial->supportInformation->interests) ? implode(', ', $initial->supportInformation->interests) : $initial->supportInformation->interests }}</span>
                    </td>
                    <td>
                        <span class="label">Preferred Worker</span>
                        <span class="value">
                            {{ $initial->supportInformation->male ? 'Male ' : '' }}
                            {{ $initial->supportInformation->female ? 'Female ' : '' }}
                            {{ $initial->supportInformation->no_preference ? 'No Preference' : '' }}
                        </span>
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
