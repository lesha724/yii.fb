$(document).ready(function(){

    initChosen();

    initSpinner('spinner1');

    $spinner1 = $('#spinner1');

    initFilterForm($spinner1);

    if ($('#chart1'). length > 0)
        initJqPlot(line1, line2, tt, dateStart, dateEnd)

});
function initJqPlot(line1, line2, tt, dateStart, dateEnd)
{
    var plot1 = $.jqplot('chart1', [line1, line2], {
        title: tt.chartTitle,
        axes:{
            xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickOptions:{
                    formatString:'%d<br/>%m'
                },
                min:dateStart, max:dateEnd,
                tickInterval: '1 day'
            },
            yaxis:{
                tickOptions:{
                    formatString:'%d абит.'
                },
                min:0,
                pad:1.1
            }
        },
        highlighter: {
            show: true,
            sizeAdjust: 7.5
        },
        cursor: {
            show: false
        },
        series: [
            { color:"#4bb2c5",label:tt.label1},
            { color:"#EAA228",label:tt.label2}
        ],
        legend: {
            show: true,
            location: "ne",
            xoffset: 12,
            yoffset: 12
        }

    });


}