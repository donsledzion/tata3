/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/postsfeed.js ***!
  \***********************************/
var ENDPOINT = "{{ url('/') }}";
var page = 1;
infinteLoadMore(page);
$(window).scroll(function () {
  if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
    page++;
    infinteLoadMore(page);
  }
});

function infinteLoadMore(page) {
  $.ajax({
    url: ENDPOINT + "/postsfeed?page=" + page,
    datatype: "html",
    type: "get",
    beforeSend: function beforeSend() {
      $('.auto-load').show();
    }
  }).done(function (response) {
    if (response.length == 0) {
      $('.auto-load').html("We don't have more data to display :(");
      return;
    }

    $('.auto-load').hide();
    $("#data-wrapper").append(response);
  }).fail(function (jqXHR, ajaxOptions, thrownError) {
    console.log('Server error occured');
  });
}
/******/ })()
;