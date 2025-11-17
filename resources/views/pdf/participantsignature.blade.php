<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appendix A - Multiple Supports</title>

    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            padding: 35px;
            line-height: 1.65;
            color: #222;
        }

        .container {
            border: 1px solid #ccc;
            padding: 28px;
            border-radius: 8px;
            background: #fff;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 90px;
            margin-bottom: 8px;
        }
        h2 {
            margin: 5px 0 0 0;
            font-size: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Titles & Text */
        .main-title {
            font-weight: bold;
            font-size: 15px;
            margin-bottom: 10px;
        }
        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-top: 22px;
            margin-bottom: 5px;
            text-decoration: underline;
        }

        p {
            margin-top: 11px;
            margin-bottom: 11px;
        }

        ul {
            margin-top: 5px;
            margin-left: 18px;
        }
        ul li {
            margin-bottom: 4px;
        }

        /* Signature Box */
        .signature-box {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
        }
        .signature-img {
            max-height: 100px;
            margin-top: 10px;
            border: 1px solid #bbb;
            padding: 5px;
            border-radius: 4px;
        }

        /* Footer */
        .footer {
            margin-top: 45px;
            text-align: center;
            font-size: 10.5px;
            color: #555;
            border-top: 1px solid #ccc;
            padding-top: 8px;
        }
    </style>
</head>

<body>
<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo">
        <h2>Appendix A – Multiple Supports</h2>
    </div>

    <!-- Document Body -->
    <p class="main-title">
        Service Agreement<br>
        Appendix A - Multiple Supports
    </p>

    <p>
        For participants who receive dual supports that may present as a conflict of interest.
        If you receive the following services, you must not at any time feel obligated to seek further
        support provision from Best of Homecare.
    </p>

    <p class="section-title">This includes participants that may receive support as well as:</p>
    <ul>
        <li>Support Coordination</li>
        <li>Other supports</li>
    </ul>

    <p class="section-title">Communication regarding conflicting service provision:</p>
    <p>
        Where you are receiving one of the above services and require additional supports available within
        Best of Homecare’s scope of provision, our staff will provide you with three provider options.
        You will also receive information about advocacy assistance to support your decision-making
        process. You will be regularly reminded of your choices and may change supports at any time.
    </p>

    <p class="section-title">Documentation:</p>
    <p>
        These options will be documented on your files and explained in a communication style that best
        suits your needs.
    </p>

    <p class="section-title">Service Provision:</p>
    <p>
        Where a service and support are provided to you, Best of Homecare ensures that separate staff
        members undertake the functions to maintain a clear distinction between roles.
    </p>

    <!-- Signature Section -->
    <div class="signature-box">
        <strong>1. Participant Signature:</strong><br>

        @if($signatureImage)
            <img src="{{ $signatureImage }}" class="signature-img">
        @else
            <span>No signature available</span>
        @endif

        <br><br>
        <strong>Date Signed:</strong>
        {{ $record->date_signed ? \Carbon\Carbon::parse($record->date_signed)->format('d/m/Y') : '-' }}
    </div>

    <!-- Footer -->
    <div class="footer">
        BHC Services © {{ date('Y') }} &nbsp; | &nbsp; Confidential Document
    </div>

</div>
</body>
</html>
