<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
IncludeModuleLangFile(__FILE__); 
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/install/wizard_sol/wizard.php");

class SelectSiteStep extends CSelectSiteWizardStep
{
	function InitStep()
	{
		parent::InitStep();

		$wizard =& $this->GetWizard();
		$wizard->solutionName = "build";
        $this->SetNextStep("site_settings");
	}
}

class SelectTemplateStep extends CSelectTemplateWizardStep { }

class SelectThemeStep extends CSelectThemeWizardStep { }

class SiteSettingsStep extends CSiteSettingsWizardStep
{
	function InitStep()
	{
		$wizard =& $this->GetWizard();
		$wizard->solutionName = "build";
		parent::InitStep();
		
		$this->SetTitle(GetMessage("wiz_settings"));
		$this->SetNextStep("data_install");
		$this->SetNextCaption(GetMessage("wiz_install"));

		$siteID = $wizard->GetVar("siteID");


		$wizard->SetDefaultVars(
			Array(
				"name" => COption::GetOptionString("main", "site_build_name", GetMessage("SITE_NAME"), $wizard->GetVar("siteID")),
				"phone" => COption::GetOptionString("main", "site_build_phone", GetMessage("wiz_phone"), $wizard->GetVar("siteID")),
				"email" => COption::GetOptionString("main", "site_build_email", GetMessage("D_email"), $wizard->GetVar("siteID"))

			)
		);
	}

	function OnPostForm()
	{
		$wizard =& $this->GetWizard();
		
		if ($wizard->IsNextButtonClick())
		{
			COption::SetOptionString("main", "site_build_name", str_replace(Array("<"), Array("&lt;"), $wizard->GetVar("site_name")));
			COption::SetOptionString("main", "site_build_phone", str_replace(Array("<"), Array("&lt;"), $wizard->GetVar("phone")));
			COption::SetOptionString("main", "site_build_email", str_replace(Array("<"), Array("&lt;"), $wizard->GetVar("email")));
			
		}
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();
		$wizard->SetVar("site_name", COption::GetOptionString("main", "site_build_name", GetMessage("SITE_NAME"), $wizard->GetVar("siteID")));
		$wizard->SetVar("phone", COption::GetOptionString("main", "site_build_phone", GetMessage("wiz_phone"), $wizard->GetVar("siteID")));

		$wizard->SetVar("email", COption::GetOptionString("main", "site_build_email", GetMessage("email"), $wizard->GetVar("siteID")));

		
		$this->content .= '<div class="wizard-upload-img-block"><div class="wizard-catalog-title">'.GetMessage("wiz_name").'</div>';
		$this->content .= $this->ShowInputField("text", "name", Array("id" => "site_build_name", "class" => "wizard-field"))."</div>";

		$this->content .= '<div class="wizard-upload-img-block"><div class="wizard-catalog-title">'.GetMessage("wiz_company_phone").'</div>';
		$this->content .= $this->ShowInputField("text", "phone", Array("id" => "site_build_phone", "class" => "wizard-field"))."</div>";
		
		$this->content .= '<div class="wizard-upload-img-block"><div class="wizard-catalog-title">'.GetMessage("wiz_email").'</div>';
		$this->content .= $this->ShowInputField("text", "email", Array("id" => "site_build_email", "class" => "wizard-field"))."</div>";
		
		$firstStep = COption::GetOptionString("main", "wizard_first" . substr($wizard->GetID(), 7)  . "_" . $wizard->GetVar("siteID"), false, $wizard->GetVar("siteID")); 
		
		if($firstStep == "Y")
		{
			$this->content .= $this->ShowCheckboxField(
									"installDemoData", 
									"Y", 
									(array("id" => "installDemoData"))
								);
			$this->content .= '<label for="install-demo-data">'.GetMessage("wiz_structure_data").'</label><br />';
		}
		else
		{
			$this->content .= $this->ShowHiddenField("installDemoData","Y");

		}

		$formName = $wizard->GetFormName();
		$installCaption = $this->GetNextCaption();
		$nextCaption = GetMessage("NEXT_BUTTON");
	}
}

class DataInstallStep extends CDataInstallWizardStep
{
	function CorrectServices(&$arServices)
	{
		$wizard =& $this->GetWizard();
		if($wizard->GetVar("installDemoData") != "Y")
		{
		}
	}
}

class FinishStep extends CFinishWizardStep
{
}
?>