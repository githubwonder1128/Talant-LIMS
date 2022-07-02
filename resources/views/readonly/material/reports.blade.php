@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>P.Code</th>
                                <th>P.Name</th>
                                <th>Type</th>
                                <th>Note</th>
                                <th>Qiantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($reports); $i++)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$reports[$i]->material_recorddate}}</td>
                                    <td>{{$reports[$i]->p_code}}</td>
                                    <td>{{$reports[$i]->p_name}}</td>
                                    <td>{{$reports[$i]->mat_type}}</td>
                                    <td>{{$reports[$i]->material_recordnote}}</td>
                                    <td>{{$reports[$i]->material_recordquantity}}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection