{include file="header1.tpl"}

<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Şifreyi Sıfırla</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $hata neq ""}
		<div class="hata">{$hata}</div> 
		{/if}
		
		{if $tamam neq ""}
		<div class="tamam">{$tamam}</div> 
		{/if}

	</div>

</div>

{include file="footer1.tpl"}	