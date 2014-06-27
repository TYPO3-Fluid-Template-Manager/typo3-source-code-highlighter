<?php
$extensionPath = t3lib_extMgm::extPath('sema_sourcecode');
$extensionClassesPath = $extensionPath . 'Classes/';
return array(
    'tx_semasourcecode_viewhelpers_sourcecodeviewhelper' => $extensionClassesPath . 'ViewHelpers/SourcecodeViewHelper.php',
);
?>