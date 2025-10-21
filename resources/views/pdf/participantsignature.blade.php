<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Participant Signature</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            background-color: #f9fafb;
            color: #111827;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 30px 40px;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }

        /* Header */
        .header {
            position: relative;
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            position: absolute;
            top: 0;
            left: 0;
            max-width: 80px;
            height: auto;
        }
        .header h2 {
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
            color: #1f2937;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            font-weight: bold;
            width: 35%;
        }
        td {
            background-color: #ffffff;
        }

        /* Signature image */
        .signature-img {
            max-height: 80px;
            display: block;
            margin-top: 8px;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 11px;
            color: #6b7280;
            margin-top: 40px;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">

    {{-- Header --}}
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" alt="BHC Logo" class="logo">
        <h2>MULTIPLE SUPPORT FORM</h2>
    </div>

    {{-- Signature Details --}}
    <table>
        <tr>
            <th>Date Signed</th>
            <td>{{ $record->date_signed ?? '-' }}</td>
        </tr>

    </table>

    {{-- Footer --}}
    <div class="footer">
        <p>BHC Services © {{ date('Y') }} | Confidential Document</p>
    </div>

</div>
</body>
</html>
