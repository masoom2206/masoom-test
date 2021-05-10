<?php

namespace Drupal\site_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Access\AccessResult;

/**
 * Controller for export page node json.
 */
class ExportPagesController extends ControllerBase {

  /**
   * Callback controller function jsonpagedata()
   * to return Page node json
   */
  public function jsonpagedata(NodeInterface $node) {
    $json_array = array();
    $type = $node->get('type')->target_id;
    if($type == 'page'){
      $json_array = array(
        'type' => $node->get('type')->target_id,
        'id' => $node->get('nid')->value,
        'attributes' => array(
          'title' =>  $node->get('title')->value,
          'content' => $node->get('body')->value,
        ),
      );
    }
    return new JsonResponse($json_array);
  }
  /**
   * Callback controller function jsonpagedataaccess()
   * to check the access according to site api and node type
   */
  public function jsonpagedataaccess($siteapi, NodeInterface $node){
    $site_config = $this->config('system.site');
    $siteapikey = $site_config->get('siteapikey');
    $type = $node->get('type')->target_id;
    if($type == 'page' && $siteapi == $siteapikey){
      return AccessResult::allowed();
    }
    else {
      return AccessResult::forbidden();
    }
  }
}
