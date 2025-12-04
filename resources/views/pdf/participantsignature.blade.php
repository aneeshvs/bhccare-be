<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appendix A - Multiple Supports</title>
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

        .section-header,
        .section-header1 {
            background-color: #bae6fd;
            color: #000;
            padding: 6px;
            font-weight: bold;
            font-size: 10px;
            border-bottom: 1px solid #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
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
        }

        .content-wrapper {
            margin-top: 50px;
            margin-bottom: 35px;
        }

        .section-body { padding: 6px; }

        .content-text {
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 12px;
            text-align: justify;
        }

        .content-list {
            margin: 8px 0;
            padding-left: 15px;
        }

        .content-list li {
            font-size: 11px;
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .content-title {
            font-weight: bold;
            margin: 15px 0 6px 0;
            font-size: 12px;
            text-decoration: underline;
        }

        .signature-section { margin-top: 25px; padding-top: 15px; border-top: 1px solid #000; }

        .signature-img {
            max-height: 40px;
            border: 1px solid #ccc;
            padding: 2px;
            background: white;
        }

        .page-break { page-break-before: always; }


        /* --------------------------------------------------------
           PAGE 1 FULL-WIDTH OVERRIDES
        ---------------------------------------------------------*/
        .first-page-section {
            border: none !important;
            padding: 0 !important;
        }

        .first-page-section .section-body {
            border: none !important;
            padding: 0 !important;
        }

        .first-page-section table,
        .first-page-section td,
        .first-page-section th {
            border: none !important;
        }

        .first-page-section .section-header,
        .first-page-section .section-header1 {
            background-color: transparent !important;
            border: none !important;
        }

        .first-page-section .content-text,
        .first-page-section .content-list li,
        .first-page-section .content-title {
            font-size: 13px !important;
            line-height: 1.45;
        }

    </style>
</head>

<body>

    <!-- Page Header -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo">
        <div class="header-content">
            <div class="header-title">Service Agreement - <br> Appendix A – Multiple Supports</div>
        </div>
        <div class="document-number-container"><div class="page-document-number">Appendix A</div></div>
    </div>

    <!-- PAGE 1 CONTENT -->
    <div class="content-wrapper">
        <div class="container">
            <div class="section page-start first-page-section">
                <div class="section-body">

                    <div class="content-text">
                        For participants who receive dual supports that may present as a conflict of interest.
                        If you receive the following services, you must not at any time feel obligated to seek further
                        support provision from Best of Homecare.
                    </div>

                    <div class="content-title">This includes participants that may receive support as well as:</div>
                    <ul class="content-list">
                        <li>Support Coordination</li>
                        <li>Other supports</li>
                    </ul>

                    <div class="content-title">Communication regarding conflicting service provision:</div>
                    <div class="content-text">
                        Where you are receiving one of the above services and require additional supports available within
                        Best of Homecare's scope of provision, our staff will provide you with three provider options.
                        You will also receive information about advocacy assistance to support your decision-making
                        process. You will be regularly reminded of your choices and may change supports at any time.
                    </div>

                    <div class="content-title">Documentation:</div>
                    <div class="content-text">
                        These options will be documented on your files and explained in a communication style that best
                        suits your needs.
                    </div>

                    <div class="content-title">Service Provision:</div>
                    <div class="content-text">
                        Where a service and support are provided to you, Best of Homecare ensures that separate staff
                        members undertake the functions to maintain a clear distinction between roles.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Page 1 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td>Version No: 1.1<br>Issue: 19 December 2024</td>
                <td>Approver: Director<br>UNCONTROLLED WHEN PRINTED</td>
                <td>Page 1 of 2</td>
            </tr>
        </table>
    </div>

    <!-- PAGE BREAK -->
    <div class="page-break"></div>


    <!-- PAGE 2 HEADER -->
    <div class="page-header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo">
        <div class="header-content">
            <div class="header-title">Service Agreement - <br> Appendix A – Multiple Supports</div>
        </div>
        <div class="document-number-container"><div class="page-document-number">Appendix A</div></div>
    </div>


    <!-- PAGE 2 CONTENT -->
    <div class="content-wrapper">
        <div class="container">
            <div class="section page-start">
                <div class="section-body">

                    <div class="signature-section">
                        <strong>1. Participant Signature:</strong><br><br>

                        @if($signatureImage)
                            <img src="{{ $signatureImage }}" class="signature-img">
                        @else
                            <div style="height: 40px; border:1px dashed #ccc; padding:10px; background:#f9f9f9;">
                                <span>No signature available</span>
                            </div>
                        @endif

                        <br><br>

                        <table>
                            <tr>
                                <td>Date Signed</td>
                                <td>
                                    {{ $record->date_signed ? \Carbon\Carbon::parse($record->date_signed)->format('d/m/Y') : '-' }}
                                </td>
                            </tr>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer Page 2 -->
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td>Version No: 1.1<br>Issue: 19 December 2024</td>
                <td>Approver: Director<br>UNCONTROLLED WHEN PRINTED</td>
                <td>Page 2 of 2</td>
            </tr>
        </table>
    </div>

</body>
</html>
