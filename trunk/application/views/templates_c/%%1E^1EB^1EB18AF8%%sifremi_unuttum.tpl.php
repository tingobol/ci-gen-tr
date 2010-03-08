<?php /* Smarty version 2.6.26, created on 2010-03-08 16:22:15
         compiled from yazar/panel/mailler/sifremi_unuttum.tpl */ ?>
<?php echo '
<style>

body, p {
	font-family: Arial;
	font-size:13px;
	line-height:20px;
}

</style>
'; ?>


<p>Merhaba <b><?php echo $this->_tpl_vars['kullanici']->adi; ?>
</b>,</p>

<p>Şifrenizi sıfırlamak için aşağıdaki bağlantıya tıklayınız.</p>
<p><a href="<?php echo $this->_tpl_vars['url1']; ?>
"><?php echo $this->_tpl_vars['url1']; ?>
</a></p>
<p><i>Not: Şifreniz mail adresinize gönderilecektir.</i></p>