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
		<input type="text" name="room_types[0][type_name]" value="Single">
        <input type="text" name="room_types[0][rooms][]"   value="Room 101">
        <input type="text" name="room_types[0][rooms][]"   value="Room 102">
		<input type="text" name="room_types[1][type_name]" value="double">
        <input type="text" name="room_types[1][rooms][]"   value="Room 201">
        <input type="text" name="room_types[1][rooms][]"   value="Room 202">
	</div>
	</form>
	<button type="submit">Save</button>
 </body>
</html>

