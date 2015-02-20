$.ajax({
    url: "http://www.futbolyasado.com/maindate",
    type: "GET",
    dataType: "jsonp",
    cache: false
})
    .done(function (response) {
    var resp = response.fecha;

    $.getJSON("http://api.worldweatheronline.com/free/v2/weather.ashx?q=Cordoba&format=json&date=" + resp + "&lang=es&key=a6f5be3623d9f05d92a917b9622cd", function (data) {


        //current conditions
        var temperature = data.data.current_condition[0].temp_C;
        var humidity = data.data.current_condition[0].humidity;
        var condition = data.data.current_condition[0].lang_es[0].value;
        var icon = data.data.current_condition[0].weatherIconUrl[0].value;
        var winddirection = data.data.current_condition[0].winddir16Point;
        var windspeed = data.data.current_condition[0].windspeedKmph;
        var precipmm = data.data.current_condition[0].precipMM;
        var feelslike = data.data.current_condition[0].FeelsLikeC;
        var cloudcover = data.data.current_condition[0].cloudcover;
        //forecast
        var temperaturefrcst = data.data.weather[0].hourly[7].tempC;
        var iconfrcst = data.data.weather[0].hourly[7].weatherIconUrl[0].value;
        var conditionfrcst = data.data.weather[0].hourly[7].lang_es[0].value;
        var chanceofrain = data.data.weather[0].hourly[7].chanceofrain;
        var chanceoffog = data.data.weather[0].hourly[7].chanceoffog;
        var chanceofwindy = data.data.weather[0].hourly[7].chanceofwindy;
        var chanceofhightemp = data.data.weather[0].hourly[7].chanceofhightemp;
        var chanceoffrost = data.data.weather[0].hourly[7].chanceoffrost;
        var humidityfrcst = data.data.weather[0].hourly[7].humidity;


        $(document).ready(function () {
            $('<img src="' + icon + '" />').appendTo('#weathernow');
            $("#condicion").prepend(condition);
            $("#temp").prepend("Temperatura: " + temperature + "º");
            $("#feelslike").prepend("Sensación térmica: " + feelslike + "º");
            $("#humidity").prepend("Humedad: " + humidity + "%");
            $("#windir").prepend("Dirección del viento: " + winddirection);
            $("#windvel").prepend("Velocidad del viento: " + windspeed + "KMh");
            $("#rain").prepend("Lluvia: " + precipmm + "mm");
            $("#cloudcover").prepend("Nubosidad: " + cloudcover + "%");

            $('<img src="' + iconfrcst + '" />').appendTo('#weathernow-forecast');
            $("#condicion-forecast").prepend(conditionfrcst);
            $("#temp-forecast").prepend("Temperatura estimada: " + temperaturefrcst + "º");
            $("#chanceofrain").prepend("Chance de lluvia: " + chanceofrain + "%");
            $("#chanceoffog").prepend("Chance de niebla: " + chanceoffog + "%");
            $("#chanceofwindy").prepend("Chance de viento: " + chanceofwindy + "%");
            $("#chanceofhightemp").prepend("Chance de alta temperatura: " + chanceofhightemp + "%");
            $("#chanceoffrost").prepend("Chance de helada: " + chanceoffrost + "%");
            $("#humidity-forecast").prepend("Humedad estimada: " + humidityfrcst + "%");

        });

    });


});



