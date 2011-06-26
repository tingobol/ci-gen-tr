{literal}
<style>

body, p {
	font-family: Arial;
	font-size:13px;
	line-height:20px;
}

</style>
{/literal}

<p>Merhaba <b>{$yazar_mod->adi}</b>,</p>

<p>Yeni giriş bilgileriniz aşağıdaki gibidir:</p>
<p>
Mail Adresi: {$yazar_mod->mail}<br />
Şifre: {$temp_sifre}
</p>

<p>Sisteme giriş yapmak için: </p>
<p><a href="{$url1}">{$url1}</a></p>