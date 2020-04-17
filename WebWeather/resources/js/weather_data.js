


// JavaScript Not used
$(window).on("load", getWeatherData('Mumbai'));

function getWeatherData(city) {
	
	$.ajax({ 
	
	url:'http://api.openweathermap.org/data/2.5/weather?q='+city+'&appid=d4fe00827e9855d0d0e2442f3dd09be3',
	type: "GET",
	dataType: "jsonp",
	success:function(data){
		
		console.log(data);
	}
	});
	
	

}




