
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Schedule of Supports - BHC</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            background-color: #f9fafb;
            color: #111827;
            margin: 0;
            padding: 20px;

            counter-reset: section;
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
            margin-top: 5px;
        }
        .document-number span {
            color: #4f46e5;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-header {
            counter-increment: section;
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 10px 15px;
            font-weight: bold;
            border-left: 4px solid #0284c7;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .section-header::before {
            content: counter(section) ". ";
            font-weight: bold;
            color: #0284c7;
            margin-right: 6px;
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
        .signature-table td {
            height: 80px;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #111827;
            width: 100%;
            display: inline-block;
            margin-top: 40px;
        }
        .text-center {
            text-align: center;
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

    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <div class="header-title">Schedule of Supports</div>
        <div class="document-number">Document Number: <span>SOS-{{ $schedule->id ?? 'N/A' }}</span></div>
    </div>

    <!-- Participant Details -->
    <div class="section">
    <div class="section-header">Schedule of Supports</div>
    <table>
        <tr>
            <td>
                <span class="label">Participant Name</span>
                <span class="value">{{ $schedule->participant_name ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Schedule Creation Date</span>
                <span class="value">
                    {{ $schedule->creation_date ? \Carbon\Carbon::parse($schedule->creation_date)->format('d/m/Y') : 'N/A' }}
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Service Agreement & Funding Review Date</span>
                <span class="value">
                    {{ $schedule->funding_review_date ? \Carbon\Carbon::parse($schedule->funding_review_date)->format('d/m/Y') : 'N/A' }}
                </span>
            </td>

        </tr>
    </table>
    <table>
            <tr>
                <td>
                    <span class="label">Support required on a Public Holiday</span>
                    <span class="value">
                        @if(isset($schedule->support_on_public_holiday))
                            {{ $schedule->support_on_public_holiday ? 'Yes' : 'No' }}
                        @else
                            N/A
                        @endif
                    </span>
                </td>
            </tr>
        </table>
        <p style="margin-top:10px; font-size: 11px; color:#374151;">
            <strong>Note:</strong> Shifts on a Public Holiday will incur a higher rate per hour and will be priced in the Schedule of Supports.
            This may impact on scope of support and lower the hours of support available.
        </p>
</div>







    <!-- Transport Section -->
    <div class="section">
    <div class="section-header">Funded Support</div>
    @if($schedule->transport)
    <table>
        <tr>
            <td><span class="label">Support Name</span><span class="value">{{ $schedule->transport->support_name ?? 'N/A' }}</span></td>
            <td><span class="label">Description</span><span class="value">{{ $schedule->transport->description ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Price</span><span class="value">{{ $schedule->transport->price ?? 'N/A' }}</span></td>
            <td>
                <span class="label">Payment Information</span>
                <div class="enum-field">
                    @foreach(['NDIA', 'Self-managed', 'Plan managed'] as $option)
                        <span class="enum-option {{ ($schedule->transport->payment_information ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td><span class="label">Invoicing Details</span><span class="value">{{ $schedule->transport->invoicing_details ?? 'N/A' }}</span></td>
            <td><span class="label">Delivery Details</span><span class="value">{{ $schedule->transport->delivery_details ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="label">Grand Total</span><span class="value">${{ $schedule->transport->grand_total ?? '0.00' }}</span></td>
        </tr>
    </table>
    @else
    <p>No transport details available.</p>
    @endif
</div>

    <!-- Unfunded Supports -->
    <div class="section">
    <div class="section-header">Unfunded Supports</div>
    @if($schedule->unfundedSupport)
    <table>
        <tr>
            <td><span class="label">Support Name</span><span class="value">{{ $schedule->unfundedSupport->unfunded_support_name ?? 'N/A' }}</span></td>
            <td><span class="label">Description</span><span class="value">{{ $schedule->unfundedSupport->unfunded_description ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td>
                <span class="label">Price Information</span>
                <div class="enum-field">
                    @foreach(['Free', 'Negotiated', 'Market rate', 'Sliding scale', 'Other'] as $option)
                        <span class="enum-option {{ ($schedule->unfundedSupport->unfunded_price_information ?? '') === $option ? 'selected' : '' }}">
                            {{ $option }}
                        </span>
                    @endforeach
                </div>
            </td>
            <td><span class="label">Delivery Details</span><span class="value">{{ $schedule->unfundedSupport->unfunded_delivery_details ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Price</span><span class="value">{{ $schedule->unfundedSupport->unfunded_price ?? 'N/A' }}</span></td>
            <td><span class="label">Grand Total</span><span class="value">${{ $schedule->unfundedSupport->unfunded_grand_total ?? '0.00' }}</span></td>
        </tr>
    </table>
    @else
    <p>No unfunded support details available.</p>
    @endif
</div>

<div style="page-break-before: always;"></div>

<div class="section">
    <div class="section-header">Agreement Section</div>

    <table>
        <tr><td colspan="2" class="section-title">Participant Agreement</td></tr>

        <tr>
            <th>Participant Name</th>
            <td>{{ $schedule->agreementSignature->agreement_participant_name ?? 'N/A' }}</td>
        </tr>

        <tr>
            <th style="text-align:left; width:35%; padding:8px;">Participant Signature</th>
            <td style="padding:8px;">
                @if(!empty($schedule->agreementSignature->participant_signature))
                    <img src="{{ $schedule->agreementSignature->participant_signature }}"
                         alt="Participant Signature"
                         style="max-height:70px; border:1px solid #ccc; padding:4px;">
                @else
                    -
                @endif
            </td>


        </tr>

        <tr>
            <th>Participant Date</th>
            <td>
                {{ isset($schedule->agreementSignature->participant_date)
                    ? \Carbon\Carbon::parse($schedule->agreementSignature->participant_date)->format('d/m/Y')
                    : 'N/A' }}
            </td>
        </tr>

        <tr><td colspan="2" class="section-title">Representative Agreement</td></tr>

        <tr>
            <th>Representative Name</th>
            <td>{{ $schedule->agreementSignature->representative_name ?? 'N/A' }}</td>
        </tr>

        <tr>
            <th>Representative Signature</th>
            <td>
                @if(!empty($schedule->agreementSignature->representative_signature))
                    <img src="{{ $schedule->agreementSignature->representative_signature }}"
                         alt="Representative Signature"
                        style="max-height:70px; border:1px solid #ccc; padding:4px;">
                @else
                    -
                @endif
            </td>
        </tr>

        <tr>
            <th>Representative Date</th>
            <td>
                {{ isset($schedule->agreementSignature->representative_date)
                    ? \Carbon\Carbon::parse($schedule->agreementSignature->representative_date)->format('d/m/Y')
                    : 'N/A' }}
            </td>
        </tr>
    </table>
</div>





</div>
</body>
</html>

