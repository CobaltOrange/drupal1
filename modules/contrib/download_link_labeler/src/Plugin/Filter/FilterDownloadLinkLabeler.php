<?php

namespace Drupal\download_link_labeler\Plugin\Filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;
use Drupal\download_link_labeler\Http\HttpDownloadLinkLabeler;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Custom filter class for Download Link Labeler.
 *
 * @Filter(
 *   id = "download_link_labeler",
 *   title = @Translation("Download Link Labeler"),
 *   description = @Translation("Detects downloadable links in content and adds file type and file size labels."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 *   settings = {
 *     "included_extensions" = "pdf doc docx ppt pptx xls xlsx zip"
 *   }
 * )
 */
class FilterDownloadLinkLabeler extends FilterBase {
  use StringTranslationTrait;
  /**
   * Matched text.
   *
   * @var string
   */
  public $text;

  /**
   * Returned Safe Text.
   *
   * @var string
   */
  public $safeText;

  /**
   * Filter.
   *
   * @var string
   */
  public $filter;

  /**
   * Format.
   *
   * @var string
   */
  public $format;

  /**
   * Included extensions.
   *
   * @var array
   */
  public $includedExtensions;

  /**
   * Regex pattern.
   *
   * @var string
   */
  public $pattern = '/<a[^<>]*href="([^<>"]*)"[^<]*>((?:[^<]+|<(?!\/a>))*)<\/a>((?:&nbsp;)\([^<>\(\)]*\)(?:&nbsp;)\([^<>\(\)]*\)|(?:&nbsp;)\s\([^<>\(\)]*\)(?:&nbsp;)\([^<>\(\)]*\)|\s\([^<>\(\)]*\)\s\([^<>\(\)]*\)|(?:&nbsp;)\([^<>\(\)]*\)\s\([^<>\(\)]*\)|(?:&nbsp;)\s\([^<>\(\)]*\)\s\([^<>\(\)]*\)|\s?\([^<>\(\)]*\)\s?\([^<>\(\)]*\)|(?:&nbsp;)\([^<>\(\)]*\)(?:&nbsp;)\([^<>\(\)]*\)|)/i';

  /**
   * Customized process function.
   *
   * {@inheritdoc}
   *
   * @param string $text
   *   Matched text.
   * @param string $langcode
   *   The language code.
   */
  public function process($text, $langcode) {
    $this->text = $text;
    // Set the includedExtensions property via method call.
    $this->downloadLinksFilterSetIncludedExtensions();
    // Replace text property with filtered text.
    $this->downloadLinksFilterReplaceText();
    $result = new FilterProcessResult($this->safeText);
    $result->setAttachments([
      'library' => ['download_link_labeler/download-link-labeler-theme'],
    ]);
    return $result;
  }

  /**
   * Customized settings form.
   *
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    // Add included extensions settings form.
    $form['included_extensions'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Included file type extensions'),
      '#default_value' => $this->settings['included_extensions'],
      '#maxlength' => 1024,
      '#description' => $this->t('A space separated list of file extensions to include in the automatic download file links filter.'),
    ];
    return $form;
  }

  /**
   * Customized tips.
   *
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    if ($long) {
      return $this->t('
        <p><strong>Download Links Filter</strong></p>
        <p>PDF, DOC(X) and PPT(X) file downloads will have the filetype acronym and file size displayed after the link.</p>');
    }
    else {
      return $this->t('PDF, DOC(X), XLS(X), PPT(X) and ZIP file downloads will have the filetype acronym and file size displayed after the link.');
    }
  }

  /**
   * Pull in the list of extensions from the settings and create an array.
   *
   * {@inheritdoc}
   */
  private function downloadLinksFilterSetIncludedExtensions() {
    $this->includedExtensions = preg_split('/\s+|,+|,\s+/', $this->settings['included_extensions'], -1, PREG_SPLIT_NO_EMPTY);
  }

  /**
   * Preg Replace Callback.
   *
   * {@inheritdoc}
   *
   * return string
   *   The new string with download link label applied.
   */
  private function downloadLinksFilterReplaceCallback($matches) {
    // Set the initial logic of if the link external to be false.
    $isExternal = FALSE;
    // Set the initial logic of if the link is a file download to false.
    $isDownload = FALSE;
    /*
     * $matches array:
     * [0] = The link tag and optional existing file type and file size string
     * [1] = The href attribute string
     * [2] = The string that is the full contents of the a tag
     * [3] = The existing file type and file size string OR blank
     */
    if (!empty($matches[1])) {
      // Set $href to the full href attribute from the target link.
      $href = $matches[1];
      // If $href begins with two forward slashes.
      if (substr($href, 0, 2) == '//') {
        // Set $isExternal variable to TRUE.
        $isExternal = TRUE;
      }
      // Parse the href into an array of parts.
      $hrefArray = parse_url($href);
      // If the path key is set in the new href array of parts.
      if (isset($hrefArray['path'])) {
        // Set $path to the value of the path key.
        $path = $hrefArray['path'];
        // Parse the path into an array of parts.
        $pathArray = pathinfo($path);
        // If the extension key is set.
        if (isset($pathArray['extension'])) {
          // Set the $extension variable equal to value of the extension key.
          $extension = strtolower($pathArray['extension']);
          // If the extension is in the array of included extensions.
          if (in_array($extension, $this->includedExtensions)) {
            // Set $isDownload variable to TRUE.
            $isDownload = TRUE;
          }
        }
      }
      // If the host is set.
      if (isset($hrefArray['host'])) {
        // Set the host variable to equal the value of the host key.
        $host = $hrefArray['host'];
        // If the $host varibale is not equal to the global base_url variable.
        if ($host != $GLOBALS['base_url']) {
          // Set $isExternal variable to TRUE.
          $isExternal = TRUE;
        }
      }
      // Set $result to to the value of the first element in the $matches array.
      $result = $matches[0];
      // If both of the logic variables are FALSE.
      if (!$isExternal && !$isDownload) {
        // Return the result unmodified.
        return $result;
      }
      // If there is an existing filetype and filesize string.
      if (!empty($matches[3])) {
        // Set $search variable to third key value in the $matches array.
        $search = $matches[3];
        // Remove the existing filetype and filesize portion of the string.
        $result = str_replace($search, '', $result);
      }
      // If the link is not external.
      if (!$isExternal) {
        // If the link is a download for PDF, PPT, or DOC.
        if ($isDownload) {
          // Set variable $realPath to equal the full internal path.
          $realPath = DRUPAL_ROOT . urldecode($path);
          // Set the variable $bytes to the filesize of the file.
          // Referenced by $path using the real path.
          $bytes = filesize($realPath);
          // Use Drupal function format_size to display proper unit.
          $fileSize = format_size($bytes);
        }
      }
      // If the link is external.
      if ($isExternal) {
        // If the link is a download for PDF, PPT, or DOC.
        if ($isDownload) {
          // Set the variable $bytes to the filesize of the file.
          $bytes = $this->remoteFileSize($href);
          // Validate bytes variable is numeric.
          if (is_numeric($bytes)) {
            // Use Drupal function format_size to display proper unit.
            $fileSize = format_size($bytes);
          }
          // Else if the bytes variable is a string.
          else {
            // Set fielSize variable equal to bytes variable string.
            $fileSize = $bytes;
          }
        }
      }
      // Add the file info label onto the $result string.
      $result .= $this->getFileLabel($extension, $fileSize);
      return $result;
    }
  }

  /**
   * {@inheritdoc}
   */
  private function downloadLinksFilterReplaceText() {
    // Prevent useless processing if there are no link tags at all.
    if (stristr($this->text, '<a ') !== FALSE) {
      // Set the safe text variable to equal the filtered result.
      $this->safeText = preg_replace_callback($this->pattern, [$this, 'downloadLinksFilterReplaceCallback'], $this->text);
    }
    // Else if there are no links in the text property.
    else {
      // Set the safe text to equal the text without a preg replace function.
      $this->safeText = $this->text;
    }
  }

  /**
   * Return file label string to append to download link.
   *
   * {@inheritdoc}.
   *
   * @param string $extension
   *   The file type extension acronym.
   * @param string $fileSize
   *   The file size string with numerical value and unit.
   *
   * @return string
   *   A HTML formatted file type and size label
   */
  public function getFileLabel($extension, $fileSize) {
    $fileSize = str_replace(' ', '&nbsp;', $fileSize);
    $fileLabel = '&nbsp;<span class="link-label label-file label-file-' . $extension . '" aria-label="File Type and Size">' . $extension . '&nbsp;&nbsp;' . $fileSize . '</span>';
    return $fileLabel;
  }

  /**
   * Retrieve file size of remote file.
   *
   * {@inheritdoc}.
   *
   * @param string $url
   *   A complete url encoded string with protocol, host and path.
   *
   * @return int
   *   The number of bytes of the file size
   * @see https://stackoverflow.com/questions/2602612/php-remote-file-size-without-downloading-file#answer-8159439
   */
  public function remoteFileSize($url) {
    // Construct new Guzzle HTTP Request.
    $http = new HttpDownloadLinkLabeler();
    // Set the result to be the getFileSize method.
    $result = $http->getFileSize($url);
    // Return the resulting file size in bytes.
    return $result;
  }

}
