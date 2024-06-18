document.write('<script type="text/javascript" src="/summernote/lang/summernote-ko-KR.js"><\/script>');

var summerContent = [];

function sendFile(files, el) {
	data = new FormData();
	data.append("file", files);
	$.ajax({
		url: "/ajax/uploader.php",
		data: data,
		cache: false,
		contentType: false,
		enctype: 'multipart/form-data',
		processData: false,
		type: 'POST',
		success: function(data){
			$(el).summernote("insertImage", data, 'filename');
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus+" "+errorThrown);
		}
	});
}