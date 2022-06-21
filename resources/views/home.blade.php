@extends('layouts.app')

@section('content')
<style>
    /* #tbl_projects_wrapper{
        width: 100%;
    } */
    .col-md-5{
        text-align: right;
    }
    .col-md-2 .card-body{
        padding-top: 10px!important;
        padding-bottom: 0px!important;
    }
    .col-md-2 .card {
        margin-top:5px!important;
    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class = "row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <!-- <h5 class="card-title">Project Summary</h5> -->
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom: 10px;">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary" onclick="display('all')">ALL PROJECT</button>
                                    <button type="button" class="btn btn-primary"  onclick="display('active')">ACTIVE PROJECT</button>
                                    <button type="button" class="btn btn-primary" onclick="display('complete')">WORK DONE PROJECT </button>
                                    <button type="button" class="btn btn-primary" onclick="display('fully paid')">DONE & Fully PAID PROJECT </button>
                                    <button type="button" class="btn btn-primary" onclick="display('aborted')">ABORTED PROJECT </button>
                                    <button type="button" class="btn btn-primary" onclick="display('retention')">PROJECT WITH RETENTION SUM </button>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <table id="tbl_projects" class="">
                                <thead id="bl_projects_summary-0">
                                    <tr>
                                        <th>P.Code</th>
                                        <th>Date</th>
                                        <th>P.Name</th>
                                        <th>Client</th>
                                        <th>P.status</th>
                                        <th>P.Type</th>
                                        <th>P.Work</th>
                                        <th>PIC</th>
                                        <th>Materials</th>
                                        <th>Roofing</th>
                                        <th>P.Award</th>
                                        <th>Fab%</th>
                                        <th>Site%</th>
                                        <th>Bal.Collectible</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @for($i = 0; $i < count ($Projects); $i ++)
                                    <tr id="tbl_projects_summary-{{$Projects[$i]->p_id}}" class="{{$Projects[$i]->p_status}}" data-retention = {{$Projects[$i]->progress_less_retention}}>
                                        <td>{{$Projects[$i]->p_code}}</td>
                                        <td>{{$Projects[$i]->p_date}}</td>
                                        <td>{{$Projects[$i]->p_name}}</td>
                                        <td>{{$Projects[$i]->company_name}}</td>
                                        <td>{{$Projects[$i]->p_status}}</td>
                                        <td>{{$Projects[$i]->p_type}}</td>
                                        <td>{{$Projects[$i]->p_work}}</td>
                                        <td>{{$Projects[$i]->p_ic}}</td>
                                        <td>{{$Projects[$i]->include_materials}}</td>
                                        <td>{{$Projects[$i]->include_roofing}}</td>
                                        <td>{{$Projects[$i]->p_award}}</td>
                                        <td>{{$Projects[$i]->f_completion}}</td>
                                        <td>{{$Projects[$i]->p_completion}}</td>
                                        <td>{{$Projects[$i]->approved_amount + $Projects[$i]->vo_amount - $Projects[$i]->invoice_payment_made}}</td>
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
                            <h6 class="title_project" style="text-align: center;"></h6>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>P.Value</label>
                            </div>
                            <div class="col-md-5 approved_amount">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>V.O.Value</label>
                            </div>
                            <div class="col-md-5 vo_amount">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label style="font-weight: bold;">=>Total P.Value</label>
                            </div>
                            <div class="col-md-5 total_p_value" style="font-weight: bold;">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label>Collections</label>
                            </div>
                            <div class="col-md-5 invoice_payment_made">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label style="font-weight: bold;">Balance Collectible</label>
                            </div>
                            <div class="col-md-5 balance_collectible_value" style="font-weight: bold;">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>Invoiced</label>
                            </div>
                            <div class="col-md-5 invoice_amount">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label>Collections</label>
                            </div>
                            <div class="col-md-5 invoice_payment_made">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label style="font-weight: bold;">Bal.To.Collect</label>
                            </div>
                            <div class="col-md-5 babalance_to_collect" style="font-weight: bold;">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>Overhead</label>
                            </div>
                            <div class="col-md-5 sub_con_amount">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label>CIDB LEVY</label>
                            </div>
                            <div class="col-md-5 cidb_amount">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>Insurance</label>
                            </div>
                            <div class="col-md-5 insurance_amount" >

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label>Man Power Cost</label>
                            </div>
                            <div class="col-md-5 total_man_cost">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label style="font-weight: bold;">=>Total Cost</label>
                            </div> 
                            <div class="col-md-5 balance_to_bill" style="font-weight: bold;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>=>Total P.Value</label>
                            </div>
                            <div class="col-md-5 total_p_value">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label>=>Less: Total Cost</label>
                            </div>
                            <div class="col-md-5 balance_to_bill" id="">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label style="font-weight: bold;">Net P.Value</label>
                            </div>
                            <div class="col-md-5 net_p_value" id="" style="font-weight: bold;">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>P.Value</label>
                            </div>
                            <div class="col-md-5 approved_amount" id="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>V.O.Value</label>
                            </div>
                            <div class="col-md-5 vo_amount" id="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label style="font-weight: bold;">=>Total P.Value</label>
                            </div>
                            <div class="col-md-5 total_p_value" id="" style="font-weight: bold;">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label>Work done</label>
                            </div>
                            <div class="col-md-5 total_work_done" id="">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label>Ret. Sum</label>
                            </div>
                            <div class="col-md-5 retention" id="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>Collections</label>
                            </div>
                            <div class="col-md-5 invoice_payment_made" id="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>=>Amount Claim</label>
                            </div>
                            <div class="col-md-5 amount_due_to_claim" id="">

                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Remarks</h5>
                        <div class="row remarks" id="">

                        </div>
                    </div>
                </div>
                

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>Man Power Hours</label>
                            </div>
                            <div class="col-md-5 worker_rate" id="">

                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>Start Date</label>
                            </div>
                            <div class="col-md-5 date_startWork" id="">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>Completion Date</label>
                            </div>
                            <div class="col-md-5 date_completion" id="">

                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>Active P.Value</label>
                            </div>
                            <div class="col-md-5 totalactivepvalue" id="">
                                {{$Total[0]}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>Active P.Collectible</label>
                            </div>
                            <div class="col-md-5 totalcollections" id="">
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
            autoWidth: true,
            paging : false,
            columnDefs: [
                {
                    targets: ['_all'],
                    className: 'mdc-data-table__cell',
                },
            ],
        })
        .order([0,'desc'])
        .draw();
        $("#tbl_projects tbody tr").filter(function(){
            let tmp = ($(this).children("td:nth-child(14)").text() * 1).toFixed(2) ;
            console.log(tmp);
            $(this).children("td:nth-child(14)").text(numberWithCommas(tmp))
            
        })
        // $(".active").css("background-color","#00bfff");
        // $(".complete").css("background-color","#808080");
        // $(".aborted").css("background-color","#dc143c");
    })

    $("tbody tr").click(function(){
        let rowId = $(this).attr("id").split("-")[1];
        $("tr").css("background-color","")
        $(this).css("background-color","green")
        let p_code =  $(this).children("td:nth-child(1)").text();
        let p_name =  $(this).children("td:nth-child(2)").text();
        let company_name =  $(this).children("td:nth-child(3)").text()
        let project_title = p_code + "_" + p_name + "_" + company_name;
        $(".title_project").text(project_title)
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
                for(key in data){
                    $("."+key).text((data[key] * 1).toFixed(2))
                };
                let progress = data['progress'];

                for(key in progress){
                    $("."+key).text((progress[key] * 1).toFixed(2))
                }

                let man_power = data['manpower']

                for(key in man_power){
                    $("."+key).text((man_power[key] * 1).toFixed(2))
                }

                let date_data = data['date_data'];
                for(key in date_data){
                    $("."+key).text(date_data[key]);
                }
                let total_p_value = (data['approved_amount'] + data['vo_amount']).toFixed(2);
                let balance_p_value = (total_p_value - data['progress']['total_work_done'] ).toFixed(2);
                let balance_collectible_value = (total_p_value - data['invoice_payment_made']).toFixed(2);
                let babalance_to_collect = (data['invoice_amount'] - data['invoice_payment_made']).toFixed(2);
                let balance_to_bill = (data['sub_con_amount']*1 + data['cidb_amount']*1 + data['insurance_amount']*1 + data['manpower']['total_man_cost']*1).toFixed(2);
                let net_p_value = total_p_value - balance_to_bill;
                $(".babalance_to_collect").text(babalance_to_collect);
                $(".balance_to_bill").text(balance_to_bill);
                $(".net_p_value").text(net_p_value);

                $(".total_p_value").text(total_p_value);
                $(".balance_p_value").text(balance_p_value);
                $(".balance_collectible_value").text(balance_collectible_value);
                $(".remarks").text(data['remarks'])

                $(".col-md-5").filter(function(){
                    if($(this).text()* 1 > 0)
                    {
                        $(this).text(numberWithCommas(($(this).text() * 1).toFixed(2)))
                    }
                })
            }
        })
    }

    function display(status) {
        let table = $("#tbl_projects").DataTable()
        if (status != 'retention' || status != 'all') {
            $("#tbl_projects tbody tr").filter(function(){
                if($(this).children("td:nth-child(5)").text() == status)
                {
                    $(this).show();
                }else{
                    $(this).hide()
                }
            })
        }
        if (status == 'all') {
            $("#tbl_projects tbody tr").show();
        }

        if (status == 'retention') {
            $("#tbl_projects tbody tr").filter(function(){
                console.log($(this).data("retention"));
               if($(this).data("retention")*1 > 0){
                    $(this).show()
               } else{
                    $(this).hide()
               }
            })
        }

        

        
    }
</script>
@endsection
