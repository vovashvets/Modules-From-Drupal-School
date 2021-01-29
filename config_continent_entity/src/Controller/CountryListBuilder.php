<?php

namespace Drupal\config_continent_entity\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of robot entities.
 *
 * List Controllers provide a list of entities in a tabular form. The base
 * class provides most of the rendering logic for us. The key functions
 * we need to override are buildHeader() and buildRow(). These control what
 * columns are displayed in the table, and how each row is displayed
 * respectively.
 *
 * Drupal locates the list controller by looking for the "list" entry under
 * "controllers" in our entity type's annotation. We define the path on which
 * the list may be accessed in our module's *.routing.yml file. The key entry
 * to look for is "_entity_list". In *.routing.yml, "_entity_list" specifies
 * an entity type ID. When a user navigates to the URL for that router item,
 * Drupal loads the annotation for that entity type. It looks for the "list"
 * entry under "controllers" for the class to load.
 *
 * @ingroup country
 */
class CountryListBuilder extends ConfigEntityListBuilder {

  /**
   * Builds the header row for the entity listing.
   *
   * @return array
   *   A render array structure of header strings.
   *
   * @see \Drupal\Core\Entity\EntityListController::render()
   */
  public function buildHeader() {
    $header['machine_name'] = $this->t('Machine Name');
    $header['name'] = $this->t('Name');
    $header['code'] = $this->t('Code');
    $header['continent_id'] = $this->t('Continent');
    return $header + parent::buildHeader();
  }

  /**
   * Builds a row for an entity in the entity listing.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity for which to build the row.
   *
   * @return array
   *   A render array of the table row for displaying the entity.
   *
   * @see \Drupal\Core\Entity\EntityListController::render()
   */
  public function buildRow(EntityInterface $entity) {
    $row['machine_name'] = $entity->id();
    $row['name'] = $entity->name;
    $row['code'] = $entity->code;
    $row['continent_id'] = $entity-> continent_id;

    return $row + parent::buildRow($entity);
  }

  /**
   * Adds some descriptive text to our entity list.
   *
   * Typically, there's no need to override render(). You may wish to do so,
   * however, if you want to add markup before or after the table.
   *
   * @return array
   *   Renderable array.
   */
  public function render() {
    $template_path = drupal_get_path('module', 'config_continent_entity') . "/templates/country.html.twig";
    $build = [
      '#type' => 'inline_template',
      '#template' => file_get_contents($template_path),
    ];
    $build[] = parent::render();
    return $build;
  }
}
