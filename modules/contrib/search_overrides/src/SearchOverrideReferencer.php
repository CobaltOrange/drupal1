<?php

namespace Drupal\search_overrides;

use Drupal\Core\Access\AccessManager;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\State\StateInterface;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Symfony\Cmf\Component\Routing\RouteProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\search_overrides\Entity\SearchOverride;
use Drupal\Core\Url;
use Drupal\Component\Utility\SortArray;
use Drupal\Component\Render\FormattableMarkup;

/**
 * Utility class to relate entities to search_override entities.
 */
class SearchOverrideReferencer {
  use StringTranslationTrait;

  /**
   * @var string
   */
  protected $entity_type_id;

  /**
   * @var int
   */
  protected $eid;

  /**
   * @var string
   */
  protected $keyword;

  /**
   * Retrieve search_overrides matching provided criteria.
   *
   * @param int $eid
   *   Id of the entity to look for.
   * @param string $entity_type_id
   *   Type of entity to search against.
   * @param array $options
   *   Optional array of parameters, including
   *   - query (string)
   *   - which - string, matching elnid or exnid.
   *
   * @return array
   *   An array of matching overrides.
   */
  public function findOverridesByEntity($eid, $entity_type_id = "node", array $options = []) {
    $elQuery = \Drupal::entityQuery('search_override');
    if (isset($options['which'])) {
      // If specified, search in a particular column.
      if ($options['which'] == 'elnid') {
        $elQuery->condition('elnid', $eid);
      }
      else if ($options['which'] == 'exnid') {
        $elQuery->condition('exnid', $eid);
      }
    }
    else {
      // Search for matches in either column.
      $or = $elQuery->orConditionGroup();
      $or->condition('elnid', $eid);
      $or->condition('exnid', $eid);
      $elQuery->condition($or);
    }
    if (isset($options['query'])) {
      $elQuery->condition('query', $options['query']);
    }

    $elevates = $elQuery->execute();
    return $elevates;
  }

  /**
   * Generate a table to display existing overrides for an entity.
   *
   * @param int $eid
   *   Id of the entity.
   * @param string $entity_type_id
   *   Type of entity.
   *
   * @return array
   *   Table render array.
   */
  public function EntityOverridesTable($eid, $entity_type_id = "node") {
    $fields = ['elnid' => t("Promoted"), 'exnid' => t("Excluded")];
    $elStorage = \Drupal::entityTypeManager()->getStorage('search_override');
    /** @var \Drupal\Core\Entity\EntityListBuilder $list_builder */
    $list_builder = \Drupal::service('entity_type.manager')->getListBuilder('search_override');
    $rows = [];

    foreach ($fields as $field => $field_label) {
      $rows[] = [
        'query' => [
          'class' => ['search_override-table__heading'],
          'data' => new FormattableMarkup('<h4>@heading</h4>',['@heading' => $field_label]),
          'colspan' => 2,
        ],
      ];
      // Now add rows for any existing values.
      $elQuery = \Drupal::entityQuery('search_override');
      $elevates = $elQuery->condition($field, $eid)->execute();
      foreach ($elevates as $elevate_id) {
        $row = [];
        $elevate = $elStorage->load($elevate_id);
        $query_string = $elevate->get('query')->getString();
        $row['query'] = [
          'class' => ['search_override-table__query'],
          'data' => ['#plain_text' => $query_string],
          '#wrapper_attributes' => [
            '#prefix' => '<h4>',
            '#suffix' => '</h4>',
          ],
        ];
        $links = $list_builder->getOperations($elevate);
        unset($links['delete']);
        foreach ($links as $key => $link) {
          $links[$key]['attributes'] = [
            'class' => 'use-ajax',
            'data-dialog-options' => '{"width":500}',
            // TODO: make the specifics configurable in the settings.
            'data-dialog-type' => 'modal',
          ];
          if ($key == 'edit') {
            $links[$key]['title'] = $this->t('Edit / Reorder');
          }
        }
        $new_links['remove'] = [
          'title' => $this->t('Remove'),
          'weight' => 20,
          'url' => Url::fromRoute('search_overrides.override.remove.ajax', [
            'override' => $elevate_id,
            'field' => $field,
            'entity' => $eid,
          ]),
          'attributes' => [
            'class' => 'use-ajax',
            'data-dialog-type' => 'modal',
          ],
        ];
        $links = $new_links + $links;
        $row['operations'] = [
          'data' => [
            '#type' => 'operations',
            '#links' => $links,
          ],
        ];
        $rows[] = $row;
      }
    }
    // Add the list to the vertical tabs section of the form.
    $header = [
      ['class' => ['search_overrides--table--query'], 'data' => t('Query')],
      ['class' => ['search_overrides--table--operations'], 'data' => t('Operations')],
    ];
    $table = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => t('No overrides.'),
      '#attributes' => ['class' => ['search-overrides--table']],
      '#prefix' => '<div id="search-overrides--data">',
      '#suffix' => '</div>',
    ];
    return $table;

  }

}
