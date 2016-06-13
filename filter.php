<?php

// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    filter
 * @subpackage html5media
 * @copyright  Andre Dixon <dredix84@gmail.com>
 * @copyright  2016 onwards Andre Dixon (Dredix Inc) {@link http://www.dredix.net}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * 
 */
defined('MOODLE_INTERNAL') || die();

class filter_html5media extends moodle_text_filter {

    private $videoExt = array('mp4', 'webm');   //Default file extensions for supported HTML 5 video media files

    public function filter($text, array $options = array()) {
        $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
        $filtered = array();    //Used to store link whic have already been filtered to prevent double filtering

        if (preg_match_all("/$regexp/siU", $text, $matches)) {
            for ($x = 0; $x < count($matches[0]); $x++) {
                $ext = pathinfo($matches[2][$x], PATHINFO_EXTENSION);   //Getting file extension

                if ($this->isMediaExtension($ext) && !in_array($matches[2][$x], $filtered)) {
                    $filtered[] = $matches[2][$x];
                    $newlink = $this->getOpenTag($ext)
                            . "   <source src='" . $matches[2][$x] . "' type='" . $this->getType($ext) . "'> \n"
                            . get_string('browserdoesnotsupport', 'filter_html5media')
                            . $this->getCloseTag($ext);
                    $text = str_replace($matches[0][$x], $newlink, $text);
                }
            }
        }

        return $text;
    }

    /**
     * Used to get the media type attribute based on the file extension
     * @param string $ext File extension
     * @return boolean
     */
    private function getType($ext) {
        $ext = strtolower($ext);

        if ($this->isVideo($ext)) {
            return 'video/' . $ext;
        } else {
            if ($ext == 'mp3') {
                return 'audio/mpeg';
            } else {
                return 'audio/' . $ext;
            }
        }
    }

    /**
     * Used to determine is the file extension is a media file.
     * @param string $ext
     * @return boolean
     */
    private function isMediaExtension($ext) {
        $ext = strtolower($ext);
        $mediaExt = array('mp4', 'webm', 'ogg', 'wav', 'mp3');
        return in_array($ext, $mediaExt);
    }

    /**
     * Used to get the opening tag for the media file
     * @param string $ext File entension
     * @return string
     */
    private function getOpenTag($ext) {
        if ($this->isVideo($ext)) {
            return '<video controls autoplay_no>';
        } else {
            return '<audio controls>';
        }
    }

    /**
     * Used to get the closing tag for the based on the file extension
     * @param string $ext File extension
     * @return string
     */
    private function getCloseTag($ext) {
        if ($this->isVideo($ext)) {
            return '</video>';
        } else {
            return '</audio>';
        }
    }

    /**
     * Used to determine if the media type extension is for a video file as opposed to an audio
     * @param string $ext File entension
     * @return boolean
     */
    private function isVideo($ext) {
        return in_array($ext, $this->videoExt);
    }

}

?>