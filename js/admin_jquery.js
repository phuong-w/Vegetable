// function updateThumbnail() {
//     var thumbnail_src = '../images/products/' + $('#thumbnail').val()
//     $('#img_thumbnail').attr('src', thumbnail_src)
// }

$(function() {
    $('#content').summernote({
        height: 300, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        placeholder: 'Mô tả chi tiết sản phẩm ...'
    });
})