{literal}
<style>

body, p { font-family: Arial; font-size:13px; line-height:20px; }

</style> 
{/literal} 

<p>Merhaba <b>{$admin->adi}</b>,</p>

<p>İletişim formundan yeni mesaj gönderildi;</p>
<hr />
<table style="border-collapse: collapse;">
	<tr>
		<th style="text-align: right; padding: 6px; min-width: 160px;">Konu: </th>
		<td>{$iletisim_konusu_mod->adi}</td>
	</tr>
	<tr>
		<th style="text-align: right; padding: 6px; min-width: 160px;">Gönderen Adı: </th>
		<td>{$iletisim_mesaji_mod->adi}</td>
	</tr>
	<tr>
		<th style="text-align: right; padding: 6px; min-width: 160px;">Mail Adresi: </th>
		<td>{$iletisim_mesaji_mod->mail}</td>
	</tr>
	<tr>
		<th style="text-align: right; padding: 6px; min-width: 160px;">Mesajı: </th>
		<td>{$iletisim_mesaji_mod->mesaj}</td>
	</tr>
</table>
<hr />
<p><a href="{$url1}">Admin Sayfası</a></p>