<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Individual Risk Assessment - BHC</title>
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
            margin-top: 5px;
        }
        .document-number span {
            color: #4f46e5;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-header {
            counter-increment: section;
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 10px 15px;
            font-weight: bold;
            border-left: 4px solid #0284c7;
            margin-bottom: 10px;
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
            break-before: page;
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
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <div class="header-title">Form-F5a Individual Risk Assessment</div>
    </div>

    <table style="width: 100%;   border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td colspan="3" style="padding-top: 10px; font-weight: bold; text-align: center;">
                <strong>HOW TO USE THIS FORM</strong>
            </td>
        </tr>

        <tr>
            <td colspan="3" style="padding-top: 10px;">
                You are to ensure onsite completion of the Home Safety Check prior to the commencement of service delivery. 
                Only complete those areas related to the services to be provided and ensure you address potential risks 
                with the Participant and put in place risk controls. This safety checklist is to be completed each time 
                changes to the supports or their delivery are required, and/or any changes made to the Participant’s 
                Service Agreement and/or Support care plan.
            </td>
        </tr>
    </table>

    <!-- Client Details -->
    <div class="section">
    <div class="section-header">Assessment Client Details</div>
    <table>
        <tr>
            <td>
                <span class="label">Client Name</span>
                <span class="value">{{ $assessment->client_name ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Site Address</span>
                <span class="value">{{ $assessment->site_address ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Date of Assessment</span>
                <span class="value">
                    {{ $assessment->assessment_date ? \Carbon\Carbon::parse($assessment->assessment_date)->format('d/m/Y') : 'N/A' }}
                </span>
            </td>
            <td>
                <span class="label">Planned Review Date</span>
                <span class="value">
                    {{ $assessment->planned_review_date ? \Carbon\Carbon::parse($assessment->planned_review_date)->format('d/m/Y') : 'N/A' }}
                </span>
            </td>
        </tr>
    </table>
</div>


   
    <!-- Details -->
<div class="section">
    <div class="section-header">Vulnerability Details</div>
    <table>
        <tr>
            <td>
                <span class="label">Vulnerability</span>
                <div class="enum-field">
                    @foreach(['high' => 'High', 'medium' => 'Medium', 'low' => 'Low'] as $value => $label)
                        <span class="enum-option {{ ($assessment->details->vulnerability ?? '') === $value ? 'selected' : '' }}">
                            {{ $label }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Review Frequency</span>
                <div class="enum-field">
                    @foreach(['3_months' => '3 Months', '6_months' => '6 Months', '12_months' => '12 Months'] as $value => $label)
                        <span class="enum-option {{ ($assessment->details->review_frequency ?? '') === $value ? 'selected' : '' }}">
                            {{ $label }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Dependent on Homecare</span>
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


    <!-- Communications -->
 @if($assessment->communications)
<div class="section">
    <div class="section-header">Assessment Communications</div>
    <table>
        <tr>
            <td>
                <span class="label">Does The participant have Hearing impairment</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->communications->hearing_impairment ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->communications->hearing_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->communications->hearing_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Does The participant have Speech impairment</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->communications->speech_impairment ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->communications->speech_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->communications->speech_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif

   @if($assessment->cognitions)
<div class="section">
    <div class="section-header">Assessment Cognition</div>
    <table>
        <tr>
            <td>
                <span class="label">Is the Participant Oriented in time and place</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->cognitions->oriented_in_time_place ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->cognitions->oriented_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->cognitions->oriented_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Client able to accept direction and instruction</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->cognitions->accepts_direction ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->cognitions->direction_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->cognitions->direction_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Does The participant experience Short-term memory issues</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->cognitions->short_term_memory_issues ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->cognitions->memory_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->cognitions->memory_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif

<div style="page-break-before: always;"></div>


    <!-- Mobility -->
   @if($assessment->mobilities)
<div class="section">
    <div class="section-header">Assessment Mobility</div>

    <table>
        <tr>
            <td>
                <span class="label">Walk Unaided</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->mobilities->walk_unaided ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->walk_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->walk_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Accessibility Required</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->mobilities->accessibility_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->accessibility_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->accessibility_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Manages Stairs</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->mobilities->manages_stairs ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->stairs_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->stairs_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Uses Walking Aid</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->mobilities->uses_walking_aid ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->walking_aid_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->walking_aid_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Uses electric wheelchair/ scooter</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->mobilities->uses_wheelchair ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->wheelchair_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->wheelchair_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Bed Transfer</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->mobilities->bed_transfer ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->bed_transfer_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->bed_transfer_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Vehicle Transfer</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->mobilities->vehicle_transfer ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->vehicle_transfer_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->vehicle_transfer_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Toilet Transfer</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->mobilities->toilet_transfer ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->toilet_transfer_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->toilet_transfer_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

    </table>
</div>
@endif


   <!-- Personal Care & Support -->
@if($assessment->personalCareSupport)
<div class="section">
    <div class="section-header">Assessment Personal Care & Support</div>
    <table>
        <tr>
            <td>
                <span class="label">Does the participant require assistance with showering?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->personalCareSupport->showering ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards identified:</span>
                <span class="value">{{ $assessment->personalCareSupport->showering_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan:</span>
                <span class="value">{{ $assessment->personalCareSupport->showering_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Does the participant require assistance with meal?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->personalCareSupport->meal ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards identified:</span>
                <span class="value">{{ $assessment->personalCareSupport->meal_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan:</span>
                <span class="value">{{ $assessment->personalCareSupport->meal_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Does the participant require assistance with Toileting?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->personalCareSupport->toileting ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards identified:</span>
                <span class="value">{{ $assessment->personalCareSupport->toileting_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan:</span>
                <span class="value">{{ $assessment->personalCareSupport->toileting_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Does the participant require assistance with Grooming?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->personalCareSupport->grooming ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards identified:</span>
                <span class="value">{{ $assessment->personalCareSupport->grooming_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan:</span>
                <span class="value">{{ $assessment->personalCareSupport->grooming_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Does the participant require assistance with Repositioning in bed?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->personalCareSupport->repositioning_bed ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards identified:</span>
                <span class="value">{{ $assessment->personalCareSupport->repositioning_bed_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan:</span>
                <span class="value">{{ $assessment->personalCareSupport->repositioning_bed_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Does the participant require assistance with Repositioning in chair?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->personalCareSupport->repositioning_chair ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards identified:</span>
                <span class="value">{{ $assessment->personalCareSupport->repositioning_chair_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan:</span>
                <span class="value">{{ $assessment->personalCareSupport->repositioning_chair_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Does the participant require assistance with Mouthcare?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->personalCareSupport->mouthcare ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards identified:</span>
                <span class="value">{{ $assessment->personalCareSupport->mouthcare_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan:</span>
                <span class="value">{{ $assessment->personalCareSupport->mouthcare_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Does the participant require assistance with Skin care?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->personalCareSupport->skin_care ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hazards identified:</span>
                <span class="value">{{ $assessment->personalCareSupport->skin_care_hazards ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Management Plan:</span>
                <span class="value">{{ $assessment->personalCareSupport->skin_care_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>

    </table>
</div>
@endif




    <!-- Manual Handling -->
<div class="section">
    <div class="section-header">Assessment Plan - Manual Handling</div>
    <table>
        @php
            $manualHandlings = $assessment->manualHandlings ?? collect();
        @endphp

        @if($manualHandlings->isNotEmpty())
            @foreach($manualHandlings as $mh)
                <tr>
                    <td>
                        <span class="label">Has training been provided to support staff for specific client handling techniques?</span>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($mh->training_provided ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <span class="label">Hazards</span>
                        <span class="value">{{ $mh->training_hazards ?? 'N/A' }}</span>
                    </td>
                    <td>
                        <span class="label">Management Plan</span>
                        <span class="value">{{ $mh->training_management_plan ?? 'N/A' }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Can all manual handling tasks be undertaken safely with current staff and equipment?</span>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($mh->tasks_safe ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <span class="label">Hazards</span>
                        <span class="value">{{ $mh->tasks_hazards ?? 'N/A' }}</span>
                    </td>
                    <td>
                        <span class="label">Management Plan</span>
                        <span class="value">{{ $mh->tasks_management_plan ?? 'N/A' }}</span>
                    </td>
                </tr>
            @endforeach
        @else
            {{-- ✅ No data: show one empty row --}}
            <tr>
                <td>
                    <span class="label">Has training been provided to support staff for specific client handling techniques?	☐ Yes  ☐ No</span>
                    <div class="enum-field">
                        <span class="enum-option">Yes</span>
                        <span class="enum-option">No</span>
                    </div>
                </td>
                <td><span class="label">Hazards</span> <span class="value">N/A</span></td>
                <td><span class="label">Management Plan</span> <span class="value">N/A</span></td>
            </tr>
            <tr>
                <td>
                    <span class="label">Can all manual handling tasks be undertaken safely with current staff and equipment?
</span>
                    <div class="enum-field">
                        <span class="enum-option">Yes</span>
                        <span class="enum-option">No</span>
                    </div>
                </td>
                <td><span class="label">Hazards</span> <span class="value">N/A</span></td>
                <td><span class="label">Management Plan</span> <span class="value">N/A</span></td>
            </tr>
        @endif
    </table>
</div>




  @if($assessment->violenceRisk)
<div class="section">
    <div class="section-header">Violence & Other Risks</div>
    <table>
        @php
            $vr = $assessment->violenceRisk;
        @endphp
        <tr>
            <td>
                <span class="label">Is there a history of physical aggression toward staff by the client?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($vr->physical_aggression ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td><span class="label">Hazards identified:</span><span class="value">{{ $vr->physical_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan:</span><span class="value">{{ $vr->physical_management_plan ?? 'N/A' }}</span></td>
            <td>
                <span class="label">Is there a BSP plan:</span>
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
            <td>
                <span class="label">Is there a history of verbal aggression toward staff by the client?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($vr->verbal_aggression ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td><span class="label">Hazards identified:</span><span class="value">{{ $vr->verbal_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan:</span><span class="value">{{ $vr->verbal_management_plan ?? 'N/A' }}</span></td>
            <td>
                <span class="label">Is there a BSP plan:</span>
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
            <td>
                <span class="label">Is there a history of aggression towards other clients?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($vr->client_aggression ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td><span class="label">Hazards identified:</span><span class="value">{{ $vr->client_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan:</span><span class="value">{{ $vr->client_management_plan ?? 'N/A' }}</span></td>
            <td>
                <span class="label">Is there a BSP plan:</span>
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
            <td>
                <span class="label">Is there a history of self harm?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($vr->self_harm ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td><span class="label">Hazards identified:</span><span class="value">{{ $vr->self_harm_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan:</span><span class="value">{{ $vr->self_harm_management_plan ?? 'N/A' }}</span></td>
            <td>
                <span class="label">Is there a BSP plan:</span>
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
            <td>
                <span class="label">Does the participant engage in drug or alcohol use?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($vr->drug_alcohol_use ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td><span class="label">Hazards identified:</span><span class="value">{{ $vr->drug_alcohol_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan:</span><span class="value">{{ $vr->drug_alcohol_management_plan ?? 'N/A' }}</span></td>
            <td>
                <span class="label">Is there a BSP plan:</span>
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
            <td>
                <span class="label">Is there a history of sexual abuse?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($vr->sexual_abuse_history ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td><span class="label">Hazards identified:</span><span class="value">{{ $vr->sexual_abuse_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan:</span><span class="value">{{ $vr->sexual_abuse_management_plan ?? 'N/A' }}</span></td>
            <td>
                <span class="label">Is there a BSP plan:</span>
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
            <td>
                <span class="label">Use of emotions to achieve goals?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($vr->emotional_manipulation ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td><span class="label">Hazards identified:</span><span class="value">{{ $vr->emotional_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan:</span><span class="value">{{ $vr->emotional_management_plan ?? 'N/A' }}</span></td>
            <td>
                <span class="label">Is there a BSP plan:</span>
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
            <td>
                <span class="label">Other known risks?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($vr->other_known_risks ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td><span class="label">Hazards identified:</span><span class="value">{{ $vr->other_risks_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan:</span><span class="value">{{ $vr->other_risks_management_plan ?? 'N/A' }}</span></td>
            <td>
                <span class="label">Is there a BSP plan:</span>
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
            <td>
                <span class="label">Is the participant able to manage their finances safely and independently?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($vr->finance_management ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td><span class="label">Hazards identified:</span><span class="value">{{ $vr->finance_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan:</span><span class="value">{{ $vr->finance_management_plan ?? 'N/A' }}</span></td>
            <td>
                <span class="label">Is there a BSP plan:</span>
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

</body>
</html>
