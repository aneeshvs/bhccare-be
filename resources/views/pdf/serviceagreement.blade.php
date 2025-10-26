<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Service Agreement PDF</title>
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
        }
        th {
            background-color: #f9fafb;
            font-weight: bold;
            width: 30%;
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
    </div>

    {{-- Participant Details --}}
    <table>
        <tr><td colspan="2" class="section-title">Participant Details</td></tr>
        <tr><th>Name</th><td>{{ $serviceAgreement->participant_name ?? '-' }}</td></tr>
        <tr><th>NDIS Number</th><td>{{ $serviceAgreement->ndis_number ?? '-' }}</td></tr>
        <tr><th>Date of Birth</th><td>{{ formatDate($serviceAgreement->dob) }}</td></tr>
        <tr><th>Contact</th><td>{{ $serviceAgreement->contact ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $serviceAgreement->email ?? '-' }}</td></tr>
        <tr><th>Address</th><td>{{ $serviceAgreement->address ?? '-' }}</td></tr>
    </table>

    {{-- Plan Dates --}}
    <table>
        <tr><td colspan="2" class="section-title">NDIS Plan</td></tr>
        <tr><th>Start Date</th><td>{{ formatDate($serviceAgreement->ndis_plan_start_date) }}</td></tr>
        <tr><th>End Date</th><td>{{ formatDate($serviceAgreement->ndis_plan_end_date) }}</td></tr>
    </table>

    {{-- Service Agreement Term --}}
    <table>
        <tr><td colspan="2" class="section-title">Service Agreement Term</td></tr>
        <tr><th>Start Date</th><td>{{ formatDate($serviceAgreement->term_start_date) }}</td></tr>
        <tr><th>End Date</th><td>{{ formatDate($serviceAgreement->term_end_date) }}</td></tr>
        <tr><td colspan="2">{{ $serviceAgreement->area_of_support ?? '-' }}</td></tr>
    </table>

    {{-- Area of Support --}}
    <table>
        <tr><td colspan="2" class="section-title">Area of Support</td></tr>
        <tr><td colspan="2">{{ $serviceAgreement->area_of_support ?? '-' }}</td></tr>
    </table>

    {{-- Representative Details --}}
    <table>
        <tr><td colspan="2" class="section-title">Representative Details</td></tr>
        <tr><th>Name</th><td>{{ $serviceAgreement->representative_name ?? '-' }}</td></tr>
        <tr><th>Relationship</th><td>{{ $serviceAgreement->representative_relationship ?? '-' }}</td></tr>
        <tr><th>Contact</th><td>{{ $serviceAgreement->representative_contact ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $serviceAgreement->representative_email ?? '-' }}</td></tr>
    </table>

    {{-- Consent --}}
    @if($serviceAgreement->consent)
    <table>
        <tr><td colspan="2" class="section-title">Consent Details</td></tr>

        <tr><th>Accepted Name</th><td>{{ $serviceAgreement->consent->accepted_name ?? '-' }}</td></tr>
        <tr><th>Accepted Position</th><td>{{ $serviceAgreement->consent->accepted_position ?? '-' }}</td></tr>

        <tr>
            <th>Accepted Signature</th>
            <td>
                @if(!empty($serviceAgreement->consent->accepted_signature))
                    <img src="{{ $serviceAgreement->consent->accepted_signature }}" alt="Signature" style="max-width:150px;height:auto;">
                @else -
                @endif
            </td>
        </tr>

        <tr><th>Accepted Date</th><td>{{ formatDate($serviceAgreement->consent->accepted_date) }}</td></tr>

        <tr><th>Participant Name</th><td>{{ $serviceAgreement->consent->consents_participant_name ?? '-' }}</td></tr>
        <tr><th>Participant Role</th><td>{{ $serviceAgreement->consent->participant_role ?? '-' }}</td></tr>

        <tr>
            <th>Participant Signature</th>
            <td>
                @if(!empty($serviceAgreement->consent->participant_signature))
                    <img src="{{ $serviceAgreement->consent->participant_signature }}" alt="Signature" style="max-width:150px;height:auto;">
                @else -
                @endif
            </td>
        </tr>

        <tr><th>Participant Date</th><td>{{ formatDate($serviceAgreement->consent->participant_date) }}</td></tr>

        <tr><th>Witness Name</th><td>{{ $serviceAgreement->consent->witness_name ?? '-' }}</td></tr>

        <tr>
            <th>Witness Signature</th>
            <td>
                @if(!empty($serviceAgreement->consent->witness_signature))
                    <img src="{{ $serviceAgreement->consent->witness_signature }}" alt="Signature" style="max-width:150px;height:auto;">
                @else -
                @endif
            </td>
        </tr>

        <tr><th>Witness Date</th><td>{{ formatDate($serviceAgreement->consent->witness_date) }}</td></tr>

        <tr><th>Verbal Staff Name</th><td>{{ $serviceAgreement->consent->verbal_staff_name ?? '-' }}</td></tr>
        <tr><th>Verbal Staff Position</th><td>{{ $serviceAgreement->consent->verbal_staff_position ?? '-' }}</td></tr>

        <tr>
            <th>Verbal Staff Signature</th>
            <td>
                @if(!empty($serviceAgreement->consent->verbal_staff_signature))
                    <img src="{{ $serviceAgreement->consent->verbal_staff_signature }}" alt="Signature" style="max-width:150px;height:auto;">
                @else -
                @endif
            </td>
        </tr>

        <tr><th>Verbal Date</th><td>{{ formatDate($serviceAgreement->consent->verbal_date) }}</td></tr>

    </table>
    @endif

</div>
</body>
</html>
