
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home Safety Assessment - BHC</title>
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
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="BHC Logo">
        <div class="header-title">Home Safety Assessment</div>
        <div class="document-number">Document Number: <span>HSA-{{ $homeSafety->id ?? 'N/A' }}</span></div>
    </div>

    <!-- Participant Information -->
    <div class="section">
        <div class="section-header">Participant Details</div>
        <table>
            <tr>
                <td>
                    <span class="label">Participant Name</span>
                    <span class="value">{{ $homeSafety->participant_name ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Assessment Date</span>
                    <span class="value">{{ $homeSafety->assessment_date ?? now()->toDateString() }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Address</span>
                    <span class="value">{{ $homeSafety->address ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Phone</span>
                    <span class="value">{{ $homeSafety->phone ?? 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Email</span>
                    <span class="value">{{ $homeSafety->email ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Assessment Type -->
    <div class="section">
        <div class="section-header">Assessment Type</div>
        <table>
            <tr>
                <td>
                    <span class="label">New Participant</span>
                    <span class="value">{{ isset($homeSafety->is_new_participant) ? ($homeSafety->is_new_participant ? 'Yes' : 'No') : 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Review Existing</span>
                    <span class="value">{{ isset($homeSafety->is_review_existing) ? ($homeSafety->is_review_existing ? 'Yes' : 'No') : 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Does Participant Agree?</span>
                    <span class="value">{{ isset($homeSafety->does_participant_agree) ? ($homeSafety->does_participant_agree ? 'Yes' : 'No') : 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Entry Door -->
    <div class="section">
        <div class="section-header">Entry Door Information</div>
        <table>
            <tr>
                <td>
                    <span class="label">Entry Door</span>
                    <span class="value">{{ ucfirst($homeSafety->entry_door ?? 'N/A') }}</span>
                </td>
                <td>
                    <span class="label">If Other, Specify</span>
                    <span class="value">{{ $homeSafety->entry_door_other ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>

</div>
</body>
</html>

