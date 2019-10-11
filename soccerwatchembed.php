<?php
/**
 * @package PlgSoccerwatchEmbed
 * @author Norman Malessa <mail@norman-malessa.de>
 * @copyright 2019 Norman Malessa <mail@norman-malessa.de>
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License, see LICENSE
 */

class plgContentSoccerwatchEmbed extends JPlugin
{
    CONST REGEX = '/{?\s*(https?:\/\/(?:www\.)?(?:soccerwatch|aisw)\.tv\/embed(?:\/video)?\/([0-9]+)(?:\/highlight)?)\/?\s*}?/';

    /**
     * @param string $context
     * @param object $article
     * @return bool
     */
    public function onContentPrepare($context, $article)
    {
        if ($context === 'com_content.article')
        {
            $article->text = preg_replace(self::REGEX, $this->getReplacement(), $article->text);
        }

        return true;
    }

    /**
     * @return string
     */
    private function getReplacement()
    {
        $width = $this->params->get('width', '100%');
        $height = $this->params->get('height', '500');

        return '<iframe id="soccerwatch_$3" frameborder="0" allowfullscreen'
            . ' width="' . $width . '" height="' . $height . '" src="$1"></iframe>';
    }
}
