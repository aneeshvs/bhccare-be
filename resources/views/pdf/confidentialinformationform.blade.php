<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confidential Information Form</title>
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
    padding: 10px;
    background-color: #e0f2fe;
    font-size: 13px; /* increased font size */
}

.section-body ul li {
    margin-bottom: 10px;   /* spacing between each li */
    line-height: 1.4;     /* nicer readability */
}

.section {
    margin-bottom: 8px;
    border: 1px solid #000;
    page-break-inside: avoid;
}

.note-box {
    background-color: #f0f9ff;
    border: 1px solid #bae6fd;
    padding: 6px 8px;
    margin: 8px 0;
    font-size: 12px;
    line-height: 1.3;
}


        .three-column-table {
            width: 100%;
            border-collapse: collapse;
        }

        .three-column-table td {
            border: none;
            padding: 1px 3px;
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
            font-size: 11px;
        }

        .signature-image {
            max-height: 60px;
            border: 1px solid #000;
            padding: 4px;
            border-radius: 2px;
            background-color: #fff;
        }

        .agency-separator {
            background-color: #f3f4f6;
            height: 6px;
            border-left: 3px solid #9ca3af;
        }
    </style>
</head>
<body>
    <!-- Page Header -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-3 Consent to Exchange Release Confidential Information</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-3</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">



            <!-- Participant Details -->
            <div class="section page-start">
                <div class="section-header">1. PARTICIPANT DETAILS</div>
                <table>
                    <tr>
                        <td class="field-label">Full Name</td>
                        <td class="field-value">{{ $form->participant_name ?? 'N/A' }}</td>
                        <td class="field-label">Date of Birth</td>
                        <td class="field-value">
                            {{ $form->date_of_birth ? \Carbon\Carbon::parse($form->date_of_birth)->format('d/m/Y') : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Address</td>
                        <td class="field-value">{{ $form->address ?? 'N/A' }}</td>
                        <td class="field-label">Post Code</td>
                        <td class="field-value">{{ $form->post_code ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Phone</td>
                        <td class="field-value">{{ $form->phone ?? 'N/A' }}</td>
                        <td class="field-label">Mobile Number</td>
                        <td class="field-value">{{ $form->mobile_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Email Address</td>
                        <td class="field-value" colspan="3">{{ $form->email ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Privacy Statement -->
            <div class="section">
                <div class="section-body">
                   <div class="note-box">The organisation will comply with relevant privacy legislation and in the standards set for dealing with personal information outlined in our policy, practice guidelines and procedures. Please discuss the following statement with Participants before proceeding:</div>

               <ul>
                    <li>If your information is required by law, your information may be shared without your consent.</li>
                    <li>Information can include data that is held in audio/visual format being photos or any other recorded material.</li>
                    <li>This consent form includes your permission for BHC to provide care/treatment described in the Goal Plan or Support Plan.</li>
                    <li>This consent form includes your permission to conduct surveillance within the common areas of your SIL home. Surveillance does not occur in bedrooms or private spaces. The purpose of the surveillance is for participant and worker safety. This footage may be reviewed during an incident investigation. Video surveillance is stored for a period of 30 days unless the video footage is in relation to a complaint or incident in which the footage could be stored for up to 7 years.</li>
                    <li>If your information is required by law, your information may be shared without your consent.</li>
                    <li>Information can include data that is held in audio/visual format being photos or any other recorded material.</li>
                    <li>This consent form includes your permission for BHC to provide care/treatment described in the Goal Plan or Support Plan.</li>
                    <li>This consent form includes your permission to conduct surveillance within the common areas of your SIL home. Surveillance does not occur in bedrooms or private spaces. The purpose of the surveillance is for participant and worker safety. This footage may be reviewed during an incident investigation. Video surveillance is stored for a period of 30 days unless the video footage is in relation to a complaint or incident in which the footage could be stored for up to 7 years.</li>
                    <li>The organisation will only collect personal information, and details regarding my health, that is necessary for them to deliver a service to me.</li>
                    <li>The organisation will take all necessary steps to protect my right to privacy and confidentiality when collecting my personal information. All information collected will be handled and maintained in a secure environment.</li>
                    <li>I am aware that my personal information and details will be stored electronically.</li>
                    <li>I have the right to request to see my records and to request a correction if I believe the information is wrong.</li>
                    <li>I have identified below any other individuals/services which I give informed consent for the organisation to contact on my behalf.</li>
                    <li>I may cancel all or part of this agreement at any time, by advising the organization.</li>
                </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                 <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue:21 February 2025
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

    <!-- Header for Page 2 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Form F-3 Consent to Exchange Release Confidential Information</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-3</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Proposed Use and Disclosure -->
            <div class="section page-start">
                <div class="section-header">2.PROPOSED USE AND DISCLOSURE OF MY PERSONAL INFORMATION BETWEEN THE ORGANISATION AND AS LISTED BELOW:</div>
                <div class="section-body">
                    <p><strong>I understand that the following service(s) are recommended and relevant information about me may be forwarded to the agency(s) that provide these services, in order that I receive the best possible service, including external agencies (e.g. NDIS, DHHS, and Certification Body) and other service providers.</strong></p>
                </div>

                <table>
                    <tr>
                        <th style="width: 20%">Name</th>
                        <th style="width: 15%">Role / Position</th>
                        <th style="width: 15%">Contact</th>
                        <th style="width: 20%">Name of Agency</th>
                        <th style="width: 15%">Type of Service</th>
                        <th style="width: 15%">Type of Information (Including Limits as Applicable) </th>
                    </tr>

                    @if($form->agencies && $form->agencies->count() > 0)
                        @foreach($form->agencies as $index => $agency)
                            <tr>
                                <td class="field-value">{{ $agency->name ?? 'N/A' }}</td>
                                <td class="field-value">{{ $agency->role ?? 'N/A' }}</td>
                                <td class="field-value">{{ $agency->contact ?? 'N/A' }}</td>
                                <td class="field-value">{{ $agency->agency_name ?? 'N/A' }}</td>
                                <td class="field-value">{{ $agency->service_type ?? 'N/A' }}</td>
                                <td class="field-value">{{ $agency->information_shared ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="field-value empty-field" colspan="6">No agency data available</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 2 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                  <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue:21 February 2025
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
            <div class="header-title">Form F-3 Consent to Exchange Release Confidential Information</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-3</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Written Participant Consent -->
            <div class="section page-start">
                <div class="section-header">3. WRITTEN PARTICIPANT CONSENT</div>
                <div class="section-body">
                    <p><strong>Best of Homecare has discussed with me how and why certain information about me may need to be provided to other service providers. I understand the recommendations and I give my permission for the information to be shared as detailed above.</strong></p>
                </div>

                <table>
                    @if($form->consent)
                        <tr>
                            <td class="field-label">Date</td>
                            <td class="field-value">
                                {{ $form->consent->signed_date ? \Carbon\Carbon::parse($form->consent->signed_date)->format('d/m/Y') : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Signed By</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    @foreach(['participant' => 'Participant', 'authorized_rep' => 'Authorized Representative'] as $value => $label)
                                        <span class="enum-option {{ ($form->consent->signed_by ?? '') === $value ? 'selected' : '' }}">
                                            {{ $label }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Name</td>
                            <td class="field-value">{{ $form->consent->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="field-label">Witnessed By</td>
                            <td class="field-value">{{ $form->consent->witnessed_by ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="field-label">Participant Signature</td>
                            <td class="field-value">
                                @if(isset($signatureImage) && $signatureImage)
                                    <img src="{{ $signatureImage }}" class="signature-image" alt="Participant Signature">
                                @else
                                    <span class="empty-field">No signature available</span>
                                @endif
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td class="field-label">Date</td>
                            <td class="field-value empty-field">No consent data available</td>
                        </tr>
                        <tr>
                            <td class="field-label">Signed By</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    <span class="enum-option">Participant</span>
                                    <span class="enum-option">Authorized Representative</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Name</td>
                            <td class="field-value empty-field">No consent data available</td>
                        </tr>
                        <tr>
                            <td class="field-label">Witnessed By</td>
                            <td class="field-value empty-field">No consent data available</td>
                        </tr>
                        <tr>
                            <td class="field-label">Participant Signature</td>
                            <td class="field-value empty-field">No signature available</td>
                        </tr>
                    @endif
                </table>
            </div>

            <!-- Verbal Consent -->
            <div class="section">
                <div class="section-header">4. VERBAL CONSENT</div>
                <div class="section-body">
                    <p><strong>Verbal consent should only be used where it is not practicable to obtain written consent. I have discussed the proposed referrals with the Participant or authorised representative and I am satisfied that they understand the proposed uses and disclosures and have provided their informed consent to these.</strong></p>
                </div>

                <table>
                    @if($form->verbal)
                        <tr>
                            <td class="field-label">Verbal Signature</td>
                            <td class="field-value">
                                @if(!empty($form->verbal->verbal_signature))
                                    <img src="{{ $form->verbal->verbal_signature }}" class="signature-image" alt="Verbal Signature">
                                @else
                                    <span class="empty-field">No signature available</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Date Signed</td>
                            <td class="field-value">
                                {{ $form->verbal->verbal_signed_date ? \Carbon\Carbon::parse($form->verbal->verbal_signed_date)->format('d/m/Y') : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Name</td>
                            <td class="field-value">{{ $form->verbal->verbal_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="field-label">Position</td>
                            <td class="field-value">{{ $form->verbal->position ?? 'N/A' }}</td>
                        </tr>
                    @else
                        <tr>
                            <td class="field-label">Verbal Signature</td>
                            <td class="field-value empty-field">No verbal consent data available</td>
                        </tr>
                        <tr>
                            <td class="field-label">Date Signed</td>
                            <td class="field-value empty-field">No verbal consent data available</td>
                        </tr>
                        <tr>
                            <td class="field-label">Name</td>
                            <td class="field-value empty-field">No verbal consent data available</td>
                        </tr>
                        <tr>
                            <td class="field-label">Position</td>
                            <td class="field-value empty-field">No verbal consent data available</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 3 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                 <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue: 21 February 2025
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
            <div class="header-title">Form F-3 Consent to Exchange Release Confidential Information</div>
        </div>
        <div class="document-number-container">
            <div class="page-document-number">Document Number: Form F-3</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Pre-Consent Disclosure Checklist -->
            <div class="section page-start">
                <div class="section-header1">5. PRE-CONSENT DISCLOSURE CHECKLIST</div>
                <div class="section-body">
                    <p><strong>To ensure the participant can make an informed decision about consent to disclose their information, the organisation should complete these steps, (tick when completed).</strong></p>
                </div>

                <table>
                    <tr>
                        <th style="width: 70%">Question</th>
                        <th style="width: 30%">Response</th>
                    </tr>

                    @if($form->preConsentDisclosure)
                        <tr>
                            <td class="field-label">Discuss with the participant the proposed referral to other services/agencies</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    @foreach(['Yes', 'No'] as $option)
                                        <span class="enum-option {{ ($form->preConsentDisclosure->discuss_referral_services ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Explain that the participant's information will only be released if the participant has agreed and advise that services will still be provided even if the participant does not want information disclosed.</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    @foreach(['Yes', 'No'] as $option)
                                        <span class="enum-option {{ ($form->preConsentDisclosure->explain_release_agreement ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Explain that information will be shared without consent if there is a serious threat to the health or safety of person(s), to report illegal activity or is required under law.</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    @foreach(['Yes', 'No'] as $option)
                                        <span class="enum-option {{ ($form->preConsentDisclosure->explain_share_without_consent ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Provide the participant with information about privacy if requested.</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    @foreach(['Yes', 'No'] as $option)
                                        <span class="enum-option {{ ($form->preConsentDisclosure->provide_privacy_information ? 'Yes' : 'No') === $option ? 'selected' : '' }}">
                                            {{ $option }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td class="field-label">Discuss with the participant the proposed referral to other services/agencies</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    <span class="enum-option">Yes</span>
                                    <span class="enum-option">No</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Explain that the participant's information will only be released if the participant has agreed and advise that services will still be provided even if the participant does not want information disclosed.</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    <span class="enum-option">Yes</span>
                                    <span class="enum-option">No</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Explain that information will be shared without consent if there is a serious threat to the health or safety of person(s), to report illegal activity or is required under law.</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    <span class="enum-option">Yes</span>
                                    <span class="enum-option">No</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="field-label">Provide the participant with information about privacy if requested.</td>
                            <td class="field-value">
                                <div class="enum-field">
                                    <span class="enum-option">Yes</span>
                                    <span class="enum-option">No</span>
                                </div>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 4 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                 <td style="width: 33%">
                    Version No: 3.0<br>
                    Issue:21 February 2025
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
