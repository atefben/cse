$(window).on("load",function(){var a=c3.generate({bindto:"#step-chart",size:{height:400},color:{pattern:["#673AB7","#E91E63"]},data:{columns:[["data1",300,350,300,0,0,100],["data2",130,100,140,200,150,50]],types:{data1:"step",data2:"area-step"}},grid:{y:{show:!0}}});$(".menu-toggle").on("click",function(){a.resize()})});