<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IP Storage form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
    
</head>
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit],[type=button] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  
}

input[type=submit],[type=button]:hover {
  background-color: #45a049;
}
input[type=submit],[type=button]:disabled {
  background-color: #dddddd;
}


.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-45 {
  float: left;
  width: 45%;
  margin-top: 6px;
}

.col-55 {
  float: left;
  width: 55%;
  margin-top: 6px;
}


.row:after {
  content: "";
  display: table;
  clear: both;
}
.error {
  display: none;
  clear: both; 
  color: #FF0000;
}


@media screen and (max-width: 600px) {
  .col-45, .col-55, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>

<body>
  <div class="container">

  <form name="myForm" id="myForm" action="ipsaving.html"  onsubmit="return validateForm()" method="post">
   <input type="hidden" id="usertype" name="usertype" value="">
    <input type="hidden" id="iCnt" name="iCnt" value="1">
   


    <div class="row">
    <div class="col-45">
    <input type="text" class="input" id="tb1" name="ip_box[]" value="" onblur="OnKeyUpValue()">
    </div>
    <div class="col-55">
    <input type="button" id="1" value="-" class="bt btRemove" onclick="btRemove(1)"  />
    <input type="button" id="btAdd" value="+" class="bt" />
    
    </div>
     </div>

    <div id="holder"></div>

    <label id="excess_limit" class="error">Reached the limit</label>
    <label id="validationBlank"  class="error">Please Enter Value</label>
    <label id="validationIP" class="error">Please Enter Proper IP Address</label>

     <div class="row">
    <div class="col-45">
    <input type="button" class="bt" onclick="GetTextValue()" id="btSubmit" disabled="" value="Save">
    </div>
    
    </div>



</form>
</div>
<script>
 
    $(document).ready(function() {

      if (typeof(Storage) !== "undefined") {
      var usertype=localStorage.getItem("usertype");
      console.log(usertype);
      document.getElementById("usertype").value = usertype;
      }
        
        var container = $(document.createElement('div'));

        $('#btAdd').click(function() {
          var usertype=$('#usertype').val();
          var iCnt = $('#iCnt').val();
          var maxitem = usertype==1 ? "5" : "10";
          //alert(iCnt+"----"+maxitem);

            if (iCnt <= maxitem-1) {
                iCnt = parseInt(iCnt) + 1;
                $('#iCnt').val(iCnt);
                $(container).append('<div id=tb' + iCnt + '><div class="row"><div class="col-45"><input type=text class="input" name="ip_box[]"   ' + 'value="" onblur="OnKeyUpValue()" /></div><div class="col-55"><input type="button" id="'+iCnt+'" value="-" class="bt btRemove" onclick="btRemove('+iCnt+')"   /></div></div></div>');    

                $('#holder').after(container);
            }

            else {      
                
                $('#excess_limit').show();
                $('#btAdd').attr('class', 'bt-disable'); 
                $('#btAdd').attr('disabled', 'disabled');
            }
        });

  

    });
    function btRemove(iCnt) {
       //alert(iCnt);

          if(iCnt==1)
          {
                 $('#tb' + iCnt).val('');
          }      
          else
          {
            $('#tb' + iCnt).remove(); 
            $('#btAdd').removeAttr('disabled').attr('class', 'bt');
            $('#excess_limit').hide();

            var iCntCount = $('#iCnt').val();
            iCntCount = parseInt(iCntCount) - 1;
            $('#iCnt').val(iCntCount);

          }

     }


  function OnKeyUpValue() {
      var values = '';
       $('.input').each(function() {
            
            if(this.value!='')
            {
              
          if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(this.value))
          {
               $('#btSubmit').removeAttr('disabled').attr('class', 'bt');
               $('#validationIP').hide();
                values += this.value + ',';
          }
          else
          {
                $('#validationIP').show();
                $('#btSubmit').attr('class', 'bt-disable'); 
                $('#btSubmit').attr('disabled', 'disabled');
                return false;
          }
               
            }
           
        });

      
  
    }

    var divValue, values = '';
    function GetTextValue() {

       var values = '';

       $(divValue) 
            .empty() 
            .remove(); 

       $('.input').each(function() {
            divValue = $(document.createElement('div')).css({
                padding:'5px', width:'200px'
            });
            if(this.value!='')
            {
              values += this.value + '<br> ';
            }
           
        });
       let ip_address=values;
       localStorage.setItem("ip_address", ip_address);
       var ip_address_item= localStorage.getItem("ip_address");
       console.log(ip_address_item);
        $(divValue).append('<p><b>Your IP Address : </b></p>' + ip_address_item);
        $('body').append(divValue);
  
    }
</script>
</body>
</html>