@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Year</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" onchange="display()" id="sel-year">
                                        @for($i = 2019; $i <= date("Y"); $i++)
                                            @if(date("Y") == $i)
                                                <option selected>{{$i}}</option>
                                            @else
                                                <option>{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                             
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Month</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" onchange="display()" id="sel-month">
                                        @for($i = 1; $i <= 12; $i++)
                                            @if(date("m") == $i)
                                                <option selected>{{$i}}</option>
                                            @else
                                                <option>{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                             
                        </div>
                        
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="card">
            <div class="card-body">
              <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

</div>
<script>
    let Approved_value = `<?php echo json_encode($Approved_value)?>`;
    Approved_value = JSON.parse(Approved_value);

    let Approved_vo = `<?php echo json_encode($Approved_vo)?>`;
    Approved_vo = JSON.parse(Approved_vo);

    let dt = new Date();
    let month = dt.getMonth();
    let year = dt.getFullYear();
    let daysInmonth = new Date(year,month,0).getDate();
    let MONTHS = [];
    for (let i = 0; i < daysInmonth; i++) {
        MONTHS.push("Day"+i);
    }

    function makechartdateApp(dataTo) {
        let res = [];
        for (let i = 0; i < daysInmonth; i++) {
            res.push(0);
        }
        for (let i = 0; i < dataTo.length; i++) {
            let day = dataTo[i]['approved_date'].split("-")[2] * 1;
            res[day] = (dataTo[i]['approved_amount'] * 1).toFixed(2);    
        }
        return res;
    }

    function makechartdateVo(dataTo) {
        let res = [];
        for (let i = 0; i < daysInmonth; i++) {
            res.push(0);
        }
        for (let i = 0; i < dataTo.length; i++) {
            let day = dataTo[i]['vo_date'].split("-")[2] * 1;
            res[day] = (dataTo[i]['vo_amount'] * 1).toFixed(2);    
        }
        return res;
    }

    function makechartdateTotal(dataTo1,dataTo2) {
        let res = [];
        for (let i = 0; i < daysInmonth; i++) {
            res.push(0);
        }
        for (let i = 0; i < dataTo1.length; i++) {
            let day = dataTo1[i]['approved_date'].split("-")[2] * 1;
            res[day] += (dataTo1[i]['approved_amount'] * 1);    
        }
        for (let i = 0; i < dataTo2.length; i++) {
            let day = dataTo2[i]['vo_date'].split("-")[2] * 1;
            res[day] += (dataTo2[i]['vo_amount'] * 1);    
        }
        console.log(res);
        return res;
        
    }
    const ctx = document.getElementById('myChart').getContext('2d');
    ctx.height = 400;

    const labels = MONTHS;
    let myChart ;
    makedatas(Approved_value,Approved_vo)
    function makedatas(approvedp_value,approvedvo_value) {
        let datas = {
            labels: labels,
            datasets: [
                {
                    label: 'Approved P.Value',
                    backgroundColor: '#1266f1',
                    borderColor: '#1266f1',
                    borderWidth: 1,
                    data: makechartdateApp(approvedp_value),
                },
                {
                    label: 'Approved Vo.Value',
                    backgroundColor: '#b00020eb',
                    borderColor: '#b00020eb',
                    borderWidth: 1,
                    data: makechartdateVo(approvedvo_value),
                },
                {
                    label: 'Total',
                    backgroundColor: 'black',
                    borderColor: 'black',
                    borderWidth: 1,
                    data: makechartdateTotal(approvedp_value,approvedvo_value),
                }
                ]
            };

            myChart = new Chart(ctx, {
                type: 'line',
                data: datas,
                options: {
                    scales: {
                    x: {
                        grid: {
                        borderColor: 'red'
                        }
                    }
                }
                }
            });

    }

    

    function display() {
        let year = $("#sel-year").val();
        let month = $("#sel-month").val();
        $.ajax({
            type : 'post',
            url : "{{url('/projects/get_chart_data')}}",
            data : {
                year : year,
                month : month,
            },
            success : function(data)
            {
                myChart.data.datasets[0].data = makechartdateApp(data[0]);
                myChart.data.datasets[1].data = makechartdateVo(data[1]);
                myChart.data.datasets[2].data = makechartdateTotal(data[0],data[1]);


                myChart.update();
            }
        }) 
    }


    
</script>
@endsection