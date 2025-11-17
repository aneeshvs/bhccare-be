<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confidential Information Form</title>
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
            padding: 30px 40px;
        }

        .header {
            position: relative;
            text-align: center;
            margin-bottom: 40px;
            padding-top: 10px;
        }
        .logo {
            position: absolute;
            top: 0;
            left: 0;
            max-width: 70px;
            height: auto;
        }
        .header h2 {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
            margin: 0;
            padding-top: 10px;
        }

        .section-title {
            background-color: #e0f2fe;
            color: #0369a1;
            font-weight: bold;
            padding: 12px 18px;
            border-left: 4px solid #0284c7;
            font-size: 14px;
            margin-top: 35px;
            margin-bottom: 15px;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f8fafc;
            font-weight: 600;
            width: 30%;
            color: #374151;
            font-size: 12px;
        }
        td {
            background-color: white;
            font-size: 12px;
        }

        .value {
            color: #6b7280;
            line-height: 1.4;
        }

        .empty-field {
            color: #9ca3af;
            font-style: italic;
        }

        .page-break {
            page-break-before: always;
            break-before: page;
        }

        .enum-field {
            display: flex;
            gap: 12px;
            margin-top: 6px;
        }

        .enum-option {
            padding: 4px 8px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            background-color: #f9fafb;
            color: #374151;
            font-size: 11px;
            font-weight: 500;
            min-width: 60px;
            text-align: center;
        }

        .enum-option.selected {
            background-color: #0284c7;
            color: #ffffff;
            border-color: #0369a1;
            font-weight: bold;
        }

        .agency-separator {
            background-color: #f3f4f6;
            height: 8px;
            border-left: 3px solid #9ca3af;
        }

        .signature-image {
            max-height: 80px;
            border: 1px solid #d1d5db;
            padding: 6px;
            border-radius: 4px;
            background-color: #f9fafb;
        }

         .note-box {
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 6px;
            padding: 12px 15px;
            margin: 15px 0;
            font-size: 11px;
            line-height: 1.4;
        }
        .note-box strong {
            color: #0369a1;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <h2>Confidential Information Form</h2>
    </div>

    @php
        function formatDate($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('d/m/Y') : 'N/A';
        }
    @endphp

   


    <!-- Participant Information -->
<table>


    <!-- Section Title -->
    <tr>
        <td colspan="2" class="section-title" style="margin-top: 0;">1. Confidential Information(PARTICIPANT DETAILS)</td>
    </tr>

    <tr><th>Full Name</th><td><span class="value">{{ $form->participant_name ?? 'N/A' }}</span></td></tr>
    <tr><th>Date of Birth</th><td><span class="value">{{ formatDate($form->date_of_birth) }}</span></td></tr>
    <tr><th>Address</th><td><span class="value">{{ $form->address ?? 'N/A' }}</span></td></tr>
    <tr><th>Post Code</th><td><span class="value">{{ $form->post_code ?? 'N/A' }}</span></td></tr>
    <tr><th>Phone</th><td><span class="value">{{ $form->phone ?? 'N/A' }}</span></td></tr>
    <tr><th>Mobile Number</th><td><span class="value">{{ $form->mobile_no ?? 'N/A' }}</span></td></tr>
    <tr><th>Email Address</th><td><span class="value">{{ $form->email ?? 'N/A' }}</span></td></tr>

    <!-- Notes Section Header -->
    <tr>
        <td colspan="2" style="padding-top: 15px;">
            <strong>The organisation will comply with relevant privacy legislation and in the standards set for dealing with personal information outlined in our policy, practice guidelines and procedures
Please discuss the following statement with Participants before proceeding:
</strong>
        </td>
    </tr>

    <tr>
    <td colspan="2">
        <ul style="margin: 0; padding-left: 18px;">
            <li>If your information is required by law, your information may be shared without your consent.</li>
            <li>Information can include data held in audio/visual format such as photos or other recorded material.</li>
            <li>This consent form includes your permission for BHC to provide care/treatment described in the Goal Plan or Support Plan.</li>
            <li>This consent form includes permission to conduct surveillance only in common areas (not bedrooms). Surveillance is used for participant and worker safety.</li>
            <li>Surveillance footage is stored for 30 days, or up to 7 years if related to an incident or complaint.</li>
            <li>The organisation will only collect personal and health information necessary to deliver services.</li>
             <li>The organisation will take all necessary steps to protect my right to privacy and confidentiality when collecting my personal information. All information collected will be handled and maintained in a secure environment.</li>
            <li>I am aware that my personal information and details will be stored electronically.</li>
            <li>I have the right to request to see my records and to request a correction if I believe the information is wrong.</li>
            <li>I have identified below any other individuals/services which I give informed consent for the organisation to contact on my behalf.</li>
            <li>I may cancel all or part of this agreement at any time, by advising the organisation.</li>
        </ul>
        </ul>
    </td>
</tr>

</table>
<div style="page-break-before: always;"></div>


    <!-- Confidential Information Agencies -->
    <table>
<tr><td colspan="2" class="section-title">2.Confidential Information Agencies( PROPOSED USE AND DISCLOSURE OF MY PERSONAL INFORMATION BETWEEN THE ORGANISATION AND AS LISTED BELOW:)</td></tr>

    <tr>
        <td colspan="2" style="padding-top: 15px;">
            <strong>I understand that the following service(s) are recommended and relevant information about me may be forwarded to the agency(s) that provide these services, in order that I receive the best possible service, including external agencies (e.g. NDIS, DHHS, and Certification Body) and other service providers.

</strong>
        </td>
    </tr>

        @if($form->agencies && $form->agencies->count() > 0)
            @foreach($form->agencies as $index => $agency)
                @if($index > 0)
                    <tr><td colspan="2" class="agency-separator"></td></tr>
                @endif
                <tr><th>Name</th><td><span class="value">{{ $agency->name ?? 'N/A' }}</span></td></tr>
                <tr><th>Role / Position</th><td><span class="value">{{ $agency->role ?? 'N/A' }}</span></td></tr>
                <tr><th>Contact</th><td><span class="value">{{ $agency->contact ?? 'N/A' }}</span></td></tr>
                <tr><th>Agency Name</th><td><span class="value">{{ $agency->agency_name ?? 'N/A' }}</span></td></tr>
                <tr><th>Type of Service</th><td><span class="value">{{ $agency->service_type ?? 'N/A' }}</span></td></tr>
                <tr><th>Information Shared</th><td><span class="value">{{ $agency->information_shared ?? 'N/A' }}</span></td></tr>
            @endforeach
        @else
            <tr><th>Name</th><td><span class="value empty-field">No agency data available</span></td></tr>
            <tr><th>Role / Position</th><td><span class="value empty-field">No agency data available</span></td></tr>
            <tr><th>Contact</th><td><span class="value empty-field">No agency data available</span></td></tr>
            <tr><th>Agency Name</th><td><span class="value empty-field">No agency data available</span></td></tr>
            <tr><th>Type of Service</th><td><span class="value empty-field">No agency data available</span></td></tr>
            <tr><th>Information Shared</th><td><span class="value empty-field">No agency data available</span></td></tr>
        @endif
    </table>

    <!-- Written Participant Consent -->
    <table>

        <tr><td colspan="2" class="section-title">3. Written Participant Consent</td></tr>
        <tr>
        <td colspan="2" style="padding-top: 15px;">
    <strong>Best of Homecare has discussed with me how and why certain information about me may need to be provided to other service providers. I understand the recommendations and I give my permission for the information to be shared as detailed above.

</strong>
        </td>
    </tr>
        @if($form->consent)
            <tr><th>Date</th><td><span class="value">{{ formatDate($form->consent->signed_date) }}</span></td></tr>
            <tr>
                <th>Signed By</th>
                <td>
                    <div class="enum-field">
                        @foreach(['participant' => 'Participant', 'authorized_rep' => 'Authorized Representative'] as $value => $label)
                            <span class="enum-option {{ ($form->consent->signed_by ?? '') === $value ? 'selected' : '' }}">
                                {{ $label }}
                            </span>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr><th>Name</th><td><span class="value">{{ $form->consent->name ?? 'N/A' }}</span></td></tr>
            <tr><th>Witnessed By</th><td><span class="value">{{ $form->consent->witnessed_by ?? 'N/A' }}</span></td></tr>
            <tr>
                <th>Participant Signature</th>
                <td>
                    @if(isset($signatureImage) && $signatureImage)
                        <img src="{{ $signatureImage }}" class="signature-image" alt="Participant Signature">
                    @else
                        <span class="value empty-field">No signature available</span>
                    @endif
                </td>
            </tr>
        @else
            <tr><th>Date</th><td><span class="value empty-field">No consent data available</span></td></tr>
            <tr>
                <th>Signed By</th>
                <td>
                    <div class="enum-field">
                        <span class="enum-option">Participant</span>
                        <span class="enum-option">Authorized Representative</span>
                    </div>
                </td>
            </tr>
            <tr><th>Name</th><td><span class="value empty-field">No consent data available</span></td></tr>
            <tr><th>Witnessed By</th><td><span class="value empty-field">No consent data available</span></td></tr>
            <tr><th>Participant Signature</th><td><span class="value empty-field">No signature available</span></td></tr>
        @endif
    </table>
<div style="page-break-before: always;"></div>

    <!-- Verbal Consent -->
    <table>
        <tr><td colspan="2" class="section-title">4. Verbal Consent</td></tr>
         <tr>
        <td colspan="2" style="padding-top: 15px;">
    <strong>        Verbal consent should only be used where it is not practicable to obtain written consent. I have discussed the proposed referrals with the Participant or authorised representative and I am satisfied that they understand the proposed uses and disclosures and have provided their informed consent to these.


</strong>
        </td>
    </tr>
        @if($form->verbal)
            <tr>
                <th>Verbal Signature</th>
                <td>
                    @if(!empty($form->verbal->verbal_signature))
                        <img src="{{ $form->verbal->verbal_signature }}" class="signature-image" alt="Verbal Signature">
                    @else
                        <span class="value empty-field">No signature available</span>
                    @endif
                </td>
            </tr>
            <tr><th>Date Signed</th><td><span class="value">{{ formatDate($form->verbal->verbal_signed_date) }}</span></td></tr>
            <tr><th>Name</th><td><span class="value">{{ $form->verbal->verbal_name ?? 'N/A' }}</span></td></tr>
            <tr><th>Position</th><td><span class="value">{{ $form->verbal->position ?? 'N/A' }}</span></td></tr>
        @else
            <tr><th>Verbal Signature</th><td><span class="value empty-field">No verbal consent data available</span></td></tr>
            <tr><th>Date Signed</th><td><span class="value empty-field">No verbal consent data available</span></td></tr>
            <tr><th>Name</th><td><span class="value empty-field">No verbal consent data available</span></td></tr>
            <tr><th>Position</th><td><span class="value empty-field">No verbal consent data available</span></td></tr>
        @endif
    </table>



    <!-- Pre-Consent Disclosure Checklist -->
    <table>
        <tr><td colspan="2" class="section-title">5. Pre-Consent Disclosure Checklist</td></tr>

         <tr>
        <td colspan="2" style="padding-top: 15px;">
            <strong>
        To ensure the participant can make an informed decision about consent to disclose their information, the organisation should complete these steps, (tick when completed).

</strong>
        </td>
    </tr>

        @if($form->preConsentDisclosure)
            <tr>
                <th>Discuss with the participant the proposed referral to other services/agencies</th>
                <td>
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
                <th>Explain that the participant’s information will only be released if the participant has agreed and advise that services will still be provided even if the participant does not want information disclosed.

</th>
                <td>
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
                <th>Explain that information will be shared without consent if there is a serious threat to the health or safety of person(s), to report illegal activity or is required under law.

</th>
                <td>
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
                <th>Provide the participant with information about privacy if requested.</th>
                <td>
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
                <th>Discuss with the participant the proposed referral to other services/agencies</th>
                <td>
                    <div class="enum-field">
                        <span class="enum-option">Yes</span>
                        <span class="enum-option">No</span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Explain that the participant’s information will only be released if the participant has agreed and advise that services will still be provided even if the participant does not want information disclosed.
                <td>
                    <div class="enum-field">
                        <span class="enum-option">Yes</span>
                        <span class="enum-option">No</span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Explain that information will be shared without consent if there is a serious threat to the health or safety of person(s), to report illegal activity or is required under law.
                <td>
                    <div class="enum-field">
                        <span class="enum-option">Yes</span>
                        <span class="enum-option">No</span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Provide the participant with information about privacy if requested.</th>
                <td>
                    <div class="enum-field">
                        <span class="enum-option">Yes</span>
                        <span class="enum-option">No</span>
                    </div>
                </td>
            </tr>
        @endif
    </table>

</div>
</body>
</html>
