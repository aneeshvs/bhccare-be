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
            max-width: 70px;
            height: auto;
        }
        .header h2 {
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }

        .section-title {
            background-color: #f3f4f6;
            font-weight: bold;
            padding: 8px 12px;
            border-left: 4px solid #4f46e5;
            font-size: 13px;
            margin-top: 30px;
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }
        th, td {
            border: 1px solid #e5e7eb;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f9fafb;
            font-weight: bold;
            width: 30%;
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
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <h2>Confidential Information Form</h2>
    </div>

    @php
        function formatDate($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('d/m/Y') : '-';
        }
    @endphp

    <table>
        <tr><td colspan="2" class="section-title">Participant Information</td></tr>
        <tr><th>Full Name</th><td>{{ $form->participant_name ?? '-' }}</td></tr>
        <tr><th>Date of Birth</th><td>{{ formatDate($form->date_of_birth) }}</td></tr>
        <tr><th>Address</th><td>{{ $form->address ?? '-' }}</td></tr>
        <tr><th>Post Code</th><td>{{ $form->post_code ?? '-' }}</td></tr>
        <tr><th>Phone</th><td>{{ $form->phone ?? '-' }}</td></tr>
        <tr><th>Mobile Number</th><td>{{ $form->mobile_no ?? '-' }}</td></tr>
        <tr><th>Email Address</th><td>{{ $form->email ?? '-' }}</td></tr>
    </table>


    @if($form->agencies->count())
    <table>
        <tr><td colspan="2" class="section-title">Confidential Information Agencies</td></tr>

        @foreach($form->agencies as $agency)
            <tr><th>Name</th><td>{{ $agency->name ?? '-' }}</td></tr>
            <tr><th>Role / Position</th><td>{{ $agency->role ?? '-' }}</td></tr>
            <tr><th>Contact</th><td>{{ $agency->contact ?? '-' }}</td></tr>
            <tr><th>Agency Name</th><td>{{ $agency->agency_name ?? '-' }}</td></tr>
            <tr><th>Type of Service</th><td>{{ $agency->service_type ?? '-' }}</td></tr>
            <tr><th>Information Shared</th><td>{{ $agency->information_shared ?? '-' }}</td></tr>
        @endforeach
    </table>
    @endif


    @if($form->consent)
        <table>
            <tr><td colspan="2" class="section-title">Written Participant Consent</td></tr>

            <tr><th>Date</th><td>{{ formatDate($form->consent->signed_date) }}</td></tr>
            <tr><th>Signed By</th><td>{{ $form->consent->signed_by === 'participant' ? 'Participant' : 'Authorized Representative' }}</td></tr>
            <tr><th>Name</th><td>{{ $form->consent->name ?? '-' }}</td></tr>
            <tr><th>Witnessed By</th><td>{{ $form->consent->witnessed_by ?? '-' }}</td></tr>
        </table>
    @endif


    @if($form->verbal)
        <table>
            <tr><td colspan="2" class="section-title">Verbal Consent</td></tr>
            <tr>
                <th>Verbal Signature</th>
                <td>
                    @if(!empty($form->verbal->verbal_signature))
                        <img src="data:image/png;base64,{{ $form->verbal->verbal_signature }}" style="max-height: 80px;">
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr><th>Signed Date</th><td>{{ formatDate($form->verbal->verbal_signed_date) }}</td></tr>
            <tr><th>Name</th><td>{{ $form->verbal->verbal_name ?? '-' }}</td></tr>
            <tr><th>Position</th><td>{{ $form->verbal->position ?? '-' }}</td></tr>
        </table>
    @endif


    @if($form->preConsentDisclosure)
        <table>
            <tr><td colspan="2" class="section-title">Pre-Consent Disclosure Checklist</td></tr>
            <tr><th>Discussed referral to other services/agencies</th><td>{{ $form->preConsentDisclosure->discuss_referral_services ? 'Yes' : 'No' }}</td></tr>
            <tr><th>Explained release agreement and service provision</th><td>{{ $form->preConsentDisclosure->explain_release_agreement ? 'Yes' : 'No' }}</td></tr>
            <tr><th>Explained sharing without consent (health/safety/legal)</th><td>{{ $form->preConsentDisclosure->explain_share_without_consent ? 'Yes' : 'No' }}</td></tr>
            <tr><th>Provided privacy information if requested</th><td>{{ $form->preConsentDisclosure->provide_privacy_information ? 'Yes' : 'No' }}</td></tr>
        </table>
    @endif

</div>
</body>
</html>
