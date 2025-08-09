<?php
if (isset($_POST['city'])) {
    $city = htmlspecialchars($_POST['city']);
    $apiKey = "";  // Replace with your OpenWeatherMap API key
    $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if ($data['cod'] === 200) {
        $temp = $data['main']['temp'];
        $desc = $data['weather'][0]['description'];
        $humidity = $data['main']['humidity'];
        $wind = $data['wind']['speed'];

        echo "<h2>Weather in " . ucfirst($city) . "</h2>";
        echo "<p>Temperature: $temp °C</p>";
        echo "<p>Description: $desc</p>";
        echo "<p>Humidity: $humidity%</p>";
        echo "<p>Wind Speed: $wind m/s</p>";
        echo "<br><a href='index.html'>Search again</a>";
    } else {
        echo "<p>City not found. Please try again.</p>";
        echo "<br><a href='index.html'>Back</a>";
    }
}
?>
