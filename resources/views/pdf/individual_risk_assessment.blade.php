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
    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <div class="header-title">Form-F5a Individual Risk Assessment</div>
        <div class="document-number">Document Number: <span>IRA-{{ $assessment->id }}</span></div>
    </div>

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
    <!-- Details -->
<div class="section">
    <div class="section-header">Risk Assessment Details</div>
    <table>
        <tr>
            <td>
                <span class="label">Vulnerability</span>
                <span class="value">{{ $assessment->details->vulnerability ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Review Frequency</span>
                <span class="value">{{ $assessment->details->review_frequency ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Dependent on Homecare</span>
                <span class="value">{{ $assessment->details->dependent_on_homecare ? 'Yes' : 'No' }}</span>
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
            <td><span class="label">Hearing Impairment</span>
                <span class="value">
                    {{ $assessment->communications->hearing_impairment ? 'Yes' : 'No' }}
                </span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->communications->hearing_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->communications->hearing_management_plan ?? 'N/A' }}</span>
            </td>

        </tr>
        <tr>
            <td><span class="label">Speech Impairment</span>
                <span class="value">
                    {{ $assessment->communications->speech_impairment ? 'Yes' : 'No' }}
                </span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->communications->speech_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
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
            <td><span class="label">Oriented in Time/Place</span>
                <span class="value">{{ $assessment->cognitions->oriented_in_time_place ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->cognitions->oriented_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->cognitions->oriented_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Accepts Direction</span>
                <span class="value">{{ $assessment->cognitions->accepts_direction ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->cognitions->direction_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->cognitions->direction_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Short Term Memory Issues</span>
                <span class="value">{{ $assessment->cognitions->short_term_memory_issues ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->cognitions->memory_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->cognitions->memory_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif



    <!-- Mobility -->
    @if($assessment->mobilities)
<div class="section">
    <div class="section-header">Assessment Mobility</div>
    <table>
        <tr>
            <td><span class="label">Walk Unaided</span>
                <span class="value">{{ $assessment->mobilities->walk_unaided ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Accessibility Required</span>
                <span class="value">{{ $assessment->mobilities->accessibility_required ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->walk_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->walk_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Manages Stairs</span>
                <span class="value">{{ $assessment->mobilities->manages_stairs ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->stairs_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->stairs_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Uses Walking Aid</span>
                <span class="value">{{ $assessment->mobilities->uses_walking_aid ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->walking_aid_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->walking_aid_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Uses Wheelchair</span>
                <span class="value">{{ $assessment->mobilities->uses_wheelchair ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->wheelchair_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->wheelchair_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Bed Transfer</span>
                <span class="value">{{ $assessment->mobilities->bed_transfer ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->bed_transfer_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->bed_transfer_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Vehicle Transfer</span>
                <span class="value">{{ $assessment->mobilities->vehicle_transfer ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->vehicle_transfer_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->mobilities->vehicle_transfer_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Toilet Transfer</span>
                <span class="value">{{ $assessment->mobilities->toilet_transfer ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->mobilities->toilet_transfer_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
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
            <td><span class="label">Showering</span>
                <span class="value">{{ $assessment->personalCareSupport->showering ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->personalCareSupport->showering_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->personalCareSupport->showering_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Meal</span>
                <span class="value">{{ $assessment->personalCareSupport->meal ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->personalCareSupport->meal_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->personalCareSupport->meal_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Toileting</span>
                <span class="value">{{ $assessment->personalCareSupport->toileting ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->personalCareSupport->toileting_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->personalCareSupport->toileting_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Grooming</span>
                <span class="value">{{ $assessment->personalCareSupport->grooming ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->personalCareSupport->grooming_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->personalCareSupport->grooming_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Repositioning (Bed)</span>
                <span class="value">{{ $assessment->personalCareSupport->repositioning_bed ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->personalCareSupport->repositioning_bed_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->personalCareSupport->repositioning_bed_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Repositioning (Chair)</span>
                <span class="value">{{ $assessment->personalCareSupport->repositioning_chair ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->personalCareSupport->repositioning_chair_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->personalCareSupport->repositioning_chair_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Mouthcare</span>
                <span class="value">{{ $assessment->personalCareSupport->mouthcare ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->personalCareSupport->mouthcare_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
                <span class="value">{{ $assessment->personalCareSupport->mouthcare_management_plan ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Skin Care</span>
                <span class="value">{{ $assessment->personalCareSupport->skin_care ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">Hazards</span>
                <span class="value">{{ $assessment->personalCareSupport->skin_care_hazards ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Management Plan</span>
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
                        <span class="label">Training Provided</span>
                        <span class="value">
                            {{ $mh->training_provided ? 'Yes' : 'No' }}
                        </span>
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
                        <span class="label">Tasks Safe</span>
                        <span class="value">
                            {{ $mh->tasks_safe ? 'Yes' : 'No' }}
                        </span>
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
                <td><span class="label">Training Provided</span> <span class="value">N/A</span></td>
                <td><span class="label">Hazards</span> <span class="value">N/A</span></td>
                <td><span class="label">Management Plan</span> <span class="value">N/A</span></td>
            </tr>
            <tr>
                <td><span class="label">Tasks Safe</span> <span class="value">N/A</span></td>
                <td><span class="label">Hazards</span> <span class="value">N/A</span></td>
                <td><span class="label">Management Plan</span> <span class="value">N/A</span></td>
            </tr>
        @endif
    </table>
</div>


<div style="page-break-before: always;"></div>


  @if($assessment->violenceRisk)
<div class="section">
    <div class="section-header">Violence & Other Risks</div>
    <table>
        @php
            $vr = $assessment->violenceRisk;
        @endphp
        <tr>
            <td><span class="label">Physical Aggression</span><span class="value">{{ $vr->physical_aggression ? 'Yes' : 'No' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $vr->physical_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $vr->physical_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $vr->physical_bsp_plan ? 'Yes' : 'No' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Verbal Aggression</span><span class="value">{{ $vr->verbal_aggression ? 'Yes' : 'No' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $vr->verbal_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $vr->verbal_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $vr->verbal_bsp_plan ? 'Yes' : 'No' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Client Aggression</span><span class="value">{{ $vr->client_aggression ? 'Yes' : 'No' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $vr->client_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $vr->client_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $vr->client_bsp_plan ? 'Yes' : 'No' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Self Harm</span><span class="value">{{ $vr->self_harm ? 'Yes' : 'No' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $vr->self_harm_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $vr->self_harm_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $vr->self_harm_bsp_plan ? 'Yes' : 'No' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Drug & Alcohol Use</span><span class="value">{{ $vr->drug_alcohol_use ? 'Yes' : 'No' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $vr->drug_alcohol_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $vr->drug_alcohol_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $vr->drug_alcohol_bsp_plan ? 'Yes' : 'No' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Sexual Abuse History</span><span class="value">{{ $vr->sexual_abuse_history ? 'Yes' : 'No' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $vr->sexual_abuse_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $vr->sexual_abuse_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $vr->sexual_abuse_bsp_plan ? 'Yes' : 'No' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Emotional Manipulation</span><span class="value">{{ $vr->emotional_manipulation ? 'Yes' : 'No' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $vr->emotional_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $vr->emotional_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $vr->emotional_bsp_plan ? 'Yes' : 'No' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Other Known Risks</span><span class="value">{{ $vr->other_known_risks ? 'Yes' : 'No' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $vr->other_risks_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $vr->other_risks_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $vr->other_risks_bsp_plan ? 'Yes' : 'No' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Finance Management</span><span class="value">{{ $vr->finance_management ? 'Yes' : 'No' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $vr->finance_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $vr->finance_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $vr->finance_bsp_plan ? 'Yes' : 'No' }}</span></td>
        </tr>
    </table>
</div>
@endif




</div>

</body>
</html>
