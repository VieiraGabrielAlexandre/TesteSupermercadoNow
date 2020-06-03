function graficoPizza(id,args){
    graficoPizzaDuplo(id, args);
}

function graficoPizzaDuplo(id, args){
    $(document).on('chart.ec',function(event, ec, theme){

        var graph = ec.init(document.getElementById(id), theme);
        
        var colors = [];
        var captions = [];
        var valores = [];
        var series = [];

        $.each(args.graficos,function(i,e){
            colors = colors.concat(e.cores);

            $.each(e.valores,function(ii,ee){
                captions.push(ii);

                if(typeof valores[i] === "undefined")
                    valores[i] = [];

                valores[i].push( {value: ee, name: ii} );
            });
            // captions.push('');
        });

        if(args.graficos && args.graficos[0]){

            series.push({
                name: args.graficos[0].titulo,
                type: 'pie',
                selectedMode: 'single',
                radius: [0, '40%'],
                data: valores[0],
            });
            
        }

        if(args.graficos && args.graficos[1]){
            series.push({
                name: args.graficos[1].titulo,
                type: 'pie',
                radius: ['60%', '85%'],
                data: valores[1],
            });

            series[0].itemStyle = {
                normal: {
                    label: {
                        position: 'inner'
                    },
                    labelLine: {
                        show: false
                    }
                },
                emphasis: {
                    label: {
                        show: true
                    }
                }
            };

        }else{
            series[0].radius = [0, '70%'];
        }

        graph_options = {
            color: colors,
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },

            legend: {
                orient: 'vertical',
                x: 'left',
                data: captions
            },

            toolbox: {
                show: true,
                orient: 'vertical',
                feature: {
                    mark: {
                        show: false
                    },
                    dataView: {
                        show: false
                    },
                    magicType: {
                        show: true,
                        title: {
                            pie: 'Trocar para pizza',
                            funnel: 'Trocar para funil',
                        },
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                x: '25%',
                                y: '20%',
                                width: '50%',
                                height: '70%',
                                funnelAlign: 'left',
                                max: 1548
                            }
                        }
                    },
                    restore: {
                        show: false,
                        title: 'Resetar'
                    },
                    saveAsImage: {
                        show: true,
                        title: 'Ver imagem',
                        lang: ['Salvar']
                    }
                }
            },
            calculable: false,
            series: series
        };

        graph.setOption(graph_options);
        graph.on('click', function(params){
            if(args && args.graficos && args.graficos[params.seriesIndex] && args.graficos[params.seriesIndex].links && args.graficos[params.seriesIndex].links[params.name])
                window.open(args.graficos[params.seriesIndex].links[params.name], '_blank');
        });

        $(window).resize(function(){
            setTimeout(function (){
                graph.resize();
            }, 200);
        });
    });
}

function graficoLinhasCor(id,args){
    $(document).on('chart.ec',function(event, ec, theme){
        var graph = ec.init(document.getElementById(id), theme);
        
        var colors = []; // cores
        var captions = []; // nomes em cima do grafico/clicavel
        var sections = []; // nomes de baixo do grafico
        var series = []; // dados do grafico

        var series_default = {
            name: '',
            type: 'line',
            smooth: true,
            barGap:'0%',
            data: [],
            itemStyle: {
                normal: {
                    label: {
                        show: true,
                        textStyle: {
                            fontWeight: 500
                        }
                    }
                }
            },
            // markLine: {
            //     data: [{type: 'average', name: 'Média'}]
            // }
        }
        series_default.itemStyle = {normal: {areaStyle: {type: 'default'}}};

        $.each(args.graficos,function(i,e){
            colors = colors.concat(e.cores);
            
            var serie = jQuery.extend({}, series_default);
            var dados = [];

            serie.name = e.titulo;
            captions.push(e.titulo);

            $.each(e.valores,function(ii,ee){
                if(!i) sections.push(ii);
                dados.push(ee);
            });

            serie.data = dados;
            series[i] = serie;
        });

        graph_options = {
            color: colors,
            grid: {
                x: 30,
                x2: 70,
                y: 80,
                y2: 35,
                borderColor:'#fff',
                borderWidth: 0,
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: captions
            },
            toolbox: {
                show: false,
                orient: 'vertical',
                feature: {
                    dataZoom: {
                        show: true,
                        title: {
                            dataZoom: 'Zoom',
                            dataZoomReset: 'Resetar zoom'
                        }
                    },
                    magicType: {
                        show: true,
                        title: {
                            line: 'Trocar para linhas',
                            bar: 'Trocar para barras',
                        },
                        type: ['line', 'bar']
                    },
                    restore: {
                        show: true,
                        title: 'Resetar'
                    },
                    saveAsImage: {
                        show: true,
                        title: 'Ver imagem',
                        lang: ['Salvar']
                    }
                }
            },
            calculable: false,
            xAxis: [{
                type: 'category',
                data: sections,
                boundaryGap: false,
            }],
            yAxis: [{
                type: 'value',
            }],
            series: series
        };

        graph.setOption(graph_options);
        graph.on('click', function(params){
            if(args && args.graficos && args.graficos[params.seriesIndex] && args.graficos[params.seriesIndex].links && args.graficos[params.seriesIndex].links[params.name])
                window.open(args.graficos[params.seriesIndex].links[params.name], '_blank');
        });

        $(window).resize(function(){
            setTimeout(function (){
                graph.resize();
            }, 200);
        });
    });
}

function graficoLinhas(id,args){
    $(document).on('chart.ec',function(event, ec, theme){
        var graph = ec.init(document.getElementById(id), theme);
        
        var colors = []; // cores
        var captions = []; // nomes em cima do grafico/clicavel
        var sections = []; // nomes de baixo do grafico
        var series = []; // dados do grafico

        var series_default = {
            name: '',
            type: 'line',
            smooth: true,
            barGap:'0%',
            data: [],
            itemStyle: {
                normal: {
                    label: {
                        show: true,
                        textStyle: {
                            fontWeight: 500
                        }
                    }
                }
            },
            // markLine: {
            //     data: [{type: 'average', name: 'Média'}]
            // }
        }

        $.each(args.graficos,function(i,e){
            colors = colors.concat(e.cores);
            
            var serie = jQuery.extend({}, series_default);
            var dados = [];

            serie.name = e.titulo;
            captions.push(e.titulo);

            $.each(e.valores,function(ii,ee){
                if(!i) sections.push(ii);
                dados.push(ee);
            });

            serie.data = dados;
            series[i] = serie;
        });

        graph_options = {
            color: colors,
            grid: {
                x: 30,
                x2: 70,
                y: 80,
                y2: 35,
                borderColor:'#fff',
                borderWidth: 0,
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: captions
            },
            toolbox: {
                show: false,
                orient: 'vertical',
                feature: {
                    dataZoom: {
                        show: true,
                        title: {
                            dataZoom: 'Zoom',
                            dataZoomReset: 'Resetar zoom'
                        }
                    },
                    magicType: {
                        show: true,
                        title: {
                            line: 'Trocar para linhas',
                            bar: 'Trocar para barras',
                        },
                        type: ['line', 'bar']
                    },
                    restore: {
                        show: true,
                        title: 'Resetar'
                    },
                    saveAsImage: {
                        show: true,
                        title: 'Ver imagem',
                        lang: ['Salvar']
                    }
                }
            },
            calculable: false,
            xAxis: [{
                type: 'category',
                data: sections,
                boundaryGap: false,
            }],
            yAxis: [{
                type: 'value',
            }],
            series: series
        };

        graph.setOption(graph_options);
        graph.on('click', function(params){
            if(args && args.graficos && args.graficos[params.seriesIndex] && args.graficos[params.seriesIndex].links && args.graficos[params.seriesIndex].links[params.name])
                window.open(args.graficos[params.seriesIndex].links[params.name], '_blank');
        });

        $(window).resize(function(){
            setTimeout(function (){
                graph.resize();
            }, 200);
        });
    });
}

function graficoBarras(id, args){ // cor só é usado com line

    $(document).on('chart.ec',function(event, ec, theme){
        var graph = ec.init(document.getElementById(id), theme);
        
        var colors = []; // cores
        var captions = []; // nomes em cima do grafico/clicavel
        var sections = []; // nomes de baixo do grafico
        var series = []; // dados do grafico

        var series_default = {
            name: '',
            type: 'bar',
            smooth: true,
            barGap:'0%',
            data: [],
            itemStyle: {
                normal: {
                    label: {
                        show: true,
                        textStyle: {
                            fontWeight: 500
                        }
                    }
                }
            },
            // markLine: {
            //     data: [{type: 'average', name: 'Média'}]
            // }
        }

        $.each(args.graficos,function(i,e){
            colors = colors.concat(e.cores);
            
            var serie = jQuery.extend({}, series_default);
            var dados = [];

            serie.name = e.titulo;
            captions.push(e.titulo);

            $.each(e.valores,function(ii,ee){
                if(!i) sections.push(ii);
                dados.push(ee);
            });

            serie.data = dados;
            series[i] = serie;
        });

        graph_options = {
            color: colors,
            grid: {
                x: 30,
                x2: 70,
                y: 80,
                y2: 35,
                borderColor:'#fff',
                borderWidth: 0,
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: captions
            },
            toolbox: {
                show: false,
                orient: 'vertical',
                feature: {
                    dataZoom: {
                        show: true,
                        title: {
                            dataZoom: 'Zoom',
                            dataZoomReset: 'Resetar zoom'
                        }
                    },
                    magicType: {
                        show: true,
                        title: {
                            line: 'Trocar para linhas',
                            bar: 'Trocar para barras',
                        },
                        type: ['line', 'bar']
                    },
                    restore: {
                        show: true,
                        title: 'Resetar'
                    },
                    saveAsImage: {
                        show: true,
                        title: 'Ver imagem',
                        lang: ['Salvar']
                    }
                }
            },
            calculable: false,
            xAxis: [{
                type: 'category',
                data: sections,
                boundaryGap: true,
                axisLine:{
                    show:false,
                    lineStyle:{
                        type:'dashed'
                    }
                }
            }],
            yAxis: [{
                type: 'value',
                show: false
            }],
            series: series
        };

        graph.setOption(graph_options);
        graph.on('click', function(params){
            if(args && args.graficos && args.graficos[params.seriesIndex] && args.graficos[params.seriesIndex].links && args.graficos[params.seriesIndex].links[params.name])
                window.open(args.graficos[params.seriesIndex].links[params.name], '_blank');
        });

        $(window).resize(function(){
            setTimeout(function (){
                graph.resize();
            }, 200);
        });
    });
}

function graficoBarrasEmpilhado(id, args){

    $(document).on('chart.ec',function(event, ec, theme){
        var graph = ec.init(document.getElementById(id), theme);
        
        var colors = []; // cores
        var captions = []; // nomes em cima do grafico/clicavel
        var sections = []; // nomes de baixo do grafico
        var series = []; // dados do grafico

        var series_default = {
            name: '',
            type: 'bar',
            stack: 'Total',
            smooth: true,
            data: [],
            itemStyle: {
                normal: {
                    color: '#26a69a',
                    label: {
                        show: true,
                        position: 'insideRight'
                    }
                },
                emphasis: {
                    color: '#26a69a',
                    label: {
                        show: true
                    }
                }
            }

            // {
            //     name: 'Chrome',
            //     type: 'bar',
            //     stack: 'Total',
            //     itemStyle: {
            //         normal: {
            //             color: '#26a69a',
            //             label: {
            //                 show: true,
            //                 position: 'insideRight'
            //             }
            //         },
            //         emphasis: {
            //             color: '#26a69a',
            //             label: {
            //                 show: true
            //             }
            //         }
            //     },
            //     data:[820, 832, 901, 934, 1290, 1330, 1320]
            // }
        }
        $.each(args.graficos,function(i,e){
            // ARRUMAR CORES
            // console.log(i,e);
            // console.log(e.cores[i]);

            colors = colors.concat(e.cores);

            var serie = jQuery.extend({}, series_default);
            var dados = [];

            serie.name = e.titulo;
            captions.push(e.titulo);

            $.each(e.valores,function(ii,ee){
                if(!i) sections.push(ii);
                dados.push(ee);
            });

            serie.itemStyle.normal.color = e.cores[i];
            serie.itemStyle.emphasis.color = e.cores[i];
            serie.data = dados;
            series[i] = serie;
        });

        graph_options = {
            // Setup grid
            grid: {
                x: 275,
                x2: 25,
                y: 35,
                y2: 25
            },

            // Add tooltip
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },

            // Add legend
            legend: {
                data:captions
            },

            // Enable drag recalculate
            calculable: true,

            // Horizontal axis
            xAxis: [{
                type: 'value'
            }],

            // Vertical axis
            yAxis: [{
                type: 'category',
                data: sections
            }],

            // Add series
            series: series
        };


        graph.setOption(graph_options);
        graph.on('click', function(params){
            if(args && args.graficos && args.graficos[params.seriesIndex] && args.graficos[params.seriesIndex].links && args.graficos[params.seriesIndex].links[params.name])
                window.open(args.graficos[params.seriesIndex].links[params.name], '_blank');
        });

        $(window).resize(function(){
            setTimeout(function (){
                graph.resize();
            }, 200);
        });
    });
}

function graficoBarrasEmpilhadoMulti(id, args){

    $(document).on('chart.ec',function(event, ec, theme){
        var graph = ec.init(document.getElementById(id), theme);
        
        var colors = []; // cores
        var captions = []; // nomes em cima do grafico/clicavel
        var sections = []; // nomes de baixo do grafico
        var series = []; // dados do grafico

        var series_default = {
            name: '',
            type: 'bar',
            stack: 'Total',
            smooth: true,
            data: [],
            itemStyle: {
                normal: {
                    color: '',
                    label: {
                        show: true,
                        position: 'insideRight'
                    }
                },
                emphasis: {
                    color: '',
                    label: {
                        show: true
                    }
                }
            }
        }

        var selections = {};
        // var dados = {};
        $.each(args.graficos,function(i,e){

            colors = colors.concat(e.cores);

            var dados = [];

            $.each(e.titulo,function(ii,ee){
                captions.push(ee);
            });

            var i=0;
            $.each(e.valores,function(ii,ee){
                selections[ii] = i;
                i++;
            });

            var index = 0;    
            $.each(e.valores,function(ii,ee){
                $.each(ee,function(title,value){

                    if(!dados[title])
                        dados[title] = [];

                    dados[title].push(value);

                });

                index++;

            });

            dados_final = [];
            $.each(e.titulo, function(ii,ee){
                dados_final.push(dados[ee]);                   
    
            });
            $.each(e.valores,function(ii,ee){
                $.each(e.titulo, function(titleId,titleValue){
                    var serie = jQuery.extend({}, series_default);
                    dados_final.push(dados[titleValue]);                   
                    serie.name = titleValue;
                    serie.data = dados_final[titleId];
                    series[titleId] = serie;
                });
              
            });

        });

        var _selections = [];
        $.each(selections,function(i,e){
            _selections.push(i);
        });

        graph_options = {
            // Setup grid
            grid: {
                x: 275,
                x2: 25,
                y: 35,
                y2: 25
            },

            // Add tooltip
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },

            // Add legend
            legend: {
                data:captions
            },

            // Enable drag recalculate
            calculable: true,

            // Horizontal axis
            xAxis: [{
                type: 'value'
            }],

            // Vertical axis
            yAxis: [{
                type: 'category',
                data: _selections
            }],

            // Add series
            series: series
        };

        graph.setOption(graph_options);
        graph.on('click', function(params){
            if(args && args.graficos && args.graficos[params.seriesIndex] && args.graficos[params.seriesIndex].links && args.graficos[params.seriesIndex].links[params.name])
                window.open(args.graficos[params.seriesIndex].links[params.name], '_blank');
        });

        $(window).resize(function(){
            setTimeout(function (){
                graph.resize();
            }, 200);
        });

    });
}

// Chart setup
function campaignDonut(element, size, parts) {

    // Basic setup
    // ------------------------------

    // Add data set
    var data = [
        {
            "browser": "Google Adwords",
            "icon": "<i class='icon-google position-left'></i>",
            "value": 60,
            "color" : "#2ec7c9"
        }, {
            "browser": "Social media",
            "icon": "<i class='icon-share4 position-left'></i>",
            "value": 10,
            "color": "#b6a2de"
        }
    ];

    var colors = [
        '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
        '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
        '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
        '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
    ];

    parts = typeof parts == "undefined" ? 2: parts;
    var data = [];
    for(i=1; i<=parts; i++){
        data.push( {value: Math.floor(Math.random() * 20) + 1 , color: colors[Math.floor(Math.random() * 19) + 0]} );
    }


    // Main variables
    var d3Container = d3.select(element),
        distance = 2, // reserve 2px space for mouseover arc moving
        radius = (size/2) - distance,
        sum = d3.sum(data, function(d) { return d.value; })



    // Tooltip
    // ------------------------------

    var tip = d3.tip()
        .attr('class', 'd3-tip')
        .offset([-10, 0])
        .direction('e')
        .html(function (d) {
            return "<ul class='list-unstyled mb-5'>" +
                "<li>" + "<div class='text-size-base mb-5 mt-5'>" + d.data.icon + d.data.browser + "</div>" + "</li>" +
                "<li>" + "Visits: &nbsp;" + "<span class='text-semibold pull-right'>" + d.value + "</span>" + "</li>" +
                "<li>" + "Share: &nbsp;" + "<span class='text-semibold pull-right'>" + (100 / (sum / d.value)).toFixed(2) + "%" + "</span>" + "</li>" +
            "</ul>";
        })



    // Create chart
    // ------------------------------

    // Add svg element
    var container = d3Container.append("svg");//.call(tip);
    
    // Add SVG group
    var svg = container
        .attr("width", size)
        .attr("height", size)
        .append("g")
            .attr("transform", "translate(" + (size / 2) + "," + (size / 2) + ")");  



    // Construct chart layout
    // ------------------------------

    // Pie
    var pie = d3.layout.pie()
        .sort(null)
        .startAngle(Math.PI)
        .endAngle(3 * Math.PI)
        .value(function (d) { 
            return d.value;
        }); 

    // Arc
    var arc = d3.svg.arc()
        .outerRadius(radius)
        .innerRadius(radius / 2);



    //
    // Append chart elements
    //

    // Group chart elements
    var arcGroup = svg.selectAll(".d3-arc")
        .data(pie(data))
        .enter()
        .append("g") 
            .attr("class", "d3-arc")
            .style('stroke', '#fff')
            .style('cursor', 'pointer');
    
    // Append path
    var arcPath = arcGroup
        .append("path")
        .style("fill", function (d) { return d.data.color; });

    // Add tooltip
    arcPath
        .on('mouseover', function (d, i) {

            // Transition on mouseover
            d3.select(this)
            .transition()
                .duration(500)
                .ease('elastic')
                .attr('transform', function (d) {
                    d.midAngle = ((d.endAngle - d.startAngle) / 2) + d.startAngle;
                    var x = Math.sin(d.midAngle) * distance;
                    var y = -Math.cos(d.midAngle) * distance;
                    return 'translate(' + x + ',' + y + ')';
                });
        })

        .on("mousemove", function (d) {
            
            // Show tooltip on mousemove
            tip.show(d)
                .style("top", (d3.event.pageY - 40) + "px")
                .style("left", (d3.event.pageX + 30) + "px");
        })

        .on('mouseout', function (d, i) {

            // Mouseout transition
            d3.select(this)
            .transition()
                .duration(500)
                .ease('bounce')
                .attr('transform', 'translate(0,0)');

            // Hide tooltip
            tip.hide(d);
        });

    // Animate chart on load
    arcPath
        .transition()
            .delay(function(d, i) { return i * 500; })
            .duration(500)
            .attrTween("d", function(d) {
                var interpolate = d3.interpolate(d.startAngle,d.endAngle);
                return function(t) {
                    d.endAngle = interpolate(t);
                    return arc(d);  
                }; 
            });
}

function graficoArvore(id, args){

    var element = '#'+id;
    var height = 1400;

    // Basic setup
    // ------------------------------

    // Define main variables
    var d3Container = d3.select(element),
        margin = {top: 10, right: 100, bottom: 10, left: 160},
        width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
        height = height - margin.top - margin.bottom - 5;



    // Create chart
    // ------------------------------

    // Add SVG element
    var container = d3Container.append("svg");

    // Add SVG group
    var svg = container
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");



    // Construct chart layout
    // ------------------------------

    // Tree
    var tree = d3.layout.tree()
        .size([height, width - 180]);

    // Diagonal projection
    var diagonal = d3.svg.diagonal()
        .projection(function(d) { return [d.y, d.x]; });



    // Load data
    // ------------------------------
    var json = args

    var nodes = tree.nodes(json),
        links = tree.links(nodes);


    // Links
    // ------------------------------

    // Append link group
    var linkGroup = svg.append("g")
        .attr("class", "d3-tree-link-group");

    // Append link path
    var link = linkGroup.selectAll(".d3-tree-link")
        .data(links)
        .enter()
        .append("path")
            .attr("class", "d3-tree-link")
            .attr("d", diagonal)
            .style("fill", "none")
            .style("stroke", "#ddd")
            .style("stroke-width", 1.5);


    // Nodes
    // ------------------------------

    // Append node group
    var nodeGroup = svg.append("g")
        .attr("class", "d3-tree-node-group");

    // Append node
    var node = nodeGroup.selectAll(".d3-tree-node")
        .data(nodes)
        .enter()
        .append("g")
            .attr("class", "d3-tree-node")
            .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });


    // Append node circles
    node.append("circle")
        .attr("r", 4.5)
        .attr("class", "d3-tree-circle")
        .style("stroke", "#000")
        .style("stroke-width", 0.5)
        .attr("fill", function(d) { return d.color?d.color:'#FFF'; })
        .style("cursor", function(d){return d.url?'pointer':'default' })
    ;

    // Append node text
    node.append("text")
        .attr("dx", function(d) { return d.children ? -12 : 12; })
        .attr("dy", 4)
        .style("text-anchor", function(d) { return d.children ? "end" : "start"; })
        .style("font-size", 12)
        .text(function(d){ return d.name; })
        .style("cursor", function(d){return d.url?'pointer':'default' })
    ;

    node.on('click',function(args){
        if(args.url)
            window.open(args.url, '_blank');
    });



    // Resize chart
    // ------------------------------

    // Call function on window resize
    $(window).on('resize', resize);

    // Call function on sidebar width change
    $('.sidebar-control').on('click', resize);


    // Resize function
    // 
    // Since D3 doesn't support SVG resize by default,
    // we need to manually specify parts of the graph that need to 
    // be updated on window resize
    function resize() {

        // Layout variables
        width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
        nodes = tree.nodes(json),
        links = tree.links(nodes);

        // Layout
        // -------------------------

        // Main svg width
        container.attr("width", width + margin.left + margin.right);

        // Width of appended group
        svg.attr("width", width + margin.left + margin.right);


        // Tree size
        tree.size([height, width - 180]);


        // Chart elements
        // -------------------------

        // Link paths
        svg.selectAll(".d3-tree-link").attr("d", diagonal)

        // Node paths
        svg.selectAll(".d3-tree-node").attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });
    }

}