{include file="header1.tpl"}

{literal}
<script type="text/javascript">
	$().ready(function(){
		$('#tablo').ikontooltip();
	});
</script>
{/literal}

<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Yazı Listesi</h2>
		</div>
	</div>
	
	<div class="icerik">
		
		{if $yazilar eq ""} 
		<div class="bilgi">Henüz yazı eklememişsiniz.</div>
		{else}

			<table id="tablo" class="tablo">
			
				<thead>
					<tr>
						<th style="width: 1px;">ID</th>
						<th>Başlık</th>
						<th style="width: 1px;">Durum</th>
						<th style="width: 1px;"></th>
						<th style="width: 1px;"></th>
					</tr>
				</thead>
				
				<tbody>

				{foreach from=$yazilar->result() item=yazi}

					<tr>
						<td style="text-align:right;">{$yazi->id}.</td>
						<td>{$yazi->baslik}</td>
						<td align="center">{$yazi->durum}</td>
						<td align="center"><a href="{$smarty.const.SAYFA_YAZAR_13_1|sprintf:$yazi->id}" title="Düzenle"><img src="{$smarty.const.DIZIN_URL_3}/duzenle.png" /></a></td>
						<td align="center"><a href="{$smarty.const.SAYFA_YAZAR_14|sprintf:$yazi->id}" title="Sil" onclick="Yazı ve tüm ilişkili bilgileri silinecek! Emin misiniz?"><img src="{$smarty.const.DIZIN_URL_3}/sil.png" /></a></td>
					</tr>
					
				{/foreach}

				</tbody>
			</table>

		{/if}

	</div>

</div>

{include file="footer1.tpl"}	