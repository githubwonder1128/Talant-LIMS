@extends('layouts.app')

@section('content')
<style>
    /* #tbl_projects_wrapper{
        width: 100%;
    } */
    .col-md-5{
        text-align: right;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="row">
            <div class="card">
                
            </div>
        </div>
        <div class = "row" style="margin-top:20px">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body col-md-12">
                        <!-- <h5 class="card-title">Project Summary</h5> -->
                        <div class="row">
                            <table id="tbl_projects" class="mdl-data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>P.Code</th>
                                        <th>Date</th>
                                        <th>P.Name</th>
                                        <th>CompanyName</th>
                                        <th>P.status</th>
                                        <th>P.Type</th>
                                        <th>P.Work</th>
                                        <th>PIC</th>
                                        <th>Include Materials</th>
                                        <th>Include Roofing</th>
                                        <th>Date Start Work</th>
                                        <th>Date Completion</th>
                                        <th>P.Award</th>
                                        <th>F.completion</th>
                                        <th>P.completion</th>
    
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < count ($Projects); $i ++)
                                    <tr id="tbl_projects_summary-{{$Projects[$i]['p_id']}}" class="{{$Projects[$i]['p_status']}}">
                                        <td>{{$Projects[$i]['p_code']}}</td>
                                        <td>{{$Projects[$i]['p_date']}}</td>
                                        <td>{{$Projects[$i]['p_name']}}</td>
                                        <td>{{$Projects[$i]['company_name']}}</td>
                                        <td>{{$Projects[$i]['p_status']}}</td>
                                        <td>{{$Projects[$i]['p_type']}}</td>
                                        <td>{{$Projects[$i]['p_work']}}</td>
                                        <td>{{$Projects[$i]['p_ic']}}</td>
                                        <td>{{$Projects[$i]['include_materials']}}</td>
                                        <td>{{$Projects[$i]['include_roofing']}}</td>
                                        <td>{{$Projects[$i]['date_startWork']}}</td>
                                        <td>{{$Projects[$i]['date_completion']}}</td>
                                        <td>{{$Projects[$i]['p_award']}}</td>
                                        <td>{{$Projects[$i]['f_completion']}}</td>
                                        <td>{{$Projects[$i]['p_completion']}}</td>
                                        
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Approved P.Value</label>
                            </div>
                            <div class="col-md-5" id="approved_amount">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Approved V.O.Value</label>
                            </div>
                            <div class="col-md-5" id="vo_amount">

                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-7">
                                <label>✔Total P.Value</label>
                            </div>
                            <div class="col-md-5" id="total_p_value">

                            </div>
                        </div>

                        <div class="row"  style="margin-top: 10px;">
                            <div class="col-md-7">
                                <label>✔Total Work done</label>
                            </div>
                            <div class="col-md-5" id="total_work_done">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Retention Sum</label>
                            </div>
                            <div class="col-md-5" id="retention">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Collections</label>
                            </div>
                            <div class="col-md-5" id="invoice_payment_made">

                            </div>
                        </div>
                        
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-7">
                                <label>✔Amount Due To Claim</label>
                            </div>
                            <div class="col-md-5" id="amount_due_to_claim">

                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-7" >
                                <label>✔Payment Certificate</label>
                            </div>
                            <div class="col-md-5" id="payment_amount">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Invoiced Billed</label>
                            </div>
                            <div class="col-md-5" id="invoice_amount">

                            </div>
                        </div>
                        
                    </div>
                </div>
                

                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Sub Con Claims</label>
                            </div>
                            <div class="col-md-5" id="sub_con_amount">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔CIDB LEVY</label>
                            </div>
                            <div class="col-md-5" id="cidb_amount">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Car Insurance</label>
                            </div>
                            <div class="col-md-5" id="insurance_amount">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Man Power Hours</label>
                            </div>
                            <div class="col-md-5" id="worker_rate">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Total Man Power Cost</label>
                            </div>
                            <div class="col-md-5" id="total_man_cost">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Balance P.Value</label>
                            </div>
                            <div class="col-md-5" id="balance_p_value">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Balance Collectible</label>
                            </div>
                            <div class="col-md-5" id="balance_collectible_value">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Net P.Value</label>
                            </div>
                            <div class="col-md-5" id="balance_to_bill">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">Remarks</h5>
                        <div class="row" id="remarks">

                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Total Active P.Value</label>
                            </div>
                            <div class="col-md-5" id="totalactivepvalue">
                                {{$Total[0]}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>✔Total Active P.Collectible</label>
                            </div>
                            <div class="col-md-5" id="totalcollections">
                                {{$Total[1]}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    
    </div>
</div>
<script>
    $(document).ready(function () {
        // new Datatable($("#tbl_prjects"), data, {})
        $('#tbl_projects').DataTable({
            autoWidth: false,
            columnDefs: [
                {
                    targets: ['_all'],
                    className: 'mdc-data-table__cell',
                },
            ],
        })
        .order([0,'desc'])
        .draw();;
        $(".active").css("background-color","#00bfff");
        $(".complete").css("background-color","#808080");
        $(".aborted").css("background-color","#dc143c");
    })

    $("tr").click(function(){
        let rowId = $(this).attr("id").split("-")[1];
        $("tr").css("background-color","")
        $(this).css("background-color","green")
        get_detail_total(rowId);
        
    })

    function numberWithCommas(x) {
       return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }   

    function get_detail_total(pId) {
        $.ajax({
            type : "post",
            url : "{{url('/projects/get_detail_total')}}",
            data : {
                p_id : pId
            },
            success : function(data){
                console.log(data);
                for(key in data){
                    $("#"+key).text((data[key] * 1).toFixed(2))
                };
                let progress = data['progress'];

                for(key in progress){
                    $("#"+key).text((progress[key] * 1).toFixed(2))
                }

                let man_power = data['manpower']

                for(key in man_power){
                    $("#"+key).text((man_power[key] * 1).toFixed(2))
                }

                $("#total_p_value").text((data['approved_amount'] + data['vo_amount']).toFixed(2));
                $("#balance_p_value").text((data['approved_amount'] + data['vo_amount'] - data['progress']['total_work_done']).toFixed(2));
                $("#balance_collectible_value").text((data['approved_amount'] + data['vo_amount'] - data['invoice_payment_made']).toFixed(2));
                $("#balance_to_bill").text((data['approved_amount'] + data['vo_amount'] - data['sub_con_amount']).toFixed(2));
                $("#remarks").text(data['remarks'])

                $(".col-md-5").filter(function(){
                    if($(this).text()* 1 > 0)
                    {
                        $(this).text(numberWithCommas(($(this).text() * 1).toFixed(2)))
                    }
                })
                $(".active").css("background-color","#00bfff");
                $(".complete").css("background-color","#808080");
                $(".aborted").css("background-color","#dc143c");
            }
        })
    }
</script>
@endsection
