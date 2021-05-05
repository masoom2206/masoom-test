<?php
/**
 * @file
 * Contains \Drupal\site_api\Controller\SiteAPIController.php
 */

namespace Drupal\site_api\Controller;

use \Drupal\core\Controller\ControllerBase;
use \Drupal\node\Entity\Node;
use \Drupal\node\NodeInterface;
use \Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Controller for get Page node JSON
 */
class SiteAPIController extends ControllerBase {
  /**
   * Callback function getPageJson()
   * Return given Page node JSON
   */
   public function getPageJson($siteapi, NodeInterface $node){
     print '<pre>';print_r($node);exit;
     return new JsonResponse($node);
   }
}
