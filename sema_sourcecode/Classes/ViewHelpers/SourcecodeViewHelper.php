<?php
namespace TYPO3\SemaSourcecode\ViewHelpers;

if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('geshilib')) {
    require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath('geshilib').'res/geshi.php');
}

/**
 * Shows Content Element
 *
 * @package TYPO3
 * @subpackage ftm
 */
class SourcecodeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @var \GeSHi
     */
    var $geshi = null;

    /**
     * Parse a content element
     *
     * @param string $lang Language
     * @param string $code SourceCode
     * @param string $highlight Highlight lines
     * @param int $startnumber Line starting number
     * @return string Parsed SourceCode
     */
    public function render($lang='typoscript', $code='', $highlight='', $startnumber='1') {

        // init geshi library
        $this->geshi = new \GeSHi($code, $lang);


        // defaults
        $this->geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);

        // set highlighted lines
        if ($highlight !== '') {
            $this->geshi->highlight_lines_extra(split(',', $highlight));
        }

        // set startnumber
        if (isset($startnumber)) {
            $this->geshi->start_line_numbers_at($startnumber);
        }

//        // style
//        if (isset($config['default.'])) {
//            $this->_styleSubjects($config['default.']);
//        }
//        if (isset($config[$config['content.']['lang'].'.'])) {
//            $this->_styleSubjects($config[$lang.'.']);
//        }
//
//        // external stylesheets
//        if (isset($config['global.']['external']) && $config['global.']['external'] == 0) {
//
//            // do not use external style sheets
//
//        } else {


            /**
             * @todo: dont put it multiple times into header by multiple usage
             */
            // mtness.net modification: I love stylesheets!
            $this->geshi->enable_classes();
            // Echo out the stylesheet for this code block And continue echoing the page
            $this->geshiCSS = '<style type="text/css"><!--'.$this->geshi->get_stylesheet().'--></style>';
            // additional headerdata to include the styles
            $GLOBALS['TSFE']->additionalHeaderData['sema_sourcecode:'.$lang] = $this->geshiCSS;

//        }
//
//        // xhtml compliance
//        if (isset($config['global.']['xhtmlcompliant']) && $config['global.']['xhtmlcompliant'] == 1) {
//            $this->geshi->force_xhtml_compliance = true;
//        }
//
//        // check for errors
//        if ($this->geshi->error() !== false) {
//            // log an error, this happens if the language file is missing or non-readable. Other input
//            // specific errors can also occour, eg. if a non-existing container type is set for the engine.
//            $GLOBALS['BE_USER']->simplelog($this->geshi->error(), $extKey='sema_sourcecode', 1);
//        }
//
//        // render
//        return $this->pi_wrapInBaseClass($this->geshi->parse_code());

        return $this->geshi->parse_code();
    }

}
?>