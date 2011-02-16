// Twitter Followers Count Widget
// Gabriel Oliveira
// 02-10-2011

(function( $ ) {
  $.fn.tfcWidget = function(user) {

    var context = this;

    $.getJSON(
      "http://api.twitter.com/1/users/show/" + user + ".json?callback=?",
      function(data) {
        var profile_link_elm = $("<a>", { id : "tfc-profile_link", href : "http://twitter.com/" + user, target : "_blank" }),
            avatar_elm = $("<img>", { id : "tfc-avatar", src : data.profile_image_url }),
            name_elm = $("<h5>", { id : "tfc-name" }).text(data.name),
            screen_name_elm = $("<p>", { id : "tfc-screen_name" }).text("@" + data.screen_name),
            followers_count_elm = $("<h4>", { id : "tfc-followers_count" }).text(data.followers_count + " seguidores"),
            current_status_elm = $("<q>", { id : "tfc-status", cite : "http://www.twitter.com/" + user + "/statuses/" + data.status.id_str }).text(data.status.text);

        context.append(profile_link_elm.append(name_elm.prepend(avatar_elm)).append(screen_name_elm).append(followers_count_elm).append(current_status_elm));
      }
    );
  }

})( jQuery );
