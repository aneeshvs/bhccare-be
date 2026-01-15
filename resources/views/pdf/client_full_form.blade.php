<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Client Referral Form</title>
    <style>
        @page {
            margin: 10mm;
            size: A4;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            margin-top: 80px !important;
            padding: 0;
            color: #000;
            line-height: 1.3;
            counter-reset: page;
            padding-bottom: 0px;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            background: white;
        }

        .page-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: white;
            padding: 4px 10mm;
            z-index: 1000;
            height: 45px;
            display: flex;
            align-items: center;
            box-sizing: border-box;
        }

        .page-header .logo {
            max-width: 60px;
            height: auto;
            margin-right: 10px;
        }

        .header-content {
            text-align: center;
            flex-grow: 1;
        }

        .header-title {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .document-number-container {
            position: absolute;
            top: 4px;
            right: 10mm;
            text-align: right;
        }

        .page-document-number {
            font-size: 9px;
            font-weight: 600;
            background-color: #bae6fd;
            padding: 2px 6px;
            border: 1px solid #000;
            border-radius: 3px;
            white-space: nowrap;
        }

        .section {
            margin-bottom: 8px;
            border: 1px solid #000;
            page-break-inside: avoid;
        }

        .section-header {
            background-color: #bae6fd;
            color: #000;
            padding: 6px;
            font-weight: bold;
            font-size: 10px;
            border-bottom: 1px solid #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: start;
        }
        
        .sub-section-header {
            background-color: #f3f4f6;
            color: #000;
            padding: 6px;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        th {
            background-color: #D6EEF7;
            color: #000;
            padding: 6px;
            text-align: center;
            border: 1px solid #000;
            font-weight: bold;
            font-size: 10px;
        }

        td {
            padding: 6px;
            vertical-align: top;
            border: 1px solid #000;
            font-size: 10px;
        }

        .field-label {
            background-color: #e0f2fe;
            font-weight: bold;
            width: 25%;
            padding: 6px;
            vertical-align: top;
            font-size: 10px;
        }

        .field-value {
            padding: 6px;
            vertical-align: top;
            font-size: 10px;
        }
        
        .empty-field {
            color: #666;
            font-style: italic;
        }

        /* Checkbox Styling */
        .checkbox-item {
            display: inline-block;
            margin-right: 15px;
            margin-bottom: 2px;
        }
        .checkbox-box {
            width: 10px;
            height: 10px;
            border: 1px solid #000;
            display: inline-block;
            margin-right: 4px;
            position: relative;
            background-color: #fff;
            vertical-align: middle;
        }
        .checkbox-box.checked {
            background-color: #666;
        }
        .checkbox-box.checked::after {
            content: '';
            position: absolute;
            left: 3px;
            top: 1px;
            width: 3px;
            height: 6px;
            border: solid #fff;
            border-width: 0 1px 1px 0;
            transform: rotate(45deg);
        }



        .intro-text {
            margin-bottom: 15px;
            font-style: italic;
            text-align: justify;
            font-size: 10px;
            padding: 0 10px;
        }
        
        /* Stylish Signature Pad */
        .signature-pad-container {
            width: 100%;
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 10px;
            box-sizing: border-box;
        }
        
        .signature-box-stylish {
            height: 40px;
            border-bottom: 2px dashed #9ca3af; /* Dotted/Dashed line for signing */
            width: 100%;
            position: relative;
        }
        
        .signature-placeholder {
            position: absolute;
            bottom: -15px;
            left: 0;
            font-size: 9px;
            color: #6b7280;
            font-style: italic;
        }
        
        .signature-label {
             font-size: 9px;
             color: #6b7280;
             margin-bottom: 5px;
             text-transform: uppercase;
             letter-spacing: 0.5px;
        }

        .signature-image {
            max-height: 40px;
            max-width: 200px;
            display: block;
        }

        .content-wrapper {
            margin-top: 50px;
        }

    </style>
</head>
<body>

    <!-- Header -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
             <div class="header-title">New Client Referral Form</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-28</div>
        </div>
    </div>



    <div class="content-wrapper">
        <div class="container">
            
            <div class="intro-text">
                BHC is committed to ensuring that participant outcomes are optimal when being supported by us. For this reason, all information about the potential incoming participant is required to ensure that the skill, qualifications, and experience of our team are able to meet the needs of the client. Providing information about other involved services will ensure that a collaborative approach is undertaken in supporting the client's potential support/tenancy, thus providing a holistic model of care.
            </div>
            
            @php
                $accommodation = isset($initial->accommodations) ? $initial->accommodations->first() : null;
            @endphp

            <!-- Accommodation & Support -->
            <div class="section">
                <div class="section-header">Accommodation & Support</div>
                <table>
                    <tr>
                        <td class="field-label" style="width: 25%">Type of Accommodation</td>
                        <td class="field-value" style="width: 75%">
                            @if ($accommodation && !empty($accommodation->type_of_accommodation))
                                {{ is_array($accommodation->type_of_accommodation) ? implode(', ', $accommodation->type_of_accommodation) : $accommodation->type_of_accommodation }}
                            @else
                                <span class="empty-field">N/A</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Requested Support</td>
                         <td class="field-value">
                            @if ($accommodation && !empty($accommodation->requested_support))
                                {{ is_array($accommodation->requested_support) ? implode(', ', $accommodation->requested_support) : $accommodation->requested_support }}
                            @else
                                <span class="empty-field">N/A</span>
                            @endif
                        </td>
                    </tr>
                     <tr>
                        <td class="field-label">Preference of Worker</td>
                        <td class="field-value">
                            <div style="display: flex; gap: 15px;">
                                @php $pref = $accommodation->worker_preference ?? ''; @endphp
                                <span class="checkbox-item"><span class="checkbox-box {{ $pref === 'Male' ? 'checked' : '' }}"></span> Male</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ $pref === 'Female' ? 'checked' : '' }}"></span> Female</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ $pref === 'No Preference' ? 'checked' : '' }}"></span> No Preference</span>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td class="field-label">Date Of Referral:</td>
                         <td class="field-value">
                            @if ($accommodation && !empty($accommodation->date_of_referral))
                                {{ \Carbon\Carbon::parse($accommodation->date_of_referral)->format('d/m/Y') }}
                            @else
                                <span class="empty-field">N/A</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <!-- 1. Client Details (Merged with Guardian Details) -->
            <div class="section">
                <div class="section-header">1. Client Details</div>
                <table>
                    <tr>
                        <td class="field-label" style="width: 20%">Full Name:</td>
                        <td class="field-value" style="width: 30%">{{ $initial->full_name }}</td>
                         <td class="field-label" style="width: 20%">Date of Birth:</td>
                        <td class="field-value" style="width: 30%">{{ \Carbon\Carbon::parse($initial->date_of_birth)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                         <td class="field-label">Gender:</td>
                        <td class="field-value" colspan="3">
                            <div style="display: flex; gap: 15px;">
                                @php $g = $initial->gender; @endphp
                                <span class="checkbox-item"><span class="checkbox-box {{ $g === 'Male' ? 'checked' : '' }}"></span> Male</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ $g === 'Female' ? 'checked' : '' }}"></span> Female</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ $g === 'Other' ? 'checked' : '' }}"></span> Other</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Residential Address:</td>
                        <td class="field-value" colspan="3">{{ $initial->residential_address }}</td>
                    </tr>
                     <tr>
                        <td class="field-label">Mobile:</td>
                        <td class="field-value">{{ $initial->mobile }}</td>
                         <td class="field-label">Email:</td>
                        <td class="field-value">{{ $initial->email }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">ATSI Status:</td>
                         <td class="field-value" colspan="3">
                             <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                 @php $atsi = $initial->atsi_status; @endphp
                                <span class="checkbox-item"><span class="checkbox-box {{ $atsi === 'Aboriginal' ? 'checked' : '' }}"></span> Aboriginal</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ $atsi === 'Torres Strait Islander' ? 'checked' : '' }}"></span> Torres Strait Islander</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ $atsi === 'Neither' ? 'checked' : '' }}"></span> Neither</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ $atsi === 'Both' ? 'checked' : '' }}"></span> Both</span>
                             </div>
                         </td>
                    </tr>
                     <tr>
                        <td class="field-label">Cultural Background:</td>
                        <td class="field-value">{{ $initial->cultural_background }}</td>
                         <td class="field-label">Language Spoken:</td>
                        <td class="field-value">{{ $initial->language_spoken }}</td>
                    </tr>
                     <tr>
                        <td class="field-label">Interpreter Required:</td>
                         <td class="field-value" colspan="3">
                             {{ $initial->interpreter_required ? 'Yes' : 'No' }}
                         </td>
                    </tr>
                    
                    <!-- Merged Guardian Details -->
                     <tr class="sub-section-header">
                         <td colspan="4">Guardian Details</td>
                     </tr>
                     <tr>
                        <td class="field-label">Legal Guardian Name / Plan Nominee:</td>
                        <td class="field-value" colspan="3">{{ $initial->guardian_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Is the Participant on Public Guardian or Temporary Guardian?</td>
                        <td class="field-value" colspan="3">{{ $initial->is_public_guardian ?? 'No' }}</td>
                    </tr>
                     <tr>
                        <td class="field-label">Guardian's Relationship to Participant:</td>
                        <td class="field-value" colspan="3">{{ $initial->guardian_relationship ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <td class="field-label">Guardian's Mobile:</td>
                        <td class="field-value">{{ $initial->guardian_mobile ?? 'N/A' }}</td>
                         <td class="field-label">Guardian's Email:</td>
                        <td class="field-value">{{ $initial->guardian_email ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <td class="field-label">Guardian's Residential Address:</td>
                        <td class="field-value" colspan="3">{{ $initial->guardian_address ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <td class="field-label">Guardian's Preferred Contact Method:</td>
                        <td class="field-value" colspan="3">{{ $initial->guardian_contact_method ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            @php
                $referral = isset($initial->referrals) ? $initial->referrals->first() : null;
            @endphp
            <!-- 2. Person Making Referral -->
            <div class="section">
                <div class="section-header">2. PERSON MAKING REFERRAL (if applicable)</div>
                <table>
                    <tr>
                        <td class="field-label">Agency/Organisation:</td>
                        <td class="field-value">{{ $referral->agency ?? 'N/A' }}</td>
                         <td class="field-label">Contact Name:</td>
                        <td class="field-value">{{ $referral->contact_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Job Title:</td>
                        <td class="field-value">{{ $referral->job_title ?? 'N/A' }}</td>
                         <td class="field-label">Work Contact (W):</td>
                        <td class="field-value">{{ $referral->work_contact ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Mobile (M):</td>
                        <td class="field-value">{{ $referral->referral_mobile ?? 'N/A' }}</td>
                         <td class="field-label">Email:</td>
                        <td class="field-value">{{ $referral->referral_email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label" colspan="2">I have Consent to Refer and Provide their Personal Information to Best of Homecare?</td>
                        <td class="field-value" colspan="2">
                            <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ (isset($referral->has_consent) && $referral->has_consent) ? 'checked' : '' }}"></span> Yes</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ (isset($referral->has_consent) && !$referral->has_consent) ? 'checked' : '' }}"></span> No</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- 3. Previous Service Providers -->
            <div class="section">
                <div class="section-header">3. PREVIOUS SERVICE PROVIDERS (SIL or OTHER)</div>
                 <table>
                    <thead>
                        <tr>
                             <th style="width: 25%">Provider</th>
                             <th style="width: 25%">Contact Details</th>
                             <th style="width: 20%">Length of Support</th>
                             <th style="width: 30%">Reason for Leaving or Cease of Service</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($initial->previousServiceProviders) && $initial->previousServiceProviders->count() > 0)
                            @foreach($initial->previousServiceProviders as $provider)
                            <tr>
                                <td>{{ $provider->provider ?? 'N/A' }}</td>
                                <td>{{ $provider->contact_details ?? 'N/A' }}</td>
                                <td>{{ $provider->length_of_support ?? 'N/A' }}</td>
                                <td>{{ $provider->reason_for_leaving ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr><td colspan="4">No previous providers listed</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- 4. Services Required -->
            <div class="section">
                <div class="section-header">4. SERVICES REQUIRED FROM BHC</div>
                <table>
                     <tr>
                        <td class="field-label">Select a Service:</td>
                        <td class="field-value">
                            @if(isset($initial->selectedServices) && $initial->selectedServices->count() > 0)
                                <ul style="margin: 0; padding-left: 20px;">
                                @foreach($initial->selectedServices as $service)
                                    <li>{{ $service->service_name }}</li>
                                @endforeach
                                </ul>
                            @else
                                <span class="empty-field">N/A</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            @php
                $ndis = $initial->clientNdisDetail;
            @endphp
            <!-- 5. Client NDIS Details -->
            <div class="section">
                <div class="section-header">5. CLIENT NDIS DETAILS</div>
                <table>
                    <tr>
                        <td class="field-label">NDIS Plan Approved</td>
                        <td class="field-value" colspan="3">
                            <div style="display: flex; gap: 15px;">
                                 @foreach(['Yes', 'No', 'Pending'] as $opt)
                                    <span class="checkbox-item"><span class="checkbox-box {{ (isset($ndis->ndis_plan_approved) && $ndis->ndis_plan_approved === $opt) ? 'checked' : '' }}"></span> {{ $opt }}</span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">NDIS Number</td>
                        <td class="field-value">{{ $ndis->ndis_number ?? 'N/A' }}</td>
                        <td class="field-label">NDIS Plan Start Date</td>
                        <td class="field-value">{{ isset($ndis->ndis_plan_start_date) ? \Carbon\Carbon::parse($ndis->ndis_plan_start_date)->format('d/m/Y') : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">NDIS Plan End Date</td>
                        <td class="field-value">{{ isset($ndis->ndis_plan_end_date) ? \Carbon\Carbon::parse($ndis->ndis_plan_end_date)->format('d/m/Y') : 'N/A' }}</td>
                         <td class="field-label">Plan Manager Name</td>
                        <td class="field-value">{{ $ndis->plan_manager_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Plan Manager Contact</td>
                        <td class="field-value" colspan="3">
                            Mobile: {{ $ndis->plan_manager_contact_mobile ?? 'N/A' }}<br>
                            Email: {{ $ndis->plan_manager_contact_email ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Choose What Best Describes Your Plan?</td>
                        <td class="field-value" colspan="3">
                            <div style="display: flex; gap: 15px;">
                                 @foreach(['Plan Managed', 'Agency Managed', 'Self-Managed'] as $opt)
                                    <span class="checkbox-item"><span class="checkbox-box {{ (isset($ndis->plan_type) && $ndis->plan_type === $opt) ? 'checked' : '' }}"></span> {{ $opt }}</span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Is A Copy of the Plan Provided?</td>
                        <td class="field-value">
                            <div style="display: flex; gap: 15px;">
                                 @foreach(['Yes', 'No'] as $opt)
                                    <span class="checkbox-item"><span class="checkbox-box {{ (isset($ndis->copy_of_plan_provided) && $ndis->copy_of_plan_provided === $opt) ? 'checked' : '' }}"></span> {{ $opt }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">If No, Why?</td>
                        <td class="field-value">{{ $ndis->reason_plan_not_provided ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Are there any Concerns that Might Impact the Client's Ability to Engage?</td>
                         <td class="field-value">
                            <div style="display: flex; gap: 15px;">
                                 @foreach(['Yes', 'No', 'Not Sure'] as $opt)
                                    <span class="checkbox-item"><span class="checkbox-box {{ (isset($ndis->engagement_concerns) && $ndis->engagement_concerns === $opt) ? 'checked' : '' }}"></span> {{ $opt }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">If Yes, Please Describe</td>
                        <td class="field-value">{{ $ndis->engagement_concerns_description ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            @php
                $medical = $initial->medicalInformation;
            @endphp
            <!-- 6. Client Medical Information -->
            <div class="section">
                <div class="section-header">6. CLIENT MEDICAL INFORMATION</div>
                <table>
                    <tr>
                        <td class="field-label">Primary Disability</td>
                        <td class="field-value">{{ $medical->primary_disability ?? 'N/A' }}</td>
                        <td class="field-label">Secondary Disability</td>
                        <td class="field-value">{{ $medical->secondary_disability ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label" colspan="4">Does the Participant Require High-Intensity Support?</td>
                    </tr>
                     <tr>
                        <td colspan="4">
                            <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->complex_bowel_care ? 'checked' : '' }}"></span> Complex Bowel Care</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->enteral_feeding ? 'checked' : '' }}"></span> Enteral Feeding</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->tracheostomy_care ? 'checked' : '' }}"></span> Tracheostomy Care</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->urinary_catheters ? 'checked' : '' }}"></span> Urinary Catheters</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->ventilation ? 'checked' : '' }}"></span> Ventilation</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->subcutaneous_injection ? 'checked' : '' }}"></span> Subcutaneous Injection</span>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td class="field-label">Communication (e.g., Verbal, Sign)</td>
                        <td class="field-value">{{ $medical->communication_method ?? 'N/A' }}</td>
                         <td class="field-label">Communication Assessment</td>
                        <td class="field-value">
                            <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->communication_assessment ? 'checked' : '' }}"></span> Completed</span>
                            <span class="checkbox-item"><span class="checkbox-box {{ (isset($medical) && !$medical->communication_assessment) ? 'checked' : '' }}"></span> Not Available</span>
                        </td>
                    </tr>
                    <tr>
                         <td class="field-label">Occupational Therapy Assessment</td>
                        <td class="field-value" colspan="3">
                            <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->occupational_therapy_assessment ? 'checked' : '' }}"></span> Completed</span>
                            <span class="checkbox-item"><span class="checkbox-box {{ (isset($medical) && !$medical->occupational_therapy_assessment) ? 'checked' : '' }}"></span> Not Available</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Mobility Aids Required</td>
                         <td class="field-value" colspan="3">
                            <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->hoisting ? 'checked' : '' }}"></span> Hoisting</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ !empty($medical->assisted_devices) ? 'checked' : '' }}"></span> Assisted Devices ({{ $medical->assisted_devices ?? '' }})</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ !empty($medical->mobility_other) ? 'checked' : '' }}"></span> Other ({{ $medical->mobility_other ?? '' }})</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Equipment Required</td>
                         <td class="field-value" colspan="3">
                            <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->hospital_bed ? 'checked' : '' }}"></span> Hospital Bed</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->pressure_mattresses ? 'checked' : '' }}"></span> Pressure Mattresses</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ !empty($medical->equipment_other) ? 'checked' : '' }}"></span> Other ({{ $medical->equipment_other ?? '' }})</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Challenging Behaviours</td>
                        <td class="field-value" colspan="3">
                            {{ optional($medical)->challenging_behaviours ? 'Yes' : 'No' }} (e.g., Aggressive, Absconding)
                        </td>
                    </tr>
                     <tr>
                        <td class="field-label">Is there a Positive Behaviour Support Plan (PBSP)?</td>
                        <td class="field-value">
                             <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->pbsp_attached ? 'checked' : '' }}"></span> Yes, Attached</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ (isset($medical) && !$medical->pbsp_attached) ? 'checked' : '' }}"></span> No</span>
                            </div>
                        </td>
                         <td class="field-label">If No, Is A PBSP Required?</td>
                        <td class="field-value">
                             <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->pbsp_required ? 'checked' : '' }}"></span> Yes</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ (isset($medical) && !$medical->pbsp_required) ? 'checked' : '' }}"></span> No</span>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td class="field-label">If Yes, Has a PBSP Review been Requested?</td>
                        <td class="field-value">
                             <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($medical)->pbsp_review_requested ? 'checked' : '' }}"></span> Yes</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ (isset($medical) && !$medical->pbsp_review_requested) ? 'checked' : '' }}"></span> No</span>
                            </div>
                        </td>
                         <td class="field-label">Behaviour Support Practitioner Contact Details</td>
                        <td class="field-value">{{ $medical->behaviour_support_practitioner_contact ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            @php
                $housing = $initial->housingHistory;
            @endphp
            <!-- 7. Housing History -->
            <div class="section">
                <div class="section-header">7. HOUSING HISTORY AND OTHER PROVIDER/GOVT SERVICE INVOLVEMENT</div>
                <table>
                    <tr>
                        <td class="field-label" colspan="2">Please Describe the Client Housing History (Previous 2 Years)</td>
                    </tr>
                    <tr>
                        <td class="field-label">Most Recent:</td>
                        <td class="field-value">{{ $housing->most_recent_housing ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                         <td class="field-label">Prior:</td>
                        <td class="field-value">{{ $housing->prior_housing ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label" colspan="2">Are there any Other Services or Government Departments Involved with the Participant?</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                             <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->mental_health_service ? 'checked' : '' }}"></span> Mental Health Service</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->aboriginal_service ? 'checked' : '' }}"></span> Aboriginal Service</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->communities_and_justice ? 'checked' : '' }}"></span> Department of Communities and Justice</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->family_violence ? 'checked' : '' }}"></span> Family Violence</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->correctional_service ? 'checked' : '' }}"></span> Correctional Service</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->child_protection ? 'checked' : '' }}"></span> Child Protection</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->drug_alcohol_rehabilitation ? 'checked' : '' }}"></span> Drug/Alcohol Rehabilitation</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->other_services_involved ? 'checked' : '' }}"></span> Other: {{ $housing->other_services_description ?? '' }}</span>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td class="field-label">Where Indicated Above, Please Provide Background Information</td>
                        <td class="field-value">{{ $housing->services_background_info ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <td class="field-label">Where Indicated Above, Please Provide Contact Details</td>
                        <td class="field-value">{{ $housing->services_contact_details ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <td class="field-label" colspan="2">Are there any Known Issues For:</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                             <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->issue_mental_health ? 'checked' : '' }}"></span> Mental Health Challenges</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->issue_drug_alcohol ? 'checked' : '' }}"></span> Drug/Alcohol</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->issue_family_violence ? 'checked' : '' }}"></span> Family Violence</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->issue_police_involvement ? 'checked' : '' }}"></span> Police Involvement</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->issue_child_protection ? 'checked' : '' }}"></span> Child Protection</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ optional($housing)->issue_child_custody ? 'checked' : '' }}"></span> Child Custody Arrangements</span>
                                 <span class="checkbox-item"><span class="checkbox-box {{ !empty($housing->issue_other_description) ? 'checked' : '' }}"></span> Other: {{ $housing->issue_other_description ?? '' }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-style: italic; font-size: 10px;">
                            Note: Section 6 and 8 do not have to be completed if Accommodation is not required for this Participant. However, if In-Home Supports are required, please complete the entire form.
                        </td>
                    </tr>
                </table>
            </div>
            
            @php
                $roster = $initial->rosterOfCare;
            @endphp
            <!-- 8. Roster Of Care -->
            <div class="section">
                <div class="section-header">8. ROSTER OF CARE (SIL or OTHER)</div>
                <table>
                     <tr>
                        <td class="field-label">Do you Need BHC Support for you to Participate in Community Activities?</td>
                        <td class="field-value">
                            <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($roster)->need_bhc_community_support ? 'checked' : '' }}"></span> Yes</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ (isset($roster) && !$roster->need_bhc_community_support) ? 'checked' : '' }}"></span> No</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Comments:</td>
                        <td class="field-value">{{ $roster->comments ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <td class="field-label">Transport Funding Available ($):</td>
                        <td class="field-value">{{ $roster->transport_funding ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <!-- 9. NDIS Plan - Current Goals -->
            <div class="section">
                <div class="section-header">9. NDIS PLAN – CURRENT GOALS</div>
                <table>
                     <thead>
                        <tr>
                             <th style="width: 10%">#</th>
                             <th style="width: 45%">Goal</th>
                             <th style="width: 45%">Barriers & Solutions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($initial->ndisGoals) && $initial->ndisGoals->count() > 0)
                            @foreach($initial->ndisGoals as $index => $goal)
                            <tr>
                                <td>Goal {{ $index + 1 }}</td>
                                <td>{{ $goal->goal ?? 'N/A' }}</td>
                                <td>{{ $goal->barriers ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr><td colspan="3">No goals provided</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            @php
                $ilo = $initial->independentLivingOption;
            @endphp
            <!-- 10. Independent Living Options -->
            <div class="section">
                <div class="section-header">10. INDEPENDENT LIVING OPTIONS (ILO)</div>
                <table>
                    <tr>
                        <td class="field-label">How much can you afford to pay per week for rent?</td>
                        <td class="field-value">{{ $ilo->rent_per_week ?? 'N/A' }}</td>
                         <td class="field-label">How much can you afford to pay per week for utilities?</td>
                        <td class="field-value">{{ $ilo->utilities_per_week ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <td class="field-label">Do you require fully furnished accommodation?</td>
                        <td class="field-value">
                             <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($ilo)->needs_furnished ? 'checked' : '' }}"></span> Yes</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ (isset($ilo) && !$ilo->needs_furnished) ? 'checked' : '' }}"></span> No</span>
                            </div>
                        </td>
                         <td class="field-label">Do you own your own furniture that you will be bringing to BHC accommodation?</td>
                        <td class="field-value">
                             <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($ilo)->owns_furniture ? 'checked' : '' }}"></span> Yes</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ (isset($ilo) && !$ilo->owns_furniture) ? 'checked' : '' }}"></span> No</span>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td class="field-label">How long would you like your lease to be?</td>
                        <td class="field-value" colspan="3">{{ $ilo->lease_duration ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <td class="field-label" colspan="2">For a 12-month lease, our standard terms for bond and rent in advance is 4 weeks' rent and 2 weeks' bond. Are you able to contribute to this prior to moving in?</td>
                         <td class="field-value" colspan="2">
                             <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($ilo)->can_pay_bond_upfront ? 'checked' : '' }}"></span> Yes</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ (isset($ilo) && !$ilo->can_pay_bond_upfront) ? 'checked' : '' }}"></span> No</span>
                            </div>
                        </td>
                    </tr>
                     <tr>
                        <td class="field-label">Do you have a preferred location you would like to live?</td>
                        <td class="field-value" colspan="3">{{ $ilo->preferred_location ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <td class="field-label">Would you prefer to live on your own or are you happy to share with others?</td>
                        <td class="field-value" colspan="3">
                             <div style="display: flex; gap: 15px;">
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($ilo)->living_preference === 'On Your Own' ? 'checked' : '' }}"></span> On Your Own</span>
                                <span class="checkbox-item"><span class="checkbox-box {{ optional($ilo)->living_preference === 'Share' ? 'checked' : '' }}"></span> Share</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            @php
                $declaration = $initial->finalDeclaration;
            @endphp
            <!-- Final Declaration & Submission -->
           <!-- Final Declaration & Submission -->
<div class="section page-start" style="border: none;">
    <div class="section-header">Final Declaration & Submission</div>

    <div class="section-body">
        <p>Please send this completed referral form with relevant documentation to:</p>
        <p><strong>Primary Email:</strong> enquiries@alignedcommunitycare.com.au</p>
        <p><strong>Secondary Email:</strong> admin@bestofhomecare.com.au</p>

        <p style="font-style: italic; font-size: 10px; margin-top: 10px;">
            Please note: Completing this form is not a guarantee that the service can and will be provided.
            BHC requires completion of a service agreement prior to service commencement.
        </p>
    </div>

    <!-- ================= Referrer Declaration ================= -->
    <div class="section-header" style="font-size: 13px;">Referrer Declaration</div>

    <table>
        @if($declaration)
            <tr>
                <td class="field-label">Date</td>
                <td class="field-value">
                    {{ $declaration->referrer_date
                        ? \Carbon\Carbon::parse($declaration->referrer_date)->format('d/m/Y')
                        : 'N/A' }}
                </td>
            </tr>

            <tr>
                <td class="field-label">Full Name</td>
                <td class="field-value">{{ $declaration->referrer_name ?? 'N/A' }}</td>
            </tr>

            <tr>
                <td class="field-label">Organisation</td>
                <td class="field-value">{{ $declaration->referrer_organisation ?? 'N/A' }}</td>
            </tr>

            <tr>
                <td class="field-label">Signature</td>
                <td class="field-value">
                    @if(!empty($declaration->referrer_signature))
                        <img src="{{ $declaration->referrer_signature }}"
                             class="signature-image"
                             alt="Referrer Signature">
                    @else
                         <div class="signature-pad-container">
                             <div class="signature-label">Sign Here</div>
                             <div class="signature-box-stylish"></div>
                         </div>
                    @endif
                </td>
            </tr>
        @else
            <tr>
                <td class="field-label">Referrer Declaration</td>
                <td class="field-value empty-field">No referrer declaration available</td>
            </tr>
        @endif
    </table>

    <!-- ================= Client Declaration ================= -->
    <div class="section-header" style="font-size: 13px;">Client Declaration</div>

    <table>
        @if($declaration)
            <tr>
                <td class="field-label">Date</td>
                <td class="field-value">
                    {{ $declaration->client_date
                        ? \Carbon\Carbon::parse($declaration->client_date)->format('d/m/Y')
                        : 'N/A' }}
                </td>
            </tr>

            <tr>
                <td class="field-label">Full Name</td>
                <td class="field-value">{{ $declaration->client_name ?? 'N/A' }}</td>
            </tr>

            <tr>
                <td class="field-label">Signature</td>
                <td class="field-value">
                    @if(!empty($declaration->client_signature))
                        <img src="{{ $declaration->client_signature }}"
                             class="signature-image"
                             alt="Client Signature">
                    @else
                         <div class="signature-pad-container">
                             <div class="signature-label">Sign Here</div>
                             <div class="signature-box-stylish"></div>
                         </div>
                    @endif
                </td>
            </tr>
        @else
            <tr>
                <td class="field-label">Client Declaration</td>
                <td class="field-value empty-field">No client declaration available</td>
            </tr>
        @endif
    </table>

    <!-- ================= Legal Guardian Declaration ================= -->
    <div class="section-header" style="font-size: 13px;">Legal Guardian (If Applicable)</div>

    <table>
        @if($declaration)
            <tr>
                <td class="field-label">Date</td>
                <td class="field-value">
                    {{ $declaration->guardian_date
                        ? \Carbon\Carbon::parse($declaration->guardian_date)->format('d/m/Y')
                        : 'N/A' }}
                </td>
            </tr>

            <tr>
                <td class="field-label">Full Name</td>
                <td class="field-value">
                    {{ $declaration->declaration_guardian_name ?? 'N/A' }}
                </td>
            </tr>

            <tr>
                <td class="field-label">Signature</td>
                <td class="field-value">
                    @if(!empty($declaration->guardian_signature))
                        <img src="{{ $declaration->guardian_signature }}"
                             class="signature-image"
                             alt="Guardian Signature">
                    @else
                         <div class="signature-pad-container">
                             <div class="signature-label">Sign Here</div>
                             <div class="signature-box-stylish"></div>
                         </div>
                    @endif
                </td>
            </tr>
        @else
            <tr>
                <td class="field-label">Guardian Declaration</td>
                <td class="field-value empty-field">No guardian declaration available</td>
            </tr>
        @endif
    </table>
</div>

        </div>
    </div>
</body>
</html>
