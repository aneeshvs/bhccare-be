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

<!--mygoals -->
<div class="section">
    <div class="section-header">PART H – SUPPORT PLAN MY GOALS</div>
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
                <span class="value">
                    {{ $supportPlan->LivingArrangement->is_home_suitable ? 'Yes' : 'No' }}
                </span>
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
                <span class="value">
                    {{ $supportPlan->LivingArrangement->at_risk_of_homelessness ? 'Yes' : 'No' }}
                </span>
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
                <span class="value">
                    {{ optional($supportPlan->cultural_diversity)->is_lgbti ? 'Yes' : 'No' }}
                </span>
            </td>
            <td>
                <span class="label">Details</span>
                <span class="value">{{ optional($supportPlan->cultural_diversity)->lgbti_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Separated from parents or children by forced adoption or removal</span>
                <span class="value">
                    {{ optional($supportPlan->cultural_diversity)->is_separated_family ? 'Yes' : 'No' }}
                </span>
            </td>
            <td>
                <span class="label">Details</span>
                <span class="value">{{ optional($supportPlan->cultural_diversity)->separated_family_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Are there cultural events, dates or practices we should be aware of?</span>
                <span class="value">
                    {{ optional($supportPlan->cultural_diversity)->has_cultural_events ? 'Yes' : 'No' }}
                </span>
            </td>
            <td>
                <span class="label">Details</span>
                <span class="value">{{ optional($supportPlan->cultural_diversity)->cultural_events_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Are there past events we should know to support you safely?</span>
                <span class="value">
                    {{ optional($supportPlan->cultural_diversity)->has_past_events ? 'Yes' : 'No' }}
                </span>
            </td>
            <td>
                <span class="label">Details</span>
                <span class="value">{{ optional($supportPlan->cultural_diversity)->past_events_details ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Any cultural/diversity/identity items not to disclose?</span>
                <span class="value">
                    {{ optional($supportPlan->cultural_diversity)->has_non_disclosure_items ? 'Yes' : 'No' }}
                </span>
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
                    <span class="label">Admitted to hospital in last 12 months?</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->admitted_hospital_last12months ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->admitted_hospital_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->admitted_hospital_details }}</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Preferred Hospital?</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->preferred_hospital ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->preferred_hospital_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->preferred_hospital_details }}</div>
                    @endif
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
                    <span class="label">Allergies</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->has_allergies ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->allergy_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->allergy_details }}</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Impact of Health Issues (1–10)</span>
                    <span class="value">{{ $supportPlan->general_health->health_impact_scale ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Pain affecting daily activities?</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->painful_day_to_day ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->painful_day_to_day_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->painful_day_to_day_details }}</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Weight loss in last 3 months?</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->weight_loss_last3months ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->weight_loss_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->weight_loss_details }}</div>
                    @endif
                </td>
                <td>
                    <span class="label">Nutritional Concerns?</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->nutritional_concerns ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->nutritional_concerns_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->nutritional_concerns_details }}</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Current Weight</span>
                    <span class="value">{{ $supportPlan->general_health->current_weight ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Annual Vaccinations</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->annual_vaccinations ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->annual_vaccination_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->annual_vaccination_details }}</div>
                    @endif
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
                <td>
                    <span class="label">Sleep Difficulties?</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->sleep_difficulties ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->sleep_difficulties_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->sleep_difficulties_details }}</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Sleep Routine</span>
                    <span class="value">{{ $supportPlan->general_health->sleep_routine ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Concerns about Sleep Routine?</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->sleep_routine_worries ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->sleep_routine_worries_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->sleep_routine_worries_details }}</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Alcohol / Smoke / Drug Use?</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->alcohol_smoke_drug_use ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->alcohol_smoke_drug_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->alcohol_smoke_drug_details }}</div>
                    @endif
                </td>
                <td>
                    <span class="label">Concerns about Alcohol/Drug Use?</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->alcohol_smoke_drug_worries ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->alcohol_smoke_drug_worries_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->alcohol_smoke_drug_worries_details }}</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <span class="label">Referral Required for Alcohol/Drug Use?</span>
                    <span class="value">
                        {{ optional($supportPlan->general_health)->referral_required ? 'Yes' : 'No' }}
                    </span>
                    @if(optional($supportPlan->general_health)->referral_required_details)
                        <div><strong>Details:</strong> {{ $supportPlan->general_health->referral_required_details }}</div>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- medications -->

<div class="section">
    <div class="section-header">Medication Management</div>
    <div class="section-body">
        <table>
            <tr>
                <td><span class="label">Takes Regular Medications</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->takes_regular_medications ? 'Yes' : 'No' }}</span>
                </td>
                <td><span class="label">Medication Details</span>
                    <span class="value">{{ $supportPlan->medication_management->medication_details ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td><span class="label">Medication Form</span>
                    <span class="value">{{ $supportPlan->medication_management->medication_form ?? 'N/A' }}</span>
                </td>
                <td><span class="label">Medication Packaging</span>
                    <span class="value">{{ $supportPlan->medication_management->medication_packaging ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td><span class="label">Medications Locked?</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->medications_locked ? 'Yes' : 'No' }}</span>
                    @if(optional($supportPlan->medication_management)->medications_locked_details)
                        <div><strong>Details:</strong> {{ $supportPlan->medication_management->medications_locked_details }}</div>
                    @endif
                </td>
                <td><span class="label">Specific Storage Requirements</span>
                    <span class="value">{{ $supportPlan->medication_management->specific_storage_requirements ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td><span class="label">Scheduled 4/8 Medications?</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->scheduled_4_or_8_medications ? 'Yes' : 'No' }}</span>
                    @if(optional($supportPlan->medication_management)->scheduled_medications_details)
                        <div><strong>Details:</strong> {{ $supportPlan->medication_management->scheduled_medications_details }}</div>
                    @endif
                </td>
                <td><span class="label">Chemical Restraint Medications?</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->chemical_restraint_medications ? 'Yes' : 'No' }}</span>
                </td>
            </tr>
            <tr>
                <td><span class="label">Takes More Than Prescribed?</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->takes_more_than_prescribed ? 'Yes' : 'No' }}</span>
                    @if(optional($supportPlan->medication_management)->takes_more_than_prescribed_details)
                        <div><strong>Details:</strong> {{ $supportPlan->medication_management->takes_more_than_prescribed_details }}</div>
                    @endif
                </td>
                <td><span class="label">At Risk of Missing Medication?</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->at_risk_of_missing_medication ? 'Yes' : 'No' }}</span>
                    @if(optional($supportPlan->medication_management)->missing_medication_details)
                        <div><strong>Details:</strong> {{ $supportPlan->medication_management->missing_medication_details }}</div>
                    @endif
                </td>
            </tr>
            <tr>
                <td><span class="label">Able to Explain Purpose</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->able_to_explain_purpose ? 'Yes' : 'No' }}</span>
                </td>
                <td><span class="label">Last Medication Review</span>
                    <span class="value">
                        {{ $supportPlan->medication_management->last_medication_review_date
                            ? \Carbon\Carbon::parse($supportPlan->medication_management->last_medication_review_date)->format('d-m-Y')
                            : 'N/A' }}
                    </span>
                </td>
            </tr>
            <tr>
                <td><span class="label">Medication Collection/Delivery</span>
                    <span class="value">{{ $supportPlan->medication_management->medication_collection_delivery_details ?? 'N/A' }}</span>
                </td>
                <td><span class="label">Needs Support With Medication?</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->needs_support_with_medication ? 'Yes' : 'No' }}</span>
                    @if(optional($supportPlan->medication_management)->support_with_medication_details)
                        <div><strong>Details:</strong> {{ $supportPlan->medication_management->support_with_medication_details }}</div>
                    @endif
                </td>
            </tr>
            <tr>
                <td><span class="label">Medication Management Worries?</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->medication_management_worries ? 'Yes' : 'No' }}</span>
                    @if(optional($supportPlan->medication_management)->medication_management_worries_details)
                        <div><strong>Details:</strong> {{ $supportPlan->medication_management->medication_management_worries_details }}</div>
                    @endif
                </td>
                <td><span class="label">Medication Service Required?</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->medication_service_required ? 'Yes' : 'No' }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2"><span class="label">Support Worker Prompt</span>
                    <span class="value">{{ optional($supportPlan->medication_management)->support_worker_prompt ? 'Yes' : 'No' }}</span>
                </td>
            </tr>
        </table>
    </div>
</div>
<!-- mobility transfer -->
<div class="section">
    <div class="section-header">Mobility & Transfers</div>
    <table>
        <tr>
            <td>
                <span class="label">Are you able to walk independently?</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->can_walk_independently ? 'Yes' : 'No' }}
                    {{ $supportPlan->mobility_transfer->walk_independently_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Do you need support with transfers?</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->needs_transfer_support ? 'Yes' : 'No' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Primary equipment used for mobility</span>
                <span class="value">{{ $supportPlan->mobility_transfer->primary_equipment_used ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Can you climb stairs safely?</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->can_climb_stairs ? 'Yes' : 'No' }}
                    {{ $supportPlan->mobility_transfer->climb_stairs_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do you have stairs in your house?</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->has_stairs_at_home ? 'Yes' : 'No' }}
                    {{ $supportPlan->mobility_transfer->stairs_at_home_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Are you able to transfer yourself from a chair, bed, etc.?</span>
                <span class="value">{{ $supportPlan->mobility_transfer->can_transfer_self ? 'Yes' : 'No' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Are you able to transfer in other environments?</span>
                <span class="value">{{ $supportPlan->mobility_transfer->can_transfer_in_other_envs ? 'Yes' : 'No' }}</span>
            </td>
            <td>
                <span class="label">Do you use a Bed Pole/Bed Rails?</span>
                <span class="value">{{ $supportPlan->mobility_transfer->uses_bed_pole_or_rails ? 'Yes' : 'No' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Bed Pole/Bed Rails prescribed by OT?</span>
                <span class="value">{{ $supportPlan->mobility_transfer->bed_pole_prescribed_by_ot ? 'Yes' : 'No' }}</span>
            </td>
            <td>
                <span class="label">Can you access places out of walking distance?</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->can_access_places_outside_walking_distance ? 'Yes' : 'No' }}
                    {{ $supportPlan->mobility_transfer->access_places_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Is it safe for you to mobilise in your yard?</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->safe_to_mobilise_in_yard ? 'Yes' : 'No' }}
                    {{ $supportPlan->mobility_transfer->mobilise_yard_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">How do you access the community?</span>
                <span class="value">{{ $supportPlan->mobility_transfer->community_access ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do you drive?</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->drives ? 'Yes' : 'No' }}
                    @if($supportPlan->mobility_transfer->medications_or_conditions_risk)
                        (Risk: {{ $supportPlan->mobility_transfer->driving_risk_details ?? 'N/A' }})
                    @endif
                </span>
            </td>
            <td>
                <span class="label">Mobility equipment</span>
                <span class="value">{{ $supportPlan->mobility_transfer->mobility_equipment ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Equipment purchase type</span>
                <span class="value">{{ $supportPlan->mobility_transfer->equipment_purchase_type ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Do you use a 4-wheel walker?</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->uses_four_wheel_walker ? 'Yes' : 'No' }}
                    {{ $supportPlan->mobility_transfer->four_wheel_walker_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Wheelchair type</span>
                <span class="value">{{ $supportPlan->mobility_transfer->wheelchair_type ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Wheelchair operation</span>
                <span class="value">{{ $supportPlan->mobility_transfer->wheelchair_operation ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Wheelchair recommended by OT?</span>
                <span class="value">{{ $supportPlan->mobility_transfer->wheelchair_ot_recommended ? 'Yes' : 'No' }}</span>
            </td>
            <td>
                <span class="label">Can charge wheelchair battery?</span>
                <span class="value">{{ $supportPlan->mobility_transfer->can_charge_wheelchair ? 'Yes' : 'No' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Last wheelchair service date</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->last_wheelchair_service_date
                        ? \Carbon\Carbon::parse($supportPlan->mobility_transfer->last_wheelchair_service_date)->format('d-m-Y')
                        : 'N/A' }}
                </span>
            </td>
            <td>
                <span class="label">Can carry items &lt; 5kg?</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->can_carry_5kg ? 'Yes' : 'No' }}
                    {{ $supportPlan->mobility_transfer->carry_5kg_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Foot problems</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->foot_problems ? 'Yes' : 'No' }}
                    {{ $supportPlan->mobility_transfer->foot_problems_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Mobility worries</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->mobility_worries ? 'Yes' : 'No' }}
                    {{ $supportPlan->mobility_transfer->mobility_worries_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Last OT assessment date</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->last_ot_assessment_date
                        ? \Carbon\Carbon::parse($supportPlan->mobility_transfer->last_ot_assessment_date)->format('d-m-Y')
                        : 'N/A' }}
                </span>
            </td>
            <td>
                <span class="label">New OT referral required?</span>
                <span class="value">{{ $supportPlan->mobility_transfer->new_ot_referral_required ? 'Yes' : 'No' }}</span>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <span class="label">DEMMI Assessment required?</span>
                <span class="value">
                    {{ $supportPlan->mobility_transfer->demmi_assessment_required ? 'Yes' : 'No' }}
                    {{ $supportPlan->mobility_transfer->demmi_assessment_result ?? '' }}
                </span>
            </td>
        </tr>
    </table>
</div>

{{-- falls risk --}}
 <div class="section">
        <div class="section-header">Falls Risk</div>
        <table>
            <tr>
                <td>
                    <span class="label">Recent falls in last 6 months?</span>
                    <span class="value">
                        {{ $supportPlan->fallsRisk->recent_falls ? 'Yes' : 'No' }}
                        {{ $supportPlan->fallsRisk->recent_falls_details ?? '' }}
                    </span>
                </td>
                <td>
                    <span class="label">Strategies to reduce falls risk?</span>
                    <span class="value">
                        {{ $supportPlan->fallsRisk->strategies_reduce_risk ? 'Yes' : 'No' }}
                        {{ $supportPlan->fallsRisk->strategies_reduce_risk_details ?? '' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Safety pendant available?</span>
                    <span class="value">
                        {{ $supportPlan->fallsRisk->safety_pendant ? 'Yes' : 'No' }}
                        {{ $supportPlan->fallsRisk->safety_pendant_details ?? '' }}
                    </span>
                </td>
                <td>
                    <span class="label">Worried about falling?</span>
                    <span class="value">
                        {{ $supportPlan->fallsRisk->worried_about_falling ? 'Yes' : 'No' }}
                        {{ $supportPlan->fallsRisk->worried_about_falling_details ?? '' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td>
                    <span class="label">Referral to Falls Clinic?</span>
                    <span class="value">
                        {{ $supportPlan->fallsRisk->referral_falls_clinic ? 'Yes' : 'No' }}
                        {{ $supportPlan->fallsRisk->referral_falls_clinic_details ?? '' }}
                    </span>
                </td>
                <td>
                    <span class="label">Referral to Occupational Therapist?</span>
                    <span class="value">
                        {{ $supportPlan->fallsRisk->referral_ot ? 'Yes' : 'No' }}
                        {{ $supportPlan->fallsRisk->fallrisk_referral_ot_details ?? '' }}
                    </span>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <span class="label">Referral to Physiotherapist?</span>
                    <span class="value">
                        {{ $supportPlan->fallsRisk->referral_physiotherapist ? 'Yes' : 'No' }}
                        {{ $supportPlan->fallsRisk->referral_physiotherapist_details ?? '' }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    {{-- cognitive --}}
    <div class="section">
    <div class="section-header">Cognition</div>
    <table>
        <tr>
            <td>
                <span class="label">Are there cognitive concerns?</span>
                <span class="value">
                    {{ $supportPlan->cognition->cognitive_concerns ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->cognitive_concerns_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Diagnosis of dementia?</span>
                <span class="value">
                    {{ $supportPlan->cognition->diagnosis_dementia ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->diagnosis_dementia_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Capable of making own decisions?</span>
                <span class="value">
                    {{ $supportPlan->cognition->capable_of_decisions ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->capable_of_decisions_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Power of Attorney / Guardian?</span>
                <span class="value">
                    {{ $supportPlan->cognition->has_power_of_attorney ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->power_of_attorney_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Becomes confused at times?</span>
                <span class="value">
                    {{ $supportPlan->cognition->becomes_confused ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->becomes_confused_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Experienced delirium?</span>
                <span class="value">
                    {{ $supportPlan->cognition->experienced_delirium ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->experienced_delirium_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Feels anxious or worried?</span>
                <span class="value">
                    {{ $supportPlan->cognition->anxious_or_worry ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->anxious_or_worry_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Short-term memory loss?</span>
                <span class="value">
                    {{ $supportPlan->cognition->short_term_memory_loss ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->short_term_memory_loss_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Long-term memory loss?</span>
                <span class="value">
                    {{ $supportPlan->cognition->long_term_memory_loss ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->long_term_memory_loss_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Health literacy support?</span>
                <span class="value">
                    {{ $supportPlan->cognition->health_literacy_support ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->health_literacy_support_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Referral to Geriatrician?</span>
                <span class="value">
                    {{ $supportPlan->cognition->referral_geriatrician ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->referral_geriatrician_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Referral to Psychologist?</span>
                <span class="value">
                    {{ $supportPlan->cognition->referral_psychologist ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->referral_psychologist_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <span class="label">Referral to Psychiatrist?</span>
                <span class="value">
                    {{ $supportPlan->cognition->referral_psychiatrist ? 'Yes' : 'No' }}
                    {{ $supportPlan->cognition->referral_psychiatrist_details ?? '' }}
                </span>
            </td>
        </tr>
    </table>
</div>

{{-- Behaviour Support --}}

<div class="section">
    <div class="section-header">Behaviour Support</div>
    <table>
        <tr>
            <td>
                <span class="label">Feeling agitation or frustration?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->feeling_agitation ? 'Yes' : 'No' }}
                    {{ $supportPlan->behaviourSupport->feeling_agitation_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Delusions or hallucinations previously?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->delusions_hallucinations ? 'Yes' : 'No' }}
                    {{ $supportPlan->behaviourSupport->delusions_hallucinations_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Changes to personality out of character?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->personality_changes ? 'Yes' : 'No' }}
                    {{ $supportPlan->behaviourSupport->personality_changes_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Wanders without purpose?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->wandering ? 'Yes' : 'No' }}
                    {{ $supportPlan->behaviourSupport->wandering_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Concerns of absconding?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->absconding ? 'Yes' : 'No' }}
                    {{ $supportPlan->behaviourSupport->absconding_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Screams, yells or verbally threatens?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->verbal_threats ? 'Yes' : 'No' }}
                    {{ $supportPlan->behaviourSupport->verbal_threats_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Physically assaults or threatens?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->physical_assault ? 'Yes' : 'No' }}
                    {{ $supportPlan->behaviourSupport->physical_assault_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Restrictive interventions occurring?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->restrictive_interventions ? 'Yes' : 'No' }}
                    {{ $supportPlan->behaviourSupport->restrictive_interventions_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Restrictive interventions approved?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->interventions_approved ? 'Yes' : 'No' }}
                    {{ $supportPlan->behaviourSupport->interventions_approved_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Referral to Positive Behaviour Support Practitioner?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->referral_pbsp ? 'Yes' : 'No' }}
                    {{ $supportPlan->behaviourSupport->referral_pbsp_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Behaviour Support Plan required?</span>
                <span class="value">
                    {{ $supportPlan->behaviourSupport->bsp_required ? 'Yes' : 'No' }}
                </span>
            </td>
            <td>
                <span class="label">Expiry of Behaviour Support Plan</span>
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
                <span class="value">
                    {{ $supportPlan->behaviourSupport->current_strategies ?? 'N/A' }}
                </span>
            </td>
        </tr>
    </table>
</div>

{{-- Personal Care --}}

<div class="section">
    <div class="section-header">Personal Care</div>
    <table>
        <tr>
            <td>
                <span class="label">Support to maintain daily personal care?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->support_daily_personal_care ? 'Yes' : 'No' }}
                    {{ $supportPlan->personalCare->daily_personal_care_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Support for showering?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->support_showering ? 'Yes' : 'No' }}
                    {{ $supportPlan->personalCare->showering_type ?? '' }}
                    {{ $supportPlan->personalCare->showering_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <span class="label">Personal care routine</span>
                <span class="value">
                    {{ $supportPlan->personalCare->personal_care_routine ?? 'N/A' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Support with dressing/undressing?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->support_dressing ? 'Yes' : 'No' }}
                    {{ $supportPlan->personalCare->dressing_details ?? '' }}
                    {{ $supportPlan->personalCare->dressing_routine ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Equipment in shower/bathroom?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->equipment_in_bathroom ? 'Yes' : 'No' }}
                    {{ $supportPlan->personalCare->equipment_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Support with shaving?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->support_shaving ? 'Yes' : 'No' }}
                    {{ $supportPlan->personalCare->shaving_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Support with haircuts?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->support_haircuts ? 'Yes' : 'No' }}
                    {{ $supportPlan->personalCare->haircuts_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Complete this task at home?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->task_at_home ? 'Yes' : 'No' }}
                </span>
            </td>
            <td>
                <span class="label">Wears dentures?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->wears_dentures ? 'Yes' : 'No' }}
                    {{ $supportPlan->personalCare->dentures_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Support with brushing teeth?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->support_teeth_brushing ? 'Yes' : 'No' }}
                    {{ $supportPlan->personalCare->teeth_brushing_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">OT assessment on bathroom/shower?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->ot_bathroom_assessment ? 'Yes' : 'No' }}
                    {{ $supportPlan->personalCare->ot_assessment_type ?? '' }}
                    {{ $supportPlan->personalCare->ot_assessment_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <span class="label">Referral to Occupational Therapist?</span>
                <span class="value">
                    {{ $supportPlan->personalCare->referral_ot_required ? 'Yes' : 'No' }}
                    {{ $supportPlan->personalCare->plancare_referral_ot_details ?? '' }}
                </span>
            </td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-header">Continence</div>
    <table>
        <tr>
            <td>
                <span class="label">Identified needs regarding continence support?</span>
                <span class="value">
                    {{ $supportPlan->continence->identified_needs ? 'Yes' : 'No' }}
                    {{ $supportPlan->continence->identified_needs_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Able to identify toilet needs?</span>
                <span class="value">
                    {{ $supportPlan->continence->identify_toilet_needs ? 'Yes' : 'No' }}
                    {{ $supportPlan->continence->identify_toilet_needs_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Require prompting to use toilet/change products?</span>
                <span class="value">
                    {{ $supportPlan->continence->require_prompting ? 'Yes' : 'No' }}
                    {{ $supportPlan->continence->require_prompting_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Wear continence aids?</span>
                <span class="value">
                    {{ $supportPlan->continence->wears_continence_aids ? 'Yes' : 'No' }}
                    {{ $supportPlan->continence->continence_aids_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">RUIS assessment required?</span>
                <span class="value">
                    {{ $supportPlan->continence->ruis_required ? 'Yes' : 'No' }}
                    {{ $supportPlan->continence->ruis_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">RFIS assessment required?</span>
                <span class="value">
                    {{ $supportPlan->continence->rfis_required ? 'Yes' : 'No' }}
                    {{ $supportPlan->continence->rfis_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Accessing funding for continence products?</span>
                <span class="value">
                    {{ $supportPlan->continence->funding_for_products ? 'Yes' : 'No' }}
                    {{ $supportPlan->continence->funding_for_products_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Continence Nurse Assessment previously?</span>
                <span class="value">
                    {{ $supportPlan->continence->nurse_assessment ? 'Yes' : 'No' }}
                    {{ $supportPlan->continence->nurse_assessment_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <span class="label">Does continence worry you?</span>
                <span class="value">
                    {{ $supportPlan->continence->worry_about_continence ? 'Yes' : 'No' }}
                    {{ $supportPlan->continence->worry_about_continence_details ?? '' }}
                </span>
            </td>
        </tr>
    </table>
</div>
{{-- Vision --}}

<div class="section">
    <div class="section-header">Vision</div>
    <table>
        <tr>
            <td>
                <span class="label">Do you wear glasses or contact lenses?</span>
                <span class="value">
                    {{ $supportPlan->vision->wears_glasses_or_contacts ? 'Yes' : 'No' }}
                    {{ $supportPlan->vision->glasses_or_contacts_type ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">When do you wear them?</span>
                <span class="value">
                    {{ $supportPlan->vision->vision_when_worn ?? 'N/A' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Last Optometrist Appointment:</span>
                <span class="value">
                    {{ $supportPlan->vision->last_optometrist_appointment
                        ? \Carbon\Carbon::parse($supportPlan->vision->last_optometrist_appointment)->format('d/m/Y')
                        : 'N/A' }}
                </span>
            </td>
            <td>
                <span class="label">Any aspects of vision worry you?</span>
                <span class="value">
                    {{ $supportPlan->vision->vision_worry ? 'Yes' : 'No' }}
                    {{ $supportPlan->vision->vision_worry_details ?? '' }}
                </span>
            </td>
        </tr>
    </table>
</div>

{{-- Hearing --}}
<div class="section">
    <div class="section-header">Hearing</div>
    <table>
        <tr>
            <td>
                <span class="label">Do you wear hearing devices?</span>
                <span class="value">
                    {{ $supportPlan->hearing->wears_hearing_devices ? 'Yes' : 'No' }}
                    {{ $supportPlan->hearing->hearing_devices_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">When do you wear them?</span>
                <span class="value">
                    {{ $supportPlan->hearing->when_worn ?? 'N/A' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Last Audiologist Appointment:</span>
                <span class="value">
                    {{ $supportPlan->hearing->last_audiologist_appointment
                        ? \Carbon\Carbon::parse($supportPlan->hearing->last_audiologist_appointment)->format('d/m/Y')
                        : 'N/A' }}
                </span>
            </td>
            <td>
                <span class="label">Any aspects of hearing worry you?</span>
                <span class="value">
                    {{ $supportPlan->hearing->hearing_worry ? 'Yes' : 'No' }}
                    {{ $supportPlan->hearing->hearing_worry_details ?? '' }}
                </span>
            </td>
        </tr>
    </table>
</div>

{{-- Skin Conditions --}}
<div class="section">
    <div class="section-header">Skin Conditions</div>
    <table>
        <tr>
            <td>
                <span class="label">Do you have any skin conditions?</span>
                <span class="value">
                    {{ $supportPlan->skinCondition->has_skin_condition ? 'Yes' : 'No' }}
                    {{ $supportPlan->skinCondition->skin_condition_type ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Does your skin condition impact daily activities?</span>
                <span class="value">
                    {{ $supportPlan->skinCondition->impacts_daily_activities ? 'Yes' : 'No' }}
                    {{ $supportPlan->skinCondition->impact_date
                        ? \Carbon\Carbon::parse($supportPlan->skinCondition->impact_date)->format('d/m/Y')
                        : '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Pain/Discomfort Level:</span>
                <span class="value">
                    {{ $supportPlan->skinCondition->pain_discomfort_level ?? 'N/A' }}
                    (Score: {{ $supportPlan->skinCondition->pain_level_score ?? 'N/A' }})
                </span>
            </td>
            <td>
                <span class="label">Strategies:</span>
                <span class="value">{{ $supportPlan->skinCondition->management_strategies ?? 'N/A' }}</span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Does condition worry you?</span>
                <span class="value">
                    {{ $supportPlan->skinCondition->skin_condition_worry ? 'Yes' : 'No' }}
                    {{ $supportPlan->skinCondition->worry_date
                        ? \Carbon\Carbon::parse($supportPlan->skinCondition->worry_date)->format('d/m/Y')
                        : '' }}
                </span>
            </td>
            <td>
                <span class="label">Referral to Nursing required?</span>
                <span class="value">
                    {{ $supportPlan->skinCondition->referral_nursing_required ? 'Yes' : 'No' }}
                    {{ $supportPlan->skinCondition->referral_nursing_date
                        ? \Carbon\Carbon::parse($supportPlan->skinCondition->referral_nursing_date)->format('d/m/Y')
                        : '' }}
                </span>
            </td>
        </tr>
    </table>
</div>

{{-- Dietary Requirements & Meal Preparation --}}

<div class="section">
    <div class="section-header">Dietary Requirements & Meal Preparation</div>
    <table>
        <tr>
            <td><span class="label">Intolerances:</span>
                <span class="value">{{ $supportPlan->dietary->intolerances ? 'Yes' : 'No' }}
                    {{ $supportPlan->dietary->intolerances_details ?? '' }}</span>
            </td>
            <td><span class="label">Dysphagia Concerns:</span>
                <span class="value">{{ $supportPlan->dietary->dysphagia_concerns ? 'Yes' : 'No' }}
                    {{ $supportPlan->dietary->dysphagia_details ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Speech Pathologist Recommendations:</span>
                <span class="value">{{ $supportPlan->dietary->speech_pathologist_recommendations ? 'Yes' : 'No' }}</span>
            </td>
            <td><span class="label">IDDSI Food Category:</span>
                <span class="value">{{ $supportPlan->dietary->iddsi_food_category ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">IDDSI Liquid Category:</span>
                <span class="value">{{ $supportPlan->dietary->iddsi_liquid_category ?? 'N/A' }}</span>
            </td>
            <td><span class="label">Prepares Meals:</span>
                <span class="value">{{ $supportPlan->dietary->prepares_meals ? 'Yes' : 'No' }}
                    {{ $supportPlan->dietary->prepares_meals_details ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Needs Meal Support:</span>
                <span class="value">{{ $supportPlan->dietary->needs_meal_support ? 'Yes' : 'No' }}
                    {{ $supportPlan->dietary->meal_support_details ?? '' }}</span>
            </td>
            <td><span class="label">Diet Meets Needs:</span>
                <span class="value">{{ $supportPlan->dietary->diet_meets_needs ? 'Yes' : 'No' }}
                    {{ $supportPlan->dietary->diet_meets_needs_details ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Needs Cutting Support:</span>
                <span class="value">{{ $supportPlan->dietary->needs_cutting_support ? 'Yes' : 'No' }}
                    {{ $supportPlan->dietary->cutting_support_details ?? '' }}</span>
            </td>
            <td><span class="label">Needs Feeding Support:</span>
                <span class="value">{{ $supportPlan->dietary->needs_feeding_support ? 'Yes' : 'No' }}
                    {{ $supportPlan->dietary->feeding_support_details ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td><span class="label">Dietician Referral Required:</span>
                <span class="value">{{ $supportPlan->dietary->dietician_referral_required ? 'Yes' : 'No' }}
                    {{ $supportPlan->dietary->dietician_referral_details ?? '' }}</span>
            </td>
            <td><span class="label">Needs Shopping Support:</span>
                <span class="value">{{ $supportPlan->dietary->needs_shopping_support ? 'Yes' : 'No' }}
                    {{ $supportPlan->dietary->shopping_support_details ?? '' }}</span>
            </td>
        </tr>
    </table>
</div>

{{-- Pain Management --}}
<div class="section">
    <div class="section-header">Pain Management</div>
    <table>
        <tr>
            <td>
                <span class="label">Do you have ongoing pain?</span>
                <span class="value">
                    {{ $supportPlan->painManagement->ongoing_pain ? 'Yes' : 'No' }}
                    {{ $supportPlan->painManagement->pain_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Location of the pain</span>
                <span class="value">{{ $supportPlan->painManagement->pain_location ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Frequency of the pain</span>
                <span class="value">{{ $supportPlan->painManagement->pain_frequency ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Scale of the pain (1-10)</span>
                <span class="value">{{ $supportPlan->painManagement->pain_scale ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Currently supported for pain?</span>
                <span class="value">
                    {{ $supportPlan->painManagement->supported_for_pain ? 'Yes' : 'No' }}
                    {{ $supportPlan->painManagement->supported_pain_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Strategies to manage pain</span>
                <span class="value">{{ $supportPlan->painManagement->pain_management_strategies ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Abbey Pain Scale required?</span>
                <span class="value">{{ $supportPlan->painManagement->abbey_pain_scale_required ? 'Yes' : 'No' }}</span>
            </td>
            <td>
                <span class="label">Does any aspect of pain worry you?</span>
                <span class="value">
                    {{ $supportPlan->painManagement->pain_worry ? 'Yes' : 'No' }}
                    {{ $supportPlan->painManagement->pain_worry_details ?? '' }}
                </span>
            </td>
        </tr>
    </table>
</div>
{{-- Social Connections & Community Access --}}
<div class="section">
    <div class="section-header">Social Connections & Community Access</div>
    <table>
        <tr>
            <td><span class="label">Do you ever feel lonely?</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->feels_lonely ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->feels_lonely_details ?? '' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Do you have informal supports?</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->has_informal_supports ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->informal_supports_details ?? '' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Do you want to engage more with the local community?</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->wants_more_community_engagement ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->community_engagement_details ?? '' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Do you need support accessing the community?</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->needs_community_access_support ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->community_access_support_details ?? '' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Do you have a multi-purpose taxi card?</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->has_taxi_card ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->taxi_card_details ?? '' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Interested in Community Visitors Program?</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->interested_in_visitors_program ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->visitors_program_details ?? '' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Hobbies & Activities:</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->has_hobbies_activities ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->hobbies_activities_details ?? '' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Duke Social Support Index Required?</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->needs_duke_index ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->duke_index_details ?? '' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Do you need support with feeding?</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->needs_feeding_support ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->feeding_support_details ?? '' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Referral to Dietician?</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->wants_dietician_referral ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->dietician_referral_details ?? '' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Support with food shopping/unpacking?</span></td>
            <td><span class="value">{{ $supportPlan->socialConnection->needs_shopping_support ? 'Yes' : 'No' }} {{ $supportPlan->socialConnection->shopping_support_details ?? '' }}</span></td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-header">Maintaining Your Home</div>
    <table>
        <tr>
            <td>
                <span class="label">Do you need support with domestic assistance within the home?</span>
                <span class="value">
                    {{ $supportPlan->homeMaintenance->domestic_assistance ? 'Yes' : 'No' }}
                    {{ $supportPlan->homeMaintenance->domestic_assistance_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Level of independence</span>
                <span class="value">
                    {{ $supportPlan->homeMaintenance->domestic_independence ?? 'N/A' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do you also need help obtaining safe and approved cleaning products and equipment?</span>
                <span class="value">
                    {{ $supportPlan->homeMaintenance->cleaning_products_support ? 'Yes' : 'No' }}
                    {{ $supportPlan->homeMaintenance->cleaning_products_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Do you need support with maintaining your gardens to be safe?</span>
                <span class="value">
                    {{ $supportPlan->homeMaintenance->garden_maintenance ? 'Yes' : 'No' }}
                    {{ $supportPlan->homeMaintenance->garden_maintenance_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Do you have any trouble navigating the house at night?</span>
                <span class="value">
                    {{ $supportPlan->homeMaintenance->trouble_navigating_night ? 'Yes' : 'No' }}
                    {{ $supportPlan->homeMaintenance->trouble_navigating_night_details ?? '' }}
                </span>
            </td>
            <td>
                <span class="label">Are there any aspects of maintaining your home that worry you?</span>
                <span class="value">
                    {{ $supportPlan->homeMaintenance->home_worry ? 'Yes' : 'No' }}
                    {{ $supportPlan->homeMaintenance->home_worry_details ?? '' }}
                </span>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">Date Home Safety Assessment was last completed:</span>
                <span class="value">
                    {{ $supportPlan->homeMaintenance->last_home_safety_assessment
                        ? \Carbon\Carbon::parse($supportPlan->homeMaintenance->last_home_safety_assessment)->format('d/m/Y')
                        : 'N/A' }}
                </span>
            </td>
            <td>
                <span class="label">Key areas of focus to be supported identified from Home:</span>
                <span class="value">
                    {{ $supportPlan->homeMaintenance->focus_areas ?? 'N/A' }}
                </span>
            </td>
        </tr>
    </table>
</div>






</div>

</body>
</html>
