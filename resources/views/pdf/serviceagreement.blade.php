<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Service Agreement PDF</title>
    <style>
    /* Base Styles */
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

    /* Header Styles */
    .header {
        position: relative;
        text-align: center;
        margin-bottom: 30px;
    }

    .logo {
        position: absolute;
        top: 0;
        left: 0;
        max-width: 70px;
        height: auto;
    }

    .header h2 {
        font-size: 22px;
        font-weight: bold;
        text-transform: uppercase;
        margin: 0;
    }

    /* Section Titles */
    .section-title {
        background-color: #e0f2fe;
        color: #0369a1;
        padding: 10px 15px;
        font-weight: bold;
        border-left: 4px solid #0284c7;
        margin-bottom: 10px;
        border-radius: 4px;
        font-size: 14px;
        text-transform: uppercase;
    }

    /* General Table Styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 18px;
    }

    th, td {
        border: 1px solid #e5e7eb;
        padding: 6px 8px;
        text-align: left;
    }

    th {
        background-color: #f9fafb;
        font-weight: bold;
        width: 30%;
    }


    .participant-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 50px;
        border: 1px solid #e5e7eb;
    }

    .participant-table th {
        background-color: #f8fafc;
        color: #374151; /* Fixed: Changed back to dark gray */
        font-weight: 600;
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        width: 35%;
        font-size: 11px;
        text-align: left;
        vertical-align: top;
    }

    .participant-table td {
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        background-color: white;
        font-size: 11px;
        vertical-align: top;
        line-height: 1.4;
    }

    .participant-table tr:nth-child(even) td {
        background-color: #fafbfc;
    }
    .participant-table tr:nth-child(even) td {
        background-color: #fafbfc;
    }

    /* Field Group Styles */
    .field-group {
        margin-bottom: 8px;
    }

    .field-label {
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 2px;
        font-size: 10px;
    }

    .field-value {
        color: #111827;
        font-size: 11px;
    }

    /* Date Group Styles */
    .date-group {
        display: flex;
        gap: 15px;
        margin-bottom: 8px;
    }

    .date-item {
        flex: 1;
    }

    .date-label {
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 2px;
        font-size: 10px;
    }

    .date-value {
        color: #111827;
        font-size: 11px;
    }

    /* Provider Info Styles */
    .provider-info {
        background-color: #f8f9fa;
        padding: 15px;
        text-align: center;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    /* Clause Styles */
    .clause {
        margin-bottom: 20px;
        page-break-inside: avoid;
    }

    .clause h4 {
        margin-bottom: 8px;
        color: #0369a1;
    }

    .clause-content {
        line-height: 1.4;
    }

    /* Consent Section Styles */
    .consent-section {
        margin-bottom: 25px;
        padding: 15px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        background-color: #fafbfc;
    }

    .consent-title {
        font-weight: bold;
        margin-bottom: 10px;
        color: #0369a1;
        font-size: 14px;
    }

    .consent-text {
        margin-bottom: 15px;
        font-style: bold;
        color: #4b5563;
        line-height: 1.4;
    }

    /* Consent Table Specific Styles */
    .consent-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
        border: 1px solid #d1d5db;
    }

    .consent-table th,
    .consent-table td {
        border: 1px solid #e5e7eb;
        padding: 8px 12px;
        text-align: left;
    }

    .consent-table th {
        background-color: #f3f4f6;
        font-weight: 600;
        width: 35%;
        color: #374151;
    }

    .consent-table th[colspan="2"] {
        background-color: #e0f2fe;
        color: #0369a1;
        text-align: center;
        font-size: 13px;
    }

    /* Office Use Section Styles */
    .office-use-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 6px;
        margin-top: 20px;
        border: 2px solid #e5e7eb;
    }

    .office-title {
        font-weight: bold;
        margin-bottom: 15px;
        color: #dc2626;
        font-size: 14px;
        border-bottom: 2px solid #dc2626;
        padding-bottom: 5px;
    }

    /* Checkbox and Enum Styles */
    .checkbox-option {
        display: inline-block;
        margin-right: 15px;
        margin-bottom: 8px;
    }

    .enum-field {
        display: flex;
        gap: 15px;
        margin-top: 4px;
    }

    .enum-option {
        padding: 4px 12px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
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

    /* Signature Image Styles */
    .signature-img {
        max-height: 70px;
        border: 1px solid #ccc;
        padding: 4px;
        display: block;
        background-color: white;
    }

    /* Table Container for Better Border Control */
.table-container {
    margin-bottom: 20px;
    border: 1px solid #d1d5db;
    border-radius: 6px;

}

/* Consent Table Styles */
.consent-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.consent-table th,
.consent-table td {
    border: 1px solid #e5e7eb;
    padding: 10px 12px;
    text-align: left;
    vertical-align: top;
}

.consent-table th {
    background-color: #f8fafc;
    font-weight: 600;
    width: 35%;
    color: #374151;
    font-size: 11px;
}

.consent-table td {
    background-color: white;
    font-size: 11px;
}

/* Table Header Row */
.table-header {
    background-color: #e0f2fe !important;
    color: #0369a1 !important;
    text-align: center !important;
    font-size: 13px !important;
    font-weight: bold !important;
    padding: 12px 15px !important;
}

/* Ensure proper borders on all sides */
.consent-table thead th {
    border-bottom: 2px solid #0284c7;
}

.consent-table tbody tr:last-child th,
.consent-table tbody tr:last-child td {
    border-bottom: 1px solid #e5e7eb;
}
</style>
</head>
<body>

@php
    use Carbon\Carbon;
    function formatDate($date) {
        return $date ? Carbon::parse($date)->format('d/m/Y') : '-';
    }
@endphp

<div class="container">

    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <h2>Service Agreement</h2>
        <div class="document-number">Document Number: <span>SA-01</span></div>


    </div>


     {{-- Participant Details Table --}}
    <table class="participant-table">
        <tr>
            <td colspan="2" style="background-color: #e0f2fe; color: #0369a1; padding: 10px 15px; font-weight: bold; border-left: 4px solid #0284c7; margin-bottom: 10px; border-radius: 4px; font-size: 14px; text-transform: uppercase; border: 1px solid #e5e7eb;">
                1. PARTICIPANT & REPRESENTATIVE DETAILS
            </td>
        </tr>

        {{-- Participant Basic Information --}}
        <tr>
            <th>Participant Name</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ $serviceAgreement->participant_name ?? 'saharayaj' }}</div>
                </div>
            </td>
        </tr>
        <tr>
            <th>NDIS Number</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ $serviceAgreement->ndis_number ?? '12345678' }}</div>
                </div>
            </td>
        </tr>

        {{-- Address Section --}}
        <tr>
            <th>Address</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ $serviceAgreement->address ?? 'kottyaru' }}</div>
                </div>
            </td>
        </tr>

        {{-- Contact Information --}}
        <tr>
            <th>Contact</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ $serviceAgreement->contact ?? 'Enter contact number' }}</div>
                </div>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ $serviceAgreement->email ?? 'Enter email address' }}</div>
                </div>
            </td>
        </tr>

        {{-- Date of Birth --}}
        <tr>
            <th>Date of Birth</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ formatDate($serviceAgreement->dob) }}</div>
                </div>
            </td>
        </tr>

        {{-- NDIS Plan Dates --}}
  {{-- NDIS Plan Dates --}}
<tr>
    <th>NDIS Plan Dates</th>
    <td>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 50%; padding: 4px 8px; border-right: 1px solid #e5e7eb;">
                    <div class="date-label">NDIS Plan Start Date</div>
                    <div class="date-value">{{ formatDate($serviceAgreement->ndis_plan_start_date) }}</div>
                </td>
                <td style="width: 50%; padding: 4px 8px;">
                    <div class="date-label">NDIS Plan End Date</div>
                    <div class="date-value">{{ formatDate($serviceAgreement->ndis_plan_end_date) }}</div>
                </td>
            </tr>
        </table>
    </td>
</tr>

{{-- Term Dates --}}
<tr>
    <th>Agreement Term Dates</th>
    <td>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 50%; padding: 4px 8px; border-right: 1px solid #e5e7eb;">
                    <div class="date-label">Term Start Date</div>
                    <div class="date-value">{{ formatDate($serviceAgreement->term_start_date) }}</div>
                </td>
                <td style="width: 50%; padding: 4px 8px;">
                    <div class="date-label">Term End Date</div>
                    <div class="date-value">{{ formatDate($serviceAgreement->term_end_date) }}</div>
                </td>
            </tr>
        </table>
    </td>
</tr>
        {{-- Area of Support --}}
        <tr>
            <th>Area of Support</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ $serviceAgreement->area_of_support ?? 'Enter areas of support' }}</div>
                </div>
            </td>
        </tr>

        {{-- Representative Information --}}
        <tr>
            <td colspan="2" style="background-color: #f0f9ff; padding: 8px 12px; border: 1px solid #e5e7eb;">
                <div class="sub-section-title">Representative Details</div>
            </td>
        </tr>

        <tr>
            <th>Representative Name</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ $serviceAgreement->representative_name ?? 'Enter representative name' }}</div>
                </div>
            </td>
        </tr>

        <tr>
            <th>Relationship</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ $serviceAgreement->representative_relationship ?? 'Enter relationship' }}</div>
                </div>
            </td>
        </tr>

        <tr>
            <th>Representative Contact</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ $serviceAgreement->representative_contact ?? 'Enter representative contact' }}</div>
                </div>
            </td>
        </tr>

        <tr>
            <th>Representative Email</th>
            <td>
                <div class="field-group">
                    <div class="field-value">{{ $serviceAgreement->representative_email ?? 'Enter representative email' }}</div>
                </div>
            </td>
        </tr>
    </table>
<div style="page-break-before: always;"></div>

    {{-- The Provider --}}
    <div class="provider-info">
        <h3>The Provider</h3>
        <table>
            <tr><th>Company Name</th><td>Best of Homecare</td></tr>
            <tr><th>ABN</th><td>63691624877</td></tr>
            <tr><th>Contact</th><td>1300 513 309</td></tr>
            <tr><th>Email</th><td>admin@bestofhomecare.com</td></tr>
            <tr><th>Address</th><td>1/43 Rainier Crescent, Clyde North. VIC 3978</td></tr>
        </table>
    </div>



    {{-- Agreement Clauses --}}
    <div class="section-title">Service Agreement Terms</div>

    <div class="clause">
        <h4>1. Purpose of this Agreement</h4>
        <div class="clause-content">
            The purpose of this Agreement is to document the arrangement between and best of homecare. Any changes to the services and/or support listed in this Agreement will require prior authorisation from all parties. The parties agree that any changes to this Service Agreement requires a 14-day notice period. The notice must be in writing, signed and dated by all parties and a copy of the amendments must be provided to the Participant.
        </div>
    </div>

    <div class="clause">
        <h4>2. Terms of Agreement</h4>
        <div class="clause-content">
            The Agreement will start and end on dates specified on page 2 of this Agreement unless the Agreement is terminated earlier under Clause 12 - Termination. There will be a service review date completed every 12 months.
        </div>
    </div>

    <div class="clause">
        <h4>3. Description of Services</h4>
        <div class="clause-content">
            Best of Homecare offers a range of service types that can be used as a single service or as a combination of services and supports to suit the Participant. Best of Homecare provide a minimum of 2 hours per service under one service request. The Provider's details of services and costs are detailed in Schedule 1 - Service Fees.
        </div>
    </div>

    <div class="clause">
        <h4>4. Billing Method</h4>
        <div class="clause-content">
            You agree to giving Best of Homecare consent to transfer the budget within Core budgets as required (as core budget is flexible, we may transfer funds to claims the invoices as required). The NDIS Service Provider will request payment after support services have been delivered in the following ways:
            <ul>
                <li><strong>Self-Managed:</strong> An invoice will be provided to the Participant following the service. Full payment of the invoice is required within 7 days, via direct deposit/transfer.</li>
                <li><strong>NDIA Managed:</strong> The NDIA will pay your invoice on your behalf. The invoice will be sent to the NDIA following the service. Full payment of the invoice is required within 7 days, via direct deposit/transfer.</li>
                <li><strong>Plan Managed:</strong> Your Plan Manager will be issued the invoice following the service. Full payment of the invoice within 7 days, via direct deposit/transfer.</li>
            </ul>
            Fees for support: Fees will be charged for the services set out in Schedule 1 - Service Fees, based on the NDIS Price Guide rate applicable to the date on which the service is provided. NDIS Price Guide for Support Service Costing: https://www.ndis.gov.au/providers/price-guides-and-pricing.
        </div>
    </div>

    <div class="clause">
        <h4>5. Payment</h4>
        <div class="clause-content">
            The NDIS Service Provider will seek payment for their provision of supports and services after the Participant and/or their representative confirms satisfactory delivery, and/or fees pertinent to the Cancellation requirements. The Participant or their nominee manages the funding supports provided under this Service Agreement. After Providing supports and services, the NDIS Service Provider will send the Participant/Participant's Nominee an invoice for those supports and services for the Participant/Participant's Nominee to pay. The Participant/Participant's Nominee will pay the invoice by EFT or credit-card within 14 days. Non-payment of monies owed will result in the automatic termination of this Agreement.
        </div>
    </div>

    <div class="clause">
        <h4>6. Goods and Services Tax (GST)</h4>
        <div class="clause-content">
            For the purposes of GST legislation, the Parties confirm that a supply of supports under this Agreement is a supply of one or more reasonable and necessary supports specified in the statement of supports, under subsection 33(2) of the National Disability Insurance scheme Act 2013 (Cth), in the Participant's NDIS Plan currently in effect under Section 37 of the National Disability Insurance scheme Act 2013 (Cth).
        </div>
    </div>

    <div class="clause">
        <h4>7. Participant/Participant's Nominee Rights and Responsibilities</h4>
        <div class="clause-content">
            Whilst accessing services outlined in this Agreement as a Participant/Participant's Nominee, I have:
            <ul>
                <li>The right to nominate, in writing, an Advocate or Nominee, who will act in my interests and accept the responsibilities imposed under this Agreement.</li>
                <li>The right to determine the type and range of activities/services that I wish to participate in.</li>
                <li>The right to review and alter this Agreement according to Clause 1 Purpose of this Agreement.</li>
                <li>The right to privacy and confidentiality and in keeping with the Health Records Legislation to request access to any health information kept by the Provider.</li>
            </ul>
            As a Participant/Participant's Nominee, I will:
            <ul>
                <li>Sign and return to this Service Agreement within 14 days (Service will not be provided without a signed Agreement or written acknowledgement from the Participant).</li>
                <li>Treat staff and other Participants with courtesy, respect, and consideration at all times.</li>
                <li>Keep the Provider updated with any personal changes such as my address, medication, and medical history as well as health and/or behaviour support plans. Work cooperatively with the Provider regarding issues arising with the development and delivery of support and service covered in this Agreement.</li>
                <li>Provide information as requested by the Provider in a timely manner. Ensure I am home at the agreed time and date to receive the services.</li>
                <li>Ensure my home/residence is a safe environment for the Provider's Employees.</li>
                <li>Give the Provider 7 days' notice, if I cannot make a scheduled appointment, to avoid a late cancellation fee of up to 100% of service fee costs.</li>
                <li>Provide 1 months written notice if I wish to terminate this Agreement as detailed in the Cancellation Policy of this Agreement.</li>
                <li>Notify the Provider immediately if my NDIS plan is suspended or replaced by a new NDIS Plan or if I stop being a Participant in the NDIS.</li>
            </ul>
        </div>
    </div>

    <div class="clause">
        <h4>8. Provider Responsibilities</h4>
        <div class="clause-content">
            <ul>
                <li>Respect the rights and encourage the Participant to determine the range and types of activities they wish to participate in</li>
                <li>Communicate with the Participant in an open, honest, and timely manner. Treat the Participant with courtesy, respect, and consideration at all times.</li>
                <li>Work cooperatively with the Participant/Participant's nominee regarding issues arising with the development and delivery of support and service covered in this Agreement.</li>
                <li>Will prepare a support plan with the Participant/Participant's Nominee outlining the activities/supports they will undertake...</li>
                <li>Will treat information about the Participant and their activities as private and confidential online with the Participant's wishes and with privacy legislation</li>
                <li>Will provide the Participant with 1 months' notice of intention to cease service provisions.</li>
                <li>Will provide information in a language of the Participants choice, including use of interpreters and Auslan requirements.</li>
                <li>Review the Support Plan at least annually with the Participants Representative</li>
                <li>Provide support that meets the Participants needs at the Participants preferred times.</li>
                <li>Give the Participant a minimum of 24 hours' notice if the Provider needs to change a scheduled appointment to provide supports.</li>
                <li>Provide 1 Month written notice to terminate this Agreement and/or as detailed in the Termination section of this Agreement.</li>
                <li>Provide appropriately trained and accredited support staff including absenteeism of staff.</li>
                <li>Charge according to the NDIS Price Guide and Participants assessed needs.</li>
                <li>Issue regular invoices and statements of the supports delivered to the Participant.</li>
            </ul>
        </div>
    </div>

    <div class="clause">
        <h4>9. Cancellation Policy</h4>
        <div class="clause-content">
            If a Participant, or their Nominated Participant fails to provide reasonable notice (at least 7 days' notice) in advance, prior to the cancellation of a scheduled support/service, or agreed appointment, then the Provider will seek recompense by way of charging 100% of the fee foregone for that session.
        </div>
    </div>

    <div class="clause">
        <h4>10. Additional NDIS Expenses</h4>
        <div class="clause-content">
            <strong>a) Travel / Transport Costs</strong><br>
            Where a staff member is required to travel to the participant, the participant may be invoiced for either 0.5 hours of provider travel per visit or the accompanied travel cost According to the price guide related to the service we are providing, Please refer to the schedule of Support. Additional expenses that are not included as part of the participants NDIS supports are the responsibility of the client and are not included in the cost of the support this includes but not limited to, meals, parking, entry costs etc<br><br>

            <strong>b) Non-face-to-face supports</strong><br>
            Non-face-to-face activities Best of Homecare may deliver that are specifically related to your disability and your NDIS goals will be claimed accordingly from your NDIS funding. Activities include but are not limited to: reports for co-workers and provider reports relating to your skill development. Best of Homecare will explain activities completed and how these will bring value to you prior to claiming.<br><br>

            <strong>c) NDIA Requested reports</strong><br>
            Where the NDIA requests a report that outlines plan objectives, goals, ongoing needs etc Best of Homecare will claim the time taken to collate these reports from your NDIS funding.<br><br>

            <strong>d) Establishment Fee</strong><br>
            Where Best of Homecare provides you with a minimum of 20 hours of support per month in either personal care or participation supports, we will charge a one-time fee, across all plans, accordingly.<br><br>

            <strong>e) Consumables</strong><br>
            Any cost or additional expenses related to your disability that needs to be purchased, we can assist and help you to do so. These requested purchases will be claimed against your consumables funding within your plan. We will let you and your representative know the details and costs before proceeding with any claims.
        </div>
    </div>

    <div class="clause">
        <h4>11. Emergency and Disaster Management</h4>
        <div class="clause-content">
            Best of Homecare will assess your reliance on the service provided to you during an emergency or natural disaster. Where it is determined that disruption to your service would impact your health and wellbeing, we will develop an emergency and disaster plan to ensure continued service provision.
        </div>
    </div>

    <div class="clause">
        <h4>12. Termination</h4>
        <div class="clause-content">
            Should either Party wishes to end this Agreement they must give 1 months' notice, without cause. If either party is in breach of this Agreement, the party in breach will remedy the breach within thirty (30) days of that party receiving written notice requiring it to fix the breach. 100% of rostered supports will be claimed if appropriate notice is not provided. If notice has been given and the breach is not satisfactorily remedied within thirty (30) days, the party who gave the notice may immediately terminate this Agreement by giving written notice. Note: In some instances, support may be withdrawn for valid reasons, however access to supports required by the participant will not be withdrawn or denied solely on the basis of a dignity of risk choice that has been made by the participant.
        </div>
    </div>

    <div class="clause">
        <h4>13. Feedback, Complaints and Disputes</h4>
        <div class="clause-content">
            The Provider recognises that Participants/Participants Nominee and their carers have a right to provide feedback to our staff, management and Board of Directors to raise suggestions, resolve grievances and commend good performance and encourages all Participants to speak up when they are not happy. Any individual, stakeholder or agency wishing to lodge a complaint against the organisation's services, management or staff will be provided with information regarding the organisation's Feedback, Compliments and Complaints Policy and Process and contact our office via our participant handbook. Complaints and feedback can be lodged using the Compliments, complaints and feedback form and/or contacting Senior Management at our office. Any complaint will be heard respectfully and a willingness to assist complainant. If you wish to direct your complaint externally, you can contact the NDIS Quality and Safeguards Commission on 1800 035 544 or seek independent assistance through an advocate.
        </div>
    </div>

    <div class="clause">
        <h4>14. Advocacy</h4>
        <div class="clause-content">
            The Participant has a right to be represented by an advocate at any time and we encourage the use of advocates during the assessment and planning process. Advocates can be a family member, friend, medical practitioner or from an advocacy body. The Provider staff can assist you to access the services of an advocacy body. Please see the Advocacy Services List available on the Office of Public Advocate website www.disabilityadvocacyfinder.dss.gov.au/disability/ndap/
        </div>
    </div>

    <div class="clause">
        <h4>15. Day Program Services Only</h4>
        <div class="clause-content">
            <strong>a) Materials Fees</strong><br>
            Best of Homecare will cover the costs of resources used in these programs. If additional resources are requested, then you will need to cover the costs of these supplies outside of your NDIS funding. Best of Homecare offers excellent, well-resourced programs at each of our sites to help our clients build skills. Best of Homecare will charge a material fee per day, per person, to cover resources used in these programs, Specific costs that this fee covers include, but are not limited to, printing, stationery and art supplies. This fee will be invoiced on a regular basis and calculated based on each client's attendance. Refer to the quote for the current per day fee.<br><br>

            <strong>b) Additional Activities</strong><br>
            Activities that incur an entry cost (i.e. swimming entry fee) or specific resources to undertake, outside of the standard materials and resources maybe covered by Best of Homecare however this will need to be discussed in advance and notice provided to negotiate personal contributions you can make outside of your NDIS funding.<br><br>

            <strong>c) In Program Transport</strong><br>
            Best of Homecare will charge Participants for transport costs incurred within programs per day when the program involves Best of Homecare organised transport, i.e. buses and taxis, This fee will be invoiced on a regular basis and calculated based on each Participant's attendance. Refer to the quote for the current per day fee. When a Participant uses public transport, they will be required to bring their myki card (Participant responsible for having credit) and will not be charged the in-program transport fee.<br><br>

            <strong>d) Centre Capital Costs</strong><br>
            Centre Capital Costs will be claimed from your plan to cover our costs of running and maintaining the centre during the time you we are providing support to you in our Day Program, within this centre. Costs will be claimed per hour according to the NDIS Price Guide
        </div>
    </div>

    <div class="clause">
        <h4>16. SIL/SDA Service Provision</h4>
        <div class="clause-content">
            Where supported independent living supports to participants in specialist disability accommodation dwellings, documented arrangements are in place with each participant and each specialist disability accommodation provider. At a minimum, the arrangements will outline the party or parties responsible and their roles (where applicable) for the following matters:
            <ul>
                <li>How a Participant's concerns about the dwelling will be communicated and addressed:</li>
                <li>How potential conflicts involving participant(s) will be managed:</li>
                <li>How changes to participant circumstances and/or support needs will be agreed and communicate</li>
                <li>In shared living, how vacancies will be filled, including each participant's right to have their needs, preferences and situation taken into account:</li>
                <li>How behaviours of concern which may put tenancies at risk will be managed:</li>
            </ul>
            Please refer to your SIL residency agreement in relation to the following areas:
            <ul>
                <li>Ending your SIL Supports</li>
                <li>Property Maintenance</li>
                <li>Filling Vacancies</li>
                <li>Participant and Households Expense Contributions</li>
                <li>House Rules</li>
            </ul>
        </div>
    </div>

   {{-- Consent Section --}}
@if($serviceAgreement->consent)
<div class="section-title">2. SERVICE AGREEMENT</div>

{{-- Written Participant Consent --}}
<div class="consent-section">
    <div class="consent-title">Written Participant Consent</div>
    <div class="consent-text">
        Participant's Signature confirming the support arrangement and service agreement with Best of Homecare: I, understand, accept, and agree to the information outlined in this Agreement and Schedule.
    </div>

    {{-- Organization Representative Table --}}
    <div class="table-container">
        <table class="consent-table">
            <thead>
                <tr>
                    <th colspan="2" class="table-header">Accepted By (Organization Representative)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $serviceAgreement->consent->accepted_name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td>{{ $serviceAgreement->consent->accepted_position ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Signature</th>
                    <td>
                        @if(!empty($serviceAgreement->consent->accepted_signature))
                            <img src="{{ $serviceAgreement->consent->accepted_signature }}" alt="Signature" class="signature-img">
                        @else -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ formatDate($serviceAgreement->consent->accepted_date) }}</td>
                </tr>
            </tbody>
        </table>
    </div>




    {{-- Participant Table --}}
    <div class="table-container">
        <table class="consent-table">
            <thead>
                <tr>
                    <th colspan="2" class="table-header">Agreement accepted and signed on behalf of Best of Homecare</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $serviceAgreement->consent->consents_participant_name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td>
                        <div class="enum-field">
                            @foreach(['participant', 'representative'] as $option)
                                <span class="enum-option {{ ($serviceAgreement->consent->participant_role ?? '') === $option ? 'selected' : '' }}">
                                    {{ ucfirst($option) }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Signature</th>
                    <td>
                        @if(!empty($serviceAgreement->consent->participant_signature))
                            <img src="{{ $serviceAgreement->consent->participant_signature }}" alt="Signature" class="signature-img">
                        @else -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ formatDate($serviceAgreement->consent->participant_date) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Witness Table --}}
    <div class="table-container">
        <table class="consent-table">
            <thead>
                <tr>
                    <th colspan="2" class="table-header">Written Participant Consent</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $serviceAgreement->consent->witness_name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Signature</th>
                    <td>
                        @if(!empty($serviceAgreement->consent->witness_signature))
                            <img src="{{ $serviceAgreement->consent->witness_signature }}" alt="Signature" class="signature-img">
                        @else -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ formatDate($serviceAgreement->consent->witness_date) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- Verbal Participant Consent --}}
<div class="consent-section">
    <div class="consent-title">Verbal Participant Consent</div>
    <div class="consent-text">
        Verbal consent should only be used where it is not practicable to obtain written consent. I have discussed the proposed Service Agreement with the Participant or authorised representative, and I am satisfied that they understand the proposed Service Agreement and Schedule.
    </div>

    <div class="table-container">
        <table class="consent-table">
            <thead>
                <tr>
                    <th colspan="2" class="table-header">Verbal Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Staff Name</th>
                    <td>{{ $serviceAgreement->consent->verbal_staff_name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Staff Position</th>
                    <td>{{ $serviceAgreement->consent->verbal_staff_position ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Signature</th>
                    <td>
                        @if(!empty($serviceAgreement->consent->verbal_staff_signature))
                            <img src="{{ $serviceAgreement->consent->verbal_staff_signature }}" alt="Signature" class="signature-img">
                        @else -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ formatDate($serviceAgreement->consent->verbal_date) }}</td>
                </tr>
                <tr>
                    <th>Other Notes</th>
                    <td>{{ $serviceAgreement->consent->other_notes ?? 'Enter additional notes' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="page-break-before: always;"></div>

{{-- Office Use Only --}}
<div class="office-use-section">


    <p><strong>SA-01b Schedule of Supports– Attached</strong></p>
    <p>Please also note, our schedule of fees is subject to change by direction of the National Disability Insurance Scheme.</p>

    <div class="table-container">
        <table class="consent-table">
            <thead>
                <tr>
                    <th colspan="2" class="table-header">SA-01b Schedule of Supports– Attached</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Did the Participant receive a signed copy of the Service Agreement?</th>
                    <td>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($serviceAgreement->consent->received_signed_copy ?? '') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>If No and the Participant did not sign the Agreement, was it agreed to verbally?</th>
                    <td>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($serviceAgreement->consent->agreed_verbally ?? '') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>If agreed verbally, please confirm you have entered detailed comments into Client Management Systems (CMS) to reflect this?</th>
                    <td>
                        <div class="enum-field">
                            @foreach(['Yes', 'No'] as $option)
                                <span class="enum-option {{ ($serviceAgreement->consent->cms_comments_entered ?? '') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif
</div>
</body>
</html>



