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
            color: #1e40af;
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
            color: #374151;
        }

        .value {
            margin-top: 2px;
            color: #6b7280;
        }

        .page-break {
            page-break-before: always;
            break-before: page;
        }

        .empty-field {
            color: #9ca3af;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <div class="header-title">Support Care Plan</div>
        <div class="document-number">Document Number: <span>Form SCP-{{ $supportCarePlan->id ?? 'N/A' }}</span></div>
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
                    <span class="value">
                        @if(isset($supportCarePlan->consents_participant_dob))
                            {{ \Carbon\Carbon::parse($supportCarePlan->consents_participant_dob)->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Start Date</span>
                    <span class="value">
                        @if(isset($supportCarePlan->consents_goal_plan_start_date))
                            {{ \Carbon\Carbon::parse($supportCarePlan->consents_goal_plan_start_date)->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </span>
                </td>
                <td>
                    <span class="label">Review Date</span>
                    <span class="value">
                        @if(isset($supportCarePlan->consents_goal_plan_review_date))
                            {{ \Carbon\Carbon::parse($supportCarePlan->consents_goal_plan_review_date)->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </span>
                </td>
                <td>
                    <span class="label">Plan Created Date</span>
                    <span class="value">
                        @if(isset($supportCarePlan->created_at))
                            {{ \Carbon\Carbon::parse($supportCarePlan->created_at)->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Alternate Decision Maker -->
    <div class="section">
        <div class="section-header">Alternate Decision Maker</div>
        <table>
            <tr>
                <td>
                    <span class="label">Type</span>
                    <span class="value">{{ $supportCarePlan->alternateDecisionMaker->type ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">First Name</span>
                    <span class="value">{{ $supportCarePlan->alternateDecisionMaker->first_name ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Surname</span>
                    <span class="value">{{ $supportCarePlan->alternateDecisionMaker->surname ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <span class="label">Notes</span>
                    <span class="value">{{ $supportCarePlan->alternateDecisionMaker->notes ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Goals Section -->
    @php
    $goalCategories = [
        'silGoals' => 'SIL Goals',
        'homecareGoals' => 'Homecare Goals',
        'supportCoordinationGoals' => 'Support Coordination Goals',
    ];
    @endphp

    @foreach($goalCategories as $relation => $title)
        <div class="section">
            <div class="section-header">{{ $title }}</div>

            @php
                $goals = $supportCarePlan->$relation ?? collect();
            @endphp

            @if($goals->isNotEmpty())
                @foreach($goals as $index => $goal)
                    <div style="margin-top: 10px; font-weight: bold; color: #374151;">{{ $title }} {{ $index + 1 }}</div>
                    <table>
                        <tr>
                            <td>
                                <span class="label">Goal Title</span>
                                <span class="value">{{ $goal->goal_title ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <span class="label">Goals of Support</span>
                                <span class="value">{{ $goal->goals_of_support ?? 'N/A' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label">Steps</span>
                                <span class="value">{{ $goal->steps ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <span class="label">Organisation Steps</span>
                                <span class="value">{{ $goal->organisation_steps ?? 'N/A' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="label">Risk</span>
                                <span class="value">{{ $goal->risk ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <span class="label">Risk Strategies</span>
                                <span class="value">{{ $goal->risk_management_strategies ?? 'N/A' }}</span>
                            </td>
                        </tr>
                    </table>
                @endforeach

            @endif
        </div>
    @endforeach

    <!-- Communication Plans -->
    <div class="section">
        <div class="section-header">Communication Plan</div>
        <table>
            @if($supportCarePlan->communicationPlans && $supportCarePlan->communicationPlans->count() > 0)
                @foreach($supportCarePlan->communicationPlans as $communication)
                    @php
                        // Normalize helps_me_talk
                        $helpsMeTalk = $communication->helps_me_talk;
                        if (is_string($helpsMeTalk)) {
                            $decoded = json_decode($helpsMeTalk, true);
                            $helpsMeTalk = is_array($decoded) ? $decoded : [$helpsMeTalk];
                        } elseif (!is_array($helpsMeTalk)) {
                            $helpsMeTalk = [];
                        }

                        // Normalize helps_me_understand
                        $helpsMeUnderstand = $communication->helps_me_understand;
                        if (is_string($helpsMeUnderstand)) {
                            $decoded = json_decode($helpsMeUnderstand, true);
                            $helpsMeUnderstand = is_array($decoded) ? $decoded : [$helpsMeUnderstand];
                        } elseif (!is_array($helpsMeUnderstand)) {
                            $helpsMeUnderstand = [];
                        }
                    @endphp

                    <tr>
                        <td>
                            <span class="label">Helps me talk</span>
                            <span class="value">
                                @if(!empty($helpsMeTalk))
                                    {{ implode(', ', $helpsMeTalk) }}
                                @else
                                    N/A
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="label">Helps me understand</span>
                            <span class="value">
                                @if(!empty($helpsMeUnderstand))
                                    {{ implode(', ', $helpsMeUnderstand) }}
                                @else
                                    N/A
                                @endif
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

            @endif
        </table>
    </div>

    <!-- Emergency Disaster Plan -->
    <div class="section">
        <div class="section-header">Emergency & Disaster Plan</div>
        <table>
            @if($supportCarePlan->emergencyDisasterPlan)
                <tr>
                    <td><span class="label">Participant Name</span> <span class="value">{{ $supportCarePlan->emergencyDisasterPlan->participant_name ?? 'N/A' }}</span></td>
                    <td>
                        <span class="label">Date</span>
                        <span class="value">
                            @if(isset($supportCarePlan->emergencyDisasterPlan->date))
                                {{ \Carbon\Carbon::parse($supportCarePlan->emergencyDisasterPlan->date)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class="label">Review Date</span>
                        <span class="value">
                            @if(isset($supportCarePlan->emergencyDisasterPlan->review_date))
                                {{ \Carbon\Carbon::parse($supportCarePlan->emergencyDisasterPlan->review_date)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </span>
                    </td>
                </tr>

            @endif
        </table>
    </div>

    <!-- Emergency Contacts -->
    <div class="section">
    <div class="section-header">Emergency Contacts</div>
    <table>
        @if($supportCarePlan->emergencyContacts)
            @foreach($supportCarePlan->emergencyContacts as $contact)
            <tr>
                <td><span class="label">Name</span> <span class="value">{{ $contact->name ?? 'N/A' }}</span></td>
                <td><span class="label">Relationship</span> <span class="value">{{ $contact->relationship ?? 'N/A' }}</span></td>
                <td><span class="label">Phone</span> <span class="value">{{ $contact->phone ?? 'N/A' }}</span></td>
                <td><span class="label">Email</span> <span class="value">{{ $contact->email ?? 'N/A' }}</span></td>
                <td><span class="label">Location</span> <span class="value">{{ $contact->location ?? 'N/A' }}</span></td>
            </tr>
            @endforeach
        @else
            <!-- Display empty row with N/A when no emergency contacts exist -->
            <tr>
                <td><span class="label">Name</span> <span class="value">N/A</span></td>
                <td><span class="label">Relationship</span> <span class="value">N/A</span></td>
                <td><span class="label">Phone</span> <span class="value">N/A</span></td>
                <td><span class="label">Email</span> <span class="value">N/A</span></td>
                <td><span class="label">Location</span> <span class="value">N/A</span></td>
            </tr>
        @endif
    </table>
</div>

    <!-- Important Contacts -->
    <div class="section">
        <div class="section-header">Important Contacts / Services</div>
        <table>
            @if($supportCarePlan->importantContacts)
                <tr><td><span class="label">Advocate</span> <span class="value">{{ $supportCarePlan->importantContacts->advocate ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Childcare / School</span> <span class="value">{{ $supportCarePlan->importantContacts->childcare_school_contact ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Power of Attorney</span> <span class="value">{{ $supportCarePlan->importantContacts->power_of_attorney_guardian ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Workplace / Volunteer</span> <span class="value">{{ $supportCarePlan->importantContacts->workplace_volunteer_contact ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Landlord / SDA Provider</span> <span class="value">{{ $supportCarePlan->importantContacts->landlord_sda_provider ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Doctor</span> <span class="value">{{ $supportCarePlan->importantContacts->doctor ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Specialist Practitioner</span> <span class="value">{{ $supportCarePlan->importantContacts->specialist_practitioner ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Solicitor</span> <span class="value">{{ $supportCarePlan->importantContacts->solicitor ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Insurer (Home/Contents)</span> <span class="value">{{ $supportCarePlan->importantContacts->insurer_home_contents ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Private Health Cover</span> <span class="value">{{ $supportCarePlan->importantContacts->private_health_cover ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Insurer (Vehicle)</span> <span class="value">{{ $supportCarePlan->importantContacts->insurer_vehicle ?? 'N/A' }}</span></td></tr>

            @endif
        </table>
    </div>

    <!-- Local Services Contact -->
    <div class="section">
        <div class="section-header">Local Services - Contact</div>
        <table>
            @if($supportCarePlan->localServicesContact)
                <tr><td><span class="label">Council</span> <span class="value">{{ $supportCarePlan->localServicesContact->council ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Hospital</span> <span class="value">{{ $supportCarePlan->localServicesContact->hospital ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Electricity</span> <span class="value">{{ $supportCarePlan->localServicesContact->electricity ?? 'N/A' }}</span></td></tr>
                <tr><td><span class="label">Water</span> <span class="value">{{ $supportCarePlan->localServicesContact->water ?? 'N/A' }}</span></td></tr>

            @endif
        </table>
    </div>

    <!-- Emergency Scenarios -->
    <div class="section">
        <div class="section-header">Emergency Scenarios and Support Actions</div>
        <table>
            @if($supportCarePlan->emergencyScenario)
                <tr>
                    <td><span class="label">Admitted to Hospital</span> <span class="value">{{ $supportCarePlan->emergencyScenario->admitted_to_hospital ? 'Yes' : 'No' }}</span></td>
                    <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->admitted_to_hospital_action ?? 'N/A' }}</span></td>
                </tr>
                <tr>
                    <td><span class="label">Medical Emergencies</span> <span class="value">{{ $supportCarePlan->emergencyScenario->medical_emergencies ? 'Yes' : 'No' }}</span></td>
                    <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->medical_emergencies_action ?? 'N/A' }}</span></td>
                </tr>
                <tr>
                    <td><span class="label">Other Likely Medical Emergency</span> <span class="value">{{ $supportCarePlan->emergencyScenario->other_likely_medical_emergency ? 'Yes' : 'No' }}</span></td>
                    <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->other_likely_medical_emergency_action ?? 'N/A' }}</span></td>
                </tr>
                <tr>
                    <td><span class="label">Natural Disaster</span> <span class="value">{{ $supportCarePlan->emergencyScenario->natural_disaster ? 'Yes' : 'No' }}</span></td>
                    <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->natural_disaster_action ?? 'N/A' }}</span></td>
                </tr>

            @endif
        </table>
    </div>

</div>

</body>
</html>
