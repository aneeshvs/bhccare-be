<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule of Supports - BHC</title>
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

        .transport-checkbox {
            width: 20px;
            text-align: center;
        }

        .total-row {
            background-color: #F2F2F2;
            font-weight: bold;
        }

        .signature-img {
            max-height: 40px;
            border: 1px solid #ccc;
            padding: 2px;
            background-color: white;
        }
    </style>
</head>
<body>
    <!-- Page Header -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Service Agreement -Appendix B Schedule of Supports</div>

        </div>
        {{-- <div class="document-number-container">
        </div> --}}
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Schedule of Supports Section -->
            <div class="section page-start">
                <div class="section-header">1.Schedule of Supports</div>
                <table>
                    <tr>
                        <td class="field-label">Participant Name</td>
                        <td class="field-value">{{ $schedule->participant_name ?? 'N/A' }}</td>
                        <td class="field-label">Schedule of Support Creation Date (Today’s Date)</td>
                        <td class="field-value">
                            {{ $schedule->creation_date ? \Carbon\Carbon::parse($schedule->creation_date)->format('d/m/Y') : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="field-label">Service Agreement and Funding Review Date</td>
                        <td class="field-value">
                            {{ $schedule->funding_review_date ? \Carbon\Carbon::parse($schedule->funding_review_date)->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td class="field-label">Support required on a Public Holiday</td>
                        <td class="field-value">
                            @if(isset($schedule->support_on_public_holiday))
                                {{ $schedule->support_on_public_holiday ? 'Yes' : 'No' }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="note-box">
                    <strong>Note:</strong> Shifts on a Public Holiday will incur a higher rate per hour and will be priced in the Schedule of Supports. This may impact on scope of support and lower the hours of support available.
                </div>
            </div>

            <!-- Transport Section -->
            <div class="section">
                <div class="section-header1">Transport</div>
                <table>
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                            <td class="transport-checkbox">[ ]</td>

                            </td>
                            <td>Fully funded for transport</td>
                            <td>Funding meets participant transport needs</td>
                            <td>Participant only uses KM funded for $________. This figure should be based on _____ cents per kilometre and does not include GST.</td>
                        </tr>
                        <tr>
                            <td class="transport-checkbox">[ ]</td>


                            </td>
                            <td>Partially funded for transport – converts support hours</td>
                            <td>Indicate core support $ to be converted. Funding does not meet transport needs. Participant converts support hours to pay for KM.</td>
                            <td>Conversion of core support funding into transport must not negatively impact goals and outcomes. Conversion of supports can only occur where participant has transport within their plan, and Core Daily Activity & Transport are managed by Best of Homecare.</td>
                        </tr>
                        <tr>
                            <td class="transport-checkbox">[ ]</td>


                            </td>
                            <td>Partially funded for transport – converts support hours</td>
                            <td>Indicate core support $ to be converted</td>
                            <td>*Funding does not meet transport needs. Participant converts support hours to pay for KM.<br>
                                *Conversion of core support funding into transport must not negatively impact goals and outcomes.<br>
                                *Conversion of supports can only occur where the participant has transport within their plan, and both the participant's Core Daily Activity and Transport are managed by Best of Homecare.</td>
                        </tr>
                        <tr>
                            <td class="transport-checkbox">[ ]</td>


                            </td>
                            <td>Not funded for transport within the NDIS funding plan</td>
                            <td>Participant is not funded for transport</td>
                            <td>Participant uses public transport or will be invoiced for KM at the rate of _____ cents per KM + GST</td>
                        </tr>
                        <tr>
                           <td class="transport-checkbox">[ ]</td>


                            </td>
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
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 1.1<br>
                    Issue: 20 June 2025
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


    <!-- Header for Page 2 -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="header-content">
            <div class="header-title">Service Agreement -Appendix B Schedule of Supports</div>

        </div>
        {{-- <div class="document-number-container">
            <div class="page-document-number">Appendix B Schedule of Supports</div>
        </div> --}}
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Funded Supports Section -->
           <div class="section page-start">
    <div class="section-header">2. Schedule of Supports - Funded Supports</div>

    @php
        // Funded supports from DB (Next.js already calculated totals)
        $fundedSupports = $schedule->transport ?? [];

        // Grand total already stored in DB by Laravel
        $finalGrandTotal = $schedule->grand_total ?? 0;
    @endphp

    <table>
        <thead>
            <tr>
                <th style="width: 5%">#</th>
                <th style="width: 15%">Support</th>
                <th style="width: 20%">Description of Support</th>
                <th style="width: 10%">Unit</th>

                <th style="width: 10%">Price</th>
               
                <th style="width: 20%">Payment Information</th>
                <th style="width: 15%">Invoicing Details</th>
                <th style="width: 20%">How the Support will be provided</th>
            </tr>
        </thead>

        <tbody>
            @if(count($fundedSupports) === 0)
                <tr>
                    <td colspan="9" style="text-align: center;">No funded supports available</td>
                </tr>
            @else
                @foreach($fundedSupports as $index => $fundedSupport)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $fundedSupport->support_name ?? 'N/A' }}</td>
                        <td>{{ $fundedSupport->description ?? 'N/A' }}</td>

                        <!-- UNIT FROM DATABASE -->
                        <td>{{ $fundedSupport->unit ?? '0' }}</td>

                        <!-- PRICE FROM DATABASE -->
                        <td>${{ number_format($fundedSupport->price ?? 0, 2) }}</td>

                        

                    <td>
                        <div class="enum-field">
                            @foreach(['NDIA', 'Self-managed', 'Plan managed'] as $option)
                                <span class="enum-option {{ ($fundedSupport->payment_information ?? '') === $option ? 'selected' : '' }}">
                                    {{ $option }}
                                </span><br>
                            @endforeach
                        </div>
                    </td>

                        <td>{{ $fundedSupport->invoicing_details ?? 'N/A' }}</td>
                        <td>{{ $fundedSupport->delivery_details ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>

        <tfoot>
            <tr class="total-row">
                <td colspan="5">Grand Total (all funded Supports)</td>

                <!-- FINAL GRAND TOTAL FROM DB -->
                <td colspan="4">${{ number_format($finalGrandTotal, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="note-box">
        <strong>Please note:</strong><br>
        • Participants being supported to engage in community/social or recreational activities within the community will be charged, where applicable, up to four hours over the plan period for documentation purposes.<br>
        • The schedule of supports can include staff member 'shadow shifts' (or buddy shifts) up to six hours of weekday support per year.<br>
        • Participants receiving core supports approve the flexible movement of funding between support types noted in the Schedule of Support to meet their needs.
    </div>
</div>

        </div>
    </div>

    <!-- Footer for Page 2 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                   Version No: 1.1<br>
                    Issue: 20 June 2025
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
            <div class="header-title">Service Agreement -Appendix B Schedule of Supports</div>

        </div>
        {{-- <div class="document-number-container">
            <div class="page-document-number">Appendix B Schedule of Supports</div>
        </div> --}}
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Unfunded Supports Section -->
           <div class="section page-start">
    <div class="section-header">3. Schedule of Supports - Unfunded Supports</div>

    @php
        // Unfunded supports from DB (Next.js already calculated totals)
        $unfundedSupports = $schedule->unfundedSupport ?? [];

        // Grand total already stored in DB by Laravel
        $unfundedGrandTotal = $schedule->unfunded_grand_total ?? 0;
    @endphp

    <table>
        <thead>
            <tr>
                <th style="width: 5%">#</th>
                <th style="width: 15%">Support</th>
                <th style="width: 20%">Description of Support</th>
                <th style="width: 10%">Unit</th>
                <th style="width: 10%">Price</th>
                
                <th style="width: 30%">Price Information</th>
                <th style="width: 15%">Delivery Details</th>
            </tr>
        </thead>

        <tbody>
            @if(count($unfundedSupports) === 0)
                <tr>
                    <td colspan="8" style="text-align: center;">No unfunded supports available</td>
                </tr>
            @else
                @foreach($unfundedSupports as $index => $unfundedSupport)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $unfundedSupport->unfunded_support_name ?? 'N/A' }}</td>
                        <td>{{ $unfundedSupport->unfunded_description ?? 'N/A' }}</td>

                        <!-- UNIT FROM DATABASE -->
                        <td>{{ $unfundedSupport->unfunded_unit ?? '0' }}</td>

                        <!-- PRICE FROM DATABASE -->
                        <td>${{ number_format($unfundedSupport->unfunded_price ?? 0, 2) }}</td>

                        
                        <td>
                            <div class="enum-field">
                                @foreach(['Free', 'Negotiated', 'Market rate', 'Sliding scale', 'Other'] as $option)
                                    <span class="enum-option {{ ($unfundedSupport->unfunded_price_information ?? '') === $option ? 'selected' : '' }}">
                                        {{ $option }}
                                    </span><br>
                                @endforeach
                            </div>
                        </td>

                        <td>{{ $unfundedSupport->unfunded_delivery_details ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>

        <tfoot>
            <tr class="total-row">
                <td colspan="5">Grand Total (all unfunded Supports)</td>

                <!-- GRAND TOTAL FROM DATABASE -->
                <td colspan="3">${{ number_format($unfundedGrandTotal, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="note-box">
        <strong>Please note:</strong><br>
        • Payment for board and lodgings may go via PTO or Best of Homecare account only.<br>
        • Breakdown of board and lodging costs is available upon request.
    </div>
</div>


            <!-- SIL/SDA Accommodation Section -->
            <div class="section">
                <div class="section-header1">Supported Independent Living Accommodation - Fortnightly Participants Contribution (SIL/SDA Only)</div>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 70%">Description</th>
                            <th style="width: 30%">Amount (Per Fortnight)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rent Charges (Rental cost and Commonwealth rent assistance)</td>
                            <td>$390.20</td>
                        </tr>
                        <tr>
                            <td>33% of the total cost of utilities such as electricity, gas, water, and internet<br>
                                <small style="color: #666;">(Above rates are based on the total cost of utilities for a Year)</small>
                            </td>
                            <td>$204.80</td>
                        </tr>
                        <tr>
                            <td>Food/Groceries<br>
                                <small style="color: #666;">(Based on the total cost of the food purchase currently in our SIL accommodation per person)</small>
                            </td>
                            <td>$200.00</td>
                        </tr>
                        <tr class="total-row">
                            <td><strong>Total Cost</strong></td>
                            <td><strong>$795.00 / Fortnight</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 3 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 1.1<br>
                    Issue: 20 June 2025
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
            <div class="header-title">Service Agreement -Appendix B Schedule of Supports</div>

        </div>
        {{-- <div class="document-number-container">
            <div class="page-document-number">Appendix B Schedule of Supports</div>
        </div> --}}
    </div>

    <div class="content-wrapper">
        <div class="container">
            <!-- Agreement Section -->
            <div class="section page-start">
                <div class="section-header">4.Agreement Signatures</div>

                <!-- Participant/Representative Section -->
                <div class="section-header1" style="margin-top: 10px; margin-bottom: 5px;">Participant / Representative</div>
                <table>
                    <tr>
                        <td class="field-label">Name of Participant / Representative</td>
                        <td class="field-value" colspan="3">{{ $schedule->agreementSignature->agreement_participant_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Signature Participant / Representative</td>
                        <td class="field-value" colspan="3">
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
                        <td class="field-label">Participant Date</td>
                        <td class="field-value" colspan="3">
                            {{ isset($schedule->agreementSignature->participant_date)
                                ? \Carbon\Carbon::parse($schedule->agreementSignature->participant_date)->format('d/m/Y')
                                : 'N/A' }}
                        </td>
                    </tr>
                </table>

                <!-- Best of Homecare Representative Section -->
                <div class="section-header1" style="margin-top: 15px; margin-bottom: 5px;">Signature of Best of Homecare Representative</div>
                <table>
                    <tr>
                        <td class="field-label">Name of Best Of Home Representative</td>
                        <td class="field-value" colspan="3">{{ $schedule->agreementSignature->representative_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="field-label">Signature of Best of Homecare Representative</td>
                        <td class="field-value" colspan="3">
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
                        <td class="field-label">Representative Date</td>
                        <td class="field-value" colspan="3">
                            {{ isset($schedule->agreementSignature->representative_date)
                                ? \Carbon\Carbon::parse($schedule->agreementSignature->representative_date)->format('d/m/Y')
                                : 'N/A' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer for Page 4 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%">
                    Version No: 1.1<br>
                    Issue: 20 June 2025
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
