<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Onay Bekleyen Yazılar</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $tamam}
		<div class="tamam">{$tamam}</div> 
		{/if}
		
		{if $ikaz}
		<div class="ikaz">{$ikaz}</div> 
		{/if}
		
		{if $yazilar->num_rows() eq 0} 
		<div class="ikaz">Onay bekleyen yazı bulunamadı.</div>
		{else}

			<table id="tablo" class="tablo">
			
				<thead>
					<tr>
						<th style="width: 1px;">ID</th>
						<th>Başlık</th>
						<th>Kategori</th>
						<th style="width: 1px;"></th>
					</tr>
				</thead>
				
				<tbody>

				{foreach from=$yazilar->result() item=yazi}

					<tr>
						<td style="text-align:right;">{$yazi->id}.</td>
						<td>{$yazi->baslik}</td>
						<td align="center">{$yazi->kategori_adi}</td>
						<td align="center"><a href="{$smarty.const.SAYFA_EDITOR_12|sprintf:$yazi->id}" title="Detaya Bak"><img src="{$smarty.const.DIZIN_URL_3}/detay.png" /></a></td>
					</tr>
					
				{/foreach}

				</tbody>
			</table>

		{/if}

	</div>

</div>

{literal}
<script type="text/javascript">
	$().ready(function(){$('#tablo').ikontooltip();});
</script>
{/literal}