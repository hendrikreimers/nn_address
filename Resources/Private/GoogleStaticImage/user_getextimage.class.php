<?php 

class user_getextimage {
	function main($content, $conf) {
		// Parse with TypoScript
		if ( isset($conf['url.']) ) {
		    $conf['url'] = $this->cObj->cObjGetSingle($conf['url'], $conf['url.']);
		    unset($conf['url.']);
		}
		if ( isset($conf['filename.']) ) {
		    $conf['filename'] = $this->cObj->cObjGetSingle($conf['filename'], $conf['filename.']);
		    unset($conf['filename.']);
		}
		
		// Render filename / filepath
		if ( empty($conf['filename']) ) {
			$targetFile = $conf['targetPath'].hash('adler32', $conf['url']).'.'.$conf['fileExt'];
		} else $targetFile = $conf['targetPath'].$conf['filename'].'.'.$conf['fileExt'];
		
		// Return File or create file
		if ( file_exists($targetFile) && ((filemtime($targetFile) + $conf['cacheTimeout']) > time()) ) {
			return $targetFile;
		} else {
			file_put_contents($targetFile, \TYPO3\CMS\Core\Utility\GeneralUtility::getURL($conf['url']));
			return $targetFile;
		}
	}
}

?>