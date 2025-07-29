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
            max-width: 60px;
            height: auto;
        }


        .header-title {
            font-size: 20px;
            font-weight: bold;
        }

        .document-number {
            font-size: 14px;
            font-weight: 600;
        }

        .document-number span {
            color: #4f46e5;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-header {
            background-color: #f3f4f6;
            padding: 10px 15px;
            font-weight: bold;
            border-left: 4px solid #4f46e5;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 6px 8px;
            vertical-align: top;
            border: 1px solid #e5e7eb;
        }

        .label {
            font-weight: bold;
            display: block;
        }

        .value {
            margin-top: 2px;
        }

        .page-break {
            page-break-before: always;
            break-before: page; /* For added browser support */
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


    <div class="section">
        <div class="section-header">PART A – INITIAL ENQUIRY</div>
        <table>
            <tr>
                <td>
                    <span class="label">Full Name</span>
                    <span class="value">{{ $initial->full_name }}</span>
                </td>
                <td>
                    <span class="label">Preferred Name</span>
                    <span class="value">{{ $initial->preferred_name }}</span>
                </td>
                <td>
                    <span class="label">Gender</span>
                    <span class="value">{{ ucfirst($initial->gender) }}</span>
                </td>
                <td>
                    <span class="label">Date of Birth</span>
                    <span class="value">{{ \Carbon\Carbon::parse($initial->date_of_birth)->format('d-m-Y') }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Address</span>
                    <span class="value">{{ $initial->address }}</span>
                </td>
                <td>
                    <span class="label">Postcode</span>
                    <span class="value">{{ $initial->postcode }}</span>
                </td>
                <td>
                    <span class="label">Phone Number</span>
                    <span class="value">{{ $initial->phone_number }}</span>
                </td>
                <td>
                    <span class="label">Mobile Number</span>
                    <span class="value">{{ $initial->mobile_number }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Email</span>
                    <span class="value">{{ $initial->email }}</span>
                </td>
                <td>
                    <span class="label">Needs Assistance</span>
                    <span class="value">{{ $initial->agreement == 1 ? 'Yes' : 'No' }}</span>
                </td>
                <td>
                    @if($initial->description)
                        <span class="label">Description</span>
                        <span class="value">{{ $initial->description }}</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-header">PART B – FUNDING DETAILS</div>
        <table>
            <tr>
                <td>
                    <span class="label">Type of Funding</span>
                    <span class="value">{{ $initial->funding->type_of_funding }}</span>
                </td>
                <td>
                    <span class="label">Funding Contact Person</span>
                    <span class="value">{{ $initial->funding->funding_contact_person }}</span>
                </td>
                <td>
                    <span class="label">NDIS Plan Attached</span>
                    <span class="value">{{ $initial->funding->ndis_plan_attached == 1 ? 'Yes' : 'No' }}</span>
                </td>
                <td>
                    <span class="label">NDIS Plan Start Date</span>
                    <span class="value">{{ \Carbon\Carbon::parse($initial->funding->ndis_plan_start_date)->format('d-m-Y') }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">NDIS Plan End Date</span>
                    <span class="value">{{ \Carbon\Carbon::parse($initial->funding->ndis_plan_end_date)->format('d-m-Y') }}</span>
                </td>
                <td>
                    <span class="label">Plan Manager Name</span>
                    <span class="value">{{ $initial->funding->plan_manager_name }}</span>
                </td>
                <td>
                    <span class="label">Plan Manager Email</span>
                    <span class="value">{{ $initial->funding->plan_manager_email }}</span>
                </td>
                <td>
                    <span class="label">Plan Manager Phone</span>
                    <span class="value">{{ $initial->funding->plan_manager_phone }}</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-header">PART C – EMERGENCY CONTACT DETAILS</div>
        <table>
            <tr>
                <td>
                    <span class="label">Name</span>
                    <span class="value">{{ $initial->emergencyContact->name }}</span>
                </td>
                <td>
                    <span class="label">Relationship</span>
                    <span class="value">{{ $initial->emergencyContact->relationship }}</span>
                </td>
                <td>
                    <span class="label">Phone</span>
                    <span class="value">{{ $initial->emergencyContact->phone }}</span>
                </td>
                <td>
                    <span class="label">Mobile</span>
                    <span class="value">{{ $initial->emergencyContact->mobile }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span class="label">Work Contact</span>
                    <span class="value">{{ $initial->emergencyContact->work_contact }}</span>
                </td>
            </tr>
        </table>
    </div>
        {{-- PART D – SCHEDULE OF CARES --}}
    @if ($initial->scheduleOfCares && $initial->scheduleOfCares->count())
        <div class="section">
            <div class="section-header">PART D – SCHEDULE OF CARES</div>
            <table>
                <thead>
                    <tr>
                        <td><strong>Type of Service</strong></td>
                        <td><strong>Primary Task List</strong></td>
                        <td><strong>Secondary Task List</strong></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($initial->scheduleOfCares as $schedule)
                        <tr>
                            <td>{{ $schedule->type_of_service }}</td>
                            <td>{{ $schedule->primary_task_list }}</td>
                            <td>{{ $schedule->secondary_task_list }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
        {{-- PART E – CULTURAL BACKGROUND --}}
    @if ($initial->culturalBackground)
        <div class="section">
            <div class="section-header">PART E – CULTURAL BACKGROUND</div>
            <table>
                <tr>
                    <td>
                        <span class="label">Has Children Under 18</span>
                        <span class="value">{{ $initial->culturalBackground->has_children_under_18 ? 'Yes' : 'No' }}</span>
                    </td>
                    <td>
                        <span class="label">Country of Birth</span>
                        <span class="value">{{ $initial->culturalBackground->country_of_birth }}</span>
                    </td>
                    <td>
                        <span class="label">Preferred Language</span>
                        <span class="value">{{ $initial->culturalBackground->preferred_language }}</span>
                    </td>
                    <td>
                        <span class="label">Religion</span>
                        <span class="value">{{ $initial->culturalBackground->religion }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Other Languages</span>
                        <span class="value">{{ $initial->culturalBackground->other_languages }}</span>
                    </td>
                    <td>
                        <span class="label">Cultural Needs</span>
                        <span class="value">{{ $initial->culturalBackground->cultural_needs }}</span>
                    </td>
                    <td>
                        <span class="label">Interpreter Required</span>
                        <span class="value">{{ $initial->culturalBackground->interpreter_required ? 'Yes' : 'No' }}</span>
                    </td>
                    <td>
                        <span class="label">AUSLAN Required</span>
                        <span class="value">{{ $initial->culturalBackground->auslan_required ? 'Yes' : 'No' }}</span>
                    </td>
                </tr>
            </table>
        </div>
    @endif

    @if ($initial->ndisGoals && $initial->ndisGoals->count())
    <div class="section">
        <div class="section-header">PART F – NDIS GOALS</div>
        <div class="section-body">
            <div class="field">
                <span class="label">What are the NDIS Goals that you would like assistance from BHC with?</span>
                <ul style="margin-top: 10px; padding-left: 20px;">
                    @foreach ($initial->ndisGoals as $goal)
                        <li style="margin-bottom: 6px;">{{ $goal->goal_description }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if ($initial->healthProfessionalDetails && $initial->healthProfessionalDetails->count())
    <div class="section">
        <div class="section-header">PART G – HEALTH PROFESSIONAL DETAILS</div>
        <div class="section-body">
            <table>
                <thead>
                    <tr>
                        <td><span class="label">Role</span></td>
                        <td><span class="label">Name</span></td>
                        <td><span class="label">Contact Number</span></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($initial->healthProfessionalDetails as $prof)
                        <tr>
                            <td><span class="value">{{ $prof->role }}</span></td>
                            <td><span class="value">{{ $prof->name }}</span></td>
                            <td><span class="value">{{ $prof->contact_number }}</span></td>
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
@if ($initial->behaviourSupport)
    <div class="section">
        <div class="section-header">PART K – BEHAVIOUR SUPPORT</div>
        <div class="section-body">
            <table>
                <tr>
                    <td>
                        <span class="label">Has Behaviour Support Plan</span>
                        <span class="value">{{ $initial->behaviourSupport->has_support_plan == 1 ? 'Yes' : 'No' }}</span>
                    </td>
                    <td>
                        <span class="label">Plan Copy Received</span>
                        <span class="value">{{ $initial->behaviourSupport->plan_copy_received == 1 ? 'Yes' : 'No' }}</span>
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
                        <span class="value">{{ $initial->preventiveHealthSummary->last_dental_check }}</span>
                    </td>
                    <td>
                        <span class="label">Last Hearing Check</span>
                        <span class="value">{{ $initial->preventiveHealthSummary->last_hearing_check }}</span>
                    </td>
                    <td>
                        <span class="label">Last Vision Check</span>
                        <span class="value">{{ $initial->preventiveHealthSummary->last_vision_check }}</span>
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
