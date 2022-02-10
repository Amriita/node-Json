<?php

namespace Drupal\node_json\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiKeyController.
 */
class ApiKeyController extends ControllerBase {

  /**
   * Post.
   *
   * @return string
   *   Return Hello string.
   */
  public function Api($api,$contenttype,$nid) {
    $config_api = \Drupal::config('system.site')->get('api');
    $ans = \Drupal::entityQuery('node')->condition('nid', $nid)->condition('type',$contenttype)->execute();
    $node_exists = !empty($ans);
    if((($api == $config_api) and ($node_exists))  ){
      $result = array(
        'API KEY'=> $api,
        'Node ID'=>$nid,
        'Content-type'=>$contenttype,
    );
    return new JsonResponse($result);
  }
  return new JsonResponse(t('Invalid Api Key or Node ID'));

}
}