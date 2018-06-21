$('#datemax').datepicker({
    language: 'en',
    maxDate: new Date() 
});

$('#datemin').datepicker({
    language: 'en',
    minDate: new Date() 
});

function deleteItem($url, $csrf_token) {
    swal({
        title: "Are you sure?",
        text: "Once click, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then(function (willDelete) {
        if (willDelete) {
            $('<form>', {
                "html": '<input name="_token" type="hidden" value="' + $csrf_token + '"><input name="_method" type="hidden" value="DELETE">',
                "action": $url,
                "method": 'POST'
            }).appendTo(document.body).submit();
        }
    });
}

function ValidateFileUpload() {
        var fuData = document.getElementById('pictureFile');
        var FileUploadPath = fuData.value;
        if (FileUploadPath == '') {
            swal("Stop!", "Please upload an image", "error");
        } else {
            var Extension = FileUploadPath.substring(
            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                    || Extension == "jpeg" || Extension == "jpg") {

                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }

            }else {
                swal("Stop!", "Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ", "error");
            }
        }
    }