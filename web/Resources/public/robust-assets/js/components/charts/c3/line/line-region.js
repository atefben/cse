$(window).on("load",function(){var a=c3.generate({bindto:"#line-region",size:{height:400},point:{r:4},color:{pattern:["#673AB7","#E91E63"]},data:{columns:[["data1",30,200,100,400,150,250],["data2",50,20,10,40,15,25]],regions:{data1:[{start:1,end:2,style:"dashed"},{start:3}],data2:[{end:3}]}},grid:{y:{show:!0}}});$(".menu-toggle").on("click",function(){a.resize()})});