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
        <div class="section-header">Participant Information</div>
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
                    <span class="label">New Participant</span>
                    <span class="value">{{ $assessment->is_new_participant ? 'Yes' : 'No' }}</span>
                </td>
                <td>
                    <span class="label">Participant Agreement</span>
                    <span class="value">{{ $assessment->does_participant_agree ? 'Yes' : 'No' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Entry Door</span>
                    <span class="value">{{ $assessment->entry_door ?? 'N/A' }}</span>
                </td>
                <td colspan="2">
                    <span class="label">Other Entry Door</span>
                    <span class="value">{{ $assessment->entry_door_other ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>

@if($assessment->outsideEntry)
    <div class="section">
        <div class="section-header">Outside Entry Assessment</div>
        <table>
            <tr>
                <td>
                    <span class="label">Parking Adequate</span>
                    <span class="value">{{ $assessment->outsideEntry->parking_adequate ?? 'N/A' }}</span>
                </td>
                <td class="strategy">
                    <span class="label">Parking Strategy</span>
                    <span class="value">{{ $assessment->outsideEntry->parking_adequate_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Pathway Surface</span>
                    <span class="value">{{ $assessment->outsideEntry->pathway_surface ?? 'N/A' }}</span>
                </td>
                <td class="strategy">
                    <span class="label">Pathway Strategy</span>
                    <span class="value">{{ $assessment->outsideEntry->pathway_surface_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Gates Entry Easy</span>
                    <span class="value">{{ $assessment->outsideEntry->gates_entry_easy ?? 'N/A' }}</span>
                </td>
                <td class="strategy">
                    <span class="label">Gates Strategy</span>
                    <span class="value">{{ $assessment->outsideEntry->gates_entry_easy_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Lighting Adequate</span>
                    <span class="value">{{ $assessment->outsideEntry->lighting_adequate ?? 'N/A' }}</span>
                </td>
                <td class="strategy">
                    <span class="label">Lighting Strategy</span>
                    <span class="value">{{ $assessment->outsideEntry->lighting_adequate_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Outdoor Fire Hazards</span>
                    <span class="value">{{ $assessment->outsideEntry->outdoor_fire_hazards ?? 'N/A' }}</span>
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
    <div class="section-header">Inside Residence Assessment</div>
    <table>
        <tr>
            <td>
                <span class="label">Exit Doors Unobstructed</span>
                <span class="value">{{ $assessment->insideResidence->exit_doors_unobstructed ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Exit Doors Strategy</span>
                <span class="value">{{ $assessment->insideResidence->exit_doors_unobstructed_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Heaters Suitable</span>
                <span class="value">{{ $assessment->insideResidence->heaters_suitable ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Heaters Strategy</span>
                <span class="value">{{ $assessment->insideResidence->heaters_suitable_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Aids Equipment Condition</span>
                <span class="value">{{ $assessment->insideResidence->aids_equipment_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Equipment Strategy</span>
                <span class="value">{{ $assessment->insideResidence->aids_equipment_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Evidence of Pests</span>
                <span class="value">{{ $assessment->insideResidence->evidence_of_pests ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Pests Strategy</span>
                <span class="value">{{ $assessment->insideResidence->evidence_of_pests_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Participant Open Door</span>
                <span class="value">{{ $assessment->insideResidence->participant_open_door ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Participant Open Door Strategy</span>
                <span class="value">{{ $assessment->insideResidence->participant_open_door_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Fire Hazards</span>
                <span class="value">{{ $assessment->insideResidence->fire_hazards ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Fire Hazards Strategy</span>
                <span class="value">{{ $assessment->insideResidence->fire_hazards_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Vacuum Cleaner OK</span>
                <span class="value">{{ $assessment->insideResidence->vacuum_cleaner_ok ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Vacuum Cleaner Strategy</span>
                <span class="value">{{ $assessment->insideResidence->vacuum_cleaner_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Mop Bucket OK</span>
                <span class="value">{{ $assessment->insideResidence->mop_bucket_ok ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Mop Bucket Strategy</span>
                <span class="value">{{ $assessment->insideResidence->mop_bucket_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Step Ladder OK</span>
                <span class="value">{{ $assessment->insideResidence->step_ladder_ok ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Step Ladder Strategy</span>
                <span class="value">{{ $assessment->insideResidence->step_ladder_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Cleaning Substances OK</span>
                <span class="value">{{ $assessment->insideResidence->cleaning_substances_ok ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Cleaning Substances Strategy</span>
                <span class="value">{{ $assessment->insideResidence->cleaning_substances_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif

<!-- Hallways Assessment -->
@if($assessment->hallways)
<div class="section">
    <div class="section-header">Hallways Assessment</div>
    <table>
        <tr>
            <td>
                <span class="label">Hallways/Lounge/Dining/Bedroom</span>
                <span class="value">{{ $assessment->hallways->hallways_lounge_dining_bedroom ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Strategy</span>
                <span class="value">{{ $assessment->hallways->hallways_lounge_dining_bedroom_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Pests Evidence</span>
                <span class="value">{{ $assessment->hallways->pests_evidence ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Pests Evidence Strategy</span>
                <span class="value">{{ $assessment->hallways->pests_evidence_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Lighting Workspace</span>
                <span class="value">{{ $assessment->hallways->lighting_workspace ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Lighting Workspace Strategy</span>
                <span class="value">{{ $assessment->hallways->lighting_workspace_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Furniture Stable</span>
                <span class="value">{{ $assessment->hallways->furniture_stable ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Furniture Stable Strategy</span>
                <span class="value">{{ $assessment->hallways->furniture_stable_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Bed Adjustable</span>
                <span class="value">{{ $assessment->hallways->bed_adjustable ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Bed Adjustable Strategy</span>
                <span class="value">{{ $assessment->hallways->bed_adjustable_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Electrical Switches</span>
                <span class="value">{{ $assessment->hallways->electrical_switches ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Electrical Switches Strategy</span>
                <span class="value">{{ $assessment->hallways->electrical_switches_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Private Sleep Space</span>
                <span class="value">{{ $assessment->hallways->private_sleep_space ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Private Sleep Space Strategy</span>
                <span class="value">{{ $assessment->hallways->private_sleep_space_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Hallways Fire Hazards</span>
                <span class="value">{{ $assessment->hallways->hallways_fire_hazards ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Hallways Fire Hazards Strategy</span>
                <span class="value">{{ $assessment->hallways->hallways_fire_hazards_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif

<!-- Hallways Safety Assessment -->
@if($assessment->hallwaysSafetyAssessment)
<div class="section">
    <div class="section-header">Kitchen & Bathroom Safety Assessment</div>
    <table>
        <tr>
            <td>
                <span class="label">Floor Condition</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->floor_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Floor Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->floor_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Electrical Condition</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->electrical_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Electrical Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->electrical_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Ventilation Condition</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->ventilation_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Ventilation Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->ventilation_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Bench Condition</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->bench_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Bench Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->bench_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Stove Condition</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->stove_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Stove Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->stove_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Fridge Condition</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->fridge_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Fridge Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->fridge_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Bath Access</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->bath_access ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Bath Access Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->bath_access_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Toilet Access</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->toilet_access ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Toilet Access Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->toilet_access_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Privacy Condition</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->privacy_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Privacy Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->privacy_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Laundry Condition</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->laundry_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Laundry Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->laundry_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Ironing Condition</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->ironing_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Ironing Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->ironing_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Manual Handling Risks</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->manual_handling_risks ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Manual Handling Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->manual_handling_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Kitchen Fire Hazards</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->kitchen_fire_hazards ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Kitchen Fire Hazards Strategy</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->kitchen_fire_hazards_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif

<!-- Outside Residence Assessment -->
@if($assessment->outsideResidenceAssessment)
<div class="section">
    <div class="section-header">Outside Residence Assessment</div>
    <table>
        <tr>
            <td>
                <span class="label">Paths/Veranda/Steps</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_paths_veranda_steps ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Paths Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_paths_veranda_steps_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Pets Restrained</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_pets_restrained ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Pets Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_pets_restrained_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Lighting Adequate</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_lighting_adequate ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Lighting Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_lighting_adequate_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Door Easy Open</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_door_easy_open ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Door Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_door_easy_open_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Lawn Mower Condition</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_lawn_mower_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Lawn Mower Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_lawn_mower_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Electrical Condition</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_electrical_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Electrical Strategy</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_electrical_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Fire Hazards</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_fire_hazards ?? 'N/A' }}</span>
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
    <div class="section-header">Miscellaneous Safety Assessment</div>
    <table>
        <tr>
            <td>
                <span class="label">Children Living at Home</span>
                <span class="value">{{ $assessment->miscellaneous->misc_children_living_at_home ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Children Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_children_living_at_home_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Weapons Stored Appropriately</span>
                <span class="value">{{ $assessment->miscellaneous->misc_weapons_stored_appropriately ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Weapons Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_weapons_stored_appropriately_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Smoking Outside Only</span>
                <span class="value">{{ $assessment->miscellaneous->misc_smoking_outside_only ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Smoking Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_smoking_outside_only_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Mobility Issues</span>
                <span class="value">{{ $assessment->miscellaneous->misc_mobility_issues ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Mobility Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_mobility_issues_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Equipment Good Condition</span>
                <span class="value">{{ $assessment->miscellaneous->misc_equipment_good_condition ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Equipment Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_equipment_good_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">PPE Requirements</span>
                <span class="value">{{ $assessment->miscellaneous->misc_ppe_requirements ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">PPE Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_ppe_requirements_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Personal Threats</span>
                <span class="value">{{ $assessment->miscellaneous->misc_personal_threats ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Personal Threats Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_personal_threats_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Safe Neighbourhood</span>
                <span class="value">{{ $assessment->miscellaneous->misc_safe_neighbourhood ?? 'N/A' }}</span>
            </td>
            <td class="strategy">
                <span class="label">Safe Neighbourhood Strategy</span>
                <span class="value">{{ $assessment->miscellaneous->misc_safe_neighbourhood_strategy ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Aggression in Home</span>
                <span class="value">{{ $assessment->miscellaneous->misc_aggression_in_home ?? 'N/A' }}</span>
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
        <div class="section-header">Residence Type & Completion Details</div>
        <table>
            <tr>
                <td>
                    <span class="label">Residence House Type</span>
                    <span class="value">{{ $assessment->residenceType->residence_house_type ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Other Type</span>
                    <span class="value">{{ $assessment->residenceType->residence_other_type ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Assessment Completed With</span>
                    <span class="value">{{ $assessment->residenceType->assessment_completed_with ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Name</span>
                    <span class="value">{{ $assessment->residenceType->name ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Position</span>
                    <span class="value">{{ $assessment->residenceType->position ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Review Date</span>
                    <span class="value">{{ $assessment->residenceType->review_date ? \Carbon\Carbon::parse($assessment->residenceType->review_date)->format('d-m-Y') : 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
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
