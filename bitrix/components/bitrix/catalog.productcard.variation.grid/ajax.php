<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Engine\Response;
use Bitrix\Main\Engine\Response\AjaxJson;
use Bitrix\Main\Error;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Grid\Options;
use Bitrix\Main\Loader;

class VariationGridController extends \Bitrix\Main\Engine\Controller
{
	/**
	 * @return \Bitrix\Main\Engine\Response\HtmlContent
	 * @throws \Bitrix\Main\LoaderException
	 */
	public function getProductGridAction(): Response\HtmlContent
	{
		if (!Loader::includeModule('catalog'))
		{
			return $this->sendErrorResponse('Could not load "catalog" module.');
		}

		$params = $this->getUnsignedParameters();
		$iblockId = (int)($params['IBLOCK_ID'] ?? 0);

		if ($iblockId <= 0)
		{
			return $this->sendErrorResponse(sprintf('Wrong iblock id {%s}.', $iblockId));
		}

		return new Response\Component(
			'bitrix:catalog.productcard.variation.grid',
			'',
			[
				'IBLOCK_ID' => $iblockId,
				'PRODUCT_ID' => (int)($params['PRODUCT_ID'] ?? 0),
				'COPY_PRODUCT_ID' => (int)($params['COPY_PRODUCT_ID'] ?? 0),
				'EXTERNAL_FIELDS' => $params['EXTERNAL_FIELDS'] ?? null,
				'PATH_TO' => $params['PATH_TO'] ?? [],
			]
		);
	}

	private function sendErrorResponse(string $message)
	{
		$errorCollection = new ErrorCollection();
		$errorCollection->setError(new Error($message));

		return Response\HtmlContent::createError($errorCollection);
	}

	/**
	 * @param string $gridId
	 * @param string $propertyCode
	 * @param string $anchor
	 * @param array $currentHeaders
	 *
	 * @return Response\AjaxJson
	 */
	public function addPropertyHeaderAction(string $gridId, string $propertyCode, array $currentHeaders, string $anchor = ''): AjaxJson
	{
		$options = new Options($gridId);
		$allUsedColumns = $options->getUsedColumns();

		if (empty($allUsedColumns))
		{
			$allUsedColumns = $currentHeaders;
		}

		if (empty($anchor))
		{
			$anchor = $allUsedColumns[0];
		}

		Loader::includeModule('catalog');

		/** @var \CatalogProductVariationGridComponent $componentClass */
		$componentClass = CBitrixComponent::includeComponentClass('bitrix:catalog.productcard.variation.grid');

		foreach ($allUsedColumns as $key => $header)
		{
			if ($header === $componentClass::formatFieldName($componentClass::HEADER_EMPTY_PROPERTY_COLUMN))
			{
				array_splice($allUsedColumns, $key, 1, $propertyCode);
				break;
			}

			if ($header === $anchor)
			{
				array_splice($allUsedColumns, $key + 1, 0, $propertyCode);
				break;
			}
		}

		$options->setColumns(implode(',', $allUsedColumns));
		$options->save();

		return AjaxJson::createSuccess();
	}
}