$(function() {
    //メールアドレスのバリデーションチェック
    $('input[name="email"]').on('blur', function() {
        validateEmail();
    });

    //パスワードのバリデーションチェック
    $('input[name="password"], input[name="current_password"], input[name="new_password"]').on('blur', function() {
        validatePassword($(this));
    });

    //名前のバリデーションチェック
    $('input[name="name"]').on('blur', function() {
        validateUserName();
    });

    //ユーザー名のバリデーションチェック
    $('input[name="screen_name"]').on('blur', function() {
        validateScreenName();
    });

    //パスワード確認のバリデーションチェック
    $('input[name="password_confirmation"]').on('blur', function() {
        validatePasswordConfirmation();
    });

    //投稿タイトルのバリデーションチェック
    $('input[name="title"]').on('blur', function() {
        validatePostTitle();
    });

    //投稿内容のバリデーションチェック
    $('textarea[name="content"]').on('blur', function() {
        validatePostContent();
    });

    //自己紹介のバリデーションチェック
    $('textarea[name="introduction"]').on('blur', function() {
        validateIntroduction();
    });

    //場所のバリデーションチェック
    $('input[name="location"]').on('blur', function() {
        validateLocation();
    });
})

function validateEmail() {
    const filter = /^[a-zA-Z0-9_+-]+(.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/;
    var emailInput = $('input[name="email"]');
    var email = emailInput.val();
    var emailInvalidFeedback = $('.invalid-feedback.email');

    //メールアドレスの形式に一致しない場合は、バリデーションメッセージを表示
    if (!filter.test(email)) {
        emailInput.addClass('is-invalid');
        emailInvalidFeedback.removeClass('d-none');

        return false;
    }

    //バリデーションメッセージを非表示
    emailInput.removeClass('is-invalid');
    emailInvalidFeedback.addClass('d-none');

    return;
}

function validatePassword(passwordInput) {
    const filter = /^[a-zA-Z0-9_+-]{8,}$/;
    var password = passwordInput.val();
    var passwordInvalidFeedback = $('.invalid-feedback.password');

    //パスワードの形式に一致しない場合は、バリデーションメッセージを表示
    if (!filter.test(password)) {
        passwordInput.addClass('is-invalid');
        passwordInvalidFeedback.removeClass('d-none');

        return false;
    }

    //バリデーションメッセージを非表示
    passwordInput.removeClass('is-invalid');
    passwordInvalidFeedback.removeClass('d-none');

    return;
}

function validateUserName() {
    const filter = /^.{1,50}$/;
    var userNameInput = $('input[name="name"]');
    var userName = userNameInput.val();
    var userNameInvalidFeedback = $('.invalid-feedback.user-name');

    //ユーザー名の形式に一致しない場合は、バリデーションメッセージを表示
    if (!filter.test(userName)) {
        userNameInput.addClass('is-invalid');
        userNameInvalidFeedback.removeClass('d-none');

        return false;
    }

    //バリデーションメッセージを非表示
    userNameInput.removeClass('is-invalid');
    userNameInvalidFeedback.addClass('d-none');

    return;
}

function validateScreenName() {
    const filter = /^[a-zA-Z0-9]{4,14}$/;
    var screenNameInput = $('input[name="screen_name"]');
    var screenName = screenNameInput.val();
    var screenNameInvalidFeedback = $('.invalid-feedback .screen-name');

    //スクリーンネームの形式に一致しない場合は、バリデーションメッセージを表示
    if (!filter.test(screenName)) {
        screenNameInput.addClass('is-invalid');
        screenNameInvalidFeedback.removeClass('d-none');

        return false;
    }

    //バリデーションメッセージを非表示
    screenNameInput.removeClass('is-invalid');
    screenNameInvalidFeedback.addClass('d-none');

    return;
}

function validatePasswordConfirmation() {
    var passwordConfirmationInput = $('input[name="password_confirmation"]');
    var password = $('input[name="password"]').val();
    var passwordConfirmation = passwordConfirmationInput.val();
    var passwordConfirmationInvalidFeedback = $('.invalid-feedback .password-confirmation');

    //パスワードとパスワードの確認が一致しない場合は、バリデーションメッセージを表示
    if (password !== passwordConfirmation) {
        passwordConfirmationInput.addClass('is-invalid');
        passwordConfirmationInvalidFeedback.removeClass('d-none');

        return false;
    }

    //バリデーションメッセージを非表示
    passwordConfirmationInput.removeClass('is-invalid');
    passwordConfirmationInvalidFeedback.addClass('d-none');

    return;
}

function validatePostTitle() {
    const filter = /^.{1,30}$/;
    var postTitleInput = $('input[name="title"]');
    var postTitle = postTitleInput.val();
    var postTitleInvalidFeedback = $('.invalid-feedback .title');

    //投稿タイトルの形式に一致しない場合は、バリデーションメッセージを表示
    if (!filter.test(postTitle)) {
        postTitleInput.addClass('is-invalid');
        postTitleInvalidFeedback.removeClass('d-none');

        return false;
    }

    //バリデーションメッセージを非表示
    postTitleInput.removeClass('is-invalid');
    postTitleInvalidFeedback.removeClass('d-none');

    return;
}

function validatePostContent() {
    const filter = /^.{1,255}$/;
    var postContentInput = $('textarea[name="content"]');
    var postContent = postContentInput.val();
    var postContentInvalidFeedback = $('.invalid-feedback .content');

    //投稿内容の形式に一致しない場合は、バリデーションメッセージを表示
    if (!filter.test(postContent)) {
        postContentInput.addClass('is-invalid');
        postContentInvalidFeedback.removeClass('d-none');

        return false;
    }

    //バリデーションメッセージを非表示
    postContentInput.removeClass('is-invalid');
    postContentInvalidFeedback.addClass('d-none');

    return;
}

function validateIntroduction() {
    const filter = /^.{0,160}$/;
    var introductionInput = $('textarea[name="introduction"]');
    var introduction = introductionInput.val();
    var introductionInvalidFeedback = $('.invalid-feedback .introduction');

    //自己紹介の形式に一致しない場合は、バリデーションメッセージを表示
    if (!filter.test(introduction)) {
        introductionInput.addClass('is-invalid');
        introductionInvalidFeedback.removeClass('d-none');

        return false;
    }

    //バリデーションメッセージを非表示
    introduction.removeClass('is-invalid');
    introductionInvalidFeedback.addClass('d-none');

    return;
}

function validateLocation() {
    const filter = /^.{0,30}$/;
    var locationInput = $('input[name="location"]');
    var location = locationInput.val();
    var locationInvalidFeedback = $('.invalid-feedback .location');

    //場所の形式に一致しない場合は、バリデーションメッセージを表示
    if (!filter.test(location)) {
        locationInput.addClass('is-invalid');
        locationInvalidFeedback.removeClass('d-none');

        return false;
    }

    //バリデーションメッセージを非表示
    locationInput.removeClass('is-invalid');
    locationInvalidFeedback.removeClass('d-none');

    return;
}

