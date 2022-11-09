						<?CMax::checkRestartBuffer();?>
						<?IncludeTemplateLangFile(__FILE__);?>
							<?if(!$isIndex):?>
								<?if($isHideLeftBlock && !$isWidePage):?>
									</div> <?// .maxwidth-theme?>
								<?endif;?>
<div id = "text-wraper">
<h3 style = "padding-left: 30px; padding-right: 30px; margin-top:10px; margin-bottom:15px">ТулДом – ваш надежный партнер в мире строительных и отделочных материалов</31>
<p style = "padding-left: 30px; padding-right: 30px;  margin-bottom:0px; margin-top:10px;">История компании «ТулДом» началась еще в 2013 году – и всё это время мы активно развиваемся и совершенствуемся, чтобы предложить клиентам профессиональное обслуживание на выгодных условиях.</p>
<p style = "padding-left: 30px; padding-right: 30px; margin-bottom:0px; margin-top:10px">Наша компания напрямую сотрудничает с производителями пиломатериалов, что позволило нам установить низкие цены на вагонку, доски, гипсостружечные и OSB плиты, имитацию бруса и другие виды продукции. Для покупателей разработана удобная схема взаимодействия и многочисленные преимущества.</p>
<h3 style = "padding-left: 30px; padding-right: 30px; margin-top:0px; margin-bottom:10px">Наши преимущества:</h3>
<ul style = "padding-left: 30px; padding-right: 30px; margin-bottom: 10px; margin-top:0px">
<li>Материалы в наличии. Товары хранятся на собственном складе компании в селе Маслово, что позволяет сократить сроки доставки и обеспечить своевременное формирование и отправку заказа получателю.</li>
<li>Сервис. Наша команда – профессионалы, которые подробно ответят на все вопросы, предоставят бесплатную консультацию и сделают полный спектр необходимых расчетов, чтобы заказчик мог в полной мере оценить выгоды нашего предложения. Задать интересующие вопросы можно по телефону или в режиме онлайн.</li>
<li>Оперативная доставка. Выбранные позиции будут доставлены в течение 24 часов – покупатель будет предварительно уведомлен о временном интервале прибытия транспорта. Материалы можно забрать и самостоятельно в одном из пунктов выдачи, функционирующих в различных регионах России.</li>
</ul>
<p style = "padding-left: 30px; padding-right: 30px;">Наша гордость – комплексный подход к реализации поставленной задачи. Ценим каждого клиента и уделяем максимум времени, чтобы сотрудничество было максимально продуктивным.</p>
</div>
								</div> <?// .container?>
							<?else:?>
								<?CMax::ShowPageType('indexblocks');?>
							<?endif;?>
							<?CMax::get_banners_position('CONTENT_BOTTOM');?>
						</div> <?// .middle?>
					<?//if(($isIndex && $isShowIndexLeftBlock) || (!$isIndex && !$isHideLeftBlock) && !$isBlog):?>
					<?if(($isIndex && ($isShowIndexLeftBlock || $bActiveTheme)) || (!$isIndex && !$isHideLeftBlock)):?>
						</div> <?// .right_block?>
						<?if($APPLICATION->GetProperty("HIDE_LEFT_BLOCK") != "Y" && !defined("ERROR_404")):?>
							<?CMax::ShowPageType('left_block');?>
						<?endif;?>
					<?endif;?>
					</div> <?// .container_inner?>
				<?if($isIndex):?>
					</div>
				<?elseif(!$isWidePage):?>
					</div> <?// .wrapper_inner?>
				<?endif;?>
			</div> <?// #content?>
			<?CMax::get_banners_position('FOOTER');?>
		</div><?// .wrapper?>

		<footer id="footer">
			<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer_include/under_footer.php'));?>
			<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer_include/top_footer.php'));?>
		</footer>
		<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer_include/bottom_footer.php'));?>


<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(66645211, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, ecommerce:"dataLayer" }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/66645211" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

	</body>
</html>