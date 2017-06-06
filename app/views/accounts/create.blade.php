@extends('layouts.accounting')
@section('content')


  {{ HTML::style('jquery-ui-1.11.4.custom/jquery-ui.css') }}
  {{ HTML::script('jquery-ui-1.11.4.custom/jquery-ui.js') }}

<script type="text/javascript">
$(document).ready(function(){
$('#assetcategory').hide();
$('#expensecategory').hide();
$('#liabilitycategory').hide();
$('#incomecategory').hide();

$('#category').change(function(){
if($(this).val() == "ASSET"){
    $('#assetcategory').show();
    $('#expensecategory').hide();
    $('#liabilitycategory').hide();
    $('#incomecategory').hide();
    $('#expensecat').val('');
    $('#liabilitycat').val('');
    $('#incomecat').val('');
}else if($(this).val() == "EXPENSE"){
    $('#expensecategory').show();
    $('#assetcategory').hide();
    $('#liabilitycategory').hide();
    $('#incomecategory').hide();
    $('#assetcat').val('');
    $('#liabilitycat').val('');
    $('#incomecat').val('');
}else if($(this).val() == "LIABILITY"){
    $('#liabilitycategory').show();
    $('#assetcategory').hide();
    $('#expensecategory').hide();
    $('#incomecategory').hide();
    $('#assetcat').val('');
    $('#expensecat').val('');
    $('#incomecat').val('');
}else if($(this).val() == "INCOME"){
    $('#incomecategory').show();
    $('#assetcategory').hide();
    $('#expensecategory').hide();
    $('#liabilitycategory').hide();
    $('#assetcat').val('');
    $('#expensecat').val('');
    $('#liabilitycat').val('');
}else{
    $('#assetcategory').hide();
    $('#expensecategory').hide();
    $('#liabilitycategory').hide(); 
    $('#incomecategory').hide(); 
    $('#assetcat').val('');
    $('#expensecat').val('');
    $('#liabilitycat').val('');
    $('#incomecat').val('');
}

});
});
</script>

<script>
  $(function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      tname = $( "#tname" ),
      allFields = $( [] ).add( tname ),
      tips = $( ".validateTips8" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o,m) {
      if ( o.val().length == 0 ) {
        o.addClass( "ui-state-error" );
        updateTips( m );
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
 
      valid = valid && checkLength( tname, "Please insert asset category name!" );

      //valid = valid && checkLength( bid, "Please select bank for this branch!" );
 
      valid = valid && checkRegexp( tname, /^[a-z]([0-9a-z_\s])+$/i, "Please insert a valid asset category name." );
 
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
            url     : "{{URL::to('createAsset')}}",
                      type    : "POST",
                      async   : false,
                      data    : {
                              'name'  : tname.val()
                      },
                      success : function(s){
                         $('#type_id').append($('<option>', {
                         value: s,
                         text: tname.val(),
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
      height: 280,
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
 
    $('#asset').change(function(){
    if($(this).val() == "cnew"){
    dialog.dialog( "open" );
    }
      
    });


  });
  </script>


 <script>
  $(function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      caname = $( "#caname" ),
      
      allFields = $( [] ).add( cname ),
      tips = $( ".validateTips7" );
 
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
        updateTips( "Please insert citizenship name!" );
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
 
      valid = valid && checkLength( cname );
 
      valid = valid && checkRegexp( cname, /^[a-z]([0-9a-z_\s])+$/i, "Please insert a valid name for citizenship." );
 
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
            url     : "{{URL::to('createCitizenship')}}",
                      type    : "POST",
                      async   : false,
                      data    : {
                              'name'  : cname.val()
                      },
                      success : function(s){
                         $('#citizenship').append($('<option>', {
                         value: s,
                         text: cname.val(),
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
 
    $('body').on("change", "#category", function(){
    if($(this).val() == "canew"){
    dialog.dialog( "open" );
    }
      
    });
  });
  </script>

   <script>
  $(function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      caname = $( "#change" ),
      
      allFields = $( [] ).add( cname ),
      tips = $( ".validateTips9" );
 
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
        updateTips( "Please insert citizenship name!" );
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
 
      valid = valid && checkLength( cname );
 
      valid = valid && checkRegexp( cname, /^[a-z]([0-9a-z_\s])+$/i, "Please insert a valid name for citizenship." );
 
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
            url     : "{{URL::to('createCitizenship')}}",
                      type    : "POST",
                      async   : false,
                      data    : {
                              'name'  : cname.val()
                      },
                      success : function(s){
                         $('#citizenship').append($('<option>', {
                         value: s,
                         text: cname.val(),
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
 
    $('body').on("change", "#expense", function(){
    if($(this).val() == "change"){
    dialog.dialog( "open" );
    }
      
    });
  });
  </script>


<div class="row">
    <div class="col-lg-12">
  <h4><font color='green'>Chart of Accounts</font></h4>
 

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

<div id="dialog-form" title="Create new Asset">
  <p class="validateTips8">Please insert Asset Category Name.</p>
  <form>
    <fieldset>
      <label for="name">Name <span style="color:red">*</span></label>
      <input type="text" name="cname" id="cname" value="" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>

<div id="dialog-form" title="Create new Asset">
  <p class="validateTips7">Please insert Income Category.</p>
  <form>
    <fieldset>
      <label for="name">Name <span style="color:red">*</span></label>
      <input type="text" name="tname" id="tcname" value="" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>

<div id="dialog-form" title="Create new Asset">
  <p class="validateTips9">Please insert Expense Category.</p>
  <form>
    <fieldset>
      <label for="name">Name <span style="color:red">*</span></label>
      <input type="text" name="change" id="change" value="" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>         

         <form method="POST" action="{{{ URL::to('accounts') }}}" accept-charset="UTF-8">
   
    <fieldset>

         <div class="form-group">
            <label for="username">Account Category</label>
            <select class="form-control" name="category" id="category">
                <option value="">select category</option>
                <option>--------------------------</option>
                <option value="ASSET">Asset (1000)</option>
                <option value="INCOME">Income (2000)</option>
                <option value="EXPENSE">Expense (3000)</option>
                <option value="EQUITY">Equity (4000)</option>
                <option value="LIABILITY">Liability (5000)</option>
            </select>            
        </div>

        <div class="form-group" id="assetcategory">
            <label for="username">Asset Category</label>
            <select class="form-control" name="assetcategory" id="asset">
                <option></option>
                <option value="cnew">Create Asset...</option>
                <option>--------------------------</option>
                <option value="fixed">Fixed Asset</option>
                <option value="current">Current Asset</option>
                <option value="Other">Other Assets</option>
            </select>
        </div>



        <div class="form-group" id="incomecategory">
            <label for="username">Income Category</label>
            <select class="form-control" name="incomecategory" id="category">
                <option></option>
                <option value="canew">Create Category...</option>
                <option>--------------------------</option>
                <option value="normal">Normal Income</option>
                <option value="other">Other Income</option>
            </select>
        </div>

        <div class="form-group" id="expensecategory">
            <label for="username">Expense Category</label>
            <select class="form-control" name="expensecategory" id="expense">
                <option value="cnew">Create Expense...</option>
                <option>--------------------------</option>
                <option value="COGS">Cost of Goods Sold</option>
                <option value="Normal">Normal Expense</option>
                <option value="Other">Other Expense</option>
            </select>
      
        </div>

        <div class="form-group" id="liabilitycategory">
            <label for="username">Liability Category</label>
            <select class="form-control" name="liabilitycategory" id="liabilitycat">
                <option value="">select liability category</option>
                <option>--------------------------</option>
                <option value="current">Current Liability</option>
                <option value="longterm">Long-term Liability</option>
                <option value="other">Other Liability</option>
            </select>
        <div class="panel-heading">
          <a class="btn btn-info btn-sm" href="{{ URL::to('accounts/create')}}">Create New Liability Category</a>
        </div>
        </div>

        <div class="form-group">
            <label for="username">Account Name</label>
            <input class="form-control" placeholder="" type="text" name="name" id="name" value="{{{ Input::old('name') }}}">
        </div>


        <div class="form-group">
            <label for="username">GL Code</label>
            <input class="form-control" placeholder="" type="text" name="code" id="code" value="{{{ Input::old('code') }}}">
        </div>

        <div class="form-group">
                <label for = "username">Balance</label> 
                
                    <div class="input-group">
                        <span class="input-group-addon">KES</span>
                        <input type="text" class="form-control"  id="balance" name="balance" value="{{{ Input::old('balance') }}}">
                    
                         </div>                                                                          
                </div>
        

        <div class="form-group">
            <label for="username">Active</label>&nbsp;&nbsp;
            <input   type="checkbox" name="active" id="active" value="1">
        </div>
        
        
<style>

#ncontainer table{border-collapse:collapse;border-radius:25px;width:500px;}
table, td, th{border:1px solid #00BB64;}
#ncontainer input[type=checkbox]{height:30px;width:10px;border:1px solid #fff;}
tr,#ncontainer input,#ncontainer textarea,#fdate,#edate{height:30px;width:150px;border:1px solid #fff;}
#ncontainer textarea{height:50px; width:150px;border:1px solid #fff;}
#dcontainer #fdate,#edate{height:30px; width:180px;border:1px solid #fff;background: #EEE}
#ncontainer input:focus,#dcontainer input#fdate:focus,#dcontainer input#edate:focus,#ncontainer textarea:focus{border:1px solid yellow;} 
.space{margin-bottom: 2px;}
#ncontainer{margin-left:0px;}
.but{width:270px;background:#00BB64;border:1px solid #00BB64;height:40px;border-radius:3px;color:white;margin-top:10px;margin:0px 0px 0px 290px;}
</style>

  <style>

#dcontainer table{border-collapse:collapse;border-radius:25px;width:500px;}
table, td, th{border:1px solid #00BB64;}
#dcontainer input[type=checkbox]{height:30px;width:10px;border:1px solid #fff;}
tr,#dcontainer input,#dcontainer textarea{height:30px;width:180px;border:1px solid #fff;}\
#f{width:200px;}
#dcontainer textarea{height:50px; width:100px;border:1px solid #fff;}
#dcontainer input:focus,#dcontainer input:focus{border:1px solid yellow;} 
.space{margin-bottom: 2px;}
#dcontainer{margin-left:0px;}
.but{width:270px;background:#00BB64;border:1px solid #00BB64;height:40px;border-radius:3px;color:white;margin-top:10px;margin:0px 0px 0px 290px;}
</style>

  <style>
    label, input#cname, input#ename { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em;}
    .validateTips, .validateTips1, .validateTips2, .validateTips3, .validateTips4, .validateTips5, .validateTips6, .validateTips7, .validateTips8{ border: 1px solid transparent; padding: 0.3em; }
    .ui-dialog 
    {
    position: fixed;
    margin-bottom: 850px;
    }


    .ui-dialog-titlebar-close {
  background: url("{{ URL::asset('jquery-ui-1.11.4.custom/images/ui-icons_888888_256x240.png'); }}") repeat scroll -93px -128px rgba(0, 0, 0, 0);
  border: medium none;
}
.ui-dialog-titlebar-close:hover {
  background: url("{{ URL::asset('jquery-ui-1.11.4.custom/images/ui-icons_222222_256x240.png'); }}") repeat scroll -93px -128px rgba(0, 0, 0, 0);
}
    
  </style>
        







        
      
        
        <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-primary btn-sm">Create Account</button>
        </div>

    </fieldset>
</form>
  </div>
</div>
@stop