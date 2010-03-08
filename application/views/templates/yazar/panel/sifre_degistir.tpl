{include file="header1.tpl"}

{literal}
<script type="text/javascript">
	$().ready(function(){
		$('#form1').formtooltip();	
	});
</script>
{/literal}

<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Şifre Değiştir</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $tamam neq ""}
		<div class="tamam">{$tamam}</div> 
		{else}
		
			{if $hata neq ""}
			<div class="hata">{$hata}</div> 
			{/if}
	
			<form action="{$smarty.const.SAYFA_YAZAR_6}" class="form1" method="post" id="form1">
				
				<p>
					<label for="mail">* Eski Şifreniz:</label>
					<input type="password" name="eski_sifre" size="30" title="Eski şifrenizi yazınız."></input>
				</p>
				
				<p>
					<label for="mail">* Yeni Şifreniz:</label>
					<input type="password" name="yeni_sifre" size="30" title="Yeni şifrenizi yazınız."></input>
				</p>
				
				<p>
					<label for="mail">* Yeni Şifreniz (t):</label>
					<input type="password" name="yeni_sifre_tekrar" size="30" title="Yeni şifrenizi tekrar yazınız."></input>
				</p>
	
				<p>
					<label>&nbsp;</label>
					<input type="submit" value="Şifre Değiştir"></input>
				</p>
			
			</form>
			
		{/if}

	</div>

</div>

{include file="footer1.tpl"}	