<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Individual Risk Assessment - BHC</title>
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
            background-color: #f3f4f6;
            padding: 10px 15px;
            font-weight: bold;
            border-left: 4px solid #4f46e5;
            margin-bottom: 10px;
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
        .page-break {
            page-break-before: always;
            break-before: page;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <div class="header-title">Individual Risk Assessment</div>
        <div class="document-number">Document Number: <span>IRA-{{ $assessment->id }}</span></div>
    </div>

    <!-- Client Details -->
    <div class="section">
        <div class="section-header">Client Details</div>
        <table>
            <tr>
                <td>
                    <span class="label">Client Name</span>
                    <span class="value">{{ $assessment->client_name ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Site Address</span>
                    <span class="value">{{ $assessment->site_address ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Date of Assessment</span>
                    <span class="value">{{ $assessment->assessment_date ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Planned Review Date</span>
                    <span class="value">{{ $assessment->planned_review_date ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>



</div>

</body>
</html>
