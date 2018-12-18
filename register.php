<!DOCTYPE HTML>
<html>
	<head>
		<title>register</title>
<!--<script type="text/javascript" src="ajax.js"></script> -->
	</head>
<body>
	
<div id= "panel">
	<form action ="customer_register.php" name="Reg" method = "post" onsubmit="check(this); return false;">
	
		<div class = "Reg">
			<span>Username</span>
			<input type = "text" name = "LoginID" onblur="checkname();" value="" required="required"/>
		<span id="checkbox"></span>
		</div>

		<div class = "Password">
			<span>Password</span>
			<input type = "password" name = "Password" value="" required="required"/>
		</div>

		<div class= "Retype Password">
			<span>Retype Password</span>
			<input type = "password" name="Retype_Password" value="" required="required"/>
		</div>

		<div class= "First Name">
			<span>First Name</span>
			<input type = "text" name="First_Name" value="" required="required"/>
		</div>

		<div class= "Last Name">
			<span>Last Name</span>
			<input type = "text" name="Last_Name" value="" required="required"/>
		</div>

		<div class= "TEL">
			<span>TEL</span>
			<input type = "text" name="TEL" value="" required="required"/>
		</div>

		<div class= "Address">
			<span>Address</span>
			<input type = "text" name="Address" value="" required="required"/>
		</div>

		<div class= "City">
			<span>City</span>
			<input type = "text" name="City" value="" required="required"/>
		</div>

		<div class= "Zipcode">
			<span>Zipcode</span>
			<input type = "text" name="Zipcode" value="" required="required"/>
		</div>

		<div class= "State">
			<span>State</span>
			<select name="State" required="required">
        	<option value=""></option>
        	<option value="AL">Alabama</option>
        	<option value="AK">Alaska</option>
        	<option value="AZ">Arizona</option>
        	<option value="AR">Arkansas</option>
        	<option value="CA">California</option>
        	<option value="CO">Colorado</option>
        	<option value="CT">Connecticut</option>
        	<option value="DE">Delaware</option>
        	<option value="DC">District Of Columbia</option>
        	<option value="FL">Florida</option>
        	<option value="GA">Georgia</option>
        	<option value="HI">Hawaii</option>
        	<option value="ID">Idaho</option>
        	<option value="IL">Illinois</option>
        	<option value="IN">Indiana</option>
        	<option value="IA">Iowa</option>
        	<option value="KS">Kansas</option>
        	<option value="KY">Kentucky</option>
        	<option value="LA">Louisiana</option>
        	<option value="ME">Maine</option>
        	<option value="MD">Maryland</option>
        	<option value="MA">Massachusetts</option>
        	<option value="MI">Michigan</option>
        	<option value="MN">Minnesota</option>
        	<option value="MS">Mississippi</option>
        	<option value="MO">Missouri</option>
        	<option value="MT">Montana</option>
        	<option value="NE">Nebraska</option>
        	<option value="NV">Nevada</option>
        	<option value="NH">New Hampshire</option>
        	<option value="NJ">New Jersey</option>
        	<option value="NM">New Mexico</option>
        	<option value="NY">New York</option>
        	<option value="NC">North Carolina</option>
        	<option value="ND">North Dakota</option>
        	<option value="OH">Ohio</option>
        	<option value="OK">Oklahoma</option>
        	<option value="OR">Oregon</option>
        	<option value="PA">Pennsylvania</option>
        	<option value="RI">Rhode Island</option>
        	<option value="SC">South Carolina</option>
        	<option value="SD">South Dakota</option>
        	<option value="TN">Tennessee</option>
        	<option value="TX">Texas</option>
        	<option value="UT">Utah</option>
        	<option value="VT">Vermont</option>
        	<option value="VA">Virginia</option>
        	<option value="WA">Washington</option>
        	<option value="WV">West Virginia</option>
        	<option value="WI">Wisconsin</option>
        	<option value="WY">Wyoming</option>
			</select>
		</div>

		<div>
			<input type="submit" value= "Sign up">
		</div>

	</form>
</div>
<!--
<script type= "text/javascript">
//<![CDATA[
function check(form){
if(form.username.value == ''){
alert('username cannot be empty');
return;
}
if (form.password.value == ''){
alert('password cannot be empty');
return;
}
if(form.password.value!= form.confirm_password.value){
alert('entered passwords differ');
return;
}
form.submit();
}
//]]>
</script>
-->
</body>
</html>
