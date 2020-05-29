jQuery(document).ready(function ($) {
  $('#main-menu a').on('click', function () {
    var $t = $(this)
    var url = $t.attr('href').split('#')[0]
    var test = window.location.origin + window.location.pathname

    if (url === test) {
      $('#main-nav, #menu-bg').removeClass('active')
      $('#menu-toggle').removeClass('is-active')
      $('body').removeClass('state-menu-open')
    }
  })

  $('#menu-toggle').on('click', function () {
    $('body').toggleClass('state-menu-open')
  })
})
