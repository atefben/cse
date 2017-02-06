!function(e){e.fn.weatherfeed=function(t,i,a){var s={unit:"c",image:!0,country:!1,highlow:!0,wind:!0,humidity:!1,visibility:!1,sunrise:!1,sunset:!1,forecast:!1,link:!0,showerror:!0,linktarget:"_self",woeid:!0,refresh:0},i=e.extend(s,i),o="odd";return this.each(function(s,l){function c(t,i,r){o="odd",h.html(""),e.ajax({type:"GET",url:i,dataType:"json",success:function(t){if(t.query){if(t.query.results.channel.length>0)for(var i=t.query.results.channel.length,s=0;i>s;s++)f(l,t.query.results.channel[s],r);else f(l,t.query.results.channel,r);e.isFunction(a)&&a.call(this,h)}else r.showerror&&h.html("<p>Weather information unavailable</p>")},error:function(e){r.showerror&&h.html("<p>Weather request failed</p>")}})}var h=e(l);if(h.hasClass("weatherFeed")||h.addClass("weatherFeed"),!e.isArray(t))return!1;var u=t.length;u>10&&(u=10);for(var v="",s=0;u>s;s++)""!=v&&(v+=","),v+="'"+t[s]+"'";now=new Date;var w=i.woeid?"woeid":"location",y="select * from weather.forecast where "+w+" in ("+v+") and u='"+i.unit+"'",g="http://query.yahooapis.com/v1/public/yql?q="+encodeURIComponent(y)+"&rnd="+now.getFullYear()+now.getMonth()+now.getDay()+now.getHours()+"&format=json&callback=?";if(c(y,g,i),i.refresh>0){setInterval(function(){c(y,g,i)},6e4*i.refresh)}var f=function(t,i,r){var a=e(t);if("Yahoo! Weather Error"!=i.description){var s=i.wind.direction;s>=348.75&&360>=s&&(s="N"),s>=0&&11.25>s&&(s="N"),s>=11.25&&33.75>s&&(s="NNE"),s>=33.75&&56.25>s&&(s="NE"),s>=56.25&&78.75>s&&(s="ENE"),s>=78.75&&101.25>s&&(s="E"),s>=101.25&&123.75>s&&(s="ESE"),s>=123.75&&146.25>s&&(s="SE"),s>=146.25&&168.75>s&&(s="SSE"),s>=168.75&&191.25>s&&(s="S"),s>=191.25&&213.75>s&&(s="SSW"),s>=213.75&&236.25>s&&(s="SW"),s>=236.25&&258.75>s&&(s="WSW"),s>=258.75&&281.25>s&&(s="W"),s>=281.25&&303.75>s&&(s="WNW"),s>=303.75&&326.25>s&&(s="NW"),s>=326.25&&348.75>s&&(s="NNW");var d=i.item.forecast[0];wpd=i.item.pubDate,n=wpd.indexOf(":"),tpb=m(wpd.substr(n-2,8)),tsr=m(i.astronomy.sunrise),tss=m(i.astronomy.sunset),tpb>tsr&&tpb<tss?daynight="day":daynight="night";var l='<div class="weatherItem '+o+" "+daynight+'"';if(r.image&&(l+=' style="background-image: url(http://l.yimg.com/a/i/us/nws/weather/gr/'+i.item.condition.code+daynight.substring(0,1)+'.png); background-repeat: no-repeat;"'),l+=">",l+='<div class="weatherCity">'+i.location.city+"</div>",r.country&&(l+='<div class="weatherCountry">'+i.location.country+"</div>"),l+='<div class="weatherTemp">'+i.item.condition.temp+"&deg;</div>",l+='<div class="weatherDesc">'+i.item.condition.text+"</div>",r.highlow&&(l+='<div class="weatherRange">High: '+d.high+"&deg; Low: "+d.low+"&deg;</div>"),r.wind&&(l+='<div class="weatherWind">Wind: '+s+" "+i.wind.speed+i.units.speed+"</div>"),r.humidity&&(l+='<div class="weatherHumidity">Humidity: '+i.atmosphere.humidity+"</div>"),r.visibility&&(l+='<div class="weatherVisibility">Visibility: '+i.atmosphere.visibility+"</div>"),r.sunrise&&(l+='<div class="weatherSunrise">Sunrise: '+i.astronomy.sunrise+"</div>"),r.sunset&&(l+='<div class="weatherSunset">Sunset: '+i.astronomy.sunset+"</div>"),l+="</div>",r.forecast){l+='<div class="weatherForecast">';for(var c=i.item.forecast,h=0;h<c.length;h++)l+='<div class="weatherForecastItem" style="background-image: url(http://l.yimg.com/a/i/us/nws/weather/gr/'+c[h].code+'s.png); background-repeat: no-repeat;">',l+='<div class="weatherForecastDay">'+c[h].day+"</div>",l+='<div class="weatherForecastDate">'+c[h].date+"</div>",l+='<div class="weatherForecastText">'+c[h].text+"</div>",l+='<div class="weatherForecastRange">High: '+c[h].high+" Low: "+c[h].low+"</div>",l+="</div>"}r.link&&(l+='<div class="weatherLink"><a href="'+i.link+'" target="'+r.linktarget+'" title="Read full forecast">Full forecast</a></div>')}else{var l='<div class="weatherItem '+o+'">';l+='<div class="weatherError">City not found</div>'}l+="</div>",o="odd"==o?"even":"odd",a.append(l)},m=function(e){return d=new Date,r=new Date(d.toDateString()+" "+e),r}})}}(jQuery);

/*================== Weather =====================*/
$('#weather').weatherfeed(['UKXX0085'],{
	unit: 'c',
	image: true,
	country: true,
	highlow: true,
	wind: true,
	humidity: true,
	visibility: true,
	sunrise: true,
	sunset: true,
	forecast: false,
	link: false
});
