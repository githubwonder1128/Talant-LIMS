@extends('layouts.app')

@section('content')
<style>
    table td{
        font-size : 14px!important;
        padding : 5px 5px 5px 5px !important;
        height : auto!important;
        
        .col-md-12{
    }

    /* #tbl_projects_wrapper{
        width: 100%;
    } */
    .col-md-5{
        text-align: right;
    }
    .col-md-2 .card-body{
        padding-top: 5px!important;
        padding-bottom: 5px!important;
    }
    .col-md-2 .card {
        margin-top:5px!important;
    }

</style>

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
                                    <button type="button" class="btn btn-secondary " onclick="display('all')">    ALL PROJECT<br><span style="font-size: 16px;">    所有项目     </button>
                                    <button type="button" class="btn btn-primary"  onclick="display('active')">Active Project<br><span style="font-size: 16px;">活跃项目</button>
                                    <button type="button" class="btn btn-primary" onclick="display('complete')">Work Done Project<br><span style="font-size: 16px;">工作完成项目</button>
                                    <button type="button" class="btn btn-primary" onclick="display('fully paid')">W. Done & Fully Paid Project<br><span style="font-size: 16px;">完成并全额支付项目</button>
                                    <button type="button" class="btn btn-primary" onclick="display('retention')">Project With Ret. Sum<br><span style="font-size: 16px;">保留金额的项目</button>
                                    <button type="button" class="btn btn-primary" onclick="display('aborted')">Aborted Project<br><span style="font-size: 16px;">中止的项目</button>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <table id="tbl_projects" class="col-md-6 col-p">
                                <thead id="tbl_projects_summary-0">
                                    <tr>
                                        <th>#</th>
                                        <th><b><font color=#000080>P.CODE</b></th>
                                        <th><b><font color=#000080>DATE</b></th>
                                        <th><b><font color=#000080>P.NAME</b></th>
                                        <th><b><font color=#000080>CLIENT</b></th>
                                        <th><b><font color=#000080>P.STATUS</b></th>
                                        <th><b><font color=#000080>P.TYPE</b></th>
                                        <th><b><font color=#000080>P.WORK</b></th>
                                        <th><b><font color=#000080>PIC</b></th>
                                        <th><b><font color=#000080>MATERIAL</b></th>
                                        <th><b><font color=#000080>ROOFING</b></th>
                                        <th><b><font color=#000080>P.AWARD</b></th>
                                        <th><b><font color=#000080>FAB. %</b></th>
                                        <th><b><font color=#000080>SITE %</b></th>
                                        <th><b><font color=#000080>BAL.COLL</b></th> 
                                    </tr>
                                </thead>
                                
                                <tbody >
                                    @for($i = 0; $i < count ($Projects); $i ++)
                                    <tr 
                                    id="tbl_projects_summary-{{$Projects[$i]->p_id}}" 
                                    class="{{$Projects[$i]->p_status}}" 
                                    data-retention = "{{$Projects[$i]->progress_less_retention}}"
                                    data-approved_value = "{{$Projects[$i]->approved_amount}}"
                                    data-vo_amount = "{{$Projects[$i]->vo_amount}}"
                                    data-invoice_payment_made = "{{$Projects[$i]->invoice_payment_made}}"
                                    data-balcollect = "{{$Projects[$i]->approved_amount + $Projects[$i]->vo_amount - $Projects[$i]->invoice_payment_made}}"
                                    >
                                        <td>{{$i + 1}}</td>
                                        <td>{{$Projects[$i]->p_code}}</td>
                                        <td>{{$Projects[$i]->p_date}}</td>
                                        <td><b><font color=#8B008B>{{$Projects[$i]->p_name}}</b></td>
                                        <td><b><font color=#0000FF>{{$Projects[$i]->company_name}}</b></td>
                                        <td>{{$Projects[$i]->p_status}}</td>
                                        <td>{{$Projects[$i]->p_type}}</td>
                                        <td>{{$Projects[$i]->p_work}}</td>
                                        <td>{{$Projects[$i]->p_ic}}</td>
                                        <td>{{$Projects[$i]->include_materials}}</td>
                                        <td>{{$Projects[$i]->include_roofing}}</td>
                                        <td>{{$Projects[$i]->p_award}}</td>
                                        <td><b><font color=red>{{$Projects[$i]->f_completion}}</b></td>
                                        <td><b><font color=red>{{$Projects[$i]->p_completion}}</b></td>
                                        <td>{{$Projects[$i]->approved_amount + $Projects[$i]->vo_amount - $Projects[$i]->invoice_payment_made}}</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-10" style="float: right;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label  style="float: right;">TotalP.Value</label>
                                            </div>
                                            <div class="col-md-5 row-total_p_value">
                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label style="float: right;">Total Collections</label>
                                            </div>
                                            <div class="col-md-5 row-total_invoice_payment_made">
                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label style="float: right;">BAl Collectible</label>
                                            </div>
                                            <div class="col-md-5 row-total_balance_collectible_value">
                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">


                        <div class="row"><b><font color=#0000FF>
                        <h6 class="title_project" style="text-align: center ;"></h6></b></font>
                        </div>
                    
                        <div class="row">
                        <div class="col-md-7">
                                <label style="font-weight: bold;"><font color=orange>______________________________________</font></label>

                            </div>
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
                                <label style="font-weight: bold;"><font color=#0000FF>=>Total P.Value</font></label>
                            </div>
                            <div class="col-md-5 total_p_value" style="color:#0000FF; font-weight: bold;">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label><b><font color=#006400>Collections</b></font></label>
                            </div>
                            <div class="col-md-5 invoice_payment_made"style="color:#006400; font-weight: bold;">

                            </div>
                        </div>

                        <div class="row">
                         
                            <div class="col-md-7">
                                <label style="font-weight: bold;"><font color=red>BAL. COLLECTIBLE</font></label>
                            </div>
                            <div class="col-md-5 balance_collectible_value"  style="color:red; font-weight: bold;">
   
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>Invoice Billed</label>
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
                                <label style="color:#2F4F4F; font-weight: bold;">Bal.To.Collect</label>
                            </div>
                            <div class="col-md-5 babalance_to_collect" style="color:#2F4F4F; font-weight: bold;">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <label>-Overhead</label>
                            </div>
                            <div class="col-md-5 sub_con_amount">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label>-CIDB LEVY</label>
                            </div>
                            <div class="col-md-5 cidb_amount">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label>-Insurance</label>
                            </div>
                            <div class="col-md-5 insurance_amount" >

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label>-Manpower Cost</label>
                            </div>
                            <div class="col-md-5 total_man_cost">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <label style="color:#D2691E; font-weight: bold;">=>Total Cost</label>
                            </div> 
                            <div class="col-md-5 balance_to_bill" style="color:#D2691E; font-weight: bold;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                           <div class="col-md-7">
                                <label style="color:#0000FF; font-weight: bold;">=>Total P.Value</label>
                            </div>
                            <div class="col-md-5 total_p_value" style="color:#0000FF; font-weight: bold;">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7">
                                <label style="color:#D2691E; font-weight: bold;">=>Less: Total Cost</label>
                            </div>
                            <div class="col-md-5 balance_to_bill" id="" style="color:#D2691E; font-weight: bold;">

                            </div>
                        </div>

                        <div class="row">
                              <div class="col-md-7">
                                <label style="color:#008B8B; font-weight: bold;">Net P.Value</label>
                            </div>
                            <div class="col-md-5 net_p_value" id="" style="color:#008B8B; font-weight: bold;">

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
                                <label style="font-weight: bold;"><font color=#0000FF>=>Total P.Value</font></label>
                            </div>
                            <div class="col-md-5 total_p_value" id="" style="color:#0000FF; font-weight: bold;">

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
                            <div class="col-md-7"><b><font color=#FF00FF>
                                <label>Ret. Sum</label></font></b>
                            </div>
                            <div class="col-md-5 retention" id="" style="color:#FF00FF; font-weight: bold;">

                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-7">
                                <label><b><font color=#006400>Collections</b></font></label>
                            </div>
                            <div class="col-md-5 invoice_payment_made" id="" style="color:#006400; font-weight: bold;">

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
                        <div class="row">
                            <div class="col-md-7">
                                <label><b>Payment Cert.</b></label>
                            </div>
                            <div class="col-md-5 payment_amount" id=""style="color:; font-weight: bold;">

                            </div>
                        </div>
                        
                    </div>
                </div>

                
                
                
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">* Remarks *</h5>
                        <div class="row remarks" id="" style="color:#FF6347; font-weight: bold;">

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row" id="" style="color:#FF6347; font-weight: bold;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Type</td>
                                        <td>Note</td>
                                        <td>Quantity</td>
                                    </tr>
                                </thead>
                                <tbody class="materials-body">

                                </tbody>
                            </table>
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
        .order([1,'desc'])
        .draw();
        $("#tbl_projects tbody tr").filter(function(){
            let tmp = ($(this).children("td:nth-child(15)").text() * 1).toFixed(2) ;
            $(this).children("td:nth-child(15)").text(numberWithCommas(tmp))
            
        })
        calc_total();
        // $(".active").css("background-color","#00bfff");
        // $(".complete").css("background-color","#808080");
        // $(".aborted").css("background-color","#dc143c");
        Rsort();
    })

    function Rsort() {
        let index = 1;
        $("#tbl_projects tbody tr").filter(function(){
            if ($(this).css('display') != 'none') {
                $(this).children("td:first-child").text(index);
                index++;
            }
            
        })
    }

    $("tbody tr").click(function(){
        let rowId = $(this).attr("id").split("-")[1];
        $("tr").css("background-color","")
        $(this).css("background-color","#FFD700")
        let p_code =  $(this).children("td:nth-child(2)").text();
        let p_name =  $(this).children("td:nth-child(3)").text();
        let company_name =  $(this).children("td:nth-child(4)").text()
        let project_title = p_code + " " + p_name  +" ( " + company_name + " )";
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

                let man_power = data['manpower'];

                for(key in man_power){
                    $("."+key).text((man_power[key] * 1).toFixed(2))
                }
                let materials = data['materials'];
                console.log(materials);
                let trtxt = ''
                for (let i = 0; i < materials.length; i++) {
                    trtxt += "<tr>";
                    trtxt += "<td>"+materials[i]['mat_type']+"</td>";
                    trtxt += "<td>"+materials[i]['material_recordnote']+"</td>"           
                    trtxt += "<td>"+materials[i]['material_recordquantity']+"</td>"           
                    trtxt += "</tr>"
                }
                $(".materials-body").html(trtxt);

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

    function calc_total(status = '') {
        let total_p_value = 0;
        let total_collection = 0;
        let bal_collectible = 0;
        status != '' ? status = "."+status : status;
        $("#tbl_projects tbody tr"+ status).filter(function(){
            total_p_value += $(this).data("approved_value") * 1 +  $(this).data("vo_amount") * 1;
            total_collection += $(this).data("invoice_payment_made") * 1;
            bal_collectible += $(this).data("balcollect") * 1;
        })
        $(".row-total_p_value").text(numberWithCommas(total_p_value.toFixed(2)) );
        $(".row-total_invoice_payment_made").text(numberWithCommas(total_collection.toFixed(2)) );
        $(".row-total_balance_collectible_value").text(numberWithCommas(bal_collectible.toFixed(2)) );
    }

    function display(status) {
        let table = $("#tbl_projects").DataTable()
        if (status != 'retention' || status != 'all') {
            $("#tbl_projects tbody tr").filter(function(){
                if($(this).children("td:nth-child(6)").text() == status)
                {
                    $(this).show();
                }else{
                    $(this).hide()
                }
            })
            if (status == 'fully paid') {
                calc_total('fully.paid')
            }else{
                calc_total(status);
            }
        }
        if (status == 'all') {
            $("#tbl_projects tbody tr").show();
            calc_total();
        }

        if (status == 'retention') {
            let total_p_value = 0;
            let total_collection = 0;
            let bal_collectible = 0;
            $("#tbl_projects tbody tr").filter(function(){
                console.log($(this).data("retention"));
               if($(this).data("retention")*1 > 0){
                    total_p_value += $(this).data("approved_value") * 1 +   $(this).data("vo_amount") * 1;
                    total_collection += $(this).data("invoice_payment_made") * 1;
                    bal_collectible += $(this).data("balcollect") * 1;
                    $(this).show()
               } else{
                    $(this).hide()
               }
            })
            $(".row-total_p_value").text(numberWithCommas(total_p_value.toFixed(2)) );
            $(".row-total_invoice_payment_made").text(numberWithCommas(total_collection.toFixed(2)) );
            $(".row-total_balance_collectible_value").text(numberWithCommas(bal_collectible.toFixed(2)) );
        }
        Rsort();
        
    }
</script>
@endsection
