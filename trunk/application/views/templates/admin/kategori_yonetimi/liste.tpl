{include file="header1.tpl"}

<div class="blok1">

	<div class="entrytop">
		<div class="entry">
			<h2>Kategori Listesi</h2>
		</div>
	</div>
	
	<div class="icerik">
	
		{if $tamam neq ""}
		<div class="tamam">{$tamam}</div> 
		{/if}
		
		{if $ikaz neq ""}
		<div class="ikaz">{$ikaz}</div> 
		{/if}
		
		{if $kategoriler->num_rows() eq 0} 
		<div class="bilgi">Listelenecek kategori bulunamadı.</div>
		{else}

			<table id="tablo" class="tablo">
			
				<thead>
					<tr>
						<th style="width: 1px;">ID</th>
						<th>Adı</th>
						<th style="width: 1px;"></th>
						<th style="width: 1px;"></th>
					</tr>
				</thead>
				
				<tbody>

				{foreach from=$kategoriler->result() item=kategori}

					<tr>
						<td style="text-align:right;">{$kategori->id}.</td>
						<td>{$kategori->adi}</td>
						<td align="center"><a href="{$smarty.const.SAYFA_ADMIN_13_1|sprintf:$kategori->id}" title="Düzenle"><img src="{$smarty.const.DIZIN_URL_3}/duzenle.png" /></a></td>
						<td align="center"><a href="{$smarty.const.SAYFA_ADMIN_14|sprintf:$kategori->id}" title="Sil" onclick="return confirm('Kategori ve tüm ilişkili bilgileri silinecek! Emin misiniz?');"><img src="{$smarty.const.DIZIN_URL_3}/sil.png" /></a></td>
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

{include file="footer1.tpl"}	