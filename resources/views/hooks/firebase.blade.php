<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase Data</title>
</head>
<body>
    <div>
        <h1>Firebase Data</h1>
        <div>
            <h2>RumahJamur Data</h2>
            <p>avgh: {{ $firebaseData['RumahJamur']['SetData']['avgh'] }}</p>
            <p>avgt: {{ $firebaseData['RumahJamur']['SetData']['avgt'] }}</p>
        </div>
        <div>
            <h2>TugasAkhir Data</h2>
            <p>avgh: {{ $firebaseData['TugasAkhir']['SetData']['avgh'] }}</p>
            <p>avgt: {{ $firebaseData['TugasAkhir']['SetData']['avgt'] }}</p>
            <p>Fan State Control: {{ $firebaseData['TugasAkhir']['SetData']['fanstate_control'] }}</p>
            <p>Fan State Default: {{ $firebaseData['TugasAkhir']['SetData']['fanstate_default'] }}</p>
            <p>Pump State Control: {{ $firebaseData['TugasAkhir']['SetData']['pumpstate_control'] }}</p>
            <p>Pump State Default: {{ $firebaseData['TugasAkhir']['SetData']['pumpstate_default'] }}</p>
        </div>
        <div>
            <h2>Exhaust Fan State</h2>
            <p>{{ $firebaseData['exhaust_fan'] }}</p>
        </div>
        <div>
            <h2>Water Pump State</h2>
            <p>{{ $firebaseData['water_pump'] }}</p>
        </div>
    </div>
</body>
</html>
