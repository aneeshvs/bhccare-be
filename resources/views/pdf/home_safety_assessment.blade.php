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
    </div>

     <!-- Main Assessment Information -->
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
                <span class="label">Does the Participant agree to this home Safety Check?</span>
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
                <span class="label">Which door is used for entry? 
(if ‘Other’, please define)
</span>
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
                    <span class="label">Is parking adequate on street?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                            <span class="enum-option {{ ($assessment->outsideEntry->parking_adequate ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="strategy">
                    <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                    <span class="value">{{ $assessment->outsideEntry->parking_adequate_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Are Pathway/veranda/stairs level surface, non-slip, uncluttered, adequate width?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                            <span class="enum-option {{ ($assessment->outsideEntry->pathway_surface ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="strategy">
                    <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                    <span class="value">{{ $assessment->outsideEntry->pathway_surface_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Are gates and entry door easy to open, clear of obstruction?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                            <span class="enum-option {{ ($assessment->outsideEntry->gates_entry_easy ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="strategy">
                    <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                    <span class="value">{{ $assessment->outsideEntry->gates_entry_easy_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Are lighting adequate illumination from street to front door at night?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                            <span class="enum-option {{ ($assessment->outsideEntry->lighting_adequate ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="strategy">
                    <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                    <span class="value">{{ $assessment->outsideEntry->lighting_adequate_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Are there any outdoor fire hazards? (Potential high grass / bush fire / Snakes)</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                            <span class="enum-option {{ ($assessment->outsideEntry->outdoor_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="strategy">
                    <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                    <span class="value">{{ $assessment->outsideEntry->outdoor_fire_hazards_strategy ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>
@endif

<!-- Inside Residence Assessment -->
@if($assessment->insideResidence)
<div class="section">
    <div class="section-header">3. Inside Residence Assessment</div>
    <table>

        <tr>
            <td>
                <span class="label">Are all exit doors unobstructed and in working order?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->exit_doors_unobstructed ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->insideResidence->exit_doors_unobstructed_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Are heaters in suitable position? (e.g. no bedding, clothes or water nearby)</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->heaters_suitable ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->insideResidence->heaters_suitable_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Are aids and equipment in good conditions? (e.g. handrails, adjustable bed, shower chair, hoist, access ramps)</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->aids_equipment_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->insideResidence->aids_equipment_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is there evidence of pests? (e.g. ants, wasps, vermin)</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->evidence_of_pests ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->insideResidence->evidence_of_pests_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is the Participant able to (entry/egress) open door? (if relevant)</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->participant_open_door ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->insideResidence->participant_open_door_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Are there any fire hazards? fireplaces, candles, etc.</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->fire_hazards ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->insideResidence->fire_hazards_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is vacuum cleaner/carpet sweeper appropriate design and in working order?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->vacuum_cleaner_ok ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->insideResidence->vacuum_cleaner_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is mop and bucket appropriate design and in working order?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->mop_bucket_ok ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->insideResidence->mop_bucket_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is step ladder appropriate design and in working order?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->step_ladder_ok ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->insideResidence->step_ladder_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Are cleaning substances/products in original container and labelled appropriately?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->insideResidence->cleaning_substances_ok ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->insideResidence->cleaning_substances_ok_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

    </table>
</div>
@endif



<!-- Hallways Safety Assessment -->
@if($assessment->hallways)
<div class="section">
    <div class="section-header">4. Hallways Assessment</div>
    <table>

        <!-- Hallways / Lounge / Dining / Bedroom -->
        <tr>
            <td>
                <span class="label">Hallways / Lounge / Dining / Bedroom</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->hallways_lounge_dining_bedroom ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallways->hallways_lounge_dining_bedroom_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Evidence of pests -->
        <tr>
            <td>
                <span class="label">Is there evidence of pests? (e.g. ants, wasps, vermin)</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->pests_evidence ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallways->pests_evidence_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Lighting and workspace -->
        <tr>
            <td>
                <span class="label">Is there adequate lighting and workspace to undertake tasks?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->lighting_workspace ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallways->lighting_workspace_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Furniture stable -->
        <tr>
            <td>
                <span class="label">Is furniture stable and does not need to be moved, or easy to move? (e.g. chairs)</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->furniture_stable ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallways->furniture_stable_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Bed adjustable -->
        <tr>
            <td>
                <span class="label">Is bed adjustable or adequate height to work from?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->bed_adjustable ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallways->bed_adjustable_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Electrical switches -->
        <tr>
            <td>
                <span class="label">Are electrical switches/power points/leads in good condition and easy to access?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->electrical_switches ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallways->electrical_switches_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Private sleeping space -->
        <tr>
            <td>
                <span class="label">Is there a private sleeping space with clean bed linen available for sleepover shifts?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->private_sleep_space ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallways->private_sleep_space_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Fire hazards -->
        <tr>
            <td>
                <span class="label">Are there any fire hazards? - heaters, electric blankets, etc.</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallways->hallways_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallways->hallways_fire_hazards_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

    </table>
</div>
@endif

@if($assessment->hallwaysSafetyAssessment)
<div class="section">
    <div class="section-header">5. Kitchen / Bathroom / Toilet / Laundry Safety Assessment</div>
    <table>

        {{-- Floor Surfaces --}}
        <tr>
            <td>
                <span class="label">Are floor surfaces level and in good condition (no trip hazards)?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->floor_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->floor_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Electrical Switches / Points / Leads --}}
        <tr>
            <td>
                <span class="label">Are electrical switches/power points/leads in good condition and safely located?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->electrical_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->electrical_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Ventilation / Lighting / Drainage --}}
        <tr>
            <td>
                <span class="label">Is ventilation, lighting and drainage adequate?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->ventilation_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->ventilation_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Bench / Surfaces --}}
        <tr>
            <td>
                <span class="label">Are benches/surfaces clean and suitable for use?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->bench_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->bench_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Stove and Food Preparation --}}
        <tr>
            <td>
                <span class="label">Is stove and food preparation equipment clean and in good working order?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->stove_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->stove_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Fridge --}}
        <tr>
            <td>
                <span class="label">Is fridge clean and food stored appropriately?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->fridge_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->fridge_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Bath/Shower Access --}}
        <tr>
            <td>
                <span class="label">Is bath/shower design appropriate for easy access with non-slip surface?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->bath_access ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->bath_access_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Toilet Access --}}
        <tr>
            <td>
                <span class="label">Is toilet accessible for cleaning and seat intact?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->toilet_access ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->toilet_access_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Privacy --}}
        <tr>
            <td>
                <span class="label">Is privacy adequate for staff use (doors closed/locked)?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->privacy_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->privacy_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Laundry --}}
        <tr>
            <td>
                <span class="label">Is washing machine/dryer appropriate, clean, and in working order?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->laundry_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->laundry_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Ironing Equipment --}}
        <tr>
            <td>
                <span class="label">Is iron/ironing board/clothesline appropriate and in working order?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->ironing_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->ironing_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Manual Handling --}}
        <tr>
            <td>
                <span class="label">Are manual handling risks assessed and controlled?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->manual_handling_risks ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->manual_handling_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- Fire Hazards --}}
        <tr>
            <td>
                <span class="label">Are there any fire hazards? (fireplaces, candles, etc.)</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->hallwaysSafetyAssessment->kitchen_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->hallwaysSafetyAssessment->kitchen_fire_hazards_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

    </table>
</div>
@endif


<!-- Outside Residence Assessment -->
@if($assessment->outsideResidenceAssessment)
<div class="section">
    <div class="section-header">6.Outside – back and sides of residence / garages and sheds (if used by staff)</div>
    <table>

        {{-- 1. Floor surfaces --}}
        <tr>
            <td>
                <span class="label">Are floor surfaces level, in good condition, with no trip hazards (e.g. mats)?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->floor_surfaces ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->floor_surfaces_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 2. Electrical switches/power points/leads condition --}}
        <tr>
            <td>
                <span class="label">Are electrical switches/power points/leads in good condition, easy to access, and in a suitable location (away from water and direct heat)?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->electrical_good_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->electrical_good_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 3. Ventilation, lighting and drainage adequate --}}
        <tr>
            <td>
                <span class="label">Is ventilation, lighting and drainage adequate?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->ventilation_lighting_drainage ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->ventilation_lighting_drainage_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 4. Benches/surfaces clean & adequate --}}
        <tr>
            <td>
                <span class="label">Are benches/surfaces clean and is there adequate room/height to work from?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->benches_clean_adequate ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->benches_clean_adequate_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 5. Stove / food preparation equipment --}}
        <tr>
            <td>
                <span class="label">Is the stove and food preparation equipment clean and in good working order?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->stove_clean_working ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->stove_clean_working_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 6. Fridge clean & food stored correctly --}}
        <tr>
            <td>
                <span class="label">Is the fridge clean and food stored appropriately?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->fridge_clean_stored ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->fridge_clean_stored_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 7. Bath/shower access --}}
        <tr>
            <td>
                <span class="label">Is the bath/shower an appropriate design for easy access, with a non-slip surface?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->bath_shower_accessible ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->bath_shower_accessible_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 8. Toilet accessible --}}
        <tr>
            <td>
                <span class="label">Is the toilet accessible for cleaning and is the seat intact?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->toilet_accessible ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->toilet_accessible_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 9. Privacy adequate --}}
        <tr>
            <td>
                <span class="label">Is privacy adequate for staff use? (doors closed and locked)</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->privacy_adequate ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->privacy_adequate_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 10. Washing machine/dryer --}}
        <tr>
            <td>
                <span class="label">Is the washing machine/dryer an appropriate design, clean and in working order?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->washing_machine_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->washing_machine_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 11. Iron/ironing board/clothesline --}}
        <tr>
            <td>
                <span class="label">Is the iron/ironing board/clothesline an appropriate design and in working order?</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->ironing_equipment_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->ironing_equipment_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 12. Manual handling risks --}}
        <tr>
            <td>
                <span class="label">Are manual handling risks associated with Participant transfers assessed and controlled? (e.g., transfers in/out of bed, into car)</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->manual_handling_risks ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->manual_handling_risks_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        {{-- 13. Fire hazards --}}
        <tr>
            <td>
                <span class="label">Are there any fire hazards? (fireplaces, candles, etc.)</span>
                <div class="enum-field">
                    @foreach(['Yes','No','N/A','Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->outsideResidenceAssessment->outside_fire_hazards ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->outsideResidenceAssessment->outside_fire_hazards_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

    </table>
</div>
@endif


<!-- Miscellaneous Assessment -->
@if($assessment->miscellaneous)
<div class="section">
    <div class="section-header">7. Miscellaneous Safety Assessment</div>
    <table>

        <!-- Children living at home -->
        <tr>
            <td>
                <span class="label">
                    Are children living at home or is it expected children may be at home during service?
                </span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_children_living_at_home ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->miscellaneous->misc_children_living_at_home_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Weapons -->
        <tr>
            <td>
                <span class="label">
                    Are there weapons (e.g., guns, knives) stored appropriately? (gun safe, bolts/ammo separate)
                </span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_weapons_stored_appropriately ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->miscellaneous->misc_weapons_stored_appropriately_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Smoking -->
        <tr>
            <td>
                <span class="label">
                    Is smoking outside and not in presence of staff?
                </span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_smoking_outside_only ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->miscellaneous->misc_smoking_outside_only_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Mobility issues -->
        <tr>
            <td>
                <span class="label">
                    Does the participant have mobility issues? (e.g., wheelchair or other)
                </span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_mobility_issues ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->miscellaneous->misc_mobility_issues_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Equipment good condition -->
        <tr>
            <td>
                <span class="label">
                    Is the wheelchair and other equipment used in good working condition?
                </span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_equipment_good_condition ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->miscellaneous->misc_equipment_good_condition_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- PPE Requirements -->
        <tr>
            <td>
                <span class="label">
                    Are there any PPE requirements? (gloves, mask, eye protection, etc.)
                </span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_ppe_requirements ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->miscellaneous->misc_ppe_requirements_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Personal threats -->
        <tr>
            <td>
                <span class="label">
                    Are there any personal threats?
                </span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_personal_threats ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->miscellaneous->misc_personal_threats_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Safe neighbourhood -->
        <tr>
            <td>
                <span class="label">
                    Is it generally a safe neighbourhood?
                </span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_safe_neighbourhood ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
                <span class="value">{{ $assessment->miscellaneous->misc_safe_neighbourhood_strategy ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Aggression -->
        <tr>
            <td>
                <span class="label">
                    Does the participant or others in the home become aggressive?
                </span>
                <div class="enum-field">
                    @foreach(['Yes', 'No', 'N/A', 'Unsure'] as $option)
                        <span class="enum-option {{ ($assessment->miscellaneous->misc_aggression_in_home ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="strategy">
                <span class="label">Where there is a risk identified, please outline the management strategy  =</span>
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
