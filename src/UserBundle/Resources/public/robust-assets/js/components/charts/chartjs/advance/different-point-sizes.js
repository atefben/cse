$(window).on("load",function(){var a=$("#different-point-sizes"),b={responsive:!0,maintainAspectRatio:!1,legend:{position:"bottom"},hover:{mode:"label"},scales:{xAxes:[{display:!0,gridLines:{color:"#f3f3f3",drawTicks:!1},scaleLabel:{display:!0,labelString:"Month"}}],yAxes:[{display:!0,gridLines:{color:"#f3f3f3",drawTicks:!1},scaleLabel:{display:!0,labelString:"Value"}}]},title:{display:!0,text:"Chart.js Line Chart - Legend"}},c={labels:["January","February","March","April","May","June","July"],datasets:[{label:"dataset - big points",data:[65,59,80,81,56,55,40],fill:!1,borderDash:[5,5],pointRadius:15,pointHoverRadius:10,backgroundColor:"#FFF",borderColor:"#673AB7",pointBorderColor:"#673AB7",pointBackgroundColor:"#FFF"},{label:"dataset - individual point sizes",data:[28,48,40,19,86,27,90],fill:!1,borderDash:[5,5],pointRadius:[2,4,6,18,0,12,20],backgroundColor:"#FFF",borderColor:"#00BCD4",pointBorderColor:"#00BCD4",pointBackgroundColor:"#FFF"},{label:"dataset - large pointHoverRadius",data:[45,25,16,36,67,18,76],fill:!1,pointHoverRadius:30,backgroundColor:"#FFF",borderColor:"#FF5722",pointBorderColor:"#FF5722",pointBackgroundColor:"#FFF",pointRadius:5}]},d={type:"line",options:b,data:c};new Chart(a,d)});