<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <body>
    <form name="insertForm" id="insertForm" method="post" action="room_upd.php">
	<div class="room_type" style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px;">
		<h4>Room Type</h4>
		<label>Room Type Name:</label>
		<input type="text" name="bed_type[]" value="룸-1">
        <input type="text" name="bed_price[]"   value="10000">
        <input type="text" name="option_val[][]" value="옵션1-1">
        <input type="text" name="option_val[][]" value="옵션1-2">
		<input type="text" name="bed_type[]" value="룸-2">
        <input type="text" name="bed_price[]"   value="20000">
        <input type="text" name="option_val[][]" value="옵션2-1">
        <input type="text" name="option_val[][]" value="옵션2-2">
	</div>
	</form>
	<button type="button" id="room_upd">Save</button>
 </body>
 
 <script>
	$("#room_upd").one("click", function () { 
		   $("#insertForm").submit();
	}); 
 </script>
 
</html>

