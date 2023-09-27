<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Metrics</title>
</head>
<body>
    <h1>Agent Metrics</h1>

    <!-- Display NPS -->
    <h2>Net Promoter Score (NPS)</h2>
    <p>NPS: {{ $nps }}</p>
    <p>Promoters: {{ $promoters }}</p>
    <p>Detractors: {{ $detractors }}</p>
    <p>Passives: {{ $passives }}</p>
    <p>Promoters Percentage: {{ $promotersPercentage }}%</p>
    <p>Detractors Percentage: {{ $detractorsPercentage }}%</p>
    <p>Passives Percentage: {{ $passivesPercentage }}%</p>

    <!-- Display CES -->
    <h2>Customer Effort Score (CES)</h2>
    <p>CES Score: {{ $cesScore }}</p>
    <p>Satisfied Customers (CES): {{ $satisfiedCustomersCES }}</p>
    <p>Total Responses (CES): {{ $totalResponsesCES }}</p>

    <!-- Display CSAT -->
    <h2>Customer Satisfaction Score (CSAT)</h2>
    <p>CSAT Score: {{ $csatScore }}</p>
    <p>Satisfied Customers (CSAT): {{ $satisfiedCustomersCSAT }}</p>
    <p>Total Surveys (CSAT): {{ $totalSurveysCSAT }}</p>

    <!-- Display Participation Rate -->
    <h2>Participation Rate</h2>
    <p>Participation Rate: {{ $participationRate }}%</p>

    <!-- Display Agent-Specific Metrics -->
    <h2>Agent-Specific Metrics</h2>
    <table>
        <thead>
            <tr>
                <th>Agent Name</th>
                <th>CES Score</th>
                <th>CSAT Score</th>
                <th>NPS Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surveyData as $agent)
                <tr>
                    <td>{{ $agent['agent_name'] }}</td>
                    <td>{{ $agent['ces_score'] }}</td>
                    <td>{{ $agent['csat_score'] }}</td>
                    <td>{{ $agent['nps_score'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
