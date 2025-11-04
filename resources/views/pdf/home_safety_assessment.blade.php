<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home Safety Checklist Assessment - BHC</title>
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
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 10px 15px;
            font-weight: bold;
            border-left: 4px solid #0284c7;
            margin-bottom: 10px;
            border-radius: 4px;
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
            color: #555;
            font-size: 11px;
        }

        .value {
            margin-top: 2px;
        }

        .page-break {
            page-break-before: always;
            break-before: page;
        }

        .strategy {
            background-color: #f8fafc;
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
        <div class="header-title">Home Safety Checklist Assessment</div>
        <div class="document-number">Document Number: <span>Form HSC-{{ $assessment->id }}</span></div>
    </div>

    <!-- Main Assessment Information -->
    <div class="section">
    <div class="section-header">1.Home Safety Information</div>
    <table>
        <tr>
            <td>
                <span class="label">Participant Name</span>
                <span class="value">{{ $assessment->participant_name ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Address</span>
                <span class="value">{{ $assessment->address ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Phone</span>
                <span class="value">{{ $assessment->phone ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Email</span>
                <span class="value">{{ $assessment->email ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Assessment Type</span>
                <div class="enum-field">
                    <span class="enum-option {{ $assessment->is_new_participant ? 'selected' : '' }}">New Participant</span>
                    <span class="enum-option {{ $assessment->is_review_existing ? 'selected' : '' }}">Review Existing</span>
                </div>
            </td>
            <td>
                <span class="label">Participant Agreement</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($assessment->does_participant_agree ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <span class="label">Primary Entry Door</span>
                <div class="enum-field">
                    @foreach(['front' => 'Front', 'side' => 'Side', 'rear' => 'Rear', 'other' => 'Other'] as $value => $label)
                        <span class="enum-option {{ ($assessment->entry_door ?? '') === $value ? 'selected' : '' }}">
                            {{ $label }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        @if($assessment->entry_door === 'other')
        <tr>
            <td colspan="3">
                <span class="label">Other Entry Door Description</span>
                <span class="value">{{ $assessment->entry_door_other ?? 'N/A' }}</span>
            </td>
        </tr>
        @endif
    </table>
</div>

@if($assessment->outsideEntry)
    <div class="section">
        <div class="section-header">2.Outside Entry Assessment</div>
        <table>
            <tr>
                <td>
                    <span class="label">Parking Adequate</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                            <span class="enum-option {{ ($assessment->outsideEntry->parking_adequate ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="strategy">
                    <span class="label">Parking Strategy</span>
                    <span class="value">{{ $assessment->outsideEntry->parking_adequate_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Pathway Surface</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                            <span class="enum-option {{ ($assessment->outsideEntry->pathway_surface ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="strategy">
                    <span class="label">Pathway Strategy</span>
                    <span class="value">{{ $assessment->outsideEntry->pathway_surface_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Gates Entry Easy</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                            <span class="enum-option {{ ($assessment->outsideEntry->gates_entry_easy ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="strategy">
                    <span class="label">Gates Strategy</span>
                    <span class="value">{{ $assessment->outsideEntry->gates_entry_easy_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Lighting Adequate</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                            <span class="enum-option {{ ($assessment->outsideEntry->lighting_adequate ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="strategy">
                    <span class="label">Lighting Strategy</span>
                    <span class="value">{{ $assessment->outsideEntry->lighting_adequate_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Outdoor Fire Hazards</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                            <span class="enum-option {{ ($assessment->outsideEntry->outdoor_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="strategy">
                    <span class="label">Fire Hazards Strategy</span>
                    <span class="value">{{ $assessment->outsideEntry->outdoor_fire_hazards_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>
@endif

<!-- Inside Residence Assessment -->
@if($assessment->insideResidence)
<div class="section">
    <div class="section-header">3.Inside Residence Assessment</div>
    <table>
        <tr>
            <td>
                <span class="label">Exit Doors Unobstructed</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->exit_doors_unobstructed ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Exit Doors Strategy</span>
                <span class="value">{{ $assessment->insideResidence->exit_doors_unobstructed_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Heaters Suitable</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->heaters_suitable ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Heaters Strategy</span>
                <span class="value">{{ $assessment->insideResidence->heaters_suitable_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Aids Equipment Condition</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->aids_equipment_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Equipment Strategy</span>
                <span class="value">{{ $assessment->insideResidence->aids_equipment_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Evidence of Pests</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->evidence_of_pests ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Pests Strategy</span>
                <span class="value">{{ $assessment->insideResidence->evidence_of_pests_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Participant Open Door</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->participant_open_door ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Participant Open Door Strategy</span>
                <span class="value">{{ $assessment->insideResidence->participant_open_door_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Fire Hazards</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->fire_hazards ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Fire Hazards Strategy</span>
                <span class="value">{{ $assessment->insideResidence->fire_hazards_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Vacuum Cleaner OK</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->vacuum_cleaner_ok ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Vacuum Cleaner Strategy</span>
                <span class="value">{{ $assessment->insideResidence->vacuum_cleaner_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Mop Bucket OK</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->mop_bucket_ok ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Mop Bucket Strategy</span>
                <span class="value">{{ $assessment->insideResidence->mop_bucket_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Step Ladder OK</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->step_ladder_ok ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Step Ladder Strategy</span>
                <span class="value">{{ $assessment->insideResidence->step_ladder_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Cleaning Substances OK</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->cleaning_substances_ok ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Cleaning Substances Strategy</span>
                <span class="value">{{ $assessment->insideResidence->cleaning_substances_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif


<!-- Hallways Safety Assessment -->
@if($assessment->hallways)
<div class="section">
    <div class="section-header">4.Hallways Assessment</div>
    <table>
        <tr>
            <td>
                <span class="label">Hallways/Lounge/Dining/Bedroom</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->hallways_lounge_dining_bedroom ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Strategy</span>
                <span class="value">{{ $assessment->hallways->hallways_lounge_dining_bedroom_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Pests Evidence</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->pests_evidence ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Pests Evidence Strategy</span>
                <span class="value">{{ $assessment->hallways->pests_evidence_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Lighting Workspace</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->lighting_workspace ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Lighting Workspace Strategy</span>
                <span class="value">{{ $assessment->hallways->lighting_workspace_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Furniture Stable</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->furniture_stable ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Furniture Stable Strategy</span>
                <span class="value">{{ $assessment->hallways->furniture_stable_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Bed Adjustable</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->bed_adjustable ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Bed Adjustable Strategy</span>
                <span class="value">{{ $assessment->hallways->bed_adjustable_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Electrical Switches</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->electrical_switches ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Electrical Switches Strategy</span>
                <span class="value">{{ $assessment->hallways->electrical_switches_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Private Sleep Space</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->private_sleep_space ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Private Sleep Space Strategy</span>
                <span class="value">{{ $assessment->hallways->private_sleep_space_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Hallways Fire Hazards</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->hallways_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Hallways Fire Hazards Strategy</span>
                <span class="value">{{ $assessment->hallways->hallways_fire_hazards_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif

<!-- Outside Residence Assessment -->
@if($assessment->outsideResidenceAssessment)
<div class="section">
    <div class="section-header">6.Outside Residence Assessment</div>
    <table>
        <tr>
            <td>
                <span class="label">Paths/Veranda/Steps</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->outside_paths_veranda_steps ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Paths Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_paths_veranda_steps_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Pets Restrained</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->outside_pets_restrained ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Pets Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_pets_restrained_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Lighting Adequate</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->outside_lighting_adequate ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Lighting Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_lighting_adequate_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Door Easy Open</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->outside_door_easy_open ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Door Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_door_easy_open_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Lawn Mower Condition</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->outside_lawn_mower_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Lawn Mower Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_lawn_mower_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Electrical Condition</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->outside_electrical_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Electrical Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_electrical_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Fire Hazards</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->outside_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Fire Hazards Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_fire_hazards_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif

<!-- Miscellaneous Assessment -->
@if($assessment->miscellaneous)
<div class="section">
    <div class="section-header">7.Miscellaneous Safety Assessment</div>
    <table>
        <tr>
            <td>
                <span class="label">Children Living at Home</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_children_living_at_home ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Children Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_children_living_at_home_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Weapons Stored Appropriately</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_weapons_stored_appropriately ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Weapons Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_weapons_stored_appropriately_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Smoking Outside Only</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_smoking_outside_only ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Smoking Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_smoking_outside_only_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Mobility Issues</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_mobility_issues ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Mobility Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_mobility_issues_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Equipment Good Condition</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_equipment_good_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Equipment Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_equipment_good_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">PPE Requirements</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_ppe_requirements ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">PPE Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_ppe_requirements_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Personal Threats</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_personal_threats ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Personal Threats Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_personal_threats_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Safe Neighbourhood</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_safe_neighbourhood ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Safe Neighbourhood Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_safe_neighbourhood_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Aggression in Home</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_aggression_in_home ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Aggression Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_aggression_in_home_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif

    <!-- Residence Type -->
   @if($assessment->residenceType)
<div class="section">
    <div class="section-header">8.Residence Type & Completion Details</div>
    <table>
        <tr>
            <td colspan="2">
                <span class="label">Residence Type Classification</span>
                <div class="enum-field">
                    @foreach(['Single / Double Storey', 'Private Rental', 'Care Facility'] as $option)
                        <span class="enum-option {{ ($assessment->residenceType->residence_house_type ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="label">Other Residence Type</span>
                <div class="enum-field">
                    @foreach(['Unit', 'Caravan Park', 'Office Housing'] as $option)
                        <span class="enum-option {{ ($assessment->residenceType->residence_other_type ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="label">Assessment Completed With</span>
                <div class="enum-field">
                    @foreach(['Participant', 'Support Worker', 'Guardian / Next Of Kin'] as $option)
                        <span class="enum-option {{ ($assessment->residenceType->assessment_completed_with ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Name</span>
                <span class="value">{{ $assessment->residenceType->name ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Position</span>
                <span class="value">{{ $assessment->residenceType->position ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Review Date</span>
                <span class="value">{{ $assessment->residenceType->review_date ? \Carbon\Carbon::parse($assessment->residenceType->review_date)->format('d-m-Y') : 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Care Facility</span>
                <span class="value">{{ $assessment->residenceType->care_facility ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif

</div>

</body>
</html>
