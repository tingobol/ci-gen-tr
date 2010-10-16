<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Yazar Girişi</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $hata}
		<div class="hata">{$hata}</div> 
		{/if}
	
		<form action="{$smarty.const.SAYFA_YAZAR_1}" method="post" class="form1" id="form1">
			
			<p>
				<label for="mail">* Mail Adresiniz:</label><br />
				<input type="text" name="mail" id="mail" size="30" maxlength="255" title="Mail adresinizi yazınız." value="{$yazar_mod->mail}"></input>
			</p>
			
			<p>
				<label for="sifre">* Şifre:</label><br />
				<input type="password" name="sifre" id="sifre" size="20" title="Şifrenizi yazınız."></input>
			</p>

			<p>
				<input type="submit" value="Giriş Yap"></input>
			</p>
		
		</form>

	</div>

</div>

{literal}
<script type="text/javascript">
	$().ready(function(){
		$('#form1').formtooltip();	
	});
</script>
{/literal}	