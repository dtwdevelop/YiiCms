<?= $this->registerJsFile('/widget/soc/js/social-likes.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerCssFile('/widget/soc/css/social-likes_birman.css'); ?>
<div class="social-likes">
	<div class="facebook" title="Поделиться ссылкой на Фейсбуке">Facebook</div>
	<div class="twitter" title="Поделиться ссылкой в Твиттере">Twitter</div>
	<div class="mailru" title="Поделиться ссылкой в Моём мире">Мой мир</div>
	<div class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</div>
	<div class="odnoklassniki" title="Поделиться ссылкой в Одноклассниках">Одноклассники</div>
	<div class="plusone" title="Поделиться ссылкой в Гугл-плюсе">Google+</div>
</div>


