$.getJSON( "http://api.worldweatheronline.com/free/v2/weather.ashx?q=Cordoba&format=json&date=2015-02-10&fx=no&fx24=no&lang=es&key=a6f5be3623d9f05d92a917b9622cd", function( data ) {

    //current conditions
    var temperature = data.data.current_condition[0].temp_C;
    var humidity = data.data.current_condition[0].humidity;
    var condition = data.data.current_condition[0].lang_es[0].value;
    var icon = data.data.current_condition[0].weatherIconUrl[0].value;
    var winddirection = data.data.current_condition[0].winddir16Point;
    var windspeed = data.data.current_condition[0].windspeedKmph;
    var precipmm = data.data.current_condition[0].precipMM;
    var feelslike = data.data.current_condition[0].FeelsLikeC;

    console.log(feelslike, temperature, winddirection, humidity, precipmm);


});