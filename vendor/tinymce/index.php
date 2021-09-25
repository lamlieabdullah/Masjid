<!DOCTYPE html>
<html>
<head>
  <script src="js/tinymce/tinymce.min.js"></script>
  <script>
  tinymce.init({
    selector: 'textarea',
    images_upload_url: 'postAcceptor.php',
    images_upload_base_path: 'http://10.148.2.172/tinymce/',
    height: 100,
    theme: 'modern',
    plugins: 'code print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
    toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
  toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | image code | insertdatetime preview | forecolor backcolor table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking template pagebreak restoredraft",
    image_advtab: false,
    templates: [
      { title: 'Test template 1', content: 'Test 1' },
      { title: 'Test template 2', content: 'Test 2' }
    ],
  mobile: {
    theme: 'mobile',
    plugins: [ 'autosave', 'lists', 'autolink' ],
    toolbar: [ 'undo', 'redo', 'bullist', 'numlist', 'styleselect','image', 'formatselect', 'fontsizeselect', 'forecolor']
  }
});
</script>
</head>
<body>
  <textarea>Next, start a free trial!</textarea>
</body>
</html>
