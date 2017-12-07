/* ==========================================================
 * AdminKIT v2.0
 * charts.helper.js
 * 
 * http://www.mosaicpro.biz
 * Copyright MosaicPro
 *
 * Built exclusively for sale @Envato Marketplaces
 * ========================================================== */ 

var charts =
{
	// init charts on Charts page
	initCharts: function()
	{
		// init lines chart with fill & without points
		this.chart_lines_fill_nopoints.init();

	},
    // utility class
    utility:
    {
        chartColors: [ themerPrimaryColor, "#444", "#777", "#999", "#DDD", "#EEE" ],
        chartBackgroundColors: ["#fff", "#fff"],

        applyStyle: function(that)
        {
            that.options.colors = charts.utility.chartColors;
            that.options.grid.backgroundColor = { colors: charts.utility.chartBackgroundColors };
            that.options.grid.borderColor = charts.utility.chartColors[0];
            that.options.grid.color = charts.utility.chartColors[0];
        },

        // generate random number for charts
        randNum: function()
        {
            return (Math.floor( Math.random()* (1+40-20) ) ) + 20;
        }
    },

	chart_lines_fill_nopoints:
	{
		// chart data
		//data:
		//{
		//	d1: chartNopointsData
		//},

		// will hold the chart object
		plot: null,

		// chart options
		options: 
		{
			grid: {
				show: true,
			    aboveData: true,
			    color: "#3f3f3f",
			    labelMargin: 5,
			    axisMargin: 0, 
			    borderWidth: 0,
			    borderColor:null,
			    minBorderMargin: 5 ,
			    clickable: true, 
			    hoverable: true,
			    autoHighlight: true,
			    mouseActiveRadius: 20,
			    backgroundColor : { }
			},
	        series: {
	        	grow: {active:false},
	            lines: {
            		show: true,
            		fill: true,
            		lineWidth: 2,
            		steps: false
            	},
	            points: {show:false}
	        },
	        legend: { position: "nw" },
	        yaxis: { min: 0 },
	        xaxis: {ticks:11, tickDecimals: 0},
	        colors: [],
	        shadowSize:1,
	        tooltip: true,
			tooltipOpts: {
				content: "%s : %y.0",
				shifts: {
					x: -30,
					y: -50
				},
				defaultTheme: false
			}
		},

		// initialize
		init: function()
		{
			// apply styling
			charts.utility.applyStyle(this);
			
			// generate some data
			//this.data.d1 = [[1, 3+charts.utility.randNum()], [2, 6+charts.utility.randNum()], [3, 9+charts.utility.randNum()], [4, 12+charts.utility.randNum()],[5, 15+charts.utility.randNum()],[6, 18+charts.utility.randNum()],[7, 21+charts.utility.randNum()],[8, 15+charts.utility.randNum()],[9, 18+charts.utility.randNum()],[10, 21+charts.utility.randNum()],[11, 24+charts.utility.randNum()],[12, 27+charts.utility.randNum()],[13, 30+charts.utility.randNum()],[14, 33+charts.utility.randNum()],[15, 24+charts.utility.randNum()],[16, 27+charts.utility.randNum()],[17, 30+charts.utility.randNum()],[18, 33+charts.utility.randNum()],[19, 36+charts.utility.randNum()],[20, 39+charts.utility.randNum()],[21, 42+charts.utility.randNum()],[22, 45+charts.utility.randNum()],[23, 36+charts.utility.randNum()],[24, 39+charts.utility.randNum()],[25, 42+charts.utility.randNum()],[26, 45+charts.utility.randNum()],[27,38+charts.utility.randNum()],[28, 51+charts.utility.randNum()],[29, 55+charts.utility.randNum()], [30, 60+charts.utility.randNum()]];
			//this.data.d2 = [[1, charts.utility.randNum()-5], [2, charts.utility.randNum()-4], [3, charts.utility.randNum()-4], [4, charts.utility.randNum()],[5, 4+charts.utility.randNum()],[6, 4+charts.utility.randNum()],[7, 5+charts.utility.randNum()],[8, 5+charts.utility.randNum()],[9, 6+charts.utility.randNum()],[10, 6+charts.utility.randNum()],[11, 6+charts.utility.randNum()],[12, 2+charts.utility.randNum()],[13, 3+charts.utility.randNum()],[14, 4+charts.utility.randNum()],[15, 4+charts.utility.randNum()],[16, 4+charts.utility.randNum()],[17, 5+charts.utility.randNum()],[18, 5+charts.utility.randNum()],[19, 2+charts.utility.randNum()],[20, 2+charts.utility.randNum()],[21, 3+charts.utility.randNum()],[22, 3+charts.utility.randNum()],[23, 3+charts.utility.randNum()],[24, 2+charts.utility.randNum()],[25, 4+charts.utility.randNum()],[26, 4+charts.utility.randNum()],[27,5+charts.utility.randNum()],[28, 2+charts.utility.randNum()],[29, 2+charts.utility.randNum()], [30, 3+charts.utility.randNum()]];
			
			// make chart
			this.plot = $.plot(
				'#chart_lines_fill_nopoints', 
				[{
         			label: "Visits", 
         			data: chartNopointsData,
         			lines: {fillColor: "#fff8f2"},
         			points: {fillColor: "#88bbc8"}
         		}, 
         		//{
         		//	label: "Unique Visits",
         		//	data: this.data.d2,
         		//	lines: {fillColor: "rgba(0,0,0,0.1)"},
         		//	points: {fillColor: "#ed7a53"}
         		//}
         		],
         		this.options);
		}
	},

};