<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Plan - BHC</title>
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
    word-break: break-word; /* For long text */
    max-width: 200px; /* Adjust as needed */
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

    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="document-number">Document Number: <span>Form F-</span></div>
        <div class="header-title">Client Support Plan</div>
    </div>

    <div class="section">
        <div class="section-header">Support Plan Details</div>
        <table>
            <tr>
                <td>
                    <span class="label">Effective Date</span>
                    <span class="value">{{ $supportPlan->effective_date ? \Carbon\Carbon::parse($supportPlan->effective_date)->format('d-m-Y') : 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Review Date</span>
                    <span class="value">{{ $supportPlan->review_date ? \Carbon\Carbon::parse($supportPlan->review_date)->format('d-m-Y') : 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Confirmation Date</span>
                    <span class="value">{{ $supportPlan->confirmation_date ? \Carbon\Carbon::parse($supportPlan->confirmation_date)->format('d-m-Y') : 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Developed By</span>
                    <span class="value">{{ $supportPlan->developed_by ?? 'N/A' }}</span>
                </td>
                <td colspan="2">
                    <span class="label">Invited But Not Participated</span>
                    <span class="value">{{ $supportPlan->invited_but_not_participated ?? 'N/A' }}</span>
                </td>
            </tr>

        </table>
    </div>
    <div class="section">
        <div class="section-header">Approval of Support Plan</div>
        <table>
            <tr>
                <td>
                    <span class="label">Participant Name</span>
                    <span class="value">{{ $supportPlan->approval->participant_name ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Date of Approval</span>
                    <span class="value">
                        {{ $supportPlan->approval->date_of_approval ? \Carbon\Carbon::parse($supportPlan->approval->date_of_approval)->format('d-m-Y') : 'N/A' }}
                    </span>
                </td>
                <th style="text-align:left; width:35%; padding:8px;"> Signature</th>
                <td style="padding:8px;">

                    @if(!empty($signatureImage))
                        <img src="{{ $signatureImage }}" style="max-height:70px; border:1px solid #ccc; padding:4px;">
                    @else
                        <span>N/A</span>
                    @endif
                </td>




            </tr>
        </table>
    </div>

    {{-- ✅ If participant unable to approve / co-approval needed --}}
<div class="section">
    <div class="section-header">Support Representative Approval</div>
    <table>
        <tr>
            <td>
                <span class="label">Support Representative Name</span>
                <span class="value">{{ $supportPlan->representativeApproval->support_representative_name ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Role</span>
                <span class="value">{{ $supportPlan->representativeApproval->role ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Date of Approval</span>
                <span class="value">
                    {{ $supportPlan->representativeApproval->date_of_approval ? \Carbon\Carbon::parse($supportPlan->representativeApproval->date_of_approval)->format('d-m-Y') : 'N/A' }}
                </span>
            </td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-header">Care Partner Details</div>
    <table>
        <tr>
            <td>
                <span class="label">Name</span>
                <span class="value">{{ $supportPlan->careApproval->care_partner_name ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Role</span>
                <span class="value">{{ $supportPlan->careApproval->care_partner_role ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Contact Phone</span>
                <span class="value">{{ $supportPlan->careApproval->care_partner_contact_phone ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Email</span>
                <span class="value">{{ $supportPlan->careApproval->care_partner_email ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

<!--Keepsintouch -->

<div class="section">
    <div class="section-header">Keeping in Touch</div>
    <table>
        <tr>
            <td>
                <span class="label">Need Help to Communicate</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->keep_in_touch->need_help_to_communicate ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Type of Difficulty</span>
                <span class="value">{{ $supportPlan->keep_in_touch->type_of_difficulty ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Contact First Instance</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->keep_in_touch->contact_first_instance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Details</span>
                <span class="value">{{ $supportPlan->keep_in_touch->details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Language Spoken</span>
                <span class="value">{{ $supportPlan->keep_in_touch->language_spoken ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Use NRS</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->keep_in_touch->use_nrs ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Require Interpreter</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->keep_in_touch->require_interpreter ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Written</span>
                <span class="value">{{ $supportPlan->keep_in_touch->written ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Verbal</span>
                <span class="value">{{ $supportPlan->keep_in_touch->verbal ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Schedule Change Notification</span>
                <span class="value">{{ $supportPlan->keep_in_touch->schedule_change_notification ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Interpreter Arrangement</span>
                <span class="value">{{ $supportPlan->keep_in_touch->interpreter_arrangement ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Financial Statement Method</span>
                <span class="value">{{ $supportPlan->keep_in_touch->financial_statement_method ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Feedback Survey Method</span>
                <span class="value">{{ $supportPlan->keep_in_touch->feedback_survey_method ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Marketing Material Method</span>
                <span class="value">{{ $supportPlan->keep_in_touch->marketing_material_method ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Preferred Communication Method</span>
                <span class="value">{{ $supportPlan->keep_in_touch->preferred_communication_method ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Join Consumer Advisory Body</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->keep_in_touch->join_cab ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>



{{-- ===================== Non-Responsive Visit Plan ===================== --}}
@if(!empty($supportPlan->non_responsive))
<div class="section">
    <div class="section-header">Non-Responsive Visit Plan</div>

    <table width="100%" cellspacing="0" cellpadding="6" style="border-collapse: collapse; font-size: 13px;">
        <tr>
            <td width="50%">
                <span class="label">Telephone (Home or Mobile)</span><br>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->telephone_home_or_mobile ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td width="50%">
                <span class="label">Telephone Details</span><br>
                <span class="value">{{ $supportPlan->non_responsive->telephone_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Contact Emergency Contact</span><br>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->contact_emergency_contact ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Emergency Contact Details</span><br>
                <span class="value">{{ $supportPlan->non_responsive->emergency_contact_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Access Spare Key</span><br>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->access_spare_key ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Spare Key Details</span><br>
                <span class="value">{{ $supportPlan->non_responsive->spare_key_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Contact Other Persons</span><br>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->contact_other_persons ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Other Persons Details</span><br>
                <span class="value">{{ $supportPlan->non_responsive->other_persons_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Contact Police If No Spare Key</span><br>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->contact_police_if_no_key ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Police Contact Details</span><br>
                <span class="value">{{ $supportPlan->non_responsive->police_contact_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Access Key Lock</span><br>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->non_responsive->access_key_lock ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Key Lock Code</span><br>
                <span class="value">{{ $supportPlan->non_responsive->key_lock_code ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <span class="label">Key Lock Details</span><br>
                <span class="value">{{ $supportPlan->non_responsive->key_lock_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
@endif


<!--participant deatils  -->

<div class="section">
    <div class="section-header">Participant Details</div>
    <table>
        <tr>
            <td>
                <span class="label">First Name</span>
                <span class="value">{{ $supportPlan->participantDetail->first_name ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Surname</span>
                <span class="value">{{ $supportPlan->participantDetail->surname ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Preferred Name</span>
                <span class="value">{{ $supportPlan->participantDetail->preferred_name ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Date of Birth</span>
                <span class="value">
                    {{ $supportPlan->participantDetail->date_of_birth ? \Carbon\Carbon::parse($supportPlan->participantDetail->date_of_birth)->format('d-m-Y') : 'N/A' }}
                </span>
            </td>
            <td>
                <span class="label">Country of Birth</span>
                <span class="value">{{ $supportPlan->participantDetail->country_of_birth ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Aboriginal / Torres Strait Islander</span>
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
            <td colspan="3">
                <span class="label">Gender</span>
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


<!--contact details -->
<div style="page-break-before: always;"></div>

<div class="section">
    <div class="section-header">Contact Details</div>
    <table>
        <tr>
            <td>
                <span class="label">Phone</span>
                <span class="value">{{ $supportPlan->contactDetail->phone ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Address</span>
                <span class="value">{{ $supportPlan->contactDetail->address ?? 'N/A' }}</span>
            </td>
           <td>
                <span class="label">Living in Rural Area</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->contactDetail->is_rural_area ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Mailing Address</span>
                <span class="value">{{ $supportPlan->contactDetail->mailing_address ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Email</span>
                <span class="value">{{ $supportPlan->contactDetail->email ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
<!-- seconadry contact deatils-->
<div class="section">
    <div class="section-header">Secondary Contact Details</div>
    <table>
        <tr>
            <td>
                <span class="label">Role</span>
                <span class="value">{{ $supportPlan->contactDetailSecondary->secondary_role ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Phone</span>
                <span class="value">{{ $supportPlan->contactDetailSecondary->secondary_phone ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Email</span>
                <span class="value">{{ $supportPlan->contactDetailSecondary->secondary_email ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Address</span>
                <span class="value">{{ $supportPlan->contactDetailSecondary->secondary_address ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Best Time to Contact</span>
                <span class="value">{{ $supportPlan->contactDetailSecondary->secondary_best_time_to_contact ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">MAC Registered?</span>
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
            <td>
                <span class="label">List Documents</span>
                <span class="value">{{ $supportPlan->contactDetailSecondary->secondary_list_documents ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Legal Documentation Stored?</span>
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
            <td>
                <span class="label">Legal Orders End Date</span>
                <span class="value">
                    {{ $supportPlan->contactDetailSecondary->secondary_date_legal_orders_end ? \Carbon\Carbon::parse($supportPlan->contactDetailSecondary->secondary_date_legal_orders_end)->format('d-m-Y') : 'N/A' }}
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Participants Agreed Contact?</span>
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
            <td>
                <span class="label">Participants Agreed Contact Date</span>
                <span class="value">
                    {{ $supportPlan->contactDetailSecondary->secondary_participants_agreed_contact_date ? \Carbon\Carbon::parse($supportPlan->contactDetailSecondary->secondary_participants_agreed_contact_date)->format('d-m-Y') : 'N/A' }}
                </span>
            </td>
            <td>
                <span class="label">Decision Making Approval For</span>
                <span class="value">{{ $supportPlan->contactDetailSecondary->secondary_decision_making_approval_for ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-header">SupportFunding Details</div>
    <table>
        <tr>
            <td>
                <span class="label">Aged Care ID</span>
                <span class="value">{{ $supportPlan->SupportFunding->aged_care_id ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Pension Status</span>
                <span class="value">{{ $supportPlan->SupportFunding->pension_status ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Pension Card Details</span>
                <span class="value">{{ $supportPlan->SupportFunding->pension_card_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Card Number</span>
                <span class="value">{{ $supportPlan->SupportFunding->card_number ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Card Expiry</span>
                <span class="value">{{ $supportPlan->SupportFunding->card_expiry ? \Carbon\Carbon::parse($supportPlan->SupportFunding->card_expiry)->format('d-m-Y') : 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Approved SupportFunding Level</span>
                <span class="value">{{ $supportPlan->SupportFunding->approved_funding_level ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Awaiting Package Upgrade</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->SupportFunding->awaiting_package_upgrade ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Upgrade Details</span>
                <span class="value">{{ $supportPlan->SupportFunding->upgrade_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">CHSP Referral codes</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->SupportFunding->has_chsp_referral_codes ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">CHSP Referral Details</span>
                <span class="value">{{ $supportPlan->SupportFunding->chsp_referral_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">War Veteran / Widow</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->SupportFunding->war_veteran_or_widow ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">DVA #</span>
                <span class="value">{{ $supportPlan->SupportFunding->dva_number ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Medicare #</span>
                <span class="value">{{ $supportPlan->SupportFunding->medicare_number ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Private Health Insurance</span>
                <span class="value">{{ $supportPlan->SupportFunding->private_health_insurance ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">HCP SupportFunding Level</span>
                <span class="value">{{ $supportPlan->SupportFunding->hcp_funding_level ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="label">Companion Card</span>
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
 <!--service section -->
  <div class="section">
    <div class="section-header"> SUPPORT PLAN SERVICES</div>
    <div class="section-body">
        <table>
            <thead>
                <tr>
                    <td><span class="label">Service Name</span></td>
                    <td><span class="label">Service Provided</span></td>
                    <td><span class="label">Funded By</span></td>
                    <td><span class="label">Duration / Frequency</span></td>
                    <td><span class="label">Support to Implement by Us</span></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($supportPlan->services as $service)
                    <tr>
                        <td><span class="value">{{ $service->name }}</span></td>
                        <td><span class="value">{{ $service->service_provided }}</span></td>
                        <td><span class="value">{{ $service->funded_by }}</span></td>
                        <td><span class="value">{{ $service->duration_frequency }}</span></td>
                        <td>
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
            </tbody>
        </table>
    </div>
</div>



<div class="section">
    <div class="section-header">Employee Matching Needs</div>
    <table>
        <tr>
            <td>
                <span class="label">Cultural Considerations</span>
                <span class="value">{{ $supportPlan->supportplan_employee->cultural_considerations ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Specific Training Required</span>
                <span class="value">{{ $supportPlan->supportplan_employee->specific_training_required ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="label">Common Interests</span>
                <span class="value">{{ $supportPlan->supportplan_employee->common_interests ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

<!--mygoals -->
<div class="section">
    <div class="section-header"> SUPPORT PLAN MY GOALS</div>
    <div class="section-body">
        <table>
            <thead>
                <tr>
                    <td><span class="label">Goal</span></td>
                    <td><span class="label">How will we measure this goal’s progress</span></td>
                    <td><span class="label">What will success look like for you?</span></td>
                    <td><span class="label">Who will support you</span></td>
                    <td><span class="label">How participant will support the goal</span></td>
                    <td><span class="label">When we aim to meet this goal</span></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($supportPlan->myGoals as $goal)
                    <tr>
                        <td><span class="value">{{ $goal->goal }}</span></td>
                        <td><span class="value">{{ $goal->measure_progress }}</span></td>
                        <td><span class="value">{{ $goal->success_look_like }}</span></td>
                        <td><span class="value">{{ $goal->who_will_support }}</span></td>
                        <td><span class="value">{{ $goal->participant_support }}</span></td>
                        <td><span class="value">{{ $goal->when_to_meet_goal }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--living arrangement-->
<div class="section">
    <div class="section-header">Living Arrangements</div>
    <table>
        <tr>
            <td>
                <span class="label">I reside in</span>
                <span class="value">{{ $supportPlan->LivingArrangement->reside_in ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">I reside with</span>
                <span class="value">{{ $supportPlan->LivingArrangement->reside_with ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Date Home Safety Assessment completed</span>
                <span class="value">
                    {{ optional($supportPlan->LivingArrangement)->home_safety_assessment_date
                        ? \Carbon\Carbon::parse($supportPlan->LivingArrangement->home_safety_assessment_date)->format('d-m-Y')
                        : 'N/A' }}
                </span>
            </td>

            <td>
                <span class="label">Is the home suitable to meet your needs?</span>
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
            <td colspan="2">
                <span class="label">Details (if home is suitable/unsuitable)</span>
                <span class="value">{{ $supportPlan->LivingArrangement->home_suitable_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Are you at risk of homelessness?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->LivingArrangement->at_risk_of_homelessness ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Homelessness Details</span>
                <span class="value">{{ $supportPlan->LivingArrangement->homelessness_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
<!-- diversity sections -->

<div class="section">
    <div class="section-header">Cultural, Diversity & Identity</div>
    <table>
        <tr>
            <td>
                <span class="label">Do you identify as a lesbian, gay, bisexual, transgender, or intersex person</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cultural_diversity)->is_lgbti ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Details</span>
                <span class="value">{{ optional($supportPlan->cultural_diversity)->lgbti_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Separated from parents or children by forced adoption or removal</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cultural_diversity)->is_separated_family ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Details</span>
                <span class="value">{{ optional($supportPlan->cultural_diversity)->separated_family_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Are there cultural events, dates or practices we should be aware of?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cultural_diversity)->has_cultural_events ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Details</span>
                <span class="value">{{ optional($supportPlan->cultural_diversity)->cultural_events_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Are there past events we should know to support you safely?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cultural_diversity)->has_past_events ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Details</span>
                <span class="value">{{ optional($supportPlan->cultural_diversity)->past_events_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Any cultural/diversity/identity items not to disclose?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->cultural_diversity)->has_non_disclosure_items ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Details</span>
                <span class="value">{{ optional($supportPlan->cultural_diversity)->non_disclosure_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

<!-- general health -->

<div class="section">
    <div class="section-header">General Health</div>
    <div class="section-body">
        <table>
            <tr>
                <td>
                    <span class="label">How regularly do you visit your GP?</span>
                    <span class="value">{{ $supportPlan->general_health->gp_visit_frequency ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Diagnosis & Medication Conditions</span>
                    <span class="value">{{ $supportPlan->general_health->diagnosis_medication_conditions ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Previous Surgeries</span>
                    <span class="value">{{ $supportPlan->general_health->previous_surgeries ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Impact of Health Issues (1–10)</span>
                    <span class="value">{{ $supportPlan->general_health->health_impact_scale ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Current Weight</span>
                    <span class="value">{{ $supportPlan->general_health->current_weight ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Sleep Routine</span>
                    <span class="value">{{ $supportPlan->general_health->sleep_routine ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Last Influenza Vaccination</span>
                    <span class="value">
                        {{ $supportPlan->general_health->last_influenza_vaccine
                            ? \Carbon\Carbon::parse($supportPlan->general_health->last_influenza_vaccine)->format('d-m-Y')
                            : 'N/A' }}
                    </span>
                </td>
                <td>
                    <span class="label">Last COVID-19 Vaccination</span>
                    <span class="value">
                        {{ $supportPlan->general_health->last_covid19_vaccine
                            ? \Carbon\Carbon::parse($supportPlan->general_health->last_covid19_vaccine)->format('d-m-Y')
                            : 'N/A' }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Last Pneumonia Vaccination</span>
                    <span class="value">
                        {{ $supportPlan->general_health->last_pneumonia_vaccine
                            ? \Carbon\Carbon::parse($supportPlan->general_health->last_pneumonia_vaccine)->format('d-m-Y')
                            : 'N/A' }}
                    </span>
                </td>
                <td></td>
            </tr>

            <!-- Yes/No questions with their details in same row -->
            <tr>
                <td>
                    <span class="label">Admitted to hospital in last 12 months?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->admitted_hospital_last12months ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Admission Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->admitted_hospital_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Preferred Hospital?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->preferred_hospital ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Preferred Hospital Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->preferred_hospital_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Allergies?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->has_allergies ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Allergy Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->allergy_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Pain affecting daily activities?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->painful_day_to_day ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Pain Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->painful_day_to_day_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Weight loss in last 3 months?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->weight_loss_last3months ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Weight Loss Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->weight_loss_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Nutritional Concerns?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->nutritional_concerns ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Nutritional Concerns Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->nutritional_concerns_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Annual Vaccinations?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->annual_vaccinations ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Vaccination Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->annual_vaccination_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Sleep Difficulties?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->sleep_difficulties ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Sleep Difficulties Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->sleep_difficulties_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Concerns about Sleep Routine?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->sleep_routine_worries ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Sleep Routine Concerns Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->sleep_routine_worries_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Alcohol / Smoke / Drug Use?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->alcohol_smoke_drug_use ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Substance Use Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->alcohol_smoke_drug_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Concerns about Alcohol/Drug Use?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->alcohol_smoke_drug_worries ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Substance Use Concerns Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->alcohol_smoke_drug_worries_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral Required for Alcohol/Drug Use?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->general_health)->referral_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Referral Details</span>
                    <span class="value">{{ optional($supportPlan->general_health)->referral_required_details ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>
</div>
<!-- medications -->

<div class="section">
    <div class="section-header">Medication Management</div>
    <div class="section-body">
        @php
            $med = $supportPlan->medication_management;
        @endphp

        <table>
            <tr>
                <td>
                    <span class="label">Medication Form</span>
                    <span class="value">{{ $med->medication_form ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Medication Packaging</span>
                    <span class="value">{{ $med->medication_packaging ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Specific Storage Requirements</span>
                    <span class="value">{{ $med->specific_storage_requirements ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Medication Collection/Delivery</span>
                    <span class="value">{{ $med->medication_collection_delivery_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Last Medication Review</span>
                    <span class="value">
                        {{ $med->last_medication_review_date
                            ? \Carbon\Carbon::parse($med->last_medication_review_date)->format('d-m-Y')
                            : 'N/A' }}
                    </span>
                </td>
                <td></td>
            </tr>

            <!-- Yes/No questions with their details in same row -->
            <tr>
                <td>
                    <span class="label">Takes Regular Medications?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->takes_regular_medications ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Medication Details</span>
                    <span class="value">{{ $med->medication_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Medications Locked?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->medications_locked ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Medications Locked Details</span>
                    <span class="value">{{ $med->medications_locked_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Scheduled 4/8 Medications?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->scheduled_4_or_8_medications ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Scheduled Medications Details</span>
                    <span class="value">{{ $med->scheduled_medications_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Chemical Restraint Medications?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->chemical_restraint_medications ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td></td>
            </tr>

            <tr>
                <td>
                    <span class="label">Takes More Than Prescribed?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->takes_more_than_prescribed ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Takes More Than Prescribed Details</span>
                    <span class="value">{{ $med->takes_more_than_prescribed_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">At Risk of Missing Medication?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->at_risk_of_missing_medication ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Missing Medication Details</span>
                    <span class="value">{{ $med->missing_medication_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Able to Explain Purpose?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->able_to_explain_purpose ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td></td>
            </tr>

            <tr>
                <td>
                    <span class="label">Needs Support With Medication?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->needs_support_with_medication ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Support With Medication Details</span>
                    <span class="value">{{ $med->support_with_medication_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Medication Management Worries?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->medication_management_worries ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Medication Management Worries Details</span>
                    <span class="value">{{ $med->medication_management_worries_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Medication Service Required?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->medication_service_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td></td>
            </tr>

            <tr>
                <td>
                    <span class="label">Support Worker Prompt?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($med)->support_worker_prompt ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
</div>
<!-- mobility transfer -->
<div class="section">
    <div class="section-header">Mobility & Transfers</div>
    <table>
        <!-- Regular text fields at the top -->
        <tr>
            <td>
                <span class="label">Access to community</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->community_access ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Mobility equipment</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->mobility_equipment ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Equipment purchase type</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->equipment_purchase_type ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Wheelchair type</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->wheelchair_type ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Wheelchair operation</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->wheelchair_operation ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Last wheelchair service date</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer?->last_wheelchair_service_date
                        ? \Carbon\Carbon::parse($supportPlan->mobility_transfer->last_wheelchair_service_date)->format('d-m-Y')
                        : 'N/A' }}
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Last OT assessment date</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer?->last_ot_assessment_date
                        ? \Carbon\Carbon::parse($supportPlan->mobility_transfer->last_ot_assessment_date)->format('d-m-Y')
                        : 'N/A' }}
                </span>
            </td>
            <td>
                <span class="label">Assessment result</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->demmi_assessment_result ?? 'N/A' }}</span>
            </td>
        </tr>

        <!-- Yes/No questions with their details in same row -->
        <tr>
            <td>
                <span class="label">Able to walk independently?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_walk_independently ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Walk Independently Details</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->walk_independently_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Need support with transfers?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->needs_transfer_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Primary Equipment Used</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->primary_equipment_used ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Can climb stairs safely?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_climb_stairs ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Climb Stairs Details</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->climb_stairs_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Has stairs at home?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->has_stairs_at_home ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Stairs at Home Details</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->stairs_at_home_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Able to transfer self (chair, bed, etc.)?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_transfer_self ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Able to transfer in other environments?</span>
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
            <td>
                <span class="label">Use a Bed Pole/Bed Rails?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->uses_bed_pole_or_rails ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Prescribed by OT?</span>
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
            <td>
                <span class="label">Can access places outside walking distance?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_access_places_outside_walking_distance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Access Places Details</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->access_places_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Safe to mobilise in yard?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->safe_to_mobilise_in_yard ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Mobilise Yard Details</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->mobilise_yard_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do you drive?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->drives ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
                {{ $supportPlan->mobility_transfer?->driving_risk_details ? '(Risk: ' . $supportPlan->mobility_transfer->driving_risk_details . ')' : '' }}
            </td>
            <td></td>
        </tr>

        <tr>
            <td>
                <span class="label">Use a 4-wheel walker?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->uses_four_wheel_walker ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">4-Wheel Walker Details</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->four_wheel_walker_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Wheelchair recommended by OT?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->wheelchair_ot_recommended ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Can charge wheelchair battery?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_charge_wheelchair ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Can carry items &lt; 5kg?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->can_carry_5kg ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
                {{ $supportPlan->mobility_transfer?->carry_5kg_details ?? '' }}
            </td>
            <td></td>
        </tr>

        <tr>
            <td>
                <span class="label">Foot problems?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->foot_problems ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Foot Problems Details</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->foot_problems_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Mobility worries?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->mobility_worries ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Mobility Worries Details</span>
                <span class="value">{{ $supportPlan->mobility_transfer?->mobility_worries_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">New OT referral required?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->new_ot_referral_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">DEMMI Assessment required?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->mobility_transfer?->demmi_assessment_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
    </table>
</div>
 {{-- Falls Risk Section --}}
<div class="section">
    <div class="section-header">Falls Risk</div>
    <div class="section-body">
        <table>
            <!-- Yes/No questions with their details in same row -->
            <tr>
                <td>
                    <span class="label">Recent falls in last 6 months?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->fallsRisk)->recent_falls ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Recent Falls Details</span>
                    <span class="value">{{ optional($supportPlan->fallsRisk)->recent_falls_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Strategies to reduce falls risk?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->fallsRisk)->strategies_reduce_risk ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Strategies Details</span>
                    <span class="value">{{ optional($supportPlan->fallsRisk)->strategies_reduce_risk_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Safety pendant available?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->fallsRisk)->safety_pendant ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Safety Pendant Details</span>
                    <span class="value">{{ optional($supportPlan->fallsRisk)->safety_pendant_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Worried about falling?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->fallsRisk)->worried_about_falling ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Worried About Falling Details</span>
                    <span class="value">{{ optional($supportPlan->fallsRisk)->worried_about_falling_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral to Falls Clinic?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->fallsRisk)->referral_falls_clinic ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Falls Clinic Referral Details</span>
                    <span class="value">{{ optional($supportPlan->fallsRisk)->referral_falls_clinic_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral to Occupational Therapist?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->fallsRisk)->referral_ot ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">OT Referral Details</span>
                    <span class="value">{{ optional($supportPlan->fallsRisk)->fallrisk_referral_ot_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral to Physiotherapist?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->fallsRisk)->referral_physio ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Physiotherapist Referral Details</span>
                    <span class="value">{{ optional($supportPlan->fallsRisk)->referral_physiotherapist_details ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>
</div>

{{-- Cognition Section --}}
<div class="section">
    <div class="section-header">Cognition</div>
    <div class="section-body">
        <table>
            <!-- Yes/No questions with their details in same row -->
            <tr>
                <td>
                    <span class="label">Are there cognitive concerns?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->cognitive_concerns ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Cognitive Concerns Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->cognitive_concerns_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Diagnosis of dementia?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->diagnosis_dementia ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Dementia Diagnosis Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->diagnosis_dementia_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Capable of making own decisions?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->capable_of_decisions ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Decision Making Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->capable_of_decisions_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Power of Attorney / Guardian?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->has_power_of_attorney ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Power of Attorney Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->power_of_attorney_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Becomes confused at times?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->becomes_confused ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Confusion Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->becomes_confused_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Experienced delirium?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->experienced_delirium ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Delirium Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->experienced_delirium_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Feels anxious or worried?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->anxious_or_worry ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Anxiety/Worry Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->anxious_or_worry_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Short-term memory loss?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->short_term_memory_loss ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Short-term Memory Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->short_term_memory_loss_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Long-term memory loss?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->long_term_memory_loss ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Long-term Memory Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->long_term_memory_loss_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Health literacy support?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->health_literacy_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Health Literacy Support Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->health_literacy_support_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral to Geriatrician?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->referral_geriatrician ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Geriatrician Referral Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->referral_geriatrician_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral to Psychologist?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->referral_psychologist ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Psychologist Referral Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->referral_psychologist_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral to Psychiatrist?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ (optional($supportPlan->cognition)->referral_psychiatrist ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Psychiatrist Referral Details</span>
                    <span class="value">{{ optional($supportPlan->cognition)->referral_psychiatrist_details ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>
</div>

{{-- Behaviour Support --}}

<div class="section">
    <div class="section-header">Behaviour Support</div>
    <table>
        @if($supportPlan->behaviourSupport)
            <tr>
                <td>
                    <span class="label">Feeling agitation or frustration?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->feeling_agitation ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->feeling_agitation_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Delusions or hallucinations previously?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->delusions_hallucinations ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->delusions_hallucinations_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Changes to personality out of character?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->personality_changes ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->personality_changes_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Wanders without purpose?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->wandering ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->wandering_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Concerns of absconding?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->absconding ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->absconding_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Screams, yells or verbally threatens?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->verbal_threats ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->verbal_threats_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Physically assaults or threatens?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->physical_assault ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->physical_assault_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Restrictive interventions occurring?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->restrictive_interventions ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->restrictive_interventions_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Restrictive interventions approved?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->interventions_approved ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->interventions_approved_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral to Positive Behaviour Support Practitioner?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->referral_pbsp ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->referral_pbsp_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Behaviour Support Plan required?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->behaviourSupport->bsp_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Expiry Date</span>
                    <span class="value">
                        {{ $supportPlan->behaviourSupport->bsp_expiry_date
                            ? \Carbon\Carbon::parse($supportPlan->behaviourSupport->bsp_expiry_date)->format('d/m/Y')
                            : 'N/A' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <span class="label">Current strategies being implemented:</span>
                    <span class="value">{{ $supportPlan->behaviourSupport->current_strategies ?? 'N/A' }}</span>
                </td>
            </tr>
        @endif
    </table>
</div>

{{-- Personal Care --}}
<div class="section">
    <div class="section-header">Personal Care</div>
    <table>
        @if($supportPlan->personalCare)
            <tr>
                <td>
                    <span class="label">Support to maintain daily personal care?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->support_daily_personal_care ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->personalCare->daily_personal_care_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Support for showering?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->support_showering ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">
                        {{ $supportPlan->personalCare->showering_type ?? '' }}
                        {{ $supportPlan->personalCare->showering_details ?? 'N/A' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Support with dressing/undressing?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->support_dressing ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">
                        {{ $supportPlan->personalCare->dressing_details ?? '' }}
                        {{ $supportPlan->personalCare->dressing_routine ?? 'N/A' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Equipment in shower/bathroom?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->equipment_in_bathroom ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->personalCare->equipment_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Support with shaving?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->support_shaving ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->personalCare->shaving_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Support with haircuts?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->support_haircuts ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->personalCare->haircuts_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Complete this task at home?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->task_at_home ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>

            </tr>
            <tr>
                <td>
                    <span class="label">Wears dentures?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->wears_dentures ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Dentures Details</span>
                    <span class="value">{{ $supportPlan->personalCare->dentures_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Support with brushing teeth?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->support_teeth_brushing ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->personalCare->teeth_brushing_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">OT assessment on bathroom/shower?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->ot_bathroom_assessment ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">
                        {{ $supportPlan->personalCare->ot_assessment_type ?? '' }}
                        {{ $supportPlan->personalCare->ot_assessment_details ?? 'N/A' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <span class="label">Personal care routine</span>
                    <span class="value">{{ $supportPlan->personalCare->personal_care_routine ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral to Occupational Therapist?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->personalCare->referral_ot_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">OT Referral Details</span>
                    <span class="value">{{ $supportPlan->personalCare->plancare_referral_ot_details ?? 'N/A' }}</span>
                </td>
            </tr>
        @endif
    </table>
</div>

<div class="section">
    <div class="section-header">Continence</div>
    <table>
        @if($supportPlan->continence)
            <tr>
                <td>
                    <span class="label">Identified needs regarding continence support?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->continence->identified_needs ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->continence->identified_needs_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Able to identify toilet needs?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->continence->identify_toilet_needs ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->continence->identify_toilet_needs_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Require prompting to use toilet/change products?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->continence->require_prompting ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->continence->require_prompting_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Wear continence aids?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->continence->wears_continence_aids ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->continence->continence_aids_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">RUIS assessment required?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->continence->ruis_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->continence->ruis_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">RFIS assessment required?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->continence->rfis_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->continence->rfis_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Accessing funding for continence products?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->continence->funding_for_products ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->continence->funding_for_products_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Continence Nurse Assessment previously?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->continence->nurse_assessment ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->continence->nurse_assessment_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Does continence worry you?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->continence->worry_about_continence ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->continence->worry_about_continence_details ?? 'N/A' }}</span>
                </td>
            </tr>
        @endif
    </table>
</div>
{{-- Vision --}}

{{-- Vision --}}
<div class="section">
    <div class="section-header">Vision</div>
    <table>
        <tr>
            <td>
                <span class="label">Do you wear glasses or contact lenses?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->vision->wears_glasses_or_contacts ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Type</span>
                <span class="value">
                    {{ $supportPlan->vision->wears_glasses_or_contacts && $supportPlan->vision->glasses_or_contacts_type
                       ? $supportPlan->vision->glasses_or_contacts_type : 'N/A' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">When do you wear them?</span>
                <span class="value">
                    {{ $supportPlan->vision->vision_when_worn ?? 'N/A' }}
                </span>
            </td>
            <td>
                <span class="label">Last Optometrist Appointment</span>
                <span class="value">
                    {{ $supportPlan->vision->last_optometrist_appointment
                        ? \Carbon\Carbon::parse($supportPlan->vision->last_optometrist_appointment)->format('d/m/Y')
                        : 'N/A' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Any aspects of vision worry you?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->vision->vision_worry ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Worry Details</span>
                <span class="value">
                    {{ $supportPlan->vision->vision_worry_details ?? 'N/A' }}
                </span>
            </td>
        </tr>
    </table>
</div>



{{-- Hearing --}}
<div class="section">
    <div class="section-header">Hearing</div>
    <table>
        @if($supportPlan->hearing)
            <tr>
                <td>
                    <span class="label">Do you wear hearing devices?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->hearing->wears_hearing_devices ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Device Details</span>
                    <span class="value">
                        {{ $supportPlan->hearing->hearing_devices_details ?? 'N/A' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">When do you wear them?</span>
                    <span class="value">
                        {{ $supportPlan->hearing->when_worn ?? 'N/A' }}
                    </span>
                </td>
                <td>
                    <span class="label">Last Audiologist Appointment</span>
                    <span class="value">
                        {{ $supportPlan->hearing->last_audiologist_appointment
                            ? \Carbon\Carbon::parse($supportPlan->hearing->last_audiologist_appointment)->format('d/m/Y')
                            : 'N/A' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Any aspects of hearing worry you?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->hearing->hearing_worry ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Worry Details</span>
                    <span class="value">
                        {{ $supportPlan->hearing->hearing_worry_details ?? 'N/A' }}
                    </span>
                </td>
            </tr>
        @endif
    </table>
</div>


{{-- Skin Conditions --}}
{{-- Skin Conditions --}}
<div class="section">
    <div class="section-header">Skin Conditions</div>
    <table>
        @if($supportPlan->skinCondition)
            <tr>
                <td>
                    <span class="label">Do you have any skin conditions?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->skinCondition->has_skin_condition ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Details</span>
                    <span class="value">{{ $supportPlan->skinCondition->skin_condition_type ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Does your skin condition impact daily activities?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->skinCondition->impacts_daily_activities ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Date</span>
                    <span class="value">
                        {{ $supportPlan->skinCondition->impact_date
                            ? \Carbon\Carbon::parse($supportPlan->skinCondition->impact_date)->format('d/m/Y')
                            : 'N/A' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Pain/Discomfort Level</span>
                    <span class="value">
                        {{ $supportPlan->skinCondition->pain_discomfort_level ?? 'N/A' }}
                    </span>
                </td>
                <td>
                    <span class="label">Score</span>
                    <span class="value">
                        {{ $supportPlan->skinCondition->pain_level_score ?? 'N/A' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <span class="label">Strategies</span>
                    <span class="value">{{ $supportPlan->skinCondition->management_strategies ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Does condition worry you?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->skinCondition->skin_condition_worry ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Date</span>
                    <span class="value">
                        {{ $supportPlan->skinCondition->worry_date
                            ? \Carbon\Carbon::parse($supportPlan->skinCondition->worry_date)->format('d/m/Y')
                            : 'N/A' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral to Nursing required?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->skinCondition->referral_nursing_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Date</span>
                    <span class="value">
                        {{ $supportPlan->skinCondition->referral_nursing_date
                            ? \Carbon\Carbon::parse($supportPlan->skinCondition->referral_nursing_date)->format('d/m/Y')
                            : 'N/A' }}
                    </span>
                </td>
            </tr>
        @endif
    </table>
</div>

{{-- Dietary Requirements & Meal Preparation --}}
<div class="section">
    <div class="section-header">Dietary Requirements & Meal Preparation</div>
    <table>
        <tr>
            <td>
                <span class="label">Intolerances</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->intolerances ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Intolerance Details</span>
                <span class="value">{{ $supportPlan->dietary->intolerances_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Dysphagia Concerns</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->dysphagia_concerns ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Dysphagia Details</span>
                <span class="value">{{ $supportPlan->dietary->dysphagia_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Speech Pathologist Recommendations</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->speech_pathologist_recommendations ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">IDDSI Food Category</span>
                <span class="value">{{ $supportPlan->dietary->iddsi_food_category ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">IDDSI Liquid Category</span>
                <span class="value">{{ $supportPlan->dietary->iddsi_liquid_category ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Prepares Meals</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->prepares_meals ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Meal Preparation Details</span>
                <span class="value">{{ $supportPlan->dietary->prepares_meals_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Needs Meal Support</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->needs_meal_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Meal Support Details</span>
                <span class="value">{{ $supportPlan->dietary->meal_support_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Diet Meets Needs</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->diet_meets_needs ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Diet Details</span>
                <span class="value">{{ $supportPlan->dietary->diet_meets_needs_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Needs Cutting Support</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->needs_cutting_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Cutting Support Details</span>
                <span class="value">{{ $supportPlan->dietary->cutting_support_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Needs Feeding Support</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->needs_feeding_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Feeding Support Details</span>
                <span class="value">{{ $supportPlan->dietary->feeding_support_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Dietician Referral Required</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->dietician_referral_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Referral Details</span>
                <span class="value">{{ $supportPlan->dietary->dietician_referral_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Needs Shopping Support</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->dietary->needs_shopping_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <span class="label">Shopping Support Details</span>
                <span class="value">{{ $supportPlan->dietary->shopping_support_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

<div style="page-break-before: always;"></div>


{{-- Pain Management --}}
<div class="section">
    <div class="section-header">Pain Management</div>
    <table>
        @if($supportPlan->painManagement)
            <tr>
                <td>
                    <span class="label">Do you have ongoing pain?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->painManagement->ongoing_pain ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Pain Details</span>
                    <span class="value">{{ $supportPlan->painManagement->pain_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Location of the pain</span>
                    <span class="value">{{ $supportPlan->painManagement->pain_location ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Frequency of the pain</span>
                    <span class="value">{{ $supportPlan->painManagement->pain_frequency ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Scale of the pain (1-10)</span>
                    <span class="value">{{ $supportPlan->painManagement->pain_scale ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Currently supported for pain?</span>
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
                <td>
                    <span class="label">Support Details</span>
                    <span class="value">{{ $supportPlan->painManagement->supported_pain_details ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Abbey Pain Scale required?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->painManagement->abbey_pain_scale_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <span class="label">Strategies to manage pain</span>
                    <span class="value">{{ $supportPlan->painManagement->pain_management_strategies ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Does any aspect of pain worry you?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->painManagement->pain_worry ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Worry Details</span>
                    <span class="value">{{ $supportPlan->painManagement->pain_worry_details ?? 'N/A' }}</span>
                </td>
            </tr>
        @endif
    </table>
</div>




{{-- Social Connections & Community Access --}}
<div class="section">
    <div class="section-header">Social Connections & Community Access</div>
    <table>
        <tr>
            <td>
                <span class="label">Do you ever feel lonely?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->feels_lonely ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Loneliness Details</span>
                <span class="value">{{ $supportPlan->socialConnection->feels_lonely_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do you have informal supports?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->has_informal_supports ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Informal Supports Details</span>
                <span class="value">{{ $supportPlan->socialConnection->informal_supports_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do you want to engage more with the local community?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->wants_more_community_engagement ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Community Engagement Details</span>
                <span class="value">{{ $supportPlan->socialConnection->community_engagement_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do you need support accessing the community?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->needs_community_access_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Community Access Support Details</span>
                <span class="value">{{ $supportPlan->socialConnection->community_access_support_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do you have a multi-purpose taxi card?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->has_taxi_card ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Taxi Card Details</span>
                <span class="value">{{ $supportPlan->socialConnection->taxi_card_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Interested in Community Visitors Program?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->interested_in_visitors_program ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Visitors Program Details</span>
                <span class="value">{{ $supportPlan->socialConnection->visitors_program_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Hobbies & Activities</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->has_hobbies_activities ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hobbies & Activities Details</span>
                <span class="value">{{ $supportPlan->socialConnection->hobbies_activities_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Duke Social Support Index Required?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->needs_duke_index ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Duke Index Details</span>
                <span class="value">{{ $supportPlan->socialConnection->duke_index_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do you need support with feeding?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->social_connections_needs_feeding_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Feeding Support Details</span>
                <span class="value">{{ $supportPlan->socialConnection->social_connections_feeding_support_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Referral to Dietician?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->social_connections_wants_dietician_referral ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Dietician Referral Details</span>
                <span class="value">{{ $supportPlan->socialConnection->social_connections_dietician_referral_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Support with food shopping/unpacking?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->socialConnection->social_connections_needs_shopping_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Shopping Support Details</span>
                <span class="value">{{ $supportPlan->socialConnection->social_connections_shopping_support_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

{{-- Maintaining Your Home --}}
<div class="section">
    <div class="section-header">Maintaining Your Home</div>
    <table>
        @if($supportPlan->homeMaintenance)
            <tr>
                <td>
                    <span class="label">Do you need support with domestic assistance within the home?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->homeMaintenance->domestic_assistance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Domestic Assistance Details</span>
                    <span class="value">{{ $supportPlan->homeMaintenance->domestic_assistance_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Level of independence</span>
                    <span class="value">{{ $supportPlan->homeMaintenance->domestic_independence ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Do you also need help obtaining safe and approved cleaning products and equipment?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->homeMaintenance->cleaning_products_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Cleaning Products Details</span>
                    <span class="value">{{ $supportPlan->homeMaintenance->cleaning_products_details ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Do you need support with maintaining your gardens to be safe?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->homeMaintenance->garden_maintenance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Garden Maintenance Details</span>
                    <span class="value">{{ $supportPlan->homeMaintenance->garden_maintenance_details ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Do you have any trouble navigating the house at night?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->homeMaintenance->trouble_navigating_night ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Night Navigation Details</span>
                    <span class="value">{{ $supportPlan->homeMaintenance->trouble_navigating_night_details ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Are there any aspects of maintaining your home that worry you?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->homeMaintenance->home_worry ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Home Worry Details</span>
                    <span class="value">{{ $supportPlan->homeMaintenance->home_worry_details ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Date Home Safety Assessment was last completed</span>
                    <span class="value">
                        {{ $supportPlan->homeMaintenance->last_home_safety_assessment
                            ? \Carbon\Carbon::parse($supportPlan->homeMaintenance->last_home_safety_assessment)->format('d/m/Y')
                            : 'N/A' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <span class="label">Key areas of focus to be supported identified from Home</span>
                    <span class="value">{{ $supportPlan->homeMaintenance->focus_areas ?? 'N/A' }}</span>
                </td>
            </tr>
        @else
            <tr>
                <td colspan="2" class="text-center">No Home Maintenance details available.</td>
            </tr>
        @endif
    </table>
</div>

{{-- Financial Support --}}
<div class="section">
    <div class="section-header">Financial Support</div>
    <table>
        @if($supportPlan->financialSupport)
            <tr>
                <td>
                    <span class="label">Do you have a Power of Attorney or Financial Guardian?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->financial_has_power_of_attorney ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Power of Attorney Details</span>
                    <span class="value">{{ $supportPlan->financialSupport->financial_power_of_attorney_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Do you have access to your own money?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->has_access_to_money ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Access to Money Details</span>
                    <span class="value">{{ $supportPlan->financialSupport->access_to_money_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Are you at risk of financial abuse?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->at_risk_of_abuse ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Risk of Abuse Details</span>
                    <span class="value">{{ $supportPlan->financialSupport->risk_of_abuse_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Do you need support to pay bills or attend bank?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->needs_support_for_bills ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Bills & Bank Support Details</span>
                    <span class="value">{{ $supportPlan->financialSupport->support_for_bills_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Do you ever find that you don't have enough money?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->not_enough_money ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Financial Shortage Details</span>
                    <span class="value">{{ $supportPlan->financialSupport->not_enough_money_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Do you want support to engage with a financial counsellor?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->support_financial_counsellor ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Financial Counsellor Details</span>
                    <span class="value">{{ $supportPlan->financialSupport->financial_counsellor_details ?? 'N/A' }}</span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Do you want support to access Government initiatives?</span>
                    <div class="enum-field">
                        @foreach(['Yes', 'No'] as $option)
                            <span class="enum-option {{ ($supportPlan->financialSupport->support_government_initiatives ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                {{ $option }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="label">Government Initiatives Details</span>
                    <span class="value">{{ $supportPlan->financialSupport->government_initiatives_details ?? 'N/A' }}</span>
                </td>
            </tr>
        @endif
    </table>
</div>

{{-- Informal Supports --}}
<div class="section">
    <div class="section-header">Informal Supports</div>
    <table>
        <tr>
            <td>
                <span class="label">Are you the primary caregiver for another person?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->informalSupport->is_primary_caregiver ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Primary Caregiver Details</span>
                <span class="value">{{ $supportPlan->informalSupport->primary_caregiver_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Are you receiving help from someone?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->informalSupport->receiving_help ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Receiving Help Details</span>
                <span class="value">{{ $supportPlan->informalSupport->receiving_help_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Does the carer live with you?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->informalSupport->carer_lives_with_you ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Carer Living Arrangement Details</span>
                <span class="value">{{ $supportPlan->informalSupport->carer_lives_with_you_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Does the carer receive a pension?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->informalSupport->carer_receives_pension ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Carer Pension Details</span>
                <span class="value">{{ $supportPlan->informalSupport->carer_pension_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Are there any factors affecting the care relationship?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->informalSupport->factors_affecting_care ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Care Relationship Factors Details</span>
                <span class="value">{{ $supportPlan->informalSupport->factors_affecting_care_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is a Caregiver Strain Index required?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->informalSupport->caregiver_strain_index_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Is a Carer Gateway referral suitable?</span>
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
            <td>
                <span class="label">Carer Gateway Referral Details</span>
                <span class="value">{{ $supportPlan->informalSupport->carer_gateway_referral_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Is the primary caregiver receiving Carer's Allowance?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->informalSupport->primary_caregiver_receives_allowance ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
    </table>
</div>


{{-- Emergency Readiness - Safeguarding --}}
{{-- Emergency Readiness - Safeguarding --}}
<div class="section">
    <div class="section-header">Emergency Readiness - Safeguarding</div>
    <table>
        <tr>
            <td>
                <span class="label">Is the participant at risk of abuse or neglect?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->emergency_at_risk_of_abuse ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Abuse/Neglect Details</span>
                <span class="value">{{ $supportPlan->emergencyReadiness->abuse_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is referral to OPAN required?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->opan_referral_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">OPAN Referral Details</span>
                <span class="value">{{ $supportPlan->emergencyReadiness->opan_referral_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is there a risk of declining services?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->risk_of_declining_services ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Declining Services Details</span>
                <span class="value">{{ $supportPlan->emergencyReadiness->declining_services_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Are there indicators of neglect?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->neglect_indicators ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Neglect Indicators Details</span>
                <span class="value">{{ $supportPlan->emergencyReadiness->neglect_indicators_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is the property accessible in an emergency?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->emergency_accessible ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Emergency Access Details</span>
                <span class="value">{{ $supportPlan->emergencyReadiness->emergency_accessible_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is emergency support available?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->emergency_support_available ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Emergency Support Details</span>
                <span class="value">{{ $supportPlan->emergencyReadiness->emergency_support_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is a VPR (Vulnerability, Prevention & Response) required?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->emergencyReadiness->vpr_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">VPR Details</span>
                <span class="value">{{ $supportPlan->emergencyReadiness->vpr_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

{{-- Fire & Heat Readiness --}}
<div class="section">
    <div class="section-header">Fire & Heat Readiness</div>
    <table>
        <tr>
            <td>
                <span class="label">Support with home preparation?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->home_preparation_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Home Preparation Details</span>
                <span class="value">{{ $supportPlan->fireHeatReadiness->home_preparation_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Hydration access during warm weather?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->hydration_access ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Hydration Details</span>
                <span class="value">{{ $supportPlan->fireHeatReadiness->hydration_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Cooling at home?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->home_cooling ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Home Cooling Details</span>
                <span class="value">{{ $supportPlan->fireHeatReadiness->home_cooling_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Multiple exit points available?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->multiple_exit_points ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Exit Points Details</span>
                <span class="value">{{ $supportPlan->fireHeatReadiness->exit_points_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Aware of fire risk & evacuation?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->identify_fire_risk ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Fire Risk Details</span>
                <span class="value">{{ $supportPlan->fireHeatReadiness->fire_risk_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Can evacuate independently?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->can_evacuate_independently ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Evacuation Details</span>
                <span class="value">{{ $supportPlan->fireHeatReadiness->evacuate_independently_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Support from family/neighbours?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->fireHeatReadiness->support_from_family_or_neighbour ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Family/Neighbour Support Details</span>
                <span class="value">{{ $supportPlan->fireHeatReadiness->support_from_family_or_neighbour_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

{{-- Storm or Flooding --}}
<div class="section">
    <div class="section-header">Storm or Flooding</div>
    <table>
        <tr>
            <td>
                <span class="label">Home Preparation Support?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->stormFlooding->storm_home_preparation_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Home Preparation Details</span>
                <span class="value">{{ $supportPlan->stormFlooding->storm_home_preparation_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Multiple Exit Points?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->stormFlooding->storm_multiple_exit_points ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Exit Points Details</span>
                <span class="value">{{ $supportPlan->stormFlooding->storm_multiple_exit_points_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Identify Flood Risk?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->stormFlooding->identify_flood_risk ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Flood Risk Details</span>
                <span class="value">{{ $supportPlan->stormFlooding->identify_flood_risk_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Evacuate Independently?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->stormFlooding->storm_can_evacuate_independently ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Evacuation Details</span>
                <span class="value">{{ $supportPlan->stormFlooding->storm_evacuate_independently_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Support from Family/Neighbour?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->stormFlooding->_storm_support_from_family_or_neighbour ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Family/Neighbour Support Details</span>
                <span class="value">{{ $supportPlan->stormFlooding->storm_support_from_family_or_neighbour_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

{{-- Telecommunication Outage --}}
<div class="section">
    <div class="section-header">Telecommunication Outage</div>
    <table>
        <tr>
            <td>
                <span class="label">Is the participant able to leave home independently?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->telecommunicationOutage?->independent_leave_home ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Independent Leave Details</span>
                <span class="value">{{ $supportPlan->telecommunicationOutage?->independent_leave_home_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is a support check-in available during outages?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->telecommunicationOutage?->has_support_checkin ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Support Check-in Details</span>
                <span class="value">{{ $supportPlan->telecommunicationOutage?->has_support_checkin_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is a welfare check required if the outage exceeds 5 hours?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->telecommunicationOutage?->welfare_check_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Welfare Check Details</span>
                <span class="value">{{ $supportPlan->telecommunicationOutage?->welfare_check_required_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

{{-- Power Outage --}}
<div class="section">
    <div class="section-header">Power Outage</div>
    <table>
        <tr>
            <td>
                <span class="label">Medical equipment reliant on power?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->has_medical_equipment ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Medical Equipment Details</span>
                <span class="value">{{ $supportPlan->powerOutage?->medical_equipment_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Backup Power Supply?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->has_backup_power ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Backup Power Details</span>
                <span class="value">{{ $supportPlan->powerOutage?->backup_power_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Registered Life Support?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->registered_life_support ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Life Support Details</span>
                <span class="value">
                    {{ $supportPlan->powerOutage?->life_support_hours_supply ? $supportPlan->powerOutage->life_support_hours_supply . ' hrs' : 'N/A' }}
                    {{ $supportPlan->powerOutage?->life_support_provider ? ' (' . $supportPlan->powerOutage->life_support_provider . ')' : '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Can leave home independently?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->power_independent_leave_home ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Independent Leave Details</span>
                <span class="value">{{ $supportPlan->powerOutage?->power_independent_leave_home_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Support check-in during outage?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->power_has_support_checkin ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Support Check-in Details</span>
                <span class="value">{{ $supportPlan->powerOutage?->power_has_support_checkin_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Welfare check required (>5 hours)?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ ($supportPlan->powerOutage?->power_welfare_check_required ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Welfare Check Details</span>
                <span class="value">{{ $supportPlan->powerOutage?->power_welfare_check_required_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

<div style="page-break-before: always;"></div>

{{-- End of Life - Advanced Care Planning --}}
<div class="section">
    <div class="section-header">End of Life - Advanced Care Planning</div>
    <table>
        <tr>
            <td>
                <span class="label">Receiving palliative care?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->endOfLifeAdvancedCarePlanning)->receiving_palliative_care ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Palliative Care Details</span>
                <span class="value">{{ optional($supportPlan->endOfLifeAdvancedCarePlanning)->receiving_palliative_care_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Support to initiate palliative care services?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->endOfLifeAdvancedCarePlanning)->support_to_initiate_palliative_care ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Initiate Palliative Care Details</span>
                <span class="value">{{ optional($supportPlan->endOfLifeAdvancedCarePlanning)->support_to_initiate_palliative_care_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Has an advanced care plan?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->endOfLifeAdvancedCarePlanning)->has_advanced_care_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Advanced Care Plan Details</span>
                <span class="value">{{ optional($supportPlan->endOfLifeAdvancedCarePlanning)->advanced_care_plan_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Support completing advanced care plan?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->endOfLifeAdvancedCarePlanning)->support_to_complete_advanced_care_plan ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">Complete Care Plan Details</span>
                <span class="value">{{ optional($supportPlan->endOfLifeAdvancedCarePlanning)->support_to_complete_advanced_care_plan_details ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do Not Resuscitate (DNR)?</span>
                <div class="enum-field">
                    @foreach(['Yes', 'No'] as $option)
                        <span class="enum-option {{ (optional($supportPlan->endOfLifeAdvancedCarePlanning)->has_dnr ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td>
                <span class="label">DNR Details</span>
                <span class="value">{{ optional($supportPlan->endOfLifeAdvancedCarePlanning)->dnr_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>





</div>

</body>
</html>
