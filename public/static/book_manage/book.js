    var profile = $("#profile");
    var bookInfo = $("#bookInfo");
    const toggle = $(".toggle");
    var myborrow_book = $("#myborrow_book");
    var search = $("#search");
    var myperson = $("#myperson");
    var mypwd = $("#mypwd");
    //我的借阅
    $("#mobile-borrow-trigger").click(function () {
    profile.removeClass("hidden");
    bookInfo.removeClass("flex");
    bookInfo.addClass("hidden");
    myborrow_book.removeClass("hidden");
    myborrow_book.addClass("flex");
    myperson.addClass("hidden");
    myperson.removeClass("flex");
    mypwd.addClass("hidden");
    mypwd.removeClass("flex");
    toggle.removeClass("open");
});
    //个人中心
    $("#mobile-person-trigger").click(function () {
    profile.removeClass("hidden");
    bookInfo.removeClass("flex");
    bookInfo.addClass("hidden");
    myborrow_book.addClass("hidden");
    myborrow_book.removeClass("flex");
    myperson.removeClass("hidden");
    myperson.addClass("flex");
    mypwd.addClass("hidden");
    mypwd.removeClass("flex");
    toggle.removeClass("open");
});
    //个人密码
    $("#mobile-pwd-trigger").click(function () {
    profile.removeClass("hidden");
    bookInfo.removeClass("flex");
    bookInfo.addClass("hidden");
    myborrow_book.addClass("hidden");
    myborrow_book.removeClass("flex");
    myperson.addClass("hidden");
    myperson.removeClass("flex");
    mypwd.removeClass("hidden");
    mypwd.addClass("flex");
    toggle.removeClass("open");
});
    $("#mobile-all_book-trigger").click(function () {
    var url=new URL(window.location.href);
    if (!url.search) {
    profile.addClass("hidden");
    bookInfo.addClass("flex");
    bookInfo.removeClass("hidden");
    myborrow_book.addClass("hidden");
    myborrow_book.removeClass("flex");
    myperson.addClass("hidden");
    myperson.removeClass("flex");
    mypwd.addClass("hidden");
    mypwd.removeClass("flex");
    toggle.addClass("open");
} else {
    window.location.replace("userView");
}
});