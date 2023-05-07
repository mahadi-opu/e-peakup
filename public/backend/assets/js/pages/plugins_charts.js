$(function() {
   altair_charts.chartist_charts()
}), altair_charts = {
    chartist_charts: function() {
        var t = new Chartist.Line("#chartist_line_area", {
            labels: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ],
            series: [
                [5, 9, 7, 8, 5, 3, 5, 4]
            ]
        }, {
            low: 0,
            showArea: !0
        });
    }
};