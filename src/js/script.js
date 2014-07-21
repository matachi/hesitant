'use strict';

(function() {
  var nav = document.getElementById('site-navigation'), button, menu;
  button = nav.getElementsByTagName('button')[0];
  menu = nav.getElementsByTagName('ul')[0];

  // Hide the menu if it's empty
  if (! menu.childNodes.length) {
    button.style.display = 'none';
  }

  button.onclick = function() {
    if (button.className.indexOf('toggled-on') !== -1) {
      button.className = button.className.replace(' toggled-on', '');
      menu.className = menu.className.replace(' toggled-on', '');
    } else {
      button.className += ' toggled-on';
      menu.className += ' toggled-on';
    }
  };
})();
