<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* core/profiles/demo_umami/themes/umami/templates/layout/page.html.twig */
class __TwigTemplate_d17dca0a1a0c45170da29436d36630294fa21b0fb972df453502ba5c5d3ca5ad extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 45
        echo "<div class=\"layout-container\">

  ";
        // line 47
        if (( !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "pre_header", []))))) ||  !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(        // line 48
($context["page"] ?? null), "header", []))))))) {
            // line 49
            echo "    <header class=\"layout-header\" role=\"banner\">
      <div class=\"container\">
        ";
            // line 51
            if ( !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "pre_header", [])))))) {
                // line 52
                echo "          ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "pre_header", [])), "html", null, true);
                echo "
        ";
            }
            // line 54
            echo "        ";
            if ( !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "header", [])))))) {
                // line 55
                echo "          ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true);
                echo "
        ";
            }
            // line 57
            echo "      </div>
    </header>
  ";
        }
        // line 60
        echo "
  ";
        // line 61
        if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
            // line 62
            echo "    <div class=\"layout-highlighted\">
      <div class=\"container\">
        ";
            // line 64
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
            echo "
      </div>
    </div>
  ";
        }
        // line 68
        echo "
  ";
        // line 69
        if ($this->getAttribute(($context["page"] ?? null), "tabs", [])) {
            // line 70
            echo "  <div class=\"layout-tabs\">
    <div class=\"container\">
      ";
            // line 72
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "tabs", [])), "html", null, true);
            echo "
    </div>
  </div>
  ";
        }
        // line 76
        echo "
  ";
        // line 77
        if ( !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "banner_top", [])))))) {
            // line 78
            echo "    <div class=\"layout-banner-top\">
      ";
            // line 79
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "banner_top", [])), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 82
        echo "
  ";
        // line 83
        if ( !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "breadcrumbs", [])))))) {
            // line 84
            echo "  <div class=\"layout-breadcrumbs\">
    <div class=\"container\">
      ";
            // line 86
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "breadcrumbs", [])), "html", null, true);
            echo "
    </div>
  </div>
  ";
        }
        // line 90
        echo "
  ";
        // line 91
        if ( !($context["node"] ?? null)) {
            // line 92
            echo "    ";
            if ( !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "page_title", [])))))) {
                // line 93
                echo "      <div class=\"layout-page-title\">
        ";
                // line 94
                if (($context["is_front"] ?? null)) {
                    // line 95
                    echo "          <div class=\"is-front container\">
            ";
                    // line 96
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "page_title", [])), "html", null, true);
                    echo "
          </div>
          ";
                } else {
                    // line 99
                    echo "          <div class=\"container\">
            ";
                    // line 100
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "page_title", [])), "html", null, true);
                    echo "
          </div>
        ";
                }
                // line 103
                echo "      </div>
    ";
            }
            // line 105
            echo "  ";
        }
        // line 106
        echo "
  <main role=\"main\" class=\"main container\">

    <div class=\"layout-content\">
      <a id=\"main-content\" tabindex=\"-1\"></a>";
        // line 111
        echo "      ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
        echo "
    </div>";
        // line 113
        echo "
    ";
        // line 114
        if ( !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "sidebar", [])))))) {
            // line 115
            echo "      <aside class=\"layout-sidebar\" role=\"complementary\">
        ";
            // line 116
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar", [])), "html", null, true);
            echo "
      </aside>
    ";
        }
        // line 119
        echo "
  </main>

  ";
        // line 122
        if ( !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "content_bottom", [])))))) {
            // line 123
            echo "    <div class=\"layout-content-bottom\">
      ";
            // line 124
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content_bottom", [])), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 127
        echo "
  ";
        // line 128
        if ( !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "footer", [])))))) {
            // line 129
            echo "  <div class=\"layout-footer\">
    <footer class=\"footer\" role=\"contentinfo\">
      <div class=\"container\">
        ";
            // line 132
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo "
      </div>
    </footer>
  </div>
  ";
        }
        // line 137
        echo "
  ";
        // line 138
        if ( !twig_test_empty(twig_trim_filter(strip_tags($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "bottom", [])))))) {
            // line 139
            echo "    <div class=\"layout-bottom\">
      <div class=\"container\">
        ";
            // line 141
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "bottom", [])), "html", null, true);
            echo "
      </div>
    </div>
  ";
        }
        // line 145
        echo "
</div>";
    }

    public function getTemplateName()
    {
        return "core/profiles/demo_umami/themes/umami/templates/layout/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  240 => 145,  233 => 141,  229 => 139,  227 => 138,  224 => 137,  216 => 132,  211 => 129,  209 => 128,  206 => 127,  200 => 124,  197 => 123,  195 => 122,  190 => 119,  184 => 116,  181 => 115,  179 => 114,  176 => 113,  171 => 111,  165 => 106,  162 => 105,  158 => 103,  152 => 100,  149 => 99,  143 => 96,  140 => 95,  138 => 94,  135 => 93,  132 => 92,  130 => 91,  127 => 90,  120 => 86,  116 => 84,  114 => 83,  111 => 82,  105 => 79,  102 => 78,  100 => 77,  97 => 76,  90 => 72,  86 => 70,  84 => 69,  81 => 68,  74 => 64,  70 => 62,  68 => 61,  65 => 60,  60 => 57,  54 => 55,  51 => 54,  45 => 52,  43 => 51,  39 => 49,  37 => 48,  36 => 47,  32 => 45,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/profiles/demo_umami/themes/umami/templates/layout/page.html.twig", "/app/core/profiles/demo_umami/themes/umami/templates/layout/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 47];
        static $filters = ["trim" => 47, "striptags" => 47, "render" => 47, "escape" => 52];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['trim', 'striptags', 'render', 'escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
