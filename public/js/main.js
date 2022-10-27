$(document).ready(function(){
    $('.custom-file-input').on('change', handleFileSelect);
        function handleFileSelect(evt) {
            var files = evt.target.files;

            if (files[0] === void 0) return false; //ファイルが存在しない場合は処理を終了

            $('#preview').remove();// 繰り返し実行時の処理
            $(this).parents('.input-file').after('<div id="preview" class="row"></div>');

            for (var i = 0, f; f = files[i]; i++) {

                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                        if (theFile.type.match('image.*')) {
                            var $html = ['<div class="d-inline-block mb-2 col-md-12 text-center"><img class="img-thumbnail" src="', e.target.result,'" style="height:150px;" /></div>'].join('');// 画像では画像のプレビューとファイル名の表示
                        } else {
                            var $html = ['<div class="d-inline-block mr-1" style="word-break: break-all;"><span class="small">', escape(theFile.name),'</span></div>'].join('');//画像以外はファイル名のみの表示
                        }

                        $('#preview').append($html);
                    };
                })(f);

                reader.readAsDataURL(f);
            }
            $(this).next('.custom-file-label').html(+ files.length + '個のファイルを選択しました');
        }

        //ファイルの取消
        $('.reset').click(function(){
            $(this).parent().prev().children('.custom-file-label').html('ファイル選択...');
            $('#preview').remove();
            $('.custom-file-input').val('');
        })

});