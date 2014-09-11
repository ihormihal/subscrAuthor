<script src="[[++assets_url]]design/js/plugins/alertify/alertify.min.js"></script>
<link href="[[++assets_url]]design/js/plugins/alertify/themes/alertify.core.css" rel="stylesheet">
<link href="[[++assets_url]]design/js/plugins/alertify/themes/alertify.default.css" rel="stylesheet">
<div onclick="subscribe('[[++site_url]][[~[[++subscrauthor_subscr]]]]','[[*author]]')" style="margin-bottom: 20px; cursor: pointer;">Подписаться на новые публикации автора</div>
<script type="text/javascript">
	function subscribe(url,author){
		alertify.set({ labels: {
		    ok     : "Отправить",
		    cancel : "Отмена"
		}});
		alertify.prompt("Введите E-mail для подписки", function (e, str) {
		    if (e) {
		    	if(str.indexOf('.', 0) == -1 || str.indexOf('@', 0) == -1){
		    		alertify.error('Введен некорректный e-mail!');
		    	}else{
		    		$.ajax({
					  url: url,
					  data: {author:author,email:str},
					  success: function(responce){
					  	var res = jQuery.parseJSON(responce);
					  	if(res.status == 1){
					  		alertify.success(res.msg);
					  	}else{
					  		alertify.error(res.msg);
					  		//alertify.error(str);
					  	}
					  }
					});
		    	}
		    } else {
		        alertify.log("Отменено");
		    }
		}, "[[+modx.user.id:isnot=`0`:then=`[[+modx.user.id:userinfo=`email`]]`]]");
	return false;
	}
</script>