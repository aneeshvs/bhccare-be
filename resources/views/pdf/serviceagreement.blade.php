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

            background-color: #e0f2fe;
            color: #0369a1;
            padding: 10px 15px;
            font-weight: bold;
            border-left: 4px solid #0284c7;
            margin-bottom: 10px;
            border-radius: 4px;

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

        .enum-field {
    display: flex;
    gap: 10px;
    margin-top: 4px;
}

.enum-option {
    padding: 3px 6px;
    border: 1px solid #d1d5db;
    border-radius: 3px;
    background-color: #f9fafb;
    color: #374151;
    font-size: 11px;
    font-weight: 500;
    word-break: break-word;
    max-width: 200px;
}

.enum-option.selected {
    background-color: #0284c7;
    color: #ffffff;
    border-color: #0369a1;
    font-weight: bold;
}

.section-title {
    background-color: #e0f2fe;
    color: #0369a1;
    padding: 8px 12px;
    font-weight: bold;
    border-left: 4px solid #0284c7;
    margin-bottom: 8px;
    border-radius: 4px;
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
        <tr><td colspan="2" class="section-title">1.Participant Details</td></tr>
        <tr><th>Name</th><td>{{ $serviceAgreement->participant_name ?? '-' }}</td></tr>
        <tr><th>NDIS Number</th><td>{{ $serviceAgreement->ndis_number ?? '-' }}</td></tr>
        <tr><th>Date of Birth</th><td>{{ formatDate($serviceAgreement->dob) }}</td></tr>
        <tr><th>Contact</th><td>{{ $serviceAgreement->contact ?? '-' }}</td></tr>
        <tr><th>Email</th><td>{{ $serviceAgreement->email ?? '-' }}</td></tr>
        <tr><th>Address</th><td>{{ $serviceAgreement->address ?? '-' }}</td></tr>


        <tr><th>NDIS Start Date</th><td>{{ formatDate($serviceAgreement->ndis_plan_start_date) }}</td></tr>
        <tr><th>NDIS End Date</th><td>{{ formatDate($serviceAgreement->ndis_plan_end_date) }}</td></tr>


        <tr><th>Agreement Term Start Date</th><td>{{ formatDate($serviceAgreement->term_start_date) }}</td></tr>
        <tr><th>Agreement Term End Date</th><td>{{ formatDate($serviceAgreement->term_end_date) }}</td></tr>
        <tr><th>Area of Support</th><td colspan="2">{{ $serviceAgreement->area_of_support ?? '-' }}</td></tr>




        <tr><th>Representative Name</th><td>{{ $serviceAgreement->representative_name ?? '-' }}</td></tr>
        <tr><th>Representative Relationship</th><td>{{ $serviceAgreement->representative_relationship ?? '-' }}</td></tr>
        <tr><th>Representative Contact</th><td>{{ $serviceAgreement->representative_contact ?? '-' }}</td></tr>
        <tr><th>Representative Email</th><td>{{ $serviceAgreement->representative_email ?? '-' }}</td></tr>
    </table>

    {{-- Consent --}}
    @if($serviceAgreement->consent)
    <table>
        <tr><td colspan="2" class="section-title">2. Service Agreement</td></tr>

        <tr><th>Accepted Name</th><td>{{ $serviceAgreement->consent->accepted_name ?? '-' }}</td></tr>
        <tr><th>Accepted Position</th><td>{{ $serviceAgreement->consent->accepted_position ?? '-' }}</td></tr>

        <tr>
            <th style="text-align:left; width:35%; padding:8px;">Acceptance Signature</th>
            <td style="padding:8px;">
                @if(!empty($serviceAgreement->consent->accepted_signature))
                    <img src="{{ $serviceAgreement->consent->accepted_signature }}" alt="Signature"  style="max-height:70px; border:1px solid #ccc; padding:4px;">
                @else -
                @endif
            </td>
        </tr>

        <tr><th>Accepted Date</th><td>{{ formatDate($serviceAgreement->consent->accepted_date) }}</td></tr>

        <tr><th>Participant Name</th><td>{{ $serviceAgreement->consent->consents_participant_name ?? '-' }}</td></tr>

        <tr>
            <th>Participant Role</th>
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
            <th style="text-align:left; width:35%; padding:8px;">Participant Signature</th>
            <td style="padding:8px;">
                @if(!empty($serviceAgreement->consent->participant_signature))
                    <img src="{{ $serviceAgreement->consent->participant_signature }}" alt="Signature" style="max-height:70px; border:1px solid #ccc; padding:4px;">
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
                    <img src="{{ $serviceAgreement->consent->witness_signature }}" alt="Signature" style="max-height:70px; border:1px solid #ccc; padding:4px;">
                @else -
                @endif
            </td>
        </tr>

        <tr><th>Witness Date</th><td>{{ formatDate($serviceAgreement->consent->witness_date) }}</td></tr>

        <tr><th>Verbal Staff Name</th><td>{{ $serviceAgreement->consent->verbal_staff_name ?? '-' }}</td></tr>
        <tr><th>Verbal Staff Position</th><td>{{ $serviceAgreement->consent->verbal_staff_position ?? '-' }}</td></tr>

        <tr>
            <th style="text-align:left; width:35%; padding:8px;">Verbal Signature</th>
            <td style="padding:8px;">
                @if(!empty($serviceAgreement->consent->verbal_staff_signature))
                    <img src="{{ $serviceAgreement->consent->verbal_staff_signature }}" alt="Signature" style="max-height:70px; border:1px solid #ccc; padding:4px;">
                @else -
                @endif
            </td>
        </tr>

        <tr><th>Verbal Date</th><td>{{ formatDate($serviceAgreement->consent->verbal_date) }}</td></tr>

        <!-- Office Use Only Section with Checkbox Style -->
        <tr>
            <th colspan="2" class="section-title" style="padding-top: 20px;">Office Use Only</th>
        </tr>

        <tr>
            <th>Received Signed Copy</th>
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
            <th>Agreed Verbally</th>
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
            <th>CMS Comments Entered</th>
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

    </table>
@endif
</div>
</body>
</html>
