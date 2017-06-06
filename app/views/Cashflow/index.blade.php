@extends('layouts.accounting')
@section('content')

<div class="row">
	<div class="col-lg-12">
  <h4><font color='green'>Cashflows</font></h4>

<hr>
</div>	
</div>


<div class="row">
	<div class="col-lg-12">

    @if (Session::has('flash_message'))

      <div class="alert alert-success">
      {{ Session::get('flash_message') }}
     </div>
    @endif

    @if (Session::has('delete_message'))

      <div class="alert alert-danger">
      {{ Session::get('delete_message') }}
     </div>
    @endif
    
<div class="panel panel-default">
<div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('inflow')}}">Inflow Statement</a>
          <a class="btn btn-info btn-sm" href="{{ URL::to('outflow')}}">Outflow Statement</a>
        </div>
          </div>    

    <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

<table>
  <tr>
    <th>Month</th>
    <th>Cash Inflow</th>
    <th>Cash Outflow</th>
    <th>Nett Flow</th>
  </tr>
  <tr>
    <th>January</th>
    <th style="color: green;">20,000,000</th>
    <th style="color: red;">11,000,000</th>
    <th style="color: blue;">9,000,000</th>
  </tr>
  <tr>
    <th>February</th>
    <th style="color: green;">20,000,000</th>
    <th style="color: red;">11,000,000</th>
    <th style="color: blue;">9,000,000</th>
  </tr>
  <tr>
    <th>March</th>
    <th style="color: green;">20,000,000</th>
    <th style="color: red;">11,000,000</th>
    <th style="color: blue;">9,000,000</th>
  </tr>
  
</table>
  </div>


  </div>


</div>

@stop