$(function() {
    //メイン処理終了後画面下までスクロールする
    setTimeout(function() {
        window.scroll(0,$(document).height());
    },0);

    //メッセージ取得をポーリングする
    // setTimeout(function() {
    //     getMessages();
    // },5000);

    //メッセージの画像添付処理
    $('#btn_attach_image').click(function(){
        $('input[name=input_file]').click();
        //画像選択後のプレビュー
        $('input[name=input_file]').on('change', function(evt) {
            var file = evt.target.files[0];

            var reader = new FileReader();

            reader.readAsDataURL(file);

            reader.onload = (function (theFile) {
                $('#attach_image_area').find('img').attr('src', theFile.target.result)
            });

            $('#attach_image_area').removeClass('d-none');
        });
    })

    //画像添付プレビューのバツボタン押下処理
    $('#btn_close').on('click', function() {
        $('input[name=input_file]').val('');
        $('#attach_image_area').addClass('d-none');
    })

    $('#btn_send_message').click(function(){
        //フォームのデータを取得
        var formData = new FormData($('#form_message').get(0));

        //ajax処理
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/messages/send',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
        })
        //成功した場合
        .done(function(data) {
            //デバッグログ
            console.log('ajax success', data);
            //画像が存在する場合
            // var html = '';
            // if (data.file_path !== void 0){
            //     html += `
            //                 <div class="d-flex flex-row-reverse align-items-center mt-3">
            //                     <div class="balloon-right w-50 text-center">
            //                         <img src="../${data.file_path}" alt="" class="w-100">
            //                     </div>
            //                 </div>
            //     `;
            // }
            // if (data.text !== null) {
            //     html += `
            //                 <div class="d-flex flex-row-reverse align-items-center mt-3">
            //                     <div class="balloon-right">
            //                         <h5 class="text-center">${data.text}</h5>
            //                     </div>
            //                 </div>
            //     `;
            // }

        })
        .fail(function(data) {
            console.log('ajax fail');
        })

        $('#text').val('');
        $('input[name=input_file]').val('');
        $('#attach_image_area').addClass('d-none');
    })

    //pusherのイベント処理
    window.Echo.channel("message-added-channel").listen("MessageAdded", e => {
        const userId = $('meta[name="csrf-token"]').data('user-id');
        var html = '';

        console.log('connecting to pusher', e, userId);

        //自分以外へのダイレクトメッセージは表示しないで処理終了
        if (!e.message.participant_ids.includes(userId)) {
            exit;
        }

        //メッセージを作成
        if (e.message.user_id === userId) {
            if (e.message.file_path !== void 0) {
                html += `
                            <div class="d-flex flex-row-reverse align-items-center mt-3">
                                <div class="balloon-right w-50 text-center">
                                    <img src="../${e.message.file_path}" alt="" class="w-100">
                                </div>
                            </div>
                `;
            }
            if (e.message.text !== null) {
                html += `
                            <div class="d-flex flex-row-reverse align-items-center mt-3">
                                <div class="balloon-right">
                                    <h5 class="text-center">${e.message.text}</h5>
                                </div>
                            </div>
                `;
            }
        } else {
            if (e.message.file_path !== void 0) {
                html += `
                            <div class="d-flex justify-content-start align-items-center mt-3">
                                <a href="{{ route('users.show', $user_message->id) }}" class="mr-2 text-decoration-none">
                                    <img src="../${e.message.profile_image_path}" alt="" class="rounded-circle circle-sm">
                                </a>
                                <div class="balloon-left w-50 text-center">
                                    <img src="../${e.message.file_path}" alt="" class="w-100">
                                </div>
                            </div>
                `;
            }
            if (e.message.text !== null) {
                html += `
                            <div class="d-flex justify-content-start align-items-center mt-3">
                                <a href="{{ route('users.show', $user_message->id) }}" class="mr-2 text-decoration-none">
                                    <img src="../${e.message.profile_image_path}" alt="" class="rounded-circle circle-sm">
                                </a>
                                <div class="balloon-left">
                                    <h5 class="text-center">${e.message.text}</h5>
                                </div>
                            </div>
                `;
            }
        }

        $('#message_data').append(html);

        if (e.message.user_id === userId ) {
            window.scroll(0,$(document).height());
        }

    });

});

//メッセージを取得する (メッセージの取得をポーリングからPusherに変更したため一旦コメントアウト)
// function getMessages() {
//     //ルーム名を取得
//     const path = location.pathname.split('/');
//     const roomName = path.pop();
//     const userId = $('meta[name="csrf-token"]').data('user-id');

//     //ajax処理
//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url: '/messages/get-latest',
//         method: 'POST',
//         data: {
//             name: roomName
//         },
//     })
//     //成功した場合
//     .done(function(data) {
//         //デバッグログ
//         console.log('ajax success', data);

//         $('#message_data').remove();
//         $('.container').after('<div id="message_data" class="mb-5 pb-5 container"></div>');

//         var html = '';

//         $.each(data, function(index, val){
//             //自分の投稿の場合
//             if (val.pivot.user_id == userId) {
//                 //画像が存在する場合
//                 if (val.pivot.file_path !== void 0){
//                     html += `
//                                 <div class="d-flex flex-row-reverse align-items-center mt-3">
//                                     <div class="balloon-right w-50 text-center">
//                                         <img src="../${val.pivot.file_path}" alt="" class="w-100">
//                                     </div>
//                                 </div>
//                     `;
//                 }
//                 //テキストメッセージが存在する場合
//                 if (val.pivot.text !== null) {
//                     html += `
//                                 <div class="d-flex flex-row-reverse align-items-center mt-3">
//                                     <div class="balloon-right">
//                                         <h5 class="text-center">${val.pivot.text}</h5>
//                                     </div>
//                                 </div>
//                     `;
//                 }
//             } else {
//                 //相手の投稿の場合
//                 //画像が存在する場合
//                 if (val.pivot.file_path !== void 0){
//                     html += `
//                                 <div class="d-flex justify-content-start align-items-center mt-3">
//                                     <a href="{{ route('users.show', $user_message->id) }}">
//                                         <img src="../${val.profile_image_path}" alt="" class="rounded-circle circle-sm mr-2">
//                                     </a>
//                                     <div class="balloon-left w-50 text-center">
//                                         <img src="../${val.pivot.file_path}" alt="" class="w-100">
//                                     </div>
//                                 </div>
//                     `;
//                 }
//                 //テキストメッセージが存在する場合
//                 if (val.pivot.text !== null) {
//                     html += `
//                                 <div class="d-flex justify-content-start align-items-center mt-3">
//                                     <a href="{{ route('users.show', $user_message->id) }}">
//                                         <img src="../${val.profile_image_path}" alt="" class="rounded-circle circle-sm mr-2">
//                                     </a>
//                                     <div class="balloon-left">
//                                         <h5 class="text-center">${val.pivot.text}</h5>
//                                     </div>
//                                 </div>
//                     `;
//                 }
//             }
//         });

//         $('#message_data')[0].innerHTML = html;

//     })
//     .fail(function() {
//         console.log('ajax fail');
//     })

//     setTimeout("getMessages()", 5000);

// }
