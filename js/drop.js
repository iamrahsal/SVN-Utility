 var Dropdown = (function($) {

          var $body = $('body'),
            $dropdown = $body.find('.dropdown'),
            $trigger = $dropdown.find('button'),
            $list = $dropdown.find('ul'),
            $firstLink = $list.find('li:first a'),
            $lastLink = $list.find('li:last a');

          var init = function() {
            ariaSetup();
            bindEvents();
          }

          var ariaSetup = function() {
            var listId = $list.attr('id');

            $trigger.attr({
              'aria-expanded': 'false',
              'aria-controls': listId
            });

            $list.attr({
              'aria-hidden': true
            });
          }

          var bindEvents = function() {
            $trigger.on('click', toggleDropdown);

            $firstLink.on('keydown', function() {
              if (event.which === 9 && event.shiftKey === false) {
                return;
              } else if (event.which === 9 && event.shiftKey === true) {
                toggleDropdown();
              }
            });

            $lastLink.on('keydown', function() {
              if (event.shiftKey) return;
              toggleDropdown();
            });
          }

          var toggleDropdown = function() {
            var hidden = $list.attr('aria-hidden') === 'true' ? false : true,
              expanded = !hidden;

            $trigger.attr('aria-expanded', expanded);
            $list.attr('aria-hidden', hidden);
          }

          return {
            init: init
          }

        })(jQuery);

        Dropdown.init();
		
		
var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';    
  })();
