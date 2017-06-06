@extends('layouts.accounting')
@section('content')

<div class="row">
	<div class="col-lg-12">
  <center><h4><font color='green'>Outflow Statement</font></h4></center>

<hr>
</div>	
</div>
<head>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/cashflow.css') }}">
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                         <div class="dropdown">
                            <button onclick="myFunction()" class="dropbtn" style="margin-bottom: 20%;"  >Export</button>  
                            <div id="myDropdown" class="dropdown-content">
                            <a href="#">Export to CSV</a>
                            <a href="#">Export to Excel</a>
                            <a href="#">Export as PDF</a>
                            </div>
                           </div> 
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Liabilities:</td>
                <td></td>
             </tr>      
                
            <tr class="item">
                <td>Current Liability</td>
                <td></td>               
            </tr>
            <tr class="heading">
                <td>Assets:</td>
                <td></td>  
            </tr>
            <tr class="item">
                <td>Current Assets</td>
                 <td></td>                     
            </tr>
            <tr class="heading">
                <td>Expenses</td>
                 <td></td>                     
            </tr>
            <tr class="item">
                <td>Direct Expense</td>
                 <td></td>                     
            </tr>
            <tr class="item">
                <td>Indirect Expense</td>
                 <td></td>                     
            </tr>
             <tr class="item">
                <td><B>Total</B></td>
                 <td></td>                     
            </tr>
              
         
        </table>


       
  </div>
 
<script type="text/javascript">
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>


@stop