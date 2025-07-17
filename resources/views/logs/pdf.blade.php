<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 13px; margin: 20px; }
        h2 { margin-bottom: 5px; }
        p { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Activity Logs Report</h2>
    <p><strong>UUID:</strong> {{ $uuid }}</p>

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
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $index => $log)
                @php
                    $props = $log->properties ?? [];
                    $staffId = $props['staff_id'] ?? ($props['attributes']['staff_id'] ?? '');
                    $clientId = $props['user_id'] ?? ($props['attributes']['user_id'] ?? '');
                    $clientType = $props['client_type'] ?? ($props['attributes']['client_type'] ?? '');

                    $changes = '';
                    if (isset($props['attributes']) && isset($props['old'])) {
                        foreach ($props['attributes'] as $key => $newVal) {
                            $oldVal = $props['old'][$key] ?? null;
                            if ($oldVal != $newVal) {
                                $changes .= ucfirst(str_replace('_', ' ', $key)) . ': ' . ($oldVal ?? 'null') . ' → ' . ($newVal ?? 'null') . "<br>";
                            }
                        }
                        $changes = $changes ?: 'No changes logged.';
                    } else {
                        $changes = 'No changes logged.';
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
                    <td>
                        @php
                            $props = $log->properties ?? [];
                            $changes = '';

                            if (isset($props['attributes']) && isset($props['old'])) {
                                foreach ($props['attributes'] as $key => $new) {
                                    $old = $props['old'][$key] ?? null;
                                    if ($old != $new) {
                                        $keyFormatted = ucfirst(str_replace('_', ' ', $key));
                                        $changes .= "{$keyFormatted}: {$old} → {$new}<br>";
                                    }
                                }
                            }

                            echo $changes ?: 'No changes logged.';
                        @endphp
                    </td>

                    <td>{{ $time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
