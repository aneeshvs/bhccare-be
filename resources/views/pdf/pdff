<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Profile - Onboarding</title>
   <style>
    /* General body styles */
    body {
        font-family: sans-serif;
        font-size: 12px; /* Reduced for tighter PDF */
        background-color: #f9fafb;
        color: #111827;
        margin: 0;
        padding: 20px;
    }

    /* Centered container for all content */
    .container {
        max-width: 900px;
        margin: auto;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 30px 40px;
    }

    /* Header section styling */
    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header-title {
        font-size: 22px;
        font-weight: bold;
        margin-top: 8px;
    }

    .document-number {
        font-size: 14px;
        font-weight: 600;
    }

    .document-number span {
        color: #4f46e5;
    }

    /* Section block style */
    .section {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        margin: 40px 0; /* Added space before and after sections */
        background-color: #fff;
        padding: 0;
        page-break-inside: avoid;
    }

    .section-header {
        background-color: #f3f4f6;
        padding: 12px 20px;
        font-weight: 600;
        font-size: 14px; /* Slightly smaller for PDF */
        border-bottom: 1px solid #e5e7eb;
    }

    .section-body {
        padding: 20px;
    }

    /* Table layout for fields */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 10px 0; /* Tighter spacing */
    }

    td {
        vertical-align: top;
        width: 50%;
    }

    .field {
        margin-bottom: 12px;
    }

    .label {
        font-weight: bold;
        display: block;
        margin-bottom: 4px;
        font-size: 12px;
    }

    .value-box {
        border: 1px solid #ccc;
        padding: 8px;
        background-color: #f9fafb;
        border-radius: 4px;
        font-size: 12px;
    }

    /* Logo styling */
    .logo {
        max-width: 200px;
        display: block;
        margin: 0 auto 10px;
    }

    /* Force new page between sections if required */
    .page-break {
        page-break-before: always;
    }
</style>

</head>
<body>
<div class="container">
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="document-number">Document Number: <span>Form F-18</span></div>
        <h1 class="header-title">Client Profile - Onboarding</h1>
    </div>

    {{-- PART A --}}
    <div class="section">
        <div class="section-header">PART A – INITIAL ENQUIRY</div>
        <div class="section-body">
            <table>
                <tr>
                    <td>
                        <div class="field">
                            <span class="label">Client's Full Name</span>
                            <div class="value-box">{{ $initial->full_name }}</div>
                        </div>
                        <div class="field">
                            <span class="label">Preferred Name</span>
                            <div class="value-box">{{ $initial->preferred_name }}</div>
                        </div>
                        <div class="field">
                            <span class="label">Gender</span>
                            <div class="value-box">{{ ucfirst($initial->gender) }}</div>
                        </div>
                        <div class="field">
                            <span class="label">Date of Birth</span>
                            <div class="value-box">{{ \Carbon\Carbon::parse($initial->date_of_birth)->format('d-m-Y') }}</div>
                        </div>
                        <div class="field">
                            <span class="label">Address</span>
                            <div class="value-box">{{ $initial->address }}</div>
                        </div>
                    </td>
                    <td>
                        <div class="field">
                            <span class="label">Postcode</span>
                            <div class="value-box">{{ $initial->postcode }}</div>
                        </div>
                        <div class="field">
                            <span class="label">Phone Number</span>
                            <div class="value-box">{{ $initial->phone_number }}</div>
                        </div>
                        <div class="field">
                            <span class="label">Mobile Number</span>
                            <div class="value-box">{{ $initial->mobile_number }}</div>
                        </div>
                        <div class="field">
                            <span class="label">Email</span>
                            <div class="value-box">{{ $initial->email }}</div>
                        </div>
                        <div class="field">
                            <span class="label">Needs Assistance</span>
                            <div class="value-box">{{ $initial->agreement == 1 ? 'Yes' : 'No' }}</div>
                        </div>
                        @if($initial->description)
                            <div class="field">
                                <span class="label">Description</span>
                                <div class="value-box">{{ $initial->description }}</div>
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- PART B --}}
    @if ($initial->funding)
        <div class="section">
            <div class="section-header">PART B – FUNDING DETAILS</div>
            <div class="section-body">
                <table>
                    <tr>
                        <td>
                            <div class="field">
                                <span class="label">Type of Funding</span>
                                <div class="value-box">{{ $initial->funding->type_of_funding }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Funding Contact Person</span>
                                <div class="value-box">{{ $initial->funding->funding_contact_person }}</div>
                            </div>
                            <div class="field">
                                <span class="label">NDIS Plan Attached</span>
                                <div class="value-box">{{ $initial->funding->ndis_plan_attached == 1 ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="field">
                                <span class="label">NDIS Plan Start Date</span>
                                <div class="value-box">{{ \Carbon\Carbon::parse($initial->funding->ndis_plan_start_date)->format('d-m-Y') }}</div>
                            </div>
                            <div class="field">
                                <span class="label">NDIS Plan End Date</span>
                                <div class="value-box">{{ \Carbon\Carbon::parse($initial->funding->ndis_plan_end_date)->format('d-m-Y') }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="field">
                                <span class="label">Plan Manager Name</span>
                                <div class="value-box">{{ $initial->funding->plan_manager_name }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Plan Manager Email</span>
                                <div class="value-box">{{ $initial->funding->plan_manager_email }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Plan Manager Phone</span>
                                <div class="value-box">{{ $initial->funding->plan_manager_phone }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif

    {{-- PART C: EMERGENCY CONTACT DETAILS --}}
    @if ($initial->emergencyContact)
        <div class="section">
            <div class="section-header">PART C – EMERGENCY CONTACT DETAILS</div>
            <div class="section-body">
                <table>
                    <tr>
                        <td>
                            <div class="field">
                                <span class="label">Name</span>
                                <div class="value-box">{{ $initial->emergencyContact->name }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Relationship</span>
                                <div class="value-box">{{ $initial->emergencyContact->relationship }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Phone</span>
                                <div class="value-box">{{ $initial->emergencyContact->phone }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="field">
                                <span class="label">Mobile</span>
                                <div class="value-box">{{ $initial->emergencyContact->mobile }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Work Contact</span>
                                <div class="value-box">{{ $initial->emergencyContact->work_contact }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif
        {{-- PART D: SCHEDULE OF CARES --}}
    @if ($initial->scheduleOfCares && $initial->scheduleOfCares->count())
        @foreach ($initial->scheduleOfCares as $index => $schedule)
            <div class="section">
                <div class="section-header">
                    PART D – SCHEDULE OF CARES{{ $initial->scheduleOfCares->count() > 1 ? ' (' . ($index + 1) . ')' : '' }}
                </div>
                <div class="section-body">
                    <table>
                        <tr>
                            <td>
                                <div class="field">
                                    <span class="label">Type of Service</span>
                                    <div class="value-box">{{ $schedule->type_of_service }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="field">
                                    <span class="label">Primary Task List</span>
                                    <div class="value-box">{{ $schedule->primary_task_list }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="field">
                                    <span class="label">Secondary Task List</span>
                                    <div class="value-box">{{ $schedule->secondary_task_list }}</div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach
    @endif

    {{-- PART E: CULTURAL BACKGROUND --}}
    @if ($initial->culturalBackground)
        <div class="section">
            <div class="section-header">PART E – CULTURAL BACKGROUND</div>
            <div class="section-body">
                <table>
                    <tr>
                        <td>
                            <div class="field">
                                <span class="label">Has Children Under 18</span>
                                <div class="value-box">{{ $initial->culturalBackground->has_children_under_18 ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Country of Birth</span>
                                <div class="value-box">{{ $initial->culturalBackground->country_of_birth }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Preferred Language</span>
                                <div class="value-box">{{ $initial->culturalBackground->preferred_language }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Religion</span>
                                <div class="value-box">{{ $initial->culturalBackground->religion }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="field">
                                <span class="label">Other Languages</span>
                                <div class="value-box">{{ $initial->culturalBackground->other_languages }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Cultural Needs</span>
                                <div class="value-box">{{ $initial->culturalBackground->cultural_needs }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Interpreter Required</span>
                                <div class="value-box">{{ $initial->culturalBackground->interpreter_required ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="field">
                                <span class="label">AUSLAN Required</span>
                                <div class="value-box">{{ $initial->culturalBackground->auslan_required ? 'Yes' : 'No' }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif

    {{-- PART F: NDIS GOALS --}}
    @if ($initial->ndisGoals && $initial->ndisGoals->count())
        <div class="section">
            <div class="section-header">PART F – NDIS GOALS</div>
            <div class="section-body">
                @foreach ($initial->ndisGoals as $index => $goal)
                    <div class="field">
                        <span class="label">Goal {{ $index + 1 }}</span>
                        <div class="value-box">{{ $goal->goal_description }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- PART G: HEALTH PROFESSIONAL DETAILS --}}
    @if ($initial->healthProfessionalDetails && $initial->healthProfessionalDetails->count())
        <div class="section">
            <div class="section-header">PART G – HEALTH PROFESSIONAL DETAILS</div>
            <div class="section-body">
                @foreach ($initial->healthProfessionalDetails as $index => $prof)
                    <div class="field">
                        <span class="label">Professional {{ $index + 1 }} - Role</span>
                        <div class="value-box">{{ $prof->role }}</div>
                    </div>
                    <div class="field">
                        <span class="label">Name</span>
                        <div class="value-box">{{ $prof->name }}</div>
                    </div>
                    <div class="field">
                        <span class="label">Contact Number</span>
                        <div class="value-box">{{ $prof->contact_number }}</div>
                    </div>
                    @if (!$loop->last)
                        <hr style="border: none; border-top: 1px dashed #ccc; margin: 20px 0;">
                    @endif
                @endforeach
            </div>
        </div>
    @endif

   {{-- PART H: DIAGNOSIS SUMMARY --}}
    @if ($initial->diagnosisSummary)
        <div class="section">
            <div class="section-header">PART H – DIAGNOSIS SUMMARY</div>
            <div class="section-body">
                <div class="field">
                    <span class="label">Primary Diagnosis</span>
                    <div class="value-box">{{ $initial->diagnosisSummary->primary_diagnosis }}</div>
                </div>
                <div class="field">
                    <span class="label">Secondary Diagnosis</span>
                    <div class="value-box">{{ $initial->diagnosisSummary->secondary_diagnosis }}</div>
                </div>
            </div>
        </div>
    @endif

    {{-- PART I: HEALTH INFORMATION --}}
@if ($initial->healthInformation)
    <div class="section">
        <div class="section-header">PART I – HEALTH INFORMATION</div>
        <div class="section-body">
            <div class="field">
                <span class="label">Health Conditions</span>
                <div class="value-box">
                    {{ is_array($initial->healthInformation->health_conditions)
                        ? implode(', ', $initial->healthInformation->health_conditions)
                        : $initial->healthInformation->health_conditions }}
                </div>
            </div>
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
                            <div class="field">
                                <span class="label">Medicare</span>
                                <div class="value-box">{{ $initial->healthcareSupportDetail->medicare }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Health Fund</span>
                                <div class="value-box">{{ $initial->healthcareSupportDetail->health_fund }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Pension Card Number</span>
                                <div class="value-box">{{ $initial->healthcareSupportDetail->pension_card_number }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Health Care Card</span>
                                <div class="value-box">{{ $initial->healthcareSupportDetail->health_care_card }}</div>
                            </div>
                            <div class="field">
                                <span class="label">DVA Type</span>
                                <div class="value-box">{{ $initial->healthcareSupportDetail->dva_type }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="field">
                                <span class="label">DVA Number</span>
                                <div class="value-box">{{ $initial->healthcareSupportDetail->dva_number }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Companion Card</span>
                                <div class="value-box">{{ $initial->healthcareSupportDetail->companion_card }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Preferred Hospital</span>
                                <div class="value-box">{{ $initial->healthcareSupportDetail->preferred_hospital }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Ambulance Number</span>
                                <div class="value-box">{{ $initial->healthcareSupportDetail->ambulance_number }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Disabled Parking</span>
                                <div class="value-box">{{ $initial->healthcareSupportDetail->disabled_parking }}</div>
                            </div>
                        </td>
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
                            <div class="field">
                                <span class="label">Has Behaviour Support Plan</span>
                                <div class="value-box">
                                    {{ $initial->behaviourSupport->has_support_plan == 1 ? 'Yes' : 'No' }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="field">
                                <span class="label">Plan Copy Received</span>
                                <div class="value-box">
                                    {{ $initial->behaviourSupport->plan_copy_received == 1 ? 'Yes' : 'No' }}
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif

    {{-- PART L – MEDICAL ALERT --}}
    @if ($initial->medicalAlert)
        <div class="section">
            <div class="section-header">PART L – MEDICAL ALERT</div>
            <div class="section-body">
                <table>
                    <tr>
                        <td>
                            <div class="field">
                                <span class="label">Has Epilepsy</span>
                                <div class="value-box">{{ $initial->medicalAlert->has_epilepsy ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Has Asthma</span>
                                <div class="value-box">{{ $initial->medicalAlert->has_asthma ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Has Diabetes</span>
                                <div class="value-box">{{ $initial->medicalAlert->has_diabetes ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Allergies</span>
                                <div class="value-box">{{ $initial->medicalAlert->allergies }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Medical Info</span>
                                <div class="value-box">{{ $initial->medicalAlert->medical_info }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Diagnosis</span>
                                <div class="value-box">{{ $initial->medicalAlert->diagnosis }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="field">
                                <span class="label">Other Description</span>
                                <div class="value-box">{{ $initial->medicalAlert->other_description }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Medication Taken</span>
                                <div class="value-box">{{ $initial->medicalAlert->medication_taken }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Medication Purpose</span>
                                <div class="value-box">{{ $initial->medicalAlert->medication_purpose }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Staff Administers Medication</span>
                                <div class="value-box">{{ $initial->medicalAlert->staff_administer_medication ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Self Administered</span>
                                <div class="value-box">{{ $initial->medicalAlert->self_administered ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Guardian</span>
                                <div class="value-box">{{ $initial->medicalAlert->guardian }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Support Worker</span>
                                <div class="value-box">{{ $initial->medicalAlert->support_worker }}</div>
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
            <div class="section-header">PART M – PREVENTIVE HEALTH SUMMARY</div>
            <div class="section-body">
                <table>
                    <tr>
                        <td>
                            <div class="field">
                                <span class="label">Medical Check-Up Status</span>
                                <div class="value-box">{{ $initial->preventiveHealthSummary->medical_checkup_status }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Last Dental Check</span>
                                <div class="value-box">{{ $initial->preventiveHealthSummary->last_dental_check }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Last Hearing Check</span>
                                <div class="value-box">{{ $initial->preventiveHealthSummary->last_hearing_check }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="field">
                                <span class="label">Last Vision Check</span>
                                <div class="value-box">{{ $initial->preventiveHealthSummary->last_vision_check }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Requires Vaccination Assistance</span>
                                <div class="value-box">{{ $initial->preventiveHealthSummary->requires_vaccination_assistance ? 'Yes' : 'No' }}</div>
                            </div>
                        </td>
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
                            <div class="field">
                                <span class="label">Communication Assistance Required</span>
                                <div class="value-box">{{ $initial->supportInformation->communication_assistance_required ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Mealtime Plan</span>
                                <div class="value-box">{{ $initial->supportInformation->mealtime_plan }}</div>
                            </div>
                            <div class="field">
                                <span class="label">Likes</span>
                                <div class="value-box">
                                    {{ is_array($initial->supportInformation->likes)
                                        ? implode(', ', $initial->supportInformation->likes)
                                        : $initial->supportInformation->likes }}
                                </div>
                            </div>
                            <div class="field">
                                <span class="label">Dislikes</span>
                                <div class="value-box">
                                    {{ is_array($initial->supportInformation->dislikes)
                                        ? implode(', ', $initial->supportInformation->dislikes)
                                        : $initial->supportInformation->dislikes }}
                                </div>
                            </div>
                            <div class="field">
                                <span class="label">Interests</span>
                                <div class="value-box">
                                    {{ is_array($initial->supportInformation->interests)
                                        ? implode(', ', $initial->supportInformation->interests)
                                        : $initial->supportInformation->interests }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="field">
                                <span class="label">Preferred Worker</span>
                                <div class="value-box">
                                    {{ $initial->supportInformation->male ? 'Male ' : '' }}
                                    {{ $initial->supportInformation->female ? 'Female ' : '' }}
                                    {{ $initial->supportInformation->no_preference ? 'No Preference' : '' }}
                                </div>
                            </div>
                            <div class="field">
                                <span class="label">Special Request</span>
                                <div class="value-box">{{ $initial->supportInformation->special_request }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif
</div>
</body>
</html>
