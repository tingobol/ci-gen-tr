{* misafir için *}

<h2>Kategoriler</h2>
<ul class="list-cat">
	{foreach from=$nav_kategoriler->result() item=row}
	<li><a href="{$smarty.const.SAYFA_MISAFIR_31|sprintf:$row->id}">{$row->adi}</a></li>
	{/foreach}
</ul>

<h2>Kullanıcı Türleri</h2>
<ul class="linkcat">	
	<li><a href="{$smarty.const.SAYFA_ADMIN_0}">Admin Girişi</a></li>
	<li><a href="{$smarty.const.SAYFA_EDITOR_0}">Editör Girişi</a></li>
	<li><a href="{$smarty.const.SAYFA_YAZAR_0}">Yazar Girişi</a></li>
</ul>

<h2>Etiket Bulutu</h2>
<div class="textwidget">{$etiket_bulutu}</div>