<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Plan - BHC</title>
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
            padding-bottom: 40px;
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






        .section-header1 {
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
            width: 25%;
            padding: 6px;
            vertical-align: top;
            font-size: 10px;
        }

        .full-width-label {
            font-weight: bold;
            width: 50%;
            padding: 6px;
            vertical-align: top;
            background-color: #e0f2fe;
            font-size: 10px;
        }

        .full-width-value {
            width: 50%;
            padding: 6px;
            vertical-align: top;
            font-size: 10px;
        }

        .empty-field {
            color: #666;
            font-style: italic;
        }

        .enum-field {
            display: flex;
            gap: 4px;
            margin-top: 1px;
            flex-wrap: wrap;
        }

        .enum-option {
            padding: 1px 3px;
            border: 1px solid #000;
            border-radius: 2px;
            background-color: #fff;
            color: #000;
            font-size: 9px;
            font-weight: 500;
        }

        .enum-option.selected {
            background-color: #666;
            color: #ffffff;
            border-color: #000;
            font-weight: bold;
        }

        .checkbox-item {
            display: flex;
            align-items: flex-start;
            gap: 4px;
            padding: 1px 0;
            margin-bottom: 1px;
            line-height: 1.1;
        }

        .checkbox-box {
            width: 8px;
            height: 8px;
            border: 1px solid #000;
            display: inline-block;
            flex-shrink: 0;
            position: relative;
            background-color: #fff;
            margin-top: 1px;
        }

        .checkbox-box.checked {
            background-color: #666;
        }

        .checkbox-box.checked::after {
            content: '';
            position: absolute;
            left: 1px;
            top: -1px;
            width: 3px;
            height: 5px;
            border: solid #fff;
            border-width: 0 1px 1px 0;
            transform: rotate(45deg);
        }

        ul {
            margin: 1px 0;
            padding-left: 8px;
        }

        li {
            margin-bottom: 1px;
            line-height: 1.2;
            font-size: 10px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            padding: 4px 15px;
            font-size: 8px;
            z-index: 100;
            height: 30px;
            box-sizing: border-box;
            border-top: 1px solid #000;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-table td {
            border: 1px solid #000;
            padding: 2px 6px;
            text-align: center;
            vertical-align: middle;
        }

        .footer-table td:first-child {
            text-align: left;
        }

        .footer-table td:last-child {
            text-align: right;
        }

        .page-break {
            page-break-before: always;
        }

        .content-wrapper {
            margin-top: 50px;
            margin-bottom: 35px;
        }

        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 2px;
            font-size: 10px;
        }

        .value {
            display: block;
            margin-top: 2px;
            font-size: 10px;
        }

        .section-body {
            padding: 6px;
        }

        .three-column-table {
            width: 100%;
            border-collapse: collapse;
        }

        .three-column-table td {
            border: none;
            padding: 1px 3px;
        }

        .health-conditions-table {
            width: 100%;
            border-collapse: collapse;
        }

        .health-conditions-table td {
            border: none;
            padding: 1px 3px;
            vertical-align: top;
        }

        .health-conditions-column {
            width: 33.33%;
        }

        .page-start {
            padding-top: 5px;
        }

        .page-break-avoid {
            page-break-inside: avoid;
        }

        .page-break-before {
            page-break-before: always;
        }

        .how-to-use {
            margin-bottom: 15px;
            padding: 8px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 10px;
        }

        .how-to-use-title {
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
            font-size: 12px;
        }

        .info-box {
            margin-bottom: 15px;
            border: 1px solid #000;
            page-break-inside: avoid;
        }

        .info-box-header {
            background-color: #bae6fd;
            color: #000;
            padding: 6px;
            font-weight: bold;
            font-size: 10px;
            border-bottom: 1px solid #000;
            text-align: center;
        }

        .info-box-content {
            padding: 8px;
            font-size: 10px;
            line-height: 1.3;
        }
    </style>
</head>
<body>
    <!-- Page Header -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SUPPORT PLAN</div>
        </div>
        <div class="document-number-container">
            {{-- <div class="page-document-number">Document Number: Form </div> --}}
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Information Boxes -->
            <div class="info-box">
                <div class="info-box-header">ABOUT THIS SUPPORT PLAN</div>
                <div class="info-box-content">
                    This Support Plan outlines how we will work with you to achieve your goals. It also confirms your approval
                    for us to provide the support and services you've agreed to.<br><br>
                    If your needs or circumstances change, the plan will be updated and re-approved by you.<br><br>
                    You'll always receive a copy of your current, approved plan for your records. We're here to support you
                    every step of the way.
                </div>
            </div>

            <div class="info-box">
                <div class="info-box-header">WELLNESS AND REABLEMENT</div>
                <div class="info-box-content">
                    We're committed to supporting you in embedding wellness and reablement into as many areas of your supports
                    and services as possible.<br><br>
                    Wellness and reablement means doing with rather than doing for—helping you maintain and build your
                    independence wherever we can.
                </div>
            </div>

            <div class="info-box">
                <div class="info-box-header">PUBLIC HOLIDAYS</div>
                <div class="info-box-content">
                    We do not provide care on public holidays unless this has been agreed to in your Support Plan and budget.
                    If your needs change and you require direct care visits on a Public Holiday, it may require adjustments
                    to your care plan to keep costs within budget.
                </div>
            </div>

            <!-- Your Support Plan -->
            <div class="section page-start">
                <div class="section-header">1.Your Support Plan</div>
                <table>
                    <tr>
                        <td class="field-label">This Support plan is effective from</td>
                        <td class="field-value">
                            {{ $supportPlan->effective_date ? \Carbon\Carbon::parse($supportPlan->effective_date)->format('d-m-Y') : 'N/A' }}
                        </td>

                        <td class="field-label">This Support plan will be reviewed no later than</td>
                        <td class="field-value">
                            {{ $supportPlan->review_date ? \Carbon\Carbon::parse($supportPlan->review_date)->format('d-m-Y') : 'N/A' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="field-label">Confirmation participant has received a copy of finalized Support Plan</td>
                        <td class="field-value">
                            {{ $supportPlan->confirmation_date ? \Carbon\Carbon::parse($supportPlan->confirmation_date)->format('d-m-Y') : 'N/A' }}
                        </td>

                        <td class="field-label">Who was involved in the development of this Support Plan</td>
                        <td class="field-value">
                            {{ $supportPlan->developed_by ?? 'N/A' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="field-label">Who was invited to participate in the development of this plan but declined/unable to participate</td>
                        <td class="field-value" colspan="3">
                            {{ $supportPlan->invited_but_not_participated ?? 'N/A' }}
                        </td>
                    </tr>
                </table>

            </div>

            <!-- Approval of Support Plan -->
            <div class="section">
                <div class="section-header">2.Approval of Support Plan</div>
                <table>
                    <tr>
                        <td class="field-label">Participant Name</td>
                        <td class="field-value">{{ $supportPlan->approval->participant_name ?? 'N/A' }}</td>
                        <td class="field-label">Date of Approval</td>
                        <td class="field-value">
                            {{ $supportPlan->approval->date_of_approval ? \Carbon\Carbon::parse($supportPlan->approval->date_of_approval)->format('d-m-Y') : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Signature</td>
                        <td class="field-value" colspan="3">
                            @if(!empty($signatureImage))
                                <img src="{{ $signatureImage }}" style="max-height:50px; border:1px solid #ccc; padding:2px;">
                            @else
                                <span class="empty-field">N/A</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Support Representative Approval -->
            <div class="section">
                <div class="section-header">3.Support Representative Approval</div>
                <table>
                    <tr>
                        <td class="full-width-label" colspan="4">
                            If the participant is unable to approve or the participant has requested co-approval, an approved support representative can sign
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Support Representative Name</td>
                        <td class="field-value">{{ $supportPlan->representativeApproval->support_representative_name ?? 'N/A' }}</td>
                        <td class="field-label">Role</td>
                        <td class="field-value">{{ $supportPlan->representativeApproval->role ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Date of Approval</td>
                        <td class="field-value" colspan="3">
                            {{ $supportPlan->representativeApproval->date_of_approval ? \Carbon\Carbon::parse($supportPlan->representativeApproval->date_of_approval)->format('d-m-Y') : 'N/A' }}
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Care Partner Information -->
            <div class="section">
                <div class="section-header">4.This form was facilitated by your Care Partner</div>
                <table>
                    <tr>
                        <td class="field-label">Name</td>
                        <td class="field-value">{{ $supportPlan->careApproval->care_partner_name ?? 'N/A' }}</td>
                        <td class="field-label">Role</td>
                        <td class="field-value">{{ $supportPlan->careApproval->care_partner_role ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Contact Phone</td>
                        <td class="field-value">{{ $supportPlan->careApproval->care_partner_contact_phone ?? 'N/A' }}</td>
                        <td class="field-label">Email</td>
                        <td class="field-value">{{ $supportPlan->careApproval->care_partner_email ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Keeping in Touch -->
            <div class="info-box">
                <div class="info-box-header">5.KEEPING IN TOUCH</div>
                <div class="info-box-content">
                    We'll check in with you at least once a month to make sure you're receiving the care and services you need
                    and to answer any questions.<br><br>
                    We may also contact you for a variety of reasons related to your care—such as confirming services,
                    discussing changes, reviewing your support plan, or responding to any concerns.<br><br>
                    That's why it's important that we know the best way to reach you.
                </div>
            </div>

            <!-- Communication Preferences -->
            <div class="section">
    <table>
        <tr>
            <th style="width: 30%">Question</th>
            <th style="width: 20%">Response</th>
            <th style="width: 50%">Details</th>
        </tr>

        <tr>
            <td class="field-label">
                Do you ever need help to communicate (to understand or be understood by others)?
            </td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->keep_in_touch->need_help_to_communicate ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value">
                {{ $supportPlan->keep_in_touch->type_of_difficulty ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">
                Should we contact you in the first instance?<br>
                <small>*If no, please refer to the Contacts section.</small>
            </td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->keep_in_touch->contact_first_instance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value">
                {{ $supportPlan->keep_in_touch->details ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">Language spoken</td>
            <td class="field-value" colspan="2">
                {{ $supportPlan->keep_in_touch->language_spoken ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">Do you use the National Relay Service (NRS)?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->keep_in_touch->use_nrs ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value">
                {{ $supportPlan->keep_in_touch->written ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">Do you require an interpreter?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->keep_in_touch->require_interpreter ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value">
                {{ $supportPlan->keep_in_touch->verbal ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">How do you want to know about schedule changes?</td>
            <td class="field-value" colspan="2">
                {{ $supportPlan->keep_in_touch->schedule_change_notification ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">
                Do you want to use a family/friend or would you like BHC to arrange an interpreter?
            </td>
            <td class="field-value" colspan="2">
                {{ $supportPlan->keep_in_touch->interpreter_arrangement ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">How do you want to receive financial/statement?</td>
            <td class="field-value" colspan="2">
                {{ $supportPlan->keep_in_touch->financial_statement_method ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">How do you want to receive feedback surveys?</td>
            <td class="field-value" colspan="2">
                {{ $supportPlan->keep_in_touch->feedback_survey_method ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">How do you want to receive marketing material?</td>
            <td class="field-value" colspan="2">
                {{ $supportPlan->keep_in_touch->marketing_material_method ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">How do you want to communicate with us?</td>
            <td class="field-value" colspan="2">
                {{ $supportPlan->keep_in_touch->preferred_communication_method ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">
                Do you want to be involved with the Consumer Advisory Body (CAB)?
            </td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->keep_in_touch->join_cab ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value"></td>
        </tr>

    </table>
</div>


            <!-- Non-Responsive Visit Plan -->
            @if(!empty($supportPlan->non_responsive))
<div class="section">
    <div class="section-header">6.Non-Response to a Scheduled Visit Plan</div>

    <div class="info-box-content">
        We are required to ensure the safety and wellbeing of participants. If you are not home for
        a scheduled visit, the following plan will be followed:
    </div>

    <table>
        <tr>
            <th style="width: 40%">Action</th>
            <th style="width: 20%">Required</th>
            <th style="width: 40%">Details</th>
        </tr>

        <tr>
            <td class="field-label">
                We will telephone your home and/or mobile number
            </td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->telephone_home_or_mobile ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value">
                {{ $supportPlan->non_responsive->telephone_details ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">
                Contact your listed emergency contact number
            </td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->contact_emergency_contact ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value">
                {{ $supportPlan->non_responsive->emergency_contact_details ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">
                Access your spare key, if you have identified where this is, and enter your home
                to determine that you have not had an accident or incident.
            </td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->access_spare_key ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value">
                {{ $supportPlan->non_responsive->spare_key_details ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">
                We will contact other persons you have identified
            </td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->contact_other_persons ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value">
                {{ $supportPlan->non_responsive->other_persons_details ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">
                If there is no access to a spare key available – contact with local police
                will be made to gain entry to your home
            </td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->contact_police_if_no_key ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value">
                {{ $supportPlan->non_responsive->police_contact_details ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">
                We will access your key lock
            </td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->access_key_lock ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td class="field-value">
                {{ $supportPlan->non_responsive->key_lock_code ?? 'N/A' }}
            </td>
        </tr>

        <tr>
            <td class="field-label">Key lock details</td>
            <td class="field-value" colspan="2">
                {{ $supportPlan->non_responsive->key_lock_details ?? 'N/A' }}
            </td>
        </tr>

    </table>
</div>
@endif

        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: <br>
                    Issue: {{ date('d F Y') }}
                </td>
                <td style="width: 34%">
                    Approver: Director<br>
                    UNCONTROLLED WHEN PRINTED
                </td>
                <td style="width: 33%">

                </td>
            </tr>
        </table>
    </div>

    <!-- Page 2 Header -->
    {{-- <div class="page-break"></div> --}}
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SUPPORT PLAN</div>
        </div>
        <div class="document-number-container">
            {{-- <div class="page-document-number">Document Number: Form </div> --}}
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Participant Details -->
            <div class="section page-start">
                <div class="section-header">7.Participant Details</div>
                <table>
                    <tr>
                        <td class="field-label">First Name</td>
                        <td class="field-value">{{ $supportPlan->participantDetail->first_name ?? 'N/A' }}</td>
                        <td class="field-label">Surname</td>
                        <td class="field-value">{{ $supportPlan->participantDetail->surname ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Preferred Name</td>
                        <td class="field-value">{{ $supportPlan->participantDetail->preferred_name ?? 'N/A' }}</td>
                        <td class="field-label">Date of Birth</td>
                        <td class="field-value">
                            {{ $supportPlan->participantDetail->date_of_birth ? \Carbon\Carbon::parse($supportPlan->participantDetail->date_of_birth)->format('d-m-Y') : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Country of Birth</td>
                        <td class="field-value">{{ $supportPlan->participantDetail->country_of_birth ?? 'N/A' }}</td>
                        <td class="field-label">Do you identify as Aboriginal or Torress Strait Island </td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($supportPlan->participantDetail->identify_as_aboriginal_or_torres_strait ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Gender</td>
                        <td class="field-value" colspan="3">
                            <div class="enum-field">
                                @foreach(['Male', 'Female', 'Other'] as $option)
                                    <span class="enum-option {{ ($supportPlan->participantDetail->gender === $option) ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Contact Details -->
            <div class="section">
                <div class="section-header">8.Contact Details</div>
                <table>
                    <tr>
                        <td class="field-label">Phone</td>
                        <td class="field-value">{{ $supportPlan->contactDetail->phone ?? 'N/A' }}</td>
                        <td class="field-label">Address</td>
                        <td class="field-value">{{ $supportPlan->contactDetail->address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Are you living in a rural or remote area </td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($supportPlan->contactDetail->is_rural_area ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">Mailing Address</td>
                        <td class="field-value">{{ $supportPlan->contactDetail->mailing_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Email</td>
                        <td class="field-value" colspan="3">{{ $supportPlan->contactDetail->email ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Secondary Contact Details -->
            <div class="section">
                <div class="section-header">9.Secondary Contact Details</div>
                <table>
                    <tr>
                        <td class="field-label">Role</td>
                        <td class="field-value">{{ $supportPlan->contactDetailSecondary->secondary_role ?? 'N/A' }}</td>
                        <td class="field-label">Phone</td>
                        <td class="field-value">{{ $supportPlan->contactDetailSecondary->secondary_phone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Email</td>
                        <td class="field-value">{{ $supportPlan->contactDetailSecondary->secondary_email ?? 'N/A' }}</td>
                        <td class="field-label">Address</td>
                        <td class="field-value">{{ $supportPlan->contactDetailSecondary->secondary_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Best Time to Contact</td>
                        <td class="field-value">{{ $supportPlan->contactDetailSecondary->secondary_best_time_to_contact ?? 'N/A' }}</td>
                        <td class="field-label">Is this role registered with MAC as a Support Representative? </td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ (isset($supportPlan->contactDetailSecondary->secondary_is_mac_registered) && (($supportPlan->contactDetailSecondary->secondary_is_mac_registered ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                                @if(!isset($supportPlan->contactDetailSecondary->secondary_is_mac_registered))
                                    <span class="empty-field">Not provided</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">List Documents</td>
                        <td class="field-value">{{ $supportPlan->contactDetailSecondary->secondary_list_documents ?? 'N/A' }}</td>
                        <td class="field-label">Confirmation legal documentation is stored in profile</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ (isset($supportPlan->contactDetailSecondary->secondary_legal_documentation_stored) && (($supportPlan->contactDetailSecondary->secondary_legal_documentation_stored ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                                @if(!isset($supportPlan->contactDetailSecondary->secondary_legal_documentation_stored))
                                    <span class="empty-field">Not provided</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Date legal orders end</td>
                        <td class="field-value">
                            {{ $supportPlan->contactDetailSecondary->secondary_date_legal_orders_end ? \Carbon\Carbon::parse($supportPlan->contactDetailSecondary->secondary_date_legal_orders_end)->format('d-m-Y') : 'N/A' }}
                        </td>
                        <td class="field-label">Participants Agreed Contact?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ (isset($supportPlan->contactDetailSecondary->secondary_participants_agreed_contact) && (($supportPlan->contactDetailSecondary->secondary_participants_agreed_contact ? 'Yes' : 'No') === $option)) ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                                @if(!isset($supportPlan->contactDetailSecondary->secondary_participants_agreed_contact))
                                    <span class="empty-field">Not provided</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Participants have agreed BHC will contact in these situations </td>
                        <td class="field-value">
                            {{ $supportPlan->contactDetailSecondary->secondary_participants_agreed_contact_date ? \Carbon\Carbon::parse($supportPlan->contactDetailSecondary->secondary_participants_agreed_contact_date)->format('d-m-Y') : 'N/A' }}
                        </td>
                        <td class="field-label">Decision Making Approval For</td>
                        <td class="field-value">{{ $supportPlan->contactDetailSecondary->secondary_decision_making_approval_for ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 2 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No:<br>
                    Issue: {{ date('d F Y') }}
                </td>
                <td style="width: 34%">
                    Approver: Director<br>
                    UNCONTROLLED WHEN PRINTED
                </td>
                <td style="width: 33%">

                </td>
            </tr>
        </table>
    </div>

    <!-- Page 3 Header -->
    {{-- <div class="page-break"></div> --}}
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SUPPORT PLAN</div>
        </div>
        <div class="document-number-container">
            {{-- <div class="page-document-number">Document Number: Form </div> --}}
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Funding -->
            <div class="section page-start">
                <div class="section-header">10.FUNDING</div>
                <table>
                    <tr>
                        <td class="field-label">Aged Care ID</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->aged_care_id ?? 'N/A' }}</td>
                        <td class="field-label">Pension Status</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->pension_status ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Pension Card Details</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->pension_card_details ?? 'N/A' }}</td>
                        <td class="field-label">Aged Pension Card Number</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->card_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Card Expiry</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->card_expiry ? \Carbon\Carbon::parse($supportPlan->SupportFunding->card_expiry)->format('d-m-Y') : 'N/A' }}</td>
                        <td class="field-label">Approved Funding Level</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->approved_funding_level ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Are you awaiting a package upgrade? </td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($supportPlan->SupportFunding->awaiting_package_upgrade ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">Upgrade Details</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->upgrade_details ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Do you have access to CHSP Referral Codes?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($supportPlan->SupportFunding->has_chsp_referral_codes ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">CHSP Referral Details</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->chsp_referral_details ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Are you a water veteran or a war widow?</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($supportPlan->SupportFunding->war_veteran_or_widow ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="field-label">DVA #</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->dva_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Medicare #</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->medicare_number ?? 'N/A' }}</td>
                        <td class="field-label">Private Health Insurance</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->private_health_insurance ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">HCP Funding Level</td>
                        <td class="field-value">{{ $supportPlan->SupportFunding->hcp_funding_level ?? 'N/A' }}</td>
                        <td class="field-label">Do you have a companion card</td>
                        <td class="field-value">
                            <div class="enum-field">
                                @foreach(['Yes', 'No'] as $option)
                                    <span class="enum-option {{ ($supportPlan->SupportFunding->has_companion_card ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Services -->
            <div class="section">
                <div class="section-header">11.Budget & Services accessed through us</div>
                <table>
                    <tr>
                        <th style="width: 20%">Name</th>
                        <th style="width: 25%">Service Provided</th>
                        <th style="width: 15%">Funded By</th>
                        <th style="width: 20%">Duration / Frequency</th>
                        <th style="width: 20%">Support to Implement by Us</th>
                    </tr>
                    @foreach ($supportPlan->services as $service)
                        <tr>
                            <td class="field-value">{{ $service->name }}</td>
                            <td class="field-value">{{ $service->service_provided }}</td>
                            <td class="field-value">{{ $service->funded_by }}</td>
                            <td class="field-value">{{ $service->duration_frequency }}</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    @foreach(['Yes', 'No'] as $option)
                                        <span class="enum-option {{ ($service->support_to_implement_by_us ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <!-- Employee Matching Needs -->
            <div class="section">
                <div class="section-header">12.Employee Matching Needs</div>
                <table>
                    <tr>
                        <td class="field-label">Cultural Considerations</td>
                        <td class="field-value" colspan="3">{{ $supportPlan->supportplan_employee->cultural_considerations ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Specific Training Required</td>
                        <td class="field-value" colspan="3">{{ $supportPlan->supportplan_employee->specific_training_required ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Common Interests</td>
                        <td class="field-value" colspan="3">{{ $supportPlan->supportplan_employee->common_interests ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <!-- My Goals -->
            <div class="section">
                <div class="section-header">13.MY GOALS</div>
                <table>
                    <tr>
                        <th style="width: 15%">Goal</th>
                        <th style="width: 20%">How will we measure progress</th>
                        <th style="width: 20%">What will success look like for you? </th>
                        <th style="width: 15%">Who will support you</th>
                        <th style="width: 15%">How articipant will support the goal </th>
                        <th style="width: 15%">When we aim to meet this goal</th>
                    </tr>
                    @foreach ($supportPlan->myGoals as $goal)
                        <tr>
                            <td class="field-value">{{ $goal->goal }}</td>
                            <td class="field-value">{{ $goal->measure_progress }}</td>
                            <td class="field-value">{{ $goal->success_look_like }}</td>
                            <td class="field-value">{{ $goal->who_will_support }}</td>
                            <td class="field-value">{{ $goal->participant_support }}</td>
                            <td class="field-value">{{ $goal->target_date }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>


    <!-- Footer for Page 3 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: <br>
                    Issue: {{ date('d F Y') }}
                </td>
                <td style="width: 34%">
                    Approver: Director<br>
                    UNCONTROLLED WHEN PRINTED
                </td>
                <td style="width: 33%">

                </td>
            </tr>
        </table>
    </div>


<!-- Living Arrangements -->
<div class="section">
    <div class="section-header">14.Living Arrangements</div>
    <table>
        <tr>
            <td class="field-label">I reside in</td>
            <td class="field-value">{{ $supportPlan->LivingArrangement->reside_in ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">I reside with</td>
            <td class="field-value">{{ $supportPlan->LivingArrangement->reside_with ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Date Home Safety Assessment completed</td>
            <td class="field-value">
                {{ optional($supportPlan->LivingArrangement)->home_safety_assessment_date
                    ? \Carbon\Carbon::parse($supportPlan->LivingArrangement->home_safety_assessment_date)->format('d-m-Y')
                    : 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">Is the home suitable to meet your needs?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->LivingArrangement->is_home_suitable ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details (if home is suitable/unsuitable)</td>
            <td class="field-value">{{ $supportPlan->LivingArrangement->home_suitable_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you at risk of homelessness?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->LivingArrangement->at_risk_of_homelessness ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Homelessness Details</td>
            <td class="field-value">{{ $supportPlan->LivingArrangement->homelessness_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

<!-- Cultural, Diversity & Identity -->
<div class="section">
    <div class="section-header">15.Cultural, Diversity & Identity</div>
    <table>
        <tr>
            <td class="field-label">Do you identify as a lesbian, gay, bisexual, transgender, or intersex person</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cultural_diversity)->is_lgbti ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cultural_diversity)->lgbti_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you identify as a person separated from your parents or children by forced adoption or removal</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cultural_diversity)->is_separated_family ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cultural_diversity)->separated_family_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are there cultural events, dates or practices we should be aware of?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cultural_diversity)->has_cultural_events ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cultural_diversity)->cultural_events_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are there events from your past you would like us to know about so we can support you safely?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cultural_diversity)->has_past_events ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cultural_diversity)->past_events_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are there any items discussed regarding your culture, diversity or identity that you would BHC to not disclose to others?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cultural_diversity)->has_non_disclosure_items ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cultural_diversity)->non_disclosure_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

<!-- General Health -->
<div class="section">
    <div class="section-header">16.General Health</div>
    <table>
        <tr>
            <td class="field-label">How regularly do you visit your GP?</td>
            <td class="field-value">{{ $supportPlan->general_health->gp_visit_frequency ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Diagnosis & Medication Conditions</td>
            <td class="field-value">{{ $supportPlan->general_health->diagnosis_medication_conditions ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Previous Surgeries</td>
            <td class="field-value">{{ $supportPlan->general_health->previous_surgeries ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">How much have health issues affected your normal activities? (1–10)</td>
            <td class="field-value">{{ $supportPlan->general_health->health_impact_scale ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Admitted to hospital in the last 12 months?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->admitted_hospital_last12months ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Admission Details</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->admitted_hospital_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have a preference for hospital if admitted?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->preferred_hospital ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Preferred Hospital Details</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->preferred_hospital_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have any allergies?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->has_allergies ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">List symptoms and response plan</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->allergy_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">During last 3 months has it been too painful to do day-to-day activities?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->painful_day_to_day ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Pain Details</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->painful_day_to_day_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Unintentional weight loss >5% in last 3 months?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->weight_loss_last3months ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Weight Loss Details</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->weight_loss_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have any weight loss or nutritional concerns?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->nutritional_concerns ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Nutritional Concern Details</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->nutritional_concerns_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Current Weight</td>
            <td class="field-value">{{ $supportPlan->general_health->current_weight ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you receive annual vaccinations?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->annual_vaccinations ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Annual Vaccination Details</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->annual_vaccination_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Last Influenza Vaccination</td>
            <td class="field-value">{{ $supportPlan->general_health->last_influenza_vaccine ? \Carbon\Carbon::parse($supportPlan->general_health->last_influenza_vaccine)->format('d-m-Y') : 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Last COVID-19 Vaccination</td>
            <td class="field-value">{{ $supportPlan->general_health->last_covid19_vaccine ? \Carbon\Carbon::parse($supportPlan->general_health->last_covid19_vaccine)->format('d-m-Y') : 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Last Pneumonia Vaccination</td>
            <td class="field-value">{{ $supportPlan->general_health->last_pneumonia_vaccine ? \Carbon\Carbon::parse($supportPlan->general_health->last_pneumonia_vaccine)->format('d-m-Y') : 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you experience any difficulties sleeping?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->sleep_difficulties ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Sleep Difficulty Details</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->sleep_difficulties_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">What is your sleep routine?</td>
            <td class="field-value">{{ $supportPlan->general_health->sleep_routine ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does any aspect of your sleep routine worry you?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->sleep_routine_worries ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Sleep Routine Worries Details</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->sleep_routine_worries_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you consume alcohol, smoke or use illegal drugs?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->alcohol_smoke_drug_use ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details of Alcohol/Smoking/Drug Use</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->alcohol_smoke_drug_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does your alcohol, smoking or drug use worry you?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->alcohol_smoke_drug_worries ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Substance Use Concern Details</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->alcohol_smoke_drug_worries_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is a referral required to support reduction of alcohol, smoking or drug use?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->general_health)->referral_required ? 'Yes':'No') === $option ? 'selected':'' }}">{{ $option }}</span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Referral Details</td>
            <td class="field-value">{{ optional($supportPlan->general_health)->referral_required_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

<!-- Medication Management -->
<div class="section">
    <div class="section-header">17.Medication Management</div>
    <table>
        @php
            $med = $supportPlan->medication_management;
        @endphp
        <tr>
            <td class="field-label">Medication form to be completed or provided by GP</td>
            <td class="field-value">{{ $med->medication_form ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Medication packaging</td>
            <td class="field-value">{{ $med->medication_packaging ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Specific storage requirements for medication (e.g., fridge temperature)</td>
            <td class="field-value">{{ $med->specific_storage_requirements ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Medication collection/delivery</td>
            <td class="field-value">{{ $med->medication_collection_delivery_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Date of last medication review?</td>
            <td class="field-value">
                {{ $med->last_medication_review_date
                    ? \Carbon\Carbon::parse($med->last_medication_review_date)->format('d-m-Y')
                    : 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">Do you take regular medications?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($med)->takes_regular_medications ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">List details</td>
            <td class="field-value">{{ $med->medication_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are the medications locked up?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($med)->medications_locked ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $med->medications_locked_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are any scheduled 4 or 8 medications?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($med)->scheduled_4_or_8_medications ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $med->scheduled_medications_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are any medications in chemical restraint?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($med)->chemical_restraint_medications ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
                <div><small>If yes, a BSP must be completed.</small></div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Do you ever take more than the prescribed dose of your medication?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($med)->takes_more_than_prescribed ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $med->takes_more_than_prescribed_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you at risk of missing medication?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($med)->at_risk_of_missing_medication ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $med->missing_medication_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you able to explain the purpose of your medication?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($med)->able_to_explain_purpose ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Do you need support with your medication?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($med)->needs_support_with_medication ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $med->support_with_medication_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does any aspect of your medication management worry you?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($med)->medication_management_worries ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $med->medication_management_worries_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does a medication service need to be implemented?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($med)->medication_service_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Support Worker Prompt</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($med)->support_worker_prompt ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
    </table>
</div>

<!-- Mobility & Transfers -->
<div class="section">
    <div class="section-header">18.Mobility & Transfers</div>
    <table>
        <tr>
            <td class="field-label">Are you able to walk independently?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_walk_independently ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->walk_independently_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you need support with transfers?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->needs_transfer_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Primary equipment used for mobility</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->primary_equipment_used ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Can you climb stairs safely?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_climb_stairs ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->climb_stairs_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have stairs in your house?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->has_stairs_at_home ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->stairs_at_home_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you able to transfer yourself from a chair, bed, etc.?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_transfer_self ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Are you able to transfer when not at home in different environments?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_transfer_in_other_envs ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Do you use a Bed Pole/Bed Rails?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->uses_bed_pole_or_rails ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">If yes, was this prescribed by an Occupational Therapist?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->bed_pole_prescribed_by_ot ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Are you able to get to places out of walking distance? (100m+)</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_access_places_outside_walking_distance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->access_places_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is it safe for you to mobilise in your back/front yard?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->safe_to_mobilise_in_yard ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->mobilise_yard_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">How do you access the community?</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->community_access ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you drive?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->drives ? 'Yes' : 'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">If yes, do any medications or conditions pose a safety risk?</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->driving_risk_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Equipment you use to aid mobility</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->mobility_equipment ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Did you self-purchase this equipment or was it recommended by an Occupational Therapist?</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->equipment_purchase_type ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you use a 4-wheel walker?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->uses_four_wheel_walker ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->four_wheel_walker_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you use a manual or electric wheelchair?</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->wheelchair_type ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">How do you operate your wheelchair?</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->wheelchair_operation ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Was the wheelchair recommended by an Occupational Therapist?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->wheelchair_ot_recommended ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Can you independently charge the wheelchair battery?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_charge_wheelchair ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Last service date for wheelchair</td>
            <td class="field-value">
                {{ $supportPlan->mobility_transfer?->last_wheelchair_service_date
                    ? \Carbon\Carbon::parse($supportPlan->mobility_transfer->last_wheelchair_service_date)->format('d-m-Y')
                    : 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">Are you able to carry items < 5kg while mobilising?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_carry_5kg ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
                {{ $supportPlan->mobility_transfer?->carry_5kg_details ?? 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">Any foot problems that impact your mobility?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->foot_problems ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->foot_problems_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are there any aspects of your mobility that worry you?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->mobility_worries ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->mobility_worries_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Date of last Occupational Therapist assessment</td>
            <td class="field-value">
                {{ $supportPlan->mobility_transfer?->last_ot_assessment_date
                    ? \Carbon\Carbon::parse($supportPlan->mobility_transfer->last_ot_assessment_date)->format('d-m-Y')
                    : 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">Is a new Occupational Therapist referral required?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->new_ot_referral_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">DEMMI Assessment required</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->demmi_assessment_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">DEMMI Score / Details</td>
            <td class="field-value">{{ $supportPlan->mobility_transfer?->demmi_assessment_result ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

<!-- Falls Risk -->
<div class="section">
    <div class="section-header">19.Falls Risk</div>
    <table>
        <tr>
            <td class="field-label">Have you had any recent falls or near miss falls in 6 months?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->fallsRisk)->recent_falls ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ optional($supportPlan->fallsRisk)->recent_falls_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Strategies to reduce falls risk?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->fallsRisk)->strategies_reduce_risk ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ optional($supportPlan->fallsRisk)->strategies_reduce_risk_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">If you fall, do you have a safety pendant to call for help?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->fallsRisk)->safety_pendant ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ optional($supportPlan->fallsRisk)->safety_pendant_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you worried about falling?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->fallsRisk)->worried_about_falling ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ optional($supportPlan->fallsRisk)->worried_about_falling_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is a referral to a falls clinic required?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->fallsRisk)->referral_falls_clinic ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ optional($supportPlan->fallsRisk)->referral_falls_clinic_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is a referral to an Occupational Therapist required?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->fallsRisk)->referral_ot ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ optional($supportPlan->fallsRisk)->fallrisk_referral_ot_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is a referral to a Physiotherapist/Exercise Physiologist required?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->fallsRisk)->referral_physio ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ optional($supportPlan->fallsRisk)->referral_physiotherapist_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

{{-- Cognition Section --}}
<!-- Cognition -->
<div class="section">
    <div class="section-header">20.Cognition</div>
    <table>
        <tr>
            <td class="field-label">Are there cognitive concerns?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->cognitive_concerns ? 'Yes':'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->cognitive_concerns_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have a diagnosis of dementia from a geriatrician or neurologist?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->diagnosis_dementia ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->diagnosis_dementia_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you capable of making your own decisions?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->capable_of_decisions ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->capable_of_decisions_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have an appointed Power of Attorney or Guardian?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->has_power_of_attorney ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->power_of_attorney_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you become confused at times?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->becomes_confused ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->becomes_confused_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Have you experienced delirium previously?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->experienced_delirium ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->experienced_delirium_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you feel anxious or worry a lot?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->anxious_or_worry ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->anxious_or_worry_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you experience short term memory loss?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->short_term_memory_loss ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->short_term_memory_loss_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you experience long term memory loss?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->long_term_memory_loss ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->long_term_memory_loss_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">For ATSI — does the KICA Regional C Urban - COG need to be completed?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->kica_cog_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Download Link</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->kica_cog_link ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">For ATSI — does the Kimberley Indigenous Cognitive Assessment: Carer Cognitive Informant need to be completed?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->kica_carer_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Download Link</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->kica_carer_link ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does the GPCOG need to be completed?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->gpcog_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Download Link</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->gpcog_link ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you require support with health literacy?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->health_literacy_support ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->health_literacy_support_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does the Geriatric Depression Scale need to be completed?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->gds_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Download Link</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->gds_link ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is a referral required for a Geriatrician?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->referral_geriatrician ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->referral_geriatrician_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is a referral required for a psychologist?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->referral_psychologist ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->referral_psychologist_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is a referral required for a psychiatrist?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cognition)->referral_psychiatrist ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->cognition)->referral_psychiatrist_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

<!-- Behaviour Support -->
<div class="section">
    <div class="section-header">21.Behaviour Support</div>
    <table>
        @if($supportPlan->behaviourSupport)
        <tr>
            <td class="field-label">Do you experience feeling agitation or frustration?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->feeling_agitation ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->feeling_agitation_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Have you had delusions or hallucinations previously?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->delusions_hallucinations ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->delusions_hallucinations_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are there changes to your personality that are out of character?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->personality_changes ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->personality_changes_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you wander around with no purpose?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->wandering ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->wandering_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Have you absconded previously or are there concerns of absconding?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->absconding ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->absconding_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you scream, yell or verbally threaten others?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->verbal_threats ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->verbal_threats_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you physically assault or threaten to assault others?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->physical_assault ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->physical_assault_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are there Restrictive Interventions occurring?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->restrictive_interventions ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->restrictive_interventions_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are the restrictive interventions approved by a Behaviour Support Practitioner?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->interventions_approved ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->interventions_approved_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is a referral to a Positive Behaviour Support Practitioner required?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->referral_pbsp ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->referral_pbsp_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is a Behaviour Support Plan required?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->behaviourSupport->bsp_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Date of expiry of current Behaviour Support Plan</td>
            <td class="field-value">
                {{ $supportPlan->behaviourSupport->bsp_expiry_date
                    ? \Carbon\Carbon::parse($supportPlan->behaviourSupport->bsp_expiry_date)->format('d/m/Y')
                    : 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">Current strategies being implemented</td>
            <td class="field-value">{{ $supportPlan->behaviourSupport->current_strategies ?? 'N/A' }}</td>
        </tr>
        @endif
    </table>
</div>

<!-- Personal Care -->
<div class="section">
    <div class="section-header">22.Personal Care</div>
    <table>
        @if($supportPlan->personalCare)
        <tr>
            <td class="field-label">Do you require support to maintain your daily personal care?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->support_daily_personal_care ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->personalCare->daily_personal_care_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you require support for showering?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->support_showering ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Showering Details</td>
            <td class="field-value">
                {{ $supportPlan->personalCare->showering_type ?? '' }}
                {{ $supportPlan->personalCare->showering_details ?? 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">Do you require support for undressing/dressing?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->support_dressing ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->personalCare->dressing_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">What is your dressing/undressing routine?</td>
            <td class="field-value">{{ $supportPlan->personalCare->dressing_routine ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have equipment in your shower/bathroom?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->equipment_in_bathroom ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->personalCare->equipment_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you require support with shaving?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->support_shaving ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->personalCare->shaving_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you require support with hair cuts?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->support_haircuts ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->personalCare->haircuts_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you want us to complete this task at home?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->task_at_home ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Do you wear dentures?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->wears_dentures ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->personalCare->dentures_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you need support with brushing your teeth?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->support_teeth_brushing ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->personalCare->teeth_brushing_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Have you had an Occupational Therapist assessment on your bathroom/shower?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->ot_bathroom_assessment ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Assessment Details</td>
            <td class="field-value">
                {{ $supportPlan->personalCare->ot_assessment_type ?? '' }}
                {{ $supportPlan->personalCare->ot_assessment_details ?? 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">What is your personal care routine?</td>
            <td class="field-value">{{ $supportPlan->personalCare->personal_care_routine ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you require a referral to an Occupational Therapist?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->personalCare->referral_ot_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->personalCare->plancare_referral_ot_details ?? 'N/A' }}</td>
        </tr>
        @endif
    </table>
</div>

<!-- Continence -->
<div class="section">
    <div class="section-header">23.Continence</div>
    <table>
        @if($supportPlan->continence)
        <tr>
            <td class="field-label">Do you have any identified needs regarding continence support?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->continence->identified_needs ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->continence->identified_needs_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you able to identify when you need to access the toilet?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->continence->identify_toilet_needs ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->continence->identify_toilet_needs_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you require prompting to use the toilet/change continence products?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->continence->require_prompting ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->continence->require_prompting_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you wear continence aids?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->continence->wears_continence_aids ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->continence->continence_aids_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does the RUIS assessment need to be completed?<br><small>Revised Urinary Incontinence Scale (RUIS)</small></td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->continence->ruis_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->continence->ruis_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does the RFIS assessment need to be completed?<br><small>My Aged Care – Integrated Assessment Tool (IAT) User Guide</small></td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->continence->rfis_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->continence->rfis_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you accessing funding for continence products?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->continence->funding_for_products ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->continence->funding_for_products_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Have you had a Continence Nurse Assessment previously?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->continence->nurse_assessment ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->continence->nurse_assessment_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does any aspect of your continence worry you?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->continence->worry_about_continence ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->continence->worry_about_continence_details ?? 'N/A' }}</td>
        </tr>
        @endif
    </table>
</div>

<!-- Vision -->
<div class="section">
    <div class="section-header">24.Vision</div>
    <table>
        @if($supportPlan->vision)
        <tr>
            <td class="field-label">Do you wear glasses or contact lenses?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->vision->wears_glasses_or_contacts ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">If yes, what type?</td>
            <td class="field-value">
                {{ $supportPlan->vision->wears_glasses_or_contacts && $supportPlan->vision->glasses_or_contacts_type
                    ? $supportPlan->vision->glasses_or_contacts_type
                    : 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">When do you wear them?</td>
            <td class="field-value">{{ $supportPlan->vision->vision_when_worn ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Last Optometrist Appointment Date</td>
            <td class="field-value">
                {{ $supportPlan->vision->last_optometrist_appointment
                    ? \Carbon\Carbon::parse($supportPlan->vision->last_optometrist_appointment)->format('d/m/Y')
                    : 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">Do any aspects of your vision worry you?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->vision->vision_worry ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->vision->vision_worry_details ?? 'N/A' }}</td>
        </tr>
        @endif
    </table>
</div>

<!-- Hearing -->
<div class="section">
    <div class="section-header">25.Hearing</div>
    <table>
        @if($supportPlan->hearing)
        <tr>
            <td class="field-label">Do you wear hearing devices?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->hearing->wears_hearing_devices ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->hearing->hearing_devices_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">When do you wear them?</td>
            <td class="field-value">{{ $supportPlan->hearing->when_worn ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Last Audiologist appointment Date</td>
            <td class="field-value">
                {{ $supportPlan->hearing->last_audiologist_appointment
                    ? \Carbon\Carbon::parse($supportPlan->hearing->last_audiologist_appointment)->format('d/m/Y')
                    : 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="field-label">Do any aspects of your hearing worry you?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->hearing->hearing_worry ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->hearing->hearing_worry_details ?? 'N/A' }}</td>
        </tr>
        @endif
    </table>
</div>

{{-- Skin Conditions --}}
<div class="section">
    <div class="section-header">26.Skin Conditions</div>
    <table>
        @if($supportPlan->skinCondition)
            <tr>
                <td class="field-label">Do you have any skin conditions?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->skinCondition->has_skin_condition ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Pressure Ulcer / Other Type</td>
                <td class="field-value">{{ $supportPlan->skinCondition->skin_condition_type ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Does your skin condition impact your day-to-day activities?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->skinCondition->impacts_daily_activities ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Date</td>
                <td class="field-value">
                    {{ $supportPlan->skinCondition->impact_date
                        ? \Carbon\Carbon::parse($supportPlan->skinCondition->impact_date)->format('d/m/Y')
                        : 'N/A' }}
                </td>
            </tr>
            <tr>
                <td class="field-label">What is the level of pain/discomfort?</td>
                <td class="field-value">{{ $supportPlan->skinCondition->pain_discomfort_level ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Significant Impact / Level</td>
                <td class="field-value">{{ $supportPlan->skinCondition->pain_level_score ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Strategies to manage the skin condition</td>
                <td class="field-value">{{ $supportPlan->skinCondition->management_strategies ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Does your skin condition worry you?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->skinCondition->skin_condition_worry ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Date</td>
                <td class="field-value">
                    {{ $supportPlan->skinCondition->worry_date
                        ? \Carbon\Carbon::parse($supportPlan->skinCondition->worry_date)->format('d/m/Y')
                        : 'N/A' }}
                </td>
            </tr>
            <tr>
                <td class="field-label">Is a referral to Nursing required?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->skinCondition->referral_nursing_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Date</td>
                <td class="field-value">
                    {{ $supportPlan->skinCondition->referral_nursing_date
                        ? \Carbon\Carbon::parse($supportPlan->skinCondition->referral_nursing_date)->format('d/m/Y')
                        : 'N/A' }}
                </td>
            </tr>
        @endif
    </table>
</div>

{{-- Dietary Requirements & Meal Preparation --}}
<div class="section">
    <div class="section-header">27.Dietary Requirements & Meal Preparation</div>
    <table>
        <tr>
            <td class="field-label">Intolerances</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->intolerances ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->dietary->intolerances_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are there dysphagia concerns?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->dysphagia_concerns ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->dietary->dysphagia_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Has a speech pathologist provided recommendations?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->speech_pathologist_recommendations ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">IDDSI Food categories</td>
            <td class="field-value">{{ $supportPlan->dietary->iddsi_food_category ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">IDDSI Liquid categories</td>
            <td class="field-value">{{ $supportPlan->dietary->iddsi_liquid_category ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you prepare all your meals?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->prepares_meals ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->dietary->prepares_meals_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you need support with meal preparation or meal delivery?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->needs_meal_support ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->dietary->meal_support_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you feel your current diet is meeting your needs?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->diet_meets_needs ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->dietary->diet_meets_needs_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you need support with cutting up meals?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->needs_cutting_support ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->dietary->cutting_support_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you require support with feeding?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->needs_feeding_support ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->dietary->feeding_support_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you want a referral to a Dietician?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->dietician_referral_required ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->dietary->dietician_referral_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you need support in completing food shopping/unpacking?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->needs_shopping_support ? 'Yes':'No') === $option ? 'selected':'' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->dietary->shopping_support_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

<div style="page-break-before: always;"></div>

{{-- Pain Management --}}
<div class="section">
    <div class="section-header">28.Pain Management</div>
    <table>
        @if($supportPlan->painManagement)
            <tr>
                <td class="field-label">Do you have ongoing pain?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->painManagement->ongoing_pain ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->painManagement->pain_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Location of the pain</td>
                <td class="field-value">{{ $supportPlan->painManagement->pain_location ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Frequency of the pain</td>
                <td class="field-value">{{ $supportPlan->painManagement->pain_frequency ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Scale of the pain (1 = Low, 10 = Significant)</td>
                <td class="field-value">{{ $supportPlan->painManagement->pain_scale ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Are you currently being supported to manage your pain?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->painManagement->supported_for_pain ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->painManagement->supported_pain_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Does the Abbey Pain Scale need to be completed?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->painManagement->abbey_pain_scale_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                    <div style="margin-top: 4px; font-size: 9px;">
                        Department of Health | Abbey Pain Scale
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Strategies to manage the pain</td>
                <td class="field-value">{{ $supportPlan->painManagement->pain_management_strategies ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Does any aspect of your pain worry you?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->painManagement->pain_worry ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->painManagement->pain_worry_details ?? 'N/A' }}</td>
            </tr>
        @endif
    </table>
</div>

{{-- Social Connections & Community Access --}}
<div class="section">
    <div class="section-header">29.Social Connections & Community Access</div>
    <table>
        <tr>
            <td class="field-label">Do you ever feel lonely?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->feels_lonely ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->socialConnection->feels_lonely_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have informal supports from friends, family, or neighbours?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->has_informal_supports ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->socialConnection->informal_supports_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you want to engage more with the local community?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->wants_more_community_engagement ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->socialConnection->community_engagement_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you want us to support you to engage with your local community more?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->wants_support_for_community_engagement ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->socialConnection->support_for_community_engagement_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you need support accessing the community?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->needs_community_access_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->socialConnection->community_access_support_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have a multi-purpose taxi card?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->has_taxi_card ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->socialConnection->taxi_card_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Would you be interested in being connected with the Community Visitors Program?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->interested_in_visitors_program ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->socialConnection->visitors_program_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Hobbies and activities participant enjoys</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->has_hobbies_activities ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->socialConnection->hobbies_activities_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does the Duke Social Support Index need to be completed?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->needs_duke_index ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->socialConnection->duke_index_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

{{-- Maintaining Your Home --}}
<div class="section">
    <div class="section-header">30.Maintaining Your Home</div>
    <table>
        @if($supportPlan->homeMaintenance)
            <tr>
                <td class="field-label">Do you need support with domestic assistance within the home?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->homeMaintenance->needs_domestic_assistance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Independent / Type of Domestic Assistance</td>
                <td class="field-value">{{ $supportPlan->homeMaintenance->domestic_assistance_type ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->homeMaintenance->domestic_assistance_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">If you require our support with Domestic Assistance, do you also need help obtaining safe and approved cleaning products and equipment?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->homeMaintenance->needs_help_with_cleaning_products ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->homeMaintenance->cleaning_products_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Do you need support with maintaining your gardens to be safe?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->homeMaintenance->needs_garden_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->homeMaintenance->garden_support_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Do you have any trouble navigating the house at night?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->homeMaintenance->trouble_navigating_at_night ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->homeMaintenance->navigating_at_night_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Are there any aspects of maintaining your home that worry you?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->homeMaintenance->home_maintenance_worries ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->homeMaintenance->home_maintenance_worries_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Date Home Safety Assessment was last completed</td>
                <td class="field-value">
                    {{ $supportPlan->homeMaintenance->last_home_safety_assessment
                        ? \Carbon\Carbon::parse($supportPlan->homeMaintenance->last_home_safety_assessment)->format('d/m/Y')
                        : 'N/A' }}
                </td>
            </tr>
            <tr>
                <td class="field-label">Key areas of focus to be supported identified from Home</td>
                <td class="field-value">{{ $supportPlan->homeMaintenance->home_safety_focus_areas ?? 'N/A' }}</td>
            </tr>
        @endif
    </table>
</div>

{{-- Financial Support --}}
<div class="section">
    <div class="section-header">31.Financial Support</div>
    <table>
        @if($supportPlan->financialSupport)
            <tr>
                <td class="field-label">Do you have a Power of Attorney or Financial Guardian?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes','No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->financial_has_power_of_attorney ? 'Yes':'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->financialSupport->financial_power_of_attorney_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Do you have access to your own money?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes','No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->has_access_to_money ? 'Yes':'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->financialSupport->access_to_money_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Are you at risk of financial abuse?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes','No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->at_risk_of_abuse ? 'Yes':'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->financialSupport->risk_of_abuse_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Do you need support to pay bills/attend bank?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes','No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->needs_support_for_bills ? 'Yes':'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->financialSupport->support_for_bills_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Do you ever find that you don't have enough money to purchase food or pay your bills?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes','No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->not_enough_money ? 'Yes':'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->financialSupport->not_enough_money_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Do you want support to engage with a financial hardship/counsellor?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes','No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->support_financial_counsellor ? 'Yes':'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->financialSupport->financial_counsellor_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Do you want support to access Government initiatives such as the Utility Relief Grant Scheme?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes','No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->support_government_initiatives ? 'Yes':'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details:</td>
                <td class="field-value">{{ $supportPlan->financialSupport->government_initiatives_details ?? 'N/A' }}</td>
            </tr>
        @endif
    </table>
</div>

{{-- Informal Supports --}}
<div class="section">
    <div class="section-header">32.Informal Supports</div>
    <table>
        @if($supportPlan->informalSupport)
            <tr>
                <td class="field-label">Are you the primary caregiver for another person?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->informalSupport->is_primary_caregiver ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details</td>
                <td class="field-value">{{ $supportPlan->informalSupport->primary_caregiver_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Are you receiving help from a carer, family member, friend or someone else?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->informalSupport->receiving_help ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details</td>
                <td class="field-value">{{ $supportPlan->informalSupport->receiving_help_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Does the carer live with you?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->informalSupport->carer_lives_with_you ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details</td>
                <td class="field-value">{{ $supportPlan->informalSupport->carer_lives_with_you_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Does the carer receive a pension?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->informalSupport->carer_receives_pension ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Carer's Allowance Details</td>
                <td class="field-value">{{ $supportPlan->informalSupport->carer_pension_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Are there factors affecting carer availability and sustainability of care relationship?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->informalSupport->factors_affecting_care ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details</td>
                <td class="field-value">{{ $supportPlan->informalSupport->factors_affecting_care_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">If yes, Caregiver Strain Index form must be completed</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->informalSupport->caregiver_strain_index_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                    <div style="margin-top: 4px; font-size: 9px;">
                        https://www.nslhd.health.nsw.gov.au/carer/Documents/Caregiver%20Strain%20Index%20PDF.pdf
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Carer Gateway referral suitable</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->informalSupport->carer_gateway_referral ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="field-label">Details</td>
                <td class="field-value">{{ $supportPlan->informalSupport->carer_gateway_referral_details ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="field-label">Is your primary caregiver receiving a Carer's Allowance?</td>
                <td class="field-value">
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->informalSupport->primary_caregiver_receives_allowance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
        @endif
    </table>
</div>

{{-- Emergency Readiness - Safeguarding --}}
<div class="section">
    <div class="section-header">33.Emergency Readiness - Safeguarding</div>
    <table>
        <tr>
            <td class="field-label">Are you experiencing or at risk of abuse or neglect?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->emergency_at_risk_of_abuse ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->emergencyReadiness->abuse_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Is a referral to OPAN required?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->opan_referral_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->emergencyReadiness->opan_referral_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you at risk of declining services?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->risk_of_declining_services ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->emergencyReadiness->declining_services_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are there any indicators that the participant is neglecting their personal care, nutrition, or safety?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->neglect_indicators ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->emergencyReadiness->neglect_indicators_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Can emergency vehicles easily identify & access your property?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->emergency_accessible ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->emergencyReadiness->emergency_accessible_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have emergency support in place if your carer is suddenly unavailable?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->emergency_support_available ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->emergencyReadiness->emergency_support_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Does the participant need to be added to the Vulnerable Persons Register (VPR)?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->vpr_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->emergencyReadiness->vpr_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

{{-- Fire & Heat Readiness --}}
{{-- Fire & Heat Readiness --}}
<div class="section">
    <div class="section-header">34.Fire & Heat Readiness</div>
    <table>
        <tr>
            <td class="field-label">Do you require support to prepare your home for the fire season, such as gutter cleaning, tree pruning etc.?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->home_preparation_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->fireHeatReadiness->home_preparation_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you able to maintain hydration & easily access fluids during warm weather?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->hydration_access ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->fireHeatReadiness->hydration_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have and use cooling in your home during warm weather?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->home_cooling ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->fireHeatReadiness->home_cooling_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have multiple exit points from your home and street in case of a fire?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->multiple_exit_points ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->fireHeatReadiness->exit_points_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you able to identify the risk of bushfire or fire and know when to evacuate?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->identify_fire_risk ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->fireHeatReadiness->fire_risk_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Can you evacuate independently?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->can_evacuate_independently ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->fireHeatReadiness->evacuate_independently_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have support from family or a neighbour who checks in on you during warm days?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->support_from_family_or_neighbour ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details:</td>
            <td class="field-value">{{ $supportPlan->fireHeatReadiness->support_from_family_or_neighbour_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

{{-- Storm or Flooding --}}
<div class="section">
    <div class="section-header">35.Storm or Flooding</div>
    <table>
        <tr>
            <td class="field-label">Do you require support to prepare your home for storms, such as gutter cleaning, tree pruning, etc.?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->stormFlooding->storm_home_preparation_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->stormFlooding->storm_home_preparation_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have multiple exit points from your home and street in case of flooding?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->stormFlooding->storm_multiple_exit_points ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->stormFlooding->storm_multiple_exit_points_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you able to identify the risk of flooding and know when to evacuate?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->stormFlooding->identify_flood_risk ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->stormFlooding->identify_flood_risk_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Can you evacuate independently?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->stormFlooding->storm_can_evacuate_independently ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->stormFlooding->storm_evacuate_independently_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have support from a family member or neighbour who checks in on you during a storm?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->stormFlooding->storm_support_from_family_or_neighbour ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->stormFlooding->storm_support_from_family_or_neighbour_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

{{-- Telecommunication Outage --}}
<div class="section">
    <div class="section-header">36.Telecommunication Outage</div>
    <table>
        <tr>
            <td class="field-label">Are you able to independently leave your home during a telecommunication outage?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->telecommunicationOutage?->independent_leave_home ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->telecommunicationOutage?->independent_leave_home_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have a support such as family or neighbour who will check in on you during a telecommunication outage?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->telecommunicationOutage?->has_support_checkin ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->telecommunicationOutage?->has_support_checkin_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you require us to complete a welfare check during a telecommunication outage &gt;5 hours?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->telecommunicationOutage?->welfare_check_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->telecommunicationOutage?->welfare_check_required_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

{{-- Power Outage --}}
<div class="section">
    <div class="section-header">37.Power Outage</div>
    <table>
        <tr>
            <td class="field-label">Do you have medical equipment that is reliant on power?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->has_medical_equipment ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Do you have a backup power supply such as a generator or battery?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->has_backup_power ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->powerOutage?->backup_power_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you registered with 'Life Support equipment' with your energy provider for priority reestablishment of power?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->registered_life_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">If yes, how many hours supply does it provide?</td>
            <td class="field-value">{{ $supportPlan->powerOutage?->life_support_hours_supply ? $supportPlan->powerOutage->life_support_hours_supply . ' hrs' : 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">If yes, which provider?</td>
            <td class="field-value">{{ $supportPlan->powerOutage?->life_support_provider ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Are you able to independently leave your home during a power outage?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->power_independent_leave_home ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->powerOutage?->power_independent_leave_home_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have support such as family or neighbour who will check in on you during a power outage?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->power_has_support_checkin ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->powerOutage?->power_has_support_checkin_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you require us to complete a welfare check during a power outage &gt;5 hours?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->power_welfare_check_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ $supportPlan->powerOutage?->power_welfare_check_required_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

{{-- End of Life - Advanced Care Planning --}}
<div class="section">
    <div class="section-header">38.End of Life - Advanced Care Planning</div>
    <table>
        <tr>
            <td class="field-label">Are you receiving palliative care?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->endOfLifeAdvancedCarePlanning)->receiving_palliative_care ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->endOfLifeAdvancedCarePlanning)->receiving_palliative_care_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you require support to initiate palliative care services?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->endOfLifeAdvancedCarePlanning)->support_to_initiate_palliative_care ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->endOfLifeAdvancedCarePlanning)->support_to_initiate_palliative_care_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have an advanced care plan?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->endOfLifeAdvancedCarePlanning)->has_advanced_care_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->endOfLifeAdvancedCarePlanning)->advanced_care_plan_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">If no, do you want support in completing an Advanced Care Plan?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->endOfLifeAdvancedCarePlanning)->support_to_complete_advanced_care_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->endOfLifeAdvancedCarePlanning)->support_to_complete_advanced_care_plan_details ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-label">Do you have a Do Not Resuscitate (DNR)?</td>
            <td class="field-value">
                <div class="enum-field">
                    @foreach(['Yes','No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->endOfLifeAdvancedCarePlanning)->has_dnr ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td class="field-label">Details</td>
            <td class="field-value">{{ optional($supportPlan->endOfLifeAdvancedCarePlanning)->dnr_details ?? 'N/A' }}</td>
        </tr>
    </table>
</div>





</div>

</body>
</html>
