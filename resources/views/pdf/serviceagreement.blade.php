<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Agreement</title>
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
            text-align:start;
        }

        .section-header1 {

            color: #000;
            padding: 10px;
            font-weight: bold;
            font-size: 10px;
            border-bottom: 1px solid #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
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
            background-color: #F2F2F2;
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

        .page-start {
            padding-top: 5px;
        }

        .page-break-avoid {
            page-break-inside: avoid;
        }

        .page-break-before {
            page-break-before: always;
        }

        .note-box {
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
            padding: 6px 8px;
            margin: 8px 0;
            font-size: 9px;
            line-height: 1.3;
        }

        .clause {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .clause-title {
            font-weight: bold;
            margin-bottom: 4px;
            font-size: 10px;
            color: #000;
        }

        .clause-content {
            font-size: 12px;
            line-height: 1.5;
        }

        .provider-info {
            background-color: #F2F2F2;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #000;
        }

        .signature-img {
            max-height: 40px;
            border: 1px solid #ccc;
            padding: 2px;
            background-color: white;
        }

        .office-use {
            background-color: #f8f9fa;
            padding: 8px;

            margin-top: 15px;
        }

        .office-title {
            font-weight: bold;

            margin-bottom: 8px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <!-- Page Header -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SA-01 Service Agreement</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SA-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Participant & Representative Details -->
            <div class="section page-start">
                <div class="section-header">1. PARTICIPANT & REPRESENTATIVE DETAILS</div>
                <table>
                    <tr>
                        <td class="field-label">Participant Name</td>
                        <td class="field-value">{{ $serviceAgreement->participant_name ?? 'saharayaj' }}</td>
                        <td class="field-label">NDIS Number</td>
                        <td class="field-value">{{ $serviceAgreement->ndis_number ?? '12345678' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Address</td>
                        <td class="field-value">{{ $serviceAgreement->address ?? 'kottyaru' }}</td>
                        <td class="field-label">Contact</td>
                        <td class="field-value">{{ $serviceAgreement->contact ?? 'Enter contact number' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Email</td>
                        <td class="field-value">{{ $serviceAgreement->email ?? 'Enter email address' }}</td>
                        <td class="field-label">Date of Birth</td>
                        <td class="field-value">
                            @php
                                use Carbon\Carbon;
                                function formatDate($date) {
                                    return $date ? Carbon::parse($date)->format('d/m/Y') : '-';
                                }
                            @endphp
                            {{ formatDate($serviceAgreement->dob) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">NDIS Plan Start Date</td>
                        <td class="field-value">{{ formatDate($serviceAgreement->ndis_plan_start_date) }}</td>
                        <td class="field-label">NDIS Plan End Date</td>
                        <td class="field-value">{{ formatDate($serviceAgreement->ndis_plan_end_date) }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Term Start Date</td>
                        <td class="field-value">{{ formatDate($serviceAgreement->term_start_date) }}</td>
                        <td class="field-label">Term End Date</td>
                        <td class="field-value">{{ formatDate($serviceAgreement->term_end_date) }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Area of Support</td>
                        <td class="field-value" colspan="3">{{ $serviceAgreement->area_of_support ?? 'Enter areas of support' }}</td>
                    </tr>
                </table>

                <!-- Representative Details -->
                <div class="section-header" style="margin-top: 10px;">Representative Details</div>
                <table>
                    <tr>
                        <td class="field-label">Representative Name</td>
                        <td class="field-value">{{ $serviceAgreement->representative_name ?? 'Enter representative name' }}</td>
                        <td class="field-label">Relationship</td>
                        <td class="field-value">{{ $serviceAgreement->representative_relationship ?? 'Enter relationship' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Representative Contact</td>
                        <td class="field-value">{{ $serviceAgreement->representative_contact ?? 'Enter representative contact' }}</td>
                        <td class="field-label">Representative Email</td>
                        <td class="field-value">{{ $serviceAgreement->representative_email ?? 'Enter representative email' }}</td>
                    </tr>
                </table>
            </div>

            <!-- The Provider -->
            <div class="section">
                <div class="section-header1">The Provider</div>
                <div class="provider-info">
                    <table>
                        <tr>
                            <td class="field-label">Company Name</td>
                            <td class="field-value">Best of Homecare</td>
                            <td class="field-label">ABN</td>
                            <td class="field-value">63691624877</td>
                        </tr>
                        <tr>
                            <td class="field-label">Contact</td>
                            <td class="field-value">1300 513 309</td>
                            <td class="field-label">Email</td>
                            <td class="field-value">admin@bestofhomecare.com</td>
                        </tr>
                        <tr>
                            <td class="field-label">Address</td>
                            <td class="field-value" colspan="3">1/43 Rainier Crescent, Clyde North. VIC 3978</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 2<br>
                    Issue: 19 December 2024
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

    <!-- PAGE BREAK -->
    <div class="page-break"></div>

    <!-- Header for Page 2 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SA-01 Service Agreement</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SA-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Service Agreement Terms -->
            <div class="section page-start">
                <div class="section-header">Service Agreement Terms</div>

                <div class="clause">
                    <div class="clause-title">1. Purpose of this Agreement</div>
                    <div class="clause-content">
                        The purpose of this Agreement is to document the arrangement between and best of homecare. Any changes to the services and/or support listed in this Agreement will require prior authorisation from all parties. The parties agree that any changes to this Service Agreement requires a 14-day notice period. The notice must be in writing, signed and dated by all parties and a copy of the amendments must be provided to the Participant.
                    </div>
                </div>

                <div class="clause">
                    <div class="clause-title">2. Terms of Agreement</div>
                    <div class="clause-content">
                        The Agreement will start and end on dates specified on page 2 of this Agreement unless the Agreement is terminated earlier under Clause 12 - Termination. There will be a service review date completed every 12 months.
                    </div>
                </div>

                <div class="clause">
                    <div class="clause-title">3. Description of Services</div>
                    <div class="clause-content">
                        Best of Homecare offers a range of service types that can be used as a single service or as a combination of services and supports to suit the Participant. Best of Homecare provide a minimum of 2 hours per service under one service request. The Provider's details of services and costs are detailed in Schedule 1 - Service Fees.
                    </div>
                </div>

                <div class="clause">
                    <div class="clause-title">4. Billing Method</div>
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
                    <div class="clause-title">5. Payment</div>
                    <div class="clause-content">
                        The NDIS Service Provider will seek payment for their provision of supports and services after the Participant and/or their representative confirms satisfactory delivery, and/or fees pertinent to the Cancellation requirements. The Participant or their nominee manages the funding supports provided under this Service Agreement. After Providing supports and services, the NDIS Service Provider will send the Participant/Participant's Nominee an invoice for those supports and services for the Participant/Participant's Nominee to pay. The Participant/Participant's Nominee will pay the invoice by EFT or credit-card within 14 days. Non-payment of monies owed will result in the automatic termination of this Agreement.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer for Page 2 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 2<br>
                    Issue: 19 December 2024
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



    <!-- Header for Page 3 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SA-01 Service Agreement</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SA-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Service Agreement Terms Continued -->
            <div class="section page-start">
                <div class="section-header">Service Agreement Terms (Continued)</div>

                <div class="clause">
                    <div class="clause-title">6. Goods and Services Tax (GST)</div>
                    <div class="clause-content">
                        For the purposes of GST legislation, the Parties confirm that a supply of supports under this Agreement is a supply of one or more reasonable and necessary supports specified in the statement of supports, under subsection 33(2) of the National Disability Insurance scheme Act 2013 (Cth), in the Participant's NDIS Plan currently in effect under Section 37 of the National Disability Insurance scheme Act 2013 (Cth).
                    </div>
                </div>

                <div class="clause">
                    <div class="clause-title">7. Participant/Participant's Nominee Rights and Responsibilities</div>
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
                    <div class="clause-title">8. Provider Responsibilities</div>
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
            </div>
        </div>
    </div>

    <!-- Footer for Page 3 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 2<br>
                    Issue: 19 December 2024
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



    <!-- Header for Page 4 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SA-01 Service Agreement</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SA-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Service Agreement Terms Continued -->
            <div class="section page-start">
                <div class="section-header">Service Agreement Terms (Continued)</div>

                <div class="clause">
                    <div class="clause-title">9. Cancellation Policy</div>
                    <div class="clause-content">
                        If a Participant, or their Nominated Participant fails to provide reasonable notice (at least 7 days' notice) in advance, prior to the cancellation of a scheduled support/service, or agreed appointment, then the Provider will seek recompense by way of charging 100% of the fee foregone for that session.
                    </div>
                </div>

                <div class="clause">
                    <div class="clause-title">10. Additional NDIS Expenses</div>
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
                    <div class="clause-title">11. Emergency and Disaster Management</div>
                    <div class="clause-content">
                        Best of Homecare will assess your reliance on the service provided to you during an emergency or natural disaster. Where it is determined that disruption to your service would impact your health and wellbeing, we will develop an emergency and disaster plan to ensure continued service provision.
                    </div>
                </div>

                <div class="clause">
                    <div class="clause-title">12. Termination</div>
                    <div class="clause-content">
                        Should either Party wishes to end this Agreement they must give 1 months' notice, without cause. If either party is in breach of this Agreement, the party in breach will remedy the breach within thirty (30) days of that party receiving written notice requiring it to fix the breach. 100% of rostered supports will be claimed if appropriate notice is not provided. If notice has been given and the breach is not satisfactorily remedied within thirty (30) days, the party who gave the notice may immediately terminate this Agreement by giving written notice. Note: In some instances, support may be withdrawn for valid reasons, however access to supports required by the participant will not be withdrawn or denied solely on the basis of a dignity of risk choice that has been made by the participant.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer for Page 4 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 2<br>
                    Issue: 19 December 2024
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



    <!-- Header for Page 5 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SA-01 Service Agreement</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SA-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Service Agreement Terms Continued -->
            <div class="section page-start">
                <div class="section-header">Service Agreement Terms (Continued)</div>

                <div class="clause">
                    <div class="clause-title">13. Feedback, Complaints and Disputes</div>
                    <div class="clause-content">
                        The Provider recognises that Participants/Participants Nominee and their carers have a right to provide feedback to our staff, management and Board of Directors to raise suggestions, resolve grievances and commend good performance and encourages all Participants to speak up when they are not happy. Any individual, stakeholder or agency wishing to lodge a complaint against the organisation's services, management or staff will be provided with information regarding the organisation's Feedback, Compliments and Complaints Policy and Process and contact our office via our participant handbook. Complaints and feedback can be lodged using the Compliments, complaints and feedback form and/or contacting Senior Management at our office. Any complaint will be heard respectfully and a willingness to assist complainant. If you wish to direct your complaint externally, you can contact the NDIS Quality and Safeguards Commission on 1800 035 544 or seek independent assistance through an advocate.
                    </div>
                </div>

                <div class="clause">
                    <div class="clause-title">14. Advocacy</div>
                    <div class="clause-content">
                        The Participant has a right to be represented by an advocate at any time and we encourage the use of advocates during the assessment and planning process. Advocates can be a family member, friend, medical practitioner or from an advocacy body. The Provider staff can assist you to access the services of an advocacy body. Please see the Advocacy Services List available on the Office of Public Advocate website www.disabilityadvocacyfinder.dss.gov.au/disability/ndap/
                    </div>
                </div>

                <div class="clause">
                    <div class="clause-title">15. Day Program Services Only</div>
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
                    <div class="clause-title">16. SIL/SDA Service Provision</div>
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
            </div>
        </div>
    </div>

    <!-- Footer for Page 5 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
               <td style="width: 33%">
                    Version No: 2<br>
                    Issue: 19 December 2024
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



    <!-- Header for Page 6 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">SA-01 Service Agreement</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: SA-01</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Service Agreement Section -->
            @if($serviceAgreement->consent)
            <div class="section page-start">
                <div class="section-header">2. SERVICE AGREEMENT</div>

                <!-- Written Participant Consent -->
                <div class="section-header1">Written Participant Consent</div>
                <div class="note-box">
                    Participant's Signature confirming the support arrangement and service agreement with Best of Homecare: I, understand, accept, and agree to the information outlined in this Agreement and Schedule.
                </div>

                <!-- Organization Representative -->
                <table>
                    <tr>
                        <th colspan="4">Accepted By (Organization Representative)</th>
                    </tr>
                    <tr>
                        <td class="field-label">Name</td>
                        <td class="field-value">{{ $serviceAgreement->consent->accepted_name ?? '-' }}</td>
                        <td class="field-label">Position</td>
                        <td class="field-value">{{ $serviceAgreement->consent->accepted_position ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Signature</td>
                        <td class="field-value" colspan="3">
                            @if(!empty($serviceAgreement->consent->accepted_signature))
                                <img src="{{ $serviceAgreement->consent->accepted_signature }}" alt="Signature" class="signature-img">
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Date</td>
                        <td class="field-value" colspan="3">{{ formatDate($serviceAgreement->consent->accepted_date) }}</td>
                    </tr>
                </table>

                <!-- Participant -->
                <table style="margin-top: 10px;">
                    <tr>
                        <th colspan="4">Agreement accepted and signed on behalf of Best of Homecare</th>
                    </tr>
                    <tr>
                        <td class="field-label">Name</td>
                        <td class="field-value">{{ $serviceAgreement->consent->consents_participant_name ?? '-' }}</td>
                        <td class="field-label">Position</td>
                        <td class="field-value">
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
                        <td class="field-label">Signature</td>
                        <td class="field-value" colspan="3">
                            @if(!empty($serviceAgreement->consent->participant_signature))
                                <img src="{{ $serviceAgreement->consent->participant_signature }}" alt="Signature" class="signature-img">
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Date</td>
                        <td class="field-value" colspan="3">{{ formatDate($serviceAgreement->consent->participant_date) }}</td>
                    </tr>
                </table>

                <!-- Witness -->
                <table style="margin-top: 10px;">
                    <tr>
                        <th colspan="4">Written Participant Consent</th>
                    </tr>
                    <tr>
                        <td class="field-label">Name</td>
                        <td class="field-value">{{ $serviceAgreement->consent->witness_name ?? '-' }}</td>
                        <td class="field-label">Signature</td>
                        <td class="field-value">
                            @if(!empty($serviceAgreement->consent->witness_signature))
                                <img src="{{ $serviceAgreement->consent->witness_signature }}" alt="Signature" class="signature-img">
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Date</td>
                        <td class="field-value" colspan="3">{{ formatDate($serviceAgreement->consent->witness_date) }}</td>
                    </tr>
                </table>

                <!-- Verbal Participant Consent -->
                <div class="section-header1" style="margin-top: 15px;">Verbal Participant Consent</div>
                <div class="note-box">
                    Verbal consent should only be used where it is not practicable to obtain written consent. I have discussed the proposed Service Agreement with the Participant or authorised representative, and I am satisfied that they understand the proposed Service Agreement and Schedule.
                </div>

                <table>
                    <tr>
                        <th colspan="4">Verbal Details</th>
                    </tr>
                    <tr>
                        <td class="field-label">Staff Name</td>
                        <td class="field-value">{{ $serviceAgreement->consent->verbal_staff_name ?? '-' }}</td>
                        <td class="field-label">Staff Position</td>
                        <td class="field-value">{{ $serviceAgreement->consent->verbal_staff_position ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Signature</td>
                        <td class="field-value" colspan="3">
                            @if(!empty($serviceAgreement->consent->verbal_staff_signature))
                                <img src="{{ $serviceAgreement->consent->verbal_staff_signature }}" alt="Signature" class="signature-img">
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Date</td>
                        <td class="field-value" colspan="3">{{ formatDate($serviceAgreement->consent->verbal_date) }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Other Notes</td>
                        <td class="field-value" colspan="3">{{ $serviceAgreement->consent->other_notes ?? 'Enter additional notes' }}</td>
                    </tr>
                </table>
                 <div class="page-break"></div>
                <!-- Office Use Only -->
                <div class="office-use">

                    <p><strong>SA-01b Schedule of Supports– Attached</strong></p>
                    <p>Please also note, our schedule of fees is subject to change by direction of the National Disability Insurance Scheme.</p>

                    <table>
                        <tr>
                            <td class="field-label">Did the Participant receive a signed copy of the Service Agreement?</td>
                            <td class="field-value">
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
                            <td class="field-label">If No and the Participant did not sign the Agreement, was it agreed to verbally?</td>
                            <td class="field-value">
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
                            <td class="field-label">If agreed verbally, please confirm you have entered detailed comments into Client Management Systems (CMS) to reflect this?</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    @foreach(['Yes', 'No'] as $option)
                                        <span class="enum-option {{ ($serviceAgreement->consent->cms_comments_entered ?? '') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Footer for Page 6 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 2<br>
                    Issue: 19 December 2024
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
</body>
</html>
