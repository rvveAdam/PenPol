<?php

namespace WPForms\Vendor\Box\Spout\Writer\ODS\Manager\Style;

use WPForms\Vendor\Box\Spout\Common\Entity\Style\Style;
/**
 * Class StyleRegistry
 * Registry for all used styles
 */
class StyleRegistry extends \WPForms\Vendor\Box\Spout\Writer\Common\Manager\Style\StyleRegistry
{
    /** @var array [FONT_NAME] => [] Map whose keys contain all the fonts used */
    protected $usedFontsSet = [];
    /**
     * Registers the given style as a used style.
     * Duplicate styles won't be registered more than once.
     *
     * @param Style $style The style to be registered
     * @return Style The registered style, updated with an internal ID.
     */
    public function registerStyle(Style $style)
    {
        if ($style->isRegistered()) {
            return $style;
        }
        $registeredStyle = parent::registerStyle($style);
        $this->usedFontsSet[$style->getFontName()] = \true;
        return $registeredStyle;
    }
    /**
     * @return string[] List of used fonts name
     */
    public function getUsedFonts()
    {
        return \array_keys($this->usedFontsSet);
    }
}
