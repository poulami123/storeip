<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: left;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-10 {
  float: left;
  width: 10%;
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


@media screen and (max-width: 600px) {
  .col-10, .col-55, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>
<div class="container">
  <form name="myForm" id="myForm" action="ip_store.php"  onsubmit="return validateForm()" method="post">
    <div class="row">
      <div class="col-10">
        <label for="usertype">User Type</label>
      </div>
      <div class="col-55">
        <select name="usertype" id="usertype">
          <option value="1">Basic</option>
          <option value="2">Premium</option>
          </select>
      </div>
    </div>
   <div class="row">
       <div class="col-10">
        
      </div>
       <div class="col-55">
        <input type="submit" value="Submit">
      </div>
    </div>
  </form>
</div>
<script>
function validateForm() {
  var usertype = document.forms["myForm"]["usertype"].value;
  if ( usertype== "") {
    alert("User Type must be filled out");
    return false;
  }
  else
  {
        if (typeof(Storage) !== "undefined") {
          localStorage.setItem("usertype", usertype);
          
        } 

  }
}
</script>
</body>
</html>
