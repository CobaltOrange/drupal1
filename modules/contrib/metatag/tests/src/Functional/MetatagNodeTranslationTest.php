<?php

namespace Drupal\Tests\metatag\Functional;

use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\Tests\BrowserTestBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Ensures that meta tag values are translated correctly on nodes.
 *
 * @group metatag
 */
class MetatagNodeTranslationTest extends BrowserTestBase {

  use StringTranslationTrait;

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = [
    'content_translation',
    'field_ui',
    'metatag',
    'node',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * The default language code to use in this test.
   *
   * @var array
   */
  protected $defaultLangcode = 'fr';

  /**
   * Languages to enable.
   *
   * @var array
   */
  protected $additionalLangcodes = ['es'];

  /**
   * Administrator user for tests.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $adminUser;

  /**
   * Setup basic environment.
   */
  protected function setUp() {
    parent::setUp();

    $admin_permissions = [
      'administer content types',
      'administer content translation',
      'administer languages',
      'administer nodes',
      'administer node fields',
      'bypass node access',
      'create content translations',
      'delete content translations',
      'translate any entity',
      'update content translations',
    ];

    // Create and login user.
    $this->adminUser = $this->drupalCreateUser($admin_permissions);

    // Add languages.
    foreach ($this->additionalLangcodes as $langcode) {
      ConfigurableLanguage::createFromLangcode($langcode)->save();
    }
  }

  /**
   * Tests the metatag value translations.
   */
  public function testMetatagValueTranslation() {
    if (floatval(\Drupal::VERSION) <= 8.3) {
      $save_label = $this->t('Save and publish');
      $save_label_i18n = $this->t('Save and keep published (this translation)');
    }
    else {
      $save_label = $this->t('Save');
      $save_label_i18n = $this->t('Save (this translation)');
    }

    // Set up a content type.
    $name = $this->randomMachineName() . ' ' . $this->randomMachineName();
    $this->drupalLogin($this->adminUser);
    $this->drupalCreateContentType(['type' => 'metatag_node', 'name' => $name]);

    // Add a metatag field to the content type.
    $this->drupalGet('admin/structure/types');
    $this->assertSession()->statusCodeEquals(200);
    $this->drupalGet('admin/structure/types/manage/metatag_node');
    $this->assertSession()->statusCodeEquals(200);
    $edit = [
      'language_configuration[language_alterable]' => TRUE,
      'language_configuration[content_translation]' => TRUE,
    ];
    $this->drupalPostForm(NULL, $edit, $this->t('Save content type'));
    $this->assertSession()->statusCodeEquals(200);

    $this->drupalGet('admin/structure/types/manage/metatag_node/fields/add-field');
    $this->assertSession()->statusCodeEquals(200);
    $edit = [
      'label' => 'Meta tags',
      'field_name' => 'meta_tags',
      'new_storage_type' => 'metatag',
    ];
    $this->drupalPostForm(NULL, $edit, $this->t('Save and continue'));
    $this->assertSession()->statusCodeEquals(200);
    $this->drupalPostForm(NULL, [], $this->t('Save field settings'));
    $this->assertSession()->statusCodeEquals(200);
    $edit = [
      'translatable' => TRUE,
    ];
    $this->drupalPostForm(NULL, $edit, $this->t('Save settings'));
    $this->assertSession()->statusCodeEquals(200);
    $this->drupalGet('admin/structure/types/manage/metatag_node/fields/node.metatag_node.field_meta_tags');
    $this->assertSession()->statusCodeEquals(200);

    // Set up a node without explicit metatag description. This causes the
    // global default to be used, which contains a token (node:summary). The
    // token value should be correctly translated.
    // Load the node form.
    $this->drupalGet('node/add/metatag_node');
    $this->assertSession()->statusCodeEquals(200);

    // Check the default values are correct.
    $this->assertFieldByName('field_meta_tags[0][basic][title]', '[node:title] | [site:name]', 'Default title token is present.');
    $this->assertFieldByName('field_meta_tags[0][basic][description]', '[node:summary]', 'Default description token is present.');

    // Create a node.
    $edit = [
      'title[0][value]' => 'Node Fran??ais',
      'body[0][value]' => 'French summary.',
    ];
    $this->drupalPostForm(NULL, $edit, $save_label);
    $this->assertSession()->statusCodeEquals(200);

    $xpath = $this->xpath("//meta[@name='description']");
    $this->assertCount(1, $xpath, 'Exactly one description meta tag found.');
    $value = $xpath[0]->getAttribute('content');
    $this->assertEqual($value, 'French summary.');

    $this->drupalGet('node/1/translations/add/en/es');
    $this->assertSession()->statusCodeEquals(200);
    // Check the default values are there.
    $this->assertFieldByName('field_meta_tags[0][basic][title]', '[node:title] | [site:name]', 'Default title token is present.');
    $this->assertFieldByName('field_meta_tags[0][basic][description]', '[node:summary]', 'Default description token is present.');

    $edit = [
      'title[0][value]' => 'Node Espa??ol',
      'body[0][value]' => 'Spanish summary.',
    ];
    $this->drupalPostForm(NULL, $edit, $save_label_i18n);
    $this->assertSession()->statusCodeEquals(200);

    $this->drupalGet('es/node/1');
    $this->assertSession()->statusCodeEquals(200);
    $xpath = $this->xpath("//meta[@name='description']");
    $this->assertCount(1, $xpath, 'Exactly one description meta tag found.');
    $value = $xpath[0]->getAttribute('content');
    $this->assertEqual($value, 'Spanish summary.');
    $this->assertNotEqual($value, 'French summary.');

    $this->drupalGet('node/1/edit');
    $this->assertSession()->statusCodeEquals(200);
    // Check the default values are there.
    $this->assertFieldByName('field_meta_tags[0][basic][title]', '[node:title] | [site:name]', 'Default title token is present.');
    $this->assertFieldByName('field_meta_tags[0][basic][description]', '[node:summary]', 'Default description token is present.');

    // Set explicit values on the description metatag instead using the
    // defaults.
    $this->drupalGet('node/1/edit');
    $this->assertSession()->statusCodeEquals(200);
    $edit = [
      'field_meta_tags[0][basic][description]' => 'Overridden French description.',
    ];
    $this->drupalPostForm(NULL, $edit, $save_label_i18n);
    $this->assertSession()->statusCodeEquals(200);

    $xpath = $this->xpath("//meta[@name='description']");
    $this->assertCount(1, $xpath, 'Exactly one description meta tag found.');
    $value = $xpath[0]->getAttribute('content');
    $this->assertEqual($value, 'Overridden French description.');
    $this->assertNotEqual($value, 'Spanish summary.');
    $this->assertNotEqual($value, 'French summary.');

    $this->drupalGet('es/node/1/edit');
    $this->assertSession()->statusCodeEquals(200);
    $edit = [
      'field_meta_tags[0][basic][description]' => 'Overridden Spanish description.',
    ];
    $this->drupalPostForm(NULL, $edit, $save_label_i18n);
    $this->assertSession()->statusCodeEquals(200);

    $xpath = $this->xpath("//meta[@name='description']");
    $this->assertCount(1, $xpath, 'Exactly one description meta tag found.');
    $value = $xpath[0]->getAttribute('content');
    $this->assertEqual($value, 'Overridden Spanish description.');
    $this->assertNotEqual($value, 'Spanish summary.');
    $this->assertNotEqual($value, 'French summary.');
  }

}
