    <script>
        var gline1=[];
        var bline1=[];
        var gSDneg1=[];
        var gSDneg2=[];
        var gSD0=[];
        var gSD1=[];
        var gSD2=[];
        var gjenisKelamin = '{{$balita->jenis_kelamin}}';  

            count = 0;
            @foreach($penimbangan as $data)
                gline1['{{$data->umur}}'] = ['{{$data->umur}}', '{{$data->berat}}'];
                bline1['{{$data->umur}}'] = ['{{$data->umur}}', '{{$data->tinggi}}'];
            @endforeach
            if(gjenisKelamin==='L') {
            gSDneg1=[
            [0,2.9],[1,3.9],[2,4.9],[3,5.7],[4,6.2],[5,6.7],[6,7.1],[7,7.4],[8,7.7],[9,8.0],[10,8.2],[11,8.4],[12,8.6],
            [13,8.8],[14,9.0],[15,9.2],[16,9.4],[17,9.6],[18,9.8],[19,10.0],[20,10.1],[21,10.3],[22,10.5],[23,10.7],[24,10.8],
            [25,11.0],[26,11.2],[27,11.3],[28,11.5],[29,11.7],[30,11.8],[31,12.0],[32,12.1],[33,12.3],[34,12.4],[35,12.6],[36,12.7],
            [37,12.9],[38,13.0],[39,13.1],[40,13.3],[41,13.4],[42,13.6],[43,13.7],[44,13.8],[45,14.0],[46,14.1],[47,14.3],[48,14.4],
            [49,14.5],[50,14.7],[51,14.8],[52,15.0],[53,15.1],[54,15.2],[55,15.4],[56,15.5],[57,15.6],[58,15.8],[59,15.9],[60,16.0]
            ];
            gSDneg2=[
            [0,2.5],[1,3.4],[2,4.3],[3,5.0],[4,5.6],[5,6.0],[6,6.4],[7,6.7],[8,6.9],[9,7.1],[10,7.4],[11,7.6],[12,7.7],
            [13,7.9],[14,8.1],[15,8.3],[16,8.4],[17,8.6],[18,8.8],[19,8.9],[20,9.1],[21,9.2],[22,9.4],[23,9.5],[24,9.7],
            [25,9.8],[26,10.0],[27,10.1],[28,10.2],[29,10.4],[30,10.5],[31,10.7],[32,10.8],[33,10.9],[34,11.0],[35,11.2],[36,11.3],
            [37,11.4],[38,11.5],[39,11.6],[40,11.8],[41,11.9],[42,12.0],[43,12.1],[44,12.2],[45,12.4],[46,12.5],[47,12.6],[48,12.7],
            [49,12.8],[50,12.9],[51,13.1],[52,13.2],[53,13.3],[54,13.4],[55,13.5],[56,13.6],[57,13.7],[58,13.8],[59,14.0],[60,14.1]
            ];
            gSD0=[
            [0,3.3],[1,4.5],[2,5.6],[3,6.4],[4,7.0],[5,7.5],[6,7.9],[7,8.3],[8,8.6],[9,8.9],[10,9.2],[11,9.4],[12,9.6],
            [13,9.9],[14,10.1],[15,10.3],[16,10.5],[17,10.7],[18,10.9],[19,11.1],[20,11.3],[21,11.5],[22,11.8],[23,12.0],[24,12.2],
            [25,12.4],[26,12.5],[27,12.7],[28,12.9],[29,13.1],[30,13.3],[31,13.5],[32,13.7],[33,13.8],[34,14.0],[35,14.2],[36,14.3],
            [37,14.5],[38,14.7],[39,14.8],[40,15.0],[41,15.2],[42,15.3],[43,15.5],[44,15.7],[45,15.8],[46,16.0],[47,16.2],[48,16.3],
            [49,16.5],[50,16.7],[51,16.8],[52,17.0],[53,17.2],[54,17.3],[55,17.5],[56,17.7],[57,17.8],[58,18.0],[59,18.2],[60,18.3]
            ];
            gSD1=[
            [0,3.9],[1,5.1],[2,6.3],[3,7.2],[4,7.8],[5,8.4],[6,8.8],[7,9.2],[8,9.6],[9,9.9],[10,10.2],[11,10.5],[12,10.8],
            [13,11.0],[14,11.3],[15,11.5],[16,11.7],[17,12.0],[18,12.2],[19,12.5],[20,12.7],[21,12.9],[22,13.2],[23,13.4],[24,13.6],
            [25,13.9],[26,14.1],[27,14.3],[28,14.5],[29,14.8],[30,15.0],[31,15.2],[32,15.4],[33,15.6],[34,15.8],[35,16.0],[36,16.2],
            [37,16.4],[38,16.6],[39,16.8],[40,17.0],[41,17.2],[42,17.4],[43,17.6],[44,17.8],[45,18.0],[46,18.2],[47,18.4],[48,18.6],
            [49,18.8],[50,19.0],[51,19.2],[52,19.4],[53,19.6],[54,19.8],[55,20.0],[56,20.2],[57,20.4],[58,20.6],[59,20.8],[60,21.0]
            ];
            gSD2=[
            [0,4.4],[1,5.8],[2,7.1],[3,8.0],[4,8.7],[5,9.3],[6,9.8],[7,10.3],[8,10.7],[9,11.0],[10,11.4],[11,11.7],[12,12.0],
            [13,12.3],[14,12.6],[15,12.8],[16,13.1],[17,13.4],[18,13.7],[19,13.9],[20,14.2],[21,14.5],[22,14.7],[23,15.0],[24,15.3],
            [25,15.5],[26,15.8],[27,16.1],[28,16.3],[29,16.6],[30,16.9],[31,17.1],[32,17.4],[33,17.6],[34,17.8],[35,18.1],[36,18.3],
            [37,18.6],[38,18.8],[39,19.0],[40,19.3],[41,19.5],[42,19.7],[43,20.0],[44,20.2],[45,20.5],[46,20.7],[47,20.9],[48,21.2],
            [49,21.4],[50,21.7],[51,21.9],[52,22.2],[53,22.4],[54,22.7],[55,22.9],[56,23.2],[57,23.4],[58,23.7],[59,23.9],[60,24.2]
            ];
        } else if(gjenisKelamin==='P') {
            gSDneg1=[
            [0,2.8],[1,3.6],[2,4.5],[3,5.2],[4,5.7],[5,6.1],[6,6.5],[7,6.8],[8,7.0],[9,7.3],[10,7.5],[11,7.7],[12,7.9],
            [13,8.1],[14,8.3],[15,8.5],[16,8.7],[17,8.9],[18,9.1],[19,9.2],[20,9.4],[21,9.6],[22,9.8],[23,10.0],[24,10.2],
            [25,10.3],[26,10.5],[27,10.7],[28,10.9],[29,11.1],[30,11.2],[31,11.4],[32,11.6],[33,11.7],[34,11.9],[35,12.0],[36,12.2],
            [37,12.4],[38,12.5],[39,12.7],[40,12.8],[41,13.0],[42,13.1],[43,13.3],[44,13.4],[45,13.6],[46,13.7],[47,13.9],[48,14.0],
            [49,14.2],[50,14.3],[51,14.5],[52,14.6],[53,14.8],[54,14.9],[55,15.1],[56,15.2],[57,15.3],[58,15.5],[59,15.6],[60,15.8]
            ];
            gSDneg2=[
            [0,2.4],[1,3.2],[2,3.9],[3,4.5],[4,5.0],[5,5.4],[6,5.7],[7,6.0],[8,6.3],[9,6.5],[10,6.7],[11,6.9],[12,7.0],
            [13,7.2],[14,7.4],[15,7.6],[16,7.7],[17,7.9],[18,8.1],[19,8.2],[20,8.4],[21,8.6],[22,8.7],[23,8.9],[24,9.0],
            [25,9.2],[26,9.4],[27,9.5],[28,9.7],[29,9.8],[30,10.0],[31,10.1],[32,10.3],[33,10.4],[34,10.5],[35,10.7],[36,10.8],
            [37,10.9],[38,11.1],[39,11.2],[40,11.3],[41,11.5],[42,11.6],[43,11.7],[44,11.8],[45,12.0],[46,12.1],[47,12.2],[48,12.3],
            [49,12.4],[50,12.6],[51,12.7],[52,12.8],[53,12.9],[54,13.0],[55,13.2],[56,13.3],[57,13.4],[58,13.5],[59,13.6],[60,13.7]
            ];
            gSD0=[
            [0,3.2],[1,4.2],[2,5.1],[3,5.8],[4,6.4],[5,6.9],[6,7.3],[7,7.6],[8,7.9],[9,8.2],[10,8.5],[11,8.7],[12,8.9],
            [13,9.2],[14,9.4],[15,9.6],[16,9.8],[17,10.0],[18,10.2],[19,10.4],[20,10.6],[21,10.9],[22,11.1],[23,11.3],[24,11.5],
            [25,11.7],[26,11.9],[27,12.1],[28,12.3],[29,12.5],[30,12.7],[31,12.9],[32,13.1],[33,13.3],[34,13.5],[35,13.7],[36,13.9],
            [37,14.0],[38,14.2],[39,14.4],[40,14.6],[41,14.8],[42,15.0],[43,15.2],[44,15.3],[45,15.5],[46,15.7],[47,15.9],[48,16.1],
            [49,16.3],[50,16.4],[51,16.6],[52,16.8],[53,17.0],[54,17.2],[55,17.3],[56,17.5],[57,17.7],[58,17.9],[59,18.0],[60,18.2]
            ];
            gSD1=[
            [0,3.7],[1,4.8],[2,5.8],[3,6.6],[4,7.3],[5,7.8],[6,8.2],[7,8.6],[8,9.0],[9,9.3],[10,9.6],[11,9.9],[12,10.1],
            [13,10.4],[14,10.6],[15,10.9],[16,11.1],[17,11.4],[18,11.6],[19,11.8],[20,12.1],[21,12.3],[22,12.5],[23,12.8],[24,13.0],
            [25,13.3],[26,13.5],[27,13.7],[28,14.0],[29,14.2],[30,14.4],[31,14.7],[32,14.9],[33,15.1],[34,15.4],[35,15.6],[36,15.8],
            [37,16.0],[38,16.3],[39,16.5],[40,16.7],[41,16.9],[42,17.2],[43,17.4],[44,17.6],[45,17.8],[46,18.1],[47,18.3],[48,18.5],
            [49,18.8],[50,19.0],[51,19.2],[52,19.4],[53,19.7],[54,19.9],[55,20.1],[56,20.3],[57,20.6],[58,20.8],[59,21.0],[60,21.2]
            ];
            gSD2=[
            [0,4.2],[1,5.5],[2,6.6],[3,7.5],[4,8.2],[5,8.8],[6,9.3],[7,9.8],[8,10.2],[9,10.5],[10,10.9],[11,11.2],[12,11.5],
            [13,11.8],[14,12.1],[15,12.4],[16,12.6],[17,12.9],[18,13.2],[19,13.5],[20,13.7],[21,14.0],[22,14.3],[23,14.6],[24,14.8],
            [25,15.1],[26,15.4],[27,15.7],[28,16.0],[29,16.2],[30,16.5],[31,16.8],[32,17.1],[33,17.3],[34,17.6],[35,17.9],[36,18.1],
            [37,18.4],[38,18.7],[39,19.0],[40,19.2],[41,19.5],[42,19.8],[43,20.1],[44,20.4],[45,20.7],[46,20.9],[47,21.2],[48,21.5],
            [49,21.8],[50,22.1],[51,22.4],[52,22.6],[53,22.9],[54,23.2],[55,23.5],[56,23.8],[57,24.1],[58,24.4],[59,24.6],[60,24.9]
            ];
        }

        // var options = {
        //     title: 'Grafik Berat Badan/Umur',
        //     series: {
        //         lines: {
        //             show: true
        //         },
        //         points: {
        //             show: true
        //         },
        //         showMarker:false
        //     },
        //     grid: {
        //         hoverable: true, //IMPORTANT! this is needed for tooltip to work
        //         shadow: false
        //     },
        //     axes: 
        //     {
        //         xaxis: 
        //         { label:'Umur (bln)', ticks:['0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60']},
        //         yaxis:
        //         { label:'Berat Badan (kg)', ticks:['0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30']} 
        //     },
        //     tooltip: true,
        //     tooltipOpts: {
        //         content: "Berat badan pada usia %x bulan adalah %y kg.",
        //         shifts: {
        //             x: -60,
        //             y: 25
        //         }
        //     }
        // };

        var options = {
            lines: { show: true },
            points: { show: true },
            xaxis: {
                show: true,
                tickSize: 2,
                axisLabel: "(umur dalam bulan)",
                axisLabelPadding: 20
            },
            yaxis: {
                show: true,
                tickSize: 2,
                axisLabel: "(berat dalam kg)",
                axisLabelPadding: 20,
            },
            grid: {
                hoverable: true, //IMPORTANT! this is needed for tooltip to work
                shadow: false
            },
            tooltip: true,
            tooltipOpts: {
                content: "Berat badan pada usia %x bulan adalah %y kg.",
                shifts: {
                    x: -60,
                    y: 25
                }
            }
        };

        $.plot($("#flot-line-chart"), [{
                data: gSDneg1,
                color: '#FFFFA3',
                points: { show: false },
            }, {
                data: gSDneg2,
                color: '#FF9999',
                points: { show: false },
            }, {
                data: gSD0,
                color: '#A3FF85',
                points: { show: false },
            }, {
                data: gSD1,
                color: '#FFFFA3',
                points: { show: false },
            }, {
                data: gSD2,
                color: '#FF9999',
                points: { show: false },
            }, {
                data: gline1,
                color: '#000066'
            }],
            options);

        var options2 = {
            lines: { show: true },
            points: { show: true },
            xaxis: {
                show: true,
                tickSize: 2,
                axisLabel: "(umur dalam bulan)",
                axisLabelPadding: 20,
            },
            yaxis: {
                show: true,
                tickSize: 10,
                tickDecimals: 0,
                axisLabel: "(tinggi dalam cm)",
                axisLabelPadding: 20,
            },
            grid: {
                hoverable: true, //IMPORTANT! this is needed for tooltip to work
                shadow: false
            },
            tooltip: true,
            tooltipOpts: {
                content: "Berat badan pada usia %x bulan adalah %y kg.",
                shifts: {
                    x: -60,
                    y: 25
                }
            }
        };
        $.plot($("#flot-line-chart2"), [{
                //dipakai untuk memperindah tampilan saja, tidak dipakai
                data: gSDneg1,
                color: '#FFFFA3',
                lines: {show:false},
                points: { show: false },
            },{
                data: bline1,
                color: '#000066'
            }],
            options2);

    </script>