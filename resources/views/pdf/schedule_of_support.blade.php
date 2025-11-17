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
            padding-top: 10px;
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
            color: #0369a1;
        }
        .document-number {
            font-size: 14px;
            font-weight: 600;
            margin-top: 5px;
            color: #4f46e5;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-header {
            counter-increment: section;
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 12px 15px;
            font-weight: bold;
            border-left: 4px solid #0284c7;
            margin-bottom: 15px;
            border-radius: 4px;
            font-size: 14px;
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
            margin-bottom: 15px;
        }
        th, td {
            padding: 8px 10px;
            vertical-align: top;
            border: 1px solid #e5e7eb;
        }
        th {
            background-color: #f8fafc;
            font-weight: 600;
            text-align: left;
        }
        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 4px;
            color: #374151;
        }
        .value {
            margin-top: 2px;
            color: #111827;
        }
        .enum-field {
            display: flex;
            gap: 10px;
            margin-top: 4px;
        }
        .enum-option {
            padding: 3px 8px;
            border: 1px solid #d1d5db;
            border-radius: 3px;
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
        .section-title {
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 10px 12px;
            font-weight: bold;
            border-left: 4px solid #0284c7;
            margin: 15px 0 8px 0;
            border-radius: 4px;
            font-size: 13px;
        }
        .sil-table {
            width: 100%;
            margin: 15px 0;
        }
        .sil-table th {
            background-color: #f0f9ff;
            color: #0369a1;
        }
        .total-row {
            background-color: #f8fafc;
            font-weight: bold;
        }
        .transport-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .transport-table th {
            background-color: #f0f9ff;
            color: #0369a1;
            text-align: center;
            padding: 10px;
        }
        .transport-table td {
            padding: 8px 10px;
            vertical-align: top;
            border: 1px solid #e5e7eb;
        }
        .transport-checkbox {
            text-align: center;
            width: 40px;
        }
        .support-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background-color: #fafbfc;
        }
        .support-header {
            margin: 0 0 10px 0;
            color: #0369a1;
            font-size: 13px;
            border-bottom: 2px solid #e0f2fe;
            padding-bottom: 5px;
        }
        .agreement-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .agreement-title {
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 8px 12px;
            font-weight: bold;
            margin: 10px 0;
            border-radius: 4px;
            font-size: 13px;
        }
        .signature-img {
            max-height: 70px;
            border: 1px solid #ccc;
            padding: 4px;
            background-color: white;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <div class="header-title">Service Agreement</div>
        <div class="document-number">Appendix B Schedule of Supports</div>
    </div>

    <!-- Schedule of Supports Section -->
    <div class="section">
        <div class="section-header">Schedule of Supports</div>
        <table>
            <tr>
                <td style="width: 50%">
                    <span class="label">Participant Name</span>
                    <span class="value">{{ $schedule->participant_name ?? 'N/A' }}</span>
                </td>
                <td style="width: 50%">
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

        <div class="note-box">
            <strong>Note:</strong> Shifts on a Public Holiday will incur a higher rate per hour and will be priced in the Schedule of Supports. This may impact on scope of support and lower the hours of support available.
        </div>
    </div>

    <!-- Transport Section -->
    <div class="section">
        <div>Transport</div>

        <table class="transport-table">

            <tbody>
                <tr>
                    <td class="transport-checkbox">[ ]</td>
                    <td>Fully funded for transport</td>
                    <td>Funding meets participant transport needs</td>
                    <td>Participant only uses KM funded for $________. This figure should be based on _____ cents per kilometre and does not include GST.</td>
                </tr>
                <tr>
                    <td class="transport-checkbox">[ ]</td>
                    <td>Partially funded for transport – converts support hours</td>
                    <td>Indicate core support $ to be converted. Funding does not meet transport needs. Participant converts support hours to pay for KM.</td>
                    <td>Conversion of core support funding into transport must not negatively impact goals and outcomes. Conversion of supports can only occur where participant has transport within their plan, and Core Daily Activity & Transport are managed by Best of Homecare.</td>
                </tr>
                <tr>
                    <td class="transport-checkbox">[ ]</td>
                    <td>Partially funded for transport – converts support hours</td>
                    <td>Indicate core support $ to be converted</td>
                    <td>*Funding does not meet transport needs. Participant converts support hours to pay for KM.<br>
                        *Conversion of core support funding into transport must not negatively impact goals and outcomes.<br>
                        *Conversion of supports can only occur where the participant has transport within their plan, and both the participant's Core Daily Activity and Transport are managed by Best of Homecare.</td>
                </tr>
                <tr>
                    <td class="transport-checkbox">[ ]</td>
                    <td>Not funded for transport within the NDIS funding plan</td>
                    <td>Participant is not funded for transport</td>
                    <td>Participant uses public transport or will be invoiced for KM at the rate of _____ cents per KM + GST</td>
                </tr>
                <tr>
                    <td class="transport-checkbox">[ ]</td>
                    <td>No transport costs</td>
                    <td>The participant has not authorised Best of Homecare to charge for transport costs</td>
                    <td>Participant uses public transport or does not require transport. Should transport be required, any costs will be negotiated with the participant in advance.</td>
                </tr>
            </tbody>
        </table>

        <div class="note-box">
            <strong>Note:</strong><br>
            Amounts will be listed in the funded and unfunded schedules.<br>
            Additional transport costs will be invoiced at _____ cents per KM directly to the participant or family monthly. GST will be added where transport costs exceed the amount approved in the funding plan or where there is no transport funding in the plan.<br>
            Transport may include the use of a staff member vehicle, Best of Homecare vehicle or via public transport.<br>
            Participant or family to cover any out-of-pocket public transport costs, if required.<br>
            Where a staff member travels from one participant appointment to another (providing personal care and community access), up to 20 minutes of time can be claimed against the next appointment at the hourly rate for the relevant support item. This will be discussed with you, if it is relevant to the services that you receive from Best of Homecare.
        </div>
    </div>

    <!-- Funded Supports Section -->
<div class="section">
    <div class="section-header">Schedule of Supports - Funded Supports</div>

    @php
        $fundedSupports = $schedule->transport ?? [];
        $fundedTotalPrice = 0;
    @endphp

    <table style="width:100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ccc;">
        <thead>
            <tr style="background-color: #f0f0f0; text-align: left;">
                <th style="padding: 8px; border: 1px solid #ccc;">#</th>
                <th style="padding: 8px; border: 1px solid #ccc;">Support</th>
                <th style="padding: 8px; border: 1px solid #ccc;">Description of Support</th>
                <th style="padding: 8px; border: 1px solid #ccc;">Price</th>
                <th style="padding: 8px; border: 1px solid #ccc;">Payment Information</th>
                <th style="padding: 8px; border: 1px solid #ccc;">Invoicing Details</th>
                <th style="padding: 8px; border: 1px solid #ccc;">How the Support will be provided</th>
            </tr>
        </thead>
        <tbody>
            @if(count($fundedSupports) === 0)
                <tr>
                    <td colspan="7" style="text-align: center; padding: 10px;">No funded supports available</td>
                </tr>
            @else
                @foreach($fundedSupports as $index => $fundedSupport)
                    @php
                        $fundedTotalPrice += floatval($fundedSupport->price ?? 0);
                    @endphp
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $index + 1 }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $fundedSupport->support_name ?? 'N/A' }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $fundedSupport->description ?? 'N/A' }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">${{ $fundedSupport->price ?? '0.00' }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">
                            <div class="enum-field">
                                @foreach(['NDIA', 'Self-managed', 'Plan managed'] as $option)
                                    <span class="enum-option {{ ($fundedSupport->payment_information ?? '') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $fundedSupport->invoicing_details ?? 'N/A' }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $fundedSupport->delivery_details ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr style="font-weight: bold; background-color: #f9f9f9;">
                <td colspan="3" style="padding: 8px; border: 1px solid #ccc;">Grand Total (all funded Supports)</td>
                <td colspan="4" style="padding: 8px; border: 1px solid #ccc;">${{ number_format($fundedTotalPrice, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="note-box" style="padding: 10px; background-color: #f0f0f0; border-radius: 4px;">
        <strong>Please note:</strong><br>
        • Participants being supported to engage in community/social or recreational activities within the community will be charged, where applicable, up to four hours over the plan period for documentation purposes.<br>
        • The schedule of supports can include staff member ‘shadow shifts’ (or buddy shifts) up to six hours of weekday support per year.<br>
        • Participants receiving core supports approve the flexible movement of funding between support types noted in the Schedule of Support to meet their needs.
    </div>
</div>





    <!-- Unfunded Supports Section -->
<div class="section">
    <div class="section-header">Schedule of Supports - Unfunded Supports</div>

    @php
        $unfundedSupports = $schedule->unfundedSupport ?? [];
        $unfundedTotalPrice = 0;
    @endphp

    <table style="width:100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #ccc;">
        <thead>
            <tr style="background-color: #f0f0f0; text-align: left;">
                <th style="padding: 8px; border: 1px solid #ccc;">#</th>
                <th style="padding: 8px; border: 1px solid #ccc;">Support</th>
                <th style="padding: 8px; border: 1px solid #ccc;">Description of Support</th>
                <th style="padding: 8px; border: 1px solid #ccc;">Price</th>
                <th style="padding: 8px; border: 1px solid #ccc;">Price Information</th>
                <th style="padding: 8px; border: 1px solid #ccc;">Delivery Details</th>
            </tr>
        </thead>
        <tbody>
            @if(count($unfundedSupports) === 0)
                <tr>
                    <td colspan="6" style="text-align: center; padding: 10px;">No unfunded supports available</td>
                </tr>
            @else
                @foreach($unfundedSupports as $index => $unfundedSupport)
                    @php
                        $unfundedTotalPrice += floatval($unfundedSupport->unfunded_price ?? 0);
                    @endphp
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $index + 1 }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $unfundedSupport->unfunded_support_name ?? 'N/A' }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $unfundedSupport->unfunded_description ?? 'N/A' }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">${{ $unfundedSupport->unfunded_price ?? '0.00' }}</td>
                        <td style="padding: 8px; border: 1px solid #ccc;">
                            <div class="enum-field">
                                @foreach(['Free', 'Negotiated', 'Market rate', 'Sliding scale', 'Other'] as $option)
                                    <span class="enum-option {{ ($unfundedSupport->unfunded_price_information ?? '') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td style="padding: 8px; border: 1px solid #ccc;">{{ $unfundedSupport->unfunded_delivery_details ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr style="font-weight: bold; background-color: #f9f9f9;">
                <td colspan="3" style="padding: 8px; border: 1px solid #ccc;">Grand Total (all unfunded Supports)</td>
                <td colspan="3" style="padding: 8px; border: 1px solid #ccc;">${{ number_format($unfundedTotalPrice, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="note-box" style="padding: 10px; background-color: #f0f0f0; border-radius: 4px;">
        <strong>Please note:</strong><br>
        • Payment for board and lodgings may go via PTO or Best of Homecare account only.<br>
        • Breakdown of board and lodging costs is available upon request.
    </div>
</div>





    <!-- SIL/SDA Accommodation Section -->
    <div class="section">
        <div>Supported Independent Living Accommodation - Fortnightly Participants Contribution (SIL/SDA Only)</div>

        <table class="sil-table">
            <tr>
                <th style="width: 60%">Description</th>
                <th style="width: 40%">Amount (Per Fortnight)</th>
            </tr>
            <tr>
                <td>Rent Charges (Rental cost and Commonwealth rent assistance)</td>
                <td>$390.20</td>
            </tr>
            <tr>
                <td>33% of the total cost of utilities such as electricity, gas, water, and internet<br>
                    <small style="color: #6b7280;">(Above rates are based on the total cost of utilities for a Year)</small>
                </td>
                <td>$204.80</td>
            </tr>
            <tr>
                <td>Food/Groceries<br>
                    <small style="color: #6b7280;">(Based on the total cost of the food purchase currently in our SIL accommodation per person)</small>
                </td>
                <td>$200.00</td>
            </tr>
            <tr class="total-row">
                <td><strong>Total Cost</strong></td>
                <td><strong>$795.00 / Fortnight</strong></td>
            </tr>
        </table>
    </div>
    <div style="page-break-before: always;"></div>

    <!-- Agreement Section -->
    <div class="agreement-section">
        <div class="section-header">Agreement Signature</div>

        <div class="agreement-title"> Participant / Representative  </div>
        <table>
            <tr>
                <th style="width: 35%">Participant Name</th>
                <td>{{ $schedule->agreementSignature->agreement_participant_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Signature Participant / Representative  </th>
                <td>
                    @if(!empty($schedule->agreementSignature->participant_signature))
                        <img src="{{ $schedule->agreementSignature->participant_signature }}"
                             alt="Participant Signature"
                             class="signature-img">
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
        </table>

        <div class="agreement-title">Signature of Best of Homecare Representative</div>
        <table>
            <tr>
                <th style="width: 35%">Representative Name</th>
                <td>{{ $schedule->agreementSignature->representative_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Signature of Best of Homecare Representative</th>
                <td>
                    @if(!empty($schedule->agreementSignature->representative_signature))
                        <img src="{{ $schedule->agreementSignature->representative_signature }}"
                             alt="Representative Signature"
                             class="signature-img">
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
