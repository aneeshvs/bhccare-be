<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Service Agreement PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }
        .section-title {
            background-color: #f2f2f2;
            font-weight: bold;
            padding: 6px;
        }
    </style>
</head>
<body>
    <h2>Service Agreement</h2>

    {{-- Participant Details --}}
    <table>
        <tr><td colspan="2" class="section-title">Participant Details</td></tr>
        <tr><th>Name</th><td>{{ $serviceAgreement->participant_name ?? '-' }}</td></tr>
        <tr><th>NDIS Number</th><td>{{ $serviceAgreement->ndis_number ?? '-' }}</td></tr>
        <tr><th>Date of Birth</th><td>{{ $serviceAgreement->dob ?? '-' }}</td></tr>
        <tr><th>Contact</th><td>{{ $serviceAgreement->contact ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $serviceAgreement->email ?? '-' }}</td></tr>
        <tr><th>Address</th><td>{{ $serviceAgreement->address ?? '-' }}</td></tr>
    </table>

    {{-- Plan Dates --}}
    <table>
        <tr><td colspan="2" class="section-title">NDIS Plan</td></tr>
        <tr><th>Start Date</th><td>{{ $serviceAgreement->ndis_plan_start_date ?? '-' }}</td></tr>
        <tr><th>End Date</th><td>{{ $serviceAgreement->ndis_plan_end_date ?? '-' }}</td></tr>
    </table>

    <table>
        <tr><td colspan="2" class="section-title">Service Agreement Term</td></tr>
        <tr><th>Start Date</th><td>{{ $serviceAgreement->term_start_date ?? '-' }}</td></tr>
        <tr><th>End Date</th><td>{{ $serviceAgreement->term_end_date ?? '-' }}</td></tr>
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

    {{-- Staff Details (optional) --}}
    @if($serviceAgreement->staff)
    <table>
        <tr><td colspan="2" class="section-title">Staff Details</td></tr>
        <tr><th>Name</th><td>{{ $serviceAgreement->staff->name ?? '-' }}</td></tr>
        <tr><th>Type</th><td>{{ $serviceAgreement->staff->stafftype ?? '-' }}</td></tr>
    </table>
    @endif

</body>
</html>
