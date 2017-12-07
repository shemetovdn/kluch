/**
 * Created by Pavel on 10.01.2015.
 */
(function(){
    $.fn.customRadioCheck = function() {

        return this.each(function() {
            var $this = $(this);
            var $span = $('<span/>');
            if($this.parent('label').hasClass('custom-label')) return;

            $span.addClass('custom-'+ ($this.is(':checkbox') ? 'check' : 'radio'));
            $this.is(':checked') && $span.addClass('checked'); // init
            if ($this.is(':radio')) {
                $this.parent('label').append($span);//.insertBefore($this);
            }else{
                $span.insertAfter($this);
            }

            $this.parent('label').addClass('custom-label')
                .attr('onclick', ''); // Fix clicking label in iOS
            if ($this.is(':radio')) {
                $this.parent('label').addClass('radio')
            }
            // hide by shifting left
            $this.css({ position: 'absolute', left: '-9999px' });

            // Events
            $this.on({
                change: function() {
                    if ($this.is(':radio')) {
                        $(this).parents('form').find('[name=\''+$(this).attr('name')+'\']').parent().find('.custom-radio').removeClass('checked');
                        //$this.parent().siblings('label')
                        //    .find('.custom-radio').removeClass('checked');
                    }
                    $span.toggleClass('checked', $this.is(':checked'));
                },
                focus: function() { $span.addClass('focus'); },
                blur: function() { $span.removeClass('focus'); }
            });
        });
    };
}());