<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Şifre Değiştir</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $tamam}
		<div class="tamam">{$tamam}</div> 
		{else}
		
			{if $hata}
			<div class="hata">{$hata}</div> 
			{/if}
	
			<form action="{$smarty.const.SAYFA_YAZAR_6}" class="form1" method="post" id="form1">
				
				<p>
					<label for="mail">* Eski Şifreniz:</label><br />
					<input type="password" name="eski_sifre" size="20" title="Eski şifrenizi yazınız."></input>
				</p>
				
				<p>
					<label for="mail">* Yeni Şifreniz:</label><br />
					<input type="password" name="yeni_sifre" size="20" title="Yeni şifrenizi yazınız."></input>
				</p>
				
				<p>
					<label for="mail">* Yeni Şifreniz (tekrar):</label><br />
					<input type="password" name="yeni_sifre_tekrar" size="20" title="Yeni şifrenizi tekrar yazınız."></input>
				</p>
	
				<p>
					<input type="submit" value="Şifre Değiştir"></input>
				</p>
			
			</form>
			
		{/if}

	</div>

</div>

{literal}
<script type="text/javascript">
	$().ready(function(){$('#form1').formtooltip();});
</script>
{/literal}