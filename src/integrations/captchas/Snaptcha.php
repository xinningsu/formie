<?php
namespace verbb\formie\integrations\captchas;

use verbb\formie\elements\Form;
use verbb\formie\elements\Submission;
use verbb\formie\base\Captcha;

use Craft;
use craft\web\View;

use putyourlightson\snaptcha\models\SnaptchaModel;
use putyourlightson\snaptcha\Snaptcha as SnaptchaPlugin;

class Snaptcha extends Captcha
{
    // Properties
    // =========================================================================

    public $handle = 'snaptcha';


    // Public Methods
    // =========================================================================

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return Craft::t('formie', 'Snaptcha');
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return Craft::t('formie', 'Snaptcha is an invisible CAPTCHA that automatically validates forms and prevents spam bots from submitting to your Craft CMS site. Find out more via [Snaptcha Plugin](https://plugins.craftcms.com/snaptcha).');
    }

    /**
     * @inheritDoc
     */
    public function getFrontEndHtml(Form $form, $page = null): string
    {
        $model = new SnaptchaModel();
        $fieldName = SnaptchaPlugin::$plugin->settings->fieldName;
        $fieldValue = SnaptchaPlugin::$plugin->snaptcha->getFieldValue($model) ?? '';

        return '<input type="hidden" name="' . $fieldName . '" value="' . $fieldValue . '">';
    }

}
