jQuery(function($){
    var myTextarea = document.getElementById('sourcecode_val');

    // Khởi tạo editor
    var editor = CodeMirror.fromTextArea(myTextarea, {
        lineNumbers: true,
        mode: "application/x-httpd-php",
        keyMap: "sublime",
        autoCloseBrackets: true,
        matchBrackets: true,
        showCursorWhenSelecting: true,
        theme: "monokai",
        tabSize: 4
    }).on('change', editor => {
        var v = editor.getValue();
        $('#slugdiv #post_name').attr('readonly',true);
        $('#pageparentdiv #page_template').attr('readonly',true);
    });

    // editor.focus();
    // editor.setCursor({line: 0});
    // editor.setSize('100%', '100%');

    // Khi thay đổi slug
    $('#slugdiv #post_name').on('keyup',function(){
        $('#has_change_slug').val('changed');
        $('#edit_file_page .inside').addClass('readonly');
    });

    // Khi thay đổi template
    $('#pageparentdiv #page_template').on('change',function(){
        $('#has_change_template').val('changed');
        $('#edit_file_page .inside').addClass('readonly');
    });

    // Khi chưa có file để hiển thị
    $('#edit_file_page>.inside>.CodeMirror').addClass('not_change');
    $('#edit_file_page #btn_create_file').on('change',function(){
        var value = $(this).prop('checked');
        if( value ){
            $('#edit_file_page>.inside>.CodeMirror').removeClass('not_change');
        }else{
            $('#edit_file_page>.inside>.CodeMirror').addClass('not_change');
        }
    });
});
