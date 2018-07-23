jQuery("form[name=form1]").submit(function () {
   jQuery.post('/start', jQuery(this).serialize()).done(function (data) {
       jQuery("#area1").hide();
       jQuery("#area2").append("Your Card: " + data.card + "<br />");
   });
});