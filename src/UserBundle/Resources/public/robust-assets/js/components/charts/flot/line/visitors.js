$(window).on("load",function(){function a(a){var b=[],c=new Date(a.xaxis.min);c.setUTCDate(c.getUTCDate()-(c.getUTCDay()+1)%7),c.setUTCSeconds(0),c.setUTCMinutes(0),c.setUTCHours(0);var d=c.getTime();do b.push({xaxis:{from:d,to:d+1728e5}}),d+=6048e5;while(d<a.xaxis.max);return b}for(var b=[[11964636e5,0],[119655e7,0],[11966364e5,0],[11967228e5,77],[11968092e5,3636],[11968956e5,3575],[1196982e6,2736],[11970684e5,1086],[11971548e5,676],[11972412e5,1205],[11973276e5,906],[1197414e6,710],[11975004e5,639],[11975868e5,540],[11976732e5,435],[11977596e5,301],[1197846e6,575],[11979324e5,481],[11980188e5,591],[11981052e5,608],[11981916e5,459],[1198278e6,234],[11983644e5,1352],[11984508e5,686],[11985372e5,279],[11986236e5,449],[119871e7,468],[11987964e5,392],[11988828e5,282],[11989692e5,208],[11990556e5,229],[1199142e6,177],[11992284e5,374],[11993148e5,436],[11994012e5,404],[11994876e5,253],[1199574e6,218],[11996604e5,476],[11997468e5,462],[11998332e5,448],[11999196e5,442],[1200006e6,403],[12000924e5,204],[12001788e5,194],[12002652e5,327],[12003516e5,374],[1200438e6,507],[12005244e5,546],[12006108e5,482],[12006972e5,283],[12007836e5,221],[120087e7,483],[12009564e5,523],[12010428e5,528],[12011292e5,483],[12012156e5,452],[1201302e6,270],[12013884e5,222],[12014748e5,439],[12015612e5,559],[12016476e5,521],[1201734e6,477],[12018204e5,442],[12019068e5,252],[12019932e5,236],[12020796e5,525],[1202166e6,477],[12022524e5,386],[12023388e5,409],[12024252e5,408],[12025116e5,237],[1202598e6,193],[12026844e5,357],[12027708e5,414],[12028572e5,393],[12029436e5,353],[120303e7,364],[12031164e5,215],[12032028e5,214],[12032892e5,356],[12033756e5,399],[1203462e6,334],[12035484e5,348],[12036348e5,243],[12037212e5,126],[12038076e5,157],[1203894e6,288]],c=0;c<b.length;++c)b[c][0]+=36e5;var d={xaxis:{mode:"time",tickLength:5},selection:{mode:"x"},grid:{borderWidth:1,borderColor:"#e9e9e9",color:"#999",minBorderMargin:20,labelMargin:10,margin:{top:8,bottom:20,left:20},markings:a},yaxis:{tickSize:1e3},colors:["#8c9eff"]},e=$.plot("#visitors-placeholder",[b],d),f=$.plot("#visitors-overview",[b],{series:{lines:{show:!0,lineWidth:1},shadowSize:0},xaxis:{ticks:[],mode:"time"},yaxis:{ticks:[],min:0,autoscaleMargin:.1},selection:{mode:"x"},grid:{borderWidth:1,borderColor:"#e9e9e9",minBorderMargin:20,labelMargin:10,margin:{top:8,bottom:20,left:20}},colors:["#8c9eff"]});$("#visitors-placeholder").bind("plotselected",function(a,b){$.each(e.getXAxes(),function(a,c){var d=c.options;d.min=b.xaxis.from,d.max=b.xaxis.to}),e.setupGrid(),e.draw(),e.clearSelection(),f.setSelection(b,!0)}),$("#visitors-overview").bind("plotselected",function(a,b){e.setSelection(b)})});