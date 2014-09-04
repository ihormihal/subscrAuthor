<div onclick="subscribe('[[++site_url]][[~169]]','[[*author]]')" style="margin-bottom: 20px; cursor: pointer;">Подписаться на новые публикации автора</div>
<script type="text/javascript">
	function subscribe(url,author){
		var email = prompt('Введите E-mail для подписки','[[+modx.user.id:userinfo=`email`]]');
		if(email.indexOf('.', 0) == -1 || email.indexOf('@', 0) == -1){
			subscribe();
		}else{
			$.ajax({
			  url: url,
			  data: {author:author,email:email},
			  success: function(){
			    alert('Вам отправлено письмо для подтверждения подписки');
			  }
			});
		}
		return false;
	}
</script>