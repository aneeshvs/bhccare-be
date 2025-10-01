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
            break-before: page;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <div class="header-title">Individual Risk Assessment</div>
        <div class="document-number">Document Number: <span>IRA-{{ $assessment->id }}</span></div>
    </div>

    <!-- Client Details -->
    <div class="section">
        <div class="section-header">Client Details</div>
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
                    <span class="value">{{ $assessment->assessment_date ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Planned Review Date</span>
                    <span class="value">{{ $assessment->planned_review_date ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Details -->
    <div class="section">
        <div class="section-header">Risk Assessment Details</div>
        <table>
            <tr>
                <td><span class="label">Vulnerability</span><span class="value">{{ $assessment->vulnerability ?? 'N/A' }}</span></td>
                <td><span class="label">Review Frequency</span><span class="value">{{ $assessment->review_frequency ?? 'N/A' }}</span></td>
                <td><span class="label">Dependent on Homecare</span><span class="value">{{ $assessment->dependent_on_homecare ?? 'N/A' }}</span></td>
            </tr>
        </table>
    </div>

    <!-- Communications -->
    <div class="section">
        <div class="section-header">Communications</div>
        <table>
            <tr>
                <td><span class="label">Hearing Impairment</span><span class="value">{{ $assessment->hearing_impairment ?? 'N/A' }}</span></td>
                <td><span class="label">Hazards</span><span class="value">{{ $assessment->hearing_hazards ?? 'N/A' }}</span></td>
                <td><span class="label">Management Plan</span><span class="value">{{ $assessment->hearing_management_plan ?? 'N/A' }}</span></td>
            </tr>
            <tr>
                <td><span class="label">Speech Impairment</span><span class="value">{{ $assessment->speech_impairment ?? 'N/A' }}</span></td>
                <td><span class="label">Hazards</span><span class="value">{{ $assessment->speech_hazards ?? 'N/A' }}</span></td>
                <td><span class="label">Management Plan</span><span class="value">{{ $assessment->speech_management_plan ?? 'N/A' }}</span></td>
            </tr>
        </table>
    </div>

    <!-- Cognition -->
    <div class="section">
        <div class="section-header">Cognition</div>
        <table>
            <tr>
                <td><span class="label">Oriented in Time/Place</span><span class="value">{{ $assessment->oriented_in_time_place ?? 'N/A' }}</span></td>
                <td><span class="label">Hazards</span><span class="value">{{ $assessment->oriented_hazards ?? 'N/A' }}</span></td>
                <td><span class="label">Management Plan</span><span class="value">{{ $assessment->oriented_management_plan ?? 'N/A' }}</span></td>
            </tr>
            <tr>
                <td><span class="label">Accepts Direction</span><span class="value">{{ $assessment->accepts_direction ?? 'N/A' }}</span></td>
                <td><span class="label">Hazards</span><span class="value">{{ $assessment->direction_hazards ?? 'N/A' }}</span></td>
                <td><span class="label">Management Plan</span><span class="value">{{ $assessment->direction_management_plan ?? 'N/A' }}</span></td>
            </tr>
            <tr>
                <td><span class="label">Short Term Memory Issues</span><span class="value">{{ $assessment->short_term_memory_issues ?? 'N/A' }}</span></td>
                <td><span class="label">Hazards</span><span class="value">{{ $assessment->memory_hazards ?? 'N/A' }}</span></td>
                <td><span class="label">Management Plan</span><span class="value">{{ $assessment->memory_management_plan ?? 'N/A' }}</span></td>
            </tr>
        </table>
    </div>

    <!-- Mobility -->
    <div class="section">
        <div class="section-header">Mobility</div>
        <table>
            <tr>
                <td><span class="label">Walk Unaided</span><span class="value">{{ $assessment->walk_unaided ?? 'N/A' }}</span></td>
                <td><span class="label">Accessibility Required</span><span class="value">{{ $assessment->accessibility_required ?? 'N/A' }}</span></td>
                <td><span class="label">Hazards</span><span class="value">{{ $assessment->walk_hazards ?? 'N/A' }}</span></td>
                <td><span class="label">Management Plan</span><span class="value">{{ $assessment->walk_management_plan ?? 'N/A' }}</span></td>
            </tr>
            <!-- add more rows for stairs, wheelchair, transfers etc. -->
        </table>
    </div>

    <!-- Personal Care & Support -->
    <div class="section">
    <div class="section-header">Personal Care & Support</div>
    <table>
        <tr>
            <td><span class="label">Showering</span><span class="value">{{ $assessment->showering ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->showering_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->showering_management_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Meal</span><span class="value">{{ $assessment->meal ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->meal_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->meal_management_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Toileting</span><span class="value">{{ $assessment->toileting ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->toileting_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->toileting_management_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Grooming</span><span class="value">{{ $assessment->grooming ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->grooming_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->grooming_management_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Repositioning (Bed)</span><span class="value">{{ $assessment->repositioning_bed ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->repositioning_bed_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->repositioning_bed_management_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Repositioning (Chair)</span><span class="value">{{ $assessment->repositioning_chair ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->repositioning_chair_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->repositioning_chair_management_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Mouthcare</span><span class="value">{{ $assessment->mouthcare ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->mouthcare_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->mouthcare_management_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Skin Care</span><span class="value">{{ $assessment->skin_care ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->skin_care_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->skin_care_management_plan ?? 'N/A' }}</span></td>
        </tr>
    </table>
</div>


    <!-- Manual Handling -->
    <div class="section">
        <div class="section-header">Manual Handling</div>
        <table>
            <tr>
                <td><span class="label">Training Provided</span><span class="value">{{ $assessment->training_provided ?? 'N/A' }}</span></td>
                <td><span class="label">Hazards</span><span class="value">{{ $assessment->training_hazards ?? 'N/A' }}</span></td>
                <td><span class="label">Management Plan</span><span class="value">{{ $assessment->training_management_plan ?? 'N/A' }}</span></td>
            </tr>
            <tr>
                <td><span class="label">Tasks Safe</span><span class="value">{{ $assessment->tasks_safe ?? 'N/A' }}</span></td>
                <td><span class="label">Hazards</span><span class="value">{{ $assessment->tasks_hazards ?? 'N/A' }}</span></td>
                <td><span class="label">Management Plan</span><span class="value">{{ $assessment->tasks_management_plan ?? 'N/A' }}</span></td>
            </tr>
        </table>
    </div>

    <!-- Violence Risk -->
    <div class="section">
    <div class="section-header">Violence & Other Risks</div>
    <table>
        <tr>
            <td><span class="label">Physical Aggression</span><span class="value">{{ $assessment->physical_aggression ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->physical_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->physical_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $assessment->physical_bsp_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Verbal Aggression</span><span class="value">{{ $assessment->verbal_aggression ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->verbal_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->verbal_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $assessment->verbal_bsp_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Client Aggression</span><span class="value">{{ $assessment->client_aggression ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->client_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->client_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $assessment->client_bsp_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Self Harm</span><span class="value">{{ $assessment->self_harm ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->self_harm_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->self_harm_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $assessment->self_harm_bsp_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Drug & Alcohol Use</span><span class="value">{{ $assessment->drug_alcohol_use ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->drug_alcohol_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->drug_alcohol_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $assessment->drug_alcohol_bsp_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Sexual Abuse History</span><span class="value">{{ $assessment->sexual_abuse_history ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->sexual_abuse_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->sexual_abuse_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $assessment->sexual_abuse_bsp_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Emotional Manipulation</span><span class="value">{{ $assessment->emotional_manipulation ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->emotional_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->emotional_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $assessment->emotional_bsp_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Other Known Risks</span><span class="value">{{ $assessment->other_known_risks ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->other_risks_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->other_risks_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $assessment->other_risks_bsp_plan ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Finance Management</span><span class="value">{{ $assessment->finance_management ?? 'N/A' }}</span></td>
            <td><span class="label">Hazards</span><span class="value">{{ $assessment->finance_hazards ?? 'N/A' }}</span></td>
            <td><span class="label">Management Plan</span><span class="value">{{ $assessment->finance_management_plan ?? 'N/A' }}</span></td>
            <td><span class="label">BSP Plan</span><span class="value">{{ $assessment->finance_bsp_plan ?? 'N/A' }}</span></td>
        </tr>
    </table>
</div>


</div>

</body>
</html>
