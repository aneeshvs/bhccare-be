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
        <tr><td colspan="2" class="section-title" style="margin-top: 0;">1. Confidential Information</td></tr>
        <tr><th>Full Name</th><td><span class="value">{{ $form->participant_name ?? 'N/A' }}</span></td></tr>
        <tr><th>Date of Birth</th><td><span class="value">{{ formatDate($form->date_of_birth) }}</span></td></tr>
        <tr><th>Address</th><td><span class="value">{{ $form->address ?? 'N/A' }}</span></td></tr>
        <tr><th>Post Code</th><td><span class="value">{{ $form->post_code ?? 'N/A' }}</span></td></tr>
        <tr><th>Phone</th><td><span class="value">{{ $form->phone ?? 'N/A' }}</span></td></tr>
        <tr><th>Mobile Number</th><td><span class="value">{{ $form->mobile_no ?? 'N/A' }}</span></td></tr>
        <tr><th>Email Address</th><td><span class="value">{{ $form->email ?? 'N/A' }}</span></td></tr>
    </table>

    <!-- Confidential Information Agencies -->
    <table>
        <tr><td colspan="2" class="section-title">2. Confidential Information Agencies</td></tr>
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
        <tr><td colspan="2" class="section-title">3. Confidential Consent</td></tr>
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

    <!-- Verbal Consent -->
    <table>
        <tr><td colspan="2" class="section-title">4. Verbal Consent</td></tr>
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
        @if($form->preConsentDisclosure)
            <tr>
                <th>Discussed referral to other services/agencies</th>
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
                <th>Explained release agreement and service provision</th>
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
                <th>Explained sharing without consent (health/safety/legal)</th>
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
                <th>Provided privacy information if requested</th>
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
                <th>Discussed referral to other services/agencies</th>
                <td>
                    <div class="enum-field">
                        <span class="enum-option">Yes</span>
                        <span class="enum-option">No</span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Explained release agreement and service provision</th>
                <td>
                    <div class="enum-field">
                        <span class="enum-option">Yes</span>
                        <span class="enum-option">No</span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Explained sharing without consent (health/safety/legal)</th>
                <td>
                    <div class="enum-field">
                        <span class="enum-option">Yes</span>
                        <span class="enum-option">No</span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Provided privacy information if requested</th>
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
