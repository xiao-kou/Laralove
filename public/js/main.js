$(document).ready(function(){
    //メッセージの未読通知を取得
    getUnreadNotificationMessages()

    //画像投稿のプレビュー
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

    //プロフィール画像の編集
    $('#profile_image_settings_area').click(function(){
        $('input[name=input_image]').click();
        $('input[name=input_image]').change(function(evt) {
            var file = evt.target.files[0];

            if (file === void 0) return false; //ファイルが存在しない場合は処理を終了

            var reader = new FileReader();

            reader.readAsDataURL(file);

            reader.onload = (function(theFile) {
                $('#profile_image').attr('src', theFile.target.result);
            });

        });
    })

    //ユーザー設定画面のタブ切り替え
    $('.user_edit .nav-item').click(function(){
        //クリックしたタブコンテンツのID名を取得
        var activation = $(this).data('tab');

        //クリックしたタブコンテンツをアクティブに変更
        $(activation).addClass('d-block').removeClass('d-none');

        //クリックしたタブコンテンツのインプット要素を送信可能に変更
        $(activation).find('input').prop('disabled', false);

        //クリックしていないタブコンテンツを非アクティブに変更
        $('.tab-pane').not(activation).addClass('d-none').removeClass('d-block');

        //クリックしていないタブコンテンツのインプット要素を送信不可に変更
        $('.tab-pane').not(activation).find('input').prop('disabled', true);
    })

    //フォロー処理
    $(document).on('click', '.btn_follow', function(){
        var userId = $(this).data('user-id');

        //Ajax処理
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/users/${userId}/follow`,
            method: 'POST',
            data: {
                'user_id': userId
            },
        })
        //成功した場合
        .done(function(data) {
            //デバッグログ
            console.log('ajax success', data);
            //フォローボタンをフォロー中に変更
            $('.btn_follow').text('フォロー中').removeClass('btn_follow btn-primary').addClass('btn_unfollow btn-secondary');
            //フォロワーの数を変更
            if ($('#followers_count').length) {
                $('#followers_count').text(data.followers_count);
            }
        })
        .fail(function() {
            console.log('ajax fail');
        });
    });

    //アンフォロー処理
    $(document).on('click', '.btn_unfollow', function(){
        var userId = $(this).data('user-id');

        //Ajax処理
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/users/${userId}/unfollow`,
            method: 'POST',
            data: {
                'user_id': userId,
                '_method': 'DELETE'
            },
        })
        //成功した場合
        .done(function(data) {
            //デバッグログ
            console.log('ajax success', data);
            //フォロー中をフォローボタンに変更
            $('.btn_unfollow').text('フォロー').removeClass('btn_unfollow btn-secondary').addClass('btn_follow btn-primary');
            //フォロワーの数を変更
            $('#followers_count').text(data.followers_count);
        })
        .fail(function() {
            console.log('ajax fail');
        });
    });

    //いいね登録処理
    $(document).on('click', '.btn_like', function(){
        var postId = $(this).data('post-id');

        //ajax処理
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/like/${postId}`,
            method: 'POST',
            data: {
                'post_id': postId
            },
        })
        //成功した場合
        .done(function(data) {
            //デバッグログ
            console.log('ajax success', data);
            //いいね中をいいねボタンに変更
            $('.btn_like').text('いいね中 ' + data.likes_count).removeClass('btn_like btn-primary').addClass('btn_unlike btn-secondary');
        })
        .fail(function() {
            console.log('ajax fail');
        });
    });

    //いいね解除処理
    $(document).on('click', '.btn_unlike', function(){
        var postId = $(this).data('post-id');

        //ajax処理
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `/unlike/${postId}`,
            method: 'POST',
            data: {
                'post_id': postId,
                '_method': 'DELETE'
            },
        })
        //成功した場合
        .done(function(data) {
            //デバッグログ
            console.log('ajax success', data);
            //いいね中をいいねボタンに変更
            $('.btn_unlike').text('いいね ' + data.likes_count).removeClass('btn_unlike btn-secondary').addClass('btn_like btn-primary');
        })
        .fail(function(data) {
            console.log('ajax fail');
        })
    })

    //新規メッセージの通知イベント
    window.Echo.channel("notification-added-channel").listen("NotificationAdded", e => {
        console.log(e);
        var receiverId = e.notification.receiver_id;

        //カレントユーザーのIDを取得
        $.ajax({
            url: '/get-current-userid',
            method: 'GET',
            dataType: 'json',
        })
        //成功した場合
        .done(function(currentUserId) {

            //自分以外が受信したダイレクトメッセージは処理しないで終了
            if (receiverId !== currentUserId) {
                return false;
            }

            //未読の通知を追加
            var unreadCount = parseInt($('.unread .count').text(), '10') + 1;
            $('.unread .count').text(unreadCount);

            //メッセージの通知を表示
            $('.unread').removeClass('d-none');

        })
        .fail(function(data) {
            console.log('ajax fail');
        })
    })

});

//メッセージの未読通知を取得する
function getUnreadNotificationMessages() {
    //ajax処理
    $.ajax({
        url: '/notifications/get-unread-messages',
        method: 'GET',
        dataType: 'json',
    })
    //成功した場合
    .done(function(unreadNotificationMessages) {
        console.log(unreadNotificationMessages.length);

        var unreadCount = unreadNotificationMessages.length;

        //メッセージの未読の通知件数を表示
        $('.unread .count').text(unreadCount);

        //メッセージの通知を表示
        if (unreadCount) {
            $('.unread').removeClass('d-none');
        }
    })
}