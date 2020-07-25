// weather with geoloc from openweathermap

openWeatherMap = 'https://api.openweathermap.org/data/2.5/weather'
if (window.navigator && window.navigator.geolocation) {
    window.navigator.geolocation.getCurrentPosition(function(position) {
        $.getJSON(openWeatherMap, {
            lat: position.coords.latitude,
            lon: position.coords.longitude,
            units: 'metric',
            lang: 'fr',
            APPID: '8af0f894920fd7fcf2e0dc3b48605453'
        }).done(function(weather) {
            town = weather.name;
            tempL = weather.main.temp;
            humL = weather.main.humidity;
            pressL = weather.main.pressure;
            speedL = weather.wind.speed;
            desc = weather.weather[0].description;

            document.getElementById("weather").innerHTML = "<strong>" + town + "</strong>" + " : " + "</strong>" + desc + "<br>" + "<strong>" + "Température : " + "</strong>" + tempL + "°" + "<br>" + "<strong>" + " Humidité : " + "</strong>" + humL + "%" + "<br>" + "<strong>" + "Pression : " + "</strong>" + pressL + "°" + "<br>" + "<strong>" + " Vent : " + "</strong>" + speedL;
        })
    })
}
