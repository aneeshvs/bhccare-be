<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Plan - BHC</title>
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

    <div class="header">
        <img src="{{ public_path('images/BHC LOGO_SMALL.png') }}" class="logo" alt="Company Logo">
        <div class="document-number">Document Number: <span>Form F-</span></div>
        <div class="header-title">Client Support Plan</div>
    </div>

    <div class="section">
        <div class="section-header">Support Plan Details</div>
        <table>
            <tr>
                <td>
                    <span class="label">Effective Date</span>
                    <span class="value">{{ $supportPlan->effective_date ? \Carbon\Carbon::parse($supportPlan->effective_date)->format('d-m-Y') : 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Review Date</span>
                    <span class="value">{{ $supportPlan->review_date ? \Carbon\Carbon::parse($supportPlan->review_date)->format('d-m-Y') : 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Confirmation Date</span>
                    <span class="value">{{ $supportPlan->confirmation_date ? \Carbon\Carbon::parse($supportPlan->confirmation_date)->format('d-m-Y') : 'N/A' }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Developed By</span>
                    <span class="value">{{ $supportPlan->developed_by ?? 'N/A' }}</span>
                </td>
                <td colspan="2">
                    <span class="label">Invited But Not Participated</span>
                    <span class="value">{{ $supportPlan->invited_but_not_participated ?? 'N/A' }}</span>
                </td>
            </tr>

        </table>
    </div>
    <div class="section">
        <div class="section-header">Approval of Support Plan</div>
        <table>
            <tr>
                <td>
                    <span class="label">Participant Name</span>
                    <span class="value">{{ $supportPlan->approval->participant_name ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="label">Date of Approval</span>
                    <span class="value">
                        {{ $supportPlan->approval->date_of_approval ? \Carbon\Carbon::parse($supportPlan->approval->date_of_approval)->format('d-m-Y') : 'N/A' }}
                    </span>
                </td>
                <td>
                    <span class="label">Signature</span>
                    <span class="value">{{ $supportPlan->approval->signature ?? 'N/A' }}</span>
                </td>
            </tr>
        </table>
    </div>
    {{-- ✅ If participant unable to approve / co-approval needed --}}
<div class="section">
    <div class="section-header">Support Representative Approval</div>
    <table>
        <tr>
            <td>
                <span class="label">Support Representative Name</span>
                <span class="value">{{ $supportPlan->representativeApproval->support_representative_name ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Role</span>
                <span class="value">{{ $supportPlan->representativeApproval->role ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Date of Approval</span>
                <span class="value">
                    {{ $supportPlan->representativeApproval->date_of_approval ? \Carbon\Carbon::parse($supportPlan->representativeApproval->date_of_approval)->format('d-m-Y') : 'N/A' }}
                </span>
            </td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-header">Care Partner Details</div>
    <table>
        <tr>
            <td>
                <span class="label">Name</span>
                <span class="value">{{ $supportPlan->careApproval->care_partner_name ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Role</span>
                <span class="value">{{ $supportPlan->careApproval->care_partner_role ?? 'N/A' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Contact Phone</span>
                <span class="value">{{ $supportPlan->careApproval->care_partner_contact_phone ?? 'N/A' }}</span>
            </td>
            <td>
                <span class="label">Email</span>
                <span class="value">{{ $supportPlan->careApproval->care_partner_email ?? 'N/A' }}</span>
            </td>
        </tr>
    </table>
</div>





</div>

</body>
</html>
