<?php

namespace Drupal\download_link_labeler\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Create new class that returns remote file size.
 */
class HttpDownloadLinkLabeler {
  use StringTranslationTrait;

  /**
   * GuzzleHttp Client returns File Size.
   */
  public function getFileSize($fileUrl) {
    $client = new Client();
    try {
      $response = $client->head($fileUrl, ['http_errors' => FALSE]);
      $fileSize = $response->getHeader('Content-Length');
      return reset($fileSize);
    }
    catch (RequestException $e) {
      return($this->t('Unknown Size'));
    }
  }

}
