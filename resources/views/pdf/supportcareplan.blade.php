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

       .enum-field {
    display: flex;
    gap: 15px;
    margin-top: 4px;
    flex-wrap: wrap;
}

.enum-option {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 2px 0;
    cursor: default;
}

.radio-circle {
    width: 14px;
    height: 14px;
    border: 2px solid #d1d5db;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    flex-shrink: 0;
}

.radio-circle.checked {
    border-color: #0284c7;
    background-color: #0284c7;
}

.radio-circle.checked::after {
    content: "";
    width: 6px;
    height: 6px;
    background-color: white;
    border-radius: 50%;
}

.radio-label {
    font-size: 11px;
    font-weight: 500;
    color: #374151;
    line-height: 1.2;
    white-space: nowrap;
}

.enum-field {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 8px;
}

.enum-option {
    display: flex;
    align-items: center;
    gap: 5px;
}

.checkbox-box {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid #000;
    text-align: center;
    line-height: 14px;
    font-size: 12px;
    border-radius: 2px;
    transition: all 0.2s ease;
}

.checkbox-box.checked {
    border-color: #0284c7;
    background-color: #0284c7;
    color: white;
}



.checkbox-label {
    font-size: 14px;
}

.enum-field {
    display: flex;
    gap: 15px;
    margin-top: 5px;
}

.enum-option {
    padding: 4px 12px;
    border: 2px solid #e5e7eb;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    color: #6b7280;
    background-color: #f9fafb;
    transition: all 0.2s ease;
}

.enum-option.selected {
    border-color: #0284c7;
    background-color: #0284c7;
    color: white;
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

   <div class="section">
    <div class="section-header">Alternate Decision Maker</div>
    <table>
        <tr>
            <td colspan="3">
                <span class="label">Type</span>
                <div class="enum-field">
                    @foreach([
                        'not_applicable' => 'Not Applicable',
                        'partner' => 'Partner',
                        'carer' => 'Carer',
                        'guardian' => 'Guardian',
                        'parent' => 'Parent',
                        'advocacy' => 'Advocacy',
                        'other' => 'Other'
                    ] as $value => $label)
                        <div class="enum-option">
                            <span class="radio-circle {{ ($supportCarePlan->alternateDecisionMaker->type ?? '') === $value ? 'checked' : '' }}"></span>
                            <span class="radio-label">{{ $label }}</span>
                        </div>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">First Name</span>
                <span class="value">{{ $supportCarePlan->alternateDecisionMaker->first_name ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Surname</span>
                <span class="value">{{ $supportCarePlan->alternateDecisionMaker->surname ?? 'N/A' }}</span>
            </td>
            <td>
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

        {{-- ✅ If there are saved goals, show them --}}
        @if($goals->isNotEmpty())
            @foreach($goals as $index => $goal)
                <div style="margin-top: 10px; font-weight: bold; color: #374151;">
                    {{ $title }} {{ $index + 1 }}
                </div>
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
        @else
            {{-- ✅ No goals found → show one empty table --}}
            <div style="margin-top: 10px; font-weight: bold; color: #374151;">
                {{ $title }} 1
            </div>
            <table>
                <tr>
                    <td>
                        <span class="label">Goal Title</span>
                        <span class="value">N/A</span>
                    </td>
                    <td>
                        <span class="label">Goals of Support</span>
                        <span class="value">N/A</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Steps</span>
                        <span class="value">N/A</span>
                    </td>
                    <td>
                        <span class="label">Organisation Steps</span>
                        <span class="value">N/A</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Risk</span>
                        <span class="value">N/A</span>
                    </td>
                    <td>
                        <span class="label">Risk Strategies</span>
                        <span class="value">N/A</span>
                    </td>
                </tr>
            </table>
        @endif
    </div>
@endforeach

    <div class="section">
    <div class="section-header">Communication Plan</div>
    <table>
        @if($supportCarePlan->communicationPlans && $supportCarePlan->communicationPlans->count() > 0)
            @foreach($supportCarePlan->communicationPlans as $communication)
                @php
                    // Helper function to normalize JSON/array data
                    function normalizeCommunicationData($data) {
                        if (is_string($data)) {
                            $decoded = json_decode($data, true);
                            return is_array($decoded) ? $decoded : [$data];
                        } elseif (!is_array($data)) {
                            return [];
                        }
                        return $data;
                    }

                    $helpsMeTalk = normalizeCommunicationData($communication->helps_me_talk);
                    $helpsMeUnderstand = normalizeCommunicationData($communication->helps_me_understand);
                    $pleaseCommunicateBy = normalizeCommunicationData($communication->please_communicate_by);
                @endphp

                <!-- This Helps Me Talk To You -->
                <tr>
                    <td colspan="3">
                        <span class="label"><strong>This Helps Me Talk To You</strong></span>
                        <div class="enum-field">
                            @foreach([
                                'Interpreter' => 'Interpreter',
                                'Symbols' => 'Symbols',
                                'Pictures' => 'Pictures',
                                'Gesturing' => 'Gesturing',
                                'Facial Expressions' => 'Facial Expressions',
                                'Simple words' => 'Simple words',
                                'When you wait for me to respond' => 'When you wait for me to respond',
                                'My Supporter/carer' => 'My Supporter/carer',
                                'Other (Including Assistive technology)' => 'Other (Including Assistive technology)'
                            ] as $value => $label)
                                <div class="enum-option">
                                    <span class="checkbox-box {{ in_array($value, $helpsMeTalk) ? 'checked' : '' }}"></span>
                                    <span class="checkbox-label">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <!-- This is What Helps Me To Understand You -->
                <tr>
                    <td colspan="3">
                        <span class="label"><strong>This is What Helps Me To Understand You</strong></span>
                        <div class="enum-field">
                            @foreach([
                                'Short plain sentences' => 'Short plain sentences',
                                'Simple words' => 'Simple words',
                                'Concrete examples' => 'Concrete examples',
                                'Diagrams or pictures' => 'Diagrams or pictures',
                                'Checking to see if I understand' => 'Checking to see if I understand',
                                'Asking me to explain it' => 'Asking me to explain it',
                                'Asking my supporter/carer to explain it to me' => 'Asking my supporter/carer to explain it to me',
                                'Using real objects' => 'Using real objects',
                                'Giving me a demonstration' => 'Giving me a demonstration',
                                'Other' => 'Other'
                            ] as $value => $label)
                                <div class="enum-option">
                                    <span class="checkbox-box {{ in_array($value, $helpsMeUnderstand) ? 'checked' : '' }}"></span>
                                    <span class="checkbox-label">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <!-- Please communicate with me by -->
                <tr>
                    <td colspan="3">
                        <span class="label"><strong>Please communicate with me by</strong></span>
                        <div class="enum-field">
                            @foreach([
                                'Speaking directly to me' => 'Speaking directly to me',
                                'Taking time to tell me' => 'Taking time to tell me',
                                'Waiting for me to respond' => 'Waiting for me to respond',
                                'Writing down notes in my care plan' => 'Writing down notes in my care plan',
                                'Knowing I cannot talk but can hear and understand' => 'Knowing I cannot talk but can hear and understand',
                                'Other' => 'Other'
                            ] as $value => $label)
                                <div class="enum-option">
                                    <span class="checkbox-box {{ in_array($value, $pleaseCommunicateBy) ? 'checked' : '' }}"></span>
                                    <span class="checkbox-label">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <!-- Emergency Communication -->
                <tr>
                    <td colspan="3">
                        <span class="label"><strong>Emergency Communication</strong></span>
                        <span class="value">{{ $communication->emergency_communication ?? 'N/A' }}</span>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">
                    <span class="value">No communication plan available</span>
                </td>
            </tr>
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
        @php
            $contacts = $supportCarePlan->emergencyContacts ?? collect();
        @endphp

        @if($contacts->isNotEmpty())
            @foreach($contacts as $index => $contact)
                <tr>
                    <td><span class="label">Name</span> <span class="value">{{ $contact->name ?? 'N/A' }}</span></td>
                    <td><span class="label">Relationship</span> <span class="value">{{ $contact->relationship ?? 'N/A' }}</span></td>
                    <td><span class="label">Phone</span> <span class="value">{{ $contact->phone ?? 'N/A' }}</span></td>
                    <td><span class="label">Email</span> <span class="value">{{ $contact->email ?? 'N/A' }}</span></td>
                    <td><span class="label">Location</span> <span class="value">{{ $contact->location ?? 'N/A' }}</span></td>
                </tr>
            @endforeach
        @else
            {{-- ✅ No data: show one empty row --}}
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
                <td>
                    <span class="label">Admitted to Hospital</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportCarePlan->emergencyScenario->admitted_to_hospital ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->admitted_to_hospital_action ?? 'N/A' }}</span></td>
            </tr>
            <tr>
                <td>
                    <span class="label">Medical Emergencies</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportCarePlan->emergencyScenario->medical_emergencies ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->medical_emergencies_action ?? 'N/A' }}</span></td>
            </tr>
            <tr>
                <td>
                    <span class="label">Other Likely Medical Emergency</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportCarePlan->emergencyScenario->other_likely_medical_emergency ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->other_likely_medical_emergency_action ?? 'N/A' }}</span></td>
            </tr>
            <tr>
                <td>
                    <span class="label">Natural Disaster</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportCarePlan->emergencyScenario->natural_disaster ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td><span class="label">Action</span> <span class="value">{{ $supportCarePlan->emergencyScenario->natural_disaster_action ?? 'N/A' }}</span></td>
            </tr>
        @else
            <tr>
                <td colspan="2">
                    <span class="value">No emergency scenarios available</span>
                </td>
            </tr>
        @endif
    </table>
</div>

</div>

</body>
</html>
