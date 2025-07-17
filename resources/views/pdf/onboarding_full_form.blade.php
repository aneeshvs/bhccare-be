<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Onboarding Form PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            background: #fff;
            color: #111827;
        }
        .section {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            margin: 20px 0;
            padding: 20px;
            background-color: #fff;
        }
        .section-header {
            background-color: #f3f4f6;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 16px;
            border-bottom: 1px solid #d1d5db;
        }
        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }
        .field {
            flex: 0 0 48%;
        }
        .field-full {
            flex: 0 0 100%;
        }
        .label {
            font-weight: 500;
            margin-bottom: 4px;
            display: block;
        }
        .value-box {
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 8px;
            background-color: #f9fafb;
        }
    </style>
</head>
<body>

<div class="section">
    <div class="section-header">Initial Enquiry</div>
    <div class="p-4">
        <div class="grid">
            <div class="field">
                <span class="label">Full Name:</span>
                <div class="value-box">{{ $initial->full_name }}</div>
            </div>
            <div class="field">
                <span class="label">Preferred Name:</span>
                <div class="value-box">{{ $initial->preferred_name }}</div>
            </div>

            <div class="field">
                <span class="label">Gender:</span>
                <div class="value-box">{{ ucfirst($initial->gender) }}</div>
            </div>
            <div class="field">
                <span class="label">Date of Birth:</span>
                <div class="value-box">{{ \Carbon\Carbon::parse($initial->date_of_birth)->format('d-m-Y') }}</div>
            </div>

            <div class="field-full">
                <span class="label">Address:</span>
                <div class="value-box">{{ $initial->address }}</div>
            </div>

            <div class="field">
                <span class="label">Post Code:</span>
                <div class="value-box">{{ $initial->post_code }}</div>
            </div>
            <div class="field">
                <span class="label">Phone:</span>
                <div class="value-box">{{ $initial->phone }}</div>
            </div>

            <div class="field">
                <span class="label">Mobile:</span>
                <div class="value-box">{{ $initial->mobile }}</div>
            </div>
            <div class="field">
                <span class="label">Email:</span>
                <div class="value-box">{{ $initial->email }}</div>
            </div>

            <div class="field-full">
                <span class="label">Needs Assistance (Family/Friend/Guardian):</span>
                <div class="value-box">
                    {{ $initial->agreement == 1 ? 'Yes' : 'No' }}
                </div>
            </div>

            @if($initial->description)
                <div class="field-full">
                    <span class="label">Description:</span>
                    <div class="value-box">{{ $initial->description }}</div>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
