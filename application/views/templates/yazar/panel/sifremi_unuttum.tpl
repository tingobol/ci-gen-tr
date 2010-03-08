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
			<h2>Şifremi Unuttum</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $tamam neq ""}
		<div class="tamam">{$tamam}</div> 
		{else}
		
			{if $hata neq ""}
			<div class="hata">{$hata}</div> 
			{/if}
	
			<form action="{$smarty.const.SAYFA_YAZAR_2}" class="form1" method="post" id="form1">
				
				<p>
					<label for="mail">* Mail Adresiniz:</label>
					<input type="text" name="mail" size="40" maxlength="255" title="Mail adresinizi yazınız." value="{$kullanici->mail}"></input>
				</p>
	
				<p>
					<label>&nbsp;</label>
					<input type="submit" value="Gönder"></input>
				</p>
			
			</form>
			
		{/if}

	</div>

</div>

{include file="footer1.tpl"}	