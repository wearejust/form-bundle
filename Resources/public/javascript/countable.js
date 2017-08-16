$(function(){
  $('.js-countable').each(function(index, item){
      item = $(item);
      let count_area =  item.find('textarea');
      let counter_attr = count_area.attr('data-length');
      let total = counter_attr - count_area.val().length;

      $('<small class="counter-text">Aantal aanbevolen karakters <span class="total_text">' + total + '</span></small>').insertAfter(count_area);
      let count_text =  item.find('.total_text');
      count_text.text(total);
      if(isNaN(total) || total <= 0) {
        count_text.addClass('error');
      }else {
        count_text.removeClass('error');
      }
      count_area.on('keyup', function(){
            let total = counter_attr - count_area.val().length;
            count_text.text(total);
            if(isNaN(total) || total <= 0) {
              count_text.addClass('error');
            }else {
              count_text.removeClass('error');
            }
      })
  });
});
