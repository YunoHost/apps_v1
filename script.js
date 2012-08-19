 /**
  *  Yunohost - Self-hosting for dummies
  *  Copyright (C) 2012  Kload <kload@kload.fr>
  *
  *  This program is free software: you can redistribute it and/or modify
  *  it under the terms of the GNU Affero General Public License as
  *  published by the Free Software Foundation, either version 3 of the
  *  License, or (at your option) any later version.
  *
  *  This program is distributed in the hope that it will be useful,
  *  but WITHOUT ANY WARRANTY; without even the implied warranty of
  *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  *  GNU Affero General Public License for more details.
  *
  *  You should have received a copy of the GNU Affero General Public License
  *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
  */

// TODO: Document all this sh*t

jQuery(document).ready(function () {
  var navWidth = 0;
  var navMaxWidth = jQuery('.nav-collapse').width();
  jQuery('.tab').each(function() {
    navWidth += jQuery(this).width();
  });
  
  if (navWidth > navMaxWidth) {
    jQuery('.nav').width(navWidth);
    var toMarginRight = navWidth-navMaxWidth;
    //jQuery('.nav').css('marginRight', '-'+ toMarginRight +'px');
    jQuery('.nav').animate({marginRight:'-'+ toMarginRight +'px'}, 1000);
    jQuery('a.before').hide();
    jQuery('a.after').click(function() {
      jQuery('a.before').show();
      var actualNavWidth = parseInt(jQuery('.nav').css('marginRight').replace("px", ""));
      var toNewMarginRight = actualNavWidth+160;
      if (toNewMarginRight > 0) {
        toNewMarginRight = 0;
        jQuery('a.after').hide();
        jQuery('.nav-collapse').css('marginRight', '17px');
      }
      jQuery('.nav').animate({marginRight: (toNewMarginRight) +'px'}, 150);
    });
    jQuery('a.before').click(function() {
      jQuery('a.after').show();
      jQuery('.nav-collapse').css('marginRight', '0');
      var actualNavWidth = parseInt(jQuery('.nav').css('marginRight').replace("px", ""));
      var toNewMarginRight = actualNavWidth-160;
      if (toNewMarginRight < -toMarginRight) {
        toNewMarginRight = -toMarginRight;
        jQuery('a.before').hide();
      }
      jQuery('.nav').animate({marginRight: (toNewMarginRight) +'px'}, 200);
    });
  } else {
    jQuery('a.after').hide();
    jQuery('a.before').hide();
    jQuery('.nav-collapse').css('marginRight', '17px');
  }

  jQuery('li.tab a').click(function(event) {
    event.preventDefault();
    parent.glu.location.href = jQuery(this).attr('href');
    jQuery('li.tab a.active').removeClass('active');
    jQuery(this).addClass('active');
  });

  jQuery('a.mail_image').click(function(event) {
    event.preventDefault();
    parent.glu.location.href = jQuery(this).attr('href');
    jQuery('li.tab a.active').removeClass('active');
    jQuery('li.tab a[href="/roundcube"]').addClass('active');
  });

  jQuery('li.tab a.active').click(function(event) {
    event.preventDefault();
  });


  jQuery("#glu").load(function (){
    if (top.glu.document.title)
      top.document.title = top.glu.document.title;
    else
      top.document.title = 'Yunohost Apps';
  });

  var tid = setInterval(changeTitle, 10000);
  var tid2 = setInterval(getMailCount, 30000);

  function changeTitle() {
    if (top.glu.document.title)
      top.document.title = top.glu.document.title;
    else
      top.document.title = 'Yunohost Apps';
  }

  function getMailCount() {
    $.get('/?getMailCount=1', function(data) {
      $('.mail_counter').html(data);
    });
  }

  function abortTimer() {
    clearInterval(tid);
    clearInterval(tid2);
  }
});
