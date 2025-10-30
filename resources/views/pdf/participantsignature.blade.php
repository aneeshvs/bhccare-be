<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Appendix A - Multiple Supports</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 13px; padding: 30px; line-height: 1.6; }
        .container { border: 1px solid #ddd; padding: 25px; border-radius: 8px; }
        .header { text-align: center; margin-bottom: 25px; }
        .logo { max-width: 90px; }
        h2 { margin-top: 5px; }

        .section-title { font-weight: bold; margin-top: 18px; }

        ul { margin-top: 6px; }
        ul li { margin-bottom: 4px; }

        .signature-box { margin-top: 45px; }
        .signature-img { max-height: 120px; margin-top: 8px; border: 1px solid #ccc; padding: 4px; }

        .footer { margin-top: 50px; text-align: center; font-size: 11px; color: #666; border-top: 1px solid #ddd; padding-top: 8px; }
    </style>
</head>

<body>
<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo">
        <h2>APPENDIX A - MULTIPLE SUPPORTS</h2>
    </div>

    <!-- Document Body -->
    <p><strong>Service Agreement<br>Appendix A - Multiple Supports</strong></p>

    <p>
        For participants who receive dual supports that may present as a conflict of interest.
        If you receive the following services, you must not at any time feel obligated to seek further
        support provision from Best of Homecare.
    </p>

    <p><strong>This includes participants that may receive support as well as any of the following:</strong></p>
    <ul>
        <li>Support Coordination</li>
        <li>Other supports</li>
    </ul>

    <p><strong>Communication regarding conflicting service provision:</strong><br>
        Where you are receiving one of the above listed services and require additional supports that are
        available within Best of Homecare scope of provision, Best of Homecare staff members will provide
        you with three options of providers. You will be provided information about accessing an advocate
        to support you in the decision-making process and will be assured of no retribution.
        You will be regularly reminded of your options and can choose to change supports at any time.
    </p>

    <p><strong>Documentation:</strong><br>
        These options will be documented on your files and will be explained in a format, terms or mode of
        communication that best suits your needs.
    </p>

    <p><strong>Service Provision:</strong><br>
        Where a service and a support is provided to you, Best of Homecare ensures that separate staff
        members undertake the functions to ensure clarity of distinction between the roles.
    </p>


    <!-- Signature Section -->
    <div class="signature-box">
        <strong>Participant Signature:</strong><br>

        @if($signatureImage)
            <img src="{{ $signatureImage }}" class="signature-img" style="max-height:70px; border:1px solid #ccc; padding:4px;">
        @else
            <span>No signature available</span>
        @endif

        <br><br>
        <strong>Date Signed:</strong>
        {{ $record->date_signed ? \Carbon\Carbon::parse($record->date_signed)->format('d/m/Y') : '-' }}
    </div>

    <!-- Footer -->
    <div class="footer">
        BHC Services © {{ date('Y') }} | Confidential Document
    </div>

</div>
</body>
</html>
