$(function () {
    $('.mobile-menu-toggle').on('click', function () {
       $('.mobile-menu-toggle').toggleClass('active');
       $('.mobile-menu').toggleClass('active');
        var header = $('header').height();
        $('.mobile-menu').css({'top': header});
    });
   // Popup
   var $popup_btn = $('.btn-popup, .btn-popup-no-style');
   var $popup_close = $('.pop-up .close-pop-up, .pop-up .close');
   $popup_btn.on('click', function () {
      var target = $(this).attr('data-popup');
      var $popup = $('.pop-up[data-popup="'+target+'"]');
      if ($popup.length) {
          $popup.addClass('active');
          $('.overlay').addClass('active');
      }
   });
    $popup_close.on('click', function () {
       $(this).parents('.pop-up').removeClass('active');
        $('.overlay').removeClass('active');
    });
    $('.overlay').on('click', function () {
        if ($('.pop-up.active').length) {
            $('.pop-up').removeClass('active');
            $(this).removeClass('active');
        }
    });
    // Select customizer
    $('select.customize-select').each(function(){
        var $this = $(this), numberOfOptions = $(this).children('option').length;

        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled placeholder"></div>');

        var $styledSelect = $this.next('div.select-styled');
        $styledSelect.text($this.children('option:selected').text());

        var $list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function(e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function(){
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function(e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            if ($(this).attr('rel') == "false"){
                $styledSelect.addClass('placeholder');
            }else{
                $styledSelect.removeClass('placeholder');
            }
            $this.val($(this).attr('rel'));
            $this.find('option[value="'+$(this).attr('rel')+'"]').prop('selected', 'selected');
            $list.hide();
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
            $list.hide();
        });
    });
    $('.up-btn').on('click', function () {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });
    $(window).on('scroll load', function () {
       var header = $('header').height();
       var current_position = $(window).scrollTop();
       if (current_position >= header){
           $('.scroll-bar').addClass('active');
       }else{
           $('.scroll-bar').removeClass('active');
       }
    });
});