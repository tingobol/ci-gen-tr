<style>

body, p {
	font-family: Arial;
	font-size:13px;
	line-height:20px;
}

</style>

<p>Merhaba <b><?php echo $kullanici->adi ?></b></p>

<p>
Editörlük başvurunuz kaydedilmiştir. En kısa zamanda 
yöneticilerimiz tarafından incelenecektir. 
</p>
<p>
Editörlüğünüz onaylandığında size mail ile bilgilendirme 
yapacağız. Bu bilgilendirmede editör girişi yapmanız için 
gerekli bilgileri bulacaksınız.
</p>
<p>
İlginiz için teşekkür ederiz.
</p>

<p><?php echo anchor(site_url(), site_url()) ?> </p>