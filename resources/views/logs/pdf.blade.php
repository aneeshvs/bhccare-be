<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Activity Log Report</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
            margin: 20px;
            color: #111827;
        }
        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 5px;
        }
        .subtitle {
            text-align: center;
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            vertical-align: top;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Client Onboarding – Activity Log Report</h1>

    @php
        $firstClientId = $logs->first(fn($log) => !empty($log->properties['user_id'] ?? $log->properties['attributes']['user_id'] ?? null));
        $clientId = $firstClientId->properties['user_id'] ?? $firstClientId->properties['attributes']['user_id'] ?? 'N/A';
    @endphp

    <div class="subtitle">Client ID: {{ $clientId }}</div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Log Name</th>
                <th>Description</th>
                <th>Client ID</th>
                <th>Client Type</th>
                <th>Staff ID</th>
                <th>Changes</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
         @foreach($logs as $index => $log)
            @php
                $props = $log->parsed_properties ?? [];

                $attributes = $props['attributes'] ?? [];
                $old = $props['old'] ?? [];

                $clientId = $props['user_id'] ?? ($attributes['user_id'] ?? 'N/A');
                $clientType = $props['client_type'] ?? ($attributes['client_type'] ?? 'N/A');
                $staffId = $props['staff_id'] ?? 'N/A';

                $changes = '';
                foreach ($attributes as $key => $newVal) {
                    if ($key === 'updated_at') continue;

                    $oldVal = $old[$key] ?? '[no previous value]';
                    if (trim((string)$oldVal) === trim((string)$newVal)) continue;

                    $label = ucfirst(str_replace('_', ' ', $key));
                    $changes .= "<strong>{$label}</strong>: Old value: <span style='color:red'>{$oldVal}</span> → New value: <span style='color:green'>{$newVal}</span><br>";
                }

                if (!$changes) {
                    $changes = '<em>No field-level change data available.</em>';
                }

                $time = \Carbon\Carbon::parse($log->created_at)->format('d M Y, h:i A');
            @endphp


    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $log->log_name }}</td>
        <td>{{ $log->description }}</td>
        <td>{{ $clientId }}</td>
        <td>{{ $clientType }}</td>
        <td>{{ $staffId }}</td>
        <td>{!! $changes !!}</td>
        <td>{{ $time }}</td>
    </tr>
@endforeach

        </tbody>
    </table>

</body>
</html>
