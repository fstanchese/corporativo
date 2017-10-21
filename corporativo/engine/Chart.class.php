<?php 
	class Chart 
	{
	
		
		
		public function __construct()
		{
			
			echo "<script type='text/javascript' src='../js/highchart/highcharts.js'></script>\n";
			
			
			
		}
		
		//usado no Column Chart e Line Chart
		private function ConvertToString($arData)
		{
			
			return "['".implode("', '",$arData)."']";
			
		}
		
		
		//usado no Column Chart e Line Chart
		private function ConvertArDataToString($arData)
		{
			
			
			foreach($arData as $name => $arrayValue)
			{
				
				$aux[] =  " { name: '".$name."', data: [".implode("', '",$arrayValue)." ] }";
				
			}
			
			return implode(", ",$aux); 
			
		}
		
		
		//usado no PIE CHART
		private function ConvertArrayAndKeysToString($arData)
		{
			
			foreach($arData as $key => $value)
			{
				
				$aux[] = "[ '".$key."', ".$value." ] ";
				
			}
			
			return implode(", ",$aux);
			
			
		}
		
		
		
	
		
		public function LineChart($element,$categories,$data,$param="")
		{
			
			
			
			echo "
			<script type='text/javascript'>
			$(function () {
					
				$('".$element."').highcharts({ 
					chart: { type: 'line',	marginRight: 130,	marginBottom: 25 },
					title: { text: '".$param[titulo]."', x: -20  },
					subtitle: {	text: '".$param[subtitulo]."', x: -20 },
					xAxis: {	categories: ".$this->ConvertToString($categories)."},
					yAxis: {	title: {	text: '".$param[eixoY]."'	},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					tooltip: {	valueSuffix: ' ".$param[sufixo]."' },
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: -10,
						y: 100,
						borderWidth: 0
					},
					series: [".$this->ConvertArDataToString($data)."]
				});
			});
			
			
				</script>";
			
			
			
			
		}
		
		public function PieChart($element,$data,$param="")
		{
			
			
			if($param[mostraLegenda] == "" || $param[mostraLegenda] == 0)	$param[mostraLegenda] = 'false'; else $param[mostraLegenda] = 'true';
			
			
			
			
			if($param[height] !="") $param[height] = "height: ".$param[height];
			
			echo "
					<script type='text/javascript'>
						$(function () {
					
										
							$('".$element."').highcharts({
								chart: {
									plotBackgroundColor: null,
									plotBorderWidth: null,
									plotShadow: false,
									".$param[height]."
									
								},
								title: {
									text: '".$param[titulo]."'
								},
								subtitle: {
				                	text: '".$param[subtitulo]."'
								},				               
								legend: { enabled: true },
								tooltip: {
									formatter: function() {
					                    var s;
					                    if (this.point.name) { // the pie chart
					                        s = ''+
					                            this.point.name +':  ".$param[prefixo]." ' + this.y +' ".$param[sufixo]."';
					                    } else {
					                        s = ''+
					                            this.x  +': '+ this.y;
					                    }
					                    return s;
					                }
								},
								plotOptions: {
									pie: {
										allowPointSelect: true,
										cursor: 'pointer',
					                    showInLegend: 1,
										dataLabels: {
											enabled: true,
											color: '#000000',
											connectorColor: '#000000',
											formatter: function() {
												return  this.percentage.toFixed(2) +' %';
											}
										}
									}
								},
								series: [{
									type: 'pie',
									name: '".$param[subtitulo]."',
									data: [".$this->ConvertArrayAndKeysToString($data)."]
								}]
							});
						});
						</script>";
			
		}
		
		
		public function ColumnChart($element,$categories,$data,$param="")
		{
			
			echo "
					<script>
					$(function () {
					
						
				        $('".$element."').highcharts({
				            chart: {
				                type: 'column'
				            },
				            title: {
				                text: '".$param[titulo]."'
				            },
				            subtitle: {
				                text: '".$param[subtitulo]."'
				            },
				            legend: { enabled: ".$param[mostraLegenda]." },
				            xAxis: {
				                categories: ".$this->ConvertToString($categories)."
				            },
				            yAxis: {
				                min: 0,
				                title: {
				                    text: '".$param[eixoY]."'
				                }
				            },
				            tooltip: {
				                headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
				                pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
				                    '<td style=\"padding:0\"><b>".$param[prefixo]." {point.y:.1f} ".$param[sufixo]." </b></td></tr>',
				                footerFormat: '</table>',
				                shared: true,
				                useHTML: true
				            },
				            plotOptions: {
				                column: {
				                    pointPadding: 0.2,
				                    borderWidth: 0
				                }
				            },
				           series: [".$this->ConvertArDataToString($data)."]
				        });
				    });
				           		</script>
					
					";
			
		}
		
		
		public function BarChart($element,$categories,$data,$param="")
		{
				
			echo "
					<script>
					$(function () {
			
		
				        $('".$element."').highcharts({
				            chart: {
				                type: 'bar'
				            },
				            title: {
				                text: '".$param[titulo]."'
				            },
				            subtitle: {
				                text: '".$param[subtitulo]."'
				            },
				            legend: { enabled: ".$param[mostraLegenda]." },
				            xAxis: {
				                categories: ".$this->ConvertToString($categories)."
				            },
				            yAxis: {
				                min: 0,
				                title: {
				                    text: '".$param[eixoY]."'
				                }
				            },
				            tooltip: {
				                headerFormat: '<span style=\"font-size:12px\">{point.key}</span><table>',
				                pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
				                    '<td style=\"padding:0\"><b>".$param[prefixo]." {point.y} ".$param[sufixo]." </b></td></tr>',
				                footerFormat: '</table>',
				                shared: true,
				                useHTML: true
				            },
				            plotOptions: {
				                column: {
				                    pointPadding: 0.2,
				                    borderWidth: 0
				                }
				            },
				           series: [".$this->ConvertArDataToString($data)."]
				        });
				    });
				           		</script>
			
					";
				
		}
		
		public function DynamicChart($element,$categories,$data,$param="")
		{
			$param[update] = 10000;
			echo "
					<script>
					
					$(function () {
					    $(document).ready(function() {
					        Highcharts.setOptions({
					            global: {
					                useUTC: false
					            }
					        });
					    
					        var chart;
					        $('".$element."').highcharts({
					            chart: {
					                type: 'spline',
					                animation: Highcharts.svg, // don't animate in old IE
					                marginRight: 10,
					                events: {
					                    load: function() {
					    
					                        // set up the updating of the chart each second
					                        var series = this.series[0];
					                        setInterval(function() {
					                            var x = (new Date()).getTime(), // current time
					                                y = Math.random()+10;
					                            series.addPoint([x, y], true, true);
					                        }, 1000);
					                    }
					                }
					            },
					            title: {
					                text: 'Live random data'
					            },
					            xAxis: {
					                type: 'datetime',
					                tickPixelInterval: 150
					            },
					            yAxis: {
					                title: {
					                    text: 'Value'
					                },
					                plotLines: [{
					                    value: 0,
					                    width: 1,
					                    color: '#808080'
					                }]
					            },
					            tooltip: {
					                formatter: function() {
					                        return '<b>'+ this.series.name +'</b><br/>'+
					                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
					                        Highcharts.numberFormat(this.y, 2);
					                }
					            },
					            legend: {
					                enabled: true
					            },
					            exporting: {
					                enabled: false
					            },
					            series: [{
					                name: 'dasdsadsadsadas',
					                data: (function() {
					                    // generate an array of random data
					                    var data = [],
					                        time = (new Date()).getTime(),
					                        i;
					    
					                    for (i = -19; i <= 0; i++) {
					                        data.push({
					                            x: time + i * 1000,
					                            y: Math.random()
					                        });
					                    }
					        			
					                    return data;
					                })()
					            }]
					        });
					    });
					    
					});
					
					</script>
					
					";
			
			
		}
	
	}
	
?>