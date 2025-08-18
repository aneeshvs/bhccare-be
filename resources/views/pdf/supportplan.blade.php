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
                <td>
                    <span class="label">Signature</span>
                    <span class="value">{{ $supportPlan->approval->signature ?? 'N/A' }}</span>
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
                <span class="value">{{ $supportPlan->keep_in_touch->need_help_to_communicate ? 'Yes' : 'No' }}</span>
            </td>
            <td>
                <span class="label">Type of Difficulty</span>
                <span class="value">{{ $supportPlan->keep_in_touch->type_of_difficulty ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Contact First Instance</span>
                <span class="value">{{ $supportPlan->keep_in_touch->contact_first_instance ? 'Yes' : 'No' }}</span>
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
                <span class="value">{{ $supportPlan->keep_in_touch->use_nrs ? 'Yes' : 'No' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Require Interpreter</span>
                <span class="value">{{ $supportPlan->keep_in_touch->require_interpreter ? 'Yes' : 'No' }}</span>
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
                <span class="value">{{ $supportPlan->keep_in_touch->join_cab ? 'Yes' : 'No' }}</span>
            </td>
        </tr>
    </table>
</div>

<!--non_responsive -->

<div class="section">
    <div class="section-header">Access & Contact Details</div>
    <table>
        <tr>
            <td>
                <span class="label">Telephone (Home or Mobile)</span>
                <span class="value">{{ $supportPlan->non_responsive->telephone_home_or_mobile ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Telephone Details</span>
                <span class="value">{{ $supportPlan->non_responsive->telephone_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Emergency Contact</span>
                <span class="value">{{ $supportPlan->non_responsive->contact_emergency_contact ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Emergency Contact Details</span>
                <span class="value">{{ $supportPlan->non_responsive->emergency_contact_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Access Spare Key</span>
                <span class="value">{{ $supportPlan->non_responsive->access_spare_key ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Spare Key Details</span>
                <span class="value">{{ $supportPlan->non_responsive->spare_key_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Contact Other Persons</span>
                <span class="value">{{ $supportPlan->non_responsive->contact_other_persons ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Other Persons Details</span>
                <span class="value">{{ $supportPlan->non_responsive->other_persons_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Contact Police If No Key</span>
                <span class="value">{{ $supportPlan->non_responsive->contact_police_if_no_key ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Police Contact Details</span>
                <span class="value">{{ $supportPlan->non_responsive->police_contact_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Access Key Lock</span>
                <span class="value">{{ $supportPlan->non_responsive->access_key_lock ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Key Lock Code</span>
                <span class="value">{{ $supportPlan->non_responsive->key_lock_code ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Key Lock Details</span>
                <span class="value">{{ $supportPlan->non_responsive->key_lock_details ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>

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
                <span class="value">
                    {{ $supportPlan->participantDetail->is_aboriginal_or_torres_strait_islander ? 'Yes' : 'No' }}
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Gender</span>
                <span class="value">{{ $supportPlan->participantDetail->gender ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>
<!--contact details -->

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
                <span class="value">{{ $supportPlan->contactDetail->is_rural_area ?? 'N/A'}}</span>
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
                <span class="value">
                    {{ isset($supportPlan->contactDetailSecondary->secondary_is_mac_registered) && $supportPlan->contactDetailSecondary->secondary_is_mac_registered ? 'Yes' : 'No' }}
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">List Documents</span>
                <span class="value">{{ $supportPlan->contactDetailSecondary->secondary_list_documents ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Legal Documentation Stored?</span>
                <span class="value">
                    {{ isset($supportPlan->contactDetailSecondary->secondary_legal_documentation_stored) && $supportPlan->contactDetailSecondary->secondary_legal_documentation_stored ? 'Yes' : 'No' }}
                </span>
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
                <span class="value">
                    {{ isset($supportPlan->contactDetailSecondary->secondary_participants_agreed_contact) && $supportPlan->contactDetailSecondary->secondary_participants_agreed_contact ? 'Yes' : 'No' }}
                </span>
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
                <span class="value">{{ $supportPlan->SupportFunding->awaiting_package_upgrade ? 'Yes' : 'No' }}</span>
            </td>
            <td>
                <span class="label">Upgrade Details</span>
                <span class="value">{{ $supportPlan->SupportFunding->upgrade_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">CHSP Referral Codes</span>
                <span class="value">{{ $supportPlan->SupportFunding->chsp_referral_details ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">War Veteran / Widow</span>
                <span class="value">{{ $supportPlan->SupportFunding->war_veteran_or_widow ? 'Yes' : 'No' }}</span>
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
                <span class="value">{{ $supportPlan->SupportFunding->has_companion_card ? 'Yes' : 'No' }}</span>
            </td>
        </tr>
    </table>
</div>
 <!--service section -->
  <div class="section">
    <div class="section-header">PART H – SUPPORT PLAN SERVICES</div>
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
                            <span class="value">
                                {{ $service->support_to_implement_by_us ? 'Yes' : 'No' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!---employee detail-->

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


</div>

</body>
</html>
