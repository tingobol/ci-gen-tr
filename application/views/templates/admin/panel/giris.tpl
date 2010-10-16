<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Admin Girişi</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $hata}
		<div class="hata">{$hata}</div> 
		{/if}
	
		<form action="{$smarty.const.SAYFA_ADMIN_1}" class="form1" method="post" id="form1">
			
			<p>
				<b>* Mail Adresiniz:</b><br />
				<input type="text" name="mail" size="30" maxlength="255" title="Mail adresinizi yazınız." value="{$admin_mod->mail}"></input>
			</p>
			
			<p>
				<b>* Şifre:</b><br />
				<input type="password" name="sifre" size="20" title="Şifrenizi yazınız."></input>
			</p>

			<p>
				<input type="submit" value="Giriş Yap"></input>
			</p>
		
		</form>

	</div>

</div>

{literal}
<script type="text/javascript">
	$().ready(function(){$('#form1').formtooltip();});
</script>
{/literal}