<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Support Care Plan - BHC</title>
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
        <div class="header-title">Support Care Plan</div>
        <div class="document-number">Document Number: <span>Form SCP-{{ $supportCarePlan->id }}</span></div>
    </div>

    <!-- Participant Details -->
    <div class="section">
        <div class="section-header">Participant Details</div>
        <table>
            <tr>
                <td>
                    <span class="label">First Name</span>
                    <span class="value">{{ $supportCarePlan->consents_participant_first_name ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Surname</span>
                    <span class="value">{{ $supportCarePlan->consents_participant_surname ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Date of Birth</span>
                    <span class="value">{{ $supportCarePlan->consents_participant_dob ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Start Date</span>
                    <span class="value">{{ $supportCarePlan->consents_goal_plan_start_date ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Review Date</span>
                    <span class="value">{{ $supportCarePlan->consents_goal_plan_review_date ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Alternate Decision Maker -->
    @if($supportCarePlan->alternateDecisionMaker)
    <div class="section">
        <div class="section-header">Alternate Decision Maker</div>
        <table>
            <tr>
                <td><span class="label">Type</span> <span class="value">{{ $supportCarePlan->alternateDecisionMaker->type ?? 'N/A' }}</span></td>
                <td><span class="label">First Name</span> <span class="value">{{ $supportCarePlan->alternateDecisionMaker->first_name ?? 'N/A' }}</span></td>
                <td><span class="label">Surname</span> <span class="value">{{ $supportCarePlan->alternateDecisionMaker->surname ?? 'N/A' }}</span></td>
            </tr>
            <tr>
                <td colspan="3"><span class="label">Notes</span> <span class="value">{{ $supportCarePlan->alternateDecisionMaker->notes ?? 'N/A' }}</span></td>
            </tr>
        </table>
    </div>
    @endif

    <!-- SIL Goals -->
    @if($supportCarePlan->silGoals->count())
    <div class="section">
        <div class="section-header">SIL Goals</div>
        <table>
            @foreach($supportCarePlan->silGoals as $goal)
            <tr>
                <td><span class="label">Goal Title</span> <span class="value">{{ $goal->goal_title }}</span></td>
                <td><span class="label">Goals of Support</span> <span class="value">{{ $goal->goals_of_support }}</span></td>
            </tr>
            <tr>
                <td><span class="label">Steps</span> <span class="value">{{ $goal->steps }}</span></td>
                <td><span class="label">Organisation Steps</span> <span class="value">{{ $goal->organisation_steps }}</span></td>
            </tr>
            <tr>
                <td><span class="label">Risk</span> <span class="value">{{ $goal->risk }}</span></td>
                <td><span class="label">Risk Strategies</span> <span class="value">{{ $goal->risk_management_strategies }}</span></td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif

    <!-- Communication Plans -->
@if($supportCarePlan->communicationPlans->count())
<div class="section">
    <div class="section-header">Communication Plan</div>

    <table>
        @foreach($supportCarePlan->communicationPlans as $communication)
            <tr>
                <td>
                    <span class="label">Helps me talk</span>
                    <span class="value">
                        {{ implode(', ', json_decode($communication->helps_me_talk ?? '[]', true)) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Helps me understand</span>
                    <span class="value">
                        {{ implode(', ', json_decode($communication->helps_me_understand ?? '[]', true)) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Emergency Communication</span>
                    <span class="value">{{ $communication->emergency_communication ?? 'N/A' }}</span>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endif




    <!-- Emergency Disaster Plan -->
    @if($supportCarePlan->emergencyDisasterPlan)
    <div class="section">
        <div class="section-header">Emergency & Disaster Plan</div>
        <table>
            <tr>
                <td><span class="label">Participant Name</span> <span class="value">{{ $supportCarePlan->emergencyDisasterPlan->participant_name }}</span></td>
                <td><span class="label">Date</span> <span class="value">{{ $supportCarePlan->emergencyDisasterPlan->date }}</span></td>
                <td><span class="label">Review Date</span> <span class="value">{{ $supportCarePlan->emergencyDisasterPlan->review_date }}</span></td>
            </tr>
        </table>
    </div>
    @endif

    <!-- Emergency Contacts -->
    @if($supportCarePlan->emergencyContacts->count())
    <div class="section">
        <div class="section-header">Emergency Contacts</div>
        <table>
            @foreach($supportCarePlan->emergencyContacts as $contact)
            <tr>
                <td><span class="label">Name</span> <span class="value">{{ $contact->name }}</span></td>
                <td><span class="label">Relationship</span> <span class="value">{{ $contact->relationship }}</span></td>
                <td><span class="label">Phone</span> <span class="value">{{ $contact->phone }}</span></td>
                <td><span class="label">Email</span> <span class="value">{{ $contact->email }}</span></td>
                <td><span class="label">Location</span> <span class="value">{{ $contact->location }}</span></td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif

    <!-- Important Contacts -->
    @if($supportCarePlan->importantContacts) <div class="section">
        <div class="section-header">Important Contacts / Services</div>
         <table> <tr><td><span class="label">Advocate</span>
            <span class="value">{{ $supportCarePlan->importantContacts->advocate }}</span></td></tr> <tr><td><span class="label">Childcare / School</span> <span class="value">{{ $supportCarePlan->importantContacts->childcare_school_contact }}</span></td></tr> <tr><td><span class="label">Power of Attorney</span> <span class="value">{{ $supportCarePlan->importantContacts->power_of_attorney_guardian }}</span></td></tr> <tr><td><span class="label">Workplace / Volunteer</span> <span class="value">{{ $supportCarePlan->importantContacts->workplace_volunteer_contact }}</span></td></tr> <tr><td><span class="label">Landlord / SDA Provider</span> <span class="value">{{ $supportCarePlan->importantContacts->landlord_sda_provider }}</span></td></tr> <tr><td><span class="label">Doctor</span> <span class="value">{{ $supportCarePlan->importantContacts->doctor }}</span></td></tr> <tr><td><span class="label">Specialist Practitioner</span> <span class="value">{{ $supportCarePlan->importantContacts->specialist_practitioner }}</span></td></tr> <tr><td><span class="label">Solicitor</span> <span class="value">{{ $supportCarePlan->importantContacts->solicitor }}</span></td></tr> <tr><td><span class="label">Insurer (Home/Contents)</span> <span class="value">{{ $supportCarePlan->importantContacts->insurer_home_contents }}</span></td></tr> <tr><td><span class="label">Private Health Cover</span> <span class="value">{{ $supportCarePlan->importantContacts->private_health_cover }}</span></td></tr> <tr><td><span class="label">Insurer (Vehicle)</span> <span class="value">{{ $supportCarePlan->importantContacts->insurer_vehicle }}</span></td></tr> </table> </div> @endif


    <!-- Local Services Contact -->
    @if($supportCarePlan->localServicesContact)
    <div class="section">
        <div class="section-header">Local Services - Contact</div>
        <table>
            <tr><td><span class="label">Council</span> <span class="value">{{ $supportCarePlan->localServicesContact->council }}</span></td></tr>
            <tr><td><span class="label">Hospital</span> <span class="value">{{ $supportCarePlan->localServicesContact->hospital }}</span></td></tr>
            <tr><td><span class="label">Electricity</span> <span class="value">{{ $supportCarePlan->localServicesContact->electricity }}</span></td></tr>
            <tr><td><span class="label">Water</span> <span class="value">{{ $supportCarePlan->localServicesContact->water }}</span></td></tr>
        </table>
    </div>
    @endif

    <!-- Emergency Scenarios -->
    @if($supportCarePlan->emergencyScenario)
    <div class="section">
        <div class="section-header">Emergency Scenarios and Support Actions</div>
        <table>
            <tr>
                <td><span class="label">Admitted to Hospital</span> <span class="value">{{ $supportCarePlan->emergencyScenario->admitted_to_hospital ? 'Yes' : 'No' }}</span></td>
                <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->admitted_to_hospital_action }}</span></td>
            </tr>
            <tr>
                <td><span class="label">Medical Emergencies</span> <span class="value">{{ $supportCarePlan->emergencyScenario->medical_emergencies ? 'Yes' : 'No' }}</span></td>
                <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->medical_emergencies_action }}</span></td>
            </tr>
            <tr>
                <td><span class="label">Other Likely Medical Emergency</span> <span class="value">{{ $supportCarePlan->emergencyScenario->other_likely_medical_emergency ? 'Yes' : 'No' }}</span></td>
                <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->other_likely_medical_emergency_action }}</span></td>
            </tr>
            <tr>
                <td><span class="label">Natural Disaster</span> <span class="value">{{ $supportCarePlan->emergencyScenario->natural_disaster ? 'Yes' : 'No' }}</span></td>
                <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->natural_disaster_action }}</span></td>
            </tr>
        </table>
    </div>
    @endif

</div>

</body>
</html>
