@extends('layouts.payroll')

{{ HTML::script('media/jquery-1.12.0.min.js') }}

<script type="text/javascript">

 function totalBalance() {
      var days = document.getElementById("days").value;
      var amt = document.getElementById("amount").value.replace(/,/g,'');
      var total = days * amt * 10;
      total=total.toLocaleString('en-US',{minimumFractionDigits: 2});
      document.getElementById("balance").value = total;

}

function totalB() {
      var days = document.getElementById("days").value;
      var amt = document.getElementById("amount").value.replace(/,/g,'');
      var total = days * amt ;
      total=total.toLocaleString('en-US',{minimumFractionDigits: 2});
      document.getElementById("balance").value = total;

}

</script>

<script type="text/javascript">
$(document).ready(function() {

    $('#employee').change(function(){
        $.get("{{ url('api/salary')}}", 
        { option: $(this).val() }, 
        function(data) {
            $('#amount').val(data);
        });
    });

    
});
</script>


@section('content')

<div class="row">
    <div class="col-lg-12">
  <h3>New Employee Daily Pay</h3>

<hr>
</div>  
</div>


<div class="row">
    <div class="col-lg-5">

    
        
         @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif
        
  {{ HTML::style('jquery-ui-1.11.4.custom/jquery-ui.css') }}
  {{ HTML::script('jquery-ui-1.11.4.custom/jquery-ui.js') }}

  <style>
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
    .ui-dialog 
    {
    position: fixed;
    margin-bottom: 950px;
    }


    .ui-dialog-titlebar-close {
  background: url("{{ URL::asset('jquery-ui-1.11.4.custom/images/ui-icons_888888_256x240.png'); }}") repeat scroll -93px -128px rgba(0, 0, 0, 0);
  border: medium none;
}
.ui-dialog-titlebar-close:hover {
  background: url("{{ URL::asset('jquery-ui-1.11.4.custom/images/ui-icons_222222_256x240.png'); }}") repeat scroll -93px -128px rgba(0, 0, 0, 0);
}
    
  </style>

  <script>
  $(function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      name = $( "#name" ),
      
      allFields = $( [] ).add( name ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o) {
      if ( o.val().length == 0 ) {
        o.addClass( "ui-state-error" );
        updateTips( "Please insert allowance type!" );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    function addUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      valid = valid && checkLength( name );
 
      valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Please insert a valid name for allowance type." );
 
      if ( valid ) {

      /* displaydata(); 

      function displaydata(){
       $.ajax({
                      url     : "{{URL::to('reloaddata')}}",
                      type    : "POST",
                      async   : false,
                      data    : { },
                      success : function(s){
                        var data = JSON.parse(s)
                        //alert(data.id);
                      }        
       });
       }*/

        $.ajax({
            url     : "{{URL::to('createAllowance')}}",
                      type    : "POST",
                      async   : false,
                      data    : {
                              'name'  : name.val()
                      },
                      success : function(s){
                         $('#allowance').append($('<option>', {
                         value: s,
                         text: name.val(),
                         selected:true
                         }));
                      }        
        });
        
        dialog.dialog( "close" );
      }
      return valid;
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 250,
      width: 350,
      modal: true,
      buttons: {
        "Create": addUser,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
 
    $('#allowance').change(function(){
    if($(this).val() == "cnew"){
    dialog.dialog( "open" );
    }
      
    });
  });
  </script>
 
   {{ HTML::script('datepicker/js/bootstrap-datepicker.min.js') }}

<div id="dialog-form" title="Create new allowance type">
  <p class="validateTips">Please insert Allowance Type.</p>
 
  <form>
    <fieldset>
      <label for="name">Name <span style="color:red">*</span></label>
      <input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
 

         <form method="POST" action="{{{ URL::to('dailypays') }}}" accept-charset="UTF-8">
   
    <fieldset>

       <div class="form-group">
                        <label for="username">Employee <span style="color:red">*</span></label>
                        <select name="employee" id="employee" class="form-control">
                           <option></option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"> {{ $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name }}</option>
                            @endforeach
                        </select>
                
                    </div>                    

                    
        <div class="form-group insts" id="insts">
            <label for="username">Days </label>
            <input class="form-control" placeholder="" onkeypress="totalB()" onkeyup="totalB()" type="text" name="days" id="days" value="{{{ Input::old('days') }}}">
        </div>
             
        <div class="form-group">
                        <label for="username">Period <span style="color:red">*</span></label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control period" readonly="readonly" placeholder="" type="text" name="period" id="period" value="{{{ Input::old('period') }}}">
                        </div>
        </div>        

        <div class="form-group">
            <label for="username">Daily Amount <span style="color:red">*</span> </label>
            <div class="input-group">
            <span class="input-group-addon">{{$currency->shortname}}</span>
            <input class="form-control" readonly placeholder="" onkeypress="totalBalance()" onkeyup="totalBalance()" type="text" name="amount" id="amount" value="{{{ Input::old('amount') }}}">
           </div>
          
        </div>
        
        <div class="form-group bal_amt" id="bal">
            <label for="username">Total </label>
            <div class="input-group">
            <span class="input-group-addon">{{$currency->shortname}}</span>
            <input class="form-control" placeholder="" readonly="readonly" type="text" name="balance" id="balance" value="{{{ Input::old('balance') }}}">
            </div>
        </div>

        
        

       <script type="text/javascript">
$(function(){
$('.period').datepicker({
    format: "m-yyyy",
    startView: "months", 
    minViewMode: "months",
    autoclose: true
});
});
</script>
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Employee Daily Pay</button>
        </div>

    </fieldset>
</form>
        

  </div>

</div>

@stop